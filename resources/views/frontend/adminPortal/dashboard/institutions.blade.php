@extends('frontend.adminPortal.dashboard.layouts.app')

@section('title', 'Institution Management')

@section('icon', 'bi-buildings')

@section('content')
<style>
    /* --- Page Specific Styles (Green/Teal Theme) --- */

    /* Stats Cards */
    .inst-stat-card {
        background: linear-gradient(145deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0.01) 100%);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 16px;
        padding: 24px;
        position: relative;
        overflow: hidden;
        height: 100%;
        display: flex; flex-direction: column; justify-content: center;
    }
    .inst-stat-card::before {
        content: ''; position: absolute; top: 0; left: 0; width: 4px; height: 100%;
        background-color: #10b981; opacity: 0.5;
    }

    .inst-icon {
        font-size: 1.5rem; margin-bottom: 12px; color: #10b981;
        background: rgba(16, 185, 129, 0.1);
        width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;
        border-radius: 12px;
    }

    .inst-val { font-size: 1.8rem; font-weight: 700; color: var(--text-main); margin-bottom: 4px; }
    .inst-label { font-size: 0.85rem; color: var(--text-muted); }
    .inst-trend { position: absolute; top: 24px; right: 24px; font-size: 0.75rem; color: #10b981; font-weight: 600; }

    /* Tabs */
    .inst-tabs {
        display: flex; gap: 10px; margin-bottom: 24px;
        overflow-x: auto; white-space: nowrap; padding-bottom: 4px;
    }
    .inst-tabs::-webkit-scrollbar { height: 0px; background: transparent; }

    .inst-tab-btn {
        background: transparent; border: 1px solid var(--border-color);
        color: var(--text-muted); padding: 8px 16px; border-radius: 8px;
        font-size: 0.9rem; font-weight: 500; transition: 0.2s;
        display: flex; align-items: center; gap: 8px;
        flex-shrink: 0;
    }
    .inst-tab-btn:hover, .inst-tab-btn.active {
        background-color: rgba(16, 185, 129, 0.1);
        border-color: #10b981;
        color: #10b981;
    }

    /* Content Cards */
    .content-box {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 24px;
        height: 100%;
    }

    /* Partner Item (Active Partners Tab) */
    .partner-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        margin-bottom: 16px;
        overflow: hidden;
    }
    .partner-header {
        padding: 20px; border-bottom: 1px solid var(--border-color);
        display: flex; justify-content: space-between; align-items: start;
    }
    .partner-body {
        padding: 20px; display: flex; flex-wrap: wrap; gap: 20px;
    }
    .partner-stat {
        flex: 1; text-align: center; min-width: 100px;
    }
    .partner-footer {
        padding: 12px 20px; background: rgba(255,255,255,0.02);
        border-top: 1px solid var(--border-color);
        display: flex; justify-content: space-between; align-items: center;
    }

    /* Placeholder Area */
    .placeholder-area {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 40px;
        text-align: center;
        color: var(--text-muted);
    }

    /* Donut Chart */
    .donut-chart {
        width: 180px; height: 180px; border-radius: 50%;
        background: conic-gradient(#10b981 0% 35%, #3b82f6 35% 57%, #f59e0b 57% 74%, #ef4444 74% 86%, #14b8a6 86% 100%);
        position: relative; margin: 0 auto; display: flex; align-items: center; justify-content: center;
    }
    .donut-chart::after { content: ''; position: absolute; width: 120px; height: 120px; background-color: var(--bg-card); border-radius: 50%; }

    .legend-item { display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px; font-size: 0.85rem; }
    .legend-color { width: 10px; height: 10px; border-radius: 50%; margin-right: 8px; display: inline-block; }

    /* App Item */
    .app-item {
        background-color: rgba(255,255,255,0.02); border: 1px solid var(--border-color);
        border-radius: 12px; padding: 16px; margin-bottom: 12px;
        display: flex; flex-direction: column; gap: 12px;
    }
    @media(min-width: 768px) { .app-item { flex-direction: row; align-items: center; justify-content: space-between; gap: 0; } }

    .status-badge { font-size: 0.65rem; font-weight: 700; text-transform: uppercase; padding: 4px 8px; border-radius: 4px; display: inline-block; }
    .status-pending { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
    .status-review { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }

    /* Header Banner */
    .inst-banner {
        background: linear-gradient(90deg, #064e3b 0%, #065f46 100%);
        padding: 24px; border-radius: 16px; color: white; margin-bottom: 24px;
        display: flex; flex-direction: column; border: 1px solid rgba(16, 185, 129, 0.2); gap: 12px;
    }
    @media(min-width: 768px) { .inst-banner { flex-direction: row; align-items: center; justify-content: space-between; } }
</style>

<div class="inst-banner">
    <div>
        <h5 class="fw-bold mb-1"><i class="bi bi-diagram-3 me-2"></i> Institution Partnership Network</h5>
        <small class="text-white-50">Managing 128 educational institutions worldwide</small>
    </div>
    <span class="badge bg-success border border-success bg-opacity-25 px-3 py-2 w-100 w-md-auto text-center">98 Active</span>
</div>

<div class="row g-4 mb-4">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="inst-stat-card">
            <div class="inst-icon"><i class="bi bi-buildings"></i></div>
            <div class="inst-val">128</div>
            <div class="inst-label">Total Institutions</div>
            <span class="inst-trend">+8.5%</span>
            <small class="--text-muted d-block mt-2" style="font-size: 0.7rem;">23 pending approval</small>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="inst-stat-card">
            <div class="inst-icon"><i class="bi bi-patch-check"></i></div>
            <div class="inst-val">87</div>
            <div class="inst-label">Verified Partners</div>
            <span class="inst-trend">+12.1%</span>
            <small class="--text-muted d-block mt-2" style="font-size: 0.7rem;">Fully compliant</small>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="inst-stat-card">
            <div class="inst-icon" style="color: #f59e0b; background: rgba(245,158,11,0.1);"><i class="bi bi-star"></i></div>
            <div class="inst-val">42</div>
            <div class="inst-label">Premium Partners</div>
            <span class="inst-trend" style="color: #f59e0b;">+15.3%</span>
            <small class="--text-muted d-block mt-2" style="font-size: 0.7rem;">Top tier access</small>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="inst-stat-card">
            <div class="inst-icon" style="color: #3b82f6; background: rgba(59,130,246,0.1);"><i class="bi bi-people"></i></div>
            <div class="inst-val">15,420</div>
            <div class="inst-label">Total Students</div>
            <span class="inst-trend" style="color: #3b82f6;">+6.2%</span>
            <small class="--text-muted d-block mt-2" style="font-size: 0.7rem;">Across all partners</small>
        </div>
    </div>
</div>

<div class="inst-tabs">
    <button class="inst-tab-btn active" onclick="switchInstTab('overview')"><i class="bi bi-pie-chart"></i> Overview</button>
    <button class="inst-tab-btn" onclick="switchInstTab('applications')"><i class="bi bi-file-earmark-text"></i> Applications</button>
    <button class="inst-tab-btn" onclick="switchInstTab('partners')"><i class="bi bi-check-circle"></i> Active Partners</button>
    <button class="inst-tab-btn" onclick="switchInstTab('analytics')"><i class="bi bi-graph-up"></i> Analytics</button>
</div>

<div id="tab-overview" class="inst-content-block">
    <div class="row g-4">
        <div class="col-12 col-lg-5">
            <div class="content-box">
                <h6 class="fw-bold text-main mb-4"><i class="bi bi-pie-chart me-2 text-success"></i> Institution Types</h6>
                <div class="row align-items-center">
                    <div class="col-12 col-sm-6 mb-4 mb-sm-0 d-flex justify-content-center">
                        <div class="donut-chart"></div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="legend-item"><span class="--text-muted"><span class="legend-color" style="background: #10b981;"></span> Engineering</span> <span>45</span></div>
                        <div class="legend-item"><span class="--text-muted"><span class="legend-color" style="background: #3b82f6;"></span> Business</span> <span>28</span></div>
                        <div class="legend-item"><span class="--text-muted"><span class="legend-color" style="background: #ef4444;"></span> Medical</span> <span>18</span></div>
                        <div class="legend-item"><span class="--text-muted"><span class="legend-color" style="background: #f59e0b;"></span> Arts & Sci</span> <span>22</span></div>
                        <div class="legend-item"><span class="--text-muted"><span class="legend-color" style="background: #14b8a6;"></span> Technology</span> <span>15</span></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-7">
            <div class="content-box">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-bold text-main m-0"><i class="bi bi-file-earmark-richtext me-2 text-success"></i> Recent Applications</h6>
                    <a href="#" class="text-success text-decoration-none small fw-bold">View All</a>
                </div>

                <div class="app-item">
                    <div>
                        <h6 class="fw-bold text-main mb-1">MIT Institute of Technology</h6>
                        <div class="--text-muted small">Boston, MA • Engineering College</div>
                        <div class="--text-muted small mt-1" style="font-size: 0.75rem;">Contact: Dr. Sarah Johnson • <i class="bi bi-people"></i> 2500+ Students</div>
                    </div>
                    <div class="text-md-end w-100 w-md-auto d-flex flex-row flex-md-column justify-content-between align-items-center align-items-md-end mt-2 mt-md-0">
                        <span class="status-badge status-pending">Pending Review</span>
                        <div class="mt-md-2">
                            <button class="btn btn-sm btn-icon --text-muted p-0 me-2"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-sm btn-icon text-success p-0"><i class="bi bi-check-lg"></i></button>
                        </div>
                    </div>
                </div>

                <div class="app-item">
                    <div>
                        <h6 class="fw-bold text-main mb-1">Stanford Business School</h6>
                        <div class="--text-muted small">Stanford, CA • Business School</div>
                        <div class="--text-muted small mt-1" style="font-size: 0.75rem;">Contact: Prof. Michael Chen • <i class="bi bi-people"></i> 1800+ Students</div>
                    </div>
                    <div class="text-md-end w-100 w-md-auto d-flex flex-row flex-md-column justify-content-between align-items-center align-items-md-end mt-2 mt-md-0">
                        <span class="status-badge status-review">Under Review</span>
                        <div class="mt-md-2">
                            <button class="btn btn-sm btn-icon --text-muted p-0 me-2"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-sm btn-icon text-success p-0"><i class="bi bi-check-lg"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="tab-applications" class="inst-content-block d-none">
    <div class="content-box">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h6 class="fw-bold text-main m-0">Institution Applications</h6>
            <button class="btn btn-sm btn-outline-success"><i class="bi bi-list-check me-1"></i> Bulk Actions</button>
        </div>
        <p class="--text-muted small">Detailed applications management coming soon</p>
    </div>
</div>

<div id="tab-partners" class="inst-content-block d-none">

    <div class="partner-card">
        <div class="partner-header">
            <div class="d-flex align-items-center gap-3">
                <div class="inst-icon" style="width: 40px; height: 40px; font-size: 1.2rem;"><i class="bi bi-building"></i></div>
                <div>
                    <h6 class="fw-bold text-main mb-0">Harvard University</h6>
                    <small class="--text-muted">Cambridge, MA • University</small>
                </div>
            </div>
            <div class="text-warning small"><i class="bi bi-star-fill"></i> 4.8</div>
        </div>
        <div class="partner-body">
            <div class="partner-stat">
                <div class="fw-bold text-main text-primary">3200</div>
                <small class="--text-muted" style="font-size: 0.7rem;">Students</small>
            </div>
            <div class="partner-stat">
                <div class="fw-bold text-main text-success">145</div>
                <small class="--text-muted" style="font-size: 0.7rem;">Internships</small>
            </div>
            <div class="partner-stat">
                <div class="fw-bold text-main text-warning">94.5%</div>
                <small class="--text-muted" style="font-size: 0.7rem;">Completion</small>
            </div>
        </div>
        <div class="partner-footer">
            <a href="#" class="small text-primary text-decoration-none">View Details</a>
            <a href="#" class="small --text-muted text-decoration-none"><i class="bi bi-gear-fill"></i> Manage</a>
        </div>
    </div>

    <div class="partner-card">
        <div class="partner-header">
            <div class="d-flex align-items-center gap-3">
                <div class="inst-icon" style="width: 40px; height: 40px; font-size: 1.2rem;"><i class="bi bi-building"></i></div>
                <div>
                    <h6 class="fw-bold text-main mb-0">IIT Delhi</h6>
                    <small class="--text-muted">New Delhi, India • Engineering Institute</small>
                </div>
            </div>
            <div class="text-warning small"><i class="bi bi-star-fill"></i> 4.7</div>
        </div>
        <div class="partner-body">
            <div class="partner-stat">
                <div class="fw-bold text-main text-primary">2800</div>
                <small class="--text-muted" style="font-size: 0.7rem;">Students</small>
            </div>
            <div class="partner-stat">
                <div class="fw-bold text-main text-success">126</div>
                <small class="--text-muted" style="font-size: 0.7rem;">Internships</small>
            </div>
            <div class="partner-stat">
                <div class="fw-bold text-main text-warning">91.2%</div>
                <small class="--text-muted" style="font-size: 0.7rem;">Completion</small>
            </div>
        </div>
        <div class="partner-footer">
            <a href="#" class="small text-primary text-decoration-none">View Details</a>
            <a href="#" class="small --text-muted text-decoration-none"><i class="bi bi-gear-fill"></i> Manage</a>
        </div>
    </div>

</div>

<div id="tab-analytics" class="inst-content-block d-none">
    <div class="content-box">
        <h6 class="fw-bold text-main mb-3"><i class="bi bi-graph-up me-2"></i> Institution Analytics</h6>
        <p class="--text-muted small">Advanced analytics and reporting features coming soon</p>
    </div>
</div>

<script>
    function switchInstTab(tabName) {
        // Reset buttons
        document.querySelectorAll('.inst-tab-btn').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');

        // Hide all blocks
        document.querySelectorAll('.inst-content-block').forEach(el => el.classList.add('d-none'));

        // Show selected
        document.getElementById('tab-' + tabName).classList.remove('d-none');
    }
</script>

@endsection
