@extends('frontend.institutionPortal.layout.app')

@section('page_title', 'Compliance Reports')
@section('title', 'Compliance Reports')

@section('content')
<style>
    /* ===============================
   COMPLIANCE STATUS BAR
=============================== */
.compliance-progress {
    display: flex;
    height: 10px;
    border-radius: 999px;
    overflow: hidden;
    background: var(--border-color);
}

.compliance-progress .bar {
    height: 100%;
}

.compliance-progress .bar.compliant { background: #10b981; }
.compliance-progress .bar.review { background: #f59e0b; }
.compliance-progress .bar.danger { background: #ef4444; }

/* Legends */
.legend {
    display: inline-block;
    width: 10px;
    height: 10px;
    border-radius: 3px;
    margin-right: 6px;
}
.legend.compliant { background: #10b981; }
.legend.review { background: #f59e0b; }
.legend.danger { background: #ef4444; }


</style>
<div class="container-fluid p-3 p-md-5 compliance-module">

    {{-- ================= HEADER ================= --}}
    <div class="d-flex justify-content-between align-items-start align-items-md-center flex-column flex-md-row gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Compliance Reports</h1>
            <p class="text-muted mb-0">
                Monitor regulatory compliance and institutional standards
            </p>
        </div>

        <button class="btn btn-teal"
                data-bs-toggle="modal"
                data-bs-target="#generateReportModal">
            <i class="bi bi-file-earmark-text me-2"></i> Generate Report
        </button>
    </div>

    {{-- ================= FILTER BAR ================= --}}
    <div class="glass-card p-4 mb-5">
        <div class="row g-3 align-items-end">

            <div class="col-12">
                <div class="input-group">
                    <i class="bi bi-search"></i>
                    <input type="text" class="form-control"
                           placeholder="Search compliance reports...">
                </div>
            </div>

            <div class="col-md-4">
                <label class="form-label small">Category</label>
                <select class="form-select">
                    <option>All Categories</option>
                    <option>Academic</option>
                    <option>Finance</option>
                    <option>Infrastructure</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label small">Status</label>
                <select class="form-select">
                    <option>All Status</option>
                    <option>Compliant</option>
                    <option>Under Review</option>
                    <option>Action Required</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label small">Priority</label>
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
            <div class="glass-card p-4">
                <div class="stat-icon {{ $stat['class'] }}">
                    <i class="bi {{ $stat['icon'] }}"></i>
                </div>
                <h4 class="fw-bold mt-3 mb-1">{{ $stat['value'] }}</h4>
                <small class="text-muted">{{ $stat['label'] }}</small>
                <i class="bi bi-graph-up-right text-teal position-absolute top-0 end-0 m-3"></i>
            </div>
        </div>
        @endforeach
    </div>

    {{-- ================= STATUS OVERVIEW ================= --}}
    <div class="glass-card p-4 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <strong>Compliance Status Distribution</strong>
            <span class="text-teal fw-semibold">4 / 8 Compliant</span>
        </div>

        <div class="compliance-progress mb-3">
            <div class="bar compliant" style="width:50%"></div>
            <div class="bar review" style="width:25%"></div>
            <div class="bar danger" style="width:25%"></div>
        </div>

        <div class="d-flex flex-wrap gap-3 small text-muted">
            <span><span class="legend compliant"></span> Compliant (4)</span>
            <span><span class="legend review"></span> Under Review (2)</span>
            <span><span class="legend danger"></span> Action Required (1)</span>
            <span><span class="legend danger"></span> Non-Compliant (1)</span>
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
    <div class="program-card p-4 mb-4">
        <div class="d-flex justify-content-between align-items-start mb-2">
            <div>
                <h6 class="fw-bold mb-1">Annual Accreditation Review</h6>
                <small class="text-teal">Higher Learning Commission (HLC)</small>
            </div>

            <div class="d-flex gap-2">
                <span class="announcement-status priority-high">High</span>
                <span class="announcement-status status-published">Compliant</span>
                <button class="btn btn-link p-0">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
            </div>
        </div>

        <p class="text-muted mb-3">
            Comprehensive institutional accreditation review covering academic programs,
            faculty qualifications, and institutional effectiveness.
        </p>

        <div class="mb-3">
            <div class="d-flex justify-content-between small mb-1">
                <span>Compliance Score</span>
                <span class="fw-semibold text-teal">92.5%</span>
            </div>
            <div class="progress progress-thin">
                <div class="progress-bar bg-success" style="width:92.5%"></div>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="announcement-tag">Category: Accreditation</span>
            <span class="announcement-tag">Assigned: Academic Affairs Office</span>
            <span class="announcement-tag">Documents: 3</span>
            <span class="announcement-tag">Due: 31/12/2024</span>
        </div>

        <div class="d-flex justify-content-between small text-muted">
            <span><i class="bi bi-clock me-1"></i> Last Review: 15/5/2024</span>
            <span><i class="bi bi-calendar-event me-1"></i> Next Review: 15/5/2025</span>
            <span><i class="bi bi-clipboard-check me-1"></i> 2 findings</span>
        </div>
    </div>

</div>

@include('frontend.institutionPortal.dashboard.compliance-reports.modals.generate')
@endsection
