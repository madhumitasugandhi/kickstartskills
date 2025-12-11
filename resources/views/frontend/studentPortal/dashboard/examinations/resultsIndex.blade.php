@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Test Results')

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
    /* Card & General */
    .card-custom {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
    }

    /* Result Icon */
    .result-icon {
        width: 48px; height: 48px;
        border-radius: 12px;
        background-color: var(--soft-blue);
        color: var(--text-blue);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
    }

    /* Grade Circle */
    .grade-circle-sm {
        width: 40px; height: 40px;
        border-radius: 50%;
        background-color: var(--soft-blue);
        color: var(--text-blue);
        display: flex; align-items: center; justify-content: center;
        font-weight: 700;
        font-size: 0.9rem;
    }

    /* Stats Grid in Modal */
    .stat-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px dashed var(--border-color);
        font-size: 0.9rem;
    }
    .stat-row:last-child { border-bottom: none; }

    /* Modal Styling */
    .modal-content {
        background-color: var(--bg-card);
        color: var(--text-main);
        border-radius: 16px;
        border: 1px solid var(--border-color);
    }
    .modal-header { border-bottom: 1px solid var(--border-color); }
    .modal-footer { border-top: 1px solid var(--border-color); }
    .btn-close { filter: var(--text-muted) == '#e9ecef' ? invert(1) : none; }

    /* Bullet lists */
    .custom-list { list-style: none; padding-left: 0; }
    .custom-list li {
        position: relative;
        padding-left: 20px;
        margin-bottom: 8px;
        font-size: 0.9rem;
        color: var(--text-muted);
    }
    .custom-list li::before {
        content: "•";
        color: var(--text-blue);
        font-weight: bold;
        position: absolute;
        left: 0;
    }
</style>

<div class="content-body">

    <!-- 1. Header Card -->
    <div class="card-custom d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="result-icon"><i class="bi bi-bar-chart-fill"></i></div>
            <div>
                <h5 class="fw-bold text-main m-0">Test Results & Analytics</h5>
                <small class="text-muted-custom">Detailed analysis of your examination performance</small>
            </div>
        </div>
        <button class="btn btn-primary"><i class="bi bi-download me-2"></i> Export</button>
    </div>

    <!-- 2. Filters -->
    <div class="mb-4">
        <h6 class="fw-bold text-main mb-3"><i class="bi bi-funnel me-2 text-primary"></i>Filters & Sorting</h6>
        <div class="row g-3">
            <div class="col-md-3">
                <select class="form-select bg-white border-0 shadow-sm"><option>All Subjects</option><option>Math</option></select>
            </div>
            <div class="col-md-3">
                <select class="form-select bg-white border-0 shadow-sm"><option>All Time</option><option>Last Month</option></select>
            </div>
            <div class="col-md-3">
                <select class="form-select bg-white border-0 shadow-sm"><option>All Types</option><option>Quiz</option></select>
            </div>
            <div class="col-md-3">
                <select class="form-select bg-white border-0 shadow-sm"><option>Recent</option><option>Oldest</option></select>
            </div>
        </div>
    </div>

    <!-- 3. Performance Analytics (Grid) -->
    <div class="row g-4 mb-5">
        <!-- Overall Performance -->
        <div class="col-md-4">
            <div class="card-custom h-100 mb-0">
                <h6 class="fw-bold text-main mb-4"><i class="bi bi-graph-up me-2 text-success"></i>Overall Performance</h6>

                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted-custom">Average Score</span>
                    <span class="fw-bold text-main">75.5%</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted-custom">Highest Score</span>
                    <span class="fw-bold text-main">98.0%</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted-custom">Pass Rate</span>
                    <span class="fw-bold text-main">85.0%</span>
                </div>
            </div>
        </div>

        <!-- Subject Analysis -->
        <div class="col-md-4">
            <div class="card-custom h-100 mb-0">
                <h6 class="fw-bold text-main mb-4"><i class="bi bi-book me-2 text-primary"></i>Subject-wise Analysis</h6>

                <div class="p-3 rounded mb-2 d-flex justify-content-between align-items-center border" style="border-color: var(--border-color);">
                    <div>
                        <div class="fw-bold text-main">Mathematics</div>
                        <small class="" style="color: var(--text-muted)">Avg: 82.5%</small>
                    </div>
                    <span class="text-success small fw-bold"><i class="bi bi-arrow-up"></i> +8.2%</span>
                </div>

                <div class="p-3 rounded d-flex justify-content-between align-items-center border" style="border-color: var(--border-color);">
                    <div>
                        <div class="fw-bold text-main">Physics</div>
                        <small class="" style="color: var(--text-muted)">Avg: 68.3%</small>
                    </div>
                    <span class="text-danger small fw-bold"><i class="bi bi-arrow-down"></i> -2.1%</span>
                </div>
            </div>
        </div>

        <!-- Recommendations -->
        <div class="col-md-4">
            <div class="card-custom h-100 mb-0">
                <h6 class="fw-bold text-main mb-4"><i class="bi bi-lightbulb me-2 text-warning"></i>Recommendations</h6>
                <ul class="custom-list">
                    <li>Focus on Physics problem-solving techniques</li>
                    <li>Practice more Chemistry numerical problems</li>
                    <li>Maintain consistent performance in Mathematics</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- 4. Recent Results List -->
    <h6 class="fw-bold text-main mb-3">Recent Test Results</h6>

    <!-- Result Item 1 (Clickable for Modal) -->
    <div class="card-custom p-3 d-flex align-items-center justify-content-between flex-wrap gap-3 cursor-pointer"
         data-bs-toggle="modal" data-bs-target="#resultModal">
        <div class="d-flex align-items-center gap-3">
            <div class="result-icon bg-soft-red text-danger"><i class="bi bi-hash"></i></div>
            <div>
                <h6 class="fw-bold text-main m-0">Assignment: Calculus Intro</h6>
                <div class="d-flex gap-2 mt-1">
                    <span class="badge bg-primary bg-opacity-10 text-primary">Mathematics</span>
                    <span class="badge bg-secondary bg-opacity-10 text-secondary">Assignment</span>
                </div>
            </div>
        </div>

        <div class="text-center d-none d-md-block">
            <small class=" d-block"  style="color: var(--text-muted)">Score</small>
            <span class="fw-bold text-main">38/50</span>
        </div>

        <div class="text-center d-none d-md-block">
            <small class="d-block"  style="color: var(--text-muted)">Rank</small>
            <span class="fw-bold text-main">22/94</span>
        </div>

        <div class="text-center d-none d-md-block">
            <small class="d-block"  style="color: var(--text-muted)">Time</small>
            <span class="fw-bold text-main">38/65 min</span>
        </div>

        <div class="text-center">
            <div class="grade-circle-sm bg-soft-blue text-primary mb-1">B+</div>
            <small class="text-primary fw-bold">76.0%</small>
        </div>
    </div>

