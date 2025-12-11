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
            @php $isProfileActive = request()->routeIs('student.profile.*'); @endphp

            <a class="nav-link {{ $isProfileActive ? 'text-primary' : '' }}" href="#profileSubmenu"
                data-bs-toggle="collapse" role="button" aria-expanded="{{ $isProfileActive ? 'true' : 'false' }}"
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


            <!-- Examinations Dropdown -->
            @php $isExamActive = request()->routeIs('student.exam.*'); @endphp

            <a class="nav-link {{ $isExamActive ? 'text-primary' : '' }}" href="#examSubmenu" data-bs-toggle="collapse"
                role="button" aria-expanded="{{ $isExamActive ? 'true' : 'false' }}" aria-controls="examSubmenu">
                <div class="d-flex justify-content-between w-100 align-items-center">
                    <span><i class="bi bi-file-earmark-text me-2"></i> Examinations</span>
                    <i class="bi bi-chevron-down" style="font-size: 0.8rem;"></i>
                </div>
            </a>

            <div class="collapse {{ $isExamActive ? 'show' : '' }} ps-3 mb-1" id="examSubmenu">
                <!-- Take Test -->
                <a href="{{ route('student.exam.take') }}"
                    class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.exam.take') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }}">
                    <i class="bi bi-pencil-square me-2"></i> Take Test
                </a>

                <!-- Test History -->
                <a href="{{ route('student.exam.history') }}"
                    class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.exam.history') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }}">
                    <i class="bi bi-clock-history me-2"></i> Test History
                </a>

                <!-- Results -->
                <a href="{{ route('student.exam.results') }}"
                    class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.exam.results') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }}">
                    <i class="bi bi-bar-chart me-2"></i> Results
                </a>

                <a href="{{ route('student.exam.practice') }}"
                    class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.exam.practice') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }}">
                    <i class="bi bi-lightning-charge me-2"></i> Practice Tests
                </a>
            </div>

            <!-- Learning Dropdown -->
            @php $isLearningActive = request()->routeIs('student.learning.*'); @endphp

            <a class="nav-link {{ $isLearningActive ? 'text-primary' : '' }}" href="#learningSubmenu"
                data-bs-toggle="collapse" role="button" aria-expanded="{{ $isLearningActive ? 'true' : 'false' }}"
                aria-controls="learningSubmenu">
                <div class="d-flex justify-content-between w-100 align-items-center">
                    <span><i class="bi bi-book me-2"></i> Learning</span>
                    <i class="bi bi-chevron-down" style="font-size: 0.8rem;"></i>
                </div>
            </a>

            <div class="collapse {{ $isLearningActive ? 'show' : '' }} ps-3 mb-1" id="learningSubmenu">
                <!-- My Courses -->
                <a href="{{ route('student.learning.my_courses') }}"
                    class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.learning.my_courses') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }}">
                    <i class="bi bi-play-circle me-2"></i> My Courses
                </a>

                <!-- Course Catalog -->
                <a href="{{ route('student.learning.catalog') }}"
                    class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.learning.catalog') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }}">
                    <i class="bi bi-search me-2"></i> Course Catalog
                </a>

                <!-- Resources -->
                <a href="{{ route('student.learning.resources') }}"
                    class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.learning.resources') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }}">
                    <i class="bi bi-folder2-open me-2"></i> Resources
                </a>

                <!-- Recommendations -->
                <a href="{{ route('student.learning.recommendations') }}"
                    class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.learning.recommendations') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }}">
                    <i class="bi bi-star me-2"></i> Recommendations
                </a>
            </div>

            <!-- Internship Dropdown -->
            @php $isInternActive = request()->routeIs('student.internship.*'); @endphp

            <a class="nav-link {{ $isInternActive ? 'text-primary' : '' }}" href="#internSubmenu"
                data-bs-toggle="collapse" role="button" aria-expanded="{{ $isInternActive ? 'true' : 'false' }}"
                aria-controls="internSubmenu">
                <div class="d-flex justify-content-between w-100 align-items-center">
                    <span><i class="bi bi-briefcase me-2"></i> Internship</span>
                    <i class="bi bi-chevron-down" style="font-size: 0.8rem;"></i>
                </div>
            </a>

            <div class="collapse {{ $isInternActive ? 'show' : '' }} ps-3 mb-1" id="internSubmenu">

                <!-- 1. Overview -->
                <a href="{{ route('student.internship.overview') }}"
                    class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.internship.overview') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }}">
                    <i class="bi bi-eye me-2"></i> Overview
                </a>

                <!-- 2. Tasks -->
                <a href="{{ route('student.internship.tasks') }}"
                    class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.internship.tasks') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }}">
                    <i class="bi bi-list-task me-2"></i> Tasks & Assignments
                </a>

                <!-- 3. Progress -->
                <a href="{{ route('student.internship.progress') }}"
                    class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.internship.progress') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }}">
                    <i class="bi bi-graph-up-arrow me-2"></i> Progress Tracking
                </a>

                <!-- 4. Phases -->
                <a href="{{ route('student.internship.phases') }}"
                    class="nav-link small py-2 mb-1 rounded-2 {{ request()->routeIs('student.internship.phases') ? 'bg-soft-blue text-primary fw-bold' : '--text-muted' }}">
                    <i class="bi bi-layers me-2"></i> Phase Details
                </a>
            </div>
            <a class="nav-link" href="#"><i class="bi bi-check-circle"></i> Attendance</a>
            <a class="nav-link" href="#"><i class="bi bi-chat-dots"></i> Communication</a>
             <a class="nav-link" href="#"><i class="bi bi-bar-chart"></i>Performance</a>
            <a class="nav-link" href="#"><i class="bi bi-trophy"></i> Achivements</a>
             <a class="nav-link" href="#"><i class="bi bi-bell"></i>Notifications</a>
            <a class="nav-link" href="#"><i class="bi bi-gear"></i>Setting</a>
        </nav>
    </div>

    <div class="user-footer">
        <div class="d-flex align-items-center gap-2 p-2 rounded">
            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold"
                style="width: 32px; height: 32px; font-size: 0.8rem;">JD</div>
            <div class="flex-grow-1" style="line-height: 1.2;">
                <div class="fw-bold small">John Doe</div>
                <div class="text-muted small" style="font-size: 0.7rem;">ID: STU001</div>
            </div>
        </div>
    </div>
</aside>
