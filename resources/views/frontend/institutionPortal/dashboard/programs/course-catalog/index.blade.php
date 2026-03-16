@extends('frontend.institutionPortal.layout.app')

@section('page_title', 'Course Catalog')
@section('title', 'Course Catalog')

@section('content')
<div class="container-fluid p-3 p-md-5">

    <!-- ================= HEADER ================= -->
   <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">Course Catalog Overview</h1>
        <p class="small  mb-0">
            Manage courses, visibility, enrollments, and pricing
        </p>
    </div>

    <button class="btn btn-teal"
            data-bs-toggle="modal"
            data-bs-target="#createCourseModal">
        <i class="bi bi-plus-lg me-2"></i> Add Course
    </button>
</div>


    <!-- ================= STATS ================= -->
    <div class="row g-3 mb-1">
        @php
            $stats = [
                ['label' => 'Total Courses', 'value' => 5, 'icon' => 'bi-book', 'color' => '#2dd4bf'],
                ['label' => 'Published', 'value' => 4, 'icon' => 'bi-check-circle', 'color' => '#10b981'],
                ['label' => 'Total Enrollments', 'value' => 713, 'icon' => 'bi-people', 'color' => '#3b82f6'],
                ['label' => 'Avg. Rating', 'value' => '4.7', 'icon' => 'bi-star', 'color' => '#f59e0b'],
            ];
        @endphp

<div class="row g-3 mb-5">
@foreach($stats as $stat)
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="stat-card-custom p-4 d-flex align-items-center gap-3 glass-card">
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

    </div>

    <!-- ================= FILTERS ================= -->
    <div class="glass-card p-4 mb-4">
    <h6 class="fw-semibold mb-3">Search & Filters</h6>

    <div class="row g-3">
        <div class="col-12">
            <div class="input-group-custom">
                <i class="bi bi-search"></i>
                <input type="text"
                       class="form-control"
                       placeholder="Search courses, instructors, or skills">
            </div>
        </div>

        <div class="col-md-3">
            <select class="form-select">
                <option>All Categories</option>
            </select>
        </div>

        <div class="col-md-3">
            <select class="form-select">
                <option>All Levels</option>
            </select>
        </div>

        <div class="col-md-3">
            <select class="form-select">
                <option>All Status</option>
            </select>
        </div>

        <div class="col-md-3">
            <select class="form-select">
                <option>Most Popular</option>
            </select>
        </div>
    </div>
</div>


    <!-- ================= LIST HEADER ================= -->
    <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-semibold mb-0">Courses (5)</h5>

    <div class="d-flex align-items-center gap-3">
        <button class="icon-btn">
            <i class="bi bi-download"></i>
        </button>
        <button class="icon-btn">
            <i class="bi bi-three-dots-vertical"></i>
        </button>
    </div>
</div>


    <!-- ================= COURSE CARDS ================= -->
    <div class="col-md-6">
    <div class="program-card-custom glass-card p-4 h-100">

        <div class="d-flex justify-content-between align-items-start mb-2">
            <h5 class="fw-bold mb-0">Introduction to React.js</h5>
            <span class="status-pill active">Published</span>
        </div>

        <p class="small  mb-2">by Dr. Sarah Johnson</p>

        <div class="d-flex gap-2 mb-3 flex-wrap">
            <span class="skill-tag">Programming</span>
            <span class="skill-tag highlight">Beginner</span>
        </div>

        <p class="mb-3 ">
            Learn the fundamentals of React.js and build modern web applications.
        </p>

        <div class="row g-2 small  mb-3">
            <div class="col-6">
                <i class="bi bi-people me-1"></i> 234 / 300
            </div>
            <div class="col-6">
                <i class="bi bi-star-fill me-1"></i> 4.8 (156)
            </div>
            <div class="col-6">
                <i class="bi bi-clock me-1"></i> 8 weeks
            </div>
        </div>

        <div class="progress mb-3" style="height: 5px;">
            <div class="progress-bar bg-success" style="width: 78%"></div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <strong class="text-teal">₹15,000</strong>

            <div class="d-flex gap-2">
                <button class="btn btn-outline-teal btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#viewCourseModal">
                    View
                </button>
                <button class="btn btn-teal btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#editCourseModal">
                    Edit
                </button>
            </div>
        </div>

    </div>
</div>

</div>

{{-- ================= MODALS ================= --}}
@include('frontend.institutionPortal.dashboard.programs.course-catalog.modals.create')
@include('frontend.institutionPortal.dashboard.programs.course-catalog.modals.edit')
@include('frontend.institutionPortal.dashboard.programs.course-catalog.modals.view')

@endsection
