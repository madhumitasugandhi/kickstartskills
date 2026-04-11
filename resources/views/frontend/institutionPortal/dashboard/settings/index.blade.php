@extends('frontend.institutionPortal.layout.app')

@section('title', 'Institution Settings')
@section('page_title', 'Institution Settings')

@section('content')
<div class="container-fluid p-4 p-md-5">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Institution Settings</h3>
            <p class="mb-0">Configure institutional policies and system preferences</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary">
                <i class="bi bi-download me-1"></i> Export
            </button>
            <button class="btn btn-teal">
                <i class="bi bi-save me-1"></i> Save Changes
            </button>
        </div>
    </div>

    <div class="row g-4">

        {{-- LEFT SIDEBAR --}}
        <div class="col-lg-3 col-12">
            <div class="settings-sidebar">

                <h6 class="mb-3">Settings Categories</h6>

                <button class="settings-tab active" data-tab="general">
                    <div class="d-flex gap-3">
                        <div class="settings-icon"><i class="bi bi-gear"></i></div>
                        <div>
                            <div class="fw-semibold">General Settings</div>
                            <small>Basic institution information</small>
                        </div>
                    </div>
                </button>

                <button class="settings-tab" data-tab="academic">
                    <div class="d-flex gap-3">
                        <div class="settings-icon"><i class="bi bi-book"></i></div>
                        <div>
                            <div class="fw-semibold">Academic Settings</div>
                            <small>Academic policies and grading configuration</small>
                        </div>
                    </div>
                </button>

                <button class="settings-tab" data-tab="security">
                    <div class="d-flex gap-3">
                        <div class="settings-icon"><i class="bi bi-shield"></i></div>
                        <div>
                            <div class="fw-semibold">Security and Access</div>
                            <small>Security policies and access controls</small>
                        </div>
                    </div>
                </button>

                <button class="settings-tab" data-tab="notifications">
                    <div class="d-flex gap-3">
                        <div class="settings-icon"><i class="bi bi-bell"></i></div>
                        <div>
                            <div class="fw-semibold">Notifications</div>
                            <small>Communication and notification preferences</small>
                        </div>
                    </div>
                </button>

                <button class="settings-tab" data-tab="privacy">
                    <div class="d-flex gap-3">
                        <div class="settings-icon"><i class="bi bi-lock"></i></div>
                        <div>
                            <div class="fw-semibold">Privacy & Compliance</div>
                            <small>Data privacy and regulatory compliance</small>
                        </div>
                    </div>
                </button>

                <button class="settings-tab" data-tab="integrations">
                    <div class="d-flex gap-3">
                        <div class="settings-icon"><i class="bi bi-globe"></i></div>
                        <div>
                            <div class="fw-semibold">System Integrations</div>
                            <small>Third-party integrations and APIs</small>
                        </div>
                    </div>
                </button>

            </div>
        </div>

        {{-- RIGHT CONTENT --}}
        <div class="col-lg-9 col-12">

            <div class="settings-panel active" id="tab-general">
                @include('frontend.institutionPortal.dashboard.settings.partials.general')
            </div>

            <div class="settings-panel" id="tab-academic">
                @include('frontend.institutionPortal.dashboard.settings.partials.academic')
            </div>

            <div class="settings-panel" id="tab-security">
                @include('frontend.institutionPortal.dashboard.settings.partials.security')
            </div>

            <div class="settings-panel" id="tab-notifications">
                @include('frontend.institutionPortal.dashboard.settings.partials.notifications')
            </div>

            <div class="settings-panel" id="tab-privacy">
                @include('frontend.institutionPortal.dashboard.settings.partials.privacy')
            </div>

            <div class="settings-panel" id="tab-integrations">
                @include('frontend.institutionPortal.dashboard.settings.partials.integrations')
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.settings-tab');
    const panels = document.querySelectorAll('.settings-panel');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const target = tab.dataset.tab;

            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            panels.forEach(panel => {
                panel.classList.remove('active');
                if (panel.id === `tab-${target}`) {
                    panel.classList.add('active');
                }
            });
        });
    });
});
</script>
@endsection