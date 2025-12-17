@extends('frontend.hrPortal.dashboard.layouts.app')

@section('title', 'Employee Management')

@section('icon', 'bi bi-people-fill fs-4 p-2 bg-soft-accent rounded-3 text-accent')

@section('content')
<style>
    /* --- Page Specific Styles --- */

    /* Stats Cards */
    .stat-card-employee {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        text-align: center;
        transition: transform 0.2s;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .stat-card-employee:hover {
        transform: translateY(-3px);
    }

    .stat-icon {
        font-size: 1.5rem;
        margin-bottom: 8px;
    }

    /* Stats Colors */
    .stat-green {
        color: #10b981;
        border-bottom: 3px solid #10b981;
    }

    .stat-orange {
        color: #f59e0b;
        border-bottom: 3px solid #f59e0b;
    }

    .stat-purple {
        color: #8b5cf6;
        border-bottom: 3px solid #8b5cf6;
    }

    .stat-blue {
        color: #3b82f6;
        border-bottom: 3px solid #3b82f6;
    }

    /* Filter Bar */
    .filter-container {
        background-color: var(--bg-card);
        padding: 16px;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
        align-items: center;
    }

    .search-input {
        background-color: var(--bg-body);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        padding: 10px 16px;
        border-radius: 8px;
        flex-grow: 1;
        min-width: 200px;
    }

    .filter-select {
        background-color: var(--bg-body);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        padding: 10px 16px;
        border-radius: 8px;
        min-width: 140px;
    }

    .btn-add {
        background-color: var(--bg-body);
        border: 1px solid var(--border-color);
        color: var(--accent-color);
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: 0.2s;
    }

    .btn-add:hover {
        background-color: var(--accent-color);
        color: white;
        border-color: var(--accent-color);
    }

    /* Employee Card */
    .employee-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        transition: all 0.2s;
    }

    .employee-card:hover {
        border-color: var(--accent-color);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .avatar-lg {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        font-weight: bold;
        background-color: var(--bg-body);
        color: var(--text-main);
        border: 2px solid var(--border-color);
    }

    .skill-pill {
        font-size: 0.7rem;
        padding: 4px 12px;
        border-radius: 20px;
        background-color: rgba(124, 58, 237, 0.1);
        color: var(--accent-color);
        border: 1px solid rgba(124, 58, 237, 0.2);
    }

    /* Utility for Badge */
    .bg-soft-purple-custom {
        background-color: rgba(139, 92, 246, 0.15);
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4 filter-container">
    <h5 class="fw-bold m-0 text-main">Employee Overview</h5>
    <div class="d-flex align-items-center gap-3">
        <span
            class="badge bg-soft-purple-custom text-accent px-3 py-2 rounded-pill border border-light border-opacity-10">8
            Total Employees</span>
        <button class="btn btn-link text-accent p-0">
            <i class="bi bi-grid-fill fs-5"></i>
        </button>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-6 col-md-3">
        <div class="stat-card-employee stat-green">
            <i class="bi bi-person-check stat-icon"></i>
            <h3 class="fw-bold mb-0 text-main">5</h3>
            <span class="text-muted-custom small">Active</span>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card-employee stat-orange">
            <i class="bi bi-person-dash stat-icon"></i>
            <h3 class="fw-bold mb-0 text-main">1</h3>
            <span class="text-muted-custom small">On Leave</span>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card-employee stat-purple">
            <i class="bi bi-star stat-icon"></i>
            <h3 class="fw-bold mb-0 text-main">3</h3>
            <span class="text-muted-custom small">Managers</span>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card-employee stat-blue">
            <i class="bi bi-briefcase stat-icon"></i>
            <h3 class="fw-bold mb-0 text-main">5</h3>
            <span class="text-muted-custom small">Departments</span>
        </div>
    </div>
</div>

<div class="filter-container mb-4">
    <div class="d-flex align-items-center flex-grow-1 gap-2 w-100 w-md-auto">
        <i class="bi bi-search text-muted-custom fs-5"></i>
        <input type="text" class="search-input" placeholder="Search employees...">
    </div>

    <div class="d-flex gap-3 w-100 w-md-auto overflow-auto">
        <select class="filter-select">
            <option>All Departments</option>
            <option>Engineering</option>
            <option>Design</option>
            <option>Marketing</option>
        </select>
        <select class="filter-select">
            <option>All Status</option>
            <option>Active</option>
            <option>On Leave</option>
        </select>

        <button class="btn-add flex-shrink-0">
            <i class="bi bi-plus-lg fs-5"></i>
        </button>
    </div>
</div>

<div class="d-flex flex-column gap-3">

    <div class="employee-card">
        <div class="row align-items-center g-3">
            <div class="col-12 col-lg-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-lg text-accent"
                        style="background-color: var(--soft-accent); border-color: var(--accent-color);">SJ</div>
                    <div>
                        <h5 class="fw-bold text-main mb-1">Sarah Johnson</h5>
                        <div class="text-muted-custom small">Senior Software Engineer • Engineering</div>
                        <small class="text-muted-custom d-block mt-1" style="font-size: 0.7rem;">ID: KSS001</small>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="d-flex flex-column gap-1">
                    <div class="d-flex align-items-center gap-2 text-muted-custom small">
                        <i class="bi bi-envelope"></i> sarah.j@kickstart.com
                    </div>
                    <div class="d-flex align-items-center gap-2 text-muted-custom small">
                        <i class="bi bi-geo-alt"></i> San Francisco, CA
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="d-flex flex-wrap gap-2">
                    <span class="skill-pill">React</span>
                    <span class="skill-pill">Node.js</span>
                    <span class="skill-pill">Python</span>
                    <span class="skill-pill">AWS</span>
                </div>
                <div class="mt-2 text-muted-custom small">
                    <i class="bi bi-calendar3 me-1"></i> Joined 2022
                </div>
            </div>
            <div
                class="col-12 col-lg-2 text-lg-end d-flex flex-row flex-lg-column justify-content-between align-items-center align-items-lg-end">
                <div>
                    <span class="d-block fw-bold text-success small mb-1">Active</span>
                    <span class="d-block text-muted-custom small">Senior</span>
                </div>
                <button class="btn btn-link text-muted-custom p-0 mt-lg-2">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="employee-card">
        <div class="row align-items-center g-3">
            <div class="col-12 col-lg-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-lg"
                        style="color: #3b82f6; background-color: rgba(59, 130, 246, 0.1); border-color: #3b82f6;">MC
                    </div>
                    <div>
                        <h5 class="fw-bold text-main mb-1">Michael Chen</h5>
                        <div class="text-muted-custom small">Product Designer • Design Team</div>
                        <small class="text-muted-custom d-block mt-1" style="font-size: 0.7rem;">ID: KSS004</small>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="d-flex flex-column gap-1">
                    <div class="d-flex align-items-center gap-2 text-muted-custom small">
                        <i class="bi bi-envelope"></i> michael.c@kickstart.com
                    </div>
                    <div class="d-flex align-items-center gap-2 text-muted-custom small">
                        <i class="bi bi-geo-alt"></i> New York, NY
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="d-flex flex-wrap gap-2">
                    <span class="skill-pill"
                        style="color: #3b82f6; background-color: rgba(59, 130, 246, 0.1); border-color: rgba(59, 130, 246, 0.2);">Figma</span>
                    <span class="skill-pill"
                        style="color: #3b82f6; background-color: rgba(59, 130, 246, 0.1); border-color: rgba(59, 130, 246, 0.2);">UI/UX</span>
                </div>
                <div class="mt-2 text-muted-custom small">
                    <i class="bi bi-calendar3 me-1"></i> Joined 2023
                </div>
            </div>
            <div
                class="col-12 col-lg-2 text-lg-end d-flex flex-row flex-lg-column justify-content-between align-items-center align-items-lg-end">
                <div>
                    <span class="d-block fw-bold text-success small mb-1">Active</span>
                    <span class="d-block text-muted-custom small">Mid-Level</span>
                </div>
                <button class="btn btn-link text-muted-custom p-0 mt-lg-2">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="employee-card">
        <div class="row align-items-center g-3">
            <div class="col-12 col-lg-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-lg"
                        style="color: #f59e0b; background-color: rgba(245, 158, 11, 0.1); border-color: #f59e0b;">EW
                    </div>
                    <div>
                        <h5 class="fw-bold text-main mb-1">Emma Wilson</h5>
                        <div class="text-muted-custom small">Marketing Manager • Marketing</div>
                        <small class="text-muted-custom d-block mt-1" style="font-size: 0.7rem;">ID: KSS012</small>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="d-flex flex-column gap-1">
                    <div class="d-flex align-items-center gap-2 text-muted-custom small">
                        <i class="bi bi-envelope"></i> emma.w@kickstart.com
                    </div>
                    <div class="d-flex align-items-center gap-2 text-muted-custom small">
                        <i class="bi bi-geo-alt"></i> London, UK
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="d-flex flex-wrap gap-2">
                    <span class="skill-pill"
                        style="color: #f59e0b; background-color: rgba(245, 158, 11, 0.1); border-color: rgba(245, 158, 11, 0.2);">SEO</span>
                    <span class="skill-pill"
                        style="color: #f59e0b; background-color: rgba(245, 158, 11, 0.1); border-color: rgba(245, 158, 11, 0.2);">Content</span>
                </div>
                <div class="mt-2 text-muted-custom small">
                    <i class="bi bi-calendar3 me-1"></i> Joined 2021
                </div>
            </div>
            <div
                class="col-12 col-lg-2 text-lg-end d-flex flex-row flex-lg-column justify-content-between align-items-center align-items-lg-end">
                <div>
                    <span class="d-block fw-bold text-warning small mb-1">On Leave</span>
                    <span class="d-block text-muted-custom small">Manager</span>
                </div>
                <button class="btn btn-link text-muted-custom p-0 mt-lg-2">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
            </div>
        </div>
    </div>

</div>
@endsection
