@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Test History')

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

    /* Overview Cards */
    .stat-card {
        background-color: var(--bg-card);
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        border: 1px solid var(--border-color);
    }
    .stat-value { font-size: 1.5rem; font-weight: 700; margin-bottom: 4px; color: var(--text-blue); }
    .stat-label { font-size: 0.8rem; color: var(--text-muted); }
    .stat-icon { font-size: 1.5rem; margin-bottom: 8px; color: var(--text-blue); }

    /* Streak Banner */
    .streak-banner {
        background-color: var(--soft-green);
        border-radius: 12px;
        padding: 16px;
        display: flex;
        align-items: center;
        gap: 16px;
        color: var(--text-green);
        margin-bottom: 32px;
    }
    .streak-icon {
        background-color: #198754;
        color: white;
        width: 40px; height: 40px;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem;
    }

    /* Subject Performance Bars */
    .subject-row { margin-bottom: 16px; }
    .subject-header { display: flex; justify-content: space-between; font-size: 0.85rem; margin-bottom: 6px; color: var(--text-muted); }
    .progress-track { height: 8px; background-color: var(--border-color); border-radius: 4px; overflow: hidden; }
    .progress-fill { height: 100%; border-radius: 4px; }

    /* Test History Card */
    .history-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 24px;
    }
    .grade-circle {
        width: 48px; height: 48px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-weight: 700; font-size: 1.1rem;
        color: white;
    }
    .grade-A { background-color: #198754; }
    .grade-B { background-color: #0d6efd; }
    .grade-C { background-color: #ffc107; color: #000; }

    .test-meta-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin: 20px 0;
        text-align: center;
        background-color: var(--bg-hover);
        padding: 16px;
        border-radius: 12px;
    }
    .meta-val { font-weight: 700; color: var(--text-main); font-size: 1rem; }
    .meta-lbl { font-size: 0.75rem; color: var(--text-muted); }

    .feedback-box {
        background-color: var(--soft-blue);
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 20px;
        font-size: 0.9rem;
        color: var(--text-blue);
        border-left: 4px solid var(--text-blue);
    }

    /* Tags */
    .badge-tag {
        font-size: 0.7rem;
        padding: 4px 8px;
        border-radius: 6px;
        background-color: var(--soft-orange);
        color: var(--text-orange);
        font-weight: 600;
        margin-left: 8px;
    }
</style>

<div class="content-body">

    <!-- 1. Performance Overview Cards -->
    <h6 class="fw-bold text-main mb-3">Performance Overview</h6>
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card bg-soft-blue border-0">
                <i class="bi bi-file-earmark-text stat-icon"></i>
                <div class="stat-value">45</div>
                <div class="stat-label">Tests Taken</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-soft-green border-0">
                <i class="bi bi-bullseye stat-icon text-success"></i>
                <div class="stat-value text-success">87.3%</div>
                <div class="stat-label">Average Score</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-soft-teal border-0">
                <i class="bi bi-check-circle stat-icon text-teal"></i> <!-- using teal class manually below -->
                <div class="stat-value" style="color: #107c6f;">91.1%</div>
                <div class="stat-label">Pass Rate</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-soft-blue border-0">
                <i class="bi bi-graph-up-arrow stat-icon"></i>
                <div class="stat-value">+12.5%</div>
                <div class="stat-label">Improvement</div>
            </div>
        </div>
    </div>

    <!-- Streak Banner -->
    <div class="streak-banner">
        <div class="streak-icon"><i class="bi bi-lightning-fill"></i></div>
        <div class="flex-grow-1">
            <h6 class="fw-bold m-0">Current Streak</h6>
            <small class="opacity-75">8 consecutive passes</small>
        </div>
        <div class="text-end">
            <small class="d-block opacity-75">Study Time</small>
            <span class="fw-bold">22.5h total</span>
        </div>
    </div>

    <!-- 2. Subject Performance Bars -->
    <h6 class="fw-bold text-main mb-3">Performance Analysis</h6>
    <div class="card-custom mb-5">
        <h6 class=" small fw-bold mb-4" style="color: var(--text-muted)">Subject Performance</h6>

        <div class="subject-row">
            <div class="subject-header"><span>Computer Science</span> <span class="text-success fw-bold">94.2%</span></div>
            <div class="progress-track"><div class="progress-fill bg-success" style="width: 94.2%;"></div></div>
        </div>

        <div class="subject-row">
            <div class="subject-header"><span>Mathematics</span> <span class="text-warning fw-bold">78.5%</span></div>
            <div class="progress-track"><div class="progress-fill bg-warning" style="width: 78.5%;"></div></div>
        </div>

        <div class="subject-row">
            <div class="subject-header"><span>Physics</span> <span class="text-primary fw-bold">85.7%</span></div>
            <div class="progress-track"><div class="progress-fill bg-primary" style="width: 85.7%;"></div></div>
        </div>

        <div class="subject-row">
            <div class="subject-header"><span>English</span> <span class="text-info fw-bold">81.3%</span></div>
            <div class="progress-track"><div class="progress-fill bg-info" style="width: 81.3%;"></div></div>
        </div>
    </div>

    <!-- 3. Test History List -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold text-main m-0">Test History</h6>
        <select class="form-select form-select-sm w-auto border-0 bg-light">
            <option>Recent</option>
            <option>Oldest</option>
            <option>Score: High to Low</option>
        </select>
    </div>

    <!-- History Card 1 -->
    <div class="history-card">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex gap-3">
                <div class="exam-icon-box" style="width: 48px; height: 48px; border-radius: 10px; background: #e0f2fe; color: #0284c7; display:flex; align-items:center; justify-content:center; font-size: 1.2rem;">
                    <i class="bi bi-question-circle"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-main m-0">Advanced Flutter Development Quiz</h6>
                    <div class="mt-1">
                        <span class="text-success small fw-bold">Computer Science</span>
                        <span class="badge-tag">Quiz</span>
                    </div>
                </div>
            </div>
            <div class="grade-circle grade-A">A</div>
        </div>

        <div class="test-meta-grid">
            <div><div class="meta-val">23/25</div><div class="meta-lbl">Questions</div></div>
            <div><div class="meta-val">38/45 min</div><div class="meta-lbl">Time</div></div>
            <div><div class="meta-val">95th</div><div class="meta-lbl">Percentile</div></div>
            <div><div class="meta-val">78.5%</div><div class="meta-lbl">Class Avg</div></div>
        </div>

        <div class="d-flex justify-content-between small mb-3 px-1" style="color: var(--text-muted)">
            <span><i class="bi bi-calendar me-1"></i> 9/12/2025</span>
            <span>ID: TEST_001</span>
        </div>

        <div class="feedback-box">
            <strong><i class="bi bi-chat-quote me-2"></i>Instructor Feedback</strong>
            <p class="m-0 mt-1 opacity-75">Excellent understanding of Flutter concepts. Focus on testing for improvement.</p>
        </div>

        <div class="row g-2">
            <div class="col-md-6">
                <button class="btn btn-success w-100 text-white fw-bold"><i class="bi bi-eye me-2"></i> View Details</button>
            </div>
            <div class="col-md-6">
                <button class="btn btn-outline-warning w-100 fw-bold"><i class="bi bi-arrow-repeat me-2"></i> Certificate</button>
            </div>
        </div>
    </div>

    <!-- History Card 2 -->
    <div class="history-card">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex gap-3">
                <div class="exam-icon-box" style="width: 48px; height: 48px; border-radius: 10px; background: #e0f2fe; color: #0284c7; display:flex; align-items:center; justify-content:center; font-size: 1.2rem;">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-main m-0">Calculus Midterm Examination</h6>
                    <div class="mt-1">
                        <span class="text-warning small fw-bold">Mathematics</span>
                        <span class="badge-tag">Midterm</span>
                    </div>
                </div>
            </div>
            <div class="grade-circle grade-B">B-</div>
        </div>

        <div class="test-meta-grid">
            <div><div class="meta-val">11/15</div><div class="meta-lbl">Questions</div></div>
            <div><div class="meta-val">115/120 min</div><div class="meta-lbl">Time</div></div>
            <div><div class="meta-val">72th</div><div class="meta-lbl">Percentile</div></div>
            <div><div class="meta-val">68.2%</div><div class="meta-lbl">Class Avg</div></div>
        </div>

        <div class="d-flex justify-content-between small mb-3 px-1" style="color: var(--text-muted)">
            <span><i class="bi bi-calendar me-1"></i> 4/12/2025</span>
            <span>ID: TEST_002</span>
        </div>

        <div class="feedback-box">
            <strong><i class="bi bi-chat-quote me-2"></i>Instructor Feedback</strong>
            <p class="m-0 mt-1 opacity-75">Good foundation but needs practice with application problems.</p>
        </div>

        <div class="row g-2">
            <div class="col-md-6">
                <button class="btn btn-warning w-100 text-white fw-bold"><i class="bi bi-eye me-2"></i> View Details</button>
            </div>
            <div class="col-md-6">
                <button class="btn btn-outline-warning w-100 fw-bold"><i class="bi bi-arrow-clockwise me-2"></i> Retake</button>
            </div>
        </div>
    </div>

</div>
@endsection
