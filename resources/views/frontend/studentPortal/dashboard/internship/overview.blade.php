@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Internship Overview')
@section('icon', 'bi bi-eye fs-4 p-2 bg-primary bg-opacity-10 rounded-3 text-primary')

@section('content')
<style>
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

    /* Common Card */
    .card-custom {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 24px;
    }

    /* 1. Header Styles */
    .intern-icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        background-color: var(--soft-blue);
        color: var(--text-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
    }

    .badge-remote {
        background-color: #d1e7dd;
        color: #0f5132;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .meta-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 20px;
        margin-top: 24px;
        margin-bottom: 24px;
    }

    .meta-item i {
        font-size: 1.1rem;
        color: var(--text-blue);
        margin-right: 8px;
    }

    .meta-label {
        font-size: 0.75rem;
        color: var(--text-muted);
        display: block;
        margin-bottom: 2px;
    }

    .meta-value {
        font-weight: 600;
        color: var(--text-main);
        font-size: 0.95rem;
    }

    .tech-pill {
        background-color: var(--border-color);
        color: var(--text-main);
        font-size: 0.75rem;
        padding: 4px 12px;
        border-radius: 20px;
        margin-right: 6px;
        font-weight: 500;
    }

    .pill-react {
        background-color: #e0f7fa;
        color: #006064;
    }

    .pill-node {
        background-color: #e8f5e9;
        color: #1b5e20;
    }

    .pill-mongo {
        background-color: #f3e5f5;
        color: #4a148c;
    }

    /* 2. Phase & Stats Styles */
    .phase-icon {
        width: 40px;
        height: 40px;
        background-color: var(--soft-blue);
        color: var(--text-blue);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .phase-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text-blue);
    }

    .progress-bar-custom {
        height: 8px;
        background-color: var(--border-color);
        border-radius: 4px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        border-radius: 4px;
        background-color: var(--text-blue);
    }

    .stats-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 0.9rem;
    }

    .stats-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 8px;
    }

    .dot-green {
        background-color: #198754;
    }

    .dot-blue {
        background-color: #0d6efd;
    }

    .dot-orange {
        background-color: #fd7e14;
    }

    .stats-val {
        font-weight: 700;
    }

    .stats-val.green {
        color: #198754;
    }

    .stats-val.blue {
        color: #0d6efd;
    }

    .stats-val.orange {
        color: #fd7e14;
    }

    /* 3. Timeline Styles */
    .timeline-container {
        position: relative;
        padding-left: 12px;
    }

    .timeline-container::before {
        content: '';
        position: absolute;
        left: 19px;
        top: 10px;
        bottom: 30px;
        width: 2px;
        background-color: var(--border-color);
        z-index: 0;
    }

    .timeline-item {
        display: flex;
        gap: 16px;
        margin-bottom: 32px;
        position: relative;
        z-index: 1;
    }

    .tl-icon {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        margin-top: 6px;
        border: 2px solid white;
        box-shadow: 0 0 0 2px white;
    }

    .tl-completed {
        background-color: #198754;
        box-shadow: 0 0 0 4px #d1e7dd;
    }

    .tl-current {
        background-color: #0d6efd;
        box-shadow: 0 0 0 4px #cfe2ff;
    }

    .tl-pending {
        background-color: #adb5bd;
    }

    .tl-content h6 {
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 2px;
        font-size: 0.95rem;
    }

    .tl-content p {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-bottom: 6px;
    }

    .tl-meta {
        font-size: 0.75rem;
        color: #0d6efd;
        font-weight: 500;
        background: var(--soft-blue);
        padding: 2px 8px;
        border-radius: 4px;
    }

    .tl-meta.green {
        color: #198754;
        background: #d1e7dd;
    }

    /* 4. Recent Activity Styles */
    .activity-item {
        display: flex;
        gap: 16px;
        padding-bottom: 16px;
        margin-bottom: 16px;
        border-bottom: 1px solid var(--border-color);
    }

    .activity-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .act-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }

    .bg-act-blue {
        background: var(--soft-blue);
        color: var(--text-blue);
    }

    .bg-act-green {
        background: var(--soft-green);
        color: var(--text-green);
    }

    .bg-act-teal {
        background: var(--soft-teal);
        color: var(--text-teal);
    }

    /* 5. Quick Actions Styles */
    .action-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px;
        border-radius: 12px;
        margin-bottom: 12px;
        text-decoration: none;
        transition: 0.2s;
        border: 1px solid transparent;
    }

    .action-card:hover {
        transform: translateX(4px);
    }

    .ac-blue {
        background-color: var(--soft-blue);
        color: var(--text-main);
        border-color: #cfe2ff;
    }

    .ac-green {
        background-color: var(--soft-green);
        color: var(--text-main);
        border-color: #d1e7dd;
    }

    .ac-orange {
        background-color: var(--soft-orange);
        color: var(--text-main);
        border-color: #ffe69c;
    }

    .action-icon-box {
        width: 32px;
        height: 32px;
        background: rgba(255, 255, 255, 0.6);
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
    }

    .action-title {
        font-size: 0.9rem;
        font-weight: 700;
        display: block;
    }

    .action-sub {
        font-size: 0.75rem;
        opacity: 0.7;
    }
