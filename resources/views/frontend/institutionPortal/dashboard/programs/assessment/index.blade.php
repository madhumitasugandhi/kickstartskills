@extends('frontend.institutionPortal.layout.app')

@section('page_title', 'Assessment Management')
@section('title', 'Assessment Management')

@section('content')
<div class="container-fluid p-3 p-md-5">

    <!-- ================= HEADER ================= -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 fw-bold mb-1">Assessment Management</h1>
            <p class=" mb-0">
                Create, manage, and monitor assessments and evaluations
            </p>
        </div>

        <button class="btn btn-teal"
                data-bs-toggle="modal"
                data-bs-target="#createAssessmentModal">
            <i class="bi bi-plus-lg me-2"></i> Create Assessment
        </button>
    </div>

    <!-- ================= STATS ================= -->
    <div class="row g-3 mb-5">
        @foreach([
            ['label' => 'Total Assessments', 'value' => 6, 'icon' => 'bi-clipboard'],
            ['label' => 'Active Assessments', 'value' => 3, 'icon' => 'bi-play-circle'],
            ['label' => 'Scheduled', 'value' => 1, 'icon' => 'bi-calendar-event'],
            ['label' => 'Completed', 'value' => 1, 'icon' => 'bi-check-circle']
        ] as $stat)
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="glass-card p-4 d-flex align-items-center gap-3">
                <div class="stat-icon">
                    <i class="bi {{ $stat['icon'] }}"></i>
                </div>
                <div>
                    <p class="small  mb-0">{{ $stat['label'] }}</p>
                    <h3 class="h4 fw-bold mb-0">{{ $stat['value'] }}</h3>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- ================= FILTERS ================= -->
    <div class="glass-card p-4 mb-4">
        <div class="row g-3 align-items-end">

            <div class="col-12 col-lg-6">
                <div class="input-group-custom">
                    <i class="bi bi-search"></i>
                    <input type="text"
                           class="form-control"
                           placeholder="Search assessments">
                </div>
            </div>

            <div class="col-md-4 col-lg-2">
                <label class="form-label small ">Type</label>
                <select class="form-select">
                    <option>All Types</option>
                    <option>Quiz</option>
                    <option>Exam</option>
                    <option>Assignment</option>
                </select>
            </div>

            <div class="col-md-4 col-lg-2">
                <label class="form-label small ">Status</label>
                <select class="form-select">
                    <option>All Status</option>
                    <option>Draft</option>
                    <option>Active</option>
                    <option>Completed</option>
                </select>
            </div>

            <div class="col-md-4 col-lg-2">
                <label class="form-label small ">Course</label>
                <select class="form-select">
                    <option>All Courses</option>
                    <option>Introduction to ML</option>
                </select>
            </div>

        </div>
    </div>

    <!-- ================= ASSESSMENT CARD ================= -->
    <div class="glass-card p-4 mb-4">

        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h5 class="fw-bold mb-1">Machine Learning Quiz</h5>
                <p class=" mb-0">Introduction to ML</p>
            </div>

            <div class="d-flex align-items-center gap-2">
                <span class="status-pill active">Quiz</span>
                <span class="status-pill warning">Draft</span>
                <button class="icon-btn">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
            </div>
        </div>

        <div class="row g-4 small ">
            <div class="col-6 col-md-2">
                <i class="bi bi-clock me-1"></i>
                <strong>45 min</strong>
                <div>Duration</div>
            </div>
            <div class="col-6 col-md-2">
                <i class="bi bi-award me-1"></i>
                <strong>75</strong>
                <div>Total Marks</div>
            </div>
            <div class="col-6 col-md-2">
                <i class="bi bi-people me-1"></i>
                <strong>0</strong>
                <div>Attempts</div>
            </div>
            <div class="col-6 col-md-2">
                <i class="bi bi-graph-up me-1"></i>
                <strong>0.0</strong>
                <div>Avg Score</div>
            </div>
            <div class="col-6 col-md-2">
                <i class="bi bi-percent me-1"></i>
                <strong>0%</strong>
                <div>Pass Rate</div>
            </div>
            <div class="col-6 col-md-2">
                <i class="bi bi-calendar-event me-1"></i>
                <strong>25 Mar 2024</strong>
                <div>Scheduled</div>
            </div>
        </div>

    </div>

</div>

@include('frontend.institutionPortal.dashboard.programs.assessment.modals.create')
@include('frontend.institutionPortal.dashboard.programs.assessment.scripts')
@endsection
