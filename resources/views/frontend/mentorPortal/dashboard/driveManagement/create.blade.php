@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Create Drive')
@section('icon', 'bi bi-plus-circle fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')
<style>
    /* Theme Variables */
    :root {
        --bg-card: #ffffff;
        --text-main: #343a40;
        --text-muted: #6c757d;
        --border-color: #e9ecef;
        --input-bg: #f8f9fa;
        --soft-blue: #e7f1ff; --text-blue: #0d6efd;
    }

    [data-theme="dark"] {
        --bg-card: #2e333f; /* Matches screenshot dark card */
        --text-main: #e9ecef;
        --text-muted: #94a3b8;
        --border-color: #334155;
        --input-bg: #0f172a; /* Darker input background */

        --soft-blue: rgba(13, 110, 253, 0.15); --text-blue: #6ea8fe;
    }

    /* Card & Container */
    .card-custom {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
    }

    /* Stepper */
    .stepper-container {
        display: flex;
        justify-content: space-between;
        margin-bottom: 32px;
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 16px;
        overflow-x: auto; /* Scroll on mobile */
        gap: 20px;
    }
    .step-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--text-muted);
        font-size: 0.9rem;
        font-weight: 500;
        white-space: nowrap;
        cursor: pointer;
        padding: 4px 8px;
        border-radius: 6px;
    }
    .step-item.active {
        color: var(--accent-color);
        background-color: var(--soft-orange);
        font-weight: 600;
    }
    .step-icon { font-size: 1rem; }

    /* Section Headers */
    .section-title {
        color: var(--accent-color);
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Form Controls */
    .form-label {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-bottom: 6px;
    }
    .form-control, .form-select {
        background-color: var(--input-bg);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        padding: 10px 14px;
        font-size: 0.9rem;
        border-radius: 8px;
    }
    .form-control:focus, .form-select:focus {
        background-color: var(--input-bg);
        color: var(--text-main);
        border-color: var(--text-blue);
        box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.15);
    }

    /* Input Group Icon */
    .input-group-text {
        background-color: var(--input-bg);
        border: 1px solid var(--border-color);
        border-right: none;
        color: var(--text-muted);
    }
    .input-with-icon { border-left: none; }

    /* Tech/Skill Badges */
    .tech-badge {
        padding: 6px 12px;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        font-size: 0.8rem;
        color: var(--text-main);
        cursor: pointer;
        transition: 0.2s;
        background-color: var(--input-bg);
    }
    .tech-badge:hover, .tech-badge.selected {
        border-color: var(--accent-color);
        background-color: var(--soft-orange);
        color: var(--accent-color);
    }

    /* Add Item Box */
    .add-item-box {
        border: 1px dashed var(--border-color);
        border-radius: 8px;
        padding: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: var(--text-muted);
        font-size: 0.85rem;
        background-color: rgba(255,255,255,0.02);
    }
    .btn-add-mini {
        color: var(--accent-color);
        font-weight: 600;
        font-size: 0.8rem;
        cursor: pointer;
        text-decoration: none;
    }

    /* Footer Buttons */
    .form-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 32px;
        gap: 16px;
    }

    /* Responsive */
    @media(max-width: 768px) {
        .form-footer {
            flex-direction: column-reverse; /* Stack buttons, main action top */
        }
        .form-footer > div, .form-footer > button {
            width: 100%;
        }
        .form-footer > div {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
    }
</style>

<div class="content-body">

    <div class="mb-4 card-custom">
        <div class="d-flex align-items-center gap-3 mb-2">
            <div class="fs-4 p-2 bg-soft-orange rounded-3 text-accent">
                <i class="bi bi-plus-circle fs-4"></i>
            </div>
            <div>
                <h4 class="fw-bold text-main m-0">Create New Drive</h4>
                <p class="--text-muted small m-0">Set up a new internship or apprenticeship opportunity</p>
            </div>
        </div>
    </div>

    <div class="card-custom">

        <div class="stepper-container">
            <div class="step-item active">
                <i class="bi bi-info-circle step-icon"></i> Basic Info
            </div>
            <div class="step-item">
                <i class="bi bi-check2-square step-icon"></i> Eligibility
            </div>
            <div class="step-item">
                <i class="bi bi-calendar-event step-icon"></i> Timeline
            </div>
            <div class="step-item">
                <i class="bi bi-currency-dollar step-icon"></i> Package
            </div>
        </div>

        <h6 class="section-title"><i class="bi bi-info-circle"></i> Drive Information</h6>

        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Drive Title" value="Frontend Development Internship">
        </div>

        <div class="mb-3">
            <textarea class="form-control" rows="3" placeholder="Description">Work on modern React applications with experienced developers. Learn industry best practices and build real-world projects.</textarea>
        </div>

        <div class="mb-3">
            <select class="form-select">
                <option selected>Internship</option>
                <option>Apprenticeship</option>
                <option>Full-time</option>
            </select>
        </div>

        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                <input type="text" class="form-control input-with-icon" placeholder="Location" value="Bangalore, India">
            </div>
        </div>

        <div class="mb-4 d-flex justify-content-between align-items-center bg-bg-hover p-2 rounded border border-secondary-subtle" style="border-color: var(--border-color) !important;">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-wifi text-primary"></i>
                <span class="text-main small fw-bold">Remote Work Available</span>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" checked>
            </div>
        </div>

        <h6 class="section-title mt-4"><i class="bi bi-briefcase"></i> Job Requirements</h6>

        <div class="mb-3">
            <textarea class="form-control" rows="3" placeholder="Job Description">Build responsive UI components, integrate APIs, and collaborate with the design team.</textarea>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-12 col-md-6">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-people"></i></span>
                    <input type="number" class="form-control input-with-icon" placeholder="Number of Positions">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-clock"></i></span>
                    <input type="number" class="form-control input-with-icon" placeholder="Hours per Week">
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-6">
                <label class="form-label">Work Mode</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-laptop"></i></span>
                    <select class="form-select input-with-icon">
                        <option selected>REMOTE</option>
                        <option>ON-SITE</option>
                        <option>HYBRID</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label">Mentorship Level</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                    <select class="form-select input-with-icon">
                        <option selected>INTERMEDIATE</option>
                        <option>BEGINNER</option>
                        <option>ADVANCED</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Required Technologies</label>
            <div class="d-flex flex-wrap gap-2">
                <span class="tech-badge selected">JavaScript</span>
                <span class="tech-badge">Python</span>
                <span class="tech-badge">Java</span>
                <span class="tech-badge selected">React</span>
                <span class="tech-badge">Angular</span>
                <span class="tech-badge">Vue.js</span>
                <span class="tech-badge">Node.js</span>
                <span class="tech-badge">Flutter</span>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Preferred Skills</label>
            <div class="d-flex flex-wrap gap-2">
                <span class="tech-badge selected">Problem Solving</span>
                <span class="tech-badge">Critical Thinking</span>
                <span class="tech-badge">Communication</span>
                <span class="tech-badge selected">Teamwork</span>
                <span class="tech-badge">Git</span>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Responsibilities</label>
            <div class="add-item-box">
                <span>No responsibilities added yet</span>
                <a href="#" class="btn-add-mini"><i class="bi bi-plus-lg"></i> Add</a>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Deliverables</label>
            <div class="add-item-box">
                <span>No deliverables added yet</span>
                <a href="#" class="btn-add-mini"><i class="bi bi-plus-lg"></i> Add</a>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center bg-bg-hover p-2 rounded border border-secondary-subtle mb-4" style="border-color: var(--border-color) !important;">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-shield-lock text-muted"></i>
                <span class="text-main small fw-bold">Requires NDA</span>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch">
            </div>
        </div>

        <div class="form-footer">
            <button class="btn btn-outline-secondary px-4 fw-bold">Cancel</button>
            <div class="d-flex gap-2">
                <button class="btn btn-primary fw-bold px-4" style="background-color: var(--accent-color); border: none;">
                    <i class="bi bi-save me-2"></i> Save Drive
                </button>
                <button class="btn btn-success fw-bold px-4">
                    <i class="bi bi-send me-2"></i> Save & Publish
                </button>
            </div>
        </div>

    </div>
</div>
@endsection
