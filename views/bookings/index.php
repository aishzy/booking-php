<div class="container">
    <div style="margin-bottom: var(--spacing-xl);">
        <div class="flex-between">
            <div>
                <h1>Meeting Room Booking</h1>
                <p class="text-muted">Select dates and book your perfect meeting room</p>
            </div>
            <a href="<?php echo BASE_URL; ?>/rooms" class="btn btn-primary">Browse All Rooms</a>
        </div>
    </div>

    <div class="grid grid-2" style="gap: var(--spacing-xl);">
        <!-- Left Column - Calendar -->
        <div>
            <div id="booking-calendar" data-room-id="201" data-rate="149"></div>

            <div class="booking-info-panel">
                <h3>Booking Summary</h3>
                <div class="booking-detail">
                    <label>Check-in Date</label>
                    <span class="booking-detail-value" data-checkin>Select from calendar</span>
                </div>
                <div class="booking-detail">
                    <label>Check-out Date</label>
                    <span class="booking-detail-value" data-checkout>Select from calendar</span>
                </div>
                <div class="booking-detail">
                    <label>Number of Nights</label>
                    <span class="booking-detail-value" data-nights>-</span>
                </div>
                <div class="booking-detail">
                    <label>Nightly Rate</label>
                    <span class="booking-detail-value">$149.00</span>
                </div>
                <div class="booking-detail">
                    <label>Subtotal</label>
                    <span class="booking-detail-value" data-subtotal>-</span>
                </div>
                <div class="booking-detail" style="border-bottom: 2px solid rgba(255, 255, 255, 0.3); border-top: 2px solid rgba(255, 255, 255, 0.3);">
                    <label style="font-size: 1.1rem;">Total Price</label>
                    <span class="booking-detail-value" data-total style="font-size: 1.4rem;">-</span>
                </div>
            </div>
        </div>

        <!-- Right Column - Rooms & Booking Form -->
        <div>
            <!-- Filter Tabs -->
            <div style="margin-bottom: var(--spacing-lg); display: flex; gap: var(--spacing-md); border-bottom: 2px solid var(--color-border); overflow-x: auto;">
                <button class="btn btn-secondary active-tab" style="border: none; background: none; border-bottom: 3px solid var(--color-primary); border-radius: 0; padding: var(--spacing-md) 0; white-space: nowrap;">My Bookings</button>
                <button class="btn btn-secondary" style="border: none; background: none; border-radius: 0; padding: var(--spacing-md) 0; white-space: nowrap;">Quick Book</button>
            </div>

            <!-- My Bookings Section -->
            <div style="display: grid; gap: var(--spacing-lg);">
                <!-- Booking Card 1 - Upcoming -->
                <div class="card">
                    <div class="card-body">
                        <div class="flex-between" style="margin-bottom: var(--spacing-lg);">
                            <div>
                                <h3 style="margin: 0;">Room 201 - Deluxe Meeting Room</h3>
                                <p class="text-muted">Booking #BK-2026-001</p>
                            </div>
                            <div style="text-align: right;">
                                <span class="badge badge-success">Confirmed</span>
                            </div>
                        </div>

                        <div class="grid grid-3">
                            <div>
                                <p class="text-muted" style="font-size: 0.875rem; margin-bottom: var(--spacing-sm);">CHECK-IN</p>
                                <p style="font-size: 1.125rem; font-weight: 600;">March 15, 2026</p>
                            </div>
                            <div>
                                <p class="text-muted" style="font-size: 0.875rem; margin-bottom: var(--spacing-sm);">CHECK-OUT</p>
                                <p style="font-size: 1.125rem; font-weight: 600;">March 18, 2026</p>
                            </div>
                            <div>
                                <p class="text-muted" style="font-size: 0.875rem; margin-bottom: var(--spacing-sm);">TOTAL PRICE</p>
                                <p style="font-size: 1.125rem; font-weight: 600; color: var(--color-primary);">$447.00</p>
                            </div>
                        </div>

                        <div class="divider"></div>

                        <p style="font-size: 0.95rem; margin-bottom: var(--spacing-md);">
                            <strong>Attendees:</strong> 12 people • <strong>3 days</strong> • <strong>Equipped:</strong> Projector, Whiteboard, Video Conference
                        </p>

                        <div class="availability-status available">
                            <span class="status-indicator"></span>
                            <span>Room is available and ready</span>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary btn-sm" style="margin-right: var(--spacing-md);">View Details</button>
                        <button class="btn btn-secondary btn-sm">Modify Booking</button>
                    </div>
                </div>

                <!-- Booking Card 2 - Upcoming -->
                <div class="card">
                    <div class="card-body">
                        <div class="flex-between" style="margin-bottom: var(--spacing-lg);">
                            <div>
                                <h3 style="margin: 0;">Room 102 - Standard Meeting Room</h3>
                                <p class="text-muted">Booking #BK-2026-002</p>
                            </div>
                            <div style="text-align: right;">
                                <span class="badge badge-success">Confirmed</span>
                            </div>
                        </div>

                        <div class="grid grid-3">
                            <div>
                                <p class="text-muted" style="font-size: 0.875rem; margin-bottom: var(--spacing-sm);">CHECK-IN</p>
                                <p style="font-size: 1.125rem; font-weight: 600;">April 1, 2026</p>
                            </div>
                            <div>
                                <p class="text-muted" style="font-size: 0.875rem; margin-bottom: var(--spacing-sm);">CHECK-OUT</p>
                                <p style="font-size: 1.125rem; font-weight: 600;">April 5, 2026</p>
                            </div>
                            <div>
                                <p class="text-muted" style="font-size: 0.875rem; margin-bottom: var(--spacing-sm);">TOTAL PRICE</p>
                                <p style="font-size: 1.125rem; font-weight: 600; color: var(--color-primary);">$356.00</p>
                            </div>
                        </div>

                        <div class="divider"></div>

                        <p style="font-size: 0.95rem; margin-bottom: var(--spacing-md);">
                            <strong>Attendees:</strong> 8 people • <strong>4 days</strong> • <strong>Equipped:</strong> Projector, Whiteboard
                        </p>

                        <div class="availability-status available">
                            <span class="status-indicator"></span>
                            <span>Room is available and ready</span>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary btn-sm" style="margin-right: var(--spacing-md);">View Details</button>
                        <button class="btn btn-secondary btn-sm">Modify Booking</button>
                    </div>
                </div>

                <!-- Booking Card 3 - Past -->
                <div class="card" style="opacity: 0.8;">
                    <div class="card-body">
                        <div class="flex-between" style="margin-bottom: var(--spacing-lg);">
                            <div>
                                <h3 style="margin: 0;">Room 301 - Executive Suite</h3>
                                <p class="text-muted">Booking #BK-2025-156</p>
                            </div>
                            <div style="text-align: right;">
                                <span class="badge badge-primary">Completed</span>
                            </div>
                        </div>

                        <div class="grid grid-3">
                            <div>
                                <p class="text-muted" style="font-size: 0.875rem; margin-bottom: var(--spacing-sm);">CHECK-IN</p>
                                <p style="font-size: 1.125rem; font-weight: 600;">December 10, 2025</p>
                            </div>
                            <div>
                                <p class="text-muted" style="font-size: 0.875rem; margin-bottom: var(--spacing-sm);">CHECK-OUT</p>
                                <p style="font-size: 1.125rem; font-weight: 600;">December 12, 2025</p>
                            </div>
                            <div>
                                <p class="text-muted" style="font-size: 0.875rem; margin-bottom: var(--spacing-sm);">TOTAL PRICE</p>
                                <p style="font-size: 1.125rem; font-weight: 600; color: var(--color-primary);">$498.00</p>
                            </div>
                        </div>

                        <div class="divider"></div>

                        <p style="font-size: 0.95rem; margin-bottom: var(--spacing-md);">
                            <strong>Attendees:</strong> 20 people • <strong>2 days</strong>
                        </p>

                        <div class="availability-status booked">
                            <span class="status-indicator"></span>
                            <span>Meeting completed</span>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary btn-sm" style="margin-right: var(--spacing-md);">View Invoice</button>
                        <button class="btn btn-secondary btn-sm">Book Again</button>
                    </div>
                </div>
            </div>

            <!-- Empty State (if no bookings) -->
            <div style="display: none; text-align: center; padding: var(--spacing-xxl) var(--spacing-md);">
                <h2>No bookings yet</h2>
                <p class="text-muted" style="margin-bottom: var(--spacing-lg);">Start your journey by booking your perfect meeting room</p>
                <a href="<?php echo BASE_URL; ?>/rooms" class="btn btn-primary">Browse Rooms</a>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo BASE_URL; ?>/public/js/calendar.js"></script>
<script>
// Update calendar display when dates are selected
document.addEventListener('DOMContentLoaded', function() {
    const originalOnDateSelect = window.calendar?.onDateSelect;
    
    if (window.calendar) {
        window.calendar.onDateSelect = function(dates) {
            if (originalOnDateSelect) originalOnDateSelect(dates);
            
            // Update display
            if (dates.length > 0) {
                const sortedDates = dates.sort();
                document.querySelector('[data-checkin]').textContent = sortedDates[0];
                document.querySelector('[data-checkout]').textContent = sortedDates[sortedDates.length - 1];
            }
        };
    }
});
</script>

