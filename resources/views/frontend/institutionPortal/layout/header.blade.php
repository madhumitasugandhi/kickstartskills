<header class="top-header">

    <!-- LEFT -->
    <div class="header-left">
        <button id="sidebarToggle" class="icon-btn">
            <i class="bi bi-list fs-4"></i>
        </button>

        <div class="page-title">
            <h5>@yield('page_title', 'Institution Dashboard')</h5>
            <small>Welcome, {{ $institution->institution_name }}</small>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="header-right">

        <!-- Notification -->
        <button class="icon-btn notification-btn">
            <i class="bi bi-bell"></i>
            <span class="notification-badge">5</span>
        </button>

        <!-- Theme -->
        <button id="themeToggle" class="icon-btn theme-toggle-btn">
            <i class="bi bi-moon"></i>
        </button>

        <!-- Profile -->
        <div class="dropdown">
            <button class="icon-btn" data-bs-toggle="dropdown">
                <div class="profile-circle">
                    {{ strtoupper(substr(session('institution_name'), 0, 1)) }}
                </div>
            </button>

            <ul class="dropdown-menu dropdown-menu-end ui-dropdown-menu">
                <li class="px-3 py-2 text-main">
                    <small class="">Logged in as</small><br>
                    <strong>{{ session('institution_name') }}</strong>
                </li>
                <li><hr class="dropdown-divider"></li>
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