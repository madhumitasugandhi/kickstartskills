@extends('frontend.hrPortal.dashboard.layouts.app')
@section('content')
@section('title', 'Professional Profile')
@section('icon', 'bi bi-person-circle fs-4 p-2 bg-soft-orange rounded-3 text-accent')


    <style>
        .card-custom {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: 0.3s ease;
        }

        .profile-avatar-lg {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--soft-accent);
        }

        .camera-btn {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: var(--accent-color);
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 3px solid var(--bg-card);
        }

        .form-label {
            font-weight: 600;
            color: var(--text-main);
            font-size: 0.85rem;
        }

        .form-control,
        .form-select {
            background: var(--bg-body);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            padding: 10px 15px;
            font-size: 0.85rem;
        }

        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.25rem var(--soft-accent);
        }

        .btn-purple {
            background: var(--accent-color);
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-purple:hover {
            background: #6d28d9;
            transform: translateY(-2px);
        }

        .bg-soft-purple {
            background: var(--soft-accent);
            color: var(--accent-color);
        }
    </style>

    <div class="content-body px-4 py-4">
        <form action="{{ route('hr.profile.update') }}" method="POST" enctype="multipart/form-data" id="hrProfileForm">
            @csrf
            @method('PUT')

            {{-- Header Card --}}
            <div class="card-custom mb-4">
                <div class="d-flex flex-column flex-md-row align-items-center gap-4">
                    <div class="position-relative">
                        <img src="{{ (isset($profile) && $profile->profile_image) ? asset('uploads/hr_profiles/' . $profile->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->full_name) . '&background=7c3aed&color=fff' }}"
                            id="hr_img_preview" class="profile-avatar-lg">
                        <div class="camera-btn" onclick="document.getElementById('hr_image_input').click()">
                            <i class="bi bi-camera-fill"></i>
                        </div>
                        <input type="file" name="profile_image" id="hr_image_input" hidden onchange="previewImage(this)">
                    </div>
                    <div class="text-center text-md-start">
                        <h4 class="fw-bold text-main mb-1">{{ $user->full_name }}</h4>
                        <p class="--text-muted mb-2">{{ $profile->designation ?? 'HR Executive' }} at <span
                                class="text-accent">{{ $profile->company_name ?? 'Update Company' }}</span></p>
                        <div class="d-flex gap-2 justify-content-center justify-content-md-start">
                            <span class="badge bg-soft-purple px-3 py-2 rounded-pill">HR Portal Verified</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                {{-- Personal Info --}}
                <div class="col-lg-6">
                    <div class="card-custom h-100">
                        <h6 class="fw-bold mb-4 text-accent"><i class="bi bi-person-circle me-2"></i>Personal Details</h6>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" value="{{ $firstName }}">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="{{ $lastName }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Contact Number</label>
                                <input type="text" name="phone" class="form-control" value="{{ $profile->phone ?? '' }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Professional Details --}}
                <div class="col-lg-6">
                    <div class="card-custom h-100">
                        <h6 class="fw-bold mb-4 text-accent"><i class="bi bi-briefcase-fill me-2"></i>Professional Info</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Designation</label>
                                <input type="text" name="designation" class="form-control"
                                    value="{{ $profile->designation ?? '' }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label">LinkedIn Profile URL</label>
                                <input type="url" name="linkedin_url" class="form-control"
                                    value="{{ $profile->linkedin_url ?? '' }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Office Location</label>
                                <input type="text" name="office_location" class="form-control"
                                    value="{{ $profile->office_location ?? '' }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Company Section --}}
                <div class="col-12">
                    <div class="card-custom">
                        <h6 class="fw-bold mb-4 text-accent"><i class="bi bi-building me-2"></i>Company Information</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Company Name</label>
                                <input type="text" name="company_name" class="form-control"
                                    value="{{ $profile->company_name ?? '' }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Company Website</label>
                                <input type="url" name="company_website" class="form-control"
                                    value="{{ $profile->company_website ?? '' }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Industry Type</label>
                                <select name="industry_type" class="form-select">
                                    <option value="IT" {{ ($profile->industry_type ?? '') == 'IT' ? 'selected' : '' }}>IT
                                        Services</option>
                                    <option value="Recruitment" {{ ($profile->industry_type ?? '') == 'Recruitment' ? 'selected' : '' }}>Recruitment Agency</option>
                                    <option value="Corporate" {{ ($profile->industry_type ?? '') == 'Corporate' ? 'selected' : '' }}>Corporate</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Recruitment Focus</label>
                                <textarea name="recruitment_focus" class="form-control"
                                    rows="2">{{ $profile->recruitment_focus ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-purple shadow">Update HR Profile</button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('hr_img_preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
