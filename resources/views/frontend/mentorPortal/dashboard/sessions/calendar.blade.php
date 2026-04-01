@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Session Calendar')
@section('icon', 'bi bi-calendar3 fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@php
use Carbon\Carbon;

$month = request('month', date('m'));
$year = request('year', date('Y'));
$date = Carbon::createFromDate($year, $month, 1);

$prevMonth = $date->copy()->subMonth();
$nextMonth = $date->copy()->addMonth();

$daysInMonth = $date->daysInMonth;
$firstDayOfWeek = $date->dayOfWeekIso;

$prevMonthDays = $date->copy()->subMonth()->daysInMonth;
$fillerDays = $firstDayOfWeek - 1;

// COLORS ARRAY: Dots aur Cards ke liye same use karenge
$themeColors = [
['text' => '#0d6efd', 'bg' => 'rgba(13, 110, 253, 0.12)', 'border' => '#0d6efd'], // Blue
['text' => '#ff8c00', 'bg' => 'rgba(255, 140, 0, 0.12)', 'border' => '#ff8c00'], // Orange
['text' => '#198754', 'bg' => 'rgba(25, 135, 84, 0.12)', 'border' => '#198754'], // Green
['text' => '#6f42c1', 'bg' => 'rgba(111, 66, 193, 0.12)', 'border' => '#6f42c1'], // Purple
['text' => '#d63384', 'bg' => 'rgba(214, 51, 132, 0.12)', 'border' => '#d63384'], // Pink
];
@endphp

@section('content')

{{-- 1. Header --}}
<div class="card-custom mb-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
        <div class="bg-soft-orange p-3 rounded-3 text-accent">
            <i class="bi bi-calendar3 fs-3"></i>
        </div>
        <div class="text-center text-md-start flex-grow-1 ms-md-3">
            <h4 class="fw-bold text-main mb-1">Session Calendar</h4>
            <p class="text-muted-custom mb-0 small">Manage your sessions for {{ $date->format('F Y') }}</p>
        </div>
        <div class="d-flex align-items-center gap-3 bg-bg-hover p-1 rounded-3">
            <a href="?month={{ $prevMonth->month }}&year={{ $prevMonth->year }}"
                class="btn btn-sm btn-icon text-muted-custom">
                <i class="bi bi-chevron-left"></i>
            </a>
            <span class="fw-bold text-main px-2">{{ $date->format('F Y') }}</span>
            <a href="?month={{ $nextMonth->month }}&year={{ $nextMonth->year }}"
                class="btn btn-sm btn-icon text-muted-custom">
                <i class="bi bi-chevron-right"></i>
            </a>
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- 2. Calendar Grid --}}
    <div class="col-xl-8">
        <div class="card-custom h-100 p-4">
            <div class="d-grid text-center mb-2" style="grid-template-columns: repeat(7, 1fr);">
                @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                <div class="text-muted-custom small fw-bold py-2">{{ $day }}</div>
                @endforeach
            </div>

            <div class="d-grid text-center gap-2" style="grid-template-columns: repeat(7, 1fr); min-height: 400px;">
                @for($i = $fillerDays; $i > 0; $i--)
                <div class="p-3 rounded-3 text-muted-custom opacity-25">{{ $prevMonthDays - $i + 1 }}</div>
                @endfor

                @for($d = 1; $d <= $daysInMonth; $d++) @php $currentLoopDate=Carbon::create($year, $month, $d)->
                    format('Y-m-d');
                    $today = Carbon::now()->format('Y-m-d');
                    $daySessions = $sessions->where('session_date', $currentLoopDate);
                    $count = $daySessions->count();
                    @endphp

                    <div class="p-3 rounded-3 text-main hover-bg-soft cursor-pointer position-relative date-cell {{ $currentLoopDate == $today ? 'border border-primary bg-soft-blue active-date' : '' }}"
                        data-date="{{ $currentLoopDate }}"
                        data-display-date="{{ Carbon::parse($currentLoopDate)->format('d M Y') }}">
                        {{ $d }}

                        {{-- MULTIPLE DOTS LOGIC --}}
                        @if($count > 0)
                        <div class="position-absolute bottom-0 start-50 translate-middle-x mb-1 d-flex gap-1">
                            @foreach($daySessions->take(3) as $index => $s)
                            <span class="rounded-circle"
                                style="width: 5px; height: 5px; background-color: {{ $themeColors[$index % 5]['text'] }};"></span>
                            @endforeach
                            @if($count > 3) <span class="text-muted" style="font-size: 8px;">+</span> @endif
                        </div>
                        @endif
                    </div>
                    @endfor
            </div>
        </div>
    </div>

    {{-- 3. Side Panel --}}
    <div class="col-xl-4">
        {{-- Session List --}}
        <div class="card-custom mb-4" style="min-height: 300px;">
            <h6 class="fw-bold mb-4 text-main">Sessions for <span id="selected-date-text">{{ Carbon::now()->format('d M
                    Y') }}</span></h6>

            <div class="d-flex flex-column gap-3" id="session-list-wrapper">
                @php $groupedSessions = $sessions->groupBy('session_date'); @endphp

                @foreach($groupedSessions as $dateKey => $sessionsInDay)
                @foreach($sessionsInDay as $index => $session)
                @php $color = $themeColors[$index % 5]; @endphp
                <div class="p-3 rounded-3 border position-relative overflow-hidden session-item"
                    data-session-date="{{ $session->session_date }}"
                    style="display: none; background-color: {{ $color['bg'] }}; border-color: {{ $color['border'] }} !important;">

                    <div class="position-absolute top-0 start-0 bottom-0"
                        style="width: 4px; background-color: {{ $color['text'] }};"></div>

                    <div class="d-flex justify-content-between align-items-start mb-2 ps-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 32px; height: 32px; background: white; color: {{ $color['text'] }};">
                                <i class="bi bi-people" style="font-size: 0.8rem;"></i>
                            </div>
                            <h6 class="fw-bold text-main mb-0" style="font-size: 0.85rem;">{{ $session->session_title }}
                            </h6>
                        </div>
                        <form action="{{ route('mentor.sessions.destroy', $session->id) }}" method="POST"
                            onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-link p-0 border-0 shadow-none text-danger">
                                <i class="bi bi-trash3" style="font-size: 0.9rem;"></i>
                            </button>
                        </form>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-2 ps-2">
                        <div class="small fw-bold" style="color: {{ $color['text'] }};">
                            <i class="bi bi-clock me-1"></i> {{ date('h:i A', strtotime($session->session_time)) }}
                        </div>
                        <span class="badge rounded-pill"
                            style="background-color: {{ $color['text'] }}; color: white; font-size: 0.6rem;">Scheduled</span>
                    </div>

                    <div class="d-flex gap-2 ps-2">
                        <a href="{{ route('mentor.sessions.edit', $session->id) }}"
                            class="btn btn-sm btn-light flex-grow-1" style="font-size: 0.7rem;">Edit</a>
                        <a href="{{ $session->meeting_url ?? '#' }}" target="_blank"
                            class="btn btn-sm text-white flex-grow-1 {{ !$session->meeting_url ? 'disabled' : '' }}"
                            style="background-color: {{ $color['text'] }}; font-size: 0.7rem;">Join</a>
                    </div>
                </div>
                @endforeach
                @endforeach

                <div id="no-sessions-msg" class="text-center py-5" style="display: none;">
                    <i class="bi bi-calendar-x --text-muted mb-2 fs-2"></i>
                    <p class="--text-muted small">No sessions for this date.</p>
                </div>
            </div>
        </div>

        {{-- 4. QUICK ACTIONS --}}
        <div class="card-custom">
            <h6 class="fw-bold mb-3 text-main">Quick Actions</h6>
            <div class="d-flex flex-column gap-2">
                <a href="{{ route('mentor.sessions.schedule') }}"
                    class="btn btn-outline-primary w-100 text-start d-flex align-items-center justify-content-between p-2 rounded-3 border-dark-subtle">
                    <span><i class="bi bi-plus-circle me-2"></i> Schedule Session</span>
                    <i class="bi bi-chevron-right small"></i>
                </a>
                <a href="{{ route('mentor.sessions.history') }}"
                    class="btn btn-outline-secondary w-100 text-start d-flex align-items-center justify-content-between p-2 rounded-3 border-dark-subtle">
                    <span><i class="bi bi-clock-history me-2"></i> Session History</span>
                    <i class="bi bi-chevron-right small"></i>
                </a>
                <button
                    class="btn btn-outline-secondary w-100 text-start d-flex align-items-center justify-content-between p-2 rounded-3 border-dark-subtle">
                    <span><i class="bi bi-gear me-2"></i> Settings</span>
                    <i class="bi bi-chevron-right small"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    $('.date-cell').on('click', function() {
        let selectedDate = $(this).data('date');
        let displayDate = $(this).data('display-date');

        $('.date-cell').removeClass('border border-primary bg-soft-blue active-date');
        $(this).addClass('border border-primary bg-soft-blue active-date');

        $('#selected-date-text').text(displayDate);

        let found = 0;
        $('.session-item').hide();
        $(`.session-item[data-session-date="${selectedDate}"]`).each(function() {
            $(this).fadeIn();
            found++;
        });

        if (found === 0) $('#no-sessions-msg').show();
        else $('#no-sessions-msg').hide();
    });

    // Auto-select today on load
    $('.date-cell[data-date="{{ Carbon::now()->format('Y-m-d') }}"]').trigger('click');
});
</script>
@endsection
