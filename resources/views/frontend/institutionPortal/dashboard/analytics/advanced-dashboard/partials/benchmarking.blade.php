<style>
    /* ===============================
   BENCHMARKING HELPERS
================================ */

.dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
}

.dot.success {
    background: #10b981;
}
/* ===============================
   BENCHMARK TABLE – DARK MODE
================================ */

.benchmark-table {
    color: var(--text-main);
    margin: 0;
}

/* Header */
.benchmark-table thead th {
    font-size: 0.75rem;
    font-weight: 500;
    color: var(--text-muted);
    border-bottom: 1px solid var(--border-color);
    background: transparent;
}

/* Rows */
.benchmark-table tbody tr {
    background: transparent;
}

/* Cells */
.benchmark-table td {
    padding: 14px 12px;
    border-bottom: 1px solid var(--border-color);
    color: var(--text-muted);
    vertical-align: middle;
    background: transparent;
}

/* Remove last border */
.benchmark-table tbody tr:last-child td {
    border-bottom: none;
}

/* Highlight current institution */
.benchmark-table .current-row td {
    background: rgba(45, 212, 191, 0.06);
}

/* Numbers */
.benchmark-table td.text-success {
    font-weight: 600;
}

/* Dot alignment */
.benchmark-table .dot {
    position: relative;
    top: -1px;
}

</style>

{{-- ================= BENCHMARKING & COMPARATIVE ANALYSIS ================= --}}
<div class="d-flex align-items-center gap-2 mb-4">
    <i class="bi bi-bar-chart-line text-teal"></i>
    <h6 class="fw-semibold mb-0">Benchmarking & Comparative Analysis</h6>
</div>

{{-- ================= INDUSTRY BENCHMARKS ================= --}}
<h6 class="section-title mb-3">Industry Benchmarks</h6>

<div class="row g-3 mb-4">

    @php
        $benchmarks = [
            [
                'label'=>'Graduation Rate',
                'our'=>'87.3%',
                'avg'=>'82.5%',
                'percentile'=>'78th',
                'class'=>'success'
            ],
            [
                'label'=>'Employment Rate',
                'our'=>'94.7%',
                'avg'=>'89.2%',
                'percentile'=>'85th',
                'class'=>'success'
            ],
            [
                'label'=>'Student Satisfaction',
                'our'=>'94.3',
                'avg'=>'88.7',
                'percentile'=>'92nd',
                'class'=>'success'
            ],
        ];
    @endphp

    @foreach($benchmarks as $item)
        <div class="col-lg-4 col-md-6">
            <div class="glass-card h-100">

                <div class="d-flex justify-content-between align-items-start mb-2">
                    <strong class="text-capitalize">{{ $item['label'] }}</strong>
                    <span class="badge bg-success bg-opacity-10 text-success">
                        {{ $item['percentile'] }} %ile
                    </span>
                </div>

                <div class="row mt-3">
                    <div class="col-6">
                        <small class="text-muted">Our Value</small>
                        <h6 class="fw-semibold text-success">{{ $item['our'] }}</h6>
                    </div>
                    <div class="col-6">
                        <small class="text-muted">Industry Avg</small>
                        <h6 class="fw-semibold">{{ $item['avg'] }}</h6>
                    </div>
                </div>

            </div>
        </div>
    @endforeach

</div>

{{-- ================= PEER INSTITUTION COMPARISON ================= --}}
<h6 class="section-title mb-3">Peer Institution Comparison</h6>

<div class="glass-card">

    <h6 class="fw-semibold mb-3">Top Performing Institutions</h6>

    <div class="table-responsive">
    <table class="table align-middle mb-0 benchmark-table">

            <thead class="border-bottom">
                <tr class="small ">
                    <th>Institution</th>
                    <th>Rank</th>
                    <th>Enrollment</th>
                    <th>Graduation Rate</th>
                    <th>Employment Rate</th>
                    <th>Satisfaction</th>
                </tr>
            </thead>

            <tbody class="small">

                <tr class="border-bottom">
                    <td>
                        <span class="dot success me-2"></span>
                        <strong>Our Institution</strong>
                        <small class="">(Current)</small>
                    </td>
                    <td>#3</td>
                    <td>2,847</td>
                    <td class="text-success">87.3%</td>
                    <td class="text-success">94.7%</td>
                    <td class="text-success">94.3%</td>
                </tr>

                <tr class="border-bottom">
                    <td>ABC Technical University</td>
                    <td>#2</td>
                    <td>3,200</td>
                    <td>89.1%</td>
                    <td>96.2%</td>
                    <td>92.8%</td>
                </tr>

                <tr>
                    <td>XYZ Institute of Technology</td>
                    <td>#4</td>
                    <td>2,950</td>
                    <td>85.7%</td>
                    <td>93.4%</td>
                    <td>91.2%</td>
                </tr>

            </tbody>

        </table>
    </div>

</div>
