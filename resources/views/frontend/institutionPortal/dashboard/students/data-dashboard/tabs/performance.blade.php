<div class="ui-card ui-analytics-card mb-4">

    <div class="ui-card-header">
        <div>
            <div class="ui-card-title">Performance Analytics</div>
            <div class="ui-card-subtitle">Top performers & course averages</div>
        </div>
    </div>

    {{-- ================= TOP PERFORMERS ================= --}}
    <div class="ui-section">

        <div class="ui-section-title">
            Top Performers by CGPA
        </div>

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
                        <span class="dot success"></span>
                        <div>
                            <div class="fw-semibold small">{{ $p['name'] }}</div>
                            <div class="small text-muted">{{ $p['program'] }}</div>
                        </div>
                    </div>

                    <div class="ui-badge">
                        CGPA: {{ number_format($p['cgpa'], 2) }}
                    </div>

                </div>
            @endforeach

        </div>

    </div>

    {{-- ================= AVERAGE PERFORMANCE ================= --}}
    <div class="ui-section">

        <div class="ui-section-title">
            Average Performance by Course
        </div>

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