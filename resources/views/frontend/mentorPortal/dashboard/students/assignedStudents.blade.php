@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Assigned Students')
@section('icon', 'bi bi-person-lines-fill fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')

    <div class="card-custom mb-4" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px;">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
            <div>
                <h4 class="fw-bold text-main mb-1">Assigned Students</h4>
                <p class="--text-muted-custom mb-0 small">Manage and track your student progress</p>
            </div>

            <button class="btn btn-primary fw-bold px-4 w-100 w-md-auto"
                    style="background-color: var(--accent-color); border: none;">
                <i class="bi bi-plus-lg me-2"></i>Add Student
            </button>
        </div>

        <div class="row g-3">
            <div class="col-lg-6">
                <div class="input-group">
                    <span class="input-group-text bg-bg-hover border-end-0" style="background-color: var(--bg-body); border-color: var(--border-color); color: var(--text-main);">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 ps-0"
                           placeholder="Search students..."
                           style="background-color: var(--bg-body); border-color: var(--border-color); color: var(--text-main);">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="d-flex flex-wrap gap-2 justify-content-start justify-content-lg-end">
                    <div class="btn-group" role="group">
                        <input type="radio" class="btn-check" name="status" id="statusAll" checked>
                        <label class="btn btn-outline-secondary btn-sm" for="statusAll">All</label>

                        <input type="radio" class="btn-check" name="status" id="statusOnline">
                        <label class="btn btn-outline-secondary btn-sm" for="statusOnline">Online</label>

                        <input type="radio" class="btn-check" name="status" id="statusOffline">
                        <label class="btn btn-outline-secondary btn-sm" for="statusOffline">Offline</label>
                    </div>

                    <div class="d-flex gap-2 flex-wrap">
                        <span class="badge bg-soft-blue text-blue rounded-pill px-3 py-2 cursor-pointer border border-primary-subtle">
                            Foundation
                        </span>
                        <span class="badge bg-soft-orange text-accent rounded-pill px-3 py-2 cursor-pointer border border-warning-subtle">
                            Advanced
                        </span>
                        <span class="badge bg-soft-teal text-teal rounded-pill px-3 py-2 cursor-pointer border border-info-subtle">
                            Projects
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 g-md-4 mb-4">
        <div class="col-6 col-md-3">
            <div class="card-custom text-center py-4 mb-0 h-100" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px;">
                <div class="bg-soft-blue mx-auto rounded-circle d-flex align-items-center justify-content-center mb-3"
                     style="width: 50px; height: 50px;">
                    <i class="bi bi-people fs-4 text-blue"></i>
                </div>
                <h3 class="fw-bold text-blue mb-1">5</h3>
                <span class="text-muted-custom small fw-medium">Total Assigned</span>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card-custom text-center py-4 mb-0 h-100" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px;">
                <div class="bg-soft-green mx-auto rounded-circle d-flex align-items-center justify-content-center mb-3"
                     style="width: 50px; height: 50px;">
                    <i class="bi bi-globe fs-4 text-green"></i>
                </div>
                <h3 class="fw-bold text-green mb-1">3</h3>
                <span class="text-muted-custom small fw-medium">Online Now</span>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card-custom text-center py-4 mb-0 h-100" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px;">
                <div class="bg-soft-blue mx-auto rounded-circle d-flex align-items-center justify-content-center mb-3"
                     style="width: 50px; height: 50px; background-color: rgba(13, 110, 253, 0.1);">
                     <i class="bi bi-graph-up-arrow fs-4 text-primary"></i>
                </div>
                <h3 class="fw-bold text-primary mb-1">88%</h3>
                <span class="text-muted-custom small fw-medium">Avg Progress</span>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card-custom text-center py-4 mb-0 h-100" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px;">
                <div class="bg-soft-orange mx-auto rounded-circle d-flex align-items-center justify-content-center mb-3"
                     style="width: 50px; height: 50px;">
                    <i class="bi bi-exclamation-circle fs-4 text-accent"></i>
                </div>
                <h3 class="fw-bold text-accent mb-1">1</h3>
                <span class="text-muted-custom small fw-medium">Needs Attention</span>
            </div>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-lg-6">
            <div class="card-custom h-100 mb-0 position-relative overflow-hidden" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px;">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex gap-3">
                        <div class="position-relative">
                            <div class="rounded-circle bg-soft-blue text-blue d-flex align-items-center justify-content-center fw-bold fs-5"
                                 style="width: 56px; height: 56px;">JD</div>
                            <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-2 border-white rounded-circle"></span>
                        </div>
                        <div>
                            <h5 class="fw-bold text-main mb-1">John Doe</h5>
                            <small class="text-muted-custom d-block mb-1">Tech Institute</small>
                            <span class="badge bg-soft-blue text-blue rounded-pill small">Advanced Learning Phase</span>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-link text-muted-custom p-0" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">View Profile</a></li>
                            <li><a class="dropdown-item" href="#">Message</a></li>
                        </ul>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between small mb-1">
                        <span class="text-muted-custom">Overall Progress</span>
                        <span class="fw-bold text-primary">85%</span>
                    </div>
                    <div class="progress" style="height: 6px; background-color: var(--bg-hover);">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 85%"></div>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2 mb-4">
                    <span class="badge bg-soft-green text-green rounded-pill fw-normal px-3">
                        Attendance: 92%
                    </span>
                    <span class="badge bg-soft-blue text-blue rounded-pill fw-normal px-3">
                        Score: 90
                    </span>
                    <span class="badge bg-soft-orange text-accent rounded-pill fw-normal px-3">
                        Rating: 4.2
                    </span>
                </div>

                <div class="d-flex align-items-center gap-2 text-primary small fw-medium mb-3">
                    <i class="bi bi-clock-history"></i>
                    <span>2 upcoming tasks pending</span>
                </div>

                <div class="border-top pt-3 d-flex justify-content-between align-items-center"
                     style="border-color: var(--border-color) !important;">
                     <small class="text-muted-custom">Last seen: 5h ago</small>
                     <button class="btn btn-sm btn-outline-primary rounded-pill px-3">
                       View Details
                     </button>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card-custom h-100 mb-0 position-relative overflow-hidden" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px;">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex gap-3">
                        <div class="position-relative">
                            <div class="rounded-circle bg-soft-teal text-teal d-flex align-items-center justify-content-center fw-bold fs-5"
                                 style="width: 56px; height: 56px;">JS</div>
                            <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-2 border-white rounded-circle"></span>
                        </div>
                        <div>
                            <h5 class="fw-bold text-main mb-1">Jane Smith</h5>
                            <small class="text-muted-custom d-block mb-1">Engineering College</small>
                            <span class="badge bg-soft-orange text-accent rounded-pill small">Mini-Project Phase</span>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-link text-muted-custom p-0" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">View Profile</a></li>
                            <li><a class="dropdown-item" href="#">Message</a></li>
                        </ul>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between small mb-1">
                        <span class="text-muted-custom">Overall Progress</span>
                        <span class="fw-bold text-success">92%</span>
                    </div>
                    <div class="progress" style="height: 6px; background-color: var(--bg-hover);">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 92%"></div>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2 mb-4">
                    <span class="badge bg-soft-green text-green rounded-pill fw-normal px-3">
                        Attendance: 95%
                    </span>
                    <span class="badge bg-soft-blue text-blue rounded-pill fw-normal px-3">
                        Score: 94
                    </span>
                    <span class="badge bg-soft-orange text-accent rounded-pill fw-normal px-3">
                        Rating: 4.5
                    </span>
                </div>

                <div class="d-flex align-items-center gap-2 text-primary small fw-medium mb-3">
                    <i class="bi bi-clock-history"></i>
                    <span>All tasks up to date</span>
                </div>

                <div class="border-top pt-3 d-flex justify-content-between align-items-center"
                     style="border-color: var(--border-color) !important;">
                     <small class="text-muted-custom">Last seen: 6h ago</small>
                     <button class="btn btn-sm btn-outline-primary rounded-pill px-3" >
                       View Details
                     </button>
                </div>
            </div>
        </div>

    </div>

@endsection
