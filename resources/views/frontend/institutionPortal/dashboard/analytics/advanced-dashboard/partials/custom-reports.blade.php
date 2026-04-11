{{-- ================= CUSTOM ANALYTICS REPORTS ================= --}}
<div class="ui-page-header d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex gap-3 align-items-center">
        <div class="ui-icon-box">
            <i class="bi bi-file-earmark-text"></i>
        </div>
        <div>
            <h5 class="mb-0">Custom Analytics Reports</h5>
            <small class="ui-muted">Create and manage advanced analytics reports</small>
        </div>
    </div>

    <button class="btn btn-teal btn-sm">
        <i class="bi bi-plus-lg me-1"></i> Create Report
    </button>
</div>

{{-- ================= REPORT TYPES ================= --}}
<div class="row g-3 mb-4">

    @php
        $types = [
            ['title'=>'Correlation Analysis','desc'=>'Find relationships between different metrics','icon'=>'bi-diagram-3'],
            ['title'=>'Cohort Analysis','desc'=>'Track student groups over time','icon'=>'bi-people'],
            ['title'=>'Financial Modelling','desc'=>'Revenue and cost optimization','icon'=>'bi-currency-dollar'],
            ['title'=>'Predictive Modelling','desc'=>'AI-powered trend forecasting','icon'=>'bi-graph-up'],
        ];
    @endphp

@foreach($types as $type)
    <div class="col-lg-3 col-md-6">
        <div class="ui-card h-100">
            <div class="stats-icon info mb-3">
                <i class="bi {{ $type['icon'] }}"></i>
            </div>
            <div class="ui-card-title">{{ $type['title'] }}</div>
            <div class="ui-card-subtitle">{{ $type['desc'] }}</div>
        </div>
    </div>
@endforeach
</div>

{{-- ================= RECENT REPORTS ================= --}}
<div class="ui-section-title mb-3">RECENT REPORTS</div>

<div class="drive-list">

@php
$reports = [
    [
        'title'=>'Student Performance Correlation Analysis',
        'category'=>'Advanced Analytics',
        'date'=>'28/6/2024',
        'insights'=>'23 insights generated',
        'status'=>'success'
    ],
    [
        'title'=>'Revenue Optimization Recommendations',
        'category'=>'Financial Modelling',
        'date'=>'27/6/2024',
        'insights'=>null,
        'status'=>'warning'
    ],
    [
        'title'=>'Faculty Productivity Benchmarking',
        'category'=>'HR Analytics',
        'date'=>'26/6/2024',
        'insights'=>'17 insights generated',
        'status'=>'success'
    ],
];
@endphp

@foreach($reports as $report)
<div class="ui-card position-relative mb-3">

    <div class="d-flex justify-content-between align-items-start">

        <!-- LEFT -->
        <div class="d-flex gap-3">
            <div class="stats-icon {{ $report['status'] }}">
                <i class="bi bi-check-circle"></i>
            </div>

            <div>
                <div class="ui-card-title">{{ $report['title'] }}</div>
                <div class="ui-card-subtitle">
                    {{ $report['category'] }} • Created {{ $report['date'] }}
                </div>

                @if($report['insights'])
                    <div class="small text-success mt-1">
                        {{ $report['insights'] }}
                    </div>
                @endif
            </div>
        </div>

        <!-- RIGHT -->
        <div class="student-actions">
            <button class="icon-btn kebab-toggle">
                <i class="bi bi-three-dots-vertical"></i>
            </button>

            <ul class="kebab-menu ui-dropdown">
                <li>
                    <i class="bi bi-eye me-2"></i> View Report
                </li>
                <li>
                    <i class="bi bi-download me-2"></i> Export
                </li>
                <li>
                    <i class="bi bi-pencil me-2"></i> Edit
                </li>
                <li class="text-danger">
                    <i class="bi bi-trash me-2"></i> Delete
                </li>
            </ul>
        </div>

    </div>

</div>
@endforeach

</div>
<script>
document.addEventListener('click', function (e) {

    document.querySelectorAll('.kebab-menu').forEach(menu => {
        if (!menu.contains(e.target) &&
            !menu.previousElementSibling.contains(e.target)) {
            menu.classList.remove('show');
        }
    });

    if (e.target.closest('.kebab-toggle')) {
        const menu = e.target.closest('.student-actions').querySelector('.kebab-menu');
        menu.classList.toggle('show');
    }
});
</script>
