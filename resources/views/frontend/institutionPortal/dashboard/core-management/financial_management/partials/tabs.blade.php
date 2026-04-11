<div class="ui-card mb-4">

    <!-- Desktop Tabs -->
    <div class="ui-tabs desktop-tabs">
        <a class="ui-tab {{ $tab === 'overview' ? 'active' : '' }}"
           href="{{ route('institution.core.financial-management', 'overview') }}">
            <i class="bi bi-pie-chart me-1"></i> Overview
        </a>

        <a class="ui-tab {{ $tab === 'fee-structure' ? 'active' : '' }}"
           href="{{ route('institution.core.financial-management', 'fee-structure') }}">
            <i class="bi bi-card-list me-1"></i> Fee Structures
        </a>

        <a class="ui-tab {{ $tab === 'payments' ? 'active' : '' }}"
           href="{{ route('institution.core.financial-management', 'payments') }}">
            <i class="bi bi-cash-stack me-1"></i> Payments
        </a>

        <a class="ui-tab {{ $tab === 'expenses' ? 'active' : '' }}"
           href="{{ route('institution.core.financial-management', 'expenses') }}">
            <i class="bi bi-receipt me-1"></i> Expenses
        </a>

        <a class="ui-tab {{ $tab === 'reports' ? 'active' : '' }}"
           href="{{ route('institution.core.financial-management', 'reports') }}">
            <i class="bi bi-file-earmark-text me-1"></i> Reports
        </a>
    </div>

    <!-- Mobile Dropdown -->
    <div class="mobile-tabs d-none mt-2">

        <div class="ui-dropdown">
            <button class="dropdown-trigger w-100" id="financeTabBtn">
                <span>
                    <i class="bi bi-grid"></i>
                    {{ ucfirst(str_replace('-', ' ', $tab)) }}
                </span>
                <i class="bi bi-chevron-down"></i>
            </button>

            <ul class="dropdown-menu" id="financeTabMenu">
                <li>
                    <a class="dropdown-item"
                       href="{{ route('institution.core.financial-management','overview') }}">
                        Overview
                    </a>
                </li>
                <li>
                    <a class="dropdown-item"
                       href="{{ route('institution.core.financial-management','fee-structure') }}">
                        Fee Structures
                    </a>
                </li>
                <li>
                    <a class="dropdown-item"
                       href="{{ route('institution.core.financial-management','payments') }}">
                        Payments
                    </a>
                </li>
                <li>
                    <a class="dropdown-item"
                       href="{{ route('institution.core.financial-management','expenses') }}">
                        Expenses
                    </a>
                </li>
                <li>
                    <a class="dropdown-item"
                       href="{{ route('institution.core.financial-management','reports') }}">
                        Reports
                    </a>
                </li>
            </ul>
        </div>

    </div>

</div>

<script>
document.addEventListener('click', function (e) {
    const dropdown = document.querySelector('.financial-dropdown');
    const trigger = document.getElementById('financeTabBtn');

    if (!dropdown || !trigger) return;

    if (trigger.contains(e.target)) {
        dropdown.classList.toggle('open');
        e.stopPropagation();
        return;
    }

    dropdown.classList.remove('open');
});
</script>
