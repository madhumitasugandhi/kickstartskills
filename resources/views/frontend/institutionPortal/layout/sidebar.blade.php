<div id="sidebar" class="d-flex flex-column">

    <!-- ================= HEADER (FIXED) ================= -->
    <div class="px-3 py-3 border-bottom border-secondary d-flex align-items-center">
        <i class="bi bi-buildings fs-4 me-2 text-teal"></i>
        <span class="fw-bold menu-text">Institution Portal</span>
    </div>

    <!-- ================= SCROLLABLE MENU ================= -->
    <div class="sidebar-scroll">
        <div class="px-3 mt-3 text-muted small">MAIN MENU</div>

        <nav class="mt-2 px-2">

            <a href="{{ route('institute.dashboard') }}"
               class="nav-item-custom {{ request()->is('institute/dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i>
                <span class="menu-text">Dashboard</span>
            </a>

            <!-- Core Management -->
            <div class="sidebar-dropdown">
                <a href="javascript:void(0)"
                   class="nav-item-custom dropdown-toggle-custom"
                   onclick="toggleDropdown(this)">
                    <i class="bi bi-grid me-2"></i>
                    <span class="menu-text">Core Management</span>
                    <i class="bi bi-chevron-down ms-auto dropdown-arrow"></i>
                </a>

                <div class="dropdown-menu-custom">
                    <a href="{{ route('institution.setup') }}" class="nav-item-custom sub-item">
                        <i class="bi bi-gear me-2"></i> Institution Setup
                    </a>
                    <a href="{{ route('institution.course-management') }}" class="nav-item-custom sub-item">
                        <i class="bi bi-book me-2"></i> Course Management
                    </a>
                    <a href="{{ route('institution.drive-management') }}" class="nav-item-custom sub-item">
                        <i class="bi bi-hdd-network me-2"></i> Drive Management
                    </a>
                    <a href="{{ route('institution.academic-structure') }}" class="nav-item-custom sub-item">
                        <i class="bi bi-diagram-3 me-2"></i> Academic Structure
                    </a>
                    <a href="{{ route('institution.internships') }}" class="nav-item-custom sub-item">
                        <i class="bi bi-briefcase me-2"></i> Internships
                    </a>
                    <a href="{{ route('institution.financial-management') }}" class="nav-item-custom sub-item">
                        <i class="bi bi-currency-dollar me-2"></i> Financial Management
                    </a>
                    <a href="{{ route('institution.system-integrations') }}" class="nav-item-custom sub-item">
                        <i class="bi bi-link-45deg me-2"></i> System Integrations
                    </a>
                </div>
            </div>

            <!-- Programs -->
            <div class="sidebar-dropdown">
                <a href="javascript:void(0)" class="nav-item-custom dropdown-toggle-custom"
                   onclick="toggleDropdown(this)">
                    <i class="bi bi-journal-bookmark me-2"></i>
                    <span class="menu-text">Programs</span>
                    <i class="bi bi-chevron-down ms-auto dropdown-arrow"></i>
                </a>
                <div class="dropdown-menu-custom">
                    <a href="{{ route('institution.program-management') }}" class="nav-item-custom sub-item">
                        <i class="bi bi-kanban me-2"></i> Management
                    </a>
                    <a href="{{ route('institution.course-catalog') }}" class="nav-item-custom sub-item">
                        <i class="bi bi-search me-2"></i> Course Catalog
                    </a>
                    <a href="{{ route('institution.programs-assessment') }}" class="nav-item-custom sub-item">
                        <i class="bi bi-clipboard-check me-2"></i> Assessment
                    </a>
                </div>
            </div>

            <!-- Students -->
            <div class="sidebar-dropdown">
                <a href="javascript:void(0)" class="nav-item-custom dropdown-toggle-custom"
                   onclick="toggleDropdown(this)">
                    <i class="bi bi-people me-2"></i>
                    <span class="menu-text">Students</span>
                    <i class="bi bi-chevron-down ms-auto dropdown-arrow"></i>
                </a>
                <div class="dropdown-menu-custom">
                    <a href="{{ route('institution.students-overview') }}" class="nav-item-custom sub-item">
                        <i class="bi bi-bar-chart me-2"></i> Overview
                    </a>
                    <a href="{{ route('institution.data-dashboard') }}" class="nav-item-custom sub-item">
                        <i class="bi bi-graph-up me-2"></i> Data Dashboard
                    </a>
                    <a href="{{ route('institution.enrollment') }}" class="nav-item-custom sub-item">
                        <i class="bi bi-person-plus me-2"></i> Enrollment
                    </a>
                    <a href="{{ route('institution.academic-records') }}" class="nav-item-custom sub-item">
                        <i class="bi bi-folder-check me-2"></i> Academic Records
                    </a>
                </div>
            </div>

            <!-- Faculty -->
            <div class="sidebar-dropdown">
                <a href="javascript:void(0)" class="nav-item-custom dropdown-toggle-custom"
                   onclick="toggleDropdown(this)">
                    <i class="bi bi-person-badge me-2"></i>
                    <span class="menu-text">Faculty</span>
                    <i class="bi bi-chevron-down ms-auto dropdown-arrow"></i>
                </a>
                <div class="dropdown-menu-custom">
                    <a href="{{ route('institution.faculty-management') }}" class="nav-item-custom sub-item">
                        <i class="bi bi-people-fill me-2"></i> Management
                    </a>
                    <a href="{{ route('institution.faculty-assignments') }}" class="nav-item-custom sub-item">
                        <i class="bi bi-diagram-2 me-2"></i> Assignments
                    </a>
                </div>
            </div>

            <!-- Analytics -->
            <div class="sidebar-dropdown">
                <a href="javascript:void(0)" class="nav-item-custom dropdown-toggle-custom"
                   onclick="toggleDropdown(this)">
                    <i class="bi bi-bar-chart-line me-2"></i>
                    <span class="menu-text">Analytics</span>
                    <i class="bi bi-chevron-down ms-auto dropdown-arrow"></i>
                </a>
                <div class="dropdown-menu-custom">
                    <a href="{{ route('institution.advanced-dashboard') }}" class="nav-item-custom sub-item">
                        <i class="bi bi-speedometer me-2"></i> Advanced Dashboard
                    </a>
                    <a href="{{ route('institution.analytics-performance') }}" class="nav-item-custom sub-item">
                        <i class="bi bi-activity me-2"></i> Performance
                    </a>
                    <a href="{{ route('institution.analytics-reports') }}" class="nav-item-custom sub-item">
                        <i class="bi bi-file-earmark-bar-graph me-2"></i> Reports
                    </a>
                </div>
            </div>

            <!-- Communication -->
            <div class="sidebar-dropdown">
                <a href="javascript:void(0)" class="nav-item-custom dropdown-toggle-custom"
                   onclick="toggleDropdown(this)">
                    <i class="bi bi-megaphone me-2"></i>
                    <span class="menu-text">Communication</span>
                    <i class="bi bi-chevron-down ms-auto dropdown-arrow"></i>
                </a>
                <div class="dropdown-menu-custom">
                    <a href="{{ route('institution.communication-announcements') }}" class="nav-item-custom sub-item">
                        <i class="bi bi-broadcast me-2"></i> Announcements
                    </a>
                    <a href="{{ route('institution.communication-messaging') }}" class="nav-item-custom sub-item">
                        <i class="bi bi-chat-dots me-2"></i> Messaging
                    </a>
                </div>
            </div>

            <a href="{{ route('institution.compliance-reports') }}" class="nav-item-custom">
                <i class="bi bi-shield-check me-2"></i>
                <span class="menu-text">Compliance Reports</span>
            </a>

            <a href="{{ route('institution.settings') }}" class="nav-item-custom">
                <i class="bi bi-sliders me-2"></i>
                <span class="menu-text">Settings</span>
            </a>

            <a href="{{ route('institution.notifications') }}" class="nav-item-custom">
                <i class="bi bi-bell me-2"></i>
                <span class="menu-text">Notifications</span>
            </a>

        </nav>
    </div>

    <!-- ================= FOOTER (FIXED) ================= -->
    <div class="sidebar-footer px-3 py-2 border-top border-secondary d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <div class="rounded-circle d-flex align-items-center justify-content-center me-2"
                 style="width:35px;height:35px;background:rgba(45,212,191,0.18);">
                <i class="bi bi-bank text-teal"></i>
            </div>
            <div class="sidebar-footer-text">
                <div class="fw-bold" style="font-size:13px;">ABC Institute</div>
                <div class="small" style="font-size:11px;">ID: INS001</div>
            </div>
        </div>

        <button class="btn btn-link p-0 theme-toggle-btn">
            <i class="bi bi-moon-stars fs-5"></i>
        </button>
    </div>

</div>

<script>
function toggleDropdown(el) {
    const parent = el.closest('.sidebar-dropdown');
    const sidebar = document.getElementById('sidebar');

    // Prevent dropdown when sidebar is collapsed
    if (sidebar.classList.contains('collapsed')) return;

    // Close other dropdowns
    document.querySelectorAll('.sidebar-dropdown').forEach(drop => {
        if (drop !== parent) {
            drop.classList.remove('open');
            drop.querySelector('.dropdown-toggle-custom')
                ?.setAttribute('aria-expanded', 'false');
        }
    });

    const isOpen = parent.classList.toggle('open');
    el.setAttribute('aria-expanded', isOpen);
}
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.dropdown-menu-custom .active')
        .forEach(activeItem => {
            const dropdown = activeItem.closest('.sidebar-dropdown');
            if (dropdown) {
                dropdown.classList.add('open');
                dropdown.querySelector('.dropdown-toggle-custom')
                    ?.setAttribute('aria-expanded', 'true');
            }
        });
});
</script>
