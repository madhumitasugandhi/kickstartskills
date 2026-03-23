<div class="glass-card">

    <!-- ================= HEADER ACTIONS ================= -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="input-group-custom w-50">
            <i class="bi bi-search"></i>
            <input type="text"
                class="form-control ps-5"
                placeholder="Search departments...">
        </div>

        <button class="btn btn-teal btn-sm"
            data-bs-toggle="modal"
            data-bs-target="#addDepartmentModal">
            <i class="bi bi-plus-lg me-1"></i>
            Add Department
        </button>
    </div>

    <!-- ================= DEPARTMENT LIST ================= -->
    <div class="d-flex flex-column gap-3">

    @forelse($departments ?? [] as $dept)
        <div class="configured-item p-4">

            <div class="d-flex justify-content-between align-items-start">

                <div class="d-flex gap-3">
                    <div class="stat-icon info">
                        <i class="bi bi-layers"></i>
                    </div>

                    <div>
                        <h6 class="mb-1">{{ $dept->department_name }}</h6>
                    
                    </div>
                </div>

                <!-- ACTIONS -->
                <div class="d-flex gap-2">

                    <button class="icon-btn editDeptBtn"
                        data-id="{{ $dept->department_id }}">
                        <i class="bi bi-pencil"></i>
                    </button>

                    <form action="{{ route('institution.core.academic-structure.departments.delete', $dept->department_id) }}"
                        method="POST"
                        onsubmit="return confirm('Delete this department?')">
                        @csrf
                        @method('DELETE')

                        <button class="icon-btn">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>

                </div>

            </div>

        </div>

        @empty
    <div class="text-center p-4">
        <p class="mb-0">No departments found</p>
    </div>
@endforelse
    </div>

</div>

<div class="modal fade" id="addDepartmentModal">
    <div class="modal-dialog">
        <form method="POST" action="{{route('institution.core.academic-structure.departments.store') }}">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Department</h5>
                </div>

                <div class="modal-body">
                    <input type="text"
                           name="department_name"
                           class="form-control"
                           placeholder="Department Name"
                           required>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-teal">Save</button>
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
</script>