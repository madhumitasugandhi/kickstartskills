@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Settings')
@section('icon', 'bi bi-gear fs-4 p-2 bg-primary bg-opacity-10 rounded-3 text-primary')

@section('content')
<style>
    /* Theme Variables */
    :root {
        --bg-body: #f8f9fa;
        --bg-sidebar: #ffffff;
        --bg-card: #ffffff;
        --bg-hover: #f8f9fa;
        --text-main: #343a40;
        --text-muted: #6c757d;
        --border-color: #e9ecef;

        /* Soft Colors */
        --soft-blue: #e7f1ff; --text-blue: #0d6efd;
    }

    [data-theme="dark"] {
        --bg-body: #0f1626;
        --bg-sidebar: #1e293b;
        --bg-card: #2e333f;
        --bg-hover: #2e333f;
        --text-main: #e9ecef;
        --text-muted: #adb5bd;
        --border-color: #767677;

        --soft-blue: rgba(13, 110, 253, 0.15); --text-blue: #6ea8fe;
    }

    /* Page Header Card */
    .settings-header-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 32px;
        margin-bottom: 32px;
        display: flex;
        align-items: center;
        gap: 24px;
    }

    .settings-icon-box {
        width: 64px; height: 64px;
        background-color: var(--soft-blue);
        color: var(--text-blue);
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        font-size: 2rem;
    }

    /* Section Styling */
    .settings-section {
        margin-bottom: 40px;
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 24px;
    }
    .settings-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }

    .section-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .section-title i { color: var(--text-blue); font-size: 1.1rem; }

    /* Form Rows */
    .setting-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        padding-left: 34px; /* Indent to align with text of section title */
    }
    .setting-label {
        font-size: 0.9rem;
        color: var(--text-main);
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .setting-icon { color: var(--text-muted); width: 20px; text-align: center; }

    .setting-desc {
        font-size: 0.75rem;
        color: var(--text-muted);
        display: block;
        margin-top: 4px;
        margin-left: 32px;
    }

    /* Custom Inputs */
    .form-select-custom {
        background-color: var(--bg-hover);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        padding: 8px 36px 8px 16px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
        min-width: 160px;
        text-align: right;
    }
    .form-select-custom:focus { outline: none; border-color: var(--text-blue); }

    /* Toggle Switch */
    .form-check-input {
        width: 3em; height: 1.6em;
        cursor: pointer;
        background-color: var(--border-color);
        border: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e");
        transition: background-position .15s ease-in-out;
    }
    .form-check-input:checked {
        background-color: var(--text-blue);
        border-color: var(--text-blue);
    }
    .form-check-input:focus { box-shadow: none; }

    /* Action Link */
    .action-link {
        color: var(--text-muted);
        text-decoration: none;
        font-size: 0.9rem;
        display: flex; align-items: center; gap: 8px;
        transition: 0.2s;
    }
    .action-link:hover { color: var(--text-blue); }

    @media(max-width: 768px) {
        .setting-row { flex-direction: column; align-items: flex-start; gap: 12px; }
        .setting-row > div:last-child { width: 100%; display: flex; justify-content: flex-end; }
        .setting-desc { margin-left: 0; margin-bottom: 12px; }
        .padding-left-0-mobile { padding-left: 0; }
    }
</style>

<div class="content-body">

    <!-- 1. Header Card -->
    <div class="settings-header-card">
        <div class="settings-icon-box">
            <i class="bi bi-gear"></i>
        </div>
        <div>
            <h4 class="fw-bold text-main m-0 mb-1">App Settings</h4>
            <p class="--text-muted m-0">Customize your learning experience and preferences</p>
        </div>
    </div>

    <div class="card-custom border-0 bg-transparent p-0">

        <!-- General Section -->
        <div class="settings-section">
            <h6 class="section-title"><i class="bi bi-globe"></i> General</h6>

            <div class="setting-row">
                <span class="setting-label"><i class="bi bi-translate setting-icon"></i> Language</span>
                <div>
                    <select class="form-select form-select-custom">
                        <option>English</option>
                        <option>Spanish</option>
                        <option>French</option>
                    </select>
                </div>
            </div>

            <div class="setting-row">
                <span class="setting-label"><i class="bi bi-clock setting-icon"></i> Timezone</span>
                <div>
                    <select class="form-select form-select-custom">
                        <option>Asia/Kolkata</option>
                        <option>America/New_York</option>
                        <option>Europe/London</option>
                    </select>
                </div>
            </div>

            <div class="setting-row">
                <span class="setting-label"><i class="bi bi-calendar-event setting-icon"></i> Date Format</span>
                <div>
                    <select class="form-select form-select-custom">
                        <option>DD/MM/YYYY</option>
                        <option>MM/DD/YYYY</option>
                        <option>YYYY-MM-DD</option>
                    </select>
                </div>
            </div>

            <div class="setting-row">
                <span class="setting-label"><i class="bi bi-moon setting-icon"></i> Dark Theme</span>
                <div class="form-check form-switch">
                    <!-- Added onclick to trigger theme toggle JS -->
                    <input class="form-check-input" type="checkbox" role="switch" onclick="toggleTheme()">
                </div>
            </div>
        </div>

        <!-- Privacy Section -->
        <div class="settings-section">
            <h6 class="section-title"><i class="bi bi-shield-lock"></i> Privacy</h6>

            <div class="setting-row">
                <span class="setting-label"><i class="bi bi-eye setting-icon"></i> Profile Visibility</span>
                <div>
                    <select class="form-select form-select-custom">
                        <option>Public</option>
                        <option>Private</option>
                        <option>Connections Only</option>
                    </select>
                </div>
            </div>

            <div class="setting-row">
                <span class="setting-label"><i class="bi bi-envelope setting-icon"></i> Show Email</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch">
                </div>
            </div>

            <div class="setting-row">
                <span class="setting-label"><i class="bi bi-telephone setting-icon"></i> Show Phone</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch">
                </div>
            </div>

            <div class="setting-row">
                <span class="setting-label"><i class="bi bi-share setting-icon"></i> Share Progress with Parents</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                </div>
            </div>
        </div>

        <!-- Learning Preferences -->
        <div class="settings-section">
            <h6 class="section-title"><i class="bi bi-book"></i> Learning Preferences</h6>

            <div class="setting-row">
                <span class="setting-label"><i class="bi bi-play-circle setting-icon"></i> Auto-play Videos</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                </div>
            </div>

            <div class="setting-row">
                <span class="setting-label"><i class="bi bi-camera-video setting-icon"></i> Video Quality</span>
                <div>
                    <select class="form-select form-select-custom">
                        <option>Auto</option>
                        <option>1080p</option>
                        <option>720p</option>
                        <option>480p</option>
                    </select>
                </div>
            </div>

            <div class="setting-row">
                <span class="setting-label"><i class="bi bi-bell setting-icon"></i> Study Reminders</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                </div>
            </div>

            <div class="setting-row">
                <span class="setting-label"><i class="bi bi-bullseye setting-icon"></i> Goal Tracking</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                </div>
            </div>
        </div>

        <!-- Accessibility -->
        <div class="settings-section">
            <h6 class="section-title"><i class="bi bi-universal-access"></i> Accessibility</h6>

            <div class="setting-row">
                <span class="setting-label"><i class="bi bi-fonts setting-icon"></i> Font Size</span>
                <div>
                    <select class="form-select form-select-custom">
                        <option>Medium</option>
                        <option>Small</option>
                        <option>Large</option>
                    </select>
                </div>
            </div>

            <div class="setting-row">
                <span class="setting-label"><i class="bi bi-brightness-high setting-icon"></i> High Contrast</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch">
                </div>
            </div>

            <div class="setting-row">
                <span class="setting-label"><i class="bi bi-arrows-move setting-icon"></i> Reduced Motion</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch">
                </div>
            </div>
        </div>

        <!-- Notifications Section -->
        <div class="settings-section">
            <h6 class="section-title"><i class="bi bi-bell"></i> Notifications</h6>

            <div class="setting-row">
                <span class="setting-label"><i class="bi bi-envelope setting-icon"></i> Email Notifications</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                </div>
            </div>

            <div class="setting-row">
                <span class="setting-label"><i class="bi bi-phone setting-icon"></i> Push Notifications</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                </div>
            </div>

            <div class="setting-row">
                <span class="setting-label"><i class="bi bi-chat-dots setting-icon"></i> SMS Notifications</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch">
                </div>
            </div>
        </div>

        <!-- Security -->
        <div class="settings-section">
            <h6 class="section-title"><i class="bi bi-lock"></i> Security</h6>

            <div class="setting-row">
                <span class="setting-label"><i class="bi bi-shield-check setting-icon"></i> Two-Factor Authentication</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch">
                </div>
            </div>

            <div class="setting-row">
                <span class="setting-label"><i class="bi bi-fingerprint setting-icon"></i> Biometric Login</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                </div>
            </div>

            <div class="setting-row">
                <span class="setting-label"><i class="bi bi-exclamation-triangle setting-icon"></i> Login Alerts</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                </div>
            </div>

            <div class="setting-row">
                <div>
                    <span class="setting-label"><i class="bi bi-key setting-icon"></i> Change Password</span>
                    <span class="setting-desc">Update your account password</span>
                </div>
                <a href="#" class="action-link"><i class="bi bi-chevron-right"></i></a>
            </div>
        </div>

        <!-- Advanced -->
        <div class="settings-section">
            <h6 class="section-title"><i class="bi bi-sliders"></i> Advanced</h6>

            <div class="setting-row">
                <span class="setting-label"><i class="bi bi-wifi setting-icon"></i> Data Saver Mode</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch">
                </div>
            </div>

            <div class="setting-row">
                <span class="setting-label"><i class="bi bi-arrow-repeat setting-icon"></i> Auto Sync</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                </div>
            </div>

            <div class="setting-row">
                <span class="setting-label"><i class="bi bi-bug setting-icon"></i> Crash Reporting</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                </div>
            </div>

            <div class="setting-row">
                <span class="setting-label"><i class="bi bi-bar-chart setting-icon"></i> Analytics Opt-in</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                </div>
            </div>

            <div class="setting-row">
                <div>
                    <span class="setting-label"><i class="bi bi-trash setting-icon"></i> Clear Cache</span>
                    <span class="setting-desc">Free up storage space</span>
                </div>
                <a href="#" class="action-link"><i class="bi bi-chevron-right"></i></a>
            </div>
        </div>

    </div>

</div>
@endsection

