{{-- ================= SEARCH ================= --}}
<div class="ui-card mb-4">
    <div class="input-group-custom">
        <i class="bi bi-search"></i>
        <input class="form-control"
               placeholder="Search expenses by category, vendor, approval...">
    </div>
</div>


{{-- ================= EXPENSE LIST ================= --}}
@foreach([
    [
        'title'=>'Faculty Salaries',
        'desc'=>'Monthly faculty compensation',
        'vendor'=>'Internal',
        'approved'=>'Finance Head',
        'amount'=>'₹850,000',
        'budget'=>'₹900,000',
        'variance'=>'↓ ₹50,000',
        'varianceClass'=>'success',
        'date'=>'1/6/2024',
        'status'=>'Paid'
    ],
    [
        'title'=>'Infrastructure',
        'desc'=>'Lab equipment and maintenance',
        'vendor'=>'TechEquip Solutions',
        'approved'=>'Principal',
        'amount'=>'₹250,000',
        'budget'=>'₹300,000',
        'variance'=>'↓ ₹50,000',
        'varianceClass'=>'success',
        'date'=>'5/6/2024',
        'status'=>'Paid'
    ],
    [
        'title'=>'Utilities',
        'desc'=>'Electricity, water, internet bills',
        'vendor'=>'Multiple Vendors',
        'approved'=>'Admin Head',
        'amount'=>'₹125,000',
        'budget'=>'₹120,000',
        'variance'=>'↑ ₹5,000',
        'varianceClass'=>'danger',
        'date'=>'10/6/2024',
        'status'=>'Pending'
    ]
] as $e)

<div class="ui-card">
    <div class="ui-split">

        {{-- LEFT --}}
        <div class="ui-split-left">

            <div class="d-flex align-items-center gap-2">
                <div class="ui-avatar">
                    <i class="bi bi-wallet2"></i>
                </div>

                <div>
                    <div class="ui-card-title">{{ $e['title'] }}</div>
                    <div class="ui-card-subtitle">
                        {{ $e['desc'] }} • Vendor: {{ $e['vendor'] }} • Approved: {{ $e['approved'] }}
                    </div>
                </div>
            </div>

            <div class="ui-meta mt-2">
                <span>
                    Amount: <strong>{{ $e['amount'] }}</strong>
                </span>

                <span>
                    Budget: <strong>{{ $e['budget'] }}</strong>
                </span>

                <span>
                    Variance:
                    <strong class="text-{{ $e['varianceClass'] }}">
                        {{ $e['variance'] }}
                    </strong>
                </span>

                <span>
                    Date: <strong>{{ $e['date'] }}</strong>
                </span>
            </div>

        </div>

        {{-- RIGHT --}}
        <div class="ui-split-right student-actions">

            <span class="status-pill">
                {{ $e['status'] }}
            </span>

            <button class="icon-btn kebab-btn">
                <i class="bi bi-three-dots-vertical"></i>
            </button>

            <ul class="kebab-menu">
                <li>
                    <i class="bi bi-eye"></i> View Details
                </li>
                <li>
                    <i class="bi bi-pencil"></i> Edit Expense
                </li>
                <li class="danger">
                    <i class="bi bi-trash"></i> Delete
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

