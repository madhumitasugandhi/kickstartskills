
    {{-- ================= SEARCH & FILTER ================= --}}
    <div class="glass-card mb-4">

        <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap mb-3">
            <div class="input-group-custom flex-grow-1">
                <i class="bi bi-search"></i>
                <input class="form-control ps-5"
                       placeholder="Search payments by student, program, installment...">
            </div>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <button class="tab-btn active">✓ All Payments</button>
            <button class="tab-btn">Paid</button>
            <button class="tab-btn">Pending</button>
            <button class="tab-btn">Overdue</button>
        </div>

    </div>

    {{-- ================= PAYMENTS LIST ================= --}}
    <div class="drive-list">

        @foreach([
            [
                'name'=>'Rahul Sharma',
                'program'=>'B.Tech Computer Science',
                'installment'=>'Semester Fee – Installment 1',
                'amount'=>'₹45,000',
                'due'=>'15/04/2024',
                'paid'=>'12/04/2024',
                'status'=>'Paid'
            ],
            [
                'name'=>'Priya Patel',
                'program'=>'M.Tech Data Science',
                'installment'=>'Semester Fee – Installment 1',
                'amount'=>'₹55,000',
                'due'=>'15/04/2024',
                'paid'=>'10/04/2024',
                'status'=>'Paid'
            ]
        ] as $p)

<div class="drive-card drive-approval-card position-relative">

            {{-- LEFT --}}
            <div class="drive-left">

                <div class="drive-header">
                    <div class="company-avatar">
                        {{ strtoupper(substr($p['name'],0,2)) }}
                    </div>

                    <div>
                        <h6 class="mb-1">{{ $p['name'] }}</h6>
                        <small class="">
                            {{ $p['program'] }} <br>
                            {{ $p['installment'] }}
                        </small>
                    </div>
                </div>

                <div class="d-flex gap-4 mt-3 small ">
                    <span>
                        Amount <br>
                        <strong class="text-teal">{{ $p['amount'] }}</strong>
                    </span>

                    <span>
                        Due Date <br>
                        <strong class="text-white">{{ $p['due'] }}</strong>
                    </span>

                    <span>
                        Paid On <br>
                        <strong class="text-success">{{ $p['paid'] }}</strong>
                    </span>
                </div>

            </div>

            {{-- RIGHT --}}
            <div class="drive-right">

                <span class="status-pill active">
                    {{ $p['status'] }}
                </span>

                <div class="student-actions mt-2">
                    <button class="icon-btn kebab-btn">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>

                    <ul class="kebab-menu">
                        <li>
                            <i class="bi bi-eye"></i> View Receipt
                        </li>
                        <li>
                            <i class="bi bi-download"></i> Download Invoice
                        </li>
                        <li>
                            <i class="bi bi-envelope"></i> Send Reminder
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        @endforeach

    </div>



{{-- ================= KEBAB MENU SCRIPT ================= --}}
<script>
document.addEventListener('click', function (e) {

    document.querySelectorAll('.kebab-menu')
        .forEach(menu => menu.classList.remove('show'));

    const btn = e.target.closest('.kebab-btn');
    if (!btn) return;

    e.stopPropagation();
    btn.nextElementSibling.classList.toggle('show');
});

document.querySelectorAll('.kebab-menu').forEach(menu => {
    menu.addEventListener('click', e => e.stopPropagation());
});
</script>

