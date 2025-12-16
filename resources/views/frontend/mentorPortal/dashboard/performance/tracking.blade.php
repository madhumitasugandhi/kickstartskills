@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Progress Tracking')
@section('icon', 'bi bi-graph-up-arrow fs-4 p-2 bg-soft-orange rounded-3 text-accent')

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
        --bg-card: #1e293b;
        --bg-hover: #334155;
        --text-main: #e9ecef;
        --text-muted: #94a3b8;
        --border-color: #334155;

        --soft-blue: rgba(13, 110, 253, 0.15); --text-blue: #6ea8fe;
        --soft-green: rgba(25, 135, 84, 0.15); --text-green: #75b798;
        --soft-orange: rgba(255, 193, 7, 0.15); --text-orange: #ffda6a;
        --soft-red: rgba(220, 53, 69, 0.15); --text-red: #ea868f;
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
    }
    .stat-icon { font-size: 1.5rem; margin-bottom: 12px; }
    .stat-val { font-size: 1.6rem; font-weight: 700; margin-bottom: 4px; line-height: 1.2; }
    .stat-label { font-size: 0.75rem; color: var(--text-muted); font-weight: 500; }
    .stat-trend { font-size: 0.75rem; font-weight: 600; margin-top: 8px; display: inline-block; }

    /* Insight Cards (Alerts) */
    .insight-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 16px;
        border-left: 4px solid transparent;
    }
    .insight-green { background-color: rgba(25, 135, 84, 0.05); border-left-color: #198754; }
    .insight-orange { background-color: rgba(253, 126, 20, 0.05); border-left-color: #fd7e14; }
    .insight-red { background-color: rgba(220, 53, 69, 0.05); border-left-color: #dc3545; }
    .insight-blue { background-color: rgba(13, 110, 253, 0.05); border-left-color: #0d6efd; }

    .btn-action-outline {
        background: transparent;
        border: 1px solid currentColor;
        font-size: 0.8rem;
        padding: 6px 12px;
        border-radius: 6px;
        width: 100%;
        margin-top: 12px;
        font-weight: 600;
        transition: 0.2s;
    }
    .btn-action-outline:hover { background-color: rgba(0,0,0,0.05); }

    /* Student Progress Card */
    .student-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 16px;
    }

    .skill-badge {
        font-size: 0.7rem;
        padding: 4px 10px;
        border-radius: 4px;
        background-color: var(--bg-hover);
        color: var(--text-muted);
        border: 1px solid var(--border-color);
    }
    .skill-badge.warning { background-color: rgba(253, 126, 20, 0.1); color: #fd7e14; border-color: transparent; }

    .metric-box {
        text-align: left;
    }
    .metric-label { font-size: 0.7rem; color: var(--text-muted); display: block; margin-bottom: 2px; }
    .metric-value { font-size: 0.9rem; font-weight: 700; color: var(--text-main); }

    @media (max-width: 768px) {
        .stat-card { padding: 16px; }
        .stat-val { font-size: 1.3rem; }
    }
</style>

<div class="content-body">

    <div class="card-custom mb-4" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 20px;">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <div class="fs-4 p-2 bg-soft-orange rounded-3 text-accent">
                    <i class="bi bi-graph-up-arrow fs-3"></i>
                </div>
                <div>
                    <h4 class="fw-bold text-main mb-1">Progress Tracking</h4>
                    <p class="text-muted-custom mb-0 small">Monitor student progress and identify areas for improvement</p>
                </div>
            </div>
            <button class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center p-0"
                    style="width: 40px; height: 40px; background-color: var(--accent-color); border: none;">
                <i class="bi bi-download fs-5"></i>
            </button>
        </div>
    </div>

    <div class="card-custom mb-4 p-4" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px;">
        <h6 class="fw-bold text-main mb-3">Filters</h6>
        <div class="row g-3">
            <div class="col-12 col-md-4">
                <label class="form-label small text-muted-custom fw-bold mb-1">Timeframe</label>
                <select class="form-select" style="background-color: var(--bg-card); border-color: var(--border-color); color: var(--text-main);">
                    <option>This Month</option>
                    <option>Last Month</option>
                    <option>This Quarter</option>
                </select>
            </div>
            <div class="col-12 col-md-4">
                <label class="form-label small text-muted-custom fw-bold mb-1">Cohort</label>
                <select class="form-select" style="background-color: var(--bg-card); border-color: var(--border-color); color: var(--text-main);">
                    <option>All Cohorts</option>
                    <option>Batch 2024A</option>
                    <option>Batch 2024B</option>
                </select>
            </div>
            <div class="col-12 col-md-4">
                <label class="form-label small text-muted-custom fw-bold mb-1">Metric</label>
                <select class="form-select" style="background-color: var(--bg-card); border-color: var(--border-color); color: var(--text-main);">
                    <option>All Metrics</option>
                    <option>Completion Rate</option>
                    <option>Attendance</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon text-success mb-2"><i class="bi bi-graph-up"></i></div>
                <div class="stat-val text-success">74.25%</div>
                <div class="stat-label">Average Progress</div>
                <div class="stat-trend text-success"><i class="bi bi-arrow-up"></i> +5.2%</div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon text-warning mb-2"><i class="bi bi-check2-square"></i></div>
                <div class="stat-val text-warning">68.5%</div>
                <div class="stat-label">Completion Rate</div>
                <div class="stat-trend text-danger"><i class="bi bi-arrow-down"></i> -2.1%</div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon text-accent mb-2"><i class="bi bi-calendar-check"></i></div>
                <div class="stat-val text-accent">92.75%</div>
                <div class="stat-label">Attendance Rate</div>
                <div class="stat-trend text-success"><i class="bi bi-arrow-up"></i> +1.8%</div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon text-info mb-2"><i class="bi bi-star"></i></div>
                <div class="stat-val text-info">4.1/5</div>
                <div class="stat-label">Avg Skill Rating</div>
                <div class="stat-trend text-success"><i class="bi bi-arrow-up"></i> +0.3%</div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-12 col-lg-4">
            <div class="card-custom h-100" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px;">
                <h6 class="fw-bold text-main mb-4">Performance Insights</h6>

                <div class="insight-card insight-green">
                    <div class="d-flex gap-2 align-items-center mb-1 text-success">
                        <i class="bi bi-check-circle-fill"></i>
                        <span class="fw-bold small">Strong Overall Performance</span>
                    </div>
                    <p class="text-muted-custom small mb-0">75% of students are progressing well above expectations this month.</p>
                </div>

                <div class="insight-card insight-orange">
                    <div class="d-flex gap-2 align-items-center mb-1 text-warning">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <span class="fw-bold small">Attention Needed</span>
                    </div>
                    <p class="text-muted-custom small mb-2">Mike Johnson needs additional support with JavaScript fundamentals.</p>
                    <button class="btn-action-outline text-warning"><i class="bi bi-arrow-right"></i> Take Action</button>
                </div>

                <div class="insight-card insight-red">
                    <div class="d-flex gap-2 align-items-center mb-1 text-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        <span class="fw-bold small">Completion Rate Decline</span>
                    </div>
                    <p class="text-muted-custom small mb-2">Task completion rates have dropped by 2.1% compared to last month.</p>
                    <button class="btn-action-outline text-danger"><i class="bi bi-arrow-right"></i> Take Action</button>
                </div>

                <div class="insight-card insight-blue">
                    <div class="d-flex gap-2 align-items-center mb-1 text-primary">
                        <i class="bi bi-info-circle-fill"></i>
                        <span class="fw-bold small">Skill Development Focus</span>
                    </div>
                    <p class="text-muted-custom small mb-2">Students are excelling in HTML/CSS but need more practice with advanced JavaScript.</p>
                    <button class="btn-action-outline text-primary"><i class="bi bi-arrow-right"></i> Take Action</button>
                </div>

            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="card-custom h-100" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-bold text-main m-0">Student Progress (4)</h6>
                    <i class="bi bi-arrow-repeat text-muted-custom cursor-pointer"></i>
                </div>

                <div class="student-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="d-flex gap-3">
                            <div class="rounded-circle bg-soft-blue text-blue d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px;">SW</div>
                            <div>
                                <h6 class="fw-bold text-main mb-0 small">Sarah Wilson</h6>
                                <small class="text-muted-custom" style="font-size: 0.7rem;">Frontend Development - Batch 2024A</small>
                            </div>
                        </div>
                        <span class="badge bg-soft-green text-green rounded-pill" style="font-size: 0.65rem;">Excellent</span>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-muted-custom">Overall Progress</span>
                            <span class="fw-bold text-success">92%</span>
                        </div>
                        <div class="progress" style="height: 4px; background-color: var(--bg-hover);">
                            <div class="progress-bar bg-success" style="width: 92%"></div>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-4 metric-box">
                            <span class="metric-label"><i class="bi bi-check2-square"></i> Tasks</span>
                            <span class="metric-value">28/30</span>
                        </div>
                        <div class="col-4 metric-box">
                            <span class="metric-label"><i class="bi bi-calendar-check"></i> Attendance</span>
                            <span class="metric-value">100%</span>
                        </div>
                        <div class="col-4 metric-box">
                            <span class="metric-label"><i class="bi bi-graph-up"></i> Weekly</span>
                            <span class="metric-value text-success">+6%</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted-custom fw-bold d-block mb-2" style="font-size: 0.7rem;">Skills Performance</small>
                        <div class="d-flex gap-2 flex-wrap">
                            <span class="skill-badge text-success border-success-subtle">JavaScript: 4.9/5</span>
                            <span class="skill-badge text-success border-success-subtle">React: 4.8/5</span>
                            <span class="skill-badge text-success border-success-subtle">CSS: 4.6/5</span>
                            <span class="skill-badge text-success border-success-subtle">HTML: 5/5</span>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <button class="btn btn-sm btn-outline-secondary w-100"><i class="bi bi-eye me-1"></i> View Details</button>
                        </div>
                        <div class="col-12 col-md-6">
                            <button class="btn btn-sm btn-primary w-100" style="background-color: var(--accent-color); border: none;"><i class="bi bi-chat-left-text me-1"></i> Provide Support</button>
                        </div>
                    </div>
                </div>

                <div class="student-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="d-flex gap-3">
                            <div class="rounded-circle bg-soft-teal text-teal d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px;">JS</div>
                            <div>
                                <h6 class="fw-bold text-main mb-0 small">Jane Smith</h6>
                                <small class="text-muted-custom" style="font-size: 0.7rem;">Frontend Development - Batch 2024A</small>
                            </div>
                        </div>
                        <span class="badge bg-soft-green text-green rounded-pill" style="font-size: 0.65rem;">Excellent</span>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-muted-custom">Overall Progress</span>
                            <span class="fw-bold text-success">85%</span>
                        </div>
                        <div class="progress" style="height: 4px; background-color: var(--bg-hover);">
                            <div class="progress-bar bg-success" style="width: 85%"></div>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-4 metric-box">
                            <span class="metric-label"><i class="bi bi-check2-square"></i> Tasks</span>
                            <span class="metric-value">21/25</span>
                        </div>
                        <div class="col-4 metric-box">
                            <span class="metric-label"><i class="bi bi-calendar-check"></i> Attendance</span>
                            <span class="metric-value">98%</span>
                        </div>
                        <div class="col-4 metric-box">
                            <span class="metric-label"><i class="bi bi-graph-up"></i> Weekly</span>
                            <span class="metric-value text-success">+8%</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted-custom fw-bold d-block mb-2" style="font-size: 0.7rem;">Skills Performance</small>
                        <div class="d-flex gap-2 flex-wrap">
                            <span class="skill-badge text-success border-success-subtle">JavaScript: 4.7/5</span>
                            <span class="skill-badge text-success border-success-subtle">React: 4.3/5</span>
                            <span class="skill-badge text-success border-success-subtle">CSS: 4.2/5</span>
                            <span class="skill-badge text-success border-success-subtle">HTML: 4.9/5</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <small class="text-warning fw-bold d-block mb-2" style="font-size: 0.7rem;">Areas Needing Attention</small>
                        <div class="d-flex gap-2 flex-wrap">
                            <span class="skill-badge warning">Performance Optimization</span>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <button class="btn btn-sm btn-outline-secondary w-100"><i class="bi bi-eye me-1"></i> View Details</button>
                        </div>
                        <div class="col-12 col-md-6">
                            <button class="btn btn-sm btn-primary w-100" style="background-color: var(--accent-color); border: none;"><i class="bi bi-chat-left-text me-1"></i> Provide Support</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
@endsection
