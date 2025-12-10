<div class="glass-card">
    <h5 class="fw-bold mb-2">Set New Password</h5>
    <p class="text-white opacity-75 small mb-4 px-2">
        Your new password must be different from previously used passwords.
    </p>

    <form onsubmit="alert('Password Reset Successfully! Redirecting to login...'); window.location.href='{{ url('/student-login') }}'; return false;">
        <div class="mb-3 text-start">
            <label class="form-label small ms-1 mb-2 fw-bold text-white opacity-90">New Password</label>
            <div class="input-group-custom">
                <i class="bi bi-lock input-icon"></i>
                <input type="password" class="custom-input" placeholder="••••••••" required>
            </div>
        </div>

        <div class="mb-3 text-start">
            <label class="form-label small ms-1 mb-2 fw-bold text-white opacity-90">Confirm Password</label>
            <div class="input-group-custom">
                <i class="bi bi-check-circle input-icon"></i>
                <input type="password" class="custom-input" placeholder="••••••••" required>
            </div>
        </div>

        <button type="submit" class="btn-action">
            Reset Password
        </button>
    </form>

    <div class="mt-2">
        <a href="{{ url('/student-login') }}" class="link-back">
            <i class="bi bi-arrow-left me-1"></i> Back to Login
        </a>
    </div>
</div>
