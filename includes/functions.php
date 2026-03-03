<?php
function sanitize(string $input): string
{
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

function uploadImage(array $file, string $uploadDir = 'assets/images/uploads'): string|false
{
    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
    $maxSize = 5 * 1024 * 1024; // 5 MB

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return false;
    }

    // Validate MIME type using finfo (more reliable than extension)
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file['tmp_name']);
    if (!in_array($mime, $allowedTypes, true)) {
        return false;
    }

    if ($file['size'] > $maxSize) {
        return false;
    }

    $ext = match ($mime) {
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
        };
    $filename = uniqid('img_', true) . '.' . $ext;
    $destDir = rtrim(__DIR__ . '/../' . $uploadDir, '/');

    if (!is_dir($destDir)) {
        mkdir($destDir, 0755, true);
    }

    $dest = $destDir . '/' . $filename;
    if (!move_uploaded_file($file['tmp_name'], $dest)) {
        return false;
    }

    return $filename;
}

function deleteUpload(string $filename, string $uploadDir = 'assets/images/uploads'): void
{
    $path = __DIR__ . '/../' . rtrim($uploadDir, '/') . '/' . $filename;
    if (file_exists($path) && is_file($path)) {
        unlink($path);
    }
}

function formatPrice(float $price): string
{
    return '₹' . number_format($price, 2);
}

function timeSlots(): array
{
    return [
        '09:00 AM', '09:30 AM', '10:00 AM', '10:30 AM',
        '11:00 AM', '11:30 AM', '12:00 PM', '12:30 PM',
        '01:00 PM', '01:30 PM', '02:00 PM', '02:30 PM',
        '03:00 PM', '03:30 PM', '04:00 PM', '04:30 PM',
        '05:00 PM', '05:30 PM', '06:00 PM', '06:30 PM',
    ];
}

function redirect(string $url): void
{
    header('Location: ' . $url);
    exit;
}

function flash(string $key, string $message = ''): ?string
{
    if (session_status() === PHP_SESSION_NONE)
        session_start();
    if ($message !== '') {
        $_SESSION['flash'][$key] = $message;
        return null;
    }
    $msg = $_SESSION['flash'][$key] ?? null;
    unset($_SESSION['flash'][$key]);
    return $msg;
}
