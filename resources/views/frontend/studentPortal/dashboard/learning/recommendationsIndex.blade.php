@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Recommendations')

@section('content')
<style>
    /* Theme Variables */
    :root {
        --bg-card: #ffffff;
        --text-main: #343a40;
        --text-muted: #6c757d;
        --border-color: #e9ecef;
        --soft-blue: #e7f1ff; --text-blue: #0d6efd;
        --soft-green: #d1e7dd; --text-green: #0f5132;
        --soft-orange: #ffecb5; --text-orange: #664d03;
        --soft-red: #f8d7da; --text-red: #842029;
        --soft-purple: #e0cffc; --text-purple: #6f42c1;
    }

    [data-theme="dark"] {
        --bg-card: #252525;
        --text-main: #e9ecef;
        --text-muted: #adb5bd;
        --border-color: #2c2c2c;
        --soft-blue: rgba(13, 110, 253, 0.15); --text-blue: #6ea8fe;
        --soft-green: rgba(25, 135, 84, 0.15); --text-green: #75b798;
        --soft-orange: rgba(255, 193, 7, 0.15); --text-orange: #ffda6a;
        --soft-red: rgba(220, 53, 69, 0.15); --text-red: #ea868f;
        --soft-purple: rgba(111, 66, 193, 0.15); --text-purple: #a370f7;
    }

    /* AI Insight Banner */
    .ai-banner {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px;
        padding: 32px;
        color: white;
        margin-bottom: 32px;
        position: relative;
        overflow: hidden;
    }

    .ai-icon-bg {
        position: absolute;
        right: -20px;
        top: -20px;
        font-size: 10rem;
        opacity: 0.1;
        transform: rotate(15deg);
    }

    .btn-preferences {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(5px);
        padding: 8px 20px;
        border-radius: 8px;
        font-size: 0.85rem;
        transition: 0.2s;
    }
    .btn-preferences:hover {
        background: rgba(255, 255, 255, 0.3);
        color: white;
    }

    /* Filters */
    .filter-pill {
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        color: var(--text-muted);
        transition: 0.2s;
    }
    .filter-pill.active {
        background-color: var(--text-blue);
        color: white;
        border-color: var(--text-blue);
    }

    /* Recommendation Card */
    .rec-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 24px;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: transform 0.2s;
    }
    .rec-card:hover { transform: translateY(-4px); box-shadow: 0 8px 20px rgba(0,0,0,0.05); }

    .rec-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 16px;
    }

    .type-badge {
        font-size: 0.65rem;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 0.5px;
        color: var(--text-muted);
    }

    /* Reason Box */
    .reason-box {
        background-color: var(--bg-hover); /* Light grey */
        padding: 12px;
        border-radius: 8px;
        margin: 16px 0;
        border-left: 3px solid var(--text-blue);
    }
    [data-theme="dark"] .reason-box { background-color: rgba(255,255,255,0.05); }

    /* Match Score Bar */
    .match-container {
        margin-bottom: 20px;
    }
    .progress-match {
        height: 6px;
        background-color: var(--border-color);
        border-radius: 10px;
        margin-top: 6px;
        overflow: hidden;
    }

    /* Specific Priority Colors */
    .priority-high { color: #dc3545; background-color: var(--soft-red); }
    .priority-gap { color: #fd7e14; background-color: var(--soft-orange); }
    .priority-trend { color: #0d6efd; background-color: var(--soft-blue); }

    .btn-action {
        width: 100%;
        margin-top: auto;
        padding: 10px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        border: 1px solid var(--border-color);
        background: transparent;
        color: var(--text-main);
        transition: 0.2s;
    }
    .btn-action:hover {
        background-color: var(--soft-blue);
        color: var(--text-blue);
        border-color: var(--soft-blue);
    }
</style>

<div class="content-body">

    <!-- 1. AI Insight Banner -->
    <div class="ai-banner">
        <i class="bi bi-cpu-fill ai-icon-bg"></i>
        <div class="row align-items-center position-relative">
            <div class="col-md-8">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-stars"></i>
                    </div>
                    <h5 class="fw-bold m-0">AI Learning Insight</h5>
                </div>
                <p class="mb-0 opacity-75" style="font-size: 0.95rem; line-height: 1.6;">
                    Based on your recent performance in <strong>Flutter Development</strong>, we've curated these resources to help you master state management and improve your quiz scores.
                </p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <button class="btn-preferences"><i class="bi bi-sliders me-2"></i> Update Preferences</button>
            </div>
        </div>
    </div>

    <!-- 2. Filter Tabs -->
    <div class="d-flex gap-3 mb-4 overflow-auto pb-2">
        <div class="filter-pill active">All</div>
        <div class="filter-pill">Courses</div>
        <div class="filter-pill">Practice</div>
        <div class="filter-pill">Resources</div>
    </div>

    <!-- 3. Recommendations Grid -->
    <div class="row g-4">

        <!-- Card 1: Course (High Priority) -->
        <div class="col-md-6 col-lg-4">
            <div class="rec-card">
                <div class="rec-header">
                    <div>
                        <span class="type-badge"><i class="bi bi-play-circle me-1"></i> Course</span>
                        <h6 class="fw-bold text-main mt-1 mb-0 fs-5">Advanced State Management</h6>
                    </div>
                    <span class="badge priority-high rounded-pill px-3 py-2">High Priority</span>
                </div>

                <div class="reason-box">
                    <small class="d-block fw-bold mb-1" style="color: var(--text-muted)">Why this?</small>
                    <small class="text-main">Critical concept for large scale apps. Matches your "Mobile Dev" goal.</small>
                </div>

                <div class="match-container">
                    <div class="d-flex justify-content-between small fw-bold">
                        <span class="" style="color: var(--text-muted)">Match Score</span>
                        <span class="text-success">98%</span>
                    </div>
                    <div class="progress-match">
                        <div class="bg-success h-100" style="width: 98%"></div>
                    </div>
                </div>

                <button class="btn-action">View Course</button>
            </div>
        </div>

        <!-- Card 2: Practice (Skill Gap) -->
        <div class="col-md-6 col-lg-4">
            <div class="rec-card">
                <div class="rec-header">
                    <div>
                        <span class="type-badge"><i class="bi bi-lightning-charge me-1"></i> Practice</span>
                        <h6 class="fw-bold text-main mt-1 mb-0 fs-5">Dart Async Programming</h6>
                    </div>
                    <span class="badge priority-gap rounded-pill px-3 py-2">Skill Gap</span>
                </div>

                <div class="reason-box" style="border-left-color: #fd7e14;">
                    <small class="d-block fw-bold mb-1" style="color: var(--text-muted)">Why this?</small>
                    <small class="text-main">You scored low (65%) in the last asynchronous programming quiz.</small>
                </div>

                <div class="match-container">
                    <div class="d-flex justify-content-between small fw-bold">
                        <span class="" style="color: var(--text-muted)">Match Score</span>
                        <span class="text-success">92%</span>
                    </div>
                    <div class="progress-match">
                        <div class="bg-success h-100" style="width: 92%"></div>
                    </div>
                </div>

                <button class="btn-action">Start Practice</button>
            </div>
        </div>

        <!-- Card 3: Resource (Trending) -->
        <div class="col-md-6 col-lg-4">
            <div class="rec-card">
                <div class="rec-header">
                    <div>
                        <span class="type-badge"><i class="bi bi-file-text me-1"></i> Resource</span>
                        <h6 class="fw-bold text-main mt-1 mb-0 fs-5">Material Design 3 Guidelines</h6>
                    </div>
                    <span class="badge priority-trend rounded-pill px-3 py-2">Trending</span>
                </div>

                <div class="reason-box" style="border-left-color: #0d6efd;">
                    <small class="d-block fw-bold mb-1" style="color: var(--text-muted)">Why this?</small>
                    <small class="text-main">Popular among your peers who are studying UI/UX Design.</small>
                </div>

                <div class="match-container">
                    <div class="d-flex justify-content-between small fw-bold">
                        <span class="" style="color: var(--text-muted)">Match Score</span>
                        <span class="text-primary">88%</span>
                    </div>
                    <div class="progress-match">
                        <div class="bg-primary h-100" style="width: 88%"></div>
                    </div>
                </div>

                <button class="btn-action">Read Article</button>
            </div>
        </div>

    </div>
</div>
@endsection

