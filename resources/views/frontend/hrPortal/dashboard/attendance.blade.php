@extends('frontend.hrPortal.dashboard.layouts.app')

@section('title', 'Attendance Management')

@section('icon', 'bi bi-calendar-check-fill fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')
<style>
    /* --- Page Specific Styles --- */

    /* Stats Cards */
    .stat-card-attend {
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

    .stat-card-attend:hover {
        transform: translateY(-3px);
    }

    .stat-icon {
        font-size: 1.5rem;
        margin-bottom: 8px;
    }

    .attend-green {
        color: #10b981;
        border: 1px solid rgba(16, 185, 129, 0.2);
        background-color: rgba(16, 185, 129, 0.05);
    }

    .attend-red {
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.2);
        background-color: rgba(239, 68, 68, 0.05);
    }

    .attend-orange {
        color: #f59e0b;
        border: 1px solid rgba(245, 158, 11, 0.2);
        background-color: rgba(245, 158, 11, 0.05);
    }

    .attend-blue {
        color: #3b82f6;
        border: 1px solid rgba(59, 130, 246, 0.2);
        background-color: rgba(59, 130, 246, 0.05);
    }

    /* Filter Bar */
    .filter-bar {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }

    .search-container {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 12px 16px;
        flex-grow: 1;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .search-input {
        background: transparent;
        border: none;
        color: var(--text-main);
        width: 100%;
        outline: none;
    }

    .date-select {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        padding: 12px 16px;
        border-radius: 12px;
        min-width: 200px;
        outline: none;
    }

    /* Attendance Card Row */
    .attendance-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px 24px;
        margin-bottom: 16px;
        transition: border-color 0.2s, transform 0.2s;
        cursor: pointer;
        /* Makes it look clickable */
    }

    .attendance-card:hover {
        border-color: var(--accent-color);
        transform: scale(1.002);
    }

    .avatar-md {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1rem;
        background-color: var(--bg-body);
        border: 2px solid var(--border-color);
    }

    /* Status Badge */
    .status-badge {
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .bg-status-present {
        background-color: rgba(16, 185, 129, 0.15);
        color: #10b981;
    }

    /* Toast Notification (Initially Hidden) */
    .toast-custom {
        position: fixed;
        bottom: 24px;
        left: 24px;
        right: 24px;
        background-color: #3b82f6;
        /* Blue background */
        color: white;
        padding: 16px 24px;
        border-radius: 8px;
        z-index: 1050;
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
        display: none;
        /* HIDDEN BY DEFAULT */
        align-items: center;
        justify-content: space-between;
        animation: slideUp 0.3s ease-out;
    }

    @media(min-width: 992px) {
        .toast-custom {
            left: 284px;
        }
    }

    @keyframes slideUp {
        from {
            transform: translateY(100%);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Utilities */
    .text-purple-custom {
        color: #8b5cf6;
    }

    .bg-soft-purple-custom {
        background-color: rgba(139, 92, 246, 0.1);
    }

    .text-teal-custom {
        color: #14b8a6;
    }

    .bg-soft-teal-custom {
        background-color: rgba(20, 184, 166, 0.1);
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold m-0 text-main">Attendance Overview</h5>
    <span class="--text-muted small">17/12/2025</span>
</div>

<div class="row g-4 mb-4">
    <div class="col-12 col-md-6 col-lg-3">
        <div class="stat-card-attend attend-green">
            <i class="bi bi-check-circle stat-icon"></i>
            <h3 class="fw-bold mb-0">2</h3>
            <span class="small opacity-75">Present</span>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3">
        <div class="stat-card-attend attend-red">
            <i class="bi bi-x-circle stat-icon"></i>
            <h3 class="fw-bold mb-0">1</h3>
            <span class="small opacity-75">Absent</span>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3">
        <div class="stat-card-attend attend-orange">
            <i class="bi bi-clock-history stat-icon"></i>
            <h3 class="fw-bold mb-0">1</h3>
            <span class="small opacity-75">Late</span>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3">
        <div class="stat-card-attend attend-blue">
            <i class="bi bi-house-door stat-icon"></i>
            <h3 class="fw-bold mb-0">0</h3>
            <span class="small opacity-75">Remote</span>
        </div>
    </div>
</div>

<div class="filter-bar">
    <div class="search-container">
        <i class="bi bi-search --text-muted"></i>
        <input type="text" class="search-input" placeholder="Search employees...">
    </div>
    <select class="date-select">
        <option>Today</option>
        <option>This Week</option>
        <option>This Month</option>
        <option>Last Month</option>
    </select>
</div>

<div class="d-flex gap-3 mb-4">
    <select class="date-select flex-grow-1" style="min-width: auto;">
        <option>All</option>
        <option>Engineering</option>
        <option>Sales</option>
        <option>HR</option>
        <option>Finance</option>
        <option>Operations</option>
        <option>Marketing</option>
    </select>
    <select class="date-select flex-grow-1" style="min-width: auto;">
        <option>All</option>
        <option>Present</option>
        <option>Absent</option>
        <option>Late</option>
        <option>Half Day</option>
        <option>Remote</option>
    </select>
</div>

<div class="d-flex flex-column">

    <div class="attendance-card" onclick="showToast('Sarah Johnson')">
        <div class="row align-items-center g-3">
            <div class="col-12 col-lg-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-md text-teal-custom bg-soft-teal-custom" style="border-color: #14b8a6;">SJ</div>
                    <div>
                        <h6 class="fw-bold text-main mb-1">Sarah Johnson</h6>
                        <div class="text-purple-custom small">Senior Software Engineer • Engineering</div>
                        <small class="--text-muted d-block mt-1">Location: Office</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 text-center">
                <div class="d-inline-block text-center">
                    <i class="bi bi-box-arrow-in-right text-success mb-1 d-block"></i>
                    <span class="--text-muted small d-block">Check In</span>
                    <span class="fw-bold text-main">10:44</span>
                </div>
            </div>
            <div class="col-6 col-lg-3 text-center" style="border-left: 1px solid var(--border-color);">
                <div class="d-inline-block text-center">
                    <i class="bi bi-box-arrow-right text-success mb-1 d-block"></i>
                    <span class="--text-muted small d-block">Check Out</span>
                    <span class="fw-bold text-main">18:44</span>
                </div>
            </div>
            <div class="col-12 col-lg-2 text-end">
                <span class="status-badge bg-status-present mb-2 d-inline-block">Present</span>
                <div class="--text-muted small">8.0h</div>
                <div class="--text-muted small mt-2"><i class="bi bi-calendar3 me-1"></i> 17/12/2025</div>
            </div>
        </div>
    </div>

    <div class="attendance-card" onclick="showToast('Michael Chen')">
        <div class="row align-items-center g-3">
            <div class="col-12 col-lg-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-md text-teal-custom bg-soft-teal-custom" style="border-color: #14b8a6;">MC</div>
                    <div>
                        <h6 class="fw-bold text-main mb-1">Michael Chen</h6>
                        <div class="text-purple-custom small">Marketing Manager • Marketing</div>
                        <small class="--text-muted d-block mt-1">Location: Remote</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 text-center">
                <div class="d-inline-block text-center">
                    <i class="bi bi-box-arrow-in-right text-success mb-1 d-block"></i>
                    <span class="--text-muted small d-block">Check In</span>
                    <span class="fw-bold text-main">11:29</span>
                </div>
            </div>
            <div class="col-6 col-lg-3 text-center" style="border-left: 1px solid var(--border-color);">
                <div class="d-inline-block text-center">
                    <i class="bi bi-box-arrow-right text-danger mb-1 d-block"></i>
                    <span class="--text-muted small d-block">Check Out</span>
                    <span class="fw-bold text-danger">--:--</span>
                </div>
            </div>
            <div class="col-12 col-lg-2 text-end">
                <span class="status-badge bg-status-present mb-2 d-inline-block">Present</span>
                <div class="--text-muted small">7.8h</div>
                <div class="--text-muted small mt-2"><i class="bi bi-three-dots-vertical"></i></div>
            </div>
        </div>
    </div>

</div>

<div id="attendanceToast" class="toast-custom">
    <span id="toastMessage">Attendance details - Coming soon!</span>
    <button type="button" class="btn-close btn-close-white ms-3" onclick="hideToast()"></button>
</div>

<script>
    let toastTimeout;

    function showToast(name) {
        const toast = document.getElementById('attendanceToast');
        const message = document.getElementById('toastMessage');

        // Update Message
        message.innerText = `Attendance details for ${name} - Coming soon!`;

        // Show Toast
        toast.style.display = 'flex';

        // Clear existing timeout if clicking quickly
        if(toastTimeout) clearTimeout(toastTimeout);

        // Auto hide after 3 seconds
        toastTimeout = setTimeout(() => {
            hideToast();
        }, 3000);
    }

    function hideToast() {
        const toast = document.getElementById('attendanceToast');
        toast.style.display = 'none';
    }
</script>

@endsection
