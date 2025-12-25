@extends('frontend.institutionPortal.layout.app')

@section('title', 'Advanced Analytics Dashboard')

@section('content')
<div class="container-fluid px-4 py-4">

    {{-- ================= HEADER ================= --}}
    <div class="d-flex flex-wrap justify-content-between align-items-start mb-4 gap-3">

<div>
    <h4 class="fw-semibold mb-1">Advanced Analytics Dashboard</h4>
    <small class="">
        AI-powered insights and custom reporting for institutional excellence
    </small>
</div>

<div class="d-flex gap-2">
    <button class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-gear"></i>
    </button>
    <button class="btn btn-teal btn-sm">
        <i class="bi bi-plus-lg me-1"></i> Custom Report
    </button>
</div>

</div>


      {{-- ================= TABS ================= --}}
     

      <div class="course-tabs mb-3" id="analyticsTabs">


<button class="tab-btn active" data-tab="executive">
    <i class="bi bi-speedometer2"></i>
    <span>Executive Overview</span>
</button>

<button class="tab-btn" data-tab="realtime">
    <i class="bi bi-activity"></i>
    <span>Real-time Metrics</span>
</button>

<button class="tab-btn" data-tab="predictive">
    <i class="bi bi-cpu"></i>
    <span>Predictive Analytics</span>
</button>

<button class="tab-btn" data-tab="reports">
    <i class="bi bi-file-earmark-bar-graph"></i>
    <span>Custom Reports</span>
</button>

<button class="tab-btn" data-tab="benchmark">
    <i class="bi bi-bar-chart-line"></i>
    <span>Benchmarking</span>
</button>


</div>
<div class="course-tab-content">

    <div class="tab-pane active" id="tab-executive">
        @include('frontend.institutionPortal.dashboard.analytics.advanced-dashboard.partials.executive-overview')
    </div>

    <div class="tab-pane" id="tab-realtime">
        @include('frontend.institutionPortal.dashboard.analytics.advanced-dashboard.partials.real-time-metrics')
    </div>

    <div class="tab-pane" id="tab-predictive">
        @include('frontend.institutionPortal.dashboard.analytics.advanced-dashboard.partials.predictive-analytics')
    </div>

    <div class="tab-pane" id="tab-reports">
        @include('frontend.institutionPortal.dashboard.analytics.advanced-dashboard.partials.custom-reports')
    </div>

    <div class="tab-pane" id="tab-benchmark">
        @include('frontend.institutionPortal.dashboard.analytics.advanced-dashboard.partials.benchmarking')
    </div>

</div>


</div>
<script>
document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {

        // Remove active from buttons
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));

        // Hide all panes
        document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));

        // Activate clicked tab
        btn.classList.add('active');

        const target = btn.dataset.tab;
        document.getElementById('tab-' + target).classList.add('active');
    });
});
</script>
@endsection
