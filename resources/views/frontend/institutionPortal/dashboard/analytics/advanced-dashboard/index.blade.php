@extends('frontend.institutionPortal.layout.app')

@section('title', 'Advanced Analytics Dashboard')

@section('content')
<div class="container-fluid px-4 py-4">

    {{-- ================= HEADER ================= --}}
    <div class="ui-page-header d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex gap-3 align-items-center">
        <div class="ui-icon-box">
            <i class="bi bi-bar-chart"></i>
        </div>
        <div>
            <h5 class="mb-0">Advanced Analytics Dashboard</h5>
            <small class="ui-muted">
                AI-powered insights and custom reporting for institutional excellence
            </small>
        </div>
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
     
      <div class="ui-tabs mb-3">
    <button class="ui-tab active" data-tab="executive">
        <i class="bi bi-speedometer2 me-1"></i> Executive Overview
    </button>

    <button class="ui-tab" data-tab="realtime">
        <i class="bi bi-activity me-1"></i> Real-time Metrics
    </button>

    <button class="ui-tab" data-tab="predictive">
        <i class="bi bi-cpu me-1"></i> Predictive Analytics
    </button>

    <button class="ui-tab" data-tab="reports">
        <i class="bi bi-file-earmark-bar-graph me-1"></i> Custom Reports
    </button>

    <button class="ui-tab" data-tab="benchmark">
        <i class="bi bi-bar-chart-line me-1"></i> Benchmarking
    </button>
</div>

<div class="ui-card">

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
document.querySelectorAll('.ui-tab').forEach(btn => {
    btn.addEventListener('click', () => {

        document.querySelectorAll('.ui-tab').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));

        btn.classList.add('active');

        const target = btn.dataset.tab;
        document.getElementById('tab-' + target).classList.add('active');
    });
});
</script>
@endsection
