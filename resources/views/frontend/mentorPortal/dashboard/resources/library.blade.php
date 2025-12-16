@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Resource Library')
@section('icon', 'bi bi-collection fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')
<style>
    /* Theme Variables */
    :root {
        --bg-card: #ffffff;
        --text-main: #343a40;
        --text-muted: #6c757d;
        --border-color: #e9ecef;

        --soft-blue: #e7f1ff;
        --text-blue: #0d6efd;
        --soft-green: #d1e7dd;
        --text-green: #0f5132;
        --soft-orange: #ffecb5;
        --text-orange: #664d03;
        --soft-red: #f8d7da;
        --text-red: #842029;
    }

    [data-theme="dark"] {
        --bg-card: #2e333f;
        --text-main: #e9ecef;
        --text-muted: #94a3b8;
        --border-color: #334155;

        --soft-blue: rgba(13, 110, 253, 0.15);
        --text-blue: #6ea8fe;
        --soft-green: rgba(25, 135, 84, 0.15);
        --text-green: #75b798;
        --soft-orange: rgba(255, 193, 7, 0.15);
        --text-orange: #ffda6a;
        --soft-red: rgba(220, 53, 69, 0.15);
        --text-red: #ea868f;
    }

    /* 1. Stats Cards */
    .stat-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        text-align: center;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transition: transform 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-2px);
    }

    .stat-icon {
        font-size: 1.5rem;
        margin-bottom: 12px;
        color: var(--text-blue);
    }

    .stat-val {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 4px;
    }

    .stat-lbl {
        font-size: 0.75rem;
        color: var(--text-muted);
        font-weight: 500;
    }

    /* 2. Filter Section */
    .filter-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 24px;
    }

    /* 3. Resource Card */
    .res-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.2s;
        position: relative;
    }

    .res-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .res-icon-box {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        margin-bottom: 16px;
    }

    .icon-doc {
        background-color: var(--soft-blue);
        color: var(--text-blue);
    }

    .icon-video {
        background-color: var(--soft-red);
        color: var(--text-red);
    }

    .icon-workshop {
        background-color: var(--soft-green);
        color: var(--text-green);
    }

    .res-status {
        position: absolute;
        top: 24px;
        right: 24px;
        font-size: 0.65rem;
        padding: 4px 10px;
        border-radius: 20px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .st-public {
        background-color: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .st-private {
        background-color: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    .res-title {
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 8px;
        font-size: 1rem;
    }

    .res-desc {
        color: var(--text-muted);
        font-size: 0.85rem;
        line-height: 1.5;
        margin-bottom: 16px;
        flex-grow: 1;
    }

    .tag-container {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .res-tag {
        font-size: 0.7rem;
        padding: 2px 8px;
        border-radius: 4px;
        background-color: var(--bg-hover);
        color: var(--text-muted);
        border: 1px solid var(--border-color);
    }

    .res-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.75rem;
        color: var(--text-muted);
        border-top: 1px solid var(--border-color);
        padding-top: 16px;
    }

    .level-badge {
        font-size: 0.65rem;
        padding: 2px 8px;
        border-radius: 4px;
        font-weight: 600;
    }

    .lvl-beg {
        background-color: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .lvl-adv {
        background-color: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    .lvl-int {
        background-color: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    /* Responsive Tweaks */
    @media(max-width: 991px) {
        .stat-card {
            padding: 16px;
        }
    }
</style>

<div class="content-body">

    <div class="card-custom mb-4"
        style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 20px;">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <div class="fs-4 p-2 bg-soft-orange rounded-3 text-accent">
                    <i class="bi bi-collection fs-3"></i>
                </div>
                <div>
                    <h4 class="fw-bold text-main mb-1">Resource Library</h4>
                    <p class="text-muted-custom mb-0 small">Manage and share educational resources with your students
                    </p>
                </div>
            </div>
            <button class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center p-0"
                style="width: 40px; height: 40px; background-color: var(--accent-color); border: none;">
                <i class="bi bi-upload fs-5"></i>
            </button>
        </div>
    </div>

    <div class="filter-card">
        <h6 class="fw-bold text-main mb-3">Filters & Search</h6>
        <div class="row g-3">
            <div class="col-12 col-md-5">
                <div class="input-group">
                    <span class="input-group-text border-end-0"
                        style="background-color: var(--bg-card); border-color: var(--border-color); color: var(--text-muted);">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 ps-0" placeholder="Search resources..."
                        style="background-color: var(--bg-card); border-color: var(--border-color); color: var(--text-main);">
                </div>
            </div>
            <div class="col-12 col-md-2">
                <select class="form-select"
                    style="background-color: var(--bg-card); border-color: var(--border-color); color: var(--text-main);">
                    <option>All Categories</option>
                    <option>Frontend</option>
                    <option>Backend</option>
                    <option>Design</option>
                </select>
            </div>
            <div class="col-12 col-md-2">
                <select class="form-select"
                    style="background-color: var(--bg-card); border-color: var(--border-color); color: var(--text-main);">
                    <option>All Formats</option>
                    <option>PDF</option>
                    <option>Video</option>
                    <option>Interactive</option>
                </select>
            </div>
            <div class="col-12 col-md-3">
                <button class="btn btn-primary w-100 fw-bold" style="background-color: var(--accent-color); border: none;">
                    <i class="bi bi-gear me-2"></i> Bulk Actions
                </button>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-md-4 col-xl">
            <div class="stat-card">
                <i class="bi bi-folder stat-icon text-primary"></i>
                <span class="stat-val text-primary">6</span>
                <span class="stat-lbl">Total Resources</span>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl">
            <div class="stat-card">
                <i class="bi bi-download stat-icon text-success"></i>
                <span class="stat-val text-success">838</span>
                <span class="stat-lbl">Total Downloads</span>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl">
            <div class="stat-card">
                <i class="bi bi-globe stat-icon text-info"></i>
                <span class="stat-val text-info">4</span>
                <span class="stat-lbl">Public Resources</span>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl">
            <div class="stat-card">
                <i class="bi bi-lock stat-icon text-warning"></i>
                <span class="stat-val text-warning">2</span>
                <span class="stat-lbl">Private Resources</span>
            </div>
        </div>
        <div class="col-12 col-md-4 col-xl">
            <div class="stat-card">
                <i class="bi bi-graph-up stat-icon text-primary"></i>
                <span class="stat-val text-primary">140</span>
                <span class="stat-lbl">Avg Downloads</span>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold text-main m-0">Resources (6)</h6>
        <div class="d-flex gap-2 text-muted">
            <i class="bi bi-arrow-repeat cursor-pointer"></i>
            <i class="bi bi-bar-chart cursor-pointer"></i>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-12 col-md-6 col-xl-4">
            <div class="res-card">
                <span class="res-status st-public">Public</span>
                <div class="d-flex justify-content-between">
                    <div class="res-icon-box icon-doc"><i class="bi bi-file-text"></i></div>
                    <i class="bi bi-three-dots-vertical text-muted cursor-pointer"></i>
                </div>

                <h6 class="res-title">React Fundamentals Guide</h6>
                <p class="res-desc">Comprehensive guide covering React basics, components, state management, and hooks.
                </p>

                <div class="tag-container">
                    <span class="res-tag">React</span>
                    <span class="res-tag">Frontend</span>
                    <span class="res-tag">JavaScript</span>
                </div>

                <div class="res-footer mt-auto">
                    <div class="d-flex gap-3">
                        <span><i class="bi bi-download me-1"></i> 145</span>
                        <span><i class="bi bi-clock me-1"></i> 2 hours</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="level-badge lvl-beg">Beginner</span>
                        <span class="text-muted fw-bold small">2.5 MB</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-4">
            <div class="res-card">
                <span class="res-status st-private">Private</span>
                <div class="d-flex justify-content-between">
                    <div class="res-icon-box icon-video"><i class="bi bi-camera-video"></i></div>
                    <i class="bi bi-three-dots-vertical text-muted cursor-pointer"></i>
                </div>

                <h6 class="res-title">Advanced JavaScript Patterns</h6>
                <p class="res-desc">Deep dive into advanced JavaScript concepts, design patterns, and best practices.
                </p>

                <div class="tag-container">
                    <span class="res-tag">JavaScript</span>
                    <span class="res-tag">Advanced</span>
                    <span class="res-tag">Patterns</span>
                </div>

                <div class="res-footer mt-auto">
                    <div class="d-flex gap-3">
                        <span><i class="bi bi-download me-1"></i> 89</span>
                        <span><i class="bi bi-clock me-1"></i> 3.5 hours</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="level-badge lvl-adv">Advanced</span>
                        <span class="text-muted fw-bold small">125 MB</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-4">
            <div class="res-card">
                <span class="res-status st-public">Public</span>
                <div class="d-flex justify-content-between">
                    <div class="res-icon-box icon-workshop"><i class="bi bi-display"></i></div>
                    <i class="bi bi-three-dots-vertical text-muted cursor-pointer"></i>
                </div>

                <h6 class="res-title">CSS Grid Layout Workshop</h6>
                <p class="res-desc">Interactive workshop materials for mastering CSS Grid layout system.</p>

                <div class="tag-container">
                    <span class="res-tag">CSS</span>
                    <span class="res-tag">Grid</span>
                    <span class="res-tag">Layout</span>
                </div>

                <div class="res-footer mt-auto">
                    <div class="d-flex gap-3">
                        <span><i class="bi bi-download me-1"></i> 67</span>
                        <span><i class="bi bi-clock me-1"></i> 1.5 hours</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="level-badge lvl-int">Intermediate</span>
                        <span class="text-muted fw-bold small">15 MB</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
