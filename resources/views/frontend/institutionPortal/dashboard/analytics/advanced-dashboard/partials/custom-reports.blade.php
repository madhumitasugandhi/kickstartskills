{{-- ================= CUSTOM ANALYTICS REPORTS ================= --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <h6 class="fw-semibold d-flex align-items-center gap-2">
        <i class="bi bi-file-earmark-text text-teal"></i>
        Custom Analytics Reports
    </h6>

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
            <div class="glass-card h-100">
                <div class="stat-icon info mb-3">
                    <i class="bi {{ $type['icon'] }}"></i>
                </div>
                <strong class="d-block mb-1">{{ $type['title'] }}</strong>
                <small class="">{{ $type['desc'] }}</small>
            </div>
        </div>
    @endforeach

</div>

{{-- ================= RECENT REPORTS ================= --}}
<h6 class="section-title mb-3">Recent Reports</h6>

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
<div class="glass-card position-relative mb-3">

    <div class="d-flex justify-content-between align-items-start">

        {{-- LEFT --}}
        <div class="d-flex gap-3">
            <div class="stat-icon {{ $report['status'] }}">
                <i class="bi bi-check-circle"></i>
            </div>

            <div>
                <strong class="d-block">{{ $report['title'] }}</strong>
                <small class="">
                    {{ $report['category'] }} • Created {{ $report['date'] }}
                </small>

                @if($report['insights'])
                    <div class="small text-success mt-1">
                        {{ $report['insights'] }}
                    </div>
                @endif
            </div>
        </div>

        {{-- RIGHT --}}
        <div class="student-actions">

            <button class="icon-btn kebab-toggle">
                <i class="bi bi-three-dots-vertical"></i>
            </button>

            <ul class="kebab-menu">
                <li>
                    <i class="bi bi-eye me-2"></i> View Report
                </li>
                <li>
                    <i class="bi bi-download me-2"></i> Export
                </li>
                <li>
                    <i class="bi bi-pencil me-2"></i> Edit
                </li>
                <li class="danger">
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
