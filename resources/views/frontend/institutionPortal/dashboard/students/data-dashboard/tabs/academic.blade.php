<style>
    /* ===============================
   ACADEMIC ANALYTICS (IMAGE MATCH)
================================ */

/* CGPA rows */
.analytics-row {
    display: grid;
    grid-template-columns: 120px 1fr 100px;
    gap: 16px;
    align-items: center;
    margin-bottom: 14px;
    font-size: 0.8rem;
}

.analytics-label {
    color: var(--text-muted);
}

.analytics-count {
    text-align: right;
    color: var(--text-muted);
}

/* Attendance rows */
.attendance-row {
    display: grid;
    grid-template-columns: 16px 1fr auto;
    gap: 10px;
    align-items: center;
    margin-bottom: 12px;
    font-size: 0.8rem;
}

.attendance-label {
    color: var(--text-muted);
}

.attendance-count {
    color: var(--text-muted);
}

/* Dots */
.dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
}

.dot.success { background: #10b981; }
.dot.warning { background: #f59e0b; }
.dot.info    { background: #3b82f6; }
.dot.danger  { background: #ef4444; }

/* Responsive */
@media (max-width: 768px) {
    .analytics-row {
        grid-template-columns: 1fr;
        gap: 6px;
    }

    .analytics-count {
        text-align: left;
    }
}

</style>
<div class="glass-card analytics-card mb-4">

    <h6 class="fw-semibold mb-4">Academic Performance Overview</h6>

    {{-- ================= CGPA DISTRIBUTION ================= --}}
    <div class="mb-4">

        <small class="d-block mb-3">CGPA Distribution</small>

        @php
            $cgpa = [
                ['label'=>'9.0 – 10.0', 'count'=>1, 'width'=>20],
                ['label'=>'8.0 – 8.9',  'count'=>2, 'width'=>40],
                ['label'=>'7.0 – 7.9',  'count'=>1, 'width'=>20],
                ['label'=>'6.0 – 6.9',  'count'=>1, 'width'=>20],
                ['label'=>'Below 6.0',  'count'=>0, 'width'=>0],
            ];
        @endphp

        @foreach($cgpa as $row)
            <div class="analytics-row">

                <div class="analytics-label">
                    {{ $row['label'] }}
                </div>

                <div class="analytics-bar">
                    <div class="progress-track">
                        <div class="progress-fill" style="width: {{ $row['width'] }}%"></div>
                    </div>
                </div>

                <div class="analytics-count">
                    {{ $row['count'] }} students
                </div>

            </div>
        @endforeach

    </div>

    {{-- ================= ATTENDANCE ANALYSIS ================= --}}
    <div>

        <small class="d-block mb-3">Attendance Analysis</small>

        <div class="attendance-row">
            <span class="dot success"></span>
            <span class="attendance-label">90% – 100%</span>
            <span class="attendance-count">3 students</span>
        </div>

        <div class="attendance-row">
            <span class="dot warning"></span>
            <span class="attendance-label">80% – 89%</span>
            <span class="attendance-count">1 students</span>
        </div>

        <div class="attendance-row">
            <span class="dot info"></span>
            <span class="attendance-label">70% – 79%</span>
            <span class="attendance-count">1 students</span>
        </div>

        <div class="attendance-row">
            <span class="dot danger"></span>
            <span class="attendance-label">Below 70%</span>
            <span class="attendance-count">0 students</span>
        </div>

    </div>

</div>
