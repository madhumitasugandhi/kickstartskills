@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Session History')
@section('icon', 'bi bi-clock-history fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')

{{-- 1. Header Card --}}
<div class="card-custom mb-4">
    <div class="d-flex align-items-center gap-3">
        <div class="fs-4 p-2 bg-soft-orange rounded-3 text-accent">
            <i class="bi bi-clock-history fs-3"></i>
        </div>
        <div>
            <h4 class="fw-bold text-main mb-1">Session History</h4>
            <p class="text-muted-custom mb-0 small">Review your past mentoring sessions and feedback</p>
        </div>
    </div>
</div>

{{-- 2. Filters & Search Form --}}
<div class="card-custom mb-4">
    <h6 class="fw-bold text-main mb-3">Filters & Search</h6>
    <form id="filterForm" action="{{ route('mentor.sessions.history') }}" method="GET">
        <div class="row g-3 align-items-end">
            <div class="col-lg-6">
                <div class="input-group">
                    <span class="input-group-text border-end-0 d-flex align-items-center justify-content-center"
                        style="background-color: var(--bg-hover); border-color: var(--border-color); min-width: 45px;">
                        <i class="bi bi-search" style="color: var(--text-muted);"></i>
                    </span>
                    <input type="text" name="search" id="searchInput" class="form-control border-start-0 ps-0"
                        placeholder="Search sessions..." value="{{ request('search') }}"
                        style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                </div>
            </div>

            <div class="col-md-3">
                <label class="form-label small text-muted-custom fw-bold mb-1">Status Filter</label>
                <select name="status" class="form-select filter-select"
                    style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                    <option value="All Sessions" {{ request('status')=='All Sessions' ? 'selected' : '' }}>All Sessions
                    </option>
                    <option value="completed" {{ request('status')=='completed' ? 'selected' : '' }}>Completed</option>
                    <option value="canceled" {{ request('status')=='canceled' ? 'selected' : '' }}>Canceled</option>
                    <option value="scheduled" {{ request('status')=='scheduled' ? 'selected' : '' }}>Scheduled</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label small text-muted-custom fw-bold mb-1">Time Period</label>
                <select name="period" class="form-select filter-select"
                    style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                    <option value="Last 30 days" {{ request('period')=='Last 30 days' ? 'selected' : '' }}>Last 30 days
                    </option>
                    <option value="Last 3 Months" {{ request('period')=='Last 3 Months' ? 'selected' : '' }}>Last 3
                        Months</option>
                    <option value="This Year" {{ request('period')=='This Year' ? 'selected' : '' }}>This Year</option>
                </select>
            </div>
        </div>
    </form>
</div>

{{-- 3. Stats Cards Row --}}
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card-custom text-center py-4 mb-0 h-100 border border-success-subtle"
            style="background-color: rgba(25, 135, 84, 0.1);">
            <i class="bi bi-check-circle fs-1 text-success mb-2"></i>
            <h3 class="fw-bold text-success mb-1">{{ $stats['completed'] ?? 0 }}</h3>
            <span class="text-muted-custom fw-medium">Completed Sessions</span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-custom text-center py-4 mb-0 h-100 border border-primary-subtle"
            style="background-color: rgba(13, 110, 253, 0.1);">
            <i class="bi bi-clock fs-1 text-primary mb-2"></i>
            <h3 class="fw-bold text-primary mb-1">{{ $stats['total_hours'] ?? 0 }}h</h3>
            <span class="text-muted-custom fw-medium">Total Hours</span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-custom text-center py-4 mb-0 h-100 border border-warning-subtle"
            style="background-color: var(--soft-accent);">
            <i class="bi bi-star fs-1 text-accent mb-2"></i>
            <h3 class="fw-bold text-accent mb-1">{{ $stats['avg_rating'] ?? '0.0' }}</h3>
            <span class="text-muted-custom fw-medium">Average Rating</span>
        </div>
    </div>
</div>

<h6 class="text-muted-custom mb-3 small fw-bold">{{ count($sessions) }} sessions found</h6>

