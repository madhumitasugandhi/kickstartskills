@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Feedback Center')
@section('icon', 'bi bi-chat-dots fs-4 p-2 bg-primary bg-opacity-10 rounded-3 text-primary')

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

    /* 1. Overview Section */
    .overview-grid {
        display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 32px;
    }
    .stat-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        border-bottom: 4px solid transparent;
    }

    .sc-rating { background-color: var(--soft-orange); border-color: var(--border-color); border-bottom-color: var(--text-orange); }
    .sc-total { background-color: var(--soft-blue); border-color: var(--border-color); border-bottom-color: var(--text-blue); }
    .sc-strength { background-color: var(--soft-green); border-color: var(--border-color); border-bottom-color: var(--text-green); }
    .sc-improve { background-color: var(--soft-red); border-color: var(--border-color); border-bottom-color: var(--text-red); }

    .sc-icon { font-size: 1.5rem; margin-bottom: 8px; display: block; }
    .sc-val { font-size: 1.5rem; font-weight: 700; color: var(--text-main); line-height: 1.2; }
    .sc-lbl { font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; }

    /* 2. Filter Tabs */
    .filter-row {
        display: flex; gap: 16px; margin-bottom: 24px;
    }
    .filter-btn {
        flex: 1;
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        color: var(--text-muted);
        padding: 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: 0.2s;
    }
    .filter-btn.active {
        background-color: #0ea5e9; color: white; border-color: #0ea5e9;
    }
    .filter-btn:hover:not(.active) {
        background-color: var(--soft-blue); color: var(--text-blue);
    }

    /* 3. Feedback Card */
    .fb-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
        position: relative;
    }

    .fb-header {
        display: flex; gap: 16px; margin-bottom: 16px;
    }
    .avatar-box {
        width: 48px; height: 48px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    .av-green { background-color: var(--soft-green); color: var(--text-green); }
    .av-orange { background-color: var(--soft-orange); color: var(--text-orange); }

    .user-info h6 { font-weight: 700; color: var(--text-main); margin-bottom: 2px; font-size: 1rem; }
    .user-sub { font-size: 0.75rem; color: var(--text-muted); }
    .rating-stars { color: #f59e0b; font-size: 0.8rem; margin-left: 8px; }

    .fb-title { font-weight: 600; color: var(--text-blue); font-size: 0.95rem; margin-bottom: 8px; }
    .fb-text { font-size: 0.9rem; color: var(--text-muted); line-height: 1.6; margin-bottom: 16px; }

    /* Strengths & Improvements Sections */
    .points-section { margin-bottom: 16px; }
    .ps-title { font-size: 0.8rem; font-weight: 700; margin-bottom: 8px; display: flex; align-items: center; gap: 6px; }
    .ps-title.green { color: var(--text-green); }
    .ps-title.orange { color: var(--text-orange); }

    .point-list { list-style: none; padding: 0; margin: 0; }
    .point-item {
        position: relative; padding-left: 16px; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 4px;
    }
    .point-item::before {
        content: ''; position: absolute; left: 0; top: 6px; width: 6px; height: 6px; border-radius: 50%;
    }
    .dot-green::before { background-color: var(--text-green); }
    .dot-orange::before { background-color: var(--text-orange); }

    /* Footer */
    .fb-footer {
        display: flex; justify-content: space-between; align-items: center;
        padding-top: 16px; border-top: 1px solid var(--border-color); margin-top: 16px;
    }
    .date-text { font-size: 0.75rem; color: var(--text-muted); }

    .action-links a {
        font-size: 0.85rem; font-weight: 600; text-decoration: none; margin-left: 16px; cursor: pointer;
    }
    .link-respond { color: var(--text-blue); }
    .link-share { color: var(--text-muted); }

    /* Floating Action Button */
    .fab-btn {
        position: fixed; bottom: 30px; right: 30px;
        background-color: #0ea5e9; color: white;
        padding: 12px 24px; border-radius: 30px;
        font-weight: 600; box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        border: none; display: flex; align-items: center; gap: 8px;
        transition: 0.2s; z-index: 100;
    }
    .fab-btn:hover { background-color: #0284c7; transform: translateY(-2px); }

    @media(max-width: 991px) {
        .overview-grid { grid-template-columns: 1fr 1fr; }
    }
</style>

<div class="content-body">

    <div class="d-flex align-items-center gap-3 mb-4">
        <div class="p-2 bg-primary bg-opacity-10 rounded-3 text-primary"><i class="bi bi-chat-square-quote-fill fs-4"></i></div>
        <div>
            <h5 class="fw-bold m-0 text-main">Feedback Center</h5>
            <small class="--text-muted">Welcome back, John!</small>
        </div>
    </div>

    <!-- 1. Overview Section -->
    <h6 class="fw-bold text-main mb-3">Feedback Overview</h6>
    <div class="overview-grid">
        <div class="stat-card sc-rating">
            <i class="bi bi-star text-orange-dark sc-icon"></i>
            <span class="sc-val text-orange-dark">4.2</span>
            <span class="sc-lbl text-orange-dark">Average Rating</span>
        </div>
        <div class="stat-card sc-total">
            <i class="bi bi-chat-dots text-blue-dark sc-icon"></i>
            <span class="sc-val text-blue-dark">24</span>
            <span class="sc-lbl text-blue-dark">Total Feedback</span>
        </div>
        <div class="stat-card sc-strength">
            <i class="bi bi-hand-thumbs-up text-green-dark sc-icon"></i>
            <span class="sc-val text-green-dark">5</span>
            <span class="sc-lbl text-green-dark">Strengths</span>
        </div>
        <div class="stat-card sc-improve">
            <i class="bi bi-bullseye text-red-dark sc-icon"></i> <!-- Using red variable for improve -->
            <span class="sc-val" style="color: var(--text-red);">3</span>
            <span class="sc-lbl" style="color: var(--text-red);">Improvements</span>
        </div>
    </div>

    <!-- 2. Filter Tabs -->
    <div class="filter-row">
        <button class="filter-btn active">All Feedback <span class="small opacity-75">(6 items)</span></button>
        <button class="filter-btn">Instructor <span class="small opacity-75">(4 items)</span></button>
        <button class="filter-btn">Peer <span class="small opacity-75">(2 items)</span></button>
    </div>

    <!-- 3. Feedback Feed -->

    <!-- Feedback 1 -->
    <div class="fb-card">
        <div class="fb-header">
            <div class="avatar-box av-green"><i class="bi bi-person"></i></div>
            <div class="user-info">
                <h6 class="text-main">Dr. Sarah Johnson <span class="rating-stars"><i class="bi bi-star-fill"></i> 4.5</span></h6>
                <span class="user-sub">Computer Science • Assignment Review</span>
            </div>
        </div>

        <h6 class="fb-title">Excellent Problem-Solving Skills</h6>
        <p class="fb-text">
            John demonstrates exceptional analytical thinking and problem-solving abilities. His approach to complex algorithms is methodical and well-structured. Keep up the excellent work!
        </p>

        <div class="points-section">
            <div class="ps-title green"><i class="bi bi-hand-thumbs-up"></i> Strengths</div>
            <ul class="point-list">
                <li class="point-item dot-green">Clear logical thinking</li>
                <li class="point-item dot-green">Well-commented code</li>
                <li class="point-item dot-green">Creative solutions</li>
            </ul>
        </div>

        <div class="points-section">
            <div class="ps-title orange"><i class="bi bi-bullseye"></i> Areas for Improvement</div>
            <ul class="point-list">
                <li class="point-item dot-orange">Consider edge cases more thoroughly</li>
                <li class="point-item dot-orange">Optimize time complexity where possible</li>
            </ul>
        </div>

        <div class="fb-footer">
            <span class="date-text">3 days ago</span>
            <div class="action-links">
                <a class="link-respond"><i class="bi bi-reply"></i> Respond</a>
                <a class="link-share"><i class="bi bi-share"></i> Share</a>
            </div>
        </div>
    </div>

    <!-- Feedback 2 -->
    <div class="fb-card">
        <div class="fb-header">
            <div class="avatar-box av-orange"><i class="bi bi-person"></i></div>
            <div class="user-info">
                <h6 class="text-main">Prof. Michael Chen <span class="rating-stars"><i class="bi bi-star-fill"></i> 3.8</span></h6>
                <span class="user-sub">Mathematics • Exam Performance</span>
            </div>
        </div>

        <h6 class="fb-title" style="color: var(--text-orange);">Strong Foundation, Room for Growth</h6>
        <p class="fb-text">
            Your understanding of fundamental concepts is solid. However, I notice some inconsistency in problem-solving approaches during exams. Practice more complex problems to build confidence.
        </p>

        <div class="points-section">
            <div class="ps-title green"><i class="bi bi-hand-thumbs-up"></i> Strengths</div>
            <ul class="point-list">
                <li class="point-item dot-green">Good grasp of basic concepts</li>
            </ul>
        </div>

        <div class="fb-footer">
            <span class="date-text">1 week ago</span>
            <div class="action-links">
                <a class="link-respond"><i class="bi bi-reply"></i> Respond</a>
                <a class="link-share"><i class="bi bi-share"></i> Share</a>
            </div>
        </div>
    </div>

</div>

<!-- Floating Action Button -->
<button class="fab-btn">
    <i class="bi bi-pencil-square"></i> Provide Feedback
</button>

@endsection
