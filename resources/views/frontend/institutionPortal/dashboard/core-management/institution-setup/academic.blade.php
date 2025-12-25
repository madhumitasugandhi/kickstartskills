<div class="setup-step" id="academicStep">

    <!-- ================= HEADER ================= -->
    <div class="mb-4">
        <h6 class="section-title-custom mb-1">Academic Structure</h6>
        <p class="small">
            Define your institution's departments and academic programs
        </p>
    </div>

    <!-- ================= DEPARTMENTS ================= -->
    <div class="form-section">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <label class="form-label-custom mb-0">Departments</label>
            <span class="small">At least one required</span>
        </div>

        <div class="d-flex gap-2 mb-3">
            <div class="input-group-custom flex-grow-1">
                <i class="bi bi-diagram-3"></i>
                <input type="text"
                       id="deptInput"
                       class="form-control ps-5"
                       placeholder="e.g. Computer Science, Mechanical Eng.">
            </div>

            <button class="btn btn-success d-flex align-items-center justify-content-center"
                    id="addDeptBtn"
                    style="width: 48px; background-color: var(--primary-teal); border: none;">
                <i class="bi bi-plus-lg text-white"></i>
            </button>
        </div>

        <div class="added-box d-none" id="deptListWrapper">
            <small class="fw-medium d-block mb-2">
                Added Departments
            </small>
            <div class="chip-container" id="deptList"></div>
        </div>

    </div>

    <!-- ================= DIVIDER ================= -->
    <div class="text-center my-4">
        <span class="badge rounded-pill px-3 py-1"
              style="background: rgba(255,255,255,0.05); border: 1px solid var(--border-color);">
            Programs
        </span>
    </div>

    <!-- ================= PROGRAMS ================= -->
    <div class="form-section">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <label class="form-label-custom mb-0">Academic Programs</label>
            <span class="small">Minimum one</span>
        </div>

        <div class="d-flex gap-2 mb-3">
            <div class="input-group-custom flex-grow-1">
                <i class="bi bi-journal-bookmark"></i>
                <input type="text"
                       id="programInput"
                       class="form-control ps-5"
                       placeholder="e.g. B.Tech, M.S., Ph.D.">
            </div>

            <button class="btn d-flex align-items-center justify-content-center"
                    id="addProgramBtn"
                    style="width: 48px; background-color: #3b82f6; border: none;">
                <i class="bi bi-plus-lg text-white"></i>
            </button>
        </div>

        <div class="added-box d-none" id="programListWrapper">
            <small class="fw-medium d-block mb-2">
                Added Programs
            </small>
            <div class="chip-container" id="programList"></div>
        </div>

    </div>

    <!-- ================= WARNING ================= -->
    <div class="academic-warning d-none mt-3" id="academicWarning">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <span>
            Please add at least one department and one academic program to continue
        </span>
    </div>

</div>
