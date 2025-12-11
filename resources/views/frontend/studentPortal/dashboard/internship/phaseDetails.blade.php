@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Phase Details')

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

    /* 1. Header Card */
    .header-card {
        background-color: var(--dark-card-bg);
        border: 1px solid var(--dark-border);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
    }

    .intern-icon {
        width: 48px; height: 48px;
        background-color: rgba(56, 189, 248, 0.1);
        color: #38bdf8;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
    }

    /* 2. Phase Stepper */
    .stepper-container {
        display: flex;
        gap: 16px;
        margin-top: 24px;
        overflow-x: auto;
    }
    .phase-step {
        flex: 1;
        min-width: 140px;
        background-color: rgba(255,255,255,0.03);
        border: 1px solid var(--dark-border);
        border-radius: 8px;
        padding: 16px;
        cursor: pointer;
        transition: 0.2s;
        position: relative;
    }
    .phase-step:hover { background-color: rgba(255,255,255,0.05); }

    .phase-step.active {
        background-color: rgba(56, 189, 248, 0.1);
        border-color: #38bdf8;
    }
    .phase-step.active::after {
        content: ''; position: absolute; bottom: -1px; left: 0; right: 0;
        height: 3px; background-color: #38bdf8; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;
    }

    .step-icon { margin-bottom: 8px; font-size: 1.1rem; color: #64748b; }
    .phase-step.active .step-icon { color: #38bdf8; }
    .step-title { font-size: 0.8rem; font-weight: 600; color: #fff; display: block; }
    .step-dur { font-size: 0.7rem; color: #94a3b8; }

    /* 3. Phase Detail Card */
    .detail-card {
        background-color: var(--dark-card-bg);
        border: 1px solid var(--dark-border);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
    }

    .phase-header-row {
        display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px;
    }
    .phase-badge {
        background-color: #0ea5e9;
        color: white;
        font-size: 0.7rem;
        padding: 4px 10px;
        border-radius: 6px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .progress-section { margin: 24px 0; }
    .prog-bar-track {
        height: 6px; background-color: #334155; border-radius: 4px; overflow: hidden; margin-top: 8px;
    }
    .prog-bar-fill { height: 100%; background-color: #0ea5e9; width: 35%; }

    .meta-row {
        display: flex; gap: 40px; margin-top: 24px; padding-top: 24px; border-top: 1px solid var(--dark-border);
    }
    .meta-col { display: flex; align-items: center; gap: 12px; }
    .meta-icon { font-size: 1.2rem; color: #38bdf8; }
    .meta-lbl { font-size: 0.75rem; color: #94a3b8; display: block; }
    .meta-val { font-size: 0.95rem; font-weight: 600; color: #fff; }

    /* 4. Skills & Criteria */
    .skills-row { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 24px; }
    .skill-pill {
        background-color: rgba(16, 185, 129, 0.1);
        color: #4ade80;
        border: 1px solid rgba(16, 185, 129, 0.2);
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .criteria-list { list-style: none; padding: 0; margin: 0; }
    .criteria-item {
        display: flex; align-items: start; gap: 12px; margin-bottom: 12px;
        font-size: 0.9rem; color: #cbd5e1;
    }
    .check-icon { color: #f59e0b; font-size: 1rem; margin-top: 2px; } /* Orange Check */

    /* 5. Mentor & Resources */
    .mentor-box {
        background-color: rgba(56, 189, 248, 0.05);
        border: 1px solid rgba(56, 189, 248, 0.1);
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 24px;
        color: #bae6fd;
        font-size: 0.9rem;
    }
    .resource-list { list-style: none; padding: 0; margin: 0; }
    .resource-item { margin-bottom: 10px; display: flex; align-items: center; gap: 10px; }
    .resource-link { color: #f87171; text-decoration: none; font-size: 0.9rem; transition: 0.2s; border-bottom: 1px dashed #f87171;}
    .resource-link:hover { color: #fca5a5; border-bottom-style: solid; }
</style>

<div class="content-body">

    <div class="dark-wrapper">

        <!-- Header -->
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="p-2 bg-primary bg-opacity-10 rounded-3 text-primary"><i class="bi bi-layers-fill fs-4"></i></div>
            <div>
                <h5 class="fw-bold m-0">Phase Details</h5>
                <small class="text-secondary">Welcome back, John!</small>
            </div>
        </div>

        <!-- 1. Internship Header & Stepper -->
        <div class="header-card">
            <div class="d-flex align-items-center gap-3">
                <div class="intern-icon"><i class="bi bi-briefcase"></i></div>
                <div>
                    <h6 class="fw-bold text-white m-0 fs-5">Full-Stack Development Internship</h6>
                    <span class="--text-muted small">120 days • 4 phases</span>
                </div>
            </div>

            <div class="stepper-container">
                <!-- Phase 1 -->
                <div class="phase-step">
                    <div class="step-icon"><i class="bi bi-check-circle-fill text-success"></i></div>
                    <span class="step-title">Phase 1</span>
                    <span class="step-dur">15d</span>
                </div>
                <!-- Phase 2 (Active) -->
                <div class="phase-step active">
                    <div class="step-icon"><i class="bi bi-code-slash"></i></div>
                    <span class="step-title">Phase 2</span>
                    <span class="step-dur">45d</span>
                </div>
                <!-- Phase 3 -->
                <div class="phase-step">
                    <div class="step-icon"><i class="bi bi-layers"></i></div>
                    <span class="step-title">Phase 3</span>
                    <span class="step-dur">30d</span>
                </div>
                <!-- Phase 4 -->
                <div class="phase-step">
                    <div class="step-icon"><i class="bi bi-box-seam"></i></div>
                    <span class="step-title">Phase 4</span>
                    <span class="step-dur">30d</span>
                </div>
            </div>
        </div>

        <!-- 2. Main Phase Detail -->
        <div class="detail-card">

            <div class="phase-header-row">
                <div class="d-flex gap-3">
                    <div class="intern-icon" style="width: 40px; height: 40px; font-size: 1.2rem; background: rgba(56,189,248,0.1); color: #38bdf8;"><i class="bi bi-code"></i></div>
                    <div>
                        <h5 class="fw-bold text-info m-0">Phase 2: Core Development</h5>
                        <span class="--text-muted small">Primary Feature Development & Implementation</span>
                    </div>
                </div>
                <span class="phase-badge">IN_PROGRESS</span>
            </div>

            <p class="text-secondary small mb-4" style="line-height: 1.6;">
                The core development phase is where you'll implement the main features of the project. This is the most intensive period involving hands-on coding, regular code reviews, and building substantial functionality.
            </p>

            <div class="progress-section">
                <div class="d-flex justify-content-between small fw-bold text-secondary mb-1">
                    <span>Progress</span> <span class="text-info">35%</span>
                </div>
                <div class="prog-bar-track">
                    <div class="prog-bar-fill"></div>
                </div>
            </div>

            <div class="meta-row">
                <div class="meta-col">
                    <i class="bi bi-clock-history meta-icon"></i>
                    <div><span class="meta-lbl">Duration</span><span class="meta-val">45 days</span></div>
                </div>
                <div class="meta-col">
                    <i class="bi bi-calendar-event meta-icon"></i>
                    <div><span class="meta-lbl">Start Date</span><span class="meta-val">2/12/2025</span></div>
                </div>
                <div class="meta-col">
                    <i class="bi bi-flag meta-icon"></i>
                    <div><span class="meta-lbl">End Date</span><span class="meta-val">16/1/2026</span></div>
                </div>
            </div>
        </div>

        <!-- 3. Skills, Criteria, Notes -->
        <div class="row g-4">
            <div class="col-lg-8">
                <!-- Skills -->
                <div class="detail-card">
                    <h6 class="text-success fw-bold mb-3"><i class="bi bi-award me-2"></i>Skills Focus</h6>
                    <div class="skills-row">
                        <span class="skill-pill">React/Vue.js Frontend Development</span>
                        <span class="skill-pill">Node.js Backend Development</span>
                        <span class="skill-pill">Database Design & Integration</span>
                        <span class="skill-pill">API Development & Documentation</span>
                        <span class="skill-pill">Authentication & Security</span>
                        <span class="skill-pill">Code Review & Collaboration</span>
                    </div>

                    <!-- Criteria -->
                    <h6 class="text-warning fw-bold mb-3 mt-4"><i class="bi bi-clipboard-check me-2"></i>Assessment Criteria</h6>
                    <ul class="criteria-list">
                        <li class="criteria-item"><i class="bi bi-check-circle-fill check-icon"></i> Code quality and adherence to standards (≥8/10)</li>
                        <li class="criteria-item"><i class="bi bi-check-circle-fill check-icon"></i> Feature completion rate (≥80%)</li>
                        <li class="criteria-item"><i class="bi bi-check-circle-fill check-icon"></i> Bug-free implementation (≥90%)</li>
                        <li class="criteria-item"><i class="bi bi-check-circle-fill check-icon"></i> API documentation quality (≥8/10)</li>
                        <li class="criteria-item"><i class="bi bi-check-circle-fill check-icon"></i> Collaboration and communication (≥8/10)</li>
                    </ul>
                </div>

                <!-- Mentor Notes -->
                <div class="detail-card">
                    <div class="mentor-box">
                        <strong class="d-block mb-2 text-info"><i class="bi bi-chat-quote-fill me-2"></i>Mentor Notes</strong>
                        <em>This is the most challenging phase. Focus on code quality over speed. Ask questions early and often.</em>
                    </div>

                    <h6 class="text-danger fw-bold mb-3"><i class="bi bi-book-half me-2"></i>Recommended Resources</h6>
                    <ul class="resource-list">
                        <li class="resource-item"><i class="bi bi-link-45deg text-danger"></i> <a href="#" class="resource-link">React/Vue.js Best Practices Guide</a></li>
                        <li class="resource-item"><i class="bi bi-link-45deg text-danger"></i> <a href="#" class="resource-link">Node.js Development Patterns</a></li>
                        <li class="resource-item"><i class="bi bi-link-45deg text-danger"></i> <a href="#" class="resource-link">Database Design Principles</a></li>
                        <li class="resource-item"><i class="bi bi-link-45deg text-danger"></i> <a href="#" class="resource-link">API Design Guidelines</a></li>
                        <li class="resource-item"><i class="bi bi-link-45deg text-danger"></i> <a href="#" class="resource-link">Security Implementation Checklist</a></li>
                    </ul>
                </div>
            </div>

            <!-- Deliverables (Optional Side Column if needed, usually empty in screenshot) -->
            <div class="col-lg-4">
                <!-- If you need a right sidebar later, it goes here -->
            </div>
        </div>

    </div>
</div>
@endsection
