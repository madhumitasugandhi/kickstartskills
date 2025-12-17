@extends('frontend.hrPortal.dashboard.layouts.app')

@section('title', 'Performance Reviews')

@section('icon', 'bi bi-star-fill fs-4 p-2 bg-soft-purple-custom rounded-3 text-purple-custom')

@section('content')
<style>
    /* --- Page Specific Styles --- */

    /* Stats Cards */
    .stat-card-perf {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        display: flex; align-items: center; gap: 16px;
        transition: transform 0.2s;
        height: 100%;
    }
    .stat-card-perf:hover { transform: translateY(-3px); }

    .stat-icon-box {
        width: 48px; height: 48px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    /* Color Variants */
    .accent-purple { color: #8b5cf6; background-color: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.2); }
    .accent-green { color: #10b981; background-color: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); }
    .accent-blue { color: #3b82f6; background-color: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.2); }
    .accent-red { color: #ef4444; background-color: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); }

    /* Filter Bar */
    .filter-container {
        display: flex; gap: 16px; flex-wrap: wrap; margin-bottom: 24px;
    }
    .search-box {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 10px 16px;
        flex-grow: 1;
        display: flex; align-items: center; gap: 10px;
    }
    .search-input {
        background: transparent; border: none; color: var(--text-main); width: 100%; outline: none;
    }
    .filter-select {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        padding: 10px 16px;
        border-radius: 8px;
        min-width: 150px;
        outline: none;
    }

    /* Review Card */
    .review-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 16px;
        transition: border-color 0.2s, transform 0.2s;
        cursor: pointer;
    }
    .review-card:hover {
        border-color: var(--accent-color);
        transform: scale(1.005);
    }

    .avatar-md {
        width: 48px; height: 48px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-weight: bold; font-size: 1rem;
        background-color: var(--bg-body);
        border: 2px solid var(--border-color);
    }

    /* Progress Bar */
    .progress-track {
        height: 6px;
        background-color: var(--bg-body);
        border-radius: 3px;
        overflow: hidden;
        margin-top: 8px;
        margin-bottom: 12px;
    }
    .progress-fill {
        height: 100%;
        background-color: #f59e0b;
        border-radius: 3px;
    }

    /* Tags */
    .goal-tag {
        font-size: 0.7rem;
        padding: 4px 10px;
        border-radius: 4px;
        background-color: rgba(16, 185, 129, 0.1);
        color: #10b981;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    /* Status Badge */
    .status-badge {
        font-size: 0.75rem; padding: 4px 12px; border-radius: 12px; font-weight: 600;
    }
    .status-progress { background-color: rgba(59, 130, 246, 0.15); color: #3b82f6; }
    .status-pending { background-color: rgba(245, 158, 11, 0.15); color: #f59e0b; }

    /* Action Icons */
    .action-btn {
        background: none; border: none; color: #10b981; font-size: 1.1rem; padding: 4px; transition: 0.2s;
    }
    .action-btn:hover { color: white; }

    /* Utilities */
    .text-purple-custom { color: #8b5cf6; }
    .bg-soft-purple-custom { background-color: rgba(139, 92, 246, 0.1); }

    /* --- MODAL STYLES (Added) --- */
    .modal-content-custom {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.5);
    }
    .modal-header-custom {
        border-bottom: 1px solid var(--border-color);
        padding: 20px 24px;
    }
    .modal-body-custom {
        padding: 24px;
        color: var(--text-main);
    }

    .section-title {
        color: var(--accent-color);
        font-weight: 700;
        font-size: 0.85rem;
        margin-bottom: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-row {
        display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 0.9rem;
    }
    .info-label { color: var(--text-muted); }
    .info-value { color: var(--text-main); font-weight: 500; }

    /* Modal Goal Item */
    .goal-item {
        background-color: var(--bg-body);
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 12px;
        border: 1px solid var(--border-color);
    }
    .badge-track {
        background-color: rgba(16, 185, 129, 0.1); color: #10b981; font-size: 0.7rem; padding: 2px 8px; border-radius: 4px;
    }

    /* Modal Pills */
    .pill-strength {
        background-color: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.2);
        padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; display: inline-block; margin-right: 6px; margin-bottom: 6px;
    }
    .pill-improvement {
        background-color: rgba(245, 158, 11, 0.1); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.2);
        padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; display: inline-block; margin-right: 6px; margin-bottom: 6px;
    }
</style>

<div class="review-card mb-4" style="cursor: default;">
    <div class="d-flex justify-content-between align-items-center mb-4 filter-container m-0">
        <h5 class="fw-bold m-0 text-main">Performance Overview</h5>
        <div class="d-flex align-items-center gap-3">
            <span class="badge bg-soft-purple-custom text-accent px-3 py-2 rounded-pill border border-light border-opacity-10">Q4 2024</span>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="stat-card-perf accent-purple">
                <div class="stat-icon-box accent-purple">
                    <i class="bi bi-people"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0 text-main">5</h3>
                    <span class="--text-muted small">Total Reviews</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="stat-card-perf accent-green">
                <div class="stat-icon-box accent-green">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0 text-main">1</h3>
                    <span class="--text-muted small">Completed</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="stat-card-perf accent-blue">
                <div class="stat-icon-box accent-blue">
                    <i class="bi bi-clock"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0 text-main">1</h3>
                    <span class="--text-muted small">In Progress</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="stat-card-perf accent-red">
                <div class="stat-icon-box accent-red">
                    <i class="bi bi-exclamation-circle"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0 text-main">1</h3>
                    <span class="--text-muted small">Overdue</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="filter-container">
    <div class="search-box">
        <i class="bi bi-search --text-muted"></i>
        <input type="text" class="search-input" placeholder="Search employees...">
    </div>
    <select class="filter-select">
        <option>All Departments</option>
        <option>Engineering</option>
        <option>Marketing</option>
    </select>
    <select class="filter-select">
        <option>All Status</option>
        <option>In Progress</option>
        <option>Pending</option>
        <option>Completed</option>
    </select>
</div>

<div class="d-flex flex-column">

    <div class="review-card" data-bs-toggle="modal" data-bs-target="#reviewModal">
        <div class="row g-3">
            <div class="col-12 col-lg-4 d-flex align-items-center gap-3">
                <div class="avatar-md text-purple-custom bg-soft-purple-custom" style="border-color: #8b5cf6;">SJ</div>
                <div>
                    <h6 class="fw-bold text-main mb-1">Sarah Johnson</h6>
                    <div class="--text-muted small">Senior Software Engineer • Engineering</div>
                    <small class="--text-muted d-block mt-1">Quarterly • Q4 2024</small>
                </div>
            </div>

            <div class="col-12 col-lg-5">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="--text-muted small fw-bold">Goals Progress</span>
                    <span class="text-success small fw-bold">77% average</span>
                </div>
                <div class="progress-track">
                    <div class="progress-fill" style="width: 77%;"></div>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <span class="goal-tag">Complete mobile... (85%)</span>
                    <span class="goal-tag">Mentor junior d... (70%)</span>
                </div>
            </div>

            <div class="col-12 col-lg-3 text-lg-end">
                <div class="d-flex justify-content-between flex-lg-column align-items-center align-items-lg-end h-100">
                    <div class="d-flex flex-column align-items-lg-end">
                        <span class="status-badge status-progress mb-1">In Progress</span>
                        <small class="text-warning"><i class="bi bi-star-fill small me-1"></i> 4.1</small>
                    </div>
                    <div class="d-flex align-items-end justify-content-between w-100 mt-3 mt-lg-0">
                        <small class="text-danger"><i class="bi bi-calendar-event me-1"></i> Due 367 days ago</small>
                        <div class="d-flex gap-2">
                            <button class="action-btn"><i class="bi bi-play-circle"></i></button>
                            <button class="action-btn" style="color: #3b82f6;"><i class="bi bi-calendar-check"></i></button>
                            <button class="action-btn" style="color: var(--text-muted);"><i class="bi bi-three-dots-vertical"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="review-card">
        <div class="row g-3">
            <div class="col-12 col-lg-4 d-flex align-items-center gap-3">
                <div class="avatar-md text-purple-custom bg-soft-purple-custom" style="border-color: #8b5cf6;">MC</div>
                <div>
                    <h6 class="fw-bold text-main mb-1">Michael Chen</h6>
                    <div class="--text-muted small">Marketing Manager • Marketing</div>
                    <small class="--text-muted d-block mt-1">Quarterly • Q4 2024</small>
                </div>
            </div>

            <div class="col-12 col-lg-5">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="--text-muted small fw-bold">Goals Progress</span>
                    <span class="text-success small fw-bold">77% average</span>
                </div>
                <div class="progress-track">
                    <div class="progress-fill" style="width: 77%;"></div>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <span class="goal-tag">Launch product ... (95%)</span>
                    <span class="goal-tag">Increase brand ... (60%)</span>
                </div>
            </div>

            <div class="col-12 col-lg-3 text-lg-end">
                <div class="d-flex justify-content-between flex-lg-column align-items-center align-items-lg-end h-100">
                    <div class="d-flex flex-column align-items-lg-end">
                        <span class="status-badge status-pending mb-1">Pending Review</span>
                    </div>
                    <div class="d-flex align-items-end justify-content-between w-100 mt-3 mt-lg-0">
                        <small class="text-danger"><i class="bi bi-calendar-event me-1"></i> Due 370 days ago</small>
                        <div class="d-flex gap-2">
                            <button class="action-btn"><i class="bi bi-play-circle"></i></button>
                            <button class="action-btn" style="color: #3b82f6;"><i class="bi bi-calendar-check"></i></button>
                            <button class="action-btn" style="color: var(--text-muted);"><i class="bi bi-three-dots-vertical"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="reviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content-custom">

            <div class="modal-header-custom d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-md text-purple-custom bg-soft-purple-custom" style="border-color: #8b5cf6;">SJ</div>
                    <div>
                        <h5 class="fw-bold text-main mb-0">Sarah Johnson</h5>
                        <div class="--text-muted small">Senior Software Engineer • Engineering</div>
                        <span class="status-badge status-progress mt-1 d-inline-block">In Progress</span>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body-custom">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="mb-4">
                            <h6 class="section-title">Review Information</h6>
                            <div class="info-row"><span class="info-label"><i class="bi bi-calendar3 me-2"></i>Review Period:</span> <span class="info-value">Q4 2024</span></div>
                            <div class="info-row"><span class="info-label"><i class="bi bi-tag me-2"></i>Review Type:</span> <span class="info-value">Quarterly</span></div>
                            <div class="info-row"><span class="info-label"><i class="bi bi-clock me-2"></i>Due Date:</span> <span class="info-value">15/12/2024</span></div>
                            <div class="info-row"><span class="info-label"><i class="bi bi-star me-2"></i>Final Score:</span> <span class="info-value">4.1/5.0</span></div>
                        </div>

                        <div>
                            <h6 class="section-title">Strengths</h6>
                            <div class="mb-3">
                                <span class="pill-strength">Technical expertise</span>
                                <span class="pill-strength">Leadership</span>
                                <span class="pill-strength">Problem-solving</span>
                            </div>

                            <h6 class="section-title">Areas for Improvement</h6>
                            <div>
                                <span class="pill-improvement">Time management</span>
                                <span class="pill-improvement">Documentation</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h6 class="section-title mb-3">Goals & Objectives</h6>

                        <div class="goal-item">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-main small">Complete mobile app redesign</span>
                                <span class="badge-track">On Track</span>
                            </div>
                            <p class="--text-muted small mb-2" style="font-size: 0.75rem;">Lead the redesign of the mobile application UI/UX</p>
                            <div class="progress-track mb-1" style="height: 4px;">
                                <div class="progress-fill" style="width: 85%; background-color: #10b981;"></div>
                            </div>
                            <div class="text-end small fw-bold text-success">85%</div>
                        </div>

                        <div class="goal-item">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-main small">Mentor junior developers</span>
                                <span class="badge-track">On Track</span>
                            </div>
                            <p class="--text-muted small mb-2" style="font-size: 0.75rem;">Provide guidance and support to 2 junior developers</p>
                            <div class="progress-track mb-1" style="height: 4px;">
                                <div class="progress-fill" style="width: 70%; background-color: #10b981;"></div>
                            </div>
                            <div class="text-end small fw-bold text-success">70%</div>
                        </div>

                        <div class="mt-4">
                            <h6 class="section-title">Manager Notes</h6>
                            <p class="--text-muted small fst-italic border-start border-3 border-primary ps-3">
                                "Excellent technical contributions and team collaboration. Sarah has stepped up significantly this quarter."
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
