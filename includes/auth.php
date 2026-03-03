<?php
function requireAdmin(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['admin_id'])) {
        header('Location: /admin/login.php');
        exit;
    }
    // Session timeout: 2 hours
    $timeout = 7200;
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
        session_unset();
        session_destroy();
        header('Location: /admin/login.php?timeout=1');
        exit;
    }
    $_SESSION['last_activity'] = time();
}

function adminLogin(string $username, string $password): bool
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $pdo = getPDO();
    $stmt = $pdo->prepare('SELECT id, password_hash FROM admins WHERE username = ?');
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $username;
        $_SESSION['last_activity'] = time();
        return true;
    }
    return false;
}

function adminLogout(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    session_unset();
    session_destroy();
}
