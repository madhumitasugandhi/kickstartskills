@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Student Assessments')
@section('icon', 'bi bi-clipboard-check fs-4 p-2 bg-soft-blue rounded-3 text-primary')

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
        --soft-purple: #e9d5ff; --text-purple: #9333ea;
    }

    [data-theme="dark"] {
        --bg-card: #1e293b;
        --bg-hover: #334155;
        --text-main: #e9ecef;
        --text-muted: #94a3b8;
        --border-color: #334155;

        --soft-blue: rgba(13, 110, 253, 0.15); --text-blue: #6ea8fe;
        --soft-green: rgba(25, 135, 84, 0.15); --text-green: #75b798;
        --soft-orange: rgba(255, 193, 7, 0.15); --text-orange: #ffda6a;
        --soft-red: rgba(220, 53, 69, 0.15); --text-red: #ea868f;
        --soft-purple: rgba(147, 51, 234, 0.15); --text-purple: #d8b4fe;
    }

    /* Stats Card */
    .stat-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        text-align: center;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transition: transform 0.2s;
    }
    .stat-card:hover { transform: translateY(-2px); }

    .stat-icon { font-size: 1.5rem; margin-bottom: 12px; }
    .stat-val { font-size: 1.6rem; font-weight: 700; margin-bottom: 4px; line-height: 1.2; color: var(--text-blue); }
    .stat-lbl { font-size: 0.75rem; color: var(--text-muted); font-weight: 500; }

    /* Assessment Card */
    .assess-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 16px;
    }

    .user-avatar-circle {
        width: 40px; height: 40px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-weight: 700; font-size: 0.9rem;
        background-color: var(--bg-hover);
        color: var(--text-main);
    }
    .bg-av-blue { background-color: var(--soft-blue); color: var(--text-blue); }
    .bg-av-teal { background-color: rgba(20, 184, 166, 0.15); color: #14b8a6; }

    .status-badge {
        font-size: 0.7rem; padding: 4px 12px; border-radius: 20px; border: 1px solid;
    }
    .st-overdue { background-color: rgba(220, 53, 69, 0.1); color: #dc3545; border-color: rgba(220, 53, 69, 0.2); }
    .st-completed { background-color: rgba(16, 185, 129, 0.1); color: #10b981; border-color: rgba(16, 185, 129, 0.2); }

    .assess-icon { font-size: 1.1rem; margin-right: 8px; }
    .text-icon-red { color: #dc3545; }
    .text-icon-blue { color: #0d6efd; }

    .assess-tag {
        font-size: 0.7rem; color: var(--text-muted);
        display: inline-block; margin-bottom: 8px;
    }

    /* Score Badge */
    .score-badge {
        font-size: 0.75rem; padding: 4px 10px; border-radius: 6px;
        background-color: rgba(16, 185, 129, 0.1); color: #10b981;
        font-weight: 600;
    }

    /* Action Buttons */
    .btn-action-row {
        margin-top: 20px;
    }
    .btn-view {
        background: transparent;
        border: 1px solid var(--text-blue);
        color: var(--text-blue);
    }
    .btn-grade {
        background-color: var(--text-blue);
        border: 1px solid var(--text-blue);
        color: white;
    }
    .btn-view:hover { background-color: var(--soft-blue); }
    .btn-grade:hover { opacity: 0.9; }

    /* Responsive */
    @media (max-width: 768px) {
        .stat-card { padding: 16px; }
        .action-btns { flex-direction: column; gap: 10px; }
    }
</style>

<div class="content-body">

    <div class="card-custom mb-4" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 20px;">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <div class="fs-4 p-2 bg-soft-blue rounded-3 text-primary">
                    <i class="bi bi-clipboard-check fs-3"></i>
                </div>
                <div>
                    <h4 class="fw-bold text-main mb-1">Student Assessments</h4>
                    <p class="text-muted-custom mb-0 small">Create, manage, and grade student assessments with detailed feedback</p>
                </div>
            </div>
            <button class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center p-0"
                    style="width: 40px; height: 40px; background-color: var(--text-blue); border: none;">
                <i class="bi bi-plus-lg fs-5"></i>
            </button>
        </div>
    </div>

    <div class="card-custom mb-4 p-4" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px;">
        <h6 class="fw-bold text-main mb-3">Filters</h6>
        <div class="row g-3">
            <div class="col-12 col-md-4">
                <label class="form-label small text-muted-custom fw-bold mb-1">Cohort</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0" style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-muted);">
                        <i class="bi bi-people"></i>
                    </span>
                    <select class="form-select border-start-0 ps-0" style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                        <option>All Cohorts</option>
                        <option>Batch 2024A</option>
                        <option>Batch 2024B</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <label class="form-label small text-muted-custom fw-bold mb-1">Assessment Type</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0" style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-muted);">
                        <i class="bi bi-file-text"></i>
                    </span>
                    <select class="form-select border-start-0 ps-0" style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                        <option>All Types</option>
                        <option>Quiz</option>
                        <option>Project</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <label class="form-label small text-muted-custom fw-bold mb-1">Status</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0" style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-muted);">
                        <i class="bi bi-check-circle"></i>
                    </span>
                    <select class="form-select border-start-0 ps-0" style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                        <option>All Status</option>
                        <option>Pending</option>
                        <option>Completed</option>
                        <option>Overdue</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon text-primary"><i class="bi bi-clipboard-data"></i></div>
                <div class="stat-val">5</div>
                <div class="stat-lbl">Total Assessments</div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon text-warning"><i class="bi bi-clock-history"></i></div>
                <div class="stat-val text-warning">1</div>
                <div class="stat-lbl">Pending</div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon text-success"><i class="bi bi-check-circle"></i></div>
                <div class="stat-val text-success">2</div>
                <div class="stat-lbl">Completed</div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon" style="color: var(--text-purple);"><i class="bi bi-graph-up"></i></div>
                <div class="stat-val" style="color: var(--text-purple);">86%</div>
                <div class="stat-lbl">Avg Score</div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold text-main m-0">Assessments (5)</h6>
        <i class="bi bi-arrow-repeat text-muted-custom cursor-pointer"></i>
    </div>

    <div class="assess-card border-start border-4 border-danger" style="border-left-color: #dc3545 !important;">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex gap-3">
                <div class="user-avatar-circle bg-av-blue">JD</div>
                <div>
                    <h6 class="fw-bold text-main mb-0">John Doe</h6>
                    <small class="text-muted-custom" style="font-size: 0.75rem;">Frontend Development - Batch 2024A</small>
                </div>
            </div>
            <span class="status-badge st-overdue"><i class="bi bi-exclamation-circle me-1"></i> Overdue</span>
        </div>

        <div class="mb-1">
            <span class="assess-icon text-icon-red"><i class="bi bi-award"></i></span>
            <span class="fw-bold text-main">Mid-Term Progress Review</span>
        </div>
        <span class="assess-tag ms-4 ps-1">Comprehensive Review</span>

        <p class="text-muted-custom small mb-3 mt-2 ms-4 ps-1">
            Comprehensive mid-term evaluation covering all learning objectives including HTML, CSS, and basic JavaScript.
        </p>

        <div class="d-flex align-items-center gap-2 text-danger small fw-bold ms-4 ps-1">
            <i class="bi bi-calendar-x"></i> Overdue
        </div>

        <div class="row g-2 btn-action-row">
            <div class="col-12 col-md-6">
                <button class="btn btn-sm btn-view w-100 fw-bold py-2 rounded-3">
                    <i class="bi bi-eye me-1"></i> View Details
                </button>
            </div>
            <div class="col-12 col-md-6">
                <button class="btn btn-sm btn-grade w-100 fw-bold py-2 rounded-3">
                    <i class="bi bi-pencil-square me-1"></i> Grade
                </button>
            </div>
        </div>
    </div>

    <div class="assess-card border-start border-4 border-success" style="border-left-color: #198754 !important;">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex gap-3">
                <div class="user-avatar-circle bg-av-teal">JS</div>
                <div>
                    <h6 class="fw-bold text-main mb-0">Jane Smith</h6>
                    <small class="text-muted-custom" style="font-size: 0.75rem;">Frontend Development - Batch 2024A</small>
                </div>
            </div>
            <span class="status-badge st-completed"><i class="bi bi-check2 me-1"></i> Completed</span>
        </div>

        <div class="mb-1">
            <span class="assess-icon text-icon-blue"><i class="bi bi-folder"></i></span>
            <span class="fw-bold text-main">React Component Development Project</span>
        </div>
        <span class="assess-tag ms-4 ps-1">Project Assessment</span>

        <p class="text-muted-custom small mb-3 mt-2 ms-4 ps-1">
            Assessment of React skills through a comprehensive component library project submission.
        </p>

        <div class="d-flex justify-content-between align-items-center ms-4 ps-1">
            <div class="d-flex align-items-center gap-3">
                <span class="score-badge">142/150 (A)</span>
                <span class="text-muted-custom small"><i class="bi bi-calendar-check me-1"></i> Due 18/12</span>
            </div>
            <span class="text-muted-custom small"><i class="bi bi-chat-left-text"></i> 3</span>
        </div>

        <div class="row g-2 btn-action-row">
            <div class="col-12 col-md-6">
                <button class="btn btn-sm btn-view w-100 fw-bold py-2 rounded-3">
                    <i class="bi bi-eye me-1"></i> View Details
                </button>
            </div>
            <div class="col-12 col-md-6">
                <button class="btn btn-sm btn-grade w-100 fw-bold py-2 rounded-3" style="background-color: var(--text-blue); border: none;">
                    <i class="bi bi-file-earmark-check me-1"></i> View Grading
                </button>
            </div>
        </div>
    </div>

</div>
@endsection

