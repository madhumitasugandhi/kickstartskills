@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Performance Analytics')
@section('icon', 'bi bi-graph-up fs-4 p-2 bg-primary bg-opacity-10 rounded-3 text-primary')

@section('content')
<style>
    /* === YOUR SPECIFIC COLOR PALETTE === */
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
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
    }

    /* 1. Academic Summary Cards */
    .summary-grid {
        display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px;
    }
    .summary-card {
        padding: 20px; border-radius: 12px; text-align: center; border: 1px solid transparent;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
    }

    .sc-green { background-color: var(--soft-green); border-color: rgba(16, 185, 129, 0.2); }
    .sc-blue { background-color: var(--soft-blue); border-color: rgba(59, 130, 246, 0.2); }
    .sc-orange { background-color: var(--soft-orange); border-color: rgba(249, 115, 22, 0.2); }
    .sc-teal { background-color: var(--soft-teal); border-color: rgba(32, 201, 151, 0.2); }

    .sum-icon { font-size: 1.5rem; margin-bottom: 8px; }
    .sum-val { font-size: 1.5rem; font-weight: 700; color: var(--text-main); line-height: 1.2; }
    .sum-lbl { font-size: 0.8rem; color: var(--text-muted); font-weight: 500; }

    .text-green-dark { color: var(--text-green); }
    .text-blue-dark { color: var(--text-blue); }
    .text-orange-dark { color: var(--text-orange); }
    .text-teal-dark { color: var(--text-teal); }

    /* 2. Performance Metrics Grid */
    .metrics-grid {
        display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; margin-bottom: 24px;
    }
    .metric-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        position: relative;
        overflow: hidden;
    }

    .bg-tint-green { background-color: var(--bg-card); } /* Uses main card bg now, specific colors handle tint */

    .metric-header { display: flex; justify-content: space-between; margin-bottom: 12px; }
    .m-title { font-size: 0.9rem; color: var(--text-muted); font-weight: 600; }
    .m-trend { font-size: 0.8rem; font-weight: 700; }

    .m-val-large { font-size: 1.8rem; font-weight: 700; color: var(--text-main); margin-bottom: 16px; display: block; }
    .m-val-sub { font-size: 0.9rem; color: var(--text-muted); font-weight: 400; }

    .progress-thick { height: 6px; border-radius: 4px; background-color: var(--border-color); overflow: hidden; }
    .p-fill { height: 100%; border-radius: 4px; }

    .m-icon-corner {
        position: absolute; bottom: 20px; left: 24px;
        width: 32px; height: 32px; border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem;
    }

    /* 3. Trends Chart Placeholder */
    .chart-placeholder {
        background-color: var(--soft-blue);
        border-radius: 12px;
        height: 200px;
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        text-align: center;
        color: var(--text-blue);
        border: 1px dashed var(--text-blue);
        margin-bottom: 32px;
    }

    /* 4. Subject Performance Cards */
    .subject-grid {
        display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px;
    }
    .subject-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
    }

    .subj-header { display: flex; justify-content: space-between; margin-bottom: 20px; }
    .subj-code { font-size: 0.75rem; color: var(--text-muted); display: block; text-transform: uppercase; letter-spacing: 0.5px; }
    .subj-name { font-size: 1.1rem; font-weight: 700; color: var(--text-main); }

    .grade-circle {
        width: 40px; height: 40px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-weight: 700; color: white;
    }
    .gr-blue { background-color: #0ea5e9; }
    .gr-green { background-color: #10b981; }

    .subj-stat-row {
        display: flex; justify-content: space-between; align-items: center;
        margin-bottom: 12px; font-size: 0.85rem; color: var(--text-muted);
    }
    .subj-progress { width: 100px; height: 6px; background-color: var(--border-color); border-radius: 3px; overflow: hidden; }

    @media(max-width: 991px) {
        .summary-grid, .metrics-grid, .subject-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="content-body">

    <!-- 1. Academic Summary -->
    <h6 class="fw-bold text-main mb-3">Academic Summary</h6>
    <div class="summary-grid">
        <div class="summary-card sc-green">
            <i class="bi bi-award sum-icon text-green-dark"></i>
            <span class="sum-val text-green-dark">3.7</span>
            <span class="sum-lbl text-green-dark">GPA</span>
        </div>
        <div class="summary-card sc-blue">
            <i class="bi bi-journal-bookmark sum-icon text-blue-dark"></i>
            <span class="sum-val text-blue-dark">45</span>
            <span class="sum-lbl text-blue-dark">Credits</span>
        </div>
        <div class="summary-card sc-orange">
            <i class="bi bi-people sum-icon text-orange-dark"></i>
            <span class="sum-val text-orange-dark">15/120</span>
            <span class="sum-lbl text-orange-dark">Rank</span>
        </div>
        <div class="summary-card sc-teal">
            <i class="bi bi-check-circle sum-icon text-teal-dark"></i>
            <span class="sum-val text-teal-dark" style="font-size: 1.2rem;">Good Standing</span>
            <span class="sum-lbl text-teal-dark">Status</span>
        </div>
    </div>

    <!-- 2. Performance Metrics -->
    <h6 class="fw-bold text-main mb-3">Performance Metrics</h6>
    <div class="metrics-grid">

        <!-- GPA Card -->
        <div class="metric-card">
            <div class="metric-header">
                <span class="m-title">Current GPA</span>
                <span class="m-trend text-green"><i class="bi bi-arrow-up"></i> +0.2</span>
            </div>
            <span class="m-val-large">3.7 <span class="m-val-sub">/ 4.0</span></span>
            <div class="progress-thick">
                <div class="p-fill" style="width: 92%; background-color: var(--text-green);"></div>
            </div>
            <div class="m-icon-corner" style="background-color: var(--bg-hover); color: var(--text-green);"><i class="bi bi-graph-up-arrow"></i></div>
        </div>

        <!-- Attendance Card -->
        <div class="metric-card">
            <div class="metric-header">
                <span class="m-title">Attendance Rate</span>
                <span class="m-trend text-green"><i class="bi bi-arrow-up"></i> +2%</span>
            </div>
            <span class="m-val-large">94% <span class="m-val-sub">/ 100%</span></span>
            <div class="progress-thick">
                <div class="p-fill" style="width: 94%; background-color: var(--text-green);"></div>
            </div>
            <div class="m-icon-corner" style="background-color: var(--bg-hover); color: var(--text-green);"><i class="bi bi-calendar-check"></i></div>
        </div>

        <!-- Assignment Score -->
        <div class="metric-card">
            <div class="metric-header">
                <span class="m-title">Assignment Score</span>
                <span class="m-trend text-red"><i class="bi bi-arrow-down"></i> -3%</span>
            </div>
            <span class="m-val-large text-orange-dark">88% <span class="m-val-sub">/ 100%</span></span>
            <div class="progress-thick">
                <div class="p-fill" style="width: 88%; background-color: var(--text-orange);"></div>
            </div>
            <div class="m-icon-corner" style="background-color: var(--bg-hover); color: var(--text-orange);"><i class="bi bi-file-text"></i></div>
        </div>

        <!-- Participation -->
        <div class="metric-card">
            <div class="metric-header">
                <span class="m-title">Class Participation</span>
                <span class="m-trend text-muted"><i class="bi bi-dash"></i> 0%</span>
            </div>
            <span class="m-val-large text-blue-dark">85% <span class="m-val-sub">/ 100%</span></span>
            <div class="progress-thick">
                <div class="p-fill" style="width: 85%; background-color: var(--text-blue);"></div>
            </div>
            <div class="m-icon-corner" style="background-color: var(--bg-hover); color: var(--text-blue);"><i class="bi bi-people"></i></div>
        </div>

    </div>

    <!-- 3. Trends Chart Placeholder -->
    <h6 class="fw-bold text-main mb-3">Performance Trends</h6>
    <div class="chart-placeholder">
        <i class="bi bi-graph-up-arrow fs-1 mb-3"></i>
        <h6 class="fw-bold">Interactive Chart Coming Soon</h6>
        <p class="small opacity-75">This will show your performance trends over time</p>
    </div>

    <!-- 4. Subject-wise Performance -->
    <h6 class="fw-bold text-main mb-3">Subject-wise Performance</h6>
    <div class="subject-grid">

        <!-- Subject 1 -->
        <div class="subject-card">
            <div class="subj-header">
                <div>
                    <span class="subj-code">CS 101</span>
                    <h6 class="subj-name">Computer Science</h6>
                </div>
                <div class="grade-circle gr-blue">A-</div>
            </div>

            <div class="subj-stat-row">
                <span>Attendance</span>
                <div class="d-flex align-items-center gap-2">
                    <span class="fw-bold text-main">96%</span>
                    <div class="subj-progress"><div class="p-fill bg-primary" style="width: 96%;"></div></div>
                </div>
            </div>
            <div class="subj-stat-row">
                <span>Assignments</span>
                <div class="d-flex align-items-center gap-2">
                    <span class="fw-bold text-main">90%</span>
                    <div class="subj-progress"><div class="p-fill bg-primary" style="width: 90%;"></div></div>
                </div>
            </div>
            <div class="subj-stat-row">
                <span>Exams</span>
                <div class="d-flex align-items-center gap-2">
                    <span class="fw-bold text-main">88%</span>
                    <div class="subj-progress"><div class="p-fill bg-primary" style="width: 88%;"></div></div>
                </div>
            </div>
            <div class="subj-stat-row">
                <span>Participation</span>
                <div class="d-flex align-items-center gap-2">
                    <span class="fw-bold text-main">92%</span>
                    <div class="subj-progress"><div class="p-fill bg-primary" style="width: 92%;"></div></div>
                </div>
            </div>
        </div>

        <!-- Subject 2 -->
        <div class="subject-card">
            <div class="subj-header">
                <div>
                    <span class="subj-code">MATH 201</span>
                    <h6 class="subj-name">Mathematics</h6>
                </div>
                <div class="grade-circle gr-green">B+</div>
            </div>

            <div class="subj-stat-row">
                <span>Attendance</span>
                <div class="d-flex align-items-center gap-2">
                    <span class="fw-bold text-main">92%</span>
                    <div class="subj-progress"><div class="p-fill bg-success" style="width: 92%;"></div></div>
                </div>
            </div>
            <div class="subj-stat-row">
                <span>Assignments</span>
                <div class="d-flex align-items-center gap-2">
                    <span class="fw-bold text-main">85%</span>
                    <div class="subj-progress"><div class="p-fill bg-success" style="width: 85%;"></div></div>
                </div>
            </div>
            <div class="subj-stat-row">
                <span>Exams</span>
                <div class="d-flex align-items-center gap-2">
                    <span class="fw-bold text-main">82%</span>
                    <div class="subj-progress"><div class="p-fill bg-success" style="width: 82%;"></div></div>
                </div>
            </div>
            <div class="subj-stat-row">
                <span>Participation</span>
                <div class="d-flex align-items-center gap-2">
                    <span class="fw-bold text-main">88%</span>
                    <div class="subj-progress"><div class="p-fill bg-success" style="width: 88%;"></div></div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
