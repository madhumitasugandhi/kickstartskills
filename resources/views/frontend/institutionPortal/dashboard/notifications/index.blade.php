@extends('frontend.institutionPortal.layout.app')

@section('page_title', 'Notifications')
@section('title', 'Notifications')

@section('content')
<div class="container-fluid p-4 p-md-5">

    {{-- ================= HEADER ================= --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="fw-semibold mb-1 form-label">Notifications</h4>
            <p class=" small mb-0">
                Institutional alerts, updates, and notifications
            </p>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-check2-all me-1"></i> Mark All Read
            </button>
            <a href="{{ route('institution.settings') }}" class="btn btn-teal btn-sm">
                <i class="bi bi-gear me-1"></i> Settings
            </a>
        </div>
    </div>

    {{-- ================= FILTER CARD ================= --}}
    <div class="card glass-card p-3 mb-4">
        <div class="row g-3 align-items-center">

            <div class="col-md-5">
                <label class="form-label small">Category</label>
                <div class="input-group-custom">
                    <i class="bi bi-folder"></i>
                    <select class="form-select">
                        <option>All</option>
                        <option>Academic</option>
                        <option>System</option>
                        <option>Compliance</option>
                    </select>
                </div>
            </div>

            <div class="col-md-5">
                <label class="form-label small">Filter</label>
                <div class="input-group-custom">
                    <i class="bi bi-funnel"></i>
                    <select class="form-select">
                        <option>All Notifications</option>
                        <option>Unread</option>
                        <option>High Priority</option>
                        <option>Action Required</option>
                    </select>
                </div>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-teal w-100">
                    <i class="bi bi-arrow-repeat me-1"></i> Refresh
                </button>
            </div>

        </div>
    </div>

    {{-- ================= OVERVIEW STATS ================= --}}
    <div class="row g-3 mb-4">
        @php
            $stats = [
                ['label' => 'Total', 'value' => 5, 'icon' => 'bi-bell'],
                ['label' => 'Unread', 'value' => 3, 'icon' => 'bi-envelope'],
                ['label' => 'Action Required', 'value' => 2, 'icon' => 'bi-exclamation-circle'],
                ['label' => 'High Priority', 'value' => 2, 'icon' => 'bi-flag'],
            ];
        @endphp

        @foreach($stats as $stat)
        <div class="col-md-3">
            <div class="glass-card p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon">
                        <i class="bi {{ $stat['icon'] }}"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold form-label">{{ $stat['value'] }}</h5>
                        <small class="">{{ $stat['label'] }}</small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- ================= NOTIFICATIONS LIST ================= --}}
    <div class="card glass-card p-4">
        <h6 class="fw-semibold mb-3 form-label">Notifications (5)</h6>

        {{-- Notification Item --}}
        @php
            $items = [
                [
                    'title' => 'New Student Enrollment',
                    'text' => 'John Smith has enrolled in Computer Science program.',
                    'office' => 'Admissions Office',
                    'icon' => 'bi-building',
                    'priority' => 'warning',
                    'unread' => true
                ],
                [
                    'title' => 'Grade Appeal Submitted',
                    'text' => 'A grade appeal has been submitted for CS-101 course.',
                    'office' => 'Academic Office',
                    'icon' => 'bi-mortarboard',
                    'priority' => 'danger',
                    'action' => true,
                    'unread' => true
                ],
                [
                    'title' => 'Faculty Meeting Reminder',
                    'text' => 'Monthly faculty meeting scheduled for tomorrow at 2 PM.',
                    'office' => 'Dean Office',
                    'icon' => 'bi-people',
                    'priority' => 'warning'
                ],
                [
                    'title' => 'System Maintenance Alert',
                    'text' => 'Scheduled maintenance window: Tonight 11 PM – 2 AM.',
                    'office' => 'IT Department',
                    'icon' => 'bi-cpu',
                    'priority' => 'info'
                ],
                [
                    'title' => 'Compliance Report Due',
                    'text' => 'Annual compliance report due in 3 days.',
                    'office' => 'Compliance Office',
                    'icon' => 'bi-shield-check',
                    'priority' => 'danger',
                    'action' => true,
                    'unread' => true
                ],
            ];
        @endphp

        @foreach($items as $item)
        <div class="notification-item {{ $item['unread'] ?? false ? 'unread' : '' }}">
        <div>
    <h6 class="mb-1 text-main fw-semibold">
        {{ $item['title'] }}
    </h6>

    <p class="small text-secondary mb-1">
        {{ $item['text'] }}
    </p>

    <small class="text-secondary">
        <i class="bi {{ $item['icon'] }} me-1"></i>
        {{ $item['office'] }}
    </small>
</div>


            <div class="text-end">
                <span class="badge bg-{{ $item['priority'] }}">
                    {{ ucfirst($item['priority']) }}
                </span>

                @if($item['action'] ?? false)
                    <span class="badge bg-outline-danger ms-1">Action</span>
                @endif

                <div class="small  mt-1">5d ago</div>
            </div>
        </div>
        @endforeach

    </div>

</div>
@endsection
