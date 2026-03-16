<?php

// Start session
session_start();

// Define base path
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');
define('APP_DEBUG', getenv('APP_DEBUG') !== false ? filter_var(getenv('APP_DEBUG'), FILTER_VALIDATE_BOOLEAN) : true);

// Define BASE_URL
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
$base_url = $protocol . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);
define('BASE_URL', rtrim($base_url, '/'));

// Autoloader for PSR-4 namespace
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = APP_PATH . '/';

    $len = strlen($prefix);
    
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Load HTTP classes
use App\Http\Request;
use App\Http\Response;
use App\Core\Router;
use App\Database\Database;

// Load helper functions
require APP_PATH . '/Helpers/helpers.php';

try {
    // Create request and response objects
    $request = new Request();
    $response = new Response();
    
    // Initialize database connection
    Database::getInstance();
    
    // Load routes
    $router = require BASE_PATH . '/config/routes.php';
    
    // Resolve and execute the route
    $result = $router->resolve($request, $response);
    
    // Send response if it's a Response object
    if ($result instanceof Response) {
        $result->send();
    } else {
        // If result is a string or other data, output it
        echo $result;
    }
    
} catch (\Exception $e) {
    http_response_code(500);
    if (APP_DEBUG) {
        echo '<pre>';
        echo $e->getMessage() . "\n";
        echo $e->getTraceAsString();
        echo '</pre>';
    } else {
        echo 'An error occurred. Please try again later.';
    }
}
