@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Task Management')
@section('icon', 'bi bi-list-check fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')

<div class="card-custom mb-4" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px;">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="fs-4 p-2 bg-soft-orange rounded-3 text-accent">
                <i class="bi bi-list-check fs-3"></i>
            </div>
            <div>
                <h4 class="fw-bold text-main mb-1">Task Management</h4>
                <p class="text-muted-custom mb-0 small">Assign, track, and manage intern tasks and projects</p>
            </div>
        </div>
        <button class="btn btn-primary fw-bold w-100 w-md-auto" style="background-color: var(--accent-color); border: none;">
            <i class="bi bi-plus-lg me-2"></i> New Task
        </button>
    </div>
</div>

<div class="card-custom mb-4 p-4" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px;">
    <h6 class="fw-bold text-main mb-3">Filters & Search</h6>

    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text border-end-0 d-flex align-items-center justify-content-center"
                style="background-color: var(--bg-hover); border-color: var(--border-color); min-width: 45px;">
                <i class="bi bi-search " style="color: var(--text-muted);"></i>
            </span>
            <input type="text" class="form-control border-start-0 ps-0" placeholder="Search tasks..."
                style="background-color: transparent; border-color: var(--border-color); color: var(--text-main);">
        </div>
    </div>

    <div class="row g-3">
        <div class="col-12 col-md-4">
            <label class="form-label small text-muted-custom fw-bold mb-1">Status Filter</label>
            <div class="input-group">
                <span class="input-group-text border-end-0 d-flex align-items-center justify-content-center"
                    style="background-color: var(--bg-hover); border-color: var(--border-color); min-width: 45px;">
                    <i class="bi bi-funnel" style="color: var(--text-muted);"></i>
                </span>
                <select class="form-select border-start-0 ps-0"
                    style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                    <option selected>All Tasks</option>
                    <option>In Progress</option>
                    <option>Completed</option>
                    <option>Overdue</option>
                </select>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <label class="form-label small text-muted-custom fw-bold mb-1">Priority Filter</label>
            <div class="input-group">
                <span class="input-group-text border-end-0 d-flex align-items-center justify-content-center"
                    style="background-color: var(--bg-hover); border-color: var(--border-color); min-width: 45px;">
                    <i class="bi bi-flag" style="color: var(--text-muted);"></i>
                </span>
                <select class="form-select border-start-0 ps-0"
                    style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                    <option selected>All Priorities</option>
                    <option>High</option>
                    <option>Medium</option>
                    <option>Low</option>
                </select>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <label class="form-label small text-muted-custom fw-bold mb-1">Assignee Filter</label>
            <div class="input-group">
                <span class="input-group-text border-end-0 d-flex align-items-center justify-content-center"
                    style="background-color: var(--bg-hover); border-color: var(--border-color); min-width: 45px;">
                    <i class="bi bi-person" style="color: var(--text-muted);"></i>
                </span>
                <select class="form-select border-start-0 ps-0"
                    style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                    <option selected>All Interns</option>
                    <option>John Doe</option>
                    <option>Jane Smith</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-6 col-md-4 col-lg">
        <div class="card-custom text-center py-4 mb-0 h-100 bg-transparent border border-light-subtle rounded-3">
            <div class="mb-2">
                <i class="bi bi-list-ul fs-3 text-primary"></i>
            </div>
            <h3 class="fw-bold text-primary mb-1">5</h3>
            <span class="text-muted-custom small">Total Tasks</span>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg">
        <div class="card-custom text-center py-4 mb-0 h-100 bg-transparent border border-light-subtle rounded-3">
            <div class="mb-2">
                <i class="bi bi-check-circle fs-3 text-success"></i>
            </div>
            <h3 class="fw-bold text-success mb-1">1</h3>
            <span class="text-muted-custom small">Completed</span>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg">
        <div class="card-custom text-center py-4 mb-0 h-100 bg-transparent border border-light-subtle rounded-3">
            <div class="mb-2">
                <i class="bi bi-clock-history fs-3 text-warning"></i>
            </div>
            <h3 class="fw-bold text-warning mb-1">1</h3>
            <span class="text-muted-custom small">In Progress</span>
        </div>
    </div>
    <div class="col-6 col-md-6 col-lg">
        <div class="card-custom text-center py-4 mb-0 h-100 bg-transparent border border-light-subtle rounded-3">
            <div class="mb-2">
                <i class="bi bi-eye fs-3 text-info"></i>
            </div>
            <h3 class="fw-bold text-info mb-1">1</h3>
            <span class="text-muted-custom small">Under Review</span>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg">
        <div class="card-custom text-center py-4 mb-0 h-100 bg-transparent border border-light-subtle rounded-3">
            <div class="mb-2">
                <i class="bi bi-exclamation-triangle fs-3 text-danger"></i>
            </div>
            <h3 class="fw-bold text-danger mb-1">1</h3>
            <span class="text-muted-custom small">Overdue</span>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h6 class="fw-bold text-main m-0">Tasks (5)</h6>
    <div class="d-flex gap-2">
        <i class="bi bi-three-dots text-muted-custom cursor-pointer"></i>
        <i class="bi bi-arrow-repeat text-muted-custom cursor-pointer"></i>
    </div>
