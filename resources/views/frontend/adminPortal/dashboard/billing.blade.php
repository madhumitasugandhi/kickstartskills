@extends('frontend.adminPortal.dashboard.layouts.app')

@section('title', 'Billing & Subscriptions')

@section('icon', 'bi-credit-card')

@section('content')
<style>
    /* --- Billing Page Styles --- */

    /* Tab Navigation Container */
    .billing-tabs-container {
        margin-bottom: 24px;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    @media (min-width: 992px) {
        .billing-tabs-container {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }
    }

    /* The Pills Wrapper */
    .billing-pills {
        display: inline-flex;
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        padding: 4px;
        border-radius: 8px;
        /* Mobile: Scrollable */
        overflow-x: auto;
        white-space: nowrap;
        max-width: 100%;
    }

    /* Desktop: Normal (No Scrollbar) */
    @media (min-width: 992px) {
        .billing-pills {
            overflow-x: visible;
            white-space: normal;
        }
    }

    /* Hide scrollbar for mobile */
    .billing-pills::-webkit-scrollbar { height: 0px; background: transparent; }

    .billing-pill {
        border: none;
        background: transparent;
        color: var(--text-muted);
        font-weight: 500;
        font-size: 0.9rem;
        padding: 8px 20px;
        border-radius: 6px;
        cursor: pointer;
        transition: 0.2s;
        flex-shrink: 0;
    }
    .billing-pill:hover { color: var(--text-main); }
    .billing-pill.active { background-color: #dc2626; color: white; }

    /* Action Buttons */
    .btn-action-billing {
        background-color: transparent;
        border: 1px solid var(--border-color);
        color: var(--text-main);
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: 0.2s;
        flex-grow: 1;
    }
    @media (min-width: 768px) { .btn-action-billing { flex-grow: 0; } }

    .btn-action-billing:hover { background-color: var(--bg-hover); border-color: var(--text-muted); }
    .btn-report { background-color: rgba(220, 38, 38, 0.1); color: #dc2626; border-color: rgba(220, 38, 38, 0.3); }
    .btn-report:hover { background-color: #dc2626; color: white; }

    /* Search Bar Area */
    .billing-search-row {
        display: flex;
        gap: 12px;
        margin-bottom: 24px;
        flex-direction: column;
    }
    @media (min-width: 768px) { .billing-search-row { flex-direction: row; } }

    .billing-search {
        background-color: var(--bg-body);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        padding: 10px 16px;
        border-radius: 8px;
        width: 100%;
    }
    .billing-search:focus { outline: none; border-color: #dc2626; }

    /* Stats Cards */
    .billing-stat-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .stat-icon-bill { font-size: 1.5rem; margin-bottom: 12px; }
    .stat-val-bill { font-size: 1.8rem; font-weight: 700; color: var(--text-main); margin-bottom: 4px; }
    .stat-lbl-bill { font-size: 0.9rem; color: var(--text-muted); }

    /* Lists (Subscriptions, Invoices, Transactions) */
    .list-box {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 0; /* Padding inside items */
        overflow: hidden;
    }

    .list-header { padding: 20px; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; }

    .list-item {
        padding: 16px 20px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        flex-direction: column;
        gap: 12px;
        transition: background 0.2s;
    }
    @media (min-width: 992px) {
        .list-item { flex-direction: row; align-items: center; justify-content: space-between; gap: 0; }
    }
    .list-item:last-child { border-bottom: none; }
    .list-item:hover { background-color: rgba(255,255,255,0.01); }

    .list-meta-group { display: flex; gap: 24px; font-size: 0.85rem; color: var(--text-muted); flex-wrap: wrap; }
    .meta-label { font-size: 0.75rem; opacity: 0.7; display: block; margin-bottom: 2px; }
    .meta-val { color: var(--text-main); font-weight: 500; }

    /* Utilities */
    .text-success-custom { color: #10b981; }
    .text-danger-custom { color: #ef4444; }
    .bg-soft-success { background-color: rgba(16, 185, 129, 0.1); color: #10b981; }
    .bg-soft-danger { background-color: rgba(239, 68, 68, 0.1); color: #ef4444; }
    .bg-soft-warning { background-color: rgba(245, 158, 11, 0.1); color: #f59e0b; }

</style>

<div class="billing-tabs-container">
    <div class="billing-pills">
        <button class="billing-pill active" onclick="switchBillTab('overview')">Overview</button>
        <button class="billing-pill" onclick="switchBillTab('subscriptions')">Subscriptions</button>
        <button class="billing-pill" onclick="switchBillTab('transactions')">Transactions</button>
        <button class="billing-pill" onclick="switchBillTab('invoices')">Invoices</button>
    </div>
    <div class="d-flex gap-2 w-100 w-lg-auto">
        <button class="btn-action-billing"><i class="bi bi-download"></i> Export Data</button>
        <button class="btn-action-billing btn-report"><i class="bi bi-file-earmark-text"></i> Generate Report</button>
    </div>
</div>

<div class="billing-search-row">
    <div class="position-relative flex-grow-1">
        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 --text-muted"></i>
        <input type="text" class="billing-search ps-5" placeholder="Search transactions, invoices, companies...">
    </div>
    <select class="form-select border-secondary --text-muted w-auto">
        <option>This Month</option>
        <option>Last Month</option>
        <option>This Year</option>
    </select>
</div>

<div id="tab-overview" class="bill-content-block">
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6 col-xl-3">
            <div class="billing-stat-card">
                <i class="bi bi-currency-dollar stat-icon-bill text-success-custom"></i>
                <div class="stat-val-bill">$2,450,000</div>
                <div class="stat-lbl-bill">Total Revenue</div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="billing-stat-card">
                <i class="bi bi-graph-up-arrow stat-icon-bill text-danger-custom"></i>
                <div class="stat-val-bill">$185,000</div>
                <div class="stat-lbl-bill">Monthly Revenue</div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="billing-stat-card">
                <i class="bi bi-people stat-icon-bill text-primary"></i>
                <div class="stat-val-bill">342</div>
                <div class="stat-lbl-bill">Active Subscriptions</div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="billing-stat-card">
                <i class="bi bi-arrow-down-right stat-icon-bill text-warning"></i>
                <div class="stat-val-bill">2.1%</div>
                <div class="stat-lbl-bill">Churn Rate</div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-xl-8">
            <div class="list-box h-100 p-4 d-flex flex-column">
                <h6 class="fw-bold text-main mb-4">Revenue Overview</h6>
                <div class="flex-grow-1 d-flex align-items-center justify-content-center rounded border border-secondary border-opacity-25" style="min-height: 300px;">
                    <div class="text-center --text-muted ">
                        <i class="bi bi-bar-chart-fill fs-1 mb-2 text-danger"></i>
                        <p class="mb-0">Revenue Chart</p>
                        <small class="opacity-75">Chart integration pending</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="list-box h-100">
                <div class="list-header border-0 pb-0">
                    <h6 class="fw-bold text-main m-0">Recent Transactions</h6>
                    <a href="#" class="text-primary text-decoration-none small" onclick="switchBillTab('transactions')">View All</a>
                </div>

                <div class="px-3 pt-3">
                    <div class="d-flex align-items-center justify-content-between py-3 border-bottom border-secondary border-opacity-10">
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-2 rounded --text-muted border border-secondary border-opacity-25"><i class="bi bi-credit-card"></i></div>
                            <div>
                                <div class="small fw-bold text-main">Tech University</div>
                                <small class="--text-muted" style="font-size: 0.7rem;">2024-01-30</small>
                            </div>
                        </div>
                        <span class="text-success-custom fw-bold small">+$2,499</span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between py-3 border-bottom border-secondary border-opacity-10">
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-2 rounded --text-muted border border-secondary border-opacity-25"><i class="bi bi-wallet2"></i></div>
                            <div>
                                <div class="small fw-bold text-main">Business College</div>
                                <small class="--text-muted" style="font-size: 0.7rem;">2024-01-30</small>
                            </div>
                        </div>
                        <span class="text-success-custom fw-bold small">+$500</span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between py-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-2 rounded --text-muted border border-secondary border-opacity-25"><i class="bi bi-arrow-counterclockwise"></i></div>
                            <div>
                                <div class="small fw-bold text-main">Training Institute</div>
                                <small class="--text-muted" style="font-size: 0.7rem;">2024-01-29</small>
                            </div>
                        </div>
                        <span class="text-danger-custom fw-bold small">-$1,200</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="tab-subscriptions" class="bill-content-block d-none">
    <div class="list-box">
        <div class="list-header">
            <h6 class="fw-bold text-main m-0">Subscription Management</h6>
        </div>

        <div class="list-item">
            <div class="d-flex align-items-center gap-3">
                <div>
                    <h6 class="fw-bold text-main mb-0">Tech University</h6>
                    <small class="text-danger">Enterprise Pro</small>
                </div>
            </div>
            <div class="list-meta-group">
                <div><span class="meta-label">Amount</span> <span class="meta-val">$2,499/mo</span></div>
                <div><span class="meta-label">Next Payment</span> <span class="meta-val">2024-02-15</span></div>
                <div><span class="meta-label">Users</span> <span class="meta-val">2500</span></div>
            </div>
            <div class="d-flex align-items-center gap-3 w-100 w-lg-auto justify-content-between justify-content-lg-end">
                <span class="badge bg-soft-success px-3 py-2">Active</span>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-link text-decoration-none">View Details</button>
                    <button class="btn btn-sm btn-link text-decoration-none --text-muted">Actions</button>
                </div>
            </div>
        </div>

        <div class="list-item">
            <div>
                <h6 class="fw-bold text-main mb-0">Business College</h6>
                <small class="--text-muted">Professional</small>
            </div>
            <div class="list-meta-group">
                <div><span class="meta-label">Amount</span> <span class="meta-val">$999/mo</span></div>
                <div><span class="meta-label">Next Payment</span> <span class="meta-val">2024-02-12</span></div>
                <div><span class="meta-label">Users</span> <span class="meta-val">800</span></div>
            </div>
            <div class="d-flex align-items-center gap-3 w-100 w-lg-auto justify-content-between justify-content-lg-end">
                <span class="badge bg-soft-success px-3 py-2">Active</span>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-link text-decoration-none">View Details</button>
                    <button class="btn btn-sm btn-link text-decoration-none --text-muted">Actions</button>
                </div>
            </div>
        </div>

        <div class="list-item">
            <div>
                <h6 class="fw-bold text-main mb-0">Training Institute</h6>
                <small class="--text-muted">Standard</small>
            </div>
            <div class="list-meta-group">
                <div><span class="meta-label">Amount</span> <span class="meta-val">$499/mo</span></div>
                <div><span class="meta-label">Next Payment</span> <span class="meta-val">-</span></div>
                <div><span class="meta-label">Users</span> <span class="meta-val">0</span></div>
            </div>
            <div class="d-flex align-items-center gap-3 w-100 w-lg-auto justify-content-between justify-content-lg-end">
                <span class="badge bg-soft-danger px-3 py-2">Cancelled</span>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-link text-decoration-none">View Details</button>
                    <button class="btn btn-sm btn-link text-decoration-none --text-muted">Actions</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="tab-transactions" class="bill-content-block d-none">
    <div class="list-box">
        <div class="list-header">
            <h6 class="fw-bold text-main m-0">All Transactions</h6>
        </div>

        <div class="list-item">
            <div>
                <h6 class="fw-bold text-main mb-0">Monthly Subscription Payment</h6>
                <small class="--text-muted">ID: TXN_001</small>
            </div>
            <div class="list-meta-group">
                <div><span class="meta-label">Date</span> <span class="meta-val">2024-01-30 14:23</span></div>
                <div><span class="meta-label">Method</span> <span class="meta-val">Credit Card</span></div>
                <div><span class="meta-label">Institution</span> <span class="meta-val">Tech University</span></div>
            </div>
            <div class="text-lg-end w-100 w-lg-auto d-flex flex-lg-column justify-content-between align-items-center align-items-lg-end">
                <div class="fw-bold text-success-custom">+$2,499</div>
                <small class="text-success-custom opacity-75">completed</small>
            </div>
        </div>

        <div class="list-item">
            <div>
                <h6 class="fw-bold text-main mb-0">Setup Fee Payment</h6>
                <small class="--text-muted">ID: TXN_002</small>
            </div>
            <div class="list-meta-group">
                <div><span class="meta-label">Date</span> <span class="meta-val">2024-01-30 11:45</span></div>
                <div><span class="meta-label">Method</span> <span class="meta-val">Bank Transfer</span></div>
                <div><span class="meta-label">Institution</span> <span class="meta-val">Business College</span></div>
            </div>
            <div class="text-lg-end w-100 w-lg-auto d-flex flex-lg-column justify-content-between align-items-center align-items-lg-end">
                <div class="fw-bold text-success-custom">+$500</div>
                <small class="text-success-custom opacity-75">completed</small>
            </div>
        </div>

        <div class="list-item">
            <div>
                <h6 class="fw-bold text-main mb-0">Subscription Refund</h6>
                <small class="--text-muted">ID: TXN_003</small>
            </div>
            <div class="list-meta-group">
                <div><span class="meta-label">Date</span> <span class="meta-val">2024-01-29 16:12</span></div>
                <div><span class="meta-label">Method</span> <span class="meta-val">Credit Card</span></div>
                <div><span class="meta-label">Institution</span> <span class="meta-val">Training Institute</span></div>
            </div>
            <div class="text-lg-end w-100 w-lg-auto d-flex flex-lg-column justify-content-between align-items-center align-items-lg-end">
                <div class="fw-bold text-danger-custom">-$1,200</div>
                <small class="text-success-custom opacity-75">completed</small>
            </div>
        </div>
    </div>
</div>

<div id="tab-invoices" class="bill-content-block d-none">
    <div class="list-box">
        <div class="list-header">
            <h6 class="fw-bold text-main m-0">Invoice Management</h6>
            <button class="btn btn-sm btn-danger d-flex align-items-center gap-2"><i class="bi bi-plus-lg"></i> Generate Invoice</button>
        </div>

        <div class="list-item">
            <div>
                <h6 class="fw-bold text-main mb-0">Invoice INV-2024-001</h6>
                <small class="text-danger">Tech University</small>
            </div>
            <div class="list-meta-group">
                <div><span class="meta-label">Date</span> <span class="meta-val">2024-01-01</span></div>
                <div><span class="meta-label">Due Date</span> <span class="meta-val">2024-01-15</span></div>
                <div><span class="meta-label">Period</span> <span class="meta-val">January 2024</span></div>
            </div>
            <div class="d-flex align-items-center gap-4 w-100 w-lg-auto justify-content-between justify-content-lg-end">
                <div class="text-end">
                    <div class="fw-bold text-success-custom">$2,499</div>
                    <small class="text-success-custom opacity-50" style="font-size: 0.65rem;">PAID</small>
                </div>
                <div class="d-flex gap-3">
                    <button class="btn btn-sm btn-link text-decoration-none p-0 d-flex align-items-center gap-1"><i class="bi bi-download"></i> Download</button>
                    <button class="btn btn-sm btn-link text-decoration-none p-0 d-flex align-items-center gap-1"><i class="bi bi-envelope"></i> Send</button>
                </div>
            </div>
        </div>

        <div class="list-item">
            <div>
                <h6 class="fw-bold text-main mb-0">Invoice INV-2024-002</h6>
                <small class="--text-muted">Business College</small>
            </div>
            <div class="list-meta-group">
                <div><span class="meta-label">Date</span> <span class="meta-val">2024-01-01</span></div>
                <div><span class="meta-label">Due Date</span> <span class="meta-val">2024-01-15</span></div>
                <div><span class="meta-label">Period</span> <span class="meta-val">January 2024</span></div>
            </div>
            <div class="d-flex align-items-center gap-4 w-100 w-lg-auto justify-content-between justify-content-lg-end">
                <div class="text-end">
                    <div class="fw-bold text-success-custom">$999</div>
                    <small class="text-success-custom opacity-50" style="font-size: 0.65rem;">PAID</small>
                </div>
                <div class="d-flex gap-3">
                    <button class="btn btn-sm btn-link text-decoration-none p-0 d-flex align-items-center gap-1"><i class="bi bi-download"></i> Download</button>
                    <button class="btn btn-sm btn-link text-decoration-none p-0 d-flex align-items-center gap-1"><i class="bi bi-envelope"></i> Send</button>
                </div>
            </div>
        </div>

        <div class="list-item">
            <div>
                <h6 class="fw-bold text-main mb-0">Invoice INV-2024-003</h6>
                <small class="text-danger">Medical School</small>
            </div>
            <div class="list-meta-group">
                <div><span class="meta-label">Date</span> <span class="meta-val">2024-01-01</span></div>
                <div><span class="meta-label">Due Date</span> <span class="meta-val">2024-01-15</span></div>
                <div><span class="meta-label">Period</span> <span class="meta-val">January 2024</span></div>
            </div>
            <div class="d-flex align-items-center gap-4 w-100 w-lg-auto justify-content-between justify-content-lg-end">
                <div class="text-end">
                    <div class="fw-bold text-success-custom">$4,999</div>
                    <small class="text-danger-custom opacity-75" style="font-size: 0.65rem;">OVERDUE</small>
                </div>
                <div class="d-flex gap-3">
                    <button class="btn btn-sm btn-link text-decoration-none p-0 d-flex align-items-center gap-1"><i class="bi bi-download"></i> Download</button>
                    <button class="btn btn-sm btn-link text-decoration-none p-0 d-flex align-items-center gap-1"><i class="bi bi-envelope"></i> Send</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function switchBillTab(tabName) {
        document.querySelectorAll('.billing-pill').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');

        document.querySelectorAll('.bill-content-block').forEach(el => el.classList.add('d-none'));
        document.getElementById('tab-' + tabName).classList.remove('d-none');
    }
</script>

@endsection
