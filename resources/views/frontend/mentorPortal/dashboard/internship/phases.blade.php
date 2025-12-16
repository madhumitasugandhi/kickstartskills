@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Phase Guidance')
@section('icon', 'bi bi-map fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')

    <div class="card-custom mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="fs-4 p-2 bg-soft-orange rounded-3 text-accent">
                <i class="bi bi-map fs-3"></i>
            </div>
            <div>
                <h4 class="fw-bold text-main mb-1">Phase Guidance</h4>
                <p class="text-muted-custom mb-0 small">Guide interns through structured learning phases and milestones</p>
            </div>
        </div>
    </div>

    <div class="row g-4 card-custom my-4 mx-1">

        <h6 class="fw-bold text-main mt-2">Select Phase</h6>

        <div class="col-md-4">
            <div class="card-custom text-center p-4 cursor-pointer position-relative h-100"
                 style="border: 2px solid var(--accent-color); background-color: var(--soft-accent);">
                <div class="mb-2 text-accent">
                    <i class="bi bi-play-circle-fill fs-3"></i>
                </div>
                <h6 class="fw-bold text-accent mb-1">Phase 1</h6>
                <small class="text-accent opacity-75">Foundation</small>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-custom text-center p-4 cursor-pointer h-100 bg-bg-hover opacity-75">
                <div class="mb-2 text-muted-custom">
                    <i class="bi bi-code-slash fs-3"></i>
                </div>
                <h6 class="fw-bold text-muted-custom mb-1">Phase 2</h6>
                <small class="text-muted-custom">Development</small>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-custom text-center p-4 cursor-pointer h-100 bg-bg-hover opacity-75">
                <div class="mb-2 text-muted-custom">
                    <i class="bi bi-star fs-3"></i>
                </div>
                <h6 class="fw-bold text-muted-custom mb-1">Phase 3</h6>
                <small class="text-muted-custom">Specialization</small>
            </div>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-xl-8">

            <div class="card-custom mb-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-soft-blue text-blue rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-play-fill fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-main mb-0">Foundation Phase</h5>
                            <small class="text-primary fw-bold">Duration: 8 weeks</small>
                        </div>
                    </div>
                </div>

                <p class="text-muted-custom small mb-4">
                    Building core programming fundamentals and basic web development skills. Interns are expected to master the basics of HTML, CSS, and JavaScript structure before moving to frameworks.
                </p>

                <h6 class="fw-bold text-main small mb-2">Learning Objectives</h6>
                <ul class="text-muted-custom small mb-4 ps-3">
                    <li class="mb-1">Master HTML, CSS, and JavaScript fundamentals</li>
                    <li class="mb-1">Understand version control with Git</li>
                    <li class="mb-1">Learn responsive web design principles</li>
                    <li class="mb-1">Complete first project portfolio</li>
                    <li class="mb-1">Develop problem-solving mindset</li>
                </ul>

                <h6 class="fw-bold text-main small mb-2">Key Skills</h6>
                <div class="d-flex gap-2 flex-wrap mb-4">
                    <span class="badge bg-bg-hover text-muted-custom border border-secondary fw-normal px-3 py-2">HTML</span>
                    <span class="badge bg-bg-hover text-muted-custom border border-secondary fw-normal px-3 py-2">CSS</span>
                    <span class="badge bg-bg-hover text-muted-custom border border-secondary fw-normal px-3 py-2">JavaScript</span>
                    <span class="badge bg-bg-hover text-muted-custom border border-secondary fw-normal px-3 py-2">Git</span>
                    <span class="badge bg-bg-hover text-muted-custom border border-secondary fw-normal px-3 py-2">Responsive Design</span>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <button class="btn btn-outline-primary w-100 fw-bold" style="border-color: var(--accent-color); color: var(--accent-color);">
                            <i class="bi bi-book me-2"></i> View Resources
                        </button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary w-100 fw-bold" style="background-color: var(--accent-color); border: none;">
                            <i class="bi bi-pencil-square me-2"></i> Edit Guide
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-custom mb-0">
                <h6 class="fw-bold text-main mb-4">Phase Milestones</h6>

                <div class="d-flex flex-column gap-3">
                    <div class="p-3 rounded-3 border border-dark-subtle" style="background-color: var(--bg-hover); border-color: var(--border-color) !important;">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <span class="fw-bold text-main small">HTML & CSS Mastery</span>
                                <small class="text-muted-custom ms-2">Week 2</small>
                            </div>
                            <span class="fw-bold text-success small">100%</span>
                        </div>
                        <div class="progress mb-3" style="height: 4px; background-color: rgba(255,255,255,0.1);">
                            <div class="progress-bar bg-success" style="width: 100%"></div>
                        </div>
                        <div class="d-flex gap-2">
                            <span class="badge bg-soft-blue text-blue border border-primary-subtle small fw-normal">HTML Structure</span>
                            <span class="badge bg-soft-blue text-blue border border-primary-subtle small fw-normal">CSS Styling</span>
                            <span class="badge bg-soft-blue text-blue border border-primary-subtle small fw-normal">Responsive Layout</span>
                        </div>
                    </div>

                    <div class="p-3 rounded-3 border border-dark-subtle" style="background-color: var(--bg-hover); border-color: var(--border-color) !important;">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <span class="fw-bold text-main small">JavaScript Fundamentals</span>
                                <small class="text-muted-custom ms-2">Week 4</small>
                            </div>
                            <span class="fw-bold text-success small">85%</span>
                        </div>
                        <div class="progress mb-3" style="height: 4px; background-color: rgba(255,255,255,0.1);">
                            <div class="progress-bar bg-success" style="width: 85%"></div>
                        </div>
                        <div class="d-flex gap-2">
                            <span class="badge bg-soft-blue text-blue border border-primary-subtle small fw-normal">Variables</span>
                            <span class="badge bg-soft-blue text-blue border border-primary-subtle small fw-normal">DOM Manipulation</span>
                        </div>
                    </div>

                    <div class="p-3 rounded-3 border border-dark-subtle" style="background-color: var(--bg-hover); border-color: var(--border-color) !important;">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="d-flex align-items-center gap-2">
                                <div class="spinner-border spinner-border-sm text-accent" role="status"></div>
                                <span class="fw-bold text-main small">Version Control with Git</span>
                                <small class="text-muted-custom ms-2">Week 5</small>
                            </div>
                            <span class="fw-bold text-accent small">67%</span>
                        </div>
                        <div class="progress mb-3" style="height: 4px; background-color: rgba(255,255,255,0.1);">
                            <div class="progress-bar bg-soft-orange" style="width: 67%; background-color: var(--accent-color);"></div>
                        </div>
                        <div class="d-flex gap-2">
                            <span class="badge bg-soft-blue text-blue border border-primary-subtle small fw-normal">Git Basics</span>
                            <span class="badge bg-soft-blue text-blue border border-primary-subtle small fw-normal">Branching</span>
                        </div>
                    </div>

                    <div class="p-3 rounded-3 border border-dark-subtle" style="background-color: var(--bg-hover); border-color: var(--border-color) !important;">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-circle text-muted-custom"></i>
                                <span class="fw-bold text-main small">First Portfolio Project</span>
                                <small class="text-muted-custom ms-2">Week 8</small>
                            </div>
                            <span class="fw-bold text-warning small">25%</span>
                        </div>
                        <div class="progress mb-3" style="height: 4px; background-color: rgba(255,255,255,0.1);">
                            <div class="progress-bar bg-warning" style="width: 25%"></div>
                        </div>
                        <div class="d-flex gap-2">
                            <span class="badge bg-soft-blue text-blue border border-primary-subtle small fw-normal">Planning</span>
                            <span class="badge bg-soft-blue text-blue border border-primary-subtle small fw-normal">Deployment</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-xl-4">
            <div class="card-custom h-100 mb-0">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-bold text-main m-0">Intern Progress</h6>
                    <i class="bi bi-box-arrow-up-right text-muted-custom cursor-pointer"></i>
                </div>

                <div class="d-flex flex-column gap-3">

                    <div class="p-3 rounded-3 border border-dark-subtle" style="background-color: var(--bg-hover); border-color: var(--border-color) !important;">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-flex gap-3">
                                <div class="rounded-circle bg-soft-blue text-blue d-flex align-items-center justify-content-center fw-bold"
                                     style="width: 40px; height: 40px;">JD</div>
                                <div>
                                    <h6 class="fw-bold text-main mb-0 small">John Doe</h6>
                                    <small class="text-muted-custom" style="font-size: 0.7rem;">Frontend 2024A</small>
                                </div>
                            </div>
                            <span class="badge bg-soft-green text-green rounded-pill" style="font-size: 0.65rem;">Active</span>
                        </div>

                        <div class="row g-2 mb-2">
                            <div class="col-6">
                                <small class="text-muted-custom d-block" style="font-size: 0.65rem;">Overall</small>
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-primary" style="width: 65%"></div>
                                </div>
                                <span class="small fw-bold text-primary">65%</span>
                            </div>
                            <div class="col-6">
                                <small class="text-muted-custom d-block" style="font-size: 0.65rem;">Weekly</small>
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-success" style="width: 85%"></div>
                                </div>
                                <span class="small fw-bold text-success">85%</span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <small class="text-danger fw-bold d-block mb-1" style="font-size: 0.7rem;">Needs Support:</small>
                            <div class="d-flex gap-1 flex-wrap">
                                <span class="badge bg-soft-red text-red border border-danger-subtle" style="font-size: 0.65rem;">Git Branching</span>
                                <span class="badge bg-soft-red text-red border border-danger-subtle" style="font-size: 0.65rem;">JS Async</span>
                            </div>
                        </div>

                        <button class="btn btn-sm btn-outline-secondary w-100" style="font-size: 0.8rem;">
                            <i class="bi bi-eye me-1"></i> View Details
                        </button>
                    </div>

                    <div class="p-3 rounded-3 border border-dark-subtle" style="background-color: var(--bg-hover); border-color: var(--border-color) !important;">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-flex gap-3">
                                <div class="rounded-circle bg-soft-teal text-teal d-flex align-items-center justify-content-center fw-bold"
                                     style="width: 40px; height: 40px;">JS</div>
                                <div>
                                    <h6 class="fw-bold text-main mb-0 small">Jane Smith</h6>
                                    <small class="text-muted-custom" style="font-size: 0.7rem;">Frontend 2024A</small>
                                </div>
                            </div>
                            <span class="badge bg-soft-green text-green rounded-pill" style="font-size: 0.65rem;">Active</span>
                        </div>

                        <div class="row g-2 mb-2">
                            <div class="col-6">
                                <small class="text-muted-custom d-block" style="font-size: 0.65rem;">Overall</small>
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-primary" style="width: 75%"></div>
                                </div>
                                <span class="small fw-bold text-primary">75%</span>
                            </div>
                            <div class="col-6">
                                <small class="text-muted-custom d-block" style="font-size: 0.65rem;">Weekly</small>
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-success" style="width: 92%"></div>
                                </div>
                                <span class="small fw-bold text-success">92%</span>
                            </div>
                        </div>

                        <button class="btn btn-sm btn-outline-secondary w-100" style="font-size: 0.8rem;">
                            <i class="bi bi-eye me-1"></i> View Details
                        </button>
                    </div>

                    <div class="p-3 rounded-3 border border-dark-subtle" style="background-color: var(--bg-hover); border-color: var(--border-color) !important;">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-flex gap-3">
                                <div class="rounded-circle bg-soft-orange text-accent d-flex align-items-center justify-content-center fw-bold"
                                     style="width: 40px; height: 40px;">MJ</div>
                                <div>
                                    <h6 class="fw-bold text-main mb-0 small">Mike Johnson</h6>
                                    <small class="text-muted-custom" style="font-size: 0.7rem;">Full-Stack 2024B</small>
                                </div>
                            </div>
                            <span class="text-warning small"><i class="bi bi-exclamation-triangle-fill"></i></span>
                        </div>

                        <div class="row g-2 mb-2">
                            <div class="col-6">
                                <small class="text-muted-custom d-block" style="font-size: 0.65rem;">Overall</small>
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-primary" style="width: 35%"></div>
                                </div>
                                <span class="small fw-bold text-primary">35%</span>
                            </div>
                            <div class="col-6">
                                <small class="text-muted-custom d-block" style="font-size: 0.65rem;">Weekly</small>
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-success" style="width: 45%"></div>
                                </div>
                                <span class="small fw-bold text-success">45%</span>
                            </div>
                        </div>

                        <button class="btn btn-sm btn-outline-secondary w-100" style="font-size: 0.8rem;">
                            <i class="bi bi-eye me-1"></i> View Details
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection

