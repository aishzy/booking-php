<?php

namespace App\Http;

class Request {
    private array $get;
    private array $post;
    private array $files;
    private array $server;
    private array $headers;
    private ?string $body;

    public function __construct() {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->files = $_FILES;
        $this->server = $_SERVER;
        $this->body = file_get_contents('php://input');
        $this->parseHeaders();
    }

    private function parseHeaders(): void {
        $this->headers = [];
        foreach ($this->server as $key => $value) {
            if (strpos($key, 'HTTP_') === 0) {
                $headerKey = str_replace('HTTP_', '', $key);
                $headerKey = str_replace('_', '-', strtolower($headerKey));
                $this->headers[$headerKey] = $value;
            }
        }
    }

    public function getMethod(): string {
        return strtoupper($this->server['REQUEST_METHOD'] ?? 'GET');
    }

    public function getPath(): string {
        $path = parse_url($this->server['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        return rtrim(str_replace(rtrim(dirname($this->server['SCRIPT_NAME']), '/'), '', $path), '/') ?: '/';
    }

    public function getQuery(string $key = null, $default = null) {
        if ($key === null) {
            return $this->get;
        }
        return $this->get[$key] ?? $default;
    }

    public function getInput(string $key = null, $default = null) {
        if ($key === null) {
            return array_merge($this->post, json_decode($this->body, true) ?? []);
        }
        return $this->post[$key] ?? json_decode($this->body, true)[$key] ?? $default;
    }

    public function getPost(string $key = null, $default = null) {
        if ($key === null) {
            return $this->post;
        }
        return $this->post[$key] ?? $default;
    }

    public function getFile(string $key) {
        return $this->files[$key] ?? null;
    }

    public function all(): array {
        return array_merge($this->get, $this->post);
    }

    public function only(array $keys): array {
        return array_intersect_key($this->all(), array_flip($keys));
    }

    public function except(array $keys): array {
        return array_diff_key($this->all(), array_flip($keys));
    }

    public function has(string $key): bool {
        return isset($this->post[$key]) || isset($this->get[$key]);
    }

    public function header(string $header): ?string {
        return $this->headers[strtolower($header)] ?? null;
    }

    public function getHeaders(): array {
        return $this->headers;
    }

    public function getBody(): ?string {
        return $this->body;
    }

    public function getJsonData(): ?array {
        return json_decode($this->body, true);
    }

    public function isJson(): bool {
        return strpos($this->header('content-type') ?? '', 'application/json') !== false;
    }

    public function isAjax(): bool {
        return strtolower($this->header('x-requested-with') ?? '') === 'xmlhttprequest';
    }

    public function getReferer(): ?string {
        return $this->header('referer');
    }

    public function getCookie(string $name): ?string {
        return $_COOKIE[$name] ?? null;
    }

    public function getIp(): string {
        if (!empty($this->server['HTTP_CLIENT_IP'])) {
            $ip = $this->server['HTTP_CLIENT_IP'];
        } elseif (!empty($this->server['HTTP_X_FORWARDED_FOR'])) {
            $ip = explode(',', $this->server['HTTP_X_FORWARDED_FOR'])[0];
        } else {
            $ip = $this->server['REMOTE_ADDR'] ?? '0.0.0.0';
        }
        return trim($ip);
    }
}
