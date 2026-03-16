<div class="setup-step animate__animated animate__fadeIn">

    <!-- ================= HEADER ================= -->
    <div class="d-flex align-items-center mb-4 basic-header">
        <div class="icon-box me-3">
            <i class="bi bi-building"></i>
        </div>
        <div>
            <h5 class="fw-bold mb-0">Institution Basic Information</h5>
            <p class="text-muted small mb-0">
                Provide the core identity details of your campus.
            </p>
        </div>
    </div>

    <hr class="opacity-10">

    <!-- ================= IDENTITY ================= -->
    <div class="form-section">
        <h6 class="section-title">INSTITUTION IDENTITY</h6>

        <div class="row g-3 mt-2">
            <div class="col-lg-5 col-md-6">
                <label class="form-label-custom">Institution Type *</label>
                <div class="input-group-custom">
                    <i class="bi bi-mortarboard"></i>
                    <select class="form-select ps-5" name="institution_type_id" required>

                        <option value="">Select Type</option>

                        @foreach($types as $type)

                        <option value="{{ $type->institution_type_id }}"
                            {{ $institution->institution_type_id == $type->institution_type_id ? 'selected' : '' }}>

                            {{ $type->type_name }}

                        </option>

                        @endforeach

                    </select>
                </div>
            </div>

            <div class="col-lg-7 col-md-6">
                <label class="form-label-custom">Institution Name *</label>
                <div class="input-group-custom">
                    <i class="bi bi-bank"></i>
                    <input
                        type="text"
                        name="institution_name"
                        class="form-control ps-5"
                        value="{{ $institution->institution_name }}"
                        required>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= ESTABLISHMENT ================= -->
    <div class="form-section">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label-custom">Established Year *</label>
                <div class="input-group-custom">
                    <i class="bi bi-calendar-event"></i>
                    <input type="number"
                        name="established_year"
                        class="form-control ps-5"
                        value="{{ $institution->established_year }}"
                        placeholder="YYYY">
                </div>
            </div>

            <div class="col-md-8">
                <label class="form-label-custom">Website URL</label>
                <div class="input-group-custom">
                    <i class="bi bi-globe"></i>
                    <input type="url"
                        name="website"
                        class="form-control ps-5"
                        value="{{ $institution->website }}"
                        placeholder="https://www.example.edu">
                </div>
            </div>
        </div>
    </div>

    <!-- ================= CONTACT ================= -->
    <div class="form-section">
        <h6 class="section-title">CONTACT DETAILS</h6>

        <div class="row g-3 mt-2">
            <div class="col-md-6">
                <label class="form-label-custom">Phone Number *</label>
                <div class="input-group-custom">
                    <i class="bi bi-telephone"></i>
                    <input
                        type="text"
                        name="phone"
                        class="form-control ps-5"
                        value="{{ $institution->phone }}"
                        required>
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label-custom">Official Email *</label>
                <div class="input-group-custom">
                    <i class="bi bi-envelope"></i>
                    <input
                        type="email"
                        name="email"
                        class="form-control ps-5"
                        value="{{ $institution->email }}"
                        required>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= ADDRESS ================= -->
    <div class="form-section">
        <h6 class="section-title">INSTITUTION ADDRESS</h6>

        <div class="mt-3">
            <label class="form-label-custom">Address Line 1 *</label>
            <div class="input-group-custom">
                <i class="bi bi-geo-alt"></i>
                <input
                    type="text"
                    name="address_line1"
                    class="form-control ps-5"
                    value="{{ $address->address_line1 ?? '' }}"
                    required>
            </div>
        </div>

        <div class="row g-3 mt-2">

            <div class="col-md-4">

                <label class="form-label-custom">State *</label>

                <select name="state" id="stateDropdown" class="form-select" required>

                    <option value="">Select State</option>

                    @foreach($states as $id => $name)

                    <option value="{{ $id }}"
                        {{ ($address->state_id ?? '') == $id ? 'selected' : '' }}>

                        {{ $name }}

                    </option>

                    @endforeach

                </select>

            </div>


            <div class="col-md-4">

                <label class="form-label-custom">City *</label>

                <select name="city" id="cityDropdown" class="form-select" required>

                    <option value="">Select City</option>

                    @if(!empty($cities))

                    @foreach($cities as $id => $name)

                    <option value="{{ $id }}"
                        {{ ($address->city_id ?? '') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>

                    @endforeach

                    @endif

                </select>

            </div>


            <div class="col-md-4">

                <label class="form-label-custom">PIN Code *</label>

                <input
                    type="text"
                    name="postal_code"
                    class="form-control"
                    value="{{ $address->postal_code ?? '' }}"
                    required>

            </div>

        </div>
    </div>

</div>