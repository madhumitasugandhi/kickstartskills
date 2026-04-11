<div class="ui-card">

    <!-- HEADER -->
    <div class="ui-card-header">
        <div class="ui-card-title">
            <i class="bi bi-diagram-3 me-2"></i>
            System Integration Settings
        </div>
    </div>

    <!-- ================= LMS INTEGRATION ================= -->
    <div class="ui-section">
        <div class="ui-section-title">LEARNING MANAGEMENT SYSTEM</div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="ui-label mb-0">Enable LMS Integration</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>

        <div>
            <label class="ui-label">LMS Provider</label>
            <div class="input-group-custom">
                <i class="bi bi-journal-bookmark"></i>
                <select class="form-select">
                    <option selected>Canvas</option>
                    <option>Moodle</option>
                    <option>Blackboard</option>
                </select>
            </div>
        </div>
    </div>

    <!-- ================= SIS INTEGRATION ================= -->
    <div class="ui-section">
        <div class="ui-section-title">STUDENT INFORMATION SYSTEM</div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="ui-label mb-0">Enable SIS Integration</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>

        <div>
            <label class="ui-label">SIS Provider</label>
            <div class="input-group-custom">
                <i class="bi bi-people"></i>
                <select class="form-select">
                    <option selected>Banner</option>
                    <option>PeopleSoft</option>
                    <option>Ellucian</option>
                </select>
            </div>
        </div>
    </div>

    <!-- ================= PAYMENT INTEGRATION ================= -->
    <div class="ui-section">
        <div class="ui-section-title">PAYMENT GATEWAY</div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="ui-label mb-0">Enable Payment Gateway</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>

        <div>
            <label class="ui-label">Payment Provider</label>
            <div class="input-group-custom">
                <i class="bi bi-credit-card"></i>
                <select class="form-select">
                    <option selected>Stripe</option>
                    <option>Razorpay</option>
                    <option>PayPal</option>
                </select>
            </div>
        </div>
    </div>

    <!-- ================= VIDEO CONFERENCING ================= -->
    <div class="ui-section">
        <div class="ui-section-title">VIDEO CONFERENCING</div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="ui-label mb-0">Enable Video Integration</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>

        <div>
            <label class="ui-label">Video Provider</label>
            <div class="input-group-custom">
                <i class="bi bi-camera-video"></i>
                <select class="form-select">
                    <option selected>Zoom</option>
                    <option>Google Meet</option>
                    <option>Microsoft Teams</option>
                </select>
            </div>
        </div>
    </div>

    <!-- ================= CLOUD STORAGE ================= -->
    <div class="ui-section">
        <div class="ui-section-title">CLOUD STORAGE</div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="ui-label mb-0">Enable Cloud Storage</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>

        <div>
            <label class="ui-label">Storage Provider</label>
            <div class="input-group-custom">
                <i class="bi bi-cloud"></i>
                <select class="form-select">
                    <option selected>AWS S3</option>
                    <option>Google Cloud Storage</option>
                    <option>Azure Blob Storage</option>
                </select>
            </div>
        </div>
    </div>

    <!-- ================= API SETTINGS ================= -->
    <div class="ui-section">
        <div class="ui-section-title">API SETTINGS</div>

        <div>
            <label class="ui-label">API Rate Limit (requests/hour)</label>
            <div class="input-group-custom">
                <i class="bi bi-speedometer2"></i>
                <input type="number" class="form-control" value="1000">
            </div>
        </div>
    </div>

</div>