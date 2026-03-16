@extends('frontend.institutionPortal.layout.app')
@section('page_title', 'Institution Setup')
@section('title', 'Institution Setup')

@section('content')
<div class="container-fluid px-4 py-4">

    <div class="setup-header p-4">
        <div class="d-flex align-items-center">
            <div class="icon-box me-3">
                <i class="bi bi-gear-fill"></i>
            </div>
            <div>
                <h5 class="mb-1 fw-semibold" style="color: var(--text-main)">Institution Setup</h5>
                <small class="">Complete your institution profile and get verified</small>
            </div>
        </div>
    </div>

    <div class="setup-wrapper d-flex gap-4">
    
    <!-- LEFT: STEPS -->
    <div class="setup-steps p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <span class="small fw-medium" id="step-title-display">
                Step 1 of 8: Basic Information
            </span>
            <span class="progress-percent small">0%</span>
        </div>

        <div class="steps-track">
            @php
                $steps = ['Basic Info', 'Academic', 'Courses', 'Code Setup', 'Regulatory', 'Admin', 'Verification', 'Complete'];
            @endphp

            @foreach($steps as $index => $step)
                <div class="step-item {{ $index === 0 ? 'active' : '' }}">
                    <div class="step-circle">
                        @if($index === 0)
                            <i class="bi bi-info-lg"></i>
                        @else
                            {{ $index + 1 }}
                        @endif
                    </div>
                    <span class="step-label">{{ $step }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- RIGHT: CONTENT -->
    <div class="flex-grow-1">
        <!-- Step Content -->
        <div class="setup-content p-4 rounded" id="step-basic">
            @include('frontend.institutionPortal.dashboard.core-management.institution-setup.basicinfo')
        </div>

        <div class="setup-content p-4 rounded d-none" id="step-academic">
            @include('frontend.institutionPortal.dashboard.core-management.institution-setup.academic')
        </div>

        <div class="setup-content p-4 rounded d-none" id="step-course">
            @include('frontend.institutionPortal.dashboard.core-management.institution-setup.course')
        </div>

        <div class="setup-content p-4 rounded d-none" id="step-code">
            @include('frontend.institutionPortal.dashboard.core-management.institution-setup.codesetup')
        </div>

        <div class="setup-content p-4 rounded d-none" id="step-regulatory">
            @include('frontend.institutionPortal.dashboard.core-management.institution-setup.regulatory')
        </div>

        <div class="setup-content p-4 rounded d-none" id="step-admin">
            @include('frontend.institutionPortal.dashboard.core-management.institution-setup.admin')
        </div>

        <div class="setup-content p-4 rounded d-none" id="step-verification">
            @include('frontend.institutionPortal.dashboard.core-management.institution-setup.verification')
        </div>

        <div class="setup-content p-4 rounded d-none" id="step-complete">
            @include('frontend.institutionPortal.dashboard.core-management.institution-setup.complete')
        </div>

        <div class="setup-footer p-3 px-4 mt-3">
            <div class="d-flex justify-content-between">
                <button class="btn btn-outline-secondary px-4" id="prevBtn">
                    <i class="bi bi-chevron-left me-2"></i> Previous
                </button>

                <button class="btn btn-success px-5 py-2" id="nextBtn">
                    Next <i class="bi bi-chevron-right ms-2"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const stepIds = [
        'step-basic',
        'step-academic',
        'step-course',
        'step-code',
        'step-regulatory',
        'step-admin',
        'step-verification',
        'step-complete'
    ];

    const stepLabels = [
        'Basic Information',
        'Academic',
        'Courses',
        'Code Setup',
        'Regulatory',
        'Admin',
        'Verification',
        'Complete'
    ];

    const stepPercent = ['0%','14%','28%','42%','57%','71%','85%','100%'];

    const stepItems = document.querySelectorAll('.step-item');
    const nextBtn = document.getElementById('nextBtn');
    const NEXT_BTN_HTML = 'Next <i class="bi bi-chevron-right ms-2"></i>';
    let currentStep = 0;
    const prevBtn = document.getElementById('prevBtn');

prevBtn.addEventListener('click', () => {
    if (currentStep > 0) {
        currentStep--;
        updateUI();
    }
});

    function updateUI() {
        stepIds.forEach((id, index) => {
            const el = document.getElementById(id);
            if (el) el.classList.toggle('d-none', index !== currentStep);
        });

        document.getElementById('step-title-display').innerText =
            `Step ${currentStep + 1} of 8: ${stepLabels[currentStep]}`;

        document.querySelector('.progress-percent').innerText =
            stepPercent[currentStep];

        stepItems.forEach((item, index) => {
            const circle = item.querySelector('.step-circle');
            item.classList.remove('active', 'completed');

            if (index < currentStep) {
                item.classList.add('completed');
                circle.innerHTML = '<i class="bi bi-check-lg"></i>';
            } else if (index === currentStep) {
                item.classList.add('active');
            }
        });

        // Handle Previous button
prevBtn.disabled = currentStep === 0;

// Handle Next button state
if (currentStep === stepIds.length - 1) {
    nextBtn.disabled = true;
    nextBtn.innerHTML = 'Completed';
} else {
    nextBtn.disabled = false;
    nextBtn.innerHTML = NEXT_BTN_HTML;
}

    }

    nextBtn.addEventListener('click', () => {

        // Academic validation (safe)
        if (currentStep === 1) {
            const deptList = document.getElementById('deptList');
            const programList = document.getElementById('programList');
            const warning = document.getElementById('academicWarning');

            if (
                deptList && programList &&
                (!deptList.children.length || !programList.children.length)
            ) {
                warning?.classList.remove('d-none');
                return;
            }
        }

        if (currentStep < stepIds.length - 1) {
            currentStep++;
            updateUI();
        }
    });

    updateUI();

    const deptInput = document.getElementById('deptInput');
    const programInput = document.getElementById('programInput');
    const deptList = document.getElementById('deptList');
    const programList = document.getElementById('programList');
    const deptWrapper = document.getElementById('deptListWrapper');
    const programWrapper = document.getElementById('programListWrapper');
    const warning = document.getElementById('academicWarning');
    function updateWarning() {
        if (deptList.children.length > 0 && programList.children.length > 0) {
            warning.classList.add('d-none');
        } else {
            warning.classList.remove('d-none');
        }
    }
    function createChip(text, container) {
        const chip = document.createElement('div');
        chip.className = 'chip-item';
        chip.innerHTML = `
            <span>${text}</span>
            <button type="button">&times;</button>
        `;
        chip.querySelector('button').addEventListener('click', () => {
            chip.remove();
            updateWarning();
            if (!container.children.length) {
                container.parentElement.classList.add('d-none');
            }
        });
        container.appendChild(chip);
        container.parentElement.classList.remove('d-none');
        updateWarning();
    }
    document.getElementById('addDeptBtn')?.addEventListener('click', () => {
        if (!deptInput.value.trim()) return;
        createChip(deptInput.value.trim(), deptList);
        deptInput.value = '';
    });
    document.getElementById('addProgramBtn')?.addEventListener('click', () => {
        if (!programInput.value.trim()) return;
        createChip(programInput.value.trim(), programList);
        programInput.value = '';
    });

});
</script>
@endsection