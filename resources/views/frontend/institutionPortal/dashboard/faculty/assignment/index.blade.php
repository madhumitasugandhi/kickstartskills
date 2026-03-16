@extends('frontend.institutionPortal.layout.app')

@section('page_title', 'Instructor Assignments')
@section('title', 'Instructor Assignments')

@section('content')
<div class="container-fluid p-3 p-md-5">

    <!-- ================= HEADER ================= -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 fw-bold mb-1">Instructor Assignments</h1>
            <p class=" mb-0">
                Manage course assignments and teaching schedules
            </p>
        </div>

        <button class="btn btn-teal"
                data-bs-toggle="modal"
                data-bs-target="#createAssignmentModal">
            <i class="bi bi-plus-lg me-2"></i> New Assignment
        </button>
    </div>

    <!-- ================= STATS ================= -->
    <div class="row g-3 mb-5">
        @foreach([
            ['label' => 'Total Assignments', 'value' => 6, 'icon' => 'bi-book'],
            ['label' => 'Active Courses', 'value' => 4, 'icon' => 'bi-play-circle'],
            ['label' => 'Pending', 'value' => 1, 'icon' => 'bi-clock'],
            ['label' => 'Completed', 'value' => 1, 'icon' => 'bi-check-circle'],
            ['label' => 'Total Students', 'value' => 195, 'icon' => 'bi-people'],
            ['label' => 'Avg Workload', 'value' => '6.3h', 'icon' => 'bi-briefcase'],
        ] as $stat)
        <div class="col-12 col-md-6 col-xl-4">
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

            <div class="col-12 col-lg-8">
                <div class="input-group-custom">
                    <i class="bi bi-search"></i>
                    <input type="text"
                           class="form-control"
                           placeholder="Search assignments">
                </div>
            </div>

            <div class="col-md-4 col-lg-2">
                <label class="form-label small ">Semester</label>
                <select class="form-select">
                    <option>Current Semester</option>
                </select>
            </div>

            <div class="col-md-4 col-lg-1">
                <label class="form-label small ">Department</label>
                <select class="form-select">
                    <option>All Departments</option>
                </select>
            </div>

            <div class="col-md-4 col-lg-1">
                <label class="form-label small ">Status</label>
                <select class="form-select">
                    <option>All Status</option>
                </select>
            </div>

        </div>
    </div>

    <!-- ================= EMPTY STATE ================= -->
    <div class="glass-card p-5 text-center empty-state">
        <i class="bi bi-book fs-1 mb-3 d-block "></i>
        <h6 class="fw-semibold mb-1">No assignments found</h6>
        <p class=" mb-0">
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
