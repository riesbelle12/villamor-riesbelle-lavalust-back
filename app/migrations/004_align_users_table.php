<?php

class Align_users_table
{
    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        if (!$this->_lava->dbforge->table_exists('users')) {
            throw new RuntimeException('Cannot align the users table because it does not exist.');
        }

        $has_legacy_active = $this->_lava->dbforge->column_exists('users', 'isactive');
        $has_active = $this->_lava->dbforge->column_exists('users', 'is_active');

        if ($has_legacy_active && $has_active) {
            throw new RuntimeException('Both users.isactive and users.is_active exist; resolve the duplicate columns before migrating.');
        }

        if ($has_legacy_active) {
            $this->_lava->db->raw(
                'ALTER TABLE `users` RENAME COLUMN `isactive` TO `is_active`'
            );
        } elseif (!$has_active) {
            throw new RuntimeException('Neither users.isactive nor users.is_active exists.');
        }

        if (!$this->_lava->dbforge->column_exists('users', 'role')) {
            $this->_lava->dbforge->add_column('users', [
                'role' => [
                    'type' => 'ENUM',
                    'constraint' => "'admin','moderator','user'",
                    'null' => FALSE,
                    'default' => 'user',
                ],
            ]);
        }
    }

    public function down()
    {
        $has_legacy_active = $this->_lava->dbforge->column_exists('users', 'isactive');
        $has_active = $this->_lava->dbforge->column_exists('users', 'is_active');

        if ($has_legacy_active && $has_active) {
            throw new RuntimeException('Both users.isactive and users.is_active exist; resolve the duplicate columns before rolling back.');
        }

        if ($this->_lava->dbforge->column_exists('users', 'role')) {
            $this->_lava->dbforge->drop_column('users', 'role');
        }

        if ($has_active) {
            $this->_lava->db->raw(
                'ALTER TABLE `users` RENAME COLUMN `is_active` TO `isactive`'
            );
        }
    }
}
