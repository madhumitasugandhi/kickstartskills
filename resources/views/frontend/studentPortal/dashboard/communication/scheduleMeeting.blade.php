@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Schedule Meeting')

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
            --soft-blue: #e7f1ff;
            --text-blue: #0d6efd;
            --soft-green: #d1e7dd;
            --text-green: #0f5132;
            --soft-orange: #ffecb5;
            --text-orange: #664d03;
            --soft-red: #f8d7da;
            --text-red: #842029;
            --soft-teal: #e0fbf6;
            --text-teal: #107c6f;
        }

        [data-theme="dark"] {
            --bg-body: #0f1626;
            --bg-sidebar: #1e293b;
            --bg-card: #2e333f;
            --bg-hover: #2e333f;

            --text-main: #e9ecef;
            --text-muted: #adb5bd;

            --border-color: #767677;

            /* Dark Mode Transparencies */
            --soft-blue: rgba(13, 110, 253, 0.15);
            --text-blue: #6ea8fe;
            --soft-green: rgba(25, 135, 84, 0.15);
            --text-green: #75b798;
            --soft-orange: rgba(255, 193, 7, 0.15);
            --text-orange: #ffda6a;
            --soft-red: rgba(220, 53, 69, 0.15);
            --text-red: #ea868f;
            --soft-teal: rgba(32, 201, 151, 0.15);
            --text-teal: #a9e5d6;
        }

    /* 1. Overview Stats */
    .overview-section {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
    }
    .stats-grid {
        display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px;
    }
    .stat-card {
        padding: 16px; border-radius: 8px; text-align: center; border: 1px solid transparent;
    }
    .sc-orange { background-color: rgba(253, 126, 20, 0.1); color: #fd7e14; }
    .sc-green { background-color: rgba(25, 135, 84, 0.1); color: #198754; }
    .sc-red { background-color: rgba(220, 53, 69, 0.1); color: #dc3545; }
    .sc-blue { background-color: rgba(13, 110, 253, 0.1); color: #0d6efd; }

    .stat-val { font-size: 1.5rem; font-weight: 700; display: block; margin-bottom: 2px; }
    .stat-lbl { font-size: 0.8rem; opacity: 0.8; font-weight: 500; }

    /* Action Row */
    .action-row { display: flex; gap: 16px; }
    .btn-schedule {
        flex: 1;
        background-color: #0ea5e9; color: white; border: none;
        padding: 10px; border-radius: 8px; font-weight: 600;
        transition: 0.2s;
    }
    .btn-schedule:hover { background-color: #0284c7; }

    .btn-join-input {
        flex: 1;
        display: flex;
        border: 1px solid #0ea5e9;
        border-radius: 8px;
        overflow: hidden;
    }
    .join-input {
        flex-grow: 1; border: none; padding: 0 16px; outline: none; background: var(--bg-card); color: var(--text-main);
    }
    .btn-join {
        background-color: transparent; color: #0ea5e9; border: none; padding: 0 20px; font-weight: 600; border-left: 1px solid #0ea5e9;
    }
    .btn-join:hover { background-color: rgba(14, 165, 233, 0.1); }

    /* 2. Tabs */
    .tab-bar {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        display: flex;
        padding: 6px;
        margin-bottom: 24px;
    }
    .tab-item {
        flex: 1; text-align: center; padding: 10px;
        font-size: 0.9rem; font-weight: 600;
        color: var(--text-muted); cursor: pointer; border-radius: 8px; transition: 0.2s;
    }
    .tab-item.active { background-color: #0ea5e9; color: white; }
    .tab-item:hover:not(.active) { background-color: var(--soft-blue); }

    /* 3. Meeting Card */
    .meeting-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 16px;
        position: relative;
    }
    .badge-confirmed {
        position: absolute; top: 24px; right: 24px;
        background-color: rgba(16, 185, 129, 0.1); color: #10b981;
        font-size: 0.7rem; padding: 4px 10px; border-radius: 4px; font-weight: 600;
    }

    .meeting-header { display: flex; gap: 16px; margin-bottom: 16px; }
    .m-icon-box {
        width: 48px; height: 48px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center; font-size: 1.4rem;
        flex-shrink: 0;
    }
    .ic-blue { background-color: rgba(14, 165, 233, 0.1); color: #0ea5e9; }
    .ic-green { background-color: rgba(16, 185, 129, 0.1); color: #10b981; }
    .ic-orange { background-color: rgba(249, 115, 22, 0.1); color: #f97316; }

    .m-title { font-weight: 700; color: var(--text-main); font-size: 1rem; margin-bottom: 2px; }
    .m-sub { font-size: 0.8rem; color: var(--text-muted); }

    /* Meta Grid */
    .m-meta-grid {
        display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 16px;
        margin-bottom: 16px; font-size: 0.85rem; color: var(--text-muted);
    }
    .meta-val { font-weight: 600; color: var(--text-main); margin-left: 6px; }

    /* Link Box */
    .link-box {
        background-color: var(--soft-blue);
        color: var(--text-blue);
        padding: 10px 16px; border-radius: 8px;
        font-size: 0.85rem; margin-bottom: 16px;
        display: flex; align-items: center; gap: 8px;
        text-decoration: none;
    }
    .link-box:hover { background-color: rgba(13, 110, 253, 0.2); }

    /* Participants */
    .participants-label { font-size: 0.8rem; color: var(--text-muted); margin-bottom: 8px; display: block; font-weight: 600; }
    .participant-chips { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 16px; }
    .p-chip {
        border: 1px solid var(--border-color);
        background-color: var(--bg-card);
        color: var(--text-muted);
        font-size: 0.75rem; padding: 4px 10px; border-radius: 20px;
    }

    /* Footer Buttons */
    .card-footer-btns { display: flex; gap: 10px; border-top: 1px solid var(--border-color); padding-top: 16px; }
    .btn-card {
        padding: 8px 16px; border-radius: 6px; font-size: 0.85rem; font-weight: 600; border: 1px solid transparent;
    }
    .btn-view { background-color: var(--soft-blue); color: var(--text-blue); } .btn-view:hover { background-color: var(--text-blue); color: white; }
    .btn-edit { background-color: transparent; border-color: var(--text-blue); color: var(--text-blue); } .btn-edit:hover { background-color: var(--text-blue); color: white; }

    @media(max-width: 991px) {
        .stats-grid { grid-template-columns: 1fr 1fr; }
        .m-meta-grid { grid-template-columns: 1fr; gap: 8px; }
    }
</style>

<div class="content-body">

    <div class="d-flex align-items-center gap-3 mb-4">
        <div class="p-2 bg-primary bg-opacity-10 rounded-3 text-primary"><i class="bi bi-camera-video fs-4"></i></div>
        <div>
            <h5 class="fw-bold m-0 text-main">Schedule Meeting</h5>
            <small class="--text-muted">Welcome back, John!</small>
        </div>
    </div>

    <!-- 1. Meeting Overview Stats -->
    <div class="overview-section">
        <h6 class="fw-bold text-main mb-3"><i class="bi bi-bar-chart-fill me-2 text-primary"></i>Meeting Overview</h6>

        <div class="stats-grid">
            <div class="stat-card sc-orange">
                <span class="stat-val">4</span><span class="stat-lbl">Upcoming</span>
            </div>
            <div class="stat-card sc-green">
                <span class="stat-val">11</span><span class="stat-lbl">Completed</span>
            </div>
            <div class="stat-card sc-red">
                <span class="stat-val">2</span><span class="stat-lbl">Today</span>
            </div>
            <div class="stat-card sc-blue">
                <span class="stat-val">6</span><span class="stat-lbl">This Week</span>
            </div>
        </div>

        <div class="action-row">
            <button class="btn-schedule"><i class="bi bi-plus-lg me-1"></i> Schedule Meeting</button>
            <div class="btn-join-input">
                <input type="text" class="join-input" placeholder="Enter meeting code">
                <button class="btn-join"><i class="bi bi-camera-video me-1"></i> Join Meeting</button>
            </div>
        </div>
    </div>

    <!-- 2. Tabs -->
    <div class="tab-bar">
        <div class="tab-item active">Upcoming</div>
        <div class="tab-item">Past</div>
        <div class="tab-item">Calendar</div>
    </div>

    <!-- 3. Meeting Cards List -->

    <!-- Card 1 -->
    <div class="meeting-card">
        <span class="badge-confirmed">Confirmed</span>
        <div class="meeting-header">
            <div class="m-icon-box ic-blue"><i class="bi bi-camera-video-fill"></i></div>
            <div>
                <h6 class="m-title">Project Discussion with Dr. Wilson</h6>
                <span class="m-sub">Dr. Sarah Wilson</span>
            </div>
        </div>

        <div class="--text-muted small mb-3">Discuss final year project progress and next steps</div>

        <div class="m-meta-grid">
            <div><i class="bi bi-clock me-1"></i> Time <span class="meta-val">01:40 PM - 02:25 PM</span></div>
            <div><i class="bi bi-hourglass-split me-1"></i> Duration <span class="meta-val">45 min</span></div>
            <div><i class="bi bi-camera-video me-1"></i> Type <span class="meta-val">Video Call</span></div>
        </div>

        <a href="#" class="link-box"><i class="bi bi-link-45deg fs-5"></i> Zoom Meeting</a>

        <span class="participants-label">Participants (2)</span>
        <div class="participant-chips">
            <span class="p-chip">Ms. Jennifer Davis</span>
            <span class="p-chip bg-soft-blue text-primary border-primary">John Doe</span>
        </div>

        <div class="card-footer-btns">
            <button class="btn-card btn-view"><i class="bi bi-eye me-1"></i> View Details</button>
            <button class="btn-card btn-edit"><i class="bi bi-pencil me-1"></i> Edit</button>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="meeting-card">
        <span class="badge-confirmed">Confirmed</span>
        <div class="meeting-header">
            <div class="m-icon-box ic-green"><i class="bi bi-layers-fill"></i></div>
            <div>
                <h6 class="m-title">Study Group - Algorithms</h6>
                <span class="m-sub">Study Group Coordinator</span>
            </div>
        </div>

        <div class="--text-muted small mb-3">Weekly study session for advanced algorithms course</div>

        <div class="m-meta-grid">
            <div><i class="bi bi-clock me-1"></i> Time <span class="meta-val">02:40 AM - 04:40 AM</span></div>
            <div><i class="bi bi-hourglass-split me-1"></i> Duration <span class="meta-val">120 min</span></div>
            <div><i class="bi bi-people me-1"></i> Type <span class="meta-val">Hybrid</span></div>
        </div>

        <a href="#" class="link-box"><i class="bi bi-link-45deg fs-5"></i> Library Room 201 / Google Meet</a>

        <span class="participants-label">Participants (4)</span>
        <div class="participant-chips">
            <span class="p-chip">Mike Johnson</span>
            <span class="p-chip">Sarah Kim</span>
            <span class="p-chip">Alex Chen</span>
            <span class="p-chip bg-soft-blue text-primary border-primary">John Doe</span>
        </div>

        <div class="card-footer-btns">
            <button class="btn-card btn-view"><i class="bi bi-eye me-1"></i> View Details</button>
            <button class="btn-card btn-edit"><i class="bi bi-pencil me-1"></i> Edit</button>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="meeting-card">
        <span class="badge-confirmed">Confirmed</span>
        <div class="meeting-header">
            <div class="m-icon-box ic-orange"><i class="bi bi-briefcase-fill"></i></div>
            <div>
                <h6 class="m-title">Internship Interview - TechCorp</h6>
                <span class="m-sub">TechCorp HR</span>
            </div>
        </div>

        <div class="--text-muted small mb-3">Technical interview for summer internship position</div>

        <div class="m-meta-grid">
            <div><i class="bi bi-clock me-1"></i> Time <span class="meta-val">01:40 AM - 02:40 AM</span></div>
            <div><i class="bi bi-hourglass-split me-1"></i> Duration <span class="meta-val">60 min</span></div>
            <div><i class="bi bi-camera-video me-1"></i> Type <span class="meta-val">Video Call</span></div>
        </div>

        <a href="#" class="link-box"><i class="bi bi-link-45deg fs-5"></i> Microsoft Teams</a>

        <span class="participants-label">Participants (3)</span>
        <div class="participant-chips">
            <span class="p-chip">Ms. Lisa Rodriguez</span>
            <span class="p-chip">Dr. Mark Thompson</span>
            <span class="p-chip bg-soft-blue text-primary border-primary">John Doe</span>
        </div>

        <div class="card-footer-btns">
            <button class="btn-card btn-view"><i class="bi bi-eye me-1"></i> View Details</button>
            <button class="btn-card btn-edit"><i class="bi bi-pencil me-1"></i> Edit</button>
        </div>
    </div>

</div>
@endsection
