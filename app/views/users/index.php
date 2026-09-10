<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Management Module</title>

    <style>
        /* =================================
           GLOBAL SETTINGS
           ================================= */

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 55px 30px;
            font-family: Arial, Helvetica, sans-serif;

            /* Warm sunflower background */
            background:
                radial-gradient(circle at top left, #fff4bd 0%, transparent 30%),
                linear-gradient(135deg, #fff9df, #f8e7a6);

            color: #493b17;
        }

        .container {
            width: 100%;
            max-width: 1150px;
            margin: auto;
        }


        /* =================================
           HEADER
           ================================= */

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 30px;
            padding: 10px 5px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .sunflower-icon {
            width: 58px;
            height: 58px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #f7c928;
            border: 5px solid #e5a900;
            border-radius: 50%;

            font-size: 29px;

            box-shadow:
                0 7px 15px rgba(153, 105, 0, 0.18);
        }

        .header h1 {
            margin: 0;

            color: #6d4b00;

            font-size: 34px;
            font-weight: 800;

            letter-spacing: 1px;
        }

        .header p {
            margin: 7px 0 0;

            color: #806c3a;

            font-size: 14px;
            letter-spacing: 0.5px;
        }

        .user-count {
            padding: 10px 17px;

            background: #fff8d8;

            border: 1px solid #e6c85b;
            border-radius: 30px;

            color: #876500;

            font-size: 13px;
            font-weight: 700;

            box-shadow: 0 4px 10px rgba(133, 99, 0, 0.08);
        }


        /* =================================
           MAIN CARD
           ================================= */

        .card {
            padding: 24px;

            background: rgba(255, 255, 255, 0.82);

            border: 1px solid #e8cf72;
            border-radius: 22px;

            box-shadow:
                0 12px 35px rgba(110, 82, 10, 0.12);

            backdrop-filter: blur(8px);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 20px;
            padding: 4px 5px;
        }

        .card-title {
            margin: 0;

            color: #654900;

            font-size: 17px;
            font-weight: 700;
        }

        .card-subtitle {
            margin: 5px 0 0;

            color: #9a8755;

            font-size: 12px;
        }

        .flower {
            font-size: 22px;
        }


        /* =================================
           TABLE WRAPPER
           ================================= */

        .table-wrapper {
            overflow-x: auto;

            border: 1px solid #eadb9c;
            border-radius: 15px;
        }


        /* =================================
           TABLE
           ================================= */

        table {
            width: 100%;
            min-width: 700px;

            border-collapse: separate;
            border-spacing: 0;
        }


        /* =================================
           TABLE HEADER
           ================================= */

        th {
            padding: 16px 19px;

            background: #f5ca28;

            color: #5b4200;

            text-align: left;

            font-size: 12px;
            font-weight: 800;

            letter-spacing: 0.8px;
            text-transform: uppercase;

            border-bottom: 2px solid #e1b51a;
        }

        th:first-child {
            border-radius: 14px 0 0 0;
        }

        th:last-child {
            border-radius: 0 14px 0 0;
        }


        /* =================================
           TABLE BODY
           ================================= */

        td {
            padding: 18px 19px;

            background: #fffdf4;

            color: #5b5137;

            font-size: 14px;

            border-bottom: 1px solid #eee3b9;

            transition: all 0.2s ease;
        }

        tbody tr {
            transition: all 0.2s ease;
        }

        tbody tr:hover td {
            background: #fff7cf;
        }

        tbody tr:hover {
            transform: translateY(-1px);

            box-shadow:
                0 5px 15px rgba(125, 92, 5, 0.08);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }


        /* =================================
           SPECIAL COLUMNS
           ================================= */

        .id {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-width: 36px;
            height: 30px;

            padding: 0 9px;

            background: #fff0a6;

            border-radius: 20px;

            color: #876100;

            font-weight: 800;
        }

        .username {
            color: #9a6900;

            font-weight: 700;
        }

        .email {
            color: #746744;
        }


        /* =================================
           EMPTY STATE
           ================================= */

        .empty {
            padding: 55px 20px !important;

            text-align: center;

            color: #9b8a5b;

            letter-spacing: 0.5px;
        }

        .empty-icon {
            display: block;

            margin-bottom: 10px;

            font-size: 32px;
        }


        /* =================================
           FOOTER DECORATION
           ================================= */

        .footer-decoration {
            margin-top: 22px;

            text-align: center;

            color: #aa8b32;

            font-size: 12px;
            letter-spacing: 1px;
        }


        /* =================================
           MOBILE DESIGN
           ================================= */

        @media (max-width: 700px) {

            body {
                padding: 30px 14px;
            }

            .header {
                align-items: flex-start;
                margin-bottom: 24px;
            }

            .header-left {
                gap: 12px;
            }

            .sunflower-icon {
                width: 48px;
                height: 48px;

                font-size: 23px;
                border-width: 4px;
            }

            .header h1 {
                font-size: 27px;
            }

            .header p {
                font-size: 12px;
            }

            .user-count {
                display: none;
            }

            .card {
                padding: 15px;

                border-radius: 18px;
            }

            .card-header {
                margin-bottom: 15px;
            }

            .card-title {
                font-size: 15px;
            }

            .table-wrapper {
                border-radius: 12px;
            }

            th,
            td {
                padding: 14px 13px;

                font-size: 13px;
            }
        }

        @media (max-width: 420px) {

            body {
                padding: 22px 10px;
            }

            .header h1 {
                font-size: 23px;
            }

            .header p {
                font-size: 11px;
            }

            .card {
                padding: 10px;
            }

            th,
            td {
                padding: 13px 11px;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- =================================
             HEADER
             ================================= -->

        <div class="header">

            <div class="header-left">

                <div class="sunflower-icon">
                    🌻
                </div>

                <div>
                    <h1>Users</h1>

                    <p>
                        User Management Module
                    </p>
                </div>

            </div>

            <div class="user-count">
                USER DIRECTORY
            </div>

        </div>


        <!-- =================================
             USER CARD
             ================================= -->

        <div class="card">

            <div class="card-header">

                <div>
                    <h2 class="card-title">
                        User Directory
                    </h2>

                    <p class="card-subtitle">
                        Manage and view registered users
                    </p>
                </div>

                <div class="flower">
                    🌻
                </div>

            </div>


            <!-- =================================
                 TABLE
                 ================================= -->

            <div class="table-wrapper">

                <table>

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Username</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (!empty($users)) : ?>

                            <?php foreach ($users as $user) : ?>

                                <tr>

                                    <td>
                                        <span class="id">
                                            <?= htmlspecialchars($user->id ?? $user['id']) ?>
                                        </span>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($user->firstname ?? $user['firstname']) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($user->lastname ?? $user['lastname']) ?>
                                    </td>

                                    <td class="email">
                                        <?= htmlspecialchars($user->email ?? $user['email']) ?>
                                    </td>

                                    <td class="username">
                                        <?= htmlspecialchars($user->username ?? $user['username']) ?>
                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else : ?>

                            <tr>
                                <td colspan="5" class="empty">

                                    <span class="empty-icon">
                                        🌻
                                    </span>

                                    No users found.

                                </td>
                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>


        <div class="footer-decoration">
            ✦ &nbsp; Growing your user community &nbsp; ✦
        </div>

    </div>

</body>
</html>
