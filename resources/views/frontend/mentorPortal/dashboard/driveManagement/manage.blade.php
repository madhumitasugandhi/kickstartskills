@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Manage Drives')
@section('icon', 'bi bi-hdd-network fs-4 p-2 bg-soft-orange rounded-3 text-accent')

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

    /* Card Styling */
    .card-custom {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        transition: transform 0.2s;
    }

    /* Stats Cards */
    .stat-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 140px;
        position: relative;
    }
    .stat-icon-wrapper {
        width: 40px; height: 40px;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem;
        margin-bottom: 12px;
    }
    .stat-val { font-size: 1.8rem; font-weight: 700; color: var(--text-blue); line-height: 1; margin-bottom: 4px; }
    .stat-lbl { font-size: 0.8rem; color: var(--text-muted); }
    .trend-icon { position: absolute; top: 20px; right: 20px; font-size: 1rem; }

    /* Filter Tabs */
    .filter-tabs-container {
        display: flex;
        gap: 20px;
        overflow-x: auto;
        padding-bottom: 4px;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 20px;
        scrollbar-width: thin;
    }
    .filter-tab {
        background: none; border: none;
        color: var(--text-muted);
        font-size: 0.9rem; font-weight: 500;
        padding: 10px 4px;
        position: relative;
        white-space: nowrap;
    }
    .filter-tab.active { color: var(--text-blue); font-weight: 600; }
    .filter-tab.active::after {
        content: ''; position: absolute; bottom: -5px; left: 0; right: 0;
        height: 2px; background-color: var(--text-blue);
    }
    .tab-count {
        background-color: var(--soft-blue); color: var(--text-blue);
        font-size: 0.7rem; padding: 2px 6px; border-radius: 4px; margin-left: 6px;
    }

    /* Drive Card */
    .drive-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 24px;
        margin-bottom: 16px;
        transition: box-shadow 0.2s;
    }
    .drive-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.05); }

    .drive-icon {
        width: 48px; height: 48px;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .status-badge {
        font-size: 0.75rem; padding: 4px 12px; border-radius: 20px; font-weight: 600;
        white-space: nowrap;
    }
    .bg-badge-blue { background-color: var(--soft-blue); color: var(--text-blue); }
    .bg-badge-orange { background-color: var(--soft-orange); color: var(--text-orange); }

    .meta-item {
        display: flex; align-items: center; gap: 8px;
        font-size: 0.85rem; color: var(--text-muted);
    }
    .meta-item i { font-size: 1rem; }

    .action-link {
        font-size: 0.9rem; font-weight: 500; text-decoration: none;
        display: inline-flex; align-items: center; gap: 6px;
        margin-right: 16px;
    }
    .link-blue { color: var(--text-blue); }
    .link-green { color: var(--text-green); }
    .link-muted { color: var(--text-muted); }

    /* Responsive Tweaks */
    @media(max-width: 768px) {
        .stat-card { min-height: 120px; padding: 16px; }
        .filter-tabs-container { gap: 15px; }
        .meta-grid { row-gap: 12px; }
    }
</style>

<div class="content-body">

    <div class="card-custom mb-4" style="padding: 24px;">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
            <div>
                <h4 class="fw-bold text-main mb-1">Drive Management</h4>
                <p class="text-muted-custom mb-0 small">Manage your internship drives and track applications</p>
            </div>
            <button class="btn btn-primary fw-bold px-4 w-100 w-md-auto" style="background-color: var(--text-blue); border: none;">
                <i class="bi bi-plus-lg me-2"></i> Create Drive
            </button>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3">
            <div class="card-custom stat-card h-100">
                <i class="bi bi-graph-up-arrow trend-icon text-success"></i>
                <div class="stat-icon-wrapper bg-soft-blue text-blue">
                    <i class="bi bi-briefcase"></i>
                </div>
                <div>
                    <span class="stat-val">3</span>
                    <span class="stat-lbl d-block">Total Drives</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="card-custom stat-card h-100">
                <i class="bi bi-graph-up-arrow trend-icon text-success"></i>
                <div class="stat-icon-wrapper bg-soft-green text-green">
                    <i class="bi bi-play-fill"></i>
                </div>
                <div>
                    <span class="stat-val text-green">2</span>
                    <span class="stat-lbl d-block">Active Drives</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="card-custom stat-card h-100">
                <i class="bi bi-graph-up-arrow trend-icon text-success"></i>
                <div class="stat-icon-wrapper bg-soft-blue text-blue">
                    <i class="bi bi-people"></i>
                </div>
                <div>
                    <span class="stat-val">54</span>
                    <span class="stat-lbl d-block">Total Applications</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="card-custom stat-card h-100">
                <i class="bi bi-graph-up-arrow trend-icon text-success"></i>
                <div class="stat-icon-wrapper bg-soft-orange text-orange">
                    <i class="bi bi-person-check"></i>
                </div>
                <div>
                    <span class="stat-val text-orange">4</span>
                    <span class="stat-lbl d-block">Selected Students</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card-custom mb-4 p-0 border-0 bg-transparent">
        <div class="filter-tabs-container">
            <button class="filter-tab active">All Drives <span class="tab-count">3</span></button>
            <button class="filter-tab">Draft</button>
            <button class="filter-tab">Published</button>
            <button class="filter-tab">Active</button>
            <button class="filter-tab">Completed</button>
        </div>

        <div class="row g-3">
            <div class="col-12 col-md-9">
                <div class="input-group">
                    <span class="input-group-text bg-card border-end-0" style="background-color: var(--bg-card); border-color: var(--border-color);">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 ps-0" placeholder="Search drives..."
                        style="background-color: var(--bg-card); border-color: var(--border-color); color: var(--text-main);">
                </div>
            </div>
            <div class="col-12 col-md-3">
                <select class="form-select" style="background-color: var(--bg-card); border-color: var(--border-color); color: var(--text-main);">
                    <option>Newest</option>
                    <option>Oldest</option>
                    <option>Most Applications</option>
                </select>
            </div>
        </div>
    </div>

    <div class="drive-card">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start gap-3 mb-3">
            <div class="d-flex gap-3">
                <div class="drive-icon bg-soft-blue text-blue">
                    <i class="bi bi-laptop"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-main mb-1">Frontend Development Internship</h6>
                    <small class="text-muted-custom">Tech Innovations Inc. • Internship</small>
                </div>
            </div>
            <span class="status-badge bg-badge-blue">Applications Open</span>
        </div>

        <p class="text-muted-custom small mb-4" style="line-height: 1.6;">
            Work on modern React applications with experienced developers. Learn industry best practices and build real-world projects.
        </p>

        <div class="row g-3 mb-4 meta-grid">
            <div class="col-6 col-md-3 meta-item">
                <i class="bi bi-people --text-muted"></i> 23 Applications
            </div>
            <div class="col-6 col-md-3 meta-item">
                <i class="bi bi-person-check --text-muted"></i> 0 Selected
            </div>
            <div class="col-6 col-md-3 meta-item">
                <i class="bi bi-geo-alt --text-muted"></i> Bangalore, India
            </div>
            <div class="col-6 col-md-3 meta-item">
                <i class="bi bi-calendar --text-muted"></i> 12 weeks
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center border-top pt-3" style="border-color: var(--border-color) !important;">
            <div class="d-flex flex-wrap gap-2">
                <a href="#" class="action-link link-blue"><i class="bi bi-people"></i> Applications (23)</a>
                <a href="#" class="action-link link-green"><i class="bi bi-bar-chart"></i> Analytics</a>
            </div>
            <div class="dropdown">
                <button class="btn btn-link --text-muted p-0" data-bs-toggle="dropdown">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Edit</a></li>
                    <li><a class="dropdown-item" href="#">Close Drive</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="drive-card">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start gap-3 mb-3">
            <div class="d-flex gap-3">
                <div class="drive-icon bg-soft-orange text-orange">
                    <i class="bi bi-phone"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-main mb-1">Mobile App Development - Flutter</h6>
                    <small class="text-muted-custom">Tech Innovations Inc. • Internship</small>
                </div>
            </div>
            <span class="status-badge bg-badge-orange">Draft</span>
        </div>

        <p class="text-muted-custom small mb-4" style="line-height: 1.6;">
            Build cross-platform mobile applications using Flutter. Mentorship includes code reviews and industry insights.
        </p>

        <div class="row g-3 mb-4 meta-grid">
            <div class="col-6 col-md-3 meta-item">
                <i class="bi bi-people --text-muted"></i> 0 Applications
            </div>
            <div class="col-6 col-md-3 meta-item">
                <i class="bi bi-person-check --text-muted"></i> 0 Selected
            </div>
            <div class="col-6 col-md-3 meta-item">
                <i class="bi bi-geo-alt --text-muted"></i> Mumbai, India
            </div>
            <div class="col-6 col-md-3 meta-item">
                <i class="bi bi-calendar --text-muted"></i> 12 weeks
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center border-top pt-3" style="border-color: var(--border-color) !important;">
            <div class="d-flex flex-wrap gap-2">
                <a href="#" class="action-link link-muted"><i class="bi bi-pencil-square"></i> Edit</a>
                <a href="#" class="action-link link-green"><i class="bi bi-bar-chart"></i> Analytics</a>
            </div>
            <div class="dropdown">
                <button class="btn btn-link --text-muted p-0" data-bs-toggle="dropdown">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Publish</a></li>
                    <li><a class="dropdown-item" href="#">Delete</a></li>
                </ul>
            </div>
        </div>
    </div>

</div>
@endsection
