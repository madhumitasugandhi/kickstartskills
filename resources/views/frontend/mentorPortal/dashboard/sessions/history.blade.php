@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Session History')
@section('icon', 'bi bi-clock-history fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')

<div class="card-custom mb-4">
    <div class="d-flex align-items-center gap-3">
        <div class="fs-4 p-2 bg-soft-orange rounded-3 text-accent">
            <i class="bi bi-clock-history fs-3"></i>
        </div>
        <div>
            <h4 class="fw-bold text-main mb-1">Session History</h4>
            <p class="text-muted-custom mb-0 small">Review your past mentoring sessions and feedback</p>
        </div>
    </div>
</div>

<div class="card-custom mb-4">
    <h6 class="fw-bold text-main mb-3">Filters & Search</h6>
    <div class="row g-3 align-items-end">
        <div class="col-lg-6">
            <div class="input-group">
                <span class="input-group-text border-end-0 d-flex align-items-center justify-content-center"
                    style="background-color: var(--bg-hover); border-color: var(--border-color); min-width: 45px;">
                    <i class="bi bi-search  " style="color: var(--text-muted);"></i>
                </span>
                <input type="text" class="form-control border-start-0 ps-0" placeholder="Search sessions..."
                    style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
            </div>
        </div>

        <div class="col-md-3">
            <label class="form-label small text-muted-custom fw-bold mb-1">Status Filter</label>
            <select class="form-select"
                style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                <option selected>All Sessions</option>
                <option>Completed</option>
                <option>Canceled</option>
                <option>Rescheduled</option>
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label small text-muted-custom fw-bold mb-1">Time Period</label>
            <select class="form-select"
                style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                <option selected>Last 30 days</option>
                <option>Last 3 Months</option>
                <option>This Year</option>
            </select>
        </div>
    </div>

    <div class="d-flex justify-content-around mt-4 pt-3 border-top"
        style="border-color: var(--border-color) !important;">
        <div class="text-center">
            <i class="bi bi-calendar-check text-primary mb-1 d-block"></i>
            <span class="fw-bold text-primary fs-5">6</span>
            <span class="d-block text-muted-custom small" style="font-size: 0.7rem;">Total Sessions</span>
        </div>
        <div class="text-center">
            <i class="bi bi-check-circle text-success mb-1 d-block"></i>
            <span class="fw-bold text-success fs-5">5</span>
            <span class="d-block text-muted-custom small" style="font-size: 0.7rem;">Completed</span>
        </div>
        <div class="text-center">
            <i class="bi bi-star text-accent mb-1 d-block"></i>
            <span class="fw-bold text-accent fs-5">4.7</span>
            <span class="d-block text-muted-custom small" style="font-size: 0.7rem;">Avg Rating</span>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card-custom text-center py-4 mb-0 h-100 bg-soft-green border border-success-subtle"
            style="background-color: rgba(25, 135, 84, 0.1);">
            <i class="bi bi-check-circle fs-1 text-success mb-2"></i>
            <h3 class="fw-bold text-success mb-1">5</h3>
            <span class="text-muted-custom fw-medium">Completed Sessions</span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-custom text-center py-4 mb-0 h-100 bg-soft-blue border border-primary-subtle"
            style="background-color: rgba(13, 110, 253, 0.1);">
            <i class="bi bi-clock fs-1 text-primary mb-2"></i>
            <h3 class="fw-bold text-primary mb-1">7.0h</h3>
            <span class="text-muted-custom fw-medium">Total Hours</span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-custom text-center py-4 mb-0 h-100 bg-soft-orange border border-warning-subtle"
            style="background-color: var(--soft-accent);">
            <i class="bi bi-star fs-1 text-accent mb-2"></i>
            <h3 class="fw-bold text-accent mb-1">4.7</h3>
            <span class="text-muted-custom fw-medium">Average Rating</span>
        </div>
    </div>
</div>

<h6 class="text-muted-custom mb-3 small fw-bold">6 sessions found</h6>