{{-- 4. Sessions Loop --}}
@forelse($sessions as $session)
@php
// Notebook Agenda: Status Logic (Scheduled = Green, Past = Completed)
$sessionDT = \Carbon\Carbon::parse($session->session_date . ' ' . $session->session_time);
$isPast = $sessionDT->isPast();

if($session->status == 'cancelled' || $session->status == 'canceled') {
$badgeClass = 'bg-soft-red text-red';
$statusLabel = 'Canceled';
} elseif($isPast) {
$badgeClass = 'bg-soft-info text-info'; // Completed sessions Blue ya Info
$statusLabel = 'Completed';
} else {
$badgeClass = 'bg-soft-green text-green'; // Future scheduled hamesha Green
$statusLabel = 'Scheduled';
}
@endphp

<div
    class="card-custom mb-4 {{ ($session->status == 'cancelled' || $session->status == 'canceled') ? 'opacity-75 shadow-none' : '' }}">
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div class="d-flex align-items-start gap-3">
            <div class="bg-soft-orange text-accent p-3 rounded-3 d-flex align-items-center justify-content-center">
                <i class="bi {{ $session->session_type == 'Group Discussion' ? 'bi-people' : 'bi-person' }} fs-4"></i>
            </div>
            <div>
                <h5 class="fw-bold text-main mb-1">{{ $session->session_title }}</h5>
                <p class="text-muted-custom mb-0 small">Type: <span class="text-main fw-bold">{{ $session->session_type
                        }}</span></p>
            </div>
        </div>
        <span class="badge {{ $badgeClass }} rounded-pill px-3 py-2">
            <i class="bi bi-circle-fill me-1" style="font-size: 6px;"></i> {{ $statusLabel }}
        </span>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <small class="text-muted-custom d-block mb-1">DATE & TIME</small>
            <div class="text-main fw-bold">
                <i class="bi bi-calendar3 text-primary me-1"></i> {{ date('d M Y', strtotime($session->session_date)) }}
                <div class="small text-muted-custom fw-normal mt-1"><i class="bi bi-clock me-1"></i> {{ date('h:i A',
                    strtotime($session->session_time)) }}</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <small class="text-muted-custom d-block mb-1">DURATION</small>
            <div class="d-flex align-items-center gap-2 text-main fw-medium">
                <i class="bi bi-hourglass-split text-primary"></i> {{ $session->duration }} mins
            </div>
        </div>

        {{-- Meeting Link in Card --}}
        <div class="col-12 col-md-7">
            <small class="text-muted-custom d-block mb-1">MEETING ACCESS</small>
            <div class="p-2 rounded-3 border border-dark-subtle d-flex justify-content-between align-items-center">
                <div class="text-truncate me-2 small"><i class="bi bi-link-45deg text-primary fs-5"></i> {{
                    $session->meeting_url ?? 'No link added' }}</div>
                @if(!$isPast && $session->status == 'scheduled')
                <a href="{{ $session->meeting_url }}" target="_blank"
                    class="btn btn-sm btn-primary px-3 fw-bold shadow-sm">Join Now</a>
                @else
                <button class="btn btn-sm btn-secondary px-3 fw-bold disabled">Join Now</button>
                @endif
            </div>
        </div>
    </div>

    {{-- Agenda Point-wise in Card --}}
    @if($session->agenda)
    <div class="p-3 rounded-3 mb-3 border border-dark-subtle" style="background-color: var(--bg-hover);">
        <div class="d-flex align-items-center gap-2 mb-2 text-muted-custom small fw-bold">
            <i class="bi bi-list-ul"></i> Agenda Points:
        </div>
        <ul class="text-main mb-0 small ps-4">
            @foreach(explode(',', $session->agenda) as $point)
            @if(trim($point)) <li class="mb-1">{{ trim($point) }}</li> @endif
            @endforeach
        </ul>
    </div>
    @endif

    <div class="row g-2">
        <div class="col-md-6">
            <button class="btn btn-outline-primary w-100 fw-bold view-summary-btn"
                data-title="{{ $session->session_title }}"
                data-date="{{ date('d M Y', strtotime($session->session_date)) }}"
                data-duration="{{ $session->duration }}" data-agenda="{{ $session->agenda ?? 'N/A' }}"
                data-desc="{{ $session->description ?? 'No description provided' }}"
                data-link="{{ $session->meeting_url }}" data-status="{{ $statusLabel }}" data-bs-toggle="modal"
                data-bs-target="#summaryModal">
                <i class="bi bi-eye me-2"></i> View Summary
            </button>
        </div>
        <div class="col-md-6">
            <a href="{{ route('mentor.sessions.edit', $session->id) }}" class="btn btn-outline-secondary w-100 fw-bold">
                <i class="bi bi-arrow-repeat me-2"></i> Re-schedule
            </a>
        </div>
    </div>
