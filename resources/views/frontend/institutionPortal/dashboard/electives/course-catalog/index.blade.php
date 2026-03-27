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
    <div class="row g-3">
@foreach($electives as $course)
<div class="col-md-6">
    <div class="program-card-custom glass-card p-4 h-100">

        <div class="d-flex justify-content-between align-items-start mb-2">
            <h5 class="fw-bold mb-0">{{ $course->elective_title }}</h5>

            <div class="dropdown">
                <button class="icon-btn" data-bs-toggle="dropdown">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item viewCourse"
                           data-id="{{ $course->elective_id }}">
                           View
                        </a>
                    </li>
                    <li>
                    <a class="dropdown-item" onclick="editCourse({{ $course->elective_id }})">Edit</a>
                    </li>
                    <li>
                    <a class="dropdown-item text-danger" onclick="deleteCourse({{ $course->elective_id }})">Delete</a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                    <a class="dropdown-item" onclick="toggleStatus({{ $course->elective_id }})">
    {{ $course->status ? 'Deactivate' : 'Activate' }}
</a>
                    </li>
                </ul>
            </div>
        </div>

        <p class="small mb-2">by {{ $course->instructor_name }}</p>

        <div class="d-flex gap-2 mb-3 flex-wrap">
            <span class="skill-tag">{{ $course->category->category_name ?? '' }}</span>

            @foreach($course->skills as $skill)
                <span class="skill-tag highlight">
                    {{ $skill->subcategory_name }}
                </span>
            @endforeach
        </div>

        <p class="mb-3">{{ $course->description }}</p>

        <div class="row g-2 small mb-3">
            <div class="col-6">
                <i class="bi bi-clock me-1"></i> {{ $course->duration }}
            </div>
            <div class="col-6">
                <i class="bi bi-calendar me-1"></i> {{ $course->start_date }}
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <strong class="text-teal">₹{{ $course->price }}</strong>

            <span class="status-pill {{ $course->status ? 'active' : 'inactive' }}">
                {{ $course->status ? 'Active' : 'Inactive' }}
            </span>
        </div>

    </div>
</div>
@endforeach
</div>

</div>

{{-- ================= MODALS ================= --}}
@include('frontend.institutionPortal.dashboard.electives.course-catalog.modals.create')
@include('frontend.institutionPortal.dashboard.electives.course-catalog.modals.edit')
@include('frontend.institutionPortal.dashboard.electives.course-catalog.modals.view')

@endsection
