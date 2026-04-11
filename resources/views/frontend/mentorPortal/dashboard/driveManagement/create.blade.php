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
        --soft-blue: #e7f1ff;
        --text-blue: #0d6efd;
    }

    [data-theme="dark"] {
        --bg-card: #2e333f;
        /* Matches screenshot dark card */
        --text-main: #e9ecef;
        --text-muted: #94a3b8;
        --border-color: #334155;
        --input-bg: #0f172a;
        /* Darker input background */

        --soft-blue: rgba(13, 110, 253, 0.15);
        --text-blue: #6ea8fe;
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
        overflow-x: auto;
        /* Scroll on mobile */
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

    .step-icon {
        font-size: 1rem;
    }

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

    .form-control,
    .form-select {
        background-color: var(--input-bg);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        padding: 10px 14px;
        font-size: 0.9rem;
        border-radius: 8px;
    }

    .form-control:focus,
    .form-select:focus {
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

    .input-with-icon {
        border-left: none;
    }

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

    .tech-badge:hover,
    .tech-badge.selected {
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
        background-color: rgba(255, 255, 255, 0.02);
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
            flex-direction: column-reverse;
            /* Stack buttons, main action top */
        }

        .form-footer>div,
        .form-footer>button {
            width: 100%;
        }

        .form-footer>div {
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
            <div class="step-item active" data-tab="tab-basic">
                <i class="bi bi-info-circle step-icon"></i> Basic Info
            </div>
            <div class="step-item" data-tab="tab-eligibility">
                <i class="bi bi-check2-square step-icon"></i> Eligibility
            </div>
            <div class="step-item" data-tab="tab-timeline">
                <i class="bi bi-calendar-event step-icon"></i> Timeline
            </div>
            <div class="step-item" data-tab="tab-package">
                <i class="bi bi-currency-dollar step-icon"></i> Package
            </div>
        </div>
    </div>

</div>


<form action="{{ route('mentor.drive.store') }}" method="POST">
    @csrf

    <!-- All tabs here -->
    
    <div id="tab-basic" class="drive-tab">
        @include('frontend.mentorPortal.dashboard.driveManagement.tabs.basicinfo')
    </div>

    <div id="tab-eligibility" class="drive-tab d-none">
        @include('frontend.mentorPortal.dashboard.driveManagement.tabs.eligibility',['institutions'=>$institutions,'departments'=>$departments,'courses'=>$courses])
    </div>

    <div id="tab-timeline" class="drive-tab d-none">
        @include('frontend.mentorPortal.dashboard.driveManagement.tabs.timeline')
    </div>

    <div id="tab-package" class="drive-tab d-none">
        @include('frontend.mentorPortal.dashboard.driveManagement.tabs.package')
    </div>

</form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function switchTab(tabId) {
                document.querySelectorAll('.drive-tab').forEach(tab => {
                    tab.classList.add('d-none');
                });

                document.getElementById(tabId).classList.remove('d-none');

                document.querySelectorAll('.step-item').forEach(step => {
                    step.classList.remove('active');
                    if (step.getAttribute('data-tab') === tabId) {
                        step.classList.add('active');
                    }
                });
            }

            document.querySelectorAll('.step-item').forEach(step => {
                step.addEventListener('click', function() {
                    switchTab(this.getAttribute('data-tab'));
                });
            });

            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('next-tab')) {
                    switchTab(e.target.getAttribute('data-next'));
                }
                if (e.target.classList.contains('prev-tab')) {
                    switchTab(e.target.getAttribute('data-prev'));
                }
            });

        });
    </script>
    @endsection