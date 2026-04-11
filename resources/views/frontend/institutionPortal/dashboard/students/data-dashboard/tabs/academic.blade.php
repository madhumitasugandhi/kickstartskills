<div class="ui-card ui-analytics-card mb-4">

    <div class="ui-card-header">
        <div>
            <div class="ui-card-title">Academic Performance Overview</div>
            <div class="ui-card-subtitle">CGPA & Attendance Distribution</div>
        </div>
    </div>

    {{-- ================= CGPA DISTRIBUTION ================= --}}
    <div class="ui-section">

        <div class="ui-section-title">CGPA Distribution</div>

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
    <div class="ui-section">

        <div class="ui-section-title">Attendance Analysis</div>

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