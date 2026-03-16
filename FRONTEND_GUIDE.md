# Modern Minimalist Frontend - Complete Guide

## Overview

A complete, modern minimalist frontend for your booking system has been created with the following features:

- ✨ **Clean, White Color Scheme** - Minimalist design with subtle grays
- 📱 **Fully Responsive** - Works perfectly on desktop, tablet, and mobile devices
- ♿ **Accessible** - Semantic HTML and proper contrast ratios
- 🎨 **Modern Typography** - System fonts for better performance
- 🚀 **Fast & Lightweight** - No external dependencies, pure CSS and vanilla JavaScript

## Color Palette

- **Primary**: Blue (#0066cc) - Main CTA buttons and links
- **Background**: Light Gray (#f8f9fa) - Page background
- **White**: (#ffffff) - Card and container backgrounds
- **Text Primary**: Dark Gray (#212529) - Main text
- **Text Secondary**: Medium Gray (#6c757d) - Secondary text and descriptions
- **Success**: Green (#28a745) - Success messages and badges
- **Danger**: Red (#dc3545) - Errors and delete actions

## File Structure

### CSS (`public/css/style.css`)

A comprehensive stylesheet including:
- **Variables** - Easy customization via CSS custom properties
- **Base Styles** - Typography, buttons, forms, and utilities
- **Components** - Cards, badges, tables, and more
- **Layouts** - Grid system, container, and flexbox utilities
- **Responsive Design** - Mobile-first approach with breakpoints at 768px and 480px

### Views Created

#### Authentication Pages
- **`views/auth/login.php`** - Login form with email and password
- **`views/auth/register.php`** - Registration form with name, email, and password validation

#### Main Pages
- **`views/home.php`** - Homepage with welcome section and featured rooms
- **`views/faq.php`** - FAQ page with collapsible questions
- **`views/contact.php`** - Contact form and information

#### Rooms Pages
- **`views/rooms/index.php`** - Room listing with filters and grid layout
- **`views/rooms/detail.php`** - Individual room details with booking form and reviews

#### User Pages
- **`views/bookings/index.php`** - My Bookings page showing booking history
- **`views/users/profile.php`** - User profile with personal info, address, and preferences

#### Layout
- **`views/layouts/main.php`** - Master layout with header, footer, and navigation

### JavaScript (`public/js/main.js`)

Lightweight vanilla JavaScript with:
- Form validation
- Price calculation
- Interactive elements
- Utility functions
- API helper
- Notification system

## Key Features

### Design System

#### Spacing Scale
- `--spacing-xs`: 4px
- `--spacing-sm`: 8px
- `--spacing-md`: 16px (default)
- `--spacing-lg`: 24px
- `--spacing-xl`: 32px
- `--spacing-xxl`: 48px

#### Border Radius
- `--radius-sm`: 4px
- `--radius-md`: 8px (default)

#### Transitions
All interactive elements use smooth transitions: `all 0.3s ease`

### Components

#### Buttons
```html
<!-- Primary (Blue) -->
<button class="btn btn-primary">Click Me</button>

<!-- Secondary (White with border) -->
<button class="btn btn-secondary">Click Me</button>

<!-- Success (Green) -->
<button class="btn btn-success">Click Me</button>

<!-- Danger (Red) -->
<button class="btn btn-danger">Click Me</button>

<!-- Sizes -->
<button class="btn btn-sm">Small</button>
<button class="btn btn-lg">Large</button>
```

#### Cards
```html
<div class="card">
    <div class="card-header">Header</div>
    <div class="card-body">Content</div>
    <div class="card-footer">Footer</div>
</div>
```

#### Forms
```html
<div class="form-group">
    <label for="email">Email</label>
    <input type="email" id="email" name="email">
</div>
```

#### Grid System
```html
<!-- Auto-responsive grid -->
<div class="grid grid-2"><!-- 2 columns on desktop, 1 on mobile -->
<div class="grid grid-3"><!-- 3 columns on desktop, 1 on mobile -->
<div class="grid grid-4"><!-- 4 columns on desktop, 1 on mobile -->
```

#### Utilities
```html
<!-- Text -->
<p class="text-center">Centered text</p>
<p class="text-muted">Muted gray text</p>
<p class="text-primary">Primary blue</p>

<!-- Spacing -->
<div class="mt-lg">Margin top large</div>
<div class="mb-md">Margin bottom medium</div>
<div class="px-md">Padding horizontal</div>

<!-- Flex -->
<div class="flex">Flexbox</div>
<div class="flex-between">Space between</div>
<div class="flex-center">Center content</div>

<!-- Badges -->
<span class="badge badge-primary">Primary</span>
<span class="badge badge-success">Success</span>
<span class="badge badge-danger">Danger</span>
```

## Responsive Breakpoints

### Desktop (1200px+)
- Full-width layouts
- Multi-column grids
- Full navigation

### Tablet (768px - 1199px)
- Adjusted spacing
- 2-column grids become single column
- Optimized layout

### Mobile (< 768px)
- Single column layouts
- Stacked navigation
- Touch-friendly sizes
- Reduced font sizes

## Setup Instructions

### 1. Include Required Files

Make sure your main layout includes:
```php
<link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/style.css">
<script src="<?php echo BASE_URL; ?>/public/js/main.js"></script>
```

### 2. Define BASE_URL

In your main layout or config:
```php
define('BASE_URL', 'http://localhost/booking-php');
```

### 3. Session Variables

The templates expect these session variables:
```php
$_SESSION['user_id']     // For logged-in users
```

For error/success messages in templates:
```php
$error = '';        // Error message
$success = '';      // Success message
```

## Customization

### Change Primary Color

Edit `style.css`:
```css
:root {
    --color-primary: #your-color;
    --color-primary-hover: #darker-shade;
}
```

### Adjust Spacing

Edit the spacing scale in `style.css`:
```css
:root {
    --spacing-md: 20px;  /* Instead of 16px */
}
```

### Add Custom Fonts

Replace system fonts in `style.css`:
```css
--font-family: 'Your Font', sans-serif;
```

## Browser Support

- Chrome/Edge (latest)
- Firefox (latest)
- Safari (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Performance

- **CSS**: Single optimized stylesheet (~15KB)
- **JavaScript**: Lightweight vanilla JS (~4KB)
- **No external dependencies** - No jQuery, Bootstrap, or external CDN
- **No web fonts** - Uses system fonts for instant rendering

## Accessibility Features

- Semantic HTML structure
- ARIA labels for interactive elements
- Color contrast ratios meet WCAG AA standards
- Keyboard navigation support
- Focus indicators on form elements

## JavaScript API

### Global `bookingApp` Object

```javascript
// Format price
bookingApp.formatPrice(149);  // Returns: $149.00

// Format date
bookingApp.formatDate('2026-03-15');  // Returns: March 15, 2026

// Show notification
bookingApp.showNotification('Success!', 'success');
bookingApp.showNotification('Error occurred', 'error');

// Make API call
bookingApp.apiCall('/api/rooms', {
    method: 'GET',
    headers: { 'X-Custom': 'value' }
});

// Calculate booking price
bookingApp.calculateBookingPrice();
```

## Future Enhancements

Consider adding:
- [ ] Dark mode toggle
- [ ] Progressive Web App (PWA)
- [ ] Advanced animations with observer API
- [ ] Internationalization (i18n)
- [ ] Loading skeleton screens
- [ ] Image lazy loading
- [ ] Component library
- [ ] Storybook for component documentation

## Support

For questions about HTML/CSS/JS implementation:
1. Check the specific view file
2. Review the style.css comments
3. Check main.js for JavaScript functionality

## License

This frontend is open and ready to use in your booking system.
