@extends('frontend.institutionPortal.layout.app')

@section('page_title', 'Messaging Center')
@section('title', 'Messaging Center')

@section('content')
<div class="container-fluid p-3 p-md-5">

    <!-- ================= HEADER ================= -->
    <div class="ui-page-header d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex gap-3 align-items-center">
        <div class="ui-icon-box">
            <i class="bi bi-chat-dots"></i>
        </div>
        <div>
            <h5 class="mb-0">Messaging Center</h5>
            <small class="ui-muted">
                Institutional communication and messaging platform
            </small>
        </div>
    </div>

    <button class="btn btn-teal"
            data-bs-toggle="modal"
            data-bs-target="#composeMessageModal">
        <i class="bi bi-pencil-square me-2"></i> Compose
    </button>
</div>

    <!-- ================= SEARCH & FILTERS ================= -->
    <div class="ui-card mb-4">
    <div class="row g-3 align-items-end">

<div class="col-12">
    <div class="ui-search">
        <i class="bi bi-search"></i>
        <input type="text"
               class="form-control"
               placeholder="Search conversations...">
    </div>
</div>

<div class="col-md-6">
    <label class="ui-label">Folder</label>
    <select class="form-select">
        <option>Inbox</option>
        <option>Sent</option>
        <option>Archived</option>
    </select>
</div>

<div class="col-md-5">
    <label class="ui-label">Filter</label>
    <select class="form-select">
        <option>All Messages</option>
        <option>Unread</option>
        <option>Urgent</option>
    </select>
</div>

<div class="col-md-1">
    <button class="btn btn-outline-teal w-100">
        <i class="bi bi-arrow-repeat"></i>
    </button>
</div>

</div>
    </div>

    <!-- ================= OVERVIEW ================= -->
    <h6 class="fw-semibold mb-3">Messaging Overview</h6>

    <div class="row g-3 mb-5">
        @php
            $stats = [
                ['label' => 'Conversations', 'value' => 6, 'icon' => 'bi-chat-dots'],
                ['label' => 'Unread', 'value' => 2, 'icon' => 'bi-envelope'],
                ['label' => 'Urgent', 'value' => 1, 'icon' => 'bi-exclamation-circle'],
                ['label' => 'Active', 'value' => 4, 'icon' => 'bi-activity'],
            ];
        @endphp

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

    <!-- ================= CONVERSATION LAYOUT ================= -->
    <div class="row g-4 align-items-stretch">

    <!-- LEFT: CONVERSATIONS -->
    <div class="col-lg-4">
        <div class="ui-card h-100 d-flex flex-column">

            <div class="ui-card-title mb-3">Conversations (3)</div>

            <div class="ui-conversation-item active">
                <div class="d-flex justify-content-between align-items-start mb-1">
                    <strong>Student Registration Issues</strong>
                    <span class="ui-announcement-status high">High</span>
                </div>
                <div class="small ui-muted mb-1">
                    The registration system will be updated tonight...
                </div>
                <small class="ui-muted">53d ago</small>
            </div>

            <div class="ui-conversation-item">
                <div class="d-flex justify-content-between align-items-start mb-1">
                    <strong>Faculty Meeting Reschedule</strong>
                    <span class="ui-announcement-status medium">Medium</span>
                </div>
                <div class="small ui-muted mb-1">
                    The faculty meeting has been rescheduled to Friday...
                </div>
                <small class="ui-muted">54d ago</small>
            </div>

            <div class="ui-conversation-item">
                <div class="d-flex justify-content-between align-items-start mb-1">
                    <strong>Library Resource Request</strong>
                    <span class="ui-announcement-status low">Low</span>
                </div>
                <div class="small ui-muted mb-1">
                    The requested research databases have been added...
                </div>
                <small class="ui-muted">54d ago</small>
            </div>

        </div>
    </div>

    <!-- RIGHT: MESSAGE VIEW -->
    <div class="col-lg-8">
        <div class="ui-card h-100 ui-message-empty">
            <div class="stat-icon mb-3">
                <i class="bi bi-chat"></i>
            </div>
            <div class="ui-card-title">Select a conversation</div>
            <div class="ui-muted">
                Choose a conversation from the list to view messages
            </div>
        </div>
    </div>

</div>

</div>

{{-- ================= MODALS ================= --}}
@include('frontend.institutionPortal.dashboard.communication.messaging.modals.compose')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        console.log('Messaging Center loaded');
    });
</script>
@endsection