<div class="card-custom mb-4">
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div class="d-flex align-items-start gap-3">
            <div class="bg-soft-orange text-accent p-3 rounded-3 d-flex align-items-center justify-content-center">
                <i class="bi bi-eye fs-4"></i>
            </div>
            <div>
                <h5 class="fw-bold text-main mb-1">Code Review - React Components</h5>
                <p class="text-muted-custom mb-0 small">with <span class="text-main fw-bold">John Doe</span></p>
            </div>
        </div>
        <span class="badge bg-soft-green text-green rounded-pill px-3 py-2">Completed</span>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <small class="text-muted-custom d-block mb-1">Date</small>
            <div class="d-flex align-items-center gap-2 text-main fw-medium">
                <i class="bi bi-calendar3 text-primary"></i> 12 Dec 2025
            </div>
        </div>
        <div class="col-6 col-md-3">
            <small class="text-muted-custom d-block mb-1">Duration</small>
            <div class="d-flex align-items-center gap-2 text-main fw-medium">
                <i class="bi bi-hourglass-split text-primary"></i> 60 minutes
            </div>
        </div>
        <div class="col-6 col-md-3">
            <small class="text-muted-custom d-block mb-1">Rating</small>
            <div class="d-flex align-items-center gap-2 text-main fw-medium">
                <i class="bi bi-star-fill text-accent"></i> 4.8/5.0
            </div>
        </div>
        <div class="col-6 col-md-3">
            <small class="text-muted-custom d-block mb-1">Attendance</small>
            <div class="d-flex align-items-center gap-2 text-main fw-medium">
                <i class="bi bi-people text-primary"></i> 1/1
            </div>
        </div>
    </div>

    <div class="mb-3">
        <small class="text-muted-custom fw-bold d-block mb-2">Topics Covered:</small>
        <div class="d-flex gap-2 flex-wrap">
            <span class="badge bg-bg-hover text-muted-custom border border-secondary fw-normal px-3 py-2">React</span>
            <span
                class="badge bg-bg-hover text-muted-custom border border-secondary fw-normal px-3 py-2">Components</span>
            <span class="badge bg-bg-hover text-muted-custom border border-secondary fw-normal px-3 py-2">Best
                Practices</span>
        </div>
    </div>

    <div class="p-3 rounded-3 mb-3 border border-dark-subtle"
        style="background-color: var(--bg-hover); border-color: var(--border-color) !important;">
        <div class="d-flex align-items-center gap-2 mb-2 text-muted-custom small fw-bold">
            <i class="bi bi-chat-square-text"></i> Session Notes:
        </div>
        <p class="text-main mb-0 small" style="opacity: 0.9;">
            Great session! John made excellent progress on component structure. We discussed props drilling vs context
            API.
        </p>
    </div>

    <div class="row g-2">
        <div class="col-md-6">
            <button class="btn btn-outline-primary w-100 fw-bold">
                <i class="bi bi-eye me-2"></i> View Details
            </button>
        </div>
        <div class="col-md-6">
            <button class="btn btn-outline-secondary w-100 fw-bold"
                style="border-color: var(--border-color); color: var(--text-muted);">
                <i class="bi bi-calendar-plus me-2"></i> Reschedule
            </button>
        </div>
    </div>
</div>

<div class="card-custom opacity-75">
    <div class="d-flex justify-content-between align-items-start">
        <div class="d-flex align-items-start gap-3">
            <div class="bg-soft-orange text-orange p-3 rounded-3 d-flex align-items-center justify-content-center">
                <i class="bi bi-people fs-4"></i>
            </div>
            <div>
                <h5 class="fw-bold text-main mb-1">Sprint Planning - Team Alpha</h5>
                <p class="text-muted-custom mb-0 small">with <span class="text-main fw-bold">Team Alpha</span></p>
            </div>
        </div>
        <span class="badge bg-soft-red text-red rounded-pill px-3 py-2">Canceled</span>
    </div>
</div>

@endsection
