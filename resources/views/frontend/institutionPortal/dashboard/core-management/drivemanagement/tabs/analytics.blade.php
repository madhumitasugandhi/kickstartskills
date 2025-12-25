<h6 class="fw-semibold mb-3">Drive Analytics & Insights</h6>

<!-- ================= PACKAGE DISTRIBUTION ================= -->
<div class="glass-card mb-4">
    <h6 class="mb-3">Package Distribution</h6>

    @php
        $packages = [
            ['label' => 'High (10+ LPA)', 'count' => 3, 'color' => 'success'],
            ['label' => 'Medium (5–10 LPA)', 'count' => 2, 'color' => 'info'],
            ['label' => 'Entry Below 5 LPA', 'count' => 0, 'color' => 'muted'],
        ];
        $maxPkg = max(array_column($packages, 'count')) ?: 1;
    @endphp

    @foreach($packages as $pkg)
        @php $width = ($pkg['count'] / $maxPkg) * 100; @endphp

        <div class="mb-3">
            <div class="d-flex justify-content-between small mb-1">
                <span>{{ $pkg['label'] }}</span>
                <span>{{ $pkg['count'] }} drives</span>
            </div>

            <div class="progress-track">
                <div class="progress-fill bg-{{ $pkg['color'] }}"
                     style="width: {{ $width }}%"></div>
            </div>
        </div>
    @endforeach
</div>

<!-- ================= INDUSTRY BREAKDOWN ================= -->
<div class="glass-card mb-4">
    <h6 class="mb-3">Industry Breakdown</h6>

    @php
        $industries = [
            'Software Services',
            'Data Analytics',
            'Financial Services',
            'Technology Startup',
            'Consulting'
        ];
    @endphp

    @foreach($industries as $industry)
        <div class="d-flex justify-content-between align-items-center small mb-2">
            <span>
                <i class="bi bi-dot text-teal me-1"></i> {{ $industry }}
            </span>
            <span>1 drive</span>
        </div>
    @endforeach
</div>

<!-- ================= APPLICATION PERFORMANCE ================= -->
<div class="glass-card">
    <h6 class="mb-3">Application Performance</h6>

    @php
        $performance = [
            ['company' => 'TechCore Solutions', 'count' => 4],
            ['company' => 'DataTech Analytics', 'count' => 23],
            ['company' => 'FinanceFlow Corp', 'count' => 15],
            ['company' => 'StartupHub Inc', 'count' => 0],
            ['company' => 'ConsultPro Services', 'count' => 8],
        ];
        $maxPerf = max(array_column($performance, 'count')) ?: 1;
    @endphp

    @foreach($performance as $item)
        @php $width = ($item['count'] / $maxPerf) * 100; @endphp

        <div class="mb-3">
            <div class="d-flex justify-content-between small mb-1">
                <span>{{ $item['company'] }}</span>
                <span>{{ $item['count'] }}/45 ({{ round($width) }}%)</span>
            </div>

            <div class="progress-track">
                <div class="progress-fill"
                     style="width: {{ $width }}%"></div>
            </div>
        </div>
    @endforeach
</div>
<style>
    /* Progress bar base */
.progress-track {
    width: 100%;
    height: 6px;
    background: rgba(255,255,255,0.08);
    border-radius: 999px;
    overflow: hidden;
}

/* Progress fill */
.progress-fill {
    height: 100%;
    background: var(--primary-teal);
    border-radius: 999px;
    transition: width 0.4s ease;
}

/* Color helpers */
.progress-fill.bg-success { background: #10b981; }
.progress-fill.bg-info { background: #3b82f6; }
.progress-fill.bg-muted { background: #6b7280; }

</style>