@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Profile Management')
@section('icon', 'bi bi-person-circle fs-4 p-2 bg-soft-orange rounded-3 text-accent')

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

        --soft-blue: #e7f1ff; --text-blue: #0d6efd;
        --soft-green: #d1e7dd; --text-green: #0f5132;
        --soft-orange: #ffecb5; --text-orange: #664d03;
    }

    [data-theme="dark"] {
        --bg-card: #1e293b;
        --bg-hover: #334155;
        --text-main: #e9ecef;
        --text-muted: #94a3b8;
        --border-color: #334155;
        --input-bg: #0f172a;

        --soft-blue: rgba(13, 110, 253, 0.15); --text-blue: #6ea8fe;
        --soft-green: rgba(25, 135, 84, 0.15); --text-green: #75b798;
        --soft-orange: rgba(255, 193, 7, 0.15); --text-orange: #ffda6a;
    }

    /* Common Card Style */
    .card-custom {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
    }

    /* Header Profile Card */
    .profile-header {
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .profile-avatar-lg {
        width: 80px; height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--accent-color);
        padding: 2px;
    }
    .camera-icon {
        position: absolute; bottom: 0; right: 0;
        background-color: var(--accent-color); color: white;
        width: 24px; height: 24px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.8rem; cursor: pointer; border: 2px solid var(--bg-card);
    }

    /* Form Inputs */
    .form-label { font-size: 0.85rem; color: var(--text-muted); margin-bottom: 6px; }
    .form-control, .form-select {
        background-color: var(--input-bg);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        font-size: 0.9rem;
        padding: 10px 12px;
    }
    .form-control:focus {
        background-color: var(--input-bg);
        color: var(--text-main);
        border-color: var(--text-blue);
        box-shadow: none;
    }
    .input-group-text {
        background-color: var(--input-bg);
        border: 1px solid var(--border-color);
        border-right: none;
        color: var(--text-muted);
    }

    /* Skills Badges */
    .skill-badge {
        font-size: 0.8rem; padding: 6px 12px; border-radius: 6px;
        background-color: var(--bg-hover); color: var(--text-muted);
        border: 1px solid var(--border-color);
        display: inline-flex; align-items: center; gap: 6px;
    }
    .skill-badge i { cursor: pointer; }

    /* Upload Box */
    .upload-box {
        border: 2px dashed var(--border-color);
        border-radius: 12px;
        padding: 24px;
        text-align: center;
        color: var(--text-muted);
        background-color: var(--bg-hover);
        cursor: pointer;
        transition: 0.2s;
    }
    .upload-box:hover { border-color: var(--accent-color); color: var(--accent-color); }

    /* Footer Actions */
    .action-footer {
        position: fixed; bottom: 0; left: 0; right: 0;
        background-color: var(--bg-card);
        border-top: 1px solid var(--border-color);
        padding: 16px 24px;
        z-index: 100;
        /* Adjust left margin if sidebar is present, usually handled by main layout container */
        /* margin-left: 250px; (Example if needed) */
    }

    /* Responsive */
    @media (max-width: 991px) {
        .profile-header { flex-direction: column; text-align: center; }
        .action-footer { position: sticky; margin-left: 0; }
        .action-footer .d-flex { flex-direction: column; gap: 12px; }
        .action-footer button { width: 100%; }
    }
</style>

