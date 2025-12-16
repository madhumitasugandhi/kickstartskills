@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Goal Setting')
@section('icon', 'bi bi-flag fs-4 p-2 bg-soft-orange rounded-3 text-accent')

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
        --soft-teal: #e0fbf6; --text-teal: #107c6f;
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
        --soft-teal: rgba(32, 201, 151, 0.15); --text-teal: #a9e5d6;
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

    /* Goal Card */
    .goal-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 16px;
    }

    .goal-icon-box {
        width: 40px; height: 40px;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    .icon-orange { background-color: rgba(253, 126, 20, 0.1); color: #fd7e14; }
    .icon-blue { background-color: rgba(13, 110, 253, 0.1); color: #0d6efd; }

    /* Badges */
    .status-badge {
        font-size: 0.7rem; padding: 4px 10px; border-radius: 20px; border: 1px solid;
    }
    .badge-high { background-color: rgba(220, 53, 69, 0.1); color: #dc3545; border-color: rgba(220, 53, 69, 0.2); }
    .badge-progress { background-color: rgba(13, 110, 253, 0.1); color: #0d6efd; border-color: rgba(13, 110, 253, 0.2); }

    /* Template Sidebar */
    .template-card {
        background-color: var(--bg-hover);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 12px;
        cursor: pointer;
        transition: 0.2s;
    }
    .template-card:hover { background-color: var(--bg-card); border-color: var(--text-blue); }

    /* Responsive Tweaks */
    @media (max-width: 768px) {
        .stat-card { padding: 16px; }
        .stat-val { font-size: 1.3rem; }
        .action-row { row-gap: 10px; } /* Space between stacked buttons */
    }
</style>

<div class="content-body">

    <div class="card-custom mb-4" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 20px;">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <div class="fs-4 p-2 bg-soft-orange rounded-3 text-accent">
                    <i class="bi bi-flag fs-3"></i>
                </div>
                <div>
                    <h4 class="fw-bold text-main mb-1">Goal Setting</h4>
                    <p class="text-muted-custom mb-0 small">Set, track, and achieve your mentoring and student development goals</p>
                </div>
            </div>
            <button class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center p-0"
                    style="width: 40px; height: 40px; background-color: var(--accent-color); border: none;">
                <i class="bi bi-plus-lg fs-5"></i>
            </button>
        </div>
    </div>

    <div class="card-custom mb-4 p-4" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px;">
        <h6 class="fw-bold text-main mb-3">Filters</h6>
        <div class="row g-3">
            <div class="col-12 col-md-4">
                <label class="form-label small text-muted-custom fw-bold mb-1">Category</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0" style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-muted);">
                        <i class="bi bi-tag"></i>
                    </span>
                    <select class="form-select border-start-0 ps-0" style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                        <option>All Categories</option>
                        <option>Skill Development</option>
                        <option>Support</option>
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
                        <option>In Progress</option>
                        <option>Completed</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <label class="form-label small text-muted-custom fw-bold mb-1">Timeframe</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0" style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-muted);">
                        <i class="bi bi-calendar"></i>
                    </span>
                    <select class="form-select border-start-0 ps-0" style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                        <option>All Time</option>
                        <option>This Month</option>
                        <option>This Quarter</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon text-primary"><i class="bi bi-flag"></i></div>
                <div class="stat-val">5</div>
                <div class="stat-lbl">Total Goals</div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon text-accent"><i class="bi bi-clock-history"></i></div>
                <div class="stat-val text-accent">5</div>
                <div class="stat-lbl">In Progress</div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon text-success"><i class="bi bi-check-circle"></i></div>
                <div class="stat-val text-success">0</div>
                <div class="stat-lbl">Completed</div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon text-warning"><i class="bi bi-graph-up-arrow"></i></div>
                <div class="stat-val text-warning">79%</div>
                <div class="stat-lbl">Avg Progress</div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-12 col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold text-main m-0">Goals (5)</h6>
                <i class="bi bi-arrow-repeat text-muted-custom cursor-pointer"></i>
            </div>

            <div class="goal-card">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="d-flex gap-3">
                        <div class="goal-icon-box icon-orange">
                            <i class="bi bi-person"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-main mb-1">Support Mike Johnson's Progress</h6>
                            <small class="text-muted-custom">Individual Support</small>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <span class="status-badge badge-high">High</span>
                        <span class="status-badge badge-progress"><i class="bi bi-clock me-1"></i> In Progress</span>
                    </div>
                </div>

                <p class="text-muted-custom small mb-3 mt-2">
                    Help Mike achieve 70% overall progress and improve JavaScript fundamentals
                </p>

                <div class="mb-3">
                    <div class="d-flex justify-content-between small mb-1">
                        <span class="text-muted-custom">Progress: 42% / 70%</span>
                        <span class="fw-bold text-primary">60%</span>
                    </div>
                    <div class="progress" style="height: 6px; background-color: var(--bg-hover);">
                        <div class="progress-bar bg-primary" style="width: 60%"></div>
                    </div>
                </div>

                <div class="d-flex gap-3 text-muted-custom small mb-4">
                    <span><i class="bi bi-calendar-event me-1"></i> Due 15/1/2026</span>
                    <span><i class="bi bi-check2-square me-1"></i> 0/3 milestones</span>
                </div>

                <div class="row g-2 action-row">
                    <div class="col-12 col-md-6">
                        <button class="btn btn-sm btn-outline-secondary w-100 fw-bold border-secondary-subtle">
                            <i class="bi bi-eye me-1"></i> View Details
                        </button>
                    </div>
                    <div class="col-12 col-md-6">
                        <button class="btn btn-sm btn-primary w-100 fw-bold" style="background-color: var(--accent-color); border: none;">
                            <i class="bi bi-pencil-square me-1"></i> Update Progress
                        </button>
                    </div>
                </div>
            </div>

            <div class="goal-card">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="d-flex gap-3">
                        <div class="goal-icon-box icon-blue">
                            <i class="bi bi-lightning-charge"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-main mb-1">Improve JavaScript Proficiency Across Cohort</h6>
                            <small class="text-muted-custom">Skill Development</small>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <span class="status-badge badge-high">High</span>
                        <span class="status-badge badge-progress"><i class="bi bi-clock me-1"></i> In Progress</span>
                    </div>
                </div>

                <p class="text-muted-custom small mb-3 mt-2">
                    Increase average JavaScript skill rating from 3.5 to 4.2 across all Frontend Development students
                </p>

                <div class="mb-3">
                    <div class="d-flex justify-content-between small mb-1">
                        <span class="text-muted-custom">Progress: 3.8/5 rating / 4.2/5 rating</span>
                        <span class="fw-bold text-success">90%</span>
                    </div>
                    <div class="progress" style="height: 6px; background-color: var(--bg-hover);">
                        <div class="progress-bar bg-success" style="width: 90%"></div>
                    </div>
                </div>

                <div class="d-flex gap-3 text-muted-custom small mb-4">
                    <span><i class="bi bi-calendar-event me-1"></i> Due 30/1/2026</span>
                    <span><i class="bi bi-check2-square me-1"></i> 0/3 milestones</span>
                </div>

                <div class="row g-2 action-row">
                    <div class="col-12 col-md-6">
                        <button class="btn btn-sm btn-outline-secondary w-100 fw-bold border-secondary-subtle">
                            <i class="bi bi-eye me-1"></i> View Details
                        </button>
                    </div>
                    <div class="col-12 col-md-6">
                        <button class="btn btn-sm btn-primary w-100 fw-bold" style="background-color: var(--accent-color); border: none;">
                            <i class="bi bi-pencil-square me-1"></i> Update Progress
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-12 col-lg-4">
            <div class="card-custom h-100" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px;">
                <h6 class="fw-bold text-main mb-4">Goal Templates</h6>

                <div class="template-card">
                    <div class="d-flex align-items-center gap-2 mb-1 text-primary">
                        <i class="bi bi-lightning-charge-fill"></i>
                        <span class="fw-bold small">Skill Improvement Goal</span>
                    </div>
                    <p class="text-muted-custom small mb-2">Template for improving specific technical skills</p>
                    <small class="text-muted-custom"><i class="bi bi-clock me-1"></i> 60 days</small>
                </div>

                <div class="template-card">
                    <div class="d-flex align-items-center gap-2 mb-1 text-warning">
                        <i class="bi bi-person-fill"></i>
                        <span class="fw-bold small">Individual Student Support</span>
                    </div>
                    <p class="text-muted-custom small mb-2">Template for supporting struggling students</p>
                    <small class="text-muted-custom"><i class="bi bi-clock me-1"></i> 30 days</small>
                </div>

                <div class="template-card">
                    <div class="d-flex align-items-center gap-2 mb-1 text-info">
                        <i class="bi bi-book-half"></i>
                        <span class="fw-bold small">Cohort Performance Goal</span>
                    </div>
                    <p class="text-muted-custom small mb-2">Template for improving overall cohort metrics</p>
                    <small class="text-muted-custom"><i class="bi bi-clock me-1"></i> 90 days</small>
                </div>

                <div class="template-card">
                    <div class="d-flex align-items-center gap-2 mb-1 text-success">
                        <i class="bi bi-heart-fill"></i>
                        <span class="fw-bold small">Engagement Enhancement</span>
                    </div>
                    <p class="text-muted-custom small mb-2">Template for improving student engagement</p>
                    <small class="text-muted-custom"><i class="bi bi-clock me-1"></i> 45 days</small>
                </div>

            </div>
        </div>

    </div>

</div>
@endsection
