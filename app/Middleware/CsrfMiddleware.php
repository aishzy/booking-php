<?php

namespace App\Middleware;

use App\Http\Request;
use App\Http\Response;

class CsrfMiddleware implements MiddlewareInterface {
    public function handle(Request $request, Response $response): bool {
        // Skip CSRF check for GET requests
        if (in_array($request->getMethod(), ['GET', 'HEAD', 'OPTIONS'])) {
            return true;
        }

        $csrf = new \App\Security\CsrfToken();
        $token = $request->getInput('_token') ?? $request->header('x-csrf-token');

        if (!$token || !$csrf->verify($token)) {
            return false; // Return false for failed CSRF validation
        }

        return true;
    }
}
