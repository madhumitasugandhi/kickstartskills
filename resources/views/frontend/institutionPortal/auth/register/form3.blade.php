@if ($errors->any())
<div class="alert alert-danger">
<ul class="mb-0">
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
<div class="glass-card">

    <h5 class="fw-bold mb-2 text-white text-center">Registration Details</h5>
    <p class="text-white opacity-75 small mb-4 text-center">
        Regulatory information and accreditation
    </p>

    <!-- Institution Type -->
    <label class="small text-white opacity-75 ms-1 mb-1">Institution Type</label>
    <div class="input-group-custom">
        <i class="bi bi-bookmark input-icon"></i>
        <select id="institution_type" name="institution_type_id" class="custom-input">

<option value="">Select Institution Type</option>

@foreach($types as $type)

<option value="{{ $type->institution_type_id }}"
{{ (old('institution_type_id', $formData['institution_type_id'] ?? '') == $type->institution_type_id) ? 'selected' : '' }}>

{{ $type->type_name }}

</option>

@endforeach

</select>
    </div>
    <div class="field-error" id="type-error"></div>
    <!-- AISHE Code -->
    <label class="small text-white opacity-75 ms-1 mb-1 mt-3">AISHE Code</label>
    <div class="input-group-custom">
        <i class="bi bi-upc-scan input-icon"></i>
        <input type="text" id="aishe_code" name="aishe_code" class="custom-input" placeholder="AISHE Code">
    </div>

    <!-- Information Box -->
    <div class="info-box mt-3 p-3 rounded" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2);">
        <span class="text-white small fw-bold">AISHE Code Format:</span>
        <ul class="text-white small opacity-75 mt-2 mb-0">
            <li>U-[numbers] for Universities</li>
            <li>C-[numbers] for Colleges</li>
            <li>S-[numbers] for Standalone Institutions</li>
        </ul>
    </div>

    <!-- AICTE Permanent ID -->
    <label class="small text-white opacity-75 ms-1 mb-1">
        AICTE Permanent ID (Technical Institutions)
    </label>
    <div class="input-group-custom">
        <i class="bi bi-gear input-icon"></i>
        <input type="text" id="aicte_id" name="aicte_id" class="custom-input" placeholder="AICTE Permanent ID (Technical Institutions)">
    </div>

    <!-- UGC Recognition Number -->
    <label class="small text-white opacity-75 ms-1 mb-1 mt-3">
        UGC Recognition Number (Universities & Colleges)
    </label>
    <div class="input-group-custom">
        <i class="bi bi-bank input-icon"></i>
        <input type="text" id="ugc_number" name="ugc_number" class="custom-input" placeholder="UGC Recognition Number (Universities & Colleges)">
    </div>

    <!-- Regulatory Info Box -->
    <div class="info-box mt-4 p-3 rounded" style="background: rgba(0, 128, 96, 0.15); border: 1px solid rgba(0, 255, 180, 0.25);">
        <span class="text-white fw-bold small">Regulatory Information:</span>
        <ul class="text-white small opacity-75 mt-2 mb-0">
            <li>AICTE: Required for technical education (Engineering, Management, etc.)</li>
            <li>UGC: Required for universities and degree-granting colleges</li>
            <li>Both may be required for some institutions</li>
        </ul>
    </div>

    <!-- Buttons -->
    <div class="d-flex justify-content-between mt-4 gap-2">
        <button type="button" class="btn-prev" onclick="switchStep(2)">Back</button>
        <button type="button" class="btn-action" onclick="validateStep3()">Review</button>
    </div>
</div>