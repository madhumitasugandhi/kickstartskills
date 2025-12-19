@extends('frontend.adminPortal.dashboard.layouts.app')

@section('title', 'Real-time Monitoring')

@section('icon', 'bi-activity')

@section('content')
<style>
    /* --- Monitoring Page Styles --- */

    /* Stats Cards */
    .mon-stat-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 4px;
        padding: 24px;
        height: 100%;
        display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;
        position: relative;
        overflow: hidden;
    }
    .mon-stat-card::after {
        content: ''; position: absolute; bottom: 0; left: 0; width: 100%; height: 2px;
        background-color: currentColor; opacity: 0.5;
    }

    .mon-icon { font-size: 1.5rem; margin-bottom: 8px; }
    .mon-val { font-size: 1.8rem; font-weight: 700; color: var(--text-main); margin-bottom: 2px; }
    .mon-lbl { font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; }

    /* Custom Navigation Tabs (Scrollable on Mobile) */
    .mon-tabs-nav {
        display: flex; gap: 8px; margin-bottom: 24px;
        overflow-x: auto; white-space: nowrap; /* Horizontal Scroll */
        padding-bottom: 5px; /* Space for scrollbar */
    }
    /* Hide Scrollbar */
    .mon-tabs-nav::-webkit-scrollbar { height: 4px; }
    .mon-tabs-nav::-webkit-scrollbar-thumb { background: var(--border-color); border-radius: 4px; }

    .mon-tab-link {
        padding: 8px 16px;
        border: 1px solid transparent;
        background: transparent;
        color: var(--text-muted);
        font-weight: 500;
        font-size: 0.85rem;
        cursor: pointer;
        border-radius: 4px;
        transition: all 0.2s;
        flex-shrink: 0; /* Prevent shrinking */
    }
    .mon-tab-link:hover { color: var(--text-main); background: var(--bg-hover); }
    .mon-tab-link.active {
        background-color: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
        border-color: rgba(59, 130, 246, 0.2);
    }

    /* Content Panels */
    .mon-panel {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .panel-head { font-size: 0.95rem; font-weight: 700; color: var(--text-main); margin-bottom: 16px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; }

    /* Quick Actions */
    .quick-btn {
        background: transparent; border: 1px solid var(--border-color); color: var(--text-main);
        padding: 8px 16px; border-radius: 6px; font-size: 0.85rem; transition: 0.2s;
        display: inline-flex; align-items: center; gap: 8px;
        flex-grow: 1; justify-content: center; /* Better mobile touch targets */
    }
    .quick-btn:hover { background-color: var(--bg-hover); border-color: var(--text-muted); }
    @media (min-width: 768px) { .quick-btn { flex-grow: 0; } }

    /* System Overview Bars */
    .sys-row { margin-bottom: 16px; }
    .sys-meta { display: flex; justify-content: space-between; font-size: 0.8rem; margin-bottom: 4px; color: var(--text-muted); }
    .sys-track { height: 4px; background-color: var(--bg-body); width: 100%; border-radius: 2px; overflow: hidden; }
    .sys-fill { height: 100%; border-radius: 2px; }

    /* Activity List */
    .act-item {
        padding: 12px; border-left: 3px solid transparent; background: var(--bg-body); margin-bottom: 8px; border-radius: 4px;
        display: flex; align-items: start; gap: 12px;
    }
    .act-icon { width: 24px; text-align: center; font-size: 1rem; flex-shrink: 0; }
    .act-time { font-size: 0.7rem; color: var(--text-muted); margin-top: 4px; display: block; }

    /* Service Status List */
    .svc-item {
        display: flex; justify-content: space-between; align-items: center;
        padding: 16px; border-bottom: 1px solid var(--border-color);
    }
    .svc-item:last-child { border-bottom: none; }
    .svc-status { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; }
    .dot { width: 8px; height: 8px; border-radius: 50%; display: inline-block; margin-right: 6px; }

    /* Alerts */
    .alert-card {
        background-color: var(--bg-body); border: 1px solid var(--border-color);
        border-radius: 6px; padding: 16px; margin-bottom: 12px;
        border-left: 4px solid;
    }
    .alert-critical { border-left-color: #ef4444; }
    .alert-warning { border-left-color: #f59e0b; }
    .alert-info { border-left-color: #3b82f6; }

    .alert-actions { display: flex; gap: 1px; background: var(--border-color); margin-top: 12px; border-radius: 4px; overflow: hidden; }
    .alert-btn { flex: 1; border: none; background: var(--bg-card); color: var(--text-muted); padding: 8px; font-size: 0.8rem; transition: 0.2s; }
    .alert-btn:hover { background: var(--bg-hover); color: var(--text-main); }
    .btn-investigate:hover { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }

    /* Placeholder for charts */
    .chart-box-mon {
        height: 300px; display: flex; flex-direction: column; align-items: center; justify-content: center;
        background: var(--bg-body); border-radius: 8px; color: var(--text-muted);
    }

</style>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
    <div>
        <h5 class="fw-bold text-main mb-1">Real-time System Monitoring</h5>
        <small class="--text-muted">Live monitoring of system performance and health metrics</small>
    </div>
    <span class="badge bg-success bg-opacity-10 border border-success text-success px-3 py-2">
        <i class="bi bi-broadcast me-2 swing-animation"></i> Live
    </span>
</div>

<div class="row g-4 mb-4">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="mon-stat-card text-success" style="border-bottom-color: #10b981;">
            <i class="bi bi-check-circle mon-icon"></i>
            <div class="mon-val">99.98%</div>
            <div class="mon-lbl">System Uptime</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="mon-stat-card text-info" style="border-bottom-color: #3b82f6;">
            <i class="bi bi-people mon-icon"></i>
            <div class="mon-val">1,247</div>
            <div class="mon-lbl">Active Users</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="mon-stat-card text-primary" style="border-bottom-color: #6366f1;">
            <i class="bi bi-lightning-charge mon-icon"></i>
            <div class="mon-val">124ms</div>
            <div class="mon-lbl">Response Time</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="mon-stat-card text-warning" style="border-bottom-color: #f59e0b;">
            <i class="bi bi-exclamation-triangle mon-icon"></i>
            <div class="mon-val">3</div>
            <div class="mon-lbl">Active Alerts</div>
        </div>
    </div>
</div>

<div class="mon-tabs-nav">
    <button class="mon-tab-link active" onclick="switchMonTab('overview')">Overview</button>
    <button class="mon-tab-link" onclick="switchMonTab('health')">System Health</button>
    <button class="mon-tab-link" onclick="switchMonTab('alerts')">Alerts</button>
    <button class="mon-tab-link" onclick="switchMonTab('performance')">Performance</button>
    <button class="mon-tab-link" onclick="switchMonTab('logs')">Logs</button>
</div>

<div id="tab-overview" class="mon-content-block">

    <div class="mon-panel">
        <div class="panel-head">Quick Actions</div>
        <div class="d-flex flex-wrap gap-2">
            <button class="quick-btn"><i class="bi bi-arrow-clockwise"></i> Refresh All</button>
            <button class="quick-btn"><i class="bi bi-gear"></i> Configure Alerts</button>
            <button class="quick-btn"><i class="bi bi-download"></i> Export Report</button>
            <button class="quick-btn"><i class="bi bi-bell"></i> Test Alerts</button>
        </div>
    </div>

    <div class="mon-panel">
        <div class="panel-head"><i class="bi bi-hdd-stack text-primary me-2"></i> System Overview</div>

        <div class="sys-row">
            <div class="sys-meta"><span>CPU Usage</span> <span class="text-warning">68%</span></div>
            <div class="sys-track"><div class="sys-fill bg-warning" style="width: 68%"></div></div>
        </div>
        <div class="sys-row">
            <div class="sys-meta"><span>Memory Usage</span> <span class="text-success">52%</span></div>
            <div class="sys-track"><div class="sys-fill bg-success" style="width: 52%"></div></div>
        </div>
        <div class="sys-row">
            <div class="sys-meta"><span>Disk Usage</span> <span class="text-primary">34%</span></div>
            <div class="sys-track"><div class="sys-fill bg-primary" style="width: 34%"></div></div>
        </div>
        <div class="sys-row">
            <div class="sys-meta"><span>Network I/O</span> <span class="text-info">43%</span></div>
            <div class="sys-track"><div class="sys-fill bg-info" style="width: 43%"></div></div>
        </div>
        <div class="sys-row">
            <div class="sys-meta"><span>Database Load</span> <span class="text-danger">76%</span></div>
            <div class="sys-track"><div class="sys-fill bg-danger" style="width: 76%"></div></div>
        </div>
        <div class="sys-row">
            <div class="sys-meta"><span>API Response</span> <span class="text-success">124ms</span></div>
            <div class="sys-track"><div class="sys-fill bg-success" style="width: 20%"></div></div>
        </div>
    </div>

    <div class="mon-panel">
        <div class="panel-head">
            <span><i class="bi bi-activity text-info me-2"></i> Recent Activities</span>
            <a href="#" class="small fw-normal text-primary text-decoration-none">View All</a>
        </div>

        <div class="act-item" style="border-left-color: #f59e0b;">
            <div class="act-icon text-warning"><i class="bi bi-exclamation-triangle"></i></div>
            <div>
                <div class="small fw-bold text-main">High CPU usage detected on server-03</div>
                <span class="act-time">2 minutes ago</span>
            </div>
        </div>

        <div class="act-item" style="border-left-color: #10b981;">
            <div class="act-icon text-success"><i class="bi bi-check-circle"></i></div>
            <div>
                <div class="small fw-bold text-main">Database backup completed successfully</div>
                <span class="act-time">15 minutes ago</span>
            </div>
        </div>

        <div class="act-item" style="border-left-color: #f59e0b;">
            <div class="act-icon text-warning"><i class="bi bi-clock-history"></i></div>
            <div>
                <div class="small fw-bold text-main">API response time increased to 250ms</div>
                <span class="act-time">28 minutes ago</span>
            </div>
        </div>

        <div class="act-item" style="border-left-color: #3b82f6;">
            <div class="act-icon text-primary"><i class="bi bi-tools"></i></div>
            <div>
                <div class="small fw-bold text-main">System maintenance window scheduled</div>
                <span class="act-time">1 hour ago</span>
            </div>
        </div>
    </div>
</div>

<div id="tab-health" class="mon-content-block d-none">

    <div class="mon-panel bg-opacity-10" style="background-color: rgba(16, 185, 129, 0.05); border-color: rgba(16, 185, 129, 0.2);">
        <div class="d-flex align-items-center gap-3">
            <div class="p-3 rounded-circle bg-success text-white"><i class="bi bi-heart-pulse fs-4"></i></div>
            <div>
                <h6 class="fw-bold text-main mb-1">Overall System Health: Excellent</h6>
                <p class="--text-muted small mb-0">All critical systems are operating within normal parameters.</p>
            </div>
        </div>
    </div>

    <div class="mon-panel p-0 overflow-hidden">
        <div class="p-3 bg-body border-bottom border-secondary border-opacity-10 --text-muted small fw-bold">Service Status</div>

        <div class="svc-item">
            <div>
                <div class="fw-bold text-main small"><span class="dot bg-success"></span> Web Application</div>
                <div class="--text-muted" style="font-size: 0.7rem;">Uptime: 99.98% • Response: 124ms</div>
            </div>
            <span class="svc-status text-success">Operational</span>
        </div>

        <div class="svc-item">
            <div>
                <div class="fw-bold text-main small"><span class="dot bg-success"></span> API Gateway</div>
                <div class="--text-muted" style="font-size: 0.7rem;">Uptime: 99.95% • Response: 89ms</div>
            </div>
            <span class="svc-status text-success">Operational</span>
        </div>

        <div class="svc-item">
            <div>
                <div class="fw-bold text-main small"><span class="dot bg-success"></span> Database Cluster</div>
                <div class="--text-muted" style="font-size: 0.7rem;">Uptime: 99.99% • Response: 12ms</div>
            </div>
            <span class="svc-status text-success">Operational</span>
        </div>

        <div class="svc-item">
            <div>
                <div class="fw-bold text-main small"><span class="dot bg-warning"></span> File Storage</div>
                <div class="--text-muted" style="font-size: 0.7rem;">Uptime: 98.2% • Response: 567ms</div>
            </div>
            <span class="svc-status text-warning">Degraded</span>
        </div>

        <div class="svc-item">
            <div>
                <div class="fw-bold text-main small"><span class="dot bg-primary"></span> CDN</div>
                <div class="--text-muted" style="font-size: 0.7rem;">Uptime: 95.1% • Response: 45ms</div>
            </div>
            <span class="svc-status text-primary">Maintenance</span>
        </div>
    </div>

    <div class="mon-panel">
        <div class="panel-head">Infrastructure Health</div>

        <div class="sys-row">
            <div class="sys-meta"><span>Load Balancer</span> <span class="text-success">Healthy</span></div>
            <div class="sys-track"><div class="sys-fill bg-info" style="width: 45%"></div></div>
        </div>
        <div class="sys-row">
            <div class="sys-meta"><span>Application Servers</span> <span class="text-success">Healthy</span></div>
            <div class="sys-track"><div class="sys-fill bg-info" style="width: 67%"></div></div>
        </div>
        <div class="sys-row">
            <div class="sys-meta"><span>Database Servers</span> <span class="text-warning">Warning</span></div>
            <div class="sys-track"><div class="sys-fill bg-warning" style="width: 82%"></div></div>
        </div>
        <div class="sys-row">
            <div class="sys-meta"><span>Cache Layer</span> <span class="text-success">Healthy</span></div>
            <div class="sys-track"><div class="sys-fill bg-info" style="width: 34%"></div></div>
        </div>
    </div>
</div>

<div id="tab-alerts" class="mon-content-block d-none">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold text-main m-0"><i class="bi bi-bell text-warning me-2"></i> Active Alerts</h6>
        <button class="btn btn-sm btn-outline-secondary">Acknowledge All</button>
    </div>

    <div class="alert-card alert-critical">
        <div class="d-flex justify-content-between align-items-start gap-3">
            <div>
                <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                    <i class="bi bi-exclamation-octagon-fill text-danger"></i>
                    <h6 class="fw-bold text-main mb-0">High CPU Usage on Server-03</h6>
                    <span class="badge bg-danger">Critical</span>
                </div>
                <div class="small --text-muted mb-2">ALT-001 • 2 minutes ago</div>
                <p class="small text-main mb-1">CPU utilization has exceeded 85% threshold for the past 15 minutes.</p>
                <div class="small --text-muted"><i class="bi bi-hdd-network me-1"></i> Affected: server-03</div>
            </div>
            <span class="badge border border-danger text-danger d-none d-sm-inline-block">Active</span>
        </div>
        <div class="alert-actions">
            <button class="alert-btn"><i class="bi bi-check2"></i> Acknowledge</button>
            <button class="alert-btn btn-investigate"><i class="bi bi-search"></i> Investigate</button>
        </div>
    </div>

    <div class="alert-card alert-warning">
        <div class="d-flex justify-content-between align-items-start gap-3">
            <div>
                <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                    <i class="bi bi-exclamation-triangle-fill text-warning"></i>
                    <h6 class="fw-bold text-main mb-0">Database Connection Pool Exhausted</h6>
                    <span class="badge bg-warning text-dark">Warning</span>
                </div>
                <div class="small --text-muted mb-2">ALT-002 • 8 minutes ago</div>
                <p class="small text-main mb-1">All database connections are in use, new requests are being queued.</p>
                <div class="small --text-muted"><i class="bi bi-database me-1"></i> Affected: db-cluster-1</div>
            </div>
            <span class="badge border border-warning text-warning d-none d-sm-inline-block">Investigating</span>
        </div>
        <div class="alert-actions">
            <button class="alert-btn"><i class="bi bi-check2"></i> Acknowledge</button>
            <button class="alert-btn btn-investigate"><i class="bi bi-search"></i> Investigate</button>
        </div>
    </div>

    <div class="alert-card alert-info">
        <div class="d-flex justify-content-between align-items-start gap-3">
            <div>
                <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                    <i class="bi bi-info-circle-fill text-primary"></i>
                    <h6 class="fw-bold text-main mb-0">Unusual Traffic Pattern Detected</h6>
                    <span class="badge bg-primary">Info</span>
                </div>
                <div class="small --text-muted mb-2">ALT-003 • 23 minutes ago</div>
                <p class="small text-main mb-1">Traffic from specific IP range shows suspicious behavior patterns.</p>
                <div class="small --text-muted"><i class="bi bi-globe me-1"></i> Affected: api-gateway</div>
            </div>
            <span class="badge border border-primary text-primary d-none d-sm-inline-block">Monitoring</span>
        </div>
        <div class="alert-actions">
            <button class="alert-btn"><i class="bi bi-check2"></i> Acknowledge</button>
            <button class="alert-btn btn-investigate"><i class="bi bi-search"></i> Investigate</button>
        </div>
    </div>
</div>

<div id="tab-performance" class="mon-content-block d-none">
    <div class="mon-panel">
        <div class="panel-head">Performance Overview</div>
        <p class="small --text-muted">Real-time performance metrics and system optimization insights</p>

        <div class="chart-box-mon">
            <i class="bi bi-bar-chart-line fs-1 mb-2 text-primary"></i>
            <h6 class="fw-bold">Performance Charts</h6>
            <span class="small opacity-75">Real-time performance visualization coming soon</span>
        </div>
    </div>
</div>

<div id="tab-logs" class="mon-content-block d-none">
    <div class="mon-panel">
        <div class="panel-head">System Logs</div>
        <p class="small --text-muted">Real-time system logs and activity monitoring</p>

        <div class="chart-box-mon">
            <i class="bi bi-file-earmark-code fs-1 mb-2 text-info"></i>
            <h6 class="fw-bold">System Logs Viewer</h6>
            <span class="small opacity-75">Real-time log streaming and filtering coming soon</span>
        </div>
    </div>
</div>

<script>
    function switchMonTab(tabName) {
        document.querySelectorAll('.mon-tab-link').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');

        document.querySelectorAll('.mon-content-block').forEach(el => el.classList.add('d-none'));
        document.getElementById('tab-' + tabName).classList.remove('d-none');
    }
</script>

@endsection
