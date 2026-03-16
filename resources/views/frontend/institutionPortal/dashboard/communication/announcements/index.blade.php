@extends('frontend.institutionPortal.layout.app')

@section('page_title', 'Announcements')
@section('title', 'Announcements')

@section('content')
<div class="container-fluid p-3 p-md-5">

    <!-- ================= HEADER ================= -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 fw-bold mb-1">Announcements</h1>
            <p class="mb-0">
                Create, manage, and publish institutional announcements
            </p>
        </div>

        <button class="btn btn-teal"
                data-bs-toggle="modal"
                data-bs-target="#createAnnouncementModal">
            <i class="bi bi-plus-lg me-2"></i> New Announcement
        </button>
    </div>

    <!-- ================= SEARCH & FILTERS ================= -->
    <div class="glass-card p-4 mb-4">

<div class="input-group-custom mb-3">
    <i class="bi bi-search"></i>
    <input type="text"
           class="form-control"
           placeholder="Search announcements...">
</div>

<div class="row g-3 align-items-end">
    <div class="col-md-4">
        <label class="form-label small text-muted">Priority</label>
        <select class="form-select">
            <option>All Priorities</option>
            <option>High</option>
            <option>Medium</option>
            <option>Low</option>
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label small text-muted">Status</label>
        <select class="form-select">
            <option>All Status</option>
            <option>Published</option>
            <option>Draft</option>
            <option>Scheduled</option>
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label small text-muted">Audience</label>
        <select class="form-select">
            <option>All Audiences</option>
            <option>Students</option>
            <option>Faculty</option>
            <option>Staff</option>
        </select>
    </div>

    <div class="col-md-1">
        <button class="btn btn-teal w-100">
            <i class="bi bi-arrow-repeat"></i>
        </button>
    </div>
</div>

</div>


    <!-- ================= STATISTICS ================= -->
    <h6 class="fw-semibold mb-3">Announcement Statistics</h6>

    <div class="row g-3 mb-5">
        @php
            $stats = [
                ['label' => 'Total', 'value' => 6, 'icon' => 'bi-megaphone', 'color' => '#3b82f6'],
                ['label' => 'Published', 'value' => 4, 'icon' => 'bi-check-circle', 'color' => '#10b981'],
                ['label' => 'Drafts', 'value' => 1, 'icon' => 'bi-pencil', 'color' => '#f59e0b'],
                ['label' => 'Scheduled', 'value' => 1, 'icon' => 'bi-clock', 'color' => '#6366f1'],
                ['label' => 'Pinned', 'value' => 2, 'icon' => 'bi-star', 'color' => '#f97316'],
                ['label' => 'Views', 'value' => 4158, 'icon' => 'bi-eye', 'color' => '#22c55e'],
                ['label' => 'Comments', 'value' => 46, 'icon' => 'bi-chat', 'color' => '#06b6d4'],
                ['label' => 'Categories', 'value' => 6, 'icon' => 'bi-grid', 'color' => '#8b5cf6'],
            ];
        @endphp

<div class="row g-3 mb-5">
    @foreach($stats as $stat)
    <div class="col-12 col-md-6 col-xl-3">
        <div class="glass-card p-4 position-relative">

            <div class="stat-icon mb-3">
                <i class="bi {{ $stat['icon'] }}"></i>
            </div>

            <h4 class="fw-bold mb-1">{{ $stat['value'] }}</h4>
            <small class="text-muted">{{ $stat['label'] }}</small>

            <i class="bi bi-graph-up-right position-absolute top-0 end-0 m-3 text-teal"></i>
        </div>
    </div>
    @endforeach
</div>

    </div>

    <!-- ================= LIST HEADER ================= -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-semibold mb-0">Announcements (6)</h6>
        <a href="#" class="small text-info">Bulk Actions</a>
    </div>

    <!-- ================= ANNOUNCEMENT CARD ================= -->
    <div class="announcement-card d-flex justify-content-between gap-4 mb-4">

    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <i class="bi bi-star-fill text-warning"></i>
            <h6 class="fw-semibold mb-0">
                Academic Year 2024–25 Registration Open
            </h6>
        </div>

        <p class="text-muted mb-2">
            Registration for Academic Year 2024–25 is now open. Complete your enrollment
            through the registration portal.
        </p>

        <div class="announcement-meta">
            <span class="announcement-tag">Category: Academic</span>
            <span class="announcement-tag">Author: Academic Office</span>
            <span class="announcement-tag">Attachments: 2</span>
            <span class="announcement-tag">Audience: Students, Faculty</span>
        </div>

        <small class="text-muted">
            <i class="bi bi-calendar"></i> 28/06/2024 &nbsp; • &nbsp;
            <i class="bi bi-eye"></i> 1247 views &nbsp; • &nbsp;
            <i class="bi bi-chat"></i> 23 comments
        </small>
    </div>

    <div class="text-end">
        <span class="announcement-status priority-high">High</span>
        <span class="announcement-status status-published ms-2">Published</span>
        <button class="btn btn-link ms-2">
            <i class="bi bi-three-dots-vertical"></i>
        </button>
    </div>

</div>


</div>

{{-- ================= MODALS ================= --}}
@include('frontend.institutionPortal.dashboard.communication.announcements.modals.create')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        console.log('Announcements module loaded');
    });
</script>



@endsection
