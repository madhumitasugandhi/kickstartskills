@extends('frontend.institutionPortal.layout.app')

@section('page_title', 'Enrollment Management')
@section('title', 'Enrollment Management')

@section('content')
<style>
 
/* ===============================
   ENROLLMENT CARD – FINAL ALIGN
================================ */

.enrollment-meta {
    display: grid;
    grid-template-columns: repeat(6, minmax(140px, 1fr));
    gap: 18px;
    margin-top: 6px;
}

.meta-item {
    display: flex;
    gap: 8px;
    font-size: 0.75rem;
}

.meta-item i {
    color: var(--text-muted);
    margin-top: 2px;
}

.meta-item small {
    color: var(--text-muted);
    display: block;
}

.meta-item strong {
    font-weight: 600;
    font-size: 0.8rem;
}

/* Mobile */
@media (max-width: 992px) {
    .enrollment-meta {
        grid-template-columns: repeat(2, 1fr);
        row-gap: 12px;
    }
}

/* ===============================
   ENROLLMENT – RESPONSIVE SYSTEM
================================ */

/* DEFAULT (DESKTOP) */
.enrollment-meta {
    display: grid;
    grid-template-columns: repeat(6, minmax(140px, 1fr));
    gap: 18px;
    margin-top: 10px;
}

.meta-item {
    display: flex;
    gap: 8px;
    font-size: 0.75rem;
}

.meta-item i {
    color: var(--text-muted);
    margin-top: 2px;
}

.meta-item small {
    color: var(--text-muted);
    display: block;
}

.meta-item strong {
    font-weight: 600;
    font-size: 0.8rem;
}

/* ===============================
   LAPTOP (≤1199px)
================================ */
@media (max-width: 1199px) {
    .enrollment-meta {
        grid-template-columns: repeat(3, 1fr);
        row-gap: 14px;
    }
}

/* ===============================
   TABLET (≤992px)
================================ */
@media (max-width: 992px) {

    /* Header wraps */
    .glass-card > .d-flex:first-child {
        /* flex-direction: column; */
        gap: 12px;
    }

    /* Status row moves below name */
    .glass-card > .d-flex:first-child > .d-flex:last-child {
        align-self: flex-start;
    }

    .enrollment-meta {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* ===============================
   MOBILE (≤768px)
================================ */
@media (max-width: 768px) {

    .company-avatar {
        width: 42px;
        height: 42px;
        font-size: 0.9rem;
    }

    .glass-card {
        padding: 16px;
    }

    /* Stack avatar + text */
    .glass-card > .d-flex:first-child > .d-flex:first-child {
        align-items: flex-start;
    }

    .enrollment-meta {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    /* Status pills wrap nicely */
    .glass-card .status-pill {
        font-size: 0.7rem;
        padding: 4px 10px;
    }
}

/* ===============================
   EXTRA SMALL (≤480px)
================================ */
@media (max-width: 480px) {

    /* Full stack layout */
    .glass-card > .d-flex:first-child {
        flex-direction: column;
        gap: 10px;
    }

    .glass-card > .d-flex:first-child > .d-flex:first-child {
        flex-direction: column;
        gap: 6px;
    }

    /* Status + kebab row */
    .glass-card > .d-flex:first-child > .d-flex:last-child {
        width: 100%;
        justify-content: space-between;
    }

    .enrollment-meta {
        grid-template-columns: 1fr;
    }

    .meta-item {
        font-size: 0.78rem;
    }
}

</style>
<div class="container-fluid p-4">

    {{-- ================= HEADER ================= --}}
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h5 class="fw-semibold mb-1">Enrollment Management</h5>
            <p class="small mb-0">
                Review and manage student enrollment applications
            </p>
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
                <div class="glass-card d-flex align-items-center gap-3">
                    <div class="stat-icon {{ $stat['class'] }}">
                        <i class="bi {{ $stat['icon'] }}"></i>
                    </div>
                    <div>
                        <small class="">{{ $stat['label'] }}</small>
                        <h6 class="fw-semibold mb-0">{{ $stat['value'] }}</h6>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    {{-- ================= FILTERS ================= --}}
    <div class="glass-card mb-4">

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

    {{-- ================= APPLICATION LIST ================= --}}
    <div class="drive-list">

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
        <div class="glass-card position-relative">

{{-- ================= HEADER ROW ================= --}}
<div class="d-flex align-items-start justify-content-between mb-3">

    {{-- LEFT --}}
    <div class="d-flex align-items-center gap-3">
        <div class="company-avatar">
            {{ strtoupper(substr($app['name'],0,1)) }}
        </div>

        <div>
            <h6 class="mb-0 fw-semibold">{{ $app['name'] }}</h6>
            <small class="d-block">{{ $app['email'] }}</small>
            <div class="small">{{ $app['program'] }}</div>
        </div>
    </div>

    {{-- RIGHT (STATUS + KEBAB) --}}
    <div class="d-flex align-items-center gap-2">

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

</div>

{{-- ================= META ROW ================= --}}
<div class="enrollment-meta">

    <div class="meta-item">
        <i class="bi bi-calendar"></i>
        <div>
            <small>Applied</small>
            <strong>{{ $app['applied'] }}</strong>
        </div>
    </div>

    <div class="meta-item">
        <i class="bi bi-briefcase"></i>
        <div>
            <small>Experience</small>
            <strong>{{ $app['exp'] }}</strong>
        </div>
    </div>

    <div class="meta-item">
        <i class="bi bi-mortarboard"></i>
        <div>
            <small>Education</small>
            <strong>{{ $app['edu'] }}</strong>
        </div>
    </div>

    <div class="meta-item">
        <i class="bi bi-file-earmark"></i>
        <div>
            <small>Documents</small>
            <strong>{{ $app['docs'] }}</strong>
        </div>
    </div>

    <div class="meta-item">
        <i class="bi bi-globe"></i>
        <div>
            <small>Source</small>
            <strong>{{ $app['source'] }}</strong>
        </div>
    </div>

    <div class="meta-item">
        <i class="bi bi-heart"></i>
        <div>
            <small>Motivation</small>
            <strong>{{ $app['score'] }}</strong>
        </div>
    </div>

</div>

{{-- ================= NOTE ================= --}}
<small class="d-block mt-2">
    {{ $app['note'] }}
</small>

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
