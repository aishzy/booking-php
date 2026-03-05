# 🏨 Booking System - Backend

A modern, production-ready booking management system built with PHP.

## 📖 Documentation

- **[Backend Improvements Summary](IMPROVEMENTS_SUMMARY.md)** - What was improved and why
- **[Backend Guide](BACKEND_GUIDE.md)** - Comprehensive API documentation
- **[Quick Start Guide](QUICKSTART.md)** - Get up and running in minutes

## 🚀 Quick Setup

1. **Configure Database**
   - Edit `config/database.php` with your MySQL credentials
   - Ensure database `booking_system` exists

2. **Create Tables**
   - Run: `mysql -u root -p booking_system < database/schema.sql`
   - Or import `database/schema.sql` via phpMyAdmin

3. **Test Installation**
   - Navigate to `http://localhost/booking-php/`
   - Should display the home page

## 📁 Project Structure

```
booking-php/
├── app/                               # Application code
│   ├── Controllers/                   # Route handlers
│   │   ├── BaseController.php        # Controller base class
│   │   ├── HomeController.php
│   │   ├── UserController.php
│   │   └── BookingController.example.php
│   ├── Http/                         # Request/Response handling
│   │   ├── Request.php
│   │   └── Response.php
│   ├── Core/                         # Framework core
│   │   └── Router.php
│   ├── Database/
│   │   └── Database.php              # Database abstraction
│   ├── Models/                       # Data models
│   │   ├── BaseModel.php
│   │   └── User.php
│   ├── Middleware/                   # Request middleware
│   │   ├── MiddlewareInterface.php
│   │   ├── AuthMiddleware.php
│   │   └── CsrfMiddleware.php
│   ├── Validation/                   # Input validation
│   │   └── Validator.php
│   ├── Security/                     # Security features
│   │   └── CsrfToken.php
│   ├── Services/                     # Business logic
│   │   └── ErrorLogger.php
│   └── Helpers/                      # Helper functions
│       └── helpers.php
├── config/                            # Configuration
│   ├── app.php                       # App settings
│   ├── database.php                  # Database credentials
│   └── routes.php                    # Route definitions
├── database/
│   ├── Database.php                  # [Legacy - see app/Database]
│   └── schema.sql                    # Table definitions
├── public/
│   ├── index.php                     # Entry point
│   ├── css/
│   ├── js/
│   └── images/
├── views/                             # HTML templates
│   ├── layouts/
│   ├── auth/
│   │   ├── login.php
│   │   └── register.php
│   └── [other views]/
├── IMPROVEMENTS_SUMMARY.md           # Changes summary
├── BACKEND_GUIDE.md                  # Complete documentation
└── QUICKSTART.md                     # Getting started

```

## 🎯 Core Concepts

### Routing
Routes are defined in `config/routes.php`:
```php
$router->get('/path', [ControllerClass::class, 'method']);
$router->post('/path', [ControllerClass::class, 'method']);
```

### Controllers
Extend `BaseController` for built-in features:
```php
class MyController extends BaseController {
    public function show($id) {
        return $this->json(['data' => $data]);
    }
}
```

### Database
Use `Database::getInstance()` for queries:
```php
$db = Database::getInstance();
$rows = $db->query('SELECT * FROM table WHERE id = ?', [$id]);
```

### Validation
Validate input with simple rules:
```php
$validation = $this->validate([
    'email' => 'required|email',
    'password' => 'required|min:6'
]);
```

### Security
- **CSRF Protection:** Automatic for POST/PUT/DELETE
- **SQL Injection:** Prevented via prepared statements
- **Password Security:** Bcrypt hashing

## 🔗 Available Endpoints

### Authentication
- `GET /login` - Login form
- `POST /login` - Process login
- `GET /register` - Registration form
- `POST /register` - Process registration
- `POST /logout` - Logout

### Home
- `GET /` - Home page
- `GET /about` - About page

## 📖 Example: Create a Booking Controller

1. **Create Controller** (`app/Controllers/BookingController.php`):
```php
<?php
namespace App\Controllers;

class BookingController extends BaseController {
    public function index() {
        $bookings = Database::getInstance()
            ->query('SELECT * FROM bookings');
        return $this->json(['data' => $bookings]);
    }

    public function create() {
        $validation = $this->validate([
            'room_id' => 'required|numeric',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
        ]);

        if (!$validation['valid']) {
            return $this->error('Validation failed', $validation['errors'], 422);
        }

        // Create booking...
        return $this->success(['id' => 1], 'Booking created');
    }
}
```

2. **Add Routes** (in `config/routes.php`):
```php
$router->get('/api/bookings', [BookingController::class, 'index']);
$router->post('/api/bookings', [BookingController::class, 'create']);
```

3. **Test**:
```bash
curl http://localhost/booking-php/api/bookings
```

## 🛠️ Helper Functions

```php
// Authentication
auth()           // Get user details
auth_id()        // Get user ID
is_authenticated() // Check if logged in

// Configuration
config('app.debug') // Get config value

// CSRF
csrf_token()     // Get token
csrf_field()     // Get hidden input

// Redirects
redirect('/page') // Redirect to page
```

## 🔒 Security

### SQL Injection Protection
```php
// ✅ Safe - Uses prepared statements
$db->query('SELECT * FROM users WHERE email = ?', [$email]);

// ❌ Unsafe - Never do this
$db->query("SELECT * FROM users WHERE email = '{$email}'");
```

### CSRF Protection
```html
<!-- Include in all forms -->
<?= csrf_field() ?>
```

### Password Security
```php
// Hash password
$hash = password_hash($password, PASSWORD_BCRYPT);

// Verify password
password_verify($password, $hash);
```

## 📝 View Files

Create HTML files in `views/` directory:

```php
<!-- views/bookings/index.php -->
<h1>My Bookings</h1>
<?php foreach ($bookings as $booking): ?>
    <div>
        <h3><?= htmlspecialchars($booking['room_name']) ?></h3>
        <p>Check-in: <?= htmlspecialchars($booking['check_in']) ?></p>
    </div>
<?php endforeach; ?>
```

Render from controller:
```php
return $this->view('bookings/index', ['bookings' => $bookings]);
```

## 🐛 Debugging

Enable debug mode in `config/app.php`:
```php
'debug' => true, // Shows detailed errors
```

View logs in `storage/logs/error.log`

## 🚀 Deployment Checklist

- [ ] Set `debug => false` in `config/app.php`
- [ ] Use environment variables for sensitive data
- [ ] Enable HTTPS
- [ ] Set up backups
- [ ] Configure logging
- [ ] Set up monitoring
- [ ] Enable WAF rules
- [ ] Test all endpoints

## 📚 Learn More

- [Backend Guide](BACKEND_GUIDE.md) - Complete API documentation
- [Quick Start](QUICKSTART.md) - Step-by-step tutorials
- [Improvements Summary](IMPROVEMENTS_SUMMARY.md) - What changed and why

## 📧 Support

For issues or questions:
1. Check the documentation
2. Review the example controller: `app/Controllers/BookingController.example.php`
3. Check configuration in `config/`

---

Built with ❤️ for the booking system.
