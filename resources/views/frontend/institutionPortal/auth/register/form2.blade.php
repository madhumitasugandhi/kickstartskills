

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

<select id="country" name="country_id" class="custom-input">

<option value="">Select Country</option>

@foreach($countries as $id => $name)

<option value="{{ $id }}"
{{ (old('country_id', $formData['country_id'] ?? '') == $id) ? 'selected' : '' }}>

{{ $name }}

</option>

@endforeach

</select>

</div>

<div class="field-error" id="country-error"></div>

</div>


<div class="col-md-6">

<label class="small text-white opacity-75 ms-1 mb-1">Phone Number</label>

<div class="input-group-custom">
<i class="bi bi-telephone input-icon"></i>

<input
type="tel"
id="phone"
name="phone"
class="custom-input"
value="{{ old('phone', $formData['phone'] ?? '') }}"
placeholder="Phone Number">

</div>

<div class="field-error" id="phone-error"></div>

</div>

</div>


<!-- ADDRESS LINE 1 -->

<label class="small text-white opacity-75 ms-1 mb-1 mt-3">Address Line 1</label>

<div class="input-group-custom">
<i class="bi bi-geo-alt input-icon"></i>

<input
type="text"
id="address1"
name="address_line1"
class="custom-input"
value="{{ old('address_line1', $formData['address_line1'] ?? '') }}"
placeholder="Address Line 1">

</div>

<div class="field-error" id="address1-error"></div>


<!-- ADDRESS LINE 2 -->

<label class="small text-white opacity-75 ms-1 mb-1 mt-3">
Address Line 2 (Optional)
</label>

<div class="input-group-custom">
<i class="bi bi-geo-alt input-icon"></i>

<input
type="text"
id="address2"
name="address_line2"
class="custom-input"
value="{{ old('address_line2', $formData['address_line2'] ?? '') }}"
placeholder="Address Line 2 (Optional)">

</div>


<!-- STATE + CITY -->

<div class="row mt-3">

<div class="col-md-6">

<label class="small text-white opacity-75 ms-1 mb-1">State</label>

<div class="input-group-custom">
<i class="bi bi-map input-icon"></i>

<select id="state" name="state" class="custom-input">

<option value="">Select State</option>

</select>

</div>

<div class="field-error" id="state-error"></div>

</div>


<div class="col-md-6">

<label class="small text-white opacity-75 ms-1 mb-1">City</label>

<div class="input-group-custom">
<i class="bi bi-map input-icon"></i>

<select id="city" name="city" class="custom-input">

<option value="">Select City</option>

</select>

</div>

<div class="field-error" id="city-error"></div>

</div>

</div>


<!-- ZIP -->

<label class="small text-white opacity-75 ms-1 mb-1 mt-3">
Postal/ZIP Code
</label>

<div class="input-group-custom">
<i class="bi bi-hash input-icon"></i>

<input
type="text"
id="zip"
name="zip"
class="custom-input"
value="{{ old('zip', $formData['zip'] ?? '') }}"
placeholder="Postal/ZIP Code">

</div>

<div class="field-error" id="zip-error"></div>


<div class="d-flex justify-content-between mt-4 gap-2">

<button type="button" class="btn-prev" onclick="switchStep(1)">
Back
</button>

<button type="button" class="btn-action" onclick="validateStep2()">
Continue
</button>

</div>

</div>