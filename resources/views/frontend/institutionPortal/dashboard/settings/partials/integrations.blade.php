<div class="card glass-card p-4">

    {{-- HEADER --}}
    <h5 class="fw-semibold mb-4 d-flex align-items-center gap-2">
        <i class="bi bi-diagram-3 text-teal"></i>
        System Integration Settings
    </h5>

    {{-- LEARNING MANAGEMENT SYSTEM --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="form-label">Learning Management System</span>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" checked>
        </div>
    </div>

    <div class="mb-4">
        <label class="form-label">LMS Provider</label>
        <div class="input-group-custom">
            <i class="bi bi-journal-bookmark"></i>
            <select class="form-select">
                <option selected>Canvas</option>
                <option>Moodle</option>
                <option>Blackboard</option>
            </select>
        </div>
    </div>

    {{-- STUDENT INFORMATION SYSTEM --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="form-label">Student Information System</span>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" checked>
        </div>
    </div>

    <div class="mb-4">
        <label class="form-label">SIS Provider</label>
        <div class="input-group-custom">
            <i class="bi bi-people"></i>
            <select class="form-select">
                <option selected>Banner</option>
                <option>PeopleSoft</option>
                <option>Ellucian</option>
            </select>
        </div>
    </div>

    {{-- PAYMENT GATEWAY --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="form-label">Payment Gateway</span>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" checked>
        </div>
    </div>

    <div class="mb-4">
        <label class="form-label">Payment Provider</label>
        <div class="input-group-custom">
            <i class="bi bi-credit-card"></i>
            <select class="form-select">
                <option selected>Stripe</option>
                <option>Razorpay</option>
                <option>PayPal</option>
            </select>
        </div>
    </div>

    {{-- VIDEO CONFERENCING --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="form-label">Video Conferencing</span>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" checked>
        </div>
    </div>

    <div class="mb-4">
        <label class="form-label">Video Provider</label>
        <div class="input-group-custom">
            <i class="bi bi-camera-video"></i>
            <select class="form-select">
                <option selected>Zoom</option>
                <option>Google Meet</option>
                <option>Microsoft Teams</option>
            </select>
        </div>
    </div>

    {{-- CLOUD STORAGE --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="form-label">Cloud Storage</span>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" checked>
        </div>
    </div>

    <div class="mb-4">
        <label class="form-label">Storage Provider</label>
        <div class="input-group-custom">
            <i class="bi bi-cloud"></i>
            <select class="form-select">
                <option selected>AWS S3</option>
                <option>Google Cloud Storage</option>
                <option>Azure Blob Storage</option>
            </select>
        </div>
    </div>

    {{-- API RATE LIMIT --}}
    <div>
        <label class="form-label">API Rate Limit (requests/hour)</label>
        <div class="input-group-custom">
            <i class="bi bi-speedometer2"></i>
            <input type="number" class="form-control" value="1000">
        </div>
    </div>

</div>
