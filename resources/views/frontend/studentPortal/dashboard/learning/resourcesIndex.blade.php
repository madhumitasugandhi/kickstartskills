@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Resources')

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
        --bg-card: #252525;
        --text-main: #e9ecef;
        --text-muted: #adb5bd;
        --border-color: #2c2c2c;
        --soft-blue: rgba(13, 110, 253, 0.15);
        --text-blue: #6ea8fe;
        --soft-green: rgba(25, 135, 84, 0.15);
        --text-green: #75b798;
        --soft-orange: rgba(255, 193, 7, 0.15);
        --text-orange: #ffda6a;
        --soft-red: rgba(220, 53, 69, 0.15);
        --text-red: #ea868f;
    }

    /* Overview Section */
    .overview-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 32px;
    }

    .stat-block {
        text-align: left;
    }

    .stat-label {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-bottom: 4px;
    }

    .stat-num {
        font-size: 1.2rem;
        font-weight: 700;
    }

    .text-blue {
        color: var(--text-blue);
    }

    .text-green {
        color: var(--text-green);
    }

    .text-orange {
        color: var(--text-orange);
    }

    /* Search Bar */
    .search-container {
        position: relative;
        margin-bottom: 32px;
    }

    .search-input {
        padding: 16px 16px 16px 48px;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        background-color: var(--bg-card);
        color: var(--text-main);
        width: 100%;
        transition: 0.2s;
    }

    .search-input:focus {
        border-color: var(--text-blue);
        box-shadow: 0 0 0 4px var(--soft-blue);
        outline: none;
    }

    .search-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 1.2rem;
    }

    /* Category Cards */
    .cat-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        text-align: center;
        transition: transform 0.2s;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .cat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .cat-icon-box {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 12px;
    }

    .bg-light-blue {
        background-color: var(--soft-blue);
        color: var(--text-blue);
    }

    .bg-light-green {
        background-color: var(--soft-green);
        color: var(--text-green);
    }

    .bg-light-orange {
        background-color: var(--soft-orange);
        color: var(--text-orange);
    }

    .bg-light-red {
        background-color: var(--soft-red);
        color: var(--text-red);
    }

    /* Resource Item Cards */
    .resource-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.2s;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .resource-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05);
    }

    .resource-header {
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        font-size: 2rem;
    }

    .bookmark-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        color: rgba(0, 0, 0, 0.3);
        cursor: pointer;
        font-size: 1.2rem;
    }

    .bookmark-btn:hover {
        color: var(--text-main);
    }

    .resource-body {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .file-tag {
        font-size: 0.65rem;
        padding: 2px 8px;
        border-radius: 4px;
        font-weight: 600;
        background-color: var(--border-color);
        color: var(--text-main);
        margin-right: 6px;
    }

    .download-btn {
        margin-top: auto;
        width: 100%;
        background-color: #e2e8f0;
        border: none;
        color: #475569;
        font-weight: 600;
        padding: 10px;
        border-radius: 8px;
        font-size: 0.85rem;
        transition: 0.2s;
    }

    .download-btn:hover {
        background-color: #cbd5e1;
    }

    [data-theme="dark"] .download-btn {
        background-color: #333;
        color: #ccc;
    }

    [data-theme="dark"] .download-btn:hover {
        background-color: #444;
    }

    /* Colors specific to cards from image */
    .header-blue {
        background-color: #dbeafe;
        color: #2563eb;
    }

    .header-red {
        background-color: #fee2e2;
        color: #dc2626;
    }

    [data-theme="dark"] .header-blue {
        background-color: rgba(37, 99, 235, 0.2);
    }

    [data-theme="dark"] .header-red {
        background-color: rgba(220, 38, 38, 0.2);
    }
</style>

<div class="content-body">

    <!-- 1. Resource Overview Stats -->
    <div class="overview-card">
        <div class="d-flex align-items-center gap-2 mb-4">
            <i class="bi bi-bar-chart-fill text-primary"></i>
            <h6 class="fw-bold text-main m-0">Resource Overview</h6>
        </div>

        <div class="row mb-4">
            <div class="col-md-3 stat-block">
                <div class="stat-label">Total Resources</div>
                <div class="stat-num text-blue">178</div>
            </div>
            <div class="col-md-3 stat-block">
                <div class="stat-label">Downloaded</div>
                <div class="stat-num text-green">45</div>
            </div>
            <div class="col-md-3 stat-block">
                <div class="stat-label">Bookmarked</div>
                <div class="stat-num text-orange">12</div>
            </div>
            <div class="col-md-3 stat-block">
                <div class="stat-label">Categories</div>
                <div class="stat-num text-green">5</div>
            </div>
        </div>

        <!-- Storage Bar -->
        <div class="d-flex justify-content-between small mb-2" style="color: var(--text-muted)">
            <span>Storage Usage</span>
            <span class="text-primary fw-bold">2.8 GB / 10 GB</span>
        </div>
        <div class="progress" style="height: 6px;">
            <div class="progress-bar bg-primary" style="width: 28%"></div>
        </div>
    </div>

    <!-- 2. Search and Filters -->
    <div class="card-custom border-0 bg-transparent p-0 mb-4">
        <div class="search-container">
            <i class="bi bi-search search-icon"></i>
            <input type="text" class="search-input" placeholder="Search resources, courses, or topics...">
        </div>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex gap-2">
                <select class="form-select form-select-sm border-0 shadow-sm w-auto">
                    <option>Category: All</option>
                </select>
                <select class="form-select form-select-sm border-0 shadow-sm w-auto">
                    <option>Type: All</option>
                </select>
                <select class="form-select form-select-sm border-0 shadow-sm w-auto">
                    <option>Sort: Recent</option>
                </select>
            </div>
            <small class="text-primary fw-bold">5 resources found</small>
        </div>
    </div>

    <!-- 3. Browse by Category -->
    <h6 class=" small fw-bold mb-3" style="color: var(--text-muted)">Browse by Category</h6>
    <div class="row g-4 mb-5">
        <div class="col-6 col-md">
            <div class="cat-card">
                <div class="cat-icon-box bg-light-blue"><i class="bi bi-tablet"></i></div>
                <h6 class="fw-bold text-main m-0" style="font-size: 0.9rem;">Course Materials</h6>
                <small class="text-primary fw-bold">45</small>
            </div>
        </div>
        <div class="col-6 col-md">
            <div class="cat-card">
                <div class="cat-icon-box bg-light-green"><i class="bi bi-file-earmark-text"></i></div>
                <h6 class="fw-bold text-main m-0" style="font-size: 0.9rem;">Reference Docs</h6>
                <small class="text-primary fw-bold">28</small>
            </div>
        </div>
        <div class="col-6 col-md">
            <div class="cat-card">
                <div class="cat-icon-box bg-light-orange"><i class="bi bi-pencil-square"></i></div>
                <h6 class="fw-bold text-main m-0" style="font-size: 0.9rem;">Practice Materials</h6>
                <small class="text-primary fw-bold">35</small>
            </div>
        </div>
        <div class="col-6 col-md">
            <div class="cat-card">
                <div class="cat-icon-box bg-light-blue"><i class="bi bi-folder"></i></div>
                <h6 class="fw-bold text-main m-0" style="font-size: 0.9rem;">Project Templates</h6>
                <small class="text-primary fw-bold">18</small>
            </div>
        </div>
        <div class="col-6 col-md">
            <div class="cat-card">
                <div class="cat-icon-box bg-light-red"><i class="bi bi-play-btn"></i></div>
                <h6 class="fw-bold text-main m-0" style="font-size: 0.9rem;">Video Lectures</h6>
                <small class="text-primary fw-bold">52</small>
            </div>
        </div>
    </div>

    <!-- 4. Resources Grid -->
    <div class="row g-4">

        <!-- Resource 1 -->
        <div class="col-md-6 col-lg-4">
            <div class="resource-card">
                <div class="resource-header header-blue">
                    <i class="bi bi-link-45deg"></i>
                    <i class="bi bi-bookmark-fill bookmark-btn"></i>
                </div>
                <div class="resource-body">
                    <h6 class="fw-bold text-main mb-2">JavaScript ES6+ Features Playground</h6>
                    <p class=" small mb-3" style="color: var(--text-muted)">Interactive code examples showcasing modern
                        JavaScript features and syntax.</p>

                    <div class="mb-3">
                        <span class="file-tag text-primary bg-soft-blue">Link</span>
                        <span class="file-tag">Online</span>
                    </div>

                    <div class="d-flex justify-content-between small text-muted mb-3">
                        <span class="text-warning"><i class="bi bi-star-fill"></i> 4.8 (203)</span>
                        <span><i class="bi bi-download"></i> 1456</span>
                    </div>

                    <button class="download-btn">Open Link</button>
                </div>
            </div>
        </div>

        <!-- Resource 2 -->
        <div class="col-md-6 col-lg-4">
            <div class="resource-card">
                <div class="resource-header header-red">
                    <i class="bi bi-file-earmark-pdf"></i>
                    <i class="bi bi-bookmark bookmark-btn"></i>
                </div>
                <div class="resource-body">
                    <h6 class="fw-bold text-main mb-2">Flutter Advanced State Management Guide</h6>
                    <p class=" small mb-3" style="color: var(--text-muted)">Comprehensive guide covering Provider, BLoC,
                        and Riverpod patterns with examples.</p>

                    <div class="mb-3">
                        <span class="file-tag text-danger bg-soft-red">PDF</span>
                        <span class="file-tag">12.4 MB</span>
                    </div>

                    <div class="d-flex justify-content-between small text-muted mb-3">
                        <span class="text-warning"><i class="bi bi-star-fill"></i> 4.8 (245)</span>
                        <span><i class="bi bi-download"></i> 1250</span>
                    </div>

                    <button class="download-btn">Download</button>
                </div>
            </div>
        </div>

        <!-- Resource 3 -->
        <div class="col-md-6 col-lg-4">
            <div class="resource-card">
                <div class="resource-header header-red">
                    <i class="bi bi-file-earmark-pdf"></i>
                    <i class="bi bi-bookmark bookmark-btn"></i>
                </div>
                <div class="resource-body">
                    <h6 class="fw-bold text-main mb-2">Machine Learning Algorithms Cheat Sheet</h6>
                    <p class="small mb-3" style="color: var(--text-muted)">Quick reference guide for popular ML
                        algorithms with implementation snippets.</p>

                    <div class="mb-3">
                        <span class="file-tag text-danger bg-soft-red">PDF</span>
                        <span class="file-tag">8.7 MB</span>
                    </div>

                    <div class="d-flex justify-content-between small text-muted mb-3">
                        <span class="text-warning"><i class="bi bi-star-fill"></i> 4.7 (412)</span>
                        <span><i class="bi bi-download"></i> 2150</span>
                    </div>

                    <button class="download-btn">Download</button>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
