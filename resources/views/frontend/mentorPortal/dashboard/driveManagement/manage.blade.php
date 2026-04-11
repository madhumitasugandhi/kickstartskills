@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Manage Drives')
@section('icon', 'bi bi-hdd-network fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')
<style>
    /* Theme Variables */
    :root {
        --bg-body: #f8f9fa;
        --bg-sidebar: #ffffff;
        --bg-card: #ffffff;
        --bg-hover: #f8f9fa;

        --text-main: #343a40;
        --text-muted: #6c757d;
        --border-color: #e9ecef;

        /* Soft Colors */
        --soft-blue: #e7f1ff;
        --text-blue: #0d6efd;
        --soft-green: #d1e7dd;
        --text-green: #0f5132;
        --soft-orange: #ffecb5;
        --text-orange: #664d03;
        --soft-red: #f8d7da;
        --text-red: #842029;
        --soft-teal: #e0fbf6;
        --text-teal: #107c6f;
    }

    [data-theme="dark"] {
        --bg-body: #0f1626;
        --bg-sidebar: #1e293b;
        --bg-card: #2e333f;
        --bg-hover: #2e333f;

        --text-main: #e9ecef;
        --text-muted: #adb5bd;
        --border-color: #767677;

        --soft-blue: rgba(13, 110, 253, 0.15);
        --text-blue: #6ea8fe;
        --soft-green: rgba(25, 135, 84, 0.15);
        --text-green: #75b798;
        --soft-orange: rgba(255, 193, 7, 0.15);
        --text-orange: #ffda6a;
        --soft-red: rgba(220, 53, 69, 0.15);
        --text-red: #ea868f;
        --soft-teal: rgba(32, 201, 151, 0.15);
        --text-teal: #a9e5d6;
    }

    /* Card Styling */
    .card-custom {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        transition: transform 0.2s;
    }

    /* Stats Cards */
    .stat-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 140px;
        position: relative;
    }

    .stat-icon-wrapper {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        margin-bottom: 12px;
    }

    .stat-val {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--accent-color);
        line-height: 1;
        margin-bottom: 4px;
    }

    .stat-lbl {
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    .trend-icon {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 1rem;
    }

    /* Filter Tabs */
    .filter-tabs-container {
        display: flex;
        gap: 20px;
        overflow-x: auto;
        padding-bottom: 4px;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 20px;
        scrollbar-width: thin;
    }

    .filter-tab {
        background: none;
        border: none;
        color: var(--text-muted);
        font-size: 0.9rem;
        font-weight: 500;
        padding: 10px 4px;
        position: relative;
        white-space: nowrap;
    }

    .filter-tab.active {
        color: var(--accent-color);
        font-weight: 600;
    }

    .filter-tab.active::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        right: 0;
        height: 2px;
        background-color: var(--accent-color);
    }

    .tab-count {
        background-color: var(--soft-blue);
        color: var(--text-blue);
        font-size: 0.7rem;
        padding: 2px 6px;
        border-radius: 4px;
        margin-left: 6px;
    }

    /* Drive Card */
    .drive-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 24px;
        margin-bottom: 16px;
        transition: box-shadow 0.2s;
    }

    .drive-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .drive-icon {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .status-badge {
        font-size: 0.75rem;
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 600;
        white-space: nowrap;
    }

    .bg-badge-blue {
        background-color: var(--soft-blue);
        color: var(--text-blue);
    }

    .bg-badge-orange {
        background-color: var(--soft-orange);
        color: var(--text-orange);
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .meta-item i {
        font-size: 1rem;
    }

    .action-link {
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-right: 16px;
    }

    .link-blue {
        color: var(--text-blue);
    }

    .link-green {
        color: var(--text-green);
    }

    .link-muted {
        color: var(--text-muted);
    }

    /* Responsive Tweaks */
    @media(max-width: 768px) {
        .stat-card {
            min-height: 120px;
            padding: 16px;
        }

        .filter-tabs-container {
            gap: 15px;
        }

        .meta-grid {
            row-gap: 12px;
        }
    }

    .modal-content {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        color: var(--text-main);
    }

    .modal-header {
        border-bottom: 1px solid var(--border-color);
    }

    .modal-footer {
        border-top: 1px solid var(--border-color);
    }

    .modal input,
    .modal textarea,
    .modal select {
        background-color: var(--bg-body);
        border: 1px solid var(--border-color);
        color: var(--text-main);
    }

    .modal input:focus,
    .modal textarea:focus,
    .modal select:focus {
        box-shadow: none;
        border-color: var(--accent-color);
    }
</style>

<div class="content-body">

    <div class="card-custom mb-4" style="padding: 24px;">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
            <div>
                <h4 class="fw-bold text-main mb-1">Drive Management</h4>
                <p class="text-muted-custom mb-0 small">Manage your internship drives and track applications</p>
            </div>
            <a href="{{ route('mentor.drive.create') }}"
                class="btn btn-primary fw-bold px-4 w-md-auto"
                style="background-color: var(--accent-color); border: none;">
                <i class="bi bi-plus-lg me-2"></i> Create Drive
            </a>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3">
            <div class="card-custom stat-card h-100">
                <i class="bi bi-graph-up-arrow trend-icon text-success"></i>
                <div class="stat-icon-wrapper bg-soft-blue text-blue">
                    <i class="bi bi-briefcase"></i>
                </div>
                <div>
                    <span class="stat-val">{{ $total }}</span>
                    <span class="stat-lbl d-block">Total Drives</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="card-custom stat-card h-100">
                <i class="bi bi-graph-up-arrow trend-icon text-success"></i>
                <div class="stat-icon-wrapper bg-soft-green text-green">
                    <i class="bi bi-play-fill"></i>
                </div>
                <div>
                <span class="stat-val text-green">{{ $approved }}</span>
                <span class="stat-lbl d-block">Active Drives</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="card-custom stat-card h-100">
                <i class="bi bi-graph-up-arrow trend-icon text-success"></i>
                <div class="stat-icon-wrapper bg-soft-blue text-blue">
                    <i class="bi bi-people"></i>
                </div>
                <div>
                    <span class="stat-val">54</span>
                    <span class="stat-lbl d-block">Total Applications</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="card-custom stat-card h-100">
                <i class="bi bi-graph-up-arrow trend-icon text-success"></i>
                <div class="stat-icon-wrapper bg-soft-orange text-orange">
                    <i class="bi bi-person-check"></i>
                </div>
                <div>
                    <span class="stat-val text-orange">4</span>
                    <span class="stat-lbl d-block">Selected Students</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card-custom mb-4 p-0 border-0 bg-transparent">
    <div class="filter-tabs-container">
    <a href="{{ route('mentor.drive.manage') }}"
        class="filter-tab {{ request('status')=='' ? 'active' : '' }}">
        All Drives
        <span class="tab-count">{{ $total }}</span>
    </a>

    <a href="{{ route('mentor.drive.manage',['status'=>'draft']) }}"
        class="filter-tab {{ request('status')=='draft' ? 'active' : '' }}">
        Draft
        <span class="tab-count">{{ $draft }}</span>
    </a>

    <a href="{{ route('mentor.drive.manage',['status'=>'pending']) }}"
        class="filter-tab {{ request('status')=='pending' ? 'active' : '' }}">
        Pending
        <span class="tab-count">{{ $pending }}</span>
    </a>

    <a href="{{ route('mentor.drive.manage',['status'=>'approved']) }}"
        class="filter-tab {{ request('status')=='approved' ? 'active' : '' }}">
        Approved
        <span class="tab-count">{{ $approved }}</span>
    </a>

    <a href="{{ route('mentor.drive.manage',['status'=>'rejected']) }}"
        class="filter-tab {{ request('status')=='rejected' ? 'active' : '' }}">
        Rejected
        <span class="tab-count">{{ $rejected }}</span>
    </a>
</div>

        <form method="GET" action="{{ route('mentor.drive.manage') }}">
            <input type="hidden" name="status" value="{{ request('status') }}">
            <div class="row g-3">
                <div class="col-12 col-md-9">
                    <div class="input-group">
                        <span class="input-group-text bg-card border-end-0" style="background-color: var(--bg-card); border-color: var(--border-color);">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" name="search"
                            value="{{ request('search') }}"
                            class="form-control border-start-0 ps-0"
                            placeholder="Search drives..." style="background-color: var(--bg-card); border-color: var(--border-color); color: var(--text-main);">
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <select name="sort" class="form-select" onchange="this.form.submit()" style="background-color: var(--bg-card); border-color: var(--border-color); color: var(--text-main);">
                        <option value="newest" {{ request('sort')=='newest' ? 'selected' : '' }}>Newest</option>
                        <option value="oldest" {{ request('sort')=='oldest' ? 'selected' : '' }}>Oldest</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

    @foreach($drives as $drive)
    <div class="drive-card">

        <div class="d-flex justify-content-between align-items-start mb-3">

            <div class="d-flex gap-3">
                <div class="drive-icon bg-soft-blue text-blue">
                    <i class="bi bi-laptop"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-main mb-1">{{ $drive->drive_title }}</h6>
                    <small class="text-muted-custom">{{ $drive->drive_type }}</small>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2">
                @if($drive->status == 0)
                <span class="badge bg-secondary">Draft</span>
                @endif

                @if($drive->status == 1)
                <span class="badge bg-warning">Pending Approval</span>
                @endif

                @if($drive->status == 2)
                <span class="badge bg-success">Live</span>
                @endif

                @if($drive->status == 3)
                <span class="badge bg-danger">Rejected</span>
                @endif

                <div class="dropdown">
                    <button class="btn btn-link p-0" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>
                            <a class="dropdown-item" href="#" onclick="viewDrive({{ $drive->drive_id }})">
                                View
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="#" onclick="editDrive({{ $drive->drive_id }})">
                                Edit
                            </a>
                        </li>

                        @if($drive->status == 0)
                        <li>
                            <a class="dropdown-item" href="#" onclick="publishDrive({{ $drive->drive_id }})">
                                Publish
                            </a>
                        </li>
                        @endif

                        <li>
                            <a class="dropdown-item text-danger" href="#" onclick="deleteDrive({{ $drive->drive_id }})">
                                Delete
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

        </div>

        <p class="text-muted-custom small mb-4">
            {{ $drive->drive_description }}
        </p>

        <div class="row g-3 mb-4 meta-grid">
            <div class="col-6 col-md-3 meta-item">
                <i class="bi bi-geo-alt"></i> {{ $drive->location }}
            </div>
            <div class="col-6 col-md-3 meta-item">
                <i class="bi bi-calendar"></i> {{ $drive->duration_weeks }} Weeks
            </div>
            <div class="col-6 col-md-3 meta-item">
                <i class="bi bi-clock"></i> {{ $drive->work_mode }}
            </div>
            <div class="col-6 col-md-3 meta-item">
                <i class="bi bi-people"></i> {{ $drive->positions }} Positions
            </div>
        </div>


    </div>

</div>
@endforeach

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function viewDrive(id) {
        fetch('/mentor/drive/get/' + id)
            .then(res => res.json())
            .then(data => {

                document.getElementById('viewDriveContent').innerHTML = `
            <h5>${data.drive_title}</h5>
            <p>${data.drive_description}</p>
            <p><b>Location:</b> ${data.location}</p>
            <p><b>Positions:</b> ${data.positions}</p>
            <p><b>Work Mode:</b> ${data.work_mode}</p>
        `;

                new bootstrap.Modal(document.getElementById('viewDriveModal')).show();
            });
    }

    function editDrive(id) {
        fetch('/mentor/drive/get/' + id)
            .then(res => res.json())
            .then(data => {

                document.getElementById('edit_drive_id').value = data.drive_id;
                document.getElementById('edit_drive_title').value = data.drive_title;
                document.getElementById('edit_drive_description').value = data.drive_description;
                document.getElementById('edit_location').value = data.location;
                document.getElementById('edit_positions').value = data.positions;
                document.getElementById('edit_drive_type').value = data.drive_type;
                document.getElementById('edit_work_mode').value = data.work_mode;
                document.getElementById('edit_duration_weeks').value = data.duration_weeks;

                new bootstrap.Modal(document.getElementById('editDriveModal')).show();
            });
    }

    function updateDrive() {
        let id = document.getElementById('edit_drive_id').value;

        fetch("{{ url('mentor/drive/update') }}/" + id, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    drive_title: document.getElementById('edit_drive_title').value,
                    drive_description: document.getElementById('edit_drive_description').value,
                    location: document.getElementById('edit_location').value,
                    positions: document.getElementById('edit_positions').value,
                    drive_type: document.getElementById('edit_drive_type').value,
                    work_mode: document.getElementById('edit_work_mode').value,
                    duration_weeks: document.getElementById('edit_duration_weeks').value
                })
            }).then(res => res.json())
            .then(() => {
                Swal.fire('Updated!', 'Drive updated successfully', 'success')
                    .then(() => location.reload());
            });
    }

    function deleteDrive(id) {
        Swal.fire({
            title: 'Delete Drive?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("{{ url('mentor/drive/delete') }}/" + id, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(() => {
                    Swal.fire('Deleted!', '', 'success')
                        .then(() => location.reload());
                });
            }
        });
    }

    function publishDrive(id) {
        fetch("{{ url('mentor/drive/publish') }}/" + id, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(() => {
            Swal.fire('Sent!', 'Drive sent for admin approval', 'success')
                .then(() => location.reload());
        });
    }
</script>

@endsection

<!-- VIEW MODAL -->
<div class="modal fade" id="viewDriveModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Drive Details</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="viewDriveContent">
            </div>
        </div>
    </div>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editDriveModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Edit Drive</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">

                <input type="hidden" id="edit_drive_id">

                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Title</label>
                        <input type="text" id="edit_drive_title" class="form-control">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Drive Type</label>
                        <select id="edit_drive_type" class="form-control">
                            <option>INTERNSHIP</option>
                            <option>FULL_TIME</option>
                            <option>PART_TIME</option>
                            <option>CONTRACTUAL</option>
                            <option>FREELANCE</option>
                        </select>
                    </div>
                </div>

                <div class="mb-2">
                    <label>Description</label>
                    <textarea id="edit_drive_description" class="form-control"></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Location</label>
                        <input type="text" id="edit_location" class="form-control">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Work Mode</label>
                        <select id="edit_work_mode" class="form-control">
                            <option>REMOTE</option>
                            <option>ON-SITE</option>
                            <option>HYBRID</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Positions</label>
                        <input type="number" id="edit_positions" class="form-control">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Duration Weeks</label>
                        <input type="number" id="edit_duration_weeks" class="form-control">
                    </div>
                </div>

                <button class="btn btn-primary mt-3" onclick="updateDrive()">Update Drive</button>

            </div>
        </div>
    </div>
</div>