</style>

<div class="content-body">

    <!-- 1. Header Card -->
    <div class="card-custom">
        <div class="d-flex justify-content-between align-items-start mb-2">
            <div class="d-flex gap-3">
                <div class="intern-icon"><i class="bi bi-briefcase"></i></div>
                <div>
                    <h5 class="fw-bold text-main mb-1">Full-Stack Development Internship</h5>
                    <p class="--text-muted mb-0">at TechCorp Solutions Pvt Ltd</p>
                </div>
            </div>
            <span class="badge-remote">Remote</span>
        </div>

        <div class="meta-grid">
            <div class="meta-item">
                <div class="d-flex align-items-start">
                    <i class="bi bi-clock-history"></i>
                    <div><span class="meta-label">Duration</span><span class="meta-value">120 days</span></div>
                </div>
            </div>
            <div class="meta-item">
                <div class="d-flex align-items-start">
                    <i class="bi bi-currency-rupee"></i>
                    <div><span class="meta-label">Stipend</span><span class="meta-value">₹15000/month</span></div>
                </div>
            </div>
            <div class="meta-item">
                <div class="d-flex align-items-start">
                    <i class="bi bi-calendar-event"></i>
                    <div><span class="meta-label">Progress</span><span class="meta-value">Day 26 of 120</span></div>
                </div>
            </div>
            <div class="meta-item">
                <div class="d-flex align-items-start">
                    <i class="bi bi-person"></i>
                    <div><span class="meta-label">Mentor</span><span class="meta-value">Rajesh Kumar</span></div>
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <span class="--text-muted small fw-bold me-2">Technologies:</span>
            <span class="tech-pill pill-react">React</span>
            <span class="tech-pill pill-node">Node.js</span>
            <span class="tech-pill pill-mongo">MongoDB</span>
            <span class="tech-pill">AWS</span>
        </div>
    </div>

    <!-- 2. Middle Row: Current Phase & Stats -->
    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card-custom h-100 mb-0">
                <div class="d-flex gap-3 mb-3">
                    <div class="phase-icon"><i class="bi bi-play-fill"></i></div>
                    <div>
                        <span class="--text-muted small">Current Phase</span>
                        <div class="phase-name">Core Development</div>
                    </div>
                </div>
                <p class="--text-muted small mb-4">Main project development and skill building</p>
                <div class="d-flex justify-content-between small fw-bold mb-1 --text-muted">
                    <span>Progress</span> <span class="text-primary">35%</span>
                </div>
                <div class="progress-bar-custom mb-3">
                    <div class="progress-fill" style="width: 35%;"></div>
                </div>
                <small class="--text-muted"><i class="bi bi-check-square me-1 text-primary"></i> Tasks: 5/15
                    completed</small>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-custom h-100 mb-0  border-0">
                <div class="d-flex align-items-center gap-2 mb-4">
                    <i class="bi bi-graph-up-arrow text-success"></i>
                    <h6 class="fw-bold text-main m-0">Progress Statistics</h6>
                </div>
                <div class="stats-row"><span><i class="stats-dot dot-green"></i> Overall Progress</span> <span
                        class="stats-val green">22%</span></div>
                <div class="stats-row"><span><i class="stats-dot dot-blue"></i> Tasks Completed</span> <span
                        class="stats-val blue">13/39</span></div>
                <div class="stats-row"><span><i class="stats-dot dot-orange"></i> Current Streak</span> <span
                        class="stats-val orange">5 days</span></div>
                <div class="stats-row"><span><i class="stats-dot dot-green"></i> Skills Acquired</span> <span
                        class="stats-val green">6</span></div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- LEFT COL: Timeline & Recent Activity -->
        <div class="col-lg-8">

            <!-- 3. Internship Timeline -->
            <div class="card-custom">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-layers text-primary fs-5"></i>
                        <h6 class="fw-bold text-main m-0">Internship Timeline</h6>
                    </div>
                    <a href="#" class="small text-primary text-decoration-none fw-bold">View Details</a>
                </div>
                <div class="timeline-container">
                    <div class="timeline-item">
                        <div class="tl-icon tl-completed"></div>
                        <div class="tl-content">
                            <h6>Foundation & Setup</h6>
                            <p>Environment setup, technology overview, and initial tasks</p>
                            <span class="tl-meta green">8/8 tasks</span>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="tl-icon tl-current"></div>
                        <div class="tl-content">
                            <h6 class="text-primary">Core Development</h6>
                            <p>Main project development and skill building</p>
                            <span class="tl-meta">5/15 tasks</span>
                        </div>
                    </div>
                    <div class="timeline-item mb-0">
                        <div class="tl-icon tl-pending"></div>
                        <div class="tl-content">
                            <h6 class="--text-muted">Integration & Testing</h6>
                            <p>System integration, testing, and optimization</p>
                            <span class="--text-muted small">0/10 tasks</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. Recent Activities (ADDED) -->
            <div class="card-custom">
                <div class="d-flex align-items-center gap-2 mb-4">
                    <i class="bi bi-activity text-primary fs-5"></i>
                    <h6 class="fw-bold text-main m-0">Recent Activities</h6>
                </div>
                <div class="activity-item">
                    <div class="act-icon bg-act-green"><i class="bi bi-check-lg"></i></div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between"><span class="fw-bold text-main small">Completed User
                                Auth Module</span><small class="--text-muted">3h ago</small></div>
                        <small class="--text-muted">Implemented secure login/logout with JWT</small>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="act-icon bg-act-blue"><i class="bi bi-eye"></i></div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between"><span class="fw-bold text-main small">Code Review
                                Session</span><small class="--text-muted">8h ago</small></div>
                        <small class="--text-muted">Reviewed authentication logic and feedback</small>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="act-icon bg-act-blue"><i class="bi bi-people"></i></div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between"><span class="fw-bold text-main small">Weekly
                                Progress Meeting</span><small class="--text-muted">1d ago</small></div>
                        <small class="--text-muted">Discussed current progress and next objectives</small>
                    </div>
                </div>
                <div class="activity-item mb-0">
                    <div class="act-icon bg-act-teal"><i class="bi bi-award"></i></div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between"><span class="fw-bold text-main small">Mastered React
                                Hooks</span><small class="--text-muted">2d ago</small></div>
                        <small class="--text-muted">Successfully implemented custom hooks</small>
                    </div>
                </div>
            </div>

        </div>

        <!-- RIGHT COL: Quick Actions (ADDED) -->
        <div class="col-lg-4">
            <h6 class="fw-bold text-main mb-3">Quick Actions</h6>

            <a href="#" class="action-card ac-blue">
                <div class="d-flex align-items-center">
                    <div class="action-icon-box text-primary"><i class="bi bi-file-text"></i></div>
                    <div><span class="action-title">View Tasks</span><span class="action-sub">Check assignments</span>
                    </div>
                </div>
                <i class="bi bi-chevron-right small text-muted"></i>
            </a>

            <a href="#" class="action-card ac-green">
                <div class="d-flex align-items-center">
                    <div class="action-icon-box text-success"><i class="bi bi-graph-up"></i></div>
                    <div><span class="action-title">Track Progress</span><span class="action-sub">View detailed
                            stats</span></div>
                </div>
                <i class="bi bi-chevron-right small text-muted"></i>
            </a>

            <a href="#" class="action-card ac-blue">
                <div class="d-flex align-items-center">
                    <div class="action-icon-box text-primary"><i class="bi bi-people"></i></div>
                    <div><span class="action-title">Contact Mentor</span><span class="action-sub">Schedule
                            meeting</span></div>
                </div>
                <i class="bi bi-chevron-right small text-muted"></i>
            </a>

            <a href="#" class="action-card ac-orange">
                <div class="d-flex align-items-center">
                    <div class="action-icon-box text-warning"><i class="bi bi-award"></i></div>
                    <div><span class="action-title">View Certificate</span><span class="action-sub">Download
                            certificate</span></div>
                </div>
                <i class="bi bi-chevron-right small text-muted"></i>
            </a>
        </div>
    </div>

</div>
@endsection
