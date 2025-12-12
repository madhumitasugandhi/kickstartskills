@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Portfolio')

@section('content')
<style>
    /* Reusing Theme Variables */
    :root {
        --bg-body: #f8f9fa;
        --bg-sidebar: #ffffff;
        --bg-card: #ffffff;
        --bg-hover: #f8f9fa;

        --text-main: #343a40;
        --text-muted: #6c757d;

        --border-color: #e9ecef;

        /* Soft Colors */
        --soft-blue: #e7f1ff;
        --text-blue: #0d6efd;
        --soft-green: #d1e7dd;
        --text-green: #0f5132;
        --soft-orange: #ffecb5;
        --text-orange: #664d03;
        --soft-red: #f8d7da;
        --text-red: #842029;
        --soft-teal: #e0fbf6;
        --text-teal: #107c6f;
    }

    [data-theme="dark"] {
        --bg-body: #0f1626;
        --bg-sidebar: #1e293b;
        --bg-card: #2e333f;
        --bg-hover: #2e333f;

        --text-main: #e9ecef;
        --text-muted: #adb5bd;

        --border-color: #767677;

        /* Dark Mode Transparencies */
        --soft-blue: rgba(13, 110, 253, 0.15);
        --text-blue: #6ea8fe;
        --soft-green: rgba(25, 135, 84, 0.15);
        --text-green: #75b798;
        --soft-orange: rgba(255, 193, 7, 0.15);
        --text-orange: #ffda6a;
        --soft-red: rgba(220, 53, 69, 0.15);
        --text-red: #ea868f;
        --soft-teal: rgba(32, 201, 151, 0.15);
        --text-teal: #a9e5d6;
    }

    /* Card Styling */
    .card-custom {
        border: 1px solid var(--border-color);
        border-radius: 12px;
        background: var(--bg-card);
        padding: 24px;
        margin-bottom: 24px;
    }

    /* Section Icons */
    .section-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    /* Resume Box */
    .resume-box {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        color: var(--text-main);
        font-family: monospace;
    }

    /* Project Cards */
    .project-card {
        border: 1px solid var(--border-color);
        border-radius: 12px;
        overflow: hidden;
        height: 100%;
        background: var(--bg-card);
        transition: transform 0.2s;
    }

    .project-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .project-header {
        height: 140px;
        background-color: var(--soft-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-blue);
        font-size: 3rem;
    }

    .project-body {
        padding: 20px;
    }

    .badge-tech {
        background-color: var(--border-color);
        /* Light grey for tags */
        color: var(--text-main);
        font-size: 0.75rem;
        padding: 4px 8px;
        border-radius: 4px;
        margin-right: 4px;
        display: inline-block;
        margin-bottom: 4px;
    }

    /* Progress Bars for Skills */
    .skill-bar-container {
        height: 8px;
        background-color: var(--border-color);
        border-radius: 4px;
        overflow: hidden;
        margin-top: 8px;
    }

    .skill-bar {
        height: 100%;
        border-radius: 4px;
    }

    /* Achievement Items */
    .achievement-item {
        background-color: var(--soft-green);
        /* Default, overridden inline */
        border-radius: 12px;
        padding: 16px;
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 12px;
    }

    .achievement-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        background-color: rgba(255, 255, 255, 0.5);
        /* Semi-transparent white */
    }

    /* Utility for background colors based on image */
    .bg-light-blue {
        background-color: #e0f2fe;
    }

    /* Pale Blue */
    .bg-light-green {
        background-color: #dcfce7;
    }

    /* Pale Green */
    .bg-light-orange {
        background-color: #ffedd5;
    }

    /* Pale Orange */

    [data-theme="dark"] .bg-light-blue {
        background-color: rgba(14, 165, 233, 0.15);
    }

    [data-theme="dark"] .bg-light-green {
        background-color: rgba(34, 197, 94, 0.15);
    }

    [data-theme="dark"] .bg-light-orange {
        background-color: rgba(249, 115, 22, 0.15);
    }
</style>

