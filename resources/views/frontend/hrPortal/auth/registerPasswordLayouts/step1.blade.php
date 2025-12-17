<div class="glass-card">
    <h5 class="fw-bold mb-3 text-white">Basic Information</h5>

    <div class="row g-2">
        <div class="col-6">
            <div class="input-group-custom">
                <i class="bi bi-person input-icon"></i>
                <input type="text" id="fname" name="first_name" class="custom-input" placeholder="First Name" required>
            </div>
        </div>
        <div class="col-6">
            <div class="input-group-custom">
                <i class="bi bi-person input-icon"></i>
                <input type="text" id="lname" name="last_name" class="custom-input" placeholder="Last Name" required>
            </div>
        </div>
    </div>

    <div class="input-group-custom">
        <i class="bi bi-envelope input-icon"></i>
        <input type="email" id="email" name="email" class="custom-input" placeholder="Email Address" required>
    </div>

    <div class="input-group-custom">
        <i class="bi bi-briefcase input-icon"></i>
        <input type="text" class="custom-input" value="HR" readonly style="background: rgba(255,255,255,0.7); cursor: not-allowed;">
    </div>

    <div class="row g-2">
        <div class="col-6">
            <div class="input-group-custom">
                <i class="bi bi-lock input-icon"></i>
                <input type="password" name="password" class="custom-input" placeholder="Password" required>
            </div>
        </div>
        <div class="col-6">
            <div class="input-group-custom">
                <i class="bi bi-lock input-icon"></i>
                <input type="password" name="password_confirmation" class="custom-input" placeholder="Confirm" required>
            </div>
        </div>
    </div>

    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="terms" required>
        <label class="form-check-label text-white small opacity-75" for="terms">
            I agree to the Terms of Service and Privacy Policy
        </label>
    </div>

    <button type="button" class="btn-action" onclick="switchStep(2)">Continue</button>

    <div class="text-center mt-3">
        <a href="{{ url('/hr-login') }}" class="small text-white text-decoration-none opacity-75 hover:opacity-100">
            Already have an account? <b>Sign In</b>
        </a>
    </div>
</div>
