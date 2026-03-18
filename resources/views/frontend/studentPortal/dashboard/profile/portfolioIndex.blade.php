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
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="section-icon bg-soft-blue text-primary">
                    <i class="bi bi-person-lines-fill"></i>
                </div>
                <h6 class="fw-bold m-0 text-main fs-5">Professional Summary</h6>
            </div>
            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                <i class="bi bi-pencil-square"></i> Edit
            </button>
        </div>
        <div class="mb-4">
            <label class="form-label small fw-bold" style="color: var(--text-muted)">Bio/Summary</label>
            <div class="p-3 rounded" style="color: var(--text-main); border: 1px solid var(--border-color);">
                {{ $profile->bio ?? 'No bio added yet. Click edit to update your profile!' }}
            </div>
        </div>

        <div>
            <label class="form-label small fw-bold" style="color: var(--text-muted)">Resume/CV</label>
            <div class="resume-box">
                <i class="bi bi-file-earmark-pdf text-danger me-2 flex-shrink-0"></i>
                <span class="text-truncate me-2">
                    {{ $profile->resume_url ?? 'No resume uploaded' }}
                </span>
                <span class="ms-auto text-primary small fw-bold flex-shrink-0" style="cursor: pointer;">
                    {{ isset($profile->resume_url) ? 'Download' : 'Upload' }}
                </span>
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
        <div class="mb-3">
            <label class="form-label small fw-bold" style="color: var(--text-muted)">LinkedIn</label>
            <div class="resume-box">
                {{ $profile->linkedin_url ?? 'https://linkedin.com/in/your-profile' }}
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label small fw-bold" style="color: var(--text-muted)">GitHub</label>
            <div class="resume-box">
                {{ $profile->github_url ?? 'https://github.com/your-username' }}
            </div>
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

        <div class="row g-4 mb-3">
            @forelse($projects as $project)
            <div class="col-12 col-md-6">
                <div class="project-card">
                    <div class="project-header bg-light-blue position-relative"> <i class="bi bi-code-slash"></i>

                        <form action="{{ route('student.profile.portfolio.delete', $project->id) }}" method="POST"
                            class="position-absolute top-0 end-0 m-2"
                            onsubmit="return confirm('Are you sure you want to delete this project?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger shadow-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                    <div class="project-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="fw-bold text-main m-0">{{ $project->project_title }}</h6>
                            <span class="badge bg-success rounded-pill" style="font-size: 0.65rem;">Live</span>
                        </div>

                        <p class="small mb-3 flex-grow-1" style="color: var(--text-muted)">
                            {{ $project->project_description }}
                        </p>

                        <div class="d-flex gap-2 project-actions">
                            @if($project->project_link)
                            <a href="{{ $project->project_link }}" target="_blank"
                                class="btn btn-light btn-sm flex-grow-1 border">
                                <i class="bi bi-box-arrow-up-right me-1"></i> Live
                            </a>
                            @endif

                            @if($project->github_link)
                            <a href="{{ $project->github_link }}" target="_blank"
                                class="btn btn-light btn-sm flex-grow-1 border">
                                <i class="bi bi-github me-1"></i> Code
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div> @empty
            <div class="col-12 text-center py-5 card-custom">
                <p class="--text-muted">No projects found. Click "Add Project" to begin!</p>
            </div>
            @endforelse
        </div>

        <div class="card-custom">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="section-icon bg-soft-green text-success">
                        <i class="bi bi-cpu"></i>
                    </div>
                    <h6 class="fw-bold m-0 text-main fs-5">Skills Overview</h6>
                </div>
                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addSkillModal">
                    <i class="bi bi-plus"></i> Add Skill
                </button>
            </div>

            <div class="row g-4">
                @forelse($skills as $skill)
                @php
                // Mapping levels to John Doe style percentages
                $percent = match($skill->level) {
                'Advanced' => 100,
                'Intermediate' => 66,
                'Beginner' => 33,
                default => 50,
                };

                $barColor = match($skill->level) {
                'Advanced' => 'bg-success',
                'Intermediate' => 'bg-warning',
                default => 'bg-info',
                };
                @endphp
                <div class="col-12 col-md-6">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="d-flex align-items-center gap-2">
                                <span class="small fw-bold text-main">{{ $skill->skill_name }}</span>

                                <form action="{{ route('student.profile.skills.delete', $skill->id) }}" method="POST"
                                    onsubmit="return confirm('Remove this skill?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn p-0 border-0 lh-1 text-danger opacity-50 shadow-none">
                                        <i class="bi bi-x-circle-fill" style="font-size: 0.75rem;"></i>
                                    </button>
                                </form>
                            </div>
                            <span class="small fw-bold text-main">{{ $percent }}%</span>
                        </div>
                        <div class="skill-bar-container">
                            <div class="skill-bar {{ $barColor }}" style="width: {{ $percent }}%;"></div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-3">
                    <p class="--text-muted small">No skills saved. Use the "Add Skill" button to showcase your expertise!
                    </p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="card-custom">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="section-icon bg-soft-teal text-success">
                        <i class="bi bi-trophy"></i>
                    </div>
                    <h6 class="fw-bold m-0 text-main fs-5">Achievements</h6>
                </div>
                <button class="btn btn-sm btn-outline-success px-3" data-bs-toggle="modal"
                    data-bs-target="#addAchievementModal">
                    <i class="bi bi-plus-lg me-1"></i> Add
                </button>
            </div>

            @forelse($achievements as $ach)
            <div class="achievement-item bg-light-green position-relative mb-3">
                <div class="achievement-icon text-success">
                    <i class="bi bi-award"></i>
                </div>
                <div class="flex-grow-1">
                    <h6 class="fw-bold text-main m-0">{{ $ach->title }}</h6>
                    <div class="d-flex justify-content-between align-items-start">
                        <small class="text-success fw-bold">{{ $ach->organization }}</small>
                    </div>
                    <p class="small m-0 --text-muted">{{ $ach->description }}</p>
                </div>

                <form action="{{ route('student.profile.achievements.delete', $ach->id) }}" method="POST" class="ms-2"
                    onsubmit="return confirm('Delete this achievement?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link text-danger p-0 border-0 shadow-none">
                        <i class="bi bi-x-circle-fill"></i>
                    </button>
                </form>
            </div>
            @empty
            <div class="text-center py-3">
                <p class="--text-muted small mb-0">No achievements added yet. Show off your wins!</p>
            </div>
            @endforelse
        </div>

    </div>

    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow bg-black bg-opacity-75">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Edit Professional Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('student.profile.profile.update_links') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Professional Bio</label>
                            <textarea name="bio" class="form-control" rows="4"
                                placeholder="Briefly describe yourself...">{{ $profile->bio ?? '' }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-danger">
                                <i class="bi bi-file-pdf"></i> Upload Resume (PDF only)
                            </label>
                            <input type="file" name="resume_file" class="form-control" accept=".pdf">
                            @if(isset($profile->resume_url))
                            <small class="text-success">Current: {{ $profile->resume_url }}</small>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">LinkedIn URL</label>
                            <input type="url" name="linkedin_url" class="form-control"
                                value="{{ $profile->linkedin_url ?? '' }}" placeholder="https://linkedin.com/in/...">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">GitHub URL</label>
                            <input type="url" name="github_url" class="form-control"
                                value="{{ $profile->github_url ?? '' }}" placeholder="https://github.com/...">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary px-4">Save Profile & Resume</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addProjectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-muted">Add New Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('student.profile.portfolio.save') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Project Title</label>
                            <input type="text" name="project_title" class="form-control" placeholder="e.g. Uplynk India"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Project Live URL</label>
                            <input type="url" name="project_link" class="form-control"
                                placeholder="https://uplynkindia.com">
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
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-muted">Select Your Skills</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('student.profile.skills.save') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label class="form-label small fw-bold mb-3 text-muted">Pick a Category and Select a
                            Skill</label>

                        <div class="accordion" id="skillsAccordion">
                            @foreach($categories as $category)
                            <div class="accordion-item mb-2 border rounded">
                                <h2 class="accordion-header" id="heading{{ $category->id }}">
                                    <button class="accordion-button collapsed py-2" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $category->id }}">
                                        <i class="bi {{ $category->icon ?? 'bi-tag' }} me-2 text-primary"></i>
                                        {{ $category->name }} </button>
                                </h2>
                                <div id="collapse{{ $category->id }}" class="accordion-collapse collapse"
                                    data-bs-parent="#skillsAccordion">
                                    <div class="accordion-body bg-light bg-opacity-10">
                                        <div class="row g-2">
                                            @foreach($category->subcategories as $sub)
                                            <div class="col-md-6">
                                                <div class="form-check p-2 border rounded bg-white shadow-sm">
                                                    <input class="form-check-input ms-0 me-2" type="radio"
                                                        name="skill_name" value="{{ $sub->name }}"
                                                        id="sub{{ $sub->id }}" required>
                                                    <label class="form-check-label small fw-bold"
                                                        for="sub{{ $sub->id }}">
                                                        {{ $sub->name }} </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <hr class="my-4">

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
                        <button type="submit" class="btn btn-primary px-5 shadow-sm">Add to Portfolio</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addAchievementModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Add Achievement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('student.profile.achievements.save') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Achievement Title</label>
                            <input type="text" name="title" class="form-control"
                                placeholder="e.g. Winner - Web Design Hackathon" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Issuing Organization</label>
                            <input type="text" name="organization" class="form-control"
                                placeholder="e.g. IIT Bombay / Google Cloud">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Short Description</label>
                            <textarea name="description" class="form-control" rows="3"
                                placeholder="Describe your achievement..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success px-4">Save Achievement</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @endsection
