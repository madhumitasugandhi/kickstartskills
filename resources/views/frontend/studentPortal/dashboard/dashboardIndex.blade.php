@extends('frontend.studentPortal.dashboard.layouts.app')
@section('content')
        <div class="content-body">

            <!-- SECTION 1: Progress Overview -->
            <div class="card-custom">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <i class="bi bi-graph-up-arrow text-primary"></i>
                    <h6 class="fw-bold m-0 text-main">Progress Overview</h6>
                </div>
                <div class="bg-soft-blue p-3 rounded-4 mb-3 d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-3">
                        <div class="card-custom border-0 d-flex align-items-center justify-content-center mb-0 p-0"
                            style="width: 40px; height: 40px; min-width: 40px;">
                            <i class="bi bi-clock fs-5 text-primary"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1" style="color: var(--text-blue); font-size: 0.95rem;">Current Phase:
                                Learning & Development</h6>
                            <small class="text-muted-custom" style="font-size: 0.75rem;">Day 23 of 45 • 22 days
                                remaining</small>
                        </div>
                    </div>
                    <div class="spinner-border text-primary d-none d-md-block spinner-border-sm" role="status"></div>
                </div>
                <div class="row g-4 mb-3">
                    <div class="col-md-4">
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-muted-custom">Flutter Development</span>
                            <span class="fw-bold text-primary">75%</span>
                        </div>
                        <div class="progress" style="background-color: var(--bg-hover); height: 8px;">
                            <div class="progress-bar bg-primary" style="width: 75%"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-muted-custom">UI/UX Design</span>
                            <span class="fw-bold text-success">60%</span>
                        </div>
                        <div class="progress" style="background-color: var(--bg-hover); height: 8px;">
                            <div class="progress-bar bg-success" style="width: 60%"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-muted-custom">Project Management</span>
                            <span class="fw-bold text-warning">45%</span>
                        </div>
                        <div class="progress" style="background-color: var(--bg-hover); height: 8px;">
                            <div class="progress-bar bg-warning" style="width: 45%"></div>
                        </div>
                    </div>
                </div>
                <div class="border-top pt-3" style="border-color: var(--border-color) !important;">
                    <div class="d-flex justify-content-between small mb-1 fw-bold">
                        <span class="text-main">Overall Completion</span>
                        <span class="text-primary">60%</span>
                    </div>
                    <div class="progress" style="height: 10px; background-color: var(--bg-hover);">
                        <div class="progress-bar bg-primary" style="width: 60%"></div>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: Grid 1 - Actions & Tasks -->
            <div class="row g-4 mb-4">
                <!-- Quick Actions -->
                <div class="col-lg-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <i class="bi bi-lightning-charge text-primary"></i>
                        <h6 class="fw-bold m-0 text-main">Quick Actions</h6>
                    </div>
                    <div class="row g-2">
                        <div class="col-6">
                            <button class="btn-quick-action m-0 h-100">
                                <div class="action-icon bg-soft-green mb-2"><i class="bi bi-check-circle"></i></div>
                                <span class="fw-bold text-main d-block">Mark Attendance</span>
                            </button>
                        </div>
                        <div class="col-6">
                            <button class="btn-quick-action m-0 h-100">
                                <div class="action-icon bg-soft-blue mb-2"><i class="bi bi-upload"></i></div>
                                <span class="fw-bold text-main d-block">Submit Assignment</span>
                            </button>
                        </div>
                        <div class="col-6">
                            <button class="btn-quick-action m-0 h-100">
                                <div class="action-icon bg-soft-orange mb-2"><i class="bi bi-calendar-plus"></i></div>
                                <span class="fw-bold text-main d-block">Schedule Meeting</span>
                            </button>
                        </div>
                        <div class="col-6">
                            <button class="btn-quick-action m-0 h-100">
                                <div class="action-icon bg-soft-teal mb-2"><i class="bi bi-book"></i></div>
                                <span class="fw-bold text-main d-block">Access Resources</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Tasks -->
                <div class="col-lg-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <i class="bi bi-hourglass-split text-warning"></i>
                        <h6 class="fw-bold m-0 text-main">Upcoming Tasks & Deadlines</h6>
                    </div>
                    <div class="task-card bg-soft-red border-danger">
                        <div class="text-danger mt-1"><i class="bi bi-file-earmark-text"></i></div>
                        <div>
                            <div class="fw-bold text-main">Flutter UI Assignment</div>
                            <small class="text-danger fw-bold" style="font-size: 0.75rem;">Assignment • Due:
                                Tomorrow</small>
                        </div>
                    </div>
                    <div class="task-card bg-soft-orange border-warning">
                        <div class="text-warning mt-1"><i class="bi bi-clipboard-data"></i></div>
                        <div>
                            <div class="fw-bold text-main">Database Design Exam</div>
                            <small class="text-warning fw-bold" style="font-size: 0.75rem;">Exam • Due: Oct 30</small>
                        </div>
                    </div>
                    <div class="task-card bg-soft-green border-success">
                        <div class="text-success mt-1"><i class="bi bi-people"></i></div>
                        <div>
                            <div class="fw-bold text-main">Mentor 1:1 Meeting</div>
                            <small class="text-success fw-bold" style="font-size: 0.75rem;">Meeting • Due: Nov 2</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 3: Grid 2 - Metrics & Courses -->
            <div class="row g-4 mb-4">

                <!-- Performance Metrics -->
                <div class="col-lg-6">
                    <div class="card-custom h-100">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="bi bi-bar-chart-line text-success"></i>
                            <h6 class="fw-bold m-0 text-main">Performance Metrics</h6>
                        </div>

                        <div class="metric-item bg-soft-blue border border-primary-subtle">
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-award text-primary"></i>
                                <span class="fw-medium text-main">Exam Scores</span>
                            </div>
                            <span class="fw-bold text-primary">85%</span>
                        </div>

                        <div class="metric-item bg-soft-green border border-success-subtle">
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-file-text text-success"></i>
                                <span class="fw-medium text-main">Assignment Grades</span>
                            </div>
                            <span class="fw-bold text-success">92%</span>
                        </div>

                        <div class="metric-item bg-soft-teal border border-info-subtle">
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-check-circle text-info"></i>
                                <span class="fw-medium text-main">Attendance</span>
                            </div>
                            <span class="fw-bold text-info">96%</span>
                        </div>

                        <div class="metric-item bg-soft-orange border border-warning-subtle mb-0">
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-star text-warning"></i>
                                <span class="fw-medium text-main">Mentor Feedback</span>
                            </div>
                            <span class="fw-bold text-warning">4.8/5</span>
                        </div>
                    </div>
                </div>

                <!-- Course Recommendations -->
                <div class="col-lg-6">
                    <div class="card-custom h-100">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="bi bi-bookmark text-primary"></i>
                            <h6 class="fw-bold m-0 text-main">Course Recommendations</h6>
                        </div>

                        <!-- Course 1 -->
                        <div class="course-card bg-soft-blue border border-primary-subtle">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="fw-bold text-main m-0" style="font-size: 0.9rem;">Advanced Flutter Patterns
                                </h6>
                                <span class="badge bg-primary rounded-pill" style="font-size: 0.65rem;">AI
                                    Suggested</span>
                            </div>
                            <div class="d-flex align-items-center gap-3 text-muted-custom small"
                                style="font-size: 0.75rem;">
                                <span><i class="bi bi-people me-1"></i> 142 students</span>
                                <span><i class="bi bi-star-fill text-warning me-1"></i> 4.9</span>
                            </div>
                        </div>

                        <!-- Course 2 -->
                        <div class="course-card bg-soft-green border border-success-subtle">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="fw-bold text-main m-0" style="font-size: 0.9rem;">UI/UX Design Principles
                                </h6>
                                <span class="badge bg-success rounded-pill" style="font-size: 0.65rem;">Skill Gap</span>
                            </div>
                            <div class="d-flex align-items-center gap-3 text-muted-custom small"
                                style="font-size: 0.75rem;">
                                <span><i class="bi bi-people me-1"></i> 89 students</span>
                                <span><i class="bi bi-star-fill text-warning me-1"></i> 4.7</span>
                            </div>
                        </div>

                        <!-- Course 3 -->
                        <div class="course-card bg-soft-orange border border-warning-subtle mb-0">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="fw-bold text-main m-0" style="font-size: 0.9rem;">Project Management Basics
                                </h6>
                                <span class="badge bg-warning text-dark rounded-pill"
                                    style="font-size: 0.65rem;">Popular</span>
                            </div>
                            <div class="d-flex align-items-center gap-3 text-muted-custom small"
                                style="font-size: 0.75rem;">
                                <span><i class="bi bi-people me-1"></i> 203 students</span>
                                <span><i class="bi bi-star-fill text-warning me-1"></i> 4.8</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 4: Notification Center -->
            <div class="card-custom">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-bell text-primary"></i>
                        <h6 class="fw-bold m-0 text-main">Notification Center</h6>
                    </div>
                    <a href="#" class="text-primary text-decoration-none small fw-bold" style="font-size: 0.8rem;">View
                        All</a>
                </div>

                <div class="notification-item bg-soft-blue">
                    <div class="p-2 bg-white rounded-circle text-primary d-flex align-items-center justify-content-center"
                        style="width: 32px; height: 32px;"><i class="bi bi-file-earmark-text"></i></div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between">
                            <span class="fw-semibold text-main" style="font-size: 0.85rem;">New assignment posted in
                                Flutter Development</span>
                            <span class="text-primary small"><i class="bi bi-circle-fill"
                                    style="font-size: 6px;"></i></span>
                        </div>
                        <small class="text-muted-custom" style="font-size: 0.75rem;">2 hours ago</small>
                    </div>
                </div>

                <div class="notification-item bg-soft-green">
                    <div class="p-2 bg-white rounded-circle text-success d-flex align-items-center justify-content-center"
                        style="width: 32px; height: 32px;"><i class="bi bi-chat-quote"></i></div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between">
                            <span class="fw-semibold text-main" style="font-size: 0.85rem;">Mentor feedback available
                                for last project</span>
                            <span class="text-primary small"><i class="bi bi-circle-fill"
                                    style="font-size: 6px;"></i></span>
                        </div>
                        <small class="text-muted-custom" style="font-size: 0.75rem;">1 day ago</small>
                    </div>
                </div>

                <div class="notification-item bg-soft-orange">
                    <div class="p-2 bg-white rounded-circle text-warning d-flex align-items-center justify-content-center"
                        style="width: 32px; height: 32px;"><i class="bi bi-bell"></i></div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between">
                            <span class="fw-semibold text-main" style="font-size: 0.85rem;">Reminder: Database exam
                                scheduled for tomorrow</span>
                        </div>
                        <small class="text-muted-custom" style="font-size: 0.75rem;">2 days ago</small>
                    </div>
                </div>

                <div class="notification-item bg-soft-teal mb-0">
                    <div class="p-2 bg-white rounded-circle text-info d-flex align-items-center justify-content-center"
                        style="width: 32px; height: 32px;"><i class="bi bi-award"></i></div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between">
                            <span class="fw-semibold text-main" style="font-size: 0.85rem;">Congratulations! You
                                completed Phase 1</span>
                        </div>
                        <small class="text-muted-custom" style="font-size: 0.75rem;">1 week ago</small>
                    </div>
                </div>
            </div>

        </div>
@endsection
