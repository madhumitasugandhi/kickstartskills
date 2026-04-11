@extends('frontend.institutionPortal.layout.app')

@section('title','Performance Analytics')
@section('page_title','Performance Analytics')

@section('content')

<div class="container-fluid p-3 p-md-5">

    <!-- ================= HEADER ================= -->
    <div class="ui-page-header d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex gap-3 align-items-center">
        <div class="ui-icon-box">
            <i class="bi bi-graph-up"></i>
        </div>
        <div>
            <h5 class="mb-0">Performance Analytics</h5>
            <small class="ui-muted">
                Monitor institutional performance metrics and trends
            </small>
        </div>
    </div>

    <button class="btn btn-teal btn-sm">
        <i class="bi bi-download me-1"></i> Export Report
    </button>
</div>

    <!-- ================= FILTER BAR ================= -->
    <div class="ui-card mb-4">
                <div class="row g-3 align-items-end">

            <div class="col-md-4">
                <label class="ui-label ">Timeframe</label>
                <select class="form-select">
                    <option>Last 30 Days</option>
                    <option>Last 6 Months</option>
                    <option>Last Year</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="ui-label ">Department</label>
                <select class="form-select">
                    <option>All Departments</option>
                    <option>Computer Science</option>
                    <option>Engineering</option>
                    <option>Business</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="ui-label ">View</label>
                <select class="form-select">
                    <option>Overview</option>
                    <option>Academic</option>
                    <option>Faculty</option>
                </select>
            </div>

            <div class="col-md-1">
                <button class="btn btn-teal w-100">
                    <i class="bi bi-arrow-repeat"></i>
                </button>
            </div>

        </div>
    </div>

    <!-- ================= KPI CARDS ================= -->
    <h6 class="fw-semibold mb-3">Key Performance Indicators</h6>
    <div class="row g-3 mb-4">
        @foreach([
            ['label'=>'Total Students','value'=>2847,'icon'=>'bi-people'],
            ['label'=>'Total Faculty','value'=>156,'icon'=>'bi-person-badge'],
            ['label'=>'Total Courses','value'=>89,'icon'=>'bi-book'],
            ['label'=>'Programs','value'=>12,'icon'=>'bi-grid'],
            ['label'=>'Average GPA','value'=>'3.42','icon'=>'bi-graph-up'],
            ['label'=>'Graduation Rate','value'=>'87.3%','icon'=>'bi-award'],
            ['label'=>'Retention Rate','value'=>'92.1%','icon'=>'bi-shield-check'],
            ['label'=>'Employment Rate','value'=>'94.7%','icon'=>'bi-briefcase'],
        ] as $kpi)

        <div class="col-12 col-md-6 col-xl-3">
    <div class="ui-card d-flex align-items-center gap-3 position-relative">

        <div class="stats-icon">
            <i class="bi {{ $kpi['icon'] }}"></i>
        </div>

        <div>
            <div class="ui-card-title">{{ $kpi['value'] }}</div>
            <div class="ui-card-subtitle">{{ $kpi['label'] }}</div>
        </div>

        <div class="ui-kpi-trend">
            <i class="bi bi-graph-up-right"></i>
        </div>
    </div>
</div>
@endforeach
</div>

    <!-- ================= PERFORMANCE TRENDS ================= -->
    <h6 class="fw-semibold mb-3">Performance Trends</h6>
    <div class="row g-3 mb-4">

        <div class="col-md-7">
        <div class="ui-analytics-card h-100">
    <div class="ui-card-title mb-3">
        <i class="bi bi-bar-chart-line me-1"></i>
        Enrollment Trend
    </div>

    <div class="ui-chart-placeholder">
        <i class="bi bi-bar-chart-line fs-2 text-teal"></i>
        Chart visualization would be implemented here
        <div class="fw-semibold text-teal mt-2">
            Current: 2,847 students
        </div>
    </div>
