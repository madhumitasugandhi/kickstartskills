<div class="glass-card mb-4">

    <!-- ================= SEARCH & FILTER ================= -->
    <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap">

        <div class="input-group-custom flex-grow-1">
            <i class="bi bi-search"></i>
            <input type="text"
       id="programSearch"
       class="form-control ps-5"
       placeholder="Search programs...">
        </div>

        <button class="btn btn-teal btn-sm" data-bs-toggle="modal" data-bs-target="#createProgramModal">
            <i class="bi bi-plus-lg me-1"></i>
            Create Program
        </button>
    </div>

    <!-- FILTER CHIPS -->
    <div class="chip-container mt-3">
    <span class="chip-item accreditation-chip active" data-dept="all">
        <span>All Departments</span>
    </span>

    @foreach($departments as $dept)
        <span class="chip-item accreditation-chip" data-dept="{{ $dept->department_id }}">
            <span>{{ $dept->department_name }}</span>
        </span>
    @endforeach
</div>

</div>

<!-- ================= PROGRAM LIST ================= -->
<div class="d-flex flex-column gap-3">

    @foreach($programs as $program)

    @php
    $students = 0;
    $percent = $program->max_intake > 0 ? round(($students / $program->max_intake) * 100, 1) : 0;
    @endphp

<div class="configured-item p-4" data-department="{{ $program->department_id }}">
        <div class="d-flex justify-content-between align-items-start mb-3">

            <div class="d-flex gap-3">
                <div class="stat-icon info">
                    <i class="bi bi-book"></i>
                </div>

                <div>
                    <h6 class="mb-1">{{ $program->program_name }}</h6>
                    <small>
                        {{ $program->department->department_name ?? '' }} •
                        {{ $program->duration }} •
                        {{ $program->educationType->education_type_name ?? '' }}
                    </small></br>
                    <small>Coordinator : {{ $program->coordinator }}</small>
                </div>
            </div>

            <div class="dropdown">
                <button class="icon-btn" data-bs-toggle="dropdown">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end custom-dropdown">
                    <li>
                        <button class="dropdown-item viewProgramBtn"
                            data-id="{{ $program->program_id }}">
                            <i class="bi bi-eye me-2"></i> View Details
                        </button>
                    </li>

                    <li>
                        <button class="dropdown-item editProgramBtn"
                            data-id="{{ $program->program_id }}"
                            data-name="{{ $program->program_name }}"
                            data-coordinator="{{ $program->coordinator }}"
                            data-duration="{{ $program->duration }}"
                            data-semesters="{{ $program->semesters }}"
                            data-intake="{{ $program->max_intake }}"
                            data-department="{{ $program->department_id }}"
                            data-education="{{ $program->education_type_id }}">
                            <i class="bi bi-pencil me-2"></i> Edit Program
                        </button>
                    </li>

                    <li>
                        <button class="dropdown-item deleteProgramBtn"
                            data-id="{{ $program->program_id }}"
                            data-name="{{ $program->program_name }}">
                            <i class="bi bi-trash me-2 text-danger"></i> Delete Program
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <div class="meta-row mb-2">
            <span><i class="bi bi-person-plus"></i> Max Intake {{ $program->max_intake }}</span>
            <span><i class="bi bi-stack"></i> Semesters {{ $program->semesters }}</span>
        </div>

        <div class="progress-track">
            <div class="progress-fill"
                style="width: {{ min($percent, 100) }}%"></div>
        </div>

    </div>

    @endforeach

</div>

