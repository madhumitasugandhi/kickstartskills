<div class="financial-tabs-wrapper mb-4">

    <!-- DESKTOP TABS -->
    <div class="course-tabs financial-tabs desktop-tabs">
        <a class="tab-btn {{ $tab === 'overview' ? 'active' : '' }}"
           href="{{ route('institution.financial-management', 'overview') }}">
            <i class="bi bi-pie-chart"></i> Overview
        </a>

        <a class="tab-btn {{ $tab === 'fee-structure' ? 'active' : '' }}"
           href="{{ route('institution.financial-management', 'fee-structure') }}">
            <i class="bi bi-card-list"></i> Fee Structures
        </a>

        <a class="tab-btn {{ $tab === 'payments' ? 'active' : '' }}"
           href="{{ route('institution.financial-management', 'payments') }}">
            <i class="bi bi-cash-stack"></i> Payments
        </a>

        <a class="tab-btn {{ $tab === 'expenses' ? 'active' : '' }}"
           href="{{ route('institution.financial-management', 'expenses') }}">
            <i class="bi bi-receipt"></i> Expenses
        </a>

        <a class="tab-btn {{ $tab === 'reports' ? 'active' : '' }}"
           href="{{ route('institution.financial-management', 'reports') }}">
            <i class="bi bi-file-earmark-text"></i> Reports
        </a>
    </div>

    <!-- MOBILE DROPDOWN -->
    <!-- MOBILE DROPDOWN -->
<div class="mobile-tabs d-none">

<div class="financial-dropdown">
    <button class="dropdown-trigger" id="financeTabBtn">
        <span>
            <i class="bi bi-grid"></i>
            {{ ucfirst(str_replace('-', ' ', $tab)) }}
        </span>
        <i class="bi bi-chevron-down"></i>
    </button>

    <ul class="dropdown-menu-custom" id="financeTabMenu">
        <li>
            <a href="{{ route('institution.financial-management','overview') }}"
               class="{{ $tab==='overview'?'active':'' }}">
                <i class="bi bi-pie-chart"></i> Overview
            </a>
        </li>
        <li>
            <a href="{{ route('institution.financial-management','fee-structure') }}"
               class="{{ $tab==='fee-structure'?'active':'' }}">
                <i class="bi bi-card-list"></i> Fee Structures
            </a>
        </li>
        <li>
            <a href="{{ route('institution.financial-management','payments') }}"
               class="{{ $tab==='payments'?'active':'' }}">
                <i class="bi bi-cash-stack"></i> Payments
            </a>
        </li>
        <li>
            <a href="{{ route('institution.financial-management','expenses') }}"
               class="{{ $tab==='expenses'?'active':'' }}">
                <i class="bi bi-receipt"></i> Expenses
            </a>
        </li>
        <li>
            <a href="{{ route('institution.financial-management','reports') }}"
               class="{{ $tab==='reports'?'active':'' }}">
                <i class="bi bi-file-earmark-text"></i> Reports
            </a>
        </li>
    </ul>
</div>

</div>


</div>
<style>
    /* ==========================================
   FINANCIAL TABS – RESPONSIVE DROPDOWN
========================================== */

.financial-tabs-wrapper {
    width: 100%;
}

/* Mobile default hidden */
.mobile-tabs {
    width: 100%;
}

/* Dropdown styling */
.financial-tab-select {
    background: var(--bg-input);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 12px 14px;
    color: var(--text-main);
    font-weight: 500;
}

/* Icon spacing inside select (optional) */
.financial-tab-select option {
    padding: 6px;
}

/* =====================
   RESPONSIVE SWITCH
===================== */
@media (max-width: 768px) {

    .desktop-tabs {
        display: none !important;
    }

    .mobile-tabs {
        display: block !important;
    }

}
/* ===============================
   MOBILE FINANCIAL DROPDOWN
================================ */

.financial-dropdown {
    position: relative;
    width: 100%;
}

.dropdown-trigger {
    width: 100%;
    padding: 12px 16px;
    border-radius: 14px;
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    color: var(--text-main);
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-weight: 600;
}

.dropdown-trigger i {
    font-size: 1rem;
    color: var(--text-muted);
}

.dropdown-trigger span {
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Menu */
.financial-dropdown .dropdown-menu-custom {
    position: absolute;
    top: calc(100% + 8px);
    left: -30px;
    width: 100%;
    background: var(--bg-sidebar);
    border: 1px solid var(--border-color);
    border-radius: 14px;
    padding: 8px;
    list-style: none;
    display: none;
    z-index: 1000;
    box-shadow: var(--shadow-sm);
}

.financial-dropdown .dropdown-menu-custom li a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 14px;
    border-radius: 10px;
    font-size: 0.9rem;
    color: var(--text-main);
    text-decoration: none;
}

.financial-dropdown .dropdown-menu-custom li a:hover {
    background: rgba(255,255,255,0.06);
}

.financial-dropdown .dropdown-menu-custom li a.active {
    background: rgba(45,212,191,0.18);
    color: var(--primary-teal);
    font-weight: 600;
}

/* Show */
.financial-dropdown.open .dropdown-menu-custom {
    display: block;
}

</style>
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
