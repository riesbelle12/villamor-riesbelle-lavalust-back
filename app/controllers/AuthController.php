<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('UserModel');
    }

    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!empty($_SESSION['authenticated'])) {
            return redirect('/products');
        }

        $error = '';
        $username = trim((string) ($_POST['username'] ?? ''));

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = (string) ($_POST['password'] ?? '');
            $user = $username !== '' ? $this->UserModel->find_by('username', $username) : false;
            $active = $user && (int) (
                $user->isactive
                ?? $user->is_active
                ?? $user['isactive']
                ?? $user['is_active']
                ?? 1
            ) === 1;
            $hash = $user ? (string) ($user->password ?? $user['password'] ?? '') : '';

            if ($active && $password !== '' && password_verify($password, $hash)) {
                session_regenerate_id(true);
                $_SESSION['authenticated'] = true;
                $_SESSION['username'] = $username;
                return redirect('/products');
            }

            $error = 'Invalid username or password.';
        }

        $this->call->view('auth/login', [
            'error' => $error,
            'username' => $username
        ]);
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];
        session_destroy();
        redirect('/login');
    }
}
