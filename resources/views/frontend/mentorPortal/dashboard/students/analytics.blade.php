@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Student Analytics')
@section('icon', 'bi bi-bar-chart-line fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')

<div class="card-custom mb-4" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px;">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold text-main mb-1">Student Analytics</h4>
            <p class="text-muted-custom mb-0 small">Comprehensive performance insights and trends</p>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-6">
            <label class="form-label small text-muted-custom fw-bold">Time Period</label>
            <div class="btn-group w-100 w-md-auto d-flex flex-wrap" role="group">
                <input type="radio" class="btn-check" name="timePeriod" id="tpWeek">
                <label class="btn btn-outline-secondary btn-sm flex-grow-1 flex-md-grow-0" for="tpWeek">This Week</label>

                <input type="radio" class="btn-check" name="timePeriod" id="tpMonth" checked>
                <label class="btn btn-outline-secondary btn-sm flex-grow-1 flex-md-grow-0" for="tpMonth">This Month</label>

                <input type="radio" class="btn-check" name="timePeriod" id="tp3Months">
                <label class="btn btn-outline-secondary btn-sm flex-grow-1 flex-md-grow-0" for="tp3Months">Last 3 Months</label>

                <input type="radio" class="btn-check" name="timePeriod" id="tpYear">
                <label class="btn btn-outline-secondary btn-sm flex-grow-1 flex-md-grow-0" for="tpYear">This Year</label>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="d-flex flex-column align-items-start align-items-lg-end">
                <label class="form-label small text-muted-custom fw-bold text-start text-lg-end w-100">Metric Type</label>
                <div class="btn-group w-100 w-md-auto d-flex flex-wrap" role="group">
                    <input type="radio" class="btn-check" name="metricType" id="mtOverall" checked>
                    <label class="btn btn-outline-primary btn-sm flex-grow-1 flex-md-grow-0" for="mtOverall">Overall</label>

                    <input type="radio" class="btn-check" name="metricType" id="mtAttendance">
                    <label class="btn btn-outline-secondary btn-sm flex-grow-1 flex-md-grow-0" for="mtAttendance">Attendance</label>

                    <input type="radio" class="btn-check" name="metricType" id="mtTasks">
                    <label class="btn btn-outline-secondary btn-sm flex-grow-1 flex-md-grow-0" for="mtTasks">Tasks</label>

                    <input type="radio" class="btn-check" name="metricType" id="mtSkills">
                    <label class="btn btn-outline-secondary btn-sm flex-grow-1 flex-md-grow-0" for="mtSkills">Skills</label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 g-md-4 mb-4">
    <div class="col-6 col-xl-3">
        <div class="card-custom text-center py-4 mb-0 h-100 position-relative overflow-hidden" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px;">
            <span class="badge bg-soft-green text-green position-absolute top-0 end-0 m-2 m-md-3 small">+4%</span>
            <div class="mb-3">
                <i class="bi bi-graph-up-arrow fs-3 text-success"></i>
            </div>
            <h3 class="fw-bold text-success mb-1">86%</h3>
            <span class="text-muted-custom small fw-medium">Average Performance</span>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="card-custom text-center py-4 mb-0 h-100 position-relative overflow-hidden" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px;">
            <span class="badge bg-soft-green text-green position-absolute top-0 end-0 m-2 m-md-3 small">+2%</span>
            <div class="mb-3">
                <i class="bi bi-check2-circle fs-3 text-primary"></i>
            </div>
            <h3 class="fw-bold text-primary mb-1">89%</h3>
            <span class="text-muted-custom small fw-medium">Completion Rate</span>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="card-custom text-center py-4 mb-0 h-100 position-relative overflow-hidden" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px;">
            <span class="badge bg-soft-green text-green position-absolute top-0 end-0 m-2 m-md-3 small">+8%</span>
            <div class="mb-3">
                <i class="bi bi-activity fs-3 text-accent"></i>
            </div>
            <h3 class="fw-bold text-accent mb-1">High</h3>
            <span class="text-muted-custom small fw-medium">Engagement Level</span>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="card-custom text-center py-4 mb-0 h-100 position-relative overflow-hidden" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px;">
            <span class="badge bg-soft-red text-red position-absolute top-0 end-0 m-2 m-md-3 small">-2</span>
            <div class="mb-3">
                <i class="bi bi-exclamation-triangle fs-3 text-warning"></i>
            </div>
            <h3 class="fw-bold text-warning mb-1">1</h3>
            <span class="text-muted-custom small fw-medium">Students at Risk</span>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card-custom h-100 mb-0" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px;">
            <h6 class="fw-bold text-main mb-4">Performance Trends - Overall Performance</h6>

            <div class="bg-soft-blue rounded-3 d-flex align-items-end justify-content-between px-4 pb-0 pt-5 position-relative"
                style="height: 300px; overflow: hidden; width: 100%;">

                <div class="position-absolute w-100 h-100 start-0 top-0 d-flex flex-column justify-content-between text-muted-custom small p-3"
                    style="opacity: 0.3; z-index: 0; pointer-events: none;">
                    <div class="border-bottom w-100">100%</div>
                    <div class="border-bottom w-100">80%</div>
                    <div class="border-bottom w-100">60%</div>
                    <div class="border-bottom w-100">40%</div>
                    <div class="border-bottom w-100">20%</div>
                    <div class="w-100">0%</div>
                </div>

                <svg viewBox="0 0 800 250" preserveAspectRatio="none" class="position-absolute start-0 top-0 w-100 h-100 p-3" style="z-index: 1;">
                    <polyline points="0,200 150,190 300,180 450,175 600,170 800,160" fill="none"
                        stroke="var(--text-blue)" stroke-width="3" />
                    <circle cx="0" cy="200" r="4" fill="var(--text-blue)" />
                    <circle cx="150" cy="190" r="4" fill="var(--text-blue)" />
                    <circle cx="300" cy="180" r="4" fill="var(--text-blue)" />
                    <circle cx="450" cy="175" r="4" fill="var(--text-blue)" />
                    <circle cx="600" cy="170" r="4" fill="var(--text-blue)" />
                    <circle cx="800" cy="160" r="4" fill="var(--text-blue)" />
                </svg>

                <div class="w-100 d-flex justify-content-between position-relative"
                    style="z-index: 2; margin-bottom: -2px;">
                    <small class="text-muted-custom">Week 1</small>
                    <small class="text-muted-custom">Week 2</small>
                    <small class="text-muted-custom">Week 3</small>
                    <small class="text-muted-custom">Week 4</small>
                    <small class="text-muted-custom">Week 5</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card-custom h-100 mb-0" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px;">
            <h6 class="fw-bold text-main mb-4">Top Performers</h6>

            <div class="d-flex flex-column gap-3">
                <div class="d-flex align-items-center gap-3 p-2 rounded bg-soft-green border border-success-subtle">
                    <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                        style="width: 32px; height: 32px; font-size: 0.8rem;">1</div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="fw-bold text-main small">Sarah Wilson</span>
                            <span class="fw-bold text-success small">96%</span>
                        </div>
                        <small class="text-success d-block" style="font-size: 0.7rem;">Outstanding</small>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3 p-2 rounded bg-soft-blue border border-primary-subtle">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                        style="width: 32px; height: 32px; font-size: 0.8rem;">2</div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="fw-bold text-main small">Jane Smith</span>
                            <span class="fw-bold text-primary small">92%</span>
                        </div>
                        <small class="text-primary d-block" style="font-size: 0.7rem;">Excellent</small>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3 p-2 rounded bg-soft-orange border border-warning-subtle">
                    <div class="rounded-circle bg-warning text-dark d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                        style="width: 32px; height: 32px; font-size: 0.8rem;">3</div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="fw-bold text-main small">Alex Chen</span>
                            <span class="fw-bold text-accent small">88%</span>
                        </div>
                        <small class="text-accent d-block" style="font-size: 0.7rem;">Very Good</small>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3 p-2 rounded bg-bg-hover">
                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                        style="width: 32px; height: 32px; font-size: 0.8rem;">4</div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="fw-bold text-main small">John Doe</span>
                            <span class="fw-bold text-info small">85%</span>
                        </div>
                        <small class="text-muted-custom d-block" style="font-size: 0.7rem;">Good</small>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3 p-2 rounded bg-bg-hover">
                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                        style="width: 32px; height: 32px; font-size: 0.8rem;">5</div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="fw-bold text-main small">Mike Johnson</span>
                            <span class="fw-bold text-warning small">78%</span>
                        </div>
                        <small class="text-muted-custom d-block" style="font-size: 0.7rem;">Good</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card-custom h-100 mb-0" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px;">
            <h6 class="fw-bold text-main mb-4">Skill Performance Analysis</h6>

            <div class="d-flex flex-column gap-4">
                <div>
                    <div class="d-flex justify-content-between small mb-1">
                        <div>
                            <span class="fw-bold text-main">Flutter Development</span>
                            <small class="text-muted-custom d-block">5 students</small>
                        </div>
                        <span class="fw-bold text-primary">85%</span>
                    </div>
                    <div class="progress" style="height: 8px; background-color: var(--bg-hover);">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 85%"></div>
                    </div>
                </div>

                <div>
                    <div class="d-flex justify-content-between small mb-1">
                        <div>
                            <span class="fw-bold text-main">React Development</span>
                            <small class="text-muted-custom d-block">3 students</small>
                        </div>
                        <span class="fw-bold text-success">92%</span>
                    </div>
                    <div class="progress" style="height: 8px; background-color: var(--bg-hover);">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 92%"></div>
                    </div>
                </div>

                <div>
                    <div class="d-flex justify-content-between small mb-1">
                        <div>
                            <span class="fw-bold text-main">Python Programming</span>
                            <small class="text-muted-custom d-block">4 students</small>
                        </div>
                        <span class="fw-bold text-primary">78%</span>
                    </div>
                    <div class="progress" style="height: 8px; background-color: var(--bg-hover);">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 78%"></div>
                    </div>
                </div>

                <div>
                    <div class="d-flex justify-content-between small mb-1">
                        <div>
                            <span class="fw-bold text-main">UI/UX Design</span>
                            <small class="text-muted-custom d-block">2 students</small>
                        </div>
                        <span class="fw-bold text-accent">82%</span>
                    </div>
                    <div class="progress" style="height: 8px; background-color: var(--bg-hover);">
                        <div class="progress-bar bg-soft-orange" role="progressbar"
                            style="width: 82%; background-color: var(--accent-color) !important;"></div>
                    </div>
                </div>

                <div>
                    <div class="d-flex justify-content-between small mb-1">
                        <div>
                            <span class="fw-bold text-main">Machine Learning</span>
                            <small class="text-muted-custom d-block">1 student</small>
                        </div>
                        <span class="fw-bold text-danger">88%</span>
                    </div>
                    <div class="progress" style="height: 8px; background-color: var(--bg-hover);">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 88%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card-custom h-100 mb-0" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px;">
            <h6 class="fw-bold text-main mb-4">Phase Distribution</h6>

            <div class="mt-2">
                <div class="d-flex justify-content-between small mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <span class="d-inline-block rounded-circle"
                            style="width: 8px; height: 8px; background-color: var(--text-blue);"></span>
                        <span class="text-muted-custom">Foundation Phase</span>
                    </div>
                    <span class="fw-bold text-main">50%</span>
                </div>
                <div class="d-flex justify-content-between small mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <span class="d-inline-block rounded-circle"
                            style="width: 8px; height: 8px; background-color: var(--accent-color);"></span>
                        <span class="text-muted-custom">Advanced Learning</span>
                    </div>
                    <span class="fw-bold text-main">20%</span>
                </div>
                <div class="d-flex justify-content-between small mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <span class="d-inline-block rounded-circle"
                            style="width: 8px; height: 8px; background-color: var(--text-teal);"></span>
                        <span class="text-muted-custom">Mini-Project Phase</span>
                    </div>
                    <span class="fw-bold text-main">20%</span>
                </div>
                <div class="d-flex justify-content-between small">
                    <div class="d-flex align-items-center gap-2">
                        <span class="d-inline-block rounded-circle mb-4"
                            style="width: 8px; height: 8px; background-color: #20c997;"></span>
                        <span class="text-muted-custom mb-4">Client Project Phase</span>
                    </div>
                    <span class="fw-bold text-main mb-4">10%</span>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-center mt-2" style="min-height: 120px;">
                <div class="rounded-circle position-relative d-flex align-items-center justify-content-center" style="width: 180px; height: 180px;
                                background: conic-gradient(
                                    var(--text-blue) 0% 50%,
                                    var(--text-teal) 50% 70%,
                                    var(--accent-color) 70% 90%,
                                    #20c997 90% 100%
                                );">
                    <div class="bg-card rounded-circle"
                        style="width: 100px; height: 100px; position: absolute; background-color: var(--bg-card); text-align: center; padding-top: 40px;">%
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
