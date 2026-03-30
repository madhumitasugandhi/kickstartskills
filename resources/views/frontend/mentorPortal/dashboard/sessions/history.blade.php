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
            {{-- Search Input --}}
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

            {{-- Status Filter --}}
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

            {{-- Time Period Filter --}}
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

    <div class="d-flex justify-content-around mt-4 pt-3 border-top"
        style="border-color: var(--border-color) !important;">
        <div class="text-center">
            <i class="bi bi-calendar-check text-primary mb-1 d-block"></i>
            <span class="fw-bold text-primary fs-5">{{ count($sessions) }}</span>
            <span class="d-block text-muted-custom small" style="font-size: 0.7rem;">Sessions Found</span>
        </div>
        <div class="text-center">
            <i class="bi bi-check-circle text-success mb-1 d-block"></i>
            <span class="fw-bold text-success fs-5">{{ $stats['completed'] ?? 0 }}</span>
            <span class="d-block text-muted-custom small" style="font-size: 0.7rem;">Completed</span>
        </div>
        <div class="text-center">
            <i class="bi bi-star text-accent mb-1 d-block"></i>
            <span class="fw-bold text-accent fs-5">{{ $stats['avg_rating'] }}</span>
            <span class="d-block text-muted-custom small" style="font-size: 0.7rem;">Avg Rating</span>
        </div>
    </div>
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
            <h3 class="fw-bold text-primary mb-1">{{ $stats['total_hours'] }}h</h3>
            <span class="text-muted-custom fw-medium">Total Hours</span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-custom text-center py-4 mb-0 h-100 border border-warning-subtle"
            style="background-color: var(--soft-accent);">
            <i class="bi bi-star fs-1 text-accent mb-2"></i>
            <h3 class="fw-bold text-accent mb-1">{{ $stats['avg_rating'] }}</h3>
            <span class="text-muted-custom fw-medium">Average Rating</span>
        </div>
    </div>
</div>

<h6 class="text-muted-custom mb-3 small fw-bold">{{ count($sessions) }} sessions found</h6>

{{-- 4. Sessions Loop --}}
@forelse($sessions as $session)
<div class="card-custom mb-4 {{ $session->status == 'canceled' ? 'opacity-75' : '' }}">
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div class="d-flex align-items-start gap-3">
            <div class="bg-soft-orange text-accent p-3 rounded-3 d-flex align-items-center justify-content-center">
                <i class="bi {{ $session->session_type == 'Group Discussion' ? 'bi-people' : 'bi-eye' }} fs-4"></i>
            </div>
            <div>
                <h5 class="fw-bold text-main mb-1">{{ $session->session_title }}</h5>
                <p class="text-muted-custom mb-0 small">Type: <span class="text-main fw-bold">{{ $session->session_type
                        }}</span></p>
            </div>
        </div>
        <span
            class="badge {{ $session->status == 'completed' ? 'bg-soft-green text-green' : 'bg-soft-red text-red' }} rounded-pill px-3 py-2">
            {{ ucfirst($session->status) }}
        </span>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <small class="text-muted-custom d-block mb-1">Date</small>
            <div class="d-flex align-items-center gap-2 text-main fw-medium">
                <i class="bi bi-calendar3 text-primary"></i> {{ date('d M Y', strtotime($session->session_date)) }}
            </div>
        </div>
        <div class="col-6 col-md-3">
            <small class="text-muted-custom d-block mb-1">Duration</small>
            <div class="d-flex align-items-center gap-2 text-main fw-medium">
                <i class="bi bi-hourglass-split text-primary"></i> {{ $session->duration }}
            </div>
        </div>
    </div>

    @if($session->agenda)
    <div class="p-3 rounded-3 mb-3 border border-dark-subtle" style="background-color: var(--bg-hover);">
        <div class="d-flex align-items-center gap-2 mb-2 text-muted-custom small fw-bold">
            <i class="bi bi-list-ul"></i> Agenda:
        </div>
        <p class="text-main mb-0 small">{{ $session->agenda }}</p>
    </div>
    @endif

    <div class="row g-2">
        <div class="col-md-6">
            <button class="btn btn-outline-primary w-100 fw-bold view-summary-btn"
                data-title="{{ $session->session_title }}"
                data-date="{{ date('d M Y', strtotime($session->session_date)) }}"
                data-duration="{{ $session->duration }}" data-agenda="{{ $session->agenda ?? 'N/A' }}"
                data-desc="{{ $session->description ?? 'No description' }}" data-bs-toggle="modal"
                data-bs-target="#summaryModal">
                <i class="bi bi-eye me-2"></i> View Summary
            </button>
        </div>
        <div class="col-md-6">
            <a href="{{ route('mentor.sessions.edit', $session->id) }}" class="btn btn-outline-secondary w-100 fw-bold"
                style="border-color: var(--border-color); color: var(--text-muted);">
                <i class="bi bi-arrow-repeat me-2"></i> Re-schedule
            </a>
        </div>
    </div>
</div>
@empty
<div class="card-custom text-center py-5">
    <p class="--text-muted mb-0">No past sessions found matching your filters.</p>
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
                        style="min-height: 50px;">
                    </div>
                </div>

                <div class="mb-0">
                    <label class="small text-muted-custom fw-bold d-block mb-1">DESCRIPTION</label>
                    <p id="modal-desc" class="text-muted-custom small mb-0"></p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary w-100 fw-bold" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- 6. Scripts --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // --- Modal Data Loading Logic ---
        $(document).on('click', '.view-summary-btn', function() {
            const title = $(this).data('title');
            const date = $(this).data('date');
            const duration = $(this).data('duration');
            const agenda = $(this).data('agenda');
            const desc = $(this).data('desc');

            $('#modal-title').html(title);
            $('#modal-date').html(date);
            $('#modal-duration').html(duration);
            $('#modal-agenda').html(agenda);
            $('#modal-desc').html(desc);

            if(!agenda || agenda.trim() == "" || agenda == "N/A") {
                $('#modal-agenda').html('<span class="text-muted italic">No agenda provided</span>');
            }
        });

        // --- Filter Auto-submit Logic ---
        $('.filter-select').on('change', function() {
            $('#filterForm').submit();
        });

        let typingTimer;
        $('#searchInput').on('keyup', function() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(function() {
                $('#filterForm').submit();
            }, 500);
        });
    });
</script>

@endsection
