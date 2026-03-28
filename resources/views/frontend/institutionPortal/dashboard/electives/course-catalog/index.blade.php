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
    <div class="row g-3 mb-5">

<div class="col-md-3">
    <div class="stat-card-custom p-4 glass-card">
        <div class="d-flex align-items-center gap-3">
            <div class="stat-icon"><i class="bi bi-book"></i></div>
            <div>
                <p class="small mb-0">Total Courses</p>
                <h4 class="mb-0">{{ $totalCourses }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="stat-card-custom p-4 glass-card">
        <div class="d-flex align-items-center gap-3">
            <div class="stat-icon"><i class="bi bi-check-circle"></i></div>
            <div>
                <p class="small mb-0">Active Courses</p>
                <h4 class="mb-0">{{ $activeCourses }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="stat-card-custom p-4 glass-card">
        <div class="d-flex align-items-center gap-3">
            <div class="stat-icon"><i class="bi bi-x-circle"></i></div>
            <div>
                <p class="small mb-0">Inactive Courses</p>
                <h4 class="mb-0">{{ $inactiveCourses }}</h4>
            </div>
        </div>
    </div>
</div>

</div>

    </div>

    <!-- ================= FILTERS ================= -->
    <div class="glass-card p-4 mb-4">
    <h6 class="fw-semibold mb-3">Search & Filters</h6>

    <form method="GET">
        <div class="row g-3">

            <div class="col-md-4">
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Search courses"
                       value="{{ request('search') }}">
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
    <h5 class="fw-semibold mb-0">
    Courses ({{ $electives->count() }})
</h5>
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
                                <a class="dropdown-item" onclick="viewCourse({{ $course->elective_id }})">
                                    View
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" onclick="editCourse({{ $course->elective_id }})">Edit</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" onclick="deleteCourse({{ $course->elective_id }})">Delete</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" onclick="toggleStatus({{ $course->elective_id }})">
                                    {{ $course->status ? 'Deactivate' : 'Activate' }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <p class="small mb-2">by {{ $course->faculty->name }}</p>

                <div class="d-flex gap-2 mb-3 flex-wrap">
                    <span class="skill-tag">{{ $course->category->name ?? '' }}</span>

                    @foreach($course->skills as $skill)
                    <span class="skill-tag highlight">
                        {{ $skill->name }}
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


{{-- ================= SCRIPTS ================= --}}
@include('frontend.institutionPortal.dashboard.electives.course-catalog.scripts')
@endsection