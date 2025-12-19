@extends('frontend.adminPortal.dashboard.layouts.app')

@section('title', 'Business Intelligence')

@section('icon', 'bi-lightbulb')

@section('content')
<style>
    /* --- Intelligence Page Styles --- */

    /* Top Stats Row */
    .bi-stat-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 20px;
        height: 100%;
        display: flex; flex-direction: column; justify-content: center;
        position: relative;
        transition: transform 0.2s;
    }
    .bi-stat-card:hover { transform: translateY(-2px); }

    .bi-trend-icon { font-size: 1rem; margin-bottom: 8px; display: inline-block; }
    .bi-val-lg { font-size: 1.6rem; font-weight: 700; color: var(--text-main); margin-bottom: 2px; }
    .bi-lbl-sm { font-size: 0.8rem; color: var(--text-muted); }
    .bi-badge-corner { position: absolute; top: 16px; right: 16px; font-size: 0.7rem; font-weight: 600; padding: 2px 6px; border-radius: 4px; }

    /* Custom Navigation Tabs */
    .bi-tabs-nav {
        display: flex; gap: 8px; margin-bottom: 24px;
        border-bottom: 1px solid var(--border-color); padding-bottom: 12px;
        overflow-x: auto; white-space: nowrap;
    }
    .bi-tab-link {
        border: none; background: transparent; color: var(--text-muted); font-size: 0.85rem; font-weight: 500; cursor: pointer;
        padding: 6px 16px; border-radius: 20px; transition: 0.2s;
    }
    .bi-tab-link:hover { color: var(--text-main); background-color: var(--bg-hover); }
    .bi-tab-link.active { background-color: #0f172a; border: 1px solid #3b82f6; color: #3b82f6; }

    /* Dashboard Selection Cards */
    .bi-dash-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        height: 100%;
        min-height: 220px;
        display: flex; flex-direction: column; justify-content: center;
        transition: all 0.2s;
        cursor: pointer;
        position: relative;
    }
    .bi-dash-card:hover { transform: translateY(-3px); border-color: #3b82f6; }

    /* Active State for Cards */
    .bi-dash-card.active {
        border-color: #3b82f6;
        box-shadow: 0 0 0 1px #3b82f6;
    }

    .dash-icon-box {
        width: 48px; height: 48px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem; margin-bottom: 16px;
    }

    /* Course Performance Section */
    .metric-chart-placeholder {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        height: 250px;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        color: var(--text-muted);
        margin-bottom: 24px;
    }

    /* Ranking Items */
    .ranking-item {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 12px;
        display: flex; align-items: center; justify-content: space-between;
        transition: 0.2s;
    }
    .ranking-item:hover { border-color: var(--text-muted); }

    .rank-num {
        width: 28px; height: 28px; background: rgba(59, 130, 246, 0.1); color: #3b82f6;
        border-radius: 6px; display: flex; align-items: center; justify-content: center;
        font-weight: 700; font-size: 0.8rem; margin-right: 16px;
    }

    /* Reports List */
    .report-item {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-left: 3px solid transparent;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 16px;
        display: flex; flex-direction: column;
    }
    @media(min-width: 768px) {
        .report-item { flex-direction: row; align-items: center; justify-content: space-between; }
    }

    .report-item.active-report { border-left-color: #10b981; }
    .report-item.paused-report { border-left-color: #f59e0b; }

    /* Template Cards */
    .template-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 0;
        overflow: hidden;
        height: 100%;
        display: flex; flex-direction: column;
    }
    .template-body { padding: 20px; flex-grow: 1; }
    .template-footer {
        padding: 12px 20px; border-top: 1px solid var(--border-color);
        background-color: var(--bg-body);
        display: flex; gap: 10px;
    }

    /* Placeholders */
    .placeholder-container {
        height: 400px;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        color: var(--text-muted);
        text-align: center;
    }

    /* Float Button */
    .create-report-btn {
        position: fixed; bottom: 30px; right: 30px; z-index: 99;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        padding: 12px 24px; border-radius: 50px; font-weight: 600;
    }
</style>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div class="d-flex align-items-center">
        <div class="p-2 rounded bg-primary bg-opacity-10 text-primary me-3"><i class="bi bi-bar-chart-line fs-4"></i></div>
        <div>
            <h5 class="fw-bold text-main mb-0">Advanced Business Intelligence</h5>
            <small class="--text-muted">Comprehensive data analytics and business insights dashboard</small>
        </div>
    </div>
    <span class="badge bg-success bg-opacity-10 border border-success text-success px-3 py-2 align-self-start align-self-md-center">
        <i class="bi bi-circle-fill small me-2"></i> Data Current: 2m ago
    </span>
</div>

<div class="row g-4 mb-4">
    <div class="col-6 col-xl-3">
        <div class="bi-stat-card">
            <span class="bi-badge-corner text-success bg-soft-green">+18.2%</span>
            <i class="bi bi-graph-up-arrow bi-trend-icon text-success"></i>
            <div class="bi-val-lg text-success">$42.8K</div>
            <div class="bi-lbl-sm">Revenue (MTD)</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="bi-stat-card">
            <span class="bi-badge-corner text-success bg-soft-green">+12.5%</span>
            <i class="bi bi-people bi-trend-icon text-primary"></i>
            <div class="bi-val-lg text-primary">8,247</div>
            <div class="bi-lbl-sm">Active Users</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="bi-stat-card">
            <span class="bi-badge-corner text-success bg-soft-green">+0.4%</span>
            <i class="bi bi-bullseye bi-trend-icon text-info"></i>
            <div class="bi-val-lg text-info">3.8%</div>
            <div class="bi-lbl-sm">Conversion Rate</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="bi-stat-card">
            <span class="bi-badge-corner text-danger bg-soft-red">-0.3%</span>
            <i class="bi bi-arrow-down-right bi-trend-icon text-warning"></i>
            <div class="bi-val-lg text-warning">2.1%</div>
            <div class="bi-lbl-sm">Churn Rate</div>
        </div>
    </div>
</div>

<div class="bi-tabs-nav">
    <button class="bi-tab-link active" onclick="switchMainTab('dashboards')">Dashboards</button>
    <button class="bi-tab-link" onclick="switchMainTab('reports')">Reports</button>
    <button class="bi-tab-link" onclick="switchMainTab('analytics')">Analytics</button>
    <button class="bi-tab-link" onclick="switchMainTab('insights')">Insights</button>
    <button class="bi-tab-link" onclick="switchMainTab('visualization')">Visualization</button>
</div>

<div id="main-tab-dashboards" class="main-tab-content">

    <h6 class="text-main fw-bold mb-3">Business Intelligence Dashboards</h6>
    <p class="--text-muted small mb-4">Select a dashboard to view detailed analytics and insights</p>

    <div class="row g-4 mb-4">

        <div class="col-12 col-md-6">
            <div class="bi-dash-card" id="card-executive" onclick="selectDetailDashboard('executive')">
                <div class="dash-icon-box bg-soft-blue text-primary"><i class="bi bi-briefcase"></i></div>
                <h5 class="fw-bold text-main mb-1">Executive Summary</h5>
                <p class="--text-muted small mb-0">High-level KPIs and business metrics overview for stakeholders.</p>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="bi-dash-card" id="card-financial" onclick="selectDetailDashboard('financial')">
                <div class="dash-icon-box bg-soft-green text-success"><i class="bi bi-currency-dollar"></i></div>
                <h5 class="fw-bold text-main mb-1">Financial Overview</h5>
                <p class="--text-muted small mb-0">Revenue, costs, profit margins, and financial forecasting.</p>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="bi-dash-card" id="card-users" onclick="selectDetailDashboard('users')">
                <div class="dash-icon-box bg-soft-purple text-primary"><i class="bi bi-people"></i></div>
                <h5 class="fw-bold text-main mb-1">User Analytics</h5>
                <p class="--text-muted small mb-0">User behavior, engagement metrics, and retention analysis.</p>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="bi-dash-card active" id="card-courses" onclick="selectDetailDashboard('courses')">
                <div class="dash-icon-box bg-soft-warning text-warning"><i class="bi bi-journal-bookmark"></i></div>
                <h5 class="fw-bold text-main mb-1">Course Performance</h5>
                <p class="--text-muted small mb-0">Course completion rates, ratings, and content popularity.</p>
            </div>
        </div>
    </div>

    <div id="detail-view-courses" class="detail-section">

        <div class="metric-chart-placeholder">
            <i class="bi bi-book fs-1 text-warning mb-3 opacity-50"></i>
            <h6 class="fw-bold text-main">Course Performance Metrics</h6>
            <small class="--text-muted">Enrollment and completion rates by course category</small>
        </div>

        <h6 class="fw-bold text-main mb-3"><i class="bi bi-graph-up text-warning me-2"></i> Course Performance Rankings</h6>

        <div class="ranking-item">
            <div class="d-flex align-items-center">
                <div class="rank-num">#1</div>
                <div>
                    <div class="fw-bold text-main small">Advanced Flutter Animations</div>
                    <small class="--text-muted" style="font-size: 0.75rem;">1456 enrollments • 89% completion</small>
                </div>
            </div>
            <div class="text-warning fw-bold small"><i class="bi bi-star-fill me-1"></i> 4.9</div>
        </div>

        <div class="ranking-item">
            <div class="d-flex align-items-center">
                <div class="rank-num">#2</div>
                <div>
                    <div class="fw-bold text-main small">Microservices with Docker</div>
                    <small class="--text-muted" style="font-size: 0.75rem;">1203 enrollments • 76% completion</small>
                </div>
            </div>
            <div class="text-warning fw-bold small"><i class="bi bi-star-fill me-1"></i> 4.8</div>
        </div>

        <div class="ranking-item">
            <div class="d-flex align-items-center">
                <div class="rank-num">#3</div>
                <div>
                    <div class="fw-bold text-main small">Machine Learning Fundamentals</div>
                    <small class="--text-muted" style="font-size: 0.75rem;">1034 enrollments • 72% completion</small>
                </div>
            </div>
            <div class="text-warning fw-bold small"><i class="bi bi-star-fill me-1"></i> 4.7</div>
        </div>

        <div class="ranking-item">
            <div class="d-flex align-items-center">
                <div class="rank-num">#4</div>
                <div>
                    <div class="fw-bold text-main small">GraphQL API Development</div>
                    <small class="--text-muted" style="font-size: 0.75rem;">892 enrollments • 84% completion</small>
                </div>
            </div>
            <div class="text-warning fw-bold small"><i class="bi bi-star-fill me-1"></i> 4.8</div>
        </div>
    </div>

    <div id="detail-view-other" class="detail-section d-none">
        <div class="placeholder-container">
            <i class="bi bi-bar-chart-steps fs-1 --text-muted opacity-25 mb-3"></i>
            <h6 class="text-main">Dashboard Detail View</h6>
            <p class="small --text-muted">Select a different dashboard to see metrics here.</p>
        </div>
    </div>
</div>

<div id="main-tab-reports" class="main-tab-content d-none">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h6 class="text-main fw-bold mb-1">Business Intelligence Reports</h6>
            <small class="--text-muted">Generate, schedule, and manage comprehensive business reports</small>
        </div>
        <button class="btn btn-sm btn-link text-primary text-decoration-none"><i class="bi bi-plus-lg me-1"></i> Generate Report</button>
    </div>

    <h6 class="--text-muted small fw-bold text-uppercase mt-4 mb-3">Scheduled Reports</h6>

    <div class="report-item active-report">
        <div class="mb-2 mb-md-0">
            <div class="d-flex align-items-center gap-2 mb-1">
                <span class="dot bg-success rounded-circle" style="width: 8px; height: 8px;"></span>
                <h6 class="fw-bold text-main mb-0">Weekly Executive Summary</h6>
            </div>
            <div class="small --text-muted"><i class="bi bi-clock me-1"></i> Every Monday 9:00 AM &bull; <i class="bi bi-envelope me-1"></i> 2 recipients</div>
            <small class="--text-muted d-block mt-1" style="font-size: 0.75rem;">Last generated: 2 days ago</small>
        </div>
        <div class="d-flex gap-3 align-items-center">
            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">ACTIVE</span>
            <div class="d-flex gap-3">
                <a href="#" class="small text-primary text-decoration-none">Edit</a>
                <a href="#" class="small text-primary text-decoration-none">Run Now</a>
            </div>
        </div>
    </div>

    <div class="report-item active-report">
        <div class="mb-2 mb-md-0">
            <div class="d-flex align-items-center gap-2 mb-1">
                <span class="dot bg-success rounded-circle" style="width: 8px; height: 8px;"></span>
                <h6 class="fw-bold text-main mb-0">Monthly Financial Report</h6>
            </div>
            <div class="small --text-muted"><i class="bi bi-calendar3 me-1"></i> 1st of every month &bull; <i class="bi bi-envelope me-1"></i> 1 recipients</div>
            <small class="--text-muted d-block mt-1" style="font-size: 0.75rem;">Last generated: 12 days ago</small>
        </div>
        <div class="d-flex gap-3 align-items-center">
            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">ACTIVE</span>
            <div class="d-flex gap-3">
                <a href="#" class="small text-primary text-decoration-none">Edit</a>
                <a href="#" class="small text-primary text-decoration-none">Run Now</a>
            </div>
        </div>
    </div>

    <div class="report-item paused-report">
        <div class="mb-2 mb-md-0">
            <div class="d-flex align-items-center gap-2 mb-1">
                <span class="dot bg-warning rounded-circle" style="width: 8px; height: 8px;"></span>
                <h6 class="fw-bold text-main mb-0">Quarterly Performance Review</h6>
            </div>
            <div class="small --text-muted"><i class="bi bi-calendar3 me-1"></i> Every 3 months &bull; <i class="bi bi-envelope me-1"></i> 1 recipients</div>
            <small class="--text-muted d-block mt-1" style="font-size: 0.75rem;">Last generated: 45 days ago</small>
        </div>
        <div class="d-flex gap-3 align-items-center">
            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25">PAUSED</span>
            <div class="d-flex gap-3">
                <a href="#" class="small text-primary text-decoration-none">Edit</a>
                <a href="#" class="small text-primary text-decoration-none">Run Now</a>
            </div>
        </div>
    </div>

    <h6 class="--text-muted small fw-bold text-uppercase mt-4 mb-3">Report Templates</h6>
    <div class="row g-4">
        <div class="col-md-6">
            <div class="template-card">
                <div class="template-body">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-briefcase text-primary"></i>
                        <h6 class="fw-bold text-main mb-0">Executive Summary</h6>
                    </div>
                    <p class="--text-muted small mb-0">High-level business metrics and KPI overview</p>
                    <div class="mt-3">
                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25">Executive</span>
                        <small class="--text-muted float-end mt-1">Weekly/Monthly</small>
                    </div>
                </div>
                <div class="template-footer">
                    <button class="btn btn-sm w-50" style="border: 1px solid var(--border-color); color: var(--text-main);">Preview</button>
                    <button class="btn btn-sm btn-primary w-50">Use</button>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="template-card">
                <div class="template-body">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-currency-dollar text-success"></i>
                        <h6 class="fw-bold text-main mb-0">Financial Analysis</h6>
                    </div>
                    <p class="--text-muted small mb-0">Revenue, costs, profitability, and financial health</p>
                    <div class="mt-3">
                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25">Finance</span>
                        <small class="--text-muted float-end mt-1">Monthly/Quarterly</small>
                    </div>
                </div>
                <div class="template-footer">
                    <button class="btn btn-sm w-50" style="border: 1px solid var(--border-color); color: var(--text-main);">Preview</button>
                    <button class="btn btn-sm btn-success w-50">Use</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="main-tab-analytics" class="main-tab-content d-none">
    <div class="placeholder-container">
        <i class="bi bi-bar-chart-line fs-1 text-primary mb-3"></i>
        <h6 class="text-main">Advanced Analytics Engine</h6>
        <p class="--text-muted small">Predictive modeling and statistical analysis coming soon.</p>
    </div>
</div>

<div id="main-tab-insights" class="main-tab-content d-none">
    <div class="placeholder-container">
        <i class="bi bi-lightbulb fs-1 text-warning mb-3"></i>
        <h6 class="text-main">AI Business Insights</h6>
        <p class="--text-muted small">Intelligent recommendations and growth opportunities coming soon.</p>
    </div>
</div>

<div id="main-tab-visualization" class="main-tab-content d-none">
    <div class="placeholder-container">
        <i class="bi bi-pie-chart fs-1 text-primary mb-3"></i>
        <h6 class="text-main">Interactive Data Visualizations</h6>
        <p class="--text-muted small">Custom charts and interactive data exploration coming soon.</p>
    </div>
</div>

<button class="btn btn-primary text-white create-report-btn">
    <i class="bi bi-plus-lg me-2"></i> Create Report
</button>

<script>
    // 1. Switch Main Tabs
    function switchMainTab(tabName) {
        document.querySelectorAll('.bi-tab-link').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');

        document.querySelectorAll('.main-tab-content').forEach(el => el.classList.add('d-none'));
        document.getElementById('main-tab-' + tabName).classList.remove('d-none');
    }

    // 2. Select Dashboard Card
    function selectDetailDashboard(type) {
        // Reset Cards
        document.querySelectorAll('.bi-dash-card').forEach(card => card.classList.remove('active'));
        document.getElementById('card-' + type).classList.add('active');

        // Logic for detail view content
        const courseDetail = document.getElementById('detail-view-courses');
        const otherDetail = document.getElementById('detail-view-other');

        if (type === 'courses') {
            courseDetail.classList.remove('d-none');
            otherDetail.classList.add('d-none');
        } else {
            courseDetail.classList.add('d-none');
            otherDetail.classList.remove('d-none');
        }
    }
</script>

@endsection
