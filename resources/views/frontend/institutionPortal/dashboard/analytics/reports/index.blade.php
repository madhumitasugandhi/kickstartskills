@extends('frontend.institutionPortal.layout.app')

@section('page_title', 'Institutional Reports')
@section('title', 'Institutional Reports')

@section('content')

<div class="container-fluid p-4 p-md-5">

    {{-- ================= HEADER ================= --}}
    <div class="ui-page-header d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex gap-3 align-items-center">
        <div class="ui-icon-box">
            <i class="bi bi-file-earmark-text"></i>
        </div>
        <div>
            <h5 class="mb-0">Institutional Reports</h5>
            <small class="ui-muted">
                Generate, manage, and download institutional reports and analytics
            </small>
        </div>
    </div>

    <button class="btn btn-teal btn-sm">
        <i class="bi bi-plus-lg me-1"></i> Create Report
    </button>
</div>

    {{-- ================= FILTER BAR ================= --}}
    <div class="ui-card mb-4">
    <div class="input-group-custom mb-3">
        <i class="bi bi-search"></i>
        <input type="text"
               class="form-control"
               placeholder="Search reports...">
    </div>

    <div class="row g-3 align-items-end">
        <div class="col-md-4">
            <label class="ui-label ">Category</label>
            <select class="form-select">
                <option>All Categories</option>
                <option>Academic</option>
                <option>Faculty</option>
                <option>Financial</option>
            </select>
        </div>

        <div class="col-md-4">
            <label class="ui-label ">Status</label>
            <select class="form-select">
                <option>All Status</option>
                <option>Available</option>
                <option>Generating</option>
                <option>Error</option>
            </select>
        </div>

        <div class="col-md-3">
            <label class="ui-label ">Format</label>
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
    <div class="ui-stats-card">
        <div class="stats-icon">
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

    {{-- ================= REPORT LIST ================= --}}
    <div class="ui-report-card">
    <div>
        <div class="ui-card-title">Student Performance Report</div>
        <div class="ui-card-subtitle">
            Comprehensive analysis of student academic performance, grades, and progress tracking
        </div>

        <div class="ui-ui-report-meta">
            <span class="ui-report-tag">Academic</span>
            <span class="ui-report-tag">Performance</span>
            <span class="ui-report-tag">Monthly</span>
            <span class="ui-report-tag">PDF</span>
        </div>

        <small class="ui-muted">
            <i class="bi bi-building"></i> Academic Office •
            <i class="bi bi-clock"></i> 28/06/2024 •
            <i class="bi bi-download"></i> 156 downloads
        </small>
    </div>

    <div class="ui-muted">
        <span class="ui-report-status available">Available</span>
        <button class="btn btn-link ms-2">
            <i class="bi bi-three-dots-vertical"></i>
        </button>
    </div>
</div>

   


    <div class="ui-report-card d-flex justify-content-between gap-4">
    <div class="flex-grow-1">
        <h6 class="ui-card-title">Faculty Workload Analysis</h6>
        <p class="ui-card-subtitle">
            Detailed breakdown of faculty teaching loads, research activities, and administrative duties
        </p>

        <div class="report-progress">
            <div style="width:75%"></div>
        </div>

        <small class="text-warning fw-medium">Generating… 75%</small><br>
        <small class="">HR Department • Last: 25/06/2024</small>
    </div>

    <div class="ui-muted">
        <span class="report-status generating">Generating</span>
        <div class="small  mt-1">ETA: 5 min</div>
    </div>
</div>


<div class="ui-report-card d-flex justify-content-between gap-4">
    <div>
        <h6 class="ui-card-title">Financial Summary Report</h6>
        <p class="ui-card-subtitle">
            Complete financial overview including revenue, expenses, and budget allocation
        </p>

        <div class="ui-report-meta">
            <span class="ui-report-tag">Financial</span>
            <span class="ui-report-tag">Summary</span>
            <span class="ui-report-tag">PDF</span>
        </div>

        <small class="">
            Finance Office • Last: 30/06/2024 • 234 downloads
        </small>
    </div>

    <div class="text-end">
        <span class="ui-report-status available">Available</span>
        <button class="btn btn-link ms-2">
            <i class="bi bi-three-dots-vertical"></i>
        </button>
    </div>
</div>


</div>
@endsection
