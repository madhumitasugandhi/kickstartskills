@extends('frontend.adminPortal.dashboard.layouts.app')

@section('title', 'Platform Analytics')

@section('icon', 'bi-bar-chart-line')

@section('content')
<style>
    /* --- Analytics Specific Styles --- */

    /* Top Overview Banner */
    .analytics-banner {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 24px;
        border: 1px solid rgba(255,255,255,0.05);
        color: white;
    }
    @media(min-width: 768px) { .analytics-banner { padding: 32px; } }

    .banner-stat-box {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 12px;
        padding: 20px;
        display: flex; flex-direction: column; justify-content: center;
        height: 100%;
        transition: transform 0.2s;
    }
    .banner-stat-box:hover { transform: translateY(-5px); background: rgba(255,255,255,0.08); }

    .banner-icon { font-size: 1.5rem; margin-bottom: 8px; color: #3b82f6; }
    .banner-val { font-size: 1.5rem; font-weight: 700; margin-bottom: 4px; }
    @media(min-width: 992px) { .banner-val { font-size: 1.8rem; } }

    .banner-label { font-size: 0.9rem; opacity: 0.7; }
    .banner-growth { font-size: 0.75rem; color: #10b981; font-weight: 600; margin-top: 4px; }

    /* Time Range Selector (Scrollable on Mobile) */
    .time-selector {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 12px;
        margin-bottom: 24px;
        display: flex; gap: 8px;
        overflow-x: auto; white-space: nowrap; /* Horizontal scroll */
    }
    /* Hide scrollbar */
    .time-selector::-webkit-scrollbar { height: 0px; background: transparent; }

    .time-btn {
        background: transparent; border: none;
        color: var(--text-muted);
        padding: 8px 20px;
        border-radius: 8px;
        font-size: 0.85rem; font-weight: 500;
        cursor: pointer; transition: 0.2s;
        flex-shrink: 0;
    }
    .time-btn:hover { color: var(--text-main); background-color: var(--bg-hover); }
    .time-btn.active {
        background-color: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
        font-weight: 600;
    }

    /* Metric Cards Grid */
    .metric-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        height: 100%;
        position: relative;
        display: flex; flex-direction: column; justify-content: center;
    }
    .metric-icon-sm {
        font-size: 1.2rem; color: var(--text-muted); margin-bottom: 12px;
    }
    .metric-val-lg { font-size: 1.5rem; font-weight: 700; color: var(--text-main); }
    .metric-sub { font-size: 0.85rem; color: var(--text-muted); }
    .metric-badge-corner {
        position: absolute; top: 20px; right: 20px;
        font-size: 0.7rem; color: #10b981; background: rgba(16,185,129,0.1);
        padding: 2px 8px; border-radius: 4px;
    }

    /* Chart Containers */
    .chart-box {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 20px;
        height: 100%;
        min-height: 300px;
        display: flex; flex-direction: column;
    }
    @media(min-width: 768px) { .chart-box { padding: 24px; } }

    .chart-header {
        display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;
        flex-wrap: wrap; gap: 10px;
    }
    .chart-title { font-size: 1rem; font-weight: 700; color: var(--text-main); display: flex; align-items: center; gap: 8px; }

    /* Donut Chart */
    .donut-chart-lg {
        width: 160px; height: 160px; border-radius: 50%;
        background: conic-gradient(
            #10b981 0% 27.6%,
            #3b82f6 27.6% 47.8%,
            #f59e0b 47.8% 78%,
            #ef4444 78% 100%
        );
        position: relative; margin: 0 auto;
        display: flex; align-items: center; justify-content: center;
    }
    .donut-chart-lg::after {
        content: ''; position: absolute; width: 100px; height: 100px;
        background-color: var(--bg-card); border-radius: 50%;
    }

    /* Bar Chart */
    .bar-chart-container {
        display: flex; justify-content: space-around; align-items: flex-end;
        height: 180px; padding-top: 20px;
        width: 100%;
    }
    .bar-col {
        width: 8px; background-color: #10b981; border-radius: 4px 4px 0 0;
        transition: height 0.5s; opacity: 0.8;
    }
    @media(min-width: 576px) { .bar-col { width: 12px; } }
    .bar-col:hover { opacity: 1; }

    /* Feature Usage Progress */
    .prog-row { margin-bottom: 16px; }
    .prog-label { display: flex; justify-content: space-between; font-size: 0.8rem; margin-bottom: 6px; color: var(--text-muted); }
    .prog-bar-bg { height: 6px; background: var(--bg-body); border-radius: 3px; overflow: hidden; }
    .prog-fill { height: 100%; border-radius: 3px; }

</style>

<div class="analytics-banner">
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center mb-4 gap-3">
        <div class="d-flex align-items-center">
            <i class="bi bi-graph-up-arrow fs-3 me-3 text-primary"></i>
            <div>
                <h4 class="fw-bold mb-0">Platform Performance Overview</h4>
                <small class="opacity-75">Real-time analytics and insights for KickStartSkills platform</small>
            </div>
        </div>
        <span class="badge bg-success border border-light ms-md-auto align-self-start align-self-md-center">
            <i class="bi bi-circle-fill small me-1"></i> LIVE DATA
        </span>
    </div>

    <div class="row g-4">
        <div class="col-12 col-md-4">
            <div class="banner-stat-box">
                <i class="bi bi-people banner-icon"></i>
                <div class="banner-val">15,420</div>
                <div class="banner-label">Total Users</div>
                <div class="banner-growth"><i class="bi bi-arrow-up"></i> 12.5% growth</div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="banner-stat-box">
                <i class="bi bi-currency-dollar banner-icon" style="color: #10b981;"></i>
                <div class="banner-val">$245,001</div>
                <div class="banner-label">Revenue</div>
                <div class="banner-growth"><i class="bi bi-arrow-up"></i> Monthly: +$8501</div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="banner-stat-box">
                <i class="bi bi-buildings banner-icon" style="color: #f59e0b;"></i>
                <div class="banner-val">128</div>
                <div class="banner-label">Institutions</div>
                <div class="banner-growth"><i class="bi bi-arrow-up"></i> 3.2% growth</div>
            </div>
        </div>
    </div>
</div>

<div class="time-selector">
    <button class="time-btn">24H</button>
    <button class="time-btn active">7D</button>
    <button class="time-btn">30D</button>
    <button class="time-btn">90D</button>
    <button class="time-btn">1Y</button>
</div>

<div class="row g-4 mb-4">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="metric-card">
            <span class="metric-badge-corner">+12.5%</span>
            <i class="bi bi-person-check metric-icon-sm text-primary"></i>
            <div class="metric-val-lg">8,934</div>
            <div class="metric-sub">Active Users</div>
            <small class="--text-muted" style="font-size: 0.7rem;">Currently online</small>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="metric-card">
            <span class="metric-badge-corner">+3.2%</span>
            <i class="bi bi-building-check metric-icon-sm text-success"></i>
            <div class="metric-val-lg">95</div>
            <div class="metric-sub">Active Institutions</div>
            <small class="--text-muted" style="font-size: 0.7rem;">Verified partners</small>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="metric-card">
            <span class="metric-badge-corner">+54.2%</span>
            <i class="bi bi-briefcase metric-icon-sm text-warning"></i>
            <div class="metric-val-lg">1,245</div>
            <div class="metric-sub">Active Internships</div>
            <small class="--text-muted" style="font-size: 0.7rem;">Currently running</small>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="metric-card">
            <span class="metric-badge-corner">+0.8%</span>
            <i class="bi bi-bullseye metric-icon-sm text-info"></i>
            <div class="metric-val-lg">3.2%</div>
            <div class="metric-sub">Conversion Rate</div>
            <small class="--text-muted" style="font-size: 0.7rem;">Visitor to user</small>
        </div>
    </div>
</div>

<div class="row g-4">

    <div class="col-12 col-lg-8">
        <div class="chart-box">
            <div class="chart-header">
                <div class="chart-title"><i class="bi bi-activity text-primary"></i> Daily Active Users</div>
                <span class="badge bg-soft-blue text-primary">This Week</span>
            </div>

            <div class="d-flex align-items-end flex-grow-1 position-relative pt-4 w-100" style="min-height: 200px;">
                <svg viewBox="0 0 800 200" class="w-100 h-100" preserveAspectRatio="none">
                    <line x1="0" y1="50" x2="100%" y2="50" stroke="rgba(255,255,255,0.05)" stroke-width="1" stroke-dasharray="5,5"/>
                    <line x1="0" y1="100" x2="100%" y2="100" stroke="rgba(255,255,255,0.05)" stroke-width="1" stroke-dasharray="5,5"/>
                    <line x1="0" y1="150" x2="100%" y2="150" stroke="rgba(255,255,255,0.05)" stroke-width="1" stroke-dasharray="5,5"/>

                    <path d="M0,150 C100,150 150,80 250,120 C350,160 400,20 500,50 C600,80 700,180 800,190"
                          fill="none" stroke="#3b82f6" stroke-width="3" vector-effect="non-scaling-stroke"/>

                    <circle cx="0%" cy="150" r="4" fill="#3b82f6" />
                    <circle cx="31.25%" cy="120" r="4" fill="#3b82f6" />
                    <circle cx="62.5%" cy="50" r="4" fill="#3b82f6" />
                    <circle cx="100%" cy="190" r="4" fill="#3b82f6" />
                </svg>
            </div>
            <div class="d-flex justify-content-between --text-muted small mt-2 px-1">
                <span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="chart-box">
            <div class="chart-header">
                <div class="chart-title"><i class="bi bi-globe text-success"></i> Regional Distribution</div>
            </div>

            <div class="donut-chart-lg">
                <div class="text-center">
                    <div class="h4 fw-bold mb-0 text-main">15.4K</div>
                    <small class="--text-muted">Total</small>
                </div>
            </div>

            <div class="mt-4">
                <div class="d-flex justify-content-between small mb-2">
                    <span><i class="bi bi-circle-fill text-success small me-1"></i> North America</span> <span>27.6%</span>
                </div>
                <div class="d-flex justify-content-between small mb-2">
                    <span><i class="bi bi-circle-fill text-primary small me-1"></i> Europe</span> <span>20.2%</span>
                </div>
                <div class="d-flex justify-content-between small mb-2">
                    <span><i class="bi bi-circle-fill text-warning small me-1"></i> Asia Pacific</span> <span>42.7%</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-8">
        <div class="chart-box">
            <div class="chart-header">
                <div class="chart-title"><i class="bi bi-graph-up text-success"></i> Institution Growth</div>
            </div>

            <div class="bar-chart-container">
                <div class="bar-col" style="height: 40%;"></div>
                <div class="bar-col" style="height: 55%;"></div>
                <div class="bar-col" style="height: 45%;"></div>
                <div class="bar-col" style="height: 70%;"></div>
                <div class="bar-col" style="height: 60%;"></div>
                <div class="bar-col" style="height: 85%;"></div>
                <div class="bar-col" style="height: 75%;"></div>
            </div>
            <div class="d-flex justify-content-around --text-muted small mt-2">
                <span>Jan</span><span>Feb</span><span>Mar</span><span>Apr</span><span>May</span><span>Jun</span><span>Jul</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="chart-box">
            <div class="chart-header">
                <div class="chart-title"><i class="bi bi-lightning-charge text-warning"></i> Feature Usage</div>
            </div>

            <div class="prog-row">
                <div class="prog-label"><span>Search</span> <span class="text-success">89.2%</span></div>
                <div class="prog-bar-bg"><div class="prog-fill bg-success" style="width: 89.2%;"></div></div>
            </div>

            <div class="prog-row">
                <div class="prog-label"><span>Profile</span> <span class="text-warning">76.8%</span></div>
                <div class="prog-bar-bg"><div class="prog-fill bg-warning" style="width: 76.8%;"></div></div>
            </div>

            <div class="prog-row">
                <div class="prog-label"><span>Applications</span> <span class="text-warning">68.4%</span></div>
                <div class="prog-bar-bg"><div class="prog-fill bg-warning" style="width: 68.4%;"></div></div>
            </div>

            <div class="prog-row">
                <div class="prog-label"><span>Messaging</span> <span class="text-danger">45.2%</span></div>
                <div class="prog-bar-bg"><div class="prog-fill bg-danger" style="width: 45.2%;"></div></div>
            </div>

            <div class="prog-row">
                <div class="prog-label"><span>Resources</span> <span class="text-danger">34.6%</span></div>
                <div class="prog-bar-bg"><div class="prog-fill bg-danger" style="width: 34.6%;"></div></div>
            </div>
        </div>
    </div>

</div>
@endsection
