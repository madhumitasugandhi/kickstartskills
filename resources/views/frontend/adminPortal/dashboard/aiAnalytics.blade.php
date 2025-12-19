@extends('frontend.adminPortal.dashboard.layouts.app')

@section('title', 'AI/ML Analytics')

@section('icon', 'bi-cpu')

@section('content')
<style>
    /* --- AI Analytics Page Styles --- */

    /* Stats Cards */
    .ai-stat-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        height: 100%;
        display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .ai-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        border-color: #3b82f6;
    }

    .ai-icon-lg { font-size: 1.8rem; margin-bottom: 10px; color: #3b82f6; }
    .ai-val-lg { font-size: 1.6rem; font-weight: 700; color: var(--text-main); margin-bottom: 4px; }
    .ai-lbl-sm { font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; }

    /* Custom Navigation Tabs (Scrollable) */
    .ai-tabs-nav {
        display: flex;
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 4px;
        margin-bottom: 24px;
        overflow-x: auto; /* Horizontal scroll for mobile */
        white-space: nowrap;
    }
    /* Hide scrollbar */
    .ai-tabs-nav::-webkit-scrollbar { height: 0px; background: transparent; }

    .ai-tab-link {
        flex: 1;
        min-width: 100px; /* Prevent squashing */
        text-align: center;
        padding: 10px;
        border: none;
        background: transparent;
        color: var(--text-muted);
        font-weight: 500;
        border-radius: 6px;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.2s;
    }
    .ai-tab-link:hover { color: var(--text-main); }
    .ai-tab-link.active {
        background-color: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
        font-weight: 600;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    /* Section Containers */
    .ai-section {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 24px;
    }
    .section-header {
        display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;
        flex-wrap: wrap; gap: 10px;
    }
    .section-title { font-size: 1rem; font-weight: 700; color: var(--text-main); display: flex; align-items: center; gap: 8px; }

    /* Prediction Insight Item */
    .insight-item {
        background-color: var(--bg-body);
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 16px;
        margin-bottom: 12px;
        border-left: 3px solid transparent;
        transition: 0.2s;
    }
    .insight-item:hover { transform: translateX(4px); }

    .insight-high { border-left-color: #10b981; }
    .insight-med { border-left-color: #f59e0b; }
    .insight-low { border-left-color: #ef4444; }

    .confidence-badge {
        font-size: 0.7rem; padding: 2px 8px; border-radius: 4px; font-weight: 600;
        background-color: rgba(255,255,255,0.05); border: 1px solid var(--border-color);
        white-space: nowrap;
    }

    /* Model List Item */
    .model-item {
        display: flex; align-items: center; justify-content: space-between;
        padding: 16px 0; border-bottom: 1px solid var(--border-color);
        flex-wrap: wrap; gap: 12px;
    }
    .model-item:last-child { border-bottom: none; }

    .model-icon {
        width: 40px; height: 40px; border-radius: 8px;
        background: rgba(59, 130, 246, 0.1); color: #3b82f6;
        display: flex; align-items: center; justify-content: center; font-size: 1.2rem;
        margin-right: 16px; flex-shrink: 0;
    }

    /* Chart Placeholders */
    .chart-placeholder-ai {
        height: 250px;
        background-color: rgba(255,255,255,0.02);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        border: 1px dashed var(--border-color);
        color: var(--text-muted);
    }

    /* Progress Bar */
    .accuracy-track { height: 6px; background-color: var(--bg-body); border-radius: 3px; overflow: hidden; width: 100px; }
    .accuracy-fill { height: 100%; border-radius: 3px; }

</style>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
    <div>
        <h5 class="fw-bold text-main mb-1">AI/ML Analytics Dashboard</h5>
        <small class="--text-muted">Advanced predictive insights and machine learning analytics</small>
    </div>
    <span class="badge bg-success bg-opacity-25 border border-success text-success px-3 py-2">
        <i class="bi bi-circle-fill small me-2"></i> AI Models Active
    </span>
</div>

<div class="row g-4 mb-4">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="ai-stat-card">
            <i class="bi bi-cpu ai-icon-lg"></i>
            <div class="ai-val-lg">12</div>
            <div class="ai-lbl-sm">Active Models</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="ai-stat-card">
            <i class="bi bi-activity ai-icon-lg" style="color: #10b981;"></i>
            <div class="ai-val-lg">2.4K</div>
            <div class="ai-lbl-sm">Predictions/Hour</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="ai-stat-card">
            <i class="bi bi-bullseye ai-icon-lg" style="color: #3b82f6;"></i>
            <div class="ai-val-lg">94.7%</div>
            <div class="ai-lbl-sm">Accuracy Rate</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="ai-stat-card">
            <i class="bi bi-lightning ai-icon-lg" style="color: #f59e0b;"></i>
            <div class="ai-val-lg">0.12s</div>
            <div class="ai-lbl-sm">Processing Time</div>
        </div>
    </div>
</div>

<div class="ai-tabs-nav">
    <button class="ai-tab-link active" onclick="switchTab('predictions')">Predictions</button>
    <button class="ai-tab-link" onclick="switchTab('models')">ML Models</button>
    <button class="ai-tab-link" onclick="switchTab('insights')">Auto Insights</button>
    <button class="ai-tab-link" onclick="switchTab('performance')">Performance</button>
</div>

<div id="tab-predictions" class="tab-content-block">
    <div class="ai-section">
        <div class="section-header">
            <div class="section-title"><i class="bi bi-graph-up-arrow text-primary"></i> Predictive Insights</div>
            <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-clockwise"></i> Refresh</button>
        </div>

        <div class="chart-placeholder-ai mb-4">
            <div class="text-center">
                <i class="bi bi-bar-chart-steps fs-1 text-primary mb-2"></i>
                <p>AI Prediction Visualization Chart</p>
            </div>
        </div>

        <div class="insight-item insight-high">
            <div class="d-flex justify-content-between align-items-start mb-1 flex-wrap gap-2">
                <span class="fw-bold text-main small">Student Enrollment Spike</span>
                <span class="confidence-badge text-success">89% Confident</span>
            </div>
            <p class="--text-muted small mb-0">+18% increase expected next month based on seasonal trends.</p>
        </div>

        <div class="insight-item insight-med">
            <div class="d-flex justify-content-between align-items-start mb-1 flex-wrap gap-2">
                <span class="fw-bold text-main small">Course Completion Rates</span>
                <span class="confidence-badge text-warning">76% Confident</span>
            </div>
            <p class="--text-muted small mb-0">Flutter course completion may drop by 5% due to curriculum difficulty spike.</p>
        </div>

        <div class="insight-item insight-high">
            <div class="d-flex justify-content-between align-items-start mb-1 flex-wrap gap-2">
                <span class="fw-bold text-main small">Revenue Forecast</span>
                <span class="confidence-badge text-success">94% Confident</span>
            </div>
            <p class="--text-muted small mb-0">12% growth in Q4 subscription revenue predicted.</p>
        </div>
    </div>

    <div class="ai-section">
        <div class="section-header">
            <div class="section-title"><i class="bi bi-people text-info"></i> Student Performance Predictions</div>
        </div>
        <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary border-opacity-10">
            <span class="text-danger small"><i class="bi bi-graph-down-arrow me-2"></i> At Risk Students</span>
            <div class="text-end">
                <span class="fw-bold text-main me-2">23</span>
                <span class="badge bg-soft-green text-success">+5%</span>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary border-opacity-10">
            <span class="text-success small"><i class="bi bi-graph-up-arrow me-2"></i> High Achievers</span>
            <div class="text-end">
                <span class="fw-bold text-main me-2">127</span>
                <span class="badge bg-soft-green text-success">+12%</span>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center py-2">
            <span class="text-primary small"><i class="bi bi-bar-chart me-2"></i> Avg. Completion</span>
            <div class="text-end">
                <span class="fw-bold text-main me-2">78%</span>
                <span class="badge bg-soft-green text-success">+3%</span>
            </div>
        </div>
    </div>
</div>

<div id="tab-models" class="tab-content-block d-none">
    <div class="ai-section">
        <div class="section-header">
            <div class="section-title"><i class="bi bi-robot text-primary"></i> Active ML Models</div>
            <button class="btn btn-sm btn-primary"><i class="bi bi-plus-lg"></i> Deploy Model</button>
        </div>

        <div class="model-item">
            <div class="d-flex align-items-center w-100 w-md-auto mb-2 mb-md-0">
                <div class="model-icon"><i class="bi bi-mortarboard"></i></div>
                <div>
                    <h6 class="fw-bold text-main mb-0">Student Success Predictor</h6>
                    <small class="--text-muted">Classification • Version 2.1</small>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between w-100 w-md-auto gap-4 mt-2 mt-md-0">
                <div class="text-end d-none d-md-block">
                    <small class="--text-muted d-block">Last Trained</small>
                    <small class="text-main fw-bold">2 hours ago</small>
                </div>
                <div class="text-end">
                    <small class="--text-muted d-block">Accuracy</small>
                    <span class="text-success fw-bold small">94%</span>
                </div>
                <span class="badge bg-soft-green text-success">Active</span>
            </div>
        </div>

        <div class="model-item">
            <div class="d-flex align-items-center w-100 w-md-auto mb-2 mb-md-0">
                <div class="model-icon"><i class="bi bi-collection-play"></i></div>
                <div>
                    <h6 class="fw-bold text-main mb-0">Course Recommendation Engine</h6>
                    <small class="--text-muted">Recommendation • Version 1.4</small>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between w-100 w-md-auto gap-4 mt-2 mt-md-0">
                <div class="text-end d-none d-md-block">
                    <small class="--text-muted d-block">Last Trained</small>
                    <small class="text-main fw-bold">6 hours ago</small>
                </div>
                <div class="text-end">
                    <small class="--text-muted d-block">Accuracy</small>
                    <span class="text-success fw-bold small">89%</span>
                </div>
                <span class="badge bg-soft-green text-success">Active</span>
            </div>
        </div>

        <div class="model-item">
            <div class="d-flex align-items-center w-100 w-md-auto mb-2 mb-md-0">
                <div class="model-icon"><i class="bi bi-person-x"></i></div>
                <div>
                    <h6 class="fw-bold text-main mb-0">Churn Prediction Model</h6>
                    <small class="--text-muted">Binary Classification • Version 3.0</small>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between w-100 w-md-auto gap-4 mt-2 mt-md-0">
                <div class="text-end d-none d-md-block">
                    <small class="--text-muted d-block">Last Trained</small>
                    <small class="text-main fw-bold">1 day ago</small>
                </div>
                <div class="text-end">
                    <small class="--text-muted d-block">Accuracy</small>
                    <span class="text-warning fw-bold small">87%</span>
                </div>
                <span class="badge bg-soft-warning text-warning">Training</span>
            </div>
        </div>
    </div>
</div>

<div id="tab-insights" class="tab-content-block d-none">
    <div class="ai-section">
        <div class="section-header">
            <div class="section-title"><i class="bi bi-lightbulb text-warning"></i> AI-Generated Insights</div>
            <button class="btn btn-sm btn-outline-primary"><i class="bi bi-magic me-2"></i> Generate New</button>
        </div>

        <div class="card bg-transparent border border-secondary border-opacity-25 mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2 flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-clock-history text-success"></i>
                        <h6 class="mb-0 text-main fw-bold">Peak Learning Hours Identified</h6>
                    </div>
                    <span class="badge bg-danger">High Impact</span>
                </div>
                <p class="text-main small mb-2" style=>Students show 23% higher engagement between 2-4 PM. Consider scheduling live sessions during this window.</p>
                <div class="d-flex gap-2 flex-wrap">
                    <span class="badge bg-secondary bg-opacity-25 text-secondary border border-secondary border-opacity-25">Engagement</span>
                    <span class="badge bg-secondary bg-opacity-25 text-secondary border border-secondary border-opacity-25">User Experience</span>
                </div>
            </div>
        </div>

        <div class="card bg-transparent border border-secondary border-opacity-25 mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2 flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-exclamation-triangle text-danger"></i>
                        <h6 class="mb-0 text-main fw-bold">Course Difficulty Mismatch</h6>
                    </div>
                    <span class="badge bg-danger">High Priority</span>
                </div>
                <p class="text-main small mb-2">React Advanced course has 34% higher dropout rate. Recommend adding intermediate bridge content.</p>
                <div class="d-flex gap-2 flex-wrap">
                    <span class="badge bg-secondary bg-opacity-25 text-secondary border border-secondary border-opacity-25">Content</span>
                    <span class="badge bg-secondary bg-opacity-25 text-secondary border border-secondary border-opacity-25">Retention</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="tab-performance" class="tab-content-block d-none">

    <div class="ai-section">
        <div class="section-header">
            <div class="section-title"><i class="bi bi-activity text-success"></i> AI System Performance</div>
        </div>
        <div class="row text-center g-4">
            <div class="col-6 col-md-3">
                <div class="p-3 border border-secondary border-opacity-25 rounded h-100">
                    <i class="bi bi-lightning-charge text-primary fs-4 mb-2"></i>
                    <h4 class="fw-bold text-main mb-0">0.12s</h4>
                    <small class="--text-muted">Inference Latency</small>
                    <div class="text-danger small mt-1">-15%</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3 border border-secondary border-opacity-25 rounded h-100">
                    <i class="bi bi-graph-up-arrow text-success fs-4 mb-2"></i>
                    <h4 class="fw-bold text-main mb-0">2.4K/hr</h4>
                    <small class="--text-muted">Throughput</small>
                    <div class="text-success small mt-1">+23%</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3 border border-secondary border-opacity-25 rounded h-100">
                    <i class="bi bi-bullseye text-info fs-4 mb-2"></i>
                    <h4 class="fw-bold text-main mb-0">94.7%</h4>
                    <small class="--text-muted">Model Accuracy</small>
                    <div class="text-success small mt-1">+2.1%</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3 border border-secondary border-opacity-25 rounded h-100">
                    <i class="bi bi-shield-check text-warning fs-4 mb-2"></i>
                    <h4 class="fw-bold text-main mb-0">99.98%</h4>
                    <small class="--text-muted">System Uptime</small>
                    <div class="text-success small mt-1">+0.02%</div>
                </div>
            </div>
        </div>
    </div>

    <div class="ai-section">
        <div class="section-header">
            <div class="section-title"><i class="bi bi-hdd-stack text-info"></i> AI API Performance</div>
        </div>

        <div class="d-flex justify-content-between align-items-center py-3 border-bottom border-secondary border-opacity-10">
            <div>
                <div class="fw-bold text-main mb-1 text-break">/api/v1/predict/student-success</div>
                <small class="--text-muted">Latency: 0.08s • Requests: 1.2K/hr</small>
            </div>
            <span class="text-success fw-bold small ms-2">Healthy</span>
        </div>

        <div class="d-flex justify-content-between align-items-center py-3 border-bottom border-secondary border-opacity-10">
            <div>
                <div class="fw-bold text-main mb-1 text-break">/api/v1/recommend/courses</div>
                <small class="--text-muted">Latency: 0.15s • Requests: 800/hr</small>
            </div>
            <span class="text-success fw-bold small ms-2">Healthy</span>
        </div>

        <div class="d-flex justify-content-between align-items-center py-3">
            <div>
                <div class="fw-bold text-main mb-1 text-break">/api/v1/analyze/learning-path</div>
                <small class="--text-muted">Latency: 0.23s • Requests: 400/hr</small>
            </div>
            <span class="text-warning fw-bold small ms-2">Warning</span>
        </div>
    </div>

    <div class="ai-section">
        <div class="section-header">
            <div class="section-title"><i class="bi bi-box-seam text-warning"></i> Resource Utilization</div>
        </div>

        <div class="mb-4">
            <div class="d-flex justify-content-between mb-1">
                <small class="--text-muted">GPU Utilization</small>
                <small class="text-danger fw-bold">78%</small>
            </div>
            <div class="progress" style="height: 4px; background: #333;">
                <div class="progress-bar bg-danger" style="width: 78%"></div>
            </div>
        </div>

        <div class="mb-4">
            <div class="d-flex justify-content-between mb-1">
                <small class="--text-muted">Memory Usage</small>
                <small class="text-warning fw-bold">65%</small>
            </div>
            <div class="progress" style="height: 4px; background: #333;">
                <div class="progress-bar bg-warning" style="width: 65%"></div>
            </div>
        </div>

        <div>
            <div class="d-flex justify-content-between mb-1">
                <small class="--text-muted">CPU Usage</small>
                <small class="text-success fw-bold">42%</small>
            </div>
            <div class="progress" style="height: 4px; background: #333;">
                <div class="progress-bar bg-success" style="width: 42%"></div>
            </div>
        </div>
    </div>
</div>

<script>
    function switchTab(tabName) {
        // 1. Reset all buttons
        document.querySelectorAll('.ai-tab-link').forEach(btn => btn.classList.remove('active'));

        // 2. Activate clicked button
        event.target.classList.add('active');

        // 3. Hide all tab content blocks
        document.querySelectorAll('.tab-content-block').forEach(el => el.classList.add('d-none'));

        // 4. Show the selected tab content
        const selectedTab = document.getElementById('tab-' + tabName);
        if (selectedTab) {
            selectedTab.classList.remove('d-none');
        }
    }
</script>

@endsection
