<div class="container" style="max-width: 1000px;">
    <h1 style="text-align: center; margin-bottom: var(--spacing-lg);">Contact Us</h1>
    <p class="text-muted" style="text-align: center; margin-bottom: var(--spacing-xxl);">We'd love to hear from you. Get in touch with our team</p>

    <div class="grid grid-2">
        <!-- Contact Information -->
        <div>
            <h2 style="margin-bottom: var(--spacing-lg);">Get in Touch</h2>
            
            <div style="margin-bottom: var(--spacing-xl);">
                <h4 style="margin-bottom: var(--spacing-sm);">📍 Address</h4>
                <p class="text-muted">123 Booking Street<br>New York, NY 10001<br>United States</p>
            </div>

            <div style="margin-bottom: var(--spacing-xl);">
                <h4 style="margin-bottom: var(--spacing-sm);">📞 Phone</h4>
                <p><a href="tel:+15551234567" class="text-primary">+1 (555) 123-4567</a></p>
                <p class="text-muted" style="font-size: 0.9rem;">Available Monday - Friday, 9 AM - 6 PM EST</p>
            </div>

            <div style="margin-bottom: var(--spacing-xl);">
                <h4 style="margin-bottom: var(--spacing-sm);">✉️ Email</h4>
                <p><a href="mailto:support@bookings.com" class="text-primary">support@bookings.com</a></p>
                <p style="font-size: 0.9rem; color: var(--color-text-secondary);">For general inquiries: hello@bookings.com</p>
                <p style="font-size: 0.9rem; color: var(--color-text-secondary);">For group bookings: groups@bookings.com</p>
            </div>

            <div style="margin-bottom: var(--spacing-xl);">
                <h4 style="margin-bottom: var(--spacing-sm);">🕐 Business Hours</h4>
                <p>
                    Monday - Friday: 9:00 AM - 6:00 PM<br>
                    Saturday: 10:00 AM - 4:00 PM<br>
                    Sunday: Closed
                </p>
            </div>

            <div>
                <h4 style="margin-bottom: var(--spacing-md);">Follow Us</h4>
                <div style="display: flex; gap: var(--spacing-md);">
                    <a href="#" style="display: inline-block; width: 40px; height: 40px; background-color: var(--color-primary); color: white; border-radius: 50%; text-align: center; line-height: 40px;">f</a>
                    <a href="#" style="display: inline-block; width: 40px; height: 40px; background-color: var(--color-primary); color: white; border-radius: 50%; text-align: center; line-height: 40px;">𝕏</a>
                    <a href="#" style="display: inline-block; width: 40px; height: 40px; background-color: var(--color-primary); color: white; border-radius: 50%; text-align: center; line-height: 40px;">📷</a>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div>
            <div class="card">
                <div class="card-header">Send us a Message</div>
                <form method="POST" action="<?php echo BASE_URL; ?>/contact">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" id="name" name="name" placeholder="John Doe" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="john@example.com" required>
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <select id="subject" name="subject" required>
                                <option value="">Select a subject</option>
                                <option value="booking-issue">Booking Issue</option>
                                <option value="payment">Payment Question</option>
                                <option value="cancellation">Cancellation Request</option>
                                <option value="feedback">Feedback</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" placeholder="Tell us how we can help..." required></textarea>
                        </div>

                        <div class="form-group">
                            <label style="display: flex; align-items: flex-start; cursor: pointer;">
                                <input type="checkbox" name="subscribe" style="margin-right: var(--spacing-md); margin-top: 4px;">
                                <span>I'd like to subscribe to updates and special offers</span>
                            </label>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message</button>
                    </div>
                </form>
            </div>

            <!-- Expected Response Time -->
            <div style="margin-top: var(--spacing-lg); padding: var(--spacing-lg); background-color: var(--color-bg); border-radius: var(--radius-md); border-left: 4px solid var(--color-primary);">
                <p style="font-size: 0.9rem; margin: 0;">
                    <strong>Response Time:</strong> We typically respond within 24 hours during business hours.
                </p>
            </div>
        </div>
    </div>
</div>
