@extends('frontend.institutionPortal.layout.app')

@section('page_title', 'Student Overview')
@section('title', 'Student Overview')

@section('content')
<div class="container-fluid p-3 p-md-5">

    <!-- ================= HEADER ================= -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 fw-bold mb-1">Student Overview</h1>
            <p class=" mb-0">
                Monitor student progress, performance, and engagement
            </p>
        </div>

        <button class="btn btn-teal"
                data-bs-toggle="modal"
                data-bs-target="#addStudentModal">
            <i class="bi bi-person-plus me-2"></i> Add Student
        </button>
    </div>

    <!-- ================= STATS ================= -->
    <div class="row g-3 mb-5">
        @foreach([
            ['label' => 'Total Students', 'value' => 6, 'icon' => 'bi-people'],
            ['label' => 'Active Students', 'value' => 3, 'icon' => 'bi-person-check'],
            ['label' => 'Completed', 'value' => 1, 'icon' => 'bi-award'],
            ['label' => 'Avg Progress', 'value' => '65.8%', 'icon' => 'bi-graph-up'],
            ['label' => 'Avg GPA', 'value' => '3.58', 'icon' => 'bi-star'],
            ['label' => 'Avg Attendance', 'value' => '84.9%', 'icon' => 'bi-calendar-check'],
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
                           placeholder="Search students">
                </div>
            </div>

            <div class="col-md-4 col-lg-2">
                <label class="form-label small ">Program</label>
                <select class="form-select">
                    <option>All Programs</option>
                    <option>Full Stack Web Development</option>
                </select>
            </div>

            <div class="col-md-4 col-lg-1">
                <label class="form-label small ">Status</label>
                <select class="form-select">
                    <option>All Status</option>
                    <option>Active</option>
                    <option>Completed</option>
                </select>
            </div>

            <div class="col-md-4 col-lg-1">
                <label class="form-label small ">Cohort</label>
                <select class="form-select">
                    <option>All Cohorts</option>
                </select>
            </div>

        </div>
    </div>

    <!-- ================= STUDENT CARD ================= -->
    <div class="glass-card p-4 mb-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex align-items-center gap-3">
                <div class="avatar-circle">AJ</div>
                <div>
                    <h6 class="fw-bold mb-0">Alice Johnson</h6>
                    <small class="">alice.johnson@email.com</small>
                    <div class="small  mt-1">
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
            <div class="d-flex justify-content-between small mb-1 ">
                <span>Progress</span>
                <span class="fw-semibold">78.5%</span>
            </div>
            <div class="progress" style="height: 5px;">
                <div class="progress-bar bg-warning" style="width: 78.5%"></div>
            </div>
        </div>

        <!-- Metrics -->
        <div class="row g-4 small ">
            <div class="col-6 col-md-2">
                <i class="bi bi-journal-bookmark me-1"></i>
                <strong>8 / 12</strong>
                <div>Courses</div>
            </div>
            <div class="col-6 col-md-2">
                <i class="bi bi-star me-1"></i>
                <strong>3.8</strong>
                <div>GPA</div>
            </div>
            <div class="col-6 col-md-2">
                <i class="bi bi-calendar-check me-1"></i>
                <strong>92.5%</strong>
                <div>Attendance</div>
            </div>
            <div class="col-6 col-md-2">
                <i class="bi bi-patch-check me-1"></i>
                <strong>3</strong>
                <div>Certificates</div>
            </div>
            <div class="col-6 col-md-2">
                <i class="bi bi-folder me-1"></i>
                <strong>5</strong>
                <div>Projects</div>
            </div>
            <div class="col-6 col-md-2">
                <i class="bi bi-clock-history me-1"></i>
                <strong>2h ago</strong>
                <div>Last Active</div>
            </div>
        </div>

    </div>

</div>

@include('frontend.institutionPortal.dashboard.students.overview.modals.create')

<script>
document.addEventListener('DOMContentLoaded', () => {
    console.log('Student overview module loaded');
});
</script>

@endsection
