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
    loadStats();


    // CREATE PROGRAM
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
                alert('Program Created');
                form.reset();
                loadPrograms();
                bootstrap.Modal.getInstance(document.getElementById('createProgramModal')).hide();
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

            let createSelect = document.getElementById('dept');
            let filterSelect = document.getElementById('departmentFilter');

            if(createSelect){
                createSelect.innerHTML = '<option value="">Select Department</option>';
                data.forEach(dept => {
                    createSelect.innerHTML += `<option value="${dept.department_id}">
                        ${dept.department_name}
                    </option>`;
                });
            }

            if(filterSelect){
                filterSelect.innerHTML = '<option value="">All Departments</option>';
                data.forEach(dept => {
                    filterSelect.innerHTML += `<option value="${dept.department_id}">
                        ${dept.department_name}
                    </option>`;
                });
            }

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
            let count = document.getElementById('programCount');

            container.innerHTML = '';
            count.innerText = data.length;

            data.forEach(program => {

                let card = `
                <div class="course-type-card program-card"
                     data-name="${program.name.toLowerCase()}"
                     data-department="${program.department_id}"
                     data-status="${program.status ? 1 : 0}">

                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h6 class="fw-semibold mb-1">${program.name}</h6>
                            <small>${program.department?.department_name ?? ''} • ${program.duration}</small>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <span class="status-pill ${program.status ? 'active' : 'inactive'}">
                                ${program.status ? 'Active' : 'Inactive'}
                            </span>

                            <div class="student-actions">
                                <button class="icon-btn kebab-toggle">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>

                                <ul class="kebab-menu">
                                    <li onclick="viewProgram(${program.id})">
                                        <i class="bi bi-eye"></i> View
                                    </li>
                                    <li onclick="editProgram(${program.id})">
                                        <i class="bi bi-pencil"></i> Edit
                                    </li>
                                     <li onclick="toggleStatus(${program.id}, ${program.status ? 1 : 0})">
        <i class="bi bi-toggle-on"></i>
        ${program.status ? 'Set Inactive' : 'Set Active'}
    </li>
                                    <li class="danger" onclick="deleteProgram(${program.id})">
                                        <i class="bi bi-trash"></i> Delete
                                    </li>
                                </ul>
                            </div>
                        </div>
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

            attachKebab();
            initFilters();
        });
}

/* =============================
   KEBAB MENU
============================= */
function attachKebab(){
    document.querySelectorAll('.kebab-toggle').forEach(btn => {
        btn.addEventListener('click', function(e){
            e.stopPropagation();
            this.nextElementSibling.classList.toggle('show');
        });
    });

    document.addEventListener('click', function(){
        document.querySelectorAll('.kebab-menu').forEach(menu=>{
            menu.classList.remove('show');
        });
    });
}

/* =============================
   FILTERS
============================= */
function initFilters(){

    const searchInput = document.getElementById("programSearch");
    const departmentFilter = document.getElementById("departmentFilter");
    const statusFilter = document.getElementById("statusFilter");

    function filterPrograms(){

        let search = searchInput.value.toLowerCase();
        let dept = departmentFilter.value;
        let status = statusFilter.value;

        document.querySelectorAll(".program-card").forEach(card => {

            let name = card.dataset.name;
            let department = card.dataset.department;
            let cardStatus = card.dataset.status;

            let show = true;

            if(search && !name.includes(search)) show = false;
            if(dept && dept != department) show = false;
            if(status && status != cardStatus) show = false;

            card.style.display = show ? "block" : "none";
        });
    }

    searchInput.addEventListener("keyup", filterPrograms);
    departmentFilter.addEventListener("change", filterPrograms);
    statusFilter.addEventListener("change", filterPrograms);
}

/* =============================
   VIEW PROGRAM
============================= */
function viewProgram(id){
    fetch(`/institution/electives/program-management/edit/${id}`)
    .then(res=>res.json())
    .then(data=>{
        document.getElementById('view_program_name').innerText = data.name;
        document.getElementById('view_department').innerText = data.department?.department_name ?? '';
        document.getElementById('view_duration').innerText = data.duration;
        document.getElementById('view_fees').innerText = '₹'+data.fees;
        document.getElementById('view_description').innerText = data.description;

        new bootstrap.Modal(document.getElementById('viewProgramModal')).show();
    });
}

/* =============================
   EDIT PROGRAM
============================= */
function editProgram(id){
    fetch(`/institution/electives/program-management/edit/${id}`)
    .then(res=>res.json())
    .then(data=>{

        document.getElementById('edit_program_id').value = data.id;
        document.getElementById('edit_program_name').value = data.name;
        document.getElementById('edit_duration').value = data.duration;
        document.getElementById('edit_fees').value = data.fees;
        document.getElementById('edit_description').value = data.description;

        // Load departments in edit dropdown
        fetch('/institution/electives/program-management/departments')
        .then(res=>res.json())
        .then(depts=>{
            let select = document.getElementById('edit_department_id');
            select.innerHTML = '';

            depts.forEach(d=>{
                select.innerHTML += `<option value="${d.department_id}">
                                        ${d.department_name}
                                     </option>`;
            });

            select.value = data.department_id;
        });

        new bootstrap.Modal(document.getElementById('editProgramModal')).show();
    });
}

/* =============================
   DELETE PROGRAM (SweetAlert)
============================= */
function deleteProgram(id){

    Swal.fire({
        title: 'Delete Program?',
        text: "This cannot be undone",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0d9488',
        cancelButtonColor: '#ef4444',
        confirmButtonText: 'Yes Delete'
    }).then((result) => {
        if(result.isConfirmed){

            fetch(`/institution/electives/program-management/delete/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(res=>res.json())
            .then(data=>{
                loadPrograms();

                Swal.fire(
                    'Deleted!',
                    'Program deleted successfully',
                    'success'
                );
            });
        }
    });

}

//submit
document.addEventListener('submit', function(e){

if(e.target && e.target.id === 'editProgramForm'){
    e.preventDefault();

    let id = document.getElementById('edit_program_id').value;

    let formData = new FormData();
    formData.append('name', document.getElementById('edit_program_name').value);
    formData.append('department_id', document.getElementById('edit_department_id').value);
    formData.append('duration', document.getElementById('edit_duration').value);
    formData.append('fees', document.getElementById('edit_fees').value);
    formData.append('description', document.getElementById('edit_description').value);

    fetch(`/institution/electives/program-management/update/${id}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        loadPrograms();
        bootstrap.Modal.getInstance(document.getElementById('editProgramModal')).hide();
        Swal.fire('Updated!', 'Program updated successfully', 'success');
    });
}

});

function loadStats(){
    fetch('/institution/electives/program-management/stats')
    .then(res => res.json())
    .then(data => {
        document.getElementById('totalPrograms').innerText = data.total;
        document.getElementById('activePrograms').innerText = data.active;
        if(document.getElementById('inactivePrograms')){
            document.getElementById('inactivePrograms').innerText = data.inactive;
        }
    });
}

// status toggle
function toggleStatus(id, currentStatus){

fetch('/institution/electives/program-management/status', {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({ id: id })
})
.then(res => res.json())
.then(data => {
    loadPrograms();
    loadStats();

    Swal.fire(
        'Updated!',
        'Program status updated',
        'success'
    );
});
}
</script>