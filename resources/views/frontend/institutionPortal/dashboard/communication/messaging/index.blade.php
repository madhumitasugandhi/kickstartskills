@extends('frontend.institutionPortal.layout.app')

@section('page_title', 'Messaging Center')
@section('title', 'Messaging Center')

@section('content')
<div class="container-fluid p-3 p-md-5">

    <!-- ================= HEADER ================= -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 fw-bold mb-1">Messaging Center</h1>
            <p class="mb-0">
                Institutional communication and messaging platform
            </p>
        </div>

        <button class="btn btn-teal"
                data-bs-toggle="modal"
                data-bs-target="#composeMessageModal">
            <i class="bi bi-pencil-square me-2"></i> Compose
        </button>
    </div>

    <!-- ================= SEARCH & FILTERS ================= -->
    <div class="glass-card p-4 mb-4">
        <div class="row g-3 align-items-end">

            <div class="col-12">
                <div class="input-group-custom">
                    <i class="bi bi-search"></i>
                    <input type="text"
                           class="form-control form-control-custom"
                           placeholder="Search conversations...">
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label small">Folder</label>
                <select class="form-select form-select-custom">
                    <option>Inbox</option>
                    <option>Sent</option>
                    <option>Archived</option>
                </select>
            </div>

            <div class="col-md-5">
                <label class="form-label small">Filter</label>
                <select class="form-select form-select-custom">
                    <option>All Messages</option>
                    <option>Unread</option>
                    <option>Urgent</option>
                </select>
            </div>

            <div class="col-md-1 d-flex align-items-end">
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
                <div class="glass-card d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon">
                            <i class="bi {{ $stat['icon'] }}"></i>
                        </div>
                        <div>
                            <small class="">{{ $stat['label'] }}</small>
                            <h5 class="fw-bold mb-0">{{ $stat['value'] }}</h5>
                        </div>
                    </div>
                    <i class="bi bi-graph-up text-teal"></i>
                </div>
            </div>
        @endforeach
    </div>

    <!-- ================= CONVERSATION LAYOUT ================= -->
    <div class="row g-4 align-items-stretch">

        <!-- LEFT: CONVERSATIONS -->
        <div class="col-lg-4">
            <div class="glass-card h-100 d-flex flex-column">

                <h6 class="fw-semibold mb-3">Conversations (3)</h6>

                <!-- Conversation Item -->
                <div class="conversation-item p-3 mb-3 rounded"
                     style="border:1px solid var(--glass-border); cursor:pointer;">
                    <div class="d-flex justify-content-between align-items-start mb-1">
                        <div class="fw-semibold">Student Registration Issues</div>
                        <span class="announcement-status priority-high">High</span>
                    </div>
                    <p class="small  mb-1">
                        The registration system will be updated tonight...
                    </p>
                    <small class="">53d ago</small>
                </div>

                <div class="conversation-item p-3 mb-3 rounded"
                     style="border:1px solid var(--glass-border); cursor:pointer;">
                    <div class="d-flex justify-content-between align-items-start mb-1">
                        <div class="fw-semibold">Faculty Meeting Reschedule</div>
                        <span class="announcement-status priority-medium">Medium</span>
                    </div>
                    <p class="small  mb-1">
                        The faculty meeting has been rescheduled to Friday...
                    </p>
                    <small class="">54d ago</small>
                </div>

                <div class="conversation-item p-3 rounded"
                     style="border:1px solid var(--glass-border); cursor:pointer;">
                    <div class="d-flex justify-content-between align-items-start mb-1">
                        <div class="fw-semibold">Library Resource Request</div>
                        <span class="announcement-status priority-low">Low</span>
                    </div>
                    <p class="small  mb-1">
                        The requested research databases have been added...
                    </p>
                    <small class="">54d ago</small>
                </div>

            </div>
        </div>

        <!-- RIGHT: MESSAGE VIEW -->
        <div class="col-lg-8">
            <div class="glass-card h-100 d-flex flex-column justify-content-center align-items-center text-center">
                <div class="stat-icon mb-3">
                    <i class="bi bi-chat"></i>
                </div>
                <h6 class="fw-semibold mb-1">Select a conversation</h6>
                <p class=" mb-0">
                    Choose a conversation from the list to view messages
                </p>
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
