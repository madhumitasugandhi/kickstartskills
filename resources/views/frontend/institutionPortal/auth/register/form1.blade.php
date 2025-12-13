<div class="glass-card">
    <h5 class="fw-bold mb-3 text-white text-center">Basic Information</h5>
    <p class="text-white opacity-75 small mb-4 px-2 text-center"> Tell us about your institution</p>

            <div class="input-group-custom">
                <i class="bi bi-person input-icon"></i>
                <input type="text" id="iname" name="first_name" class="custom-input" placeholder="Institution Name" required>
            </div>
       
            <div class="input-group-custom">
                <i class="bi bi-person input-icon"></i>
                <input type="text" id="lname" name="last_name" class="custom-input" placeholder="Representative Name" required>
            </div>
        

    <div class="input-group-custom">
        <i class="bi bi-envelope input-icon"></i>
        <input type="email" id="email" name="email" class="custom-input" placeholder="Official Email Address" required>
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
                <input type="password" name="password_confirmation" class="custom-input" placeholder="Confirm Password" required>
            </div>
        </div>
    </div>

    <button type="button" class="btn-action" onclick="switchStep(2)">Continue</button>

    
</div>
