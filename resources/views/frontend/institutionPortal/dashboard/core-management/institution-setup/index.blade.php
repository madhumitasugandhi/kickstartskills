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
                    `Step ${currentStep+1} of ${stepIds.length}`: Basic Information
                </span>
                <span class="progress-percent small">0%</span>
            </div>

            <div class="steps-track">
                @php
                $steps = ['Basic Info', 'Academic', 'Courses','Code Setup','Regulatory','Admin','Verification'];
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
                @include(
                'frontend.institutionPortal.dashboard.core-management.institution-setup.basicinfo'
                )
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

            window.getCoursesGlobal = function() {

                // priority 1: runtime data
                if (window.courseCatalog && window.courseCatalog.length) {
                    return window.courseCatalog;
                }

                // priority 2: session fallback
                try {
                    return JSON.parse(
                        document.getElementById('courseData')?.dataset.session || '[]'
                    );
                } catch (e) {
                    return [];
                }
            };

            // ================= STEPS =================
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

            const stepPercent = ['0%', '16%', '32%', '48%', '64%', '80%', '100%'];

            let currentStep = 0;

            const stepItems = document.querySelectorAll('.step-item');
            const nextBtn = document.getElementById('nextBtn');
            const prevBtn = document.getElementById('prevBtn');



            // ================= UI UPDATE =================
            function updateUI() {

                stepIds.forEach((id, index) => {
                    document.getElementById(id)?.classList.toggle('d-none', index !== currentStep);
                });

                document.getElementById('step-title-display').innerText =
                    `Step ${currentStep+1} of ${stepIds.length}: ${stepLabels[currentStep]}`;

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

                prevBtn.disabled = currentStep === 0;

                nextBtn.innerText = currentStep === stepIds.length - 1 ?
                    'Submit' :
                    'Next';
            }

            // ================= SESSION SAVE =================
            async function saveStep(step, data) {
                try {
                    const res = await fetch('/institution/core-management/setup/save-step', {
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
                    return await res.json();

                } catch (e) {
                    alert('Save failed!');

                    console.error('Save error:', e);
                    return false;
                } finally {
                    nextBtn.disabled = false;
                    nextBtn.innerText = 'Next';
                }
            }

            // ================= NEXT =================
            nextBtn.addEventListener('click', async () => {
                console.log('Next clicked, step:', currentStep);
                // BASIC
                if (currentStep === 0) {
                    console.log({
                        city: document.querySelector('[name="city"]'),
                        state: document.querySelector('[name="state"]')
                    });
                    const getVal = (name) => document.querySelector(`[name="${name}"]`)?.value || '';

                    await saveStep('basic', {
                        institution_name: getVal('institution_name'),
                        institution_type_id: getVal('institution_type_id'),
                        phone: getVal('phone'),
                        email: getVal('email'),
                        address_line1: getVal('address_line1'),
                        city: getVal('city'),
                        state: getVal('state'),
                        postal_code: getVal('postal_code')
                    });
                }

                // ACADEMIC
                if (currentStep === 1) {

                    const departments = [...document.querySelectorAll('#deptList span')].map(el => el.innerText);
                    const programs = [...document.querySelectorAll('#programList span')].map(el => el.innerText);

                    if (!departments.length || !programs.length) {
                        document.getElementById('academicWarning')?.classList.remove('d-none');
                        return;
                    }

                    await saveStep('academic', {
                        departments,
                        programs
                    });
                }

                // COURSES
                if (currentStep === 2) {

                    const courses = window.getCourseCatalog?.() || [];

                    window.courseCatalog = courses;

                    await saveStep('courses', courses);

                    document.dispatchEvent(new Event('coursesUpdated'));
                }

                // CODE SETUP
                if (currentStep === 3) {
                    await saveStep('code', {
                        prefix: document.getElementById('codePrefix')?.value,
                        format: document.getElementById('codeFormat')?.value,
                        include_year: document.getElementById('includeYearToggle')?.checked
                    });
                }

                // REGULATORY
                if (currentStep === 4) {
                    await saveStep('regulatory', {
                        aishe_code: document.querySelector('[name="aishe_code"]').value,
                        aicte_id: document.querySelector('[name="aicte_id"]').value,
                        ugc_number: document.querySelector('[name="ugc_number"]').value,
                        affiliated_university: document.querySelector('[name="affiliated_university"]').value,
                        accreditation_ids: document.getElementById('accreditation_ids').value
                    });
                }

                // ADMIN
                if (currentStep === 5) {

                    const password = document.querySelector('[name="password"]').value;

                    if (!password || password.length < 8) {
                        alert('Password must be at least 8 characters');
                        return;
                    }

                    await saveStep('admin', {
                        name: document.querySelector('[name="name"]').value,
                        email: document.querySelector('[name="email"]').value,
                        phone: document.querySelector('[name="phone"]').value,
                        designation: document.querySelector('[name="designation"]').value,
                        password: password
                    });
                }

                // FINAL SUBMIT
                if (currentStep === stepIds.length - 1) {

                    const res = await fetch('/institution/core-management/setup/complete', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });

                    const data = await res.json();

                    if (data.status === 'success') {
                        window.location.href = '/institution/dashboard';
                    }

                    return;
                }

                currentStep++;
                updateUI();

                if (currentStep === 3) {
                    setTimeout(() => {
                        document.dispatchEvent(new Event('refreshCodeSetup'));
                    }, 100);
                }

            });

            // ================= PREV =================
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