<div class="setup-step" id="completionStep">

    <!-- ================= COMPLETION HERO ================= -->
    <div class="config-card p-5 text-center mb-4 completion-hero">

        <div class="completion-icon mb-3">
            <i class="bi bi-check-lg"></i>
        </div>

        <h4 class="fw-semibold mb-2">
            Setup Complete!
        </h4>

        <p class="mb-0 opacity-75">
            Your institution profile has been created successfully
        </p>

    </div>

    <!-- ================= WHAT'S NEXT ================= -->
    <div class="config-card p-4 mb-4">

        <h6 class="fw-semibold mb-3">
            What happens next?
        </h6>

        <!-- Verification -->
        <div class="next-step-card warning mb-3">
            <div class="d-flex gap-3">
                <div class="next-icon warning">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div>
                    <div class="fw-semibold">Document Verification (In Progress)</div>
                    <small class="opacity-75">
                        Our team is reviewing your submitted documents.
                        You’ll receive an email once approved.
                    </small>
                </div>
            </div>
        </div>

        <!-- Code Generation -->
        <div class="next-step-card info">
            <div class="d-flex gap-3">
                <div class="next-icon info">
                    <i class="bi bi-upc-scan"></i>
                </div>
                <div>
                    <div class="fw-semibold">Institution Code Generation</div>
                    <small class="opacity-75">
                        After verification, unique institution codes will be issued
                        for student registration.
                    </small>
                </div>
            </div>
        </div>

    </div>

    <!-- ================= ACTIONS ================= -->
    <div class="config-card p-4">

        <h6 class="fw-semibold mb-3">
            Get Started
        </h6>

        <div class="action-card success mb-3">
            <div class="d-flex gap-3">
                <div class="next-icon success">
                    <i class="bi bi-people"></i>
                </div>
                <div>
                    <div class="fw-semibold">Start Student Enrollment</div>
                    <small class="opacity-75">
                        Enroll students, manage programs, and track academics.
                    </small>
                </div>
            </div>
        </div>

        <div class="action-card success mb-4">
            <div class="d-flex gap-3">
                <div class="next-icon success">
                    <i class="bi bi-briefcase"></i>
                </div>
                <div>
                    <div class="fw-semibold">Configure Internship Programs</div>
                    <small class="opacity-75">
                        Set up internship drives, partners, and placements.
                    </small>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="d-flex flex-wrap gap-3">
            <a href="{{ route('institute.dashboard') }}" class="btn btn-teal px-4">
                <i class="bi bi-house-door me-1"></i> Go to Dashboard
            </a>

            <button class="btn btn-outline-secondary px-4">
                <i class="bi bi-download me-1"></i> Download Setup Summary
            </button>
        </div>

    </div>

</div>
