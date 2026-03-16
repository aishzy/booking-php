<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Modern minimalist booking system">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' : ''; ?>Booking System</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/style.css">
</head>
<body>
    <!-- Header Navigation -->
    <header>
        <div class="navbar">
            <a href="<?php echo BASE_URL; ?>" class="logo">Bookings</a>
            <nav>
                <ul>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="<?php echo BASE_URL; ?>/rooms" class="nav-link">Rooms</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/bookings" class="nav-link">My Bookings</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/profile" class="nav-link">Profile</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/logout" class="nav-link">Logout</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo BASE_URL; ?>/login" class="nav-link">Login</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/register" class="nav-link">Register</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <?php if (isset($error) && !empty($error)): ?>
            <div class="container">
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            </div>
        <?php endif; ?>

        <?php if (isset($success) && !empty($success)): ?>
            <div class="container">
                <div class="success-message"><?php echo htmlspecialchars($success); ?></div>
            </div>
        <?php endif; ?>

        <?php echo $content ?? ''; ?>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>About</h4>
                <p>Modern booking system for your accommodation needs.</p>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/rooms">Browse Rooms</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/contact">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Support</h4>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>/faq">FAQ</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/terms">Terms</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/privacy">Privacy</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 Booking System. All rights reserved.</p>
        </div>
    </footer>

    <script src="<?php echo BASE_URL; ?>/public/js/main.js"></script>
</body>
</html>