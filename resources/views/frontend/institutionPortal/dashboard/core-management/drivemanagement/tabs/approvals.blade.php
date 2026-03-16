<h6 class="fw-semibold mb-3">Pending Approvals (1)</h6>

<div class="glass-card mb-3 drive-approval-card" data-drive-id="1">

    <!-- TOP ROW -->
    <div class="d-flex justify-content-between align-items-start mb-2">
        <div>
            <h6 class="mb-1">TechCore Solutions</h6>
            <div class="text-teal fw-medium">Software Engineer</div>
            <div class="small text-info">₹8–12 LPA</div>
        </div>

        <span class="status-pill warning">Pending Review</span>
    </div>

    <!-- DESCRIPTION -->
    <p class="small  mb-2">
        Looking for passionate software engineers to join our dynamic team
        working on cutting-edge web applications.
    </p>

    <!-- META -->
    <div class="d-flex flex-wrap gap-3 small mb-3">
        <span><i class="bi bi-people me-1"></i> 45 students eligible</span>
        <span><i class="bi bi-mortarboard me-1"></i> Min CGPA: 7</span>
        <span><i class="bi bi-calendar-event me-1"></i> Deadline: 15/12/2024</span>
    </div>

    <!-- ACTIONS -->
    <div class="d-flex gap-2">
        <button class="btn btn-success btn-sm approve-btn">
            <i class="bi bi-check-lg me-1"></i> Approve
        </button>

        <button class="btn btn-danger btn-sm block-btn">
            <i class="bi bi-x-lg me-1"></i> Block
        </button>

        <button class="btn btn-outline-info btn-sm details-btn">
            <i class="bi bi-eye me-1"></i> Details
        </button>
    </div>

    <!-- DETAILS DRAWER (HIDDEN) -->
    <div class="approval-details mt-3 d-none">
        <div class="added-box">
            <div>
                <div class="fw-medium mb-1">Drive Details</div>
                <ul class="small mb-0">
                    <li>Location: Bangalore / Remote</li>
                    <li>Job Type: Full Time</li>
                    <li>Hiring Rounds: 3</li>
                    <li>Skills: React, Laravel, SQL</li>
                </ul>
            </div>
        </div>
    </div>

</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // APPROVE
    document.querySelectorAll('.approve-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const card = this.closest('.drive-approval-card');
            card.querySelector('.status-pill').textContent = 'Approved';
            card.querySelector('.status-pill').className = 'status-pill active';
            this.disabled = true;
            card.querySelector('.block-btn').disabled = true;
        });
    });

    // BLOCK
    document.querySelectorAll('.block-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            if (!confirm('Are you sure you want to block this drive?')) return;

            const card = this.closest('.drive-approval-card');
            card.querySelector('.status-pill').textContent = 'Blocked';
            card.querySelector('.status-pill').className = 'status-pill danger';
            card.style.opacity = '0.6';
        });
    });

    // DETAILS TOGGLE
    document.querySelectorAll('.details-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const details = this.closest('.drive-approval-card')
                                .querySelector('.approval-details');
            details.classList.toggle('d-none');
        });
    });

});
</script>
