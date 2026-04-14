<div class="glass-card">
    <h5 class="fw-bold mb-2">Enter Verification Code</h5>

    <p class="text-white opacity-75 small mb-4">
        Enter the 6-digit code sent to your email
    </p>

    <form onsubmit="verifyOtp(event)">

        <!-- OTP BOXES -->
        <div class="otp-container mb-3">
            <input type="text" maxlength="1" class="otp-input" />
            <input type="text" maxlength="1" class="otp-input" />
            <input type="text" maxlength="1" class="otp-input" />
            <input type="text" maxlength="1" class="otp-input" />
            <input type="text" maxlength="1" class="otp-input" />
            <input type="text" maxlength="1" class="otp-input" />
        </div>

        <input type="hidden" id="otp">

        <button class="btn-action">Verify</button>
    </form>

    <div class="mt-3 small text-white">
        Didn’t receive code?
        <span onclick="sendOtp(event)" style="cursor:pointer; font-weight:600;">
            Resend
        </span>
    </div>
</div>