

{{-- ================= AI POWERED PREDICTIONS ================= --}}
<div class="ui-page-header mb-3">
    <div class="d-flex gap-3 align-items-center">
        <div class="ui-icon-box">
            <i class="bi bi-graph-up-arrow"></i>
        </div>
        <div>
            <h5 class="mb-0">AI-Powered Predictions</h5>
            <small class="ui-muted">Predictive analytics and AI insights</small>
        </div>
    </div>
</div>

{{-- ================= ENROLLMENT FORECAST ================= --}}
<div class="ui-card mb-4">

    <div class="ui-card-header">
        <div class="ui-card-title">Enrollment Forecast</div>
        <span class="ui-badge">AI Confidence: 82%</span>
    </div>

    <div class="text-center py-5 ui-muted">
        <i class="bi bi-graph-up fs-2 text-success mb-2"></i>
        <p class="small mb-1">Advanced forecasting chart would be implemented here</p>
        <strong class="text-success">Predicted Q4 2024: 3410 students</strong>
    </div>

    <div class="row g-3 mt-2">
    @php $quarters = [ ['q'=>'Q1 2024','value'=>2950,'confidence'=>'87.5%'], ['q'=>'Q2 2024','value'=>3120,'confidence'=>'82.3%'], ['q'=>'Q3 2024','value'=>3285,'confidence'=>'76.8%'], ['q'=>'Q4 2024','value'=>3410,'confidence'=>'71.2%'], ]; @endphp
        @foreach($quarters as $q)
            <div class="col-md-3 col-6">
                <div class="ui-card text-center">
                    <small class="ui-muted">{{ $q['q'] }}</small>
                    <div class="fw-semibold mt-1">{{ $q['value'] }}</div>
                    <small class="ui-muted">{{ $q['confidence'] }}</small>
                </div>
            </div>
        @endforeach
    </div>

</div>

{{-- ================= STUDENT RETENTION RISK ================= --}}
<div class="ui-card mb-4">

    <div class="ui-card-title mb-3">Student Retention Risk Analysis</div>

    <div class="row g-3 mb-3">
        <div class="col-md-4">
            <div class="ui-risk-card danger">
                <h5>127</h5>
                <small>High Risk</small>
            </div>
        </div>

        <div class="col-md-4">
            <div class="ui-risk-card warning">
                <h5>234</h5>
                <small>Medium Risk</small>
            </div>
        </div>

        <div class="col-md-4">
            <div class="ui-risk-card success">
                <h5>2486</h5>
                <small>Low Risk</small>
            </div>
        </div>
    </div>

    <div class="ui-subtle">
        <strong class="small">Key Risk Factors:</strong>
        <ul class="small mb-0 mt-2">
            <li>Academic Performance</li>
            <li>Financial Status</li>
            <li>Engagement Level</li>
        </ul>
    </div>

</div>

{{-- ================= FACULTY WORKLOAD ================= --}}
<div class="ui-card">

    <div class="ui-card-title mb-3">Faculty Workload Prediction</div>

    <div class="row g-3 mb-3">
        <div class="col-md-4">
            <div class="ui-risk-card danger">
                <h5>12</h5>
                <small>Overloaded</small>
            </div>
        </div>

        <div class="col-md-4">
            <div class="ui-risk-card success">
                <h5>132</h5>
                <small>Balanced</small>
            </div>
        </div>

        <div class="col-md-4">
            <div class="ui-risk-card warning">
                <h5>12</h5>
                <small>Underutilized</small>
            </div>
        </div>
    </div>

    <div class="ui-subtle d-flex align-items-center gap-2 text-success small">
        <i class="bi bi-check-circle"></i>
        AI suggests redistributing 3 courses to optimize faculty workload and improve efficiency
    </div>

</div>
