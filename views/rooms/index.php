<div class="container">
    <div style="margin-bottom: var(--spacing-xl);">
        <h1>Available Rooms</h1>
        <p class="text-muted">Choose from our collection of comfortable and well-equipped rooms</p>
    </div>

    <div style="display: grid; grid-template-columns: 250px 1fr; gap: var(--spacing-lg); margin-bottom: var(--spacing-xl);">
        <!-- Sidebar Filters -->
        <div>
            <div class="card">
                <div class="card-header">Filters</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="price-range">Price Range</label>
                        <input type="range" min="0" max="500" value="250" id="price-range" style="width: 100%;">
                        <div style="text-align: center; margin-top: var(--spacing-sm);">
                            $<span id="price-value">250</span>/night
                        </div>
                    </div>

                    <div class="divider"></div>

                    <div class="form-group">
                        <label style="display: flex; align-items: center; margin-bottom: var(--spacing-sm);">
                            <input type="checkbox" style="margin-right: var(--spacing-sm);">
                            Free WiFi
                        </label>
                        <label style="display: flex; align-items: center; margin-bottom: var(--spacing-sm);">
                            <input type="checkbox" style="margin-right: var(--spacing-sm);">
                            AC & Heating
                        </label>
                        <label style="display: flex; align-items: center; margin-bottom: var(--spacing-sm);">
                            <input type="checkbox" style="margin-right: var(--spacing-sm);">
                            TV
                        </label>
                        <label style="display: flex; align-items: center;">
                            <input type="checkbox" style="margin-right: var(--spacing-sm);">
                            Mini Bar
                        </label>
                    </div>

                    <button class="btn btn-secondary" style="width: 100%; margin-top: var(--spacing-md);">Reset Filters</button>
                </div>
            </div>
        </div>

        <!-- Rooms Grid -->
        <div>
            <div class="grid grid-3">
                <!-- Room Card 1 -->
                <div class="room-card">
                    <div class="room-image">
                        <img src="https://via.placeholder.com/300x250/e9ecef/6c757d?text=Room+101" alt="Room 101">
                    </div>
                    <div class="room-details">
                        <div class="room-name">Room 101 - Standard</div>
                        <div class="room-price">$89<span style="font-size: 0.875rem; color: var(--color-text-secondary);">/night</span></div>
                        <p class="room-description">Comfortable room with modern amenities, perfect for solo travelers.</p>
                        <ul class="room-features">
                            <li>Free WiFi</li>
                            <li>AC & Heating</li>
                            <li>Private Bathroom</li>
                        </ul>
                        <div class="card-footer">
                            <a href="<?php echo BASE_URL; ?>/rooms/101" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>

                <!-- Room Card 2 -->
                <div class="room-card">
                    <div class="room-image">
                        <img src="https://via.placeholder.com/300x250/e9ecef/6c757d?text=Room+102" alt="Room 102">
                    </div>
                    <div class="room-details">
                        <div class="room-name">Room 102 - Standard</div>
                        <div class="room-price">$89<span style="font-size: 0.875rem; color: var(--color-text-secondary);">/night</span></div>
                        <p class="room-description">Comfortable room with modern amenities, perfect for solo travelers.</p>
                        <ul class="room-features">
                            <li>Free WiFi</li>
                            <li>AC & Heating</li>
                            <li>Private Bathroom</li>
                        </ul>
                        <div class="card-footer">
                            <a href="<?php echo BASE_URL; ?>/rooms/102" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>

                <!-- Room Card 3 -->
                <div class="room-card">
                    <div class="room-image">
                        <img src="https://via.placeholder.com/300x250/e9ecef/6c757d?text=Room+201" alt="Room 201">
                    </div>
                    <div class="room-details">
                        <div class="room-name">Room 201 - Deluxe</div>
                        <div class="room-price">$149<span style="font-size: 0.875rem; color: var(--color-text-secondary);">/night</span></div>
                        <p class="room-description">Spacious room with premium furnishings and enhanced comfort.</p>
                        <ul class="room-features">
                            <li>Free WiFi</li>
                            <li>Smart TV</li>
                            <li>Luxury Bathroom</li>
                        </ul>
                        <div class="card-footer">
                            <a href="<?php echo BASE_URL; ?>/rooms/201" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>

                <!-- Room Card 4 -->
                <div class="room-card">
                    <div class="room-image">
                        <img src="https://via.placeholder.com/300x250/e9ecef/6c757d?text=Room+202" alt="Room 202">
                    </div>
                    <div class="room-details">
                        <div class="room-name">Room 202 - Deluxe</div>
                        <div class="room-price">$149<span style="font-size: 0.875rem; color: var(--color-text-secondary);">/night</span></div>
                        <p class="room-description">Spacious room with premium furnishings and enhanced comfort.</p>
                        <ul class="room-features">
                            <li>Free WiFi</li>
                            <li>Smart TV</li>
                            <li>Luxury Bathroom</li>
                        </ul>
                        <div class="card-footer">
                            <a href="<?php echo BASE_URL; ?>/rooms/202" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>

                <!-- Room Card 5 -->
                <div class="room-card">
                    <div class="room-image">
                        <img src="https://via.placeholder.com/300x250/e9ecef/6c757d?text=Room+301" alt="Room 301">
                    </div>
                    <div class="room-details">
                        <div class="room-name">Room 301 - Suite</div>
                        <div class="room-price">$249<span style="font-size: 0.875rem; color: var(--color-text-secondary);">/night</span></div>
                        <p class="room-description">Luxury suite with premium service and amenities.</p>
                        <ul class="room-features">
                            <li>Concierge Service</li>
                            <li>Mini Bar</li>
                            <li>Work Desk</li>
                        </ul>
                        <div class="card-footer">
                            <a href="<?php echo BASE_URL; ?>/rooms/301" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>

                <!-- Room Card 6 -->
                <div class="room-card">
                    <div class="room-image">
                        <img src="https://via.placeholder.com/300x250/e9ecef/6c757d?text=Room+302" alt="Room 302">
                    </div>
                    <div class="room-details">
                        <div class="room-name">Room 302 - Suite</div>
                        <div class="room-price">$249<span style="font-size: 0.875rem; color: var(--color-text-secondary);">/night</span></div>
                        <p class="room-description">Luxury suite with premium service and amenities.</p>
                        <ul class="room-features">
                            <li>Concierge Service</li>
                            <li>Mini Bar</li>
                            <li>Work Desk</li>
                        </ul>
                        <div class="card-footer">
                            <a href="<?php echo BASE_URL; ?>/rooms/302" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('price-range').addEventListener('input', function(e) {
        document.getElementById('price-value').innerText = e.target.value;
    });
</script>
