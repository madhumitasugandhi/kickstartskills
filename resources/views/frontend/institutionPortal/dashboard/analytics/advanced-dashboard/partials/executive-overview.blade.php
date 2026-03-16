    <div class="glass-card mb-4" id="executive">

<div class="row g-3 align-items-end">

    <div class="col-md-4">
        <label class="form-label">Dashboard Template</label>
        <select class="form-select">
            <option>Executive Overview</option>
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Time Period</label>
        <select class="form-select">
            <option>Last 30 Days</option>
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label">Data Granularity</label>
        <select class="form-select">
            <option>Daily</option>
        </select>
    </div>

    <div class="col-md-1 d-grid">
        <button class="btn btn-teal btn-sm">
            <i class="bi bi-arrow-clockwise"></i>
        </button>
    </div>

</div>
</div>

    {{-- KPI CARDS --}}
    <h6 class="section-title mb-3">Key Performance Indicators</h6>

<div class="row g-3 mb-4">
@php
$kpis = [
    ['label'=>'Student Satisfaction','value'=>'94.3%','trend'=>'+2.1%','icon'=>'bi-emoji-smile','trendType'=>'up'],
    ['label'=>'Faculty Retention','value'=>'91.7%','trend'=>'-1.3%','icon'=>'bi-people','trendType'=>'down'],
    ['label'=>'Graduation Rate','value'=>'87.3%','trend'=>'+0.8%','icon'=>'bi-mortarboard','trendType'=>'up'],
    ['label'=>'Employment Rate','value'=>'94.7%','trend'=>'+1.6%','icon'=>'bi-briefcase','trendType'=>'up'],
    ['label'=>'Financial Health','value'=>'85.2 / 100','trend'=>'+3.5%','icon'=>'bi-currency-dollar','trendType'=>'up'],
    ['label'=>'Academic Excellence','value'=>'92.1 / 100','trend'=>'+3.2%','icon'=>'bi-award','trendType'=>'up'],
];
@endphp

@foreach($kpis as $kpi)
<div class="col-lg-4 col-md-6">
    <div class="glass-card h-100">

        <div class="d-flex justify-content-between align-items-start mb-2">
            <div class="stat-icon info">
                <i class="bi {{ $kpi['icon'] }}"></i>
            </div>

            <span class="badge 
                {{ $kpi['trendType']=='up' ? 'bg-success bg-opacity-10 text-success' : 'bg-danger bg-opacity-10 text-danger' }}">
                {{ $kpi['trend'] }}
            </span>
        </div>

        <h5 class="fw-semibold mb-1">{{ $kpi['value'] }}</h5>
        <small class="text-muted">{{ $kpi['label'] }}</small>

    </div>
</div>
@endforeach
</div>


    {{-- PERFORMANCE INSIGHTS --}}
    <h6 class="section-title mb-3">Performance Insights</h6>

<div class="glass-card mb-3 d-flex justify-content-between align-items-center">
    <div class="d-flex gap-3">
        <div class="stat-icon success">
            <i class="bi bi-graph-up"></i>
        </div>
        <div>
            <strong>Performance Alert</strong>
            <p class="small text-muted mb-0">
                Student satisfaction increased by 2.1% this month, driven by improved faculty response times.
            </p>
        </div>
    </div>
    <button class="btn btn-outline-success btn-sm">View Details</button>
</div>

<div class="glass-card mb-3 d-flex justify-content-between align-items-center">
    <div class="d-flex gap-3">
        <div class="stat-icon warning">
            <i class="bi bi-exclamation-triangle"></i>
        </div>
        <div>
            <strong>Attention Needed</strong>
            <p class="small text-muted mb-0">
                Faculty retention dropped by 1.3%. HR recommends workload review.
            </p>
        </div>
    </div>
    <button class="btn btn-warning btn-sm">Take Action</button>
</div>
<h6 class="section-title mb-3">Quick Actions</h6>

<div class="row g-3">
    <div class="col-md-3">
        <div class="glass-card text-center">
            <div class="stat-icon info mx-auto mb-2">
                <i class="bi bi-file-earmark-text"></i>
            </div>
            <small>Generate Executive Report</small>
        </div>
    </div>

    <div class="col-md-3">
        <div class="glass-card text-center">
            <div class="stat-icon success mx-auto mb-2">
                <i class="bi bi-download"></i>
            </div>
            <small>Schedule Data Export</small>
        </div>
    </div>

    <div class="col-md-3">
        <div class="glass-card text-center">
            <div class="stat-icon warning mx-auto mb-2">
                <i class="bi bi-bell"></i>
            </div>
            <small>Configure Alerts</small>
        </div>
    </div>

    <div class="col-md-3">
        <div class="glass-card text-center">
            <div class="stat-icon info mx-auto mb-2">
                <i class="bi bi-bar-chart"></i>
            </div>
            <small>Benchmark Analysis</small>
        </div>
    </div>
</div>


