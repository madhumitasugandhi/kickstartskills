<div>

    <!-- HEADER -->
    <div class="d-flex align-items-center mb-3">
        <div class="ui-icon-box me-3">
            <i class="bi bi-building"></i>
        </div>
        <div>
            <h5 class="fw-bold mb-0">Institution Basic Information</h5>
            <small class="text-muted">
                Provide the core identity details of your campus.
            </small>
        </div>
    </div>

    <div class="ui-divider"></div>

    <!-- IDENTITY -->
    <div class="ui-section">
        <div class="ui-section-title">INSTITUTION IDENTITY</div>

        <div class="row g-3">
            <div class="col-lg-5 col-md-6">
                <label class="ui-label">Institution Type *</label>
                <div class="ui-input-icon">
                    <i class="bi bi-mortarboard"></i>
                    <select class="form-select" name="institution_type_id" required>
                        <option value="">Select Type</option>

                        @foreach($types as $type)
                        <option value="{{ $type->institution_type_id }}"
                            {{ ($sessionData['basic']['institution_type_id'] ?? $institution->institution_type_id) == $type->institution_type_id ? 'selected' : '' }}>
                            {{ $type->type_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-7 col-md-6">
                <label class="ui-label">Institution Name *</label>
                <div class="ui-input-icon">
                    <i class="bi bi-bank"></i>
                    <input type="text"
                        name="institution_name"
                        class="form-control"
                        value="{{ $sessionData['basic']['institution_name'] ?? $institution->institution_name }}"
                        required>
                    <small class="text-danger error-msg" data-error="institution_name"></small>
                </div>
            </div>
        </div>
    </div>

    <!-- ESTABLISHMENT -->
    <div class="ui-section">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="ui-label">Established Year *</label>
                <div class="ui-input-icon">
                    <i class="bi bi-calendar-event"></i>
                    <input type="number"
                        name="established_year"
                        class="form-control"
                        value="{{ $sessionData['basic']['established_year'] ?? $institution->established_year }}"
                        placeholder="YYYY">
                </div>
            </div>

            <div class="col-md-8">
                <label class="ui-label">Website URL</label>
                <div class="ui-input-icon">
                    <i class="bi bi-globe"></i>
                    <input type="url"
                        name="website"
                        class="form-control"
                        value="{{ $sessionData['basic']['website'] ?? $institution->website }}"
                        placeholder="https://www.example.edu">
                </div>
            </div>
        </div>
    </div>

    <!-- CONTACT -->
    <div class="ui-section">
        <div class="ui-section-title">CONTACT DETAILS</div>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="ui-label">Phone Number *</label>
                <div class="ui-input-icon">
                    <i class="bi bi-telephone"></i>
                    <input type="text"
                        name="phone"
                        class="form-control"
                        value="{{ $sessionData['basic']['phone'] ?? $institution->phone }}"
                        required>
                    <small class="text-danger error-msg" data-error="phone"></small>
                </div>
            </div>

            <div class="col-md-6">
                <label class="ui-label">Official Email *</label>
                <div class="ui-input-icon">
                    <i class="bi bi-envelope"></i>
                    <input type="email"
                        name="email"
                        class="form-control"
                        value="{{ $sessionData['basic']['email'] ?? $institution->email }}"
                        required>
                    <small class="text-danger error-msg" data-error="email"></small>
                </div>
            </div>
        </div>
    </div>

    <!-- ADDRESS -->
    <div class="ui-section">
        <div class="ui-section-title">INSTITUTION ADDRESS</div>

        <div class="mt-2">
            <label class="ui-label">Address Line 1 *</label>
            <div class="ui-input-icon">
                <i class="bi bi-geo-alt"></i>
                <input type="text"
                    name="address_line1"
                    class="form-control"
                    value="{{ $sessionData['basic']['address_line1'] ?? ($address->address_line1 ?? '') }}"
                    required>
                <small class="text-danger error-msg" data-error="address_line1"></small>
            </div>
        </div>

        <div class="row g-3 mt-2">
            <div class="col-md-4">
                <label class="ui-label">State *</label>
                <select name="state" id="stateDropdown" class="form-select" required>
                    <option value="">Select State</option>
                    @foreach($states as $id => $name)
                    <option value="{{ $id }}"
                        {{ ($sessionData['basic']['state'] ?? ($address->state_id ?? '')) == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="ui-label">City *</label>
                <select name="city" id="cityDropdown" class="form-select" required>
                    <option value="">Select City</option>
                    @if(!empty($cities))
                    @foreach($cities as $id => $name)
                    <option value="{{ $id }}"
                        {{ ($sessionData['basic']['city'] ?? ($address->city_id ?? '')) == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                    @endforeach
                    @endif
                </select>
            </div>

            <div class="col-md-4">
                <label class="ui-label">PIN Code *</label>
                <input type="text"
                    name="postal_code"
                    class="form-control"
                    value="{{ $sessionData['basic']['postal_code'] ?? ($address->postal_code ?? '') }}"
                    required>
                <small class="text-danger error-msg" data-error="postal_code"></small>
            </div>
        </div>
    </div>

</div>
<script>
    document.getElementById('stateDropdown').addEventListener('change', function() {

        let stateId = this.value;
        let cityDropdown = document.getElementById('cityDropdown');

        cityDropdown.innerHTML = '<option value="">Loading...</option>';

        fetch(`/api/cities/${stateId}`)
            .then(res => res.json())
            .then(data => {

                cityDropdown.innerHTML = '<option value="">Select City</option>';

                data.forEach(city => {
                    cityDropdown.innerHTML +=
                        `<option value="${city.id}">${city.name}</option>`;
                });

            })
            .catch(() => {
                cityDropdown.innerHTML = '<option value="">Error loading cities</option>';
            });

    });
</script>