@extends('frontend.adminPortal.dashboard.layouts.app')

@section('title', 'Drive Oversight')

@section('icon', 'bi-activity')

@section('content')
<style>
    /* --- Page Specific Styles --- */

    /* Stats Cards */
    .drive-stat-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        height: 100%;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .drive-stat-icon {
        font-size: 1.2rem;
        margin-bottom: 8px;
        display: block;
    }

    .drive-stat-value {
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 0;
    }

    .drive-stat-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 0.75rem;
        padding: 2px 8px;
        border-radius: 6px;
        font-weight: 600;
    }

    /* Main Tabs Navigation */
    .drive-tabs {
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 24px;
        display: flex;
        gap: 32px;
        overflow-x: auto;
        white-space: nowrap;
    }

    .drive-tabs::-webkit-scrollbar {
        height: 0px;
        background: transparent;
    }

    .drive-tab-link {
        background: none;
        border: none;
        color: var(--text-muted);
        padding: 12px 0;
        font-weight: 500;
        position: relative;
        cursor: pointer;
        transition: color 0.2s;
    }

    .drive-tab-link:hover {
        color: var(--text-main);
    }

    .drive-tab-link.active {
        color: #ef4444;
    }

    /* Red accent */
    .drive-tab-link.active::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #ef4444;
    }

    /* Nested Analytics Tabs */
    .nested-tabs {
        display: flex;
        gap: 16px;
        margin-bottom: 20px;
        border-bottom: 1px solid var(--border-color);
        overflow-x: auto;
        white-space: nowrap;
    }

    .nested-tab-link {
        background: none;
        border: none;
        color: var(--text-muted);
        padding: 8px 12px;
        font-size: 0.8rem;
        cursor: pointer;
        border-bottom: 2px solid transparent;
        transition: 0.2s;
    }

    .nested-tab-link:hover {
        color: var(--text-main);
    }

    .nested-tab-link.active {
        color: #ef4444;
        border-bottom-color: #ef4444;
    }

    /* Cards & Lists */
    .content-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 16px;
    }

    .approval-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 16px;
        border-left: 4px solid var(--border-color);
    }

    .border-urgent {
        border-left-color: #ef4444;
    }

    .border-high {
        border-left-color: #f59e0b;
    }

    /* Tags & Badges */
    .tag-badge {
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        padding: 4px 8px;
        border-radius: 4px;
        display: inline-block;
        margin-right: 6px;
    }

    .tag-company {
        background-color: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .tag-urgent {
        background-color: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    .tag-mentor {
        background-color: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
    }

    .tag-high {
        background-color: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    /* Action Buttons */
    .btn-card-action {
        width: 100%;
        padding: 8px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        border: none;
        transition: 0.2s;
    }

    .btn-approve {
        background-color: #10b981;
        color: white;
    }

    .btn-reject {
        background-color: #ef4444;
        color: white;
    }

    .btn-view {
        background-color: transparent;
        border: 1px solid var(--border-color);
        color: var(--text-muted);
    }

    /* Progress Bars */
    .progress-thin {
        height: 4px;
        background-color: var(--bg-body);
        border-radius: 2px;
        margin-top: 4px;
    }

    .skill-row {
        margin-bottom: 16px;
    }

    /* Sidebar Widgets */
    .widget-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 24px;
    }

    .alert-box-side {
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 12px;
        border: 1px solid transparent;
    }

    .alert-high {
        background-color: rgba(239, 68, 68, 0.1);
        border-color: rgba(239, 68, 68, 0.2);
    }

    .alert-warn {
        background-color: rgba(245, 158, 11, 0.1);
        border-color: rgba(245, 158, 11, 0.2);
    }

    .alert-info {
        background-color: rgba(59, 130, 246, 0.1);
        border-color: rgba(59, 130, 246, 0.2);
    }

    /* Form Elements */
    .search-input-drive {
        background-color: var(--bg-body);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        padding: 10px 16px;
        border-radius: 8px;
        width: 100%;
    }
    .border-success {
    border-left-color: #10b981;
}
/* Glass Modal Theme */
.glass-modal {
    background-color: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    color: var(--text-main);
}

.glass-modal .modal-header {
    border-bottom: 1px solid var(--border-color);
}

.glass-modal .modal-footer {
    border-top: 1px solid var(--border-color);
}

.modal-label {
    font-size: 0.75rem;
    color: var(--text-muted);
    margin-bottom: 2px;
}

.modal-value {
    font-weight: 600;
    color: var(--text-main);
}
</style>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h5 class="fw-bold text-main mb-1">Drive Oversight Dashboard</h5>
        <small class="--text-muted">Comprehensive platform-wide drive management and analytics</small>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-download me-2"></i> Export Report</button>
        <button class="btn btn-outline-danger btn-sm"><i class="bi bi-display me-2"></i> Real-time View</button>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-6 col-xl-3">
        <div class="drive-stat-card">
            <i class="bi bi-hdd-network drive-stat-icon text-danger"></i>
            <h3 class="drive-stat-value">{{ $total }}</h3>
            <small class="--text-muted">Total Drives</small>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="drive-stat-card">
            <i class="bi bi-person-workspace drive-stat-icon text-danger"></i>
            <h3 class="drive-stat-value">{{ $mentorDrives }}</h3>
            <small class="--text-muted">Mentor Drives</small>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="drive-stat-card">
            <i class="bi bi-check-circle drive-stat-icon text-danger"></i>
            <h3 class="drive-stat-value">{{ $approvedCount }}</h3>
            <small class="--text-muted">Approved Drives</small>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="drive-stat-card">
            <i class="bi bi-broadcast drive-stat-icon text-danger"></i>
            <h3 class="drive-stat-value">{{ $activeDrives }}</h3>
            <small class="--text-muted">Live Drives</small>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-12 col-lg-8">

        <div class="drive-tabs">
            <button class="drive-tab-link active" onclick="switchMainTab('approval')">Drive Approval</button>
            <button class="drive-tab-link" onclick="switchMainTab('analytics')">Analytics</button>
            <button class="drive-tab-link" onclick="switchMainTab('companies')">Companies</button>
            <button class="drive-tab-link" onclick="switchMainTab('config')">Configuration</button>
        </div>

        <div id="main-tab-approval" class="main-content-block">

            <!-- Search & Filter -->
            <form method="GET" action="{{ route('admin.drives.index') }}">
                <div class="d-flex flex-column flex-md-row gap-3 mb-4">
                    <div class="position-relative flex-grow-1">
                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 --text-muted"></i>
                        <input type="text" name="search"
                            value="{{ request('search') }}"
                            class="search-input-drive ps-5"
                            placeholder="Search drives...">
                    </div>

                    <div class="d-flex gap-2">
                        <select name="status" class="form-select w-auto bg-body border-secondary text-main"
                            onchange="this.form.submit()">
                            <option value="">All Drives</option>
                            <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status')=='approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ request('status')=='rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                </div>
            </form>

            <!-- Pending Header -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold text-main m-0">
                    <i class="bi bi-clock-history me-2 text-danger"></i>
                    Drives ({{ $drives->count() }})
                </h6>
            </div>

            <!-- Pending Drives -->
            @if($drives->count() > 0)

@foreach($drives as $drive)

<div class="approval-card 
    {{ $drive->status == 1 ? 'border-high' : '' }}
    {{ $drive->status == 2 ? 'border-success' : '' }}
    {{ $drive->status == 3 ? 'border-urgent' : '' }}">

    <div class="d-flex justify-content-between align-items-start mb-2">
        <div>
            <span class="tag-badge tag-mentor">MENTOR DRIVE</span>

            @if($drive->status == 1)
                <span class="badge bg-warning">Pending Approval</span>
            @elseif($drive->status == 2)
                <span class="badge bg-success">Approved / Live</span>
            @elseif($drive->status == 3)
                <span class="badge bg-danger">Rejected</span>
            @endif
        </div>

        <small>{{ $drive->created_at->diffForHumans() }}</small>
    </div>

    <h5 class="fw-bold text-main mb-1">{{ $drive->drive_title }}</h5>
    <p class="small mb-2">
        {{ $drive->location }} • {{ $drive->drive_type }} • {{ $drive->positions }} Positions
    </p>

    <div class="row g-2 mt-3">

        <!-- View Button -->
        <div class="col-4">
            <button class="btn-card-action btn-view"
                onclick="viewDrive({{ $drive->drive_id }})">
                Details
            </button>
        </div>

        <!-- Pending Buttons -->
        @if($drive->status == 1)
            <div class="col-4">
                <button class="btn-card-action btn-approve"
                    onclick="approveDrive({{ $drive->drive_id }})">
                    Approve
                </button>
            </div>

            <div class="col-4">
                <button class="btn-card-action btn-reject"
                    onclick="rejectDrive({{ $drive->drive_id }})">
                    Reject
                </button>
            </div>
        @endif

        <!-- Approved -->
        @if($drive->status == 2)
            <div class="col-8">
                <div class="btn-card-action" style="background:#10b98120; color:#10b981;">
                    Drive Approved & Live
                </div>
            </div>
        @endif

        <!-- Rejected -->
        @if($drive->status == 3)
            <div class="col-8">
                <div class="btn-card-action" style="background:#ef444420; color:#ef4444;">
                    Drive Rejected
                </div>
            </div>
        @endif

    </div>

</div>

@endforeach

@else

    @if(request('status') == 'pending')
        <div class="content-card text-center py-5">
            <i class="bi bi-clock-history fs-1 text-warning mb-3"></i>
            <h5 class="fw-bold">No Pending Drives</h5>
            <p class="--text-muted">All drives are approved or rejected.</p>
        </div>

    @elseif(request('status') == 'approved')
        <div class="content-card text-center py-5">
            <i class="bi bi-check-circle fs-1 text-success mb-3"></i>
            <h5 class="fw-bold">No Approved Drives</h5>
            <p class="--text-muted">No drives have been approved yet.</p>
        </div>

    @elseif(request('status') == 'rejected')
        <div class="content-card text-center py-5">
            <i class="bi bi-x-circle fs-1 text-danger mb-3"></i>
            <h5 class="fw-bold">No Rejected Drives</h5>
            <p class="--text-muted">No drives have been rejected.</p>
        </div>

    @else
        <div class="content-card text-center py-5">
            <i class="bi bi-folder fs-1 text-secondary mb-3"></i>
            <h5 class="fw-bold">No Drives Found</h5>
            <p class="--text-muted">No drives available in the system.</p>
        </div>
    @endif

@endif

        </div>

        <div id="main-tab-analytics" class="main-content-block d-none">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
                <select class="form-select bg-body border-secondary text-main w-auto">
                    <option>Last Month</option>
                    <option>Last Quarter</option>
                </select>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary">Export Analytics</button>
                    <button class="btn btn-sm btn-outline-danger">Real-time Dashboard</button>
                </div>
            </div>

            <div class="nested-tabs">
                <button class="nested-tab-link active" onclick="switchAnalyticsTab('perf')">Performance Overview</button>
                <button class="nested-tab-link" onclick="switchAnalyticsTab('skills')">Skills Intelligence</button>
                <button class="nested-tab-link" onclick="switchAnalyticsTab('rankings')">Institution Rankings</button>
                <button class="nested-tab-link" onclick="switchAnalyticsTab('company')">Company Analytics</button>
            </div>

            <div id="sub-tab-perf" class="analytics-sub-block">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="content-card text-center py-4">
                            <h4 class="text-danger fw-bold">₹2.45 Cr</h4>
                            <small class="--text-muted">Total Revenue Generated</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="content-card text-center py-4">
                            <h4 class="text-warning fw-bold">₹6.8 L</h4>
                            <small class="--text-muted">Average Placement Salary</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="content-card text-center py-4">
                            <h4 class="text-danger fw-bold">₹19</h4>
                            <small class="--text-muted">Revenue Growth (YoY)</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="content-card text-center py-4">
                            <h4 class="text-danger fw-bold">₹24.5 L</h4>
                            <small class="--text-muted">Platform Commission</small>
                        </div>
                    </div>
                </div>
                <div class="content-card" style="height: 200px; display: flex; align-items: center; justify-content: center;">
                    <div class="text-center --text-muted">
                        <i class="bi bi-graph-up fs-1 mb-2"></i>
                        <p>Revenue Growth Chart Placeholder</p>
                    </div>
                </div>
            </div>

            <div id="sub-tab-skills" class="analytics-sub-block d-none">
                <div class="content-card">
                    <h6 class="fw-bold text-main mb-4"><i class="bi bi-graph-up text-danger me-2"></i> Skills Demand Trends</h6>

                    <div class="skill-row">
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-main fw-bold">Flutter</span>
                            <span class="text-success small"><i class="bi bi-arrow-up"></i> +32.4%</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" style="width: 85%"></div>
                        </div>
                        <small class="--text-muted" style="font-size: 0.7rem;">156 drives requiring this skill</small>
                    </div>

                    <div class="skill-row">
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-main fw-bold">AI/ML</span>
                            <span class="text-success small"><i class="bi bi-arrow-up"></i> +28.7%</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" style="width: 75%"></div>
                        </div>
                        <small class="--text-muted" style="font-size: 0.7rem;">134 drives requiring this skill</small>
                    </div>

                    <div class="skill-row">
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-main fw-bold">React Native</span>
                            <span class="text-success small"><i class="bi bi-arrow-up"></i> +18.5%</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" style="width: 60%"></div>
                        </div>
                        <small class="--text-muted" style="font-size: 0.7rem;">98 drives requiring this skill</small>
                    </div>
                </div>
            </div>

            <div id="sub-tab-rankings" class="analytics-sub-block d-none">
                <div class="content-card">
                    <h6 class="fw-bold text-main mb-4">Institution Performance Rankings</h6>

                    <div class="d-flex align-items-center justify-content-between border-bottom border-secondary border-opacity-25 pb-3 mb-3">
                        <div>
                            <span class="badge bg-danger bg-opacity-10 text-danger me-2">1</span>
                            <span class="fw-bold text-main">Indian Institute of Technology, Bombay</span>
                            <div class="small --text-muted ms-4 ps-1">Drives: 89 • Students: 234</div>
                        </div>
                        <div class="text-end">
                            <div class="text-danger fw-bold">92.5%</div>
                            <small class="--text-muted" style="font-size: 0.7rem;">Success Rate</small>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between border-bottom border-secondary border-opacity-25 pb-3 mb-3">
                        <div>
                            <span class="badge bg-danger bg-opacity-10 text-danger me-2">2</span>
                            <span class="fw-bold text-main">National Institute of Technology, Trichy</span>
                            <div class="small --text-muted ms-4 ps-1">Drives: 76 • Students: 189</div>
                        </div>
                        <div class="text-end">
                            <div class="text-danger fw-bold">87.3%</div>
                            <small class="--text-muted" style="font-size: 0.7rem;">Success Rate</small>
                        </div>
                    </div>
                </div>
            </div>

            <div id="sub-tab-company" class="analytics-sub-block d-none">
                <div class="content-card">
                    <h6 class="fw-bold text-main mb-4">Company Performance Analytics</h6>

                    <div class="border-bottom border-secondary border-opacity-25 pb-3 mb-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="fw-bold text-main">TechCorp Solutions</h6>
                            <div class="text-warning small"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2 text-center">
                            <div>
                                <div class="text-danger fw-bold">45</div><small class="--text-muted" style="font-size: 0.7rem;">Active Drives</small>
                            </div>
                            <div>
                                <div class="text-danger fw-bold">234</div><small class="--text-muted" style="font-size: 0.7rem;">Total Hires</small>
                            </div>
                            <div>
                                <div class="text-danger fw-bold">78.5%</div><small class="--text-muted" style="font-size: 0.7rem;">Success Rate</small>
                            </div>
                        </div>
                    </div>

                    <div class="border-bottom border-secondary border-opacity-25 pb-3 mb-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="fw-bold text-main">InnovateTech Pvt Ltd</h6>
                            <div class="text-warning small"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2 text-center">
                            <div>
                                <div class="text-danger fw-bold">32</div><small class="--text-muted" style="font-size: 0.7rem;">Active Drives</small>
                            </div>
                            <div>
                                <div class="text-danger fw-bold">167</div><small class="--text-muted" style="font-size: 0.7rem;">Total Hires</small>
                            </div>
                            <div>
                                <div class="text-danger fw-bold">82.1%</div><small class="--text-muted" style="font-size: 0.7rem;">Success Rate</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="main-tab-companies" class="main-content-block d-none">
            <div class="d-flex gap-3 mb-4">
                <input type="text" class="search-input-drive" placeholder="Search companies...">
                <select class="form-select w-auto bg-body border-secondary text-main">
                    <option>All Organizations</option>
                </select>
            </div>

            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="fw-bold text-main mb-0">TechCorp Solutions <i class="bi bi-patch-check-fill text-success small"></i></h5>
                    <span class="--text-muted small fw-bold">95.2% Compliance</span>
                </div>
                <small class="--text-muted d-block mb-3">Information Technology • Large • Bangalore, Karnataka</small>

                <div class="row text-center mb-3">
                    <div class="col-4 border-end border-secondary border-opacity-25">
                        <div class="text-danger fw-bold">24</div><small class="--text-muted" style="font-size: 0.7rem;">Active Drives</small>
                    </div>
                    <div class="col-4 border-end border-secondary border-opacity-25">
                        <div class="text-danger fw-bold">156</div><small class="--text-muted" style="font-size: 0.7rem;">Total Hires</small>
                    </div>
                    <div class="col-4">
                        <div class="text-danger fw-bold">4.6/5</div><small class="--text-muted" style="font-size: 0.7rem;">Rating</small>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-6"><button class="btn btn-outline-secondary w-100 btn-sm rounded-0 rounded-start">View Details</button></div>
                    <div class="col-6"><button class="btn btn-danger w-100 btn-sm rounded-0 rounded-end">Manage</button></div>
                </div>
            </div>
        </div>

        <div id="main-tab-config" class="main-content-block d-none">
            <div class="content-card">
                <div class="d-flex justify-content-between mb-4">
                    <h5 class="fw-bold text-main">Drive Policy Configuration</h5>
                    <div>
                        <button class="btn btn-danger btn-sm">Save All</button>
                        <button class="btn btn-outline-secondary btn-sm">Reset</button>
                    </div>
                </div>

                <div class="mb-4 d-flex justify-content-between align-items-center border-bottom border-secondary border-opacity-25 pb-3">
                    <div>
                        <h6 class="fw-bold text-main mb-0">Automatic Approval</h6>
                        <small class="--text-muted">Enable automatic approval for drives meeting all criteria</small>
                    </div>
                    <div class="form-check form-switch"><input class="form-check-input" type="checkbox"></div>
                </div>

                <div class="mb-4 d-flex justify-content-between align-items-center border-bottom border-secondary border-opacity-25 pb-3">
                    <div>
                        <h6 class="fw-bold text-main mb-0">Compliance Check Required</h6>
                        <small class="--text-muted">Require compliance verification before approval</small>
                    </div>
                    <div class="form-check form-switch"><input class="form-check-input" type="checkbox" checked></div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <h6 class="fw-bold text-main">Approval Timeout (Days)</h6>
                        <span class="badge bg-secondary">7</span>
                    </div>
                    <input type="range" class="form-range" min="1" max="30" value="7">
                </div>
            </div>
        </div>

    </div>

    <div class="col-12 col-lg-4">
        <div class="widget-card">
            <h6 class="fw-bold text-main mb-4"><i class="bi bi-pie-chart me-2 text-danger"></i> Platform Distribution</h6>
            <div class="dist-label"><span>Mentor Drives</span> <span class="text-danger">{{ $mentorDrives }}</span></div>
            <div class="progress progress-thin mb-3">
                <div class="progress-bar bg-danger" style="width: 45%"></div>
            </div>

            <div class="dist-label"><span>HR Drives</span> <span class="text-danger">672</span></div>
            <div class="progress progress-thin mb-3">
                <div class="progress-bar bg-danger" style="width: 65%"></div>
            </div>

            <div class="dist-label"><span>Company Drives</span> <span class="text-danger">322</span></div>
            <div class="progress progress-thin mb-3">
                <div class="progress-bar bg-danger" style="width: 30%"></div>
            </div>
        </div>

        <div class="widget-card">
            <h6 class="fw-bold text-main mb-3"><i class="bi bi-exclamation-triangle me-2 text-danger"></i> Drive Alerts</h6>
            <div class="alert-box-side alert-high">
                <span class="badge bg-danger mb-1">HIGH PRIORITY</span>
                <p class="mb-0 text-main small">TechCorp drive needs immediate approval</p>
            </div>
            <div class="alert-box-side alert-warn">
                <span class="badge bg-warning text-dark mb-1">COMPLIANCE</span>
                <p class="mb-0 text-main small">3 drives require policy review</p>
            </div>
        </div>
    </div>

<!-- Drive Details Modal -->
<div class="modal fade" id="driveDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content glass-modal">

            <div class="modal-header">
                <h6 class="modal-title">Drive Details</h6>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="modal-label">Drive Title</div>
                        <div class="modal-value" id="modal_drive_title"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="modal-label">Drive Type</div>
                        <div class="modal-value" id="modal_drive_type"></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="modal-label">Location</div>
                        <div class="modal-value" id="modal_location"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="modal-label">Positions</div>
                        <div class="modal-value" id="modal_positions"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="modal-label">Description</div>
                    <div class="modal-value" id="modal_description"></div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="modal-label">Created At</div>
                        <div class="modal-value" id="modal_created_at"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="modal-label">Status</div>
                        <div class="modal-value" id="modal_status"></div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">
                    Close
                </button>
            </div>

        </div>
    </div>
</div>
</div>

<script>
    // Switch Main Tabs (Approval, Analytics, Companies, Config)
    function switchMainTab(tabName) {
        document.querySelectorAll('.drive-tab-link').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');
        document.querySelectorAll('.main-content-block').forEach(el => el.classList.add('d-none'));
        document.getElementById('main-tab-' + tabName).classList.remove('d-none');
    }

    // Switch Nested Analytics Tabs
    function switchAnalyticsTab(subTabName) {
        document.querySelectorAll('.nested-tab-link').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');
        document.querySelectorAll('.analytics-sub-block').forEach(el => el.classList.add('d-none'));
        document.getElementById('sub-tab-' + subTabName).classList.remove('d-none');
    }

    function approveDrive(id) {
        fetch("/admin/drives/approve/" + id, {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(() => {
            location.reload();
        });
    }

    function rejectDrive(id) {
        let reason = prompt("Enter rejection reason:");

        fetch("/admin/drives/reject/" + id, {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                reason: reason
            })
        }).then(() => {
            location.reload();
        });
    }

    function viewDrive(id) {
    fetch("/admin/drives/get/" + id)
        .then(res => res.json())
        .then(data => {

            document.getElementById('modal_drive_title').innerText = data.drive_title;
            document.getElementById('modal_drive_type').innerText = data.drive_type;
            document.getElementById('modal_location').innerText = data.location;
            document.getElementById('modal_positions').innerText = data.positions;
            document.getElementById('modal_description').innerText = data.drive_description;
            document.getElementById('modal_created_at').innerText = data.created_at;

            let statusText = '';
            if(data.status == 1) statusText = 'Pending Approval';
            if(data.status == 2) statusText = 'Approved / Live';
            if(data.status == 3) statusText = 'Rejected';

            document.getElementById('modal_status').innerText = statusText;

            let modal = new bootstrap.Modal(document.getElementById('driveDetailsModal'));
            modal.show();
        });
}
</script>

@endsection