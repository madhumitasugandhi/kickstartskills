@extends('frontend.hrPortal.dashboard.layouts.app')

@section('title', 'Settings & Configuration')

@section('icon', 'bi bi-gear-fill fs-4 p-2 bg-soft-purple-custom rounded-3 text-purple-custom')

@section('content')
<style>
    /* --- Page Specific Styles --- */

    /* Header Banner */
    .settings-header-card {
        background: linear-gradient(90deg, #1e1b4b 0%, #2e1065 100%); /* Deep Purple Gradient */
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .settings-icon-box {
        width: 48px; height: 48px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem; color: #d8b4fe;
    }

    /* Save Button */
    .btn-save-header {
        background-color: #7c3aed; /* Bright Purple */
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        display: flex; align-items: center; gap: 8px;
        transition: 0.2s;
    }
    .btn-save-header:hover { background-color: #6d28d9; color: white; }

    /* LAYOUT GRID */
    .settings-container {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }
    @media(min-width: 992px) {
        .settings-container { flex-direction: row; }
        .settings-sidebar { width: 280px; flex-shrink: 0; }
        .settings-content { flex-grow: 1; }
    }

    /* SIDEBAR MENU */
    .settings-sidebar-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 16px;
        height: 100%;
    }

    .sidebar-title {
        font-size: 0.85rem;
        /* text-transform: uppercase; */
        /* letter-spacing: 0.5px; */
        color: var(--text-main);
        font-weight: 700;
        margin-bottom: 12px;
        padding-left: 12px;
    }

    .nav-pills-custom .nav-link {
        color: var(--text-muted); /* Using CSS variable via class not needed here as it's specific */
        background: transparent;
        border-radius: 8px;
        padding: 12px 16px;
        margin-bottom: 4px;
        font-weight: 500;
        display: flex; align-items: center; justify-content: space-between;
        transition: 0.2s;
        text-align: left;
        width: 100%;
    }

    /* Custom class for sidebar items to match --text-muted if needed */
    .nav-pills-custom .nav-link { color: #9ca3af; }

    .nav-pills-custom .nav-link:hover {
        background-color: var(--bg-hover);
        color: var(--text-main);
    }

    .nav-pills-custom .nav-link.active {
        background-color: rgba(124, 58, 237, 0.1); /* Soft Purple Bg */
        color: #a78bfa; /* Purple Text */
        font-weight: 600;
    }

    .nav-pills-custom .nav-link i { font-size: 1.1rem; margin-right: 10px; width: 20px; text-align: center; }
    .nav-pills-custom .nav-link.active i { color: #a78bfa; }

    .nav-pills-custom .nav-link .arrow-icon { opacity: 0; transition: 0.2s; font-size: 0.8rem; }
    .nav-pills-custom .nav-link.active .arrow-icon { opacity: 1; }


    /* RIGHT CONTENT AREA */
    .content-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 32px;
        min-height: 600px;
    }

    .section-header { margin-bottom: 32px; }
    .section-h { font-size: 1.1rem; font-weight: 700; color: var(--text-main); margin-bottom: 4px; }

    /* Headings inside content */
    .settings-sub-heading {
        color: var(--text-main);
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 20px;
        margin-top: 10px;
    }

    /* Form Elements */
    .form-group-custom { margin-bottom: 24px; }
    .form-label-custom { display: block; color: var(--text-muted); font-size: 0.9rem; margin-bottom: 8px; font-weight: 500; }

    .form-control-custom, .form-select-custom {
        background-color: var(--bg-body);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        padding: 12px 16px;
        border-radius: 8px;
        width: 100%;
        outline: none;
    }
    .form-control-custom:focus, .form-select-custom:focus { border-color: #8b5cf6; }

    /* Custom Toggles (Purple) */
    .toggle-row {
        display: flex; align-items: center; justify-content: space-between;
        padding: 16px 0;
        /* border-bottom: 1px solid rgba(255,255,255,0.05); */
    }
    .toggle-label { color: var(--text-muted); font-size: 0.95rem; }

    .form-check-input {
        width: 3.2em; height: 1.6em;
        background-color: var(--bg-body);
        border-color: var(--border-color);
        cursor: pointer;
        float: none; /* Reset bootstrap float */
        margin-left: 0;
    }
    .form-check-input:checked {
        background-color: #8b5cf6; /* Purple */
        border-color: #8b5cf6;
    }

    /* Advanced Buttons Styling */
    .btn-advanced {
        width: 100%;
        text-align: center;
        padding: 12px;
        border: 1px solid;
        border-radius: 8px;
        background: transparent;
        font-weight: 500;
        margin-bottom: 16px;
        transition: 0.2s;
        display: block;
        text-decoration: none;
    }
    .btn-adv-blue { border-color: #3b82f6; color: #3b82f6; }
    .btn-adv-blue:hover { background: rgba(59,130,246,0.1); }

    .btn-adv-purple { border-color: #8b5cf6; color: #8b5cf6; }
    .btn-adv-purple:hover { background: rgba(139,92,246,0.1); }

    .btn-adv-orange { border-color: #f59e0b; color: #f59e0b; }
    .btn-adv-orange:hover { background: rgba(245,158,11,0.1); }

    .btn-adv-green { border-color: #10b981; color: #10b981; }
    .btn-adv-green:hover { background: rgba(16,185,129,0.1); }

    /* Utilities */
    .text-purple-custom { color: #8b5cf6; }
    .bg-soft-purple-custom { background-color: rgba(139, 92, 246, 0.1); }
    .--text-muted { color: #9ca3af !important; } /* Custom class requested */
</style>

<div class="settings-header-card">
    <div class="d-flex align-items-center gap-3">
        <div class="settings-icon-box">
            <i class="bi bi-gear-fill"></i>
        </div>
        <div>
            <h5 class="fw-bold text-white mb-1">HR Settings & Configuration</h5>
            <small class="text-white-50">Configure your HR system preferences and policies</small>
        </div>
    </div>
    <button class="btn-save-header">
        <i class="bi bi-save"></i> Save Changes
    </button>
</div>

<div class="settings-container">

    <div class="settings-sidebar">
        <div class="settings-sidebar-card">
            <div class="sidebar-title">Settings Categories</div>

            <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                <button class="nav-link active" id="v-pills-general-tab" data-bs-toggle="pill" data-bs-target="#v-pills-general" type="button" role="tab">
                    <span><i class="bi bi-gear"></i> General</span>
                    <i class="bi bi-chevron-right arrow-icon"></i>
                </button>

                <button class="nav-link" id="v-pills-policies-tab" data-bs-toggle="pill" data-bs-target="#v-pills-policies" type="button" role="tab">
                    <span><i class="bi bi-file-text"></i> HR Policies</span>
                    <i class="bi bi-chevron-right arrow-icon"></i>
                </button>

                <button class="nav-link" id="v-pills-recruitment-tab" data-bs-toggle="pill" data-bs-target="#v-pills-recruitment" type="button" role="tab">
                    <span><i class="bi bi-briefcase"></i> Recruitment</span>
                    <i class="bi bi-chevron-right arrow-icon"></i>
                </button>

                <button class="nav-link" id="v-pills-performance-tab" data-bs-toggle="pill" data-bs-target="#v-pills-performance" type="button" role="tab">
                    <span><i class="bi bi-star"></i> Performance</span>
                    <i class="bi bi-chevron-right arrow-icon"></i>
                </button>

                <button class="nav-link" id="v-pills-security-tab" data-bs-toggle="pill" data-bs-target="#v-pills-security" type="button" role="tab">
                    <span><i class="bi bi-shield-check"></i> Security</span>
                    <i class="bi bi-chevron-right arrow-icon"></i>
                </button>

                <button class="nav-link" id="v-pills-advanced-tab" data-bs-toggle="pill" data-bs-target="#v-pills-advanced" type="button" role="tab">
                    <span><i class="bi bi-cpu"></i> Advanced</span>
                    <i class="bi bi-chevron-right arrow-icon"></i>
                </button>

            </div>
        </div>
    </div>

    <div class="settings-content">
        <div class="tab-content" id="v-pills-tabContent">

            <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel">
                <div class="content-card">
                    <h5 class="section-h mb-4">General Settings</h5>

                    <div class="mb-5">
                        <h6 class="settings-sub-heading">Notifications</h6>

                        <div class="toggle-row">
                            <span class="--text-muted">Email Notifications</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" checked>
                            </div>
                        </div>

                        <div class="toggle-row">
                            <span class="--text-muted">Push Notifications</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" checked>
                            </div>
                        </div>

                        <div class="toggle-row">
                            <span class="--text-muted">SMS Notifications</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch">
                            </div>
                        </div>

                        <div class="toggle-row">
                            <span class="--text-muted">Weekend Notifications</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch">
                            </div>
                        </div>
                    </div>

                    <div>
                        <h6 class="settings-sub-heading">Localization</h6>

                        <div class="form-group-custom">
                            <label class="form-label-custom --text-muted">Time Zone</label>
                            <select class="form-select-custom">
                                <option>UTC-8 (Pacific Standard Time)</option>
                                <option>UTC+5:30 (Indian Standard Time)</option>
                                <option>UTC+0 (London)</option>
                            </select>
                        </div>

                        <div class="form-group-custom">
                            <label class="form-label-custom --text-muted">Date Format</label>
                            <select class="form-select-custom">
                                <option>MM/DD/YYYY</option>
                                <option>DD/MM/YYYY</option>
                                <option>YYYY-MM-DD</option>
                            </select>
                        </div>

                        <div class="form-group-custom">
                            <label class="form-label-custom --text-muted">Currency</label>
                            <select class="form-select-custom">
                                <option>USD</option>
                                <option>INR</option>
                                <option>EUR</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="v-pills-policies" role="tabpanel">
                <div class="content-card">
                    <h5 class="section-h mb-4">HR Policy Settings</h5>

                    <div class="mb-5">
                        <h6 class="settings-sub-heading">Employment Policies</h6>

                        <div class="form-group-custom">
                            <label class="form-label-custom --text-muted">Probation Period (days)</label>
                            <input type="number" class="form-control-custom" value="90">
                        </div>

                        <div class="form-group-custom">
                            <label class="form-label-custom --text-muted">Annual Leave Entitlement (days)</label>
                            <input type="number" class="form-control-custom" value="25">
                        </div>

                        <div class="toggle-row mt-3">
                            <span class="--text-muted">Flexible Working Hours</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" checked>
                            </div>
                        </div>

                        <div class="toggle-row">
                            <span class="--text-muted">Remote Work Allowed</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" checked>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h6 class="settings-sub-heading">Working Hours</h6>

                        <div class="form-group-custom">
                            <label class="form-label-custom --text-muted">Working Hours Start</label>
                            <input type="time" class="form-control-custom" value="09:00">
                        </div>

                        <div class="form-group-custom">
                            <label class="form-label-custom --text-muted">Working Hours End</label>
                            <input type="time" class="form-control-custom" value="17:00">
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="v-pills-recruitment" role="tabpanel">
                <div class="content-card">
                    <h5 class="section-h mb-4">Recruitment Settings</h5>

                    <div class="mb-5">
                        <h6 class="settings-sub-heading">Application Processing</h6>

                        <div class="toggle-row">
                            <span class="--text-muted">Auto Screening</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" checked>
                            </div>
                        </div>

                        <div class="toggle-row">
                            <span class="--text-muted">Duplicate Application Check</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" checked>
                            </div>
                        </div>

                        <div class="form-group-custom mt-3">
                            <label class="form-label-custom --text-muted">Application Retention (days)</label>
                            <input type="number" class="form-control-custom" value="365">
                        </div>

                        <div class="toggle-row mt-2">
                            <span class="--text-muted">Anonymous Recruitment</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch">
                            </div>
                        </div>
                    </div>

                    <div>
                        <h6 class="settings-sub-heading">Communication</h6>

                        <div class="form-group-custom">
                            <label class="form-label-custom --text-muted">Recruitment Email Template</label>
                            <select class="form-select-custom">
                                <option>Standard</option>
                                <option>Professional</option>
                                <option>Friendly</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="v-pills-performance" role="tabpanel">
                <div class="content-card">
                    <h5 class="section-h mb-4">Performance Management Settings</h5>

                    <div>
                        <h6 class="settings-sub-heading">Review Configuration</h6>

                        <div class="form-group-custom">
                            <label class="form-label-custom --text-muted">Review Cycle</label>
                            <select class="form-select-custom">
                                <option>Annual</option>
                                <option>Bi-Annual</option>
                                <option>Quarterly</option>
                            </select>
                        </div>

                        <div class="toggle-row mt-3">
                            <span class="--text-muted">360-Degree Reviews</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch">
                            </div>
                        </div>

                        <div class="toggle-row">
                            <span class="--text-muted">Goal Tracking</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" checked>
                            </div>
                        </div>

                        <div class="toggle-row">
                            <span class="--text-muted">Performance Metrics</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" checked>
                            </div>
                        </div>

                        <div class="form-group-custom mt-3">
                            <label class="form-label-custom --text-muted">Review Reminder (days)</label>
                            <input type="number" class="form-control-custom" value="14">
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="v-pills-security" role="tabpanel">
                <div class="content-card">
                    <h5 class="section-h mb-4">Security Settings</h5>

                    <div>
                        <h6 class="settings-sub-heading">Authentication & Security</h6>

                        <div class="toggle-row">
                            <span class="--text-muted">Two-Factor Authentication</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch">
                            </div>
                        </div>

                        <div class="toggle-row">
                            <span class="--text-muted">Login Alerts</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" checked>
                            </div>
                        </div>

                        <div class="toggle-row">
                            <span class="--text-muted">Data Encryption</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" checked>
                            </div>
                        </div>

                        <div class="toggle-row">
                            <span class="--text-muted">Audit Logging</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" checked>
                            </div>
                        </div>

                        <div class="form-group-custom mt-3">
                            <label class="form-label-custom --text-muted">Password Expiry (days)</label>
                            <input type="number" class="form-control-custom" value="14">
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="v-pills-advanced" role="tabpanel">
                <div class="content-card">
                    <h5 class="section-h mb-4">Advanced Settings</h5>

                    <div class="mb-5">
                        <h6 class="settings-sub-heading">System Administration</h6>

                        <a href="#" class="btn-advanced btn-adv-blue">
                            <i class="bi bi-download me-2"></i> Export System Configuration
                        </a>

                        <a href="#" class="btn-advanced btn-adv-purple">
                            <i class="bi bi-upload me-2"></i> Import Configuration
                        </a>

                        <a href="#" class="btn-advanced btn-adv-orange">
                            <i class="bi bi-arrow-counterclockwise me-2"></i> Reset to Defaults
                        </a>

                        <a href="#" class="btn-advanced btn-adv-green">
                            <i class="bi bi-file-earmark-text me-2"></i> Generate Audit Report
                        </a>
                    </div>

                    <div>
                        <h6 class="settings-sub-heading">Data Management</h6>

                        <a href="#" class="btn-advanced btn-adv-blue">
                            <i class="bi bi-database me-2"></i> Backup Settings
                        </a>

                        <a href="#" class="btn-advanced btn-adv-orange">
                            <i class="bi bi-trash me-2"></i> Clear Cache
                        </a>

                        <a href="#" class="btn-advanced btn-adv-green">
                            <i class="bi bi-lightning-charge me-2"></i> Optimize Database
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
