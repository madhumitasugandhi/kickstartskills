@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Notifications')
@section('icon', 'bi bi-bell fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')
<style>
    /* Theme Variables */
    :root {
        --bg-card: #ffffff;
        --bg-hover: #f8f9fa;
        --text-main: #343a40;
        --text-muted: #6c757d;
        --border-color: #e9ecef;

        --soft-blue: #e7f1ff; --text-blue: #0d6efd;
        --soft-red: #f8d7da; --text-red: #842029;
        --soft-orange: #ffecb5; --text-orange: #664d03;
    }

    [data-theme="dark"] {
        --bg-card: #1e293b;
        --bg-hover: #334155;
        --text-main: #e9ecef;
        --text-muted: #94a3b8;
        --border-color: #334155;

        --soft-blue: rgba(13, 110, 253, 0.15); --text-blue: #6ea8fe;
        --soft-red: rgba(220, 53, 69, 0.15); --text-red: #ea868f;
        --soft-orange: rgba(255, 193, 7, 0.15); --text-orange: #ffda6a;
    }

    /* Notification Card */
    .notif-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 12px;
        position: relative;
        transition: background-color 0.2s;
    }
    .notif-card:hover { background-color: var(--bg-hover); }

    .notif-icon-box {
        width: 40px; height: 40px;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    .icon-red { background-color: rgba(220, 53, 69, 0.1); color: #dc3545; }
    .icon-blue { background-color: rgba(13, 110, 253, 0.1); color: #0d6efd; }
    .icon-orange { background-color: rgba(253, 126, 20, 0.1); color: #fd7e14; }

    .priority-dot {
        width: 8px; height: 8px; border-radius: 50%; display: inline-block; margin-right: 4px;
    }
    .dot-high { background-color: #dc3545; }
    .dot-med { background-color: #fd7e14; }

    .priority-text { font-size: 0.7rem; font-weight: 600; text-transform: uppercase; }
    .text-high { color: #dc3545; }
    .text-med { color: #fd7e14; }

    .notif-actions {
        display: flex; gap: 12px;
        align-items: center;
        color: var(--text-muted);
    }
    .action-btn { cursor: pointer; transition: 0.2s; }
    .action-btn:hover { color: var(--text-main); }

    /* Responsive */
    @media (max-width: 768px) {
        .filter-row { flex-direction: column; align-items: stretch; gap: 16px; }
        .filter-row > div { width: 100%; }
        .notif-card { padding: 16px; }
    }
</style>

<div class="content-body">

    <div class="card-custom mb-4" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 20px;">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <div class="fs-4 p-2 bg-soft-orange rounded-3 text-accent position-relative">
                    <i class="bi bi-bell-fill fs-3"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">3</span>
                </div>
                <div>
                    <h4 class="fw-bold text-main mb-1">Notifications</h4>
                    <p class="text-muted-custom mb-0 small">Stay updated with important mentoring activities and alerts</p>
                </div>
            </div>
            <button class="btn btn-sm btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center p-0"
                    style="width: 36px; height: 36px;">
                <i class="bi bi-gear"></i>
            </button>
        </div>
    </div>

    <div class="card-custom mb-4 p-4" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px;">
        <h6 class="fw-bold text-main mb-3">Filters & Actions</h6>

        <div class="d-flex justify-content-between align-items-center filter-row">
            <div style="flex: 2;">
                <label class="form-label small text-muted-custom fw-bold mb-1">Filter by Type</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0" style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-muted);">
                        <i class="bi bi-funnel"></i>
                    </span>
                    <select class="form-select border-start-0 ps-0" style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                        <option>All Notifications</option>
                        <option>Alerts</option>
                        <option>Messages</option>
                    </select>
                </div>
            </div>

            <div class="d-flex align-items-center gap-3 bg-bg-hover p-2 rounded border border-secondary-subtle" style="flex: 1; justify-content: space-between;">
                <div class="form-check form-switch m-0">
                    <input class="form-check-input" type="checkbox" role="switch">
                    <label class="form-check-label small text-muted-custom ms-2">Show only unread</label>
                </div>
            </div>

            <div style="flex: 0 0 auto;">
                <button class="btn btn-success w-100 fw-bold" style="background-color: #10b981; border: none;">
                    <i class="bi bi-check2-all me-2"></i> Mark All Read
                </button>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold text-main m-0">Notifications (5)</h6>
        <span class="badge bg-soft-red text-danger border border-danger-subtle rounded-pill">3 unread</span>
    </div>

    <div class="notif-card border-start border-4 border-danger" style="border-left-color: #dc3545 !important;">
        <div class="d-flex justify-content-between align-items-start mb-2">
            <div class="d-flex gap-3">
                <div class="notif-icon-box icon-red">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-main mb-0">Assignment Overdue</h6>
                    <small class="text-danger fw-bold" style="font-size: 0.7rem;">Deadline Alert</small>
                </div>
            </div>
            <div class="text-end">
                <span class="priority-dot dot-high"></span>
                <span class="priority-text text-high">High</span>
            </div>
        </div>

        <p class="text-muted-custom small mb-3 ms-5 ps-2">
            John Doe has not submitted "JavaScript Fundamentals Assessment" which was due 2 days ago.
        </p>

        <div class="d-flex justify-content-between align-items-center ms-5 ps-2">
            <div class="text-muted-custom small">
                <i class="bi bi-clock me-1"></i> 15m ago &nbsp;•&nbsp; <i class="bi bi-person me-1"></i> John Doe
            </div>
            <div class="notif-actions">
                <i class="bi bi-eye action-btn fs-5"></i>
                <i class="bi bi-trash action-btn fs-5"></i>
            </div>
        </div>
    </div>

    <div class="notif-card border-start border-4 border-primary" style="border-left-color: #0d6efd !important;">
        <div class="d-flex justify-content-between align-items-start mb-2">
            <div class="d-flex gap-3">
                <div class="notif-icon-box icon-blue">
                    <i class="bi bi-chat-left-text"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-main mb-0">New Message Received</h6>
                    <small class="text-primary fw-bold" style="font-size: 0.7rem;">Message</small>
                </div>
            </div>
            <div class="text-end">
                <span class="priority-dot dot-med"></span>
                <span class="priority-text text-med">Medium</span>
            </div>
        </div>

        <p class="text-muted-custom small mb-3 ms-5 ps-2">
            Jane Smith sent you a message: "Thank you for the feedback on my React project."
        </p>

        <div class="d-flex justify-content-between align-items-center ms-5 ps-2">
            <div class="text-muted-custom small">
                <i class="bi bi-clock me-1"></i> 1h ago &nbsp;•&nbsp; <i class="bi bi-person me-1"></i> Jane Smith
            </div>
            <div class="notif-actions">
                <i class="bi bi-eye action-btn fs-5"></i>
                <i class="bi bi-trash action-btn fs-5"></i>
            </div>
        </div>
    </div>

    <div class="notif-card border-start border-4 border-warning" style="border-left-color: #fd7e14 !important;">
        <div class="d-flex justify-content-between align-items-start mb-2">
            <div class="d-flex gap-3">
                <div class="notif-icon-box icon-orange">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-main mb-0">Student Needs Support</h6>
                    <small class="text-warning fw-bold" style="font-size: 0.7rem;">Student Alert</small>
                </div>
            </div>
            <div class="text-end">
                <span class="priority-dot dot-high"></span>
                <span class="priority-text text-high">High</span>
            </div>
        </div>

        <p class="text-muted-custom small mb-3 ms-5 ps-2">
            Mike Johnson is struggling with JavaScript fundamentals and has low progress (42%).
        </p>

        <div class="d-flex justify-content-between align-items-center ms-5 ps-2">
            <div class="text-muted-custom small">
                <i class="bi bi-clock me-1"></i> 2h ago &nbsp;•&nbsp; <i class="bi bi-person me-1"></i> Mike Johnson
            </div>
            <div class="notif-actions">
                <i class="bi bi-eye action-btn fs-5"></i>
                <i class="bi bi-trash action-btn fs-5"></i>
            </div>
        </div>
    </div>

</div>
@endsection
