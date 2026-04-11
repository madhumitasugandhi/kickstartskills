@extends('frontend.institutionPortal.layout.app')
@section('title', 'Dashboard | Institute Portal')
@section('page_title', 'Institution Dashboard')

@section('content')

<div class="content-area">

    {{-- ================= TOP STATS ================= --}}
    <div class="row g-3 mb-4">

        @foreach([
            ['title'=>'Total Students','value'=>'2,847','change'=>'+12.5%'],
            ['title'=>'Active Programs','value'=>'24','change'=>'+2'],
            ['title'=>'Completion Rate','value'=>'87.2%','change'=>'+3.1%'],
            ['title'=>'Employment Rate','value'=>'94.8%','change'=>'+1.7%'],
        ] as $stat)
        <div class="col-md-3">
            <div class="ui-stats-card">
                <div>
                    <h5 class="fw-bold mb-0">{{ $stat['value'] }}</h5>
                    <small class="ui-muted">{{ $stat['title'] }}</small>
                </div>
                <div class="ui-kpi-trend">
                    <i class="bi bi-graph-up-arrow"></i> {{ $stat['change'] }}
                </div>
            </div>
        </div>
        @endforeach

    </div>


    <div class="row g-3">

        {{-- LEFT COLUMN --}}
        <div class="col-lg-8">

            {{-- Enrollment Statistics --}}
            <div class="ui-card mb-4">
                <div class="ui-card-header">
                    <div class="ui-card-title">
                        <i class="bi bi-bar-chart-line me-2"></i> Enrollment Statistics
                    </div>
                    <small class="ui-muted">Academic Year 2024–25</small>
                </div>

                <div class="ui-section">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <small class="ui-muted">New Enrollments</small>
                            <h6>847 <span class="text-success small">+15.2%</span></h6>
                        </div>
                        <div class="col-md-3">
                            <small class="ui-muted">Total Active</small>
                            <h6>2,847 <span class="text-success small">+12.5%</span></h6>
                        </div>
                        <div class="col-md-3">
                            <small class="ui-muted">Retention Rate</small>
                            <h6>92.1% <span class="text-success small">+2.3%</span></h6>
                        </div>
                        <div class="col-md-3">
                            <small class="ui-muted">Dropout Rate</small>
                            <h6>3.2% <span class="text-danger small">-1.1%</span></h6>
                        </div>
                    </div>
                </div>

                <div class="ui-section">
                    <div class="ui-section-title">Department-wise Enrollment</div>

                    <div class="ui-analytics-row">
                        <span>Engineering</span>
                        <strong>1,245 (43.7%)</strong>
                    </div>

                    <div class="ui-analytics-row">
                        <span>Business Studies</span>
                        <strong>892 (31.3%)</strong>
                    </div>

                    <div class="ui-analytics-row">
                        <span>Liberal Arts</span>
                        <strong>456 (16.0%)</strong>
                    </div>
                </div>
            </div>


            {{-- Performance Analytics --}}
            <div class="ui-card mb-4">
                <div class="ui-card-header">
                    <div class="ui-card-title">
                        <i class="bi bi-activity me-2"></i> Performance Analytics
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="ui-subtle">
                            <small class="ui-muted">Average GPA</small>
                            <h5 class="mb-0">3.42 <span class="text-success small">+0.15</span></h5>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="ui-subtle">
                            <small class="ui-muted">Pass Rate</small>
                            <h5 class="mb-0">91.7% <span class="text-success small">+2.3%</span></h5>
                        </div>
                    </div>
                </div>
            </div>


            {{-- Top Faculty --}}
            <div class="ui-card">
                <div class="ui-card-header">
                    <div class="ui-card-title">
                        <i class="bi bi-star me-2"></i> Top Faculty Performance
                    </div>
                </div>

                @foreach([
                    ['Dr. Sarah Johnson', 'Engineering', '4.9', '156'],
                    ['Prof. Michael Chen', 'Business', '4.7', '203']
                ] as $faculty)
                <div class="ui-list-item d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <div class="ui-avatar"><i class="bi bi-person"></i></div>
                        <div>
                            <h6 class="mb-0">{{ $faculty[0] }}</h6>
                            <small class="ui-muted">{{ $faculty[1] }}</small>
                        </div>
                    </div>

                    <div class="text-end">
                        <div class="text-warning small">
                            <i class="bi bi-star-fill"></i> {{ $faculty[2] }}
                        </div>
                        <small class="ui-muted">{{ $faculty[3] }} students</small>
                    </div>
                </div>
                @endforeach
            </div>

        </div>


        {{-- RIGHT COLUMN --}}
        <div class="col-lg-4">

            {{-- Quick Actions --}}
            <div class="ui-card mb-4">
                <div class="ui-card-header">
                    <div class="ui-card-title">
                        <i class="bi bi-lightning-charge me-2"></i> Quick Actions
                    </div>
                </div>

                <div class="ui-list">
                    <a href="#" class="nav-item-custom">
                        <i class="bi bi-people me-2"></i> Manage Enrollments
                    </a>
                    <a href="#" class="nav-item-custom">
                        <i class="bi bi-plus-circle me-2"></i> Create Program
                    </a>
                    <a href="#" class="nav-item-custom">
                        <i class="bi bi-megaphone me-2"></i> Send Announcement
                    </a>
                </div>
            </div>


            {{-- Recent Activities --}}
            <div class="ui-card mb-4">
                <div class="ui-card-header">
                    <div class="ui-card-title">Recent Activities</div>
                    <a href="#" class="ui-link">View All</a>
                </div>

                <div class="ui-activity-item">
                    <i class="bi bi-person-plus"></i>
                    <div>
                        <div class="small fw-semibold">New student enrollment batch approved</div>
                        <small class="ui-muted">2 hours ago</small>
                    </div>
                </div>

                <div class="ui-activity-item">
                    <i class="bi bi-journal-text"></i>
                    <div>
                        <div class="small fw-semibold">New program curriculum published</div>
                        <small class="ui-muted">1 day ago</small>
                    </div>
                </div>
            </div>


            {{-- Success Trends --}}
            <div class="ui-card">
                <div class="ui-card-header">
                    <div class="ui-card-title">
                        <i class="bi bi-trending-up me-2"></i> Success Trends
                    </div>
                </div>

                <div class="ui-subtle">
                    <div class="row mb-2">
                        <div class="col-6">
                            <small class="ui-muted">Graduation</small>
                            <div class="fw-semibold">87.2%</div>
                        </div>
                        <div class="col-6">
                            <small class="ui-muted">Employment</small>
                            <div class="fw-semibold">94.8%</div>
                        </div>
                    </div>

                    <ul class="small mb-0">
                        <li>Engineering ranked #3 in state</li>
                        <li>15 students placed in Fortune 500</li>
                    </ul>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection