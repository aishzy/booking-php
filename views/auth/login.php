<div class="auth-container">
    <div class="auth-box">
        <div class="auth-header">
            <h1>Login</h1>
            <p>Welcome back to Bookings</p>
        </div>

        <form method="POST" action="<?php echo BASE_URL; ?>/login">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="you@example.com"
                    required
                    autofocus
                >
                <?php if (isset($errors['email'])): ?>
                    <div class="form-error"><?php echo htmlspecialchars($errors['email']); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Enter your password"
                    required
                >
                <?php if (isset($errors['password'])): ?>
                    <div class="form-error"><?php echo htmlspecialchars($errors['password']); ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-bottom: var(--spacing-lg);">
                Sign In
            </button>
        </form>

        <div class="divider"></div>

        <div class="auth-footer">
            <p>Don't have an account? <a href="<?php echo BASE_URL; ?>/register">Create one</a></p>
            <p><a href="<?php echo BASE_URL; ?>/forgot-password">Forgot your password?</a></p>
        </div>
    </div>
</div>;