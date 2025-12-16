@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Digital Portfolio')
@section('icon', 'bi bi-briefcase fs-4 p-2 bg-primary bg-opacity-10 rounded-3 text-primary')

@section('content')
<style>
    /* Theme Variables */
    :root {
        --bg-body: #f8f9fa;
        --bg-sidebar: #ffffff;
        --bg-card: #ffffff;
        --bg-hover: #f8f9fa;

        --text-main: #343a40;
        --text-muted: #6c757d;
        --border-color: #e9ecef;

        /* Soft Colors */
        --soft-blue: #e7f1ff; --text-blue: #0d6efd;
        --soft-green: #d1e7dd; --text-green: #0f5132;
        --soft-orange: #ffecb5; --text-orange: #664d03;
        --soft-red: #f8d7da; --text-red: #842029;
        --soft-teal: #e0fbf6; --text-teal: #107c6f;
    }

    [data-theme="dark"] {
        --bg-body: #0f1626;
        --bg-sidebar: #1e293b;
        --bg-card: #2e333f;
        --bg-hover: #2e333f;

        --text-main: #e9ecef;
        --text-muted: #adb5bd;
        --border-color: #767677;

        --soft-blue: rgba(13, 110, 253, 0.15); --text-blue: #6ea8fe;
        --soft-green: rgba(25, 135, 84, 0.15); --text-green: #75b798;
        --soft-orange: rgba(255, 193, 7, 0.15); --text-orange: #ffda6a;
        --soft-red: rgba(220, 53, 69, 0.15); --text-red: #ea868f;
        --soft-teal: rgba(32, 201, 151, 0.15); --text-teal: #a9e5d6;
    }

    /* 1. Profile Header Card */
    .profile-header-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 32px;
        position: relative;
    }

    .profile-avatar-lg {
        width: 80px; height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--bg-card);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        flex-shrink: 0;
    }

    .role-text { color: #0ea5e9; font-weight: 600; font-size: 0.9rem; margin-bottom: 8px; display: block; }

    .badge-public {
        background-color: #10b981; color: white;
        padding: 2px 10px; border-radius: 20px; font-size: 0.7rem; font-weight: 700;
        display: inline-flex; align-items: center; gap: 4px; vertical-align: middle;
    }
    .badge-pro {
        background-color: var(--soft-blue); color: var(--text-blue);
        padding: 2px 10px; border-radius: 20px; font-size: 0.7rem; font-weight: 700;
        margin-left: 8px; vertical-align: middle;
    }

    .portfolio-link {
        display: flex; align-items: center; gap: 8px;
        color: var(--text-blue); text-decoration: none; font-size: 0.85rem;
        margin-top: 12px;
        word-break: break-all; /* Ensures long links wrap */
    }
    .portfolio-link:hover { text-decoration: underline; }

    /* 2. Analytics Cards */
    .analytics-grid {
        display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 32px;
    }
    .analytic-box {
        padding: 24px;
        border-radius: 12px;
        text-align: center;
        border: 1px solid transparent;
        height: 100%;
        display: flex; flex-direction: column; justify-content: center;
    }
    .an-blue { background-color: var(--soft-blue); border-color: rgba(59, 130, 246, 0.2); }
    .an-green { background-color: var(--soft-green); border-color: rgba(16, 185, 129, 0.2); }
    .an-orange { background-color: var(--soft-orange); border-color: rgba(249, 115, 22, 0.2); }
    .an-teal { background-color: var(--soft-teal); border-color: rgba(20, 184, 166, 0.2); }

    .an-val { font-size: 1.8rem; font-weight: 700; color: var(--text-main); line-height: 1.2; margin-bottom: 4px; display: block; }
    .an-blue .an-val { color: var(--text-blue); }
    .an-green .an-val { color: var(--text-green); }
    .an-orange .an-val { color: var(--text-orange); }
    .an-teal .an-val { color: var(--text-teal); }

    .an-icon { font-size: 1.5rem; margin-bottom: 8px; display: block; }
    .an-lbl { font-size: 0.8rem; color: var(--text-muted); font-weight: 500; }

    /* 3. Preview Section */
    .preview-tabs {
        display: flex; gap: 12px; margin-bottom: 24px; overflow-x: auto; padding-bottom: 8px;
        scrollbar-width: thin;
    }
    .preview-tabs::-webkit-scrollbar { height: 4px; }
    .preview-tabs::-webkit-scrollbar-thumb { background: var(--border-color); border-radius: 4px; }

    .p-tab {
        padding: 8px 16px;
        border-radius: 20px;
        border: 1px solid var(--border-color);
        background-color: var(--bg-card);
        color: var(--text-muted);
        font-size: 0.85rem; font-weight: 600;
        cursor: pointer; white-space: nowrap;
        display: flex; align-items: center; gap: 6px;
        transition: 0.2s;
    }
    .p-tab.active { background-color: #0ea5e9; color: white; border-color: #0ea5e9; }
    .p-tab:hover:not(.active) { background-color: var(--soft-blue); color: var(--text-blue); }

    .summary-stats-row {
        display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 24px;
    }
    .ss-box {
        background-color: var(--bg-hover);
        border-radius: 8px; padding: 20px; text-align: center;
    }
    .ss-val { font-size: 1.5rem; font-weight: 700; color: var(--text-main); display: block; }
    .ss-lbl { font-size: 0.8rem; color: var(--text-muted); }

    .ss-blue { background-color: var(--soft-blue); }
    .ss-green { background-color: var(--soft-green); }
    .ss-orange { background-color: var(--soft-orange); }

    /* 4. Section Management */
    .section-list {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        overflow: hidden;
    }
    .section-item {
        display: flex; justify-content: space-between; align-items: center;
        padding: 16px 24px;
        border-bottom: 1px solid var(--border-color);
    }
    .section-item:last-child { border-bottom: none; }

    .sec-title { font-weight: 500; color: var(--text-main); display: flex; align-items: center; gap: 12px; }
    .sec-icon { font-size: 1.1rem; color: var(--text-muted); width: 20px; text-align: center; }

    /* Custom Switch */
    .form-check-input {
        width: 3em; height: 1.5em; cursor: pointer;
        background-color: var(--border-color); border: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e");
    }
    .form-check-input:checked { background-color: #10b981; }
    .form-check-input:focus { box-shadow: none; }

    /* Customize Button */
    .btn-customize {
        position: fixed; bottom: 30px; right: 30px;
        background-color: #0ea5e9; color: white;
        border: none; padding: 12px 24px; border-radius: 30px;
        font-weight: 600; box-shadow: 0 4px 12px rgba(14, 165, 233, 0.4);
        display: flex; align-items: center; gap: 8px; z-index: 100;
        transition: 0.2s;
    }
    .btn-customize:hover { transform: translateY(-2px); background-color: #0284c7; }

    /* --- RESPONSIVE MEDIA QUERIES --- */
    @media(max-width: 991px) {
        /* Tablet: 2 cols for analytics */
        .analytics-grid { grid-template-columns: 1fr 1fr; }
    }

    @media(max-width: 768px) {
        /* Mobile: Header Centering */
        .portfolio-link { justify-content: center; }

        /* Stats on mobile can stay 2 cols or stack. 2 cols (1fr 1fr) is usually fine. */
        .analytics-grid { gap: 12px; }
        .analytic-box { padding: 16px; }

        /* Summary Stats Stack */
        .summary-stats-row { grid-template-columns: 1fr; gap: 12px; }

        /* Section List Padding */
        .section-item { padding: 12px 16px; }

        /* Customize Button */
        .btn-customize { bottom: 20px; right: 20px; }
    }
</style>

<div class="content-body">

    <div class="profile-header-card">
        <div class="d-flex flex-column flex-md-row gap-4 align-items-center align-items-md-start text-center text-md-start">
            <img src="https://ui-avatars.com/api/?name=John+Doe&background=random" class="profile-avatar-lg" alt="Profile">

            <div class="flex-grow-1">
                <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2 mb-1">
                    <h4 class="fw-bold text-main m-0">John Doe</h4>
                </div>
                <span class="role-text">Full Stack Developer & AI Enthusiast</span>
                <div class="mb-3">
                    <span class="badge-public"><i class="bi bi-globe"></i> PUBLIC</span>
                    <span class="badge-pro">Professional</span>
                </div>

                <p class="--text-muted small mb-0" style="max-width: 800px; line-height: 1.6;">
                    Passionate software developer with expertise in Flutter, React, and machine learning. Always eager to learn new technologies and solve complex problems.
                </p>

                <a href="#" class="portfolio-link">
                    <i class="bi bi-link-45deg flex-shrink-0"></i> kickstartskills.edu/portfolio/johndoe-portfolio
                    <i class="bi bi-files ms-2 --text-muted" style="cursor: pointer;"></i>
                </a>

                <small class="--text-muted d-block mt-2" style="font-size: 0.75rem;">Last updated: 9/12/2025</small>
            </div>
        </div>
    </div>

    <h6 class="fw-bold text-main mb-3">Portfolio Analytics</h6>
    <div class="analytics-grid">
        <div class="analytic-box an-blue">
            <i class="bi bi-eye an-icon text-primary"></i>
            <span class="an-val">1247</span>
            <span class="an-lbl">Total Views</span>
        </div>
        <div class="analytic-box an-green">
            <i class="bi bi-graph-up-arrow an-icon text-success"></i>
            <span class="an-val">186</span>
            <span class="an-lbl">Monthly Views</span>
        </div>
        <div class="analytic-box an-orange">
            <i class="bi bi-briefcase an-icon text-warning"></i>
            <span class="an-val">23</span>
            <span class="an-lbl">Employer Views</span>
        </div>
        <div class="analytic-box an-teal">
            <i class="bi bi-download an-icon text-info"></i>
            <span class="an-val">45</span>
            <span class="an-lbl">Downloads</span>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold text-main m-0">Portfolio Preview</h6>
        <button class="btn btn-primary btn-sm rounded-pill px-3"><i class="bi bi-eye me-1"></i> Full Preview</button>
    </div>

    <div class="card-custom border-0 p-0 bg-transparent mb-5">
        <div class="preview-tabs">
            <div class="p-tab active"><i class="bi bi-person"></i> Overview</div>
            <div class="p-tab"><i class="bi bi-folder"></i> Projects</div>
            <div class="p-tab"><i class="bi bi-award"></i> Certificates</div>
            <div class="p-tab"><i class="bi bi-star"></i> Badges</div>
            <div class="p-tab"><i class="bi bi-cpu"></i> Skills</div>
            <div class="p-tab"><i class="bi bi-mortarboard"></i> Education</div>
            <div class="p-tab"><i class="bi bi-envelope"></i> Contact</div>
        </div>

        <div class="p-4 rounded-3 border border-light shadow-sm bg-white" style="background-color: var(--bg-card) !important; border-color: var(--border-color) !important;">
            <h6 class="fw-bold text-main mb-2">Professional Summary</h6>
            <p class="--text-muted small mb-0">
                Passionate software developer with expertise in Flutter, React, and machine learning. Always eager to learn new technologies and solve complex problems.
            </p>

            <div class="summary-stats-row">
                <div class="ss-box ss-blue">
                    <span class="ss-val text-primary">3</span>
                    <span class="ss-lbl --text-muted">Projects</span>
                </div>
                <div class="ss-box ss-green">
                    <span class="ss-val text-success">3</span>
                    <span class="ss-lbl --text-muted">Certificates</span>
                </div>
                <div class="ss-box ss-orange">
                    <span class="ss-val text-warning">3</span>
                    <span class="ss-lbl --text-muted">Badges</span>
                </div>
            </div>
        </div>
    </div>

    <h6 class="fw-bold text-main mb-3">Section Management</h6>
    <div class="section-list">

        <div class="section-item">
            <span class="sec-title"><i class="bi bi-person sec-icon"></i> Overview</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>

        <div class="section-item">
            <span class="sec-title"><i class="bi bi-folder sec-icon"></i> Projects</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>

        <div class="section-item">
            <span class="sec-title"><i class="bi bi-award sec-icon"></i> Certificates</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>

        <div class="section-item">
            <span class="sec-title"><i class="bi bi-star sec-icon"></i> Badges</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>

        <div class="section-item">
            <span class="sec-title"><i class="bi bi-cpu sec-icon"></i> Skills</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>

        <div class="section-item">
            <span class="sec-title"><i class="bi bi-briefcase sec-icon"></i> Experience</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox"> </div>
        </div>

        <div class="section-item">
            <span class="sec-title"><i class="bi bi-mortarboard sec-icon"></i> Education</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>

        <div class="section-item">
            <span class="sec-title"><i class="bi bi-envelope sec-icon"></i> Contact</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>

    </div>

</div>

<button class="btn-customize">
    <i class="bi bi-pencil-square"></i> Customize
</button>

@endsection
