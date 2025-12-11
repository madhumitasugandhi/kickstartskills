@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Practice Tests')

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
        --soft-orange: #ffecb5; --text-orange: #664d03;
    }

    [data-theme="dark"] {
        --bg-card: #252525;
        --text-main: #e9ecef;
        --text-muted: #adb5bd;
        --border-color: #2c2c2c;
        --soft-blue: rgba(13, 110, 253, 0.15); --text-blue: #6ea8fe;
        --soft-green: rgba(25, 135, 84, 0.15); --text-green: #75b798;
        --soft-orange: rgba(255, 193, 7, 0.15); --text-orange: #ffda6a;
    }

    /* Header & Search */
    .practice-header {
        background-color: var(--bg-card);
        border-radius: 12px;
        padding: 24px;
        border: 1px solid var(--border-color);
        margin-bottom: 24px;
    }

    .search-input-group {
        position: relative;
    }
    .search-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
    }
    .form-control-search {
        padding-left: 44px;
        padding-top: 12px;
        padding-bottom: 12px;
        border-radius: 8px;
        border: 1px solid var(--border-color);
        background-color: #f8f9fa; /* Slight grey background for input */
    }
    [data-theme="dark"] .form-control-search { background-color: #2c2c2c; }

    /* Cards */
    .test-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        height: 100%;
        transition: transform 0.2s, box-shadow 0.2s;
        position: relative;
    }
    .test-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.05);
    }

    .icon-square {
        width: 48px; height: 48px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.25rem;
        margin-bottom: 16px;
    }

    /* Tags */
    .badge-soft {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-right: 6px;
    }
    .bg-soft-blue { background-color: var(--soft-blue); color: var(--text-blue); }
    .bg-soft-green { background-color: var(--soft-green); color: var(--text-green); }
    .bg-soft-orange { background-color: var(--soft-orange); color: var(--text-orange); }

    /* Meta Info */
    .meta-info {
        display: flex;
        gap: 16px;
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-top: 20px;
        align-items: center;
    }

    /* Start Button Icon */
    .action-icon-btn {
        width: 32px; height: 32px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        background-color: var(--soft-green);
        color: var(--text-green);
        position: absolute;
        bottom: 24px;
        right: 24px;
        transition: 0.2s;
    }
    .action-icon-btn:hover {
        transform: scale(1.1);
    }
</style>

<div class="content-body">

    <!-- 1. Search & Filter Section -->
    <div class="practice-header">
        <h5 class="fw-bold text-main mb-4"><i class="bi bi-search me-2 text-primary"></i>Find Practice Tests</h5>

        <!-- Search Bar -->
        <div class="search-input-group mb-4">
            <i class="bi bi-search search-icon"></i>
            <input type="text" class="form-control form-control-search" placeholder="Search tests by name, subject, or topic...">
        </div>

        <!-- Filters Row -->
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label text-muted small fw-bold">Subject</label>
                <select class="form-select border-light bg-light">
                    <option>All Subjects</option>
                    <option>Computer Science</option>
                    <option>Mathematics</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label text-muted small fw-bold">Difficulty</label>
                <select class="form-select border-light bg-light">
                    <option>All Levels</option>
                    <option>Beginner</option>
                    <option>Advanced</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label text-muted small fw-bold">Type</label>
                <select class="form-select border-light bg-light">
                    <option>All Types</option>
                    <option>Topic Wise</option>
                    <option>Full Mock</option>
                </select>
            </div>
        </div>
    </div>

    <!-- 2. Results Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="fw-bold text-main m-0">Available Tests (25)</h6>
        <a href="#" class="text-primary small fw-bold text-decoration-none"><i class="bi bi-arrow-counterclockwise"></i> Reset Filters</a>
    </div>

    <!-- 3. Test Cards Grid -->
    <div class="row g-4">

        <!-- Card 1 -->
        <div class="col-lg-6">
            <div class="test-card">
                <div class="d-flex gap-3 mb-2">
                    <div class="icon-square bg-soft-blue text-primary">
                        <i class="bi bi-code-slash"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold text-main m-0">Topic Master - Computer Science #1</h6>
                        <small class="text-muted">Targeted practice on specific topics with progressive difficulty.</small>
                    </div>
                </div>

                <div class="mt-3 mb-4">
                    <span class="badge-soft bg-soft-blue">Computer Science</span>
                    <span class="badge-soft bg-soft-green">Beginner</span>
                </div>

                <div class="meta-info">
                    <span><i class="bi bi-file-text me-1"></i> 41 Q</span>
                    <span><i class="bi bi-clock me-1"></i> 160m</span>
                    <span><i class="bi bi-star me-1"></i> 4.2</span>
                </div>

                <!-- Action Button -->
                <a href="#" class="action-icon-btn">
                    <i class="bi bi-check-lg"></i>
                </a>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-lg-6">
            <div class="test-card">
                <div class="d-flex gap-3 mb-2">
                    <div class="icon-square bg-soft-orange text-orange">
                        <i class="bi bi-pencil"></i>
                    </div>
                    <div>
                        <div class="d-flex gap-2 mb-1">
                            <span class="badge border border-warning text-warning rounded-pill" style="font-size: 0.65rem;">Popular</span>
                            <span class="badge border border-success text-success rounded-pill" style="font-size: 0.65rem;">Free</span>
                        </div>
                        <h6 class="fw-bold text-main m-0">Previous Year Paper - English #2</h6>
                    </div>
                </div>

                <p class="text-muted small mt-2 mb-3">Authentic previous year question paper with time-bound practice.</p>

                <div class="mt-3 mb-4">
                    <span class="badge-soft bg-soft-orange">English</span>
                    <span class="badge-soft bg-soft-orange">Advanced</span>
                </div>

                <div class="meta-info">
                    <span><i class="bi bi-file-text me-1"></i> 42 Q</span>
                    <span><i class="bi bi-clock me-1"></i> 86m</span>
                    <span><i class="bi bi-star me-1"></i> 3.9</span>
                </div>

                <!-- Action Button -->
                <a href="#" class="action-icon-btn">
                    <i class="bi bi-check-lg"></i>
                </a>
            </div>
        </div>

        <!-- Card 3 (Duplicate for demo grid) -->
        <div class="col-lg-6">
            <div class="test-card">
                <div class="d-flex gap-3 mb-2">
                    <div class="icon-square bg-soft-blue text-primary">
                        <i class="bi bi-calculator"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold text-main m-0">Calculus Integration Series</h6>
                        <small class="text-muted">Focus on definite and indefinite integrals.</small>
                    </div>
                </div>

                <div class="mt-3 mb-4">
                    <span class="badge-soft bg-soft-blue">Mathematics</span>
                    <span class="badge-soft bg-soft-orange">Medium</span>
                </div>

                <div class="meta-info">
                    <span><i class="bi bi-file-text me-1"></i> 20 Q</span>
                    <span><i class="bi bi-clock me-1"></i> 45m</span>
                    <span><i class="bi bi-star me-1"></i> 4.5</span>
                </div>

                <a href="#" class="action-icon-btn">
                    <i class="bi bi-play-fill"></i> <!-- Play icon for unattempted -->
                </a>
            </div>
        </div>

    </div>
</div>
@endsection

