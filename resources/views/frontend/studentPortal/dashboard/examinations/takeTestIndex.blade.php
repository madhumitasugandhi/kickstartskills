@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Take Test')
@section('icon', 'bi bi-play-circle fs-4 p-2 bg-primary bg-opacity-10 rounded-3 text-primary')

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
        padding: 32px;
        /* Extra padding for this spacious layout */
        margin-bottom: 24px;
    }

    /* Exam Icon */
    .exam-icon-box {
        width: 56px;
        height: 56px;
        background-color: var(--soft-blue);
        color: var(--text-blue);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    /* Metadata Items (Time, Questions, Score) */
    .meta-item {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .meta-icon {
        color: var(--text-blue);
        font-size: 1.1rem;
    }

    .meta-label {
        font-size: 0.75rem;
        color: var(--text-muted);
        display: block;
        margin-bottom: 2px;
    }

    .meta-value {
        font-weight: 600;
        color: var(--text-main);
        font-size: 0.9rem;
    }

    /* Instructions List */
    .instruction-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .instruction-list li {
        display: flex;
        align-items: start;
        gap: 10px;
        margin-bottom: 12px;
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    .bullet-point {
        color: var(--text-blue);
        font-size: 1.2rem;
        line-height: 0.7;
        /* Aligns dot nicely with text */
    }

    /* Start Button Custom Style */
    .btn-start {
        background-color: #dfe7f6;
        /* Light Blue-Grey from image */
        color: #344054;
        border: none;
        padding: 12px 32px;
        border-radius: 8px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }

    .btn-start:hover {
        background-color: #cfd9ea;
        color: #1d2939;
    }

    [data-theme="dark"] .btn-start {
        background-color: #3a3f4b;
        color: #e9ecef;
    }

    [data-theme="dark"] .btn-start:hover {
        background-color: #4a505e;
    }
</style>

<div class="content-body">
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('student.profile.portfolio') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
            <i class="bi bi-plus-circle me-1"></i> Add More Skills
        </a>
    </div>

    @forelse($availableExams as $exam)
        <div class="card-custom mb-4 p-4">
            <div class="d-flex align-items-start gap-4 mb-3">
                <div class="exam-icon-box">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-main mb-1">{{ $exam->exam_title }}</h5>
                    <p class="text-blue small mb-0">{{ $exam->skill_category }} Assessment</p>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-4 mb-3 pb-3 border-bottom" style="border-color: var(--border-color) !important;">
                <div class="meta-item">
                    <div class="d-flex flex-column">
                        <span class="meta-label">Duration</span>
                        <span class="meta-value">{{ $exam->duration_minutes }} mins</span>
                    </div>
                </div>
                <div class="meta-item">
                    <div class="d-flex flex-column">
                        <span class="meta-label">Questions</span>
                        <span class="meta-value">{{ $exam->total_marks }}</span>
                    </div>
                </div>
                <div class="meta-item">
                    <div class="d-flex flex-column">
                        <span class="meta-label">Pass Score</span>
                        <span class="meta-value">{{ $exam->passing_score }}%</span>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('student.exam.start', $exam->id) }}" class="btn-start text-decoration-none">
                    <i class="bi bi-play-fill fs-5"></i> Start Test
                </a>
            </div>
        </div>

    @empty
        <div class="card-custom text-center py-5">
            <div class="exam-icon-box mx-auto mb-3" style="background: var(--soft-red); color: var(--text-red);">
                <i class="bi bi-exclamation-circle"></i>
            </div>
            <h5 class="fw-bold text-main">No Exams Found</h5>
            <p class="--text-muted">We couldn't find exams matching the skills in your portfolio.<br>
                Add skills like <strong>Next.js</strong> or <strong>Angular</strong> to see available tests.</p>

            <a href="{{ route('student.profile.portfolio') }}" class="btn btn-primary mt-3 px-4 shadow-sm">
                <i class="bi bi-person-badge me-2"></i> Go to Portfolio to Add Skills
            </a>
        </div>
    @endforelse
</div>
@endsection
