<div class="ui-card mb-4">

    <div class="ui-card-header">
        <div>
            <div class="ui-card-title">Faculty Management</div>
            <div class="ui-card-subtitle">
                {{ count($faculties) }} faculty members configured
            </div>
        </div>

        <button class="btn btn-teal btn-sm"
            data-bs-toggle="modal"
            data-bs-target="#createFacultyModal">
            <i class="bi bi-plus-lg me-1"></i>
            Add Faculty
        </button>
    </div>

    <!-- SEARCH -->
    <div class="input-group-custom mb-3">
        <i class="bi bi-search"></i>
        <input type="text"
            id="facultySearch"
            class="form-control ps-5"
            placeholder="Search faculty...">
    </div>

    <!-- FILTER CHIPS -->
    <div class="ui-chips">
        <span class="ui-chip active" data-dept="all">
            <span>All Departments</span>
        </span>

        @foreach($departments as $dept)
        <span class="ui-chip" data-dept="{{ $dept->department_id }}">
            <span>{{ $dept->department_name }}</span>
        </span>
        @endforeach
    </div>

</div>
<!-- ================= FACULTY LIST ================= -->
<div class="d-flex flex-column gap-3">

@foreach($faculties as $faculty)

<div class="ui-card faculty-card" data-department="{{ $faculty->department_id }}">

    <div class="ui-card-header">
        <div class="d-flex gap-3 align-items-center">
            <div class="ui-avatar">
                {{ strtoupper(substr($faculty->name,0,2)) }}
            </div>

            <div>
                <div class="ui-card-title">{{ $faculty->name }}</div>
                <div class="ui-card-subtitle">
                    {{ $faculty->designation }} •
                    {{ $faculty->department->department_name ?? '' }}
                </div>
            </div>
        </div>

        <div class="dropdown">
            <button class="icon-btn" data-bs-toggle="dropdown">
                <i class="bi bi-three-dots-vertical"></i>
            </button>

            <ul class="dropdown-menu dropdown-menu-end ui-dropdown">
                <li>
                    <button type="button" class="dropdown-item viewFacultyBtn"
                        data-id="{{ $faculty->faculty_id }}">
                        <i class="bi bi-eye me-2"></i> View Details
                    </button>
                </li>
                <li>
                    <button type="button" class="dropdown-item editFacultyBtn"
                        data-id="{{ $faculty->faculty_id }}"
                        data-name="{{ $faculty->name }}"
                        data-email="{{ $faculty->email }}"
                        data-phone="{{ $faculty->phone }}"
                        data-designation="{{ $faculty->designation }}"
                        data-specialization="{{ $faculty->specialization }}"
                        data-experience="{{ $faculty->experience }}"
                        data-department="{{ $faculty->department_id }}">
                        <i class="bi bi-pencil me-2"></i> Edit Faculty
                    </button>
                </li>
                <li>
                    <button class="dropdown-item deleteFacultyBtn"
                        data-id="{{ $faculty->faculty_id }}"
                        data-name="{{ $faculty->name }}">
                        <i class="bi bi-trash me-2 text-danger"></i> Delete Faculty
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <!-- META -->
    <div class="ui-meta">
        <span><i class="bi bi-clock-history"></i> {{ $faculty->experience }} yrs</span>
        <span><i class="bi bi-stars"></i> {{ $faculty->specialization }}</span>
        <span><i class="bi bi-envelope"></i> {{ $faculty->email }}</span>
        <span><i class="bi bi-telephone"></i> {{ $faculty->phone }}</span>
    </div>

    <!-- COURSES -->
    <div class="ui-chips mt-2">
        @foreach($faculty->courses as $course)
        <span class="ui-chip">
            <span>{{ $course->course_name }}</span>
        </span>
        @endforeach
    </div>

</div>

@endforeach

@if(count($faculties) == 0)
<div class="ui-preview-box text-center">
    <i class="bi bi-person" style="font-size: 2rem;"></i>
    <p class="mt-2 mb-0">No faculty added yet</p>
    <small>Add faculty to start assigning courses</small>
</div>
@endif

</div>