<!-- ================= CREATE PROGRAM MODAL ================= -->
<div class="modal fade" id="createProgramModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content glass-card">

            <form action="{{ route('institution.core.academic-structure.programs.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Create Program</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="form-section">
                        <div class="row g-3">

                            <!-- Department -->
                            <div class="col-md-6">
                                <label class="form-label-custom">Department</label>
                                <div class="input-group-custom">
                                    <i class="bi bi-building"></i>
                                    <select name="department_id" class="form-select ps-5" required>
                                        <option value="">Select Department</option>
                                        @foreach($departments as $dept)
                                        <option value="{{ $dept->department_id }}">
                                            {{ $dept->department_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Education Type -->
                            <div class="col-md-6">
                                <label class="form-label-custom">Education Type</label>
                                <div class="input-group-custom">
                                    <i class="bi bi-mortarboard"></i>
                                    <select name="education_type_id" class="form-select ps-5" required>
                                        <option value="">Select Education Type</option>
                                        @foreach($educationTypes as $type)
                                        <option value="{{ $type->id }}">
                                            {{ $type->education_type_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Program Name -->
                            <div class="col-md-6">
                                <label class="form-label-custom">Program Name</label>
                                <div class="input-group-custom">
                                    <i class="bi bi-book"></i>
                                    <input type="text" name="program_name" class="form-control ps-5" required>
                                </div>
                            </div>

                            <!-- Coordinator -->
                            <div class="col-md-6">
                                <label class="form-label-custom">Coordinator</label>
                                <div class="input-group-custom">
                                    <i class="bi bi-person"></i>
                                    <input type="text" name="coordinator" class="form-control ps-5">
                                </div>
                            </div>

                            <!-- Duration -->
                            <div class="col-md-4">
                                <label class="form-label-custom">Duration</label>
                                <div class="input-group-custom">
                                    <i class="bi bi-clock"></i>
                                    <input type="text" name="duration" class="form-control ps-5" placeholder="4 Years">
                                </div>
                            </div>

                            <!-- Semesters -->
                            <div class="col-md-4">
                                <label class="form-label-custom">Semesters</label>
                                <div class="input-group-custom">
                                    <i class="bi bi-stack"></i>
                                    <input type="number" name="semesters" class="form-control ps-5">
                                </div>
                            </div>

                            <!-- Max Intake -->
                            <div class="col-md-4">
                                <label class="form-label-custom">Max Intake</label>
                                <div class="input-group-custom">
                                    <i class="bi bi-people"></i>
                                    <input type="number" name="max_intake" class="form-control ps-5">
                                </div>
                            </div>

                            <!-- Description -->
                            <!-- <div class="col-md-12">
                                <label class="form-label-custom">Description</label>
                                <div class="input-group-custom">
                                    <i class="bi bi-card-text"></i>
                                    <textarea name="description" class="form-control ps-5" rows="2"></textarea>
                                </div>
                            </div> -->

                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-teal">
                        Create Program
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- ================= EDIT PROGRAM MODAL ================= -->
<div class="modal fade" id="editProgramModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content glass-card">

            <form id="editProgramForm" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Edit Program</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label-custom">Program Name</label>
                            <div class="input-group-custom">
                                <i class="bi bi-book"></i>
                                <input type="text" name="program_name" id="edit_program_name" class="form-control ps-5">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Department</label>
                            <div class="input-group-custom">
                                <i class="bi bi-building"></i>
                                <select name="department_id" id="edit_department" class="form-select ps-5">
                                    @foreach($departments as $dept)
                                    <option value="{{ $dept->department_id }}">
                                        {{ $dept->department_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Education Type</label>
                            <div class="input-group-custom">
                                <i class="bi bi-mortarboard"></i>
                                <select name="education_type_id" id="edit_education_type" class="form-select ps-5">
                                    @foreach($educationTypes as $type)
                                    <option value="{{ $type->id }}">
                                        {{ $type->education_type_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Coordinator</label>
                            <div class="input-group-custom">
                                <i class="bi bi-person"></i>
                                <input type="text" name="coordinator" id="edit_coordinator" class="form-control ps-5">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label-custom">Duration</label>
                            <div class="input-group-custom">
                                <i class="bi bi-clock"></i>
                                <input type="text" name="duration" id="edit_duration" class="form-control ps-5">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label-custom">Semesters</label>
                            <div class="input-group-custom">
                                <i class="bi bi-stack"></i>
                                <input type="number" name="semesters" id="edit_semesters" class="form-control ps-5">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label-custom">Max Intake</label>
                            <div class="input-group-custom">
                                <i class="bi bi-people"></i>
                                <input type="number" name="max_intake" id="edit_intake" class="form-control ps-5">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-teal">
                        Update Program
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- ================= VIEW PROGRAM MODAL ================= -->
<div class="modal fade" id="viewProgramModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content glass-card">

            <div class="modal-header">
                <h5 class="modal-title">Program Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <h5 id="view_title" class="fw-semibold mb-3"></h5>

                <div class="row mb-3">
                    <div class="col-md-4"><strong>Department:</strong></div>
                    <div class="col-md-8" id="view_department"></div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4"><strong>Education Type:</strong></div>
                    <div class="col-md-8" id="view_education"></div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4"><strong>Duration:</strong></div>
                    <div class="col-md-8" id="view_duration"></div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4"><strong>Coordinator:</strong></div>
                    <div class="col-md-8" id="view_coordinator"></div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4"><strong>Semesters:</strong></div>
                    <div class="col-md-8" id="view_semesters"></div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4"><strong>Max Intake:</strong></div>
                    <div class="col-md-8" id="view_intake"></div>
                </div>

            </div>

        </div>
    </div>
</div>

<script>
    // ================= EDIT  =================
    document.querySelectorAll('.editProgramBtn').forEach(button => {
        button.addEventListener('click', function() {

            let id = this.dataset.id;

            document.getElementById('edit_program_name').value = this.dataset.name;
            document.getElementById('edit_coordinator').value = this.dataset.coordinator;
            document.getElementById('edit_duration').value = this.dataset.duration;
            document.getElementById('edit_semesters').value = this.dataset.semesters;
            document.getElementById('edit_intake').value = this.dataset.intake;
            document.getElementById('edit_department').value = this.dataset.department;
            document.getElementById('edit_education_type').value = this.dataset.education;

            document.getElementById('editProgramForm').action =
                "/institution/core-management/academic-structure/programs/update/" + id;

            new bootstrap.Modal(document.getElementById('editProgramModal')).show();
        });
    });

    // ================= VIEW  =================
    document.querySelectorAll('.viewProgramBtn').forEach(button => {
        button.addEventListener('click', function() {

            let id = this.dataset.id;

            fetch(`/institution/core-management/academic-structure/programs/edit/${id}`)
                .then(res => res.json())
                .then(data => {

                    document.getElementById('view_title').innerText = data.program_name;
                    document.getElementById('view_department').innerText = data.department.department_name;
                    document.getElementById('view_education').innerText = data.education_type.education_type_name;
                    document.getElementById('view_duration').innerText = data.duration;
                    document.getElementById('view_coordinator').innerText = data.coordinator;
                    document.getElementById('view_semesters').innerText = data.semesters;
                    document.getElementById('view_intake').innerText = data.max_intake;

                    new bootstrap.Modal(document.getElementById('viewProgramModal')).show();
                });
        });
    });

    // ================= DELETE  =================

document.querySelectorAll('.deleteProgramBtn').forEach(button => {
    button.addEventListener('click', function() {

        let id = this.dataset.id;
        let name = this.dataset.name;

        Swal.fire({
            title: "Delete Program?",
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
                form.action = "/institution/core-management/academic-structure/programs/delete/" + id;

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
    });
});

document.querySelectorAll('.chip-item').forEach(chip => {
    chip.addEventListener('click', function() {

        document.querySelectorAll('.chip-item').forEach(c => c.classList.remove('active'));
        this.classList.add('active');

        let dept = this.dataset.dept;
        let cards = document.querySelectorAll('.configured-item');

        cards.forEach(card => {
            if (dept === 'all') {
                card.style.display = 'block';
            } else {
                if (card.dataset.department == dept) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            }
        });
    });
});

// ================= SEARCH  =================

document.getElementById('programSearch').addEventListener('keyup', function() {
    let value = this.value.toLowerCase();

    document.querySelectorAll('.configured-item').forEach(card => {
        let text = card.innerText.toLowerCase();

        if (text.includes(value)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});
</script>