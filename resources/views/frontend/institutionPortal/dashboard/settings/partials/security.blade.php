<div class="card glass-card p-4">

    {{-- HEADER --}}
    <h5 class="fw-semibold mb-4 d-flex align-items-center gap-2">
        <i class="bi bi-shield-lock text-teal"></i>
        Security & Access Settings
    </h5>

    {{-- TWO FACTOR AUTH --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <span class="form-label">Enable Two-Factor Authentication</span>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" checked>
        </div>
    </div>

    {{-- SESSION TIMEOUT --}}
    <div class="mb-4">
        <label class="form-label">Session Timeout (minutes)</label>
        <div class="input-group-custom">
            <i class="bi bi-clock"></i>
            <input type="number" class="form-control" value="120">
        </div>
    </div>

    {{-- MIN PASSWORD LENGTH --}}
    <div class="mb-4">
        <label class="form-label">Minimum Password Length</label>
        <div class="input-group-custom">
            <i class="bi bi-key"></i>
            <input type="number" class="form-control" value="8">
        </div>
    </div>

    {{-- PASSWORD RULES --}}
    <div class="d-flex flex-column gap-3 mb-4">

        <div class="d-flex justify-content-between align-items-center">
            <span class="form-label">Require Special Characters</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <span class="form-label">Require Numbers</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <span class="form-label">Require Uppercase Letters</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>

    </div>

    {{-- MAX LOGIN ATTEMPTS --}}
    <div class="mb-4">
        <label class="form-label">Max Login Attempts</label>
        <div class="input-group-custom">
            <i class="bi bi-exclamation-circle"></i>
            <input type="number" class="form-control" value="5">
        </div>
    </div>

    {{-- ACCOUNT LOCKOUT --}}
    <div class="mb-4">
        <label class="form-label">Account Lockout Duration (minutes)</label>
        <div class="input-group-custom">
            <i class="bi bi-lock"></i>
            <input type="number" class="form-control" value="30">
        </div>
    </div>

    {{-- IP WHITELIST --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="form-label">Enable IP Whitelist</span>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox">
        </div>
    </div>

    {{-- AUDIT LOGGING --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <span class="form-label">Enable Audit Logging</span>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" checked>
        </div>
    </div>

    {{-- DATA RETENTION --}}
    <div>
        <label class="form-label">Data Retention Period (years)</label>
        <div class="input-group-custom">
            <i class="bi bi-database-lock"></i>
            <input type="number" class="form-control" value="5">
        </div>
    </div>

</div>
