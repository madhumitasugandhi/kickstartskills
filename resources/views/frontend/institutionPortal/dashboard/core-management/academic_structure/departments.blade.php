<div class="ui-section">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>
    <h6 class="mb-0 fw-semibold">Departments</h6>
    <small>
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
<div class="ui-list-item p-4">

<div class="d-flex justify-content-between align-items-start w-100">

    <div class="d-flex gap-3">
        <div class="stat-icon info">
            <i class="bi bi-building"></i>
        </div>

        <div>
            <h6 class="mb-1">{{ $dept->department_name }}</h6>
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
<div class="text-center p-5 ui-preview-box">
    <i class="bi bi-building" style="font-size: 2rem;"></i>
    <p class="mt-2 mb-0">No departments added yet</p>
    <small>Click Add Department to create one</small>
</div>
@endforelse
</div>

</div>

<!-- MODAL -->
<div class="modal fade" id="addDepartmentModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">

        <form method="POST" action="{{route('institution.core.academic-structure.departments.store') }}">
            @csrf

            <div class="modal-content ui-modal p-1">

                <!-- HEADER -->
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h6 class="modal-title mb-0">Add Department</h6>
                        <small>Create a new academic department</small>
                    </div>

                    <button type="button" class="icon-btn" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <!-- BODY -->
                <div class="modal-body pt-2">

                    <div class="ui-floating mb-3">
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
                    <button type="button" class="btn ui-btn-muted" data-bs-dismiss="modal">
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
document.addEventListener('click', function(e) {

    /* ================= EDIT ================= */
    let editBtn = e.target.closest('.editDeptBtn');
    if (editBtn) {
        let id = editBtn.dataset.id;

        fetch(`/institution/core-management/academic-structure/departments/edit/${id}`)
            .then(res => res.json())
            .then(data => {
                console.log(data);
                // open edit modal later
            });
    }

    /* ================= DELETE ================= */
    let deleteBtn = e.target.closest('.deleteDeptBtn');
    if (deleteBtn) {
        let id = deleteBtn.dataset.id;

        if (!confirm('Delete this department?')) return;

        let form = document.createElement('form');
        form.method = 'POST';
        form.action = `/institution/core-management/academic-structure/departments/delete/${id}`;

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

    /* ================= KEBAB MENU ================= */
    let kebab = e.target.closest('.kebab-toggle');
    if (kebab) {
        e.stopPropagation();
        document.querySelectorAll('.kebab-menu').forEach(m => m.classList.remove('show'));
        kebab.nextElementSibling.classList.toggle('show');
    } else {
        document.querySelectorAll('.kebab-menu').forEach(m => m.classList.remove('show'));
    }

});
</script>