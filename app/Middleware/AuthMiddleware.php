<?php

namespace App\Middleware;

use App\Http\Request;
use App\Http\Response;

class AuthMiddleware implements MiddlewareInterface {
    public function handle(Request $request, Response $response): bool {
        if (!isset($_SESSION['user_id'])) {
            // Store the intended destination
            $_SESSION['redirect_after_login'] = $request->getReferer();
            return false; // Return false to prevent further execution
        }
        return true;
    }
}
