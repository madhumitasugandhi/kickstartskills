<div class="row g-3 mb-4">

    <div class="col-md-3">
        <div class="ui-stats-card">
            <div class="stats-icon success">
                <i class="bi bi-graph-up"></i>
            </div>
            <div>
                <small>Total Revenue</small>
                <h4>₹24.5L</h4>
                <span class="small text-success">↑ +12.8%</span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="ui-stats-card">
            <div class="stats-icon info">
                <i class="bi bi-arrow-down-circle"></i>
            </div>
            <div>
                <small>Total Expenses</small>
                <h4>₹18.5L</h4>
                <span class="small text-success">↑ +8.4%</span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="ui-stats-card">
            <div class="stats-icon success">
                <i class="bi bi-currency-rupee"></i>
            </div>
            <div>
                <small>Net Profit</small>
                <h4>₹6.0L</h4>
                <span class="small text-success">↑ +24.5%</span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="ui-stats-card">
            <div class="stats-icon info">
                <i class="bi bi-percent"></i>
            </div>
            <div>
                <small>Collection Rate</small>
                <h4>87.3%</h4>
                <span class="small text-success">↑ +2.3%</span>
            </div>
        </div>
    </div>

</div>

<div class="row g-4 mb-4">

    <!-- Revenue Breakdown -->
    <div class="col-md-8">
        <div class="ui-card">
            <h6 class="mb-3">Revenue Breakdown</h6>

            @php
                $revenue = [
                    ['label'=>'Tuition Fees','amount'=>'₹18.0L','percent'=>73.5],
                    ['label'=>'Lab Fees','amount'=>'₹3.5L','percent'=>14.3],
                    ['label'=>'Examination Fees','amount'=>'₹2.0L','percent'=>8.2],
                    ['label'=>'Miscellaneous','amount'=>'₹1.0L','percent'=>4.0],
                ];
            @endphp

            @foreach($revenue as $r)
                <div class="mb-3">
                    <div class="d-flex justify-content-between small">
                        <span>{{ $r['label'] }}</span>
                        <span>{{ $r['amount'] }}</span>
                    </div>

                    <div class="ui-progress">
                        <div class="ui-progress-fill"
                             style="width: {{ $r['percent'] }}%"></div>
                    </div>
                </div>
            @endforeach

            <div class="ui-box mt-3">
                <strong>Total Revenue</strong>
                <span class="float-end">₹24.50 Lakh</span>
            </div>
        </div>
    </div>

    <!-- Payment Status -->
    <div class="col-md-4">
        <div class="ui-card">
            <div class="d-flex justify-content-between mb-3">
                <h6>Payment Status</h6>
                <i class="bi bi-arrow-repeat"></i>
            </div>

            <div class="ui-box mb-2 d-flex justify-content-between">
                <strong>Total Students</strong>
                <span>1247</span>
            </div>

            <div class="ui-box mb-2 d-flex justify-content-between">
                <strong>Payments Collected</strong>
                <span>1089</span>
            </div>

            <div class="ui-box mb-2 d-flex justify-content-between">
                <strong>Pending Payments</strong>
                <span>158</span>
            </div>

            <div class="ui-box mb-3 d-flex justify-content-between">
                <strong>Defaulters</strong>
                <span>23</span>
            </div>

            <small class="ui-muted">Collection Rate</small>
            <div class="ui-progress mt-1">
                <div class="ui-progress-fill" style="width:87.3%"></div>
            </div>
            <small class="float-end mt-1">87.3%</small>
        </div>
    </div>

</div>


{{-- Financial Trends --}}
<div class="ui-card mt-4 text-center py-5">
    <i class="bi bi-bar-chart fs-2 mb-2"></i>
    <h6>Financial Trends (6 Months)</h6>
    <p class="ui-muted small">
        Revenue vs Expenses vs Profit trends
    </p>
</div>




