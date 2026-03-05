# Backend Improvements Documentation

## Overview
Your booking system has been refactored with a modern, scalable architecture featuring:
- Improved routing system
- Request/Response abstraction
- Request validation
- CSRF protection
- Authentication middleware
- Database abstraction layer
- Error handling

## Project Structure

```
app/
├── Controllers/
│   ├── BaseController.php      # Base class for all controllers
│   ├── HomeController.php
│   └── UserController.php
├── Core/
│   └── Router.php              # Routing engine
├── Database/
│   └── Database.php            # Database abstraction
├── Http/
│   ├── Request.php             # Request handling
│   └── Response.php            # Response handling
├── Middleware/
│   ├── MiddlewareInterface.php # Middleware interface
│   ├── AuthMiddleware.php      # Authentication middleware
│   └── CsrfMiddleware.php      # CSRF protection
├── Security/
│   └── CsrfToken.php           # CSRF token management
├── Validation/
│   └── Validator.php           # Request validation
└── Helpers/
    └── helpers.php             # Helper functions
```

## Key Features

### 1. Routing
Routes are defined in `config/routes.php`:

```php
$router->get('/path', [ControllerClass::class, 'method']);
$router->post('/path', [ControllerClass::class, 'method']);
$router->put('/path', [ControllerClass::class, 'method']);
$router->delete('/path', [ControllerClass::class, 'method']);
```

Route parameters:
```php
$router->get('/users/{id}', [UserController::class, 'show']);
// Accessible as $this->request->getInput('id')
```

### 2. Request Handling
Access request data:

```php
// GET parameters
$this->request->getQuery('key', 'default');

// POST/JSON data
$this->request->getInput('key', 'default');

// All input
$this->request->all();

// Specific fields
$this->request->only(['name', 'email']);
$this->request->except(['password']);

// Check if field exists
$this->request->has('email');

// Headers
$this->request->header('content-type');

// Request method
$this->request->getMethod();

// User IP
$this->request->getIp();

// AJAX check
if ($this->request->isJson()) {
    // Handle JSON request
}
```

### 3. Response Handling
Sending responses:

```php
// JSON response
return $this->response->json(['key' => 'value'], 200);

// HTML view
return $this->view('users/profile', ['user' => $user]);

// Success response
return $this->success($data, 'Operation successful');

// Error response
return $this->error('Something went wrong', null, 400);

// Redirect
return $this->redirect('/dashboard');

// Status codes
return $this->response->notFound('Resource not found');
return $this->response->unauthorized('Please log in');
return $this->response->forbidden('Access denied');
return $this->response->serverError('Server error');
```

### 4. Request Validation
Validate input with simple rules:

```php
$validation = $this->validate([
    'name' => 'required|min:3|max:255',
    'email' => 'required|email',
    'password' => 'required|min:6',
    'password_confirmation' => 'required|confirmed:password',
    'age' => 'numeric|min:18',
    'status' => 'in:active,inactive',
    'birthdate' => 'date',
]);

if (!$validation['valid']) {
    return $this->error('Validation failed', $validation['errors'], 422);
}

$validated = $validation['data']; // Only validated fields
```

**Available validation rules:**
- `required` - Field must not be empty
- `email` - Valid email format
- `min:length` - Minimum length
- `max:length` - Maximum length
- `numeric` - Must be numeric
- `confirmed:field` - Must match another field
- `regex:pattern` - Match regex pattern
- `in:value1,value2` - Must be one of the values
- `date` - Valid date

### 5. Authentication
Check if user is authenticated:

```php
// Get auth user
$user = auth();

// Get user ID
$userId = auth_id();

// Check if authenticated
if (is_authenticated()) {
    // User is logged in
}
```

### 6. CSRF Protection
Automatically protect forms from CSRF attacks:

```php
// In your form
<?= csrf_field() ?>

// Or get token manually
<input type="hidden" name="_token" value="<?= csrf_token() ?>">

// Middleware validates on POST/PUT/DELETE requests
// (implement in config/routes.php for specific routes)
```

### 7. Database Access
Query and manipulate data safely:

```php
use App\Database\Database;

$db = Database::getInstance();

// Select multiple rows
$users = $db->query('SELECT * FROM users WHERE status = ?', ['active']);

// Select one row
$user = $db->queryOne('SELECT * FROM users WHERE id = ?', [1]);

// Insert
$db->insert('users', [
    'name' => 'John',
    'email' => 'john@example.com'
]);

// Update
$db->update('users', 
    ['name' => 'Jane'],
    ['id' => 1]
);

// Delete
$db->delete('users', ['id' => 1]);

// Get last inserted ID
$lastId = $db->lastInsertId();
```

### 8. Creating Controllers
Extend BaseController for access to all features:

```php
<?php

namespace App\Controllers;

class BookingController extends BaseController {
    public function index() {
        $bookings = Database::getInstance()
            ->query('SELECT * FROM bookings');
        
        return $this->view('bookings/index', [
            'bookings' => $bookings
        ]);
    }

    public function store() {
        $validate = $this->validate([
            'room_id' => 'required|numeric',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
        ]);

        if (!$validate['valid']) {
            return $this->error('Invalid input', $validate['errors'], 422);
        }

        // Create booking...
        return $this->success(['id' => $bookingId], 'Booking created');
    }
}
```

## Configuration

### App Config (`config/app.php`)
```php
'app_name' => 'Booking System',
'app_url' => 'http://localhost',
'debug' => true,     // Set to false in production
'timezone' => 'UTC',
```

### Database Config (`config/database.php`)
```php
'host' => 'localhost',
'port' => 3306,
'database' => 'booking_system',
'user' => 'root',
'password' => '',
'charset' => 'utf8mb4',
```

## Best Practices

1. **Always validate input:**
   ```php
   $validation = $this->validate([...]);
   if (!$validation['valid']) {
       return $this->error('Validation failed', $validation['errors'], 422);
   }
   ```

2. **Use prepared statements:**
   ```php
   // Good - SQL injection safe
   $db->query('SELECT * FROM users WHERE email = ?', [$email]);
   
   // Bad - SQL injection risk
   $db->query("SELECT * FROM users WHERE email = '{$email}'");
   ```

3. **Hash passwords:**
   ```php
   $hashed = password_hash($password, PASSWORD_BCRYPT);
   password_verify($input, $hashed);
   ```

4. **Return proper HTTP status codes:**
   - 200: Success
   - 201: Created
   - 400: Bad request
   - 401: Unauthorized
   - 403: Forbidden
   - 404: Not found
   - 422: Validation error
   - 500: Server error

5. **Use helper functions:**
   ```php
   if (is_authenticated()) {
       $userId = auth_id();
   }
   ```

## Next Steps

1. Create database tables based on your schema
2. Implement additional controllers for bookings, rooms, etc.
3. Create view files in the `views/` directory
4. Add more validation rules as needed
5. Implement additional middleware (rate limiting, logging, etc.)
6. Add error logging
7. Set up environment-based configuration

## Error Handling

The framework automatically handles exceptions. Errors are displayed in debug mode and hidden in production.
