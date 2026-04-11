@extends('frontend.institutionPortal.layout.app')

@section('page_title', 'Faculty Management')
@section('title', 'Faculty Management')

@section('content')
<div class="container-fluid p-3 p-md-5">

    <!-- ================= HEADER ================= -->
    <div class="ui-page-header d-flex justify-content-between align-items-center">
    <div class="d-flex gap-3 align-items-center">
        <div class="ui-icon-box">
            <i class="bi bi-person-badge"></i>
        </div>
        <div>
            <h5 class="mb-0">Faculty Management</h5>
            <small class="ui-muted">Manage faculty members, assignments, and performance</small>
        </div>
    </div>

    <button class="btn btn-teal"
        data-bs-toggle="modal"
        data-bs-target="#addFacultyModal">
        <i class="bi bi-person-plus me-2"></i> Add Faculty
    </button>
</div>
    <!-- ================= STATS ================= -->
    <div class="row g-3 mb-5" id="facultyStats">
    </div>

    <!-- ================= FILTERS ================= -->
    <div class="ui-card mb-4">
    <div class="row g-3 align-items-end">

        <div class="col-12 col-lg-8">
            <div class="input-group-custom">
                <i class="bi bi-search"></i>
                <input type="text" id="facultySearch" class="form-control" placeholder="Search faculty">
            </div>
        </div>

        <div class="col-md-4 col-lg-2">
            <label class="ui-label">Department</label>
            <select class="form-select" id="departmentFilter">
                <option value="">All Departments</option>
                @foreach($departments as $dept)
                <option value="{{ $dept->department_id }}">
                    {{ $dept->department_name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 col-lg-1">
            <label class="ui-label">Status</label>
            <select class="form-select" id="statusFilter">
                <option value="">All Status</option>
                <option value="1">Active</option>
                <option value="0">On Leave</option>
            </select>
        </div>

        <div class="col-md-4 col-lg-1">
            <label class="ui-label">Employment</label>
            <select class="form-select" id="employmentFilter">
                <option value="">All Types</option>
                <option value="full_time">Full-time</option>
                <option value="part_time">Part-time</option>
            </select>
        </div>

    </div>
</div>

    <!-- ================= FACULTY CARD ================= -->
    <div id="facultyList"></div>
</div>

{{-- ================= MODALS ================= --}}
@include('frontend.institutionPortal.dashboard.faculty.management.modals.create')
@include('frontend.institutionPortal.dashboard.faculty.management.modals.view')
@include('frontend.institutionPortal.dashboard.faculty.management.modals.edit')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        loadFaculty();
        loadStats();

        function renderFaculty(data) {
    let html = '';

    data.forEach(faculty => {

        let courses = '';
        if (faculty.courses) {
            faculty.courses.forEach(course => {
                courses += `<div class="ui-chip">${course.course_name}</div>`;
            });
        }

        html += `
<div class="ui-card">
    <div class="ui-card-header">
        <div class="d-flex align-items-center gap-3">
            <div class="ui-avatar">
                ${faculty.name.charAt(0)}
            </div>
            <div>
                <div class="ui-card-title">${faculty.name}</div>
                <div class="ui-card-subtitle">${faculty.designation ?? ''}</div>
                <div class="ui-muted small">${faculty.email ?? ''}</div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <span class="status-pill">
                ${faculty.employment_type ?? 'Full-time'}
            </span>

            <div class="dropdown">
                <button class="icon-btn dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>

                <ul class="dropdown-menu ui-dropdown">
                    <li><a class="dropdown-item viewFaculty" data-id="${faculty.faculty_id}">View</a></li>
                    <li><a class="dropdown-item editFaculty" data-id="${faculty.faculty_id}">Edit</a></li>
                    <li><a class="dropdown-item deleteFaculty text-danger" data-id="${faculty.faculty_id}">Delete</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="ui-meta">
        <div><strong>${faculty.experience ?? 0} yrs</strong> Experience</div>
        <div><strong>${faculty.department?.department_name ?? ''}</strong> Department</div>
        <div><strong>${faculty.courses_count}</strong> Courses</div>
    </div>

    <div class="mt-3 ui-chips">
        ${courses}
    </div>
</div>
`;
    
    });

    document.getElementById('facultyList').innerHTML = html;
}

        //  LOAD FACULTY
        function loadFaculty() {
    let search = document.getElementById('facultySearch').value;
    let department = document.getElementById('departmentFilter').value;
    let status = document.getElementById('statusFilter').value;
    let employment = document.getElementById('employmentFilter').value;

    fetch(`{{ route('institution.faculties.faculty-management.list') }}?search=${search}&department_id=${department}&status=${status}&employment_type=${employment}`)
    .then(res => res.json())
    .then(data => {
        renderFaculty(data);
    });
}

document.getElementById('facultySearch').addEventListener('keyup', loadFaculty);
document.getElementById('departmentFilter').addEventListener('change', loadFaculty);
document.getElementById('statusFilter').addEventListener('change', loadFaculty);
document.getElementById('employmentFilter').addEventListener('change', loadFaculty);
        // VIEW
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('viewFaculty')) {
                let id = e.target.dataset.id;

                fetch(`/institution/faculties/faculty-management/edit/${id}`)
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('facultyViewContent').innerHTML = `
                    <p><strong>Name:</strong> ${data.name}</p>
                    <p><strong>Email:</strong> ${data.email}</p>
                    <p><strong>Department:</strong> ${data.department?.department_name ?? ''}</p>
                    <p><strong>Experience:</strong> ${data.experience} years</p>
                `;

                        new bootstrap.Modal(document.getElementById('viewFacultyModal')).show();
                    });
            }
        });

        // EDIT
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('editFaculty')) {
                let id = e.target.dataset.id;

                fetch(`/institution/faculties/faculty-management/edit/${id}`)
.then(res => res.json())
.then(data => {

    document.getElementById('editFacultyId').value = id;
    document.getElementById('editName').value = data.name;
    document.getElementById('editEmail').value = data.email;
    document.getElementById('editPhone').value = data.phone;
    document.getElementById('editDesignation').value = data.designation;
    document.getElementById('editExperience').value = data.experience;
    document.getElementById('editEmployment').value = data.employment_type;
    document.getElementById('editDepartment').value = data.department_id;

    // Courses select
    let courseSelect = document.getElementById('editCourses');
    let courseIds = data.courses.map(c => c.course_type_id);

    for (let option of courseSelect.options) {
        option.selected = courseIds.includes(parseInt(option.value));
    }

    new bootstrap.Modal(document.getElementById('editFacultyModal')).show();
});
            }
        });

        // UPDATE
        document.getElementById('editFacultyForm').addEventListener('submit', function(e){
    e.preventDefault();

    let id = document.getElementById('editFacultyId').value;

    let formData = new FormData();
    formData.append('name', document.getElementById('editName').value);
    formData.append('email', document.getElementById('editEmail').value);
    formData.append('phone', document.getElementById('editPhone').value);
    formData.append('designation', document.getElementById('editDesignation').value);
    formData.append('experience', document.getElementById('editExperience').value);
    formData.append('employment_type', document.getElementById('editEmployment').value);
    formData.append('department_id', document.getElementById('editDepartment').value);

let selectedCourses = [];
let courseSelect = document.getElementById('editCourses');

for (let option of courseSelect.options) {
    if(option.selected){
        selectedCourses.push(option.value);
    }
}

selectedCourses.forEach(course => {
    formData.append('courses[]', course);
});
    formData.append('_token', '{{ csrf_token() }}');

    fetch(`/institution/faculties/faculty-management/update/${id}`, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.success){
            loadFaculty();
            loadStats();
            bootstrap.Modal.getInstance(document.getElementById('editFacultyModal')).hide();

            Swal.fire({
                icon: 'success',
                title: 'Faculty Updated',
                timer: 1500,
                showConfirmButton: false
            });
        }
    });
});
        // DELETE
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('deleteFaculty')) {
                let id = e.target.dataset.id;

                Swal.fire({
                    title: 'Delete Faculty?',
                    icon: 'warning',
                    showCancelButton: true
                }).then(result => {
                    if (result.isConfirmed) {
                        fetch(`/institution/faculties/faculty-management/delete/${id}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(() => loadFaculty());
                    }
                });
            }
        });

        // Stats
        function loadStats() {
            fetch("{{ route('institution.faculties.faculty-management.stats') }}")
                .then(res => res.json())
                .then(data => {

                    let html = `
<div class="col-md-3">
    <div class="ui-stats-card">
        <div class="stats-icon">
            <i class="bi bi-people"></i>
        </div>
        <div>
            <h4>${data.total}</h4>
            <small class="ui-muted">Total Faculty</small>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="ui-stats-card">
        <div class="stats-icon success">
            <i class="bi bi-person-check"></i>
        </div>
        <div>
            <h4>${data.active}</h4>
            <small class="ui-muted">Active Faculty</small>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="ui-stats-card">
        <div class="stats-icon info">
            <i class="bi bi-briefcase"></i>
        </div>
        <div>
            <h4>${data.full_time}</h4>
            <small class="ui-muted">Full Time</small>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="ui-stats-card">
        <div class="stats-icon">
            <i class="bi bi-clock"></i>
        </div>
        <div>
            <h4>${data.part_time}</h4>
            <small class="ui-muted">Part Time</small>
        </div>
    </div>
</div>
`;
  document.getElementById('facultyStats').innerHTML = html;
                });
        }
    });
</script>
@endsection