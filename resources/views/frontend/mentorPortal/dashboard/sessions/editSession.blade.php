@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Edit Session')
@section('icon', 'bi bi-pencil-square fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')

<div class="card-custom mb-4">
    <div class="d-flex align-items-center gap-3">
        <div class="bg-soft-orange p-3 rounded-3 text-accent">
            <i class="bi bi-pencil-square fs-3"></i>
        </div>
        <div>
            <h4 class="fw-bold text-main mb-1">Edit Session</h4>
            <p class="text-muted-custom mb-0 small">Update details for "{{ $session->session_title }}"</p>
        </div>
    </div>
</div>

<form action="{{ route('mentor.sessions.update', $session->id) }}" method="POST">
    @csrf
    @method('PUT') {{-- UPDATE ke liye ye zaroori hai --}}

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card-custom mb-4">
                <h6 class="fw-bold text-main mb-4 border-bottom pb-3">Session Details</h6>

                <div class="mb-3">
                    <label class="form-label small text-muted-custom fw-bold">Session Title</label>
                    <input type="text" name="session_title" class="form-control"
                        value="{{ old('session_title', $session->session_title) }}" required
                        style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted-custom fw-bold">Description</label>
                    <textarea name="description" class="form-control" rows="3"
                        style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">{{ old('description', $session->description) }}</textarea>
                </div>

                <div class="mb-3" id="urlFieldWrapper">
                    <label class="form-label small text-muted-custom fw-bold">Meeting Link (URL)</label>
                    <input type="url" name="meeting_url" class="form-control"
                        value="{{ old('meeting_url', $session->meeting_url) }}"
                        style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card-custom mb-4">
                <h6 class="fw-bold text-main mb-3">Date & Time</h6>
                <div class="mb-3">
                    <label class="form-label small text-muted-custom fw-bold">Date</label>
                    <input type="date" name="session_date" class="form-control"
                        value="{{ old('session_date', $session->session_date) }}" required
                        style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                </div>
                <div class="mb-3">
                    <label class="form-label small text-muted-custom fw-bold">Time</label>
                    <input type="time" name="session_time" class="form-control"
                        value="{{ old('session_time', \Carbon\Carbon::parse($session->session_time)->format('H:i')) }}"
                        required
                        style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                </div>
            </div>

            <div class="card-custom mb-0">
                <button type="submit" class="btn btn-primary w-100 fw-bold mb-2"
                    style="background-color: var(--accent-color); border: none; padding: 10px;">
                    <i class="bi bi-check-circle me-2"></i> Update Session
                </button>
                <a href="{{ route('mentor.sessions.calendar') }}" class="btn btn-outline-secondary w-100 fw-bold"
                    style="border-color: var(--border-color); color: var(--text-muted);">
                    Cancel
                </a>
            </div>
        </div>
    </div>
</form>

@endsection
