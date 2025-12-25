@extends('frontend.institutionPortal.layout.app')

@section('page_title', 'Faculty Management')
@section('title', 'Faculty Management')

@section('content')
<div class="container-fluid p-3 p-md-5">

    <!-- ================= HEADER ================= -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 fw-bold mb-1">Faculty Management</h1>
            <p class=" mb-0">
                Manage faculty members, assignments, and performance
            </p>
        </div>

        <button class="btn btn-teal"
                data-bs-toggle="modal"
                data-bs-target="#addFacultyModal">
            <i class="bi bi-person-plus me-2"></i> Add Faculty
        </button>
    </div>

    <!-- ================= STATS ================= -->
    <div class="row g-3 mb-5">
        @foreach([
            ['label' => 'Total Faculty', 'value' => 6, 'icon' => 'bi-people'],
            ['label' => 'Active Faculty', 'value' => 5, 'icon' => 'bi-person-check'],
            ['label' => 'Full-time', 'value' => 5, 'icon' => 'bi-briefcase'],
            ['label' => 'Avg Rating', 'value' => '4.6', 'icon' => 'bi-star'],
            ['label' => 'Total Students', 'value' => 557, 'icon' => 'bi-people-fill'],
            ['label' => 'Publications', 'value' => 67, 'icon' => 'bi-journal-text'],
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
                           placeholder="Search faculty">
                </div>
            </div>

            <div class="col-md-4 col-lg-2">
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

            <div class="col-md-4 col-lg-1">
                <label class="form-label small ">Employment</label>
                <select class="form-select">
                    <option>All Types</option>
                </select>
            </div>

        </div>
    </div>

    <!-- ================= FACULTY CARD ================= -->
    <div class="glass-card p-4 mb-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex align-items-center gap-3">
                <div class="avatar-circle">DD</div>
                <div>
                    <h6 class="fw-bold mb-0">Dr. David Kim</h6>
                    <small class="">
                        Associate Professor • Mobile Development
                    </small>
                    <div class="small  mt-1">
                        david.kim@institute.edu
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <span class="status-pill active">Full-time</span>
                <span class="status-pill active">Active</span>
                <button class="icon-btn">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
            </div>
        </div>

        <!-- Metrics -->
        <div class="row g-4 small ">
            <div class="col-6 col-md-2">
                <i class="bi bi-journal-bookmark me-1"></i>
                <strong>3</strong>
                <div>Courses Teaching</div>
            </div>
            <div class="col-6 col-md-2">
                <i class="bi bi-people me-1"></i>
                <strong>112</strong>
                <div>Students Enrolled</div>
            </div>
            <div class="col-6 col-md-2">
                <i class="bi bi-star me-1"></i>
                <strong>4.4</strong>
                <div>Avg Rating</div>
            </div>
            <div class="col-6 col-md-2">
                <i class="bi bi-briefcase me-1"></i>
                <strong>9 years</strong>
                <div>Experience</div>
            </div>
            <div class="col-6 col-md-2">
                <i class="bi bi-journal-text me-1"></i>
                <strong>7</strong>
                <div>Publications</div>
            </div>
            <div class="col-6 col-md-2">
                <i class="bi bi-geo-alt me-1"></i>
                <strong>MOB-201</strong>
                <div>Office</div>
            </div>
        </div>

        <!-- Skills -->
        <div class="mt-3 d-flex flex-wrap gap-2">
            <span class="skill-tag">iOS Development</span>
            <span class="skill-tag">Android Development</span>
            <span class="skill-tag">Cross-platform</span>
        </div>

    </div>

</div>

{{-- ================= MODALS ================= --}}
@include('frontend.institutionPortal.dashboard.faculty.management.modals.create')

<script>
document.addEventListener('DOMContentLoaded', () => {
    console.log('Faculty Management module loaded');
});
</script>

@endsection
