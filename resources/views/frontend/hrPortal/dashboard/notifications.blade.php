@extends('frontend.hrPortal.dashboard.layouts.app')

@section('title', 'Notifications')

@section('icon', 'bi bi-bell-fill fs-4 p-2 bg-soft-purple-custom rounded-3 text-purple-custom')

@section('content')
<style>
    /* --- Page Specific Styles --- */

    /* Header Card */
    .header-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
        display: flex; justify-content: space-between; align-items: center;
    }

    /* Filter Bar */
    .filter-bar {
        display: flex; gap: 16px; margin-bottom: 24px;
    }
    .filter-select {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        padding: 10px 16px;
        border-radius: 8px;
        flex-grow: 1;
        outline: none;
    }
    .btn-refresh {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        color: var(--text-muted);
        width: 42px; height: 42px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 8px;
        transition: 0.2s;
    }
    .btn-refresh:hover { border-color: var(--accent-color); color: var(--accent-color); }

    /* Notification Card */
    .notify-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 16px;
        position: relative;
        overflow: hidden;
        transition: transform 0.2s;
        display: flex; flex-direction: column;
    }
    .notify-card:hover { transform: translateY(-2px); }

    /* Colored Accents & Borders */
    .notify-blue { border-left: 4px solid #3b82f6; background: linear-gradient(90deg, rgba(59, 130, 246, 0.05) 0%, rgba(59, 130, 246, 0.01) 100%); }
    .notify-red { border-left: 4px solid #ef4444; background: linear-gradient(90deg, rgba(239, 68, 68, 0.05) 0%, rgba(239, 68, 68, 0.01) 100%); }
    .notify-green { border-left: 4px solid #10b981; background: linear-gradient(90deg, rgba(16, 185, 129, 0.05) 0%, rgba(16, 185, 129, 0.01) 100%); }
    .notify-orange { border-left: 4px solid #f59e0b; background: linear-gradient(90deg, rgba(245, 158, 11, 0.05) 0%, rgba(245, 158, 11, 0.01) 100%); }

    /* Icons inside Card */
    .notify-icon {
        font-size: 1.2rem; margin-right: 12px;
    }
    .text-blue { color: #3b82f6; }
    .text-red { color: #ef4444; }
    .text-green { color: #10b981; }
    .text-orange { color: #f59e0b; }

    /* Priority Badge (Dot) */
    .priority-badge {
        font-size: 0.65rem; font-weight: 700; text-transform: uppercase;
        display: flex; align-items: center; gap: 4px;
        letter-spacing: 0.5px;
    }
    .dot { width: 6px; height: 6px; border-radius: 50%; display: inline-block; }
    .dot-blue { background-color: #3b82f6; }
    .dot-red { background-color: #ef4444; }
    .dot-green { background-color: #10b981; }
    .dot-orange { background-color: #f59e0b; }

    /* Action Link (Bottom Left) */
    .action-link {
        font-size: 0.8rem; text-decoration: none; display: flex; align-items: center; gap: 4px; margin-top: 12px;
    }
    .action-link:hover { text-decoration: underline; }

    /* Top Right Menu */
    .card-menu {
        position: absolute; top: 16px; right: 16px;
        color: var(--text-muted); cursor: pointer;
    }

    /* Unread Badge Main */
    .badge-unread-main {
        background-color: rgba(239, 68, 68, 0.15); color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.2);
        padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;
    }

    .mark-read-btn {
        color: var(--text-muted); font-size: 0.8rem; text-decoration: none; transition: 0.2s;
    }
    .mark-read-btn:hover { color: var(--accent-color); }

    /* Utilities */
    .text-purple-custom { color: #8b5cf6; }
    .bg-soft-purple-custom { background-color: rgba(139, 92, 246, 0.1); }
</style>

<div class="header-card">
    <div class="d-flex align-items-center gap-3">
        <div class="rounded-circle bg-soft-purple-custom d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
            <i class="bi bi-bell-fill text-purple-custom fs-4"></i>
        </div>
        <div>
            <h5 class="fw-bold mb-1 text-main">Notification Center</h5>
            <small class="--text-muted">Stay updated with important HR activities and alerts</small>
        </div>
    </div>
    <div class="text-end">
        <span class="badge-unread-main mb-1 d-inline-block">4 Unread</span>
        <br>
        <a href="#" class="mark-read-btn">Mark all read</a>
    </div>
</div>

<div class="filter-bar">
    <select class="filter-select">
        <option>All Types</option>
        <option>Applications</option>
        <option>Interviews</option>
        <option>System</option>
    </select>
    <select class="filter-select">
        <option>All Priorities</option>
        <option>Urgent</option>
        <option>High</option>
        <option>Medium</option>
    </select>
    <button class="btn-refresh"><i class="bi bi-arrow-clockwise"></i></button>
</div>

<div class="d-flex flex-column">

    <div class="notify-card notify-blue">
        <div class="d-flex justify-content-between align-items-start">
            <div class="d-flex">
                <i class="bi bi-file-earmark-text-fill notify-icon text-blue"></i>
                <div>
                    <h6 class="fw-bold text-main mb-1">New Job Application Received</h6>
                    <p class="--text-muted small mb-0">Sarah Martinez has applied for Senior Software Engineer position</p>
                </div>
            </div>
            <div class="text-end">
                <div class="priority-badge text-orange mb-1"><span class="dot dot-orange"></span> High</div>
                <small class="--text-muted" style="font-size: 0.7rem;">5m ago</small>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <a href="#" class="action-link text-blue"><i class="bi bi-arrow-return-right"></i> View Application</a>
            <i class="bi bi-three-dots-vertical card-menu small"></i>
        </div>
    </div>

    <div class="notify-card notify-red">
        <div class="d-flex justify-content-between align-items-start">
            <div class="d-flex">
                <i class="bi bi-calendar-event-fill notify-icon text-red"></i>
                <div>
                    <h6 class="fw-bold text-main mb-1">Interview Reminder</h6>
                    <p class="--text-muted small mb-0">Interview with David Chen scheduled in 30 minutes</p>
                </div>
            </div>
            <div class="text-end">
                <div class="priority-badge text-red mb-1"><span class="dot dot-red"></span> Urgent</div>
                <small class="--text-muted" style="font-size: 0.7rem;">10m ago</small>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <a href="#" class="action-link text-red"><i class="bi bi-camera-video"></i> Join Interview</a>
            <i class="bi bi-three-dots-vertical card-menu small"></i>
        </div>
    </div>

    <div class="notify-card notify-green">
        <div class="d-flex justify-content-between align-items-start">
            <div class="d-flex">
                <i class="bi bi-star-fill notify-icon text-green"></i>
                <div>
                    <h6 class="fw-bold text-main mb-1">Performance Review Due</h6>
                    <p class="--text-muted small mb-0">5 employees have performance reviews due this week</p>
                </div>
            </div>
            <div class="text-end">
                <div class="priority-badge text-blue mb-1"><span class="dot dot-blue"></span> Medium</div>
                <small class="--text-muted" style="font-size: 0.7rem;">2h ago</small>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <a href="#" class="action-link text-green"><i class="bi bi-clipboard-check"></i> Review Performance</a>
            <i class="bi bi-three-dots-vertical card-menu small"></i>
        </div>
    </div>

    <div class="notify-card notify-orange">
        <div class="d-flex justify-content-between align-items-start">
            <div class="d-flex">
                <i class="bi bi-clock-history notify-icon text-orange"></i>
                <div>
                    <h6 class="fw-bold text-main mb-1">Attendance Alert</h6>
                    <p class="--text-muted small mb-0">Emma Wilson has been marked absent for 3 consecutive days</p>
                </div>
            </div>
            <div class="text-end">
                <div class="priority-badge text-orange mb-1"><span class="dot dot-orange"></span> High</div>
                <small class="--text-muted" style="font-size: 0.7rem;">4h ago</small>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <a href="#" class="action-link text-orange"><i class="bi bi-person-check"></i> Check Attendance</a>
            <i class="bi bi-three-dots-vertical card-menu small"></i>
        </div>
    </div>

</div>
@endsection
