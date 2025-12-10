 <!-- 1. SIDEBAR -->
    <aside class="sidebar d-flex flex-column no-scrollbar" id="sidebar">
        <div class="sidebar-brand">
            <i class="bi bi-journal-text me-2 fs-5"></i> <span>Student Portal</span>
        </div>

        <div class="p-3 flex-grow-1">
            <nav class="nav flex-column">
                <!-- Dashboard Link -->
                <a class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}"
                   href="{{ route('student.dashboard') }}">
                    <i class="bi bi-grid"></i> Dashboard
                </a>

                <!-- Profile Dropdown Trigger -->
                <!-- Checks if ANY profile route is active to keep parent menu highlighted/open -->
                @php $isProfileActive = request()->routeIs('student.profile.*'); @endphp

                <a class="nav-link {{ $isProfileActive ? 'text-primary' : '' }}"
                   href="#profileSubmenu"
                   data-bs-toggle="collapse"
                   role="button"
                   aria-expanded="{{ $isProfileActive ? 'true' : 'false' }}"
                   aria-controls="profileSubmenu">
                    <div class="d-flex justify-content-between w-100 align-items-center">
                        <span><i class="bi bi-person"></i> Profile</span>
                        <i class="bi bi-chevron-down" style="font-size: 0.8rem;"></i>
                    </div>
                </a>

                <!-- Profile Dropdown Content -->
                <div class="collapse {{ $isProfileActive ? 'show' : '' }} ps-3 mb-1" id="profileSubmenu">
                    <!-- Personal Info -->
                    <a href="{{ route('student.profile.personal') }}"
                       class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.profile.personal') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }}">
                        <i class="bi bi-pencil-square me-2"></i> Personal Info
                    </a>

                    <!-- Academic Details -->
                    <a href="{{ route('student.profile.academic') }}"
                       class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.profile.academic') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }}">
                        <i class="bi bi-mortarboard me-2"></i> Academic Details
                    </a>

                    <!-- Portfolio -->
                    <a href="{{ route('student.profile.portfolio') }}"
                       class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.profile.portfolio') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }}">
                        <i class="bi bi-briefcase me-2"></i> Portfolio
                    </a>
                </div>

                <!-- Other Links -->
                <a class="nav-link" href="#"><i class="bi bi-file-earmark-text"></i> Examinations</a>
                <a class="nav-link" href="#"><i class="bi bi-book"></i> Learning</a>
                <a class="nav-link" href="#"><i class="bi bi-briefcase"></i> Internship</a>
                <a class="nav-link" href="#"><i class="bi bi-check-circle"></i> Attendance</a>
                <a class="nav-link" href="#"><i class="bi bi-chat-dots"></i> Communication</a>
            </nav>
        </div>

        <div class="user-footer">
            <div class="d-flex align-items-center gap-2 p-2 rounded">
                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px; font-size: 0.8rem;">JD</div>
                <div class="flex-grow-1" style="line-height: 1.2;">
                    <div class="fw-bold small">John Doe</div>
                    <div class="text-muted small" style="font-size: 0.7rem;">ID: STU001</div>
                </div>
            </div>
        </div>
    </aside>