</div>
        </div>

        <div class="col-md-5">
            <div class="ui-analytics-card h-100">
                <h6 class="fw-semibold mb-3">
                    <i class="bi bi-pie-chart me-1"></i>
                    Academic Performance
                </h6>

                <div class="ui-chart-placeholder">
    <i class="bi bi-pie-chart fs-2 text-teal"></i>
    Performance chart would be implemented here
    <div class="fw-semibold text-teal mt-2">
        Current GPA: 3.42
    </div>
</div>

            </div>
        </div>

    </div>

    <!-- ================= DETAILED ANALYTICS ================= -->
    <h6 class="fw-semibold mb-3">Detailed Analytics</h6>
    <div class="row g-3">

        <!-- Academic -->
        <div class="col-md-6">
            <div class="ui-analytics-card h-100">
                <h6 class="fw-semibold mb-3">
                    <i class="bi bi-mortarboard me-1"></i>
                    Academic Performance
                </h6>

                <div class="ui-analytics-row"><span>Pass Rate</span><strong class="text-teal">89.4%</strong></div>
                <div class="ui-analytics-row"><span>Dropout Rate</span><strong class="text-danger">5.2%</strong></div>
                <div class="ui-analytics-row"><span>Completion Rate</span><strong class="text-teal">94.8%</strong></div>
                <div class="ui-analytics-row"><span>Attendance</span><strong class="text-warning">87.6%</strong></div>

                <hr>

                <h6 class="small fw-semibold mb-2">Top Performing Departments</h6>
                <div class="ui-analytics-row"><span>Computer Science</span><span>GPA 3.6</span></div>
                <div class="ui-analytics-row"><span>Engineering</span><span>GPA 3.5</span></div>
                <div class="ui-analytics-row"><span>Business</span><span>GPA 3.4</span></div>
            </div>
        </div>

        <!-- Faculty -->
        <div class="col-md-6">
            <div class="ui-analytics-card h-100">
                <h6 class="fw-semibold mb-3">
                    <i class="bi bi-people me-1"></i>
                    Faculty Performance
                </h6>

                <div class="ui-analytics-row"><span>Average Rating</span><strong>4.3 / 5.0</strong></div>
                <div class="ui-analytics-row"><span>Course Load</span><strong>3.2 courses</strong></div>
                <div class="ui-analytics-row"><span>Research Output</span><strong>142 papers</strong></div>
                <div class="ui-analytics-row"><span>Publication Rate</span><strong>68.5%</strong></div>

                <hr>

                <h6 class="small fw-semibold mb-2">Top Rated Faculty</h6>
                <div class="ui-analytics-row"><span>Dr. Sarah Johnson</span><span>★ 4.8</span></div>
                <div class="ui-analytics-row"><span>Prof. Michael Chen</span><span>★ 4.7</span></div>
                <div class="ui-analytics-row"><span>Dr. Emily Rodriguez</span><span>★ 4.6</span></div>
            </div>
        </div>

    </div>
    <h6 class="fw-semibold mb-3">Financial Performance</h6>

<div class="ui-financial-card mb-4">
    <div class="row g-4">

        <div class="col-md-6">
            <div class="ui-analytics-row">
                <span>Total Revenue</span>
                <strong class="text-teal">$15.4M</strong>
            </div>
            <div class="ui-analytics-row">
                <span>Tuition Collection</span>
                <strong class="text-primary">95.8%</strong>
            </div>
            <div class="ui-analytics-row">
                <span>Scholarships</span>
                <strong class="text-warning">$2.8M</strong>
            </div>
        </div>

        <div class="col-md-6">
            <div class="ui-analytics-row">
                <span>Operational Costs</span>
                <strong class="text-danger">$12.2M</strong>
            </div>
            <div class="ui-analytics-row">
                <span>Profit Margin</span>
                <strong class="text-teal">21%</strong>
            </div>
            <div class="ui-analytics-row">
                <span>Net Profit</span>
                <strong class="text-teal">$3.2M</strong>
            </div>
        </div>

    </div>
</div>

</div>
@endsection