<div class="content-body">

    <div class="d-flex align-items-center gap-3 mb-4">
        <div class="p-2 bg-primary bg-opacity-10 rounded-3 text-primary"><i class="bi bi-briefcase fs-4"></i></div>
        <div>
            <h5 class="fw-bold m-0 text-main">Portfolio</h5>
            <small class="--text-muted">Welcome back, John!</small>
        </div>
    </div>

    <!-- 1. Professional Summary & Resume -->
    <div class="card-custom">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="section-icon bg-soft-blue text-primary">
                <i class="bi bi-person-lines-fill"></i>
            </div>
            <h6 class="fw-bold m-0 text-main fs-5">Professional Summary</h6>
        </div>

        <div class="mb-4">
            <label class="form-label small fw-bold" style="color: var(--text-muted)">Bio/Summary</label>
            <div class="p-3 rounded" style="color: var(--text-main); border: 1px solid var(--border-color); ">
                Passionate Computer Engineering student with expertise in Flutter development and UI/UX design.
                Experienced in building mobile applications and web solutions.
            </div>
        </div>

        <div>
            <label class="form-label small fw-bold" style="color: var(--text-muted)">Resume/CV</label>
            <div class="resume-box">
                <i class="bi bi-file-earmark-pdf text-danger me-2"></i> john_doe_resume.pdf
                <span class="ms-auto text-primary small fw-bold" style="cursor: pointer;">Download</span>
            </div>
        </div>
    </div>

    <!-- 2. Social Links -->
    <div class="card-custom">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="section-icon bg-soft-blue text-primary">
                <i class="bi bi-globe"></i>
            </div>
            <h6 class="fw-bold m-0 text-main fs-5">Social Links & Online Presence</h6>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-bold" style="color: var(--text-muted)">LinkedIn Profile</label>
            <div class="resume-box " style="color: var(--text-main);">https://linkedin.com/in/johndoe</div>
        </div>
        <div class="mb-3">
            <label class="form-label small fw-bold" style="color: var(--text-muted)">GitHub Profile</label>
            <div class="resume-box " style="color: var(--text-main);">https://github.com/johndoe</div>
        </div>
        <div>
            <label class="form-label small fw-bold" style="color: var(--text-muted)">Portfolio Website</label>
            <div class="resume-box " style="color: var(--text-main);">https://johndoe.dev</div>
        </div>
    </div>

    <!-- 3. Projects Showcase (Grid) -->
    <div class="mb-4">
        <div class="d-flex align-items-center gap-3 mb-3">
            <div class="section-icon bg-soft-orange text-warning">
                <i class="bi bi-folder"></i>
            </div>
            <h6 class="fw-bold m-0 text-main fs-5">Projects Showcase</h6>
        </div>

        <div class="row g-4">
            <!-- Project 1 -->
            <div class="col-md-6">
                <div class="project-card">
                    <div class="project-header bg-light-blue">
                        <i class="bi bi-phone"></i> <!-- Placeholder Icon -->
                    </div>
                    <div class="project-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="fw-bold text-main m-0">E-commerce Mobile App</h6>
                            <span class="badge bg-success rounded-pill" style="font-size: 0.65rem;">Completed</span>
                        </div>
                        <p class=" small mb-3" style="color: var(--text-muted)">Flutter-based mobile application with
                            complete shopping functionality, payment integration, and real-time order tracking.</p>
                        <div class="mb-3">
                            <span class="badge-tech">Flutter</span>
                            <span class="badge-tech">Firebase</span>
                            <span class="badge-tech">Stripe API</span>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-light btn-sm flex-grow-1 border"><i
                                    class="bi bi-box-arrow-up-right me-1"></i> Live</button>
                            <button class="btn btn-light btn-sm flex-grow-1 border"><i class="bi bi-github me-1"></i>
                                Code</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Project 2 -->
            <div class="col-md-6">
                <div class="project-card">
                    <div class="project-header bg-light-green">
                        <i class="bi bi-kanban"></i> <!-- Placeholder Icon -->
                    </div>
                    <div class="project-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="fw-bold text-main m-0">Inventory Management System</h6>
                            <span class="badge bg-success rounded-pill" style="font-size: 0.65rem;">Completed</span>
                        </div>
                        <p class=" small mb-3" style="color: var(--text-muted)">Java-based desktop application for
                            managing inventory with barcode scanning, automated reordering, and detailed analytics.</p>
                        <div class="mb-3">
                            <span class="badge-tech">Java</span>
                            <span class="badge-tech">JavaFX</span>
                            <span class="badge-tech">MySQL</span>
                        </div>
                        <div class="d-flex gap-2">
                            <!-- Only Code button enabled for desktop app typically -->
                            <button class="btn btn-light btn-sm flex-grow-1 border" disabled><i
                                    class="bi bi-box-arrow-up-right me-1"></i> Live</button>
                            <button class="btn btn-light btn-sm flex-grow-1 border"><i class="bi bi-github me-1"></i>
                                Code</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Skills Overview -->
    <div class="card-custom">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="section-icon bg-soft-green text-success">
                <i class="bi bi-cpu"></i>
            </div>
            <h6 class="fw-bold m-0 text-main fs-5">Skills Overview</h6>
        </div>

        <div class="row g-4">
            <!-- Left Column -->
            <div class="col-md-6">
                <div class="mb-4">
                    <div class="d-flex justify-content-between small fw-bold text-main">
                        <span>Flutter</span> <span>90%</span>
                    </div>
                    <div class="skill-bar-container">
                        <div class="skill-bar bg-info" style="width: 90%;"></div>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="d-flex justify-content-between small fw-bold text-main">
                        <span>React</span> <span>80%</span>
                    </div>
                    <div class="skill-bar-container">
                        <div class="skill-bar bg-primary" style="width: 80%;"></div>
                    </div>
                </div>
                <div class="mb-0">
                    <div class="d-flex justify-content-between small fw-bold text-main">
                        <span>Node.js</span> <span>65%</span>
                    </div>
                    <div class="skill-bar-container">
                        <div class="skill-bar bg-success" style="width: 65%;"></div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <div class="mb-4">
                    <div class="d-flex justify-content-between small fw-bold text-main">
                        <span>Java</span> <span>85%</span>
                    </div>
                    <div class="skill-bar-container">
                        <div class="skill-bar bg-warning" style="width: 85%;"></div>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="d-flex justify-content-between small fw-bold text-main">
                        <span>Python</span> <span>75%</span>
                    </div>
                    <div class="skill-bar-container">
                        <div class="skill-bar bg-success" style="width: 75%;"></div>
                    </div>
                </div>
                <div class="mb-0">
                    <div class="d-flex justify-content-between small fw-bold text-main">
                        <span>MongoDB</span> <span>70%</span>
                    </div>
                    <div class="skill-bar-container">
                        <div class="skill-bar bg-danger" style="width: 70%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 5. Achievements -->
    <div class="card-custom">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="section-icon bg-soft-teal text-success">
                <i class="bi bi-trophy"></i>
            </div>
            <h6 class="fw-bold m-0 text-main fs-5">Achievements & Recognition</h6>
        </div>

        <!-- Item 1 -->
        <div class="achievement-item bg-light-green">
            <div class="achievement-icon text-success"><i class="bi bi-award"></i></div>
            <div>
                <h6 class="fw-bold text-main m-0">Winner - State Level Technical Competition</h6>
                <small class="text-success fw-bold d-block my-1">Government of Maharashtra • March 2024</small>
                <small class=" d-block" style="color: var(--text-muted)">First place in mobile app development category
                    with innovative healthcare solution.</small>
            </div>
        </div>

        <!-- Item 2 -->
        <div class="achievement-item bg-light-blue">
            <div class="achievement-icon text-primary"><i class="bi bi-shield-check"></i></div>
            <div>
                <h6 class="fw-bold text-main m-0">Microsoft Azure Fundamentals Certified</h6>
                <small class="text-primary fw-bold d-block my-1">Microsoft • January 2024</small>
                <small class=" d-block" style="color: var(--text-muted)">Successfully completed Microsoft Azure
                    Fundamentals certification (AZ-900).</small>
            </div>
        </div>

        <!-- Item 3 -->
        <div class="achievement-item bg-light-orange">
            <div class="achievement-icon text-warning"><i class="bi bi-star"></i></div>
            <div>
                <h6 class="fw-bold text-main m-0">Dean's List for Academic Excellence</h6>
                <small class="text-warning fw-bold d-block my-1">MIT College • December 2023</small>
                <small class=" d-block" style="color: var(--text-muted)
                ">Recognized for maintaining CGPA above 9.0 for consecutive semesters.</small>
            </div>
        </div>
    </div>

</div>
@endsection
