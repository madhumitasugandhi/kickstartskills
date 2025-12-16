@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Dashboard')

@section('icon', 'bi bi-house-door fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')
    <div class="card-custom border-0"
         style="background: linear-gradient(135deg, rgba(255, 140, 0, 0.15) 0%, rgba(30, 41, 59, 0) 100%);">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-soft-orange p-3 rounded-4 d-flex align-items-center justify-content-center"
                     style="width: 56px; height: 56px;">
                    <i class="bi bi-person-fill fs-3 text-accent"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-1 text-main">Welcome back, Sarah!</h5>
                    <p class="text-muted-custom mb-0 small">You have 5 students to mentor today.</p>
                </div>
            </div>
            <span class="badge bg-soft-green text-green rounded-pill px-3 py-2">
                <i class="bi bi-circle-fill small me-1" style="font-size: 6px;"></i> Active
            </span>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6 col-xl-3">
            <div class="card-custom h-100 d-flex flex-column justify-content-between mb-0">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="bg-soft-blue p-2 rounded-3 text-blue">
                        <i class="bi bi-person-video2 fs-5"></i>
                    </div>
                    <span class="badge bg-soft-blue text-blue rounded-pill">+2</span>
                </div>
                <div>
                    <h4 class="fw-bold text-main mb-1">15</h4>
                    <span class="text-muted-custom small">Assigned Students</span>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card-custom h-100 d-flex flex-column justify-content-between mb-0">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="bg-soft-blue p-2 rounded-3 text-blue" style="background-color: rgba(13, 110, 253, 0.1) !important;">
                        <i class="bi bi-calendar-check fs-5"></i>
                    </div>
                </div>
                <div>
                    <h4 class="fw-bold text-main mb-1">8</h4>
                    <span class="text-muted-custom small">Active Sessions</span>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card-custom h-100 d-flex flex-column justify-content-between mb-0">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="bg-soft-green p-2 rounded-3 text-green">
                        <i class="bi bi-check-circle fs-5"></i>
                    </div>
                    <span class="badge bg-soft-green text-green rounded-pill">+5</span>
                </div>
                <div>
                    <h4 class="fw-bold text-main mb-1">42</h4>
                    <span class="text-muted-custom small">Completed Tasks</span>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card-custom h-100 d-flex flex-column justify-content-between mb-0">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="bg-soft-orange p-2 rounded-3 text-accent">
                        <i class="bi bi-graph-up-arrow fs-5"></i>
                    </div>
                    <span class="badge bg-soft-orange text-accent rounded-pill">+3%</span>
                </div>
                <div>
                    <h4 class="fw-bold text-main mb-1">87%</h4>
                    <span class="text-muted-custom small">Avg. Progress</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-lg-8">
            <div class="card-custom h-100 mb-0">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="fw-bold m-0 text-main">Assigned Students</h6>
                    <a href="#" class="text-accent text-decoration-none small fw-bold">
                        <i class="bi bi-box-arrow-up-right me-1"></i> View All
                    </a>
                </div>

                <div class="d-flex flex-column gap-3">
                    <div class="p-3 rounded-3" style="background-color: var(--bg-hover);">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle bg-soft-blue text-blue d-flex align-items-center justify-content-center fw-bold"
                                     style="width: 40px; height: 40px; font-size: 0.9rem;">JD</div>
                                <div>
                                    <h6 class="fw-bold text-main mb-0" style="font-size: 0.9rem;">John Doe</h6>
                                    <small class="text-muted-custom" style="font-size: 0.75rem;">Advanced Learning Phase</small>
                                </div>
                            </div>
                            <i class="bi bi-three-dots-vertical text-muted-custom small"></i>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="progress flex-grow-1" style="height: 6px; background-color: rgba(255,255,255,0.05);">
                                <div class="progress-bar bg-primary" style="width: 85%"></div>
                            </div>
                            <small class="text-primary fw-bold" style="font-size: 0.75rem;">85%</small>
                        </div>
                    </div>

                    <div class="p-3 rounded-3" style="background-color: var(--bg-hover);">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle bg-soft-teal text-teal d-flex align-items-center justify-content-center fw-bold"
                                     style="width: 40px; height: 40px; font-size: 0.9rem;">JS</div>
                                <div>
                                    <h6 class="fw-bold text-main mb-0" style="font-size: 0.9rem;">Jane Smith</h6>
                                    <small class="text-muted-custom" style="font-size: 0.75rem;">Mini-Project Phase</small>
                                </div>
                            </div>
                            <i class="bi bi-three-dots-vertical text-muted-custom small"></i>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="progress flex-grow-1" style="height: 6px; background-color: rgba(255,255,255,0.05);">
                                <div class="progress-bar bg-success" style="width: 92%"></div>
                            </div>
                            <small class="text-success fw-bold" style="font-size: 0.75rem;">92%</small>
                        </div>
                    </div>

                    <div class="p-3 rounded-3" style="background-color: var(--bg-hover);">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle bg-soft-blue text-blue d-flex align-items-center justify-content-center fw-bold"
                                     style="width: 40px; height: 40px; font-size: 0.9rem;">MJ</div>
                                <div>
                                    <h6 class="fw-bold text-main mb-0" style="font-size: 0.9rem;">Mike Johnson</h6>
                                    <small class="text-muted-custom" style="font-size: 0.75rem;">Foundation Phase</small>
                                </div>
                            </div>
                            <i class="bi bi-three-dots-vertical text-muted-custom small"></i>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="progress flex-grow-1" style="height: 6px; background-color: rgba(255,255,255,0.05);">
                                <div class="progress-bar bg-primary" style="width: 78%"></div>
                            </div>
                            <small class="text-primary fw-bold" style="font-size: 0.75rem;">78%</small>
                        </div>
                    </div>

                    <div class="p-3 rounded-3" style="background-color: var(--bg-hover);">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle bg-soft-teal text-teal d-flex align-items-center justify-content-center fw-bold"
                                     style="width: 40px; height: 40px; font-size: 0.9rem;">SW</div>
                                <div>
                                    <h6 class="fw-bold text-main mb-0" style="font-size: 0.9rem;">Sarah Wilson</h6>
                                    <small class="text-muted-custom" style="font-size: 0.75rem;">Client Project Phase</small>
                                </div>
                            </div>
                            <i class="bi bi-three-dots-vertical text-muted-custom small"></i>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="progress flex-grow-1" style="height: 6px; background-color: rgba(255,255,255,0.05);">
                                <div class="progress-bar bg-success" style="width: 96%"></div>
                            </div>
                            <small class="text-success fw-bold" style="font-size: 0.75rem;">96%</small>
                        </div>
                    </div>

                    <div class="p-3 rounded-3" style="background-color: var(--bg-hover);">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle bg-soft-blue text-blue d-flex align-items-center justify-content-center fw-bold"
                                     style="width: 40px; height: 40px; font-size: 0.9rem;">AC</div>
                                <div>
                                    <h6 class="fw-bold text-main mb-0" style="font-size: 0.9rem;">Alex Chen</h6>
                                    <small class="text-muted-custom" style="font-size: 0.75rem;">Advanced Learning Phase</small>
                                </div>
                            </div>
                            <i class="bi bi-three-dots-vertical text-muted-custom small"></i>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="progress flex-grow-1" style="height: 6px; background-color: rgba(255,255,255,0.05);">
                                <div class="progress-bar bg-primary" style="width: 88%"></div>
                            </div>
                            <small class="text-primary fw-bold" style="font-size: 0.75rem;">88%</small>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-4">

            <div class="card-custom mb-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="fw-bold m-0 text-main">Upcoming Sessions</h6>
                    <i class="bi bi-calendar-event text-muted-custom"></i>
                </div>

                <div class="d-flex flex-column gap-2 mb-3">
                    <div class="d-flex align-items-start gap-3 p-2 rounded-3 border border-dark-subtle" style="border-color: var(--border-color) !important;">
                        <div class="bg-soft-blue p-2 rounded-2 text-blue mt-1">
                            <i class="bi bi-people"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-main mb-0" style="font-size: 0.85rem;">Daily Standup</h6>
                            <small class="text-muted-custom d-block" style="font-size: 0.75rem;">John Doe</small>
                            <small class="text-blue fw-bold" style="font-size: 0.7rem;">In 1 hour</small>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3 p-2 rounded-3 border border-dark-subtle" style="border-color: var(--border-color) !important;">
                        <div class="bg-soft-orange p-2 rounded-2 text-accent mt-1">
                            <i class="bi bi-eye"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-main mb-0" style="font-size: 0.85rem;">Code Review</h6>
                            <small class="text-muted-custom d-block" style="font-size: 0.75rem;">Jane Smith</small>
                            <small class="text-accent fw-bold" style="font-size: 0.7rem;">In 3 hours</small>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3 p-2 rounded-3 border border-dark-subtle" style="border-color: var(--border-color) !important;">
                        <div class="bg-soft-green p-2 rounded-2 text-green mt-1">
                            <i class="bi bi-person"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-main mb-0" style="font-size: 0.85rem;">1-on-1 Meeting</h6>
                            <small class="text-muted-custom d-block" style="font-size: 0.75rem;">Mike Johnson</small>
                            <small class="text-green fw-bold" style="font-size: 0.7rem;">In 23 hours</small>
                        </div>
                    </div>

                     <div class="d-flex align-items-start gap-3 p-2 rounded-3 border border-dark-subtle" style="border-color: var(--border-color) !important;">
                        <div class="bg-soft-blue p-2 rounded-2 text-blue mt-1">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-main mb-0" style="font-size: 0.85rem;">Project Demo</h6>
                            <small class="text-muted-custom d-block" style="font-size: 0.75rem;">Sarah Wilson</small>
                            <small class="text-blue fw-bold" style="font-size: 0.7rem;">In 1 day</small>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary w-100 fw-bold"
                        style="background-color: var(--accent-color); border: none;">
                    <i class="bi bi-plus me-1"></i> Schedule Session
                </button>
            </div>

            <div class="card-custom mb-0">
                <h6 class="fw-bold mb-3 text-main">Quick Actions</h6>

                <div class="d-flex flex-column gap-2">
                    <button class="btn-quick-action m-0 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <div class="action-icon bg-soft-blue text-blue" style="width: 32px; height: 32px; font-size: 0.9rem;">
                                <i class="bi bi-calendar-plus"></i>
                            </div>
                            <span class="fw-medium text-main">Schedule Meeting</span>
                        </div>
                        <i class="bi bi-chevron-right small text-muted-custom"></i>
                    </button>

                    <button class="btn-quick-action m-0 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <div class="action-icon bg-soft-blue text-blue" style="width: 32px; height: 32px; font-size: 0.9rem;">
                                <i class="bi bi-chat-dots"></i>
                            </div>
                            <span class="fw-medium text-main">Send Message</span>
                        </div>
                        <i class="bi bi-chevron-right small text-muted-custom"></i>
                    </button>

                    <button class="btn-quick-action m-0 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <div class="action-icon bg-soft-green text-green" style="width: 32px; height: 32px; font-size: 0.9rem;">
                                <i class="bi bi-check2-square"></i>
                            </div>
                            <span class="fw-medium text-main">Review Tasks</span>
                        </div>
                        <i class="bi bi-chevron-right small text-muted-custom"></i>
                    </button>

                    <button class="btn-quick-action m-0 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <div class="action-icon bg-soft-orange text-accent" style="width: 32px; height: 32px; font-size: 0.9rem;">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <span class="fw-medium text-main">Generate Report</span>
                        </div>
                        <i class="bi bi-chevron-right small text-muted-custom"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>
@endsection
