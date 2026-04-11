@extends('frontend.institutionPortal.layout.app')

@section('page_title', 'Academic Records')
@section('title', 'Academic Records')

@section('content')

<div class="content-area">

    <!-- ================= PAGE HEADER ================= -->
    <div class="ui-page-header d-flex justify-content-between align-items-start">
        <div>
            <h5 class="fw-semibold mb-1">Academic Records</h5>
            <small class="ui-muted">
                Manage student transcripts, grades, and academic achievements
            </small>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary">
                <i class="bi bi-download me-2"></i> Export Reports
            </button>
            <button class="btn btn-teal"
                    data-bs-toggle="modal"
                    data-bs-target="#enterGradesModal">
                <i class="bi bi-pencil-square me-2"></i> Enter Grades
            </button>
        </div>
    </div>


    <!-- ================= STATS ================= -->
    <div class="row g-3 mb-4">
        @foreach([
            ['label' => 'Total Students', 'value' => 3, 'icon' => 'bi-people'],
            ['label' => 'Active Students', 'value' => 2, 'icon' => 'bi-person-check'],
            ['label' => 'Graduated', 'value' => 1, 'icon' => 'bi-mortarboard'],
            ['label' => 'Average GPA', 'value' => '3.77', 'icon' => 'bi-star'],
            ['label' => 'Avg Completion', 'value' => '81.2%', 'icon' => 'bi-graph-up'],
            ['label' => 'Certifications', 'value' => 5, 'icon' => 'bi-patch-check'],
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
                    </select>
                </div>

                <div class="col-md-4 col-lg-1">
                    <label class="ui-label">Status</label>
                    <select class="form-select">
                        <option>All Status</option>
                    </select>
                </div>

                <div class="col-md-4 col-lg-1">
                    <label class="ui-label">Grade Range</label>
                    <select class="form-select">
                        <option>All Grades</option>
                    </select>
                </div>

            </div>
        </div>
    </div>


    <!-- ================= STUDENT RECORD CARD ================= -->
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
                <span class="status-pill active">GPA 3.75</span>
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
                <strong>36 / 45</strong>
                <div>Credits Earned</div>
            </div>
            <div class="col-6 col-md-2">
                <strong>3.80</strong>
                <div>Current GPA</div>
            </div>
            <div class="col-6 col-md-2">
                <strong>92.5%</strong>
                <div>Attendance</div>
            </div>
            <div class="col-6 col-md-2">
                <strong>2</strong>
                <div>Achievements</div>
            </div>
            <div class="col-6 col-md-2">
                <strong>2</strong>
                <div>Certificates</div>
            </div>
            <div class="col-6 col-md-2">
                <strong>15 Jan 2024</strong>
                <div>Enrolled</div>
            </div>
        </div>

    </div>

</div>

@include('frontend.institutionPortal.dashboard.students.academic-records.modals.enter-grades')

@endsection