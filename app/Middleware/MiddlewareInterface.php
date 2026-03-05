<?php

namespace App\Middleware;

use App\Http\Request;
use App\Http\Response;

interface MiddlewareInterface {
    public function handle(Request $request, Response $response): bool;
}
