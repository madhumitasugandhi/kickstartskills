<style>
    /* ===============================
   PERFORMANCE ANALYTICS UI
================================ */

/* Top performers list */
.top-performers {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.performer-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.performer-left {
    display: flex;
    align-items: center;
    gap: 10px;
}

.performer-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--primary-teal);
}

.performer-right {
    font-size: 0.8rem;
    color: var(--primary-teal);
}

/* Slight divider spacing */
.analytics-row {
    padding-bottom: 6px;
}

</style>
<div class="glass-card analytics-card mb-4">

    <h6 class="fw-semibold mb-4">Performance Analytics</h6>

    {{-- ================= TOP PERFORMERS ================= --}}
    <div class="mb-4">

        <small class="d-block mb-3">
            Top Performers by CGPA
        </small>

        <div class="top-performers">

            @php
                $performers = [
                    ['name'=>'Clara Davis', 'program'=>'MBA Marketing', 'cgpa'=>9.1],
                    ['name'=>'Emma Brown', 'program'=>'MCA', 'cgpa'=>8.9],
                    ['name'=>'Alice Johnson', 'program'=>'B.Tech Computer Science', 'cgpa'=>8.7],
                    ['name'=>'Bob Smith', 'program'=>'M.Tech Data Science', 'cgpa'=>7.8],
                ];
            @endphp

            @foreach($performers as $p)
                <div class="performer-row">

                    <div class="performer-left">
                        <span class="performer-dot"></span>
                        <div>
                            <div class="fw-semibold small">{{ $p['name'] }}</div>
                            <div class="small">{{ $p['program'] }}</div>
                        </div>
                    </div>

                    <div class="performer-right">
                        CGPA: {{ number_format($p['cgpa'], 2) }}
                    </div>

                </div>
            @endforeach

        </div>

    </div>

    {{-- ================= AVERAGE PERFORMANCE ================= --}}
    <div>

        <small class="d-block mb-3">
            Average Performance by Course
        </small>

        @php
            $courses = [
                ['name'=>'B.Tech Computer Science', 'cgpa'=>8.7, 'attendance'=>92.5],
                ['name'=>'M.Tech Data Science', 'cgpa'=>7.8, 'attendance'=>88.3],
                ['name'=>'MBA Marketing', 'cgpa'=>9.1, 'attendance'=>96.7],
                ['name'=>'B.Tech Mechanical Engineering', 'cgpa'=>8.5, 'attendance'=>75.2],
                ['name'=>'MCA', 'cgpa'=>8.9, 'attendance'=>94.1],
            ];
        @endphp

        @foreach($courses as $course)
            <div class="analytics-row mb-3">

                <div class="analytics-label">
                    {{ $course['name'] }}
                    <div class="small text-muted">
                        Avg CGPA: {{ number_format($course['cgpa'], 2) }}
                    </div>
                </div>

                <div class="analytics-bar">
                    <div class="progress-track">
                        <div class="progress-fill"
                             style="width: {{ $course['attendance'] }}%">
                        </div>
                    </div>
                </div>

                <div class="analytics-count">
                    Avg Attendance: {{ number_format($course['attendance'], 1) }}%
                </div>

            </div>
        @endforeach

    </div>

</div>
