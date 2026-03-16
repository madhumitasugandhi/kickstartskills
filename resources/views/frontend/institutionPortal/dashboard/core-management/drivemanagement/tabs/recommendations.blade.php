<h6 class="fw-semibold mb-3">Student Recommendations</h6>

@php
$drives = [
    [
        'company' => 'DataTech Analytics',
        'role' => 'Data Analyst',
        'eligible' => 67,
        'recommended' => 2,
        'deadline' => '10/12/2024'
    ],
    [
        'company' => 'FinanceFlow Corp',
        'role' => 'Business Analyst',
        'eligible' => 28,
        'recommended' => 1,
        'deadline' => '30/11/2024'
    ]
];
@endphp

@foreach($drives as $index => $drive)
<div class="glass-card mb-3 recommendation-card" data-drive="{{ $index }}">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-start mb-2">
        <div>
            <h6 class="mb-1">{{ $drive['company'] }}</h6>
            <div class="text-teal fw-medium">{{ $drive['role'] }}</div>
            <div class="small">
                {{ $drive['eligible'] }} eligible students
            </div>
        </div>

        <div class="text-end">
            <span class="status-pill active">
                {{ $drive['recommended'] }} recommended
            </span>
            <div class="small mt-1">
                Deadline: {{ $drive['deadline'] }}
            </div>
        </div>
    </div>

    <!-- ACTIONS -->
    <div class="d-flex gap-2 mt-2">
        <button class="btn btn-success btn-sm recommend-btn">
            <i class="bi bi-person-plus me-1"></i> Recommend Students
        </button>

        <button class="btn btn-outline-success btn-sm eligible-btn">
            <i class="bi bi-people me-1"></i> View Eligible
        </button>
    </div>

    <!-- ELIGIBLE STUDENTS PANEL -->
    <div class="eligible-panel d-none mt-3">
        <div class="added-box">
            <div class="fw-medium mb-2">Eligible Students (Preview)</div>

            <ul class="small mb-0">
                <li>Student A — CGPA 8.6</li>
                <li>Student B — CGPA 8.2</li>
                <li>Student C — CGPA 7.9</li>
            </ul>
        </div>
    </div>

</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // TOGGLE ELIGIBLE STUDENTS
    document.querySelectorAll('.eligible-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const panel = this.closest('.recommendation-card')
                              .querySelector('.eligible-panel');
            panel.classList.toggle('d-none');
        });
    });

    // RECOMMEND STUDENTS (UI ONLY)
    document.querySelectorAll('.recommend-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const card = this.closest('.recommendation-card');
            const badge = card.querySelector('.status-pill');

            let count = parseInt(badge.innerText);
            badge.innerText = (count + 1) + ' recommended';

            this.innerHTML = '<i class="bi bi-check-lg me-1"></i> Recommended';
            this.disabled = true;
        });
    });

});
</script>

@endforeach
