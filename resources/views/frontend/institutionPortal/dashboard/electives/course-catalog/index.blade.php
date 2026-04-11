@extends('frontend.institutionPortal.layout.app')

@section('page_title', 'Course Catalog')
@section('title', 'Course Catalog')

@section('content')
<div class="container-fluid py-4">

    <!-- ================= PAGE HEADER ================= -->
    <div class="ui-page-header d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="ui-icon-box">
                <i class="bi bi-book"></i>
            </div>
            <div>
                <h5 class="mb-1">Course Catalog</h5>
                <small class="ui-muted">
                    Manage courses, visibility, enrollments, and pricing
                </small>
            </div>
        </div>

        <button class="btn btn-teal"
            data-bs-toggle="modal"
            data-bs-target="#createCourseModal">
            <i class="bi bi-plus-lg me-2"></i> Add Course
        </button>
    </div>


    <!-- ================= STATS ================= -->
    <div class="row g-3 mb-4">

        <div class="col-md-3">
            <div class="ui-stats-card">
                <div class="stats-icon">
                    <i class="bi bi-book"></i>
                </div>
                <div>
                    <h4>{{ $totalCourses }}</h4>
                    <small>Total Courses</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="ui-stats-card">
                <div class="stats-icon success">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div>
                    <h4>{{ $activeCourses }}</h4>
                    <small>Active Courses</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="ui-stats-card">
                <div class="stats-icon danger">
                    <i class="bi bi-x-circle"></i>
                </div>
                <div>
                    <h4>{{ $inactiveCourses }}</h4>
                    <small>Inactive Courses</small>
                </div>
            </div>
        </div>

    </div>


    <!-- ================= FILTERS ================= -->
    <div class="ui-card mb-4">
        <div class="ui-card-title mb-3">Search & Filters</div>

        <form method="GET">
            <div class="row g-3">

                <div class="col-md-4">
                    <div class="input-group-custom">
                        <i class="bi bi-search"></i>
                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="Search courses"
                               value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <select name="category_id" class="form-select">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-teal w-100">Filter</button>
                </div>

            </div>
        </form>
    </div>


    <!-- ================= LIST HEADER ================= -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="mb-0">
            Courses ({{ $electives->count() }})
        </h6>

        <div class="d-flex align-items-center gap-2">
            <button class="icon-btn">
                <i class="bi bi-download"></i>
            </button>
        </div>
    </div>


    <!-- ================= COURSE CARDS ================= -->
    <div class="row g-3">
        @foreach($electives as $course)
        <div class="col-md-6">
            <div class="ui-card h-100">

                <div class="ui-card-header">
                    <div>
                        <div class="ui-card-title">
                            {{ $course->elective_title }}
                        </div>
                        <div class="ui-card-subtitle">
                            by {{ $course->faculty->name }}
                        </div>
                    </div>

                    <div class="dropdown">
                        <button class="icon-btn" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" onclick="viewCourse({{ $course->elective_id }})">
                                    View
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" onclick="editCourse({{ $course->elective_id }})">
                                    Edit
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-danger"
                                   onclick="deleteCourse({{ $course->elective_id }})">
                                    Delete
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item"
                                   onclick="toggleStatus({{ $course->elective_id }})">
                                    {{ $course->status ? 'Deactivate' : 'Activate' }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="ui-meta mt-2 mb-2">
                    <span>{{ $course->category->name ?? '' }}</span>
                    <span>{{ $course->duration }}</span>
                    <span>{{ $course->start_date }}</span>
                </div>

                <div class="d-flex flex-wrap gap-2 mb-2">
                    @foreach($course->skills as $skill)
                        <span class="skill-chip">
                            {{ $skill->name }}
                        </span>
                    @endforeach
                </div>

                <p class="small mb-3">{{ $course->description }}</p>

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

{{-- ================= SCRIPTS ================= --}}
@include('frontend.institutionPortal.dashboard.electives.course-catalog.scripts')

@endsection