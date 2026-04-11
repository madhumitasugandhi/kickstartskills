<div class="glass-card">
    <h5 class="fw-bold mb-2">Security Verification</h5>
    <p class="text-white opacity-75 small mb-4 px-2">Check your inbox for the 6-digit code</p>

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

        <button type="submit" class="btn-action">
            Verify Identity
        </button>
    </form>

    <div class="mt-2">
        <a href="{{ route('admin.forgot_password') }}" class="link-back text-decoration-none">
            Code not received? <span class="fw-bold text-white">Resend</span>
        </a>
    </div>
</div>
