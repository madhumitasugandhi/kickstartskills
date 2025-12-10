<div class="glass-card">
    <h5 class="fw-bold mb-3 text-white">Tell us more about you</h5>

    <label class="small text-white opacity-75 ms-1 mb-1">Phone Number</label>
    <div class="input-group-custom">
        <i class="bi bi-telephone input-icon"></i>
        <input type="tel" id="phone" name="phone" class="custom-input" placeholder="+91 9876543210">
    </div>

    <label class="small text-white opacity-75 ms-1 mb-1">Country</label>
    <div class="input-group-custom">
        <i class="bi bi-globe input-icon"></i>
        <input type="text" id="country" name="country" class="custom-input" placeholder="India">
    </div>

    <hr class="border-white opacity-25 my-3">

    <label class="small text-white opacity-75 ms-1 mb-1">Institution Code</label>
    <div class="input-group-custom">
        <i class="bi bi-upc-scan input-icon"></i>
        <input type="text" id="institution_code" name="institution_code" class="custom-input" placeholder="Enter Code (e.g. DU-2025)">
    </div>

    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="no-institution-code" onchange="toggleInstitutionFields()">
        <label class="form-check-label text-white small opacity-75" for="no-institution-code">
            I don't have an Institution code (Individual learner)
        </label>
    </div>

    <div id="institution-name-group">
        <label class="small text-white opacity-75 ms-1 mb-1">Institution/University Name (Optional)</label>
        <div class="input-group-custom">
            <i class="bi bi-house-door input-icon"></i>
            <input type="text" id="institution_name" name="institution_name" class="custom-input" placeholder="Delhi University">
        </div>
    </div>

    <hr class="border-white opacity-25 my-3">

    <h6 class="text-white fw-bold mb-2 small">Skills & Learning Goals</h6>

    <div class="input-group-custom">
        <i class="bi bi-code-slash input-icon"></i>
        <input type="text" id="skills" name="skills" class="custom-input" placeholder="Current Skills (e.g. Flutter, HTML)">
    </div>

    <div class="input-group-custom">
        <i class="bi bi-bullseye input-icon"></i>
        <input type="text" id="goals" name="goals" class="custom-input" placeholder="Learning Goals (e.g. React, Python)">
    </div>

    <button type="button" class="btn-action" onclick="switchStep(3)">Continue</button>
    <button type="button" class="btn-prev" onclick="switchStep(1)">Previous</button>

    <script>
        function toggleInstitutionFields() {
            const isChecked = document.getElementById('no-institution-code').checked;
            const codeInput = document.getElementById('institution_code');

            if(isChecked) {
                codeInput.value = '';
                codeInput.disabled = true;
                codeInput.style.opacity = '0.5';
                codeInput.placeholder = "Individual Learner (Disabled)";
            } else {
                codeInput.disabled = false;
                codeInput.style.opacity = '1';
                codeInput.placeholder = "Enter Code (e.g. DU-2025)";
            }
        }
    </script>
</div>
