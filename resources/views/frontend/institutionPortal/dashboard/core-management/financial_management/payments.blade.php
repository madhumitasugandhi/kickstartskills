
  {{-- ================= SEARCH & FILTER ================= --}}
<div class="ui-card mb-4">

<div class="d-flex justify-content-between align-items-center gap-3 flex-wrap mb-3">
    <div class="input-group-custom flex-grow-1">
        <i class="bi bi-search"></i>
        <input class="form-control"
               placeholder="Search payments by student, program, installment...">
    </div>
</div>

<div class="ui-tabs">
    <button class="ui-tab active">All Payments</button>
    <button class="ui-tab">Paid</button>
    <button class="ui-tab">Pending</button>
    <button class="ui-tab">Overdue</button>
</div>

</div>


{{-- ================= PAYMENTS LIST ================= --}}
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

<div class="ui-card">
<div class="ui-split">

    {{-- LEFT --}}
    <div class="ui-split-left">

        <div class="d-flex align-items-center gap-2">
            <div class="ui-avatar">
                {{ strtoupper(substr($p['name'],0,2)) }}
            </div>

            <div>
                <div class="ui-card-title">{{ $p['name'] }}</div>
                <div class="ui-card-subtitle">
                    {{ $p['program'] }} • {{ $p['installment'] }}
                </div>
            </div>
        </div>

        <div class="ui-meta mt-2">
            <span>
                Amount: <strong>{{ $p['amount'] }}</strong>
            </span>

            <span>
                Due: <strong>{{ $p['due'] }}</strong>
            </span>

            <span>
                Paid: <strong class="text-success">{{ $p['paid'] }}</strong>
            </span>
        </div>

    </div>

    {{-- RIGHT --}}
    <div class="ui-split-right student-actions">

        <span class="status-pill">
            {{ $p['status'] }}
        </span>

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

