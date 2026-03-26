<script>
function openCreateProgram() {
    showModal('createProgramModal');
}

function openEditProgram(id) {
    // later: fetch program data via AJAX
    showModal('editProgramModal');
}

function openViewProgram(id) {
    showModal('viewProgramModal');
}

function showModal(id) {
    document.getElementById(id).classList.remove('hidden');
}

function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}


document.addEventListener("DOMContentLoaded", function () {

    loadDepartments();
    loadPrograms();

    // Use document listener because modal loads dynamically
    document.addEventListener('submit', function(e){

        if(e.target && e.target.id === 'createProgramForm'){
            e.preventDefault();

            let form = e.target;
            let formData = new FormData(form);

            fetch('/institution/electives/program-management/store', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                console.log(data);

                alert('Program Created');

                form.reset();
                loadPrograms();

                let modal = bootstrap.Modal.getInstance(document.getElementById('createProgramModal'));
                modal.hide();
            });
        }

    });

});

/* =============================
   LOAD DEPARTMENTS
============================= */
function loadDepartments() {
    fetch('/institution/electives/program-management/departments')
        .then(res => res.json())
        .then(data => {

            let select = document.getElementById('dept');
            if(!select) return;

            select.innerHTML = '<option value="" disabled selected>Select Department</option>';

            data.forEach(dept => {
                select.innerHTML += `<option value="${dept.department_id}">${dept.department_name}</option>`;
            });
        });
}

/* =============================
   LOAD PROGRAMS
============================= */
function loadPrograms() {
    fetch('/institution/electives/program-management/list')
        .then(res => res.json())
        .then(data => {

            let container = document.getElementById('programsContainer');
            if(!container) return;

            container.innerHTML = '';

            data.forEach(program => {

                let card = `
                <div class="course-type-card">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h6 class="fw-semibold mb-1">${program.name}</h6>
                            <small>${program.department?.department_name ?? ''} • ${program.duration}</small>
                        </div>
                        <span class="status-pill ${program.status ? 'active' : 'inactive'}">
                            ${program.status ? 'Active' : 'Inactive'}
                        </span>
                    </div>

                    <p class="small mb-3">${program.description ?? ''}</p>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <small>Fees</small>
                            <strong>₹${program.fees ?? 0}</strong>
                        </div>
                        <div class="col-md-3">
                            <small>Duration</small>
                            <strong>${program.duration}</strong>
                        </div>
                    </div>
                </div>
                `;

                container.innerHTML += card;
            });

        });
}
</script>