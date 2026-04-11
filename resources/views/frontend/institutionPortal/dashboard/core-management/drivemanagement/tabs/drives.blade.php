<h6 class="fw-semibold mb-3">
    Available Drives ({{ count($approvedDrives) }})
</h6>

<div class="drive-list">

@forelse($approvedDrives as $drive)
<div class="ui-card">
    <div class="ui-split">
        <div class="ui-split-left">
            <div class="ui-card-title">{{ $drive->drive_title }}</div>
            <div class="ui-card-subtitle">{{ $drive->location }}</div>
            <div class="text-teal fw-medium">{{ $drive->drive_type }}</div>

            <p class="small mt-2">
                {{ $drive->drive_description }}
            </p>
        </div>

        <div class="ui-split-right">
            <span class="status-pill active">Approved</span>
        </div>
    </div>
</div>

@empty
<!-- EMPTY STATE -->
<div class="ui-section text-center py-5">
    <div class="stat-icon success mx-auto mb-3" style="width:60px;height:60px;">
        <i class="bi bi-briefcase fs-3"></i>
    </div>

    <h6 class="fw-semibold">No Approved Drives Yet</h6>
    <p class="small text-muted mb-0">
        Once you approve drives, they will appear here for student applications.
    </p>
</div>
@endforelse

</div>