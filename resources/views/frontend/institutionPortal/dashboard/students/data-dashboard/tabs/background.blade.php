<style>
    /* ===============================
   BACKGROUND ANALYTICS
================================ */

.background-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
    font-size: 0.8rem;
}

.background-left {
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--text-muted);
}

.background-count {
    color: var(--text-muted);
}

/* Reuse dot colors */
.dot.success { background: #10b981; }
.dot.warning { background: #f59e0b; }
.dot.info    { background: #3b82f6; }
.dot.danger  { background: #ef4444; }

</style>
<div class="glass-card analytics-card mb-4">

    <h6 class="fw-semibold mb-4">Student Background Analysis</h6>

    {{-- ================= EDUCATIONAL BACKGROUND ================= --}}
    <div class="mb-4">

        <small class="d-block mb-3">
            Educational Background Distribution
        </small>

        @php
            $education = [
                '12th Science – CBSE' => 1,
                'B.Tech Information Technology' => 1,
                'B.Com Commerce' => 1,
                '12th Science – State Board' => 1,
                'BCA Computer Applications' => 1,
            ];
        @endphp

        @foreach($education as $label => $count)
            <div class="background-row">
                <div class="background-left">
                    <span class="dot success"></span>
                    <span>{{ $label }}</span>
                </div>
                <div class="background-count">
                    {{ $count }} students
                </div>
            </div>
        @endforeach

    </div>

    {{-- ================= WORK EXPERIENCE ================= --}}
    <div class="mb-4">

        <small class="d-block mb-3">
            Work Experience Analysis
        </small>

        @php
            $experience = [
                ['label'=>'None', 'count'=>2, 'color'=>'info'],
                ['label'=>'0–2 years', 'count'=>2, 'color'=>'warning'],
                ['label'=>'2–4 years', 'count'=>1, 'color'=>'success'],
                ['label'=>'4+ years', 'count'=>0, 'color'=>'danger'],
            ];
        @endphp

        @foreach($experience as $exp)
            <div class="background-row">
                <div class="background-left">
                    <span class="dot {{ $exp['color'] }}"></span>
                    <span>{{ $exp['label'] }}</span>
                </div>
                <div class="background-count">
                    {{ $exp['count'] }} students
                </div>
            </div>
        @endforeach

    </div>

    {{-- ================= LOCATION DISTRIBUTION ================= --}}
    <div>

        <small class="d-block mb-3">
            Location Distribution
        </small>

        @php
            $locations = [
                ['label'=>'Urban', 'count'=>3, 'width'=>60],
                ['label'=>'Semi-Urban', 'count'=>1, 'width'=>20],
                ['label'=>'Rural', 'count'=>1, 'width'=>20],
            ];
        @endphp

        @foreach($locations as $loc)
            <div class="analytics-row mb-3">

                <div class="analytics-label">
                    {{ $loc['label'] }}
                </div>

                <div class="analytics-bar">
                    <div class="progress-track">
                        <div class="progress-fill"
                             style="width: {{$loc['width']}}%">
                        </div>
                    </div>
                </div>

                <div class="analytics-count">
                    {{ $loc['count'] }} students
                </div>

            </div>
        @endforeach

    </div>

</div>
