<div class="glass-card">
    <h5 class="fw-bold mb-2">Enter your email address</h5>
    <p class="text-white opacity-75 small mb-4 px-2">
        We'll send you a verification code to reset your password
    </p>

    <form id="otp-send-form">
        @csrf
        <div class="mb-3 text-start">
            <label class="form-label small ms-1 mb-2 fw-bold text-white opacity-90">Email address</label>
            <div class="input-group-custom">
                <i class="bi bi-envelope-fill input-icon"></i>
                <input type="email" name="email" id="reset-email" class="custom-input"
                    placeholder="mentor@kickstartskills.com" required>
            </div>
        </div>

        <button type="submit" class="btn-action" id="send-otp-btn">
            Send Reset Code
        </button>
    </form>

    <div class="mt-2">
        <a href="{{ route('mentor.login') }}" class="link-back">
            Remember your password? <span class="fw-bold ms-1 text-white">Sign in</span>
        </a>
    </div>
</div>
