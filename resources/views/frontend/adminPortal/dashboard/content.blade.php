@extends('frontend.adminPortal.dashboard.layouts.app')

@section('title', 'Content Management')

@section('icon', 'bi-file-text')

@section('content')
<style>
    /* --- Content Page Styles --- */

    /* Stats Row */
    .content-stat-card {
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

    .stat-icon-sm { font-size: 1.2rem; margin-bottom: 8px; display: inline-block; }
    .stat-val-lg { font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin-bottom: 2px; }
    .stat-lbl-sm { font-size: 0.85rem; color: var(--text-muted); }
    .stat-badge-top { position: absolute; top: 15px; right: 15px; font-size: 0.7rem; padding: 2px 6px; border-radius: 4px; font-weight: 600; }

    /* Navigation Tabs */
    .content-tabs {
        display: flex; gap: 8px; margin-bottom: 24px;
        overflow-x: auto; white-space: nowrap;
        padding-bottom: 4px;
    }
    .content-tabs::-webkit-scrollbar { height: 0px; background: transparent; }

    .content-tab-btn {
        background: transparent; border: 1px solid transparent;
        color: var(--text-muted); padding: 8px 16px; border-radius: 6px;
        font-size: 0.9rem; font-weight: 500; cursor: pointer; transition: 0.2s;
        display: flex; align-items: center; gap: 8px;
    }
    .content-tab-btn:hover { color: var(--text-main); background-color: var(--bg-hover); }
    .content-tab-btn.active { background-color: rgba(220, 38, 38, 0.1); color: #dc2626; border-color: rgba(220, 38, 38, 0.2); }

    /* Search & Filter Bar */
    .filter-bar-content {
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

    .filter-btn-pill {
        background: transparent; border: 1px solid var(--border-color);
        color: var(--text-muted); padding: 6px 14px; border-radius: 20px;
        font-size: 0.8rem; transition: 0.2s; cursor: pointer;
        display: inline-block; margin-bottom: 4px;
    }
    .filter-btn-pill:hover, .filter-btn-pill.active {
        background-color: rgba(220, 38, 38, 0.1);
        border-color: #dc2626; color: #dc2626;
    }

    /* Content List & Analytics Containers */
    .content-container {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
    }

    .content-item {
        padding: 20px 0;
        border-bottom: 1px solid var(--border-color);
        display: flex; flex-direction: column; gap: 12px;
        transition: 0.2s;
    }
    @media (min-width: 768px) {
        .content-item { flex-direction: row; align-items: start; justify-content: space-between; gap: 0; }
    }
    .content-item:last-child { border-bottom: none; }
    .content-item:hover {
        background-color: rgba(255,255,255,0.02);
        margin: 0 -10px; padding-left: 10px; padding-right: 10px; border-radius: 8px;
    }

    .content-icon {
        width: 40px; height: 40px; border-radius: 8px;
        background-color: rgba(255,255,255,0.05);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem; color: var(--text-muted);
        margin-right: 16px; flex-shrink: 0;
    }

    /* Tags & Labels */
    .status-tag { font-size: 0.65rem; font-weight: 700; text-transform: uppercase; }
    .tag-published { color: #10b981; }
    .tag-draft { color: #f59e0b; }
    .tag-scheduled { color: #3b82f6; }

    .category-label {
        font-size: 0.7rem; font-weight: 600; text-transform: uppercase;
        display: block; text-align: right; margin-bottom: 4px;
    }
    @media(max-width: 768px) { .category-label { text-align: left; display: inline-block; margin-right: 8px; } }

    /* Analytics Specific */
    .perf-item {
        display: flex; justify-content: space-between; align-items: center;
        padding: 12px 0; border-bottom: 1px solid var(--border-color);
    }
    .perf-item:last-child { border-bottom: none; }

    .perf-val { font-weight: 700; color: #10b981; }

    /* Activity Specific */
    .activity-row {
        display: flex; gap: 16px; padding: 16px 0; border-bottom: 1px solid var(--border-color);
    }
    .activity-row:last-child { border-bottom: none; }
    .activity-icon {
        width: 32px; height: 32px; border-radius: 50%;
        background: rgba(255,255,255,0.05); display: flex; align-items: center; justify-content: center;
        font-size: 0.9rem; flex-shrink: 0;
    }

</style>

<div class="row g-4 mb-4">
    <div class="col-6 col-md-4 col-xl-2">
        <div class="content-stat-card">
            <span class="stat-badge-top text-success bg-soft-green">+12</span>
            <i class="bi bi-file-earmark-text stat-icon-sm text-danger"></i>
            <div class="stat-val-lg">247</div>
            <div class="stat-lbl-sm">Total Content</div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="content-stat-card">
            <span class="stat-badge-top text-success bg-soft-green">+8</span>
            <i class="bi bi-eye stat-icon-sm" style="color: #10b981;"></i>
            <div class="stat-val-lg">189</div>
            <div class="stat-lbl-sm">Published</div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="content-stat-card">
            <span class="stat-badge-top text-success bg-soft-green">+5</span>
            <i class="bi bi-pencil-square stat-icon-sm" style="color: #f59e0b;"></i>
            <div class="stat-val-lg">34</div>
            <div class="stat-lbl-sm">Drafts</div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="content-stat-card">
            <span class="stat-badge-top text-success bg-soft-green">+3</span>
            <i class="bi bi-clock-history stat-icon-sm" style="color: #3b82f6;"></i>
            <div class="stat-val-lg">12</div>
            <div class="stat-lbl-sm">Scheduled</div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="content-stat-card">
            <span class="stat-badge-top text-success bg-soft-green">+15%</span>
            <i class="bi bi-graph-up stat-icon-sm" style="color: #3b82f6;"></i>
            <div class="stat-val-lg">89.5K</div>
            <div class="stat-lbl-sm">Total Views</div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="content-stat-card">
            <span class="stat-badge-top text-success bg-soft-green">+23%</span>
            <i class="bi bi-bar-chart stat-icon-sm" style="color: #3b82f6;"></i>
            <div class="stat-val-lg">23.8K</div>
            <div class="stat-lbl-sm">Monthly Views</div>
        </div>
    </div>
</div>

<div class="content-tabs">
    <button class="content-tab-btn active" onclick="switchContentTab('content')"><i class="bi bi-file-earmark-text"></i> Content</button>
    <button class="content-tab-btn" onclick="switchContentTab('analytics')"><i class="bi bi-bar-chart-line"></i> Analytics</button>
    <button class="content-tab-btn" onclick="switchContentTab('activity')"><i class="bi bi-activity"></i> Activity</button>
</div>

<div id="tab-content" class="tab-content-block">
    <div class="filter-bar-content">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mb-3">
            <div class="input-group w-100" style="max-width: 600px;">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 --text-muted"></i>
                <input type="text" class="search-input-drive ps-5"
                    placeholder="Search content by title, author, or tags...">
            </div>
            <button class="btn btn-danger text-white d-flex align-items-center justify-content-center gap-2 px-4 w-100 w-md-auto">
                <i class="bi bi-plus-lg"></i> Create
            </button>
        </div>

        <div class="d-flex flex-wrap align-items-center gap-2">
            <span class="--text-muted small me-2"><i class="bi bi-funnel"></i> Filters:</span>
            <span class="filter-btn-pill active">All</span>
            <span class="filter-btn-pill">Articles</span>
            <span class="filter-btn-pill">Announcements</span>
            <span class="filter-btn-pill">Policies</span>
            <span class="filter-btn-pill">FAQs</span>
            <span class="filter-btn-pill">Media</span>
            <div class="vr mx-2 --text-muted d-none d-md-block"></div>
            <span class="filter-btn-pill">Published</span>
            <span class="filter-btn-pill">Draft</span>
            <span class="filter-btn-pill">Archived</span>
            <span class="filter-btn-pill">Scheduled</span>
        </div>
    </div>

    <div class="content-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h6 class="fw-bold text-main m-0"><i class="bi bi-file-earmark-richtext me-2 text-danger"></i> Content Library (3 items)</h6>
            <i class="bi bi-three-dots-vertical --text-muted cursor-pointer"></i>
        </div>

        <div class="content-item">
            <div class="d-flex align-items-start">
                <div class="content-icon text-primary"><i class="bi bi-file-earmark-text-fill"></i></div>
                <div>
                    <h6 class="fw-bold text-main mb-1">Welcome to KickStartSkills Platform</h6>
                    <p class="--text-muted small mb-1 opacity-75">Welcome to our comprehensive platform connecting students with real-world opportunities...</p>
                    <div class="d-flex align-items-center gap-3 --text-muted small mt-2">
                        <span><i class="bi bi-eye me-1"></i> 15.4K views</span>
                        <span><i class="bi bi-calendar3 me-1"></i> 30/1/2024</span>
                        <span><i class="bi bi-person me-1"></i> Admin User</span>
                    </div>
                </div>
            </div>
            <div class="text-md-end w-100 w-md-auto d-flex flex-row flex-md-column justify-content-between align-items-center align-items-md-end mt-2 mt-md-0">
                <div>
                    <span class="category-label" style="color: #3b82f6;"><i class="bi bi-star-fill text-warning me-1"></i> Article</span>
                    <span class="status-tag tag-published">Published</span>
                </div>
                <div class="mt-md-2 --text-muted small">#welcome #platform</div>
            </div>
        </div>

        <div class="content-item">
            <div class="d-flex align-items-start">
                <div class="content-icon text-warning"><i class="bi bi-megaphone-fill"></i></div>
                <div>
                    <h6 class="fw-bold text-main mb-1">New Feature: Enhanced Skill Matching</h6>
                    <p class="--text-muted small mb-1 opacity-75">We're excited to announce our new AI powered skill matching algorithm...</p>
                    <div class="d-flex align-items-center gap-3 --text-muted small mt-2">
                        <span><i class="bi bi-eye me-1"></i> 8.9K views</span>
                        <span><i class="bi bi-calendar3 me-1"></i> 28/1/2024</span>
                        <span><i class="bi bi-person me-1"></i> Product Team</span>
                    </div>
                </div>
            </div>
            <div class="text-md-end w-100 w-md-auto d-flex flex-row flex-md-column justify-content-between align-items-center align-items-md-end mt-2 mt-md-0">
                <div>
                    <span class="category-label" style="color: #f59e0b;">Announcement</span>
                    <span class="status-tag tag-published">Published</span>
                </div>
                <div class="mt-md-2 --text-muted small">#features #update</div>
            </div>
        </div>

        <div class="content-item">
            <div class="d-flex align-items-start">
                <div class="content-icon text-danger"><i class="bi bi-shield-lock-fill"></i></div>
                <div>
                    <h6 class="fw-bold text-main mb-1">Privacy Policy Update</h6>
                    <p class="--text-muted small mb-1 opacity-75">Updated privacy policy to reflect new data protection standards...</p>
                    <div class="d-flex align-items-center gap-3 --text-muted small mt-2">
                        <span><i class="bi bi-eye me-1"></i> 5.7K views</span>
                        <span><i class="bi bi-calendar3 me-1"></i> 30/1/2024</span>
                        <span><i class="bi bi-person me-1"></i> Legal Team</span>
                    </div>
                </div>
            </div>
            <div class="text-md-end w-100 w-md-auto d-flex flex-row flex-md-column justify-content-between align-items-center align-items-md-end mt-2 mt-md-0">
                <div>
                    <span class="category-label" style="color: #ef4444;">Policy</span>
                    <span class="status-tag tag-published">Published</span>
                </div>
                <div class="mt-md-2 --text-muted small">#privacy #legal</div>
            </div>
        </div>
    </div>
</div>

<div id="tab-analytics" class="tab-content-block d-none">
    <div class="row g-4">
        <div class="col-12 col-xl-8">
            <div class="content-container h-100">
                <h6 class="fw-bold text-main mb-4"><i class="bi bi-graph-up-arrow me-2 text-success"></i> Top Performing Content</h6>

                <div class="perf-item">
                    <div class="d-flex align-items-center gap-3">
                        <div class="content-icon text-info"><i class="bi bi-play-circle-fill"></i></div>
                        <div>
                            <h6 class="fw-bold text-main mb-0">Platform Demo Video</h6>
                            <small class="--text-muted">Media</small>
                        </div>
                    </div>
                    <span class="perf-val">23.5K views</span>
                </div>

                <div class="perf-item">
                    <div class="d-flex align-items-center gap-3">
                        <div class="content-icon text-primary"><i class="bi bi-file-earmark-text-fill"></i></div>
                        <div>
                            <h6 class="fw-bold text-main mb-0">Welcome to KickStartSkills</h6>
                            <small class="--text-muted">Articles</small>
                        </div>
                    </div>
                    <span class="perf-val">15.4K views</span>
                </div>

                <div class="perf-item">
                    <div class="d-flex align-items-center gap-3">
                        <div class="content-icon text-success"><i class="bi bi-question-circle-fill"></i></div>
                        <div>
                            <h6 class="fw-bold text-main mb-0">How to Create an Effective Profile</h6>
                            <small class="--text-muted">FAQs</small>
                        </div>
                    </div>
                    <span class="perf-val">12.5K views</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="content-container h-100">
                <h6 class="fw-bold text-main mb-4"><i class="bi bi-bar-chart-line me-2 text-warning"></i> Content Performance</h6>

                <div class="mb-4">
                    <small class="--text-muted d-block mb-1">Total Views</small>
                    <h3 class="fw-bold text-primary">89.5K</h3>
                </div>

                <div class="mb-4">
                    <small class="--text-muted d-block mb-1">Avg Views/Content</small>
                    <h3 class="fw-bold text-success">362</h3>
                </div>

                <div>
                    <small class="--text-muted d-block mb-2">Top Categories</small>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-soft-danger text-danger border border-danger border-opacity-25">Platform</span>
                        <span class="badge bg-soft-warning text-warning border border-warning border-opacity-25">Help</span>
                        <span class="badge bg-soft-info text-info border border-info border-opacity-25">Features</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="tab-activity" class="tab-content-block d-none">
    <div class="content-container">
        <h6 class="fw-bold text-main mb-4"><i class="bi bi-lightning-charge me-2 text-danger"></i> Recent Content Activity</h6>

        <div class="activity-row">
            <div class="activity-icon text-success"><i class="bi bi-check-lg"></i></div>
            <div>
                <h6 class="fw-bold text-main mb-1">New Feature: Enhanced Skill Matching published</h6>
                <small class="--text-muted">30/1/2024</small>
            </div>
        </div>

        <div class="activity-row">
            <div class="activity-icon text-warning"><i class="bi bi-pencil-fill"></i></div>
            <div>
                <h6 class="fw-bold text-main mb-1">Privacy Policy Update content modified</h6>
                <small class="--text-muted">30/1/2024</small>
            </div>
        </div>

        <div class="activity-row">
            <div class="activity-icon text-primary"><i class="bi bi-plus-lg"></i></div>
            <div>
                <h6 class="fw-bold text-main mb-1">Platform Maintenance Notice draft created</h6>
                <small class="--text-muted">30/1/2024</small>
            </div>
        </div>
    </div>
</div>

<script>
    function switchContentTab(tabName) {
        // Reset buttons
        document.querySelectorAll('.content-tab-btn').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');

        // Hide all content blocks
        document.querySelectorAll('.tab-content-block').forEach(el => el.classList.add('d-none'));

        // Show selected content
        document.getElementById('tab-' + tabName).classList.remove('d-none');
    }
</script>

@endsection
