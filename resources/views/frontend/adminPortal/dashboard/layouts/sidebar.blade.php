<nav class="sidebar d-flex flex-column" id="sidebar">
    <div class="sidebar-brand d-flex align-items-center justify-content-between px-3 mt-3 mb-2">
        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none d-flex align-items-center mt-3 mb-3">
            <i class="bi bi-shield-fill fs-4 text-accent"></i>
            <span class="brand-text fs-6 fw-bold text-accent ms-2">Admin Portal</span>
        </a>

        <div class="d-lg-none --text-muted" id="sidebarCloseBtn" style="cursor: pointer;">
            <i class="bi bi-x-lg border rounded-2 d-flex align-items-center justify-content-center"
               style="width: 32px; height: 32px; font-size: 16px; margin-top: -5px;"></i>
        </div>
    </div>

    <div class="flex-grow-1 overflow-y-auto no-scrollbar px-3 py-3">
        <ul class="nav flex-column gap-1">

            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('admin.dashboard') }}">
                <i class="bi  bi-house-door  fs-5"></i>
                <span class="nav-label ms-3">Dashboard</span>
            </a>

            <a class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('admin.users') }}">
                <i class="bi bi-people fs-5"></i>
                <span class="nav-label ms-3">User Management</span>
            </a>

            <a class="nav-link {{ request()->routeIs('admin.drives') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('admin.drives') }}">
                <i class="bi bi-activity fs-5"></i>
                <span class="nav-label ms-3">Drive Oversight</span>
                <span class="badge bg-danger ms-auto" style="font-size: 0.65rem;">New</span>
            </a>

            <a class="nav-link {{ request()->routeIs('admin.institutions') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('admin.institutions') }}">
                <i class="bi bi-buildings fs-5"></i>
                <span class="nav-label ms-3">Institutions</span>
            </a>

            <a class="nav-link {{ request()->routeIs('admin.system') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('admin.system') }}">
                <i class="bi bi-gear-wide-connected fs-5"></i>
                <span class="nav-label ms-3">System Config</span>
            </a>

            <a class="nav-link {{ request()->routeIs('admin.analytics') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('admin.analytics') }}">
                <i class="bi bi-bar-chart-line fs-5"></i>
                <span class="nav-label ms-3">Analytics</span>
            </a>

            <a class="nav-link {{ request()->routeIs('admin.security') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('admin.security') }}">
                <i class="bi bi-shield-check fs-5"></i>
                <span class="nav-label ms-3">Security</span>
            </a>

            <a class="nav-link {{ request()->routeIs('admin.content') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('admin.content') }}">
                <i class="bi bi-file-text fs-5"></i>
                <span class="nav-label ms-3">Content</span>
            </a>

            <a class="nav-link {{ request()->routeIs('admin.support') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('admin.support') }}">
                <i class="bi bi-gear fs-5"></i>
                <span class="nav-label ms-3">Support</span>
            </a>

            <a class="nav-link {{ request()->routeIs('admin.billing') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('admin.billing') }}">
                <i class="bi bi-credit-card fs-5"></i>
                <span class="nav-label ms-3">Billing</span>
                <span class="badge bg-soft-red ms-auto" style="font-size: 0.65rem;">12</span>
            </a>

            <a class="nav-link {{ request()->routeIs('admin.ai_analytics') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('admin.ai_analytics') }}">
                <i class="bi bi-cpu fs-5"></i>
                <span class="nav-label ms-3">AI Analytics</span>
            </a>

            <a class="nav-link {{ request()->routeIs('admin.workflows') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('admin.workflows') }}">
                <i class="bi bi-diagram-3 fs-5"></i>
                <span class="nav-label ms-3">Workflows</span>
            </a>

            <a class="nav-link {{ request()->routeIs('admin.monitoring') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('admin.monitoring') }}">
                <i class="bi bi-activity fs-5"></i>
                <span class="nav-label ms-3">Monitoring</span>
                <span class="badge bg-danger ms-auto" style="font-size: 0.65rem;">Live</span>
            </a>

            <a class="nav-link {{ request()->routeIs('admin.intelligence') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('admin.intelligence') }}">
                <i class="bi bi-lightbulb fs-5"></i>
                <span class="nav-label ms-3">Intelligence</span>
            </a>

        </ul>
    </div>

    <div class="user-footer p-2 m-2">
         <div class="d-flex align-items-center gap-2 p-2 rounded">
             <div class="avatar rounded-circle bg-soft-red text-accent d-flex align-items-center justify-content-center flex-shrink-0"
                  style="width: 36px; height: 36px; font-weight: bold;">SA</div>

             <div class="user-info flex-grow-1" style="line-height: 1.2;">
                 <div class="fw-bold small text-main">Super Admin</div>
                 <div class="text-muted-custom" style="font-size: 0.7rem;">System Admin</div>
             </div>
         </div>
    </div>
</nav>
