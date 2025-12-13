<nav class="sidebar d-flex flex-column" id="sidebar">
    <a href="{{ route('mentor.dashboard') }}" class="sidebar-brand text-decoration-none">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-person-workspace fs-4 text-accent"></i>
            <span class="fs-6 fw-bold text-accent">Mentor Portal</span>
        </div>
    </a>

    <div class="flex-grow-1 overflow-y-auto no-scrollbar px-3 py-3">
        <ul class="nav flex-column gap-1">

            <a class="nav-link {{ request()->routeIs('mentor.dashboard') ? 'active' : '' }}"
               href="{{ route('mentor.dashboard') }}">
                <i class="bi bi-house-door"></i>
                <span>Dashboard</span>
            </a>

            @php $isStudentsActive = request()->routeIs('mentor.students.*'); @endphp

            <a class="nav-link {{ $isStudentsActive ? 'text-accent' : '' }}" href="#studentsMenu"
               data-bs-toggle="collapse" role="button" aria-expanded="{{ $isStudentsActive ? 'true' : 'false' }}"
               aria-controls="studentsMenu">
                <div class="d-flex justify-content-between w-100 align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-people"></i> <span>Students</span>
                    </div>
                    <i class="bi bi-chevron-down small"></i>
                </div>
            </a>

            <div class="collapse {{ $isStudentsActive ? 'show' : '' }} ps-3 mb-1" id="studentsMenu">
                <a href="{{ route('mentor.students.assigned') }}"
                   class="nav-link small sub-link {{ request()->routeIs('mentor.students.assigned') ? 'active' : '' }}">
                    <i class="bi bi-person-lines-fill me-2"></i> Assigned Students
                </a>
                <a href="{{ route('mentor.students.analytics') }}"
                   class="nav-link small sub-link {{ request()->routeIs('mentor.students.analytics') ? 'active' : '' }}">
                    <i class="bi bi-bar-chart me-2"></i> Analytics
                </a>
            </div>

            @php $isSessionsActive = request()->routeIs('mentor.sessions.*'); @endphp

            <a class="nav-link {{ $isSessionsActive ? 'text-accent' : '' }}" href="#sessionsMenu"
               data-bs-toggle="collapse" role="button" aria-expanded="{{ $isSessionsActive ? 'true' : 'false' }}"
               aria-controls="sessionsMenu">
                <div class="d-flex justify-content-between w-100 align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-calendar-event"></i> <span>Sessions</span>
                    </div>
                    <i class="bi bi-chevron-down small"></i>
                </div>
            </a>

            <div class="collapse {{ $isSessionsActive ? 'show' : '' }} ps-3 mb-1" id="sessionsMenu">
                <a href="{{ route('mentor.sessions.calendar') }}"
                   class="nav-link small sub-link {{ request()->routeIs('mentor.sessions.calendar') ? 'active' : '' }}">
                    <i class="bi bi-calendar3 me-2"></i> Calendar
                </a>
                <a href="{{ route('mentor.sessions.schedule') }}"
                   class="nav-link small sub-link {{ request()->routeIs('mentor.sessions.schedule') ? 'active' : '' }}">
                    <i class="bi bi-plus-circle me-2"></i> Schedule Session
                </a>
                <a href="{{ route('mentor.sessions.history') }}"
                   class="nav-link small sub-link {{ request()->routeIs('mentor.sessions.history') ? 'active' : '' }}">
                    <i class="bi bi-clock-history me-2"></i> History
                </a>
            </div>

            @php $isInternActive = request()->routeIs('mentor.internship.*'); @endphp

            <a class="nav-link {{ $isInternActive ? 'text-accent' : '' }}" href="#internshipMenu"
               data-bs-toggle="collapse" role="button" aria-expanded="{{ $isInternActive ? 'true' : 'false' }}"
               aria-controls="internshipMenu">
                <div class="d-flex justify-content-between w-100 align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-bullseye"></i> <span>Internship</span>
                    </div>
                    <i class="bi bi-chevron-down small"></i>
                </div>
            </a>

            <div class="collapse {{ $isInternActive ? 'show' : '' }} ps-3 mb-1" id="internshipMenu">
                <a href="{{ route('mentor.internship.overview') }}"
                   class="nav-link small sub-link {{ request()->routeIs('mentor.internship.overview') ? 'active' : '' }}">
                    <i class="bi bi-info-circle me-2"></i> Overview
                </a>
                <a href="{{ route('mentor.internship.tasks') }}"
                   class="nav-link small sub-link {{ request()->routeIs('mentor.internship.tasks') ? 'active' : '' }}">
                    <i class="bi bi-list-check me-2"></i> Task Management
                </a>
                <a href="{{ route('mentor.internship.phases') }}"
                   class="nav-link small sub-link {{ request()->routeIs('mentor.internship.phases') ? 'active' : '' }}">
                    <i class="bi bi-map me-2"></i> Phase Guidance
                </a>
            </div>

            @php $isDriveActive = request()->routeIs('mentor.drive.*'); @endphp

            <a class="nav-link {{ $isDriveActive ? 'text-accent' : '' }}" href="#driveMenu"
               data-bs-toggle="collapse" role="button" aria-expanded="{{ $isDriveActive ? 'true' : 'false' }}"
               aria-controls="driveMenu">
                <div class="d-flex justify-content-between w-100 align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-briefcase"></i> <span>Drive Management</span>
                    </div>
                    <i class="bi bi-chevron-down small"></i>
                </div>
            </a>

            <div class="collapse {{ $isDriveActive ? 'show' : '' }} ps-3 mb-1" id="driveMenu">
                <a href="{{ route('mentor.drive.manage') }}"
                   class="nav-link small sub-link {{ request()->routeIs('mentor.drive.manage') ? 'active' : '' }}">
                    <i class="bi bi-hdd-network me-2"></i> Manage Drives
                </a>
                <a href="{{ route('mentor.drive.create') }}"
                   class="nav-link small sub-link {{ request()->routeIs('mentor.drive.create') ? 'active' : '' }}">
                    <i class="bi bi-folder-plus me-2"></i> Create Drive
                </a>
            </div>

            @php $isCommActive = request()->routeIs('mentor.communication.*'); @endphp

            <a class="nav-link {{ $isCommActive ? 'text-accent' : '' }}" href="#commMenu"
               data-bs-toggle="collapse" role="button" aria-expanded="{{ $isCommActive ? 'true' : 'false' }}"
               aria-controls="commMenu">
                <div class="d-flex justify-content-between w-100 align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-chat-left-text"></i> <span>Communication</span>
                    </div>
                    <i class="bi bi-chevron-down small"></i>
                </div>
            </a>

            <div class="collapse {{ $isCommActive ? 'show' : '' }} ps-3 mb-1" id="commMenu">
                <a href="{{ route('mentor.communication.messages') }}"
                   class="nav-link small sub-link {{ request()->routeIs('mentor.communication.messages') ? 'active' : '' }}">
                    <i class="bi bi-envelope me-2"></i> Messages
                </a>
                <a href="{{ route('mentor.communication.groups') }}"
                   class="nav-link small sub-link {{ request()->routeIs('mentor.communication.groups') ? 'active' : '' }}">
                    <i class="bi bi-people-fill me-2"></i> Group Discussions
                </a>
            </div>

            @php $isResActive = request()->routeIs('mentor.resources.*'); @endphp

            <a class="nav-link {{ $isResActive ? 'text-accent' : '' }}" href="#resourceMenu"
               data-bs-toggle="collapse" role="button" aria-expanded="{{ $isResActive ? 'true' : 'false' }}"
               aria-controls="resourceMenu">
                <div class="d-flex justify-content-between w-100 align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-folder2-open"></i> <span>Resources</span>
                    </div>
                    <i class="bi bi-chevron-down small"></i>
                </div>
            </a>

            <div class="collapse {{ $isResActive ? 'show' : '' }} ps-3 mb-1" id="resourceMenu">
                <a href="{{ route('mentor.resources.library') }}"
                   class="nav-link small sub-link {{ request()->routeIs('mentor.resources.library') ? 'active' : '' }}">
                    <i class="bi bi-collection me-2"></i> Library
                </a>
                <a href="{{ route('mentor.resources.assignments') }}"
                   class="nav-link small sub-link {{ request()->routeIs('mentor.resources.assignments') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-plus me-2"></i> Assignment Creator
                </a>
            </div>

            @php $isPerfActive = request()->routeIs('mentor.performance.*'); @endphp

            <a class="nav-link {{ $isPerfActive ? 'text-accent' : '' }}" href="#performanceMenu"
               data-bs-toggle="collapse" role="button" aria-expanded="{{ $isPerfActive ? 'true' : 'false' }}"
               aria-controls="performanceMenu">
                <div class="d-flex justify-content-between w-100 align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-graph-up-arrow"></i> <span>Performance</span>
                    </div>
                    <i class="bi bi-chevron-down small"></i>
                </div>
            </a>

            <div class="collapse {{ $isPerfActive ? 'show' : '' }} ps-3 mb-1" id="performanceMenu">
                <a href="{{ route('mentor.performance.tracking') }}"
                   class="nav-link small sub-link {{ request()->routeIs('mentor.performance.tracking') ? 'active' : '' }}">
                    <i class="bi bi-graph-up me-2"></i> Progress Tracking
                </a>
                <a href="{{ route('mentor.performance.goals') }}"
                   class="nav-link small sub-link {{ request()->routeIs('mentor.performance.goals') ? 'active' : '' }}">
                    <i class="bi bi-flag me-2"></i> Goal Setting
                </a>
            </div>

            @php $isReportActive = request()->routeIs('mentor.reports.*'); @endphp

            <a class="nav-link {{ $isReportActive ? 'text-accent' : '' }}" href="#reportsMenu"
               data-bs-toggle="collapse" role="button" aria-expanded="{{ $isReportActive ? 'true' : 'false' }}"
               aria-controls="reportsMenu">
                <div class="d-flex justify-content-between w-100 align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-file-earmark-text"></i> <span>Reports</span>
                    </div>
                    <i class="bi bi-chevron-down small"></i>
                </div>
            </a>

            <div class="collapse {{ $isReportActive ? 'show' : '' }} ps-3 mb-1" id="reportsMenu">
                <a href="{{ route('mentor.reports.mentoring') }}"
                   class="nav-link small sub-link {{ request()->routeIs('mentor.reports.mentoring') ? 'active' : '' }}">
                    <i class="bi bi-file-text me-2"></i> Mentoring Reports
                </a>
                <a href="{{ route('mentor.reports.assessments') }}"
                   class="nav-link small sub-link {{ request()->routeIs('mentor.reports.assessments') ? 'active' : '' }}">
                    <i class="bi bi-clipboard-check me-2"></i> Student Assessments
                </a>
            </div>

            <a class="nav-link mt-2 {{ request()->routeIs('mentor.notifications') ? 'active' : '' }}"
               href="{{ route('mentor.notifications') }}">
                <div class="d-flex justify-content-between w-100 align-items-center">
                    <span><i class="bi bi-bell me-2"></i> Notifications</span>
                    <span class="badge bg-danger rounded-pill">2</span>
                </div>
            </a>

            <a class="nav-link {{ request()->routeIs('mentor.profile') ? 'active' : '' }}"
               href="{{ route('mentor.profile') }}">
                <i class="bi bi-person-circle me-2"></i> Profile Management
            </a>

            <a class="nav-link {{ request()->routeIs('mentor.settings') ? 'active' : '' }}"
               href="{{ route('mentor.settings') }}">
                <i class="bi bi-gear me-2"></i> Settings
            </a>

        </ul>
    </div>

    <div class="user-footer d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-2">
            <div class="avatar rounded-circle bg-soft-orange text-accent d-flex align-items-center justify-content-center"
                 style="width: 36px; height: 36px; font-weight: bold;">
                SJ
            </div>
            <div style="line-height: 1.2;">
                <div class="fw-bold small text-main">Sarah Johnson</div>
                <div class="text-muted-custom" style="font-size: 0.7rem;">Mentor ID: MEN001</div>
            </div>
        </div>

        <button onclick="toggleTheme()" class="btn btn-link text-muted-custom p-0 text-decoration-none">
            <i id="themeIcon" class="bi bi-moon-stars"></i>
        </button>
    </div>
</nav>
