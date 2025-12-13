<div class="glass-card">
    <h5 class="fw-bold mb-3 text-white text-center">Contact & Location</h5>
    <p class="text-white opacity-75 small mb-4 px-2 text-center">
        How can we reach your institution?
    </p>

    <!-- COUNTRY + PHONE -->
    <div class="row">
        <div class="col-md-6">
            <label class="small text-white opacity-75 ms-1 mb-1">Country</label>
            <div class="input-group-custom">
                <i class="bi bi-globe input-icon"></i>
                <select id="country" name="country" class="custom-input">
                    <option value="India">India (+91)</option>
                    <option value="USA">USA (+1)</option>
                    <option value="UK">UK (+44)</option>
                    <option value="Canada">Canada (+1)</option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <label class="small text-white opacity-75 ms-1 mb-1">Phone Number</label>
            <div class="input-group-custom">
                <i class="bi bi-telephone input-icon"></i>
                <input type="tel" id="phone" name="phone" class="custom-input" placeholder="Phone Number">
            </div>
        </div>
    </div>

    <!-- ADDRESS LINE 1 -->
    <label class="small text-white opacity-75 ms-1 mb-1 mt-3">Address Line 1</label>
    <div class="input-group-custom">
        <i class="bi bi-geo-alt input-icon"></i>
        <input type="text" id="address1" name="address1" class="custom-input" placeholder="Address Line 1">
    </div>

    <!-- ADDRESS LINE 2 -->
    <label class="small text-white opacity-75 ms-1 mb-1 mt-3">Address Line 2 (Optional)</label>
    <div class="input-group-custom">
        <i class="bi bi-geo-alt input-icon"></i>
        <input type="text" id="address2" name="address2" class="custom-input" placeholder="Address Line 2 (Optional)">
    </div>

    <!-- CITY + STATE -->
    <div class="row mt-3">
        <div class="col-md-6">
            <label class="small text-white opacity-75 ms-1 mb-1">City</label>
            <div class="input-group-custom">
                <i class="bi bi-map input-icon"></i>
                <input type="text" id="city" name="city" class="custom-input" placeholder="City">
            </div>
        </div>

        <div class="col-md-6">
            <label class="small text-white opacity-75 ms-1 mb-1">State/Province</label>
            <div class="input-group-custom">
                <i class="bi bi-map input-icon"></i>
                <input type="text" id="state" name="state" class="custom-input" placeholder="State/Province">
            </div>
        </div>
    </div>

    <!-- ZIP CODE -->
    <label class="small text-white opacity-75 ms-1 mb-1 mt-3">Postal/ZIP Code</label>
    <div class="input-group-custom">
        <i class="bi bi-hash input-icon"></i>
        <input type="text" id="zip" name="zip" class="custom-input" placeholder="Postal/ZIP Code">
    </div>

    <!-- BUTTONS -->
    <div class="d-flex justify-content-between mt-4 gap-2">
        <button type="button" class="btn-prev" onclick="switchStep(1)">Back</button>
        <button type="button" class="btn-action" onclick="switchStep(3)">Continue</button>
    </div>
</div>
