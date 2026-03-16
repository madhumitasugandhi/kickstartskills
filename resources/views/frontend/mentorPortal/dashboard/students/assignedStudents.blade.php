@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Assigned Students')
@section('icon', 'bi bi-person-lines-fill fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')

{{-- 1. SUCCESS/ERROR ALERTS --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger border-0 shadow-sm mb-4" role="alert">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li><i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card-custom mb-4"
    style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px;">
    <div
        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold text-main mb-1">Assigned Students</h4>
            <p class="--text-muted-custom mb-0 small">Manage and track your student progress</p>
        </div>

        {{-- 2. UPDATED BUTTON TO TRIGGER MODAL --}}
        <button class="btn btn-primary fw-bold px-4 w-100 w-md-auto" data-bs-toggle="modal"
            data-bs-target="#addStudentModal" style="background-color: var(--accent-color); border: none;">
            <i class="bi bi-plus-lg me-2"></i>Add Student
        </button>
    </div>

    <div class="row g-3">
        <div class="col-lg-6">
            <form action="{{ route('mentor.students.assigned') }}" method="GET">
                <div class="input-group">
                    <span class="input-group-text ..."><i class="bi bi-search"></i></span>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control ..."
                        placeholder="Search students...">
                </div>
            </form>
        </div>

        <div class="col-lg-6">
            <div class="d-flex flex-wrap gap-2 justify-content-start justify-content-lg-end">
                <div class="btn-group" role="group">
                    <input type="radio" class="btn-check" name="status" id="statusAll" checked>
                    <label class="btn btn-outline-secondary btn-sm" for="statusAll">All</label>

                    <input type="radio" class="btn-check" name="status" id="statusOnline">
                    <label class="btn btn-outline-secondary btn-sm" for="statusOnline">Online</label>

                    <input type="radio" class="btn-check" name="status" id="statusOffline">
                    <label class="btn btn-outline-secondary btn-sm" for="statusOffline">Offline</label>
                </div>

                <div class="d-flex gap-2 flex-wrap">
                    <span
                        class="badge bg-soft-blue text-blue rounded-pill px-3 py-2 cursor-pointer border border-primary-subtle">
                        Foundation
                    </span>
                    <span
                        class="badge bg-soft-orange text-accent rounded-pill px-3 py-2 cursor-pointer border border-warning-subtle">
                        Advanced
                    </span>
                    <span
                        class="badge bg-soft-teal text-teal rounded-pill px-3 py-2 cursor-pointer border border-info-subtle">
                        Projects
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 g-md-4 mb-4">
    <div class="col-6 col-md-3">
        <a href="{{ route('mentor.students.assigned', ['status' => 'all']) }}" class="text-decoration-none">
            <div class="card-custom text-center py-4 mb-0 h-100"
                style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px;">
                <div class="bg-soft-blue mx-auto rounded-circle d-flex align-items-center justify-content-center mb-3"
                    style="width: 50px; height: 50px;">
                    <i class="bi bi-people fs-4 text-blue"></i>
                </div>
                <h3 class="fw-bold text-blue mb-1">{{ $stats['total'] }}</h3>
                <span class="text-muted-custom small fw-medium">Total Assigned</span>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <div class="card-custom text-center py-4 mb-0 h-100"
            style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px;">
            <div class="bg-soft-green mx-auto rounded-circle d-flex align-items-center justify-content-center mb-3"
                style="width: 50px; height: 50px;">
                <i class="bi bi-globe fs-4 text-green"></i>
            </div>
            <h3 class="fw-bold text-green mb-1">3</h3>
            <span class="text-muted-custom small fw-medium">Online Now</span>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card-custom text-center py-4 mb-0 h-100"
            style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px;">
            <div class="bg-soft-blue mx-auto rounded-circle d-flex align-items-center justify-content-center mb-3"
                style="width: 50px; height: 50px; background-color: rgba(13, 110, 253, 0.1);">
                <i class="bi bi-graph-up-arrow fs-4 text-primary"></i>
            </div>
            <h3 class="fw-bold text-primary mb-1">88%</h3>
            <span class="text-muted-custom small fw-medium">Avg Progress</span>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <a href="{{ route('mentor.students.assigned', ['status' => 'attention']) }}" class="text-decoration-none">
            <div class="card-custom text-center py-4 mb-0 h-100"
                style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px;">

                <div class="{{ $stats['needs_attention'] > 0 ? 'bg-soft-red' : 'bg-soft-orange' }} mx-auto rounded-circle d-flex align-items-center justify-content-center mb-3"
                    style="width: 50px; height: 50px;">
                    <i
                        class="bi bi-exclamation-circle fs-4 {{ $stats['needs_attention'] > 0 ? 'text-danger' : 'text-accent' }}"></i>
                </div>

                <h3 class="fw-bold {{ $stats['needs_attention'] > 0 ? 'text-danger' : 'text-accent' }} mb-1">
                    {{ $stats['needs_attention'] }}
                </h3>

                <span class="text-muted-custom small fw-medium">Needs Attention</span>
            </div>
        </a>
    </div>
</div>

<div class="row g-4">
    @forelse($students as $student)
    <div class="col-lg-6">
        <div class="card-custom h-100 mb-0 position-relative overflow-hidden"
            style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px;">

            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="d-flex gap-3">
                    <div class="position-relative">
                        <div class="rounded-circle bg-soft-blue text-blue d-flex align-items-center justify-content-center fw-bold fs-5"
                            style="width: 56px; height: 56px;">
                            {{ strtoupper(substr($student->full_name, 0, 2)) }}
                        </div>
                        <span
                            class="position-absolute bottom-0 end-0 p-1 bg-success border-2 border-white rounded-circle"></span>
                    </div>
                    <div>
                        <h5 class="fw-bold text-main mb-1">{{ $student->full_name }}</h5>
                        <small class="text-muted-custom d-block mb-1">Assigned Student</small>
                        @if($student->account_status == 'suspended')
                        <span class="badge bg-soft-red text-danger rounded-pill small">
                            <i class="bi bi-x-circle me-1"></i> Suspended
                        </span>
                        @elseif($student->account_status == 'deactivated')
                        <span class="badge bg-secondary text-white rounded-pill small">
                            <i class="bi bi-pause-circle me-1"></i> Inactive
                        </span>
                        @elseif($student->account_status == 'pending')
                        <span class="badge bg-soft-orange text-accent rounded-pill small">
                            <i class="bi bi-clock-history me-1"></i> Pending
                        </span>
                        @else
                        <span class="badge bg-soft-blue text-blue rounded-pill small">
                            <i class="bi bi-check-circle me-1"></i> Active Phase
                        </span>
                        @endif
                    </div>
                </div>
                <div class="dropdown">
                    <button class="btn btn-link text-muted-custom p-0" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('mentor.students.show', $student->id) }}">View
                                Profile</a></li>
                        <li><a class="dropdown-item" href="#">Message</a></li>
                    </ul>
                </div>
            </div>

            <div class="mb-4">
                <div class="d-flex justify-content-between small mb-1">
                    <span class="text-muted-custom">Overall Progress</span>
                    <span class="fw-bold text-primary">85%</span>
                </div>
                <div class="progress" style="height: 6px; background-color: var(--bg-hover);">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 85%"></div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mb-4">
                <span class="badge bg-soft-green text-green rounded-pill fw-normal px-3">Attendance: 92%</span>
                <span class="badge bg-soft-blue text-blue rounded-pill fw-normal px-3">Score: 90</span>
            </div>

            <div class="border-top pt-3 d-flex justify-content-between align-items-center"
                style="border-color: var(--border-color) !important;">
                <small class="text-muted-custom">Joined: {{ $student->created_at->diffForHumans() }}</small>
                <a href="{{ route('mentor.students.show', $student->id) }}"
                    class="btn btn-sm btn-outline-primary rounded-pill px-3">
                    View Details
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <div class="card-custom p-5">
            <i class="bi bi-people --text-muted fs-1"></i>
            <p class="mt-3 --text-muted">No students found assigned to you.</p>
        </div>
    </div>
    @endforelse
