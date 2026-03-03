<?php
function generateCsrfToken(): string
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrfField(): string
{
    $token = generateCsrfToken();
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token) . '">';
}

function validateCsrfToken(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $submitted = $_POST['csrf_token'] ?? '';
    $stored = $_SESSION['csrf_token'] ?? '';

    if (empty($submitted) || empty($stored) || !hash_equals($stored, $submitted)) {
        http_response_code(403);
        die('Invalid CSRF token. Please go back and try again.');
    }
    // Rotate token after use
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
