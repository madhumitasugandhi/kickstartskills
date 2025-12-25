<div class="card glass-card p-4">

    {{-- HEADER --}}
    <h5 class="fw-semibold mb-4 d-flex align-items-center gap-2">
        <i class="bi bi-mortarboard text-teal"></i>
        Academic Settings
    </h5>

    {{-- FORM --}}
    <div class="row g-4">

        {{-- Default Grading Scale --}}
        <div class="col-12">
            <label class="form-label">Default Grading Scale</label>
            <div class="input-group-custom">
                <i class="bi bi-list-check"></i>
                <select class="form-select">
                    <option selected>Letter Grade (A–F)</option>
                    <option>Percentage</option>
                    <option>GPA (4.0)</option>
                </select>
            </div>
        </div>

        {{-- Passing Grade --}}
        <div class="col-12">
            <label class="form-label">Passing Grade</label>
            <div class="input-group-custom">
                <i class="bi bi-award"></i>
                <select class="form-select">
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option selected>D</option>
                    <option>F</option>
                </select>
            </div>
        </div>

        {{-- Max Credits --}}
        <div class="col-12">
            <label class="form-label">Max Credits Per Semester</label>
            <div class="input-group-custom">
                <i class="bi bi-plus-circle"></i>
                <input type="number" class="form-control" value="18">
            </div>
        </div>

        {{-- Min Credits --}}
        <div class="col-12">
            <label class="form-label">Min Credits for Full-Time</label>
            <div class="input-group-custom">
                <i class="bi bi-dash-circle"></i>
                <input type="number" class="form-control" value="12">
            </div>
        </div>

        {{-- Attendance --}}
        <div class="col-12">
            <label class="form-label">Attendance Requirement (%)</label>
            <div class="input-group-custom">
                <i class="bi bi-calendar-check"></i>
                <input type="number" class="form-control" value="75">
            </div>
        </div>

        {{-- Late Penalty --}}
        <div class="col-12">
            <label class="form-label">Late Submission Penalty (%)</label>
            <div class="input-group-custom">
                <i class="bi bi-exclamation-triangle"></i>
                <input type="number" class="form-control" value="10">
            </div>
        </div>

        {{-- Grade Retention --}}
        <div class="col-12">
            <label class="form-label">Grade Retention Policy</label>
            <div class="input-group-custom">
                <i class="bi bi-clock-history"></i>
                <input type="text" class="form-control" value="7 years">
            </div>
        </div>

        {{-- Transcript Fee --}}
        <div class="col-12">
            <label class="form-label">Transcript Fee ($)</label>
            <div class="input-group-custom">
                <i class="bi bi-currency-dollar"></i>
                <input type="number" class="form-control" value="25">
            </div>
        </div>

    </div>

    {{-- DIVIDER --}}
    <hr class="my-4">

    {{-- ACADEMIC FEATURES --}}
    <h6 class="text-teal mb-3">Academic Features</h6>

    <div class="d-flex flex-column gap-3">

        <div class="d-flex justify-content-between align-items-center">
            <span class="form-label">Enable Online Exams</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <span class="form-label">Enable Grade Appeals</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <span class="form-label">Auto Enrollment</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox">
            </div>
        </div>

    </div>

</div>