</div>

{{-- 3. THE ADD STUDENT MODAL --}}
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="background-color: var(--bg-card); border-radius: 15px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="fw-bold text-main m-0"><i class="bi bi-person-plus-fill me-2 text-accent"></i>Register New
                    Student</h5>
                <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('mentor.students.store') }}" method="POST">
                @csrf
                <div class="modal-body py-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold small --text-muted">FULL NAME</label>
                        <input type="text" name="full_name" class="form-control border-0 py-2"
                            style="background-color: var(--bg-body); color: var(--text-main);"
                            placeholder="e.g. Rahul Sharma" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small --text-muted">ACCOUNT STATUS</label>
                        <select name="account_status" class="form-select border-0 py-2"
                            style="background-color: var(--bg-body); color: var(--text-main); appearance: auto;">
                            <option value="active" selected>Active</option>
                            <option value="pending">Pending</option>
                            <option value="deactivated">Deactivated / Inactive</option>
                            <option value="suspended">Suspended</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small --text-muted">EMAIL ADDRESS</label>
                        <input type="email" name="email" class="form-control border-0 py-2"
                            style=" color: var(--text-main);" placeholder="rahul@example.com" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-bold small --text-muted">TEMPORARY PASSWORD</label>
                        <input type="password" name="password" class="form-control border-0 py-2"
                            style=" color: var(--text-main);" placeholder="Minimum 8 characters" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-link --text-muted text-decoration-none fw-bold"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4 fw-bold"
                        style="background-color: var(--accent-color); border: none; border-radius: 8px;">
                        Create Student
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
