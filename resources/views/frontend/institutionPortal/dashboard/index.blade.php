@extends('frontend.institutionPortal.layout.app')
@section('title', 'Dashboard | Institute Portal')
@section('page_title', 'Institution Dashboard')
@section('content')

<div class="container-fluid">
    {{-- Top Stats Row --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="setup-header h-100 mb-0">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h4 class="fw-bold mb-0">2,847</h4>
                        <span class=" small">Total Students</span>
                    </div>
                    <span class="text-success fw-semibold small"><i class="bi bi-graph-up-arrow"></i> +12.5%</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="setup-header h-100 mb-0">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h4 class="fw-bold mb-0">24</h4>
                        <span class=" small">Active Programs</span>
                    </div>
                    <span class="text-success fw-semibold small"><i class="bi bi-graph-up-arrow"></i> +2</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="setup-header h-100 mb-0">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h4 class="text-success fw-bold mb-0">87.2%</h4>
                        <span class=" small">Completion Rate</span>
                    </div>
                    <span class="text-success fw-semibold small"><i class="bi bi-graph-up-arrow"></i> +3.1%</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="setup-header h-100 mb-0">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h4 class="text-warning fw-bold mb-0">94.8%</h4>
                        <span class=" small">Employment Rate</span>
                    </div>
                    <span class="text-success fw-semibold small"><i class="bi bi-graph-up-arrow"></i> +1.7%</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        {{-- Left Column: Enrollment & Performance --}}
        <div class="col-lg-8">
            {{-- Enrollment Statistics --}}
            <div class="setup-content mb-4">
                <h5 class="fw-bold mb-3"><i class="bi bi-bar-chart-line me-2 text-success"></i> Enrollment Statistics</h5>
                <div class="added-box mb-3">
                    <h6 class="text-success mb-3">Academic Year 2024–25</h6>
                    <div class="row">
                        <div class="col-6 col-md-3 mb-3">
                            <p class=" small mb-0">New Enrollments</p>
                            <h6 class="mb-0">847 <span class="text-success small">+15.2%</span></h6>
                        </div>
                        <div class="col-6 col-md-3 mb-3">
                            <p class=" small mb-0">Total Active</p>
                            <h6 class="mb-0">2,847 <span class="text-success small">+12.5%</span></h6>
                        </div>
                        <div class="col-6 col-md-3">
                            <p class=" small mb-0">Retention Rate</p>
                            <h6 class="mb-0">92.1% <span class="text-success small">+2.3%</span></h6>
                        </div>
                        <div class="col-6 col-md-3">
                            <p class=" small mb-0">Dropout Rate</p>
                            <h6 class="mb-0">3.2% <span class="text-danger small">-1.1%</span></h6>
                        </div>
                    </div>
                </div>

                <h6 class="fw-bold mt-4 mb-3">Department-wise Enrollment</h6>
                <div class="d-flex flex-column gap-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="small"><i class="bi bi-circle-fill me-2 text-primary"></i> Engineering</span>
                        <span class="small fw-bold">1,245 <span class=" ms-2">43.7%</span></span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="small"><i class="bi bi-circle-fill me-2 text-warning"></i> Business Studies</span>
                        <span class="small fw-bold">892 <span class=" ms-2">31.3%</span></span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="small"><i class="bi bi-circle-fill me-2 text-danger"></i> Liberal Arts</span>
                        <span class="small fw-bold">456 <span class=" ms-2">16.0%</span></span>
                    </div>
                </div>
            </div>

            {{-- Performance Analytics --}}
            <div class="setup-content mb-4">
                <h5 class="fw-bold mb-3"><i class="bi bi-activity me-2 text-primary"></i> Performance Analytics</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="config-card p-3 mb-2">
                            <p class=" small mb-1">Average GPA</p>
                            <h5 class="mb-0">3.42 <span class="text-success small fs-6">+0.15</span></h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="config-card p-3 mb-2" style="border-left: 3px solid #10b981;">
                            <p class=" small mb-1">Pass Rate</p>
                            <h5 class="mb-0">91.7% <span class="text-success small fs-6">+2.3%</span></h5>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Top Faculty --}}
            <div class="setup-content">
                <h5 class="fw-bold mb-3"><i class="bi bi-star me-2 text-warning"></i> Top Faculty Performance</h5>
                @foreach([['Dr. Sarah Johnson', 'Engineering', '4.9', '156'], ['Prof. Michael Chen', 'Business', '4.7', '203']] as $faculty)
                <div class="configured-item mb-2 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="icon-box me-3" style="width: 40px; height: 40px;"><i class="bi bi-person"></i></div>
                        <div>
                            <h6 class="mb-0">{{ $faculty[0] }}</h6>
                            <small class="">{{ $faculty[1] }}</small>
                        </div>
                    </div>
                    <div class="text-end">
                        <div class="text-warning small"><i class="bi bi-star-fill"></i> {{ $faculty[2] }}</div>
                        <small class="">{{ $faculty[3] }} students</small>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Right Column: Actions & Trends --}}
        <div class="col-lg-4">
            {{-- Quick Actions --}}
            <div class="setup-content mb-4 p-0">
                <div class="p-4 border-bottom border-light border-opacity-10">
                    <h5 class="fw-bold mb-0"><i class="bi bi-lightning-charge me-2 text-warning"></i> Quick Actions</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="#" class="nav-item-custom border-0 mx-0 rounded-0"><i class="bi bi-people me-3"></i> Manage Enrollments</a>
                    <a href="#" class="nav-item-custom border-0 mx-0 rounded-0"><i class="bi bi-plus-circle me-3"></i> Create Program</a>
                    <a href="#" class="nav-item-custom border-0 mx-0 rounded-0"><i class="bi bi-megaphone me-3"></i> Send Announcement</a>
                </div>
            </div>

            {{-- Recent Activities --}}
            <div class="setup-content mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">Recent Activities</h5>
                    <a href="#" class="small text-primary text-decoration-none">View All</a>
                </div>
                <div class="activity-item border-0 mb-3 p-0 bg-transparent">
                    <div class="d-flex gap-3">
                        <div class="activity-icon"><i class="bi bi-person-plus"></i></div>
                        <div>
                            <p class="mb-0 small fw-bold">New student enrollment batch approved</p>
                            <small class="">2 hours ago</small>
                        </div>
                    </div>
                </div>
                <div class="activity-item border-0 p-0 bg-transparent">
                    <div class="d-flex gap-3">
                        <div class="activity-icon" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6;"><i class="bi bi-journal-text"></i></div>
                        <div>
                            <p class="mb-0 small fw-bold">New program curriculum published</p>
                            <small class="">1 day ago</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Student Success Trends --}}
            <div class="setup-content">
                <h5 class="fw-bold mb-3"><i class="bi bi-trending-up me-2 text-success"></i> Success Trends</h5>
                <div class="added-box">
                    <div class="row g-2 mb-3">
                        <div class="col-6"><small class=" d-block">Graduation</small><span class="fw-bold">87.2%</span></div>
                        <div class="col-6"><small class=" d-block">Employment</small><span class="fw-bold">94.8%</span></div>
                    </div>
                    <ul class="list-unstyled mb-0 small">
                        <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> Engineering ranked #3 in state</li>
                        <li><i class="bi bi-check2 text-success me-2"></i> 15 students placed in Fortune 500</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection