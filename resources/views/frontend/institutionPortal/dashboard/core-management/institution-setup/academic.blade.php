<div class="setup-step" id="academicStep">

    <!-- SESSION DATA -->
    <div id="academicData"
     data-session='@json($sessionData["academic"] ?? [])'>
</div>
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
                <input type="text" id="deptInput" class="form-control ps-5"
                       placeholder="e.g. Computer Science, Mechanical Eng.">
            </div>

            <button type="button" class="btn btn-success"
                    id="addDeptBtn"
                    style="width: 48px; background-color: var(--primary-teal); border: none;">
                <i class="bi bi-plus-lg text-white"></i>
            </button>
        </div>

        <div class="added-box d-none" id="deptListWrapper">
            <small class="fw-medium d-block mb-2">Added Departments</small>
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
                <input type="text" id="programInput" class="form-control ps-5"
                       placeholder="e.g. B.Tech, M.S., Ph.D.">
            </div>

            <button type="button" class="btn"
                    id="addProgramBtn"
                    style="width: 48px; background-color: #3b82f6; border: none;">
                <i class="bi bi-plus-lg text-white"></i>
            </button>
        </div>

        <div class="added-box d-none" id="programListWrapper">
            <small class="fw-medium d-block mb-2">Added Programs</small>
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

<!-- ================= JS ================= -->
<script>
document.addEventListener('DOMContentLoaded', () => {

    const deptInput = document.getElementById('deptInput');
    const programInput = document.getElementById('programInput');
    const deptList = document.getElementById('deptList');
    const programList = document.getElementById('programList');
    const deptWrapper = document.getElementById('deptListWrapper');
    const programWrapper = document.getElementById('programListWrapper');
    const academicSession = JSON.parse(
    document.getElementById('academicData').dataset.session
);

    // ================= CREATE CHIP =================
    function createChip(text, container) {

        const chip = document.createElement('div');
        chip.className = 'chip-item';

        chip.innerHTML = `
            <span>${text}</span>
            <button type="button">&times;</button>
        `;

        chip.querySelector('button').addEventListener('click', () => {
            chip.remove();
        });

        container.appendChild(chip);
        container.parentElement.classList.remove('d-none');
    }

    // ================= RESTORE SESSION =================
    if (academicSession.departments) {
        academicSession.departments.forEach(dept => {
            createChip(dept, deptList);
        });
    }

    if (academicSession.programs) {
        academicSession.programs.forEach(program => {
            createChip(program, programList);
        });
    }

    // ================= ADD EVENTS =================
    document.getElementById('addDeptBtn').addEventListener('click', () => {
        if (!deptInput.value.trim()) return;
        createChip(deptInput.value.trim(), deptList);
        deptInput.value = '';
    });

    document.getElementById('addProgramBtn').addEventListener('click', () => {
        if (!programInput.value.trim()) return;
        createChip(programInput.value.trim(), programList);
        programInput.value = '';
    });

});

// ================= SAVE FUNCTION =================
async function saveAcademicStep(){

    const departments = [...document.querySelectorAll('#deptList span')]
        .map(el => el.innerText);

    const programs = [...document.querySelectorAll('#programList span')]
        .map(el => el.innerText);

    await fetch('/institution/setup/save-step',{
        method:'POST',
        headers:{
            'Content-Type':'application/json',
            'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            step:'academic',
            data:{ departments, programs }
        })
    });

}
</script>