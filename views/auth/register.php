<div class="auth-container">
    <div class="auth-box">
        <div class="auth-header">
            <h1>Register</h1>
            <p>Join us and start booking</p>
        </div>

        <form method="POST" action="<?php echo BASE_URL; ?>/register">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    placeholder="John Doe"
                    required
                    autofocus
                >
                <?php if (isset($errors['name'])): ?>
                    <div class="form-error"><?php echo htmlspecialchars($errors['name']); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="you@example.com"
                    required
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
                    placeholder="At least 8 characters"
                    required
                >
                <?php if (isset($errors['password'])): ?>
                    <div class="form-error"><?php echo htmlspecialchars($errors['password']); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="password_confirm">Confirm Password</label>
                <input 
                    type="password" 
                    id="password_confirm" 
                    name="password_confirm" 
                    placeholder="Confirm your password"
                    required
                >
                <?php if (isset($errors['password_confirm'])): ?>
                    <div class="form-error"><?php echo htmlspecialchars($errors['password_confirm']); ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-bottom: var(--spacing-lg);">
                Create Account
            </button>
        </form>

        <div class="divider"></div>

        <div class="auth-footer">
            <p>Already have an account? <a href="<?php echo BASE_URL; ?>/login">Sign in</a></p>
        </div>
    </div>
</div>