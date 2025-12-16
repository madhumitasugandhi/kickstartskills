@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Assignment Creator')
@section('icon', 'bi bi-file-earmark-plus fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')
<style>
    /* Theme Variables */
    :root {
        --bg-card: #ffffff;
        --bg-hover: #f8f9fa;
        --text-main: #343a40;
        --text-muted: #6c757d;
        --border-color: #e9ecef;

        --soft-blue: #e7f1ff; --text-blue: #0d6efd;
        --soft-green: #d1e7dd; --text-green: #0f5132;
        --soft-orange: #ffecb5; --text-orange: #664d03;
        --soft-red: #f8d7da; --text-red: #842029;
    }

    [data-theme="dark"] {
       --bg-card: #2e333f;
        --bg-hover: #334155;
        --text-main: #e9ecef;
        --text-muted: #94a3b8;
        --border-color: #334155;

        --soft-blue: rgba(13, 110, 253, 0.15); --text-blue: #6ea8fe;
        --soft-green: rgba(25, 135, 84, 0.15); --text-green: #75b798;
        --soft-orange: rgba(255, 193, 7, 0.15); --text-orange: #ffda6a;
        --soft-red: rgba(220, 53, 69, 0.15); --text-red: #ea868f;
    }

    /* 1. Assignment Card */
    .assign-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
        position: relative;
    }

    .icon-box {
        width: 48px; height: 48px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }
    .icon-quiz { background-color: var(--soft-blue); color: var(--text-blue); }
    .icon-project { background-color: var(--soft-green); color: var(--text-green); }

    .status-badge {
        font-size: 0.7rem; padding: 4px 12px; border-radius: 20px;
        font-weight: 600; text-transform: uppercase;
        border: 1px solid transparent;
    }
    .st-draft { background-color: rgba(245, 158, 11, 0.1); color: #f59e0b; border-color: rgba(245, 158, 11, 0.2); }
    .st-published { background-color: rgba(16, 185, 129, 0.1); color: #10b981; border-color: rgba(16, 185, 129, 0.2); }

    .tag-pill {
        font-size: 0.7rem; padding: 2px 8px; border-radius: 4px;
        background-color: var(--bg-hover); color: var(--text-muted);
        border: 1px solid var(--border-color);
    }

    /* Meta Info Grid */
    .meta-label { font-size: 0.7rem; color: var(--text-muted); display: block; margin-bottom: 2px; }
    .meta-val { font-size: 0.9rem; font-weight: 600; color: var(--text-main); }

    .val-due { color: #f59e0b; }
    .val-active { color: var(--text-blue); }

    /* Action Buttons */
    .btn-action {
        width: 100%;
        padding: 8px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: 0.2s;
    }
    .btn-view {
        background-color: transparent;
        border: 1px solid var(--text-blue);
        color: var(--text-blue);
    }
    .btn-view:hover { background-color: var(--soft-blue); }

    .btn-grade {
        background-color: var(--text-blue);
        border: 1px solid var(--text-blue);
        color: white;
    }
    .btn-grade:hover { opacity: 0.9; }

    /* Tabs */
    .nav-tabs-custom {
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 24px;
        display: flex;
        gap: 24px;
    }
    .nav-item-custom {
        padding: 12px 4px;
        color: var(--text-muted);
        font-weight: 500;
        border-bottom: 2px solid transparent;
        cursor: pointer;
        display: flex; align-items: center; gap: 8px;
    }
    .nav-item-custom.active {
        color: var(--text-blue);
        border-bottom-color: var(--text-blue);
    }

    /* Responsive Tweaks */
    @media(max-width: 768px) {
        .meta-row { row-gap: 16px; }
        .action-row { flex-direction: row; }
    }
</style>

<div class="content-body">

    <div class="card-custom mb-4" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px;">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <div class="fs-4 p-2 bg-soft-orange rounded-3 text-accent">
                    <i class="bi bi-file-earmark-plus fs-3"></i>
                </div>
                <div>
                    <h4 class="fw-bold text-main mb-1">Assignment Creator</h4>
                    <p class="text-muted-custom mb-0 small">Create, manage, and track assignments for your students</p>
                </div>
            </div>
            <button class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center p-0"
                    style="width: 40px; height: 40px; background-color: var(--text-blue); border: none;">
                <i class="bi bi-plus-lg fs-5"></i>
            </button>
        </div>
    </div>

    <div class="nav-tabs-custom">
        <div class="nav-item-custom active">
            <i class="bi bi-file-earmark-text"></i> Assignments
        </div>
        <div class="nav-item-custom">
            <i class="bi bi-layers"></i> Templates
        </div>
    </div>

    <div class="mb-4">
        <h6 class="fw-bold text-main mb-3">Search & Filter</h6>
        <div class="input-group mb-3">
            <span class="input-group-text bg-bg-hover border-end-0" style="background-color: var(--bg-card); border-color: var(--border-color); color: var(--text-muted);">
                <i class="bi bi-search"></i>
            </span>
            <input type="text" class="form-control border-start-0 ps-0" placeholder="Search assignments..."
                   style="background-color: var(--bg-card); border-color: var(--border-color); color: var(--text-main);">
        </div>

        <div class="d-flex flex-wrap gap-2">
            <button class="btn btn-sm btn-primary px-3 rounded-pill" style="background-color: var(--text-blue); border: none;">All Assignments</button>
            <button class="btn btn-sm btn-outline-secondary px-3 rounded-pill text-muted-custom border-secondary-subtle">Published</button>
            <button class="btn btn-sm btn-outline-secondary px-3 rounded-pill text-muted-custom border-secondary-subtle">Draft</button>
            <button class="btn btn-sm btn-outline-secondary px-3 rounded-pill text-muted-custom border-secondary-subtle">Due Soon</button>
        </div>
    </div>

    <h6 class="fw-bold text-main mb-3">Assignments (4)</h6>

    <div class="assign-card">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex gap-3">
                <div class="icon-box icon-quiz">
                    <i class="bi bi-question-circle"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-main mb-1">JavaScript Fundamentals Quiz</h6>
                    <small class="text-blue fw-bold" style="font-size: 0.75rem;">Quiz</small>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="status-badge st-draft">Draft</span>
                <i class="bi bi-three-dots-vertical text-muted cursor-pointer"></i>
            </div>
        </div>

        <p class="text-muted-custom small mb-3">
            Comprehensive quiz covering ES6+ features, async programming, and best practices.
        </p>

        <div class="d-flex flex-wrap gap-2 mb-4">
            <span class="tag-pill">JavaScript</span>
            <span class="tag-pill">ES6</span>
            <span class="tag-pill">Fundamentals</span>
            <span class="tag-pill">Quiz</span>
        </div>

        <div class="row g-3 mb-4 meta-row">
            <div class="col-6 col-md-3">
                <span class="meta-label"><i class="bi bi-calendar-event me-1"></i> Due Date</span>
                <span class="meta-val val-due">Due in 2d</span>
            </div>
            <div class="col-6 col-md-3">
                <span class="meta-label"><i class="bi bi-upload me-1"></i> Submissions</span>
                <span class="meta-val">0</span>
            </div>
            <div class="col-6 col-md-3">
                <span class="meta-label"><i class="bi bi-check2-all me-1"></i> Graded</span>
                <span class="meta-val">0/0</span>
            </div>
            <div class="col-6 col-md-3">
                <span class="meta-label"><i class="bi bi-graph-up me-1"></i> Avg Score</span>
                <span class="meta-val">N/A</span>
            </div>
        </div>

        <div class="row g-3 action-row">
            <div class="col-6">
                <button class="btn-action btn-view"><i class="bi bi-eye me-2"></i> View</button>
            </div>
            <div class="col-6">
                <button class="btn-action btn-grade"><i class="bi bi-pencil-square me-2"></i> Edit</button>
            </div>
        </div>
    </div>

    <div class="assign-card">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex gap-3">
                <div class="icon-box icon-project">
                    <i class="bi bi-folder-fill"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-main mb-1">React Component Development</h6>
                    <small class="text-blue fw-bold" style="font-size: 0.75rem;">Project</small>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="status-badge st-published">Published</span>
                <i class="bi bi-three-dots-vertical text-muted cursor-pointer"></i>
            </div>
        </div>

        <p class="text-muted-custom small mb-3">
            Create a reusable React component library with proper documentation and testing.
        </p>

        <div class="d-flex flex-wrap gap-2 mb-4">
            <span class="tag-pill">React</span>
            <span class="tag-pill">Components</span>
            <span class="tag-pill">Testing</span>
            <span class="tag-pill">Documentation</span>
        </div>

        <div class="row g-3 mb-4 meta-row">
            <div class="col-6 col-md-3">
                <span class="meta-label"><i class="bi bi-calendar-event me-1"></i> Due Date</span>
                <span class="meta-val">Due in 6d</span>
            </div>
            <div class="col-6 col-md-3">
                <span class="meta-label"><i class="bi bi-upload me-1"></i> Submissions</span>
                <span class="meta-val val-active">12</span>
            </div>
            <div class="col-6 col-md-3">
                <span class="meta-label"><i class="bi bi-check2-all me-1"></i> Graded</span>
                <span class="meta-val">8/12</span>
            </div>
            <div class="col-6 col-md-3">
                <span class="meta-label"><i class="bi bi-graph-up me-1"></i> Avg Score</span>
                <span class="meta-val val-active">85%</span>
            </div>
        </div>

        <div class="row g-3 action-row">
            <div class="col-6">
                <button class="btn-action btn-view"><i class="bi bi-eye me-2"></i> Submissions</button>
            </div>
            <div class="col-6">
                <button class="btn-action btn-grade"><i class="bi bi-check-lg me-2"></i> Grade</button>
            </div>
        </div>
    </div>

</div>
@endsection
