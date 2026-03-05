# Quick Start Guide - Backend Improvements

## 📋 What Was Improved

Your booking system now has a **modern, production-ready backend** featuring:

✅ **Fixed Router** - Now properly handles route parameters  
✅ **Request/Response Abstraction** - Clean API for handling HTTP requests  
✅ **Input Validation** - Built-in validation system  
✅ **CSRF Protection** - Prevent cross-site attacks  
✅ **Authentication Ready** - Session-based user auth  
✅ **Database Abstraction** - Safe database queries with prepared statements  
✅ **Error Handling** - Comprehensive error logging  
✅ **Model Layer** - Optional ORM-like models for database interactions

---

## 🚀 Getting Started

### 1. Set Up Database

1. Open phpMyAdmin or your MySQL client
2. Run the SQL queries from `database/schema.sql` to create tables
3. Or run this single command:
   ```bash
   mysql -u root -p booking_system < database/schema.sql
   ```

### 2. Update Database Config

Edit `config/database.php` with your credentials:
```php
'host' => 'localhost',
'database' => 'booking_system',
'user' => 'root',
'password' => '',
```

### 3. Test Your Setup

Visit these URLs in your browser:
- `http://localhost/booking-php/` - Should work if HomeController is set up
- `http://localhost/booking-php/register` - Registration form
- `http://localhost/booking-php/login` - Login form

---

## 📝 Creating Your First API Endpoint

### Step 1: Create a Controller

Create `app/Controllers/RoomController.php`:

```php
<?php

namespace App\Controllers;

use App\Database\Database;

class RoomController extends BaseController {
    public function index() {
        $db = Database::getInstance();
        $rooms = $db->query('SELECT * FROM rooms');
        
        return $this->json(['data' => $rooms]);
    }

    public function show($id) {
        $db = Database::getInstance();
        $room = $db->queryOne('SELECT * FROM rooms WHERE id = ?', [$id]);
        
        if (!$room) {
            return $this->notFound('Room not found');
        }
        
        return $this->json(['data' => $room]);
    }

    public function create() {
        $validation = $this->validate([
            'name' => 'required|min:3',
            'price' => 'required|numeric',
            'capacity' => 'required|numeric',
        ]);

        if (!$validation['valid']) {
            return $this->error('Validation failed', $validation['errors'], 422);
        }

        $db = Database::getInstance();
        $db->insert('rooms', $validation['data']);

        return $this->success(
            ['id' => $db->lastInsertId()],
            'Room created successfully',
            201
        );
    }

    public function update($id) {
        $validation = $this->validate([
            'name' => 'required|min:3',
            'price' => 'required|numeric',
        ]);

        if (!$validation['valid']) {
            return $this->error('Validation failed', $validation['errors'], 422);
        }

        $db = Database::getInstance();
        $db->update('rooms', $validation['data'], ['id' => $id]);

        return $this->success(null, 'Room updated');
    }

    public function delete($id) {
        $db = Database::getInstance();
        $db->delete('rooms', ['id' => $id]);
        
        return $this->success(null, 'Room deleted');
    }
}
```

### Step 2: Add Routes

Update `config/routes.php`:

```php
// Room routes
$router->get('/api/rooms', [RoomController::class, 'index']);
$router->get('/api/rooms/{id}', [RoomController::class, 'show']);
$router->post('/api/rooms', [RoomController::class, 'create']);
$router->put('/api/rooms/{id}', [RoomController::class, 'update']);
$router->delete('/api/rooms/{id}', [RoomController::class, 'delete']);
```

### Step 3: Test Your Endpoint

```bash
# Get all rooms
curl http://localhost/booking-php/api/rooms

# Get room by ID
curl http://localhost/booking-php/api/rooms/1

# Create room
curl -X POST http://localhost/booking-php/api/rooms \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Deluxe Room",
    "price": 150.00,
    "capacity": 2
  }'
```

---

## 🔐 Authentication Example

Add auth check to your routes:

```php
// Only allow logged-in users
$router->get('/profile', [UserController::class, 'profile']);
```

In your controller:

```php
public function profile() {
    if (!is_authenticated()) {
        return $this->unauthorized('Please log in');
    }

    $userId = auth_id();
    return $this->success(['user_id' => $userId]);
}
```

---

## 🛡️ CSRF Protection for Forms

In your HTML form:

```html
<form method="POST" action="/book">
    <?= csrf_field() ?>
    
    <input type="text" name="check_in" required>
    <input type="text" name="check_out" required>
    <button type="submit">Book</button>
</form>
```

The CSRF token is automatically validated for POST/PUT/DELETE requests.

---

## 💾 Using Models (Optional)

Create a Booking model in `app/Models/Booking.php`:

```php
<?php

namespace App\Models;

class Booking extends BaseModel {
    protected string $table = 'bookings';
    protected array $fillable = ['user_id', 'room_id', 'check_in', 'check_out', 'total_price', 'status'];
}
```

Use it in your controller:

```php
use App\Models\Booking;

// Create
Booking::create([
    'user_id' => 1,
    'room_id' => 1,
    'check_in' => '2024-03-10',
    'check_out' => '2024-03-12',
    'total_price' => 300.00,
]);

// Find by ID
$booking = Booking::find(1);

// Update
$booking->update(['status' => 'confirmed']);

// Delete
$booking->delete();

// Where query
$userBookings = Booking::all(); // Get all
```

---

## 📊 Response Examples

### Success Response
```json
{
  "success": true,
  "message": "Operation successful",
  "data": {
    "id": 1,
    "name": "Deluxe Room"
  }
}
```

### Error Response
```json
{
  "success": false,
  "message": "Validation failed",
  "data": {
    "name": ["name is required"],
    "price": ["price must be numeric"]
  }
}
```

---

## 📁 File Structure Reference

```
app/
├── Controllers/       # Route handlers
├── Models/           # Database models (optional)
├── Http/             # Request/Response classes
├── Database/         # Database connection
├── Middleware/       # Request middleware
├── Security/         # Auth, CSRF tokens
├── Validation/       # Input validation
├── Services/         # Business logic
└── Helpers/          # Helper functions

config/
├── app.php          # App settings
├── database.php     # Database credentials
└── routes.php       # All routes defined here

public/
└── index.php        # Entry point

views/               # HTML templates
database/
├── Database.php     # Database abstraction
└── schema.sql       # Table definitions
```

---

## 🐛 Common Issues & Solutions

**Issue:** "Class not found" error
- **Solution:** Make sure namespace matches file path. `App\Controllers\MyController` should be in `app/Controllers/MyController.php`

**Issue:** Route returns 404
- **Solution:** Check that route is defined in `config/routes.php` with correct HTTP method

**Issue:** Database connection fails
- **Solution:** Verify credentials in `config/database.php` and that database exists

**Issue:** Validation not working
- **Solution:** Make sure you're calling `$this->validate()` in a controller extending BaseController

---

## 🎯 Next Steps

1. ✅ Set up database schema
2. ✅ Create Controllers for your resources (rooms, bookings, etc.)
3. ✅ Define all routes in `config/routes.php`
4. ✅ Create view files for HTML responses
5. ✅ Implement application logic
6. ⏭️ Add unit tests
7. ⏭️ Deploy to production (set `debug => false` in config)

---

## 📚 Documentation

For detailed API documentation, see `BACKEND_GUIDE.md`

Have fun building! 🎉
