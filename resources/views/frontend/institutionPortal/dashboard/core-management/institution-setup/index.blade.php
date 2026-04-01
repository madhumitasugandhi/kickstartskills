@extends('frontend.institutionPortal.layout.app')
@section('page_title', 'Institution Setup')
@section('title', 'Institution Setup')

@section('content')

<div class="container-fluid px-4 py-4">

    <div class="ui-page-header">
        <div class="d-flex align-items-center">
            <div class="icon-box me-3">
                <i class="bi bi-gear-fill"></i>
            </div>
            <div>
                <h5 class="mb-1 fw-semibold" style="color: var(--text-main)">Institution Setup</h5>
                <small>Complete your institution profile and get verified</small>
            </div>
        </div>
    </div>

    <div class="ui-setup">
        <!-- LEFT: STEPS -->
        <div class="ui-stepper">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <span class="small fw-medium" id="step-title-display"></span>
                <span class="progress-percent small">{{ round($progressPercent) }}%</span>
            </div>

            <div class="ui-steps-track">
                @php
                $steps = ['Basic Info', 'Academic', 'Courses','Code Setup','Regulatory','Admin','Verification'];
                @endphp

                @foreach($steps as $index => $step)
                <div class="ui-step {{ $index === 0 ? 'active' : '' }}">
                    <div class="ui-step-circle">
                        @if($index === 0)
                        <i class="bi bi-info-lg"></i>
                        @else
                        {{ $index + 1 }}
                        @endif
                    </div>
                    <span class="ui-step-label">{{ $step }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- RIGHT CONTENT -->
        <div class="flex-grow-1">
            <div class="ui-step-content" id="step-basic">
                @include('frontend.institutionPortal.dashboard.core-management.institution-setup.basicinfo')
            </div>

            <div class="setup-content  d-none" id="step-academic">
                @include('frontend.institutionPortal.dashboard.core-management.institution-setup.academic')
            </div>

            <div class="setup-content  d-none" id="step-course">
                @include('frontend.institutionPortal.dashboard.core-management.institution-setup.course')
            </div>

            <div class="setup-content  d-none" id="step-code">
                @include('frontend.institutionPortal.dashboard.core-management.institution-setup.codesetup')
            </div>

            <div class="setup-content  d-none" id="step-regulatory">
                @include('frontend.institutionPortal.dashboard.core-management.institution-setup.regulatory')
            </div>

            <div class="setup-content  d-none" id="step-admin">
                @include('frontend.institutionPortal.dashboard.core-management.institution-setup.admin')
            </div>

            <div class="setup-content  d-none" id="step-verification">
                @include('frontend.institutionPortal.dashboard.core-management.institution-setup.verification')
            </div>

            <div class="ui-step-footer p-3 px-4 mt-3">
                <div class="d-flex justify-content-between">
                    <button class="btn btn-outline-secondary px-4" id="prevBtn">
                        Previous
                    </button>

                    <button class="btn btn-success px-5 py-2" id="nextBtn">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {

            let currentStep = {{ $resumeStep ?? 0 }};
                const stepIds = [
                'step-basic',
                'step-academic',
                'step-course',
                'step-code',
                'step-regulatory',
                'step-admin',
                'step-verification'
            ];

            const stepLabels = [
                'Basic Information',
                'Academic',
                'Courses',
                'Code Setup',
                'Regulatory',
                'Admin',
                'Verification'
            ];

            const stepItems = document.querySelectorAll('.ui-step');
                        const nextBtn = document.getElementById('nextBtn');
            const prevBtn = document.getElementById('prevBtn');

            // ================= UPDATE UI =================
            function updateUI() {

                stepIds.forEach((id, index) => {
                    document.getElementById(id)?.classList.toggle('d-none', index !== currentStep);
                });

                document.getElementById('step-title-display').innerText =
                    `Step ${currentStep+1} of ${stepIds.length}: ${stepLabels[currentStep]}`;

                const percent = Math.round(((currentStep + 1) / stepIds.length) * 100);
                document.querySelector('.progress-percent').innerText = percent + '%';

                stepItems.forEach((item, index) => {
                    const circle = item.querySelector('.ui-step-circle');
                    item.classList.remove('active', 'completed');

                    if (index < currentStep) {
                        item.classList.add('completed');
                        circle.innerHTML = '<i class="bi bi-check-lg"></i>';
                    } else if (index === currentStep) {
                        item.classList.add('active');
                    }
                });

                prevBtn.disabled = currentStep === 0;
                nextBtn.innerText = currentStep === stepIds.length - 1 ? 'Submit' : 'Next';

                document.dispatchEvent(new CustomEvent('stepChanged', {
                    detail: {
                        step: currentStep
                    }
                }));
            }

            // ================= SAVE STEP =================
            async function saveStep(step, data) {
                await fetch('/institution/core-management/setup/save-step', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        step,
                        data
                    })
                });
            }

            // ================= COMPLETE SETUP =================
            async function completeSetup() {

                const uploadedIcons = document.querySelectorAll('.bi-check-circle').length;

                if (uploadedIcons < 2) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Upload Required Documents',
                        text: 'Please upload all required documents before submitting'
                    });
                    return;
                }

                const confirm = await Swal.fire({
                    title: 'Submit Setup?',
                    text: 'After submission, institution will go for verification.',
                    icon: 'question',
                    showCancelButton: true
                });

                if (!confirm.isConfirmed) return;

                const res = await fetch('/institution/core-management/setup/complete', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await res.json();

                if (data.status === 'success') {
                    await Swal.fire({
                        icon: 'success',
                        title: 'Setup Completed'
                    });

                    window.location.href = '/institution/dashboard';
                }
            } //validateBasicInfo
            function validateBasicInfo() {

                let valid = true;

                const fields = [
                    'institution_name',
                    'institution_type_id',
                    'phone',
                    'email',
                    'address_line1',
                    'state',
                    'city',
                    'postal_code',
                    'established_year'
                ];

                // clear old errors
                document.querySelectorAll('.error-msg').forEach(el => el.innerText = '');
                document.querySelectorAll('.form-control, .form-select').forEach(el => el.classList.remove('is-invalid'));

                fields.forEach(name => {
                    const input = document.querySelector(`[name="${name}"]`);
                    if (!input || !input.value.trim()) {
                        valid = false;
                        input.classList.add('is-invalid');
                        const err = document.querySelector(`[data-error="${name}"]`);
                        if (err) err.innerText = 'This field is required';
                    }
                });

                // email format
                const email = document.querySelector('[name="email"]').value;
                if (email && !email.includes('@')) {
                    valid = false;
                    document.querySelector('[name="email"]').classList.add('is-invalid');
                    document.querySelector('[data-error="email"]').innerText = 'Invalid email';
                }

                // phone validation
                const phone = document.querySelector('[name="phone"]').value;
                if (phone && phone.length < 10) {
                    valid = false;
                    document.querySelector('[name="phone"]').classList.add('is-invalid');
                    document.querySelector('[data-error="phone"]').innerText = 'Invalid phone number';
                }

                return valid;
            }



            // ================= NEXT BUTTON =================
            nextBtn.addEventListener('click', async () => {

                if (currentStep === 0) {

                    if (!validateBasicInfo()) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Please fill all required fields'
                        });
                        return;
                    }

                    const getVal = (name) => document.querySelector(`[name="${name}"]`)?.value || '';

                    await saveStep('basic', {
                        institution_name: getVal('institution_name'),
                        institution_type_id: getVal('institution_type_id'),
                        phone: getVal('phone'),
                        email: getVal('email'),
                        address_line1: getVal('address_line1'),
                        city: getVal('city'),
                        state: getVal('state'),
                        postal_code: getVal('postal_code'),
                        website: getVal('website'),
                        established_year: getVal('established_year')
                    });
                }
                if (currentStep === 1) {
                    const departments = [...document.querySelectorAll('#deptList .chip-item span')]
                        .map(el => el.innerText);

                    const programs = [...document.querySelectorAll('#programList .chip-item span')]
                        .map(el => el.innerText);

                    if (!departments.length || !programs.length) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Add Departments & Programs'
                        });
                        return;
                    }

                    await saveStep('academic', {
                        departments,
                        programs
                    });
                }
                if (currentStep === 2) {
                    if (window.saveCourseStep) {
                        await window.saveCourseStep();
                    }
                }

                if (currentStep === 3) {
                    if (window.saveAcademicStep) {
                        await window.saveAcademicStep();
                    }
                }

                if (currentStep === 4) {
                    if (window.saveRegulatoryStep) {
                        await window.saveRegulatoryStep();
                    }
                }

                if (currentStep === 5) {
                    if (window.saveAdminStep) {
                        const ok = await window.saveAdminStep();
                        if (!ok) return;
                    }
                }

                if (currentStep === stepIds.length - 1) {
                    await completeSetup();
                    return;
                }

                currentStep++;
                updateUI();
            });

            prevBtn.addEventListener('click', () => {
                if (currentStep > 0) {
                    currentStep--;
                    updateUI();
                }
            });

            updateUI();
        });

    </script>

    @endsection