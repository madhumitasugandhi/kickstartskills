<div class="glass-card">
    <h5 class="fw-bold mb-2">Enter Verification Code</h5>
    <p class="text-white opacity-75 small mb-4 px-2">
        Check your inbox and enter the 6-digit code we just sent.
    </p>

    <form onsubmit="switchStep(3); return false;">
        <div class="mb-3 text-start">
            <label class="form-label small ms-1 mb-2 fw-bold text-white opacity-90">OTP Code</label>
            <div class="input-group-custom">
                <i class="bi bi-shield-lock input-icon"></i>
                <input type="text" class="custom-input" placeholder="123456" maxlength="6" style="letter-spacing: 4px; font-weight: 700;" required>
            </div>
        </div>

        <button type="submit" class="btn-action">
            Verify Code
        </button>
    </form>

    <div class="mt-2">
        <a href="#" class="link-back">
            Didn't receive code? <span class="fw-bold ms-1 text-white">Resend</span>
        </a>
    </div>
</div>
