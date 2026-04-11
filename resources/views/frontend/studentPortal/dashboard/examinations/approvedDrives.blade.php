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

        @if($drive->payment_status == 'paid')
    <div class="paid-badge">
        <i class="bi bi-check-circle-fill me-1"></i> Paid
    </div>
@endif

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

        @if($drive->payment_status == 'paid')
    <a href="{{ route('student.exam.startDrive', $drive->drive_id) }}"
       class="btn-start">
        <i class="bi bi-play-fill"></i> Start Exam
    </a>
@else
    <button class="btn-start pay-btn"
            data-drive="{{ $drive->drive_id }}">
        Pay ₹100 & Unlock Exam
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
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    document.querySelectorAll('.pay-btn').forEach(btn => {

        btn.addEventListener('click', function() {

            let driveId = this.dataset.drive;
            console.log(driveId);
            fetch('/student/dashboard/examinations/payment/create/' + driveId, {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Accept': 'application/json'
    }
})
.then(res => {
    if (!res.ok) throw new Error("Server error");
    return res.json();
})
.then(data => {

    if (data.error) {
        alert(data.error);
        return;
    }

    var options = {
        key: data.key,
        amount: data.amount * 100,
        currency: "INR",
        name: "Platform Fee",
        description: "Drive Exam Access",
        order_id: data.order_id,

        handler: function(response) {

            fetch('/student/dashboard/examinations/payment/success', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(response)
            })
            .then(res => res.json())
            .then(data => {
    Swal.fire({
        icon: 'success',
        title: 'Payment Successful!',
        text: 'You can now start your exam.',
        confirmButtonText: 'Start Now'
    }).then(() => {
        location.reload(); 
    });
});
        }
    };

    var rzp = new Razorpay(options);
    rzp.open();
})
.catch(err => {
    console.error(err);
    alert("Something went wrong");
});

        });

    });
</script>
@endpush
@endsection