@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Academic Details')
@section('icon', 'bi bi-mortarboard fs-4 p-2 bg-primary bg-opacity-10 rounded-3 text-primary')

@section('content')
<style>

    /* Reusing your Theme Variables */
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

    /* Form Inputs */
    .form-label {
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 8px;
        font-size: 0.85rem;
    }

    .form-control,
    .form-select {
        background-color: var(--bg-card);
        border-color: var(--border-color);
        color: var(--text-main);
        padding: 12px;
        font-size: 0.9rem;
        border-radius: 8px;
    }

    .form-control:focus,
    .form-select:focus {
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

    .bg-soft-teal {
        background-color: #e0fbf6;
        color: #107c6f;
    }

    [data-theme="dark"] .bg-soft-teal {
        background-color: rgba(32, 201, 151, 0.15);
        color: #a9e5d6;
    }

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

    .card-custom {
        border: 1px solid var(--border-color);
        border-radius: 12px;
        background: var(--bg-card);
        padding: 24px;
        margin-bottom: 24px;
    }
</style>

<div class="content-body">
    <form action="{{ route('student.profile.academic.save') }}" method="POST">
        @csrf

        <div class="card-custom">
            <div class="d-flex align-items-center gap-3 mb-4 border-bottom pb-3">
                <div class="section-icon bg-soft-green text-success">
                    <i class="bi bi-mortarboard"></i>
                </div>
                <h6 class="fw-bold m-0 text-main fs-5">Current Graduation Details</h6>
            </div>

            <div class="row g-4">
                <div class="col-12">
                    <label class="form-label">Institution / College Name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-building"></i></span>
                        <input type="text" name="degree_college" class="form-control"
                            value="{{ $academic->degree_college ?? '' }}" placeholder="Enter college name">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Degree Name</label>
                    <input type="text" name="degree_name" class="form-control"
                        value="{{ $academic->degree_name ?? '' }}" placeholder="e.g. B.E. Computer Engineering">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Passing Year</label>
                    <input type="number" name="degree_year" class="form-control"
                        value="{{ $academic->degree_year ?? '' }}" placeholder="YYYY">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Current CGPA</label>
                    <input type="number" step="0.01" name="degree_cgpa" class="form-control"
                        value="{{ $academic->degree_cgpa ?? '' }}" placeholder="0.00">
                </div>
            </div>
        </div>

        <div class="row g-4"> <div class="col-md-6">
        <div class="card-custom h-100">
            <div class="d-flex align-items-center gap-3 mb-4 border-bottom pb-3">
                <div class="section-icon bg-soft-blue text-primary">
                    <i class="bi bi-patch-check"></i>
                </div>
                <h6 class="fw-bold m-0 text-main fs-5">HSC (12th) Details</h6>
            </div>
            <div class="mb-3">
                <label class="form-label">College Name</label>
                <input type="text" name="hsc_college" class="form-control" value="{{ $academic->hsc_college ?? '' }}">
            </div>
            <div class="row g-2">
                <div class="col-4">
                    <label class="form-label">Board</label>
                    <input type="text" name="hsc_board" class="form-control" value="{{ $academic->hsc_board ?? '' }}">
                </div>
                <div class="col-4">
                    <label class="form-label">Year</label>
                    <input type="number" name="hsc_year" class="form-control" value="{{ $academic->hsc_year ?? '' }}" placeholder="YYYY">
                </div>
                <div class="col-4">
                    <label class="form-label">Percentage</label>
                    <input type="number" step="0.01" name="hsc_percentage" class="form-control" value="{{ $academic->hsc_percentage ?? '' }}">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card-custom h-100">
            <div class="d-flex align-items-center gap-3 mb-4 border-bottom pb-3">
                <div class="section-icon bg-soft-orange text-warning">
                    <i class="bi bi-patch-check-fill"></i>
                </div>
                <h6 class="fw-bold m-0 text-main fs-5">SSC (10th) Details</h6>
            </div>
            <div class="mb-3">
                <label class="form-label">School Name</label>
                <input type="text" name="ssc_school" class="form-control" value="{{ $academic->ssc_school ?? '' }}">
            </div>
            <div class="row g-2">
                <div class="col-4">
                    <label class="form-label">Board</label>
                    <input type="text" name="ssc_board" class="form-control" value="{{ $academic->ssc_board ?? '' }}">
                </div>
                <div class="col-4">
                    <label class="form-label">Year</label>
                    <input type="number" name="ssc_year" class="form-control" value="{{ $academic->ssc_year ?? '' }}" placeholder="YYYY">
                </div>
                <div class="col-4">
                    <label class="form-label">Percentage</label>
                    <input type="number" step="0.01" name="ssc_percentage" class="form-control" value="{{ $academic->ssc_percentage ?? '' }}">
                </div>
            </div>
        </div>
    </div>
</div>

        <div class="card-custom">
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="section-icon bg-soft-teal text-teal">
                    <i class="bi bi-cpu-fill"></i>
                </div>
                <h6 class="fw-bold m-0 text-main fs-5">Skills & Expertise</h6>
            </div>
            <label class="form-label">Technical Skills (Comma separated)</label>
            <textarea name="skills" class="form-control" rows="3"
                placeholder="Flutter, Laravel, Python...">{{ $academic->skills ?? '' }}</textarea>
        </div>

        <div class="text-end pb-5">
            <button type="submit" class="btn btn-primary px-5 py-2 shadow-sm fw-bold">
                <i class="bi bi-cloud-upload me-2"></i> Save Academic Records
            </button>
        </div>
    </form>
</div>
@endsection
