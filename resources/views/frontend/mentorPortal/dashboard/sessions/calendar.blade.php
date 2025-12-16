@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Session Calendar')
@section('icon', 'bi bi-calendar3 fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')

    <div class="card-custom mb-4" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px;">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <div class="text-center text-md-start">
                <h4 class="fw-bold text-main mb-1">Session Calendar</h4>
                <p class="text-muted-custom mb-0 small">Manage your mentoring sessions and availability</p>
            </div>

            <div class="d-flex flex-column flex-sm-row align-items-center gap-3 w-100 w-md-auto justify-content-center justify-content-md-end">
                <div class="d-flex align-items-center justify-content-between gap-2 bg-bg-hover p-1 rounded-3 w-100 w-sm-auto">
                    <button class="btn btn-sm btn-icon text-muted-custom hover-accent">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <span class="fw-bold text-main px-2">December 2025</span>
                    <button class="btn btn-sm btn-icon text-muted-custom hover-accent">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>

                <div class="btn-group w-100 w-sm-auto" role="group">
                    <input type="radio" class="btn-check" name="viewMode" id="vmDay">
                    <label class="btn btn-outline-secondary btn-sm flex-grow-1 flex-sm-grow-0" for="vmDay">Day</label>

                    <input type="radio" class="btn-check" name="viewMode" id="vmWeek">
                    <label class="btn btn-outline-secondary btn-sm flex-grow-1 flex-sm-grow-0" for="vmWeek">Week</label>

                    <input type="radio" class="btn-check" name="viewMode" id="vmMonth" checked>
                    <label class="btn btn-outline-primary btn-sm flex-grow-1 flex-sm-grow-0" for="vmMonth">Month</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-xl-8">
            <div class="card-custom h-100 mb-0 p-4" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; overflow-x: auto;">

                <div style="min-width: 600px;">
                    <div class="d-grid text-center mb-2" style="grid-template-columns: repeat(7, 1fr);">
                        <div class="text-muted-custom small fw-bold py-2">Mon</div>
                        <div class="text-muted-custom small fw-bold py-2">Tue</div>
                        <div class="text-muted-custom small fw-bold py-2">Wed</div>
                        <div class="text-muted-custom small fw-bold py-2">Thu</div>
                        <div class="text-muted-custom small fw-bold py-2">Fri</div>
                        <div class="text-muted-custom small fw-bold py-2">Sat</div>
                        <div class="text-muted-custom small fw-bold py-2">Sun</div>
                    </div>

                    <div class="d-grid text-center gap-2" style="grid-template-columns: repeat(7, 1fr); min-height: 400px;">
                        <div class="p-3 rounded-3 text-muted-custom opacity-25">24</div>
                        <div class="p-3 rounded-3 text-muted-custom opacity-25">25</div>
                        <div class="p-3 rounded-3 text-muted-custom opacity-25">26</div>
                        <div class="p-3 rounded-3 text-muted-custom opacity-25">27</div>
                        <div class="p-3 rounded-3 text-muted-custom opacity-25">28</div>
                        <div class="p-3 rounded-3 text-muted-custom opacity-25">29</div>
                        <div class="p-3 rounded-3 text-muted-custom opacity-25">30</div>

                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">1</div>
                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">2</div>
                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">3</div>
                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">4</div>
                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">5</div>
                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">6</div>
                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">7</div>

                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">8</div>
                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">9</div>
                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">10</div>
                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">11</div>
                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer position-relative">
                            12
                            <span class="position-absolute bottom-0 start-50 translate-middle-x mb-2 d-flex gap-1">
                                <span class="rounded-circle bg-warning" style="width: 4px; height: 4px;"></span>
                            </span>
                        </div>

                        <div class="p-3 rounded-3 text-accent fw-bold border border-primary position-relative"
                             style="background-color: rgba(13, 110, 253, 0.1); border-color: var(--accent-color) !important;">
                            13
                            <span class="position-absolute bottom-0 start-50 translate-middle-x mb-2 d-flex gap-1">
                                <span class="rounded-circle bg-primary" style="width: 4px; height: 4px;"></span>
                                <span class="rounded-circle bg-warning" style="width: 4px; height: 4px;"></span>
                            </span>
                        </div>

                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer position-relative">
                            14
                            <span class="position-absolute bottom-0 start-50 translate-middle-x mb-2 d-flex gap-1">
                                <span class="rounded-circle bg-success" style="width: 4px; height: 4px;"></span>
                            </span>
                        </div>

                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer position-relative">
                            15
                            <span class="position-absolute bottom-0 start-50 translate-middle-x mb-2 d-flex gap-1">
                                <span class="rounded-circle bg-primary" style="width: 4px; height: 4px;"></span>
                            </span>
                        </div>
                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">16</div>
                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">17</div>
                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">18</div>
                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">19</div>
                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">20</div>
                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">21</div>

                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">22</div>
                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">23</div>
                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">24</div>
                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">25</div>
                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">26</div>
                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">27</div>
                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">28</div>

                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">29</div>
                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">30</div>
                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer">31</div>

                        <div class="p-3 rounded-3 text-muted-custom opacity-25">1</div>
                        <div class="p-3 rounded-3 text-muted-custom opacity-25">2</div>
                        <div class="p-3 rounded-3 text-muted-custom opacity-25">3</div>
                        <div class="p-3 rounded-3 text-muted-custom opacity-25">4</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">

            <div class="card-custom mb-4" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-bold m-0 text-main">Sessions for 13 Dec 2025</h6>
                    <button class="btn btn-sm btn-primary rounded-circle d-flex align-items-center justify-content-center p-0"
                            style="width: 32px; height: 32px; background-color: var(--accent-color); border: none;">
                        <i class="bi bi-plus-lg text-white"></i>
                    </button>
                </div>

                <div class="d-flex flex-column gap-3">

                    <div class="p-3 rounded-3 border border-dark-subtle position-relative overflow-hidden"
                         style="background-color: var(--bg-hover); border-color: var(--border-color) !important;">
                        <div class="position-absolute top-0 start-0 bottom-0 bg-primary" style="width: 4px;"></div>

                        <div class="d-flex justify-content-between align-items-start mb-2 ps-2">
                            <div class="d-flex align-items-center gap-2">
                                <div class="bg-soft-blue text-blue rounded-circle d-flex align-items-center justify-content-center"
                                     style="width: 36px; height: 36px;">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-main mb-0" style="font-size: 0.9rem;">Daily Standup</h6>
                                    <small class="text-muted-custom" style="font-size: 0.75rem;">with John Doe</small>
                                </div>
                            </div>
                            <span class="badge bg-soft-blue text-blue rounded-pill" style="font-size: 0.65rem;">Scheduled</span>
                        </div>

                        <div class="d-flex align-items-center gap-2 mb-3 ps-2 text-muted-custom small">
                            <i class="bi bi-clock"></i>
                            <span>8:30 PM - 9:00 PM</span>
                        </div>

                        <div class="d-flex gap-2 ps-2">
                            <button class="btn btn-sm btn-outline-secondary flex-grow-1" style="font-size: 0.8rem;">
                                <i class="bi bi-pencil-square me-1"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-primary flex-grow-1" style="font-size: 0.8rem; background-color: var(--accent-color); border: none;">
                                <i class="bi bi-camera-video me-1"></i> Join
                            </button>
                        </div>
                    </div>

                    <div class="p-3 rounded-3 border border-dark-subtle position-relative overflow-hidden"
                         style="background-color: var(--bg-hover); border-color: var(--border-color) !important;">
                        <div class="position-absolute top-0 start-0 bottom-0 bg-warning" style="width: 4px;"></div>

                        <div class="d-flex justify-content-between align-items-start mb-2 ps-2">
                            <div class="d-flex align-items-center gap-2">
                                <div class="bg-soft-orange text-accent rounded-circle d-flex align-items-center justify-content-center"
                                     style="width: 36px; height: 36px;">
                                    <i class="bi bi-eye"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-main mb-0" style="font-size: 0.9rem;">Code Review</h6>
                                    <small class="text-muted-custom" style="font-size: 0.75rem;">with Jane Smith</small>
                                </div>
                            </div>
                            <span class="badge bg-soft-blue text-blue rounded-pill" style="font-size: 0.65rem;">Scheduled</span>
                        </div>

                        <div class="d-flex align-items-center gap-2 mb-3 ps-2 text-muted-custom small">
                            <i class="bi bi-clock"></i>
                            <span>10:30 PM - 11:30 PM</span>
                        </div>

                        <div class="d-flex gap-2 ps-2">
                            <button class="btn btn-sm btn-outline-secondary flex-grow-1" style="font-size: 0.8rem;">
                                <i class="bi bi-pencil-square me-1"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-primary flex-grow-1" style="font-size: 0.8rem; background-color: var(--accent-color); border: none;">
                                <i class="bi bi-camera-video me-1"></i> Join
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-custom mb-0" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px;">
                <h6 class="fw-bold mb-3 text-main">Quick Actions</h6>
                <div class="d-flex flex-column gap-2">
                    <button class="btn btn-outline-primary w-100 text-start d-flex align-items-center justify-content-between p-2"
                            style="border-color: var(--accent-color); color: var(--accent-color);">
                        <span><i class="bi bi-plus me-2"></i> Schedule Session</span>
                        <i class="bi bi-chevron-right small"></i>
                    </button>

                    <button class="btn btn-outline-secondary w-100 text-start d-flex align-items-center justify-content-between p-2">
                        <span><i class="bi bi-list-ul me-2"></i> View All Sessions</span>
                        <i class="bi bi-chevron-right small"></i>
                    </button>

                    <button class="btn btn-outline-secondary w-100 text-start d-flex align-items-center justify-content-between p-2">
                        <span><i class="bi bi-clock me-2"></i> Set Availability</span>
                        <i class="bi bi-chevron-right small"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>

@endsection
