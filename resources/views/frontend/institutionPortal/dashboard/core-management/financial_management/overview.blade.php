<div class="row g-3 mb-4">

    <div class="col-md-3">
        <div class="glass-card d-flex align-items-center gap-3">
            <div class="stat-icon success">
                <i class="bi bi-graph-up"></i>
            </div>
            <div>
                <small>Total Revenue</small>
                <h5 class="mb-0 text-teal">₹24.5L</h5>
                <span class="small text-success">↑ +12.8%</span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="glass-card d-flex align-items-center gap-3">
            <div class="stat-icon warning">
                <i class="bi bi-arrow-down-circle"></i>
            </div>
            <div>
                <small>Total Expenses</small>
                <h5 class="mb-0 text-warning">₹18.5L</h5>
                <span class="small text-success">↑ +8.4%</span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="glass-card d-flex align-items-center gap-3">
            <div class="stat-icon info">
                <i class="bi bi-currency-rupee"></i>
            </div>
            <div>
                <small>Net Profit</small>
                <h5 class="mb-0 text-info">₹6.0L</h5>
                <span class="small text-success">↑ +24.5%</span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="glass-card d-flex align-items-center gap-3">
            <div class="stat-icon success">
                <i class="bi bi-percent"></i>
            </div>
            <div>
                <small>Collection Rate</small>
                <h5 class="mb-0 text-teal">87.3%</h5>
                <span class="small text-success">↑ +2.3%</span>
            </div>
        </div>
    </div>

</div>

<div class="row g-4 mb-4">

    <!-- LEFT : Revenue Breakdown -->
    <div class="col-md-8">
        <div class="glass-card h-100">
            <h6 class="mb-3">Revenue Breakdown</h6>
            @php
    $revenue = [
        ['label'=>'Tuition Fees','amount'=>'₹18.0L','percent'=>73.5,'class'=>'success'],
        ['label'=>'Lab Fees','amount'=>'₹3.5L','percent'=>14.3,'class'=>'info'],
        ['label'=>'Examination Fees','amount'=>'₹2.0L','percent'=>8.2,'class'=>'warning'],
        ['label'=>'Miscellaneous','amount'=>'₹1.0L','percent'=>4.0,'class'=>'success'],
    ];
@endphp

            @foreach($revenue as $r)
                <div class="mb-3">
                    <div class="d-flex justify-content-between small">
                        <span>{{ $r['label'] }}</span>
                        <span class="text-{{ $r['class'] }}">{{ $r['amount'] }}</span>
                    </div>
                    <div class="progress-track">
                        <div class="progress-fill" style="width: {{ $r['percent'] }}%"></div>
                    </div>
                </div>
            @endforeach

            <div class="glass-card mt-3 p-3">
                <strong>Total Revenue</strong>
                <span class="float-end text-teal">₹24.50 Lakh</span>
            </div>
        </div>
    </div>

    <!-- RIGHT : Payment Status -->
    <div class="col-md-4">
        <div class="glass-card h-100">
            <div class="d-flex justify-content-between mb-3">
                <h6>Payment Status</h6>
                <i class="bi bi-arrow-repeat"></i>
            </div>

            <div class="glass-card mb-2 p-3 d-flex justify-content-between">
                <strong>Total Students</strong>
                <span class="text-info">1247</span>
            </div>

            <div class="glass-card mb-2 p-3 d-flex justify-content-between">
                <strong>Payments Collected</strong>
                <span class="text-success">1089</span>
            </div>

            <div class="glass-card mb-2 p-3 d-flex justify-content-between">
                <strong>Pending Payments</strong>
                <span class="text-warning">158</span>
            </div>

            <div class="glass-card mb-3 p-3 d-flex justify-content-between">
                <strong>Defaulters</strong>
                <span class="text-danger">23</span>
            </div>

            <small class="text-muted">Collection Rate</small>
            <div class="progress-track mt-1">
                <div class="progress-fill" style="width:87.3%"></div>
            </div>
            <small class="float-end text-teal mt-1">87.3%</small>
        </div>
    </div>

</div>



{{-- Financial Trends --}}
<div class="glass-card mt-4 text-center py-5">
    <i class="bi bi-bar-chart fs-2 mb-2"></i>
    <h6>Financial Trends (6 Months)</h6>
    <p class="small text-muted">
        Revenue vs Expenses vs Profit trends
    </p>
</div>




