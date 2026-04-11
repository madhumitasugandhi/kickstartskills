<div class="glass-card">
    <h5 class="fw-bold mb-2">Update Credentials</h5>
    <p class="text-white opacity-75 small mb-4 px-2">
        Set a highly secure password for your admin account.
    </p>

    <form id="password-reset-final-form">
        @csrf
        <div class="mb-3 text-start">
            <label class="form-label small ms-1 mb-2 fw-bold text-white opacity-90">New Admin Password</label>
            <div class="input-group-custom">
                <i class="bi bi-shield-lock input-icon"></i>
                <input type="password" name="password" class="custom-input" placeholder="••••••••" required>
            </div>
        </div>

        <div class="mb-3 text-start">
            <label class="form-label small ms-1 mb-2 fw-bold text-white opacity-90">Confirm Admin Password</label>
            <div class="input-group-custom">
                <i class="bi bi-check-all input-icon"></i>
                <input type="password" name="password_confirmation" class="custom-input" placeholder="••••••••"
                    required>
            </div>
        </div>

        <button type="submit" class="btn-action">
            Finalize Reset
        </button>
    </form>
</div>
