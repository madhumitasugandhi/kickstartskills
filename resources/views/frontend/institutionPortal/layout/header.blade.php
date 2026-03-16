<header class="top-header d-flex align-items-center justify-content-between px-4" 
        style="height: var(--header-height); background: var(--bg-header); border-bottom: 1px solid var(--border-color);">

    <div class="d-flex align-items-center">
        <button id="sidebarToggle" class="btn btn-sm  me-3">
            <i class="bi bi-list fs-4" style="color: var(--text-main)"></i>
        </button>

        <div>
            <h5 class="mb-0 fw-semibold" style="color: var(--text-main)">
                @yield('page_title', 'Institution Dashboard')
            </h5>
            <small style="color: var(--text-main)">Welcome, ABC Institute!</small>
        </div>
    </div>

    <div class="d-flex align-items-center gap-2">
        <button class="btn position-relative border-0">
            <i class="bi bi-bell fs-5" style="color: var(--text-main)"></i>
            <span class="position-absolute top-2 start-75 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">5</span>
        </button>

        <button id="themeToggle" class="btn border-0 theme-toggle-btn">
            <i class="bi bi-moon fs-5" style="color: var(--text-main)"></i>
        </button>
    </div>
</header>