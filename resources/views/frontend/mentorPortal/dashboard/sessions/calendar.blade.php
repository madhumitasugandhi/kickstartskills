@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Session Calendar')
@section('icon', 'bi bi-calendar3 fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@php
use Carbon\Carbon;

// Get month and year from request or use current
$month = request('month', date('m'));
$year = request('year', date('Y'));
$date = Carbon::createFromDate($year, $month, 1);

$prevMonth = $date->copy()->subMonth();
$nextMonth = $date->copy()->addMonth();

// Calculate days for the grid
$daysInMonth = $date->daysInMonth;
$firstDayOfWeek = $date->dayOfWeekIso; // 1 (Mon) to 7 (Sun)

// Previous month filler days
$prevMonthDays = $date->copy()->subMonth()->daysInMonth;
$fillerDays = $firstDayOfWeek - 1;
@endphp

@section('content')

{{-- 1. Header with Dynamic Month/Year --}}
<div class="card-custom mb-4"
    style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px;">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
        <div class="bg-soft-orange p-3 rounded-3 text-accent">
            <i class="bi bi-calendar3 fs-3"></i>
        </div>
        <div class="text-center text-md-start">
            <h4 class="fw-bold text-main mb-1">Session Calendar</h4>
            <p class="text-muted-custom mb-0 small">Manage your mentoring sessions for {{ $date->format('F Y') }}</p>
        </div>

        <div
            class="d-flex flex-column flex-sm-row align-items-center gap-3 w-100 w-md-auto justify-content-center justify-content-md-end">
            <div
                class="d-flex align-items-center justify-content-between gap-2 bg-bg-hover p-1 rounded-3 w-100 w-sm-auto">
                <a href="?month={{ $prevMonth->month }}&year={{ $prevMonth->year }}"
                    class="btn btn-sm btn-icon text-muted-custom hover-accent">
                    <i class="bi bi-chevron-left"></i>
                </a>
                <span class="fw-bold text-main px-2">{{ $date->format('F Y') }}</span>
                <a href="?month={{ $nextMonth->month }}&year={{ $nextMonth->year }}"
                    class="btn btn-sm btn-icon text-muted-custom hover-accent">
                    <i class="bi bi-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- 2. Calendar Grid --}}
    <div class="col-xl-8">
        <div class="card-custom h-100 mb-0 p-4"
            style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; overflow-x: auto;">
            <div style="min-width: 600px;">
                <div class="d-grid text-center mb-2" style="grid-template-columns: repeat(7, 1fr);">
                    @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                    <div class="text-muted-custom small fw-bold py-2">{{ $day }}</div>
                    @endforeach
                </div>

                <div class="d-grid text-center gap-2" style="grid-template-columns: repeat(7, 1fr); min-height: 400px;">
                    {{-- Prev Month Fillers --}}
                    @for($i = $fillerDays; $i > 0; $i--)
                    <div class="p-3 rounded-3 text-muted-custom opacity-25">{{ $prevMonthDays - $i + 1 }}</div>
                    @endfor

                    {{-- Current Month Days --}}
                    {{-- Current Month Days --}}
                    @for($d = 1; $d <= $daysInMonth; $d++) @php $currentLoopDate=Carbon::create($year, $month, $d)->
                        format('Y-m-d');
                        $today = Carbon::now()->format('Y-m-d');
                        // $sessions variable ab yahan sahi se access hoga
                        $hasSession = $sessions->where('session_date', $currentLoopDate)->count();
                        @endphp

                        <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer position-relative date-cell {{ $currentLoopDate == $today ? 'border border-primary bg-soft-blue active-date' : '' }}"
                            data-date="{{ $currentLoopDate }}"
                            data-display-date="{{ Carbon::parse($currentLoopDate)->format('d M Y') }}">
                            {{ $d }}
                            @if($hasSession)
                            <span class="position-absolute bottom-0 start-50 translate-middle-x mb-2 d-flex gap-1">
                                <span class="rounded-circle bg-warning" style="width: 4px; height: 4px;"></span>
                            </span>
                            @endif
                        </div>
                        @endfor
                </div>
            </div>
        </div>
    </div>

    {{-- 3. Side Panel: Real-time Sessions List --}}
    <div class="col-xl-4">
        <div class="card-custom mb-4"
            style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px;">
            <h6 class="fw-bold mb-4 text-main">Sessions for <span id="selected-date-text">{{ Carbon::now()->format('d M
                    Y') }}</span></h6>

            <div class="d-flex flex-column gap-3" id="session-list-wrapper"
                style="max-height: 450px; overflow-y: auto; padding-right: 5px;">
                {{-- Iske andar ka @forelse loop waise hi rehne dein --}}
                @forelse($sessions as $session)
                <div class="p-3 rounded-3 border position-relative overflow-hidden session-item"
                    data-session-date="{{ $session->session_date }}"
                    style="display: {{ $session->session_date == $today ? 'block' : 'none' }}; background-color: var(--bg-hover); border-color: var(--border-color) !important;">
                    {{-- Side Indicator --}}
                    <div class="position-absolute top-0 start-0 bottom-0 bg-primary" style="width: 4px;"></div>

                    {{-- Header: Icon + Title + Trash --}}
                    <div class="d-flex justify-content-between align-items-start mb-2 ps-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-soft-blue text-blue rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 32px; height: 32px;">
                                <i class="bi bi-people" style="font-size: 0.8rem;"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-main mb-0" style="font-size: 0.85rem;">{{
                                    $session->session_title }}</h6>
                                <small class="text-muted-custom" style="font-size: 0.7rem;">{{ date('d M, Y',
                                    strtotime($session->session_date)) }}</small>
                            </div>
                        </div>

                        {{-- DELETE TRASH BUTTON --}}
                        <form action="{{ route('mentor.sessions.destroy', $session->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this session?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link text-danger p-0 border-0 shadow-none">
                                <i class="bi bi-trash3" style="font-size: 1rem;"></i>
                            </button>
                        </form>
                    </div>

                    {{-- Time & Status --}}
                    <div class="d-flex align-items-center justify-content-between mb-3 ps-2">
                        <div class="text-muted-custom" style="font-size: 0.75rem;">
                            <i class="bi bi-clock me-1"></i> {{ date('h:i A', strtotime($session->session_time)) }}
                        </div>
                        <span class="badge bg-soft-blue text-blue rounded-pill"
                            style="font-size: 0.6rem;">Scheduled</span>
                    </div>

                    {{-- Action Buttons: Edit & Join --}}
                    <div class="d-flex gap-2 ps-2">
                        <a href="{{ route('mentor.sessions.edit', $session->id) }}"
                            class="btn btn-sm btn-outline-secondary flex-grow-1"
                            style="font-size: 0.75rem; border-color: var(--border-color);">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </a>

                        <a href="{{ $session->meeting_url ?? '#' }}" target="_blank"
                            class="btn btn-sm btn-primary flex-grow-1 {{ !$session->meeting_url ? 'disabled' : '' }}"
                            style="font-size: 0.75rem; background-color: var(--accent-color); border: none;">
                            <i class="bi bi-camera-video me-1"></i> Join
                        </a>
                    </div>
                </div>
                @empty
                @endforelse
                <div id="no-sessions-msg" class="text-center py-4" style="display: none;">
                    <i class="bi bi-calendar-x --text-muted mb-2 fs-2"></i>
                    <p class="--text-muted small">No sessions for this date.</p>
                </div>
            </div>
        </div>

        {{-- 2. Quick Actions Card --}}
        <div class="card-custom mb-0"
            style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px;">
            <h6 class="fw-bold mb-3 text-main">Quick Actions</h6>
            <div class="d-flex flex-column gap-2">
                <a href="{{ route('mentor.sessions.schedule') }}"
                    class="btn btn-outline-primary w-100 text-start d-flex align-items-center justify-content-between p-2"
                    style="border-color: var(--accent-color); color: var(--accent-color); background: transparent;">
                    <span><i class="bi bi-plus me-2"></i> Schedule Session</span>
                    <i class="bi bi-chevron-right small"></i>
                </a>

                <a href="{{ route('mentor.sessions.history') }}"
                    class="btn btn-outline-secondary w-100 text-start d-flex align-items-center justify-content-between p-2"
                    style="border-color: var(--border-color); color: var(--text-muted);">
                    <span><i class="bi bi-list-ul me-2"></i> View All Sessions</span>
                    <i class="bi bi-chevron-right small"></i>
                </a>

                <button
                    class="btn btn-outline-secondary w-100 text-start d-flex align-items-center justify-content-between p-2"
                    style="border-color: var(--border-color); color: var(--text-muted);">
                    <span><i class="bi bi-clock me-2"></i> Set Availability</span>
                    <i class="bi bi-chevron-right small"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Click event on date cell
    $('.date-cell').on('click', function() {
        let selectedDate = $(this).data('date');
        let displayDate = $(this).data('display-date');

        // UI Update: Highlight selected date
        $('.date-cell').removeClass('border border-primary bg-soft-blue');
        $(this).addClass('border border-primary bg-soft-blue');

        // Update Title
        $('#selected-date-text').text(displayDate);

        // Filter Sessions
        let found = 0;
        $('.session-item').each(function() {
            if ($(this).data('session-date') === selectedDate) {
                $(this).fadeIn();
                found++;
            } else {
                $(this).hide();
            }
        });

        // Show/Hide No Sessions Message
        if (found === 0) {
            $('#no-sessions-msg').show();
        } else {
            $('#no-sessions-msg').hide();
        }
    });

    // Page load par aaj ki date filter karlo automatically
    $('.date-cell[data-date="{{ Carbon::now()->format('Y-m-d') }}"]').trigger('click');
});
</script>
@endsection