</div>

<!-- ================= MODAL START ================= -->
<div class="modal fade" id="resultModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Assignment: Calculus Intro</h5>
                <button type="button" class="btn-close border border-primary" style="color: var(--text-muted)"  data-bs-dismiss="modal" aria-label=" Close"></button>
            </div>
            <div class="modal-body">

                <!-- Performance Overview -->
                <h6 class="text-primary fw-bold mb-3">Performance Overview</h6>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="stat-row"><span>Score</span> <span class="fw-bold">38/50 (76.0%)</span></div>
                        <div class="stat-row"><span>Grade</span> <span class="fw-bold text-primary">B+</span></div>
                        <div class="stat-row"><span>Rank</span> <span class="fw-bold">22 out of 94</span></div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-row"><span>Time Taken</span> <span class="fw-bold">38/65 minutes</span></div>
                        <div class="stat-row"><span>Difficulty</span> <span class="fw-bold text-danger">Hard</span></div>
                    </div>
                </div>

                <!-- Answer Breakdown -->
                <h6 class="text-primary fw-bold mb-3">Answer Breakdown</h6>
                <div class="d-flex gap-4 mb-4">
                    <div class="text-success"><i class="bi bi-check-circle-fill me-1"></i> Correct: 30</div>
                    <div class="text-danger"><i class="bi bi-x-circle-fill me-1"></i> Wrong: 6</div>
                    <div class="text-secondary"><i class="bi bi-dash-circle-fill me-1"></i> Skipped: 2</div>
                </div>

                <!-- Analysis -->
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-primary fw-bold mb-2">Strengths</h6>
                        <ul class="custom-list">
                            <li>Strong conceptual understanding</li>
                            <li>Good problem-solving approach</li>
                            <li>Consistent accuracy in basics</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-primary fw-bold mb-2">Areas for Improvement</h6>
                        <ul class="custom-list">
                            <li>Practice more numerical problems</li>
                            <li>Focus on time management</li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light text-muted" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- ================= MODAL END ================= -->

@endsection
