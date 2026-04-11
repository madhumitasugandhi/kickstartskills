
{{-- ================= BENCHMARKING & COMPARATIVE ANALYSIS ================= --}}
<div class="ui-page-header mb-3">
    <div class="d-flex gap-3 align-items-center">
        <div class="ui-icon-box">
            <i class="bi bi-bar-chart-line"></i>
        </div>
        <div>
            <h5 class="mb-0">Benchmarking & Comparative Analysis</h5>
            <small class="ui-muted">Performance comparison with industry benchmarks</small>
        </div>
    </div>
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
        <div class="ui-card h-100">

            <div class="d-flex justify-content-between align-items-start mb-2">
                <strong>{{ $item['label'] }}</strong>
                <span class="ui-badge">
                    {{ $item['percentile'] }} %ile
                </span>
            </div>

            <div class="row mt-3">
                <div class="col-6">
                    <small class="ui-muted">Our Value</small>
                    <h6 class="fw-semibold text-success">{{ $item['our'] }}</h6>
                </div>
                <div class="col-6">
                    <small class="ui-muted">Industry Avg</small>
                    <h6 class="fw-semibold">{{ $item['avg'] }}</h6>
                </div>
            </div>

        </div>
    </div>
@endforeach
</div>

{{-- ================= PEER INSTITUTION COMPARISON ================= --}}
<h6 class="section-title mb-3">Peer Institution Comparison</h6>

<div class="ui-card">

    <div class="ui-card-header">
        <div>
            <div class="ui-card-title">Top Performing Institutions</div>
            <div class="ui-card-subtitle">Peer comparison metrics</div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="ui-table">
            <thead>
                <tr>
                    <th>Institution</th>
                    <th>Rank</th>
                    <th>Enrollment</th>
                    <th>Graduation Rate</th>
                    <th>Employment Rate</th>
                    <th>Satisfaction</th>
                </tr>
            </thead>

            <tbody>

                <tr class="highlight-row">
                    <td>
                        <span class="ui-dot success me-2"></span>
                        <strong>Our Institution</strong>
                        <small class="ui-muted">(Current)</small>
                    </td>
                    <td>#3</td>
                    <td>2,847</td>
                    <td class="text-success">87.3%</td>
                    <td class="text-success">94.7%</td>
                    <td class="text-success">94.3%</td>
                </tr>

                <tr>
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
