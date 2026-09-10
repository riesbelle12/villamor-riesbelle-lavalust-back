<?php
$error = isset($error) ? (string) $error : '';
$username = isset($username) ? (string) $username : '';
$escape = static function ($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style><?php require __DIR__ . '/../../../public/assets/css/dahlia.css'; ?></style>
</head>
<body class="dahlia-page dahlia-login">
    <main class="dahlia-card">
        <p class="dahlia-kicker">Dahlia garden</p>
        <div class="dahlia-flower" aria-hidden="true">✿</div>
        <h1>Welcome back</h1>
        <p class="dahlia-subtitle">Sign in to tend your product collection.</p>

        <?php if ($error !== '') : ?>
            <p class="dahlia-error"><?= $escape($error) ?></p>
        <?php endif; ?>

        <form class="dahlia-form" method="post" action="<?= $escape(site_url('/login')) ?>">
            <label for="username">Username
                <input id="username" name="username" type="text" value="<?= $escape($username) ?>" required>
            </label>

            <label for="password">Password
                <input id="password" name="password" type="password" required>
            </label>

            <button type="submit">Login</button>
        </form>
    </main>
</body>
</html>
