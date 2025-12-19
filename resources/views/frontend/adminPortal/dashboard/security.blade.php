@extends('frontend.adminPortal.dashboard.layouts.app')

@section('title', 'Security & Compliance')

@section('icon', 'bi-shield-check')

@section('content')
<style>
    /* --- Security Page Styles --- */

    /* Banner */
    .security-banner {
        background: linear-gradient(135deg, #1f1212 0%, #3f1010 100%);
        border: 1px solid rgba(239, 68, 68, 0.2);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
    }
    .score-val { color: #10b981; font-weight: 700; font-size: 1.1rem; }

    /* Stats Cards */
    .sec-stat-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        height: 100%;
        position: relative;
        overflow: hidden;
        display: flex; flex-direction: column; justify-content: center;
    }
    .status-dot-corner { position: absolute; top: 15px; right: 15px; width: 8px; height: 8px; border-radius: 50%; }
    .sec-icon { font-size: 1.5rem; margin-bottom: 12px; }
    .sec-val { font-size: 1.8rem; font-weight: 700; color: var(--text-main); margin-bottom: 2px; }
    .sec-label { font-size: 0.85rem; color: var(--text-muted); }

    /* Color Themes */
    .theme-orange { border-top: 3px solid #f97316; } .theme-orange .sec-icon, .theme-orange .status-dot-corner { color: #f97316; background-color: #f97316; }
    .theme-green { border-top: 3px solid #10b981; } .theme-green .sec-icon, .theme-green .status-dot-corner { color: #10b981; background-color: #10b981; }
    .theme-red { border-top: 3px solid #ef4444; } .theme-red .sec-icon, .theme-red .status-dot-corner { color: #ef4444; background-color: #ef4444; }

    /* Tabs */
    .sec-tabs {
        display: flex; gap: 16px; border-bottom: 1px solid var(--border-color); margin-bottom: 24px;
        overflow-x: auto; white-space: nowrap; padding-bottom: 4px;
    }
    .sec-tabs::-webkit-scrollbar { height: 0px; background: transparent; }

    .sec-tab-link {
        background: none; border: none; color: var(--text-muted); padding: 10px 12px; font-size: 0.9rem; font-weight: 500;
        cursor: pointer; position: relative; transition: 0.2s;
    }
    .sec-tab-link:hover { color: var(--text-main); }
    .sec-tab-link.active { color: #ef4444; }
    .sec-tab-link.active::after {
        content: ''; position: absolute; bottom: -5px; left: 0; width: 100%; height: 2px; background-color: #ef4444;
    }

    /* List Items & Panels */
    .sec-panel {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
    }

    .sec-list-item {
        padding: 16px 0; border-bottom: 1px solid var(--border-color);
        display: flex; flex-direction: column; gap: 12px;
    }
    @media(min-width: 768px) {
        .sec-list-item { flex-direction: row; align-items: center; justify-content: space-between; gap: 0; }
    }
    .sec-list-item:last-child { border-bottom: none; }

    /* Alerts */
    .alert-item {
        background: rgba(239, 68, 68, 0.05); border: 1px solid rgba(239, 68, 68, 0.2);
        border-radius: 8px; padding: 16px; margin-bottom: 12px;
        display: flex; flex-direction: column; gap: 12px;
    }
    @media(min-width: 768px) {
        .alert-item { flex-direction: row; align-items: center; justify-content: space-between; }
    }

    /* Threat Dashboard */
    .threat-card {
        background-color: var(--bg-body); border: 1px solid var(--border-color);
        border-radius: 8px; padding: 20px; height: 100%;
        position: relative;
    }
    .threat-corner-badge { position: absolute; top: 12px; right: 12px; font-size: 0.7rem; }

    /* Charts */
    .chart-container { height: 250px; display: flex; align-items: flex-end; width: 100%; }
    .donut-chart { width: 140px; height: 140px; border-radius: 50%; margin: 0 auto; background: conic-gradient(#3b82f6 0% 25%, #f97316 25% 43%, #10b981 43% 55%, #ef4444 55% 80%, #14b8a6 80% 100%); position: relative; }
    .donut-chart::after { content: ''; position: absolute; top: 25px; left: 25px; width: 90px; height: 90px; background: var(--bg-card); border-radius: 50%; }

</style>

<div class="security-banner d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
    <div>
        <h5 class="fw-bold text-white mb-1"><i class="bi bi-shield-lock me-2"></i> Platform Security Status</h5>
        <div class="text-white-50">Overall Security Score: <span class="score-val">94/100</span></div>
    </div>
    <span class="badge bg-success bg-opacity-25 border border-success text-success px-3 py-2 w-100 w-md-auto text-center">
        <i class="bi bi-circle-fill small me-2"></i> Low Threat Level
    </span>
</div>

<div class="row g-4 mb-4">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="sec-stat-card theme-orange">
            <div class="status-dot-corner"></div>
            <i class="bi bi-person-x sec-icon"></i>
            <div class="sec-val">23</div>
            <div class="sec-label">Failed Logins</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="sec-stat-card theme-green">
            <div class="status-dot-corner"></div>
            <i class="bi bi-shield-check sec-icon"></i>
            <div class="sec-val">156</div>
            <div class="sec-label">Blocked Threats</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="sec-stat-card theme-red">
            <div class="status-dot-corner"></div>
            <i class="bi bi-exclamation-triangle sec-icon"></i>
            <div class="sec-val">0</div>
            <div class="sec-label">Security Incidents</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="sec-stat-card theme-orange">
            <div class="status-dot-corner"></div>
            <i class="bi bi-bug sec-icon"></i>
            <div class="sec-val">2</div>
            <div class="sec-label">Vulnerabilities</div>
        </div>
    </div>
</div>

<div class="sec-tabs">
    <button class="sec-tab-link active" onclick="switchSecTab('overview')"><i class="bi bi-eye me-1"></i> Overview</button>
    <button class="sec-tab-link" onclick="switchSecTab('alerts')"><i class="bi bi-bell me-1"></i> Alerts</button>
    <button class="sec-tab-link" onclick="switchSecTab('audit')"><i class="bi bi-journal-text me-1"></i> Audit Logs</button>
    <button class="sec-tab-link" onclick="switchSecTab('compliance')"><i class="bi bi-patch-check me-1"></i> Compliance</button>
    <button class="sec-tab-link" onclick="switchSecTab('threats')"><i class="bi bi-radar me-1"></i> Threat Intelligence</button>
    <button class="sec-tab-link" onclick="switchSecTab('access')"><i class="bi bi-key me-1"></i> Access Control</button>
    <button class="sec-tab-link" onclick="switchSecTab('data')"><i class="bi bi-database-lock me-1"></i> Data Protection</button>
    <button class="sec-tab-link" onclick="switchSecTab('incidents')"><i class="bi bi-life-preserver me-1"></i> Incident Response</button>
</div>

<div id="tab-overview" class="sec-content-block">
    <div class="row g-4">
        <div class="col-12 col-lg-8">
            <div class="sec-panel h-100 d-flex flex-column">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-bold text-main m-0"><i class="bi bi-graph-up-arrow text-danger me-2"></i> Threat Trends (Last 7 Days)</h6>
                </div>
                <div class="chart-container flex-grow-1 position-relative">
                    <svg viewBox="0 0 800 200" class="w-100 h-100" preserveAspectRatio="none" style="overflow: visible;">
                        <line x1="0" y1="50" x2="100%" y2="50" stroke="rgba(255,255,255,0.05)" stroke-width="1" />
                        <line x1="0" y1="100" x2="100%" y2="100" stroke="rgba(255,255,255,0.05)" stroke-width="1" />
                        <line x1="0" y1="150" x2="100%" y2="150" stroke="rgba(255,255,255,0.05)" stroke-width="1" />
                        <path d="M0,150 C100,120 200,180 300,160 C400,100 500,50 600,80 C700,150 800,180 800,180"
                              fill="none" stroke="#ef4444" stroke-width="3" />
                    </svg>
                </div>
                <div class="d-flex justify-content-between --text-muted small mt-3">
                    <span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="sec-panel h-100">
                <h6 class="fw-bold text-main mb-4"><i class="bi bi-pie-chart text-warning me-2"></i> Risk Categories</h6>
                <div class="donut-chart mb-4"></div>
                <div>
                    <div class="d-flex justify-content-between small mb-2"><span><i class="bi bi-circle-fill text-primary" style="font-size: 8px;"></i> Authentication</span> <span class="fw-bold">25%</span></div>
                    <div class="d-flex justify-content-between small mb-2"><span><i class="bi bi-circle-fill text-warning" style="font-size: 8px;"></i> Data Access</span> <span class="fw-bold">18%</span></div>
                    <div class="d-flex justify-content-between small mb-2"><span><i class="bi bi-circle-fill text-success" style="font-size: 8px;"></i> Network</span> <span class="fw-bold">12%</span></div>
                    <div class="d-flex justify-content-between small mb-2"><span><i class="bi bi-circle-fill text-danger" style="font-size: 8px;"></i> Malware</span> <span class="fw-bold">8%</span></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="tab-alerts" class="sec-content-block d-none">
    <div class="sec-panel">
        <h6 class="fw-bold text-main mb-4">Active Security Alerts</h6>

        <div class="alert-item">
            <div class="d-flex align-items-start gap-3">
                <i class="bi bi-exclamation-octagon-fill text-danger fs-4"></i>
                <div>
                    <h6 class="fw-bold text-main mb-1">High CPU Usage on Server-03 <span class="badge bg-danger ms-2">CRITICAL</span></h6>
                    <p class="--text-muted small mb-1">CPU utilization has exceeded 85% threshold for the past 15 minutes.</p>
                    <small class="--text-muted">Affected: server-03 • 2 mins ago</small>
                </div>
            </div>
            <div class="d-flex gap-2 w-100 w-md-auto justify-content-end">
                <button class="btn btn-sm btn-outline-secondary">Acknowledge</button>
                <button class="btn btn-sm btn-primary">Investigate</button>
            </div>
        </div>

        <div class="alert-item" style="background: rgba(249, 115, 22, 0.05); border-color: rgba(249, 115, 22, 0.2);">
            <div class="d-flex align-items-start gap-3">
                <i class="bi bi-exclamation-triangle-fill text-warning fs-4"></i>
                <div>
                    <h6 class="fw-bold text-main mb-1">Database Connection Pool Exhausted <span class="badge bg-warning text-dark ms-2">WARNING</span></h6>
                    <p class="--text-muted small mb-1">All database connections are in use, new requests are queued.</p>
                    <small class="--text-muted">Affected: db-cluster-1 • 8 mins ago</small>
                </div>
            </div>
            <div class="d-flex gap-2 w-100 w-md-auto justify-content-end">
                <button class="btn btn-sm btn-outline-secondary">Acknowledge</button>
                <button class="btn btn-sm btn-primary">Investigate</button>
            </div>
        </div>
    </div>
</div>

<div id="tab-audit" class="sec-content-block d-none">
    <div class="sec-panel">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <input type="text" class="search-input-support --bg-card w-50" placeholder="Search audit logs...">
            <button class="btn btn-sm btn-outline-primary"><i class="bi bi-download"></i> Export</button>
        </div>

        <div class="sec-list-item">
            <div class="d-flex align-items-start gap-3">
                <i class="bi bi-check-circle-fill text-success mt-1"></i>
                <div>
                    <h6 class="fw-bold text-main mb-0">User Account Created</h6>
                    <small class="--text-muted">admin@kickstartskills.com created user 'john.doe'</small>
                </div>
            </div>
            <small class="--text-muted">2024-01-30 14:20:05 • IP: 192.168.1.1</small>
        </div>

        <div class="sec-list-item">
            <div class="d-flex align-items-start gap-3">
                <i class="bi bi-x-circle-fill text-danger mt-1"></i>
                <div>
                    <h6 class="fw-bold text-main mb-0">Failed Login Attempt</h6>
                    <small class="--text-muted">Multiple failed attempts for user 'admin'</small>
                </div>
            </div>
            <small class="--text-muted">2024-01-30 14:18:42 • IP: 203.45.67.89</small>
        </div>

        <div class="sec-list-item">
            <div class="d-flex align-items-start gap-3">
                <i class="bi bi-cloud-download-fill text-warning mt-1"></i>
                <div>
                    <h6 class="fw-bold text-main mb-0">Data Export</h6>
                    <small class="--text-muted">Large data export initiated by 'manager'</small>
                </div>
            </div>
            <small class="--text-muted">2024-01-30 11:15:20 • IP: 192.168.1.100</small>
        </div>
    </div>
</div>

<div id="tab-compliance" class="sec-content-block d-none">
    <div class="sec-panel">
        <h6 class="fw-bold text-main mb-4">Compliance Status</h6>

        <div class="sec-list-item">
            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-patch-check-fill text-success fs-4"></i>
                <div>
                    <h6 class="fw-bold text-main mb-0">GDPR Compliance</h6>
                    <small class="--text-muted">General Data Protection Regulation</small>
                </div>
            </div>
            <span class="badge bg-soft-success text-success">COMPLIANT</span>
        </div>

        <div class="sec-list-item">
            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-patch-check-fill text-success fs-4"></i>
                <div>
                    <h6 class="fw-bold text-main mb-0">CCPA Compliance</h6>
                    <small class="--text-muted">California Consumer Privacy Act</small>
                </div>
            </div>
            <span class="badge bg-soft-success text-success">COMPLIANT</span>
        </div>

        <div class="sec-list-item">
            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-exclamation-circle-fill text-danger fs-4"></i>
                <div>
                    <h6 class="fw-bold text-main mb-0">SOC 2 Compliance</h6>
                    <small class="--text-muted">Service Organization Control 2</small>
                </div>
            </div>
            <span class="badge bg-soft-danger text-danger">NON-COMPLIANT</span>
        </div>

        <div class="d-flex justify-content-between mt-4 pt-3 border-top border-secondary border-opacity-25 small --text-muted">
            <span>Last Audit: 2024-01-15</span>
            <span>Next Audit: 2024-04-15</span>
        </div>
    </div>
</div>

<div id="tab-threats" class="sec-content-block d-none">
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="threat-card" style="background: rgba(239, 68, 68, 0.1); border-color: rgba(239, 68, 68, 0.2);">
                <span class="badge bg-danger threat-corner-badge">+3</span>
                <div class="fs-2 fw-bold text-danger mb-1">12</div>
                <small class="text-danger opacity-75">Active Threats</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="threat-card" style="background: rgba(16, 185, 129, 0.1); border-color: rgba(16, 185, 129, 0.2);">
                <span class="badge bg-success threat-corner-badge">+156</span>
                <div class="fs-2 fw-bold text-success mb-1">1,247</div>
                <small class="text-success opacity-75">Blocked IPs</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="threat-card" style="background: rgba(245, 158, 11, 0.1); border-color: rgba(245, 158, 11, 0.2);">
                <span class="badge bg-warning text-dark threat-corner-badge">Medium</span>
                <div class="fs-2 fw-bold text-warning mb-1">8</div>
                <small class="text-warning opacity-75">Malware Detected</small>
            </div>
        </div>
    </div>

    <div class="sec-panel">
        <h6 class="fw-bold text-main mb-3">Active Threat Sources</h6>
        <div class="sec-list-item">
            <div>
                <h6 class="fw-bold text-main mb-1">Brute Force Attack</h6>
                <small class="--text-muted">Source: 192.168.100.45 • 127 attempts</small>
            </div>
            <span class="badge bg-danger">High</span>
        </div>
        <div class="sec-list-item">
            <div>
                <h6 class="fw-bold text-main mb-1">SQL Injection Attempt</h6>
                <small class="--text-muted">Source: 104.26.12.78 • 23 attempts</small>
            </div>
            <span class="badge bg-danger">Critical</span>
        </div>
    </div>
</div>

<div id="tab-access" class="sec-content-block d-none">
    <div class="sec-panel">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h6 class="fw-bold text-main m-0">Role-Based Access Control</h6>
            <a href="#" class="text-primary small text-decoration-none">Manage Roles</a>
        </div>

        <div class="sec-list-item">
            <div>
                <h6 class="fw-bold text-main mb-0">Super Admin</h6>
                <small class="--text-muted">2 users • 100% permissions</small>
            </div>
            <span class="text-success small fw-bold">Active</span>
        </div>
        <div class="sec-list-item">
            <div>
                <h6 class="fw-bold text-main mb-0">Admin Staff</h6>
                <small class="--text-muted">8 users • 75% permissions</small>
            </div>
            <span class="text-success small fw-bold">Active</span>
        </div>
        <div class="sec-list-item">
            <div>
                <h6 class="fw-bold text-main mb-0">Guest</h6>
                <small class="--text-muted">12 users • 5% permissions</small>
            </div>
            <span class="text-warning small fw-bold">Limited</span>
        </div>
    </div>

    <div class="sec-panel">
        <h6 class="fw-bold text-main mb-3">Recent Admin Sessions</h6>
        <div class="sec-list-item">
            <div class="d-flex align-items-center gap-2">
                <span class="status-dot-corner position-static bg-success d-inline-block"></span>
                <div>
                    <div class="fw-bold text-main small">admin@kickstartskills.com</div>
                    <small class="--text-muted" style="font-size: 0.75rem;">New York, US • Chrome on Windows</small>
                </div>
            </div>
            <small class="--text-muted">2 hours ago</small>
        </div>
    </div>
</div>

<div id="tab-data" class="sec-content-block d-none">
    <div class="sec-panel">
        <h6 class="fw-bold text-main mb-4"><i class="bi bi-lock me-2 text-danger"></i> Data Protection & Encryption</h6>

        <div class="sec-list-item">
            <div>
                <h6 class="fw-bold text-main mb-0">Database Encryption</h6>
                <small class="--text-muted">Encryption: AES-256</small>
            </div>
            <span class="badge bg-soft-success text-success">Compliant</span>
        </div>
        <div class="sec-list-item">
            <div>
                <h6 class="fw-bold text-main mb-0">API Communications</h6>
                <small class="--text-muted">Encryption: TLS 1.3</small>
            </div>
            <span class="badge bg-soft-success text-success">Compliant</span>
        </div>
        <div class="sec-list-item">
            <div>
                <h6 class="fw-bold text-main mb-0">Backup Encryption</h6>
                <small class="--text-muted">Encryption: RSA-4096</small>
            </div>
            <span class="badge bg-soft-success text-success">Compliant</span>
        </div>
    </div>

    <div class="sec-panel">
        <h6 class="fw-bold text-main mb-3">Data Classification</h6>
        <div class="mb-3">
            <div class="d-flex justify-content-between small mb-1">
                <span class="text-primary"><i class="bi bi-circle-fill small me-1"></i> Public</span>
                <span class="--text-muted">12,450 records</span>
            </div>
            <div class="progress" style="height: 4px;"><div class="progress-bar bg-primary" style="width: 60%"></div></div>
        </div>
        <div class="mb-3">
            <div class="d-flex justify-content-between small mb-1">
                <span class="text-warning"><i class="bi bi-circle-fill small me-1"></i> Internal</span>
                <span class="--text-muted">8,320 records</span>
            </div>
            <div class="progress" style="height: 4px;"><div class="progress-bar bg-warning" style="width: 35%"></div></div>
        </div>
        <div>
            <div class="d-flex justify-content-between small mb-1">
                <span class="text-danger"><i class="bi bi-circle-fill small me-1"></i> Restricted</span>
                <span class="--text-muted">1,200 records</span>
            </div>
            <div class="progress" style="height: 4px;"><div class="progress-bar bg-danger" style="width: 5%"></div></div>
        </div>
    </div>
</div>

<div id="tab-incidents" class="sec-content-block d-none">
    <div class="sec-panel p-0 overflow-hidden mb-4">
        <div class="row g-0">
            <div class="col-6 col-md-3 p-4 border-end border-secondary border-opacity-25 text-center bg-danger bg-opacity-10">
                <div class="fs-2 fw-bold text-danger">2</div>
                <small class="text-danger opacity-75">Active Incidents</small>
            </div>
            <div class="col-6 col-md-3 p-4 border-end border-secondary border-opacity-25 text-center">
                <div class="fs-2 fw-bold text-success">5</div>
                <small class="text-success">Resolved Today</small>
            </div>
            <div class="col-6 col-md-3 p-4 border-end border-secondary border-opacity-25 text-center">
                <div class="fs-2 fw-bold text-primary">12m</div>
                <small class="text-primary">Avg Response Time</small>
            </div>
            <div class="col-6 col-md-3 p-4 text-center">
                <div class="fs-2 fw-bold text-warning">2.4h</div>
                <small class="text-warning">MTTR</small>
            </div>
        </div>
    </div>

    <div class="sec-panel">
        <h6 class="fw-bold text-main mb-3">Active Security Incidents</h6>
        <div class="alert-item border-danger bg-danger bg-opacity-10">
            <div>
                <h6 class="fw-bold text-main mb-1">Suspicious API Activity Detected</h6>
                <small class="--text-muted">Unusual request patterns detected from multiple IP addresses.</small>
            </div>
            <div class="text-end">
                <span class="badge bg-danger mb-2">High</span>
                <div><a href="#" class="small text-primary text-decoration-none">View Details</a></div>
            </div>
        </div>
    </div>

    <div class="sec-panel">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold text-main m-0">Response Playbooks</h6>
            <a href="#" class="small text-primary text-decoration-none">Manage Playbooks</a>
        </div>
        <div class="sec-list-item">
            <div>
                <h6 class="fw-bold text-main mb-0">Data Breach Response</h6>
                <small class="--text-muted">Triggers: Unauth data access, > 100 records</small>
            </div>
            <a href="#" class="small text-primary text-decoration-none">Execute</a>
        </div>
        <div class="sec-list-item">
            <div>
                <h6 class="fw-bold text-main mb-0">DDoS Attack Mitigation</h6>
                <small class="--text-muted">Triggers: High latency anomaly, > 1M req/sec</small>
            </div>
            <a href="#" class="small text-primary text-decoration-none">Execute</a>
        </div>
    </div>
</div>

<script>
    function switchSecTab(tabName) {
        document.querySelectorAll('.sec-tab-link').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');

        document.querySelectorAll('.sec-content-block').forEach(el => el.classList.add('d-none'));
        document.getElementById('tab-' + tabName).classList.remove('d-none');
    }
</script>

@endsection
