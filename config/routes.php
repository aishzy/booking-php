<?php

use App\Core\Router;
use App\Controllers\HomeController;
use App\Controllers\UserController;

// Initialize the router
$router = new Router();

// Home routes
$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [HomeController::class, 'about']);

// User routes
$router->get('/register', [UserController::class, 'registerForm']);
$router->post('/register', [UserController::class, 'register']);
$router->get('/login', [UserController::class, 'loginForm']);
$router->post('/login', [UserController::class, 'login']);
$router->post('/logout', [UserController::class, 'logout']);

// User profile (requires auth middleware)
// Note: Middleware support will be added to routes in the next update
// For now, implement auth check in the controller

// Example other routes:
// $router->get('/bookings', [BookingController::class, 'index']);
// $router->post('/bookings', [BookingController::class, 'create']);
// $router->get('/bookings/{id}', [BookingController::class, 'show']);
// $router->put('/bookings/{id}', [BookingController::class, 'update']);
// $router->delete('/bookings/{id}', [BookingController::class, 'delete']);

return $router;
