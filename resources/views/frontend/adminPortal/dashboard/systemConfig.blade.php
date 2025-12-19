@extends('frontend.adminPortal.dashboard.layouts.app')

@section('title', 'System Configuration')

@section('icon', 'bi-gear-wide-connected')

@section('content')
<style>
    /* --- Page Specific Styles --- */

    /* Layout: Sidebar + Content */
    .config-layout {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }
    @media(min-width: 992px) {
        .config-layout { flex-direction: row; }
        .config-sidebar { width: 260px; flex-shrink: 0; }
        .config-content { flex-grow: 1; }
    }

    /* Vertical Tabs Sidebar */
    .nav-pills-config .nav-link {
        color: var(--text-muted);
        background: transparent;
        border-radius: 8px;
        padding: 12px 16px;
        margin-bottom: 8px;
        font-weight: 500;
        display: flex; flex-direction: column; align-items: start;
        text-align: left;
        transition: 0.2s;
        border: 1px solid transparent;
    }

    .nav-pills-config .nav-link:hover {
        background-color: var(--bg-hover);
        color: var(--text-main);
    }

    .nav-pills-config .nav-link.active {
        background-color: rgba(220, 38, 38, 0.1); /* Soft Red */
        color: #ef4444; /* Bright Red */
        border-color: rgba(220, 38, 38, 0.2);
    }

    .tab-label { font-size: 0.9rem; font-weight: 600; margin-bottom: 2px; }
    .tab-desc { font-size: 0.75rem; opacity: 0.8; font-weight: 400; }

    /* Content Card */
    .config-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 32px;
        min-height: 600px;
    }

    .section-title { font-size: 1.1rem; font-weight: 700; color: #ef4444; margin-bottom: 24px; }

    /* Form Elements */
    .form-group-config { margin-bottom: 24px; }
    .form-label-config { display: block; color: var(--text-muted); font-size: 0.85rem; margin-bottom: 8px; font-weight: 500; }

    .form-control-config {
        background-color: var(--bg-body);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        padding: 12px 16px;
        border-radius: 8px;
        width: 100%;
        outline: none;
        transition: border-color 0.2s;
    }
    .form-control-config:focus { border-color: #ef4444; }

    /* Red Toggles */
    .toggle-row {
        display: flex; align-items: center; justify-content: space-between;
        padding: 16px;
        background-color: var(--bg-body);
        border-radius: 8px;
        margin-bottom: 12px;
        border: 1px solid var(--border-color);
    }

    .form-check-input-red {
        width: 3.2em; height: 1.6em;
        background-color: var(--bg-card);
        border-color: var(--border-color);
        cursor: pointer;
        float: none; margin-left: 0;
    }
    .form-check-input-red:checked {
        background-color: #ef4444;
        border-color: #ef4444;
    }

    .toggle-text { font-size: 0.9rem; font-weight: 500; color: var(--text-muted); }

</style>

<div class="config-layout">

    <div class="config-sidebar">
        <h6 class="fw-bold text-main mb-3 px-2">Configuration</h6>

        <div class="nav flex-column nav-pills nav-pills-config" id="v-pills-tab" role="tablist" aria-orientation="vertical">

            <button class="nav-link active" id="v-pills-general-tab" data-bs-toggle="pill" data-bs-target="#v-pills-general" type="button" role="tab">
                <span class="tab-label"><i class="bi bi-gear me-2"></i> General Settings</span>
                <span class="tab-desc">Basic platform configuration</span>
            </button>

            <button class="nav-link" id="v-pills-security-tab" data-bs-toggle="pill" data-bs-target="#v-pills-security" type="button" role="tab">
                <span class="tab-label"><i class="bi bi-shield-lock me-2"></i> Security & Auth</span>
                <span class="tab-desc">Authentication and security settings</span>
            </button>

            <button class="nav-link" id="v-pills-notifications-tab" data-bs-toggle="pill" data-bs-target="#v-pills-notifications" type="button" role="tab">
                <span class="tab-label"><i class="bi bi-bell me-2"></i> Notifications</span>
                <span class="tab-desc">Email, SMS, and push notifications</span>
            </button>

            <button class="nav-link" id="v-pills-features-tab" data-bs-toggle="pill" data-bs-target="#v-pills-features" type="button" role="tab">
                <span class="tab-label"><i class="bi bi-toggle-on me-2"></i> Feature Flags</span>
                <span class="tab-desc">Enable/disable platform features</span>
            </button>

        </div>
    </div>

    <div class="config-content">
        <div class="tab-content" id="v-pills-tabContent">

            <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel">
                <div class="config-card">
                    <h5 class="section-title">General Settings</h5>

                    <div class="form-group-config">
                        <label class="form-label-config">Platform Name</label>
                        <input type="text" class="form-control-config" value="KickStartSkills">
                    </div>

                    <div class="form-group-config">
                        <label class="form-label-config">Description</label>
                        <input type="text" class="form-control-config" value="Connecting Students with Real-World Opportunities">
                    </div>

                    <div class="form-group-config">
                        <label class="form-label-config">Language</label>
                        <select class="form-control-config">
                            <option selected>English</option>
                            <option>Spanish</option>
                            <option>French</option>
                        </select>
                    </div>

                    <div class="form-group-config">
                        <label class="form-label-config">Timezone</label>
                        <select class="form-control-config">
                            <option selected>UTC+00:00</option>
                            <option>UTC-08:00 (PST)</option>
                            <option>UTC+05:30 (IST)</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="v-pills-security" role="tabpanel">
                <div class="config-card">
                    <h5 class="section-title">Security Settings</h5>

                    <div class="form-group-config">
                        <label class="form-label-config">Max Login Attempts</label>
                        <input type="number" class="form-control-config" value="5">
                    </div>

                    <div class="form-group-config">
                        <label class="form-label-config">Session Timeout (seconds)</label>
                        <input type="number" class="form-control-config" value="3600">
                    </div>

                    <div class="toggle-row">
                        <span class="toggle-text">MFA Required</span>
                        <div class="form-check form-switch">
                            <input class="form-check-input form-check-input-red" type="checkbox" role="switch">
                        </div>
                    </div>

                    <div class="toggle-row">
                        <span class="toggle-text">Rate Limiting</span>
                        <div class="form-check form-switch">
                            <input class="form-check-input form-check-input-red" type="checkbox" role="switch" checked>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="v-pills-notifications" role="tabpanel">
                <div class="config-card">
                    <h5 class="section-title">Notification Settings</h5>

                    <div class="toggle-row">
                        <span class="toggle-text">Email Notifications</span>
                        <div class="form-check form-switch">
                            <input class="form-check-input form-check-input-red" type="checkbox" role="switch" checked>
                        </div>
                    </div>

                    <div class="toggle-row">
                        <span class="toggle-text">SMS Notifications</span>
                        <div class="form-check form-switch">
                            <input class="form-check-input form-check-input-red" type="checkbox" role="switch">
                        </div>
                    </div>

                    <div class="toggle-row">
                        <span class="toggle-text">Push Notifications</span>
                        <div class="form-check form-switch">
                            <input class="form-check-input form-check-input-red" type="checkbox" role="switch" checked>
                        </div>
                    </div>

                    <div class="form-group-config mt-4">
                        <label class="form-label-config">From Email</label>
                        <input type="email" class="form-control-config" value="noreply@kickstartskills.com">
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="v-pills-features" role="tabpanel">
                <div class="config-card">
                    <h5 class="section-title">Feature Settings</h5>

                    <div class="toggle-row">
                        <span class="toggle-text">Maintenance Mode</span>
                        <div class="form-check form-switch">
                            <input class="form-check-input form-check-input-red" type="checkbox" role="switch">
                        </div>
                    </div>

                    <div class="toggle-row">
                        <span class="toggle-text">Registration Open</span>
                        <div class="form-check form-switch">
                            <input class="form-check-input form-check-input-red" type="checkbox" role="switch" checked>
                        </div>
                    </div>

                    <div class="toggle-row">
                        <span class="toggle-text">Debug Mode</span>
                        <div class="form-check form-switch">
                            <input class="form-check-input form-check-input-red" type="checkbox" role="switch">
                        </div>
                    </div>

                    <div class="toggle-row">
                        <span class="toggle-text">File Upload</span>
                        <div class="form-check form-switch">
                            <input class="form-check-input form-check-input-red" type="checkbox" role="switch" checked>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
