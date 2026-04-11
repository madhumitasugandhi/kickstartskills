@extends('frontend.institutionPortal.layout.app')

@section('page_title', 'Student Overview')
@section('title', 'Student Overview')

@section('content')

<div class="content-area">

    <!-- ================= PAGE HEADER ================= -->
    <div class="ui-page-header d-flex justify-content-between align-items-start">
        <div>
            <h5 class="fw-semibold mb-1">Student Overview</h5>
            <small class="ui-muted">
                Monitor student progress, performance, and engagement
            </small>
        </div>

        <button class="btn btn-teal"
                data-bs-toggle="modal"
                data-bs-target="#addStudentModal">
            <i class="bi bi-person-plus me-2"></i> Add Student
        </button>
    </div>


    <!-- ================= STATS ================= -->
    <div class="row g-3 mb-4">
        @foreach([
            ['label' => 'Total Students', 'value' => 6, 'icon' => 'bi-people'],
            ['label' => 'Active Students', 'value' => 3, 'icon' => 'bi-person-check'],
            ['label' => 'Completed', 'value' => 1, 'icon' => 'bi-award'],
            ['label' => 'Avg Progress', 'value' => '65.8%', 'icon' => 'bi-graph-up'],
            ['label' => 'Avg GPA', 'value' => '3.58', 'icon' => 'bi-star'],
            ['label' => 'Avg Attendance', 'value' => '84.9%', 'icon' => 'bi-calendar-check'],
        ] as $stat)
        <div class="col-12 col-md-6 col-xl-4">
            <div class="ui-stats-card">
                <div class="stats-icon">
                    <i class="bi {{ $stat['icon'] }}"></i>
                </div>
                <div>
                    <small class="ui-muted">{{ $stat['label'] }}</small>
                    <h5 class="fw-semibold mb-0">{{ $stat['value'] }}</h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>


    <!-- ================= FILTERS ================= -->
    <div class="ui-card mb-4">
        <div class="ui-section">
            <div class="row g-3 align-items-end">

                <div class="col-12 col-lg-8">
                    <div class="input-group-custom">
                        <i class="bi bi-search"></i>
                        <input type="text"
                               class="form-control"
                               placeholder="Search students">
                    </div>
                </div>

                <div class="col-md-4 col-lg-2">
                    <label class="ui-label">Program</label>
                    <select class="form-select">
                        <option>All Programs</option>
                        <option>Full Stack Web Development</option>
                    </select>
                </div>

                <div class="col-md-4 col-lg-1">
                    <label class="ui-label">Status</label>
                    <select class="form-select">
                        <option>All Status</option>
                        <option>Active</option>
                        <option>Completed</option>
                    </select>
                </div>

                <div class="col-md-4 col-lg-1">
                    <label class="ui-label">Cohort</label>
                    <select class="form-select">
                        <option>All Cohorts</option>
                    </select>
                </div>

            </div>
        </div>
    </div>


    <!-- ================= STUDENT CARD ================= -->
    <div class="ui-card">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex align-items-center gap-3">
                <div class="ui-avatar">AJ</div>
                <div>
                    <h6 class="fw-semibold mb-0">Alice Johnson</h6>
                    <small class="ui-muted">alice.johnson@email.com</small>
                    <div class="small ui-muted mt-1">
                        Full Stack Web Development
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <span class="status-pill active">Active</span>
                <button class="icon-btn">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
            </div>
        </div>

        <!-- Progress -->
        <div class="mb-3">
            <div class="d-flex justify-content-between small mb-1 ui-muted">
                <span>Progress</span>
                <span class="fw-semibold">78.5%</span>
            </div>
            <div class="ui-progress">
                <div class="ui-progress-fill warning" style="width: 78.5%"></div>
            </div>
        </div>

        <!-- Metrics -->
        <div class="row g-4 small ui-muted">
            <div class="col-6 col-md-2">
                <strong>8 / 12</strong>
                <div>Courses</div>
            </div>
            <div class="col-6 col-md-2">
                <strong>3.8</strong>
                <div>GPA</div>
            </div>
            <div class="col-6 col-md-2">
                <strong>92.5%</strong>
                <div>Attendance</div>
            </div>
            <div class="col-6 col-md-2">
                <strong>3</strong>
                <div>Certificates</div>
            </div>
            <div class="col-6 col-md-2">
                <strong>5</strong>
                <div>Projects</div>
            </div>
            <div class="col-6 col-md-2">
                <strong>2h ago</strong>
                <div>Last Active</div>
            </div>
        </div>

    </div>

</div>

@include('frontend.institutionPortal.dashboard.students.overview.modals.create')

@endsection