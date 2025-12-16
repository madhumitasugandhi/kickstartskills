@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Mentoring Reports')
@section('icon', 'bi bi-file-earmark-text fs-4 p-2 bg-soft-orange rounded-3 text-accent')

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
        transition: transform 0.2s;
    }
    .stat-card:hover { transform: translateY(-2px); }

    .stat-icon { font-size: 1.5rem; margin-bottom: 12px; }
    .stat-val { font-size: 1.6rem; font-weight: 700; margin-bottom: 4px; line-height: 1.2; color: var(--text-blue); }
    .stat-lbl { font-size: 0.75rem; color: var(--text-muted); font-weight: 500; }

    /* Report Card */
    .report-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 16px;
    }

    .report-icon-box {
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
        font-size: 0.65rem; padding: 3px 10px; border-radius: 20px; border: 1px solid;
    }
    .st-ready { background-color: rgba(16, 185, 129, 0.1); color: #10b981; border-color: rgba(16, 185, 129, 0.2); }
    .st-process { background-color: rgba(253, 126, 20, 0.1); color: #fd7e14; border-color: rgba(253, 126, 20, 0.2); }

    .type-badge {
        font-size: 0.65rem; color: var(--text-muted);
        background-color: var(--bg-hover); padding: 2px 8px; border-radius: 4px;
    }

    /* Template Sidebar */
    .template-item {
        background-color: var(--bg-card);
        padding: 16px 0;
        border-bottom: 1px solid var(--border-color);
    }
    .template-item:last-child { border-bottom: none; }

    .time-badge { font-size: 0.7rem; color: var(--text-muted); display: flex; align-items: center; gap: 4px; }
    .pct-badge { font-size: 0.7rem; color: #10b981; font-weight: 600; }

    /* Metric Data Points */
    .metric-point {
        font-size: 0.75rem; color: var(--accent-color); background-color: var(--soft-orange);
        padding: 4px 8px; border-radius: 4px; white-space: nowrap;
    }

    /* Responsive Tweaks */
    @media (max-width: 768px) {
        .stat-card { padding: 16px; }
        .action-row { row-gap: 10px; }
    }
</style>

<div class="content-body">

    <div class="card-custom mb-4" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 20px;">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <div class="fs-4 p-2 bg-soft-orange rounded-3 text-accent">
                    <i class="bi bi-file-earmark-text fs-3"></i>
                </div>
                <div>
                    <h4 class="fw-bold text-main mb-1">Mentoring Reports</h4>
                    <p class="text-muted-custom mb-0 small">Generate comprehensive reports and analytics for your mentoring activities</p>
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
                <label class="form-label small text-muted-custom fw-bold mb-1">Timeframe</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0" style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-muted);">
                        <i class="bi bi-calendar"></i>
                    </span>
                    <select class="form-select border-start-0 ps-0" style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                        <option>This Month</option>
                        <option>Last Month</option>
                        <option>Last Quarter</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <label class="form-label small text-muted-custom fw-bold mb-1">Report Type</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0" style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-muted);">
                        <i class="bi bi-file-text"></i>
                    </span>
                    <select class="form-select border-start-0 ps-0" style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                        <option>All Reports</option>
                        <option>Individual</option>
                        <option>Summary</option>
                    </select>
                </div>
            </div>
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
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon text-primary"><i class="bi bi-file-earmark-bar-graph"></i></div>
                <div class="stat-val">5</div>
                <div class="stat-lbl">Total Reports</div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon text-success"><i class="bi bi-check-circle"></i></div>
                <div class="stat-val text-success">3</div>
                <div class="stat-lbl">Ready</div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon text-warning"><i class="bi bi-clock-history"></i></div>
                <div class="stat-val text-warning">1</div>
                <div class="stat-lbl">Processing</div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon text-info"><i class="bi bi-download"></i></div>
                <div class="stat-val text-info">26</div>
                <div class="stat-lbl">Downloads</div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-12 col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold text-main m-0">Reports (5)</h6>
                <i class="bi bi-arrow-repeat text-muted-custom cursor-pointer"></i>
            </div>

            <div class="report-card">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="d-flex gap-3">
                        <div class="report-icon-box icon-orange">
                            <i class="bi bi-person"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-main mb-1">Individual Student Assessment - Mike Johnson</h6>
                            <span class="type-badge">Individual Report</span>
                        </div>
                    </div>
                    <span class="status-badge st-ready"><i class="bi bi-check2 me-1"></i> Ready</span>
                </div>

                <p class="text-muted-custom small mb-3">
                    Comprehensive assessment report for Mike Johnson including progress, challenges, and recommendations.
                </p>

                <div class="mb-3">
                    <small class="text-main fw-bold d-block mb-2" style="font-size: 0.75rem;">Key Metrics</small>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="metric-point">Overall Progress: 42%</span>
                        <span class="metric-point">Tasks Completed: 8/20</span>
                        <span class="metric-point">Skill Rating: 2.8/5</span>
                        <span class="metric-point">Attendance: 78%</span>
                    </div>
                </div>

                <div class="d-flex gap-3 text-muted-custom small mb-4 align-items-center">
                    <span><i class="bi bi-file-earmark-pdf me-1"></i> Generated yesterday</span>
                    <span><i class="bi bi-hdd me-1"></i> 960 KB</span>
                    <span><i class="bi bi-download me-1"></i> 3 downloads</span>
                </div>

                <div class="row g-2 action-row">
                    <div class="col-12 col-md-6">
                        <button class="btn btn-sm btn-outline-secondary w-100 fw-bold border-secondary-subtle">
                            <i class="bi bi-eye me-1"></i> View Report
                        </button>
                    </div>
                    <div class="col-12 col-md-6">
                        <button class="btn btn-sm btn-primary w-100 fw-bold" style="background-color: var(--accent-color); border: none;">
                            <i class="bi bi-download me-1"></i> Download
                        </button>
                    </div>
                </div>
            </div>

            <div class="report-card">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="d-flex gap-3">
                        <div class="report-icon-box icon-blue">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-main mb-1">Monthly Progress Summary - October 2024</h6>
                            <span class="type-badge">Progress Report</span>
                        </div>
                    </div>
                    <span class="status-badge st-ready"><i class="bi bi-check2 me-1"></i> Ready</span>
                </div>

                <p class="text-muted-custom small mb-3">
                    Comprehensive overview of student progress, session statistics, and key achievements for October.
                </p>

                <div class="mb-3">
                    <small class="text-main fw-bold d-block mb-2" style="font-size: 0.75rem;">Key Metrics</small>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="metric-point">Students Tracked: 35</span>
                        <span class="metric-point">Sessions Conducted: 128</span>
                        <span class="metric-point">Avg Progress: 78%</span>
                        <span class="metric-point">Completion Rate: 85%</span>
                    </div>
                </div>

                <div class="d-flex gap-3 text-muted-custom small mb-4 align-items-center">
                    <span><i class="bi bi-file-earmark-pdf me-1"></i> Generated 2d ago</span>
                    <span><i class="bi bi-hdd me-1"></i> 2.3 MB</span>
                    <span><i class="bi bi-download me-1"></i> 13 downloads</span>
                </div>

                <div class="row g-2 action-row">
                    <div class="col-12 col-md-6">
                        <button class="btn btn-sm btn-outline-secondary w-100 fw-bold border-secondary-subtle">
                            <i class="bi bi-eye me-1"></i> View Report
                        </button>
                    </div>
                    <div class="col-12 col-md-6">
                        <button class="btn btn-sm btn-primary w-100 fw-bold" style="background-color: var(--accent-color); border: none;">
                            <i class="bi bi-download me-1"></i> Download
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-12 col-lg-4">
            <div class="card-custom h-100" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px;">
                <h6 class="fw-bold text-main mb-2">Report Templates</h6>

                <div class="template-item">
                    <div class="d-flex justify-content-between align-items-start mb-1">
                        <div class="d-flex align-items-center gap-2 text-primary">
                            <i class="bi bi-graph-up"></i>
                            <span class="fw-bold small">Monthly Progress Report</span>
                        </div>
                        <span class="pct-badge">65%</span>
                    </div>
                    <p class="text-muted-custom small mb-2" style="font-size: 0.75rem;">Comprehensive monthly overview of student progress and mentoring activities.</p>
                    <span class="time-badge"><i class="bi bi-clock"></i> 5-10 minutes</span>
                </div>

                <div class="template-item">
                    <div class="d-flex justify-content-between align-items-start mb-1">
                        <div class="d-flex align-items-center gap-2 text-warning">
                            <i class="bi bi-person"></i>
                            <span class="fw-bold small">Individual Assessment</span>
                        </div>
                        <span class="pct-badge">87%</span>
                    </div>
                    <p class="text-muted-custom small mb-2" style="font-size: 0.75rem;">Detailed assessment report for individual student analysis.</p>
                    <span class="time-badge"><i class="bi bi-clock"></i> 3-5 minutes</span>
                </div>

                <div class="template-item">
                    <div class="d-flex justify-content-between align-items-start mb-1">
                        <div class="d-flex align-items-center gap-2 text-info">
                            <i class="bi bi-calendar-check"></i>
                            <span class="fw-bold small">Session Summary Report</span>
                        </div>
                        <span class="pct-badge">72%</span>
                    </div>
                    <p class="text-muted-custom small mb-2" style="font-size: 0.75rem;">Analysis of mentoring sessions and engagement metrics.</p>
                    <span class="time-badge"><i class="bi bi-clock"></i> 2-4 minutes</span>
                </div>

                <div class="template-item">
                    <div class="d-flex justify-content-between align-items-start mb-1">
                        <div class="d-flex align-items-center gap-2 text-success">
                            <i class="bi bi-shield-check"></i>
                            <span class="fw-bold small">Custom Analytics Report</span>
                        </div>
                        <span class="pct-badge">44%</span>
                    </div>
                    <p class="text-muted-custom small mb-2" style="font-size: 0.75rem;">Customizable report with flexible metrics and timeframes.</p>
                    <span class="time-badge"><i class="bi bi-clock"></i> 10-15 minutes</span>
                </div>

            </div>
        </div>

    </div>

</div>
@endsection
