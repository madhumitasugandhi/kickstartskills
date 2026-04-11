@extends('frontend.institutionPortal.layout.app')

@section('page_title', 'Assessment Management')
@section('title', 'Assessment Management')

@section('content')
<div class="container-fluid py-4">

    <!-- ================= PAGE HEADER ================= -->
    <div class="ui-page-header d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="ui-icon-box">
                <i class="bi bi-clipboard"></i>
            </div>
            <div>
                <h5 class="mb-1">Assessment Management</h5>
                <small class="ui-muted">
                    Create, manage, and monitor assessments and evaluations
                </small>
            </div>
        </div>

        <button class="btn btn-teal"
                data-bs-toggle="modal"
                data-bs-target="#createAssessmentModal">
            <i class="bi bi-plus-lg me-2"></i> Create Assessment
        </button>
    </div>


    <!-- ================= STATS ================= -->
    <div class="row g-3 mb-4">
        @foreach([
            ['label' => 'Total Assessments', 'value' => 6, 'icon' => 'clipboard'],
            ['label' => 'Active Assessments', 'value' => 3, 'icon' => 'play-circle'],
            ['label' => 'Scheduled', 'value' => 1, 'icon' => 'calendar-event'],
            ['label' => 'Completed', 'value' => 1, 'icon' => 'check-circle']
        ] as $stat)
        <div class="col-md-3">
            <div class="ui-stats-card">
                <div class="stats-icon">
                    <i class="bi bi-{{ $stat['icon'] }}"></i>
                </div>
                <div>
                    <h4>{{ $stat['value'] }}</h4>
                    <small>{{ $stat['label'] }}</small>
                </div>
            </div>
        </div>
        @endforeach
    </div>


    <!-- ================= FILTERS ================= -->
    <div class="ui-card mb-4">
        <div class="ui-card-title mb-3">Search & Filters</div>

        <div class="row g-3 align-items-end">

            <div class="col-lg-6">
                <div class="input-group-custom">
                    <i class="bi bi-search"></i>
                    <input type="text"
                           class="form-control"
                           placeholder="Search assessments">
                </div>
            </div>

            <div class="col-md-4 col-lg-2">
                <select class="form-select">
                    <option>All Types</option>
                    <option>Quiz</option>
                    <option>Exam</option>
                    <option>Assignment</option>
                </select>
            </div>

            <div class="col-md-4 col-lg-2">
                <select class="form-select">
                    <option>All Status</option>
                    <option>Draft</option>
                    <option>Active</option>
                    <option>Completed</option>
                </select>
            </div>

            <div class="col-md-4 col-lg-2">
                <select class="form-select">
                    <option>All Courses</option>
                    <option>Introduction to ML</option>
                </select>
            </div>

        </div>
    </div>


    <!-- ================= ASSESSMENT CARDS ================= -->
    <div class="ui-card mb-3">

        <div class="ui-card-header">
            <div>
                <div class="ui-card-title">Machine Learning Quiz</div>
                <div class="ui-card-subtitle">Introduction to ML</div>
            </div>

            <div class="d-flex align-items-center gap-2 student-actions">
                <span class="status-pill active">Quiz</span>
                <span class="status-pill warning">Draft</span>

                <button class="icon-btn kebab-toggle">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>

                <ul class="kebab-menu">
                    <li><i class="bi bi-eye"></i> View</li>
                    <li><i class="bi bi-pencil"></i> Edit</li>
                    <li><i class="bi bi-question-circle"></i> Questions</li>
                    <li><i class="bi bi-bar-chart"></i> Results</li>
                    <li class="danger"><i class="bi bi-trash"></i> Delete</li>
                </ul>
            </div>
        </div>

        <div class="ui-meta mt-3">
            <span><i class="bi bi-clock"></i> 45 min</span>
            <span><i class="bi bi-award"></i> 75 Marks</span>
            <span><i class="bi bi-people"></i> 0 Attempts</span>
            <span><i class="bi bi-graph-up"></i> Avg Score 0</span>
            <span><i class="bi bi-percent"></i> Pass Rate 0%</span>
            <span><i class="bi bi-calendar-event"></i> 25 Mar 2024</span>
        </div>

    </div>

</div>

@include('frontend.institutionPortal.dashboard.electives.assessment.modals.create')
@include('frontend.institutionPortal.dashboard.electives.assessment.scripts')

@endsection