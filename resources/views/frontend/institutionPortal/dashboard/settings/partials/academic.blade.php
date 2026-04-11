<div class="ui-card">

    <!-- HEADER -->
    <div class="ui-card-header">
        <div class="ui-card-title">
            <i class="bi bi-mortarboard me-2"></i>
            Academic Settings
        </div>
    </div>

    <!-- ================= ACADEMIC RULES ================= -->
    <div class="ui-section">
        <div class="ui-section-title">ACADEMIC RULES</div>

        <div class="row g-3">

            <!-- Default Grading Scale -->
            <div class="col-md-6">
                <label class="ui-label">Default Grading Scale</label>
                <div class="input-group-custom">
                    <i class="bi bi-list-check"></i>
                    <select class="form-select">
                        <option selected>Letter Grade (A–F)</option>
                        <option>Percentage</option>
                        <option>GPA (4.0)</option>
                    </select>
                </div>
            </div>

            <!-- Passing Grade -->
            <div class="col-md-6">
                <label class="ui-label">Passing Grade</label>
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

            <!-- Max Credits -->
            <div class="col-md-6">
                <label class="ui-label">Max Credits Per Semester</label>
                <div class="input-group-custom">
                    <i class="bi bi-plus-circle"></i>
                    <input type="number" class="form-control" value="18">
                </div>
            </div>

            <!-- Min Credits -->
            <div class="col-md-6">
                <label class="ui-label">Min Credits for Full-Time</label>
                <div class="input-group-custom">
                    <i class="bi bi-dash-circle"></i>
                    <input type="number" class="form-control" value="12">
                </div>
            </div>

            <!-- Attendance -->
            <div class="col-md-6">
                <label class="ui-label">Attendance Requirement (%)</label>
                <div class="input-group-custom">
                    <i class="bi bi-calendar-check"></i>
                    <input type="number" class="form-control" value="75">
                </div>
            </div>

            <!-- Late Penalty -->
            <div class="col-md-6">
                <label class="ui-label">Late Submission Penalty (%)</label>
                <div class="input-group-custom">
                    <i class="bi bi-exclamation-triangle"></i>
                    <input type="number" class="form-control" value="10">
                </div>
            </div>

            <!-- Grade Retention -->
            <div class="col-md-6">
                <label class="ui-label">Grade Retention Policy</label>
                <div class="input-group-custom">
                    <i class="bi bi-clock-history"></i>
                    <input type="text" class="form-control" value="7 years">
                </div>
            </div>

            <!-- Transcript Fee -->
            <div class="col-md-6">
                <label class="ui-label">Transcript Fee ($)</label>
                <div class="input-group-custom">
                    <i class="bi bi-currency-dollar"></i>
                    <input type="number" class="form-control" value="25">
                </div>
            </div>

        </div>
    </div>

    <!-- ================= ACADEMIC FEATURES ================= -->
    <div class="ui-section">
        <div class="ui-section-title">ACADEMIC FEATURES</div>

        <div class="d-flex flex-column gap-3">

            <div class="d-flex justify-content-between align-items-center">
                <span class="ui-label mb-0">Enable Online Exams</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" checked>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <span class="ui-label mb-0">Enable Grade Appeals</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" checked>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <span class="ui-label mb-0">Auto Enrollment</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox">
                </div>
            </div>

        </div>
    </div>

</div>