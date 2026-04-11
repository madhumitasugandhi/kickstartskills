@extends('frontend.institutionPortal.layout.app')

@section('title', 'System Integrations')

@section('content')
<div class="container-fluid py-4">

    {{-- ================= PAGE HEADER ================= --}}
    <div class="ui-page-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="ui-icon-box">
                <i class="bi bi-plug"></i>
            </div>
            <div>
                <h5 class="mb-1">System Integrations</h5>
                <small class="ui-muted">
                    Manage and configure integrations with external systems and platforms
                </small>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-teal btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Add Integration
            </button>
            <button class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-gear"></i>
            </button>
        </div>
    </div>


    {{-- ================= FILTER CARD ================= --}}
    <div class="ui-card mb-4">
        <div class="mb-3">
            <div class="input-group-custom">
                <i class="bi bi-search"></i>
                <input type="text" class="form-control"
                       placeholder="Search integrations...">
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-4">
                <label class="ui-label">System Category</label>
                <select class="form-select">
                    <option>All Systems</option>
                    <option>Academic</option>
                    <option>Administrative</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="ui-label">Status</label>
                <select class="form-select">
                    <option>All Status</option>
                    <option>Connected</option>
                    <option>Error</option>
                    <option>Testing</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="ui-label">Integration Type</label>
                <select class="form-select">
                    <option>All Types</option>
                    <option>SIS</option>
                    <option>LMS</option>
                    <option>ERP</option>
                </select>
            </div>

            <div class="col-md-2">
                <button class="btn btn-teal w-100">
                    <i class="bi bi-arrow-repeat me-1"></i> Refresh
                </button>
            </div>
        </div>
    </div>


    {{-- ================= OVERVIEW ================= --}}
    <h6 class="mb-3">Integration Overview</h6>

    <div class="row g-3 mb-5">
        @php
            $stats = [
                ['label'=>'Total Systems','value'=>'7','icon'=>'layers'],
                ['label'=>'Connected','value'=>'4','icon'=>'check-circle'],
                ['label'=>'Errors','value'=>'1','icon'=>'exclamation-circle'],
                ['label'=>'Testing','value'=>'1','icon'=>'clock'],
                ['label'=>'Data Points','value'=>'66.6K','icon'=>'database'],
                ['label'=>'Avg Uptime','value'=>'99.3%','icon'=>'activity'],
                ['label'=>'Avg Latency','value'=>'206ms','icon'=>'lightning'],
                ['label'=>'Configured','value'=>'1','icon'=>'gear'],
            ];
        @endphp

        @foreach($stats as $stat)
        <div class="col-md-3">
            <div class="ui-stats-card">
                <div class="stats-icon">
                    <i class="bi bi-{{ $stat['icon'] }}"></i>
                </div>
                <div>
                    <h4>{{ $stat['value'] }}</h4>
                    <small>{{ $stat['label'] }}</small>
                </div>
            </div>
        </div>
        @endforeach
    </div>


    {{-- ================= QUICK SETUP ================= --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6>Quick Setup Templates</h6>
        <a href="#" class="ui-link">View All</a>
    </div>

    <div class="row g-3 mb-5">
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
            <div class="ui-card">
                <div class="ui-badge mb-2">{{ $tpl['level'] }}</div>
                <div class="ui-card-title">{{ $tpl['title'] }}</div>
                <div class="ui-card-subtitle mb-2">{{ $tpl['desc'] }}</div>

                <div class="ui-meta">
                    <span><i class="bi bi-clock me-1"></i>{{ $tpl['time'] }}</span>
                    <span>{{ $tpl['systems'] }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>


    {{-- ================= SYSTEM LIST ================= --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6>System Integrations (7)</h6>
        <a href="#" class="ui-link">
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

@endsection
