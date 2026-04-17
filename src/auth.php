<?php

function app_start_session()
{
    if (session_status() === PHP_SESSION_NONE) {
        $isSecure = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';

        session_set_cookie_params([
            'httponly' => true,
            'samesite' => 'Lax',
            'secure' => $isSecure,
        ]);

        session_start();
    }
}

function app_redirect($location, $message = null)
{
    if ($message !== null && $message !== '') {
        $separator = strpos($location, '?') === false ? '?' : '&';
        $location .= $separator . 'message=' . rawurlencode($message);
    }

    if (!headers_sent()) {
        header('Location: ' . $location);
        exit;
    }

    echo '<script>window.location = ' . json_encode($location) . ';</script>';
    exit;
}

function app_get_flash_message()
{
    if (!isset($_GET['message'])) {
        return null;
    }

    $message = trim((string) $_GET['message']);

    return $message === '' ? null : $message;
}

function app_render_alert($message)
{
    if ($message === null || $message === '') {
        return '';
    }

    return '<script>alert(' . json_encode($message) . ');</script>';
}

function app_render_flash_banner($message)
{
    if ($message === null || $message === '') {
        return '';
    }

    return '<div class="app-flash">' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</div>';
}

function app_hash_password($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}

function app_verify_password($plainPassword, $storedPassword)
{
    if ($storedPassword === null || $storedPassword === '') {
        return false;
    }

    if (preg_match('/^[a-f0-9]{32}$/i', $storedPassword)) {
        return hash_equals(strtolower($storedPassword), md5($plainPassword));
    }

    return password_verify($plainPassword, $storedPassword);
}

function app_password_needs_upgrade($storedPassword)
{
    if ($storedPassword === null || $storedPassword === '') {
        return false;
    }

    if (preg_match('/^[a-f0-9]{32}$/i', $storedPassword)) {
        return true;
    }

    return password_needs_rehash($storedPassword, PASSWORD_DEFAULT);
}

function app_normalize_email($email)
{
    return strtolower(trim((string) $email));
}

function app_get_csrf_token()
{
    app_start_session();

    if (empty($_SESSION['_csrf_token'])) {
        $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['_csrf_token'];
}

function app_csrf_input()
{
    return '<input type="hidden" name="_csrf_token" value="' . htmlspecialchars(app_get_csrf_token(), ENT_QUOTES, 'UTF-8') . '">';
}

function app_verify_csrf_token($token)
{
    app_start_session();

    return isset($_SESSION['_csrf_token'])
        && is_string($token)
        && hash_equals($_SESSION['_csrf_token'], $token);
}

function app_require_post_request($redirectPath)
{
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
        app_redirect($redirectPath, 'Invalid request method.');
    }
}

function app_require_csrf_token($redirectPath)
{
    $token = $_POST['_csrf_token'] ?? '';

    if (!app_verify_csrf_token($token)) {
        app_redirect($redirectPath, 'Your session expired. Please try again.');
    }
}