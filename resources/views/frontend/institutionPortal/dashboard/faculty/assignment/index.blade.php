@extends('frontend.institutionPortal.layout.app')

@section('page_title', 'Instructor Assignments')
@section('title', 'Instructor Assignments')

@section('content')
<div class="container-fluid p-3 p-md-5">

    <!-- ================= HEADER ================= -->
    <div class="ui-page-header d-flex justify-content-between align-items-center">
    <div class="d-flex gap-3 align-items-center">
        <div class="ui-icon-box">
            <i class="bi bi-book"></i>
        </div>
        <div>
            <h5 class="mb-0">Instructor Assignments</h5>
            <small class="ui-muted">Manage course assignments and teaching schedules</small>
        </div>
    </div>

    <button class="btn btn-teal"
            data-bs-toggle="modal"
            data-bs-target="#createAssignmentModal">
        <i class="bi bi-plus-lg me-2"></i> New Assignment
    </button>
</div>

    <!-- ================= STATS ================= -->
    <div class="row g-3 mb-4">
@foreach([
    ['label' => 'Total Assignments', 'value' => 6, 'icon' => 'bi-book'],
    ['label' => 'Active Courses', 'value' => 4, 'icon' => 'bi-play-circle'],
    ['label' => 'Pending', 'value' => 1, 'icon' => 'bi-clock'],
    ['label' => 'Completed', 'value' => 1, 'icon' => 'bi-check-circle'],
    ['label' => 'Total Students', 'value' => 195, 'icon' => 'bi-people'],
    ['label' => 'Avg Workload', 'value' => '6.3h', 'icon' => 'bi-briefcase'],
] as $stat)
<div class="col-12 col-md-6 col-xl-4">
    <div class="ui-stats-card">
        <div class="stats-icon">
            <i class="bi {{ $stat['icon'] }}"></i>
        </div>
        <div>
            <h4>{{ $stat['value'] }}</h4>
            <small class="ui-muted">{{ $stat['label'] }}</small>
        </div>
    </div>
</div>
@endforeach
</div>

    <!-- ================= FILTERS ================= -->
    <div class="ui-card mb-4">
    <div class="row g-3 align-items-end">

        <div class="col-12 col-lg-8">
            <div class="input-group-custom">
                <i class="bi bi-search"></i>
                <input type="text"
                       class="form-control"
                       placeholder="Search assignments">
            </div>
        </div>

        <div class="col-md-4 col-lg-2">
            <label class="ui-label">Semester</label>
            <select class="form-select">
                <option>Current Semester</option>
            </select>
        </div>

        <div class="col-md-4 col-lg-1">
            <label class="ui-label">Department</label>
            <select class="form-select">
                <option>All Departments</option>
            </select>
        </div>

        <div class="col-md-4 col-lg-1">
            <label class="ui-label">Status</label>
            <select class="form-select">
                <option>All Status</option>
            </select>
        </div>

    </div>
</div>

        <!-- ================= EMPTY STATE     ================= -->
        <div class="ui-card text-center p-5">
    <div class="ui-icon-box mx-auto mb-3" style="width:60px;height:60px;">
        <i class="bi bi-book fs-4"></i>
    </div>
    <h6 class="fw-semibold mb-1">No assignments found</h6>
    <p class="ui-muted mb-0">
        Try adjusting your search or filters
    </p>
</div>

</div>

{{-- ================= MODALS ================= --}}
@include('frontend.institutionPortal.dashboard.faculty.assignment.modals.create')

<script>
document.addEventListener('DOMContentLoaded', () => {
    console.log('Instructor Assignments module loaded');
});
</script>

@endsection
