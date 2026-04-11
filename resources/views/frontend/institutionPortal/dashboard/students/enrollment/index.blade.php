@extends('frontend.institutionPortal.layout.app')

@section('page_title', 'Enrollment Management')
@section('title', 'Enrollment Management')

@section('content')

<div class="content-area">

    {{-- ================= PAGE HEADER ================= --}}
    <div class="ui-page-header d-flex justify-content-between align-items-start">
        <div>
            <h5 class="fw-semibold mb-1">Enrollment Management</h5>
            <small class="ui-muted">
                Review and manage student enrollment applications
            </small>
        </div>

        <button class="btn btn-teal btn-sm">
            <i class="bi bi-lightning me-1"></i> Bulk Actions
        </button>
    </div>


    {{-- ================= STATS ================= --}}
    <div class="row g-3 mb-4">

        @php
            $stats = [
                ['label'=>'Total Applications', 'value'=>6, 'icon'=>'bi-file-earmark-text', 'class'=>'info'],
                ['label'=>'Pending Review', 'value'=>1, 'icon'=>'bi-clock', 'class'=>'warning'],
                ['label'=>'Accepted', 'value'=>1, 'icon'=>'bi-check-circle', 'class'=>'success'],
                ['label'=>'Interviews Scheduled', 'value'=>3, 'icon'=>'bi-calendar-event', 'class'=>'info'],
                ['label'=>'Acceptance Rate', 'value'=>'16.7%', 'icon'=>'bi-graph-up', 'class'=>'success'],
            ];
        @endphp

        @foreach($stats as $stat)
            <div class="col-md-6 col-lg-4">
                <div class="ui-stats-card">
                    <div class="stats-icon {{ $stat['class'] }}">
                        <i class="bi {{ $stat['icon'] }}"></i>
                    </div>
                    <div>
                        <small class="ui-muted">{{ $stat['label'] }}</small>
                        <h6 class="fw-semibold mb-0">{{ $stat['value'] }}</h6>
                    </div>
                </div>
            </div>
        @endforeach

    </div>


    {{-- ================= FILTERS ================= --}}
    <div class="ui-card mb-4">

        <div class="ui-card-header">
            <div class="ui-card-title">Search & Filters</div>
            <div class="ui-card-subtitle">Filter applications by status, program, or source</div>
        </div>

        <div class="ui-section">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="input-group-custom flex-grow-1 me-3">
                    <i class="bi bi-search"></i>
                    <input class="form-control" placeholder="Search applications...">
                </div>

                <button class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-down-up"></i>
                    Sort by Date Applied
                </button>
            </div>

            <div class="row g-3">
                <div class="col-md-4">
                    <select class="form-select">
                        <option>All Status</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select">
                        <option>All Programs</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select">
                        <option>All Sources</option>
                    </select>
                </div>
            </div>

        </div>

    </div>


    {{-- ================= APPLICATION LIST ================= --}}
    <div class="ui-list">

        @php
            $apps = [
                [
                    'name'=>'John Anderson','email'=>'john.anderson@email.com',
                    'program'=>'Full Stack Web Development',
                    'exp'=>'2 years','edu'=>'Bachelor of Science',
                    'docs'=>'3 files','source'=>'Website',
                    'score'=>'8.5/10','status'=>'Pending Review','priority'=>'High',
                    'note'=>'Strong technical background, eager learner',
                    'applied'=>'15/8/2024'
                ],
                [
                    'name'=>'Lisa Thompson','email'=>'lisa.thompson@email.com',
                    'program'=>'Cybersecurity Fundamentals',
                    'exp'=>'4 years','edu'=>'Bachelor of Computer Science',
                    'docs'=>'3 files','source'=>'Job Fair',
                    'score'=>'9/10','status'=>'Under Review','priority'=>'High',
                    'note'=>'Strong security background, highly motivated',
                    'applied'=>'14/8/2024'
                ],
                [
                    'name'=>'Sarah Mitchell','email'=>'sarah.mitchell@email.com',
                    'program'=>'Data Science Bootcamp',
                    'exp'=>'3 years','edu'=>'Master of Mathematics',
                    'docs'=>'3 files','source'=>'Referral',
                    'score'=>'8.1/10','status'=>'Interview Scheduled','priority'=>'High',
                    'note'=>'Excellent mathematical background',
                    'applied'=>'12/8/2024'
                ],
            ];
        @endphp

        @foreach($apps as $app)
        <div class="ui-list-item enrollment-card">

    <!-- LEFT: Avatar + Name -->
    <div class="enroll-left">
        <div class="ui-avatar">
            {{ strtoupper(substr($app['name'],0,1)) }}
        </div>

        <div>
            <h6 class="mb-0 fw-semibold">{{ $app['name'] }}</h6>
            <small class="ui-muted d-block">{{ $app['email'] }}</small>
            <div class="small">{{ $app['program'] }}</div>
        </div>
    </div>

    <!-- STATUS -->
    <div class="enroll-status">
        <span class="status-pill warning">{{ $app['priority'] }}</span>
        <span class="status-pill info">{{ $app['status'] }}</span>

        <div class="student-actions">
            <button class="icon-btn kebab-toggle">
                <i class="bi bi-three-dots-vertical"></i>
            </button>

            <ul class="kebab-menu">
                <li>View Application</li>
                <li>Schedule Interview</li>
                <li class="danger">Reject</li>
            </ul>
        </div>
    </div>

    <!-- META GRID -->
    <div class="enroll-meta">
        <div><small>Applied</small><strong>{{ $app['applied'] }}</strong></div>
        <div><small>Experience</small><strong>{{ $app['exp'] }}</strong></div>
        <div><small>Education</small><strong>{{ $app['edu'] }}</strong></div>
        <div><small>Documents</small><strong>{{ $app['docs'] }}</strong></div>
        <div><small>Source</small><strong>{{ $app['source'] }}</strong></div>
        <div><small>Score</small><strong>{{ $app['score'] }}</strong></div>
    </div>

    <!-- NOTE -->
    <div class="enroll-note">
        {{ $app['note'] }}
    </div>

</div>
        @endforeach

    </div>

</div>


<script>
document.addEventListener('click', function (e) {

    document.querySelectorAll('.kebab-menu').forEach(menu => {
        if (!menu.contains(e.target) &&
            !menu.previousElementSibling.contains(e.target)) {
            menu.classList.remove('show');
        }
    });

    if (e.target.closest('.kebab-toggle')) {
        const menu = e.target.closest('.student-actions').querySelector('.kebab-menu');
        menu.classList.toggle('show');
    }
});
</script>

@endsection