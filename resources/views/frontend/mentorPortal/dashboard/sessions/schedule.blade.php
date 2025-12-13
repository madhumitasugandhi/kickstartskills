@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Schedule Session')
@section('icon', 'bi bi-plus-circle fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')

    <div class="card-custom mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-soft-blue p-3 rounded-3 text-primary">
                <i class="bi bi-calendar-plus fs-3"></i>
            </div>
            <div>
                <h4 class="fw-bold text-main mb-1">Schedule New Session</h4>
                <p class="text-muted-custom mb-0 small">Create a mentoring session with your students</p>
            </div>
        </div>
    </div>

    <form action="#" method="POST">
        <div class="row g-4">

            <div class="col-lg-8">

                <div class="card-custom mb-4">
                    <h6 class="fw-bold text-main mb-4 border-bottom pb-3" style="border-color: var(--border-color) !important;">
                        Session Details
                    </h6>

                    <div class="mb-3">
                        <label class="form-label small text-muted-custom fw-bold">Session Title</label>
                        <div class="input-group">
                            <span class="input-group-text bg-bg-hover border-end-0" style="background-color: var(--bg-hover); border-color: var(--border-color);">
                                <i class="bi bi-pencil text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0 ps-0" placeholder="e.g. Weekly Sync with John"
                                   style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-muted-custom fw-bold">Session Type</label>
                        <div class="input-group">
                            <span class="input-group-text bg-bg-hover border-end-0" style="background-color: var(--bg-hover); border-color: var(--border-color);">
                                <i class="bi bi-layout-text-sidebar-reverse text-muted"></i>
                            </span>
                            <select class="form-select border-start-0 ps-0"
                                    style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                                <option selected>One-on-One Meeting</option>
                                <option>Group Discussion</option>
                                <option>Project Review</option>
                                <option>Code Review</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-muted-custom fw-bold">Description</label>
                        <div class="input-group">
                            <span class="input-group-text bg-bg-hover border-end-0 align-items-start pt-2" style="background-color: var(--bg-hover); border-color: var(--border-color);">
                                <i class="bi bi-file-text text-muted"></i>
                            </span>
                            <textarea class="form-control border-start-0 ps-0" rows="3" placeholder="Enter session details..."
                                      style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);"></textarea>
                        </div>
                    </div>

                    <div class="mb-0">
                        <label class="form-label small text-muted-custom fw-bold">Agenda</label>
                        <div class="input-group">
                            <span class="input-group-text bg-bg-hover border-end-0 align-items-start pt-2" style="background-color: var(--bg-hover); border-color: var(--border-color);">
                                <i class="bi bi-list-ul text-muted"></i>
                            </span>
                            <textarea class="form-control border-start-0 ps-0" rows="3" placeholder="List key discussion points..."
                                      style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);"></textarea>
                        </div>
                    </div>
                </div>

                <div class="card-custom mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-bold text-main mb-1">Recurring Session</h6>
                            <p class="text-muted-custom mb-0 small">Create multiple sessions with the same settings</p>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="recurringSwitch"
                                   style="width: 3em; height: 1.5em; cursor: pointer;">
                        </div>
                    </div>
                </div>

                <div class="card-custom mb-0">
                    <h6 class="fw-bold text-main mb-4 border-bottom pb-3" style="border-color: var(--border-color) !important;">
                        Meeting Settings
                    </h6>

                    <div class="mb-3">
                        <label class="form-label small text-muted-custom fw-bold">Meeting Platform</label>
                        <div class="input-group">
                            <span class="input-group-text bg-bg-hover border-end-0" style="background-color: var(--bg-hover); border-color: var(--border-color);">
                                <i class="bi bi-camera-video text-muted"></i>
                            </span>
                            <select class="form-select border-start-0 ps-0"
                                    style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                                <option selected>Google Meet</option>
                                <option>Zoom</option>
                                <option>Microsoft Teams</option>
                            </select>
                        </div>
                    </div>

                    <div class="alert bg-soft-blue border-0 d-flex align-items-center gap-2 mb-0 text-primary small">
                        <i class="bi bi-info-circle-fill"></i>
                        <span>Meeting link will be generated automatically and sent to participants.</span>
                    </div>
                </div>

            </div>

            <div class="col-lg-4">

                <div class="card-custom mb-4">
                    <h6 class="fw-bold text-main mb-3">Select Students</h6>

                    <div class="d-flex flex-column gap-2" style="max-height: 300px; overflow-y: auto;">
                        <div class="p-2 rounded-3 border d-flex align-items-center gap-3 cursor-pointer"
                             style="border-color: var(--accent-color) !important; background-color: var(--soft-accent);">
                            <div class="rounded-circle bg-soft-blue text-blue d-flex align-items-center justify-content-center fw-bold"
                                 style="width: 40px; height: 40px; font-size: 0.8rem;">JD</div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold text-main mb-0" style="font-size: 0.85rem;">John Doe</h6>
                                <small class="text-success" style="font-size: 0.7rem;">Available</small>
                            </div>
                            <i class="bi bi-check-circle-fill text-accent"></i>
                        </div>

                        <div class="p-2 rounded-3 border d-flex align-items-center gap-3 cursor-pointer"
                             style="border-color: var(--border-color) !important; background-color: var(--bg-hover);">
                            <div class="rounded-circle bg-soft-teal text-teal d-flex align-items-center justify-content-center fw-bold"
                                 style="width: 40px; height: 40px; font-size: 0.8rem;">JS</div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold text-main mb-0" style="font-size: 0.85rem;">Jane Smith</h6>
                                <small class="text-success" style="font-size: 0.7rem;">Available</small>
                            </div>
                            <i class="bi bi-circle text-muted-custom"></i>
                        </div>

                        <div class="p-2 rounded-3 border d-flex align-items-center gap-3 opacity-75"
                             style="border-color: var(--border-color) !important; background-color: var(--bg-hover);">
                            <div class="rounded-circle bg-soft-orange text-accent d-flex align-items-center justify-content-center fw-bold"
                                 style="width: 40px; height: 40px; font-size: 0.8rem;">MJ</div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold text-main mb-0" style="font-size: 0.85rem;">Mike Johnson</h6>
                                <small class="text-danger" style="font-size: 0.7rem;">Not available at this time</small>
                            </div>
                        </div>

                        <div class="p-2 rounded-3 border d-flex align-items-center gap-3 cursor-pointer"
                             style="border-color: var(--border-color) !important; background-color: var(--bg-hover);">
                            <div class="rounded-circle bg-soft-blue text-blue d-flex align-items-center justify-content-center fw-bold"
                                 style="width: 40px; height: 40px; font-size: 0.8rem;">SW</div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold text-main mb-0" style="font-size: 0.85rem;">Sarah Wilson</h6>
                                <small class="text-success" style="font-size: 0.7rem;">Available</small>
                            </div>
                            <i class="bi bi-circle text-muted-custom"></i>
                        </div>
                    </div>

                    <small class="text-danger mt-3 d-block" style="font-size: 0.75rem;">* Please select at least one student</small>
                </div>

                <div class="card-custom mb-4">
                    <h6 class="fw-bold text-main mb-3">Date & Time</h6>

                    <div class="mb-3">
                        <label class="form-label small text-muted-custom fw-bold">Date</label>
                        <div class="input-group">
                            <span class="input-group-text bg-bg-hover border-end-0" style="background-color: var(--bg-hover); border-color: var(--border-color);">
                                <i class="bi bi-calendar3 text-muted"></i>
                            </span>
                            <input type="date" class="form-control border-start-0 ps-0" value="2025-12-14"
                                   style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-muted-custom fw-bold">Time</label>
                        <div class="input-group">
                            <span class="input-group-text bg-bg-hover border-end-0" style="background-color: var(--bg-hover); border-color: var(--border-color);">
                                <i class="bi bi-clock text-muted"></i>
                            </span>
                            <input type="time" class="form-control border-start-0 ps-0" value="10:00"
                                   style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                        </div>
                    </div>

                    <div class="mb-0">
                        <label class="form-label small text-muted-custom fw-bold">Duration</label>
                        <div class="input-group">
                            <span class="input-group-text bg-bg-hover border-end-0" style="background-color: var(--bg-hover); border-color: var(--border-color);">
                                <i class="bi bi-hourglass-split text-muted"></i>
                            </span>
                            <select class="form-select border-start-0 ps-0"
                                    style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                                <option>30 minutes</option>
                                <option selected>60 minutes</option>
                                <option>90 minutes</option>
                                <option>2 hours</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card-custom mb-0">
                    <button type="submit" class="btn btn-primary w-100 fw-bold mb-2"
                            style="background-color: var(--accent-color); border: none; padding: 10px;">
                        <i class="bi bi-calendar-check me-2"></i> Schedule Session
                    </button>
                    <button type="button" class="btn btn-outline-secondary w-100 fw-bold mb-3"
                            style="border-color: var(--border-color); color: var(--text-muted);">
                        <i class="bi bi-save me-2"></i> Save as Draft
                    </button>

                    <div class="text-center">
                        <a href="#" class="text-accent text-decoration-none small fw-bold">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Form
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </form>@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Schedule Session')
@section('icon', 'bi bi-plus-circle fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')

    <div class="card-custom mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-soft-blue p-3 rounded-3 text-primary">
                <i class="bi bi-calendar-plus fs-3"></i>
            </div>
            <div>
                <h4 class="fw-bold text-main mb-1">Schedule New Session</h4>
                <p class="text-muted-custom mb-0 small">Create a mentoring session with your students</p>
            </div>
        </div>
    </div>

    <form action="#" method="POST">
        <div class="row g-4">

            <div class="col-lg-8">

                <div class="card-custom mb-4">
                    <h6 class="fw-bold text-main mb-4 border-bottom pb-3" style="border-color: var(--border-color) !important;">
                        Session Details
                    </h6>

                    <div class="mb-3">
                        <label class="form-label small text-muted-custom fw-bold">Session Title</label>
                        <div class="input-group">
                            <span class="input-group-text bg-bg-hover border-end-0" style="background-color: var(--bg-hover); border-color: var(--border-color);">
                                <i class="bi bi-pencil text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0 ps-0" placeholder="e.g. Weekly Sync with John"
                                   style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-muted-custom fw-bold">Session Type</label>
                        <div class="input-group">
                            <span class="input-group-text bg-bg-hover border-end-0" style="background-color: var(--bg-hover); border-color: var(--border-color);">
                                <i class="bi bi-layout-text-sidebar-reverse text-muted"></i>
                            </span>
                            <select class="form-select border-start-0 ps-0"
                                    style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                                <option selected>One-on-One Meeting</option>
                                <option>Group Discussion</option>
                                <option>Project Review</option>
                                <option>Code Review</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-muted-custom fw-bold">Description</label>
                        <div class="input-group">
                            <span class="input-group-text bg-bg-hover border-end-0 align-items-start pt-2" style="background-color: var(--bg-hover); border-color: var(--border-color);">
                                <i class="bi bi-file-text text-muted"></i>
                            </span>
                            <textarea class="form-control border-start-0 ps-0" rows="3" placeholder="Enter session details..."
                                      style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);"></textarea>
                        </div>
                    </div>

                    <div class="mb-0">
                        <label class="form-label small text-muted-custom fw-bold">Agenda</label>
                        <div class="input-group">
                            <span class="input-group-text bg-bg-hover border-end-0 align-items-start pt-2" style="background-color: var(--bg-hover); border-color: var(--border-color);">
                                <i class="bi bi-list-ul text-muted"></i>
                            </span>
                            <textarea class="form-control border-start-0 ps-0" rows="3" placeholder="List key discussion points..."
                                      style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);"></textarea>
                        </div>
                    </div>
                </div>

                <div class="card-custom mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-bold text-main mb-1">Recurring Session</h6>
                            <p class="text-muted-custom mb-0 small">Create multiple sessions with the same settings</p>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="recurringSwitch"
                                   style="width: 3em; height: 1.5em; cursor: pointer;">
                        </div>
                    </div>
                </div>

                <div class="card-custom mb-0">
                    <h6 class="fw-bold text-main mb-4 border-bottom pb-3" style="border-color: var(--border-color) !important;">
                        Meeting Settings
                    </h6>

                    <div class="mb-3">
                        <label class="form-label small text-muted-custom fw-bold">Meeting Platform</label>
                        <div class="input-group">
                            <span class="input-group-text bg-bg-hover border-end-0" style="background-color: var(--bg-hover); border-color: var(--border-color);">
                                <i class="bi bi-camera-video text-muted"></i>
                            </span>
                            <select class="form-select border-start-0 ps-0"
                                    style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                                <option selected>Google Meet</option>
                                <option>Zoom</option>
                                <option>Microsoft Teams</option>
                            </select>
                        </div>
                    </div>

                    <div class="alert bg-soft-blue border-0 d-flex align-items-center gap-2 mb-0 text-primary small">
                        <i class="bi bi-info-circle-fill"></i>
                        <span>Meeting link will be generated automatically and sent to participants.</span>
                    </div>
                </div>

            </div>

            <div class="col-lg-4">

                <div class="card-custom mb-4">
                    <h6 class="fw-bold text-main mb-3">Select Students</h6>

                    <div class="d-flex flex-column gap-2" style="max-height: 300px; overflow-y: auto;">
                        <div class="p-2 rounded-3 border d-flex align-items-center gap-3 cursor-pointer"
                             style="border-color: var(--accent-color) !important; background-color: var(--soft-accent);">
                            <div class="rounded-circle bg-soft-blue text-blue d-flex align-items-center justify-content-center fw-bold"
                                 style="width: 40px; height: 40px; font-size: 0.8rem;">JD</div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold text-main mb-0" style="font-size: 0.85rem;">John Doe</h6>
                                <small class="text-success" style="font-size: 0.7rem;">Available</small>
                            </div>
                            <i class="bi bi-check-circle-fill text-accent"></i>
                        </div>

                        <div class="p-2 rounded-3 border d-flex align-items-center gap-3 cursor-pointer"
                             style="border-color: var(--border-color) !important; background-color: var(--bg-hover);">
                            <div class="rounded-circle bg-soft-teal text-teal d-flex align-items-center justify-content-center fw-bold"
                                 style="width: 40px; height: 40px; font-size: 0.8rem;">JS</div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold text-main mb-0" style="font-size: 0.85rem;">Jane Smith</h6>
                                <small class="text-success" style="font-size: 0.7rem;">Available</small>
                            </div>
                            <i class="bi bi-circle text-muted-custom"></i>
                        </div>

                        <div class="p-2 rounded-3 border d-flex align-items-center gap-3 opacity-75"
                             style="border-color: var(--border-color) !important; background-color: var(--bg-hover);">
                            <div class="rounded-circle bg-soft-orange text-accent d-flex align-items-center justify-content-center fw-bold"
                                 style="width: 40px; height: 40px; font-size: 0.8rem;">MJ</div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold text-main mb-0" style="font-size: 0.85rem;">Mike Johnson</h6>
                                <small class="text-danger" style="font-size: 0.7rem;">Not available at this time</small>
                            </div>
                        </div>

                        <div class="p-2 rounded-3 border d-flex align-items-center gap-3 cursor-pointer"
                             style="border-color: var(--border-color) !important; background-color: var(--bg-hover);">
                            <div class="rounded-circle bg-soft-blue text-blue d-flex align-items-center justify-content-center fw-bold"
                                 style="width: 40px; height: 40px; font-size: 0.8rem;">SW</div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold text-main mb-0" style="font-size: 0.85rem;">Sarah Wilson</h6>
                                <small class="text-success" style="font-size: 0.7rem;">Available</small>
                            </div>
                            <i class="bi bi-circle text-muted-custom"></i>
                        </div>
                    </div>

                    <small class="text-danger mt-3 d-block" style="font-size: 0.75rem;">* Please select at least one student</small>
                </div>

                <div class="card-custom mb-4">
                    <h6 class="fw-bold text-main mb-3">Date & Time</h6>

                    <div class="mb-3">
                        <label class="form-label small text-muted-custom fw-bold">Date</label>
                        <div class="input-group">
                            <span class="input-group-text bg-bg-hover border-end-0" style="background-color: var(--bg-hover); border-color: var(--border-color);">
                                <i class="bi bi-calendar3 text-muted"></i>
                            </span>
                            <input type="date" class="form-control border-start-0 ps-0" value="2025-12-14"
                                   style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-muted-custom fw-bold">Time</label>
                        <div class="input-group">
                            <span class="input-group-text bg-bg-hover border-end-0" style="background-color: var(--bg-hover); border-color: var(--border-color);">
                                <i class="bi bi-clock text-muted"></i>
                            </span>
                            <input type="time" class="form-control border-start-0 ps-0" value="10:00"
                                   style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                        </div>
                    </div>

                    <div class="mb-0">
                        <label class="form-label small text-muted-custom fw-bold">Duration</label>
                        <div class="input-group">
                            <span class="input-group-text bg-bg-hover border-end-0" style="background-color: var(--bg-hover); border-color: var(--border-color);">
                                <i class="bi bi-hourglass-split text-muted"></i>
                            </span>
                            <select class="form-select border-start-0 ps-0"
                                    style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                                <option>30 minutes</option>
                                <option selected>60 minutes</option>
                                <option>90 minutes</option>
                                <option>2 hours</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card-custom mb-0">
                    <button type="submit" class="btn btn-primary w-100 fw-bold mb-2"
                            style="background-color: var(--accent-color); border: none; padding: 10px;">
                        <i class="bi bi-calendar-check me-2"></i> Schedule Session
                    </button>
                    <button type="button" class="btn btn-outline-secondary w-100 fw-bold mb-3"
                            style="border-color: var(--border-color); color: var(--text-muted);">
                        <i class="bi bi-save me-2"></i> Save as Draft
                    </button>

                    <div class="text-center">
                        <a href="#" class="text-accent text-decoration-none small fw-bold">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Form
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </form>

@endsection

@endsection
