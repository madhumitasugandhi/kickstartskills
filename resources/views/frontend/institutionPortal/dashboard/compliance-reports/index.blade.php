@extends('frontend.institutionPortal.layout.app')

@section('page_title', 'Compliance Reports')
@section('title', 'Compliance Reports')

@section('content')

<div class="container-fluid p-3 p-md-5 compliance-module">

    {{-- ================= HEADER ================= --}}
    <div class="ui-page-header d-flex justify-content-between align-items-center">
    <div class="d-flex gap-3 align-items-center">
        <div class="ui-icon-box">
            <i class="bi bi-shield-check"></i>
        </div>
        <div>
            <h5 class="mb-0">Compliance Reports</h5>
            <small class="ui-muted">
                Monitor regulatory compliance and institutional standards
            </small>
        </div>
    </div>

    <button class="btn btn-teal"
            data-bs-toggle="modal"
            data-bs-target="#generateReportModal">
        <i class="bi bi-file-earmark-text me-2"></i> Generate Report
    </button>
</div>

    {{-- ================= FILTER BAR ================= --}}
    <div class="ui-card mb-5">
                <div class="row g-3 align-items-end">

            <div class="col-12">
                <div class="input-group-custom">
                    <i class="bi bi-search"></i>
                    <input type="text" class="form-control"
                           placeholder="Search compliance reports...">
                </div>
            </div>

            <div class="col-md-4">
                <label class="ui-label">Category</label>
                <select class="form-select">
                    <option>All Categories</option>
                    <option>Academic</option>
                    <option>Finance</option>
                    <option>Infrastructure</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="ui-label">Status</label>
                <select class="form-select">
                    <option>All Status</option>
                    <option>Compliant</option>
                    <option>Under Review</option>
                    <option>Action Required</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="ui-label">Priority</label>
                <select class="form-select">
                    <option>All Priorities</option>
                    <option>High</option>
                    <option>Medium</option>
                    <option>Low</option>
                </select>
            </div>

            <div class="col-md-1">
                <button class="btn btn-outline-teal w-100">
                    <i class="bi bi-arrow-repeat"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- ================= OVERVIEW STATS ================= --}}
    <h6 class="fw-semibold mb-3">Compliance Overview</h6>

    <div class="row g-3 mb-5">
        @php
            $stats = [
                ['label'=>'Total Reports','value'=>8,'icon'=>'bi-shield-check','class'=>'info'],
                ['label'=>'Compliant','value'=>4,'icon'=>'bi-check-circle','class'=>'success'],
                ['label'=>'Under Review','value'=>2,'icon'=>'bi-clock','class'=>'warning'],
                ['label'=>'Action Required','value'=>1,'icon'=>'bi-exclamation-triangle','class'=>'danger'],
                ['label'=>'Non-Compliant','value'=>1,'icon'=>'bi-x-circle','class'=>'danger'],
                ['label'=>'High Priority','value'=>5,'icon'=>'bi-flag','class'=>'warning'],
                ['label'=>'Average Score','value'=>'86.3%','icon'=>'bi-graph-up','class'=>'success'],
                ['label'=>'Due Soon','value'=>0,'icon'=>'bi-calendar-event','class'=>'info'],
            ];
        @endphp

@foreach($stats as $stat)
<div class="col-12 col-md-6 col-xl-3">
    <div class="ui-stats-card">
        <div class="stats-icon {{ $stat['class'] }}">
            <i class="bi {{ $stat['icon'] }}"></i>
        </div>
        <div>
            <h4>{{ $stat['value'] }}</h4>
            <small class="ui-muted">{{ $stat['label'] }}</small>
        </div>
    </div>
</div>
@endforeach
</div>

    {{-- ================= STATUS OVERVIEW ================= --}}
    <div class="ui-card mb-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="ui-card-title">Compliance Status Distribution</div>
        <span class="text-teal fw-semibold">4 / 8 Compliant</span>
    </div>

    <div class="ui-compliance-progress mb-3">
        <div class="bar compliant" style="width:50%"></div>
        <div class="bar review" style="width:25%"></div>
        <div class="bar danger" style="width:25%"></div>
    </div>

    <div class="d-flex flex-wrap gap-3 small ui-muted">
        <span><span class="ui-legend compliant"></span> Compliant (4)</span>
        <span><span class="ui-legend review"></span> Under Review (2)</span>
        <span><span class="ui-legend danger"></span> Action Required (1)</span>
        <span><span class="ui-legend danger"></span> Non-Compliant (1)</span>
    </div>

    <div class="alert alert-success mt-4 mb-0">
        <i class="bi bi-check-circle me-2"></i>
        No upcoming deadlines in the next 30 days
    </div>

</div>

    {{-- ================= REPORT LIST ================= --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-semibold mb-0">Compliance Reports (8)</h6>
        <a href="#" class="text-info small">
            <i class="bi bi-download me-1"></i> Export Data
        </a>
    </div>

    {{-- REPORT CARD --}}
    <div class="ui-card">

    <div class="ui-card-header">
        <div>
            <div class="ui-card-title">Annual Accreditation Review</div>
            <div class="ui-card-subtitle text-teal">
                Higher Learning Commission (HLC)
            </div>
        </div>

        <div class="d-flex gap-2">
            <span class="ui-announcement-status high">High</span>
            <span class="ui-announcement-status published">Compliant</span>
            <button class="btn btn-link p-0">
                <i class="bi bi-three-dots-vertical"></i>
            </button>
        </div>
    </div>

    <div class="ui-card-subtitle mb-3">
        Comprehensive institutional accreditation review covering academic programs,
        faculty qualifications, and institutional effectiveness.
    </div>

    <div class="mb-3">
        <div class="d-flex justify-content-between small mb-1">
            <span>Compliance Score</span>
            <span class="fw-semibold text-teal">92.5%</span>
        </div>
        <div class="ui-progress">
            <div class="ui-progress-fill success" style="width:92.5%"></div>
        </div>
    </div>

    <div class="ui-chips mb-2">
        <div class="ui-chip">Category: Accreditation</div>
        <div class="ui-chip">Assigned: Academic Affairs Office</div>
        <div class="ui-chip">Documents: 3</div>
        <div class="ui-chip">Due: 31/12/2024</div>
    </div>

    <div class="ui-meta">
        <span><i class="bi bi-clock me-1"></i> Last Review: 15/5/2024</span>
        <span><i class="bi bi-calendar-event me-1"></i> Next Review: 15/5/2025</span>
        <span><i class="bi bi-clipboard-check me-1"></i> 2 findings</span>
    </div>

</div>

</div>

@include('frontend.institutionPortal.dashboard.compliance-reports.modals.generate')
@endsection
