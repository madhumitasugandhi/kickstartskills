@extends('frontend.hrPortal.dashboard.layouts.app')

@section('title', 'Dashboard')

@section('icon', 'bi bi-house-door fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')
<style>
    /* --- Dashboard Specific Styles --- */
    .card-stat {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        display: flex; flex-direction: column;
        justify-content: space-between;
        height: 100%;
        transition: transform 0.2s;
    }
    .card-stat:hover { transform: translateY(-3px); }

    .icon-box {
        width: 48px; height: 48px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 16px;
    }

    /* --- FIXED: Recruitment Pipeline Chart --- */
    .pipeline-chart {
        display: flex;
        justify-content: space-around;
        align-items: flex-end; /* Align bars to bottom */
        height: 220px; /* Fixed height for the chart area */
        padding-top: 20px;
        padding-bottom: 10px;
    }

    .bar-container {
        display: flex;
        flex-direction: column;
        justify-content: flex-end; /* Push bar to bottom */
        align-items: center;
        gap: 8px;
        height: 100%; /* Important: Occupy full height of chart area */
        width: 100%;
    }

    .bar {
        width: 12px; /* Slightly wider for visibility */
        border-radius: 10px 10px 0 0; /* Rounded top only */
        transition: height 1s ease;
        position: relative;
        min-height: 4px; /* Ensure tiny bars are visible */
    }

    /* Chart Colors & Glows */
    .bar-blue { background-color: #3b82f6; box-shadow: 0 0 12px rgba(59, 130, 246, 0.4); }
    .bar-purple { background-color: #8b5cf6; box-shadow: 0 0 12px rgba(139, 92, 246, 0.4); }
    .bar-orange { background-color: #f59e0b; box-shadow: 0 0 12px rgba(245, 158, 11, 0.4); }
    .bar-green { background-color: #10b981; box-shadow: 0 0 12px rgba(16, 185, 129, 0.4); }
    .bar-teal { background-color: #14b8a6; box-shadow: 0 0 12px rgba(20, 184, 166, 0.4); }

    /* --- Employee Overview Donut --- */
    .donut-chart {
        width: 140px; height: 140px;
        border-radius: 50%;
        background: conic-gradient(
            #7c3aed 0% 76%,   /* Full time */
            #3b82f6 76% 90%,  /* Part time */
            #f59e0b 90% 97%,  /* Contract */
            #10b981 97% 100%  /* Intern */
        );
        position: relative;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto; /* Center in col */
    }
    /* Inner hole */
    .donut-chart::after {
        content: "";
        position: absolute;
        width: 100px; height: 100px;
        border-radius: 50%;
        background-color: var(--bg-card);
    }

    .legend-dot { width: 10px; height: 10px; border-radius: 50%; display: inline-block; margin-right: 8px; }
</style>

<div class="card mb-4 border-0 shadow-sm" style="background: linear-gradient(135deg, #7c3aed 0%, #4c1d95 100%); border-radius: 12px;">
    <div class="card-body p-4 text-white d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-3 bg-white bg-opacity-10 p-3 d-flex align-items-center justify-content-center">
                <i class="bi bi-person-workspace fs-1"></i>
            </div>
            <div>
                <h3 class="fw-bold mb-1">Welcome back, HR Manager!</h3>
                <p class="mb-0 opacity-75">Here's your organization overview for today.</p>
                <small class="opacity-50">17/12/2025</small>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-12 col-md-6 col-xl-3">
        <div class="card-stat">
            <div class="d-flex justify-content-between">
                <div class="icon-box text-accent" style="background-color: var(--soft-accent)">
                    <i class="bi bi-people-fill"></i>
                </div>
                <span class="badge bg-success bg-opacity-10 text-success h-75 d-flex align-items-center gap-1">
                    <i class="bi bi-graph-up-arrow"></i> +12
                </span>
            </div>
            <div>
                <h3 class="fw-bold mb-1 text-main">247</h3>
                <small class="text-muted-custom">Total Employees</small>
                <small class="text-success d-block mt-1" style="font-size: 0.75rem;">+12 this month</small>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
        <div class="card-stat">
            <div class="d-flex justify-content-between">
                <div class="icon-box bg-soft-blue text-blue">
                    <i class="bi bi-briefcase-fill"></i>
                </div>
                <span class="badge bg-primary bg-opacity-10 text-primary h-75 d-flex align-items-center gap-1">
                    <i class="bi bi-plus"></i> 5
                </span>
            </div>
            <div>
                <h3 class="fw-bold mb-1 text-main">18</h3>
                <small class="text-muted-custom">Active Recruitments</small>
                <small class="text-blue d-block mt-1" style="font-size: 0.75rem;">+5 new positions</small>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
        <div class="card-stat">
            <div class="d-flex justify-content-between">
                <div class="icon-box bg-soft-green text-green">
                    <i class="bi bi-file-earmark-text-fill"></i>
                </div>
                <span class="badge bg-success bg-opacity-10 text-success h-75 d-flex align-items-center gap-1">
                    <i class="bi bi-arrow-up"></i> 23
                </span>
            </div>
            <div>
                <h3 class="fw-bold mb-1 text-main">156</h3>
                <small class="text-muted-custom">Applications</small>
                <small class="text-green d-block mt-1" style="font-size: 0.75rem;">+23 today</small>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
        <div class="card-stat">
            <div class="d-flex justify-content-between">
                <div class="icon-box bg-soft-orange text-accent" style="color: #f59e0b !important; background-color: rgba(245, 158, 11, 0.15) !important;">
                    <i class="bi bi-calendar-event-fill"></i>
                </div>
                <span class="badge bg-success bg-opacity-10 text-success h-50 d-flex align-items-center">8 this week</span>
            </div>
            <div>
                <h3 class="fw-bold mb-1 text-main">34</h3>
                <small class="text-muted-custom">Interviews Scheduled</small>
                <small class="d-block mt-1" style="font-size: 0.75rem; color: #f59e0b;">Next: 2:00 PM</small>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">

    <div class="col-12 col-lg-8">

        <div class="card-custom mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold m-0 text-main">Recruitment Pipeline</h5>
                <span class="badge bg-soft-accent text-accent">This Month</span>
            </div>

            <div class="pipeline-chart">
                <div class="bar-container">
                    <div class="bar bar-blue" style="height: 100%;"></div>
                    <div class="text-center mt-2">
                        <div class="fw-bold text-main">85</div>
                        <small class="text-muted-custom" style="font-size: 0.7rem;">Applied</small>
                    </div>
                </div>
                <div class="bar-container">
                    <div class="bar bar-purple" style="height: 70%;"></div>
                    <div class="text-center mt-2">
                        <div class="fw-bold text-main">62</div>
                        <small class="text-muted-custom" style="font-size: 0.7rem;">Screening</small>
                    </div>
                </div>
                <div class="bar-container">
                    <div class="bar bar-orange" style="height: 50%;"></div>
                    <div class="text-center mt-2">
                        <div class="fw-bold text-main">45</div>
                        <small class="text-muted-custom" style="font-size: 0.7rem;">Interview</small>
                    </div>
                </div>
                <div class="bar-container">
                    <div class="bar bar-green" style="height: 35%;"></div>
                    <div class="text-center mt-2">
                        <div class="fw-bold text-main">28</div>
                        <small class="text-muted-custom" style="font-size: 0.7rem;">Offer</small>
                    </div>
                </div>
                <div class="bar-container">
                    <div class="bar bar-teal" style="height: 25%;"></div>
                    <div class="text-center mt-2">
                        <div class="fw-bold text-main">18</div>
                        <small class="text-muted-custom" style="font-size: 0.7rem;">Hired</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-custom mb-0">
            <h5 class="fw-bold mb-4 text-main">Employee Overview</h5>
            <div class="row align-items-center">
                <div class="col-md-5 d-flex justify-content-center mb-4 mb-md-0">
                    <div class="donut-chart"></div>
                </div>
                <div class="col-md-7">
                    <div class="d-flex justify-content-between mb-3 align-items-center">
                        <div>
                            <span class="legend-dot" style="background-color: #7c3aed;"></span>
                            <span class="text-muted-custom small">Full-time</span>
                        </div>
                        <span class="fw-bold text-main">189</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 align-items-center">
                        <div>
                            <span class="legend-dot" style="background-color: #3b82f6;"></span>
                            <span class="text-muted-custom small">Part-time</span>
                        </div>
                        <span class="fw-bold text-main">34</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 align-items-center">
                        <div>
                            <span class="legend-dot" style="background-color: #f59e0b;"></span>
                            <span class="text-muted-custom small">Contract</span>
                        </div>
                        <span class="fw-bold text-main">18</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="legend-dot" style="background-color: #10b981;"></span>
                            <span class="text-muted-custom small">Intern</span>
                        </div>
                        <span class="fw-bold text-main">6</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-12 col-lg-4">

        <div class="card-custom mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold m-0 text-main">Recent Activities</h6>
                <a href="#" class="text-accent text-decoration-none small">View All</a>
            </div>

            <div class="d-flex gap-3 mb-3">
                <div class="rounded-circle bg-soft-green d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px;">
                    <i class="bi bi-person-plus text-green"></i>
                </div>
                <div class="overflow-hidden">
                    <h6 class="mb-0 small fw-bold text-main text-truncate">New Application Received</h6>
                    <small class="text-muted-custom d-block text-truncate" style="font-size: 0.75rem;">Software Engineer - Sarah J.</small>
                    <small class="text-muted-custom opacity-75" style="font-size: 0.7rem;">2 mins ago</small>
                </div>
            </div>

            <div class="d-flex gap-3 mb-3">
                <div class="rounded-circle bg-soft-blue d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px;">
                    <i class="bi bi-calendar-event text-blue"></i>
                </div>
                <div class="overflow-hidden">
                    <h6 class="mb-0 small fw-bold text-main text-truncate">Interview Scheduled</h6>
                    <small class="text-muted-custom d-block text-truncate" style="font-size: 0.75rem;">Marketing Mgr - David Chen</small>
                    <small class="text-muted-custom opacity-75" style="font-size: 0.7rem;">15 mins ago</small>
                </div>
            </div>

            <div class="d-flex gap-3 mb-3">
                <div class="rounded-circle bg-soft-accent d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px;">
                    <i class="bi bi-check-circle text-accent"></i>
                </div>
                <div class="overflow-hidden">
                    <h6 class="mb-0 small fw-bold text-main text-truncate">Employee Onboarded</h6>
                    <small class="text-muted-custom d-block text-truncate" style="font-size: 0.75rem;">UX Designer - Emma Wilson</small>
                    <small class="text-muted-custom opacity-75" style="font-size: 0.7rem;">1 hour ago</small>
                </div>
            </div>

            <div class="d-flex gap-3">
                <div class="rounded-circle bg-soft-orange d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px; background-color: rgba(245, 158, 11, 0.15); color: #f59e0b;">
                    <i class="bi bi-star"></i>
                </div>
                <div class="overflow-hidden">
                    <h6 class="mb-0 small fw-bold text-main text-truncate">Performance Review Due</h6>
                    <small class="text-muted-custom d-block text-truncate" style="font-size: 0.75rem;">5 employees this week</small>
                    <small class="text-muted-custom opacity-75" style="font-size: 0.7rem;">2 hours ago</small>
                </div>
            </div>
        </div>

        <div class="card-custom mb-0">
            <h6 class="fw-bold mb-3 text-main">Quick Actions</h6>
            <div class="d-grid gap-2">
                <button class="btn btn-quick-action">
                    <div class="action-icon bg-soft-accent text-accent">
                        <i class="bi bi-plus-lg"></i>
                    </div>
                    <div class="flex-grow-1">
                        <span class="d-block fw-bold text-main small">Post New Job</span>
                    </div>
                    <i class="bi bi-chevron-right small text-muted-custom"></i>
                </button>

                <button class="btn btn-quick-action">
                    <div class="action-icon bg-soft-blue text-blue">
                        <i class="bi bi-calendar-plus"></i>
                    </div>
                    <div class="flex-grow-1">
                        <span class="d-block fw-bold text-main small">Schedule Interview</span>
                    </div>
                    <i class="bi bi-chevron-right small text-muted-custom"></i>
                </button>

                <button class="btn btn-quick-action">
                    <div class="action-icon bg-soft-green text-green">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <div class="flex-grow-1">
                        <span class="d-block fw-bold text-main small">Employee Reports</span>
                    </div>
                    <i class="bi bi-chevron-right small text-muted-custom"></i>
                </button>

                <button class="btn btn-quick-action">
                    <div class="action-icon bg-soft-orange" style="background-color: rgba(245, 158, 11, 0.15); color: #f59e0b;">
                        <i class="bi bi-megaphone"></i>
                    </div>
                    <div class="flex-grow-1">
                        <span class="d-block fw-bold text-main small">Send Announcement</span>
                    </div>
                    <i class="bi bi-chevron-right small text-muted-custom"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
