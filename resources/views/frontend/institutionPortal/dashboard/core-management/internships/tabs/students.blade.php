<div class="ui-card mb-4">

    <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap mb-3">
        <div class="input-group-custom flex-grow-1">
            <i class="bi bi-search"></i>
            <input class="form-control"
                   placeholder="Search students by name, program, mentor...">
        </div>

        <button class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-download"></i> Export
        </button>
    </div>

    <div class="ui-tabs">
        <button class="ui-tab active">All Phases</button>
        <button class="ui-tab">Foundation</button>
        <button class="ui-tab">Advanced Learning</button>
        <button class="ui-tab">Mini-Project</button>
        <button class="ui-tab">Client Project</button>
    </div>
</div>

<!-- ================= STUDENT LIST ================= -->
<div class="ui-card">

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
       
    ] as $s)

    <div class="ui-split">

<div class="ui-split-left">

    <div class="d-flex align-items-center gap-2">
        <div class="ui-avatar">
            {{ strtoupper(substr($s['name'],0,2)) }}
        </div>

        <div>
            <div class="ui-card-title">{{ $s['name'] }}</div>
            <div class="ui-card-subtitle">
                {{ $s['program'] }} • {{ $s['company'] }}
            </div>
        </div>
    </div>

    <div class="ui-meta">
        <span>Mentor: {{ $s['mentor'] }}</span>
        <span>Attendance: {{ $s['attendance'] }}%</span>
        <span>Last Activity: {{ $s['activity'] }}</span>
    </div>

    <div class="mt-2 small">Progress</div>
    <div class="ui-progress">
        <div class="ui-progress-fill"
             style="width: {{ $s['progress'] }}%"></div>
    </div>

    <div class="ui-chips mt-2">
        @foreach($s['skills'] as $skill)
            <span class="ui-chip">{{ $skill }}</span>
        @endforeach
    </div>

</div>

<div class="ui-split-right student-actions">

    <span class="status-pill">
        {{ $s['status'] }}
    </span>

    <button class="icon-btn kebab-btn">
        <i class="bi bi-three-dots-vertical"></i>
    </button>

    <ul class="kebab-menu">
        <li>View Progress</li>
        <li>Assign Mentor</li>
        <li>Add Feedback</li>
        <li class="danger">Generate Certificate</li>
    </ul>

    <div class="small mt-2">
        Day {{ $s['day'] }}
    </div>

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

