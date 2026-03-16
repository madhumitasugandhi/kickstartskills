@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Portfolio')
@section('icon', 'bi bi-briefcase fs-4 p-2 bg-primary bg-opacity-10 rounded-3 text-primary')

@section('content')
<style>
    /* Aapka original CSS yahan rahega (Same as before) */
    :root {
        --bg-body: #f8f9fa;
        --bg-sidebar: #ffffff;
        --bg-card: #ffffff;
        --text-main: #343a40;
        --text-muted: #6c757d;
        --border-color: #e9ecef;
        --soft-blue: #e7f1ff;
        --text-blue: #0d6efd;
        --soft-green: #d1e7dd;
        --text-green: #0f5132;
        --soft-orange: #ffecb5;
        --text-orange: #664d03;
        --soft-teal: #e0fbf6;
        --text-teal: #107c6f;
    }

    [data-theme="dark"] {
        --bg-body: #0f1626;
        --bg-sidebar: #1e293b;
        --bg-card: #2e333f;
        --text-main: #e9ecef;
        --text-muted: #adb5bd;
        --border-color: #767677;
        --soft-blue: rgba(13, 110, 253, 0.15);
        --text-blue: #6ea8fe;
        --soft-green: rgba(25, 135, 84, 0.15);
        --text-green: #75b798;
        --soft-orange: rgba(255, 193, 7, 0.15);
        --text-orange: #ffda6a;
        --soft-teal: rgba(32, 201, 151, 0.15);
        --text-teal: #a9e5d6;
    }

    .card-custom {
        border: 1px solid var(--border-color);
        border-radius: 12px;
        background: var(--bg-card);
        padding: 24px;
        margin-bottom: 24px;
    }

    .section-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .resume-box {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        color: var(--text-main);
        font-family: monospace;
        overflow: hidden;
    }

    .project-card {
        border: 1px solid var(--border-color);
        border-radius: 12px;
        overflow: hidden;
        height: 100%;
        background: var(--bg-card);
        transition: transform 0.2s;
        display: flex;
        flex-direction: column;
    }

    .project-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .project-header {
        height: 140px;
        background-color: var(--soft-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-blue);
        font-size: 3rem;
    }

    .project-body {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .badge-tech {
        background-color: var(--border-color);
        color: var(--text-main);
        font-size: 0.75rem;
        padding: 4px 8px;
        border-radius: 4px;
        margin-right: 4px;
        display: inline-block;
        margin-bottom: 4px;
    }

    .skill-bar-container {
        height: 8px;
        background-color: var(--border-color);
        border-radius: 4px;
        overflow: hidden;
        margin-top: 8px;
    }

    .skill-bar {
        height: 100%;
        border-radius: 4px;
    }

    .achievement-item {
        background-color: var(--soft-green);
        border-radius: 12px;
        padding: 16px;
        display: flex;
        align-items: flex-start;
        gap: 16px;
        margin-bottom: 12px;
    }

    .achievement-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        background-color: rgba(255, 255, 255, 0.5);
        flex-shrink: 0;
    }

    .bg-light-blue {
        background-color: #e0f2fe;
    }

    .bg-light-green {
        background-color: #dcfce7;
    }

    .bg-light-orange {
        background-color: #ffedd5;
    }

    [data-theme="dark"] .bg-light-blue {
        background-color: rgba(14, 165, 233, 0.15);
    }

    [data-theme="dark"] .bg-light-green {
        background-color: rgba(34, 197, 94, 0.15);
    }

    [data-theme="dark"] .bg-light-orange {
        background-color: rgba(249, 115, 22, 0.15);
    }
</style>

