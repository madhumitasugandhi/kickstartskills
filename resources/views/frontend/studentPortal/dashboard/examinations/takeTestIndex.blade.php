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
        padding: 32px; /* Extra padding for this spacious layout */
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
        line-height: 0.7; /* Aligns dot nicely with text */
    }

    /* Start Button Custom Style */
    .btn-start {
        background-color: #dfe7f6; /* Light Blue-Grey from image */
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

    <!-- Main Exam Card -->
    <div class="card-custom">

        <!-- Header Section -->
        <div class="d-flex align-items-start gap-4 mb-5">
            <div class="exam-icon-box">
                <i class="bi bi-file-earmark-text"></i>
            </div>
            <div>
                <h5 class="fw-bold text-main mb-1">Advanced Flutter Development Assessment</h5>
                <p class="text-muted-custom mb-0" style="color: var(--text-blue) !important;">Mobile Application Development</p>
            </div>
        </div>

        <!-- Info Row (Duration, Questions, Score) -->
        <div class="d-flex flex-wrap gap-5 mb-5 pb-4 border-bottom" style="border-color: var(--border-color) !important;">

            <div class="meta-item">
                <i class="bi bi-clock meta-icon"></i>
                <div>
                    <span class="meta-label">Duration</span>
                    <span class="meta-value">120 minutes</span>
                </div>
            </div>

            <div class="meta-item">
                <i class="bi bi-question-circle meta-icon"></i>
                <div>
                    <span class="meta-label">Questions</span>
                    <span class="meta-value">25</span>
                </div>
            </div>

            <div class="meta-item">
                <i class="bi bi-bullseye meta-icon"></i>
                <div>
                    <span class="meta-label">Passing Score</span>
                    <span class="meta-value">70%</span>
                </div>
            </div>

        </div>

        <!-- Instructions Section -->
        <div class="mb-5">
            <h6 class="fw-bold text-main mb-3">Instructions</h6>
            <ul class="instruction-list">
                <li>
                    <span class="bullet-point">•</span>
                    <span>Read each question carefully before answering</span>
                </li>
                <li>
                    <span class="bullet-point">•</span>
                    <span>You can navigate between questions using Next/Previous buttons</span>
                </li>
                <li>
                    <span class="bullet-point">•</span>
                    <span>Your answers are automatically saved</span>
                </li>
                <li>
                    <span class="bullet-point">•</span>
                    <span>Submit the test before time runs out</span>
                </li>
                <li>
                    <span class="bullet-point">•</span>
                    <span>Once submitted, you cannot modify your answers</span>
                </li>
            </ul>
        </div>

        <!-- Action Button -->
        <div class="d-flex justify-content-end">
            <button class="btn-start">
                <i class="bi bi-play-fill fs-5"></i> Start Test
            </button>
        </div>

    </div>

</div>
@endsection


