@extends('frontend.studentPortal.dashboard.layouts.app')
@section('content')
<style>
    /* ================= THEME VARIABLES ================= */
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

    /* ================= GENERAL STYLING ================= */

    .content-body {
        padding: 24px;
    }

    /* --- Custom Card Styling --- */
    .card-custom {
        border: 1px solid var(--border-color);
        border-radius: 12px;
        background: var(--bg-card);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        padding: 24px;
        /* More padding for profile */
        margin-bottom: 24px;
        transition: background-color 0.3s, border-color 0.3s;
    }

    /* --- Profile Specific Styles --- */
    .profile-avatar {
        width: 100px;
        height: 100px;
        background-color: #3b82f6;
        /* Bright Blue */
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .status-badge {
        background-color: var(--soft-green);
        color: var(--text-green);
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    /* Form Inputs matching the image */
    .form-label {
        font-weight: 500;
        color: var(--text-main);
        margin-bottom: 8px;
        font-size: 0.85rem;
    }

    .input-group-text {
        background-color: var(--bg-card);
        border-color: var(--border-color);
        color: var(--text-muted);
        border-right: none;
    }

    .form-control,
    .form-select {
        background-color: var(--bg-card);
        border-color: var(--border-color);
        color: var(--text-main);
        padding: 10px 12px;
        font-size: 0.85rem;
        border-left: none;
        /* Merge with icon */
    }

    .form-control:focus,
    .form-select:focus {
        box-shadow: none;
        border-color: var(--text-blue);
        background-color: var(--bg-card);
        color: var(--text-main);
    }

    /* Input Group wrapper to handle focus border */
    .input-group:focus-within .input-group-text,
    .input-group:focus-within .form-control,
    .input-group:focus-within .form-select {
        border-color: var(--text-blue);
    }

    /* Fix for dark mode inputs */
    [data-theme="dark"] .form-control::placeholder {
        color: #6c757d;
    }

    /* Mobile */
    @media (max-width: 991.98px) {
        .main-content {
            margin-left: 0;
        }
    }

    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .text-main {
        color: var(--text-main) !important;
    }

    .text-muted-custom {
        color: var(--text-muted) !important;
    }
</style>
<div class="content-body">

<div class="d-flex align-items-center gap-3 mb-4">
        <div class="p-2 bg-primary bg-opacity-10 rounded-3 text-primary"><i class="bi bi-pencil-square fs-4"></i></div>
        <div>
            <h5 class="fw-bold m-0 text-main">Personal Info</h5>
            <small class="--text-muted">Welcome back, John!</small>
        </div>
    </div>
    <!-- 1. Profile Header Card -->
    <div class="card-custom">
        <div class="d-flex flex-column flex-md-row align-items-center gap-4">
            <!-- Avatar -->
            <div class="profile-avatar">
                <i class="bi bi-person"></i>
            </div>

            <!-- Info -->
            <div class="text-center text-md-start flex-grow-1">
                <h4 class="fw-bold text-main mb-1">John Doe</h4>
                <div
                    class="text-muted-custom small mb-2 d-flex flex-column flex-md-row gap-md-3 justify-content-center justify-content-md-start">
                    <span><i class="bi bi-envelope me-1"></i> john.doe@student.com</span>
                    <span><i class="bi bi-telephone me-1"></i> +91 9876543210</span>
                </div>
                <div class="status-badge">
                    <i class="bi bi-circle-fill" style="font-size: 6px;"></i> Active Student
                </div>
            </div>

            <!-- Edit Button (Optional) -->
            <!-- <button class="btn btn-outline-primary btn-sm">Edit Photo</button> -->
        </div>
    </div>

    <!-- 2. Basic Information Form -->
    <div class="card-custom">
        <div class="d-flex align-items-center gap-2 mb-4">
            <i class="bi bi-info-circle text-primary"></i>
            <h6 class="fw-bold m-0 text-main">Basic Information</h6>
        </div>

        <form>
            <div class="row g-4">
                <!-- First Name -->
                <div class="col-md-6">
                    <label class="form-label">First Name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" value="John" placeholder="Enter first name">
                    </div>
                </div>

                <!-- Last Name -->
                <div class="col-md-6">
                    <label class="form-label">Last Name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" value="Doe" placeholder="Enter last name">
                    </div>
                </div>

                <!-- Email Address -->
                <div class="col-md-6">
                    <label class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" class="form-control" value="john.doe@student.com"
                            placeholder="Enter email address">
                    </div>
                </div>

                <!-- Gender -->
                <div class="col-md-6">
                    <label class="form-label">Gender</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-people"></i></span>
                        <select class="form-select">
                            <option selected>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                        </select>
                    </div>
                </div>

                <!-- Date of Birth -->
                <div class="col-md-6">
                    <label class="form-label">Date of Birth</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                        <input type="text" class="form-control" value="15/08/2002" placeholder="DD/MM/YYYY">
                    </div>
                </div>

                <!-- Blood Group -->
                <div class="col-md-6">
                    <label class="form-label">Blood Group</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-droplet"></i></span>
                        <select class="form-select">
                            <option selected>O+</option>
                            <option>A+</option>
                            <option>B+</option>
                            <option>AB+</option>
                        </select>
                    </div>
                </div>

                <!-- Submit Button Area (Optional) -->
                <!--
                        <div class="col-12 text-end mt-4">
                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                        </div>
                        -->
            </div>
        </form>
    </div>

</div>
@endsection
