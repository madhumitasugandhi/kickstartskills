<aside class="sidebar d-flex flex-column no-scrollbar" id="sidebar">
    <div class="sidebar-brand d-flex align-items-center justify-content-between px-3 mt-3 mb-2">
        <div class="d-flex align-items-center">
            <i class="bi bi-journal-text fs-4 text-primary"></i>
            <span class="brand-text fw-bold ms-2" style="font-size: 1.2rem;">Student Portal</span>
        </div>
        <div class="d-lg-none --text-muted" id="sidebarCloseBtn" style="cursor: pointer;">
            <i class="bi bi-x-lg border rounded-2 d-flex align-items-center justify-content-center"
                style="width: 32px; height: 32px; font-size: 16px; margin-top: -5px;"></i>
        </div>
    </div>

    <div class="p-3 flex-grow-1">

        <div class="p-3 flex-grow-1">
            <nav class="nav flex-column gap-1">
                <a class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }} d-flex align-items-center"
                    href="{{ route('student.dashboard') }}">
                    <i class="bi bi-grid fs-5"></i>
                    <span class="nav-label ms-3">Dashboard</span>
                </a>

                @php $isProfileActive = request()->routeIs('student.profile.*'); @endphp
                <a class="nav-link {{ $isProfileActive ? 'text-primary' : '' }} d-flex align-items-center justify-content-between"
                    href="#profileSubmenu" data-bs-toggle="collapse" role="button"
                    aria-expanded="{{ $isProfileActive ? 'true' : 'false' }}">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-person fs-5"></i>
                        <span class="nav-label ms-3">Profile</span>
                    </div>
                    <i class="bi bi-chevron-down dropdown-arrow" style="font-size: 0.8rem;"></i>
                </a>

                <div class="collapse {{ $isProfileActive ? 'show' : '' }} ps-3 mb-1" id="profileSubmenu">
                    <a href="{{ route('student.profile.personal') }}"
                        class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.profile.personal') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }} d-flex align-items-center">
                        <i class="bi bi-pencil-square"></i> <span class="nav-label ms-3">Personal Info</span>
                    </a>
                    <a href="{{ route('student.profile.academic') }}"
                        class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.profile.academic') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }} d-flex align-items-center">
                        <i class="bi bi-mortarboard"></i> <span class="nav-label ms-3">Academic Details</span>
                    </a>
                    <a href="{{ route('student.profile.portfolio') }}"
                        class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.profile.portfolio') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }} d-flex align-items-center">
                        <i class="bi bi-briefcase"></i> <span class="nav-label ms-3">Portfolio</span>
                    </a>
                </div>

                @php $isExamActive = request()->routeIs('student.exam.*'); @endphp
                <a class="nav-link {{ $isExamActive ? 'text-primary' : '' }} d-flex align-items-center justify-content-between"
                    href="#examSubmenu" data-bs-toggle="collapse" role="button"
                    aria-expanded="{{ $isExamActive ? 'true' : 'false' }}">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-file-earmark-text fs-5"></i>
                        <span class="nav-label ms-3">Examinations</span>
                    </div>
                    <i class="bi bi-chevron-down dropdown-arrow" style="font-size: 0.8rem;"></i>
                </a>

                <div class="collapse {{ $isExamActive ? 'show' : '' }} ps-3 mb-1" id="examSubmenu">
                    <a href="{{ route('student.exam.take') }}"
                        class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.exam.take') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }} d-flex align-items-center">
                        <i class="bi bi-play-circle"></i> <span class="nav-label ms-3">Take Test</span>
                    </a>
                    <a href="{{ route('student.exam.history') }}"
                        class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.exam.history') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }} d-flex align-items-center">
                        <i class="bi bi-clock-history"></i> <span class="nav-label ms-3">Test History</span>
                    </a>
                    <a href="{{ route('student.exam.results') }}"
                        class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.exam.results') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }} d-flex align-items-center">
                        <i class="bi bi-bar-chart"></i> <span class="nav-label ms-3">Results</span>
                    </a>
                    <a href="{{ route('student.exam.practice') }}"
                        class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.exam.practice') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }} d-flex align-items-center">
                        <i class="bi bi-lightning-charge"></i> <span class="nav-label ms-3">Practice Tests</span>
                    </a>
                </div>

                @php $isLearningActive = request()->routeIs('student.learning.*'); @endphp
                <a class="nav-link {{ $isLearningActive ? 'text-primary' : '' }} d-flex align-items-center justify-content-between"
                    href="#learningSubmenu" data-bs-toggle="collapse" role="button"
                    aria-expanded="{{ $isLearningActive ? 'true' : 'false' }}">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-book fs-5"></i>
                        <span class="nav-label ms-3">Learning</span>
                    </div>
                    <i class="bi bi-chevron-down dropdown-arrow" style="font-size: 0.8rem;"></i>
                </a>

                <div class="collapse {{ $isLearningActive ? 'show' : '' }} ps-3 mb-1" id="learningSubmenu">
                    <a href="{{ route('student.learning.my_courses') }}"
                        class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.learning.my_courses') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }} d-flex align-items-center">
                        <i class="bi bi-play-circle"></i> <span class="nav-label ms-3">My Courses</span>
                    </a>
                    <a href="{{ route('student.learning.catalog') }}"
                        class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.learning.catalog') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }} d-flex align-items-center">
                        <i class="bi bi-search"></i> <span class="nav-label ms-3">Course Catalog</span>
                    </a>
                    <a href="{{ route('student.learning.resources') }}"
                        class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.learning.resources') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }} d-flex align-items-center">
                        <i class="bi bi-folder2-open"></i> <span class="nav-label ms-3">Resources</span>
                    </a>
                    <a href="{{ route('student.learning.recommendations') }}"
                        class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.learning.recommendations') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }} d-flex align-items-center">
                        <i class="bi bi-star"></i> <span class="nav-label ms-3">Recommendations</span>
                    </a>
                </div>

                @php $isInternActive = request()->routeIs('student.internship.*'); @endphp
                <a class="nav-link {{ $isInternActive ? 'text-primary' : '' }} d-flex align-items-center justify-content-between"
                    href="#internSubmenu" data-bs-toggle="collapse" role="button"
                    aria-expanded="{{ $isInternActive ? 'true' : 'false' }}">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-briefcase fs-5"></i>
                        <span class="nav-label ms-3">Internship</span>
                    </div>
                    <i class="bi bi-chevron-down dropdown-arrow" style="font-size: 0.8rem;"></i>
                </a>

                <div class="collapse {{ $isInternActive ? 'show' : '' }} ps-3 mb-1" id="internSubmenu">
                    <a href="{{ route('student.internship.overview') }}"
                        class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.internship.overview') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }} d-flex align-items-center">
                        <i class="bi bi-eye"></i> <span class="nav-label ms-3">Overview</span>
                    </a>
                    <a href="{{ route('student.internship.tasks') }}"
                        class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.internship.tasks') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }} d-flex align-items-center">
                        <i class="bi bi-list-task"></i> <span class="nav-label ms-3">Tasks & Assignments</span>
                    </a>
                    <a href="{{ route('student.internship.progress') }}"
                        class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.internship.progress') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }} d-flex align-items-center">
                        <i class="bi bi-graph-up-arrow"></i> <span class="nav-label ms-3">Progress Tracking</span>
                    </a>
                    <a href="{{ route('student.internship.phases') }}"
                        class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.internship.phases') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }} d-flex align-items-center">
                        <i class="bi bi-layers"></i> <span class="nav-label ms-3">Phase Details</span>
                    </a>
                </div>

                @php $isAttActive = request()->routeIs('student.attendance.*'); @endphp
                <a class="nav-link {{ $isAttActive ? 'text-primary' : '' }} d-flex align-items-center justify-content-between"
                    href="#attSubmenu" data-bs-toggle="collapse" role="button"
                    aria-expanded="{{ $isAttActive ? 'true' : 'false' }}">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle fs-5"></i>
                        <span class="nav-label ms-3">Attendance</span>
                    </div>
                    <i class="bi bi-chevron-down dropdown-arrow" style="font-size: 0.8rem;"></i>
                </a>

                <div class="collapse {{ $isAttActive ? 'show' : '' }} ps-3 mb-1" id="attSubmenu">
                    <a href="{{ route('student.attendance.mark') }}"
                        class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.attendance.mark') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }} d-flex align-items-center">
                        <i class="bi bi-geo-alt"></i> <span class="nav-label ms-3">Mark Attendance</span>
                    </a>
                    <a href="{{ route('student.attendance.history') }}"
                        class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.attendance.history') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }} d-flex align-items-center">
                        <i class="bi bi-clock-history"></i> <span class="nav-label ms-3">History</span>
                    </a>
                    <a href="{{ route('student.attendance.leave') }}"
                        class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.attendance.leave') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }} d-flex align-items-center">
                        <i class="bi bi-calendar-x"></i> <span class="nav-label ms-3">Leave Requests</span>
                    </a>
                </div>

                <a class="nav-link {{ request()->routeIs('student.notifications') ? 'active' : '' }} d-flex align-items-center justify-content-between"
                    href="{{ route('student.notifications') }}">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-bell fs-5"></i>
                        <span class="nav-label ms-3">Notifications</span>
                    </div>
                    <span class="badge bg-danger rounded-pill nav-label">3</span>
                </a>

                <a class="nav-link {{ request()->routeIs('student.settings') ? 'active' : '' }} d-flex align-items-center"
                    href="{{ route('student.settings') }}">
                    <i class="bi bi-gear fs-5"></i>
                    <span class="nav-label ms-3">Settings</span>
                </a>
            </nav>
        </div>

        <div class="user-footer p-2 m-2">
            <div class="d-flex align-items-center gap-2 p-2 rounded bg-soft-light">
                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                    style="width: 32px; height: 32px; font-size: 0.8rem;">JD</div>
                <div class="user-info flex-grow-1" style="line-height: 1.2;">
                    <div class="fw-bold small">John Doe</div>
                    <div class="text-muted small" style="font-size: 0.7rem;">ID: STU001</div>
                </div>
            </div>
        </div>
</aside>
