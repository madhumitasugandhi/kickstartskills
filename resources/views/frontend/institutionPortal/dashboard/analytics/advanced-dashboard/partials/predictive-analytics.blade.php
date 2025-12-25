<style>
    /* ===============================
   PREDICTIVE ANALYTICS
================================ */

.glass-subtle {
    background: rgba(45, 212, 191, 0.08);
    border-radius: 12px;
    padding: 14px;
}

/* Risk cards */
.risk-card {
    text-align: center;
    padding: 18px;
    border-radius: 14px;
}

.risk-card h5 {
    font-weight: 700;
    margin-bottom: 4px;
}

.risk-card small {
    opacity: 0.85;
}

.risk-card.danger {
    background: rgba(239, 68, 68, 0.12);
    color: #ef4444;
}

.risk-card.warning {
    background: rgba(245, 158, 11, 0.12);
    color: #f59e0b;
}

.risk-card.success {
    background: rgba(16, 185, 129, 0.12);
    color: #10b981;
}

</style>

{{-- ================= AI POWERED PREDICTIONS ================= --}}
<div class="d-flex align-items-center gap-2 mb-4">
    <i class="bi bi-graph-up-arrow text-teal"></i>
    <h6 class="fw-semibold mb-0">AI-Powered Predictions</h6>
</div>

{{-- ================= ENROLLMENT FORECAST ================= --}}
<div class="glass-card mb-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-semibold mb-0">Enrollment Forecast</h6>

        <span class="badge bg-info bg-opacity-10 text-info rounded-pill">
            AI Confidence: 82%
        </span>
    </div>

    {{-- Forecast placeholder --}}
    <div class="text-center py-5 text-muted">
        <i class="bi bi-graph-up fs-2 text-success mb-2"></i>
        <p class="small mb-1">Advanced forecasting chart would be implemented here</p>
        <strong class="text-success">Predicted Q4 2024: 3410 students</strong>
    </div>

    {{-- Quarter predictions --}}
    <div class="row g-3 mt-2">

        @php
            $quarters = [
                ['q'=>'Q1 2024','value'=>2950,'confidence'=>'87.5%'],
                ['q'=>'Q2 2024','value'=>3120,'confidence'=>'82.3%'],
                ['q'=>'Q3 2024','value'=>3285,'confidence'=>'76.8%'],
                ['q'=>'Q4 2024','value'=>3410,'confidence'=>'71.2%'],
            ];
        @endphp

        @foreach($quarters as $q)
            <div class="col-md-3 col-6">
                <div class="glass-card text-center">
                    <small class="text-teal">{{ $q['q'] }}</small>
                    <h6 class="fw-semibold mt-1">{{ $q['value'] }}</h6>
                    <small class="text-muted">{{ $q['confidence'] }}</small>
                </div>
            </div>
        @endforeach

    </div>
</div>

{{-- ================= STUDENT RETENTION RISK ================= --}}
<div class="glass-card mb-4">

    <h6 class="fw-semibold mb-3">Student Retention Risk Analysis</h6>

    <div class="row g-3 mb-3">

        <div class="col-md-4">
            <div class="risk-card danger">
                <h5>127</h5>
                <small>High Risk</small>
            </div>
        </div>

        <div class="col-md-4">
            <div class="risk-card warning">
                <h5>234</h5>
                <small>Medium Risk</small>
            </div>
        </div>

        <div class="col-md-4">
            <div class="risk-card success">
                <h5>2486</h5>
                <small>Low Risk</small>
            </div>
        </div>

    </div>

    <div class="glass-subtle">
        <strong class="small text-teal">Key Risk Factors:</strong>
        <ul class="small mb-0 mt-2">
            <li>Academic Performance</li>
            <li>Financial Status</li>
            <li>Engagement Level</li>
        </ul>
    </div>

</div>

{{-- ================= FACULTY WORKLOAD ================= --}}
<div class="glass-card">

    <h6 class="fw-semibold mb-3">Faculty Workload Prediction</h6>

    <div class="row g-3 mb-3">

        <div class="col-md-4">
            <div class="risk-card danger">
                <h5>12</h5>
                <small>Overloaded</small>
            </div>
        </div>

        <div class="col-md-4">
            <div class="risk-card success">
                <h5>132</h5>
                <small>Balanced</small>
            </div>
        </div>

        <div class="col-md-4">
            <div class="risk-card warning">
                <h5>12</h5>
                <small>Underutilized</small>
            </div>
        </div>

    </div>

    <div class="glass-subtle d-flex align-items-center gap-2 text-success small">
        <i class="bi bi-check-circle"></i>
        AI suggests redistributing 3 courses to optimize faculty workload and improve efficiency
    </div>

</div>
