<header class="top-header">
    <button class="btn btn-link me-2" id="headerToggleBtn" style="color: var(--text-main); text-decoration: none;">
        <i class="bi bi-list fs-4"></i>
    </button>

    <div class="d-flex align-items-center">
        <div class="me-3 d-none d-md-block">
            <i class="bi @yield('icon', 'bi-rocket-takeoff-fill') fs-2 text-primary"></i>
        </div>
        <div>
            <h5 class="fw-bold m-0">@yield('title', 'HR Dashboard')</h5>
            <small class="text-muted">Welcome back, {{ explode(' ', Auth::user()->full_name)[0] }}!</small>
        </div>
    </div>

    <div class="d-flex align-items-center gap-3 ms-auto">

        <a href="{{ route('hr.notifications') }}" class="btn btn-light position-relative rounded-circle px-2"
            style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-bell" style="font-size: 1.2rem;"></i>
            <span
                class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
        </a>

        <button class="btn btn-light rounded-circle p-2 d-none d-sm-flex" onclick="toggleTheme()"
            style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-moon" id="themeIcon" style="font-size: 1.2rem;"></i>
        </button>

        <div class="dropdown">
            <button class="btn p-0 border-0 d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <div class=" text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm"
                    style="width: 40px; height: 40px; font-size: 0.9rem; background-color: var(--accent-color);">
                    {{ strtoupper(substr(Auth::user()->full_name, 0, 1)) }}
                </div>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 py-2"
                style="border-radius: 12px; min-width: 180px;">
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ route('hr.settings') }}">
                        <i class="bi bi-person text-primary"></i> My Profile
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider opacity-50">
                </li>
                <li>
                    <form action="{{ route('hr.logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit"
                            class="dropdown-item d-flex align-items-center gap-2 py-2 text-danger fw-bold">
                            <i class="bi bi-box-arrow-right"></i> Logout
                            </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>
