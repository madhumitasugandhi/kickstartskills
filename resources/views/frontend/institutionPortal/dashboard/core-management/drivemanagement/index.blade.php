@extends('frontend.institutionPortal.layout.app')
@section('page_title', 'Drive Management')
@section('title', 'Drive Management')

@section('content')
<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h5 class="fw-semibold mb-1">Drive Management Center</h5>
            <p class="small mb-0">
                View, approve, block drives and recommend students for optimal placement outcomes
            </p>
        </div>

        <button class="btn btn-outline-success btn-sm">
            <i class="bi bi-download me-1"></i> Export Analytics
        </button>
    </div>

    <!-- ================= KPI GRID ================= -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="glass-card d-flex align-items-center gap-3">
                <div class="stat-icon success"><i class="bi bi-briefcase"></i></div>
                <div>
                    <small>Total Drives</small>
                    <h4 class="mb-0 text-teal">5</h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="glass-card d-flex align-items-center gap-3">
                <div class="stat-icon success"><i class="bi bi-check-circle"></i></div>
                <div>
                    <small>Approved</small>
                    <h4 class="mb-0 text-teal">3</h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="glass-card d-flex align-items-center gap-3">
                <div class="stat-icon warning"><i class="bi bi-clock"></i></div>
                <div>
                    <small>Pending</small>
                    <h4 class="mb-0 text-warning">1</h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="glass-card d-flex align-items-center gap-3">
                <div class="stat-icon danger"><i class="bi bi-x-circle"></i></div>
                <div>
                    <small>Blocked</small>
                    <h4 class="mb-0 text-danger">1</h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="glass-card d-flex align-items-center gap-3">
                <div class="stat-icon info"><i class="bi bi-file-earmark-text"></i></div>
                <div>
                    <small>Applications</small>
                    <h4 class="mb-0 text-info">46</h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="glass-card d-flex align-items-center gap-3">
                <div class="stat-icon success"><i class="bi bi-people"></i></div>
                <div>
                    <small>Eligible Students</small>
                    <h4 class="mb-0 text-teal">241</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= SEARCH & FILTER ================= -->
    <div class="glass-card mb-4">
        <h6 class="fw-semibold mb-3">Search & Filter Drives</h6>

        <div class="mb-3">
            <div class="input-group-custom">
                <i class="bi bi-search"></i>
                <input class="form-control ps-5"
                       placeholder="Search by company name, job title, or location...">
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-3">
                <label class="small">Status</label>
                <select class="form-select">
                    <option>All Status</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="small">Company Type</label>
                <select class="form-select">
                    <option>All Companies</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="small">Package Range</label>
                <select class="form-select">
                    <option>All Packages</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="small">Sort By</label>
                <select class="form-select">
                    <option>Application Deadline</option>
                </select>
            </div>
        </div>
    </div>

    <!-- ================= TABS ================= -->
    <div class="course-tabs mb-4 shadow-sm">
        <button class="tab-btn active" data-tab="all-drives">
            <i class="bi bi-grid"></i> All Drives
        </button>
        <button class="tab-btn" data-tab="approvals">
            <i class="bi bi-check2-square"></i> Approvals
        </button>
        <button class="tab-btn" data-tab="recommendations">
            <i class="bi bi-stars"></i> Recommendations
        </button>
        <button class="tab-btn" data-tab="analytics">
            <i class="bi bi-bar-chart"></i> Analytics
        </button>
    </div>

    <!-- ================= TAB CONTENT ================= -->
    <div class="course-tab-content">

        <div id="all-drives" class="tab-pane active">
            @include('frontend.institutionPortal.dashboard.core-management.drivemanagement.tabs.drives')
        </div>

        <div id="approvals" class="tab-pane">
        @include('frontend.institutionPortal.dashboard.core-management.drivemanagement.tabs.approvals')
        </div>

        <div id="recommendations" class="tab-pane">
        @include('frontend.institutionPortal.dashboard.core-management.drivemanagement.tabs.recommendations')
        </div>

        <div id="analytics" class="tab-pane">
        @include('frontend.institutionPortal.dashboard.core-management.drivemanagement.tabs.analytics')

        </div>

    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabPanes = document.querySelectorAll('.tab-pane');

    tabButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            tabButtons.forEach(b => b.classList.remove('active'));
            tabPanes.forEach(p => p.classList.remove('active'));

            this.classList.add('active');
            const target = document.getElementById(this.dataset.tab);
            if (target) target.classList.add('active');
        });
    });
});
</script>
@endpush
@endsection
