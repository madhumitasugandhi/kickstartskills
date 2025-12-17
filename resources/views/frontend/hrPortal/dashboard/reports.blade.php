@extends('frontend.hrPortal.dashboard.layouts.app')

@section('title', 'HR Analytics')

@section('icon', 'bi bi-bar-chart-fill fs-4 p-2 bg-soft-purple-custom rounded-3 text-purple-custom')

@section('content')
<style>
    /* --- Page Specific Styles --- */

    /* Header Banner */
    .analytics-header {
        background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%); /* Deep Indigo/Purple */
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 24px;
        color: white;
        border: 1px solid rgba(255,255,255,0.1);
        display: flex; justify-content: space-between; align-items: center;
    }
    .badge-live {
        background-color: rgba(16, 185, 129, 0.2); color: #34d399;
        border: 1px solid rgba(16, 185, 129, 0.3);
        padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;
        display: flex; align-items: center; gap: 6px;
    }
    .badge-live::before {
        content: ''; width: 8px; height: 8px; background-color: #34d399; border-radius: 50%;
        box-shadow: 0 0 8px #34d399;
    }

    /* Filter Bar */
    .filter-bar { display: flex; gap: 16px; margin-bottom: 24px; }
    .filter-select {
        background-color: var(--bg-card); border: 1px solid var(--border-color); color: var(--text-main);
        padding: 10px 16px; border-radius: 8px; flex-grow: 1; outline: none;
    }
    .btn-download {
        background-color: var(--bg-card); border: 1px solid var(--border-color); color: var(--text-muted);
        width: 42px; height: 42px; display: flex; align-items: center; justify-content: center;
        border-radius: 8px; transition: 0.2s;
    }
    .btn-download:hover { color: var(--text-main); border-color: var(--accent-color); }

    /* KPI Cards */
    .kpi-card {
        background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px;
        padding: 20px; height: 100%; position: relative; overflow: hidden;
    }
    .kpi-icon {
        width: 40px; height: 40px; border-radius: 8px; display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem; margin-bottom: 12px;
    }
    .trend-badge { font-size: 0.75rem; font-weight: 600; }
    .trend-up { color: #10b981; } .trend-down { color: #ef4444; }

    /* Custom Colors */
    .bg-purple-soft { background-color: rgba(139, 92, 246, 0.1); color: #8b5cf6; }
    .bg-green-soft { background-color: rgba(16, 185, 129, 0.1); color: #10b981; }
    .bg-blue-soft { background-color: rgba(59, 130, 246, 0.1); color: #3b82f6; }
    .bg-orange-soft { background-color: rgba(245, 158, 11, 0.1); color: #f59e0b; }

    /* --- CHARTS (CSS Only) --- */

    /* 1. Headcount Trend (Line Chart Area) */
    .chart-container {
        background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px;
        padding: 24px; margin-bottom: 24px;
    }
    .line-chart-svg { width: 100%; height: 200px; }
    .chart-line { fill: none; stroke: #8b5cf6; stroke-width: 3; stroke-linecap: round; filter: drop-shadow(0 4px 6px rgba(139, 92, 246, 0.4)); }
    .chart-grid { stroke: var(--border-color); stroke-width: 1; stroke-dasharray: 4; opacity: 0.3; }
    .chart-dot { fill: var(--bg-card); stroke: #8b5cf6; stroke-width: 2; }

    /* 2. Recruitment Funnel (Bar Chart) */
    .funnel-container {
        display: flex; justify-content: space-around; align-items: flex-end; height: 180px; padding-top: 20px;
    }
    .funnel-bar { width: 12px; border-radius: 6px 6px 0 0; position: relative; transition: height 1s; }
    .funnel-label { font-size: 0.7rem; color: var(--text-muted); text-align: center; margin-top: 8px; }

    /* Floating Stats in Funnel */
    .funnel-stat-box {
        background-color: rgba(255,255,255,0.03); border: 1px solid var(--border-color);
        padding: 8px 12px; border-radius: 8px; text-align: center; margin-bottom: 12px;
    }

    /* 3. Diversity Donut */
    .donut-lg {
        width: 160px; height: 160px; border-radius: 50%;
        background: conic-gradient(#3b82f6 0% 42%, #8b5cf6 42% 100%);
        position: relative; margin: 0 auto;
        display: flex; align-items: center; justify-content: center;
    }
    .donut-lg::after {
        content: ""; position: absolute; width: 110px; height: 110px;
        border-radius: 50%; background-color: var(--bg-card);
    }
    .donut-text { position: absolute; text-align: center; z-index: 1; font-weight: bold; font-size: 1.2rem; color: var(--text-main); }

    /* List Items */
    .metric-list-item {
        display: flex; justify-content: space-between; align-items: center;
        padding: 12px 0; border-bottom: 1px solid var(--border-color);
    }
    .metric-list-item:last-child { border-bottom: none; }
    .metric-label { font-size: 0.9rem; color: var(--text-muted); }
    .metric-val { font-weight: 600; color: var(--text-main); }
    .metric-val.bad { color: #ef4444; }
    .metric-val.good { color: #10b981; }

    /* Utilities */
    .text-purple-custom { color: #8b5cf6; }
    .bg-soft-purple-custom { background-color: rgba(139, 92, 246, 0.1); }
</style>

<div class="analytics-header">
    <div>
        <div class="d-flex align-items-center gap-3 mb-1">
            <div class="rounded-3 bg-white bg-opacity-10 p-2"><i class="bi bi-bar-chart-fill"></i></div>
            <h4 class="fw-bold m-0">HR Analytics Dashboard</h4>
        </div>
        <p class="mb-0 small opacity-75">Comprehensive insights into your organization's HR metrics</p>
    </div>
    <span class="badge-live">Live Data</span>
</div>

<div class="filter-bar">
    <select class="filter-select"><option>This Month</option><option>Last Quarter</option><option>This Year</option></select>
    <select class="filter-select"><option>All Departments</option><option>Engineering</option><option>Sales</option></select>
    <button class="btn-download"><i class="bi bi-download"></i></button>
</div>

<div class="row g-4 mb-4">
    <div class="col-12 col-md-6 col-xl-3">
        <div class="kpi-card">
            <div class="d-flex justify-content-between">
                <div class="kpi-icon bg-purple-soft"><i class="bi bi-people"></i></div>
                <div class="text-end"><i class="bi bi-graph-up-arrow trend-up"></i></div>
            </div>
            <h3 class="fw-bold text-main mb-1">247</h3>
            <div class="d-flex justify-content-between align-items-end">
                <small class="--text-muted">Total Headcount</small>
                <span class="trend-badge trend-up">+8.5%</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
        <div class="kpi-card">
            <div class="d-flex justify-content-between">
                <div class="kpi-icon bg-green-soft"><i class="bi bi-star"></i></div>
                <div class="text-end"><i class="bi bi-graph-up-arrow trend-up"></i></div>
            </div>
            <h3 class="fw-bold text-main mb-1">4.2</h3>
            <div class="d-flex justify-content-between align-items-end">
                <small class="--text-muted">Avg Performance</small>
                <span class="small --text-muted">Out of 5.0</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
        <div class="kpi-card">
            <div class="d-flex justify-content-between">
                <div class="kpi-icon bg-blue-soft"><i class="bi bi-calendar-check"></i></div>
                <div class="text-end"><i class="bi bi-graph-up-arrow trend-up"></i></div>
            </div>
            <h3 class="fw-bold text-main mb-1">94.2%</h3>
            <div class="d-flex justify-content-between align-items-end">
                <small class="--text-muted">Attendance Rate</small>
                <span class="trend-badge trend-up">+2.1%</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
        <div class="kpi-card">
            <div class="d-flex justify-content-between">
                <div class="kpi-icon bg-orange-soft"><i class="bi bi-person-x"></i></div>
                <div class="text-end"><i class="bi bi-graph-down-arrow trend-down"></i></div>
            </div>
            <h3 class="fw-bold text-main mb-1">12.8%</h3>
            <div class="d-flex justify-content-between align-items-end">
                <small class="--text-muted">Turnover Rate</small>
                <span class="trend-badge trend-down">-1.2%</span>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-12 col-lg-8">
        <div class="chart-container h-100">
            <h6 class="fw-bold text-main mb-4">Headcount Trend</h6>
            <svg class="line-chart-svg" viewBox="0 0 500 200">
                <line x1="0" y1="150" x2="500" y2="150" class="chart-grid" />
                <line x1="0" y1="100" x2="500" y2="100" class="chart-grid" />
                <line x1="0" y1="50" x2="500" y2="50" class="chart-grid" />

                <path d="M0,180 Q100,160 250,100 T500,50" class="chart-line" />

                <circle cx="0" cy="180" r="4" class="chart-dot" />
                <circle cx="250" cy="100" r="4" class="chart-dot" />
                <circle cx="500" cy="50" r="4" class="chart-dot" />
            </svg>
            <div class="d-flex justify-content-between mt-2 --text-muted small" style="font-size: 0.7rem;">
                <span>Jan</span><span>Feb</span><span>Mar</span><span>Apr</span><span>May</span><span>Jun</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="chart-container h-100">
            <h6 class="fw-bold text-main mb-3">Performance Insights</h6>

            <div class="metric-list-item">
                <span class="metric-label"><i class="bi bi-star me-2 text-warning"></i>Average Rating</span>
                <span class="metric-val">4.2/5.0</span>
            </div>
            <div class="metric-list-item">
                <span class="metric-label"><i class="bi bi-bullseye me-2 text-blue"></i>Goal Completion</span>
                <span class="metric-val">78.5%</span>
            </div>
            <div class="metric-list-item">
                <span class="metric-label"><i class="bi bi-check-circle me-2 text-purple-custom"></i>Reviews Done</span>
                <span class="metric-val">89.2%</span>
            </div>

            <div class="mt-4 p-3 rounded-3" style="background-color: rgba(245, 158, 11, 0.1);">
                <div class="d-flex align-items-center gap-2 mb-1">
                    <i class="bi bi-trophy-fill text-warning"></i>
                    <span class="fw-bold text-main small">Top Performers</span>
                </div>
                <small class="--text-muted">15 employees achieved 'Exceeds Expectations'</small>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-12 col-lg-8">
        <div class="chart-container h-100">
            <h6 class="fw-bold text-main mb-4">Recruitment Pipeline</h6>

            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="funnel-stat-box">
                        <h5 class="fw-bold text-blue mb-0">1243</h5>
                        <small class="--text-muted" style="font-size: 0.7rem;">Total Applications</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="funnel-stat-box">
                        <h5 class="fw-bold text-green mb-0">18</h5>
                        <small class="--text-muted" style="font-size: 0.7rem;">Successful Hires</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="funnel-stat-box">
                        <h5 class="fw-bold text-warning mb-0">1.4%</h5>
                        <small class="--text-muted" style="font-size: 0.7rem;">Conversion Rate</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="funnel-stat-box">
                        <h5 class="fw-bold text-purple-custom mb-0">21.5d</h5>
                        <small class="--text-muted" style="font-size: 0.7rem;">Avg Time to Hire</small>
                    </div>
                </div>
            </div>

            <div class="funnel-container">
                <div class="text-center">
                    <div class="funnel-bar" style="height: 100px; background-color: #8b5cf6;"></div>
                    <div class="funnel-label">Applied</div>
                </div>
                <div class="text-center">
                    <div class="funnel-bar" style="height: 80px; background-color: #8b5cf6; opacity: 0.8;"></div>
                    <div class="funnel-label">Screen</div>
                </div>
                <div class="text-center">
                    <div class="funnel-bar" style="height: 60px; background-color: #8b5cf6; opacity: 0.6;"></div>
                    <div class="funnel-label">Interview</div>
                </div>
                <div class="text-center">
                    <div class="funnel-bar" style="height: 40px; background-color: #8b5cf6; opacity: 0.4;"></div>
                    <div class="funnel-label">Offer</div>
                </div>
                <div class="text-center">
                    <div class="funnel-bar" style="height: 30px; background-color: #10b981;"></div>
                    <div class="funnel-label">Hired</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="chart-container h-100">
            <h6 class="fw-bold text-main mb-3">Turnover Analysis</h6>

            <div class="metric-list-item">
                <span class="metric-label">Turnover Rate</span>
                <span class="metric-val bad">12.8%</span>
            </div>
            <div class="metric-list-item">
                <span class="metric-label">Voluntary</span>
                <span class="metric-val text-warning">9.2%</span>
            </div>
            <div class="metric-list-item">
                <span class="metric-label">Involuntary</span>
                <span class="metric-val text-blue">3.6%</span>
            </div>
            <div class="metric-list-item">
                <span class="metric-label">Avg Tenure</span>
                <span class="metric-val good">2.5 years</span>
            </div>

            <h6 class="fw-bold text-main mt-4 mb-3">Diversity Analysis</h6>
            <div class="d-flex align-items-center">
                <div class="donut-lg me-3">
                    <span class="donut-text">42%<br><small style="font-size:0.7rem; font-weight:normal;">Female</small></span>
                </div>
                <div class="small">
                    <div class="mb-2"><i class="bi bi-circle-fill text-purple-custom me-2"></i>Female (42%)</div>
                    <div><i class="bi bi-circle-fill text-blue me-2"></i>Male (58%)</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