<div class="content-body">

    <div class="card-custom">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="section-icon bg-soft-blue text-primary">
                <i class="bi bi-person-lines-fill"></i>
            </div>
            <h6 class="fw-bold m-0 text-main fs-5">Professional Summary</h6>
        </div>
        <div class="mb-4">
            <label class="form-label small fw-bold" style="color: var(--text-muted)">Bio/Summary</label>
            <div class="p-3 rounded" style="color: var(--text-main); border: 1px solid var(--border-color);">
                Passionate Computer Engineering student with expertise in Flutter development and UI/UX design. (Static
                Demo Data)
            </div>
        </div>
        <div>
            <label class="form-label small fw-bold" style="color: var(--text-muted)">Resume/CV</label>
            <div class="resume-box">
                <i class="bi bi-file-earmark-pdf text-danger me-2 flex-shrink-0"></i>
                <span class="text-truncate me-2">john_doe_cv_2025_updated.pdf (Static)</span>
                <span class="ms-auto text-primary small fw-bold flex-shrink-0" style="cursor: pointer;">Download</span>
            </div>
        </div>
    </div>

    <div class="card-custom">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="section-icon bg-soft-blue text-primary">
                <i class="bi bi-globe"></i>
            </div>
            <h6 class="fw-bold m-0 text-main fs-5">Social Links & Online Presence</h6>
        </div>
        <div class="mb-3"><label class="form-label small fw-bold" style="color: var(--text-muted)">LinkedIn</label>
            <div class="resume-box">https://linkedin.com/in/johndoe</div>
        </div>
        <div class="mb-3"><label class="form-label small fw-bold" style="color: var(--text-muted)">GitHub</label>
            <div class="resume-box">https://github.com/johndoe</div>
        </div>
    </div>

    <div class="mb-4">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="d-flex align-items-center gap-3">
                <div class="section-icon bg-soft-orange text-warning">
                    <i class="bi bi-folder"></i>
                </div>
                <h6 class="fw-bold m-0 text-main fs-5">Projects Showcase</h6>
            </div>
            <button class="btn btn-sm btn-primary px-3" data-bs-toggle="modal" data-bs-target="#addProjectModal">
                <i class="bi bi-plus-lg me-1"></i> Add Project
            </button>
        </div>

        <div class="row g-4">
            @forelse($projects as $project)
            <div class="col-12 col-md-6">
                <div class="project-card">
                    <div class="project-header bg-light-blue">
                        <i class="bi bi-code-slash"></i>
                    </div>
                    <div class="project-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="fw-bold text-main m-0">{{ $project->project_title }}</h6>
                            <span class="badge bg-success rounded-pill" style="font-size: 0.65rem;">Live</span>
                        </div>
                        <p class="small mb-3 flex-grow-1" style="color: var(--text-muted)">{{
                            $project->project_description }}</p>
                        <div class="mb-3">
                            @foreach(explode(',', $project->tech_stack) as $tech)
                            <span class="badge-tech">{{ trim($tech) }}</span>
                            @endforeach
                        </div>
                        <div class="d-flex gap-2 project-actions">
                            @if($project->project_link)
                            <a href="{{ $project->project_link }}" target="_blank"
                                class="btn btn-light btn-sm flex-grow-1 border">
                                <i class="bi bi-box-arrow-up-right me-1"></i> Live
                            </a>
                            @endif

                            <a href="{{ $project->github_link ?? '#' }}" target="_blank"
                                class="btn btn-light btn-sm flex-grow-1 border">
                                <i class="bi bi-github me-1"></i> Code
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5 card-custom">
                <p class="--text-muted">No projects found. Click "Add Project" to begin!</p>
            </div>
            @endforelse
        </div>
    </div>

    <div class="card-custom">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="section-icon bg-soft-green text-success"><i class="bi bi-cpu"></i></div>
                <h6 class="fw-bold m-0 text-main fs-5">Skills Overview</h6>
            </div>
            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addSkillModal">
                <i class="bi bi-plus"></i> Add Skill
            </button>
        </div>

        <div class="row g-4">
            @forelse($skills as $skill)
            @php
            // Map text level to percentage
            $percent = ($skill->level == 'Advanced') ? 100 : (($skill->level == 'Intermediate') ? 66 : 33);
            $color = ($skill->level == 'Advanced') ? 'bg-success' : (($skill->level == 'Intermediate') ? 'bg-warning' :
            'bg-info');
            @endphp
            <div class="col-12 col-md-6">
                <div class="mb-4">
                    <div class="d-flex justify-content-between small fw-bold text-main">
                        <span>{{ $skill->skill_name }} <small class="text-muted">({{ $skill->type }})</small></span>
                        <span>{{ $percent }}%</span>
                    </div>
                    <div class="skill-bar-container">
                        <div class="skill-bar {{ $color }}" style="width: {{ $percent }}%;"></div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-3">
                <p class="--text-muted small">No skills added yet.</p>
            </div>
            @endforelse
        </div>
    </div>

    <div class="card-custom">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="section-icon bg-soft-teal text-success"><i class="bi bi-trophy"></i></div>
            <h6 class="fw-bold m-0 text-main fs-5">Achievements</h6>
        </div>
        <div class="achievement-item bg-light-green">
            <div class="achievement-icon text-success"><i class="bi bi-award"></i></div>
            <div>
                <h6 class="fw-bold text-main m-0">Winner - Tech Competition</h6><small class="--text-muted">First place
                    in
                    mobile app development.</small>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="addProjectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add New Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('student.profile.portfolio.save') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Project Title URL </label>
                        <input type="text" name="project_title" class="form-control"
                            placeholder="https://ypur_project.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Tech Stack (comma separated)</label>
                        <input type="text" name="tech_stack" class="form-control"
                            placeholder="e.g. Laravel, Bootstrap, MySQL">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">GitHub Repository URL</label>
                        <input type="url" name="github_link" class="form-control"
                            placeholder="https://github.com/your-repo">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Description</label>
                        <textarea name="project_description" class="form-control" rows="4"
                            placeholder="Briefly describe what you built..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Save Project</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addSkillModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add Technical Skill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="/student/dashboard/profile/portfolio/skills/save" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Skill Name</label>
                        <input type="text" name="skill_name" class="form-control" placeholder="e.g. Laravel" required>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Type</label>
                            <select name="type" class="form-select">
                                <option value="current">Current Skill</option>
                                <option value="learning">Learning</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">Level</label>
                            <select name="level" class="form-select">
                                <option value="Beginner">Beginner</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Advanced">Advanced</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary px-4">Save Skill</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
