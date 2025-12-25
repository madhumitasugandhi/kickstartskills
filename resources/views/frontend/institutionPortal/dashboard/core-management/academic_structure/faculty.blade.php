<div class="glass-card mb-4">

    <!-- ================= SEARCH & ACTION ================= -->
    <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap">

        <div class="input-group-custom flex-grow-1">
            <i class="bi bi-search"></i>
            <input type="text"
                   class="form-control ps-5"
                   placeholder="Search faculty...">
        </div>

        <button class="btn btn-teal btn-sm">
            <i class="bi bi-plus-lg me-1"></i>
            Add Faculty
        </button>
    </div>

</div>

<!-- ================= FACULTY LIST ================= -->
<div class="d-flex flex-column gap-3">

@php
    $faculty = [
        [
            'name' => 'Dr. Rajesh Kumar',
            'initials' => 'DR',
            'designation' => 'Professor & HOD',
            'department' => 'Computer Science & Engineering',
            'experience' => 15,
            'publications' => 45,
            'projects' => 8,
            'specialization' => 'Machine Learning, Data Mining, AI',
            'subjects' => ['Machine Learning', 'Data Mining', 'Artificial Intelligence'],
            'color' => 'info'
        ],
        [
            'name' => 'Dr. Priya Sharma',
            'initials' => 'DP',
            'designation' => 'Associate Professor & HOD',
            'department' => 'Electronics & Communication',
            'experience' => 12,
            'publications' => 32,
            'projects' => 6,
            'specialization' => 'VLSI Design, Signal Processing',
            'subjects' => ['VLSI Design', 'Digital Signal Processing', 'Communication Systems'],
            'color' => 'success'
        ],
    ];
@endphp

@foreach($faculty as $f)

    <div class="configured-item p-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-start mb-3">

            <div class="d-flex gap-3">
                <!-- AVATAR -->
                <div class="stat-icon {{ $f['color'] }}">
                    {{ $f['initials'] }}
                </div>

                <!-- BASIC INFO -->
                <div>
                    <h6 class="mb-1">{{ $f['name'] }}</h6>
                    <div class="small text-teal fw-medium">
                        {{ $f['designation'] }}
                    </div>
                    <div class="small">
                        {{ $f['department'] }}
                    </div>
                </div>
            </div>

            <!-- ACTION -->
            <button class="icon-btn">
                <i class="bi bi-three-dots-vertical"></i>
            </button>
        </div>

        <!-- METRICS -->
        <div class="meta-row mb-2">
            <span><i class="bi bi-clock-history"></i> Experience {{ $f['experience'] }} years</span>
            <span><i class="bi bi-journal-text"></i> Publications {{ $f['publications'] }}</span>
            <span><i class="bi bi-kanban"></i> Projects {{ $f['projects'] }}</span>
            <span>
                <i class="bi bi-stars"></i>
                Specialization {{ $f['specialization'] }}
            </span>
        </div>

        <!-- SUBJECTS -->
        <div class="small mb-1">Teaching Subjects</div>

        <div class="chip-container">
            @foreach($f['subjects'] as $subject)
                <span class="chip-item">
                    <span>{{ $subject }}</span>
                </span>
            @endforeach
        </div>

    </div>

@endforeach

</div>
