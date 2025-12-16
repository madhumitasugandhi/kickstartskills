@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Settings')
@section('icon', 'bi bi-gear fs-4 p-2 bg-soft-blue rounded-3 text-primary')

@section('content')
<style>
    /* Theme Variables */
    :root {
        --bg-card: #ffffff;
        --bg-hover: #f8f9fa;
        --text-main: #343a40;
        --text-muted: #6c757d;
        --border-color: #e9ecef;
        --input-bg: #ffffff;

        --soft-blue: #e7f1ff;
        --text-blue: #0d6efd;
        --soft-red: #f8d7da;
        --text-red: #842029;
    }

    [data-theme="dark"] {
        --bg-card: #1e293b;
        --bg-hover: #334155;
        --text-main: #e9ecef;
        --text-muted: #94a3b8;
        --border-color: #334155;
        --input-bg: #0f172a;

        --soft-blue: rgba(13, 110, 253, 0.15);
        --text-blue: #6ea8fe;
        --soft-red: rgba(220, 53, 69, 0.15);
        --text-red: #ea868f;
    }

    /* Card Style */
    .card-custom {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
    }

    /* Section Headers */
    .settings-header {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .settings-sub {
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-bottom: 20px;
        display: block;
    }

    /* Form Elements */
    .form-label {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-bottom: 6px;
    }

    .form-select {
        background-color: var(--input-bg);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        font-size: 0.9rem;
        padding: 10px 12px;
        border-radius: 8px;
    }

    .form-select:focus {
        border-color: var(--text-blue);
        box-shadow: none;
    }

    /* Toggles Row */
    .toggle-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 0;
        border-bottom: 1px solid var(--border-color);
    }

    .toggle-row:last-child {
        border-bottom: none;
    }

    .toggle-info h6 {
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 2px;
        color: var(--text-main);
    }

    .toggle-info small {
        font-size: 0.75rem;
        color: var(--text-muted);
    }

    /* Account Actions List */
    .action-list {
        display: flex;
        flex-direction: column;
    }

    .action-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px;
        border-bottom: 1px solid var(--border-color);
        cursor: pointer;
        transition: 0.2s;
        text-decoration: none;
    }

    .action-item:last-child {
        border-bottom: none;
    }

    .action-item:hover {
        background-color: var(--bg-hover);
    }

    .action-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 16px;
        font-size: 1.1rem;
    }

    .icon-blue {
        color: var(--text-blue);
        background-color: var(--soft-blue);
    }

    .icon-red {
        color: var(--text-red);
        background-color: var(--soft-red);
    }

    .action-text h6 {
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 2px;
        color: var(--text-main);
    }

    .action-text small {
        font-size: 0.75rem;
        color: var(--text-muted);
    }

    .chevron {
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    /* Responsive */
    @media(max-width: 768px) {
        .card-custom {
            padding: 16px;
        }

        .toggle-row {
            flex-direction: row;
            gap: 16px;
        }

        /* Keep switch inline */
        .action-item {
            padding: 12px;
        }
    }
</style>

<div class="content-body">

    <div class="card-custom mb-4" style="padding: 20px;">
        <div class="d-flex align-items-center gap-3">
            <div class="fs-4 p-2 bg-soft-blue rounded-3 text-primary">
                <i class="bi bi-gear fs-3"></i>
            </div>
            <div>
                <h4 class="fw-bold text-main mb-1">Settings</h4>
                <p class="text-muted-custom mb-0 small">Manage your account preferences, security, and notifications</p>
            </div>
        </div>
    </div>

    <div class="card-custom">
        <div class="settings-header text-primary">
            <i class="bi bi-sliders"></i> General Settings
        </div>
        <span class="settings-sub">Customize your dashboard experience</span>

        <div class="row g-4">
            <div class="col-12">
                <label class="form-label">Language</label>
                <select class="form-select">
                    <option selected>English</option>
                    <option>Spanish</option>
                    <option>French</option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label">Timezone</label>
                <select class="form-select">
                    <option selected>UTC-5 (Eastern)</option>
                    <option>UTC+0 (London)</option>
                    <option>UTC+5:30 (IST)</option>
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label">Date Format</label>
                <select class="form-select">
                    <option selected>MM/DD/YYYY</option>
                    <option>DD/MM/YYYY</option>
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label">Time Format</label>
                <select class="form-select">
                    <option selected>12-hour</option>
                    <option>24-hour</option>
                </select>
            </div>
        </div>

        <div class="toggle-row mt-3">
            <div class="toggle-info">
                <h6>Dark Mode</h6>
                <small>Switch between light and dark theme</small>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="darkModeSwitch">
            </div>
        </div>
    </div>

    <div class="card-custom">
        <div class="settings-header text-primary">
            <i class="bi bi-bell"></i> Notification Settings
        </div>
        <span class="settings-sub">Choose how you want to be notified</span>

        <div class="mb-4">
            <div class="toggle-row">
                <div class="toggle-info">
                    <h6>Email Notifications</h6>
                    <small>Receive notifications via email</small>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                </div>
            </div>
            <div class="toggle-row">
                <div class="toggle-info">
                    <h6>Push Notifications</h6>
                    <small>Get instant push notifications</small>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                </div>
            </div>
            <div class="toggle-row">
                <div class="toggle-info">
                    <h6>SMS Notifications</h6>
                    <small>Receive critical alerts via SMS</small>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch">
                </div>
            </div>
        </div>

        <label class="form-label fw-bold mb-2">Notification Types</label>
        <div class="toggle-row">
            <div class="toggle-info">
                <h6>Weekly Reports</h6>
                <small>Get weekly mentoring summary reports</small>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" checked>
            </div>
        </div>
        <div class="toggle-row">
            <div class="toggle-info">
                <h6>Student Activity Alerts</h6>
                <small>Alerts for student progress and issues</small>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" checked>
            </div>
        </div>
        <div class="toggle-row">
            <div class="toggle-info">
                <h6>Session Reminders</h6>
                <small>Reminders for upcoming mentoring sessions</small>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" checked>
            </div>
        </div>
    </div>

    <div class="card-custom">
        <div class="settings-header text-danger">
            <i class="bi bi-shield-lock"></i> Security Settings
        </div>
        <span class="settings-sub">Manage account security and access</span>

        <div class="toggle-row">
            <div class="toggle-info">
                <h6>Two-Factor Authentication</h6>
                <small>Add an extra layer of security</small>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch">
            </div>
        </div>
        <div class="toggle-row">
            <div class="toggle-info">
                <h6>Biometric Authentication</h6>
                <small>Use fingerprint or face recognition</small>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch">
            </div>
        </div>
    </div>

    <div class="card-custom mb-0">
        <div class="settings-header text-primary">
            <i class="bi bi-person-gear"></i> Account Actions
        </div>
        <span class="settings-sub">Manage your account details</span>

        <div class="action-list">
            <a href="#" class="action-item">
                <div class="d-flex align-items-center">
                    <div class="action-icon icon-blue"><i class="bi bi-pencil"></i></div>
                    <div class="action-text">
                        <h6>Edit Profile</h6>
                        <small>Update your profile information</small>
                    </div>
                </div>
                <i class="bi bi-chevron-right chevron"></i>
            </a>

            <a href="#" class="action-item">
                <div class="d-flex align-items-center">
                    <div class="action-icon icon-blue"><i class="bi bi-question-circle"></i></div>
                    <div class="action-text">
                        <h6>Help & Support</h6>
                        <small>Get help or contact support</small>
                    </div>
                </div>
                <i class="bi bi-chevron-right chevron"></i>
            </a>

            <a href="#" class="action-item">
                <div class="d-flex align-items-center">
                    <div class="action-icon icon-blue"><i class="bi bi-file-text"></i></div>
                    <div class="action-text">
                        <h6>Terms of Service</h6>
                        <small>Read our terms of service</small>
                    </div>
                </div>
                <i class="bi bi-chevron-right chevron"></i>
            </a>

            <a href="#" class="action-item">
                <div class="d-flex align-items-center">
                    <div class="action-icon icon-red"><i class="bi bi-box-arrow-right"></i></div>
                    <div class="action-text">
                        <h6 class="text-danger">Sign Out</h6>
                        <small>Sign out of your account</small>
                    </div>
                </div>
                <i class="bi bi-chevron-right chevron"></i>
            </a>

            <a href="#" class="action-item">
                <div class="d-flex align-items-center">
                    <div class="action-icon icon-red"><i class="bi bi-trash"></i></div>
                    <div class="action-text">
                        <h6 class="text-danger">Delete Account</h6>
                        <small>Permanently delete your account</small>
                    </div>
                </div>
                <i class="bi bi-chevron-right chevron"></i>
            </a>
        </div>
    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleSwitch = document.getElementById('darkModeSwitch');
        const htmlElement = document.documentElement;

        // 1. Load saved theme from Local Storage on page load
        const currentTheme = localStorage.getItem('theme');

        if (currentTheme === 'dark') {
            htmlElement.setAttribute('data-theme', 'dark');
            if (toggleSwitch) toggleSwitch.checked = true; // Turn switch ON
        } else {
            htmlElement.removeAttribute('data-theme');
            if (toggleSwitch) toggleSwitch.checked = false; // Turn switch OFF
        }

        // 2. Listen for switch changes
        if (toggleSwitch) {
            toggleSwitch.addEventListener('change', function(e) {
                if (e.target.checked) {
                    // Switch is turned ON -> Enable Dark Mode
                    htmlElement.setAttribute('data-theme', 'dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    // Switch is turned OFF -> Disable Dark Mode
                    htmlElement.removeAttribute('data-theme');
                    localStorage.setItem('theme', 'light');
                }
            });
        }
    });
</script>
@endsection
