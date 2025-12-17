<nav class="sidebar d-flex flex-column" id="sidebar">
    <div class="sidebar-brand d-flex align-items-center justify-content-between px-3 mt-3 mb-2">
        <a href="{{ route('hr.dashboard') }}" class="text-decoration-none d-flex align-items-center">
            <i class="bi bi-people fs-4 text-accent"></i>
            <span class="brand-text fs-6 fw-bold text-accent ms-2">HR Portal</span>
        </a>

        <div class="d-lg-none --text-muted" id="sidebarCloseBtn" style="cursor: pointer;">
            <i class="bi bi-x-lg border rounded-2 d-flex align-items-center justify-content-center"
               style="width: 32px; height: 32px; font-size: 16px; margin-top: -5px;"></i>
        </div>
    </div>

    <div class="flex-grow-1 overflow-y-auto no-scrollbar px-3 py-3">
        <ul class="nav flex-column gap-1">

            <a class="nav-link {{ request()->routeIs('hr.dashboard') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('hr.dashboard') }}">
                <i class="bi bi-house-door fs-5"></i>
                <span class="nav-label ms-3">Dashboard</span>
            </a>

            <a class="nav-link {{ request()->routeIs('hr.employees') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('hr.employees') }}">
                <i class="bi bi-people fs-5"></i>
                <span class="nav-label ms-3">Employee Management</span>
            </a>

            <a class="nav-link {{ request()->routeIs('hr.recruitment') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('hr.recruitment') }}">
                <i class="bi bi-briefcase fs-5"></i>
                <span class="nav-label ms-3">Recruitment Pipeline</span>
            </a>

            <a class="nav-link {{ request()->routeIs('hr.drives') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('hr.drives') }}">
                <i class="bi bi-bullseye fs-5"></i>
                <span class="nav-label ms-3">Corporate Drives</span>
            </a>

            <a class="nav-link {{ request()->routeIs('hr.analytics') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('hr.analytics') }}">
                <i class="bi bi-graph-up-arrow fs-5"></i>
                <span class="nav-label ms-3">Drive Analytics</span>
            </a>

            <a class="nav-link {{ request()->routeIs('hr.performance') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('hr.performance') }}">
                <i class="bi bi-star fs-5"></i>
                <span class="nav-label ms-3">Performance Reviews</span>
            </a>

            <a class="nav-link {{ request()->routeIs('hr.attendance') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('hr.attendance') }}">
                <i class="bi bi-calendar-check fs-5"></i>
                <span class="nav-label ms-3">Attendance Management</span>
            </a>

            <a class="nav-link {{ request()->routeIs('hr.reports') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('hr.reports') }}">
                <i class="bi bi-bar-chart-fill fs-5"></i>
                <span class="nav-label ms-3">HR Analytics</span>
            </a>

            <a class="nav-link {{ request()->routeIs('hr.notifications') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('hr.notifications') }}">
                <i class="bi bi-bell fs-5"></i>
                <span class="nav-label ms-3">Notifications</span>
            </a>

            <a class="nav-link {{ request()->routeIs('hr.settings') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('hr.settings') }}">
                <i class="bi bi-gear fs-5"></i>
                <span class="nav-label ms-3">Settings</span>
            </a>

        </ul>
    </div>

    <div class="user-footer p-2 m-2">
         <div class="d-flex align-items-center gap-2 p-2 rounded">
             <div class="avatar rounded-circle bg-soft-orange text-accent d-flex align-items-center justify-content-center flex-shrink-0"
                  style="width: 36px; height: 36px; font-weight: bold;">HM</div>

             <div class="user-info flex-grow-1" style="line-height: 1.2;">
                 <div class="fw-bold small text-main">HR Manager</div>
                 <div class="text-muted-custom" style="font-size: 0.7rem;">Manager ID: HRM001</div>
             </div>
         </div>
    </div>
</nav>
