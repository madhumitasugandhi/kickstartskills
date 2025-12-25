@extends('frontend.institutionPortal.layout.app')

@section('title', 'System Integrations')
@section('content')
<div class="container-fluid py-4 system-integrations">

    <!-- ================= HEADER ================= -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-semibold mb-1">System Integrations</h4>
            <p class=" mb-0">
                Manage and configure integrations with external systems and platforms
            </p>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-success">
                <i class="bi bi-plus-lg me-1"></i> Add Integration
            </button>
            <button class="btn btn-outline-secondary">
                <i class="bi bi-gear"></i>
            </button>
        </div>
    </div>

    <!-- ================= FILTER CARD ================= -->
    <div class="card glass-card mb-4">
        <div class="card-body">
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-0 ">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control bg-transparent border-0"
                           placeholder="Search integrations...">
                </div>
            </div>

            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label small ">System Category</label>
                    <select class="form-select dark-select">
                        <option>All Systems</option>
                        <option>Academic</option>
                        <option>Administrative</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label small ">Status</label>
                    <select class="form-select dark-select">
                        <option>All Status</option>
                        <option>Connected</option>
                        <option>Error</option>
                        <option>Testing</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label small ">Integration Type</label>
                    <select class="form-select dark-select">
                        <option>All Types</option>
                        <option>SIS</option>
                        <option>LMS</option>
                        <option>ERP</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-success w-100">
                        <i class="bi bi-arrow-repeat me-1"></i> Refresh
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= OVERVIEW CARDS ================= -->
    <h6 class="fw-semibold mb-3">Integration Overview</h6>

    <div class="row g-4 mb-5">
        @php
            $stats = [
                ['label'=>'Total Systems','value'=>'7','icon'=>'layers','color'=>'primary'],
                ['label'=>'Connected','value'=>'4','icon'=>'check-circle','color'=>'success'],
                ['label'=>'Errors','value'=>'1','icon'=>'exclamation-circle','color'=>'danger'],
                ['label'=>'Testing','value'=>'1','icon'=>'clock','color'=>'warning'],
                ['label'=>'Data Points','value'=>'66.6K','icon'=>'database','color'=>'success'],
                ['label'=>'Avg Uptime','value'=>'99.3%','icon'=>'activity','color'=>'success'],
                ['label'=>'Avg Latency','value'=>'206ms','icon'=>'lightning','color'=>'warning'],
                ['label'=>'Configured','value'=>'1','icon'=>'gear','color'=>'primary'],
            ];
        @endphp

        @foreach($stats as $stat)
        <div class="col-md-3 col-sm-6">
            <div class="stat-card glass-card">
                <div class="d-flex justify-content-between">
                    <i class="bi bi-{{ $stat['icon'] }} text-{{ $stat['color'] }}"></i>
                    <span class="dot bg-{{ $stat['color'] }}"></span>
                </div>
                <h4 class="mt-3 text-{{ $stat['color'] }}">{{ $stat['value'] }}</h4>
                <p class=" small mb-0">{{ $stat['label'] }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <!-- ================= QUICK SETUP ================= -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-semibold">Quick Setup Templates</h6>
        <a href="#" class="text-info text-decoration-none">View All</a>
    </div>

    <div class="row g-4 mb-5">
        @php
            $templates = [
                ['title'=>'Academic Suite','desc'=>'SIS + LMS + Library','time'=>'2-3 days','systems'=>'3 systems','level'=>'Medium'],
                ['title'=>'Administrative Package','desc'=>'ERP + CRM + SSO','time'=>'3-5 days','systems'=>'3 systems','level'=>'High'],
                ['title'=>'Communication Hub','desc'=>'Email + SMS + Notifications','time'=>'1-2 days','systems'=>'3 systems','level'=>'Low'],
                ['title'=>'Analytics & Reporting','desc'=>'Comprehensive analytics integration','time'=>'4-6 days','systems'=>'3 systems','level'=>'High'],
            ];
        @endphp

        @foreach($templates as $tpl)
        <div class="col-md-3">
            <div class="template-card">
                <span class="badge level-{{ strtolower($tpl['level']) }}">{{ $tpl['level'] }}</span>
                <h6 class="mt-4">{{ $tpl['title'] }}</h6>
                <p class=" small">{{ $tpl['desc'] }}</p>
                <div class="d-flex justify-content-between  small">
                    <span><i class="bi bi-clock me-1"></i>{{ $tpl['time'] }}</span>
                    <span class="text-success">{{ $tpl['systems'] }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- ================= SYSTEM LIST ================= -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-semibold">System Integrations (7)</h6>
        <a href="#" class="text-info text-decoration-none">
            <i class="bi bi-download me-1"></i> Export Report
        </a>
    </div>

    <!-- SIS CARD -->
    @include('frontend.institutionPortal.dashboard.core-management.system.partials.integration-card', [
        'title' => 'Student Information System (SIS)',
        'desc'  => 'Core system for student data, enrollment, grades, and academic records management',
        'provider' => 'PowerSchool',
        'version' => '12.4.2',
        'type' => 'SIS',
        'category' => 'Academic',
        'sync' => 'Real-time',
        'points' => '15847',
        'uptime' => '99.8%',
        'latency' => '120ms',
        'error' => '0.02%',
        'features' => ['Student Records','Enrollment','Grades','Attendance','Transcripts']
    ])

    <!-- LMS CARD -->
    @include('frontend.institutionPortal.dashboard.core-management.system.partials.integration-card', [
        'title' => 'Learning Management System (LMS)',
        'desc'  => 'Platform for course delivery, content management, and online learning',
        'provider' => 'Canvas',
        'version' => '2024.05.18',
        'type' => 'LMS',
        'category' => 'Academic',
        'sync' => 'Every 15 minutes',
        'points' => '23456',
        'uptime' => '99.9%',
        'latency' => '98ms',
        'error' => '0.01%',
        'features' => ['Courses','Assignments','Discussions','Gradebook','Analytics']
    ])

</div>
<style>
    /* ==========================================
   INTEGRATION OVERVIEW – CARD STYLE (IMAGE 1)
========================================== */

.stat-card {
    height: 100%;
    padding: 22px;
    border-radius: 18px;
    background: linear-gradient(
        180deg,
        rgba(255,255,255,0.04),
        rgba(255,255,255,0.02)
    );
    border: 1px solid var(--glass-border);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-sm);
}

/* Icon square */
.stat-card i {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    background: rgba(255,255,255,0.06);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
}

/* Value */
.stat-card h4 {
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 4px;
}

/* Label */
.stat-card p {
    color: var(--text-muted);
    font-size: 0.8rem;
}

/* Status dot */
.stat-card .dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
}

/* ================= LIGHT MODE ================= */

body.light-mode .stat-card {
    background: #ffffff;
    border-color: var(--border-color);
}

body.light-mode .stat-card i {
    background: #f3f4f6;
}
</style>
@endsection
