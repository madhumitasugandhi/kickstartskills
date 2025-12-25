@extends('frontend.institutionPortal.layout.app')

@section('page_title', 'Academic Records')
@section('title', 'Academic Records')

@section('content')
<div class="container-fluid p-3 p-md-5">

    <!-- ================= HEADER ================= -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 fw-bold mb-1">Academic Records</h1>
            <p class=" mb-0">
                Manage student transcripts, grades, and academic achievements
            </p>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-outline-teal">
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
    <div class="row g-3 mb-5">
        @foreach([
            ['label' => 'Total Students', 'value' => 3, 'icon' => 'bi-people'],
            ['label' => 'Active Students', 'value' => 2, 'icon' => 'bi-person-check'],
            ['label' => 'Graduated', 'value' => 1, 'icon' => 'bi-mortarboard'],
            ['label' => 'Average GPA', 'value' => '3.77', 'icon' => 'bi-star'],
            ['label' => 'Avg Completion', 'value' => '81.2%', 'icon' => 'bi-graph-up'],
            ['label' => 'Certifications', 'value' => 5, 'icon' => 'bi-patch-check'],
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
                </select>
            </div>

            <div class="col-md-4 col-lg-1">
                <label class="form-label small ">Status</label>
                <select class="form-select">
                    <option>All Status</option>
                </select>
            </div>

            <div class="col-md-4 col-lg-1">
                <label class="form-label small ">Grade Range</label>
                <select class="form-select">
                    <option>All Grades</option>
                </select>
            </div>

        </div>
    </div>

    <!-- ================= STUDENT RECORD CARD ================= -->
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
                <span class="status-pill active">GPA 3.75</span>
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
                <i class="bi bi-book me-1"></i>
                <strong>36 / 45</strong>
                <div>Credits Earned</div>
            </div>
            <div class="col-6 col-md-2">
                <i class="bi bi-star me-1"></i>
                <strong>3.80</strong>
                <div>Current GPA</div>
            </div>
            <div class="col-6 col-md-2">
                <i class="bi bi-calendar-check me-1"></i>
                <strong>92.5%</strong>
                <div>Attendance</div>
            </div>
            <div class="col-6 col-md-2">
                <i class="bi bi-award me-1"></i>
                <strong>2</strong>
                <div>Achievements</div>
            </div>
            <div class="col-6 col-md-2">
                <i class="bi bi-patch-check me-1"></i>
                <strong>2</strong>
                <div>Certificates</div>
            </div>
            <div class="col-6 col-md-2">
                <i class="bi bi-calendar-event me-1"></i>
                <strong>15 Jan 2024</strong>
                <div>Enrolled</div>
            </div>
        </div>

    </div>

</div>

@include('frontend.institutionPortal.dashboard.students.academic-records.modals.enter-grades')

<script>
document.addEventListener('DOMContentLoaded', () => {
    console.log('Academic Records module loaded');
});
</script>

@endsection
