@extends('frontend.institutionPortal.layout.app')
@section('page_title', 'Student Data Dashboard')
@section('title', 'Student Data Dashboard')

@section('content')

<div class="content-area">

    {{-- ================= PAGE HEADER ================= --}}
    <div class="ui-page-header d-flex justify-content-between align-items-start">
        <div>
            <h5 class="fw-semibold mb-1">Student Data Dashboard</h5>
            <small class="ui-muted">
                Comprehensive view of all enrolled students with automatic institution code access
            </small>
        </div>

        <button class="btn btn-teal btn-sm d-flex align-items-center gap-1">
            <i class="bi bi-download"></i> Export Data
        </button>
    </div>


    {{-- ================= OVERVIEW STATS ================= --}}
    <div class="row g-3 mb-4">

        @php
            $stats = [
                ['label'=>'Total Students', 'value'=>5, 'icon'=>'bi-people', 'class'=>'success'],
                ['label'=>'Active Students', 'value'=>4, 'icon'=>'bi-person-check', 'class'=>'success'],
                ['label'=>'Avg CGPA', 'value'=>'8.26', 'icon'=>'bi-star', 'class'=>'warning'],
                ['label'=>'Avg Attendance', 'value'=>'89.4%', 'icon'=>'bi-calendar-check', 'class'=>'info'],
                ['label'=>'Total Backlogs', 'value'=>3, 'icon'=>'bi-exclamation-circle', 'class'=>'danger'],
                ['label'=>'Scholarship Holders', 'value'=>4, 'icon'=>'bi-award', 'class'=>'success'],
            ];
        @endphp

        @foreach($stats as $stat)
            <div class="col-md-6 col-lg-4">
                <div class="ui-stats-card">
                    <div class="stats-icon {{ $stat['class'] }}">
                        <i class="bi {{ $stat['icon'] }}"></i>
                    </div>

                    <div>
                        <small class="ui-muted">{{ $stat['label'] }}</small>
                        <h5 class="fw-semibold mt-1 mb-0">{{ $stat['value'] }}</h5>
                    </div>
                </div>
            </div>
        @endforeach

    </div>


    {{-- ================= FILTERS ================= --}}
    <div class="ui-card mb-4">

        <div class="ui-card-header">
            <div class="ui-card-title">Advanced Filtering & Search</div>
            <div class="ui-card-subtitle">Filter students by course, year, background, and performance</div>
        </div>

        <div class="ui-section">

            {{-- Search --}}
            <div class="input-group-custom mb-3">
                <i class="bi bi-search"></i>
                <input type="text"
                       class="form-control"
                       placeholder="Search by name, email, or institution code...">
            </div>

            {{-- Filters --}}
            <div class="row g-3">
                <div class="col-md-3">
                    <select class="form-select">
                        <option>All Courses</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select class="form-select">
                        <option>All Years</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select class="form-select">
                        <option>All Backgrounds</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select class="form-select">
                        <option>All Performance</option>
                    </select>
                </div>
            </div>

            {{-- Sort --}}
            <div class="mt-3 d-flex justify-content-end">
                <select class="form-select w-auto">
                    <option>Sort by Name</option>
                    <option>Sort by CGPA</option>
                </select>
            </div>

        </div>

    </div>


    {{-- ================= MAIN CARD WITH TABS ================= --}}
    <div class="ui-card">

        <div class="ui-tabs">
            <button class="ui-tab active" data-tab="students">
                <i class="bi bi-people"></i> Students
            </button>

            <button class="ui-tab" data-tab="academic">
                <i class="bi bi-book"></i> Academic
            </button>

            <button class="ui-tab" data-tab="performance">
                <i class="bi bi-graph-up"></i> Performance
            </button>

            <button class="ui-tab" data-tab="background">
                <i class="bi bi-person-badge"></i> Background
            </button>
        </div>

        <div class="tab-content">

            <div class="tab-pane active" id="students">
                @include('frontend.institutionPortal.dashboard.students.data-dashboard.tabs.students')
            </div>

            <div class="tab-pane" id="academic">
                @include('frontend.institutionPortal.dashboard.students.data-dashboard.tabs.academic')
            </div>

            <div class="tab-pane" id="performance">
                @include('frontend.institutionPortal.dashboard.students.data-dashboard.tabs.performance')
            </div>

            <div class="tab-pane" id="background">
                @include('frontend.institutionPortal.dashboard.students.data-dashboard.tabs.background')
            </div>

        </div>

    </div>

</div>


@include('frontend.institutionPortal.dashboard.students.data-dashboard.modals.profile-modal')
@include('frontend.institutionPortal.dashboard.students.data-dashboard.modals.academic-modal')
@include('frontend.institutionPortal.dashboard.students.data-dashboard.modals.performance-modal')
@include('frontend.institutionPortal.dashboard.students.data-dashboard.modals.background-modal')


<script>
document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {

        // Remove active from buttons
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));

        // Hide all panes
        document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));

        // Activate clicked tab
        btn.classList.add('active');

        const target = btn.dataset.tab;
        document.getElementById('tab-' + target).classList.add('active');
    });
});


</script>

@endsection

