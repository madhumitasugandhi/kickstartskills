<div class="glass-card mb-4">

    <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap">

        <div class="input-group-custom flex-grow-1">
            <i class="bi bi-search"></i>
            <input class="form-control ps-5"
                   placeholder="Search internship drives...">
        </div>

        <button class="btn btn-teal" id="createDriveBtn">
            <i class="bi bi-plus-lg me-1"></i> Create Drive
        </button>

    </div>

    <!-- Status Filters -->
    <div class="d-flex gap-2 flex-wrap mt-3">

        <button class="requirement-btn active">
            <i class="bi bi-list-check me-1"></i> All
        </button>

        <button class="requirement-btn">
            <i class="bi bi-play-circle me-1"></i> Active
        </button>

        <button class="requirement-btn">
            <i class="bi bi-people me-1"></i> Selection
        </button>

        <button class="requirement-btn">
            <i class="bi bi-hourglass me-1"></i> In Progress
        </button>

        <button class="requirement-btn">
            <i class="bi bi-check-circle me-1"></i> Completed
        </button>

    </div>

</div>
{{-- DRIVES LIST --}}
<div class="drive-list" id="driveList"></div>

