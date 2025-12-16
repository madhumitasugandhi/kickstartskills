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
            <small class="--text-muted">Welcome back, John!</small>
        </div>
    </div>

    <div class="d-flex align-items-center gap-2 ms-auto">

        <a href="{{ route('student.notifications') }}" class="btn btn-light position-relative rounded-circle px-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-bell" style="font-size: 1.2rem;"></i>
            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle" style="padding: 0.3rem !important;"></span>
        </a>

        <button class="btn btn-light rounded-circle p-2" onclick="toggleTheme()" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-moon" id="themeIcon" style="font-size: 1.2rem;"></i>
        </button>
    </div>
</header>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const body = document.body;
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const headerToggle = document.getElementById('headerToggleBtn');
    const sidebarClose = document.getElementById('sidebarCloseBtn');

    // 1. Universal Toggle Logic
    if (headerToggle) {
        headerToggle.addEventListener('click', function(e) {
            e.preventDefault();

            // CHECK SCREEN WIDTH
            if (window.innerWidth >= 992) {
                // DESKTOP: Toggle "Desktop Minimized" class on BODY
                body.classList.toggle('desktop-minimized');

                // Force close dropdowns when minimizing to avoid floating submenus
                if(body.classList.contains('desktop-minimized')) {
                      document.querySelectorAll('.collapse.show').forEach(el => el.classList.remove('show'));
                }
            } else {
                // MOBILE: Toggle "Mobile Active" class on SIDEBAR
                sidebar.classList.toggle('mobile-active');
                if(overlay) overlay.classList.toggle('active');
            }
        });
    }

    // 2. Close Sidebar via "X" Button (Mobile)
    if (sidebarClose) {
        sidebarClose.addEventListener('click', function() {
            sidebar.classList.remove('mobile-active');
            if(overlay) overlay.classList.remove('active');
        });
    }

    // 3. Close on Overlay Click (Mobile)
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
   SIDEBAR TOGGLE LOGIC (MENTOR PORTAL)
   ========================================================= */

/* DEFAULT SIDEBAR STYLE */
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

/* --- SCENARIO A: DESKTOP MINIMIZED (> 992px) --- */
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
    body.desktop-minimized .nav-label,
    body.desktop-minimized .brand-text,
    body.desktop-minimized .dropdown-arrow,
    body.desktop-minimized .user-info {
        display: none !important;
    }

    /* 4. CENTER ICONS */
    body.desktop-minimized .nav-link {
        justify-content: center !important;
        padding-left: 0;
        padding-right: 0;
    }

    body.desktop-minimized .nav-link i {
        margin: 0 !important;
        font-size: 1.4rem;
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

    /* 7. Hide Open Submenus */
    body.desktop-minimized .collapse.show {
        display: none;
    }
}

/* --- SCENARIO B: MOBILE (< 992px) --- */
@media (max-width: 991.98px) {
    /* 1. Hide Sidebar Completely */
    .sidebar {
        transform: translateX(-100%);
        width: 280px; /* Slightly wider on mobile for better touch targets */
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
