@extends('frontend.adminPortal.dashboard.layouts.app')

@section('title', 'Enterprise Workflows')

@section('icon', 'bi-diagram-3')

@section('content')
<style>
    /* --- Workflow Page Styles --- */

    /* Stats Cards */
    .wf-stat-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        height: 100%;
        display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;
        transition: transform 0.2s;
    }
    .wf-stat-card:hover { transform: translateY(-3px); border-color: var(--accent-color); }

    .wf-icon-lg { font-size: 1.8rem; margin-bottom: 8px; }
    .wf-val-lg { font-size: 1.6rem; font-weight: 700; color: var(--text-main); margin-bottom: 2px; }
    .wf-lbl-sm { font-size: 0.8rem; color: var(--text-muted); }

    /* Custom Navigation Tabs (Pill Style - Scrollable) */
    .wf-tabs-nav {
        display: flex;
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 4px;
        margin-bottom: 24px;
        overflow-x: auto; /* Allow horizontal scrolling on small screens */
        white-space: nowrap;
    }
    /* Hide scrollbar for cleaner look */
    .wf-tabs-nav::-webkit-scrollbar { height: 0px; background: transparent; }

    .wf-tab-link {
        flex: 1;
        min-width: 120px; /* Ensure buttons don't squash too much */
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
    .wf-tab-link:hover { color: var(--text-main); }
    .wf-tab-link.active {
        background-color: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
        font-weight: 600;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    /* --- ACTIVE WORKFLOWS STYLES --- */
    .workflow-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 16px;
        position: relative;
    }

    .wf-header {
        display: flex; justify-content: space-between; align-items: start; margin-bottom: 16px;
        flex-wrap: wrap; gap: 8px;
    }
    .wf-title { font-size: 1rem; font-weight: 700; color: var(--text-main); margin-bottom: 4px; display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
    .wf-meta {
        font-size: 0.8rem; color: var(--text-muted);
        display: flex; gap: 16px; flex-wrap: wrap;
    }

    .priority-badge { font-size: 0.65rem; padding: 2px 6px; border-radius: 4px; font-weight: 700; text-transform: uppercase; }
    .prio-high { background: rgba(239, 68, 68, 0.15); color: #ef4444; }
    .prio-med { background: rgba(245, 158, 11, 0.15); color: #f59e0b; }
    .prio-low { background: rgba(59, 130, 246, 0.15); color: #3b82f6; }

    .status-text { font-size: 0.75rem; font-weight: 600; text-transform: uppercase; white-space: nowrap; }
    .status-running { color: #10b981; }
    .status-pending { color: #f59e0b; }
    .status-paused { color: #ef4444; }

    /* Progress Bar */
    .wf-progress-container { margin-bottom: 16px; }
    .wf-step-info { display: flex; justify-content: space-between; font-size: 0.85rem; margin-bottom: 6px; color: var(--text-main); }
    .wf-progress-track { height: 6px; background-color: var(--bg-body); border-radius: 3px; overflow: hidden; }
    .wf-progress-fill { height: 100%; border-radius: 3px; transition: width 0.5s ease; }

    /* Workflow Actions Footer */
    .wf-footer {
        background-color: var(--bg-body);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        display: flex; overflow: hidden;
    }
    .wf-action-btn {
        flex: 1; border: none; background: transparent; padding: 10px;
        font-size: 0.85rem; font-weight: 500; color: var(--text-muted);
        transition: 0.2s; border-right: 1px solid var(--border-color);
    }
    .wf-action-btn:last-child { border-right: none; }
    .wf-action-btn:hover { background-color: var(--bg-hover); color: var(--text-main); }

    .btn-pause:hover { color: #f59e0b; background-color: rgba(245, 158, 11, 0.1); }
    .btn-resume:hover { color: #10b981; background-color: rgba(16, 185, 129, 0.1); }

    /* --- AUTOMATION STYLES --- */
    .automation-item {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 12px;
    }
    .auto-icon {
        width: 36px; height: 36px; border-radius: 8px;
        background: rgba(16, 185, 129, 0.1); color: #10b981;
        display: flex; align-items: center; justify-content: center; font-size: 1.1rem;
        flex-shrink: 0;
    }
    /* Responsive Grid for automation stats */
    .auto-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px; margin-top: 12px; padding-top: 12px; border-top: 1px dashed var(--border-color);
    }
    @media (min-width: 576px) {
        .auto-grid { grid-template-columns: 1fr 1fr 1fr; }
    }

    .auto-stat-label { font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; display: block; margin-bottom: 2px; }
    .auto-stat-val { font-size: 0.9rem; font-weight: 600; color: var(--text-main); }

    /* --- TEMPLATES STYLES --- */
    .template-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        height: 100%;
        display: flex; flex-direction: column;
    }
    .template-card:hover { border-color: #3b82f6; }
    .tpl-preview-box { height: 100px; background-color: var(--bg-body); border-radius: 8px; margin-bottom: 16px; display: flex; align-items: center; justify-content: center; color: var(--text-muted); }

    /* --- ANALYTICS STYLES --- */
    .insight-row {
        padding: 16px; border-bottom: 1px solid var(--border-color);
        display: flex; flex-direction: column; gap: 12px;
    }
    @media(min-width: 768px) {
        .insight-row { flex-direction: row; justify-content: space-between; align-items: center; }
    }
    .insight-row:last-child { border-bottom: none; }

</style>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
    <div>
        <h5 class="fw-bold text-main mb-1">Enterprise Workflow Management</h5>
        <small class="--text-muted">Automate business processes and manage organizational workflows</small>
    </div>
    <div class="d-flex flex-wrap gap-2 w-100 w-md-auto">
        <span class="badge bg-success bg-opacity-25 border border-success text-success px-3 py-2 flex-grow-1 flex-md-grow-0 text-center">
            <i class="bi bi-check-circle-fill small me-2"></i> All Systems Operational
        </span>
        <button class="btn btn-primary btn-sm d-flex align-items-center justify-content-center gap-2 flex-grow-1 flex-md-grow-0">
            <i class="bi bi-plus-lg"></i> Create Workflow
        </button>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-6 col-md-6 col-xl-3">
        <div class="wf-stat-card">
            <i class="bi bi-play-circle wf-icon-lg text-success"></i>
            <div class="wf-val-lg">24</div>
            <div class="wf-lbl-sm">Active Workflows</div>
        </div>
    </div>
    <div class="col-6 col-md-6 col-xl-3">
        <div class="wf-stat-card">
            <i class="bi bi-lightning-charge wf-icon-lg text-primary"></i>
            <div class="wf-val-lg">156</div>
            <div class="wf-lbl-sm">Automated Tasks</div>
        </div>
    </div>
    <div class="col-6 col-md-6 col-xl-3">
        <div class="wf-stat-card">
            <i class="bi bi-check2-all wf-icon-lg text-info"></i>
            <div class="wf-val-lg">89</div>
            <div class="wf-lbl-sm">Completed Today</div>
        </div>
    </div>
    <div class="col-6 col-md-6 col-xl-3">
        <div class="wf-stat-card">
            <i class="bi bi-clock-history wf-icon-lg text-warning"></i>
            <div class="wf-val-lg">2.3h</div>
            <div class="wf-lbl-sm">Avg. Processing Time</div>
        </div>
    </div>
</div>

<div class="wf-tabs-nav">
    <button class="wf-tab-link active" onclick="switchWfTab('active')">Active Workflows</button>
    <button class="wf-tab-link" onclick="switchWfTab('automation')">Automation</button>
    <button class="wf-tab-link" onclick="switchWfTab('templates')">Templates</button>
    <button class="wf-tab-link" onclick="switchWfTab('analytics')">Analytics</button>
</div>

<div id="tab-active" class="wf-content-block">

    <div class="d-flex gap-2 mb-4 overflow-auto pb-2" style="white-space: nowrap;">
        <button class="btn btn-sm btn-outline-primary active">All Workflows (24)</button>
        <button class="btn btn-sm btn-outline-secondary">Running (12)</button>
        <button class="btn btn-sm btn-outline-secondary">Pending Approval (6)</button>
        <button class="btn btn-sm btn-outline-secondary">Paused (3)</button>
    </div>

    <div class="workflow-card">
        <div class="wf-header">
            <div>
                <div class="wf-title">
                    <i class="bi bi-play-circle-fill text-success"></i> Student Onboarding Process
                    <span class="priority-badge prio-high">High</span>
                </div>
                <small class="--text-muted d-block">Automated workflow for new student registration</small>
            </div>
            <span class="status-text status-running mt-2 mt-sm-0">Running</span>
        </div>

        <div class="wf-progress-container">
            <div class="wf-step-info">
                <span><strong>Step 4 of 6:</strong> Email Verification</span>
                <span class="text-success">75%</span>
            </div>
            <div class="wf-progress-track">
                <div class="wf-progress-fill bg-success" style="width: 75%;"></div>
            </div>
        </div>

        <div class="wf-meta mb-3">
            <span><strong class="text-main">Category:</strong> Student Management</span>
            <span><strong class="text-main">Assignee:</strong> System Automation</span>
            <span><strong class="text-main">Started:</strong> 2 hours ago</span>
            <span><strong class="text-main">ETA:</strong> 30 minutes</span>
        </div>

        <div class="wf-footer">
            <button class="wf-action-btn"><i class="bi bi-eye me-2"></i> View Details</button>
            <button class="wf-action-btn btn-pause"><i class="bi bi-pause-fill me-2"></i> Pause</button>
        </div>
    </div>

    <div class="workflow-card">
        <div class="wf-header">
            <div>
                <div class="wf-title">
                    <i class="bi bi-pause-circle-fill text-warning"></i> Course Content Review
                    <span class="priority-badge prio-med">Medium</span>
                </div>
                <small class="--text-muted d-block">Multi-stage content review process</small>
            </div>
            <span class="status-text status-pending mt-2 mt-sm-0">Pending Approval</span>
        </div>

        <div class="wf-progress-container">
            <div class="wf-step-info">
                <span><strong>Step 3 of 8:</strong> Technical Review</span>
                <span class="text-warning">40%</span>
            </div>
            <div class="wf-progress-track">
                <div class="wf-progress-fill bg-warning" style="width: 40%;"></div>
            </div>
        </div>

        <div class="wf-meta mb-3">
            <span><strong class="text-main">Category:</strong> Content Management</span>
            <span><strong class="text-main">Assignee:</strong> Content Team</span>
            <span><strong class="text-main">Started:</strong> 1 day ago</span>
            <span><strong class="text-main">ETA:</strong> 2 days</span>
        </div>

        <div class="wf-footer">
            <button class="wf-action-btn"><i class="bi bi-eye me-2"></i> View Details</button>
            <button class="wf-action-btn btn-pause"><i class="bi bi-pause-fill me-2"></i> Pause</button>
        </div>
    </div>

    <div class="workflow-card">
        <div class="wf-header">
            <div>
                <div class="wf-title">
                    <i class="bi bi-play-circle-fill text-primary"></i> Payment Verification
                    <span class="priority-badge prio-high">High</span>
                </div>
                <small class="--text-muted d-block">Automated payment processing</small>
            </div>
            <span class="status-text text-primary mt-2 mt-sm-0">Running</span>
        </div>

        <div class="wf-progress-container">
            <div class="wf-step-info">
                <span><strong>Step 4 of 5:</strong> Final Verification</span>
                <span class="text-primary">90%</span>
            </div>
            <div class="wf-progress-track">
                <div class="wf-progress-fill bg-primary" style="width: 90%;"></div>
            </div>
        </div>

        <div class="wf-meta mb-3">
            <span><strong class="text-main">Category:</strong> Financial</span>
            <span><strong class="text-main">Assignee:</strong> Payment System</span>
            <span><strong class="text-main">Started:</strong> 45 mins ago</span>
            <span><strong class="text-main">ETA:</strong> 5 mins</span>
        </div>

        <div class="wf-footer">
            <button class="wf-action-btn"><i class="bi bi-eye me-2"></i> View Details</button>
            <button class="wf-action-btn btn-pause"><i class="bi bi-pause-fill me-2"></i> Pause</button>
        </div>
    </div>

    <div class="workflow-card">
        <div class="wf-header">
            <div>
                <div class="wf-title">
                    <i class="bi bi-stop-circle-fill text-danger"></i> Instructor Review
                    <span class="priority-badge prio-low">Low</span>
                </div>
                <small class="--text-muted d-block">Vetting process for new instructors</small>
            </div>
            <span class="status-text status-paused mt-2 mt-sm-0">Paused</span>
        </div>

        <div class="wf-progress-container">
            <div class="wf-step-info">
                <span><strong>Step 2 of 10:</strong> Background Check</span>
                <span class="text-danger">25%</span>
            </div>
            <div class="wf-progress-track">
                <div class="wf-progress-fill bg-danger" style="width: 25%;"></div>
            </div>
        </div>

        <div class="wf-meta mb-3">
            <span><strong class="text-main">Category:</strong> HR Management</span>
            <span><strong class="text-main">Assignee:</strong> HR Team</span>
            <span><strong class="text-main">Started:</strong> 3 days ago</span>
            <span><strong class="text-main">ETA:</strong> Paused</span>
        </div>

        <div class="wf-footer">
            <button class="wf-action-btn"><i class="bi bi-eye me-2"></i> View Details</button>
            <button class="wf-action-btn btn-resume"><i class="bi bi-play-fill me-2"></i> Resume</button>
        </div>
    </div>
</div>

<div id="tab-automation" class="wf-content-block d-none">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold text-main">Active Automation Rules</h6>
        <button class="btn btn-sm btn-outline-primary"><i class="bi bi-plus-lg"></i> New Rule</button>
    </div>

    <div class="automation-item">
        <div class="d-flex align-items-start gap-3">
            <div class="auto-icon bg-soft-green text-success"><i class="bi bi-lightning-charge-fill"></i></div>
            <div class="flex-grow-1">
                <div class="d-flex justify-content-between flex-wrap">
                    <h6 class="fw-bold text-main mb-1">Auto-assign Course Reviews</h6>
                    <span class="badge bg-soft-green text-success">Active</span>
                </div>
                <p class="--text-muted small mb-2">Automatically assign course reviews to content reviewers.</p>

                <div class="auto-grid">
                    <div><span class="auto-stat-label">Trigger</span><span class="auto-stat-val">New Course</span></div>
                    <div><span class="auto-stat-label">Action</span><span class="auto-stat-val">Assign Reviewer</span></div>
                    <div><span class="auto-stat-label">Executions</span><span class="auto-stat-val">23</span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="automation-item">
        <div class="d-flex align-items-start gap-3">
            <div class="auto-icon bg-soft-blue text-primary"><i class="bi bi-bell-fill"></i></div>
            <div class="flex-grow-1">
                <div class="d-flex justify-content-between flex-wrap">
                    <h6 class="fw-bold text-main mb-1">Student Enrollment Alerts</h6>
                    <span class="badge bg-soft-green text-success">Active</span>
                </div>
                <p class="--text-muted small mb-2">Send notifications when enrollment milestones are reached.</p>

                <div class="auto-grid">
                    <div><span class="auto-stat-label">Trigger</span><span class="auto-stat-val">Milestone</span></div>
                    <div><span class="auto-stat-label">Action</span><span class="auto-stat-val">Notify Admin</span></div>
                    <div><span class="auto-stat-label">Executions</span><span class="auto-stat-val">12</span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="automation-item">
        <div class="d-flex align-items-start gap-3">
            <div class="auto-icon bg-soft-red text-danger"><i class="bi bi-envelope-exclamation-fill"></i></div>
            <div class="flex-grow-1">
                <div class="d-flex justify-content-between flex-wrap">
                    <h6 class="fw-bold text-main mb-1">Payment Failure Follow-up</h6>
                    <span class="badge bg-soft-green text-success">Active</span>
                </div>
                <p class="--text-muted small mb-2">Retry failed payments and send follow-up emails.</p>

                <div class="auto-grid">
                    <div><span class="auto-stat-label">Trigger</span><span class="auto-stat-val">Payment Fail</span></div>
                    <div><span class="auto-stat-label">Action</span><span class="auto-stat-val">Retry + Email</span></div>
                    <div><span class="auto-stat-label">Executions</span><span class="auto-stat-val">8</span></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="tab-templates" class="wf-content-block d-none">
    <div class="row g-4">
        <div class="col-12 col-md-6">
            <div class="template-card">
                <div class="d-flex justify-content-between mb-3">
                    <span class="badge bg-primary">Featured</span>
                    <span class="--text-muted small"><i class="bi bi-star-fill text-warning me-1"></i> 4.8</span>
                </div>
                <h5 class="fw-bold text-main">Student Onboarding</h5>
                <p class="--text-muted small mb-3">Complete workflow template for new student registration.</p>
                <div class="tpl-preview-box">
                    <i class="bi bi-layout-text-window-reverse fs-1"></i>
                </div>
                <div class="d-flex gap-2 mt-auto">
                    <button class="btn btn-outline-secondary w-50">Preview</button>
                    <button class="btn btn-primary w-50">Use Template</button>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="template-card">
                <div class="d-flex justify-content-between mb-3">
                    <span class="badge bg-secondary bg-opacity-25 text-secondary">Standard</span>
                    <span class="--text-muted small"><i class="bi bi-star-fill text-warning me-1"></i> 4.6</span>
                </div>
                <h5 class="fw-bold text-main">Course Publishing</h5>
                <p class="--text-muted small mb-3">End-to-end workflow for course creation and review.</p>
                <div class="tpl-preview-box">
                    <i class="bi bi-journal-check fs-1"></i>
                </div>
                <div class="d-flex gap-2 mt-auto">
                    <button class="btn btn-outline-secondary w-50">Preview</button>
                    <button class="btn btn-primary w-50">Use Template</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="tab-analytics" class="wf-content-block d-none">

    <div class="ai-section mb-4" style="background-color: var(--bg-card); border-radius: 12px; padding: 20px; border: 1px solid var(--border-color);">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold text-main m-0"><i class="bi bi-graph-up-arrow text-primary me-2"></i> Analytics Overview</h6>
        </div>

        <div class="chart-placeholder-ai mb-4" style="height: 200px; border: 1px dashed var(--border-color); display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.02); border-radius: 12px;">
            <div class="text-center --text-muted">
                <i class="bi bi-bar-chart-line fs-1 mb-2"></i>
                <p>Workflow Performance Chart</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <div class="p-3 border border-secondary border-opacity-25 rounded bg-body">
                    <small class="--text-muted d-block mb-1">Average Completion Time</small>
                    <div class="d-flex justify-content-between align-items-end">
                        <h4 class="fw-bold text-main mb-0">4.2 hours</h4>
                        <span class="text-danger small">-0.8h</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="p-3 border border-secondary border-opacity-25 rounded bg-body">
                    <small class="--text-muted d-block mb-1">Success Rate</small>
                    <div class="d-flex justify-content-between align-items-end">
                        <h4 class="fw-bold text-main mb-0">94.7%</h4>
                        <span class="text-success small">+2.3%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ai-section" style="background-color: var(--bg-card); border-radius: 12px; padding: 20px; border: 1px solid var(--border-color);">
        <h6 class="fw-bold text-main mb-3"><i class="bi bi-lightbulb text-warning me-2"></i> Insights & Recommendations</h6>

        <div class="insight-row">
            <div>
                <h6 class="fw-bold text-main mb-1">Automation Opportunity</h6>
                <p class="--text-muted small mb-1">Student verification has 78% repetitive tasks.</p>
                <small class="text-success"><i class="bi bi-clock"></i> Save: 12h/week</small>
            </div>
            <div class="text-md-end mt-2 mt-md-0">
                <span class="badge bg-danger mb-2 d-inline-block">High Impact</span><br>
                <a href="#" class="small text-primary text-decoration-none">Automate Now</a>
            </div>
        </div>

        <div class="insight-row">
            <div>
                <h6 class="fw-bold text-main mb-1">Bottleneck Identified</h6>
                <p class="--text-muted small mb-1">Course review delayed at technical step.</p>
                <small class="text-success"><i class="bi bi-clock"></i> Save: 2.3 days</small>
            </div>
            <div class="text-md-end mt-2 mt-md-0">
                <span class="badge bg-warning text-dark mb-2 d-inline-block">Medium Impact</span><br>
                <a href="#" class="small text-primary text-decoration-none">Add Reviewers</a>
            </div>
        </div>

        <div class="insight-row">
            <div>
                <h6 class="fw-bold text-main mb-1">Process Optimization</h6>
                <p class="--text-muted small mb-1">Parallel processing for payment workflows.</p>
                <small class="text-success"><i class="bi bi-clock"></i> Save: 45% time</small>
            </div>
            <div class="text-md-end mt-2 mt-md-0">
                <span class="badge bg-warning text-dark mb-2 d-inline-block">Medium Impact</span><br>
                <a href="#" class="small text-primary text-decoration-none">Redesign</a>
            </div>
        </div>
    </div>
</div>

<script>
    function switchWfTab(tabName) {
        document.querySelectorAll('.wf-tab-link').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');

        document.querySelectorAll('.wf-content-block').forEach(el => el.classList.add('d-none'));
        document.getElementById('tab-' + tabName).classList.remove('d-none');
    }
</script>

@endsection
