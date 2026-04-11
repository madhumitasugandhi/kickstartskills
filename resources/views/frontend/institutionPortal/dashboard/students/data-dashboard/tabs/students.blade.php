<h6 class="mb-3">Students (5)</h6>

<div class="ui-card position-relative">

    <div class="ui-split">

        <div class="ui-split-left">

            <div class="d-flex gap-3 align-items-start">
                <div class="ui-avatar">EB</div>

                <div>
                    <h6 class="mb-0 fw-semibold">
                        Emma Brown
                        <span class="status-pill ms-2">Active</span>
                    </h6>

                    <small class="d-block ui-muted">
                        INS-MC-2024-089
                    </small>

                    <small class="ui-muted">
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
            <div class="ui-chips mt-3">
                <div class="ui-chip">
                    BCA Computer Applications (89.4%)
                </div>
                <div class="ui-chip selectable-chip active">
                    1 year as Junior Developer
                </div>
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
