<div class="glass-card">
<h5 class="fw-bold mb-2">Set New Password</h5>
    <p class="text-white opacity-75 small mb-4 px-2">
        Your new password must be different from previously used passwords.
    </p>

    <form onsubmit="resetPassword(event)">
    <div class="mb-3 position-relative">
        <i class="bi bi-lock input-icon"></i>
        <input type="password" id="password" class="custom-input" placeholder="New password" required>
    </div>

    <div class="mb-3 position-relative">
        <i class="bi bi-check-circle input-icon"></i>
        <input type="password" id="confirm_password" class="custom-input" placeholder="Confirm password" required>
    </div>

    <button class="btn-action">Reset Password</button>
</form>

        <div class="mt-2">
        <a href="{{ url('/'.$portal.'-login') }}" class="d-block mt-3 text-white small">
    <i class="bi bi-arrow-left me-1"></i> Back to Login
</a>
    </div>
</div>