<style>
    /* ===============================
   REAL-TIME METRICS – ADDONS
================================ */

/* Status dot */
.dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
}

.dot.success { background: #10b981; }
.dot.warning { background: #f59e0b; }
.dot.info    { background: #3b82f6; }
.dot.danger  { background: #ef4444; }

/* Health circle */
.health-circle {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    margin: 0 auto;
    font-size: 0.9rem;
    border: 4px solid;
}

.health-circle.success {
    color: #10b981;
    border-color: rgba(16,185,129,0.6);
}

.health-circle.warning {
    color: #f59e0b;
    border-color: rgba(245,158,11,0.6);
}

/* Mobile spacing */
@media (max-width: 768px) {
    .health-circle {
        width: 64px;
        height: 64px;
        font-size: 0.85rem;
    }
}

</style>


{{-- ================= REAL-TIME SYSTEM STATUS ================= --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <h6 class="fw-semibold d-flex align-items-center gap-2">
        <i class="bi bi-activity text-teal"></i>
        Real-time System Status
    </h6>

    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
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
            <div class="glass-card h-100 position-relative">

                <div class="stat-icon {{ $metric['class'] }}">
                    <i class="bi {{ $metric['icon'] }}"></i>
                </div>

                <h5 class="fw-semibold mt-3 mb-1">{{ $metric['value'] }}</h5>
                <small class="text-muted">{{ $metric['label'] }}</small>

                <span class="position-absolute top-0 end-0 m-3">
                    <span class="dot {{ $metric['class'] }}"></span>
                </span>

            </div>
        </div>
    @endforeach

</div>

{{-- ================= SYSTEM HEALTH OVERVIEW ================= --}}
<div class="glass-card analytics-card">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="fw-semibold d-flex align-items-center gap-2">
            <i class="bi bi-shield-check text-teal"></i>
            System Health Overview
        </h6>

        <a href="#" class="small text-teal">
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

                <div class="health-circle {{ $item['class'] }}">
                    {{ $item['value'] }}%
                </div>

                <small class="text-muted d-block mt-2">
                    {{ $item['label'] }}
                </small>

            </div>
        @endforeach

    </div>

</div>
