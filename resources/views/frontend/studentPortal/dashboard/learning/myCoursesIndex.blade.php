@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'My Courses')

@section('content')
<style>
    /* Theme Variables */
    :root {
        --bg-card: #ffffff;
        --text-main: #343a40;
        --text-muted: #6c757d;
        --border-color: #e9ecef;
        --soft-blue: #e7f1ff; --text-blue: #0d6efd;
        --soft-green: #d1e7dd; --text-green: #0f5132;
        --soft-cyan: #cff4fc; --text-cyan: #055160;
    }

    [data-theme="dark"] {
        --bg-card: #252525;
        --text-main: #e9ecef;
        --text-muted: #adb5bd;
        --border-color: #2c2c2c;
        --soft-blue: rgba(13, 110, 253, 0.15); --text-blue: #6ea8fe;
        --soft-green: rgba(25, 135, 84, 0.15); --text-green: #75b798;
        --soft-cyan: rgba(13, 202, 240, 0.15); --text-cyan: #3dd5f3;
    }

    /* Learning Progress Dashboard */
    .progress-dashboard {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 32px;
    }

    .stat-item {
        border-right: 1px solid var(--border-color);
        padding-right: 24px;
    }
    .stat-item:last-child { border-right: none; }

    .stat-value { font-size: 1.25rem; font-weight: 700; color: var(--text-green); margin-bottom: 4px; }
    .stat-value.blue { color: var(--text-blue); }
    .stat-value.orange { color: #fd7e14; }

    .stat-label { font-size: 0.85rem; color: var(--text-muted); }

    /* Course Card */
    .course-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.2s;
    }
    .course-card:hover { transform: translateY(-4px); box-shadow: 0 4px 12px rgba(0,0,0,0.05); }

    .course-thumbnail {
        height: 160px;
        background-color: #e0f2fe; /* Light Blue bg for placeholder */
        position: relative;
        display: flex; align-items: center; justify-content: center;
    }

    .play-btn {
        width: 48px; height: 48px;
        background-color: rgba(255,255,255,0.9);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: var(--text-blue);
        font-size: 1.5rem;
        cursor: pointer;
        transition: 0.2s;
    }
    .play-btn:hover { transform: scale(1.1); }

    .status-badge {
        position: absolute;
        top: 16px; right: 16px;
        background-color: #0ea5e9;
        color: white;
        font-size: 0.75rem;
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 600;
    }

    .course-body { padding: 20px; }

    .instructor-link { font-size: 0.8rem; color: var(--text-blue); text-decoration: none; font-weight: 500; }

    .tag-pill {
        background-color: var(--soft-green);
        color: var(--text-green);
        font-size: 0.7rem;
        padding: 4px 10px;
        border-radius: 6px;
        margin-right: 6px;
        display: inline-block;
    }

    /* Continue Button Area */
    .continue-area {
        background-color: #f1f5f9; /* Light grey footer */
        padding: 12px 20px;
        color: var(--text-main);
        font-weight: 600;
        font-size: 0.9rem;
        border-top: 1px solid var(--border-color);
        cursor: pointer;
        transition: 0.2s;
    }
    .continue-area:hover { background-color: #e2e8f0; }
    [data-theme="dark"] .continue-area { background-color: #333; }
    [data-theme="dark"] .continue-area:hover { background-color: #444; }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .stat-item { border-right: none; margin-bottom: 16px; border-bottom: 1px solid var(--border-color); padding-bottom: 16px; }
        .stat-item:last-child { border-bottom: none; margin-bottom: 0; }
    }
</style>

<div class="content-body">

    <!-- 1. Learning Progress Dashboard -->
    <div class="progress-dashboard">
        <div class="d-flex align-items-center gap-2 mb-4">
            <i class="bi bi-graph-up-arrow text-success fs-5"></i>
            <h6 class="fw-bold text-main m-0">Learning Progress</h6>
        </div>

        <div class="row mb-4">
            <div class="col-md-3 stat-item">
                <div class="stat-label">Courses Completed</div>
                <div class="stat-value text-success">1/4</div>
            </div>
            <div class="col-md-3 stat-item">
                <div class="stat-label">Total Learning Time</div>
                <div class="stat-value blue">127 hours</div>
            </div>
            <div class="col-md-3 stat-item">
                <div class="stat-label">Skills Acquired</div>
                <div class="stat-value text-success">15</div>
            </div>
            <div class="col-md-3 stat-item">
                <div class="stat-label">Current Streak</div>
                <div class="stat-value orange">12 days</div>
            </div>
        </div>

        <!-- Weekly Goal Bar -->
        <div class="d-flex justify-content-between small mb-2" style="color: var(--text-muted)">
            <span>Weekly Learning Goal</span>
            <span class="text-primary fw-bold">7.5h / 10h</span>
        </div>
        <div class="progress" style="height: 8px;">
            <div class="progress-bar bg-primary" style="width: 75%"></div>
        </div>
    </div>

    <!-- 2. Filters Row -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex gap-3">
            <select class="form-select bg-white border-0 shadow-sm w-auto">
                <option>All</option>
                <option>In Progress</option>
                <option>Completed</option>
            </select>
            <select class="form-select bg-white border-0 shadow-sm w-auto">
                <option>Recent</option>
                <option>Alphabetical</option>
            </select>
        </div>
        <div class="text-muted fs-5 cursor-pointer">
            <i class="bi bi-grid-fill me-2 text-main"></i>
            <i class="bi bi-list text-main"></i>
        </div>
    </div>

    <!-- 3. Course Cards Grid -->
    <div class="row g-4">

        <!-- Course 1 -->
        <div class="col-lg-6">
            <div class="course-card">
                <!-- Thumbnail -->
                <div class="course-thumbnail bg-soft-blue">
                    <span class="status-badge">In Progress</span>
                    <div class="play-btn"><i class="bi bi-play-fill"></i></div>
                </div>

                <!-- Body -->
                <div class="course-body">
                    <h6 class="fw-bold text-main mb-1">Flutter Mobile Development Mastery</h6>
                    <a href="#" class="instructor-link">by Dr. Sarah Kumar</a>

                    <div class="d-flex justify-content-between small mt-3 mb-1" style="color: var(--text-muted)">
                        <span>Progress</span>
                        <span class="text-primary fw-bold">75%</span>
                    </div>
                    <div class="progress mb-3" style="height: 6px;">
                        <div class="progress-bar bg-primary" style="width: 75%"></div>
                    </div>

                    <div class="d-flex gap-3 small mb-3" style="color: var(--text-muted)">
                        <span><i class="bi bi-clock me-1"></i> 12 weeks</span>
                        <span><i class="bi bi-people me-1"></i> 1250</span>
                    </div>

                    <div>
                        <span class="tag-pill">Flutter</span>
                        <span class="tag-pill">Dart</span>
                        <span class="tag-pill">Mobile UI</span>
                    </div>
                </div>

                <!-- Footer Action -->
                <div class="continue-area">
                    Continue Learning <i class="bi bi-arrow-right float-end"></i>
                </div>
            </div>
        </div>

        <!-- Course 2 -->
        <div class="col-lg-6">
            <div class="course-card">
                <!-- Thumbnail -->
                <div class="course-thumbnail bg-soft-cyan">
                    <span class="status-badge">In Progress</span>
                    <div class="play-btn"><i class="bi bi-play-fill"></i></div>
                </div>

                <!-- Body -->
                <div class="course-body">
                    <h6 class="fw-bold text-main mb-1">Full-Stack Web Development with React & Node.js</h6>
                    <a href="#" class="instructor-link">by Prof. Michael Chen</a>

                    <div class="d-flex justify-content-between small mt-3 mb-1" style="color: var(--text-muted)">
                        <span>Progress</span>
                        <span class="text-primary fw-bold">45%</span>
                    </div>
                    <div class="progress mb-3" style="height: 6px;">
                        <div class="progress-bar bg-primary" style="width: 45%"></div>
                    </div>

                    <div class="d-flex gap-3 small mb-3" style="color: var(--text-muted)">
                        <span><i class="bi bi-clock me-1"></i> 16 weeks</span>
                        <span><i class="bi bi-people me-1"></i> 892</span>
                    </div>

                    <div>
                        <span class="tag-pill bg-soft-blue text-primary">React</span>
                        <span class="tag-pill bg-soft-green text-success">Node.js</span>
                        <span class="tag-pill bg-soft-orange text-warning">JavaScript</span>
                    </div>
                </div>

                <!-- Footer Action -->
                <div class="continue-area">
                    Continue Learning <i class="bi bi-arrow-right float-end"></i>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
