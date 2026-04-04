<div class="glass-card">
    <h5 class="fw-bold mb-2">Set New Password</h5>
    <p class="text-white opacity-75 small mb-4">Create a strong password for your HR access.</p>
    <form id="password-reset-final-form">
        @csrf
        <div class="mb-3 text-start">
            <div class="input-group-custom">
                <i class="bi bi-lock input-icon"></i>
                <input type="password" name="password" class="custom-input" placeholder="New Password" required>
            </div>
        </div>
        <div class="mb-3 text-start">
            <div class="input-group-custom">
                <i class="bi bi-check-all input-icon"></i>
                <input type="password" name="password_confirmation" class="custom-input" placeholder="Confirm Password"
                    required>
            </div>
        </div>
        <button type="submit" class="btn-action">Reset HR Password</button>
    </form>
</div>
