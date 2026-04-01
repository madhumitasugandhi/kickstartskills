<div id="academicStep">

    <!-- SESSION DATA -->
    <div id="academicData"
         data-session='@json($sessionData["academic"] ?? [])'>
    </div>

    <!-- HEADER -->
    <div class="mb-3">
        <div class="ui-section-title">ACADEMIC STRUCTURE</div>
        <small class="">
            Define your institution's departments and academic programs
        </small>
    </div>

    <!-- DEPARTMENTS -->
    <div class="ui-section">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <label class="ui-label mb-0">Departments</label>
            <small class="">At least one required</small>
        </div>

        <div class="d-flex gap-2 mb-3">
            <div class="ui-input-icon flex-grow-1">
                <i class="bi bi-diagram-3"></i>
                <input type="text" id="deptInput" class="form-control"
                       placeholder="e.g. Computer Science, Mechanical Eng.">
            </div>

            <button type="button" class="btn btn-primary" id="addDeptBtn">
                <i class="bi bi-plus-lg"></i>
            </button>
        </div>

        <div class="ui-chip-wrapper d-none" id="deptListWrapper">
            <small class=" d-block mb-2">Added Departments</small>
            <div class="ui-chips" id="deptList"></div>
        </div>

    </div>

    <!-- PROGRAMS -->
    <div class="ui-section">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <label class="ui-label mb-0">Academic Programs</label>
            <small class="">Minimum one</small>
        </div>

        <div class="d-flex gap-2 mb-3">
            <div class="ui-input-icon flex-grow-1">
                <i class="bi bi-journal-bookmark"></i>
                <input type="text" id="programInput" class="form-control"
                       placeholder="e.g. B.Tech, M.S., Ph.D.">
            </div>

            <button type="button" class="btn btn-info" id="addProgramBtn">
                <i class="bi bi-plus-lg"></i>
            </button>
        </div>

        <div class="ui-chip-wrapper d-none" id="programListWrapper">
            <small class=" d-block mb-2">Added Programs</small>
            <div class="ui-chips" id="programList"></div>
        </div>

    </div>

    <!-- WARNING -->
    <div class="ui-alert d-none mt-3" id="academicWarning">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <span>
            Please add at least one department and one academic program to continue
        </span>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

let initialized = false;

function initAcademicStep(){

    if(initialized) return;
    initialized = true;

    const deptInput = document.getElementById('deptInput');
    const programInput = document.getElementById('programInput');
    const deptList = document.getElementById('deptList');
    const programList = document.getElementById('programList');

    const academicSession = JSON.parse(
        document.getElementById('academicData').dataset.session || '{}'
    );

    const departmentsFromDB = @json($departments ?? []);
    const programsFromDB = @json($programs ?? []);

    function createChip(text, container) {
        const chip = document.createElement('div');
        chip.className = 'ui-chip';

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

    // SESSION restore
    if (academicSession.departments) {
        academicSession.departments.forEach(d => createChip(d, deptList));
    } else {
        departmentsFromDB.forEach(d => createChip(d, deptList));
    }

    if (academicSession.programs) {
        academicSession.programs.forEach(p => createChip(p, programList));
    } else {
        programsFromDB.forEach(p => createChip(p, programList));
    }

    document.getElementById('addDeptBtn').onclick = () => {
        if (!deptInput.value.trim()) return;
        createChip(deptInput.value.trim(), deptList);
        deptInput.value = '';
    };

    document.getElementById('addProgramBtn').onclick = () => {
        if (!programInput.value.trim()) return;
        createChip(programInput.value.trim(), programList);
        programInput.value = '';
    };
}

document.addEventListener('stepChanged', e => {
    if(e.detail.step === 1){
        initAcademicStep();
    }
});

});
</script>

