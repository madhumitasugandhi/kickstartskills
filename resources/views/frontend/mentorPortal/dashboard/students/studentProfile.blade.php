@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Student Profile')

@section('icon', 'bi-person-badge fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card-custom text-center p-4 h-100">
            <div class="rounded-circle bg-soft-orange text-accent d-flex align-items-center justify-content-center mx-auto mb-3"
                style="width: 100px; height: 100px; font-size: 2.5rem; font-weight: bold;">
                {{ strtoupper(substr($student->full_name, 0, 1)) }}
            </div>
            <h4 class="fw-bold text-main mb-1">{{ $student->full_name }}</h4>
            <p class="text-muted-custom small mb-3">{{ $student->email }}</p>

            <div class="mb-4">
                @if($student->account_status == 'active')
                <span class="badge bg-soft-green text-green rounded-pill px-3 py-2">
                    <i class="bi bi-check-circle-fill me-1"></i> Active Student
                </span>
                @else
                <span class="badge bg-soft-orange text-accent rounded-pill px-3 py-2">
                    <i class="bi bi-clock-fill me-1"></i> {{ ucfirst($student->account_status) }}
                </span>
                @endif
            </div>

            <hr class="opacity-10">

            <div class="d-flex flex-column gap-2">
                <button class="btn btn-primary w-100 fw-bold border-0" style="background-color: var(--accent-color);">
                    <i class="bi bi-chat-dots me-2"></i> Send Message
                </button>
                <button class="btn btn-outline-secondary w-100 fw-bold small">
                    <i class="bi bi-envelope me-2"></i> Email Student
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card-custom mb-4">
            <h6 class="fw-bold text-main mb-4">Academic Progress</h6>
            <div class="row g-3">
                <div class="col-6 col-md-3">
                    <div class="p-3 rounded-3 bg-light text-center">
                        <small class="text-muted-custom d-block mb-1">Tasks</small>
                        <span class="fw-bold text-main">12/15</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3 rounded-3 bg-light text-center">
                        <small class="text-muted-custom d-block mb-1">Attendance</small>
                        <span class="fw-bold text-main">94%</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3 rounded-3 bg-light text-center">
                        <small class="text-muted-custom d-block mb-1">Sessions</small>
                        <span class="fw-bold text-main">04</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3 rounded-3 bg-light text-center">
                        <small class="text-muted-custom d-block mb-1">Rank</small>
                        <span class="fw-bold text-main">Top 10</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-custom">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold text-main m-0">Recent Activity</h6>
                <span class="text-accent small fw-bold" style="cursor:pointer">View Log</span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 small fw-bold text-muted">ACTIVITY</th>
                            <th class="border-0 small fw-bold text-muted">DATE</th>
                            <th class="border-0 small fw-bold text-muted">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><i class="bi bi-file-earmark-pdf me-2 text-danger"></i> Resume Uploaded</td>
                            <td class="small">2 hours ago</td>
                            <td><span class="text-success small fw-bold">Verified</span></td>
                        </tr>
                        <tr>
                            <td><i class="bi bi-calendar-event me-2 text-primary"></i> Mock Interview</td>
                            <td class="small">Yesterday</td>
                            <td><span class="text-warning small fw-bold">Completed</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
