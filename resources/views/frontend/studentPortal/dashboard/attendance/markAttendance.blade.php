@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Mark Attendance')

@section('content')
<style>
    /* Theme Variables */
    :root {
        --bg-card: #ffffff;
        --text-main: #343a40;
        --text-muted: #6c757d;
        --border-color: #e9ecef;

        /* Provided Palette */
        --soft-blue: #e7f1ff; --text-blue: #0d6efd;
        --soft-green: #d1e7dd; --text-green: #0f5132;
        --soft-cyan: #cff4fc; --text-cyan: #055160;
        --soft-orange: #ffecb5; --text-orange: #664d03;
        --soft-teal: #e0fbf6; --text-teal: #20c997;

        /* Additional required colors for this page */
        --soft-purple: #e0cffc; --text-purple: #6f42c1;
        --soft-red: #f8d7da; --text-red: #842029;
    }

    [data-theme="dark"] {
        --bg-card: #2e333f; /* Your specific dark card color */
        --text-main: #e9ecef;
        --text-muted: #adb5bd;
        --border-color: #2c2c2c;

        /* Dark Mode Transparencies */
        --soft-blue: rgba(13, 110, 253, 0.15); --text-blue: #6ea8fe;
        --soft-green: rgba(25, 135, 84, 0.15); --text-green: #75b798;
        --soft-cyan: rgba(13, 202, 240, 0.15); --text-cyan: #0dcaf0;
        --soft-orange: rgba(255, 193, 7, 0.15); --text-orange: #ffda6a;
        --soft-teal: rgba(32, 201, 151, 0.15); --text-teal: #20c997;

        /* Additional required colors adapted for dark mode */
        --soft-purple: rgba(111, 66, 193, 0.15); --text-purple: #a370f7;
        --soft-red: rgba(220, 53, 69, 0.15); --text-red: #ea868f;
    }

    /* 1. Daily Stats Section */
    .attendance-header-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
        position: relative;
    }

    .circle-progress-sm {
        width: 60px; height: 60px;
        border-radius: 50%;
        background: conic-gradient(#10b981 50%, #e2e8f0 0);
        display: flex; align-items: center; justify-content: center;
        position: absolute; right: 24px; top: 24px;
    }
    .circle-inner-sm {
        width: 80%; height: 80%;
        background-color: var(--bg-card);
        border-radius: 50%;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        font-size: 0.7rem; font-weight: 700; color: #10b981;
    }

    .stat-box-row {
        display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-top: 20px;
    }
    .stat-mini-card {
        padding: 16px; border-radius: 8px; text-align: center;
    }
    .val-lg { font-size: 1.2rem; font-weight: 700; display: block; margin-bottom: 2px; color: var(--text-main); }
    .lbl-sm { font-size: 0.75rem; opacity: 0.8; color: var(--text-muted); }

    .bg-stat-green { background-color: var(--soft-green); color: var(--text-green); }
    .bg-stat-orange { background-color: var(--soft-orange); color: var(--text-orange); }
    .bg-stat-blue { background-color: var(--soft-blue); color: var(--text-blue); }
    .bg-stat-purple { background-color: var(--soft-purple); color: var(--text-purple); }

    /* 2. Location Info */
    .loc-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
    }
    .loc-banner {
        background-color: #e0f2fe; color: #0284c7;
        padding: 10px 16px; border-radius: 8px; font-size: 0.9rem; font-weight: 500;
        margin-bottom: 16px; display: flex; align-items: center; gap: 8px;
    }
    [data-theme="dark"] .loc-banner { background-color: rgba(14, 165, 233, 0.15); color: #38bdf8; }

    .nearby-list { display: flex; flex-direction: column; gap: 8px; }
    .nearby-item {
        display: flex; justify-content: space-between; padding: 10px 16px;
        background-color: var(--bg-hover); border-radius: 8px;
        font-size: 0.85rem; color: var(--text-muted); border: 1px solid transparent;
    }
    /* Fixed hover/active states for dark mode visibility */
    .nearby-item.active { background-color: var(--soft-green); color: var(--text-green); border-color: var(--text-green); }
    .nearby-item.error { background-color: var(--soft-red); color: var(--text-red); border-color: var(--text-red); }

    /* 3. Class List */
    .class-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 16px;
        border-left: 4px solid transparent;
    }
    .class-card.present { border-left-color: #10b981; background-color: rgba(16, 185, 129, 0.05); }
    .class-card.pending { border-left-color: #f59e0b; background-color: rgba(245, 158, 11, 0.05); }
    .class-card.upcoming { border-left-color: #3b82f6; background-color: rgba(59, 130, 246, 0.05); }

    .class-header { display: flex; justify-content: space-between; margin-bottom: 12px; }
    .class-title { font-weight: 600; color: var(--text-main); margin-bottom: 2px; }
    .class-prof { font-size: 0.75rem; color: var(--text-muted); }

    .status-badge { font-size: 0.65rem; padding: 4px 10px; border-radius: 20px; font-weight: 600; height: fit-content; }
    .st-present { background-color: #d1fae5; color: #065f46; }
    .st-pending { background-color: #ffedd5; color: #9a3412; }
    .st-upcoming { background-color: #dbeafe; color: #1e40af; }

    /* Dark mode badges */
    [data-theme="dark"] .st-present { background-color: rgba(16, 185, 129, 0.2); color: #6ee7b7; }
    [data-theme="dark"] .st-pending { background-color: rgba(245, 158, 11, 0.2); color: #fcd34d; }
    [data-theme="dark"] .st-upcoming { background-color: rgba(59, 130, 246, 0.2); color: #93c5fd; }

    .class-meta-row { display: grid; grid-template-columns: 1fr 2fr 1fr; gap: 10px; font-size: 0.8rem; color: var(--text-muted); align-items: center; }
    .meta-val { display: block; font-weight: 600; color: var(--text-main); margin-top: 2px; }
    .marked-box { margin-top: 12px; padding: 8px 12px; background-color: rgba(16, 185, 129, 0.1); color: #10b981; border-radius: 6px; font-size: 0.75rem; display: inline-flex; align-items: center; gap: 6px; }

    /* 4. Recent Attendance Styles */
    .recent-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 0;
        overflow: hidden;
    }
    .recent-row {
        display: flex; justify-content: space-between; align-items: center;
        padding: 10px 24px;
        border-bottom: 1px solid var(--border-color);
    }
    .recent-row:last-child { border-bottom: none; }

    .status-dot { font-size: 0.5rem; margin-right: 8px; }
    .badge-percent { font-size: 0.7rem; padding: 4px 10px; border-radius: 4px; font-weight: 700; min-width: 50px; text-align: center; }

    @media(max-width: 768px) {
        .stat-box-row { grid-template-columns: 1fr 1fr; }
        .class-meta-row { grid-template-columns: 1fr; gap: 16px; }
    }
</style>

<div class="content-body">

    <div class="d-flex align-items-center gap-3 mb-4">
            <div class="p-2 bg-primary bg-opacity-10 rounded-3 text-primary"><i class="bi bi-geo-alt fs-4"></i></div>
            <div>
                <h5 class="fw-bold m-0">Mark Attendance</h5>
                <small class="text-secondary">Welcome back, John!</small>
            </div>
        </div>
    <!-- 1. Header & Daily Stats -->
    <div class="attendance-header-card">
        <div class="d-flex align-items-center gap-2 mb-2">
            <i class="bi bi-check-circle-fill text-success fs-5"></i>
            <h6 class="fw-bold text-main m-0">Today's Attendance</h6>
        </div>
        <div class="circle-progress-sm">
            <div class="circle-inner-sm"><span>2/4</span><span>Classes</span></div>
        </div>
        <div class="stat-box-row">
            <div class="stat-mini-card bg-stat-green"><span class="val-lg">2</span><span class="lbl-sm">Present</span></div>
            <div class="stat-mini-card bg-stat-orange"><span class="val-lg">2</span><span class="lbl-sm">Pending</span></div>
            <div class="stat-mini-card bg-stat-blue"><span class="val-lg">7 days</span><span class="lbl-sm">Streak</span></div>
            <div class="stat-mini-card bg-stat-purple"><span class="val-lg">92.5%</span><span class="lbl-sm">Overall</span></div>
        </div>
    </div>

    <!-- 2. Location Info -->
    <div class="loc-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold text-main m-0"><i class="bi bi-geo-alt-fill text-primary me-2"></i>Location Information</h6>
            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25"><i class="bi bi-broadcast me-1"></i> GPS Active</span>
        </div>
        <div class="loc-banner"><i class="bi bi-cursor-fill"></i> Current: Computer Science Building</div>
        <h6 class="--text-muted small fw-bold mb-2">Nearby Class Locations</h6>
        <div class="nearby-list">
            <div class="nearby-item active"><span><i class="bi bi-check-circle me-2"></i> Room 101, CS Building</span><span>15.2m</span></div>
            <div class="nearby-item active"><span><i class="bi bi-check-circle me-2"></i> Room 205, CS Building</span><span>32.8m</span></div>
            <div class="nearby-item error"><span><i class="bi bi-x-circle me-2"></i> Lab 102, CS Building</span><span>45.1m</span></div>
        </div>
    </div>

    <!-- 3. Today's Classes List -->
    <h6 class="fw-bold text-main mb-3"><i class="bi bi-calendar-day me-2 text-warning"></i>Today's Classes</h6>

    <!-- Class 1: Present -->
    <div class="class-card present">
        <div class="class-header">
            <div><h6 class="class-title">Data Structures & Algorithms</h6><span class="class-prof">Dr. Sarah Wilson</span></div>
            <span class="status-badge st-present">Present</span>
        </div>
        <div class="class-meta-row">
            <div><span><i class="bi bi-clock"></i> Time</span><span class="meta-val">09:00 - 10:30</span></div>
            <div><span><i class="bi bi-geo-alt"></i> Location</span><span class="meta-val">Room 101, Computer Science Building</span></div>
            <div class="text-end"><span><i class="bi bi-phone"></i> Type</span><span class="meta-val">GPS</span></div>
        </div>
        <div class="marked-box"><i class="bi bi-check-circle-fill"></i> Marked at 09:05</div>
    </div>

    <!-- Class 2: Present -->
    <div class="class-card present">
        <div class="class-header">
            <div><h6 class="class-title">Database Management Systems</h6><span class="class-prof">Prof. Michael Chen</span></div>
            <span class="status-badge st-present">Present</span>
        </div>
        <div class="class-meta-row">
            <div><span><i class="bi bi-clock"></i> Time</span><span class="meta-val">11:00 - 12:30</span></div>
            <div><span><i class="bi bi-geo-alt"></i> Location</span><span class="meta-val">Room 205, Computer Science Building</span></div>
            <div class="text-end"><span><i class="bi bi-qr-code"></i> Type</span><span class="meta-val">QR Code</span></div>
        </div>
        <div class="marked-box"><i class="bi bi-check-circle-fill"></i> Marked at 11:03</div>
    </div>

    <!-- Class 3: Pending -->
    <div class="class-card pending">
        <div class="class-header">
            <div><h6 class="class-title">Software Engineering</h6><span class="class-prof">Dr. Emily Rodriguez</span></div>
            <span class="status-badge st-pending">Pending</span>
        </div>
        <div class="class-meta-row">
            <div><span><i class="bi bi-clock"></i> Time</span><span class="meta-val">14:00 - 15:30</span></div>
            <div><span><i class="bi bi-geo-alt"></i> Location</span><span class="meta-val">Room 301, Computer Science Building</span></div>
            <div class="text-end"><span><i class="bi bi-phone"></i> Type</span><span class="meta-val">GPS</span></div>
        </div>
        <button class="btn btn-warning w-100 mt-3 fw-bold text-white"><i class="bi bi-fingerprint me-2"></i> Mark Attendance</button>
    </div>

    <!-- Class 4: Upcoming -->
    <div class="class-card upcoming">
        <div class="class-header">
            <div><h6 class="class-title">Web Development</h6><span class="class-prof">Mr. David Kim</span></div>
            <span class="status-badge st-upcoming">Upcoming</span>
        </div>
        <div class="class-meta-row">
            <div><span><i class="bi bi-clock"></i> Time</span><span class="meta-val">16:00 - 17:30</span></div>
            <div><span><i class="bi bi-geo-alt"></i> Location</span><span class="meta-val">Lab 102, Computer Science Building</span></div>
            <div class="text-end"><span><i class="bi bi-person-check"></i> Type</span><span class="meta-val">Manual</span></div>
        </div>
    </div>

    <!-- 4. Recent Attendance Section -->
    <h6 class="fw-bold text-main mb-3 mt-4"><i class="bi bi-clock-history me-2 text-primary"></i>Recent Attendance</h6>

    <div class="recent-card">
        <!-- Yesterday -->
        <div class="recent-row">
            <div class="d-flex align-items-center gap-2 --text-muted small">
                <i class="bi bi-circle-fill status-dot text-success"></i> Yesterday
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="fw-bold text-main small">3/3</span>
                <span class="badge-percent bg-stat-green">100%</span>
            </div>
        </div>

        <!-- 2d ago -->
        <div class="recent-row">
            <div class="d-flex align-items-center gap-2 --text-muted small">
                <i class="bi bi-circle-fill status-dot text-success"></i> 2d ago
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="fw-bold text-main small">4/4</span>
                <span class="badge-percent bg-stat-green">100%</span>
            </div>
        </div>

        <!-- 3d ago -->
        <div class="recent-row">
            <div class="d-flex align-items-center gap-2 --text-muted small">
                <i class="bi bi-circle-fill status-dot text-success"></i> 3d ago
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="fw-bold text-main small">2/2</span>
                <span class="badge-percent bg-stat-green">100%</span>
            </div>
        </div>

        <!-- 4d ago -->
        <div class="recent-row">
            <div class="d-flex align-items-center gap-2 --text-muted small">
                <i class="bi bi-circle-fill status-dot text-warning"></i> 4d ago
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="fw-bold text-main small">3/4</span>
                <span class="badge-percent bg-stat-orange">75%</span>
            </div>
        </div>

        <!-- 5d ago -->
        <div class="recent-row">
            <div class="d-flex align-items-center gap-2 --text-muted small">
                <i class="bi bi-circle-fill status-dot text-success"></i> 5d ago
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="fw-bold text-main small">3/3</span>
                <span class="badge-percent bg-stat-green">100%</span>
            </div>
        </div>
    </div>

</div>
@endsection
