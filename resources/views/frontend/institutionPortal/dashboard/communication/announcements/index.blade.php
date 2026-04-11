@extends('frontend.institutionPortal.layout.app')

@section('page_title', 'Announcements')
@section('title', 'Announcements')

@section('content')
<div class="container-fluid p-3 p-md-5">

    <!-- ================= HEADER ================= -->
    <div class="ui-page-header d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex gap-3 align-items-center">
        <div class="ui-icon-box">
            <i class="bi bi-megaphone"></i>
        </div>
        <div>
            <h5 class="mb-0">Announcements</h5>
            <small class="ui-muted">
                Create, manage, and publish institutional announcements
            </small>
        </div>
    </div>

    <button class="btn btn-teal"
            data-bs-toggle="modal"
            data-bs-target="#createAnnouncementModal">
        <i class="bi bi-plus-lg me-2"></i> New Announcement
    </button>
</div>

    <!-- ================= SEARCH & FILTERS ================= -->
    <div class="ui-card mb-4">
<div class="input-group-custom mb-3">
    <i class="bi bi-search"></i>
    <input type="text"
           class="form-control"
           placeholder="Search announcements...">
</div>

<div class="row g-3 align-items-end">
    <div class="col-md-4">
        <label class="ui-label">Priority</label>
        <select class="form-select">
            <option>All Priorities</option>
            <option>High</option>
            <option>Medium</option>
            <option>Low</option>
        </select>
    </div>

    <div class="col-md-4">
        <label class="ui-label">Status</label>
        <select class="form-select">
            <option>All Status</option>
            <option>Published</option>
            <option>Draft</option>
            <option>Scheduled</option>
        </select>
    </div>

    <div class="col-md-3">
        <label class="ui-label">Audience</label>
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
    <div class="ui-stats-card">
        <div class="stats-icon">
            <i class="bi {{ $stat['icon'] }}"></i>
        </div>
        <div>
            <h4>{{ $stat['value'] }}</h4>
            <small class="ui-muted">{{ $stat['label'] }}</small>
        </div>
    </div>
</div>
@endforeach
</div>

    </div>

    <!-- ================= LIST HEADER ================= -->
    <div class="d-flex justify-content-between align-items-center mb-3">
    <div class="ui-card-title">Announcements (6)</div>
    <a href="#" class="ui-link">Bulk Actions</a>
</div>

    <!-- ================= ANNOUNCEMENT CARD ================= -->
    <div class="ui-announcement-card">

    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <i class="bi bi-star-fill text-warning"></i>
            <div class="ui-card-title">
                Academic Year 2024–25 Registration Open
            </div>
        </div>

        <div class="ui-card-subtitle">
            Registration for Academic Year 2024–25 is now open. Complete your enrollment
            through the registration portal.
        </div>

        <div class="ui-announcement-meta">
            <span class="ui-announcement-tag">Category: Academic</span>
            <span class="ui-announcement-tag">Author: Academic Office</span>
            <span class="ui-announcement-tag">Attachments: 2</span>
            <span class="ui-announcement-tag">Audience: Students, Faculty</span>
        </div>

        <small class="ui-muted">
            <i class="bi bi-calendar"></i> 28/06/2024 •
            <i class="bi bi-eye"></i> 1247 views •
            <i class="bi bi-chat"></i> 23 comments
        </small>
    </div>

    <div class="text-end">
        <span class="ui-announcement-status high">High</span>
        <span class="ui-announcement-status published ms-2">Published</span>
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
