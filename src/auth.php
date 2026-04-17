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
    app_start_session();

    if (!isset($_GET['message'])) {
        return null;
    }

    $message = trim((string) $_GET['message']);

    return $message === '' ? null : $message;
}

function app_get_flash_tone($message)
{
    $value = strtolower(trim((string) $message));

    if ($value === '') {
        return 'info';
    }

    $successKeywords = [
        'success',
        'successful',
        'updated',
        'created',
        'saved',
        'confirmed',
        'assigned',
        'completed',
        'logged in',
        'login successful',
    ];
    foreach ($successKeywords as $keyword) {
        if (strpos($value, $keyword) !== false) {
            return 'success';
        }
    }

    $dangerKeywords = [
        'wrong',
        'invalid',
        'expired',
        'failed',
        'could not',
        'not found',
        'unauthorized',
        'required',
        'denied',
        'error',
        'not be',
        'only authorized',
    ];
    foreach ($dangerKeywords as $keyword) {
        if (strpos($value, $keyword) !== false) {
            return 'danger';
        }
    }

    return 'info';
}

function app_render_toast($message, $tone = null)
{
    if ($message === null || $message === '') {
        return '';
    }

    $resolvedTone = $tone ?? app_get_flash_tone($message);
    $iconMap = [
        'success' => 'check',
        'danger' => 'triangle-alert',
        'info' => 'info',
    ];
    $icon = $iconMap[$resolvedTone] ?? $iconMap['info'];
    $liveMode = $resolvedTone === 'danger' ? 'assertive' : 'polite';

    $markup = '<div class="app-toast-viewport" data-app-toast-root>';
    $markup .= '<div class="app-toast app-toast-' . htmlspecialchars($resolvedTone, ENT_QUOTES, 'UTF-8') . '" role="status" aria-live="' . $liveMode . '" data-app-toast>';
    $markup .= '<div class="app-toast__icon" aria-hidden="true">';
    $markup .= '<span class="app-toast__icon-mark app-toast__icon-mark-' . htmlspecialchars($icon, ENT_QUOTES, 'UTF-8') . '"></span>';
    $markup .= '</div>';
    $markup .= '<div class="app-toast__body">';
    $markup .= '<div class="app-toast__eyebrow">Notification</div>';
    $markup .= '<div class="app-toast__message">' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</div>';
    $markup .= '</div>';
    $markup .= '<button class="app-toast__close" type="button" aria-label="Dismiss notification" data-app-toast-close>&times;</button>';
    $markup .= '<div class="app-toast__progress"></div>';
    $markup .= '</div>';
    $markup .= '</div>';
    $markup .= '<script>(function(){var root=document.currentScript.previousElementSibling;if(!root||root.dataset.appToastBound==="true"){return;}root.dataset.appToastBound="true";var toast=root.querySelector("[data-app-toast]");if(!toast){return;}var removeToast=function(){if(root.parentNode){root.parentNode.removeChild(root);}};var hideToast=function(){if(toast.classList.contains("is-hiding")){return;}toast.classList.add("is-hiding");window.setTimeout(removeToast,260);};window.setTimeout(hideToast,4600);root.addEventListener("click",function(event){if(event.target.closest("[data-app-toast-close]")){hideToast();}});})();</script>';

    return $markup;
}

function app_render_alert($message)
{
    return app_render_toast($message);
}

function app_render_flash_banner($message)
{
    return app_render_toast($message);
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