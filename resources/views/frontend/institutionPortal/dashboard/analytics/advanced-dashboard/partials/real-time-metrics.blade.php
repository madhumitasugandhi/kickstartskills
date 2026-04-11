
{{-- ================= REAL-TIME SYSTEM STATUS ================= --}}
<div class="ui-page-header d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex gap-3 align-items-center">
        <div class="ui-icon-box">
            <i class="bi bi-activity"></i>
        </div>
        <div>
            <h5 class="mb-0">Real-time System Status</h5>
            <small class="ui-muted">Live system metrics and monitoring</small>
        </div>
    </div>

    <span class="ui-badge">
        ● All Systems Operational
    </span>
</div>

{{-- ================= METRIC CARDS ================= --}}
<div class="row g-3 mb-4">

    @php
        $metrics = [
            ['label'=>'Active Users','value'=>'1247','icon'=>'bi-people','class'=>'success'],
            ['label'=>'Current Enrollment','value'=>'2847','icon'=>'bi-person-check','class'=>'info'],
            ['label'=>"Today's Applications",'value'=>'23','icon'=>'bi-file-earmark-text','class'=>'warning'],
            ['label'=>'System Uptime','value'=>'99.8%','icon'=>'bi-hdd','class'=>'success'],
            ['label'=>'Server Load','value'=>'67.3%','icon'=>'bi-cpu','class'=>'warning'],
            ['label'=>'DB Connections','value'=>'145','icon'=>'bi-database','class'=>'info'],
            ['label'=>'API Requests','value'=>'15627','icon'=>'bi-lightning','class'=>'success'],
            ['label'=>'Error Rate','value'=>'0.02%','icon'=>'bi-exclamation-circle','class'=>'danger'],
        ];
    @endphp

@foreach($metrics as $metric)
    <div class="col-lg-3 col-md-6">
        <div class="ui-card h-100 position-relative">

            <div class="stats-icon {{ $metric['class'] }}">
                <i class="bi {{ $metric['icon'] }}"></i>
            </div>

            <div class="ui-card-title mt-3">{{ $metric['value'] }}</div>
            <div class="ui-card-subtitle">{{ $metric['label'] }}</div>

            <span class="position-absolute top-0 end-0 m-3">
                <span class="ui-dot {{ $metric['class'] }}"></span>
            </span>

        </div>
    </div>
@endforeach
</div>

{{-- ================= SYSTEM HEALTH OVERVIEW ================= --}}
<div class="ui-card">

    <div class="ui-card-header">
        <div>
            <div class="ui-card-title">System Health Overview</div>
            <div class="ui-card-subtitle">Infrastructure health metrics</div>
        </div>

        <a href="#" class="ui-link">
            <i class="bi bi-box-arrow-up-right me-1"></i> View Details
        </a>
    </div>

    <div class="row text-center g-4">

        @php
            $health = [
                ['label'=>'Application','value'=>99,'class'=>'success'],
                ['label'=>'Database','value'=>99,'class'=>'success'],
                ['label'=>'API Gateway','value'=>98,'class'=>'warning'],
                ['label'=>'File Storage','value'=>100,'class'=>'success'],
            ];
        @endphp

@foreach($health as $item)
            <div class="col-md-3 col-6">

                <div class="ui-health-circle {{ $item['class'] }}">
                    {{ $item['value'] }}%
                </div>

                <small class="ui-muted d-block mt-2">
                    {{ $item['label'] }}
                </small>

            </div>
        @endforeach
    </div>

</div>
