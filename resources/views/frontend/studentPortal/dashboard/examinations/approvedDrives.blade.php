@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Approved Drives')
@section('icon', 'bi bi-check-circle fs-4 p-2 bg-success bg-opacity-10 rounded-3 text-success')

@section('content')
<style>
    /* Start Button Custom Style */
    .btn-start {
        background-color: #dfe7f6;
        /* Light Blue-Grey from image */
        color: #344054;
        border: none;
        padding: 12px 32px;
        border-radius: 8px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }

    .btn-start:hover {
        background-color: #cfd9ea;
        color: #1d2939;
    }

    [data-theme="dark"] .btn-start {
        background-color: #3a3f4b;
        color: #e9ecef;
    }

    [data-theme="dark"] .btn-start:hover {
        background-color: #4a505e;
    }

    .paid-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: var(--soft-green);
        color: var(--text-green);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 4px;
    }
</style>
<div class="content-body">

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('info'))
    <div class="alert alert-info">{{ session('info') }}</div>
    @endif

    @forelse($drives as $drive)
    <div class="card-custom mb-4 p-4 position-relative">
        <!-- HEADER -->
        <div class="d-flex align-items-start gap-4 mb-3">
            <div class="exam-icon-box">
                <i class="bi bi-briefcase"></i>
            </div>
            <div>
                <h5 class="fw-bold text-main mb-1">
                    {{ $drive->drive_title }}
                </h5>
                <p class="text-blue small mb-0">
                    {{ $drive->drive_type }} • {{ $drive->location }}
                </p>
            </div>
        </div>



        <!-- META INFO -->
        <div class="d-flex flex-wrap gap-4 mb-3 pb-3 border-bottom"
            style="border-color: var(--border-color) !important;">

            <div class="meta-item">
                <div class="d-flex flex-column">
                    <span class="meta-label">Exam Date</span>
                    <span class="meta-value">{{ $drive->exam_date }}</span>
                </div>
            </div>

            <div class="meta-item">
                <div class="d-flex flex-column">
                    <span class="meta-label">Start Time</span>
                    <span class="meta-value">{{ $drive->start_time }}</span>
                </div>
            </div>

            <div class="meta-item">
                <div class="d-flex flex-column">
                    <span class="meta-label">End Time</span>
                    <span class="meta-value">{{ $drive->end_time }}</span>
                </div>
            </div>

        </div>

        <!-- ACTION -->
        <div class="d-flex justify-content-end">

            {{-- Already Attempted --}}
            @if($drive->already_attempted)
            <button class="btn-start" disabled>
                <i class="bi bi-check-circle"></i> Attempted
            </button>

            {{-- Expired --}}
            @elseif($drive->is_expired)
            <button class="btn-start" disabled>
                <i class="bi bi-x-circle"></i> Expired
            </button>

            {{-- ✅ SUCCESS --}}
            @elseif($drive->payment_status == 'success')
            <a href="{{ route('student.exam.startDrive', $drive->drive_id) }}"
                class="btn-start">
                <i class="bi bi-play-fill"></i> Start Exam
            </a>

            {{-- ⏳ PENDING --}}
            @elseif($drive->payment_status == 'pending')
            <button class="btn-start" disabled>
                <i class="bi bi-hourglass-split"></i> Processing...
            </button>

            {{-- ❌ FAILED --}}
            @elseif($drive->payment_status == 'failed')
            <button class="btn-start retry-btn"
                data-drive="{{ $drive->drive_id }}">
                Retry Payment
            </button>

            {{-- 💰 DEFAULT --}}
            @else
            <button class="btn-start pay-btn"
                data-drive="{{ $drive->drive_id }}">
                Pay & Unlock Exam
            </button>
            @endif

        </div>

    </div>

    @empty
    <!-- EMPTY STATE -->
    <div class="card-custom text-center py-5">
        <div class="exam-icon-box mx-auto mb-3"
            style="background: var(--soft-orange); color: var(--text-orange);">
            <i class="bi bi-briefcase"></i>
        </div>
        <h5 class="fw-bold text-main">No Approved Drives</h5>
        <p class="--text-muted">
            You don't have any approved drives yet.
            Once institute assigns drives, they will appear here.
        </p>
    </div>
    @endforelse

</div>
@push('scripts')
<script>
    const ABLEPAY_URL = "{{ config('services.ablepay.base_url') }}v2/paymentrequest";
</script>
<script>
    document.querySelectorAll('.pay-btn, .retry-btn').forEach(btn => {

        btn.addEventListener('click', function() {

            let driveId = this.dataset.drive;

            this.disabled = true;
            this.innerText = "Processing...";

            fetch('/student/dashboard/examinations/payment/create/' + driveId, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {

                    if (!data.payment_data) {
                        alert("Payment init failed");
                        this.disabled = false;
                        this.innerText = this.classList.contains('retry-btn') ?
                            "Retry Payment" :
                            "Pay ₹10 & Unlock Exam";
                        return;
                    }

                    let form = document.createElement('form');
                    form.method = "POST";
                    form.action = ABLEPAY_URL;

                    Object.keys(data.payment_data).forEach(key => {
                        let input = document.createElement('input');
                        input.type = "hidden";
                        input.name = key;
                        input.value = data.payment_data[key];
                        form.appendChild(input);
                    });

                    document.body.appendChild(form);
                    form.submit();
                })
                .catch(() => {
                    alert("Something went wrong");
                    this.disabled = false;
                    this.innerText = this.classList.contains('retry-btn') ?
                        "Retry Payment" :
                        "Pay ₹10 & Unlock Exam";
                });

        });

    });

    window.addEventListener("pageshow", function () {
    resetButtons();
});

function resetButtons() {
    document.querySelectorAll('.pay-btn, .retry-btn').forEach(btn => {
        btn.disabled = false;

        if (btn.classList.contains('retry-btn')) {
            btn.innerText = "Retry Payment";
        } else {
            btn.innerText = "Pay & Unlock Exam";
        }
    });
}

</script>
@endpush
@endsection