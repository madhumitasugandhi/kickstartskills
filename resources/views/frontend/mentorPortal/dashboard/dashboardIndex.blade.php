@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Dashboard')

@section('icon', 'bi bi-house-door fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')
@if(session('success'))
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1100">
    <div class="toast show align-items-center text-white bg-success border-0 shadow-lg" role="alert"
        aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>
</div>

<script>
    // Auto-hide the toast after 3 seconds
    setTimeout(() => {
        $('.toast').fadeOut();
    }, 3000);
</script>
@endif
<div class="card-custom border-0"
    style="background: linear-gradient(135deg, rgba(255, 140, 0, 0.15) 0%, rgba(30, 41, 59, 0) 100%);">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-soft-orange p-3 rounded-4 d-flex align-items-center justify-content-center"
                style="width: 56px; height: 56px;">
                <i class="bi bi-person-fill fs-3 text-accent"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-1 text-main">Welcome back, {{ Auth::user()->full_name }}!</h5>
                <p class="text-muted-custom mb-0 small">You have {{ $stats['assigned_students'] }} students assigned to
                    you.</p>
            </div>
        </div>
        <span class="badge bg-soft-green text-green rounded-pill px-3 py-2">
            <i class="bi bi-circle-fill small me-1" style="font-size: 6px;"></i> Active
        </span>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="card-custom h-100 d-flex flex-column justify-content-between mb-0">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div class="bg-soft-blue p-2 rounded-3 text-blue">
                    <i class="bi bi-person-video2 fs-5"></i>
                </div>
                <span class="badge bg-soft-blue text-blue rounded-pill">+{{ $stats['new_students_count'] }}</span>
            </div>
            <div>
                <h4 class="fw-bold text-main mb-1">{{ $stats['assigned_students'] }}</h4>
                <span class="text-muted-custom small">Assigned Students</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card-custom h-100 d-flex flex-column justify-content-between mb-0">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div class="bg-soft-blue p-2 rounded-3 text-blue"
                    style="background-color: rgba(13, 110, 253, 0.1) !important;">
                    <i class="bi bi-calendar-check fs-5"></i>
                </div>
                {{-- ADD THIS BADGE BELOW --}}
                <span class="badge bg-soft-blue text-blue rounded-pill">{{ $stats['sessions_today'] }} Today</span>
            </div>
            <div>
                <h4 class="fw-bold text-main mb-1">{{ $stats['active_sessions'] }}</h4>
                <span class="text-muted-custom small">Active Sessions</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card-custom h-100 d-flex flex-column justify-content-between mb-0">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div class="bg-soft-green p-2 rounded-3 text-green">
                    <i class="bi bi-check-circle fs-5"></i>
                </div>
                <span class="badge bg-soft-green text-green rounded-pill">+5</span>
            </div>
            <div>
                <h4 class="fw-bold text-main mb-1">{{ $stats['completed_tasks'] }}</h4>
                <span class="text-muted-custom small">Completed Tasks</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card-custom h-100 d-flex flex-column justify-content-between mb-0">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div class="bg-soft-orange p-2 rounded-3 text-accent">
                    <i class="bi bi-graph-up-arrow fs-5"></i>
                </div>
                <span class="badge bg-soft-orange text-accent rounded-pill">+3%</span>
            </div>
            <div>
                <h4 class="fw-bold text-main mb-1">{{ $stats['avg_progress'] }}%</h4>
                <span class="text-muted-custom small">Avg. Progress</span>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">

    <div class="col-lg-8">
        <div class="card-custom h-100 mb-0">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="fw-bold m-0 text-main">Assigned Students</h6>
                <a href="{{ route('mentor.students.assigned') }}"
                    class="text-accent text-decoration-none small fw-bold">
                    <i class="bi bi-box-arrow-up-right me-1"></i> View All
                </a>
            </div>

            <div class="d-flex flex-column gap-3">
                @forelse($students as $student)
                <div class="p-3 rounded-3" style="background-color: var(--bg-hover);">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-soft-orange text-orange d-flex align-items-center justify-content-center fw-bold"
                                style="width: 40px; height: 40px; font-size: 0.9rem;">
                                {{ strtoupper(substr($student->full_name, 0, 2)) }}
                            </div>
                            <div>
                                <h6 class="fw-bold text-main mb-0" style="font-size: 0.9rem;">
                                    <a href="{{ route('mentor.students.show', $student->id) }}"
                                        class="text-decoration-none text-main hover-accent">
                                        {{ $student->full_name }}
                                    </a>
                                </h6>
                                <small class="text-muted-custom" style="font-size: 0.75rem;">Status: {{
                                    ucfirst($student->account_status) }}</small>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-link text-muted-custom p-0" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bi bi-three-dots-vertical small"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3">
                                <li>
                                    <a class="dropdown-item small"
                                        href="{{ route('mentor.students.show', $student->id) }}">
                                        <i class="bi bi-person-lines-fill me-2 text-primary"></i> View Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item small" href="#" data-bs-toggle="modal"
                                        data-bs-target="#messageModal">
                                        <i class="bi bi-chat-left-text me-2 text-success"></i> Send Message
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider opacity-50">
                                </li>
                                <li>
                                    <a class="dropdown-item small text-danger" href="#">
                                        <i class="bi bi-person-x me-2"></i> Unassign Student
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center p-4">
                    <i class="bi bi-people --text-muted fs-1 d-block mb-2"></i>
                    <p class="--text-muted small">No students assigned to you yet.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        {{-- 5. UPCOMING SESSIONS LIST --}}
        <div class="card-custom mb-4">
            <h6 class="fw-bold mb-3 text-main">Upcoming Sessions</h6>
            <div class="d-flex flex-column gap-2 mb-3">
                @forelse($upcomingSessions as $session)
                <div class="d-flex align-items-start gap-3 p-2 rounded-3 border border-dark-subtle"
                    style="background-color: var(--bg-hover);">
                    <div class="bg-soft-blue p-2 rounded-2 text-blue mt-1">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                    <div class="flex-grow-1">
                        {{-- FIXED: 'payload' ki jagah 'session_title' use kiya --}}
                        <h6 class="fw-bold text-main mb-0" style="font-size: 0.85rem;">
                            {{ $session->session_title }}
                        </h6>
                        <div class="d-flex justify-content-between align-items-center mt-1">
                            {{-- FIXED: 'last_activity' ki jagah 'session_time' use kiya --}}
                            <small class="text-muted-custom" style="font-size: 0.75rem;">
                                <i class="bi bi-clock me-1"></i> {{ date('h:i A', strtotime($session->session_time)) }}
                            </small>
                            <small class="text-blue fw-bold" style="font-size: 0.7rem;">
                                {{ \Carbon\Carbon::parse($session->session_date)->format('d M') }}
                            </small>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-3">
                    <p class="text-muted small mb-0">No upcoming sessions scheduled.</p>
                </div>
                @endforelse
            </div>
            {{-- Is button ko replace karo --}} <a href="{{ route('mentor.sessions.schedule') }}"
                class="btn btn-primary w-100 fw-bold" style="background-color: var(--accent-color); border: none;">
                <i class="bi bi-plus me-1"></i> Schedule Session
            </a>
        </div>

        {{-- QUICK ACTIONS (Keeping this for you!) --}}
        <div class="card-custom mb-0">
            <h6 class="fw-bold mb-3 text-main">Quick Actions</h6>
            <div class="d-flex flex-column gap-2">
                {{-- "Schedule Meeting" wali button ko isse replace karo --}}
                <a href="{{ route('mentor.sessions.schedule') }}"
                    class="btn-quick-action m-0 d-flex justify-content-between align-items-center text-decoration-none">
                    <div class="d-flex align-items-center gap-3">
                        <div class="action-icon bg-soft-blue text-blue"
                            style="width: 32px; height: 32px; font-size: 0.9rem;">
                            <i class="bi bi-calendar-plus"></i>
                        </div>
                        <span class="fw-medium text-main">Schedule Meeting</span>
                    </div>
                    <i class="bi bi-chevron-right small text-muted-custom"></i>
                </a>

                <button class="btn-quick-action m-0 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <div class="action-icon bg-soft-blue text-blue"
                            style="width: 32px; height: 32px; font-size: 0.9rem;">
                            <i class="bi bi-chat-dots"></i>
                        </div>
                        <span class="fw-medium text-main">Send Message</span>
                    </div>
                    <i class="bi bi-chevron-right small text-muted-custom"></i>
                </button>
                <a href="#"
                    class="btn-quick-action m-0 d-flex justify-content-between align-items-center text-decoration-none">
                    <div class="d-flex align-items-center gap-3">
                        <div class="action-icon bg-soft-green text-green"
                            style="width: 32px; height: 32px; font-size: 0.9rem;">
                            <i class="bi bi-check2-square"></i>
                        </div>
                        <span class="fw-medium text-main">Review Tasks</span>
                    </div>
                    <i class="bi bi-chevron-right small text-muted-custom"></i>
                </a>
                {{-- <button class="btn-quick-action m-0 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <div class="action-icon bg-soft-green text-green"
                            style="width: 32px; height: 32px; font-size: 0.9rem;">
                            <i class="bi bi-check2-square"></i>
                        </div>
                        <span class="fw-medium text-main">Review Tasks</span>
                    </div>
                    <i class="bi bi-chevron-right small text-muted-custom"></i>
                </button> --}}

                <a href="{{ route('mentor.reports.mentoring') }}"
                    class="btn-quick-action m-0 d-flex justify-content-between align-items-center text-decoration-none">
                    <div class="d-flex align-items-center gap-3">
                        <div class="action-icon bg-soft-orange text-accent"
                            style="width: 32px; height: 32px; font-size: 0.9rem;">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <span class="fw-medium text-main">Generate Report</span>
                    </div>
                    <i class="bi bi-chevron-right small text-muted-custom"></i>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
