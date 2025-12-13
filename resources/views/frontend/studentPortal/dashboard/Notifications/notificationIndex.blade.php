@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Notifications')
@section('icon', 'bi bi-bell fs-4 p-2 bg-primary bg-opacity-10 rounded-3 text-primary')

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
    }

    /* 1. Header Card */
    .notif-header {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .icon-bell-lg {
        width: 56px; height: 56px;
        background-color: var(--soft-blue); color: var(--text-blue);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.6rem;
    }

    .badge-urgent-lg {
        background-color: rgba(220, 53, 69, 0.1); color: #dc3545;
        border: 1px solid rgba(220, 53, 69, 0.2);
        padding: 6px 16px; border-radius: 20px;
        font-size: 0.8rem; font-weight: 600;
        display: flex; align-items: center; gap: 6px;
    }

    /* 2. Filter Bar */
    .filter-section {
        display: flex; gap: 24px; margin-bottom: 24px;
    }
    .filter-group { flex: 1; }
    .filter-label { font-size: 0.75rem; color: var(--text-muted); display: block; margin-bottom: 6px; font-weight: 600; }

    .custom-select {
        width: 100%;
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        padding: 10px 16px;
        border-radius: 8px;
        font-size: 0.9rem;
    }

    /* 3. Notification List */
    .notif-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 16px;
        position: relative;
        transition: transform 0.2s;
    }
    .notif-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.05); }

    .notif-top { display: flex; gap: 16px; margin-bottom: 12px; }
    .n-icon {
        width: 40px; height: 40px; border-radius: 50%; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center; font-size: 1rem;
    }
    .bg-icon-blue { background-color: var(--soft-blue); color: var(--text-blue); }
    .bg-icon-red { background-color: var(--soft-red); color: var(--text-red); }
    .bg-icon-green { background-color: var(--soft-green); color: var(--text-green); }

    .n-title { font-weight: 600; color: var(--text-main); font-size: 0.95rem; margin-bottom: 2px; }
    .n-meta { font-size: 0.75rem; color: var(--text-muted); }
    .n-link { color: var(--text-blue); text-decoration: none; font-weight: 500; }

    .n-desc { font-size: 0.9rem; color: var(--text-muted); margin-bottom: 16px; line-height: 1.5; padding-left: 56px; }

    .n-badges { padding-left: 56px; display: flex; gap: 8px; }
    .chip {
        font-size: 0.7rem; padding: 4px 10px; border-radius: 6px; font-weight: 600;
        display: flex; align-items: center; gap: 4px;
    }
    .chip-attach { background-color: #fff3cd; color: #b45309; }
    .chip-action { background-color: #fee2e2; color: #dc2626; }
    .chip-tag { background-color: var(--soft-blue); color: var(--text-blue); }

    .priority-badge {
        position: absolute; top: 20px; right: 20px;
        font-size: 0.7rem; font-weight: 700; padding: 2px 8px; border-radius: 4px;
    }
    .p-low { background-color: #d1fae5; color: #059669; }
    .p-high { background-color: #fee2e2; color: #dc2626; }

    .menu-dots { position: absolute; top: 20px; right: 20px; color: var(--text-muted); cursor: pointer; }

    @media(max-width: 768px) {
        .filter-section { flex-direction: column; gap: 12px; }
        .n-desc, .n-badges { padding-left: 0; }
    }
</style>

<div class="content-body">

    <!-- 1. Header Card -->
    <div class="notif-header">
        <div class="d-flex align-items-center gap-4">
            <div class="icon-bell-lg"><i class="bi bi-bell-fill"></i></div>
            <div>
                <h5 class="fw-bold text-main m-0">Notification Center</h5>
                <small class="--text-muted">28 unread of 50 total</small>
            </div>
        </div>
        <div class="badge-urgent-lg">
            <i class="bi bi-exclamation-circle-fill"></i> 9 urgent
        </div>
    </div>

    <!-- 2. Filters -->
    <div class="filter-section">
        <div class="filter-group">
            <label class="filter-label">Filter</label>
            <select class="custom-select">
                <option>All</option>
                <option>Unread</option>
                <option>Mentions</option>
            </select>
        </div>
        <div class="filter-group">
            <label class="filter-label">Timeframe</label>
            <select class="custom-select">
                <option>All Time</option>
                <option>Today</option>
                <option>This Week</option>
            </select>
        </div>
    </div>

    <!-- 3. Notification List -->

    <!-- Item 1 -->
    <div class="notif-card">
        <span class="priority-badge p-low">Low</span>
        <div class="notif-top">
            <div class="n-icon bg-icon-blue"><i class="bi bi-chat-left-text-fill"></i></div>
            <div>
                <h6 class="n-title"><span class="text-primary">•</span> New Message from Mentor Sarah</h6>
                <div class="n-meta">
                    <a href="#" class="n-link">Mentor Sarah</a> • 4h ago
                </div>
            </div>
        </div>
        <p class="n-desc">You have received a new message. Click to view and respond.</p>
        <div class="n-badges">
            <span class="chip chip-attach"><i class="bi bi-paperclip"></i> Attachment</span>
        </div>
        <i class="bi bi-three-dots-vertical menu-dots" style="top: 50px;"></i>
    </div>

    <!-- Item 2 -->
    <div class="notif-card">
        <span class="priority-badge p-low">Low</span>
        <div class="notif-top">
            <div class="n-icon bg-icon-red"><i class="bi bi-file-earmark-text-fill"></i></div>
            <div>
                <h6 class="n-title"><span class="text-danger">•</span> Upcoming Test: Quiz #3</h6>
                <div class="n-meta">
                    <span class="--text-muted">Exam Coordinator</span> • 1d ago
                </div>
            </div>
        </div>
        <p class="n-desc">Your examination is scheduled. Review the syllabus and prepare accordingly.</p>
        <div class="n-badges">
            <span class="chip chip-attach"><i class="bi bi-paperclip"></i> Attachment</span>
            <span class="chip chip-action"><i class="bi bi-exclamation-triangle"></i> Action Required</span>
        </div>
        <i class="bi bi-three-dots-vertical menu-dots" style="top: 50px;"></i>
    </div>

    <!-- Item 3 -->
    <div class="notif-card">
        <span class="priority-badge p-high">High</span>
        <div class="notif-top">
            <div class="n-icon bg-icon-green"><i class="bi bi-journal-check"></i></div>
            <div>
                <h6 class="n-title"><span class="text-success">•</span> New Grade Posted for Data Structures</h6>
                <div class="n-meta">
                    <a href="#" class="n-link">Prof. Johnson</a> • 3d ago
                </div>
            </div>
        </div>
        <p class="n-desc">Your assignment has been graded. Check your performance dashboard for detailed feedback.</p>
        <div class="n-badges">
            <span class="chip chip-tag">Flutter Development</span>
        </div>
        <i class="bi bi-three-dots-vertical menu-dots" style="top: 50px;"></i>
    </div>

</div>
@endsection
