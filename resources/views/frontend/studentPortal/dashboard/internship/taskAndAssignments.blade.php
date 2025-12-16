@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Tasks & Assignments')
@section('icon', 'bi bi-list-task fs-4 p-2 bg-primary bg-opacity-10 rounded-3 text-primary')

@section('content')
<style>
    /* Theme Variables */
    :root {
        --bg-body: #f8f9fa;
        --bg-sidebar: #ffffff;
        --bg-card: #ffffff;
        --bg-hover: #f8f9fa;

        --text-main: #343a40;
        --text-muted: #6c757d;

        --border-color: #e9ecef;

        /* Soft Colors */
        --soft-blue: #e7f1ff;
        --text-blue: #0d6efd;
        --soft-green: #d1e7dd;
        --text-green: #0f5132;
        --soft-orange: #ffecb5;
        --text-orange: #664d03;
        --soft-red: #f8d7da;
        --text-red: #842029;
        --soft-teal: #e0fbf6;
        --text-teal: #107c6f;
    }

    [data-theme="dark"] {
        --bg-body: #0f1626;
        --bg-sidebar: #1e293b;
        --bg-card: #2e333f;
        --bg-hover: #2e333f;

        --text-main: #e9ecef;
        --text-muted: #adb5bd;

        --border-color: #767677;

        /* Dark Mode Transparencies */
        --soft-blue: rgba(13, 110, 253, 0.15);
        --text-blue: #6ea8fe;
        --soft-green: rgba(25, 135, 84, 0.15);
        --text-green: #75b798;
        --soft-orange: rgba(255, 193, 7, 0.15);
        --text-orange: #ffda6a;
        --soft-red: rgba(220, 53, 69, 0.15);
        --text-red: #ea868f;
        --soft-teal: rgba(32, 201, 151, 0.15);
        --text-teal: #a9e5d6;
    }


    /* 1. Overview Stats (Dark Theme) */
    .stat-card-dark {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 24px;
        text-align: center;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .stat-num { font-size: 1.8rem; font-weight: 700; display: block; margin-bottom: 4px; }
    .stat-num.blue { color: #60a5fa; }
    .stat-num.green { color: #4ade80; }
    .stat-num.info { color: #38bdf8; }
    .stat-num.red { color: #f87171; }
    .stat-lbl { font-size: 0.85rem; color: var(--dark-muted); font-weight: 500; }

    /* 2. Progress Bar Section */
    .progress-header {
        display: flex; justify-content: space-between; color: var(--text-muted); font-size: 0.9rem; font-weight: 600; margin-bottom: 8px;
    }
    .progress-track-dark {
        height: 6px;
         background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 4px;
        overflow: hidden;
    }
    .progress-fill-green { background-color: #10b981; height: 100%; border-radius: 4px; }

    /* 3. Filter Bar */
    .filter-bar-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .filter-btn {
        background-color: var(--dark-card-bg);
        border: 1px solid var(--dark-border);
        color: var(--dark-muted);
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.9rem;
    }
    .btn-add-task {
        background-color: #334155;
        color: white;
        border: 1px solid #475569;
        padding: 8px 20px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    /* 4. Task Card (Row Layout) */
    .task-card-row {
         background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 20px;
        position: relative;
    }

    /* Row 1: Header */
    .task-header {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        margin-bottom: 12px;
    }
    .task-icon {
        width: 32px; height: 32px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 6px;
        font-size: 1rem;
        flex-shrink: 0; /* Prevent icon shrinking */
    }
    .icon-danger { background: rgba(239,68,68,0.1); color: #ef4444; }
    .icon-success { background: rgba(16,185,129,0.1); color: #10b981; }

    .task-title-group h6 { color: var(--dark-text); font-weight: 700; margin: 0; font-size: 1rem; }
    .task-phase { color: #60a5fa; font-size: 0.8rem; margin-top: 2px; display: block; }

    .task-badges { margin-left: auto; display: flex; gap: 8px; flex-shrink: 0; }
    .badge-status { font-size: 0.7rem; padding: 4px 8px; border-radius: 4px; font-weight: 600; }
    .badge-low { background: rgba(56,189,248,0.1); color: #38bdf8; }
    .badge-overdue { background: rgba(239,68,68,0.1); color: #ef4444; }
    .badge-high { background: rgba(239,68,68,0.1); color: #ef4444; }
    .badge-completed { background: rgba(16,185,129,0.1); color: #10b981; }

    /* Row 2: Description */
    .task-desc {
        color: var(--dark-muted);
        font-size: 0.9rem;
        margin-bottom: 20px;
        line-height: 1.5;
        padding-left: 48px; /* Indent to align with text above */
    }

    /* Row 3: Meta Data Grid */
    .task-meta-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 40px;
        padding-left: 48px;
        margin-bottom: 20px;
    }
    .meta-point { display: flex; flex-direction: column; }
    .meta-lbl { font-size: 0.75rem; color: #64748b; font-weight: 600; margin-bottom: 2px; }
    .meta-val { font-size: 0.9rem; color: #cbd5e1; font-weight: 500; display: flex; align-items: center; gap: 6px; }

    /* Row 4: Tags & Actions */
    .task-action-row {
        padding-left: 48px;
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 20px;
        flex-wrap: wrap; /* Allow wrapping */
    }
    .tag-pill {
        background-color: #334155;
        color: #94a3b8;
        font-size: 0.75rem;
        padding: 4px 10px;
        border-radius: 4px;
        font-weight: 500;
        white-space: nowrap;
    }
    .tag-pill.green { color: #86efac; background-color: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.2); }

    .btn-details {
        background: #334155;
        border: 1px solid #475569;
        color: #cbd5e1;
        padding: 6px 16px;
        border-radius: 6px;
        font-size: 0.85rem;
        display: flex; align-items: center; gap: 6px;
        white-space: nowrap;
    }

    /* Row 5: Footer Alert */
    .task-footer-alert {
        margin-left: 48px;
        background: rgba(239,68,68,0.05);
        border: 1px solid rgba(239,68,68,0.15);
        color: #fca5a5;
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 0.85rem;
        display: flex; align-items: center; gap: 10px;
    }
    .alert-success-custom {
        background: rgba(16,185,129,0.05);
        border-color: rgba(16,185,129,0.15);
        color: #86efac;
    }

    /* --- RESPONSIVE ADJUSTMENTS --- */
    @media (max-width: 768px) {
        /* Remove indentation on mobile so content fits better */
        .task-desc,
        .task-meta-grid,
        .task-action-row,
        .task-footer-alert {
            padding-left: 0;
        }

        .task-card-row { padding: 16px; }

        /* Stack header elements if needed */
        .task-header { flex-wrap: wrap; }
        .task-badges { margin-left: 0; margin-top: 4px; width: 100%; }

        /* Adjust meta grid spacing */
        .task-meta-grid { gap: 20px; }

        /* Filter bar stacking */
        .filter-bar-container {
            flex-direction: column;
            align-items: stretch;
            gap: 12px;
        }
        .btn-add-task { width: 100%; }

        /* Action buttons expand */
        .task-action-row .d-flex.gap-2 {
            flex-grow: 1;
            margin-left: 0 !important;
        }
        .btn-details { flex-grow: 1; justify-content: center; }
    }

</style>

<div class="content-body">

    <div class="dark-wrapper">

        <div class="row g-4 mb-4">
            <div class="col-6 col-md-3">
                <div class="stat-card-dark">
                    <span class="stat-num blue">39</span>
                    <span class="stat-lbl">Total Tasks</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card-dark">
                    <span class="stat-num green">13</span>
                    <span class="stat-lbl">Completed</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card-dark">
                    <span class="stat-num info">6</span>
                    <span class="stat-lbl">In Progress</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card-dark">
                    <span class="stat-num red">2</span>
                    <span class="stat-lbl">Overdue</span>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <div class="progress-header">
                <span>Overall Progress</span>
                <span class="text-success">33%</span>
            </div>
            <div class="progress-track-dark">
                <div class="progress-fill-green" style="width: 33%"></div>
            </div>
        </div>

        <div class="filter-bar-container">
            <div class="d-flex gap-2">
                <select class="filter-btn"><option>All</option></select>
                <select class="filter-btn"><option>Due Date</option></select>
            </div>
            <button class="btn-add-task"><i class="bi bi-plus-lg me-1"></i> Add Task</button>
        </div>

        <div class="row">

            <div class="col-12">
                <div class="task-card-row">

                    <div class="task-header">
                        <div class="task-icon icon-danger"><i class="bi bi-exclamation-triangle-fill"></i></div>
                        <div class="task-title-group">
                            <h6>Code Documentation</h6>
                            <span class="task-phase">Phase 1: Foundation & Setup</span>
                        </div>
                        <div class="task-badges">
                            <span class="badge-status badge-low">Low</span>
                            <span class="badge-status badge-overdue">Overdue</span>
                        </div>
                    </div>

                    <div class="task-desc">
                        Create comprehensive documentation for all developed features including API docs and user guides
                    </div>

                    <div class="task-meta-grid">
                        <div class="meta-point">
                            <span class="meta-lbl">Due Date</span>
                            <span class="meta-val"><i class="bi bi-calendar4"></i> 5d ago</span>
                        </div>
                        <div class="meta-point">
                            <span class="meta-lbl">Estimated</span>
                            <span class="meta-val"><i class="bi bi-clock"></i> 8h</span>
                        </div>
                        <div class="meta-point">
                            <span class="meta-lbl">Mentor</span>
                            <span class="meta-val"><i class="bi bi-person-circle"></i> Rajesh Kumar</span>
                        </div>
                    </div>

                    <div class="task-action-row">
                        <span class="tag-pill">Markdown</span>
                        <span class="tag-pill">JSDoc</span>
                        <span class="tag-pill">Swagger</span>

                        <div class="d-flex gap-2 ms-md-2 flex-grow-1 flex-md-grow-0">
                            <button class="btn-details w-100 w-md-auto"><i class="bi bi-info-circle"></i> Details</button>
                        </div>
                    </div>

                    <div class="task-footer-alert">
                        <i class="bi bi-chat-left-text-fill flex-shrink-0"></i>
                        <span>Please prioritize this - documentation is important for project handover.</span>
                    </div>

                </div>
            </div>

            <div class="col-12">
                <div class="task-card-row">

                    <div class="task-header">
                        <div class="task-icon icon-success"><i class="bi bi-check-circle-fill"></i></div>
                        <div class="task-title-group">
                            <h6>User Authentication System</h6>
                            <span class="task-phase">Phase 2: Core Development</span>
                        </div>
                        <div class="task-badges">
                            <span class="badge-status badge-high">High</span>
                            <span class="badge-status badge-completed">Completed</span>
                        </div>
                    </div>

                    <div class="task-desc">
                        Implement secure user login/logout functionality with JWT tokens and session management
                    </div>

                    <div class="task-meta-grid">
                        <div class="meta-point">
                            <span class="meta-lbl">Due Date</span>
                            <span class="meta-val"><i class="bi bi-calendar4"></i> 2d ago</span>
                        </div>
                        <div class="meta-point">
                            <span class="meta-lbl">Estimated</span>
                            <span class="meta-val"><i class="bi bi-clock"></i> 16h</span>
                        </div>
                        <div class="meta-point">
                            <span class="meta-lbl">Mentor</span>
                            <span class="meta-val"><i class="bi bi-person-circle"></i> Rajesh Kumar</span>
                        </div>
                    </div>

                    <div class="task-action-row">
                        <div class="d-flex gap-2 flex-wrap">
                            <span class="tag-pill green">React</span>
                            <span class="tag-pill green">Node.js</span>
                            <span class="tag-pill green">JWT</span>
                            <span class="tag-pill green">bcrypt</span>
                        </div>

                        <div class="d-flex gap-2 ms-md-2 flex-grow-1 flex-md-grow-0 mt-2 mt-md-0">
                            <button class="btn-details w-100 w-md-auto"><i class="bi bi-eye"></i> View</button>
                            <button class="btn-details w-100 w-md-auto"><i class="bi bi-info-circle"></i> Details</button>
                        </div>
                        <div class="ms-auto text-warning small fw-bold d-none d-md-block"><i class="bi bi-star-fill"></i> 9.2</div>
                    </div>

                    <div class="task-footer-alert alert-success-custom">
                        <i class="bi bi-chat-left-quote-fill flex-shrink-0"></i>
                        <span>Excellent implementation! Clean code and good security practices.</span>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
