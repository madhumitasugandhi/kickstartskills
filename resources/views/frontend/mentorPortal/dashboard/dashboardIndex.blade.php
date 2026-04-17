@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Dashboard')
@section('icon', 'bi bi-house-door fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')

{{-- 1. SUCCESS TOAST --}}
@if(session('success'))
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1100">
    <div class="toast show align-items-center text-white bg-success border-0 shadow-lg" role="alert">
        <div class="d-flex">
            <div class="toast-body"><i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
<script>
    setTimeout(() => { $('.toast').fadeOut(); }, 3000);
</script>
@endif

{{-- 2. LIVE MEETING ALERT --}}
@if(isset($currentSession) && $currentSession)
<div class="card-custom border-start border-primary border-4 mb-4 shadow-sm animate__animated animate__fadeInDown"
    style="background: rgba(13, 110, 253, 0.05);">
    <div class="d-flex justify-content-between align-items-center p-1">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-soft-blue text-primary p-3 rounded-circle d-flex align-items-center justify-content-center"
                style="width: 50px; height: 50px;">
                <i class="bi bi-camera-video-fill fs-4"></i>
            </div>
            <div>
                <h6 class="fw-bold mb-1 text-main">Live Meeting Now: {{ $currentSession->session_title }}</h6>
                <p class="text-muted-custom small mb-0">Started at {{ date('h:i A',
                    strtotime($currentSession->session_time)) }}</p>
            </div>
        </div>
        <a href="{{ $currentSession->meeting_url }}" target="_blank"
            class="btn btn-primary fw-bold px-4 rounded-pill shadow-sm">
            <i class="bi bi-box-arrow-up-right me-2"></i> Join Now
        </a>
    </div>
</div>
@endif

{{-- 3. WELCOME CARD --}}
<div class="card-custom border-0 mb-4"
    style="background: linear-gradient(135deg, rgba(255, 140, 0, 0.15) 0%, rgba(30, 41, 59, 0) 100%);">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-soft-orange p-3 rounded-4 d-flex align-items-center justify-content-center"
                style="width: 56px; height: 56px;">
                <i class="bi bi-person-fill fs-3 text-accent"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-1 text-main">Welcome back, {{ Auth::user()->full_name }}!</h5>
                <p class="text-muted-custom mb-0 small">You have {{ $stats['assigned_students'] ?? 0 }} students
                    assigned.</p>
            </div>
        </div>
        <span class="badge bg-soft-green text-green rounded-pill px-3 py-2">Active</span>
    </div>
</div>

{{-- 4. STATS ROW (CONTROLLER SYNCED) --}}
<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3">
        <div
            class="card-custom h-100 d-flex flex-column justify-content-between mb-0 border-start border-primary border-3">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div class="bg-soft-blue p-2 rounded-3 text-blue"><i class="bi bi-people fs-5"></i></div>
                <span class="badge bg-soft-blue text-blue rounded-pill">+{{ $stats['new_students_count'] ?? 0 }}</span>
            </div>
            <div>
                <h4 class="fw-bold text-main mb-1">{{ $stats['assigned_students'] ?? 0 }}</h4>
                <span class="text-muted-custom small">Total Students</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div
            class="card-custom h-100 d-flex flex-column justify-content-between mb-0 border-start border-success border-3">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div class="bg-soft-green p-2 rounded-3 text-green"><i class="bi bi-calendar-check fs-5"></i></div>
                <span class="badge bg-soft-green text-green rounded-pill">{{ $stats['sessions_today'] ?? 0 }}
                    Today</span>
            </div>
            <div>
                <h4 class="fw-bold text-main mb-1">{{ $stats['scheduled_sessions'] ?? 0 }}</h4>
                <span class="text-muted-custom small">Scheduled</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div
            class="card-custom h-100 d-flex flex-column justify-content-between mb-0 border-start border-info border-3">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div class="bg-soft-blue p-2 rounded-3 text-info"><i class="bi bi-check2-all fs-5"></i></div>
            </div>
            <div>
                <h4 class="fw-bold text-main mb-1">{{ $stats['completed_sessions'] ?? 0 }}</h4>
                <span class="text-muted-custom small">Completed</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div
            class="card-custom h-100 d-flex flex-column justify-content-between mb-0 border-start border-danger border-3">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div class="bg-soft-red p-2 rounded-3 text-red"><i class="bi bi-x-circle fs-5"></i></div>
            </div>
            <div>
                <h4 class="fw-bold text-main mb-1">{{ $stats['cancelled_sessions'] ?? 0 }}</h4>
                <span class="text-muted-custom small">Cancelled</span>
            </div>
        </div>
    </div>
</div>

