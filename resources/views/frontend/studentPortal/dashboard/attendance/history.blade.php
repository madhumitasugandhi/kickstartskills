@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Attendance History')
@section('icon', 'bi bi-clock-history fs-4 p-2 bg-primary bg-opacity-10 rounded-3 text-primary')

@section('content')
<style>
    /* Using your Root Palette */
    /* Dark Theme Logic handled by app.blade.php automatically via CSS variables */

    /* 1. Statistics Section */
    .stats-container {
        display: flex;
        gap: 24px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    /* Circle Chart Area */
    .chart-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        flex: 1;
        min-width: 300px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .circle-chart {
        width: 140px; height: 140px;
        border-radius: 50%;
        background: conic-gradient(#0ea5e9 89.2%, #e2e8f0 0);
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 8px;
    }
    .circle-chart-inner {
        width: 85%; height: 85%;
        background-color: var(--bg-card);
        border-radius: 50%;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
    }
    .chart-val { font-size: 2rem; font-weight: 700; color: #0ea5e9; line-height: 1; }
    .chart-lbl { font-size: 0.8rem; color: var(--text-muted); }

    /* Stat Cards Grid */
    .stat-cards-grid {
        flex: 2;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        min-width: 300px;
    }
    .info-card {
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        border: 1px solid transparent;
        display: flex; flex-direction: column; justify-content: center;
    }

    /* Specific Card Colors */
    .card-green { background-color: var(--soft-green); border-color: rgba(16, 185, 129, 0.2); }
    .card-blue { background-color: var(--soft-blue); border-color: rgba(59, 130, 246, 0.2); }
    .card-orange { background-color: var(--soft-orange); border-color: rgba(249, 115, 22, 0.2); }
    .card-teal { background-color: var(--soft-teal); border-color: rgba(20, 184, 166, 0.2); }

    .info-val { font-size: 1.5rem; font-weight: 700; margin-bottom: 4px; color: var(--text-main); }
    .card-green .info-val { color: var(--text-green); }
    .card-blue .info-val { color: var(--text-blue); }
    .card-orange .info-val { color: var(--text-orange); }
    .card-teal .info-val { color: var(--text-teal); }

    .info-lbl { font-size: 0.8rem; opacity: 0.8; font-weight: 500; color: var(--text-main); }

    /* Meta Bar */
    .meta-bar {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 16px 24px;
        margin-bottom: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }
    .meta-item { text-align: right; }
    .meta-item:first-child { text-align: left; }
    .meta-title { font-size: 0.75rem; color: var(--text-muted); display: block; margin-bottom: 2px; }
    .meta-data { font-size: 0.9rem; font-weight: 600; color: var(--text-main); }
    .text-link { color: var(--text-blue); text-decoration: none; }

    /* 2. Trend Section */
    .trend-section {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 32px;
    }
    .trend-header { display: flex; justify-content: space-between; margin-bottom: 20px; }

    .heatmap-row {
        display: flex; gap: 4px; margin-top: 20px; height: 60px;
    }
    .heat-block {
        flex: 1;
        border-radius: 4px;
        position: relative;
    }
    .heat-block::after {
        content: attr(data-day);
        position: absolute;
        bottom: -25px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 0.7rem;
        color: var(--text-muted);
    }
    .hb-green { background-color: #10b981; }
    .hb-orange { background-color: #f59e0b; }
    .hb-red { background-color: #ef4444; }

    /* 3. History Timeline List */
    .history-list {
        display: flex; flex-direction: column; gap: 16px;
    }

    .history-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        position: relative;
    }

    /* Left border indicators */
    .history-card.all-present { border-left: 4px solid #10b981; }
    .history-card.partial { border-left: 4px solid #f59e0b; }
    .history-card.absent { border-left: 4px solid #ef4444; }

    .history-header {
        display: flex; align-items: center; gap: 12px; margin-bottom: 12px;
    }
    .dot-indicator { width: 10px; height: 10px; border-radius: 50%; }
    .bg-dot-green { background-color: #10b981; }
    .bg-dot-orange { background-color: #f59e0b; }
    .bg-dot-red { background-color: #ef4444; }

    .date-title { font-weight: 600; color: var(--text-main); font-size: 0.95rem; }

    .stats-mini-row { display: flex; gap: 16px; font-size: 0.8rem; margin-bottom: 12px; }
    .stat-mini { display: flex; flex-direction: column; align-items: center; }
    .sm-val { font-weight: 700; }
    .sm-lbl { color: var(--text-muted); font-size: 0.7rem; }

    .text-p-green { color: #10b981; }
    .text-p-blue { color: #3b82f6; }
    .text-p-red { color: #ef4444; }

    .subject-pills { display: flex; flex-wrap: wrap; gap: 8px; }
    .subj-pill {
        font-size: 0.7rem; padding: 4px 10px; border-radius: 6px;
        background-color: var(--soft-green); color: var(--text-green);
        font-weight: 500;
    }
    .subj-pill.missed { background-color: var(--soft-red); color: var(--text-red); }

    .warning-box {
        margin-top: 12px;
        background-color: var(--soft-orange);
        color: #c2410c;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 0.8rem;
        display: flex; align-items: center; gap: 8px;
    }

    .percent-badge {
        position: absolute;
        top: 20px; right: 20px;
        font-size: 0.75rem; font-weight: 700;
        padding: 4px 10px; border-radius: 20px;
    }
    .pb-green { background-color: var(--soft-green); color: var(--text-green); }
    .pb-orange { background-color: var(--soft-orange); color: var(--text-orange); }
    .pb-red { background-color: var(--soft-red); color: var(--text-red); }

    @media(max-width: 991px) {
        .stat-cards-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="content-body">
    
    <!-- 1. Top Statistics Section -->
    <h6 class="fw-bold text-main mb-3">Attendance Statistics</h6>

    <div class="stats-container">
        <!-- Circle Chart -->
        <div class="chart-card">
            <div class="circle-chart">
                <div class="circle-chart-inner">
                    <span class="chart-val">89.2%</span>
                    <span class="chart-lbl">Overall</span>
                </div>
            </div>
        </div>

        <!-- Cards Grid -->
        <div class="stat-cards-grid">
            <div class="info-card card-green">
                <span class="info-val">92.5%</span>
                <span class="info-lbl">This Month</span>
            </div>
            <div class="info-card card-blue">
                <span class="info-val">88.7%</span>
                <span class="info-lbl">Semester</span>
            </div>
            <div class="info-card card-orange">
                <span class="info-val">12 days</span>
                <span class="info-lbl">Current Streak</span>
            </div>
            <div class="info-card card-teal"> <!-- Added 4th card based on image layout logic -->
                <span class="info-val">28 days</span>
                <span class="info-lbl">Best Streak</span>
            </div>
        </div>
    </div>

    <!-- Meta Bar -->
    <div class="meta-bar">
        <div class="meta-item">
            <span class="meta-title">Total Classes Attended</span>
            <span class="meta-data text-main">156 / 175</span>
        </div>
        <div class="meta-item">
            <span class="meta-title">Best Subject</span>
            <span class="meta-data text-green">Data Structures & Algorithms</span>
        </div>
        <div class="meta-item">
            <span class="meta-title">Best Month</span>
            <span class="meta-data text-blue">September 2024 (98.5%)</span>
        </div>
    </div>

    <!-- 2. Attendance Trend -->
    <div class="trend-section">
        <div class="trend-header">
            <h6 class="fw-bold text-main m-0"><i class="bi bi-graph-up me-2 text-warning"></i>Attendance Trend</h6>
            <div class="d-flex gap-2">
                <select class="form-select form-select-sm border-light bg-light w-auto"><option>Monthly</option></select>
                <select class="form-select form-select-sm border-light bg-light w-auto"><option>Current</option></select>
            </div>
        </div>

        <div class="d-flex justify-content-between --text-muted small mb-1">
            <span>100%</span> <span>Last 7 Days Trend</span> <span>0%</span>
        </div>

        <!-- Heatmap Blocks -->
        <div class="heatmap-row">
            <div class="heat-block hb-green" data-day="Mon"></div>
            <div class="heat-block hb-green" data-day="Tue"></div>
            <div class="heat-block hb-orange" data-day="Wed"></div>
            <div class="heat-block hb-green" data-day="Thu"></div>
            <div class="heat-block hb-red" data-day="Fri"></div>
            <div class="heat-block hb-green" data-day="Sat"></div>
            <div class="heat-block hb-green" data-day="Sun"></div>
        </div>
    </div>

    <!-- 3. Recent History List -->
    <h6 class="fw-bold text-main mb-3"><i class="bi bi-list-ul me-2 text-primary"></i>Recent History</h6>
    <div class="history-list">

        <!-- Item 1: Today (Partial/Warning) -->
        <div class="history-card partial">
            <div class="percent-badge pb-orange">66%</div>
            <div class="history-header">
                <div class="dot-indicator bg-dot-red"></div>
                <span class="date-title">Today</span>
            </div>

            <div class="stats-mini-row">
                <div class="stat-mini"><span class="sm-val text-p-green">2</span><span class="sm-lbl">Present</span></div>
                <div class="stat-mini"><span class="sm-val text-p-blue">3</span><span class="sm-lbl">Total</span></div>
                <div class="stat-mini"><span class="sm-val text-p-red">1</span><span class="sm-lbl">Absent</span></div>
            </div>

            <div class="subject-pills">
                <span class="subj-pill">Data Structures</span>
                <span class="subj-pill">Database Mgmt</span>
                <span class="subj-pill missed">Software Eng</span>
            </div>

            <div class="warning-box">
                <i class="bi bi-exclamation-circle"></i> Missed morning class due to medical appointment
            </div>
        </div>

        <!-- Item 2: Yesterday (Full) -->
        <div class="history-card all-present">
            <div class="percent-badge pb-green">100%</div>
            <div class="history-header">
                <div class="dot-indicator bg-dot-green"></div>
                <span class="date-title">Yesterday</span>
            </div>

            <div class="stats-mini-row">
                <div class="stat-mini"><span class="sm-val text-p-green">4</span><span class="sm-lbl">Present</span></div>
                <div class="stat-mini"><span class="sm-val text-p-blue">4</span><span class="sm-lbl">Total</span></div>
            </div>

            <div class="subject-pills">
                <span class="subj-pill">Data Structures</span>
                <span class="subj-pill">Database Mgmt</span>
                <span class="subj-pill">Software Eng</span>
                <span class="subj-pill">Web Dev</span>
            </div>
        </div>

        <!-- Item 3: 2d ago (Full) -->
        <div class="history-card all-present">
            <div class="percent-badge pb-green">100%</div>
            <div class="history-header">
                <div class="dot-indicator bg-dot-green"></div>
                <span class="date-title">2d ago</span>
            </div>

            <div class="stats-mini-row">
                <div class="stat-mini"><span class="sm-val text-p-green">2</span><span class="sm-lbl">Present</span></div>
                <div class="stat-mini"><span class="sm-val text-p-blue">2</span><span class="sm-lbl">Total</span></div>
            </div>

            <div class="subject-pills">
                <span class="subj-pill">Data Structures</span>
                <span class="subj-pill">Database Mgmt</span>
            </div>
        </div>

        <!-- Item 4: 3d ago (Full) -->
        <div class="history-card all-present">
            <div class="percent-badge pb-green">100%</div>
            <div class="history-header">
                <div class="dot-indicator bg-dot-green"></div>
                <span class="date-title">3d ago</span>
            </div>

            <div class="stats-mini-row">
                <div class="stat-mini"><span class="sm-val text-p-green">5</span><span class="sm-lbl">Present</span></div>
                <div class="stat-mini"><span class="sm-val text-p-blue">5</span><span class="sm-lbl">Total</span></div>
            </div>

            <div class="subject-pills">
                <span class="subj-pill">Data Structures</span>
                <span class="subj-pill">Database Mgmt</span>
                <span class="subj-pill">Software Eng</span>
                <span class="subj-pill">Web Dev</span>
                <span class="subj-pill">Computer Networks</span>
            </div>
        </div>

        <!-- Item 5: 5 Dec (Partial) -->
        <div class="history-card partial">
            <div class="percent-badge pb-orange">80%</div>
            <div class="history-header">
                <div class="dot-indicator bg-dot-orange"></div>
                <span class="date-title">5 Dec, 2025</span>
            </div>

            <div class="stats-mini-row">
                <div class="stat-mini"><span class="sm-val text-p-green">4</span><span class="sm-lbl">Present</span></div>
                <div class="stat-mini"><span class="sm-val text-p-blue">5</span><span class="sm-lbl">Total</span></div>
                <div class="stat-mini"><span class="sm-val text-p-red">1</span><span class="sm-lbl">Absent</span></div>
            </div>

            <div class="subject-pills">
                <span class="subj-pill">Data Structures</span>
                <span class="subj-pill">Database Mgmt</span>
                <span class="subj-pill">Software Eng</span>
                <span class="subj-pill">Web Dev</span>
                <span class="subj-pill missed">Computer Networks</span>
            </div>
        </div>

    </div>

</div>
@endsection

