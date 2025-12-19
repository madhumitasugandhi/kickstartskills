@extends('frontend.adminPortal.dashboard.layouts.app')

@section('title', 'Admin Dashboard')

@section('icon', 'bi bi-house-door fs-4 p-2 bg-soft-red rounded-3 text-red')

@section('content')
<style>
    /* Stats Card */
    .stat-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        transition: transform 0.2s, box-shadow 0.2s;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        border-color: var(--accent-color);
    }

    .icon-box-lg {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 16px;
    }

    /* Dashboard Cards */
    .dashboard-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 24px;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    /* --- Chart Specific Styles --- */
    .chart-container {
        position: relative;
        height: 250px;
        display: flex;
        align-items: stretch;
    }

    /* Y-Axis Labels */
    .y-axis {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        color: var(--text-muted);
        font-size: 0.7rem;
        padding-right: 10px;
        padding-bottom: 25px;
        /* Offset for X-axis labels */
    }

    /* The Grid Area */
    .chart-grid {
        flex-grow: 1;
        position: relative;
        border-left: 1px solid var(--border-color);
        border-bottom: 1px solid var(--border-color);
    }

    /* Dashed Horizontal Lines */
    .grid-line {
        position: absolute;
        left: 0;
        width: 100%;
        border-top: 1px dashed var(--border-color);
        opacity: 0.5;
    }

    /* Bar Styling */
    .bar-group {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        align-items: center;
        width: 100%;
        position: relative;
        z-index: 5;
    }

    .bar {
        width: 14px;
        /* Thin bars */
        border-radius: 4px 4px 0 0;
        transition: height 0.8s ease-in-out;
    }

    .x-label {
        margin-top: 10px;
        font-size: 0.75rem;
        color: var(--text-muted);
    }

    /* --- Chart Specific Styles --- */
    .chart-container-user {
        position: relative;
        height: 200px; /* Adjusted height for better visibility */
        display: flex;
        align-items: flex-end;

    }

    /* Gradient Fill for Area Chart */
    .chart-area-fill {
        fill: url(#growthGradient);
        opacity: ;
    }

    /* Welcome Banner (Red Theme) */
    .welcome-banner {
        background: linear-gradient(90deg, #4b1e1b 0%, #c64646 100%);
        /* Deep Blue/Indigo base */
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* Security Alert Item */
    .alert-item {
        background-color: rgba(220, 38, 38, 0.05);
        border: 1px solid rgba(220, 38, 38, 0.1);
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 12px;
        border-left: 3px solid #dc2626;
    }

    .alert-item:last-child {
        margin-bottom: 0;
    }

    /* Activity Item */
    .activity-item {
        display: flex;
        gap: 12px;
        margin-bottom: 16px;
        align-items: start;
    }

    .activity-icon {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: var(--bg-body);
        border: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        flex-shrink: 0;
        color: var(--accent-color);
    }

    /* Quick Action Button */
    .btn-quick {
        background-color: var(--bg-body);
        border: 1px solid var(--border-color);
        color: var(--text-muted);
        padding: 10px 16px;
        border-radius: 8px;
        font-size: 0.85rem;
        transition: 0.2s;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-quick:hover {
        border-color: var(--accent-color);
        color: var(--accent-color);
        background-color: var(--bg-hover);
    }
</style>

<div class="welcome-banner">
    <div>
        <h5 class="fw-bold mb-1"><i class="bi bi-activity me-2" style="color: #ef4444;"></i> System Status: 98.5%
            Healthy</h5>
        <small class="text-white-50">Platform running smoothly with 99.9% uptime</small>
    </div>
    <span class="badge bg-success rounded-pill px-3">ONLINE</span>
</div>

<p class="mb-4 --text-muted">Welcome back, Super Admin! Here's your comprehensive platform overview.</p>

<div class="row g-4 mb-4">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div class="icon-box-lg bg-soft-blue text-blue">
                    <i class="bi bi-people-fill"></i>
                </div>
                <span class="badge bg-soft-green text-green">+12.5%</span>
            </div>
            <h2 class="fw-bold text-main mb-1">15,420</h2>
            <p class="--text-muted small mb-0">Total Users</p>
            <small class="--text-muted" style="font-size: 0.75rem;">8934 active</small>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div class="icon-box-lg" style="background-color: rgba(16, 185, 129, 0.1); color: #10b981;">
                    <i class="bi bi-house-door"></i>
                </div>
                <span class="badge bg-soft-green text-green">+3.2%</span>
            </div>
            <h2 class="fw-bold text-main mb-1">128</h2>
            <p class="--text-muted small mb-0">Institutions</p>
            <small class="--text-muted" style="font-size: 0.75rem;">95 active</small>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div class="icon-box-lg bg-soft-red text-red">
                    <i class="bi bi-activity"></i>
                </div>
                <span class="badge bg-soft-green text-green">+8.7%</span>
            </div>
            <h2 class="fw-bold text-main mb-1">1,205</h2>
            <p class="--text-muted small mb-0">Active Sessions</p>
            <small class="--text-muted" style="font-size: 0.75rem;">Real-time connections</small>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div class="icon-box-lg" style="background-color: rgba(16, 185, 129, 0.1); color: #10b981;">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <span class="badge bg-soft-green text-green">+15.3%</span>
            </div>
            <h2 class="fw-bold text-main mb-1">₹18,501</h2>
            <p class="--text-muted small mb-0">Monthly Revenue</p>
            <small class="--text-muted" style="font-size: 0.75rem;">This month</small>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-12 col-lg-8">
        <div class="dashboard-card">
            <h5 class="fw-bold mb-4 text-main"><i class="bi bi-cpu me-2 text-danger"></i> System Performance</h5>

            <div class="chart-container">
                <div class="y-axis">
                    <span>100%</span>
                    <span>80%</span>
                    <span>60%</span>
                    <span>40%</span>
                    <span>20%</span>
                    <span>0%</span>
                </div>

                <div class="chart-grid position-relative">
                    <div class="grid-line" style="top: 0%;"></div>
                    <div class="grid-line" style="top: 20%;"></div>
                    <div class="grid-line" style="top: 40%;"></div>
                    <div class="grid-line" style="top: 60%;"></div>
                    <div class="grid-line" style="top: 80%;"></div>

                    <div class="d-flex justify-content-around h-100 px-3">

                        <div class="bar-group">
                            <div class="bar bg-primary" style="height: 45%;"></div>
                            <span class="x-label">CPU</span>
                        </div>

                        <div class="bar-group">
                            <div class="bar bg-warning" style="height: 68%;"></div>
                            <span class="x-label">RAM</span>
                        </div>

                        <div class="bar-group">
                            <div class="bar bg-success" style="height: 35%;"></div>
                            <span class="x-label">Disk</span>
                        </div>

                        <div class="bar-group">
                            <div class="bar bg-danger" style="height: 82%;"></div>
                            <span class="x-label">Network</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
    <div class="dashboard-card">
        <h5 class="fw-bold mb-4 text-main"><i class="bi bi-graph-up-arrow me-2 text-success"></i> User Growth</h5>

        <div class="chart-container-user">
            <svg viewBox="0 -100 500 150" class="w-100" style="height: 100%; overflow: visible;">
                <defs>
                    <linearGradient id="growthGradient" x1="0" x2="0" y1="0" y2="1">
                        <stop offset="0%" stop-color="#10b981" />
                        <stop offset="100%" stop-color="transparent" />
                    </linearGradient>
                </defs>

                <path d="M0,150 C100,140 150,100 250,120 C350,140 400,20 500,50 L500,150 L0,150 Z"
                      class="chart-area-fill" />

                <path d="M0,150 C100,140 150,100 250,120 C350,140 400,20 500,50"
                      fill="none"
                      stroke="#10b981"
                      stroke-width="4"
                      stroke-linecap="round" />
            </svg>
        </div>
    </div>
</div>
</div>

<div class="row g-4 mb-4">

    <div class="col-12 col-lg-6">
        <div class="dashboard-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold text-main mb-0"><i class="bi bi-exclamation-triangle me-2 text-warning"></i> Security
                    Alerts</h5>
                <span class="badge bg-soft-red text-red rounded-pill">2 New</span>
            </div>

            <div class="alert-item">
                <div class="d-flex justify-content-between">
                    <span class="fw-bold text-main small">Failed Login Attempts</span>
                    <small class="--text-muted" style="font-size: 0.7rem;">2 minutes ago</small>
                </div>
                <p class="mb-0 --text-muted small mt-1">15 failed login attempts from IP 192.168.1.100</p>
            </div>

            <div class="alert-item">
                <div class="d-flex justify-content-between">
                    <span class="fw-bold text-main small">Suspicious API Activity</span>
                    <small class="--text-muted" style="font-size: 0.7rem;">1 hour ago</small>
                </div>
                <p class="mb-0 --text-muted small mt-1">Unusual API call pattern detected</p>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6">
        <div class="dashboard-card">
            <h5 class="fw-bold mb-4 text-main"><i class="bi bi-activity me-2 text-danger"></i> Recent Activities</h5>

            <div class="activity-item">
                <div class="activity-icon"><i class="bi bi-building"></i></div>
                <div>
                    <div class="fw-bold text-main small">New Institution Registration</div>
                    <div class="--text-muted small">by MIT College • <span class="--text-muted-custom">5 minutes ago</span>
                    </div>
                    <div class="--text-muted small mt-1" style="font-size: 0.75rem;">Institution ID: INST_001</div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-icon"><i class="bi bi-gear"></i></div>
                <div>
                    <div class="fw-bold text-main small">System Configuration Update</div>
                    <div class="--text-muted small">by Admin User • <span class="--text-muted-custom">15 minutes ago</span>
                    </div>
                    <div class="--text-muted small mt-1" style="font-size: 0.75rem;">Updated exam time limits</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="dashboard-card mb-1 p-3">
    <h6 class="fw-bold text-main mb-3"><i class="bi bi-lightning-charge me-2 text-danger"></i> Quick Actions</h6>
    <div class="d-flex flex-wrap gap-3">
        <a href="#" class="btn-quick text-blue"><i class="bi bi-database"></i> Backup System</a>
        <a href="#" class="btn-quick text-warning"><i class="bi bi-bell"></i> Send Alert</a>
        <a href="#" class="btn-quick text-success"><i class="bi bi-trash"></i> Clear Cache</a>
        <a href="#" class="btn-quick text-danger"><i class="bi bi-download"></i> Export Data</a>
    </div>
</div>

@endsection
