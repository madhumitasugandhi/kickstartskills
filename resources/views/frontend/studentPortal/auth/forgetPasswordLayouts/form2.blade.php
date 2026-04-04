<div class="glass-card">
    <h5 class="fw-bold mb-2">Enter Verification Code</h5>
    <p class="text-white opacity-75 small mb-4">Check your inbox for the 6-digit code</p>

    <form id="otp-verify-form">
        @csrf
        <div class="d-flex justify-content-center gap-2 mb-4">
            <input type="text" class="otp-box custom-input" maxlength="1"
                style="width: 40px; text-align: center; padding: 10px;">
            <input type="text" class="otp-box custom-input" maxlength="1"
                style="width: 40px; text-align: center; padding: 10px;">
            <input type="text" class="otp-box custom-input" maxlength="1"
                style="width: 40px; text-align: center; padding: 10px;">
            <input type="text" class="otp-box custom-input" maxlength="1"
                style="width: 40px; text-align: center; padding: 10px;">
            <input type="text" class="otp-box custom-input" maxlength="1"
                style="width: 40px; text-align: center; padding: 10px;">
            <input type="text" class="otp-box custom-input" maxlength="1"
                style="width: 40px; text-align: center; padding: 10px;">
        </div>

        <input type="hidden" name="otp" id="input-otp">

        <button type="submit" class="btn-action">Verify Code</button>
    </form>
    
    <div class="mt-2">
        <a href="#" class="link-back">
            Didn't receive code? <span class="fw-bold ms-1 text-white">Resend</span>
        </a>
    </div>
</div>
