@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Academic Details')

@section('content')
<style>
    /* Reusing your Theme Variables */
    :root {
        --bg-card: #ffffff;
        --text-main: #343a40;
        --text-muted: #6c757d;
        --border-color: #e9ecef;

        /* Soft Colors */
        --soft-blue: #e7f1ff; --text-blue: #0d6efd;
        --soft-green: #d1e7dd; --text-green: #0f5132;
        --soft-orange: #ffecb5; --text-orange: #664d03;
        --soft-red: #f8d7da; --text-red: #842029;
    }

    [data-theme="dark"] {
        --bg-card: #252525;
        --text-main: #e9ecef;
        --text-muted: #adb5bd;
        --border-color: #2c2c2c;
        --soft-blue: rgba(13, 110, 253, 0.15); --text-blue: #6ea8fe;
        --soft-green: rgba(25, 135, 84, 0.15); --text-green: #75b798;
        --soft-orange: rgba(255, 193, 7, 0.15); --text-orange: #ffda6a;
    }

    /* Card Styling */
    .card-custom {
        border: 1px solid var(--border-color);
        border-radius: 12px;
        background: var(--bg-card);
        padding: 24px;
        margin-bottom: 24px;
    }

    /* Form Inputs */
    .form-label {
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 8px;
        font-size: 0.85rem;
    }

    .form-control, .form-select {
        background-color: var(--bg-card);
        border-color: var(--border-color);
        color: var(--text-main);
        padding: 12px;
        font-size: 0.9rem;
        border-radius: 8px;
    }

    .form-control:focus, .form-select:focus {
        box-shadow: none;
        border-color: var(--text-blue);
    }

    .input-group-text {
        background-color: var(--bg-card);
        border-color: var(--border-color);
        color: var(--text-muted);
    }

    /* Section Headers (Icons) */
    .section-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .bg-soft-teal { background-color: #e0fbf6; color: #107c6f; }
    [data-theme="dark"] .bg-soft-teal { background-color: rgba(32, 201, 151, 0.15); color: #a9e5d6; }

    /* Readonly Box Style (for Previous Education) */
    .info-box {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 16px;
        color: var(--text-muted);
        font-family: monospace;
        font-size: 0.9rem;
    }
</style>

<div class="content-body">

    <!-- 1. Current Education Section -->
    <div class="card-custom">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="section-icon bg-soft-green text-success">
                <i class="bi bi-book"></i>
            </div>
            <h6 class="fw-bold m-0 text-main fs-5">Current Education</h6>
        </div>

        <form>
            <div class="mb-4">
                <label class="form-label">Institution/University</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-building"></i></span>
                    <input type="text" class="form-control" value="Maharashtra Institute of Technology" readonly>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <!-- Degree Type -->
                <div class="col-md-6">
                    <label class="form-label">Degree Type</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-mortarboard"></i></span>
                        <select class="form-select">
                            <option selected>Undergraduate</option>
                            <option>Postgraduate</option>
                            <option>Diploma</option>
                        </select>
                    </div>
                </div>

                <!-- Degree Course -->
                <div class="col-md-6">
                    <label class="form-label">Degree/Course</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-award"></i></span>
                        <input type="text" class="form-control" value="Bachelor of Engineering">
                    </div>
                </div>

                <!-- Branch -->
                <div class="col-md-6">
                    <label class="form-label">Branch/Specialization</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-cpu"></i></span>
                        <input type="text" class="form-control" value="Computer Engineering">
                    </div>
                </div>

                <!-- Roll Number -->
                <div class="col-md-6">
                    <label class="form-label">Roll Number/ID</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-hash"></i></span>
                        <input type="text" class="form-control" value="CE2021001">
                    </div>
                </div>

                <!-- Year -->
                <div class="col-md-6">
                    <label class="form-label">Current Year</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                        <select class="form-select">
                            <option selected>2024</option>
                            <option>2025</option>
                            <option>2026</option>
                        </select>
                    </div>
                </div>

                <!-- Semester -->
                <div class="col-md-6">
                    <label class="form-label">Current Semester</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-list-ol"></i></span>
                        <select class="form-select">
                            <option selected>Semester 7</option>
                            <option>Semester 8</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- 2. Academic Performance Section -->
    <div class="card-custom">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="section-icon bg-soft-blue text-primary">
                <i class="bi bi-graph-up"></i>
            </div>
            <h6 class="fw-bold m-0 text-main fs-5">Academic Performance</h6>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label">Current CGPA/GPA</label>
                <input type="text" class="form-control" value="8.75">
            </div>
            <div class="col-md-6">
                <label class="form-label">Current Percentage</label>
                <input type="text" class="form-control" value="85.5">
            </div>
        </div>
    </div>

    <!-- 3. Previous Education Section -->
    <div class="card-custom">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="section-icon bg-soft-orange text-warning">
                <i class="bi bi-clock-history"></i>
            </div>
            <h6 class="fw-bold m-0 text-main fs-5">Previous Education</h6>
        </div>

        <label class="form-label">Educational Background</label>
        <div class="info-box">
            HSC - 92.5% (2020)<br>
            SSC - 95.2% (2018)
        </div>
    </div>

    <!-- 4. Skills Section -->
    <div class="card-custom">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="section-icon bg-soft-teal text-teal"> <!-- Using custom teal color -->
                <i class="bi bi-cpu-fill"></i>
            </div>
            <h6 class="fw-bold m-0 text-main fs-5">Skills & Expertise</h6>
        </div>

        <label class="form-label">Technical Skills</label>
        <div class="info-box">
            Flutter, Dart, Java, Python, React, Node.js, MySQL, Firebase
        </div>
    </div>

</div>
@endsection
