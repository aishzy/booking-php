<?php

namespace App\Security;

class CsrfToken {
    private const TOKEN_SESSION_KEY = '_csrf_token';
    private string $token;

    public function __construct() {
        if (!isset($_SESSION[self::TOKEN_SESSION_KEY]) || empty($_SESSION[self::TOKEN_SESSION_KEY])) {
            $_SESSION[self::TOKEN_SESSION_KEY] = $this->generateToken();
        }
        $this->token = $_SESSION[self::TOKEN_SESSION_KEY];
    }

    public function generate(): string {
        $_SESSION[self::TOKEN_SESSION_KEY] = $this->generateToken();
        return $_SESSION[self::TOKEN_SESSION_KEY];
    }

    public function getToken(): string {
        return $this->token;
    }

    public function verify(string $token): bool {
        return hash_equals($this->token, $token);
    }

    private function generateToken(): string {
        return bin2hex(random_bytes(32));
    }
}