<div class="content-body" style="padding-bottom: 80px;"> <div class="card-custom">
        <div class="profile-header">
            <div class="position-relative">
                <img src="https://ui-avatars.com/api/?name=Sarah+Johnson&background=0D8ABC&color=fff" class="profile-avatar-lg" alt="Profile">
                <div class="camera-icon"><i class="bi bi-camera"></i></div>
            </div>
            <div>
                <h4 class="fw-bold text-main mb-1">Sarah Johnson</h4>
                <p class="text-blue mb-2">Full-Stack Development</p>
                <div class="d-flex gap-3 justify-content-center justify-content-lg-start flex-wrap">
                    <span class="badge bg-soft-orange text-accent-color"><i class="bi bi-star-fill me-1"></i> 4.8</span>
                    <span class="badge bg-soft-orange text-accent-color"><i class="bi bi-camera-video me-1"></i> 156 sessions</span>
                    <span class="badge bg-soft-orange text-accent-color"><i class="bi bi-briefcase me-1"></i> 8 years exp.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-12 col-lg-8">

            <div class="card-custom">
                <h6 class="fw-bold text-main mb-4"><i class="bi bi-person me-2"></i> Personal Information</h6>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">First Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control border-start-0" value="Sarah">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Last Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control border-start-0" value="Johnson">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" class="form-control border-start-0" value="sarah.johnson@kickstartskills.com">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                        <input type="text" class="form-control border-start-0" value="+1 (555) 123-4567">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Professional Bio</label>
                    <div class="input-group">
                        <span class="input-group-text align-items-start pt-2"><i class="bi bi-file-text"></i></span>
                        <textarea class="form-control border-start-0" rows="3">Senior Software Engineer with 8+ years of experience in full-stack development. Passionate about mentoring and helping students achieve their career goals.</textarea>
                    </div>
                </div>
            </div>

            <div class="card-custom">
                <h6 class="fw-bold text-main mb-4"><i class="bi bi-briefcase me-2"></i> Professional Information</h6>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Years of Experience</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                            <input type="number" class="form-control border-start-0" value="8">
                            <span class="input-group-text">years</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Max Students per Batch</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-people"></i></span>
                            <select class="form-select border-start-0">
                                <option selected>5 students</option>
                                <option>10 students</option>
                                <option>15 students</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">LinkedIn Profile</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-linkedin"></i></span>
                        <input type="text" class="form-control border-start-0" value="https://linkedin.com/in/sarahjohnson">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">GitHub Profile</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-github"></i></span>
                        <input type="text" class="form-control border-start-0" value="https://github.com/sarahjohnson">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Portfolio Website</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-globe"></i></span>
                        <input type="text" class="form-control border-start-0" value="https://sarahjohnson.dev">
                    </div>
                </div>
            </div>

            <div class="card-custom mb-0">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-bold text-main m-0"><i class="bi bi-award me-2"></i> Skills & Expertise</h6>
                    <button class="btn btn-sm btn-link text-decoration-none text-accent"><i class="bi bi-plus"></i> Add Skill</button>
                </div>

                <div class="mb-4">
                    <label class="form-label d-block small fw-bold">Specializations</label>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="skill-badge text-blue border-primary-subtle">Full-Stack Development <i class="bi bi-x ms-1"></i></span>
                        <span class="skill-badge text-blue border-primary-subtle">React.js <i class="bi bi-x ms-1"></i></span>
                        <span class="skill-badge text-blue border-primary-subtle">Node.js <i class="bi bi-x ms-1"></i></span>
                        <span class="skill-badge text-blue border-primary-subtle">DevOps <i class="bi bi-x ms-1"></i></span>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label d-block small fw-bold">Technical Skills</label>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="skill-badge text-blue border-primary-subtle">JavaScript <i class="bi bi-x ms-1"></i></span>
                        <span class="skill-badge text-blue border-primary-subtle">Python <i class="bi bi-x ms-1"></i></span>
                        <span class="skill-badge text-blue border-primary-subtle">AWS <i class="bi bi-x ms-1"></i></span>
                        <span class="skill-badge text-blue border-primary-subtle">Docker <i class="bi bi-x ms-1"></i></span>
                        <span class="skill-badge text-blue border-primary-subtle">MongoDB <i class="bi bi-x ms-1"></i></span>
                    </div>
                </div>

                <div>
                    <label class="form-label d-block small fw-bold">Certifications</label>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <span class="skill-badge text-success border-success-subtle">AWS Solutions Architect <i class="bi bi-x ms-1"></i></span>
                        <span class="skill-badge text-success border-success-subtle">Google Cloud Professional <i class="bi bi-x ms-1"></i></span>
                    </div>
                    <button class="btn btn-sm  fw-bold text-white" style="background-color: var(--accent-color);"><i class="bi bi-patch-check me-1"></i> Skill Verification</button>
                </div>
            </div>

        </div>

        <div class="col-12 col-lg-4">

            <div class="card-custom">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold text-main m-0"><i class="bi bi-file-earmark-arrow-up me-2"></i> Documents</h6>
                    <button class="btn btn-sm btn-link text-decoration-none text-accent"><i class="bi bi-upload text-accent"></i> Upload</button>
                </div>
                <div class="upload-box">
                    <i class="bi bi-cloud-upload fs-1 text-accent d-block mb-2"></i>
                    <h6 class="fw-bold text-main small mb-1">Upload Documents</h6>
                    <small class="d-block" style="font-size: 0.7rem;">Resume, certificates, and credentials</small>
                </div>
            </div>

            <div class="card-custom">
                <h6 class="fw-bold text-main mb-3"><i class="bi bi-calendar-week me-2"></i> Availability</h6>

                <label class="form-label small fw-bold mb-2">Available Days</label>
                <div class="d-flex flex-column gap-2 mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="mon" checked>
                        <label class="form-check-label small text-muted" for="mon">Monday</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="tue" checked>
                        <label class="form-check-label small text-muted" for="tue">Tuesday</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="wed" checked>
                        <label class="form-check-label small text-muted" for="wed">Wednesday</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="thu" checked>
                        <label class="form-check-label small text-muted" for="thu">Thursday</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="fri" checked>
                        <label class="form-check-label small text-muted" for="fri">Friday</label>
                    </div>
                </div>

                <label class="form-label small fw-bold mb-2">Time Preferences</label>
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <label class="small text-muted d-block mb-1">Start Time</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text"><i class="bi bi-clock"></i></span>
                            <input type="text" class="form-control" value="9:00 AM">
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="small text-muted d-block mb-1">End Time</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text"><i class="bi bi-clock"></i></span>
                            <input type="text" class="form-control" value="5:00 PM">
                        </div>
                    </div>
                </div>

                <div class="input-group input-group-sm">
                    <span class="input-group-text"><i class="bi bi-globe"></i></span>
                    <select class="form-select">
                        <option>UTC-5 (Eastern)</option>
                        <option>UTC+5:30 (IST)</option>
                    </select>
                </div>
            </div>

            <div class="card-custom mb-0">
                <h6 class="fw-bold text-main mb-3"><i class="bi bi-shield-check me-2"></i> Profile Verification</h6>

                <div class="bg-bg-hover p-3 rounded text-center border border-accent mb-3">
                    <i class="bi bi-clock-history fs-3 text-accent d-block mb-2"></i>
                    <h6 class="fw-bold text-accent small mb-1">Verification Pending</h6>
                    <small class="text-muted d-block" style="font-size: 0.7rem;">Your profile is under review. You'll be notified once verified.</small>
                </div>

                <button class="btn btn-accent w-100 fw-bold text-dark btn-sm"><i class="bi bi-send me-1"></i> Request Verification</button>
            </div>

        </div>

    </div>

    <div class="action-footer shadow-lg">
        <div class="d-flex justify-content-between align-items-center container-fluid px-0">
            <div class="d-flex gap-2 w-100 justify-content-end">
                <button class="btn btn-outline-primary fw-bold px-4"><i class="bi bi-eye me-1"></i> Preview</button>
                <button class="btn btn-primary fw-bold px-4" style="background-color: var(--accent-color); border: none;"><i class="bi bi-save me-1"></i> Save Profile</button>
            </div>
        </div>
    </div>

</div>
@endsection
