<div class="glass-card">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>
    <h6 class="mb-0 fw-semibold">Departments</h6>
    <small class="">
        {{ count($departments ?? []) }} departments configured
    </small>
</div>

<div class="d-flex gap-2 align-items-center">

    <div class="input-group-custom">
        <i class="bi bi-search"></i>
        <input type="text"
               class="form-control ps-5"
               placeholder="Search department">
    </div>

    <button class="btn btn-teal btn-sm"
            data-bs-toggle="modal"
            data-bs-target="#addDepartmentModal">
        <i class="bi bi-plus-lg me-1"></i>
        Add
    </button>

</div>

</div>

    <!-- ================= DEPARTMENT LIST ================= -->
    <div class="d-flex flex-column gap-3">

    @forelse($departments ?? [] as $dept)
    <div class="configured-item p-4">

<div class="d-flex justify-content-between align-items-start">

    <div class="d-flex gap-3">
        <div class="stat-icon info">
            <i class="bi bi-building"></i>
        </div>

        <div>
            <h6 class="mb-1">{{ $dept->department_name }}</h6>
            <!-- <small class="">
                Department ID: {{ $dept->department_id }}
            </small> -->
        </div>
    </div>

    <div class="student-actions">
        <button class="icon-btn kebab-toggle">
            <i class="bi bi-three-dots-vertical"></i>
        </button>

        <ul class="kebab-menu">
            <li class="editDeptBtn" data-id="{{ $dept->department_id }}">
                <i class="bi bi-pencil"></i> Edit
            </li>
            <li class="danger deleteDeptBtn" data-id="{{ $dept->department_id }}">
                <i class="bi bi-trash"></i> Delete
            </li>
        </ul>
    </div>

</div>

</div>
        @empty
        <div class="text-center p-5 empty-state">
    <i class="bi bi-building" style="font-size: 2rem;"></i>
    <p class="mt-2 mb-0">No departments added yet</p>
    <small class="">Click Add Department to create one</small>
</div>
@endforelse
    </div>

</div>

<div class="modal fade" id="addDepartmentModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">

        <form method="POST" action="{{route('institution.core.academic-structure.departments.store') }}">
            @csrf

            <div class="modal-content glass-modal p-1">

                <!-- HEADER -->
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h6 class="modal-title mb-0">Add Department</h6>
                        <small class="">Create a new academic department</small>
                    </div>

                    <button type="button" class="icon-btn" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <!-- BODY -->
                <div class="modal-body pt-2">

                    <div class="floating-field mb-3">
                        <input type="text"
                               name="department_name"
                               class="form-control"
                               placeholder=" "
                               required>
                        <label>Department Name</label>
                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn muted-btn" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-teal">
                        Save Department
                    </button>
                </div>

            </div>

        </form>
    </div>
</div>
<script>
    document.querySelectorAll('.editDeptBtn').forEach(btn => {
    btn.addEventListener('click', function () {

        let id = this.dataset.id;

        fetch(`/institution/core-management/academic-structure/departments/edit/${id}`)
            .then(res => res.json())
            .then(data => {
                console.log(data); 
            });

    });
});

document.querySelectorAll('.kebab-toggle').forEach(btn => {
    btn.addEventListener('click', function (e) {
        e.stopPropagation();
        document.querySelectorAll('.kebab-menu').forEach(m => m.classList.remove('show'));
        this.nextElementSibling.classList.toggle('show');
    });
});

document.addEventListener('click', () => {
    document.querySelectorAll('.kebab-menu').forEach(m => m.classList.remove('show'));
});
</script>