@extends('frontend.studentPortal.dashboard.layouts.app')
@section('content')
@section('title', 'Personal Info')
@section('icon', 'bi bi-pencil-square fs-4 p-2 bg-primary bg-opacity-10 rounded-3 text-primary')

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

    /* Use your variables to keep inputs consistent with the theme */
    .form-control,
    .form-select,
    .input-group-text {
        background-color: var(--bg-card) !important;
        color: var(--text-main) !important;
        border: 1px solid var(--border-color) !important;
    }

    /* Fix for disabled state (when you aren't editing) */
    .form-control:disabled,
    .form-select:disabled {
        background-color: var(--bg-card) !important;
        opacity: 0.7;
        /* Slightly dim so it looks read-only */
        color: var(--text-muted) !important;
    }

    /* Highlight the border when user clicks to edit */
    .form-control:focus,
    .form-select:focus {
        border-color: var(--text-blue) !important;
        box-shadow: 0 0 0 0.25rem var(--soft-blue) !important;
        background-color: var(--bg-card) !important;
        color: var(--text-main) !important;
    }

    /* Ensure icons match text color */
    .input-group-text i {
        color: var(--text-muted);
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

    .btn-save-group {
        transition: all 0.3s ease;
    }
</style>
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert"
    style="background: var(--soft-green); color: var(--text-green);">
    <div class="d-flex align-items-center">
        <i class="bi bi-check-circle-fill me-2"></i>
        <div>
            <strong>Success!</strong> {{ session('success') }}
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert"
    style="background: var(--soft-red); color: var(--text-red);">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="content-body">
    <div class="card-custom">
        <div class="d-flex flex-column flex-md-row align-items-center gap-4">
            <div class="profile-avatar">
                <i class="bi bi-person"></i>
            </div>

            <div class="text-center text-md-start flex-grow-1">
                <h4 class="fw-bold text-main mb-1">{{ $user->full_name }}</h4>
                <div
                    class="text-muted-custom small mb-2 d-flex flex-column flex-md-row gap-md-3 justify-content-center justify-content-md-start">
                    <span><i class="bi bi-envelope me-1"></i> {{ $user->email }}</span>
                    <span><i class="bi bi-telephone me-1"></i> {{ $user->phone ?? 'Not Provided' }}</span>
                </div>
                @php
                // Define the colors based on status
                $status = strtolower($user->account_status ?? 'pending');

                $bg = 'var(--soft-orange)'; // Default Pending
                $color = 'var(--text-orange)';

                if($status == 'active') {
                $bg = 'var(--soft-green)';
                $color = 'var(--text-green)';
                } elseif($status == 'inactive' || $status == 'suspended') {
                $bg = 'var(--soft-red)';
                $color = 'var(--text-red)';
                }
                @endphp

                <div class="status-badge" style="background-color: {{ $bg }}; color: {{ $color }};">
                    <i class="bi bi-circle-fill" style="font-size: 6px;"></i>
                    {{ ucfirst($status) }} Student
                </div>
            </div>
        </div>
    </div>

    <div class="card-custom">
        <form action="{{ route('student.profile.update') }}" method="POST" id="profileForm">
            @csrf
            @method('PUT')

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-info-circle text-primary"></i>
                    <h6 class="fw-bold m-0 text-main">Basic Information</h6>
                </div>
                <button type="button" id="editBtn" class="btn btn-sm btn-outline-primary px-3" onclick="toggleEdit()">
                    <i class="bi bi-pencil me-1"></i> Edit Profile
                </button>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label">First Name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" name="first_name" class="form-control profile-input" value="{{ $firstName }}"
                            disabled required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Last Name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" name="last_name" class="form-control profile-input" value="{{ $lastName }}"
                            disabled required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control profile-input" value="{{ $user->email }}"
                            disabled required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Mobile Number</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                        <input type="text" name="phone" class="form-control profile-input"
                            value="{{ $profile->phone ?? '' }}" placeholder="Enter mobile number" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Gender</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-people"></i></span>
                        <select name="gender" class="form-select profile-input" disabled>
                            <option value="" disabled {{ is_null($profile->gender ?? null) ? 'selected' : '' }}>Select
                                Gender</option>
                            <option value="Male" {{ ($profile->gender ?? '') == 'Male' ? 'selected' : '' }}>Male
                            </option>
                            <option value="Female" {{ ($profile->gender ?? '') == 'Female' ? 'selected' : '' }}>Female
                            </option>
                            <option value="Other" {{ ($profile->gender ?? '') == 'Other' ? 'selected' : '' }}>Other
                            </option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Date of Birth</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                        <input type="date" name="dob" class="form-control profile-input" value="{{ $user->dob }}"
                            disabled>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Blood Group</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-droplet"></i></span>
                        <select name="blood_group" class="form-select profile-input" disabled>
                            <option value="" disabled {{ is_null($user->blood_group) ? 'selected' : '' }}>Select Group
                            </option>
                            @foreach(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $group)
                            <option value="{{ $group }}" {{ $user->blood_group == $group ? 'selected' : '' }}>{{ $group
                                }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12 text-end mt-4 d-none" id="saveButtonGroup">
                    <hr class="mb-4 opacity-50">
                    <button type="button" class="btn btn-light px-4 me-2" onclick="toggleEdit()">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleEdit() {
    const inputs = document.querySelectorAll('.profile-input');
    const editBtn = document.getElementById('editBtn');
    const saveGroup = document.getElementById('saveButtonGroup');

    // Check current state based on first input
    const isEditing = !inputs[0].disabled;

    if (isEditing) {
        // Switch to View Mode
        inputs.forEach(input => input.disabled = true);
        editBtn.classList.remove('d-none');
        saveGroup.classList.add('d-none');
    } else {
        // Switch to Edit Mode
        inputs.forEach(input => input.disabled = false);
        editBtn.classList.add('d-none');
        saveGroup.classList.remove('d-none');
    }
}
</script>
{{-- <script>
    public function update(Request $request)
{
    $user = User::find(Auth::id());

    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'gender' => 'nullable|string',
        'dob' => 'nullable|date',
        'blood_group' => 'nullable|string',
    ]);

    $user->full_name = $request->first_name . ' ' . $request->last_name;
    $user->email = $request->email;
    $user->gender = $request->gender;
    $user->dob = $request->dob;
    $user->blood_group = $request->blood_group;
    $user->save();

    return back()->with('success', 'Profile updated successfully!');
}
</script> --}}
@endsection