{{-- 5. MAIN CONTENT ROW --}}
<div class="row g-4">
    {{-- LEFT: STUDENTS --}}
    <div class="col-lg-8">
        <div class="card-custom h-100 mb-0">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="fw-bold m-0 text-main">Assigned Students</h6>
                <a href="{{ route('mentor.students.assigned') }}"
                    class="text-accent text-decoration-none small fw-bold">View All</a>
            </div>
            <div class="d-flex flex-column gap-3">
                @forelse($students as $student)
                <div class="p-3 rounded-3" style="background-color: var(--bg-hover);">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-soft-orange text-orange d-flex align-items-center justify-content-center fw-bold"
                                style="width: 40px; height: 40px;">
                                {{ strtoupper(substr($student->full_name, 0, 2)) }}
                            </div>
                            <div>
                                <h6 class="fw-bold text-main mb-0"><a
                                        href="{{ route('mentor.students.show', $student->id) }}"
                                        class="text-decoration-none text-main">{{ $student->full_name }}</a></h6>
                                <small class="text-muted-custom">Status: {{ ucfirst($student->account_status) }}</small>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-link text-muted-custom p-0" data-bs-toggle="dropdown"><i
                                    class="bi bi-three-dots-vertical"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3">
                                <li><a class="dropdown-item small"
                                        href="{{ route('mentor.students.show', $student->id) }}"><i
                                            class="bi bi-person-lines-fill me-2 text-primary"></i> Profile</a></li>
                                <li><a class="dropdown-item small text-danger" href="#"><i
                                            class="bi bi-person-x me-2"></i> Unassign</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center p-4">
                    <p class="--text-muted small">No students found.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- RIGHT: SESSIONS & QUICK ACTIONS --}}
    <div class="col-lg-4">
        {{-- UPCOMING SESSIONS (DYNAMIC STATUS) --}}
        <div class="card-custom mb-4">
            <h6 class="fw-bold mb-3 text-main">Sessions Schedule</h6>
            <div class="d-flex flex-column gap-3 mb-3">
                @forelse($upcomingSessions as $session)
                @php
                $sessionDT = \Carbon\Carbon::parse($session->session_date . ' ' . $session->session_time);
                $isPast = $sessionDT->isPast();
                @endphp
                <div class="p-2 rounded-3 border border-dark-subtle" style="background-color: var(--bg-hover);">
                    <div class="d-flex align-items-start gap-3">
                        <div
                            class="{{ $isPast ? 'bg-soft-green text-green' : 'bg-soft-blue text-blue' }} p-2 rounded-2 mt-1">
                            <i class="bi {{ $isPast ? 'bi-check-circle' : 'bi-calendar-event' }}"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-bold text-main mb-0" style="font-size: 0.85rem;">{{
                                    $session->session_title }}</h6>
                                @if($isPast)
                                <span class="badge bg-soft-green text-green" style="font-size: 0.6rem;">Completed</span>
                                @else
                                <span class="badge bg-soft-green text-green" style="font-size: 0.6rem;">Scheduled</span>
                                @endif
                            </div>
                            <small class="text-muted-custom" style="font-size: 0.75rem;">
                                {{ date('h:i A', strtotime($session->session_time)) }} | {{
                                \Carbon\Carbon::parse($session->session_date)->format('d M') }}
                            </small>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-3">
                    <p class="--text-muted small mb-0">No upcoming sessions.</p>
                </div>
                @endforelse
            </div>
            <a href="{{ route('mentor.sessions.schedule') }}" class="btn btn-primary w-100 fw-bold shadow-sm">Schedule
                Session</a>
        </div>

        {{-- QUICK ACTIONS (SCREENSHOT SYNCED) --}}
        <div class="card-custom">
            <h6 class="fw-bold mb-3 text-main">Quick Actions</h6>
            <div class="d-flex flex-column gap-2">
                <a href="{{ route('mentor.sessions.schedule') }}"
                    class="btn-quick-action m-0 d-flex justify-content-between align-items-center text-decoration-none p-2 rounded-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="action-icon bg-soft-blue text-blue shadow-sm"
                            style="width: 32px; height: 32px; font-size: 0.9rem;"><i class="bi bi-calendar-plus"></i>
                        </div>
                        <span class="fw-medium text-main">Schedule Meeting</span>
                    </div>
                    <i class="bi bi-chevron-right small text-muted-custom"></i>
                </a>
                <a href="#"
                    class="btn-quick-action m-0 d-flex justify-content-between align-items-center text-decoration-none p-2 rounded-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="action-icon bg-soft-blue text-blue shadow-sm"
                            style="width: 32px; height: 32px; font-size: 0.9rem;"><i class="bi bi-chat-left-dots"></i>
                        </div>
                        <span class="fw-medium text-main">Send Message</span>
                    </div>
                    <i class="bi bi-chevron-right small text-muted-custom"></i>
                </a>
                <a href="#"
                    class="btn-quick-action m-0 d-flex justify-content-between align-items-center text-decoration-none p-2 rounded-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="action-icon bg-soft-green text-green shadow-sm"
                            style="width: 32px; height: 32px; font-size: 0.9rem;"><i class="bi bi-check2-square"></i>
                        </div>
                        <span class="fw-medium text-main">Review Tasks</span>
                    </div>
                    <i class="bi bi-chevron-right small text-muted-custom"></i>
                </a>
                <a href="{{ route('mentor.reports.mentoring') }}"
                    class="btn-quick-action m-0 d-flex justify-content-between align-items-center text-decoration-none p-2 rounded-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="action-icon bg-soft-orange text-accent shadow-sm"
                            style="width: 32px; height: 32px; font-size: 0.9rem;"><i
                                class="bi bi-file-earmark-text"></i></div>
                        <span class="fw-medium text-main">Generate Report</span>
                    </div>
                    <i class="bi bi-chevron-right small text-muted-custom"></i>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
