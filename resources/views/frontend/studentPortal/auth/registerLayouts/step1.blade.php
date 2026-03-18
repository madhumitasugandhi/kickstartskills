<div class="glass-card">
    <h4 class="text-center fw-bold mb-4">Basic Information</h4>

    <div class="row g-3 mb-3">
        <div class="col-6">
            <label class="form-label-custom">First Name</label>
            <div class="input-group-custom">
                <i class="bi bi-person input-icon"></i>
                <input type="text" name="first_name" id="fname" class="custom-input" placeholder="First Name">
            </div>
        </div>
        <div class="col-6">
            <label class="form-label-custom">Last Name</label>
            <div class="input-group-custom">
                <i class="bi bi-person input-icon"></i>
                <input type="text" name="last_name" id="lname" class="custom-input" placeholder="Last Name">
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label-custom">Email Address</label>
        <div class="input-group-custom">
            <i class="bi bi-envelope input-icon"></i>
            <input type="email" name="email" id="email" class="custom-input" placeholder="Email Address">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label-custom">I am a</label>
        <div class="input-group-custom">
            <i class="bi bi-book input-icon"></i>
            <select id="user_role" class="custom-input form-select" style="appearance: auto; padding-left: 42px;">
                <option value="5" selected>Student</option>
            </select>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6">
            <label class="form-label-custom">Password</label>
            <div class="input-group-custom">
                <i class="bi bi-lock input-icon"></i>
                <input type="password" name="password" class="custom-input" placeholder="••••••••" >
            </div>
        </div>
        <div class="col-6">
            <label class="form-label-custom">Confirm Password</label>
            <div class="input-group-custom">
                <i class="bi bi-lock input-icon"></i>
                <input type="password" name="password_confirmation" class="custom-input" placeholder="••••••••"
                    >
            </div>
        </div>
    </div>

    <div class="form-check mb-4">
        <input class="form-check-input" type="checkbox" id="terms">
        <label class="form-check-label small text-muted-custom" for="terms">
            I agree to the Terms of Service and Privacy Policy
        </label>
    </div>

    <button type="button" class="btn-action w-100"
        onclick="console.log('Button Clicked'); switchStep(2)">Continue</button>
</div>