</div>

<div class="card-custom mb-3 border-start border-4 "
    style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-left-color: var(--text-red) !important; border-radius: 12px; padding: 24px;">

    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start mb-2 gap-2">
        <div class="d-flex align-items-start gap-3">
            <div class="bg-soft-red p-2 rounded text-danger flex-shrink-0">
                <i class="bi bi-exclamation-octagon fs-5"></i>
            </div>
            <div>
                <h6 class="fw-bold text-main mb-1">Database Design Exercise</h6>
                <small class="text-muted-custom">Assigned to <span class="text-main fw-bold">Mike Johnson</span></small>
            </div>
        </div>
        <span class="badge bg-soft-red text-danger border border-danger-subtle rounded-pill px-3 align-self-start">Overdue</span>
    </div>

    <p class="text-muted-custom small mb-4 mt-2">
        Design a normalized database schema for an e-commerce platform with proper relationships.
    </p>

    <div class="row g-3 mb-3 text-muted-custom small">
        <div class="col-6 col-md-4 d-flex align-items-center gap-2">
            <i class="bi bi-calendar-event text-danger"></i>
            <div>
                <span class="d-block" style="font-size: 0.7rem;">Due Date</span>
                <span class="text-danger fw-bold">14 Dec 2025</span>
            </div>
        </div>
        <div class="col-6 col-md-4 d-flex align-items-center gap-2">
            <i class="bi bi-layers text-primary"></i>
            <div>
                <span class="d-block" style="font-size: 0.7rem;">Phase</span>
                <span class="text-primary fw-bold">Phase 1</span>
            </div>
        </div>
        <div class="col-12 col-md-4 d-flex align-items-center gap-2">
            <i class="bi bi-pie-chart text-info"></i>
            <div>
                <span class="d-block" style="font-size: 0.7rem;">Progress</span>
                <span class="text-info fw-bold">8/15h</span>
            </div>
        </div>
    </div>

    <div class="d-flex align-items-center gap-3 mb-4">
        <div class="progress flex-grow-1" style="height: 6px; background-color: var(--bg-hover);">
            <div class="progress-bar bg-danger" style="width: 53%"></div>
        </div>
        <span class="text-danger small fw-bold">53%</span>
    </div>

    <div class="mb-4">
        <span class="d-block text-muted-custom small fw-bold mb-2">Skills:</span>
        <div class="d-flex flex-wrap gap-2">
            <span class="badge bg-soft-blue text-blue border border-primary-subtle fw-normal">Database Design</span>
            <span class="badge bg-soft-blue text-blue border border-primary-subtle fw-normal">SQL</span>
            <span class="badge bg-soft-blue text-blue border border-primary-subtle fw-normal">Normalization</span>
            <span class="badge bg-soft-blue text-blue border border-primary-subtle fw-normal">ERD</span>
        </div>
    </div>

    <div class="row g-0 rounded-3 overflow-hidden border border-dark-subtle"
        style="border-color: var(--border-color) !important;">
        <div class="col-4 border-end" style="border-color: var(--border-color) !important;">
            <button class="btn btn-link text-decoration-none w-100 text-muted-custom py-2 d-flex align-items-center justify-content-center gap-1" style="font-size: 0.85rem;">
                <i class="bi bi-eye"></i> <span class="d-none d-sm-inline">View</span>
            </button>
        </div>
        <div class="col-4 border-end" style="border-color: var(--border-color) !important;">
            <button class="btn btn-link text-decoration-none w-100 text-muted-custom py-2 d-flex align-items-center justify-content-center gap-1" style="font-size: 0.85rem;">
                <i class="bi bi-pencil-square"></i> <span class="d-none d-sm-inline">Edit</span>
            </button>
        </div>
        <div class="col-4">
            <button class="btn btn-primary w-100 py-2 rounded-0 d-flex align-items-center justify-content-center gap-1"
                style="background-color: var(--accent-color); border: none; font-size: 0.85rem;">
                <i class="bi bi-chat-left-text"></i> <span class="d-none d-sm-inline">Feedback</span>
            </button>
        </div>
    </div>
</div>

<div class="card-custom mb-3 border-start border-4 "
    style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-left-color: var(--accent-color) !important; border-radius: 12px; padding: 24px;">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
        <div class="d-flex align-items-center gap-3 w-100">
            <div class="bg-soft-orange p-2 rounded text-accent flex-shrink-0">
                <i class="bi bi-exclamation-circle fs-5"></i>
            </div>
            <div>
                <h6 class="fw-bold text-main mb-0">Build React Component Library</h6>
                <small class="text-muted-custom">Assigned to <span class="text-main fw-bold">John Doe</span></small>
            </div>
        </div>
        <span class="badge bg-soft-orange text-accent border border-warning-subtle rounded-pill px-3 align-self-start align-self-sm-center">In Progress</span>
    </div>
</div>

@endsection
