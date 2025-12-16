@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Overview')
@section('icon', 'bi bi-info-circle fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')

    <div class="card-custom mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="fs-4 p-2 bg-soft-orange rounded-3 text-accent">
                <i class="bi bi-info-circle fs-3"></i>
            </div>
            <div>
                <h4 class="fw-bold text-main mb-1">Internship Overview</h4>
                <p class="text-muted-custom mb-0 small">Monitor intern progress across all cohorts and phases</p>
            </div>
        </div>
    </div>

    <div class="card-custom mb-4 p-3">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label small text-muted-custom fw-bold mb-1">Select Cohort</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0" style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-muted);">
                        <i class="bi bi-people"></i>
                    </span>
                    <select class="form-select border-start-0 ps-0" style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                        <option selected>All Cohorts</option>
                        <option>Batch 2024A</option>
                        <option>Batch 2024B</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label small text-muted-custom fw-bold mb-1">Select Phase</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0" style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-muted);">
                        <i class="bi bi-layers"></i>
                    </span>
                    <select class="form-select border-start-0 ps-0" style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                        <option selected>All Phases</option>
                        <option>Foundation</option>
                        <option>Project</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <button class="btn btn-primary w-100 fw-bold" style="background-color: var(--text-blue); border: none;">
                    <i class="bi bi-download me-2"></i> Export Report
                </button>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-2 col-6" style="width: 20%;">
            <div class="card-custom text-center py-4 mb-0 h-100">
                <div class="mb-2">
                    <i class="bi bi-people fs-3 text-primary"></i>
                </div>
                <h3 class="fw-bold text-main mb-1">4</h3>
                <span class="text-muted-custom small fw-bold">Total Interns</span>
            </div>
        </div>
        <div class="col-md-2 col-6" style="width: 20%;">
            <div class="card-custom text-center py-4 mb-0 h-100">
                <div class="mb-2">
                    <i class="bi bi-activity fs-3 text-success"></i>
                </div>
                <h3 class="fw-bold text-main mb-1">2</h3>
                <span class="text-muted-custom small fw-bold">Active Interns</span>
            </div>
        </div>
        <div class="col-md-2 col-6" style="width: 20%;">
            <div class="card-custom text-center py-4 mb-0 h-100">
                <div class="mb-2">
                    <i class="bi bi-exclamation-triangle fs-3 text-accent"></i>
                </div>
                <h3 class="fw-bold text-main mb-1">1</h3>
                <span class="text-muted-custom small fw-bold">At Risk</span>
            </div>
        </div>
        <div class="col-md-2 col-6" style="width: 20%;">
            <div class="card-custom text-center py-4 mb-0 h-100">
                <div class="mb-2">
                    <i class="bi bi-star fs-3 text-info"></i>
                </div>
                <h3 class="fw-bold text-main mb-1">1</h3>
                <span class="text-muted-custom small fw-bold">Excellent</span>
            </div>
        </div>
        <div class="col-md-2 col-6" style="width: 20%;">
            <div class="card-custom text-center py-4 mb-0 h-100">
                <div class="mb-2">
                    <i class="bi bi-graph-up-arrow fs-3 text-primary"></i>
                </div>
                <h3 class="fw-bold text-main mb-1">73%</h3>
                <span class="text-muted-custom small fw-bold">Avg Progress</span>
            </div>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-xl-4">
            <div class="card-custom h-100 mb-0">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-bold text-main m-0">Active Cohorts</h6>
                    <i class="bi bi-box-arrow-up-right text-muted-custom cursor-pointer"></i>
                </div>

                <div class="d-flex flex-column gap-3">
                    <div class="p-3 rounded-3 border border-dark-subtle" style="background-color: var(--bg-hover); border-color: var(--border-color) !important;">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="fw-bold text-main mb-0 small">Frontend Development - Batch 2024A</h6>
                            <span class="badge bg-soft-orange text-accent" style="font-size: 0.65rem;">Phase 2</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <small class="text-muted-custom d-flex align-items-center gap-1" style="font-size: 0.75rem;">
                                <i class="bi bi-people"></i> 12/15 Active
                            </small>
                            <small class="text-muted-custom d-flex align-items-center gap-1" style="font-size: 0.75rem;">
                                <i class="bi bi-calendar"></i> 15 Jan - 15 Jun
                            </small>
                        </div>

                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-muted-custom" style="font-size: 0.7rem;">Progress</span>
                            <span class="fw-bold text-primary" style="font-size: 0.7rem;">65%</span>
                        </div>
                        <div class="progress" style="height: 4px; background-color: rgba(255,255,255,0.1);">
                            <div class="progress-bar bg-primary" style="width: 65%"></div>
                        </div>
                    </div>

                    <div class="p-3 rounded-3 border border-dark-subtle" style="background-color: var(--bg-hover); border-color: var(--border-color) !important;">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="fw-bold text-main mb-0 small">Full Stack Development - Batch 2024B</h6>
                            <span class="badge bg-soft-blue text-blue" style="font-size: 0.65rem;">Phase 1</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <small class="text-muted-custom d-flex align-items-center gap-1" style="font-size: 0.75rem;">
                                <i class="bi bi-people"></i> 18/20 Active
                            </small>
                            <small class="text-muted-custom d-flex align-items-center gap-1" style="font-size: 0.75rem;">
                                <i class="bi bi-calendar"></i> 1 Mar - 1 Aug
                            </small>
                        </div>

                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-muted-custom" style="font-size: 0.7rem;">Progress</span>
                            <span class="fw-bold text-primary" style="font-size: 0.7rem;">35%</span>
                        </div>
                        <div class="progress" style="height: 4px; background-color: rgba(255,255,255,0.1);">
                            <div class="progress-bar bg-primary" style="width: 35%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="card-custom h-100 mb-0">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-bold text-main m-0">Interns (4)</h6>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-icon text-muted-custom"><i class="bi bi-arrow-clockwise"></i></button>
                        <button class="btn btn-sm btn-icon text-muted-custom"><i class="bi bi-filter"></i></button>
                    </div>
                </div>

                <div class="d-flex flex-column gap-3">

                    <div class="p-3 rounded-3 border border-dark-subtle" style="background-color: var(--bg-hover); border-color: var(--border-color) !important;">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-flex gap-3">
                                <div class="rounded-circle bg-soft-blue text-blue d-flex align-items-center justify-content-center fw-bold"
                                     style="width: 45px; height: 45px;">JD</div>
                                <div>
                                    <h6 class="fw-bold text-main mb-0">John Doe</h6>
                                    <small class="text-muted-custom" style="font-size: 0.75rem;">Frontend Development - Batch 2024A</small>
                                </div>
                            </div>
                            <span class="badge bg-soft-green text-green rounded-pill">Active</span>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-3">
                                <small class="text-muted-custom d-block" style="font-size: 0.7rem;">Progress</small>
                                <span class="fw-bold text-main h6"><i class="bi bi-graph-up me-1 text-primary"></i> 72%</span>
                            </div>
                            <div class="col-3">
                                <small class="text-muted-custom d-block" style="font-size: 0.7rem;">Tasks</small>
                                <span class="fw-bold text-main h6"><i class="bi bi-check2-square me-1 text-info"></i> 18/25</span>
                            </div>
                            <div class="col-3">
                                <small class="text-muted-custom d-block" style="font-size: 0.7rem;">Rating</small>
                                <span class="fw-bold text-main h6"><i class="bi bi-star me-1 text-accent"></i> 4.2/5.0</span>
                            </div>
                            <div class="col-3">
                                <small class="text-muted-custom d-block" style="font-size: 0.7rem;">Attendance</small>
                                <span class="fw-bold text-main h6"><i class="bi bi-calendar-check me-1 text-success"></i> 95%</span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="progress" style="height: 6px; background-color: rgba(255,255,255,0.1);">
                                <div class="progress-bar bg-success" style="width: 72%"></div>
                            </div>
                            <div class="d-flex justify-content-end mt-1">
                                <small class="text-accent fw-bold" style="font-size: 0.7rem;">Phase 2</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted-custom fw-bold mb-2 d-block">Current Projects:</small>
                            <div class="d-flex gap-2">
                                <span class="badge bg-soft-blue text-blue border border-primary-subtle fw-normal">E-commerce Dashboard</span>
                                <span class="badge bg-soft-blue text-blue border border-primary-subtle fw-normal">React Components Library</span>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-primary flex-grow-1" style="border-color: var(--text-blue); color: var(--text-blue);">
                                <i class="bi bi-eye me-1"></i> View Details
                            </button>
                            <button class="btn btn-sm btn-primary flex-grow-1" style="background-color: var(--text-blue); border: none;">
                                <i class="bi bi-plus me-1"></i> Assign Task
                            </button>
                        </div>
                    </div>

                    <div class="p-3 rounded-3 border border-dark-subtle" style="background-color: var(--bg-hover); border-color: var(--border-color) !important;">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-flex gap-3">
                                <div class="rounded-circle bg-soft-teal text-teal d-flex align-items-center justify-content-center fw-bold"
                                     style="width: 45px; height: 45px;">JS</div>
                                <div>
                                    <h6 class="fw-bold text-main mb-0">Jane Smith</h6>
                                    <small class="text-muted-custom" style="font-size: 0.75rem;">Frontend Development - Batch 2024A</small>
                                </div>
                            </div>
                            <span class="badge bg-soft-green text-green rounded-pill">Active</span>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-3">
                                <small class="text-muted-custom d-block" style="font-size: 0.7rem;">Progress</small>
                                <span class="fw-bold text-main h6"><i class="bi bi-graph-up me-1 text-success"></i> 85%</span>
                            </div>
                            <div class="col-3">
                                <small class="text-muted-custom d-block" style="font-size: 0.7rem;">Tasks</small>
                                <span class="fw-bold text-main h6"><i class="bi bi-check2-square me-1 text-info"></i> 21/25</span>
                            </div>
                            <div class="col-3">
                                <small class="text-muted-custom d-block" style="font-size: 0.7rem;">Rating</small>
                                <span class="fw-bold text-main h6"><i class="bi bi-star me-1 text-accent"></i> 4.7/5.0</span>
                            </div>
                            <div class="col-3">
                                <small class="text-muted-custom d-block" style="font-size: 0.7rem;">Attendance</small>
                                <span class="fw-bold text-main h6"><i class="bi bi-calendar-check me-1 text-success"></i> 98%</span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="progress" style="height: 6px; background-color: rgba(255,255,255,0.1);">
                                <div class="progress-bar bg-success" style="width: 85%"></div>
                            </div>
                            <div class="d-flex justify-content-end mt-1">
                                <small class="text-accent fw-bold" style="font-size: 0.7rem;">Phase 2</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted-custom fw-bold mb-2 d-block">Current Projects:</small>
                            <div class="d-flex gap-2">
                                <span class="badge bg-soft-blue text-blue border border-primary-subtle fw-normal">Portfolio Website</span>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-primary flex-grow-1" style="border-color: var(--text-blue); color: var(--text-blue);">
                                <i class="bi bi-eye me-1"></i> View Details
                            </button>
                            <button class="btn btn-sm btn-primary flex-grow-1" style="background-color: var(--text-blue); border: none;">
                                <i class="bi bi-plus me-1"></i> Assign Task
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection
