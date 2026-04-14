<div class="glass-card">
<h5 class="fw-bold mb-2">Enter your email address</h5>
    <p class="text-white opacity-75 small mb-4 px-2">
        We'll send you a verification code to reset your password
    </p>

    <form onsubmit="sendOtp(event)">
    <div class="position-relative mb-3">
        <i class="bi bi-envelope input-icon"></i>
        <input type="email" id="email" class="custom-input" placeholder="Enter your email" required>
    </div>

    <button class="btn-action" id="sendBtn">
    <span class="spinner-border spinner-border-sm d-none" id="sendLoader"></span>
    <span id="sendText">Send Code</span>
</button>
    <a href="{{ url('/'.$portal.'-login') }}" class="d-block mt-3 text-white small">
        Back to login
    </a>
</form>

</div>