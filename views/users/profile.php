<div class="container" style="max-width: 900px;">
    <h1 style="margin-bottom: var(--spacing-xl);">My Profile</h1>

    <div class="grid" style="grid-template-columns: 300px 1fr; gap: var(--spacing-lg);">
        <!-- Profile Sidebar -->
        <div>
            <div class="card">
                <div style="text-align: center; padding: var(--spacing-lg);">
                    <div style="width: 120px; height: 120px; background-color: var(--color-bg); border-radius: 50%; margin: 0 auto var(--spacing-md); display: flex; align-items: center; justify-content: center; font-size: 3rem;">
                        👤
                    </div>
                    <h3 style="margin-bottom: var(--spacing-sm);">John Doe</h3>
                    <p class="text-muted">john@example.com</p>
                </div>
                <div class="divider" style="margin: var(--spacing-md) 0;"></div>
                <div style="padding: 0 var(--spacing-lg) var(--spacing-lg);">
                    <p><strong>Member Since:</strong> January 2024</p>
                    <p class="text-muted" style="font-size: 0.9rem;">Active member with 5 bookings</p>
                </div>
            </div>
        </div>

        <!-- Profile Content -->
        <div>
            <!-- Personal Information -->
            <div class="card" style="margin-bottom: var(--spacing-lg);">
                <div class="card-header">Personal Information</div>
                <div class="card-body">
                    <div class="grid grid-2" style="gap: var(--spacing-lg);">
                        <div>
                            <label style="display: block; color: var(--color-text-secondary); font-size: 0.875rem; margin-bottom: var(--spacing-sm);">FIRST NAME</label>
                            <p style="font-size: 1.125rem; margin: 0;">John</p>
                        </div>
                        <div>
                            <label style="display: block; color: var(--color-text-secondary); font-size: 0.875rem; margin-bottom: var(--spacing-sm);">LAST NAME</label>
                            <p style="font-size: 1.125rem; margin: 0;">Doe</p>
                        </div>
                        <div>
                            <label style="display: block; color: var(--color-text-secondary); font-size: 0.875rem; margin-bottom: var(--spacing-sm);">EMAIL</label>
                            <p style="font-size: 1.125rem; margin: 0;">john@example.com</p>
                        </div>
                        <div>
                            <label style="display: block; color: var(--color-text-secondary); font-size: 0.875rem; margin-bottom: var(--spacing-sm);">PHONE</label>
                            <p style="font-size: 1.125rem; margin: 0;">+1 (555) 123-4567</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary btn-sm">Edit Profile</button>
                </div>
            </div>

            <!-- Address Information -->
            <div class="card" style="margin-bottom: var(--spacing-lg);">
                <div class="card-header">Address</div>
                <div class="card-body">
                    <div class="grid grid-2" style="gap: var(--spacing-lg);">
                        <div>
                            <label style="display: block; color: var(--color-text-secondary); font-size: 0.875rem; margin-bottom: var(--spacing-sm);">STREET</label>
                            <p style="font-size: 1.125rem; margin: 0;">123 Main Street</p>
                        </div>
                        <div>
                            <label style="display: block; color: var(--color-text-secondary); font-size: 0.875rem; margin-bottom: var(--spacing-sm);">CITY</label>
                            <p style="font-size: 1.125rem; margin: 0;">New York</p>
                        </div>
                        <div>
                            <label style="display: block; color: var(--color-text-secondary); font-size: 0.875rem; margin-bottom: var(--spacing-sm);">STATE</label>
                            <p style="font-size: 1.125rem; margin: 0;">NY</p>
                        </div>
                        <div>
                            <label style="display: block; color: var(--color-text-secondary); font-size: 0.875rem; margin-bottom: var(--spacing-sm);">ZIP CODE</label>
                            <p style="font-size: 1.125rem; margin: 0;">10001</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary btn-sm">Edit Address</button>
                </div>
            </div>

            <!-- Security -->
            <div class="card" style="margin-bottom: var(--spacing-lg);">
                <div class="card-header">Security & Password</div>
                <div class="card-body">
                    <p class="text-muted" style="margin-bottom: var(--spacing-lg);">Last password changed: 2 months ago</p>
                    <p style="margin-bottom: var(--spacing-lg);">Keep your account secure by regularly updating your password.</p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary btn-sm">Change Password</button>
                </div>
            </div>

            <!-- Preferences -->
            <div class="card">
                <div class="card-header">Preferences</div>
                <div class="card-body">
                    <div style="margin-bottom: var(--spacing-lg);">
                        <label style="display: flex; align-items: center; cursor: pointer;">
                            <input type="checkbox" checked style="margin-right: var(--spacing-md);">
                            <span>Receive email notifications about promotions</span>
                        </label>
                    </div>
                    <div style="margin-bottom: var(--spacing-lg);">
                        <label style="display: flex; align-items: center; cursor: pointer;">
                            <input type="checkbox" checked style="margin-right: var(--spacing-md);">
                            <span>Receive booking confirmations via email</span>
                        </label>
                    </div>
                    <div>
                        <label style="display: flex; align-items: center; cursor: pointer;">
                            <input type="checkbox" style="margin-right: var(--spacing-md);">
                            <span>Receive SMS reminders for upcoming bookings</span>
                        </label>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary btn-sm">Save Preferences</button>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="card" style="margin-top: var(--spacing-lg); border-color: var(--color-danger);">
                <div class="card-header" style="border-bottom-color: var(--color-danger);">Danger Zone</div>
                <div class="card-body">
                    <p class="text-muted" style="margin-bottom: var(--spacing-md);">Permanently delete your account and all associated data</p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-danger btn-sm">Delete Account</button>
                </div>
            </div>
        </div>
    </div>
</div>
