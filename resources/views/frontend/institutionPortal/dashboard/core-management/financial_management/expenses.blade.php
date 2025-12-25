

    {{-- ================= SEARCH ================= --}}
    <div class="glass-card mb-4">
        <div class="input-group-custom">
            <i class="bi bi-search"></i>
            <input class="form-control ps-5"
                   placeholder="Search expenses by category, vendor, approval...">
        </div>
    </div>

    {{-- ================= EXPENSE LIST ================= --}}
    <div class="drive-list">

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

        <div class="drive-card drive-approval-card">

            {{-- LEFT --}}
            <div class="drive-left">

                <div class="drive-header">
                    <div class="company-avatar">
                        <i class="bi bi-wallet2"></i>
                    </div>

                    <div>
                        <h6 class="mb-1">{{ $e['title'] }}</h6>
                        <small class="">
                            {{ $e['desc'] }} <br>
                            Vendor: {{ $e['vendor'] }} • Approved by: {{ $e['approved'] }}
                        </small>
                    </div>
                </div>

                <div class="expense-metrics mt-3 small">
                <span>
                        Amount <br>
                        <strong class="text-warning">{{ $e['amount'] }}</strong>
                    </span>

                    <span>
                        Budget Allocated <br>
                        <strong class="text-white">{{ $e['budget'] }}</strong>
                    </span>

                    <span>
                        Variance <br>
                        <strong class="text-{{ $e['varianceClass'] }}">
                            {{ $e['variance'] }}
                        </strong>
                    </span>

                    <span>
                        Date <br>
                        <strong class="text-white">{{ $e['date'] }}</strong>
                    </span>
                </div>

            </div>

            {{-- RIGHT --}}
            <div class="drive-right">

                <div class="d-flex align-items-center gap-2">
                    <span class="status-pill {{ $e['status']==='Paid' ? 'active' : 'warning' }}">
                        {{ $e['status'] }}
                    </span>

                    <div class="student-actions">
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