<div class="modal fade" id="createFacultyModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content ui-modal">

            <form action="{{ route('institution.core.academic-structure.faculty.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Add Faculty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">

                        <!-- Department -->
                        <div class="col-md-6">
                            <label class="form-label-custom">Department</label>
                            <div class="input-group-custom">
                                <i class="bi bi-building"></i>
                                <select name="department_id" class="form-select ps-5" required>
                                    <option value="">Select Department</option>
                                    @foreach($departments as $dept)
                                    <option value="{{ $dept->department_id }}">{{ $dept->department_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Faculty Name -->
                        <div class="col-md-6">
                            <label class="form-label-custom">Faculty Name</label>
                            <div class="input-group-custom">
                                <i class="bi bi-person"></i>
                                <input type="text" name="name" class="form-control ps-5" required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label class="form-label-custom">Email</label>
                            <div class="input-group-custom">
                                <i class="bi bi-envelope"></i>
                                <input type="email" name="email" class="form-control ps-5">
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <label class="form-label-custom">Phone</label>
                            <div class="input-group-custom">
                                <i class="bi bi-telephone"></i>
                                <input type="text" name="phone" class="form-control ps-5">
                            </div>
                        </div>

                        <!-- Designation -->
                        <div class="col-md-6">
                            <label class="form-label-custom">Designation</label>
                            <div class="input-group-custom">
                                <i class="bi bi-award"></i>
                                <input type="text" name="designation" class="form-control ps-5">
                            </div>
                        </div>

                        <!-- Specialization -->
                        <div class="col-md-6">
                            <label class="form-label-custom">Specialization</label>
                            <div class="input-group-custom">
                                <i class="bi bi-stars"></i>
                                <input type="text" name="specialization" class="form-control ps-5">
                            </div>
                        </div>

                        <!-- Experience -->
                        <div class="col-md-6">
                            <label class="form-label-custom">Experience</label>
                            <div class="input-group-custom">
                                <i class="bi bi-clock-history"></i>
                                <input type="number" name="experience" class="form-control ps-5">
                            </div>
                        </div>

                    </div>

                    <!-- ================= COURSES CHECKBOX ================= -->
                    <div class="mt-4">
                        <label class="form-label-custom">Teaching Courses</label>

                        <div class="ui-modal p-3" style="max-height:150px; overflow-y:auto;">
                            <div class="row">
                                @foreach($courseTypes as $ct)
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input course-checkbox"
                                            type="checkbox"
                                            name="courses[]"
                                            value="{{ $ct->course_type_id }}"
                                            data-name="{{ $ct->course_name }}">
                                        <label class="form-check-label">
                                            {{ $ct->course_name }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Selected Courses Chips -->
                        <div class="ui-chips mt-2" id="selectedCourses"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-teal">
                        Save Faculty
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- ================= EDIT FACULTY MODAL ================= -->
<div class="modal fade" id="editFacultyModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content ui-modal">

            <form id="editFacultyForm" method="POST">
                @csrf
                @method('POST')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Faculty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label-custom">Faculty Name</label>
                            <div class="input-group-custom">
                                <i class="bi bi-person"></i>
                                <input type="text" name="name" id="edit_name" class="form-control ps-5">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Email</label>
                            <div class="input-group-custom">
                                <i class="bi bi-envelope"></i>
                                <input type="email" name="email" id="edit_email" class="form-control ps-5">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Phone</label>
                            <div class="input-group-custom">
                                <i class="bi bi-telephone"></i>
                                <input type="text" name="phone" id="edit_phone" class="form-control ps-5">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Designation</label>
                            <div class="input-group-custom">
                                <i class="bi bi-award"></i>
                                <input type="text" name="designation" id="edit_designation" class="form-control ps-5">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Department</label>
                            <div class="input-group-custom">
                                <i class="bi bi-building"></i>
                                <select name="department_id" id="edit_department" class="form-select ps-5">
                                    @foreach($departments as $dept)
                                    <option value="{{ $dept->department_id }}">{{ $dept->department_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <label class="form-label-custom">Teaching Courses</label>

                            <div class="ui-modal p-3" style="max-height:150px; overflow-y:auto;">
                                <div class="row">
                                    @foreach($courseTypes as $ct)
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input edit-course-checkbox"
                                                type="checkbox"
                                                value="{{ $ct->course_type_id }}"
                                                name="courses[]"
                                                id="editCourse{{ $ct->course_type_id }}"
                                                data-name="{{ $ct->course_name }}">
                                            <label class="form-check-label">
                                                {{ $ct->course_name }}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="ui-chips mt-2" id="editSelectedCourses"></div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Specialization</label>
                            <div class="input-group-custom">
                                <i class="bi bi-stars"></i>
                                <input type="text" name="specialization" id="edit_specialization" class="form-control ps-5">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Experience</label>
                            <div class="input-group-custom">
                                <i class="bi bi-clock-history"></i>
                                <input type="number" name="experience" id="edit_experience" class="form-control ps-5">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-teal">
                        Update Faculty
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
<!-- ================= VIEW FACULTY MODAL ================= -->
<div class="modal fade" id="viewFacultyModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content ui-modal">

            <div class="modal-header">
                <h5 class="modal-title">Faculty Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <h5 id="view_name" class="fw-semibold mb-3"></h5>

                <div class="row mb-2">
                    <div class="col-md-4"><strong>Department:</strong></div>
                    <div class="col-md-8" id="view_department"></div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4"><strong>Courses:</strong></div>
                    <div class="col-md-8">
                        <div class="ui-chips " id="view_courses"></div>
                    </div>
                </div>


                <div class="row mb-2">
                    <div class="col-md-4"><strong>Email:</strong></div>
                    <div class="col-md-8" id="view_email"></div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4"><strong>Phone:</strong></div>
                    <div class="col-md-8" id="view_phone"></div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4"><strong>Designation:</strong></div>
                    <div class="col-md-8" id="view_designation"></div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4"><strong>Specialization:</strong></div>
                    <div class="col-md-8" id="view_specialization"></div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4"><strong>Experience:</strong></div>
                    <div class="col-md-8" id="view_experience"></div>
                </div>

            </div>

        </div>
    </div>
</div>

<script>
/* ================= FILTER ================= */
document.querySelectorAll('.ui-chip[data-dept]').forEach(chip => {
    chip.addEventListener('click', function() {

        document.querySelectorAll('.ui-chip[data-dept]').forEach(c => c.classList.remove('active'));
        this.classList.add('active');

        let dept = this.dataset.dept;
        let cards = document.querySelectorAll('.faculty-card');

        cards.forEach(card => {
            if (dept === 'all') {
                card.style.display = 'block';
            } else {
                card.style.display =
                    card.dataset.department == dept ? 'block' : 'none';
            }
        });
    });
});

/* ================= SEARCH ================= */
document.getElementById('facultySearch').addEventListener('keyup', function() {
    let value = this.value.toLowerCase();

    document.querySelectorAll('.faculty-card').forEach(card => {
        let text = card.innerText.toLowerCase();
        card.style.display = text.includes(value) ? 'block' : 'none';
    });
});

/* ================= GLOBAL CLICK EVENTS ================= */
document.addEventListener('click', function(e) {

    let editBtn = e.target.closest('.editFacultyBtn');
    let viewBtn = e.target.closest('.viewFacultyBtn');
    let deleteBtn = e.target.closest('.deleteFacultyBtn');

    /* EDIT */
    if (editBtn) {
        let id = editBtn.dataset.id;

        document.getElementById('edit_name').value = editBtn.dataset.name;
        document.getElementById('edit_email').value = editBtn.dataset.email;
        document.getElementById('edit_phone').value = editBtn.dataset.phone;
        document.getElementById('edit_designation').value = editBtn.dataset.designation;
        document.getElementById('edit_specialization').value = editBtn.dataset.specialization;
        document.getElementById('edit_experience').value = editBtn.dataset.experience;
        document.getElementById('edit_department').value = editBtn.dataset.department;

        document.getElementById('editFacultyForm').action =
            "/institution/core-management/academic-structure/faculty/update/" + id;

        fetch("/institution/core-management/academic-structure/faculty/edit/" + id)
            .then(res => res.json())
            .then(data => {
                document.querySelectorAll('.edit-course-checkbox').forEach(cb => cb.checked = false);

                if (data.courses) {
                    data.courses.forEach(course => {
                        let checkbox = document.querySelector('#editCourse' + course.course_type_id);
                        if (checkbox) checkbox.checked = true;
                    });
                }
            });

        new bootstrap.Modal(document.getElementById('editFacultyModal')).show();
    }

    /* VIEW */
    if (viewBtn) {
        let id = viewBtn.dataset.id;

        fetch("/institution/core-management/academic-structure/faculty/edit/" + id)
            .then(res => res.json())
            .then(data => {

                document.getElementById('view_name').innerText = data.name ?? '';
                document.getElementById('view_email').innerText = data.email ?? '';
                document.getElementById('view_phone').innerText = data.phone ?? '';
                document.getElementById('view_designation').innerText = data.designation ?? '';
                document.getElementById('view_specialization').innerText = data.specialization ?? '';
                document.getElementById('view_experience').innerText = data.experience ?? '';

                if (data.department) {
                    document.getElementById('view_department').innerText =
                        data.department.department_name;
                }

                let container = document.getElementById('view_courses');
                container.innerHTML = '';

                if (data.courses && data.courses.length) {
                    data.courses.forEach(course => {
                        container.innerHTML +=
                            '<span class="ui-chip"><span>' + course.course_name + '</span></span>';
                    });
                } else {
                    container.innerHTML = '<span class="text-muted">No courses</span>';
                }

                new bootstrap.Modal(document.getElementById('viewFacultyModal')).show();
            });
    }

    /* DELETE */
    if (deleteBtn) {
        let id = deleteBtn.dataset.id;
        let name = deleteBtn.dataset.name;

        Swal.fire({
            title: "Delete Faculty?",
            text: "You are about to delete " + name,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, Delete"
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = "/institution/core-management/academic-structure/faculty/delete/" + id;

                let csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';

                let method = document.createElement('input');
                method.type = 'hidden';
                method.name = '_method';
                method.value = 'DELETE';

                form.appendChild(csrf);
                form.appendChild(method);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

});

/* ================= COURSE CHIP PREVIEW ================= */
document.querySelectorAll('.course-checkbox').forEach(cb => {
    cb.addEventListener('change', function() {
        let container = document.getElementById('selectedCourses');
        container.innerHTML = '';

        document.querySelectorAll('.course-checkbox:checked').forEach(c => {
            let chip = document.createElement('span');
            chip.className = 'ui-chip';
            chip.innerHTML = '<span>' + c.dataset.name + '</span>';
            container.appendChild(chip);
        });
    });
});
</script>