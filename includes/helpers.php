<?php

function e(mixed $value): string {
    return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
}

function redirect(string $url = 'index.php'): never {
    $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/');
    $position = strrpos($script, '/');
    $base = $position !== false ? substr($script, 0, $position) : '';

    if (preg_match('~/includes$~i', $base)) {
        $base = substr($base, 0, -9);
    }

    $url = ltrim(str_replace('\\', '/', $url), '/');

    header('Location: ' . $base . '/' . $url, true, 302);
    exit;
}

function flash(string $type, string $message): void {
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message
    ];
}

function csrf_token(): string {
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf'];
}

function verify_csrf(): void {
    $token = $_POST['csrf'] ?? '';

    if (!is_string($token) || !hash_equals($_SESSION['csrf'] ?? '', $token)) {
        http_response_code(419);
        exit('Solicitud no válida. Recarga la página e inténtalo nuevamente.');
    }
}

function require_login(): void {
    if (empty($_SESSION['user'])) {
        redirect('login.php');
    }
}

function current_user(): array {
    return $_SESSION['user'] ?? [];
}

function nav_active(string $key, string $current): string {
    return $key === $current ? 'active' : '';
}

function money(float|string|null $amount): string {
    return 'S/ ' . number_format((float)$amount, 2);
}