<div class="container">
    <div style="text-align: center; padding: var(--spacing-xxl) 0;">
        <h1>Welcome to Bookings</h1>
        <p style="font-size: 1.125rem; color: var(--color-text-secondary); margin-bottom: var(--spacing-xl);">
            Find and book your perfect accommodation
        </p>
        <a href="<?php echo BASE_URL; ?>/rooms" class="btn btn-primary btn-lg">Browse Available Rooms</a>
    </div>
</div>

<div style="background-color: var(--color-white); border-top: 1px solid var(--color-border); border-bottom: 1px solid var(--color-border); padding: var(--spacing-xxl) 0; margin-top: var(--spacing-xxl);">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Rooms Available</h3>
                <div class="stat-value">24</div>
            </div>
            <div class="stat-card">
                <h3>Happy Guests</h3>
                <div class="stat-value">1000+</div>
            </div>
            <div class="stat-card">
                <h3>Bookings This Month</h3>
                <div class="stat-value">156</div>
            </div>
            <div class="stat-card">
                <h3>Satisfaction Rate</h3>
                <div class="stat-value">98%</div>
            </div>
        </div>
    </div>
</div>

<div class="container" style="margin-top: var(--spacing-xxl); margin-bottom: var(--spacing-xxl);">
    <h2 style="text-align: center; margin-bottom: var(--spacing-xl);">Featured Rooms</h2>
    <div class="grid grid-3">
        <div class="room-card">
            <div class="room-image">
                <img src="https://via.placeholder.com/300x250/e9ecef/6c757d?text=Room+1" alt="Standard Room">
            </div>
            <div class="room-details">
                <div class="room-name">Standard Room</div>
                <div class="room-price">$89<span style="font-size: 0.875rem; color: var(--color-text-secondary);">/night</span></div>
                <p class="room-description">Comfortable room with modern amenities, perfect for solo travelers and couples.</p>
                <ul class="room-features">
                    <li>Free WiFi</li>
                    <li>AC & Heating</li>
                    <li>Private Bathroom</li>
                </ul>
                <a href="<?php echo BASE_URL; ?>/rooms" class="btn btn-primary" style="width: 100%;">View Details</a>
            </div>
        </div>

        <div class="room-card">
            <div class="room-image">
                <img src="https://via.placeholder.com/300x250/e9ecef/6c757d?text=Room+2" alt="Deluxe Room">
            </div>
            <div class="room-details">
                <div class="room-name">Deluxe Room</div>
                <div class="room-price">$149<span style="font-size: 0.875rem; color: var(--color-text-secondary);">/night</span></div>
                <p class="room-description">Spacious room with premium furnishings and enhanced comfort features.</p>
                <ul class="room-features">
                    <li>Free WiFi</li>
                    <li>Smart TV</li>
                    <li>Luxury Bathroom</li>
                </ul>
                <a href="<?php echo BASE_URL; ?>/rooms" class="btn btn-primary" style="width: 100%;">View Details</a>
            </div>
        </div>

        <div class="room-card">
            <div class="room-image">
                <img src="https://via.placeholder.com/300x250/e9ecef/6c757d?text=Room+3" alt="Suite">
            </div>
            <div class="room-details">
                <div class="room-name">Executive Suite</div>
                <div class="room-price">$249<span style="font-size: 0.875rem; color: var(--color-text-secondary);">/night</span></div>
                <p class="room-description">Luxury suite with premium service, perfect for business travelers and luxury seekers.</p>
                <ul class="room-features">
                    <li>Concierge Service</li>
                    <li>Mini Bar</li>
                    <li>Work Desk</li>
                </ul>
                <a href="<?php echo BASE_URL; ?>/rooms" class="btn btn-primary" style="width: 100%;">View Details</a>
            </div>
        </div>
    </div>
</div>
