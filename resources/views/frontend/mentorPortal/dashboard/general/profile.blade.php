@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Profile Management')
@section('icon', 'bi bi-person-circle fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')
    <style>
        /* Tera original style as it is */
        :root {
            --bg-card: #ffffff;
            --bg-hover: #f8f9fa;
            --text-main: #343a40;
            --text-muted: #6c757d;
            --border-color: #e9ecef;
            --input-bg: #ffffff;
            --soft-blue: #e7f1ff;
            --text-blue: #0d6efd;
            --soft-green: #d1e7dd;
            --text-green: #0f5132;
            --soft-orange: #ffecb5;
            --text-orange: #664d03;
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
            --soft-green: rgba(25, 135, 84, 0.15);
            --text-green: #75b798;
            --soft-orange: rgba(255, 193, 7, 0.15);
            --text-orange: #ffda6a;
        }

        .card-custom {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .profile-avatar-lg {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--accent-color);
            padding: 2px;
        }

        .camera-icon {
            position: absolute;
            bottom: 0;
            right: 0;
            background-color: var(--accent-color);
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            cursor: pointer;
            border: 2px solid var(--bg-card);
        }

        .form-label {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        .form-control,
        .form-select {
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

        .skill-badge {
            font-size: 0.8rem;
            padding: 6px 12px;
            border-radius: 6px;
            background-color: var(--bg-hover);
            color: var(--text-muted);
            border: 1px solid var(--border-color);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .skill-badge i {
            cursor: pointer;
        }

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

        .upload-box:hover {
            border-color: var(--accent-color);
            color: var(--accent-color);
        }

        .action-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: var(--bg-card);
            border-top: 1px solid var(--border-color);
            padding: 16px 24px;
            z-index: 100;
        }

        @media (max-width: 991px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .action-footer {
                position: sticky;
                margin-left: 0;
            }

            .action-footer .d-flex {
                flex-direction: column;
                gap: 12px;
            }

            .action-footer button {
                width: 100%;
            }

            /* Dropdown ko properly dikhane ke liye */
            .profile-select-custom {
                height: 45px !important;
                background-color: var(--input-bg) !important;
                color: var(--text-main) !important;
                border: 1px solid var(--border-color) !important;
                appearance: auto !important;
                /* System default arrow dikhane ke liye */
            }

            /* Dark mode compatibility */
            [data-theme="dark"] .profile-select-custom option {
                background-color: #1e293b;
                color: #ffffff;
            }
        }
    </style>

    <div class="content-body" style="padding-bottom: 80px;">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert"
                style="background-color: var(--soft-green); color: var(--text-green); border-radius: 12px;">
                <i class="bi bi-check-circle-fill me-2"></i>
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger border-0 shadow-sm mb-4"
                style="background-color: #f8d7da; color: #842029; border-radius: 12px;">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('mentor.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card-custom">
                <div class="profile-header">
                    <div class="position-relative">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->full_name) }}&background=0D8ABC&color=fff"
                            class="profile-avatar-lg" alt="Profile">
                        <div class="camera-icon"><i class="bi bi-camera"></i></div>
                    </div>
                    <div>
                        <h4 class="fw-bold text-main mb-1">{{ $user->full_name }}</h4>
                        <p class="text-blue mb-2">{{ $profile->expertise_area ?? 'N/A' }}</p>
                        <div class="d-flex gap-3 justify-content-center justify-content-lg-start flex-wrap">
                            <span class="badge bg-soft-orange text-accent-color"><i class="bi bi-star-fill me-1"></i> {{
        $profile->rating_average ?? '0.0' }}</span>
                            <span class="badge bg-soft-orange text-accent-color"><i class="bi bi-camera-video me-1"></i> 0
                                sessions</span>
                            <span class="badge bg-soft-orange text-accent-color"><i class="bi bi-briefcase me-1"></i> {{
        $profile->years_of_experience ?? '0' }} years exp.</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12 col-lg-8">
                    {{-- Personal Information --}}
                    <div class="card-custom">
                        <h6 class="fw-bold text-main mb-4"><i class="bi bi-person me-2"></i> Personal Information</h6>

                        <div class="row g-3 mb-3">
                            <div class="col-12 col-md-6">
                                <label class="form-label">First Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" name="first_name" class="form-control border-start-0"
                                        value="{{ $firstName }}">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Last Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" name="last_name" class="form-control border-start-0"
                                        value="{{ $lastName }}">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" class="form-control border-start-0"
                                    value="{{ $user->email }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                <input type="text" name="phone" class="form-control border-start-0"
                                    value="{{ $profile->phone ?? '' }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Professional Bio</label>
                            <div class="input-group">
                                <span class="input-group-text align-items-start pt-2"><i class="bi bi-file-text"></i></span>
                                <textarea name="bio" class="form-control border-start-0"
                                    rows="3">{{ $profile->bio ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Professional Information --}}
                    <div class="card-custom">
                        <h6 class="fw-bold text-main mb-4"><i class="bi bi-briefcase me-2"></i> Professional Information
                        </h6>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Years of Experience</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                    <input type="number" name="years_of_experience" class="form-control"
                                        value="{{ $profile->years_of_experience ?? '' }}">
                                    <span class="input-group-text">years</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Max Students per Batch</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-people"></i></span>
                                    <select name="max_students" class="form-select">
                                        <option value="5" {{ ($profile->max_students ?? '') == 5 ? 'selected' : '' }}>5
                                            students</option>
                                        <option value="10" {{ ($profile->max_students ?? '') == 10 ? 'selected' : '' }}>10
                                            students</option>
                                        <option value="15" {{ ($profile->max_students ?? '') == 15 ? 'selected' : '' }}>15
                                            students</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">LinkedIn Profile</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-linkedin text-primary"></i></span>
                                <input type="text" name="linkedin_url" class="form-control"
                                    value="{{ $profile->linkedin_url ?? '' }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">GitHub Profile</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-github"></i></span>
                                <input type="text" name="github_url" class="form-control"
                                    value="{{ $profile->github_url ?? '' }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Portfolio Website</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-globe"></i></span>
                                <input type="text" name="portfolio_url" class="form-control"
                                    value="{{ $profile->portfolio_url ?? '' }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Primary Specialization</label>
                            <select name="expertise_area" class="form-select profile-select-custom">
                                <option value="" selected disabled>Select Specialization</option>
                                @if(isset($categories) && $categories->count() > 0)
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->category_name }}" {{ (isset($profile->expertise_area) && $profile->expertise_area == $cat->category_name) ? 'selected' : '' }}
                                            style="color: #333;"> {{ $cat->category_name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="card-custom mb-0">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h6 class="fw-bold text-main m-0"><i class="bi bi-award me-2"></i> Skills & Expertise</h6>
                            <button type="button" class="btn btn-sm btn-link text-decoration-none text-accent"><i
                                    class="bi bi-plus"></i> Add Skill</button>
                        </div>

                        <div class="mb-4">
                            <label class="form-label d-block small fw-bold">Specializations</label>
                            <div class="d-flex flex-wrap gap-2">
                                {{-- Abhi ke liye static badges rehne diye hain --}}
                                <span class="skill-badge text-blue border-primary-subtle">Full-Stack Development <i
                                        class="bi bi-x ms-1"></i></span>
                                <span class="skill-badge text-blue border-primary-subtle">React.js <i
                                        class="bi bi-x ms-1"></i></span>
                            </div>
                        </div>

                        <div>
                            <label class="form-label d-block small fw-bold">Certifications</label>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="skill-badge text-success border-success-subtle">AWS Solutions Architect <i
                                        class="bi bi-x ms-1"></i></span>
                            </div>
                            <button type="button" class="btn btn-sm fw-bold text-white"
                                style="background-color: var(--accent-color);"><i class="bi bi-patch-check me-1"></i> Skill
                                Verification</button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card-custom">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-bold text-main m-0"><i class="bi bi-file-earmark-arrow-up me-2"></i> Documents
                            </h6>
                            <button type="button" class="btn btn-sm btn-link text-decoration-none text-accent"><i
                                    class="bi bi-upload text-accent"></i> Upload</button>
                        </div>
                        <div class="upload-box" onclick="document.getElementById('resume_file').click()">
                            <i class="bi bi-cloud-upload fs-1 text-accent d-block mb-2"></i>
                            <h6 class="fw-bold text-main small mb-1">Upload Documents</h6>
                            <small class="d-block" style="font-size: 0.7rem;">Resume, certificates, and credentials</small>
                            <input type="file" name="resume" id="resume_file" hidden>
                        </div>
                    </div>

                    <div class="card-custom">
                        <h6 class="fw-bold text-main mb-3"><i class="bi bi-calendar-week me-2"></i> Availability</h6>
                        <label class="form-label small fw-bold mb-2">Available Days</label>
                        <div class="d-flex flex-column gap-2 mb-4">
                            @php $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']; @endphp
                            @foreach($days as $day)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="available_days[]" value="{{ $day }}"
                                                        id="day_{{ $day }}" {{ in_array($day, (array) json_decode($profile->available_days ??
                                '[]')) ? 'checked' : '' }}>
                                                    <label class="form-check-label small text-muted" for="day_{{ $day }}">{{ $day }}</label>
                                                </div>
                            @endforeach
                        </div>

                        <label class="form-label small fw-bold mb-2">Time Preferences</label>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="small text-muted d-block mb-1">Start Time</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text"><i class="bi bi-clock"></i></span>
                                    <input type="text" name="start_time" class="form-control"
                                        value="{{ $profile->start_time ?? '9:00 AM' }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="small text-muted d-block mb-1">End Time</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text"><i class="bi bi-clock"></i></span>
                                    <input type="text" name="end_time" class="form-control"
                                        value="{{ $profile->end_time ?? '5:00 PM' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-custom mb-0 text-center">
                        <h6 class="fw-bold text-main mb-3"><i class="bi bi-shield-check me-2"></i> Profile Verification</h6>
                        <div class="bg-bg-hover p-3 rounded border border-accent mb-3">
                            <i class="bi bi-clock-history fs-3 text-accent d-block mb-2"></i>
                            <h6 class="fw-bold text-accent small mb-1">Verification Status</h6>
                            <small class="text-muted d-block" style="font-size: 0.7rem;">Status: {{
        ucfirst($user->account_status ?? 'Pending') }}</small>
                        </div>
                        <button type="button" class="btn btn-accent w-100 fw-bold text-dark btn-sm"><i
                                class="bi bi-send me-1"></i> Request Verification</button>
                    </div>
                </div>
            </div>

            {{-- Action Footer --}}
            <div class="action-footer shadow-lg">
                <div class="d-flex justify-content-between align-items-center container-fluid px-0">
                    <div class="d-flex gap-2 w-100 justify-content-end">
                        <button type="button" class="btn btn-outline-primary fw-bold px-4"><i class="bi bi-eye me-1"></i>
                            Preview</button>
                        <button type="submit" class="btn btn-primary fw-bold px-4"
                            style="background-color: var(--accent-color); border: none;">
                            <i class="bi bi-save me-1"></i> Save Profile
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fileInput = document.getElementById('resume_file');
            const uploadBoxTitle = document.querySelector('.upload-box h6');
            const uploadBoxSmall = document.querySelector('.upload-box small');

            if (fileInput) {
                fileInput.addEventListener('change', function () {
                    if (this.files && this.files[0]) {
                        const fileName = this.files[0].name;
                        // UI Update: File ka naam dikhao
                        uploadBoxTitle.innerText = "Selected: " + fileName;
                        uploadBoxTitle.style.color = "var(--text-orange)"; // Highlight color
                        uploadBoxSmall.innerText = "Click again to change the file";
                    }
                });
            }
        });
        document.getElementById('resume_file').addEventListener('change', function () {
            if (this.files && this.files[0]) {
                let name = this.files[0].name;
                // Jahan "Upload Documents" likha hai wahan file name dikhayega
                document.querySelector('.upload-box h6').innerHTML = '<i class="bi bi-file-earmark-check"></i> ' + name;
                document.querySelector('.upload-box h6').style.color = "#198754"; // Green color for success
            }
        });
        document.getElementById('modal_category_select').addEventListener('change', function () {
            const categoryId = this.value;
            const skillsList = document.getElementById('modal_skills_list');
            const allCategories = @json($categories);

            skillsList.innerHTML = '';

            const category = allCategories.find(c => c.id == categoryId);
            if (category && category.subcategories.length > 0) {
                category.subcategories.forEach(sub => {
                    skillsList.innerHTML += `
                    <div class="form-check border rounded p-2 px-3 bg-light m-1" style="min-width: 120px;">
                        <input class="form-check-input" type="checkbox" name="skills[]" value="${sub.subcategory_name}" id="sub_${sub.id}">
                        <label class="form-check-label small" for="sub_${sub.id}">${sub.subcategory_name}</label>
                    </div>`;
                });
            } else {
                skillsList.innerHTML = '<p class="text-muted small p-3">No skills found.</p>';
            }
        });
    </script>

    <div class="modal fade" id="addSkillModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content card-custom p-4">
                <div class="modal-header border-0 p-0 mb-3">
                    <h5 class="fw-bold text-main">Add Skills & Expertise</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    <label class="form-label">Step 1: Choose Category</label>
                    <select id="modal_category_select" class="form-select mb-4">
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach
                    </select>

                    <label class="form-label">Step 2: Select Skills</label>
                    <div id="modal_skills_list" class="d-flex flex-wrap gap-2 py-2">
                        <p class="text-muted small">Please select a category first...</p>
                    </div>
                </div>
                <div class="modal-footer border-0 p-0 mt-4">
                    <button type="button" class="btn btn-primary w-100 fw-bold" data-bs-dismiss="modal"
                        style="background-color: var(--text-orange); border:none;">Apply Skills</button>
                </div>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-sm btn-link text-decoration-none text-accent" data-bs-toggle="modal"
        data-bs-target="#addSkillModal">
        <i class="bi bi-plus"></i> Add Skill
    </button>
@endsection
