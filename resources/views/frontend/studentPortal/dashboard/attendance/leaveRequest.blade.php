@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Leave Requests')
@section('icon', 'bi bi-calendar-check fs-4 p-2 bg-primary bg-opacity-10 rounded-3 text-primary')

@section('content')
<style>
    /* Theme Variables */
    :root {
        --bg-card: #ffffff;
        --text-main: #343a40;
        --text-muted: #6c757d;
        --border-color: #e9ecef;

        /* Specific Colors */
        --soft-blue: #e7f1ff;
        --text-blue: #0d6efd;
        --soft-green: #d1e7dd;
        --text-green: #0f5132;
        --soft-orange: #ffecb5;
        --text-orange: #664d03;
        --soft-red: #f8d7da;
        --text-red: #842029;
        --soft-teal: #e0fbf6;
        --text-teal: #20c997;

        /* Dark Card for Balance Section (Always Dark style in screenshot) */
        --balance-card-bg: #1e293b;
        --balance-text: #ffffff;
        --balance-border: #334155;
    }

    [data-theme="dark"] {
        --bg-card: #2e333f;
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
        --soft-teal: rgba(32, 201, 151, 0.15);
        --text-teal: #20c997;
    }

    /* 1. Leave Balance Section */
    .balance-card {
        background-color: var(--bg-card);
        /* Matching dark theme from screenshot */
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
        color: var(--text-main);
    }

    .circle-progress-lg {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: conic-gradient(#3b82f6 75%, #334155 0);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    .circle-inner-lg {
        width: 85%;
        height: 85%;
        background-color: var(--balance-card-bg);
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .circle-num {
        font-size: 1.5rem;
        font-weight: 700;
        color: #3b82f6;
        line-height: 1;
    }

    .circle-txt {
        font-size: 0.7rem;
        color: #94a3b8;
        margin-top: 4px;
    }

    .balance-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    .balance-stat-box {
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 16px;
        text-align: center;
    }

    .bs-val {
        font-size: 1.2rem;
        font-weight: 700;
        display: block;
        margin-bottom: 2px;
    }

    .bs-val.red {
        color: #f87171;
    }

    .bs-val.orange {
        color: #fb923c;
    }

    .bs-val.green {
        color: #4ade80;
    }

    .bs-val.blue {
        color: #60a5fa;
    }

    .bs-lbl {
        font-size: 0.75rem;
        opacity: 0.7;
    }

    /* 2. Quick Apply Section */
    .quick-apply-card {
        background-color: var(--bg-card);
        /* Matching dark theme from screenshot */
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
        color: var(--text-main);
    }

    .qa-btn-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    .qa-btn {
        background: transparent;
        border-radius: 8px;
        padding: 16px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transition: 0.2s;
        cursor: pointer;
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #94a3b8;
    }

    .qa-btn:hover {
        background-color: rgba(255, 255, 255, 0.05);
        color: white;
    }

    .qa-btn.sick {
        border-color: rgba(239, 68, 68, 0.3);
        color: #fca5a5;
        background: rgba(239, 68, 68, 0.05);
    }

    .qa-btn.personal {
        border-color: rgba(249, 115, 22, 0.3);
        color: #fdba74;
        background: rgba(249, 115, 22, 0.05);
    }

    .qa-btn.emergency {
        border-color: rgba(220, 38, 38, 0.3);
        color: #fecaca;
        background: rgba(220, 38, 38, 0.05);
    }

    .qa-btn.custom {
        border-color: rgba(59, 130, 246, 0.3);
        color: #93c5fd;
        background: rgba(59, 130, 246, 0.05);
    }

    .qa-icon {
        font-size: 1.2rem;
        margin-bottom: 8px;
    }

    .qa-text {
        font-size: 0.85rem;
        font-weight: 600;
    }

    /* 3. Leave Requests List */
    .filter-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .filter-tabs {
        display: flex;
        gap: 8px;
    }

    .f-tab {
        background: transparent;
        border: none;
        color: var(--text-muted);
        font-size: 0.9rem;
        font-weight: 500;
        padding: 6px 12px;
        border-radius: 6px;
    }

    .f-tab.active {
        background-color: var(--soft-blue);
        color: var(--text-blue);
    }

    /* Request Item Card */
    .req-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 16px;
        border-left: 4px solid transparent;
        position: relative;
    }

    .req-header {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 12px;
    }

    .req-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }

    .icon-sick {
        background-color: var(--soft-green);
        color: var(--text-green);
    }

    .icon-personal {
        background-color: var(--soft-orange);
        color: var(--text-orange);
    }

    .icon-emergency {
        background-color: var(--soft-red);
        color: var(--text-red);
    }

    .icon-academic {
        background-color: var(--soft-blue);
        color: var(--text-blue);
    }

    .req-title {
        font-weight: 600;
        color: var(--text-main);
        font-size: 0.95rem;
        display: block;
    }

    .req-sub {
        font-size: 0.75rem;
        color: var(--text-muted);
    }

    .req-status {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 4px;
        text-transform: uppercase;
    }

    .st-approved {
        color: #10b981;
        background: rgba(16, 185, 129, 0.1);
    }

    .st-pending {
        color: #f59e0b;
        background: rgba(245, 158, 11, 0.1);
    }

    .st-rejected {
        color: #ef4444;
        background: rgba(239, 68, 68, 0.1);
    }

    .req-meta-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        gap: 16px;
        margin-bottom: 12px;
        font-size: 0.85rem;
    }

    .meta-l {
        color: var(--text-muted);
        font-size: 0.7rem;
        display: block;
        margin-bottom: 2px;
    }

    .meta-v {
        color: var(--text-main);
        font-weight: 500;
    }

    .req-desc {
        background-color: var(--bg-hover);
        padding: 12px;
        border-radius: 8px;
        font-size: 0.85rem;
        color: var(--text-main);
        margin-bottom: 12px;
    }

    .attachment-link {
        font-size: 0.75rem;
        color: var(--text-blue);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .approval-info {
        font-size: 0.75rem;
        color: #10b981;
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .rejection-info {
        font-size: 0.75rem;
        color: #ef4444;
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .action-row {
        display: flex;
        gap: 12px;
        margin-top: 16px;
    }

    .btn-act {
        flex: 1;
        padding: 8px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        text-align: center;
        border: 1px solid transparent;
        background: transparent;
    }

    .btn-cancel {
        border-color: var(--text-red);
        color: var(--text-red);
    }

    .btn-cancel:hover {
        background-color: var(--soft-red);
    }

    .btn-edit {
        background-color: var(--text-blue);
        color: white;
    }

    .btn-edit:hover {
        opacity: 0.9;
    }

    @media(max-width: 768px) {

        .balance-stats-grid,
        .qa-btn-grid {
            grid-template-columns: 1fr 1fr;
        }

        .req-meta-grid {
            grid-template-columns: 1fr;
            gap: 8px;
        }
    }
</style>

<div class="content-body">
    
    <!-- 1. Leave Balance Dashboard (Dark Themed) -->
    <div class="balance-card">
        <div class="d-flex align-items-center gap-2 mb-4">
            <i class="bi bi-calendar4-week text-primary"></i>
            <h6 class="fw-bold m-0">Leave Balance</h6>
        </div>

        <div class="row align-items-center">
            <div class="col-md-4 text-center">
                <div class="circle-progress-lg">
                    <div class="circle-inner-lg">
                        <span class="circle-num">22</span>
                        <span class="circle-txt">Remaining</span>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="balance-stats-grid">
                    <div class="balance-stat-box">
                        <span class="bs-val red">8</span><span class="bs-lbl">Used</span>
                    </div>
                    <div class="balance-stat-box">
                        <span class="bs-val orange">2</span><span class="bs-lbl">Pending</span>
                    </div>
                    <div class="balance-stat-box">
                        <span class="bs-val green">6</span><span class="bs-lbl">Approved</span>
                    </div>
                    <div class="balance-stat-box">
                        <span class="bs-val blue">2</span><span class="bs-lbl">This Month</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Quick Apply Section -->
    <div class="quick-apply-card">
        <div class="d-flex align-items-center gap-2 mb-3">
            <i class="bi bi-plus-circle text-primary"></i>
            <h6 class="fw-bold m-0">Quick Apply</h6>
        </div>
        <p class="--text-muted small mb-4">Apply for leave quickly with pre-defined templates</p>

        <div class="qa-btn-grid">
            <div class="qa-btn sick">
                <i class="bi bi-heart-pulse qa-icon"></i>
                <span class="qa-text">Sick Leave</span>
            </div>
            <div class="qa-btn personal">
                <i class="bi bi-person qa-icon"></i>
                <span class="qa-text">Personal</span>
            </div>
            <div class="qa-btn emergency">
                <i class="bi bi-exclamation-triangle qa-icon"></i>
                <span class="qa-text">Emergency</span>
            </div>
            <div class="qa-btn custom">
                <i class="bi bi-pencil-square qa-icon"></i>
                <span class="qa-text">Custom</span>
            </div>
        </div>
    </div>

    <!-- 3. Filter & Add Button -->
    <div class="filter-row">
        <div class="filter-tabs">
            <button class="f-tab active">All</button>
            <button class="f-tab">Pending</button>
            <button class="f-tab">Approved</button>
            <button class="f-tab">Rejected</button>
        </div>
        <button class="btn btn-primary btn-sm fw-bold"><i class="bi bi-plus-lg me-1"></i> New Request</button>
    </div>

    <!-- 4. Requests List -->

    <!-- Item 1: Sick Leave (Approved) -->
    <div class="req-card" style="border-left-color: #10b981;">
        <span class="req-status st-approved">Approved</span>

        <div class="req-header">
            <div class="req-icon icon-sick"><i class="bi bi-heart-pulse-fill"></i></div>
            <div>
                <span class="req-title">Sick Leave</span>
                <span class="req-sub">Fever and cold symptoms</span>
            </div>
        </div>

        <div class="req-meta-grid">
            <div><span class="meta-l">Duration</span><span class="meta-v">9 Dec - 10 Dec</span></div>
            <div><span class="meta-l">Days</span><span class="meta-v">2 days</span></div>
            <div><span class="meta-l">Applied</span><span class="meta-v">4d ago</span></div>
        </div>

        <div class="req-desc">
            Experiencing high fever and severe cold symptoms. Doctor advised rest for 2 days.
        </div>

        <a href="#" class="attachment-link"><i class="bi bi-paperclip"></i> medical_certificate.pdf</a>

        <div class="approval-info">
            <i class="bi bi-check-circle-fill"></i> Approved by Dr. Sarah Wilson
        </div>
    </div>

    <!-- Item 2: Personal Leave (Pending) -->
    <div class="req-card" style="border-left-color: #f59e0b;">
        <span class="req-status st-pending">Pending</span>

        <div class="req-header">
            <div class="req-icon icon-personal"><i class="bi bi-person-fill"></i></div>
            <div>
                <span class="req-title">Personal Leave</span>
                <span class="req-sub">Family function attendance</span>
            </div>
        </div>

        <div class="req-meta-grid">
            <div><span class="meta-l">Duration</span><span class="meta-v">17 Dec - 17 Dec</span></div>
            <div><span class="meta-l">Days</span><span class="meta-v">1 (Half Day)</span></div>
            <div><span class="meta-l">Applied</span><span class="meta-v">Yesterday</span></div>
        </div>

        <div class="req-desc">
            Need to attend my cousin's wedding ceremony. It's an important family event.
        </div>

        <div class="action-row">
            <button class="btn-act btn-cancel">Cancel</button>
            <button class="btn-act btn-edit">Edit</button>
        </div>
    </div>

    <!-- Item 3: Emergency Leave (Approved) -->
    <div class="req-card" style="border-left-color: #10b981;">
        <span class="req-status st-approved">Approved</span>

        <div class="req-header">
            <div class="req-icon icon-emergency"><i class="bi bi-exclamation-triangle-fill"></i></div>
            <div>
                <span class="req-title">Emergency Leave</span>
                <span class="req-sub">Family medical emergency</span>
            </div>
        </div>

        <div class="req-meta-grid">
            <div><span class="meta-l">Duration</span><span class="meta-v">2 Dec - 3 Dec</span></div>
            <div><span class="meta-l">Days</span><span class="meta-v">2 days</span></div>
            <div><span class="meta-l">Applied</span><span class="meta-v">2 Dec</span></div>
        </div>

        <div class="req-desc">
            My grandmother was hospitalized and needs immediate family support.
        </div>

        <div class="approval-info">
            <i class="bi bi-check-circle-fill"></i> Approved by Prof. Michael Chen
        </div>
    </div>

    <!-- Item 4: Festival Leave (Rejected) -->
    <div class="req-card" style="border-left-color: #ef4444;">
        <span class="req-status st-rejected">Rejected</span>

        <div class="req-header">
            <div class="req-icon icon-emergency" style="background-color: var(--soft-red);"><i
                    class="bi bi-star-fill text-danger"></i></div>
            <div>
                <span class="req-title">Festival Leave</span>
                <span class="req-sub">Diwali celebration</span>
            </div>
        </div>

        <div class="req-meta-grid">
            <div><span class="meta-l">Duration</span><span class="meta-v">22 Nov - 23 Nov</span></div>
            <div><span class="meta-l">Days</span><span class="meta-v">2 days</span></div>
            <div><span class="meta-l">Applied</span><span class="meta-v">21 Nov</span></div>
        </div>

        <div class="rejection-info">
            <i class="bi bi-x-circle-fill"></i> Rejected by Dr. Emily Rodriguez: Conflict with exam schedule.
        </div>
    </div>

</div>
@endsection
