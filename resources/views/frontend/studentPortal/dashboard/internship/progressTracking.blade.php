@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Progress Tracking')

@section('content')
<style>
    /* Theme Variables */
    :root {
        --bg-card: #ffffff;
        --text-main: #343a40;
        --text-muted: #6c757d;
        --border-color: #e9ecef;

        /* Dark Theme Specifics */
        --dark-card-bg: #1e293b;
        --dark-panel-bg: #0f172a;
        --dark-border: #334155;
    }

    [data-theme="dark"] {
        --bg-card: #252525;
        --text-main: #e9ecef;
        --text-muted: #adb5bd;
        --border-color: #2c2c2c;
    }

    /* Page Wrapper */
    .dark-wrapper {
        background-color: var(--dark-panel-bg);
        min-height: 100vh;
        padding: 24px;
        border-radius: 12px;
        color: #fff;
    }

    /* Common Card Style (Dark) */
    .metrics-card {
        background-color: var(--dark-card-bg);
        border: 1px solid var(--dark-border);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
    }

    /* 1. Overall Progress Section */
    .circle-progress-container {
        width: 120px; height: 120px;
        margin: 0 auto 32px;
        position: relative;
        display: flex; align-items: center; justify-content: center;
    }
    .circle-progress {
        width: 100%; height: 100%; border-radius: 50%;
        background: conic-gradient(#0ea5e9 22%, #334155 0);
        display: flex; align-items: center; justify-content: center;
    }
    .circle-inner {
        width: 85%; height: 85%;
        background-color: var(--dark-card-bg);
        border-radius: 50%;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
    }
    .circle-val { font-size: 1.5rem; font-weight: 700; color: #0ea5e9; line-height: 1; }
    .circle-lbl { font-size: 0.75rem; color: #94a3b8; margin-top: 4px; }

    .stat-grid-dark {
        display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px;
    }
    @media(min-width: 768px) { .stat-grid-dark { grid-template-columns: repeat(4, 1fr); } }

    .dark-stat-box {
        background-color: rgba(255,255,255,0.03);
        border: 1px solid var(--dark-border);
        border-radius: 8px; padding: 16px; text-align: center;
    }
    .ds-val { font-size: 1.1rem; font-weight: 700; color: #fff; margin-bottom: 4px; display: block; }
    .ds-lbl { font-size: 0.75rem; color: #94a3b8; }

    /* 2. Performance Metrics Bars */
    .metric-row { margin-bottom: 20px; }
    .metric-header { display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 0.85rem; font-weight: 600; color: #e2e8f0; }
    .metric-track { height: 6px; background-color: #334155; border-radius: 4px; overflow: hidden; }
    .metric-fill { height: 100%; border-radius: 4px; }
    .fill-teal { background-color: #14b8a6; }
    .fill-cyan { background-color: #06b6d4; }
    .fill-green { background-color: #10b981; }
    .fill-orange { background-color: #f59e0b; }
    .metric-target { font-size: 0.75rem; color: #64748b; margin-top: 4px; display: block; }

    /* 3. Milestones Timeline */
    .milestone-list { list-style: none; padding: 0; margin: 0; position: relative; }
    .milestone-list::before {
        content: ''; position: absolute; left: 14px; top: 10px; bottom: 10px;
        width: 2px; background-color: #334155; z-index: 0;
    }
    .ms-item { position: relative; padding-left: 40px; margin-bottom: 32px; z-index: 1; }
    .ms-item:last-child { margin-bottom: 0; }

    .ms-icon {
        position: absolute; left: 0; top: 0; width: 30px; height: 30px;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-size: 0.9rem; border: 4px solid var(--dark-card-bg);
    }

    /* Icon Status Colors */
    .icon-done { background-color: #10b981; color: #fff; } /* Green Check */
    .icon-active { background-color: #0ea5e9; color: #fff; } /* Blue Play */
    .icon-next { background-color: #f59e0b; color: #fff; border: 4px solid var(--dark-card-bg); } /* Orange */
    .icon-future { background-color: transparent; border: 2px solid #3b82f6; color: #3b82f6; box-shadow: 0 0 0 4px var(--dark-card-bg); } /* Blue Hollow */

    .ms-content h6 { font-size: 0.95rem; font-weight: 600; color: #fff; margin-bottom: 4px; }
    .ms-content p { font-size: 0.85rem; color: #94a3b8; margin-bottom: 6px; }
    .ms-meta { font-size: 0.75rem; color: #64748b; }

    .phase-badge {
        float: right; font-size: 0.7rem; background-color: rgba(16, 185, 129, 0.1);
        color: #4ade80; padding: 2px 8px; border-radius: 4px; font-weight: 600;
    }
    .phase-blue { background-color: rgba(14, 165, 233, 0.1); color: #38bdf8; }
    .phase-orange { background-color: rgba(245, 158, 11, 0.1); color: #f59e0b; }

    /* 4. Skills Section Styles */
    .skill-item { margin-bottom: 24px; }
    .skill-item:last-child { margin-bottom: 0; }
    .skill-header { display: flex; justify-content: space-between; margin-bottom: 6px; align-items: flex-end; }
    .skill-name { font-weight: 600; color: #f8fafc; font-size: 0.9rem; }
    .skill-meta { font-size: 0.75rem; font-weight: 600; }

    .cat-frontend { color: #38bdf8; }
    .cat-backend { color: #4ade80; }
    .cat-db { color: #fb923c; }
    .cat-test { color: #a78bfa; }
    .cat-devops { color: #f472b6; }

    .skill-track { height: 4px; background-color: #334155; border-radius: 2px; overflow: hidden; }
    .skill-fill { height: 100%; border-radius: 2px; background-color: #10b981; }
    .skill-updated { font-size: 0.7rem; color: #64748b; margin-top: 4px; display: block; }
</style>

<div class="content-body">

    <div class="dark-wrapper">

        <!-- Header -->
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="p-2 bg-primary bg-opacity-10 rounded-3 text-primary"><i class="bi bi-graph-up-arrow fs-4"></i></div>
            <div>
                <h5 class="fw-bold m-0">Progress Tracking</h5>
                <small class="text-secondary">Welcome back, John!</small>
            </div>
        </div>

        <!-- 1. Overall Progress -->
        <div class="metrics-card">
            <h6 class="fw-bold text-white mb-4"><i class="bi bi-record-circle me-2 text-info"></i>Overall Progress</h6>
            <div class="circle-progress-container">
                <div class="circle-progress">
                    <div class="circle-inner">
                        <span class="circle-val">22%</span><span class="circle-lbl">Complete</span>
                    </div>
                </div>
            </div>
            <div class="stat-grid-dark">
                <div class="dark-stat-box"><span class="ds-val text-success">26/120</span><span class="ds-lbl">Days Completed</span></div>
                <div class="dark-stat-box"><span class="ds-val text-info">13/39</span><span class="ds-lbl">Tasks Completed</span></div>
                <div class="dark-stat-box"><span class="ds-val text-success">6/15</span><span class="ds-lbl">Skills Acquired</span></div>
                <div class="dark-stat-box"><span class="ds-val text-warning">8.5/10</span><span class="ds-lbl">Mentor Rating</span></div>
            </div>
        </div>

        <!-- 2. Performance Metrics -->
        <div class="metrics-card">
            <h6 class="fw-bold text-white mb-4"><i class="bi bi-bar-chart-steps me-2 text-success"></i>Performance Metrics</h6>
            <div class="metric-row">
                <div class="metric-header"><span>Productivity</span> <span class="text-success">85%</span></div>
                <div class="metric-track"><div class="metric-fill fill-teal" style="width: 85%;"></div></div>
                <span class="metric-target">Target: 80%</span>
            </div>
            <div class="metric-row">
                <div class="metric-header"><span>Code Quality</span> <span class="text-info">78%</span></div>
                <div class="metric-track"><div class="metric-fill fill-cyan" style="width: 78%;"></div></div>
                <span class="metric-target">Target: 75%</span>
            </div>
            <div class="metric-row">
                <div class="metric-header"><span>Collaboration</span> <span class="text-success">92%</span></div>
                <div class="metric-track"><div class="metric-fill fill-green" style="width: 92%;"></div></div>
                <span class="metric-target">Target: 85%</span>
            </div>
            <div class="metric-row">
                <div class="metric-header"><span>Time Management</span> <span class="text-warning">73%</span></div>
                <div class="metric-track"><div class="metric-fill fill-orange" style="width: 73%;"></div></div>
                <span class="metric-target">Target: 80%</span>
            </div>
        </div>

        <!-- 3. Milestones Timeline (COMPLETE LIST) -->
        <div class="metrics-card">
            <h6 class="fw-bold text-white mb-4"><i class="bi bi-flag-fill me-2 text-primary"></i>Milestones Timeline</h6>
            <ul class="milestone-list">

                <!-- 1. Environment Setup -->
                <li class="ms-item">
                    <div class="ms-icon icon-done"><i class="bi bi-check"></i></div>
                    <div class="ms-content">
                        <span class="phase-badge">Phase 1</span>
                        <h6>Environment Setup Complete</h6>
                        <p>Development environment configured and ready for project work</p>
                        <span class="ms-meta">Target: 15d ago</span>
                    </div>
                </li>

                <!-- 2. User Authentication -->
                <li class="ms-item">
                    <div class="ms-icon icon-done"><i class="bi bi-check"></i></div>
                    <div class="ms-content">
                        <span class="phase-badge">Phase 2</span>
                        <h6>User Authentication Module</h6>
                        <p>Complete user registration, login, and session management system</p>
                        <span class="ms-meta">Target: 3d ago</span>
                    </div>
                </li>

                <!-- 3. Product Catalog (Active) -->
                <li class="ms-item">
                    <div class="ms-icon icon-active"><i class="bi bi-play-fill"></i></div>
                    <div class="ms-content">
                        <span class="phase-badge phase-blue">Phase 2</span>
                        <h6 class="text-info">Product Catalog System</h6>
                        <p>Build comprehensive product management and catalog browsing features</p>
                        <div class="progress my-2" style="height: 4px; background: #334155;"><div class="progress-bar bg-info" style="width: 60%"></div></div>
                        <span class="text-info small fw-bold">60% Complete</span> • <span class="ms-meta">Target: In 4d</span>
                    </div>
                </li>

                <!-- 4. Shopping Cart (Next Up - Orange) -->
                <li class="ms-item">
                    <div class="ms-icon icon-next"><i class="bi bi-cart"></i></div>
                    <div class="ms-content">
                        <span class="phase-badge phase-orange">Phase 2</span>
                        <h6 class="text-white">Shopping Cart & Checkout</h6>
                        <p>Implement cart management and secure checkout process</p>
                        <span class="ms-meta">Target: In 11d</span>
                    </div>
                </li>

                <!-- 5. Testing (Future - Hollow) -->
                <li class="ms-item">
                    <div class="ms-icon icon-future"><i class="bi bi-bug"></i></div>
                    <div class="ms-content">
                        <span class="phase-badge phase-blue">Phase 3</span>
                        <h6 class="--text-muted">Testing & Quality Assurance</h6>
                        <p>Comprehensive testing suite and code quality improvements</p>
                        <span class="ms-meta">Target: In 44d</span>
                    </div>
                </li>

                <!-- 6. Production Deployment (Future - Hollow) -->
                <li class="ms-item">
                    <div class="ms-icon icon-future"><i class="bi bi-rocket"></i></div>
                    <div class="ms-content">
                        <span class="phase-badge phase-blue">Phase 4</span>
                        <h6 class="--text-muted">Production Deployment</h6>
                        <p>Deploy application to production with CI/CD pipeline</p>
                        <span class="ms-meta">Target: In 84d</span>
                    </div>
                </li>

            </ul>
        </div>

        <!-- 4. Skills Development -->
        <div class="metrics-card">
            <h6 class="fw-bold text-white mb-4"><i class="bi bi-award me-2 text-success"></i>Skills Development</h6>

            <div class="skill-item">
                <div class="skill-header">
                    <span class="skill-name">React Development</span>
                    <span class="skill-meta cat-frontend">Frontend <span class="text-white">8/9</span></span>
                </div>
                <div class="skill-track"><div class="skill-fill" style="width: 88%;"></div></div>
                <span class="skill-updated">Last updated: 2d ago</span>
            </div>

            <div class="skill-item">
                <div class="skill-header">
                    <span class="skill-name">Node.js Backend</span>
                    <span class="skill-meta cat-backend">Backend <span class="text-white">6/8</span></span>
                </div>
                <div class="skill-track"><div class="skill-fill" style="width: 75%;"></div></div>
                <span class="skill-updated">Last updated: 1d ago</span>
            </div>

            <div class="skill-item">
                <div class="skill-header">
                    <span class="skill-name">Database Design</span>
                    <span class="skill-meta cat-db">Database <span class="text-white">5/7</span></span>
                </div>
                <div class="skill-track"><div class="skill-fill" style="width: 71%;"></div></div>
                <span class="skill-updated">Last updated: 3d ago</span>
            </div>

            <div class="skill-item">
                <div class="skill-header">
                    <span class="skill-name">API Development</span>
                    <span class="skill-meta cat-backend">Backend <span class="text-white">7/8</span></span>
                </div>
                <div class="skill-track"><div class="skill-fill" style="width: 87%;"></div></div>
                <span class="skill-updated">Last updated: 8h ago</span>
            </div>

            <div class="skill-item">
                <div class="skill-header">
                    <span class="skill-name">Testing & QA</span>
                    <span class="skill-meta cat-test">Testing <span class="text-white">4/7</span></span>
                </div>
                <div class="skill-track"><div class="skill-fill" style="width: 57%;"></div></div>
                <span class="skill-updated">Last updated: 5d ago</span>
            </div>

            <div class="skill-item">
                <div class="skill-header">
                    <span class="skill-name">DevOps & Deployment</span>
                    <span class="skill-meta cat-devops">DevOps <span class="text-white">3/6</span></span>
                </div>
                <div class="skill-track"><div class="skill-fill" style="width: 50%;"></div></div>
                <span class="skill-updated">Last updated: 10d ago</span>
            </div>

        </div>

    </div>
</div>
@endsection
