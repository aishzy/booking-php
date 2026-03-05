<?php

namespace App\Http;

class Response {
    private int $statusCode = 200;
    private array $headers = [];
    private string $body = '';
    private bool $headersSent = false;

    public function __construct() {
        $this->headers['Content-Type'] = 'text/html; charset=UTF-8';
    }

    public function setStatusCode(int $code): self {
        $this->statusCode = $code;
        return $this;
    }

    public function getStatusCode(): int {
        return $this->statusCode;
    }

    public function setHeader(string $key, string $value): self {
        $this->headers[$key] = $value;
        return $this;
    }

    public function getHeader(string $key): ?string {
        return $this->headers[$key] ?? null;
    }

    public function json($data, int $statusCode = 200): self {
        $this->statusCode = $statusCode;
        $this->headers['Content-Type'] = 'application/json';
        $this->body = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        return $this;
    }

    public function html(string $content, int $statusCode = 200): self {
        $this->statusCode = $statusCode;
        $this->headers['Content-Type'] = 'text/html; charset=UTF-8';
        $this->body = $content;
        return $this;
    }

    public function text(string $content, int $statusCode = 200): self {
        $this->statusCode = $statusCode;
        $this->headers['Content-Type'] = 'text/plain';
        $this->body = $content;
        return $this;
    }

    public function view(string $view, array $data = []): self {
        ob_start();
        extract($data);
        include BASE_PATH . "/views/{$view}.php";
        $this->body = ob_get_clean();
        return $this;
    }

    public function success($data = null, string $message = 'Success', int $statusCode = 200): self {
        return $this->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    public function error(string $message, $data = null, int $statusCode = 400): self {
        return $this->json([
            'success' => false,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    public function unauthorized(string $message = 'Unauthorized'): self {
        return $this->error($message, null, 401);
    }

    public function forbidden(string $message = 'Forbidden'): self {
        return $this->error($message, null, 403);
    }

    public function notFound(string $message = 'Not Found'): self {
        return $this->error($message, null, 404);
    }

    public function serverError(string $message = 'Internal Server Error'): self {
        return $this->error($message, null, 500);
    }

    public function redirect(string $url, int $statusCode = 302): self {
        $this->statusCode = $statusCode;
        $this->headers['Location'] = $url;
        return $this;
    }

    public function send(): void {
        if ($this->headersSent) {
            return;
        }

        http_response_code($this->statusCode);
        
        foreach ($this->headers as $key => $value) {
            header("{$key}: {$value}");
        }

        echo $this->body;
        $this->headersSent = true;
    }

    public function getBody(): string {
        return $this->body;
    }

    public function __toString(): string {
        return $this->body;
    }
}
