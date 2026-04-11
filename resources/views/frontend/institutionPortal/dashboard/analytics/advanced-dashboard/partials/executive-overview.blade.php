<div class="ui-card mb-4" id="executive">

    <div class="row g-3 align-items-end">

        <div class="col-md-4">
            <label class="ui-label">Dashboard Template</label>
            <select class="form-select">
                <option>Executive Overview</option>
            </select>
        </div>

        <div class="col-md-4">
            <label class="ui-label">Time Period</label>
            <select class="form-select">
                <option>Last 30 Days</option>
            </select>
        </div>

        <div class="col-md-3">
            <label class="ui-label">Data Granularity</label>
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
</div>

    {{-- KPI CARDS --}}
    <div class="ui-section-title mb-3">KEY PERFORMANCE INDICATORS</div>

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
    <div class="ui-card h-100">

        <div class="d-flex justify-content-between align-items-start mb-2">
            <div class="stats-icon info">
                <i class="bi {{ $kpi['icon'] }}"></i>
            </div>

            <span class="ui-badge 
                {{ $kpi['trendType']=='up' ? '' : 'text-danger' }}">
                {{ $kpi['trend'] }}
            </span>
        </div>

        <div class="ui-card-title">{{ $kpi['value'] }}</div>
        <div class="ui-card-subtitle">{{ $kpi['label'] }}</div>

    </div>
</div>
@endforeach
</div>


    {{-- PERFORMANCE INSIGHTS --}}
    <div class="ui-section-title mb-3">PERFORMANCE INSIGHTS</div>

    <div class="ui-card mb-3 d-flex justify-content-between align-items-center">
    <div class="d-flex gap-3">
        <div class="stats-icon success">
            <i class="bi bi-graph-up"></i>
        </div>
        <div>
            <div class="ui-card-title">Performance Alert</div>
            <div class="ui-muted small">
                Student satisfaction increased by 2.1% this month, driven by improved faculty response times.
            </div>
        </div>
    </div>
    <button class="btn btn-outline-success btn-sm">View Details</button>
</div>

<div class="ui-card mb-3 d-flex justify-content-between align-items-center">
    <div class="d-flex gap-3">
        <div class="stats-icon warning">
            <i class="bi bi-exclamation-triangle"></i>
        </div>
        <div>
            <div class="ui-card-title">Attention Needed</div>
            <div class="ui-muted small">
                Faculty retention dropped by 1.3%. HR recommends workload review.
            </div>
        </div>
    </div>
    <button class="btn btn-warning btn-sm">Take Action</button>
</div>

<div class="glass-card mb-3 d-flex justify-content-between align-items-center">
    <div class="d-flex gap-3">
        <div class="stat-icon warning">
            <i class="bi bi-exclamation-triangle"></i>
        </div>
        <div>
            <strong>Attention Needed</strong>
            <p class="small mb-0">
                Faculty retention dropped by 1.3%. HR recommends workload review.
            </p>
        </div>
    </div>
    <button class="btn btn-warning btn-sm">Take Action</button>
</div>
<div class="ui-section-title mb-3">QUICK ACTIONS</div>

<div class="row g-3">
    <div class="col-md-3">
        <div class="ui-card text-center">
            <div class="stats-icon info mx-auto mb-2">
                <i class="bi bi-file-earmark-text"></i>
            </div>
            <div class="ui-muted small">Generate Executive Report</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="ui-card text-center">
            <div class="stats-icon success mx-auto mb-2">
                <i class="bi bi-download"></i>
            </div>
            <div class="ui-muted small">Schedule Data Export</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="ui-card text-center">
            <div class="stats-icon warning mx-auto mb-2">
                <i class="bi bi-bell"></i>
            </div>
            <div class="ui-muted small">Configure Alerts</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="ui-card text-center">
            <div class="stats-icon info mx-auto mb-2">
                <i class="bi bi-bar-chart"></i>
            </div>
            <div class="ui-muted small">Benchmark Analysis</div>
        </div>
    </div>
</div>


