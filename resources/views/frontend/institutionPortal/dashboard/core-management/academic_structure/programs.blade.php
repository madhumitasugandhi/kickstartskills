<div class="glass-card mb-4">

    <!-- ================= SEARCH & FILTER ================= -->
    <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap">

        <div class="input-group-custom flex-grow-1">
            <i class="bi bi-search"></i>
            <input type="text"
                   class="form-control ps-5"
                   placeholder="Search programs...">
        </div>

        <button class="btn btn-teal btn-sm">
            <i class="bi bi-plus-lg me-1"></i>
            Create Program
        </button>
    </div>

    <!-- FILTER CHIPS -->
    <div class="chip-container mt-3">
        <span class="chip-item accreditation-chip active">
            <span>All Departments</span>
        </span>
        <span class="chip-item accreditation-chip">
            <span>Computer Science</span>
        </span>
        <span class="chip-item accreditation-chip">
            <span>Business Admin</span>
        </span>
    </div>

</div>

<!-- ================= PROGRAM LIST ================= -->
<div class="d-flex flex-column gap-3">

    @php
        $programs = [
            [
                'title' => 'Bachelor of Technology - Computer Science',
                'dept' => 'Computer Science & Engineering',
                'duration' => '4 Years',
                'level' => 'Undergraduate',
                'coordinator' => 'Dr. Vijay Singh',
                'students' => 320,
                'intake' => 120,
                'semesters' => 8,
                'credits' => 180,
                'color' => 'info'
            ],
            [
                'title' => 'Master of Business Administration',
                'dept' => 'Business Administration',
                'duration' => '2 Years',
                'level' => 'Postgraduate',
                'coordinator' => 'Dr. Meera Joshi',
                'students' => 180,
                'intake' => 60,
                'semesters' => 4,
                'credits' => 120,
                'color' => 'success'
            ],
        ];
    @endphp

    @foreach($programs as $program)
        @php
            $percent = round(($program['students'] / $program['intake']) * 100, 1);
        @endphp

        <div class="configured-item p-4">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-start mb-3">

                <div class="d-flex gap-3">
                    <div class="stat-icon {{ $program['color'] }}">
                        <i class="bi bi-book"></i>
                    </div>

                    <div>
                        <h6 class="mb-1">{{ $program['title'] }}</h6>
                        <small class="">
                            {{ $program['dept'] }} • {{ $program['duration'] }} • {{ $program['level'] }}
                        </small>
                        <div class="small  mt-1">
                            Coordinator: {{ $program['coordinator'] }}
                        </div>
                    </div>
                </div>

                <button class="icon-btn">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
            </div>

            <!-- METRICS -->
            <div class="meta-row mb-2">
                <span><i class="bi bi-people"></i> Current Students {{ $program['students'] }}</span>
                <span><i class="bi bi-person-plus"></i> Max Intake {{ $program['intake'] }}</span>
                <span><i class="bi bi-stack"></i> Semesters {{ $program['semesters'] }}</span>
                <span><i class="bi bi-award"></i> Credits {{ $program['credits'] }}</span>
            </div>

            <!-- PROGRESS -->
            <div class="small  mb-1 d-flex justify-content-between">
                <span>Enrollment Progress</span>
                <span class="text-teal">
                    {{ $program['students'] }}/{{ $program['intake'] }} ({{ $percent }}%)
                </span>
            </div>

            <div class="progress-track">
                <div class="progress-fill"
                     style="width: {{ min($percent, 100) }}%"></div>
            </div>

        </div>
    @endforeach

</div>
