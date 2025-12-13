<style>
    /* Default: DARK MODE */
body.dark-mode {
    background: #0f172a;
    color: #e2e8f0;
}

.top-header {
    background: #1a2333;
    border-bottom: 1px solid rgba(255,255,255,0.08);
}

/* LIGHT MODE */
body.light-mode {
    background: #f7f9fc;
    color: #1a1a1a;
}

body.light-mode .top-header {
    background: #ffffff;
    border-bottom: 1px solid #e5e7eb;
}

/* Transition effect */
body {
    transition: background 0.3s ease, color 0.3s ease;
}

#sidebar.light-mode,
body.light-mode #sidebar {
    background: #ffffff !important;
    color: #333 !important;
}

</style>


<header class="top-header d-flex align-items-center justify-content-between px-4">

    <!-- Left: Sidebar Toggle + Title -->
    <div class="d-flex align-items-center">
        <button id="sidebarToggle" class="btn btn-sm btn-outline-light me-3">
            <i class="bi bi-list"></i>
        </button>

        <div>
            <h5 class="text-white mb-0 fw-semibold">Institution Dashboard</h5>
            <small class="text-muted">Welcome, ABC Institute!</small>
        </div>
    </div>

    <!-- Right: Notifications + Settings -->
    <div class="d-flex align-items-center">

        <button class="btn position-relative text-white me-3">
            <i class="bi bi-bell fs-5"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge bg-danger rounded-pill">
                5
            </span>
        </button>

        <button id="themeToggle" class="btn text-white">
            <i class="bi bi-moon fs-5"></i>
        </button>


    </div>

</header>
