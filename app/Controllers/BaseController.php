<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;

abstract class BaseController {
    protected Request $request;
    protected Response $response;

    public function __construct(Request $request, Response $response) {
        $this->request = $request;
        $this->response = $response;
    }

    protected function validate(array $rules): array {
        $validator = new \App\Validation\Validator($this->request, $rules);
        return $validator->validate();
    }

    protected function view(string $view, array $data = []): Response {
        return $this->response->view($view, $data);
    }

    protected function json($data, int $statusCode = 200): Response {
        return $this->response->json($data, $statusCode);
    }

    protected function success($data = null, string $message = 'Success'): Response {
        return $this->response->success($data, $message);
    }

    protected function error(string $message, $data = null, int $statusCode = 400): Response {
        return $this->response->error($message, $data, $statusCode);
    }

    protected function unauthorized(string $message = 'Unauthorized'): Response {
        return $this->response->unauthorized($message);
    }

    protected function forbidden(string $message = 'Forbidden'): Response {
        return $this->response->forbidden($message);
    }

    protected function notFound(string $message = 'Not Found'): Response {
        return $this->response->notFound($message);
    }

    protected function serverError(string $message = 'Internal Server Error'): Response {
        return $this->response->serverError($message);
    }

    protected function redirect(string $url): Response {
        return $this->response->redirect($url);
    }

    protected function getRequest(): Request {
        return $this->request;
    }

    protected function getResponse(): Response {
        return $this->response;
    }

    /**
     * Helper method - Check if user is authenticated
     */
    protected function isAuthenticated(): bool {
        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }

    /**
     * Helper method - Get authenticated user ID
     */
    protected function getAuthId(): ?int {
        return $_SESSION['user_id'] ?? null;
    }

    /**
     * Helper method - Get authenticated user info
     */
    protected function getAuth(): ?array {
        if (!$this->isAuthenticated()) {
            return null;
        }
        return [
            'id' => $_SESSION['user_id'],
            'name' => $_SESSION['user_name'] ?? null,
            'email' => $_SESSION['user_email'] ?? null,
        ];
    }

    /**
     * Helper method - Get CSRF token
     */
    protected function getCsrfToken(): string {
        $csrf = new \App\Security\CsrfToken();
        return $csrf->getToken();
    }
}
