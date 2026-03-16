<header class="top-header">
    <button class="btn btn-link me-2" id="headerToggleBtn" style="color: var(--text-main); text-decoration: none;">
        <i class="bi bi-list fs-4"></i>
    </button>

    <div class="d-flex align-items-center">
        <div class="me-3 d-none d-md-block">
            <i class="bi @yield('icon', 'bi-app') fs-2 text-primary"></i>
        </div>
        <div>
            <h5 class="fw-bold m-0">@yield('title', 'Student Portal')</h5>
            <small class="text-muted-custom">Welcome back, {{ explode(' ', Auth::user()->full_name)[0] }}!</small>
        </div>
    </div>

    <div class="d-flex align-items-center gap-3 ms-auto">
        <button class="btn btn-light rounded-circle p-2 d-none d-sm-flex" onclick="toggleTheme()"
            style="width: 40px; height: 40px; align-items: center; justify-content: center;">
            <i class="bi bi-moon" id="themeIcon"></i>
        </button>

        <a href="{{ route('student.notifications') }}" class="btn btn-light position-relative rounded-circle px-2"
            style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-bell"></i>
            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
        </a>

        <div class="dropdown">
            <button class="btn p-0 border-0 d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm"
                    style="width: 40px; height: 40px; font-size: 0.9rem;">
                    {{ strtoupper(substr(Auth::user()->full_name, 0, 1)) }}
                </div>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 py-2" style="border-radius: 12px; min-width: 180px;">
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ route('student.profile.personal') }}">
                        <i class="bi bi-person text-primary"></i> My Profile
                    </a>
                </li>
                <li><hr class="dropdown-divider opacity-50"></li>
                <li>
                    <form action="{{ route('student.logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="dropdown-item d-flex align-items-center gap-2 py-2 text-danger fw-bold">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const body = document.body;
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const headerToggle = document.getElementById('headerToggleBtn');

    // --- NEW: Select the Close Button ---
    const sidebarClose = document.getElementById('sidebarCloseBtn');

    // 1. Open Sidebar (Existing Logic)
    if (headerToggle) {
        headerToggle.addEventListener('click', function(e) {
            e.preventDefault();
            if (window.innerWidth >= 992) {
                body.classList.toggle('desktop-minimized');
            } else {
                sidebar.classList.toggle('mobile-active');
                if(overlay) overlay.classList.toggle('active');
            }
        });
    }

    // 2. Close Sidebar via "X" Button (NEW Logic)
    if (sidebarClose) {
        sidebarClose.addEventListener('click', function() {
            sidebar.classList.remove('mobile-active');
            if(overlay) overlay.classList.remove('active');
        });
    }

    // 3. Close on Overlay Click (Existing Logic)
    if (overlay) {
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('mobile-active');
            overlay.classList.remove('active');
        });
    }

    // Reset layout if resizing window
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 992) {
            sidebar.classList.remove('mobile-active');
            if(overlay) overlay.classList.remove('active');
        } else {
            body.classList.remove('desktop-minimized');
        }
    });
});
</script>

<style>
/* =========================================================
   FINAL SIDEBAR TOGGLE LOGIC
   ========================================================= */

/* DEFAULT SIDEBAR STYLE (EXPANDED) */
.sidebar {
    width: 250px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    transition: all 0.3s ease;
    z-index: 1000;
}

/* MAIN CONTENT ADJUSTMENT */
.main-content {
    margin-left: 250px;
    transition: all 0.3s ease;
    width: calc(100% - 250px);
}

.dropdown-item {
    font-size: 0.85rem;
    transition: all 0.2s;
}
.dropdown-item:hover {
    background-color: var(--bg-body); /* Or any soft color */
    color: var(--text-main);
}

/* --- SCENARIO A: DESKTOP TOGGLED (> 992px) --- */
@media (min-width: 992px) {

    /* 1. Shrink Sidebar Width */
    body.desktop-minimized .sidebar {
        width: 80px;
    }

    /* 2. Adjust Main Content Margin */
    body.desktop-minimized .main-content {
        margin-left: 80px;
        width: calc(100% - 80px);
    }

    /* 3. HIDE TEXT LABELS & EXTRAS */
    body.desktop-minimized .nav-label,        /* The Text */
    body.desktop-minimized .brand-text,       /* The Logo Text */
    body.desktop-minimized .dropdown-arrow,   /* The Chevron */
    body.desktop-minimized .user-info {       /* Footer Text */
        display: none !important;
    }

    /* 4. CENTER ICONS */
    body.desktop-minimized .nav-link {
        justify-content: center !important;
        padding-left: 0;
        padding-right: 0;
    }

    body.desktop-minimized .nav-link i {
        margin: 0 !important; /* Removes margins */
        font-size: 1.4rem; /* Icons slightly larger */
    }

    /* 5. Center Brand Logo */
    body.desktop-minimized .sidebar-brand {
        justify-content: center;
        padding: 0;
    }

    /* 6. Center Footer Avatar */
    body.desktop-minimized .user-footer {
        padding: 5px;
        display: flex;
        justify-content: center;
    }

    /* 7. Hide Collapse content entirely when minimized to prevent ugly overflow */
    body.desktop-minimized .collapse.show {
        display: none;
    }
}

/* --- SCENARIO B: TABLET & MOBILE (< 992px) --- */
@media (max-width: 991.98px) {
    /* 1. Hide Sidebar Completely initially */
    .sidebar {
        transform: translateX(-100%);
        width: 280px;
    }

    /* 2. Content is Full Width */
    .main-content {
        margin-left: 0 !important;
        width: 100%;
    }

    /* 3. Show Sidebar When Active */
    .sidebar.mobile-active {
        transform: translateX(0);
        box-shadow: 0 0 100px rgba(0,0,0,0.5);
    }
}
</style>
