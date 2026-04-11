<h6 class="fw-semibold mb-3">
    Pending Approvals ({{ count($pendingDrives) }})
</h6>

@forelse($pendingDrives as $drive)
<div class="ui-section mb-3 drive-approval-card">

    <div class="d-flex justify-content-between align-items-start mb-2">
        <div>
            <h4 class="mb-1 fw-medium">{{ $drive->drive_title }}</h4>
            <div class="ui-card-subtitle">{{ $drive->location }}</div>
            <div class="text-teal">{{ $drive->drive_type }}</div>
        </div>

        <span class="status-pill warning">Pending Review</span>
    </div>

    <p class="small mb-2">
        {{ $drive->drive_description }}
    </p>

    <div class="d-flex gap-2">
        
            <button class="btn btn-success btn-sm open-approve-modal"
        data-drive="{{ $drive->drive_id }}"
        data-approval="{{ $drive->approval_id }}">
    Approve
</button>

        <form method="POST" action="{{ route('institution.core.drive-management.reject',$drive->approval_id) }}">
            @csrf
            <button class="btn btn-danger btn-sm">
                Block
            </button>
        </form>
    </div>

</div>

@empty
<!-- EMPTY STATE -->
<div class="ui-section text-center py-5">
    <div class="stat-icon info mx-auto mb-3" style="width:60px;height:60px;">
        <i class="bi bi-inbox fs-3"></i>
    </div>

    <h6 class="fw-semibold">No Pending Drive Approvals</h6>
    <p class="small text-muted mb-0">
        All drive approval requests have been reviewed.
    </p>
</div>
@endforelse

<div class="modal fade" id="approveDriveModal" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">
    <input type="hidden" name="drive_id" id="modalDriveId">
        <div class="modal-content glass-modal">

            <div class="modal-header">
                <h6 class="modal-title">Select Students for Drive</h6>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" id="approveDriveForm">
                @csrf

                <div class="modal-body">

    <!-- Exam Date -->
    <div class="mb-2">
        <label class="small">Exam Date</label>
        <input type="date" name="exam_date" class="form-control" required>
    </div>

    <!-- Start Time -->
    <div class="mb-2">
        <label class="small">Start Time</label>
        <input type="time" name="start_time" class="form-control" required>
    </div>

    <!-- End Time -->
    <div class="mb-2">
        <label class="small">End Time</label>
        <input type="time" name="end_time" class="form-control" required>
    </div>

    <!-- Duration -->
    <div class="mb-3">
        <label class="small">Duration (minutes)</label>
        <input type="number" name="duration" class="form-control" placeholder="60">
    </div>

    <hr>

    <div class="mb-2">
        <input type="checkbox" id="selectAllStudents">
        <label>Select All Students</label>
    </div>

    <div class="student-list" style="max-height:300px;overflow:auto;">
        @foreach($students as $student)
        <div class="form-check">
            <input class="form-check-input student-checkbox"
                   type="checkbox"
                   name="students[]"
                   value="{{ $student->id }}">
            <label class="form-check-label">
                {{ $student->full_name }}
            </label>
        </div>
        @endforeach
    </div>

</div>

                <div class="modal-footer">
                    <button class="btn btn-success">Approve Drive</button>
                </div>

            </form>

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

document.addEventListener('DOMContentLoaded', function () {

    const modal = new bootstrap.Modal(document.getElementById('approveDriveModal'));

    document.querySelectorAll('.open-approve-modal').forEach(btn => {
    btn.addEventListener('click', function () {
        const approvalId = this.dataset.approval;
        const driveId = this.dataset.drive;

        document.getElementById('approveDriveForm')
            .action = "/institution/core-management/drive-management/approve/" + approvalId;

        document.getElementById('modalDriveId').value = driveId;

        modal.show();
    });
});

    // Select All
    document.getElementById('selectAllStudents').addEventListener('change', function () {
        document.querySelectorAll('.student-checkbox').forEach(cb => {
            cb.checked = this.checked;
        });
    });

});
</script>
