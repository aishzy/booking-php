<div class="container">
    <div style="margin-bottom: var(--spacing-lg);">
        <a href="<?php echo BASE_URL; ?>/rooms" class="text-primary">← Back to Rooms</a>
    </div>

    <div class="grid grid-2">
        <!-- Left Column - Room Images & Features -->
        <div>
            <div class="card" style="overflow: hidden; margin-bottom: var(--spacing-lg);">
                <img src="https://via.placeholder.com/600x400/e9ecef/6c757d?text=Meeting+Room+201" alt="Room" style="width: 100%; height: auto; display: block;">
            </div>
            
            <div style="margin-bottom: var(--spacing-lg);">
                <h3>Room Amenities</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-md);">
                    <div style="display: flex; gap: var(--spacing-sm); align-items: center;">
                        <span style="color: var(--color-primary); font-weight: 600;">✓</span>
                        <span>Free High-Speed WiFi</span>
                    </div>
                    <div style="display: flex; gap: var(--spacing-sm); align-items: center;">
                        <span style="color: var(--color-primary); font-weight: 600;">✓</span>
                        <span>Air Conditioning</span>
                    </div>
                    <div style="display: flex; gap: var(--spacing-sm); align-items: center;">
                        <span style="color: var(--color-primary); font-weight: 600;">✓</span>
                        <span>Projector & Screen</span>
                    </div>
                    <div style="display: flex; gap: var(--spacing-sm); align-items: center;">
                        <span style="color: var(--color-primary); font-weight: 600;">✓</span>
                        <span>Whiteboard</span>
                    </div>
                    <div style="display: flex; gap: var(--spacing-sm); align-items: center;">
                        <span style="color: var(--color-primary); font-weight: 600;">✓</span>
                        <span>Conference Phone</span>
                    </div>
                    <div style="display: flex; gap: var(--spacing-sm); align-items: center;">
                        <span style="color: var(--color-primary); font-weight: 600;">✓</span>
                        <span>Video Conference System</span>
                    </div>
                    <div style="display: flex; gap: var(--spacing-sm); align-items: center;">
                        <span style="color: var(--color-primary); font-weight: 600;">✓</span>
                        <span>Refreshments Available</span>
                    </div>
                    <div style="display: flex; gap: var(--spacing-sm); align-items: center;">
                        <span style="color: var(--color-primary); font-weight: 600;">✓</span>
                        <span>24/7 Room Service</span>
                    </div>
                </div>
            </div>

            <!-- Room Details Card -->
            <div class="card">
                <div class="card-header">Room Specifications</div>
                <div class="card-body">
                    <div style="display: grid; gap: var(--spacing-md);">
                        <div style="border-bottom: 1px solid var(--color-border); padding-bottom: var(--spacing-md);">
                            <p class="text-muted" style="margin: 0 0 var(--spacing-sm) 0;">Capacity</p>
                            <p style="margin: 0; font-size: 1.1rem; font-weight: 600;">Up to 20 attendees</p>
                        </div>
                        <div style="border-bottom: 1px solid var(--color-border); padding-bottom: var(--spacing-md);">
                            <p class="text-muted" style="margin: 0 0 var(--spacing-sm) 0;">Room Size</p>
                            <p style="margin: 0; font-size: 1.1rem; font-weight: 600;">250 m²</p>
                        </div>
                        <div style="border-bottom: 1px solid var(--color-border); padding-bottom: var(--spacing-md);">
                            <p class="text-muted" style="margin: 0 0 var(--spacing-sm) 0;">Layout Options</p>
                            <p style="margin: 0; font-size: 1.1rem; font-weight: 600;">Classroom, Theater, Boardroom</p>
                        </div>
                        <div>
                            <p class="text-muted" style="margin: 0 0 var(--spacing-sm) 0;">Availability</p>
                            <p style="margin: 0;">
                                <span class="badge badge-success">Available</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Booking & Calendar -->
        <div>
            <!-- Pricing & Booking Header -->
            <div class="card" style="margin-bottom: var(--spacing-lg); background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-hover) 100%); color: white;">
                <div class="card-body">
                    <h2 style="color: white; margin-top: 0;">Room 201 - Executive Meeting Room</h2>
                    <p style="color: rgba(255, 255, 255, 0.9); margin-bottom: var(--spacing-lg);">Professional meeting space for your important events</p>
                    
                    <div style="font-size: 3rem; font-weight: 700; margin-bottom: var(--spacing-md);">
                        $149<span style="font-size: 1.5rem; color: rgba(255, 255, 255, 0.9);">/day</span>
                    </div>
                    
                    <p style="color: rgba(255, 255, 255, 0.9); border-top: 1px solid rgba(255, 255, 255, 0.2); padding-top: var(--spacing-md); margin-top: var(--spacing-md);">
                        ✓ Free cancellation up to 24 hours before<br>
                        ✓ Setup & cleanup included<br>
                        ✓ Dedicated room coordinator
                    </p>
                </div>
            </div>

            <!-- Calendar Section -->
            <div class="card" style="margin-bottom: var(--spacing-lg);">
                <div class="card-header">Select Your Dates</div>
                <div class="card-body" style="padding: 0;">
                    <div id="booking-calendar" data-room-id="201" data-rate="149"></div>
                </div>
            </div>

            <!-- Booking Form -->
            <div class="card">
                <div class="card-header">Complete Your Booking</div>
                
                <div class="card-body">
                    <form method="POST" action="<?php echo BASE_URL; ?>/bookings/create">
                        <div class="form-group">
                            <label for="check-in">Check-in Date</label>
                            <input type="date" id="check-in" name="check_in" required style="font-weight: 600;">
                        </div>

                        <div class="form-group">
                            <label for="check-out">Check-out Date</label>
                            <input type="date" id="check-out" name="check_out" required style="font-weight: 600;">
                        </div>

                        <div class="form-group">
                            <label for="attendees">Number of Attendees</label>
                            <select id="attendees" name="attendees" required>
                                <option value="">Select number of attendees</option>
                                <option value="1">1-5 Attendees</option>
                                <option value="2">6-10 Attendees</option>
                                <option value="3">11-15 Attendees</option>
                                <option value="4">16-20 Attendees</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="meeting-type">Meeting Type</label>
                            <select id="meeting-type" name="meeting_type">
                                <option value="">Select meeting type</option>
                                <option value="conference">Conference</option>
                                <option value="training">Training Session</option>
                                <option value="workshop">Workshop</option>
                                <option value="presentation">Presentation</option>
                                <option value="team-meeting">Team Meeting</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="requirements">Special Requirements</label>
                            <textarea id="requirements" name="requirements" placeholder="Mention any special equipment or arrangements needed..."></textarea>
                        </div>

                        <div style="background-color: var(--color-bg); padding: var(--spacing-md); border-radius: var(--radius-md); margin-bottom: var(--spacing-lg); border: 1px solid var(--color-border);">
                            <div class="flex-between" style="margin-bottom: var(--spacing-sm);">
                                <span>Daily Rate:</span>
                                <strong>$149.00</strong>
                            </div>
                            <div class="flex-between" style="margin-bottom: var(--spacing-sm);">
                                <span>Number of Days:</span>
                                <strong data-nights>-</strong>
                            </div>
                            <div class="flex-between" style="margin-bottom: var(--spacing-sm);">
                                <span>Subtotal:</span>
                                <strong data-subtotal>-</strong>
                            </div>
                            <div style="border-top: 2px solid var(--color-border); padding-top: var(--spacing-sm); margin-top: var(--spacing-sm);">
                                <div class="flex-between">
                                    <span style="font-weight: 600;">Total:</span>
                                    <strong style="font-size: 1.25rem; color: var(--color-primary);" data-total>-</strong>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg" style="width: 100%; margin-bottom: var(--spacing-md);">
                            Book Room Now
                        </button>
                        <button type="button" class="btn btn-secondary btn-lg" style="width: 100%;">
                            Add to Wishlist
                        </button>
                    </form>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="card" style="margin-top: var(--spacing-lg);">
                <div class="card-header">Guest Reviews</div>
                <div class="card-body">
                    <div style="margin-bottom: var(--spacing-lg); padding-bottom: var(--spacing-lg); border-bottom: 1px solid var(--color-border);">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: var(--spacing-sm);">
                            <strong>Corporate Team</strong>
                            <span style="color: #ffc107;">★★★★★</span>
                        </div>
                        <p class="text-muted" style="margin-bottom: var(--spacing-sm);">Perfect venue for our conference! Professional staff and excellent facilities.</p>
                        <p style="font-size: 0.875rem; color: var(--color-text-secondary);">Verified Booking • 2 weeks ago</p>
                    </div>

                    <div style="margin-bottom: var(--spacing-lg); padding-bottom: var(--spacing-lg); border-bottom: 1px solid var(--color-border);">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: var(--spacing-sm);">
                            <strong>Training Institute</strong>
                            <span style="color: #ffc107;">★★★★☆</span>
                        </div>
                        <p class="text-muted" style="margin-bottom: var(--spacing-sm);">Great setup for training sessions. Could use faster WiFi but overall very good.</p>
                        <p style="font-size: 0.875rem; color: var(--color-text-secondary);">Verified Booking • 1 month ago</p>
                    </div>

                    <button class="btn btn-secondary" style="width: 100%;">View All Reviews (24)</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo BASE_URL; ?>/public/js/calendar.js"></script>
