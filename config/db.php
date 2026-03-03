<?php
// Load .env if not already in environment (local dev)
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
    if (file_exists(__DIR__ . '/../.env')) {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->safeLoad();
    }
}

function getenv_val(string $key, string $default = ''): string {
    return $_ENV[$key] ?? getenv($key) ?: $default;
}

function getPDO(): PDO {
    static $pdo = null;
    if ($pdo !== null) return $pdo;

    $host = getenv_val('DB_HOST', 'db');
    $port = getenv_val('DB_PORT', '5432');
    $name = getenv_val('DB_NAME', 'salon');
    $user = getenv_val('DB_USER', 'salon_user');
    $pass = getenv_val('DB_PASS', 'salon_pass');

    $dsn = "pgsql:host={$host};port={$port};dbname={$name}";

    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    } catch (PDOException $e) {
        // Don't expose DB details in production
        error_log('DB Connection failed: ' . $e->getMessage());
        die('Database connection error. Please try again later.');
    }

    return $pdo;
}
