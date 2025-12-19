@extends('frontend.adminPortal.dashboard.layouts.app')

@section('title', 'Support & Maintenance')

@section('icon', 'bi-gear')

@section('content')
<style>
    /* --- Support Page Styles --- */

    /* Stats Cards */
    .support-stat-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        height: 100%;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .stat-icon-sm {
        font-size: 1.2rem;
        margin-bottom: 8px;
        display: inline-block;
        color: var(--text-muted);
    }

    .stat-val-lg {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 2px;
    }

    .stat-lbl-sm {
        font-size: 0.85rem;
        color: var(----);
    }

    .stat-badge-top {
        position: absolute;
        top: 15px;
        right: 15px;
        font-size: 0.7rem;
        padding: 2px 6px;
        border-radius: 4px;
        font-weight: 600;
    }

    /* Navigation Tabs */
    .support-tabs {
        display: flex;
        gap: 8px;
        margin-bottom: 24px;
        overflow-x: auto;
        white-space: nowrap;
        /* Mobile scroll */
        padding-bottom: 4px;
    }

    .support-tabs::-webkit-scrollbar {
        height: 0px;
        background: transparent;
    }

    .support-tab-btn {
        background: transparent;
        border: 1px solid transparent;
        color: var(--text-muted);
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
        transition: 0.2s;
    }

    .support-tab-btn:hover {
        color: var(--text-main);
        background-color: var(--bg-hover);
    }

    .support-tab-btn.active {
        background-color: rgba(220, 38, 38, 0.1);
        color: #dc2626;
        border-color: rgba(220, 38, 38, 0.2);
    }

    /* Search & Filters */
    .filter-bar-support {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 24px;
    }

    /* Search Bar */
    .search-input-drive {
        background-color: var(--bg-body);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        padding: 10px 16px;
        border-radius: 8px;
        width: 100%;
    }

    .search-input-drive:focus {
        outline: none;
        border-color: var(--accent-color);
    }

    .filter-pill {
        background: transparent;
        border: 1px solid var(--border-color);
        color: var(--text-muted);
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.8rem;
        transition: 0.2s;
        cursor: pointer;
        display: inline-block;
    }

    .filter-pill:hover,
    .filter-pill.active {
        background-color: #dc2626;
        border-color: #dc2626;
        color: white;
    }

    /* List Containers */
    .content-box {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
    }

    /* Ticket Item */
    .ticket-item {
        padding: 16px 0;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        flex-direction: column;
        gap: 12px;
        transition: 0.2s;
    }

    @media (min-width: 768px) {
        .ticket-item {
            flex-direction: row;
            align-items: start;
            justify-content: space-between;
            gap: 0;
        }
    }

    .ticket-item:last-child {
        border-bottom: none;
    }

    .ticket-item:hover {
        transform: translateX(4px);
    }

    .ticket-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background-color: rgba(255, 255, 255, 0.05);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: var(--text-muted);
        margin-right: 16px;
        flex-shrink: 0;
    }

    .ticket-meta {
        font-size: 0.8rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 4px;
        flex-wrap: wrap;
    }

    /* Tags */
    .priority-tag {
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .prio-critical {
        color: #ef4444;
    }

    .prio-high {
        color: #f97316;
    }

    .prio-medium {
        color: #3b82f6;
    }

    .prio-low {
        color: #10b981;
    }

    .status-tag {
        font-size: 0.7rem;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 4px;
        background: rgba(255, 255, 255, 0.05);
    }

    .status-open {
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .status-progress {
        color: #f97316;
        border: 1px solid rgba(249, 115, 22, 0.3);
    }

    .status-resolved {
        color: #3b82f6;
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    /* Maintenance Item */
    .maint-item {
        padding: 20px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        background-color: var(--bg-body);
        margin-bottom: 12px;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    @media(min-width: 768px) {
        .maint-item {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }
    }

    /* Health Overview */
    .health-metric-box {
        text-align: center;
        padding: 20px;
        border-right: 1px solid var(--border-color);
    }

    .health-metric-box:last-child {
        border-right: none;
    }

    @media(max-width: 768px) {
        .health-metric-box {
            border-right: none;
            border-bottom: 1px solid var(--border-color);
        }
    }

    .service-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 0;
        border-bottom: 1px solid var(--border-color);
    }

    .service-row:last-child {
        border-bottom: none;
    }
</style>

<div class="row g-4 mb-4">
    <div class="col-6 col-md-4 col-xl-2">
        <div class="support-stat-card">
            <span class="stat-badge-top text-success bg-soft-green">+3</span>
            <i class="bi bi-exclamation-circle stat-icon-sm text-danger"></i>
            <div class="stat-val-lg text-danger">23</div>
            <div class="stat-lbl-sm">Open Tickets</div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="support-stat-card">
            <span class="stat-badge-top text-success bg-soft-green">+2</span>
            <i class="bi bi-clock-history stat-icon-sm text-warning"></i>
            <div class="stat-val-lg text-warning">8</div>
            <div class="stat-lbl-sm">In Progress</div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="support-stat-card">
            <span class="stat-badge-top text-success bg-soft-green">+15</span>
            <i class="bi bi-check-circle stat-icon-sm text-success"></i>
            <div class="stat-val-lg text-success">145</div>
            <div class="stat-lbl-sm">Resolved</div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="support-stat-card">
            <span class="stat-badge-top text-success bg-soft-green">-0.5h</span>
            <i class="bi bi-stopwatch stat-icon-sm text-primary"></i>
            <div class="stat-val-lg text-primary">2.4h</div>
            <div class="stat-lbl-sm">Avg Response</div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="support-stat-card">
            <span class="stat-badge-top text-success bg-soft-green">+0.2</span>
            <i class="bi bi-star stat-icon-sm text-warning"></i>
            <div class="stat-val-lg text-warning">4.7/5</div>
            <div class="stat-lbl-sm">Satisfaction</div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="support-stat-card">
            <span class="stat-badge-top text-success bg-soft-green">+65</span>
            <i class="bi bi-inbox stat-icon-sm text-info"></i>
            <div class="stat-val-lg text-info">1.1K</div>
            <div class="stat-lbl-sm">Total Tickets</div>
        </div>
    </div>
</div>

<div class="support-tabs">
    <button class="support-tab-btn active" onclick="switchSupportTab('tickets')"><i
            class="bi bi-ticket-perforated me-2"></i> Tickets</button>
    <button class="support-tab-btn" onclick="switchSupportTab('maintenance')"><i class="bi bi-tools me-2"></i>
        Maintenance</button>
    <button class="support-tab-btn" onclick="switchSupportTab('health')"><i class="bi bi-activity me-2"></i> System
        Health</button>
</div>

<div id="tab-tickets" class="support-content-block">
    <div class="filter-bar-support">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mb-3">
            <div class="input-group w-100" style="max-width: 600px;">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 --text-muted"></i>
                <input type="text" class="search-input-drive ps-5"
                    placeholder="Search tickets by subject, user, or description...">
            </div>
            <button
                class="btn btn-danger text-white d-flex align-items-center justify-content-center gap-2 px-4 w-100 w-md-auto">
                <i class="bi bi-plus-lg"></i> Create
            </button>
        </div>

        <div class="d-flex flex-wrap align-items-center gap-2">
            <span class="--text-muted small me-2"><i class="bi bi-funnel"></i> Filters:</span>
            <span class="filter-pill active">All</span>
            <span class="filter-pill">Critical</span>
            <span class="filter-pill">High</span>
            <span class="filter-pill">Medium</span>
            <span class="filter-pill">Low</span>
            <div class="vr mx-2 --text-muted d-none d-md-block"></div>
            <span class="filter-pill">Open</span>
            <span class="filter-pill">In Progress</span>
            <span class="filter-pill">Resolved</span>
            <span class="filter-pill">Closed</span>
        </div>
    </div>

    <div class="content-box">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h6 class="fw-bold text-main m-0"><i class="bi bi-envelope-paper me-2 text-danger"></i> Support Tickets (5)
            </h6>
            <i class="bi bi-three-dots-vertical --text-muted cursor-pointer"></i>
        </div>

        <div class="ticket-item">
            <div class="d-flex align-items-start">
                <div class="ticket-icon text-warning"><i class="bi bi-exclamation-circle-fill"></i></div>
                <div>
                    <h6 class="fw-bold text-main mb-1">Unable to access course materials</h6>
                    <div class="ticket-meta mb-1">
                        <span>John Smith • Technical</span>
                    </div>
                    <p class="--text-muted small mb-1 opacity-75">Student unable to access uploaded course materials...
                    </p>
                    <div class="ticket-meta">
                        <span><i class="bi bi-person me-1"></i> Sarah Johnson</span>
                        <span><i class="bi bi-chat-left me-1"></i> 0 responses</span>
                    </div>
                </div>
            </div>
            <div
                class="text-md-end w-100 w-md-auto d-flex flex-row flex-md-column justify-content-between align-items-center align-items-md-end mt-2 mt-md-0">
                <div class="d-flex flex-md-column align-items-center align-items-md-end gap-2 gap-md-0">
                    <span class="priority-tag prio-high mb-md-1">High</span>
                    <span class="status-tag status-open">Open</span>
                </div>
                <div class="mt-md-2 --text-muted small">30/1/2024</div>
            </div>
        </div>

        <div class="ticket-item">
            <div class="d-flex align-items-start">
                <div class="ticket-icon text-danger"><i class="bi bi-credit-card-fill"></i></div>
                <div>
                    <h6 class="fw-bold text-main mb-1">Payment processing issue</h6>
                    <div class="ticket-meta mb-1">
                        <span>Emily Davis • Billing</span>
                    </div>
                    <p class="--text-muted small mb-1 opacity-75">Institution payment for premium features is failing...
                    </p>
                    <div class="ticket-meta">
                        <span><i class="bi bi-person me-1"></i> Michael Chen</span>
                        <span><i class="bi bi-chat-left me-1"></i> 3 responses</span>
                    </div>
                </div>
            </div>
            <div
                class="text-md-end w-100 w-md-auto d-flex flex-row flex-md-column justify-content-between align-items-center align-items-md-end mt-2 mt-md-0">
                <div class="d-flex flex-md-column align-items-center align-items-md-end gap-2 gap-md-0">
                    <span class="priority-tag prio-critical mb-md-1">Critical</span>
                    <span class="status-tag status-progress">In Progress</span>
                </div>
                <div class="mt-md-2 --text-muted small">30/1/2024</div>
            </div>
        </div>

        <div class="ticket-item">
            <div class="d-flex align-items-start">
                <div class="ticket-icon text-info"><i class="bi bi-person-badge-fill"></i></div>
                <div>
                    <h6 class="fw-bold text-main mb-1">Profile information not updating</h6>
                    <div class="ticket-meta mb-1">
                        <span>David Wilson • Account</span>
                    </div>
                    <div class="ticket-meta">
                        <span><i class="bi bi-person me-1"></i> Lisa Brown</span>
                        <span><i class="bi bi-chat-left me-1"></i> 5 responses</span>
                    </div>
                </div>
            </div>
            <div
                class="text-md-end w-100 w-md-auto d-flex flex-row flex-md-column justify-content-between align-items-center align-items-md-end mt-2 mt-md-0">
                <div class="d-flex flex-md-column align-items-center align-items-md-end gap-2 gap-md-0">
                    <span class="priority-tag prio-medium mb-md-1">Medium</span>
                    <span class="status-tag status-resolved">Resolved</span>
                </div>
                <div class="mt-md-2 --text-muted small">30/1/2024</div>
            </div>
        </div>
    </div>
</div>

<div id="tab-maintenance" class="support-content-block d-none">
    <div class="content-box">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h6 class="fw-bold text-main m-0"><i class="bi bi-calendar-check me-2 text-warning"></i> Maintenance
                Schedule</h6>
            <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-plus-lg me-1"></i> Schedule</button>
        </div>

        <div class="maint-item">
            <div class="d-flex align-items-start gap-3">
                <div class="ticket-icon text-primary"><i class="bi bi-database-fill-gear"></i></div>
                <div>
                    <h6 class="fw-bold text-main mb-1">Database Optimization</h6>
                    <small class="--text-muted d-block mb-1">Scheduled database performance optimization and
                        indexing</small>
                    <div class="text-info small"><i class="bi bi-calendar3 me-1"></i> Scheduled: 1/2/2024</div>
                </div>
            </div>
            <div class="text-md-end mt-3 mt-md-0">
                <span class="badge bg-soft-primary mb-2">Scheduled</span>
                <div class="small --text-muted">Duration: 2 hours</div>
                <div class="small text-danger">Low Impact</div>
            </div>
        </div>

        <div class="maint-item">
            <div class="d-flex align-items-start gap-3">
                <div class="ticket-icon text-success"><i class="bi bi-shield-lock-fill"></i></div>
                <div>
                    <h6 class="fw-bold text-main mb-1">Security Update</h6>
                    <small class="--text-muted d-block mb-1">Critical security patches and system updates</small>
                    <div class="text-success small"><i class="bi bi-calendar-check me-1"></i> Completed: 29/1/2024</div>
                </div>
            </div>
            <div class="text-md-end mt-3 mt-md-0">
                <span class="badge bg-soft-success mb-2">Completed</span>
                <div class="small --text-muted">Duration: 1.5 hours</div>
                <div class="small text-warning">Medium Impact</div>
            </div>
        </div>

        <div class="maint-item">
            <div class="d-flex align-items-start gap-3">
                <div class="ticket-icon text-info"><i class="bi bi-hdd-network-fill"></i></div>
                <div>
                    <h6 class="fw-bold text-main mb-1">Storage Migration</h6>
                    <small class="--text-muted d-block mb-1">Migration of file storage to improved infrastructure</small>
                    <div class="--text-muted small"><i class="bi bi-calendar3 me-1"></i> Planned: 5/2/2024</div>
                </div>
            </div>
            <div class="text-md-end mt-3 mt-md-0">
                <span class="badge bg-soft-secondary mb-2">Planned</span>
                <div class="small --text-muted">Duration: 4 hours</div>
                <div class="small text-danger">High Impact</div>
            </div>
        </div>
    </div>
</div>

<div id="tab-health" class="support-content-block d-none">

    <div class="content-box mb-4">
        <h6 class="fw-bold text-main mb-3"><i class="bi bi-heart-pulse me-2 text-danger"></i> System Health Overview
        </h6>
        <div
            class="alert bg-success bg-opacity-10 border-success border-opacity-25 text-success d-flex align-items-center mb-4">
            <i class="bi bi-check-circle-fill me-3 fs-4"></i>
            <div>
                <strong>Overall System Healthy</strong>
                <div class="small opacity-75">All critical systems are operating within normal parameters.</div>
            </div>
        </div>

        <div class="row g-0 border border-secondary border-opacity-25 rounded overflow-hidden">
            <div class="col-12 col-md-4 health-metric-box">
                <small class="--text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Availability</small>
                <div class="fs-4 fw-bold text-success my-1">99.94%</div>
                <span class="badge bg-success bg-opacity-10 text-success">Excellent</span>
            </div>
            <div class="col-12 col-md-4 health-metric-box">
                <small class="--text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Performance</small>
                <div class="fs-4 fw-bold text-primary my-1">245ms</div>
                <span class="badge bg-primary bg-opacity-10 text-primary">Good</span>
            </div>
            <div class="col-12 col-md-4 health-metric-box">
                <small class="--text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Reliability</small>
                <div class="fs-4 fw-bold text-info my-1">99.99%</div>
                <span class="badge bg-info bg-opacity-10 text-info">Stable</span>
            </div>
        </div>
    </div>

    <div class="content-box">
        <h6 class="fw-bold text-main mb-3">Services Status</h6>

        <div class="service-row">
            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-circle-fill text-success small"></i>
                <div>
                    <div class="fw-bold text-main small">API Gateway</div>
                    <small class="--text-muted" style="font-size: 0.75rem;">Uptime: 99.98% • Latency: 89ms</small>
                </div>
            </div>
            <span class="badge bg-transparent border border-success text-success"
                style="font-size: 0.65rem;">OPERATIONAL</span>
        </div>

        <div class="service-row">
            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-circle-fill text-success small"></i>
                <div>
                    <div class="fw-bold text-main small">Database Cluster</div>
                    <small class="--text-muted" style="font-size: 0.75rem;">Uptime: 99.99% • Latency: 12ms</small>
                </div>
            </div>
            <span class="badge bg-transparent border border-success text-success"
                style="font-size: 0.65rem;">OPERATIONAL</span>
        </div>

        <div class="service-row">
            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-circle-fill text-success small"></i>
                <div>
                    <div class="fw-bold text-main small">File Storage</div>
                    <small class="--text-muted" style="font-size: 0.75rem;">Uptime: 99.95% • Latency: 145ms</small>
                </div>
            </div>
            <span class="badge bg-transparent border border-success text-success"
                style="font-size: 0.65rem;">OPERATIONAL</span>
        </div>

        <div class="service-row">
            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-circle-fill text-warning small"></i>
                <div>
                    <div class="fw-bold text-main small">Notifications Service</div>
                    <small class="--text-muted" style="font-size: 0.75rem;">High Latency Detected</small>
                </div>
            </div>
            <span class="badge bg-transparent border border-warning text-warning"
                style="font-size: 0.65rem;">WARNING</span>
        </div>
    </div>
</div>

<script>
    function switchSupportTab(tabName) {
        // Reset buttons
        document.querySelectorAll('.support-tab-btn').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');

        // Hide all content
        document.querySelectorAll('.support-content-block').forEach(el => el.classList.add('d-none'));

        // Show selected content
        document.getElementById('tab-' + tabName).classList.remove('d-none');
    }
</script>

@endsection
