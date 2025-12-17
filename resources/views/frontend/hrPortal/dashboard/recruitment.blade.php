@extends('frontend.hrPortal.dashboard.layouts.app')

@section('title', 'Recruitment Pipeline')

@section('icon', 'bi bi-briefcase-fill fs-4 p-2 bg-soft-accent rounded-3 text-accent')

@section('content')
<style>
    /* Stats Cards - Pipeline Specific */
    .stat-card-pipeline {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        text-align: center;
        transition: transform 0.2s;
        height: 100%;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
    }
    .stat-card-pipeline:hover { transform: translateY(-3px); }

    /* Pipeline Colors based on image */
    .stat-blue { color: #3b82f6; border-bottom: 3px solid #3b82f6; }
    .stat-purple { color: #8b5cf6; border-bottom: 3px solid #8b5cf6; }
    .stat-orange { color: #f59e0b; border-bottom: 3px solid #f59e0b; }
    .stat-green { color: #10b981; border-bottom: 3px solid #10b981; }
    .stat-teal { color: #14b8a6; border-bottom: 3px solid #14b8a6; }

    /* Filter Bar */
    .filter-container {
        background-color: var(--bg-card);
        padding: 16px;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        display: flex; gap: 16px; flex-wrap: wrap; align-items: center;
    }

    .search-input {
        background-color: var(--bg-body);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        padding: 10px 16px;
        border-radius: 8px;
        flex-grow: 1;
        min-width: 250px;
    }

    .filter-select {
        background-color: var(--bg-body);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        padding: 10px 16px;
        border-radius: 8px;
        min-width: 150px;
        flex-grow: 1;
    }

    /* Candidate Card */
    .candidate-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        transition: all 0.2s;
        cursor: pointer; /* Clickable */
    }
    .candidate-card:hover {
        border-color: var(--accent-color);
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transform: scale(1.002);
    }

    .avatar-lg {
        width: 56px; height: 56px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem; font-weight: bold;
        background-color: var(--bg-body);
        color: var(--text-main);
        border: 2px solid var(--border-color);
    }

    .skill-pill {
        font-size: 0.7rem;
        padding: 4px 12px;
        border-radius: 20px;
        background-color: rgba(59, 130, 246, 0.1); /* Blue tint default */
        color: #3b82f6;
        border: 1px solid rgba(59, 130, 246, 0.2);
    }

    .stage-badge {
        font-size: 0.75rem;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        background-color: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .rating-star { color: #f59e0b; font-size: 0.85rem; }

    .action-icon {
        width: 32px; height: 32px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 8px;
        border: 1px solid var(--border-color);
        background-color: var(--bg-body);
        color: var(--text-muted);
        transition: 0.2s;
    }
    .action-icon:hover {border: 2px solid var(--border-color); color: white; }

    /* Utility for Header Badge */
    .bg-soft-purple-custom { background-color: rgba(139, 92, 246, 0.15); }

    /* --- MODAL STYLES --- */
    .modal-content-custom {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.5);
    }
    .modal-header-custom {
        border-bottom: 1px solid var(--border-color);
        padding: 20px 24px;
    }
    .modal-body-custom {
        padding: 24px;
        color: var(--text-main);
    }
    .section-label {
        color: var(--accent-color);
        font-weight: 700;
        font-size: 0.85rem;
        margin-bottom: 8px;
        display: block;
    }
    .info-list { list-style: none; padding: 0; margin: 0; }
    .info-list li {
        margin-bottom: 8px; font-size: 0.9rem; color: var(--text-muted); display: flex; align-items: center; gap: 10px;
    }
    .info-list li i { width: 20px; text-align: center; color: var(--text-muted); }

    .btn-action-primary {
        background-color: #10b981; border: none; color: white; padding: 10px 20px; border-radius: 8px; font-weight: 600; width: 100%; transition: 0.2s;
    }
    .btn-action-primary:hover { background-color: #059669; }

    .btn-action-secondary {
        background-color: transparent; border: 1px solid var(--border-color); color: var(--text-main); padding: 10px 20px; border-radius: 8px; font-weight: 600; width: 100%; transition: 0.2s;
    }
    .btn-action-secondary:hover { border-color: var(--accent-color); color: var(--accent-color); }
</style>

<div class="d-flex justify-content-between align-items-center mb-4 filter-container">
    <h5 class="fw-bold m-0 text-main">Recruitment Pipeline</h5>
    <div class="d-flex align-items-center gap-3">
        <span class="badge bg-soft-purple-custom text-accent px-3 py-2 rounded-pill border border-light border-opacity-10">5 Total Applications</span>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-6 col-md"> <div class="stat-card-pipeline stat-blue"><h3 class="fw-bold mb-0 text-main">0</h3><span class="--text-muted-custom small mt-1">Applied</span></div></div>
    <div class="col-6 col-md"><div class="stat-card-pipeline stat-purple"><h3 class="fw-bold mb-0 text-main">1</h3><span class="--text-muted-custom small mt-1">Screening</span></div></div>
    <div class="col-6 col-md"><div class="stat-card-pipeline stat-orange"><h3 class="fw-bold mb-0 text-main">3</h3><span class="--text-muted-custom small mt-1">Interview</span></div></div>
    <div class="col-6 col-md"><div class="stat-card-pipeline stat-green"><h3 class="fw-bold mb-0 text-main">1</h3><span class="--text-muted-custom small mt-1">Offer</span></div></div>
    <div class="col-6 col-md"><div class="stat-card-pipeline stat-teal"><h3 class="fw-bold mb-0 text-main">0</h3><span class="--text-muted-custom small mt-1">Hired</span></div></div>
</div>

<div class="filter-container mb-4">
    <div class="d-flex align-items-center flex-grow-1 gap-2 w-100 w-md-auto">
        <i class="bi bi-search text-muted-custom fs-5"></i>
        <input type="text" class="search-input" placeholder="Search candidates...">
    </div>
    <div class="d-flex gap-3 w-100 w-md-auto">
        <select class="filter-select"><option>All Jobs</option><option>Software Engineer</option></select>
        <select class="filter-select"><option>All Stages</option><option>Applied</option></select>
    </div>
</div>

<div class="d-flex flex-column gap-3">

    <div class="candidate-card" data-bs-toggle="modal" data-bs-target="#candidateModal">
        <div class="row align-items-center g-3">
            <div class="col-12 col-lg-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-lg text-accent" style="background-color: var(--soft-accent); border-color: var(--accent-color);">SJ</div>
                    <div>
                        <h5 class="fw-bold text-main mb-1">Sarah Johnson</h5>
                        <div class="--text-muted-custom small">Senior Software Engineer</div>
                        <small class="--text-muted-custom d-block mt-1" style="font-size: 0.7rem;">5 years • LinkedIn</small>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="d-flex flex-wrap gap-2">
                    <span class="skill-pill">React</span><span class="skill-pill">Node.js</span><span class="skill-pill">Python</span><span class="skill-pill">AWS</span>
                </div>
                <div class="mt-2 --text-muted-custom small"><i class="bi bi-calendar3 me-1"></i> Applied 702 days ago</div>
            </div>
            <div class="col-12 col-lg-3 text-lg-center"></div>
            <div class="col-12 col-lg-2 text-lg-end">
                <div class="d-flex flex-column align-items-lg-end gap-2">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="stage-badge" style="color: #8b5cf6; background-color: rgba(139, 92, 246, 0.1); border-color: rgba(139, 92, 246, 0.2);">Technical Interview</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-lg-end gap-1 mb-2">
                        <i class="bi bi-star-fill rating-star"></i><span class="text-main small fw-bold">4.2</span>
                    </div>
                    <div class="d-flex gap-2 justify-content-lg-end">
                        <button class="action-icon text-success"><i class="bi bi-arrow-right"></i></button>
                        <button class="action-icon text-primary"><i class="bi bi-file-earmark-text"></i></button>
                        <button class="action-icon"><i class="bi bi-three-dots-vertical"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="candidate-card">
        <div class="row align-items-center g-3">
            <div class="col-12 col-lg-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-lg" style="color: #8b5cf6; background-color: rgba(139, 92, 246, 0.1); border-color: #8b5cf6;">MC</div>
                    <div>
                        <h5 class="fw-bold text-main mb-1">Michael Chen</h5>
                        <div class="--text-muted-custom small">Marketing Manager</div>
                        <small class="--text-muted-custom d-block mt-1" style="font-size: 0.7rem;">7 years • Company Website</small>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="d-flex flex-wrap gap-2">
                    <span class="skill-pill">Digital Marketing</span><span class="skill-pill">SEO</span>
                </div>
                <div class="mt-2 --text-muted-custom small"><i class="bi bi-calendar3 me-1"></i> Applied 707 days ago</div>
            </div>
            <div class="col-12 col-lg-3 text-lg-center"></div>
            <div class="col-12 col-lg-2 text-lg-end">
                <div class="d-flex flex-column align-items-lg-end gap-2">
                    <div class="d-flex align-items-center gap-2 mb-1"><span class="stage-badge">Final Interview</span></div>
                    <div class="d-flex align-items-center justify-content-lg-end gap-1 mb-2"><i class="bi bi-star-fill rating-star"></i><span class="text-main small fw-bold">4.5</span></div>
                    <div class="d-flex gap-2 justify-content-lg-end">
                        <button class="action-icon text-success"><i class="bi bi-arrow-right"></i></button>
                        <button class="action-icon text-primary"><i class="bi bi-file-earmark-text"></i></button>
                        <button class="action-icon"><i class="bi bi-three-dots-vertical"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="candidateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content-custom">

            <div class="modal-header-custom d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-lg text-accent" style="background-color: var(--soft-accent); border-color: var(--accent-color);">SJ</div>
                    <div>
                        <h5 class="fw-bold text-main mb-0">Sarah Johnson</h5>
                        <div class="--text-muted small">Senior Software Engineer</div>
                        <small class="text-warning"><i class="bi bi-star-fill me-1"></i> 4.2/5.0</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body-custom">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <span class="section-label">Contact Information</span>
                        <ul class="info-list">
                            <li><i class="bi bi-envelope"></i> sarah.johnson@email.com</li>
                            <li><i class="bi bi-telephone"></i> +1 234 567 8901</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <span class="section-label">Application Details</span>
                        <ul class="info-list">
                            <li><i class="bi bi-briefcase"></i> Experience: 5 years</li>
                            <li><i class="bi bi-globe"></i> Source: LinkedIn</li>
                            <li><i class="bi bi-cash"></i> Expected: $95,000</li>
                            <li><i class="bi bi-clock"></i> Availability: Immediate</li>
                        </ul>
                    </div>
                </div>

                <div class="mb-4">
                    <span class="section-label">Skills</span>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="skill-pill">React</span>
                        <span class="skill-pill">Node.js</span>
                        <span class="skill-pill">Python</span>
                        <span class="skill-pill">AWS</span>
                    </div>
                </div>

                <div class="mb-4">
                    <span class="section-label">Notes</span>
                    <p class="--text-muted small m-0">Strong technical background, excellent communication skills. Performed well in the coding challenge.</p>
                </div>

                <div class="mt-2">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <small class="--text-muted">Current Stage:</small>
                        <span class="stage-badge" style="color: #8b5cf6; background-color: rgba(139, 92, 246, 0.1); border-color: rgba(139, 92, 246, 0.2);">Technical Interview</span>
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <button class="btn-action-primary">
                                <i class="bi bi-arrow-right me-2"></i> Move Forward
                            </button>
                        </div>
                        <div class="col-6">
                            <button class="btn-action-secondary">
                                <i class="bi bi-calendar-event me-2"></i> Schedule
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
