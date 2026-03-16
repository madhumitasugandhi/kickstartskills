@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="glass-card">

    <h5 class="fw-bold mb-3 text-white text-center">Basic Information</h5>

    <p class="text-white opacity-75 small mb-4 px-2 text-center">
        Tell us about your institution
    </p>


    <!-- Institution Name -->
    <div class="input-group-custom">
        <i class="bi bi-building input-icon"></i>

        <input
            type="text"
            id="iname"
            name="institution_name"
            class="custom-input"
            value="{{ old('institution_name', $formData['institution_name'] ?? '') }}"
            placeholder="Institution Name">

    </div>

    <div class="field-error" id="iname-error"></div>


    <!-- Representative Name -->
    <div class="input-group-custom">
        <i class="bi bi-person input-icon"></i>

        <input
            type="text"
            id="lname"
            name="representative_name"
            class="custom-input"
            value="{{ old('representative_name', $formData['representative_name'] ?? '') }}"
            placeholder="Representative Name">

    </div>

    <div class="field-error" id="lname-error"></div>


    <!-- Email -->
    <div class="input-group-custom">
        <i class="bi bi-envelope input-icon"></i>

        <input
            type="email"
            id="email"
            name="email"
            class="custom-input"
            value="{{ old('email', $formData['email'] ?? '') }}"
            placeholder="Official Email Address">

    </div>

    <div class="field-error" id="email-error"></div>


    <!-- Password -->
    <div class="row g-2">

        <div class="col-6">

            <div class="input-group-custom">
                <i class="bi bi-lock input-icon"></i>

                <input
                    type="password"
                    name="password"
                    id="password"
                    class="custom-input"
                    placeholder="Password">

            </div>

            <div class="field-error" id="password-error"></div>

        </div>


        <div class="col-6">

            <div class="input-group-custom">
                <i class="bi bi-lock input-icon"></i>

                <input
                    type="password"
                    name="password_confirmation"
                    id="confirm_password"
                    class="custom-input"
                    placeholder="Confirm Password">

            </div>

            <div class="field-error" id="confirm-password-error"></div>

        </div>

    </div>


    <button
        type="button"
        class="btn-action"
        onclick="validateStep1()">
        Continue
    </button>

</div>