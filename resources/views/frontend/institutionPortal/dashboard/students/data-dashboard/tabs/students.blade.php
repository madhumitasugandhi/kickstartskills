<style>
    /* ===============================
   STUDENT CARD – IMAGE 1 FIX
================================ */

/* Absolute kebab positioning */
.student-actions-absolute {
    position: absolute;
    top: 50%;
    right: 18px;
    transform: translateY(-50%);
}

/* Bottom-right meta */
.student-last-active {
    position: absolute;
    bottom: 16px;
    right: 18px;
    font-size: 0.75rem;
}

/* Metrics grid (even spread) */
.student-metrics {
    display: grid;
    grid-template-columns: repeat(6, minmax(0, 1fr));
    gap: 24px;
    margin-top: 18px;
}

.student-metrics span {
    text-align: left;
    font-size: 0.8rem;
}

.student-metrics strong {
    display: block;
    font-size: 1rem;
    margin-top: 2px;
}

/* Responsive */
@media (max-width: 992px) {
    .student-metrics {
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }
}

@media (max-width: 576px) {
    .student-metrics {
        grid-template-columns: repeat(2, 1fr);
    }

    .student-actions-absolute {
        top: 18px;
        transform: none;
    }
}

</style>

<h6 class="mb-3">Students (5)</h6>

<div class="glass-card drive-card mb-3 position-relative">

    {{-- TOP ROW --}}
    <div class="d-flex justify-content-between align-items-start">

        {{-- LEFT --}}
        <div class="drive-left">

            <div class="drive-header">
                <div class="company-avatar">EB</div>

                <div>
                    <h6 class="mb-0 fw-semibold">
                        Emma Brown
                        <span class="status-pill active ms-2">Active</span>
                    </h6>

                    <small class="d-block">
                        INS-MC-2024-089
                    </small>

                    <small class="">
                        MCA • Semester 3
                    </small>
                </div>
            </div>

            {{-- METRICS --}}
            <div class="student-metrics mt-3">
            <span>CGPA<br><strong class="text-success">8.90</strong></span>
                <span>Attendance<br><strong>94.1%</strong></span>
                <span>Backlogs<br><strong>0</strong></span>
                <span>Projects<br><strong>10</strong></span>
                <span>Certs<br><strong>3</strong></span>
                <span>Mentor<br><strong>Zhang</strong></span>
            </div>

            {{-- TAGS --}}
            <div class="skill-chips mt-3">
                <span class="skill-tag">
                    BCA Computer Applications (89.4%)
                </span>
                <span class="skill-tag highlight">
                    1 year as Junior Developer
                </span>
            </div>

        </div>


    </div>
    {{-- KEBAB MENU --}}
<div class="student-actions student-actions-absolute">
    <button class="icon-btn kebab-toggle">
        <i class="bi bi-three-dots-vertical"></i>
    </button>

    <ul class="kebab-menu">
        <li data-bs-toggle="modal" data-bs-target="#studentProfileModal">
            <i class="bi bi-person"></i> View Profile
        </li>
        <li data-bs-toggle="modal" data-bs-target="#academicDetailsModal">
            <i class="bi bi-book"></i> Academic Details
        </li>
        <li data-bs-toggle="modal" data-bs-target="#performanceModal">
            <i class="bi bi-graph-up"></i> Performance
        </li>
        <li class="danger" data-bs-toggle="modal" data-bs-target="#backgroundModal">
            <i class="bi bi-info-circle"></i> Background
        </li>
    </ul>
</div>
<small class="text-muted student-last-active">
    Last active: 2h ago
</small>

</div>
<script>
document.addEventListener('click', function (e) {

    document.querySelectorAll('.kebab-menu').forEach(menu => {
        if (!menu.contains(e.target) &&
            !menu.previousElementSibling.contains(e.target)) {
            menu.classList.remove('show');
        }
    });

    if (e.target.closest('.kebab-toggle')) {
        const menu = e.target.closest('.student-actions').querySelector('.kebab-menu');
        menu.classList.toggle('show');
    }
});
</script>
