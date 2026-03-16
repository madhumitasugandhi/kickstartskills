@extends('frontend.institutionPortal.layout.app')

@section('page_title', 'Institutional Reports')
@section('title', 'Institutional Reports')

@section('content')
<style>
    .report-item {
    display: flex;
    justify-content: space-between;
    align-items: start;
    padding: 18px;
    border-radius: 14px;
    background: rgba(255,255,255,0.03);
    margin-bottom: 14px;
}

.progress-thin {
    height: 6px;
    border-radius: 10px;
    background: rgba(255,255,255,0.1);
}

.badge-soft {
    background: rgba(16,185,129,0.12);
    color: #10b981;
    font-size: 11px;
}
/* ===============================
   REPORTS MODULE (MATCH UI)
================================ */

.report-card {
    background: linear-gradient(
        180deg,
        rgba(255,255,255,0.04),
        rgba(255,255,255,0.02)
    );
    border: 1px solid var(--glass-border);
    border-radius: 18px;
    padding: 22px;
    margin-bottom: 16px;
}

.report-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin: 10px 0;
}

.report-tag {
    font-size: 11px;
    padding: 4px 10px;
    border-radius: 999px;
    background: rgba(16,185,129,0.12);
    color: #10b981;
}

.report-status {
    font-size: 12px;
    padding: 6px 12px;
    border-radius: 999px;
    font-weight: 500;
}

.report-status.available {
    background: rgba(16,185,129,0.15);
    color: #10b981;
}

.report-status.generating {
    background: rgba(245,158,11,0.15);
    color: #f59e0b;
}

.report-progress {
    height: 6px;
    border-radius: 999px;
    background: rgba(255,255,255,0.1);
    overflow: hidden;
    margin: 8px 0;
}

.report-progress > div {
    height: 100%;
    background: linear-gradient(90deg, #f59e0b, #fbbf24);
}


</style>
<div class="container-fluid p-4 p-md-5">

    {{-- ================= HEADER ================= --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="fw-semibold mb-1">Institutional Reports</h4>
            <p class=" small mb-0">
                Generate, manage, and download institutional reports and analytics
            </p>
        </div>

        <button class="btn btn-success btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Create Report
        </button>
    </div>

    {{-- ================= FILTER BAR ================= --}}
    <div class="glass-card p-4 mb-4">

    <div class="input-group-custom mb-3">
        <i class="bi bi-search"></i>
        <input type="text"
               class="form-control"
               placeholder="Search reports...">
    </div>

    <div class="row g-3 align-items-end">
        <div class="col-md-4">
            <label class="form-label small ">Category</label>
            <select class="form-select">
                <option>All Categories</option>
                <option>Academic</option>
                <option>Faculty</option>
                <option>Financial</option>
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label small ">Status</label>
            <select class="form-select">
                <option>All Status</option>
                <option>Available</option>
                <option>Generating</option>
                <option>Error</option>
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label small ">Format</label>
            <select class="form-select">
                <option>PDF</option>
                <option>Excel</option>
                <option>CSV</option>
            </select>
        </div>

        <div class="col-md-1">
            <button class="btn btn-teal w-100">
                <i class="bi bi-arrow-repeat"></i>
            </button>
        </div>
    </div>

</div>

    {{-- ================= STATS ================= --}}
    <div class="row g-3 mb-4">
        @php
            $stats = [
                ['label'=>'Total Reports','value'=>8,'icon'=>'bi-file-earmark-text','color'=>'primary'],
                ['label'=>'Available','value'=>6,'icon'=>'bi-check-circle','color'=>'success'],
                ['label'=>'Generating','value'=>1,'icon'=>'bi-hourglass-split','color'=>'warning'],
                ['label'=>'Errors','value'=>1,'icon'=>'bi-x-circle','color'=>'danger'],
                ['label'=>'Scheduled','value'=>6,'icon'=>'bi-calendar','color'=>'info'],
                ['label'=>'Downloads','value'=>892,'icon'=>'bi-download','color'=>'success'],
                ['label'=>'Total Size','value'=>'23.9 MB','icon'=>'bi-hdd','color'=>'warning'],
                ['label'=>'Categories','value'=>7,'icon'=>'bi-grid','color'=>'primary'],
            ];
        @endphp

        @foreach($stats as $stat)
        <div class="col-md-3">
        <div class="glass-card p-4 position-relative">
    <div class="stat-icon mb-3">
        <i class="bi {{ $stat['icon'] }}"></i>
    </div>

    <h4 class="fw-bold mb-1">{{ $stat['value'] }}</h4>
    <small class="">{{ $stat['label'] }}</small>

    <i class="bi bi-graph-up-right position-absolute top-0 end-0 m-3 text-teal"></i>
</div>

        </div>
        @endforeach
    </div>

    {{-- ================= REPORT LIST ================= --}}
    <div class="report-card d-flex justify-content-between gap-4">
    <div>
        <h6 class="fw-semibold mb-1">Student Performance Report</h6>
        <p class=" small mb-2">
            Comprehensive analysis of student academic performance, grades, and progress tracking
        </p>

        <div class="report-meta">
            <span class="report-tag">Academic</span>
            <span class="report-tag">Performance</span>
            <span class="report-tag">Monthly</span>
            <span class="report-tag">PDF</span>
        </div>

        <small class="">
            <i class="bi bi-building"></i> Academic Office &nbsp; • &nbsp;
            <i class="bi bi-clock"></i> 28/06/2024 &nbsp; • &nbsp;
            <i class="bi bi-download"></i> 156 downloads
        </small>
    </div>

    <div class="text-end">
        <span class="report-status available">Available</span>
        <button class="btn btn-link ms-2">
            <i class="bi bi-three-dots-vertical"></i>
        </button>
    </div>
    </div>
    <div class="report-card d-flex justify-content-between gap-4">
    <div class="flex-grow-1">
        <h6 class="fw-semibold mb-1">Faculty Workload Analysis</h6>
        <p class=" small mb-2">
            Detailed breakdown of faculty teaching loads, research activities, and administrative duties
        </p>

        <div class="report-progress">
            <div style="width:75%"></div>
        </div>

        <small class="text-warning fw-medium">Generating… 75%</small><br>
        <small class="">HR Department • Last: 25/06/2024</small>
    </div>

    <div class="text-end">
        <span class="report-status generating">Generating</span>
        <div class="small  mt-1">ETA: 5 min</div>
    </div>
</div>
<div class="report-card d-flex justify-content-between gap-4">
    <div>
        <h6 class="fw-semibold mb-1">Financial Summary Report</h6>
        <p class=" small mb-2">
            Complete financial overview including revenue, expenses, and budget allocation
        </p>

        <div class="report-meta">
            <span class="report-tag">Financial</span>
            <span class="report-tag">Summary</span>
            <span class="report-tag">PDF</span>
        </div>

        <small class="">
            Finance Office • Last: 30/06/2024 • 234 downloads
        </small>
    </div>

    <div class="text-end">
        <span class="report-status available">Available</span>
        <button class="btn btn-link ms-2">
            <i class="bi bi-three-dots-vertical"></i>
        </button>
    </div>
</div>


</div>
@endsection
