<header class="top-header">

    <div class="header-left">
        <button id="sidebarToggle" class="icon-btn">
            <i class="bi bi-list fs-4"></i>
        </button>

        <!-- Dynamic Page Icon -->
        <div class="page-icon">
            <i class="@yield('page_icon', 'bi bi-speedometer2')"></i>
        </div>

        <div class="page-title">
            <h5>@yield('page_title', 'Institution Dashboard')</h5>
            <small>Welcome, {{ $institution->institution_name }}</small>
        </div>
    </div>

    <div class="header-right">
        <button class="icon-btn notification-btn">
            <i class="bi bi-bell"></i>
            <span class="notification-badge">5</span>
        </button>

        <button id="themeToggle" class="icon-btn theme-toggle-btn">
            <i class="bi bi-moon"></i>
        </button>

        <div class="dropdown">
            <button class="icon-btn" data-bs-toggle="dropdown">
                <div class="profile-circle">
                    {{ strtoupper(substr(session('institution_name'), 0, 1)) }}
                </div>
            </button>

            <ul class="dropdown-menu dropdown-menu-end">
                <li class="px-3 py-2">
                    <small style="color: var(--text-main)">Logged in as</small><br>
                    <strong style="color: var(--text-main)">{{ session('institution_name') }}</strong>
                </li>
                <li><hr class="dropdown-divider" style="color: var(--text-main)"></li>
                <li>
                    <form method="POST" action="{{ url('/institution/logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

</header>