</div>
@empty
<div class="card-custom text-center py-5">
    <p class="text-muted-custom mb-0">No past sessions found matching your filters.</p>
</div>
@endforelse

{{-- 5. Summary Modal --}}
<div class="modal fade" id="summaryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card-custom border-0 shadow-lg" style="background-color: var(--bg-card);">
            <div class="modal-header border-bottom" style="border-color: var(--border-color) !important;">
                <h5 class="fw-bold text-main mb-0"><i class="bi bi-info-circle me-2 text-accent"></i>Session Summary
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <div class="mb-4">
                    <label class="small text-muted-custom fw-bold d-block mb-1">TITLE</label>
                    <h5 id="modal-title" class="fw-bold text-main"></h5>
                </div>

                <div class="row mb-4">
                    <div class="col-6 border-end" style="border-color: var(--border-color) !important;">
                        <label class="small text-muted-custom fw-bold d-block mb-1">DATE</label>
                        <span id="modal-date" class="text-main fw-medium"></span>
                    </div>
                    <div class="col-6 ps-3">
                        <label class="small text-muted-custom fw-bold d-block mb-1">DURATION</label>
                        <span id="modal-duration" class="text-main fw-medium"></span>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="small text-muted-custom fw-bold d-block mb-1">AGENDA</label>
                    <div id="modal-agenda" class="p-3 rounded-3 bg-bg-hover text-main small border border-dark-subtle"
                        style="min-height: 50px;"></div>
                </div>

                <div class="mb-0">
                    <label class="small text-muted-custom fw-bold d-block mb-1">DESCRIPTION</label>
                    <p id="modal-desc" class="text-muted-custom small mb-0"></p>
                </div>

                {{-- Join Link in Modal (Notebook Logic) --}}
                <div class="mt-4 pt-3 border-top border-dark-subtle" id="modal-join-section">
                    <label class="small text-muted-custom fw-bold d-block mb-2">MEETING ACTION</label>
                    <a href="#" id="modal-join-btn" target="_blank" class="btn btn-success w-100 fw-bold">
                        <i class="bi bi-camera-video me-2"></i> Join Meeting Now
                    </a>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary w-100 fw-bold" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.view-summary-btn', function() {
            const title = $(this).data('title');
            const date = $(this).data('date');
            const duration = $(this).data('duration');
            const agenda = $(this).data('agenda');
            const desc = $(this).data('desc');
            const link = $(this).data('link');
            const status = $(this).data('status');

            $('#modal-title').html(title);
            $('#modal-date').html(date);
            $('#modal-duration').html(duration + ' mins');
            $('#modal-desc').html(desc);

            // Join Button Logic in Modal
            if(status === 'Scheduled' && link) {
                $('#modal-join-btn').attr('href', link).show();
                $('#modal-join-section').show();
            } else {
                $('#modal-join-section').hide();
            }

            if(!agenda || agenda.trim() == "" || agenda == "N/A") {
                $('#modal-agenda').html('<span class="text-muted">No agenda provided</span>');
            } else {
                let points = agenda.split(/[,\n]/);
                let listHtml = '<ul class="mb-0 ps-3">';
                points.forEach(function(point) {
                    if(point.trim()) listHtml += '<li class="mb-1">' + point.trim() + '</li>';
                });
                listHtml += '</ul>';
                $('#modal-agenda').html(listHtml);
            }
        });

        $('.filter-select').on('change', function() {
            $('#filterForm').submit();
        });
    });
</script>

@endsection
