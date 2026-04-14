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
            color: var(--text-blue);
            border: 1px solid var(--border-color);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 5px;
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

        /* .action-footer {
                                                position: fixed;
                                                bottom: 0;
                                                left: 0;
                                                right: 0;
                                                /* background-color: var(--bg-card);
                                border-top: 1px solid var(--border-color);
                                padding: 16px 24px;
                                z-index: 100;
                                }*/

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

    <div class="content-body">
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

            {{-- Profile Header --}}
            <div class="card-custom">
                <div class="profile-header">
                    <div class="position-relative">
                        {{-- Image Logic: Agar DB mein hai toh wo dikhao, warna UI Avatar --}}
                        <img src="{{ $profile && $profile->profile_image ? asset('uploads/mentor_profiles/' . $profile->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->full_name) . '&background=0D8ABC&color=fff' }}"
                            class="profile-avatar-lg" id="profile_img_preview" alt="Profile">

                        {{-- Camera Icon as Trigger --}}
                        <div class="camera-icon" onclick="document.getElementById('profile_image_input').click()">
                            <i class="bi bi-camera"></i>
                        </div>

                        {{-- Hidden File Input --}}
                        <input type="file" name="profile_image" id="profile_image_input" hidden accept="image/*">
                    </div>
                    <div>
                        <h4 class="fw-bold text-main mb-1">{{ $user->full_name }}</h4>
                        <p class="text-blue mb-2">Mentor ID: #{{ $user->id }}</p>
                        <div class="d-flex gap-3 justify-content-center justify-content-lg-start flex-wrap">
                            <span class="badge bg-soft-orange text-accent-color"><i class="bi bi-star-fill me-1"></i>
                                {{ $profile->rating_average ?? '0.0' }}</span>
                            <span class="badge bg-soft-orange text-accent-color"><i class="bi bi-briefcase me-1"></i>
                                {{ $profile->years_of_experience ?? '0' }} years exp.</span>
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
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" value="{{ $firstName }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="{{ $lastName }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control" value="{{ $profile->phone ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Professional Bio</label>
                            <textarea name="bio" class="form-control" rows="3">{{ $profile->bio ?? '' }}</textarea>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">LinkedIn Profile URL</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-linkedin text-primary"></i></span>
                                    <input type="url" name="linkedin_url" class="form-control"
                                        value="{{ $profile->linkedin_url ?? '' }}"
                                        placeholder="https://linkedin.com/in/username">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">GitHub Profile URL</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-github"></i></span>
                                    <input type="url" name="github_url" class="form-control"
                                        value="{{ $profile->github_url ?? '' }}" placeholder="https://github.com/username">
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <label class="form-label">Portfolio Website</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-globe"></i></span>
                                    <input type="url" name="portfolio_url" class="form-control"
                                        value="{{ $profile->portfolio_url ?? '' }}" placeholder="https://yourportfolio.com">
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Years of Experience</label>
                                <input type="number" name="years_of_experience" class="form-control"
                                    value="{{ $profile->years_of_experience ?? '' }}" min="0">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Max Students per Batch</label>
                                <input type="number" name="max_students" class="form-control"
                                    value="{{ $profile->max_students ?? '5' }}" min="1">
                            </div>
                        </div>
                    </div>

                    {{-- Skills & Expertise Section --}}
                    <div class="card-custom">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h6 class="fw-bold text-main m-0"><i class="bi bi-award me-2"></i> Skills & Expertise</h6>
                            <button type="button" class="btn btn-sm btn-link text-decoration-none text-accent"
                                data-bs-toggle="modal" data-bs-target="#addSkillModal">
                                <i class="bi bi-plus"></i> Add Skill
                            </button>
                        </div>

                        {{-- 1. Specializations --}}
                        <p class="mb-2 fw-bold small --text-muted">Specializations</p>
                        <div id="specializations_container" class="d-flex flex-wrap gap-2 mb-4" style="min-height: 40px;">
                            @if(isset($profile->specializations) && $profile->specializations)
                                @foreach(json_decode($profile->specializations) as $skill)
                                    <span class="skill-badge">
                                        {{ $skill }}
                                        <input type="hidden" name="specializations[]" value="{{ $skill }}">
                                        <i class="bi bi-x ms-1 text-danger" style="cursor:pointer"
                                            onclick="this.parentElement.remove()"></i>
                                    </span>
                                @endforeach
                            @endif
                        </div>

                        {{-- 2. Technical Skills --}}
                        <p class="mb-1 fw-bold small --text-muted">Technical Skills</p>
                        <div id="technical_skills_container" class="d-flex flex-wrap gap-2 mb-4" style="min-height: 40px;">
                            @if(isset($profile->technical_skills) && $profile->technical_skills)
                                @foreach(json_decode($profile->technical_skills) as $skill)
                                    <span class="skill-badge">
                                        {{ $skill }}
                                        <input type="hidden" name="technical_skills[]" value="{{ $skill }}">
                                        <i class="bi bi-x ms-1 text-danger" style="cursor:pointer"
                                            onclick="this.parentElement.remove()"></i>
                                    </span>
                                @endforeach
                            @endif
                        </div>

                        {{-- 3. Certifications --}}
                        <p class="mb-1 fw-bold small --text-muted">Certifications</p>
                        <div id="certifications_container" class="d-flex flex-wrap gap-2" style="min-height: 40px;">
                            @if(isset($profile->certifications) && $profile->certifications)
                                @foreach(json_decode($profile->certifications) as $skill)
                                    <span class="skill-badge">
                                        {{ $skill }}
                                        <input type="hidden" name="certifications[]" value="{{ $skill }}">
                                        <i class="bi bi-x ms-1 text-danger" style="cursor:pointer"
                                            onclick="this.parentElement.remove()"></i>
                                    </span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    {{-- Documents --}}
                    <div class="card-custom text-center">
                        <h6 class="fw-bold text-main mb-3 text-start"><i class="bi bi-file-earmark-arrow-up me-2"></i>
                            Documents</h6>
                        <div class="upload-box" onclick="document.getElementById('resume_file').click()">
                            <i class="bi bi-cloud-upload fs-1 text-accent d-block mb-2"></i>
                            <h6 class="fw-bold text-main small mb-1">
                                @if($profile && $profile->resume_url)
                                    <i class="bi bi-file-earmark-check text-success"></i> Resume Uploaded
                                @else
                                    Upload Resume
                                @endif
                            </h6>
                            <input type="file" name="resume" id="resume_file" hidden>
                        </div>
                    </div>

                    {{-- Availability --}}
                    <div class="card-custom">
                        <h6 class="fw-bold text-main mb-3"><i class="bi bi-calendar-week me-2"></i> Availability</h6>
                        @php $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']; @endphp
                        @foreach($days as $day)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="available_days[]" value="{{ $day }}" {{ in_array($day, (array) json_decode($profile->available_days ?? '[]')) ? 'checked' : '' }}>
                                <label class="form-check-label small">{{ $day }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-custom">
                        <h5 class="fw-bold text-main mb-3">Time Preferences</h5>
                        <div class="row g-3">
                            {{-- <div class="col-md-12">
                                <label class="form-label">Timezone</label>
                                <select name="timezone" class="form-select border-0 bg-light">
                                    <option value="Asia/Kolkata" {{ ($profile->timezone ?? '') == 'Asia/Kolkata' ?
                                        'selected' : '' }}>(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                                    <option value="UTC" {{ ($profile->timezone ?? '') == 'UTC' ? 'selected' : '' }}>UTC /
                                        GMT
                                    </option>

                                </select>
                            </div> --}}
                            <div class="col-md-6">
                                <label class="form-label">Start Time</label>
                                <input type="time" name="start_time" class="form-control border-0 "
                                    value="{{ $profile->start_time ?? '09:00' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">End Time</label>
                                <input type="time" name="end_time" class="form-control border-0 "
                                    value="{{ $profile->end_time ?? '18:00' }}">
                            </div>
                        </div>
                    </div>

                    {{-- Profile Verification Section --}}
                    @php
                        $status = $user->account_status ?? 'pending';
                    @endphp

                    <div class="card-custom p-4 mb-0 text-center shadow-sm">
                        <h6 class="fw-bold text-main mb-3 text-start"><i class="bi bi-shield-check me-2"></i> Profile
                            Verification</h6>

                        @if($status == 'pending')
                            {{-- Verification Pending State --}}
                            <div class="p-3 rounded border border-warning mb-3" style="background-color: #fffdf5;">
                                <i class="bi bi-clock-history fs-3 text-warning d-block mb-2"></i>
                                <h6 class="fw-bold text-warning small mb-1">Verification Pending</h6>
                                <p class="text-muted mb-0" style="font-size: 0.75rem;">Your profile is under review. You'll be
                                    notified once verified.</p>
                            </div>
                            <button type="button" class="btn btn-warning w-100 fw-bold btn-sm disabled" style="opacity: 0.7;">
                                <i class="bi bi-hourglass-split me-1"></i> Reviewing...
                            </button>
                        @elseif($status == 'active')
                            {{-- Verified State --}}
                            <div class="p-3 rounded border border-success mb-3">
                                <i class="bi bi-patch-check-fill fs-3 text-success d-block mb-2"></i>
                                <h6 class="fw-bold text-success small mb-1">Verified Profile</h6>
                                <p class="--text-muted mb-0" style="font-size: 0.75rem;">You are a verified mentor on
                                    KickStartSkills.</p>
                            </div>
                            <button type="button" class="btn btn-success w-100 fw-bold btn-sm ">
                                <i class="bi bi-check-all me-1"></i> Verified
                            </button>
                        @else
                            {{-- Request Verification State (If rejected or new) --}}
                            <div class="p-3 rounded border border-accent mb-3" style="background-color: var(--bg-hover);">
                                <i class="bi bi-patch-exclamation fs-3 text-accent d-block mb-2"></i>
                                <h6 class="fw-bold text-accent small mb-1">Verification Required</h6>
                                <p class="text-muted mb-0" style="font-size: 0.75rem;">Complete your profile to request
                                    verification.</p>
                            </div>
                            <button type="button" class="btn btn-accent w-100 fw-bold text-dark btn-sm shadow-sm"
                                style="background-color: var(--accent-color);">
                                <i class="bi bi-send me-1"></i> Request Verification
                            </button>
                        @endif
                    </div>
                </div>

            </div>

            {{-- ACTION FOOTER (Form ke andar hona chahiye) --}}
            <div class="action-footer ">
                <div class="d-flex justify-content-end gap-2 container-fluid">
                    <button type="submit" class="btn btn-primary fw-bold px-5"
                        style="background-color: var(--accent-color); border: none;">
                        <i class="bi bi-save me-1"></i> Save Profile
                    </button>
                </div>
            </div>

            {{-- SKILLS MODAL (Isse FORM ke andar rakha hai taaki checkbox submit ho sakein) --}}
            <div class="modal fade" id="addSkillModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content card-custom p-4">
                        <div class="modal-header border-0 p-0 mb-3">
                            <h5 class="fw-bold text-main">Add Skills & Expertise</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-0">

                            {{-- Step 1: Skill Type Selection --}}
                            <div class="mb-3">
                                <label class="form-label fw-bold">1. Select Skill Type</label>
                                <select id="skill_type_select" class="form-select">
                                    <option value="specializations">Specialization</option>
                                    <option value="technical_skills">Technical Skill</option>
                                    <option value="certifications">Certification</option>
                                </select>
                            </div>

                            {{-- Step 2: Category Selection --}}
                            <div class="mb-3">
                                <label class="form-label fw-bold">2. Choose Category</label>
                                <select id="modal_category_select" class="form-select">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Step 3: Skills List --}}
                            <label class="form-label fw-bold">3. Select Skills</label>
                            <div id="modal_skills_list" class="d-flex flex-wrap gap-2 py-2 border rounded p-2 "
                                style="min-height: 50px;">
                                <p class="--text-muted small m-0">Please select a category first...</p>
                            </div>
                        </div>

                        <div class="modal-footer border-0 p-0 mt-4">
                            <button type="button" class="btn btn-primary w-100 fw-bold" data-bs-dismiss="modal"
                                id="apply_skills_btn" style="background-color: var(--accent-color)!importat; border:none;">
                                Add Selected Skills
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('profile_image_input').addEventListener('change', function (e) {
            if (e.target.files && e.target.files[0]) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('profile_img_preview').src = e.target.result;
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });
        // File Name display logic
        document.getElementById('resume_file').addEventListener('change', function () {
            if (this.files && this.files[0]) {
                document.querySelector('.upload-box h6').innerHTML = '<i class="bi bi-file-earmark-check text-success"></i> ' + this.files[0].name;
            }
        });

        document.getElementById('modal_category_select').addEventListener('change', function () {
            const categoryId = this.value;
            const skillsList = document.getElementById('modal_skills_list');
            const allCategories = @json($categories);

            skillsList.innerHTML = ''; // Clear previous skills

            const category = allCategories.find(c => c.id == categoryId);

            if (category && category.subcategories) {
                category.subcategories.forEach(sub => {
                    skillsList.innerHTML += `
                                <div class="form-check border rounded p-2 px-3  m-1">
                                <input class="form-check-input modal-skill-check" type="checkbox" value="${sub.name}" id="sub_${sub.id}">
                                <label class="form-check-label small" for="sub_${sub.id}">${sub.name}</label>
                                </div>`;
                });
            }
        });

        // Add skills to badge container logic
        document.getElementById('apply_skills_btn').addEventListener('click', function () {
            const skillType = document.getElementById('skill_type_select').value; // specializations, technical_skills, etc.
            const container = document.getElementById(skillType + '_container'); // Sahi container pakdega
            const checkedSkills = document.querySelectorAll('.modal-skill-check:checked');

            if (!container) {
                alert("Container not found! Check your HTML IDs.");
                return;
            }

            if (container.querySelector('p')) container.innerHTML = ''; // Remove "No skills" text

            checkedSkills.forEach(cb => {
                // Duplicate check
                const exists = Array.from(container.querySelectorAll(`input[name="${skillType}[]"]`))
                    .some(input => input.value === cb.value);

                if (!exists) {
                    container.innerHTML += `
                                                        <span class="skill-badge">
                                                            ${cb.value}
                                                            <input type="hidden" name="${skillType}[]" value="${cb.value}">
                                                            <i class="bi bi-x ms-1 text-danger" style="cursor:pointer" onclick="this.parentElement.remove()"></i>
                                                        </span>`;
                }
            });
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
                        style="background-color: var(--accent-color); border:none;">Apply Skills</button>
                </div>
            </div>
        </div>
    </div>
@endsection
