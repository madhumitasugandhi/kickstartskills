<div class="glass-card mb-4">

    <!-- SEARCH + FILTER -->
    <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap mb-3">
        <div class="input-group-custom flex-grow-1">
            <i class="bi bi-search"></i>
            <input class="form-control ps-5"
                   placeholder="Search students by name, program, mentor...">
        </div>

        <button class="btn btn-outline-success btn-sm">
            <i class="bi bi-download"></i> Export
        </button>
    </div>

    <!-- PHASE FILTERS -->
    <div class="d-flex gap-2 flex-wrap">
        <button class="tab-btn active">✓ All Phases</button>
        <button class="tab-btn">Foundation</button>
        <button class="tab-btn">Advanced Learning</button>
        <button class="tab-btn">Mini-Project</button>
        <button class="tab-btn">Client Project</button>
    </div>
</div>

<!-- ================= STUDENT LIST ================= -->
<div class="drive-list">

    {{-- STUDENT CARD --}}
    @foreach([
        [
            'name'=>'Rahul Sharma',
            'program'=>'Full Stack Development',
            'company'=>'TechCorp Solutions',
            'mentor'=>'Sarah Johnson',
            'phase'=>'Client Project Phase',
            'status'=>'On Track',
            'day'=>'95/120',
            'progress'=>79.2,
            'attendance'=>94.5,
            'activity'=>'2 hours ago',
            'skills'=>['React','Node.js','JavaScript']
        ],
        [
            'name'=>'Priya Patel',
            'program'=>'Data Science & Analytics',
            'company'=>'DataMind Analytics',
            'mentor'=>'Michael Chen',
            'phase'=>'Advanced Learning Phase',
            'status'=>'Excellent',
            'day'=>'45/120',
            'progress'=>37.5,
            'attendance'=>98.2,
            'activity'=>'1 hour ago',
            'skills'=>['Python','Machine Learning','SQL']
        ]
    ] as $s)

    <div class="drive-card drive-approval-card">

        <!-- LEFT -->
        <div class="drive-left">

            <div class="drive-header">
                <div class="company-avatar">
                    {{ strtoupper(substr($s['name'],0,2)) }}
                </div>

                <div>
                    <h6 class="mb-1">{{ $s['name'] }}</h6>
                    <small class="">
                        {{ $s['program'] }} <br>
                        {{ $s['company'] }} • Mentor: {{ $s['mentor'] }}
                    </small>
                </div>
            </div>

            <span class="package-badge">
                {{ $s['phase'] }}
            </span>

            <div class="mt-3 small ">
                Overall Progress
            </div>

            <div class="progress-track mt-1">
                <div class="progress-fill"
                     style="width: {{ $s['progress'] }}%">
                </div>
            </div>

            <div class="d-flex gap-4 mt-3 small ">
                <span>Attendance: <b>{{ $s['attendance'] }}%</b></span>
                <span>Last Activity: {{ $s['activity'] }}</span>
            </div>

            <div class="skill-chips mt-3">
                @foreach($s['skills'] as $skill)
                    <span class="skill-chip">{{ $skill }}</span>
                @endforeach
            </div>
        </div>

        <div class="drive-right">

    <!-- STATUS + KEBAB (INLINE) -->
    <div class="d-flex align-items-center gap-2">

        <span class="status-pill {{ $s['status']==='Excellent' ? 'active' : 'warning' }}">
            {{ $s['status'] }}
        </span>

        <div class="student-actions">
            <button class="icon-btn kebab-btn">
                <i class="bi bi-three-dots-vertical"></i>
            </button>

            <ul class="kebab-menu">
                <li><i class="bi bi-graph-up"></i> View Progress</li>
                <li><i class="bi bi-person-plus"></i> Assign Mentor</li>
                <li><i class="bi bi-chat-left-text"></i> Add Feedback</li>
                <li class="danger">
                    <i class="bi bi-award"></i> Generate Certificate
                </li>
            </ul>
        </div>

    </div>

    <!-- DAY INFO -->
    <div class="small mt-2">
        Day {{ $s['day'] }}
    </div>

</div>

    </div>

    @endforeach
</div>
<script>
document.addEventListener('click', function (e) {

    // Close all open menus
    document.querySelectorAll('.kebab-menu')
        .forEach(menu => menu.classList.remove('show'));

    // Check if kebab button was clicked
    const btn = e.target.closest('.kebab-btn');
    if (!btn) return;

    e.stopPropagation();

    // Toggle current menu
    btn.nextElementSibling?.classList.toggle('show');
});

// Prevent menu click from closing itself
document.querySelectorAll('.kebab-menu').forEach(menu => {
    menu.addEventListener('click', e => e.stopPropagation());
});
</script>

