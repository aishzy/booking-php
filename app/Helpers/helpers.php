<?php

namespace App\Helpers;

/**
 * Get config values using dot notation
 * 
 * @param string $key Config key in dot notation (e.g., 'app.debug')
 * @param mixed $default Default value if key not found
 * @return mixed
 */
function config(string $key, $default = null) {
    $parts = explode('.', $key);
    $file = array_shift($parts);
    $config = require BASE_PATH . "/config/{$file}.php";
    
    foreach ($parts as $part) {
        $config = $config[$part] ?? null;
        if ($config === null) {
            return $default;
        }
    }
    
    return $config ?? $default;
}

/**
 * Check if user is authenticated
 */
function auth(): ?array {
    return isset($_SESSION['user_id']) ? [
        'id' => $_SESSION['user_id'],
        'name' => $_SESSION['user_name'] ?? null,
        'email' => $_SESSION['user_email'] ?? null,
    ] : null;
}

/**
 * Get authenticated user ID
 */
function auth_id(): ?int {
    return $_SESSION['user_id'] ?? null;
}

/**
 * Check if user is authenticated
 */
function is_authenticated(): bool {
    return isset($_SESSION['user_id']);
}

/**
 * Redirect to URL
 */
function redirect(string $url): never {
    header("Location: {$url}");
    exit;
}

/**
 * Get CSRF token
 */
function csrf_token(): string {
    $csrf = new \App\Security\CsrfToken();
    return $csrf->getToken();
}

/**
 * Create a hidden CSRF token input for forms
 */
function csrf_field(): string {
    return '<input type="hidden" name="_token" value="' . htmlspecialchars(csrf_token()) . '">';
}
