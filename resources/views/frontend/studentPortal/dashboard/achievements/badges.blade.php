@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Skill Badges')
@section('icon', 'bi bi-patch-check fs-4 p-2 bg-primary bg-opacity-10 rounded-3 text-primary')

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
        --soft-purple: #e0cffc;
        --text-purple: #6f42c1;
    }

    [data-theme="dark"] {
        --bg-body: #0f1626;
        --bg-sidebar: #1e293b;
        --bg-card: #2e333f;
        --bg-hover: #2e333f;

        --text-main: #e9ecef;
        --text-muted: #adb5bd;
        --border-color: #767677;

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
        --soft-purple: rgba(111, 66, 193, 0.15);
        --text-purple: #a370f7;
    }

    /* 1. Progress Overview */
    .progress-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
    }

    .level-badge {
        background-color: #0ea5e9;
        color: white;
        padding: 6px 16px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.85rem;
        display: inline-block;
        white-space: nowrap;
    }

    .points-text {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 8px;
        display: block;
    }

    .main-progress-track {
        height: 10px;
        background-color: var(--bg-hover);
        border-radius: 6px;
        overflow: hidden;
        margin-bottom: 8px;
    }

    .main-progress-fill {
        height: 100%;
        background-color: #0ea5e9;
        border-radius: 6px;
        transition: width 1s ease;
    }

    .level-steps {
        display: flex;
        justify-content: space-between; /* Better spacing */
        gap: 10px;
        margin-top: 24px;
        flex-wrap: wrap; /* Allow wrapping on very small screens */
    }

    .step-circle {
        width: 60px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }

    .circle-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid var(--border-color);
        font-size: 1rem;
        color: var(--text-muted);
        transition: 0.2s;
    }

    .circle-icon.completed { color: white; }
    .circle-icon.active {
        border-color: #f5c639;
        color: #f5c639;
        box-shadow: 0 0 0 4px var(--soft-orange);
    }

    .step-label {
        font-size: 0.75rem;
        color: var(--text-muted);
        font-weight: 600;
        text-align: center;
    }

    /* 2. Badge Stats */
    .stat-box {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        height: 100%;
    }

    .bg-green-soft { background-color: var(--soft-green); color: var(--text-green); }
    .bg-blue-soft { background-color: var(--soft-blue); color: var(--text-blue); }
    .bg-orange-soft { background-color: var(--soft-orange); color: var(--text-orange); }
    .bg-teal-soft { background-color: var(--soft-teal); color: var(--text-teal); }

    .sb-icon { font-size: 1.5rem; margin-bottom: 4px; display: block; }
    .sb-val { font-size: 1.5rem; font-weight: 700; line-height: 1.2; }
    .sb-lbl { font-size: 0.75rem; font-weight: 600; text-transform: uppercase; }

    /* 3. Badge Cards */
    .badge-card {
        border-radius: 16px;
        padding: 24px;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
        transition: transform 0.2s;
        min-height: 220px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%; /* Ensure equal height in row */
    }

    .badge-card:hover { transform: translateY(-5px); }

    .grad-blue { background: linear-gradient(135deg, #60a5fa 0%, #93c5fd 100%); }
    .grad-green { background: linear-gradient(135deg, #34d399 0%, #6ee7b7 100%); }
    .grad-purple { background: linear-gradient(135deg, #a78bfa 0%, #c4b5fd 100%); }
    .grad-orange { background: linear-gradient(135deg, #fbbf24 0%, #fcd34d 100%); }

    .b-icon-box {
        width: 64px; height: 64px;
        background-color: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(4px);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 2rem;
        margin-bottom: 16px;
        border: 2px solid rgba(255, 255, 255, 0.4);
    }

    .b-title { font-size: 1.1rem; font-weight: 700; margin-bottom: 4px; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); }
    .b-rank {
        font-size: 0.7rem; text-transform: uppercase; font-weight: 700;
        background-color: rgba(0, 0, 0, 0.2);
        padding: 4px 10px; border-radius: 12px;
        margin-bottom: 8px; display: inline-block;
    }
    .b-pts { font-size: 0.85rem; font-weight: 600; opacity: 0.9; }

    /* Available Badges */
    .avail-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 24px;
        text-align: center;
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .avail-icon {
        width: 56px; height: 56px;
        margin: 0 auto 16px;
        border-radius: 50%;
        border: 1px solid var(--border-color);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
    }

    .av-blue { background-color: var(--soft-blue); color: var(--text-blue); }
    .av-red { background-color: var(--soft-red); color: var(--text-red); }
    .av-green { background-color: var(--soft-green); color: var(--text-green); }
    .av-orange { background-color: var(--soft-orange); color: var(--text-orange); }

    .av-title { font-weight: 600; color: var(--text-main); font-size: 0.95rem; margin-bottom: 4px; }
    .av-rank { font-size: 0.7rem; font-weight: 700; opacity: 0.7; margin-bottom: 12px; display: block; color: var(--text-muted); }

    .progress-mini {
        height: 6px;
        background-color: var(--border-color);
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 4px;
        width: 100%;
    }
    .progress-mini-bar { height: 100%; border-radius: 4px; }
    .progress-text { font-size: 0.7rem; font-weight: 700; display: block; }

    /* Start Quest Button */
    .btn-quest {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background-color: #0ea5e9;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 30px;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.4);
        display: flex; align-items: center; gap: 8px;
        z-index: 100;
        transition: 0.2s;
    }
    .btn-quest:hover { transform: translateY(-2px); background-color: #0284c7; }

    /* Mobile Tweaks */
    @media (max-width: 576px) {
        .level-steps { justify-content: center; } /* Center steps on mobile */
        .btn-quest { bottom: 20px; right: 20px; padding: 10px 20px; font-size: 0.9rem; }
    }
</style>

<div class="content-body">

    <h6 class="fw-bold text-main mb-3">Progress Overview</h6>
    <div class="progress-card">
        <div class="d-flex justify-content-between align-items-end mb-2 flex-wrap gap-2">
            <span class="points-text">Skill Points: 2850 / 3500</span>
            <span class="level-badge">Level: Intermediate</span>
        </div>

        <div class="main-progress-track">
            <div class="main-progress-fill" style="width: 81%;"></div>
        </div>
        <div class="text-end small --text-muted fw-bold mb-4">81% Complete</div>

        <div class="level-steps">
            <div class="step-circle --soft-blue">
                <div class="circle-icon completed bg-primary border border-primary"><i class="bi bi-check"></i></div>
                <span class="step-label">Beginner</span>
            </div>
            <div class="step-circle ">
                <div class="circle-icon completed bg-success border border-success"><i class="bi bi-check"></i></div>
                <span class="step-label">Intermediate</span>
            </div>
            <div class="step-circle">
                <div class="circle-icon active"><i class="bi bi-star-fill"></i></div>
                <span class="step-label">Advanced</span>
            </div>
            <div class="step-circle">
                <div class="circle-icon completed bg-danger border border-danger"><i class="bi bi-lock-fill"></i></div>
                <span class="step-label">Expert</span>
            </div>
            <div class="step-circle">
                <div class="circle-icon completed bg-info border border-info"><i class="bi bi-lock-fill"></i></div>
                <span class="step-label">Master</span>
            </div>
        </div>
    </div>

    <h6 class="fw-bold text-main mb-3">Badge Statistics</h6>
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-box bg-green-soft">
                <i class="bi bi-award sb-icon"></i>
                <span class="sb-val">18</span>
                <span class="sb-lbl">Earned</span>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-box bg-blue-soft">
                <i class="bi bi-bullseye sb-icon"></i>
                <span class="sb-val">45</span>
                <span class="sb-lbl">Available</span>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-box bg-orange-soft">
                <i class="bi bi-graph-up-arrow sb-icon"></i>
                <span class="sb-val">#15</span>
                <span class="sb-lbl">Rank</span>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-box bg-teal-soft">
                <i class="bi bi-calendar-check sb-icon text-teal"></i>
                <span class="sb-val">4</span>
                <span class="sb-lbl">This Month</span>
            </div>
        </div>
    </div>

    <h6 class="fw-bold text-main mb-3">Earned Badges</h6>
    <div class="row g-4 mb-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="badge-card grad-blue">
                <div class="b-icon-box"><i class="bi bi-phone"></i></div>
                <h6 class="b-title">Flutter Master</h6>
                <span class="b-rank">Legendary</span>
                <span class="b-pts"><i class="bi bi-lightning-fill"></i> 500 pts</span>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="badge-card grad-green">
                <div class="b-icon-box"><i class="bi bi-bar-chart-fill"></i></div>
                <h6 class="b-title">Data Analyst Pro</h6>
                <span class="b-rank">Epic</span>
                <span class="b-pts"><i class="bi bi-lightning-fill"></i> 350 pts</span>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="badge-card grad-purple">
                <div class="b-icon-box"><i class="bi bi-cloud-check"></i></div>
                <h6 class="b-title">Cloud Native</h6>
                <span class="b-rank">Epic</span>
                <span class="b-pts"><i class="bi bi-lightning-fill"></i> 400 pts</span>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="badge-card grad-orange">
                <div class="b-icon-box"><i class="bi bi-people-fill"></i></div>
                <h6 class="b-title">Team Leader</h6>
                <span class="b-rank">Rare</span>
                <span class="b-pts"><i class="bi bi-lightning-fill"></i> 250 pts</span>
            </div>
        </div>
    </div>

    <h6 class="fw-bold text-main mb-3">Available Badges</h6>
    <div class="row g-4 mb-5">

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="avail-card">
                <div class="avail-icon av-blue"><i class="bi bi-cpu"></i></div>
                <h6 class="av-title">AI/ML Specialist</h6>
                <span class="av-rank text-blue">Legendary</span>
                <div class="progress-mini">
                    <div class="progress-mini-bar bg-primary" style="width: 25%;"></div>
                </div>
                <span class="progress-text text-blue">25%</span>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="avail-card">
                <div class="avail-icon av-red"><i class="bi bi-shield-lock"></i></div>
                <h6 class="av-title">Cybersecurity Guardian</h6>
                <span class="av-rank text-danger">Epic</span>
                <div class="progress-mini">
                    <div class="progress-mini-bar bg-danger" style="width: 0%;"></div>
                </div>
                <span class="progress-text text-danger">0%</span>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="avail-card">
                <div class="avail-icon av-green"><i class="bi bi-phone"></i></div>
                <h6 class="av-title">Mobile App Master</h6>
                <span class="av-rank text-success">Epic</span>
                <div class="progress-mini">
                    <div class="progress-mini-bar bg-success" style="width: 60%;"></div>
                </div>
                <span class="progress-text text-success">60%</span>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="avail-card">
                <div class="avail-icon av-orange"><i class="bi bi-link"></i></div>
                <h6 class="av-title">Blockchain Pioneer</h6>
                <span class="av-rank text-warning">Legendary</span>
                <div class="progress-mini">
                    <div class="progress-mini-bar bg-warning" style="width: 10%;"></div>
                </div>
                <span class="progress-text text-warning">10%</span>
            </div>
        </div>

    </div>

</div>

<button class="btn-quest">
    <i class="bi bi-play-circle-fill"></i> Start Quest
</button>
@endsection
