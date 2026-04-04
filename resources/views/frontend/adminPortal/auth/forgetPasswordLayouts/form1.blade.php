<div class="glass-card">
    <h5 class="fw-bold mb-2">Admin Identification</h5>
    <p class="text-white opacity-75 small mb-4 px-2">
        Enter your registered admin email to receive a secure reset code.
    </p>

    <form id="otp-send-form">
        @csrf
        <div class="mb-3 text-start">
            <label class="form-label small ms-1 mb-2 fw-bold text-white opacity-90">Admin Email</label>
            <div class="input-group-custom">
                <i class="bi bi-envelope-fill input-icon"></i>
                <input type="email" name="email" id="reset-email" class="custom-input"
                    placeholder="admin@kickstartskills.com" required>
            </div>
        </div>

        <button type="submit" class="btn-action" id="send-otp-btn">
            Authorize & Send Code
        </button>
    </form>

    <div class="mt-2">
        <a href="{{ url('/admin-login') }}" class="link-back">
            <i class="bi bi-arrow-left me-1"></i> Back to Admin Login
        </a>
    </div>
</div>
