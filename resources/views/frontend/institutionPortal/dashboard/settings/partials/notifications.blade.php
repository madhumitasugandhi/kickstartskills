<div class="card glass-card p-4">

    {{-- HEADER --}}
    <h5 class="fw-semibold mb-4 d-flex align-items-center gap-2">
        <i class="bi bi-bell text-teal"></i>
        Notification Settings
    </h5>

    {{-- COMMUNICATION CHANNELS --}}
    <h6 class="text-teal mb-3">Communication Channels</h6>

    <div class="d-flex flex-column gap-3 mb-4">

        <div class="d-flex justify-content-between align-items-center">
            <span class="form-label">Email Notifications</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <span class="form-label">SMS Notifications</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox">
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <span class="form-label">Push Notifications</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>

    </div>

    {{-- NOTIFICATION TYPES --}}
    <h6 class="text-teal mb-3">Notification Types</h6>

    <div class="d-flex flex-column gap-3 mb-4">

        <div class="d-flex justify-content-between align-items-center">
            <span class="form-label">Admissions Notifications</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <span class="form-label">Grade Change Notifications</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <span class="form-label">Attendance Alert Notifications</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <span class="form-label">System Maintenance Notifications</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <span class="form-label">Compliance Deadline Notifications</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked>
            </div>
        </div>

    </div>

    {{-- EMAIL DIGEST --}}
    <div>
        <label class="form-label">Email Digest Frequency</label>
        <div class="input-group-custom">
            <i class="bi bi-envelope-paper"></i>
            <select class="form-select">
                <option selected>Daily</option>
                <option>Weekly</option>
                <option>Monthly</option>
                <option>Never</option>
            </select>
        </div>
    </div>

</div>
