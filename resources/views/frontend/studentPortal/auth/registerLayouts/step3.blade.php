<div class="glass-card">
    <h5 class="fw-bold mb-3 text-white">Review Your Information</h5>

    <div class="review-box">
        <h6 class="text-white fw-bold mb-3 border-bottom border-light pb-2" style="opacity: 0.9;">
            <i class="bi bi-person-circle me-2"></i>Personal Information
        </h6>

        <div class="row">
            <div class="col-6">
                <div class="review-label text-white-50 small">Full Name</div>
                <div class="review-value fw-bold text-white" id="review-name">-</div>
            </div>
            <div class="col-6">
                <div class="review-label text-white-50 small">Country</div>
                <div class="review-value fw-bold text-white" id="review-country">-</div>
            </div>
        </div>

        <div class="mt-2">
            <div class="review-label text-white-50 small">Email Address</div>
            <div class="review-value fw-bold text-white" id="review-email">-</div>
        </div>

        <div class="mt-2">
            <div class="review-label text-white-50 small">Phone Number</div>
            <div class="review-value fw-bold text-white" id="review-phone">-</div>
        </div>
    </div>

    <div class="review-box">
        <h6 class="text-white fw-bold mb-3 border-bottom border-light pb-2" style="opacity: 0.9;">
            <i class="bi bi-mortarboard me-2"></i>Account Details
        </h6>

        <div class="row">
            <div class="col-6">
                <div class="review-label text-white-50 small" id="review-inst-label">Institution Code</div>
                <div class="review-value fw-bold text-white" id="review-code">-</div>
            </div>
            <div class="col-6">
                <div class="review-label text-white-50 small">Role</div>
                <div class="review-value fw-bold text-white">Student</div>
            </div>
        </div>

        <hr class="border-white opacity-25">

        <div class="mb-2">
            <div class="review-label text-white-50 small">Current Skills</div>
            <div id="review-skills" class="d-flex flex-wrap gap-1 mt-1">-</div>
        </div>

        <div>
            <div class="review-label text-white-50 small">Learning Goals</div>
            <div id="review-goals" class="d-flex flex-wrap gap-1 mt-1">-</div>
        </div>
    </div>
    <button type="submit" class="btn-action w-100 mb-2">
        <i class="bi bi-check-circle me-2"></i>Create Account
    </button>
    <button type="button" class="btn-prev w-100" onclick="switchStep(2)">
        <i class="bi bi-arrow-left me-2"></i>Previous
    </button>
</div>
