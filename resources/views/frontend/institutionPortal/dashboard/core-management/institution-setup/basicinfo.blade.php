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
                    <select class="form-select ps-5" required>
                        <option selected disabled>Select Type</option>
                        <option>University</option>
                        <option>College</option>
                        <option>Institute</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-7 col-md-6">
                <label class="form-label-custom">Institution Name *</label>
                <div class="input-group-custom">
                    <i class="bi bi-bank"></i>
                    <input type="text" class="form-control ps-5"
                           placeholder="e.g. Stanford University" required>
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
                    <input type="number" class="form-control ps-5" placeholder="YYYY" required>
                </div>
            </div>

            <div class="col-md-8">
                <label class="form-label-custom">Website URL</label>
                <div class="input-group-custom">
                    <i class="bi bi-globe"></i>
                    <input type="url" class="form-control ps-5"
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
                    <input type="text" class="form-control ps-5"
                           placeholder="+1 (000) 000-0000" required>
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label-custom">Official Email *</label>
                <div class="input-group-custom">
                    <i class="bi bi-envelope"></i>
                    <input type="email" class="form-control ps-5"
                           placeholder="admin@institute.edu" required>
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
                <input type="text" class="form-control ps-5"
                       placeholder="Street name and number" required>
            </div>
        </div>

        <div class="row g-3 mt-2">
            <div class="col-md-4">
                <label class="form-label-custom">City *</label>
                <input type="text" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label-custom">State *</label>
                <input type="text" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label-custom">PIN Code *</label>
                <input type="text" class="form-control"
                       placeholder="123456" required>
            </div>
        </div>
    </div>

</div>
