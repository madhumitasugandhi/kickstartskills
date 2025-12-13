<style>
    /* Sidebar Base */
#sidebar {
    width: 260px;
    background: #141c2b;      /* Deep navy like screenshot */
    height: 100vh;
    display: flex;
    flex-direction: column;
    border-right: 1px solid rgba(255,255,255,0.06);
}

/* Header */
#sidebar .menu-text {
    font-size: 14px;
    font-weight: 600;
}

/* MAIN MENU label */
#sidebar .small {
    letter-spacing: 0.5px;
    opacity: 0.7;
}

/* Navigation items */
.nav-item-custom {
    display: flex;
    align-items: center;
    padding: 10px 14px;
    color: #b7c4d4;
    text-decoration: none;
    border-radius: 8px;
    margin-bottom: 4px;
    transition: 0.2s ease;
    font-size: 14px;
}

.nav-item-custom i {
    font-size: 18px;
    opacity: 0.9;
}

/* Hover effect */
.nav-item-custom:hover {
    background: rgba(255,255,255,0.08);
    color: #ffffff;
}

/* Active menu style */
.nav-item-custom.active {
    background: #113d3a;          /* Teal-green dark shade like screenshot */
    color: #2dd4bf !important;    /* Soft green text */
    font-weight: 600;
}

.nav-item-custom.active i {
    color: #2dd4bf !important;
}

/* Bottom section */
#sidebar .mt-auto small,
#sidebar .mt-auto span {
    opacity: 0.6;
    font-size: 12px;
}

/* Divider styling */
#sidebar .border-secondary {
    border-color: rgba(255,255,255,0.08) !important;
}

</style>


<div id="sidebar" class="d-flex flex-column">

    <div class="px-3 py-3 border-bottom border-secondary d-flex align-items-center">
        <i class="bi bi-house-door text-white fs-4 me-2"></i>
        <span class="text-white fw-bold menu-text">Institution Portal</span>
    </div>

    <div class="px-3 mt-3 text-muted small">MAIN MENU</div>

    <nav class="mt-2 px-2">

        <a href="{{ route('institute.dashboard') }}" class="nav-item-custom {{ request()->is('institute/dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i>
            <span class="menu-text">Dashboard</span>
        </a>

        <a href="#" class="nav-item-custom">
            <i class="bi bi-grid me-2"></i>
            <span class="menu-text">Core Management</span>
        </a>

        <a href="#" class="nav-item-custom">
            <i class="bi bi-journal-bookmark me-2"></i>
            <span class="menu-text">Programs</span>
        </a>

        <a href="#" class="nav-item-custom">
            <i class="bi bi-people me-2"></i>
            <span class="menu-text">Students</span>
        </a>

        <a href="#" class="nav-item-custom">
            <i class="bi bi-person-badge me-2"></i>
            <span class="menu-text">Faculty</span>
        </a>

        <a href="#" class="nav-item-custom">
            <i class="bi bi-graph-up-arrow me-2"></i>
            <span class="menu-text">Analytics</span>
        </a>

        <a href="#" class="nav-item-custom">
            <i class="bi bi-chat-dots me-2"></i>
            <span class="menu-text">Communication</span>
        </a>

        <a href="#" class="nav-item-custom">
            <i class="bi bi-file-earmark-text me-2"></i>
            <span class="menu-text">Compliance Reports</span>
        </a>

        <a href="#" class="nav-item-custom">
            <i class="bi bi-gear me-2"></i>
            <span class="menu-text">Settings</span>
        </a>

        <a href="#" class="nav-item-custom">
            <i class="bi bi-bell me-2"></i>
            <span class="menu-text">Notifications</span>
        </a>

    </nav>

    <div class="mt-auto px-3 py-4 border-top border-secondary">
        <small class="text-muted">ABC Institute</small><br>
        <span class="text-white-50 small">ID: INS001</span>
    </div>

</div>
