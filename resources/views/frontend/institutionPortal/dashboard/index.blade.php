@extends('frontend.institutionPortal.layout.app')


@section('title', 'Dashboard | Institute Portal')

@section('content')

<div class="container-fluid">

    {{-- Top Stats Row --}}
    <div class="row g-3 mb-4">

        <div class="col-md-3">
            <div class="p-3 rounded" style="background:#14293f; border:1px solid rgba(255,255,255,0.05);">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="text-white fw-bold">2,847</h4>
                        <span class="text-muted small">Total Students</span>
                    </div>
                    <span class="text-success fw-semibold small">
                        <i class="bi bi-graph-up-arrow"></i> +12.5%
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="p-3 rounded" style="background:#14293f; border:1px solid rgba(255,255,255,0.05);">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="text-white fw-bold">24</h4>
                        <span class="text-muted small">Active Programs</span>
                    </div>
                    <span class="text-success fw-semibold small">
                        <i class="bi bi-graph-up-arrow"></i> +2.0%
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="p-3 rounded" style="background:#14293f; border:1px solid rgba(255,255,255,0.05);">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="text-success fw-bold">87.2%</h4>
                        <span class="text-muted small">Completion Rate</span>
                    </div>
                    <span class="text-success fw-semibold small">
                        <i class="bi bi-graph-up-arrow"></i> +3.1%
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="p-3 rounded" style="background:#14293f; border:1px solid rgba(255,255,255,0.05);">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="text-warning fw-bold">94.8%</h4>
                        <span class="text-muted small">Employment Rate</span>
                    </div>
                    <span class="text-success fw-semibold small">
                        <i class="bi bi-graph-up-arrow"></i> +1.7%
                    </span>
                </div>
            </div>
        </div>

    </div>

    {{-- Enrollment & Quick Actions --}}
    <div class="row g-3">

        {{-- Enrollment Statistics --}}
        <div class="col-lg-8">
            <div class="p-4 rounded" style="background:#14293f; border:1px solid rgba(255,255,255,0.05);">

                <h5 class="text-white fw-bold mb-3">
                    <i class="bi bi-bar-chart-line me-2"></i> Enrollment Statistics
                </h5>

                <div class="p-3 rounded mb-3" style="background:#0d1b2b;">
                    <h6 class="text-info">Academic Year 2024–25</h6>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <p class="text-muted small mb-1">New Enrollments</p>
                            <h6 class="text-white">847 <small class="text-success">+15.2%</small></h6>

                            <p class="text-muted small mb-1 mt-3">Retention Rate</p>
                            <h6 class="text-white">92.1% <small class="text-success">+2.3%</small></h6>
                        </div>

                        <div class="col-md-6">
                            <p class="text-muted small mb-1">Total Active</p>
                            <h6 class="text-white">2,847 <small class="text-success">+12.5%</small></h6>

                            <p class="text-muted small mb-1 mt-3">Dropout Rate</p>
                            <h6 class="text-white">3.2% <small class="text-danger">-1.1%</small></h6>
                        </div>
                    </div>
                </div>

                <h6 class="text-white fw-bold mt-3 mb-2">Department-wise Enrollment</h6>

                <div>
                    <div class="d-flex justify-content-between text-white-50 small mb-1">
                        <span><span class="badge bg-primary me-2"> </span>Engineering</span>
                        <span>1,245 <span class="text-success">43.7%</span></span>
                    </div>

                    <div class="d-flex justify-content-between text-white-50 small mb-1">
                        <span><span class="badge bg-warning me-2"> </span>Business Studies</span>
                        <span>892 <span class="text-success">31.3%</span></span>
                    </div>

                    <div class="d-flex justify-content-between text-white-50 small mb-1">
                        <span><span class="badge bg-danger me-2"> </span>Liberal Arts</span>
                        <span>456 <span class="text-danger">16.0%</span></span>
                    </div>

                    <div class="d-flex justify-content-between text-white-50 small mb-1">
                        <span><span class="badge bg-info me-2"> </span>Sciences</span>
                        <span>254 <span class="text-info">8.9%</span></span>
                    </div>
                </div>

            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="col-lg-4">
            <div class="p-4 rounded" style="background:#14293f; border:1px solid rgba(255,255,255,0.05);">

                <h5 class="text-white fw-bold mb-3">
                    <i class="bi bi-lightning-charge me-2"></i> Quick Actions
                </h5>

                <div class="list-group">

                    <a href="#" class="list-group-item bg-transparent text-white d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-people me-2"></i> Manage Enrollments</span>
                        <i class="bi bi-chevron-right"></i>
                    </a>

                    <a href="#" class="list-group-item bg-transparent text-white d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-journal-plus me-2"></i> Create Program</span>
                        <i class="bi bi-chevron-right"></i>
                    </a>

                    <a href="#" class="list-group-item bg-transparent text-white d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-person-check me-2"></i> Faculty Assignment</span>
                        <i class="bi bi-chevron-right"></i>
                    </a>

                    <a href="#" class="list-group-item bg-transparent text-white d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-megaphone me-2"></i> Send Announcement</span>
                        <i class="bi bi-chevron-right"></i>
                    </a>

                    <a href="#" class="list-group-item bg-transparent text-white d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-file-earmark-bar-graph me-2"></i> Generate Report</span>
                        <i class="bi bi-chevron-right"></i>
                    </a>

                </div>

            </div>
        </div>

    </div>

</div>

@endsection
