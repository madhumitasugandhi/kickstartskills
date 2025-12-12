@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Announcements')
@section('icon', 'bi bi-megaphone fs-4 p-2 bg-primary bg-opacity-10 rounded-3 text-primary')

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

    /* 1. Overview Stats Panel */
    .stats-panel {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    .stat-box {
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        border: 1px solid transparent;
    }

    .sb-red {
        background-color: rgba(220, 53, 69, 0.1);
        border-color: rgba(220, 53, 69, 0.2);
        color: #dc3545;
    }

    .sb-blue {
        background-color: rgba(13, 110, 253, 0.1);
        border-color: rgba(13, 110, 253, 0.2);
        color: #0d6efd;
    }

    .sb-green {
        background-color: rgba(25, 135, 84, 0.1);
        border-color: rgba(25, 135, 84, 0.2);
        color: #198754;
    }

    .sb-cyan {
        background-color: rgba(13, 202, 240, 0.1);
        border-color: rgba(13, 202, 240, 0.2);
        color: #0dcaf0;
    }

    [data-theme="dark"] .sb-red {
        color: #ea868f;
    }

    [data-theme="dark"] .sb-blue {
        color: #6ea8fe;
    }

    [data-theme="dark"] .sb-green {
        color: #75b798;
    }

    [data-theme="dark"] .sb-cyan {
        color: #3dd5f3;
    }

    .sb-num {
        font-size: 1.5rem;
        font-weight: 700;
        display: block;
        margin-bottom: 4px;
    }

    .sb-lbl {
        font-size: 0.8rem;
        opacity: 0.8;
    }

    .last-update {
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-top: 16px;
        display: block;
    }

    /* 2. Categories Section */
    .categories-panel {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 24px;
    }

    .cat-scroll {
        display: flex;
        gap: 12px;
        overflow-x: auto;
    }

    .cat-pill {
        padding: 8px 16px;
        border-radius: 8px;
        border: 1px solid var(--border-color);
        background-color: var(--bg-card);
        /* Should contrast slightly if needed */
        color: var(--text-main);
        font-size: 0.85rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: 0.2s;
        white-space: nowrap;
    }

    .cat-pill:hover {
        background-color: var(--soft-blue);
        border-color: var(--text-blue);
        color: var(--text-blue);
    }

    .cat-pill.active {
        background-color: var(--text-blue);
        color: white;
        border-color: var(--text-blue);
    }

    .cat-count {
        background: rgba(0, 0, 0, 0.1);
        padding: 2px 6px;
        border-radius: 4px;
        font-size: 0.7rem;
        font-weight: 700;
    }

    /* Specific pill accents from image */
    .border-l-blue {
        border-left: 3px solid #0d6efd;
    }

    .border-l-orange {
        border-left: 3px solid #fd7e14;
    }

    .border-l-green {
        border-left: 3px solid #198754;
    }

    .border-l-purple {
        border-left: 3px solid #6f42c1;
    }

    .border-l-red {
        border-left: 3px solid #dc3545;
    }

    /* 3. Filter Bar */
    .filter-bar {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
    }

    .btn-filter {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        color: var(--text-muted);
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.9rem;
    }

    .btn-unread {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        color: var(--text-muted);
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* 4. Announcement Card */
    .ann-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 16px;
        position: relative;
    }

    .ann-card.priority-high {
        border-left: 4px solid #dc3545;
    }

    .ann-card.priority-med {
        border-left: 4px solid #0d6efd;
    }

    .ann-card.priority-info {
        border-left: 4px solid #198754;
    }

    .ann-header {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 12px;
    }

    .ann-icon {
        font-size: 1.1rem;
        margin-top: 2px;
    }

    .text-p-red {
        color: #dc3545;
    }

    .text-p-blue {
        color: #0d6efd;
    }

    .text-p-green {
        color: #198754;
    }

    .text-p-orange {
        color: #fd7e14;
    }

    .ann-title {
        font-weight: 700;
        font-size: 1rem;
        color: var(--text-main);
        margin-bottom: 4px;
    }

    .ann-badges {
        display: flex;
        gap: 8px;
    }

    .badge-tag {
        font-size: 0.65rem;
        padding: 3px 8px;
        border-radius: 4px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .bg-t-red {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }

    .bg-t-blue {
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
    }

    .bg-t-orange {
        background-color: rgba(253, 126, 20, 0.1);
        color: #fd7e14;
    }

    .bg-t-green {
        background-color: rgba(25, 135, 84, 0.1);
        color: #198754;
    }

    .ann-content {
        color: var(--text-muted);
        font-size: 0.9rem;
        margin-bottom: 16px;
        line-height: 1.5;
    }

    .ann-meta {
        display: flex;
        justify-content: space-between;
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--border-color);
    }

    .meta-l {
        display: flex;
        gap: 16px;
    }

    .attach-box {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
    }

    .file-chip {
        display: flex;
        align-items: center;
        gap: 8px;
        background-color: var(--soft-blue);
        color: var(--text-blue);
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.8rem;
        text-decoration: none;
        border: 1px solid transparent;
    }

    .file-chip:hover {
        border-color: var(--text-blue);
    }

    .ann-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-action {
        padding: 6px 16px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        border: none;
        transition: 0.2s;
    }

    .btn-view {
        background-color: var(--text-blue);
        color: white;
        margin-right: 8px;
    }

    .btn-view:hover {
        opacity: 0.9;
    }

    .btn-dl {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        color: var(--text-main);
    }

    .btn-dl:hover {
        background-color: var(--bg-body);
    }

    @media(max-width: 991px) {
        .stats-grid {
            grid-template-columns: 1fr 1fr;
        }

        .ann-meta {
            flex-direction: column;
            gap: 8px;
        }
    }
</style>

<div class="content-body">

    <!-- 1. Announcement Overview -->
    <div class="stats-panel">
        <h6 class="fw-bold text-main mb-3"><i class="bi bi-bar-chart-fill me-2 text-primary"></i>Announcement Overview
        </h6>

        <div class="stats-grid">
            <div class="stat-box sb-red">
                <span class="sb-num">7</span>
                <span class="sb-lbl">Unread</span>
            </div>
            <div class="stat-box sb-blue">
                <span class="sb-num">24</span>
                <span class="sb-lbl">Total</span>
            </div>
            <div class="stat-box sb-green">
                <span class="sb-num">3</span>
                <span class="sb-lbl">Today</span>
            </div>
            <div class="stat-box sb-cyan">
                <span class="sb-num">12</span>
                <span class="sb-lbl">This Week</span>
            </div>
        </div>
        <small class="last-update"><i class="bi bi-clock-history me-1"></i> Last updated: 15m ago</small>
    </div>

    <!-- 2. Categories -->
    <div class="categories-panel">
        <h6 class="fw-bold text-main mb-3"><i class="bi bi-grid-fill me-2 text-success"></i>Categories</h6>
        <div class="cat-scroll">
            <div class="cat-pill active">
                <i class="bi bi-layers"></i> All <span class="cat-count text-primary bg-white">24</span>
            </div>
            <div class="cat-pill border-l-blue">
                <i class="bi bi-mortarboard text-primary"></i> Academic <span class="cat-count">8</span>
            </div>
            <div class="cat-pill border-l-orange">
                <i class="bi bi-building text-warning"></i> Administrative <span class="cat-count">5</span>
            </div>
            <div class="cat-pill border-l-green">
                <i class="bi bi-calendar-event text-success"></i> Events <span class="cat-count">6</span>
            </div>
            <div class="cat-pill border-l-purple">
                <i class="bi bi-book text-info"></i> Library <span class="cat-count">3</span>
            </div>
            <div class="cat-pill border-l-red">
                <i class="bi bi-exclamation-triangle text-danger"></i> Emergency <span class="cat-count">1</span>
            </div>
        </div>
    </div>

    <!-- 3. Filter Bar -->
    <div class="filter-bar">
        <select class="btn-filter">
            <option>All</option>
        </select>
        <button class="btn-unread"><i class="bi bi-eye"></i> Unread Only</button>
        <div class="ms-auto text-muted cursor-pointer"><i class="bi bi-arrow-repeat fs-5"></i></div>
    </div>

    <!-- 4. Announcement Feed -->

    <!-- Card 1: High Priority -->
    <div class="ann-card priority-high">
        <div class="d-flex justify-content-between">
            <div class="ann-header">
                <i class="bi bi-exclamation-circle-fill ann-icon text-p-red"></i>
                <div>
                    <h6 class="ann-title">Final Examination Schedule Released</h6>
                    <div class="ann-badges">
                        <span class="badge-tag bg-t-red">Academic</span>
                        <span class="badge-tag bg-t-orange">High</span>
                    </div>
                </div>
            </div>
            <i class="bi bi-three-dots-vertical text-muted cursor-pointer"></i>
        </div>

        <p class="ann-content">
            The final examination schedule for the current semester has been released. Students are advised to check
            their examination dates and venues on the student portal. Please ensure you have your student ID cards ready
            for the examinations.
        </p>

        <div class="ann-meta">
            <div class="meta-l">
                <span><i class="bi bi-calendar3 me-1"></i> Published: 12 Dec, 09:20</span>
                <span><i class="bi bi-person me-1"></i> Author: Academic Office</span>
            </div>
            <span><i class="bi bi-eye me-1"></i> Views: 1247</span>
        </div>

        <div class="attach-box">
            <a href="#" class="file-chip"><i class="bi bi-paperclip"></i> Final_Exam_Schedule.pdf (2.3 MB)</a>
            <a href="#" class="file-chip"><i class="bi bi-file-earmark-text"></i> Exam_Guidelines.pdf (1.1 MB)</a>
        </div>

        <div class="ann-footer">
            <div>
                <button class="btn-action btn-view"><i class="bi bi-eye-fill me-1"></i> View Full</button>
                <button class="btn-action btn-dl"><i class="bi bi-download me-1"></i> Download</button>
            </div>
            <small class="--text-muted" style="font-size: 0.7rem;">Expires: 11 Jan</small>
        </div>
    </div>

    <!-- Card 2: Medium Priority -->
    <div class="ann-card priority-med">
        <div class="d-flex justify-content-between">
            <div class="ann-header">
                <i class="bi bi-info-circle-fill ann-icon text-p-blue"></i>
                <div>
                    <h6 class="ann-title">Library Extended Hours During Exam Period</h6>
                    <div class="ann-badges">
                        <span class="badge-tag bg-t-blue">Library</span>
                        <span class="badge-tag bg-t-orange">Medium</span>
                    </div>
                </div>
            </div>
            <i class="bi bi-three-dots-vertical text-muted cursor-pointer"></i>
        </div>

        <p class="ann-content">
            The university library will extend its operating hours during the final examination period. From next week,
            the library will be open from 6:00 AM to 12:00 AM to accommodate students' study needs.
        </p>

        <div class="ann-meta">
            <div class="meta-l">
                <span><i class="bi bi-calendar3 me-1"></i> Published: 12 Dec, 07:20</span>
                <span><i class="bi bi-person me-1"></i> Author: Library Services</span>
            </div>
            <span><i class="bi bi-eye me-1"></i> Views: 892</span>
        </div>

        <div class="ann-footer">
            <button class="btn-action btn-view"><i class="bi bi-eye-fill me-1"></i> View Full</button>
            <small class="--text-muted" style="font-size: 0.7rem;">Expires: 2 Jan</small>
        </div>
    </div>

    <!-- Card 3: Events -->
    <div class="ann-card priority-info">
        <div class="d-flex justify-content-between">
            <div class="ann-header">
                <i class="bi bi-calendar-event-fill ann-icon text-p-green"></i>
                <div>
                    <h6 class="ann-title">Annual Tech Fest 2024 - Call for Participation</h6>
                    <div class="ann-badges">
                        <span class="badge-tag bg-t-green">Events</span>
                        <span class="badge-tag bg-t-orange">Medium</span>
                    </div>
                </div>
            </div>
            <i class="bi bi-three-dots-vertical text-muted cursor-pointer"></i>
        </div>

        <p class="ann-content">
            Registration is now open for the Annual Tech Fest 2024! This year's theme is "Innovation for Tomorrow". We
            invite all students to participate in various competitions including coding challenges, robotics, and
            project exhibitions.
        </p>

        <div class="ann-meta">
            <div class="meta-l">
                <span><i class="bi bi-calendar3 me-1"></i> Published: 12 Dec, 05:20</span>
                <span><i class="bi bi-person me-1"></i> Author: Student Activities Committee</span>
            </div>
            <span><i class="bi bi-eye me-1"></i> Views: 2156</span>
        </div>

        <div class="attach-box">
            <a href="#" class="file-chip"><i class="bi bi-paperclip"></i> TechFest_Brochure.pdf (5.7 MB)</a>
        </div>

        <div class="ann-footer">
            <div>
                <button class="btn-action btn-view"><i class="bi bi-eye-fill me-1"></i> View Full</button>
                <button class="btn-action btn-dl"><i class="bi bi-download me-1"></i> Download</button>
            </div>
            <small class="--text-muted" style="font-size: 0.7rem;">Expires: 26 Jan</small>
        </div>
    </div>

    <!-- Card 4: Administrative (Warning) -->
    <div class="ann-card priority-high" style="border-left-color: #fd7e14;">
        <div class="d-flex justify-content-between">
            <div class="ann-header">
                <i class="bi bi-exclamation-triangle-fill ann-icon text-p-orange"></i>
                <div>
                    <h6 class="ann-title">New Academic Policies Effective Next Semester</h6>
                    <div class="ann-badges">
                        <span class="badge-tag bg-t-orange">Administrative</span>
                        <span class="badge-tag bg-t-red">High</span>
                    </div>
                </div>
            </div>
            <i class="bi bi-three-dots-vertical text-muted cursor-pointer"></i>
        </div>

        <p class="ann-content">
            Several new academic policies will come into effect starting next semester. These include updated attendance
            requirements, revised grading criteria, and new course registration procedures.
        </p>
    </div>

</div>
@endsection
