<div class="ui-card">

    <!-- HEADER -->
    <div class="ui-card-header">
        <div class="ui-card-title">
            <i class="bi bi-shield-lock me-2"></i>
            Security & Access Settings
        </div>
    </div>

    <!-- ================= AUTHENTICATION ================= -->
    <div class="ui-section">
        <div class="ui-section-title">AUTHENTICATION</div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="ui-label mb-0">Enable Two-Factor Authentication</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>

        <div class="mb-3">
            <label class="ui-label">Session Timeout (minutes)</label>
            <div class="input-group-custom">
                <i class="bi bi-clock"></i>
                <input type="number" class="form-control" value="120">
            </div>
        </div>

        <div class="mb-3">
            <label class="ui-label">Minimum Password Length</label>
            <div class="input-group-custom">
                <i class="bi bi-key"></i>
                <input type="number" class="form-control" value="8">
            </div>
        </div>
    </div>

    <!-- ================= PASSWORD RULES ================= -->
    <div class="ui-section">
        <div class="ui-section-title">PASSWORD RULES</div>

        <div class="d-flex flex-column gap-3">

            <div class="d-flex justify-content-between align-items-center">
                <span class="ui-label mb-0">Require Special Characters</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" checked>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <span class="ui-label mb-0">Require Numbers</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" checked>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <span class="ui-label mb-0">Require Uppercase Letters</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" checked>
                </div>
            </div>

        </div>
    </div>

    <!-- ================= LOGIN SECURITY ================= -->
    <div class="ui-section">
        <div class="ui-section-title">LOGIN SECURITY</div>

        <div class="mb-3">
            <label class="ui-label">Max Login Attempts</label>
            <div class="input-group-custom">
                <i class="bi bi-exclamation-circle"></i>
                <input type="number" class="form-control" value="5">
            </div>
        </div>

        <div class="mb-3">
            <label class="ui-label">Account Lockout Duration (minutes)</label>
            <div class="input-group-custom">
                <i class="bi bi-lock"></i>
                <input type="number" class="form-control" value="30">
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="ui-label mb-0">Enable IP Whitelist</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox">
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <span class="ui-label mb-0">Enable Audit Logging</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>
    </div>

    <!-- ================= DATA POLICY ================= -->
    <div class="ui-section">
        <div class="ui-section-title">DATA POLICY</div>

        <div>
            <label class="ui-label">Data Retention Period (years)</label>
            <div class="input-group-custom">
                <i class="bi bi-database-lock"></i>
                <input type="number" class="form-control" value="5">
            </div>
        </div>
    </div>

</div>