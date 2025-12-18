@extends('frontend.hrPortal.dashboard.layouts.app')

@section('title', 'Corporate Drive')

@section('icon', 'bi bi-bullseye fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')
<style>
    /* --- Page Specific Styles --- */

    /* Custom Tabs - Responsive Scroll */
    .nav-tabs-custom {
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 24px;
        display: flex;
        gap: 24px;
        /* Mobile Scroll Logic */
        overflow-x: auto;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch; /* Smooth scroll on iOS */
        padding-bottom: 8px; /* Space for scrollbar if visible */
    }

    /* Hide Scrollbar for clean UI */
    .nav-tabs-custom::-webkit-scrollbar { display: none; }
    .nav-tabs-custom { -ms-overflow-style: none; scrollbar-width: none; }

    .nav-link-custom {
        background: none;
        border: none;
        color: var(--text-muted);
        padding: 12px 4px;
        font-weight: 500;
        position: relative;
        cursor: pointer;
        transition: color 0.2s;
        flex-shrink: 0; /* Prevent shrinking on mobile */
    }

    .nav-link-custom:hover { color: var(--text-main); }

    .nav-link-custom.active {
        color: var(--accent-color);
    }

    .nav-link-custom.active::after {
        content: '';
        position: absolute;
        bottom: -1px; left: 0; width: 100%;
        height: 2px;
        background-color: var(--accent-color);
        border-radius: 2px 2px 0 0;
    }

    .badge-count {
        font-size: 0.7rem;
        padding: 2px 8px;
        border-radius: 10px;
        background-color: var(--bg-hover);
        color: var(--text-muted);
        margin-left: 6px;
    }
    .nav-link-custom.active .badge-count {
        background-color: var(--soft-accent);
        color: var(--accent-color);
    }

    /* Search & Filter */
    .filter-bar {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 8px;
        /* Responsive Flex handled in HTML classes now, styles kept for base */
    }

    .search-input {
        background: transparent;
        border: none;
        color: var(--text-main);
        width: 100%;
        outline: none;
        padding: 8px 0; /* Added padding for touch targets */
    }

    .filter-btn {
        background: transparent;
        border: none;
        color: var(--text-muted);
        padding: 8px 12px;
        display: flex; align-items: center; gap: 6px;
        font-size: 0.9rem;
        transition: color 0.2s;
        white-space: nowrap; /* Keep button text on one line */
    }
    .filter-btn:hover { color: var(--text-main); }

    /* Drive Card */
    .drive-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 16px;
        transition: border-color 0.2s;
    }
    .drive-card:hover {
        border-color: var(--accent-color);
    }

    /* Stat Pills inside Card */
    .stat-pill {
        font-size: 0.75rem;
        padding: 6px 12px;
        border-radius: 6px;
        display: inline-flex; align-items: center; gap: 6px;
        font-weight: 500;
    }
    .pill-blue { background-color: rgba(59, 130, 246, 0.1); color: #3b82f6; }
    .pill-green { background-color: rgba(16, 185, 129, 0.1); color: #10b981; }
    .pill-purple { background-color: rgba(139, 92, 246, 0.1); color: #8b5cf6; }

    /* Status Badges */
    .status-badge {
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        white-space: nowrap;
    }
    .status-draft { background-color: rgba(245, 158, 11, 0.1); color: #f59e0b; }
    .status-published { background-color: rgba(59, 130, 246, 0.1); color: #3b82f6; }
    .status-active { background-color: rgba(16, 185, 129, 0.1); color: #10b981; }

    /* Floating Action Button */
    .fab-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background-color: var(--accent-color);
        color: white;
        padding: 12px 24px;
        border-radius: 30px;
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.4);
        border: none;
        display: flex; align-items: center; gap: 8px;
        font-weight: 600;
        z-index: 100;
        transition: transform 0.2s;
    }
    .fab-btn:hover { transform: translateY(-2px); color: white; }

    @media (max-width: 576px) {
        .fab-btn {
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            font-size: 0.9rem;
        }
    }
</style>

<div class="nav-tabs-custom filter-bar border-0 bg-transparent p-0">
    <button class="nav-link-custom active">All <span class="badge-count">15</span></button>
    <button class="nav-link-custom">Draft <span class="badge-count">3</span></button>
    <button class="nav-link-custom">Published <span class="badge-count">2</span></button>
    <button class="nav-link-custom">Active <span class="badge-count">2</span></button>
    <button class="nav-link-custom">Completed <span class="badge-count">2</span></button>
</div>

<div class="filter-bar d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 mb-4">
    <div class="d-flex align-items-center flex-grow-1">
        <i class="bi bi-search --text-muted fs-5 ms-2"></i>
        <input type="text" class="search-input ms-2" placeholder="Search drives...">
    </div>

    <div class="vr mx-2 d-none d-md-block" style="color: var(--border-color); opacity: 1;"></div>
    <hr class="d-md-none my-1" style="color: var(--border-color);">

    <div class="d-flex justify-content-between justify-content-md-end gap-2">
        <button class="filter-btn">
            <select class="filter-btn">
            <option>Latest First</option>
            <option>Oldest First</option>
            <option>Most Applications</option>
            <option>Most Positions</option>
            <option>Title A-Z</option>
        </select>
        </button>
        <div class="d-flex gap-1">
            <button class="filter-btn"><i class="bi bi-funnel"></i></button>
            <button class="filter-btn"><i class="bi bi-arrow-clockwise"></i></button>
        </div>
    </div>
</div>

<div class="d-flex flex-column">

    <div class="drive-card">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start mb-3 gap-2">
            <div>
                <h5 class="fw-bold text-main mb-1">Corporate Internship Program 1</h5>
                <div class="d-flex align-items-center flex-wrap gap-3 --text-muted small">
                    <span><i class="bi bi-building me-1"></i> TechCorp Solutions</span>
                    <span><i class="bi bi-tag me-1"></i> Internship</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3 w-100 w-sm-auto justify-content-between justify-content-sm-end">
                <span class="status-badge status-draft">Draft</span>
                <button class="btn btn-link --text-muted p-0"><i class="bi bi-three-dots-vertical"></i></button>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2 mb-4">
            <span class="stat-pill pill-blue"><i class="bi bi-people"></i> 25 Positions</span>
            <span class="stat-pill pill-green"><i class="bi bi-file-earmark-text"></i> 0 Applications</span>
            <span class="stat-pill pill-purple"><i class="bi bi-check-circle"></i> 0 Selected</span>
        </div>

        <div class="row align-items-end g-3">
            <div class="col-12 col-md-8">
                <div class="--text-muted small mb-1">Institutions: <span class="text-main">3</span></div>
                <div class="--text-muted small mb-1">Locations: <span class="text-main">Bangalore, Mumbai, Delhi</span></div>
                <div class="small fw-bold mt-2" style="color: #10b981;">Package: ₹25,000/monthly</div>
            </div>
            <div class="col-12 col-md-4 text-start text-md-end">
                <span class="text-muted small">Created 17/12/2025</span>
            </div>
        </div>
    </div>

    <div class="drive-card">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start mb-3 gap-2">
            <div>
                <h5 class="fw-bold text-main mb-1">Corporate Apprenticeship Program 2</h5>
                <div class="d-flex align-items-center flex-wrap gap-3 --text-muted small">
                    <span><i class="bi bi-building me-1"></i> TechCorp Solutions</span>
                    <span><i class="bi bi-award me-1"></i> Apprenticeship</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3 w-100 w-sm-auto justify-content-between justify-content-sm-end">
                <span class="status-badge status-published">Published</span>
                <button class="btn btn-link --text-muted p-0"><i class="bi bi-three-dots-vertical"></i></button>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2 mb-4">
            <span class="stat-pill pill-blue"><i class="bi bi-people"></i> 30 Positions</span>
            <span class="stat-pill pill-green"><i class="bi bi-file-earmark-text"></i> 12 Applications</span>
            <span class="stat-pill pill-purple"><i class="bi bi-check-circle"></i> 2 Selected</span>
        </div>

        <div class="row align-items-end g-3">
            <div class="col-12 col-md-8">
                <div class="--text-muted small mb-1">Institutions: <span class="text-main">3</span></div>
                <div class="--text-muted small mb-1">Locations: <span class="text-main">Bangalore, Mumbai, Delhi</span></div>
                <div class="small fw-bold mt-2" style="color: #10b981;">Package: ₹30,000/monthly</div>
            </div>
            <div class="col-12 col-md-4 text-start text-md-end">
                <span class="text-muted small">Created 15/12/2025</span>
            </div>
        </div>
    </div>

</div>

<button class="fab-btn">
    <i class="bi bi-plus-lg"></i> New Drive
</button>

@endsection
