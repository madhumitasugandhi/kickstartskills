<header class="top-header">
    <!-- Sidebar Toggle (Mobile) -->
    <button class="btn btn-link text-dark d-lg-none me-2" onclick="document.getElementById('sidebar').classList.toggle('show')">
        <i class="bi bi-list fs-4"></i>
    </button>

    <!-- Title & Icon Area -->
    <div class="d-flex align-items-center">
        <div class="me-3 d-none d-md-block">
             <!-- Icon Section: Default to 'bi-app' if not defined -->
            <i class="bi @yield('icon', 'bi-app') fs-2 text-primary"></i>
        </div>
        <div>
            <h5 class="fw-bold m-0">@yield('title', 'Student Portal')</h5>
            <small class="--text-muted">Welcome back, John!</small>
        </div>
    </div>

    <!-- Right Side Actions -->
    <div class="d-flex align-items-center gap-2">

        <!-- Notification Bell (Linked) -->
        <a href="{{ route('student.notifications') }}" class="btn btn-light position-relative rounded-circle px-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-bell" style="font-size: 1.2rem;"></i>
            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle" style="padding: 0.3rem !important;"></span>
        </a>

        <!-- Theme Toggle -->
        <button class="btn btn-light rounded-circle p-2" onclick="toggleTheme()" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-moon" id="themeIcon" style="font-size: 1.2rem;"></i>
        </button>
    </div>
</header>
