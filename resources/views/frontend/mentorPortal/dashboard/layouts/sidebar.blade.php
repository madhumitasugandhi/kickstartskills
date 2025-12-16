<nav class="sidebar d-flex flex-column" id="sidebar">
    <div class="sidebar-brand d-flex align-items-center justify-content-between px-3 mt-3 mb-2">
        <a href="{{ route('mentor.dashboard') }}" class="text-decoration-none d-flex align-items-center">
            <i class="bi bi-person-workspace fs-4 text-accent"></i>
            <span class="brand-text fs-6 fw-bold text-accent ms-2">Mentor Portal</span>
        </a>

        <div class="d-lg-none --text-muted" id="sidebarCloseBtn" style="cursor: pointer;">
            <i class="bi bi-x-lg border rounded-2 d-flex align-items-center justify-content-center"
               style="width: 32px; height: 32px; font-size: 16px; margin-top: -5px;"></i>
        </div>
    </div>

    <div class="flex-grow-1 overflow-y-auto no-scrollbar px-3 py-3">
        <ul class="nav flex-column gap-1">

            <a class="nav-link {{ request()->routeIs('mentor.dashboard') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('mentor.dashboard') }}">
                <i class="bi bi-house-door fs-5"></i>
                <span class="nav-label ms-3">Dashboard</span>
            </a>

            @php $isStudentsActive = request()->routeIs('mentor.students.*'); @endphp
            <a class="nav-link {{ $isStudentsActive ? 'text-accent' : '' }} d-flex align-items-center justify-content-between"
               href="#studentsMenu" data-bs-toggle="collapse" role="button" aria-expanded="{{ $isStudentsActive ? 'true' : 'false' }}">
                <div class="d-flex align-items-center">
                    <i class="bi bi-people fs-5"></i>
                    <span class="nav-label ms-3">Students</span>
                </div>
                <i class="bi bi-chevron-down dropdown-arrow" style="font-size: 0.8rem;"></i>
            </a>

            <div class="collapse {{ $isStudentsActive ? 'show' : '' }} ps-3 mb-1" id="studentsMenu">
                <a href="{{ route('mentor.students.assigned') }}" class="nav-link small sub-link {{ request()->routeIs('mentor.students.assigned') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-person-lines-fill"></i> <span class="nav-label ms-3">Assigned Students</span>
                </a>
                <a href="{{ route('mentor.students.analytics') }}" class="nav-link small sub-link {{ request()->routeIs('mentor.students.analytics') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-bar-chart"></i> <span class="nav-label ms-3">Analytics</span>
                </a>
            </div>

            @php $isSessionsActive = request()->routeIs('mentor.sessions.*'); @endphp
            <a class="nav-link {{ $isSessionsActive ? 'text-accent' : '' }} d-flex align-items-center justify-content-between"
               href="#sessionsMenu" data-bs-toggle="collapse" role="button" aria-expanded="{{ $isSessionsActive ? 'true' : 'false' }}">
                <div class="d-flex align-items-center">
                    <i class="bi bi-calendar-event fs-5"></i>
                    <span class="nav-label ms-3">Sessions</span>
                </div>
                <i class="bi bi-chevron-down dropdown-arrow" style="font-size: 0.8rem;"></i>
            </a>

            <div class="collapse {{ $isSessionsActive ? 'show' : '' }} ps-3 mb-1" id="sessionsMenu">
                <a href="{{ route('mentor.sessions.calendar') }}" class="nav-link small sub-link {{ request()->routeIs('mentor.sessions.calendar') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-calendar3"></i> <span class="nav-label ms-3">Calendar</span>
                </a>
                <a href="{{ route('mentor.sessions.schedule') }}" class="nav-link small sub-link {{ request()->routeIs('mentor.sessions.schedule') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-plus-circle"></i> <span class="nav-label ms-3">Schedule Session</span>
                </a>
                <a href="{{ route('mentor.sessions.history') }}" class="nav-link small sub-link {{ request()->routeIs('mentor.sessions.history') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-clock-history"></i> <span class="nav-label ms-3">History</span>
                </a>
            </div>

            @php $isInternActive = request()->routeIs('mentor.internship.*'); @endphp
            <a class="nav-link {{ $isInternActive ? 'text-accent' : '' }} d-flex align-items-center justify-content-between"
               href="#internshipMenu" data-bs-toggle="collapse" role="button" aria-expanded="{{ $isInternActive ? 'true' : 'false' }}">
                <div class="d-flex align-items-center">
                    <i class="bi bi-bullseye fs-5"></i>
                    <span class="nav-label ms-3">Internship</span>
                </div>
                <i class="bi bi-chevron-down dropdown-arrow" style="font-size: 0.8rem;"></i>
            </a>

            <div class="collapse {{ $isInternActive ? 'show' : '' }} ps-3 mb-1" id="internshipMenu">
                <a href="{{ route('mentor.internship.overview') }}" class="nav-link small sub-link {{ request()->routeIs('mentor.internship.overview') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-info-circle"></i> <span class="nav-label ms-3">Overview</span>
                </a>
                <a href="{{ route('mentor.internship.tasks') }}" class="nav-link small sub-link {{ request()->routeIs('mentor.internship.tasks') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-list-check"></i> <span class="nav-label ms-3">Task Management</span>
                </a>
                <a href="{{ route('mentor.internship.phases') }}" class="nav-link small sub-link {{ request()->routeIs('mentor.internship.phases') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-map"></i> <span class="nav-label ms-3">Phase Guidance</span>
                </a>
            </div>

            @php $isDriveActive = request()->routeIs('mentor.drive.*'); @endphp
            <a class="nav-link {{ $isDriveActive ? 'text-accent' : '' }} d-flex align-items-center justify-content-between"
               href="#driveMenu" data-bs-toggle="collapse" role="button" aria-expanded="{{ $isDriveActive ? 'true' : 'false' }}">
                <div class="d-flex align-items-center">
                    <i class="bi bi-briefcase fs-5"></i>
                    <span class="nav-label ms-3">Drive Mgmt</span>
                </div>
                <i class="bi bi-chevron-down dropdown-arrow" style="font-size: 0.8rem;"></i>
            </a>

            <div class="collapse {{ $isDriveActive ? 'show' : '' }} ps-3 mb-1" id="driveMenu">
                <a href="{{ route('mentor.drive.manage') }}" class="nav-link small sub-link {{ request()->routeIs('mentor.drive.manage') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-hdd-network"></i> <span class="nav-label ms-3">Manage Drives</span>
                </a>
                <a href="{{ route('mentor.drive.create') }}" class="nav-link small sub-link {{ request()->routeIs('mentor.drive.create') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-folder-plus"></i> <span class="nav-label ms-3">Create Drive</span>
                </a>
            </div>

            @php $isCommActive = request()->routeIs('mentor.communication.*'); @endphp
            <a class="nav-link {{ $isCommActive ? 'text-accent' : '' }} d-flex align-items-center justify-content-between"
               href="#commMenu" data-bs-toggle="collapse" role="button" aria-expanded="{{ $isCommActive ? 'true' : 'false' }}">
                <div class="d-flex align-items-center">
                    <i class="bi bi-chat-left-text fs-5"></i>
                    <span class="nav-label ms-3">Communication</span>
                </div>
                <i class="bi bi-chevron-down dropdown-arrow" style="font-size: 0.8rem;"></i>
            </a>

            <div class="collapse {{ $isCommActive ? 'show' : '' }} ps-3 mb-1" id="commMenu">
                <a href="{{ route('mentor.communication.messages') }}" class="nav-link small sub-link {{ request()->routeIs('mentor.communication.messages') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-envelope"></i> <span class="nav-label ms-3">Messages</span>
                </a>
                <a href="{{ route('mentor.communication.groups') }}" class="nav-link small sub-link {{ request()->routeIs('mentor.communication.groups') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-people-fill"></i> <span class="nav-label ms-3">Group Discussions</span>
                </a>
            </div>

            @php $isResActive = request()->routeIs('mentor.resources.*'); @endphp
            <a class="nav-link {{ $isResActive ? 'text-accent' : '' }} d-flex align-items-center justify-content-between"
               href="#resourceMenu" data-bs-toggle="collapse" role="button" aria-expanded="{{ $isResActive ? 'true' : 'false' }}">
                <div class="d-flex align-items-center">
                    <i class="bi bi-folder2-open fs-5"></i>
                    <span class="nav-label ms-3">Resources</span>
                </div>
                <i class="bi bi-chevron-down dropdown-arrow" style="font-size: 0.8rem;"></i>
            </a>

            <div class="collapse {{ $isResActive ? 'show' : '' }} ps-3 mb-1" id="resourceMenu">
                <a href="{{ route('mentor.resources.library') }}" class="nav-link small sub-link {{ request()->routeIs('mentor.resources.library') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-collection"></i> <span class="nav-label ms-3">Library</span>
                </a>
                <a href="{{ route('mentor.resources.assignments') }}" class="nav-link small sub-link {{ request()->routeIs('mentor.resources.assignments') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-file-earmark-plus"></i> <span class="nav-label ms-3">Assignment Creator</span>
                </a>
            </div>

            @php $isPerfActive = request()->routeIs('mentor.performance.*'); @endphp
            <a class="nav-link {{ $isPerfActive ? 'text-accent' : '' }} d-flex align-items-center justify-content-between"
               href="#performanceMenu" data-bs-toggle="collapse" role="button" aria-expanded="{{ $isPerfActive ? 'true' : 'false' }}">
                <div class="d-flex align-items-center">
                    <i class="bi bi-graph-up-arrow fs-5"></i>
                    <span class="nav-label ms-3">Performance</span>
                </div>
                <i class="bi bi-chevron-down dropdown-arrow" style="font-size: 0.8rem;"></i>
            </a>

            <div class="collapse {{ $isPerfActive ? 'show' : '' }} ps-3 mb-1" id="performanceMenu">
                <a href="{{ route('mentor.performance.tracking') }}" class="nav-link small sub-link {{ request()->routeIs('mentor.performance.tracking') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-graph-up"></i> <span class="nav-label ms-3">Progress Tracking</span>
                </a>
                <a href="{{ route('mentor.performance.goals') }}" class="nav-link small sub-link {{ request()->routeIs('mentor.performance.goals') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-flag"></i> <span class="nav-label ms-3">Goal Setting</span>
                </a>
            </div>

            @php $isReportActive = request()->routeIs('mentor.reports.*'); @endphp
            <a class="nav-link {{ $isReportActive ? 'text-accent' : '' }} d-flex align-items-center justify-content-between"
               href="#reportsMenu" data-bs-toggle="collapse" role="button" aria-expanded="{{ $isReportActive ? 'true' : 'false' }}">
                <div class="d-flex align-items-center">
                    <i class="bi bi-file-earmark-text fs-5"></i>
                    <span class="nav-label ms-3">Reports</span>
                </div>
                <i class="bi bi-chevron-down dropdown-arrow" style="font-size: 0.8rem;"></i>
            </a>

            <div class="collapse {{ $isReportActive ? 'show' : '' }} ps-3 mb-1" id="reportsMenu">
                <a href="{{ route('mentor.reports.mentoring') }}" class="nav-link small sub-link {{ request()->routeIs('mentor.reports.mentoring') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-file-text"></i> <span class="nav-label ms-3">Mentoring Reports</span>
                </a>
                <a href="{{ route('mentor.reports.assessments') }}" class="nav-link small sub-link {{ request()->routeIs('mentor.reports.assessments') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-clipboard-check"></i> <span class="nav-label ms-3">Student Assessments</span>
                </a>
            </div>

            <a class="nav-link mt-2 {{ request()->routeIs('mentor.notifications') ? 'active' : '' }} d-flex align-items-center justify-content-between"
               href="{{ route('mentor.notifications') }}">
                <div class="d-flex align-items-center">
                    <i class="bi bi-bell fs-5"></i>
                    <span class="nav-label ms-3">Notifications</span>
                </div>
                <span class="badge bg-danger rounded-pill nav-label">2</span>
            </a>

            <a class="nav-link {{ request()->routeIs('mentor.profile') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('mentor.profile') }}">
                <i class="bi bi-person-circle fs-5"></i>
                <span class="nav-label ms-3">Profile Management</span>
            </a>

            <a class="nav-link {{ request()->routeIs('mentor.settings') ? 'active' : '' }} d-flex align-items-center"
               href="{{ route('mentor.settings') }}">
                <i class="bi bi-gear fs-5"></i>
                <span class="nav-label ms-3">Settings</span>
            </a>

        </ul>
    </div>

    <div class="user-footer p-2 m-2">
         <div class="d-flex align-items-center gap-2 p-2 rounded">
             <div class="avatar rounded-circle bg-soft-orange text-accent d-flex align-items-center justify-content-center flex-shrink-0"
                 style="width: 36px; height: 36px; font-weight: bold;">SJ</div>

             <div class="user-info flex-grow-1" style="line-height: 1.2;">
                 <div class="fw-bold small text-main">Sarah Johnson</div>
                 <div class="text-muted-custom" style="font-size: 0.7rem;">Mentor ID: MEN001</div>
             </div>

             <button onclick="toggleTheme()" class="btn btn-link text-muted-custom p-0 text-decoration-none user-info">
                <i id="themeIcon" class="bi bi-moon-stars"></i>
             </button>
         </div>
    </div>
</nav>
