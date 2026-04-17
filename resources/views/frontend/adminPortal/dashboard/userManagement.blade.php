@extends('frontend.adminPortal.dashboard.layouts.app')

@section('title', 'User Management')

@section('icon', 'bi-people')

@section('content')
<style>
    /* --- Page Specific Styles --- */

    /* Stats Cards */
    .user-stat-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        height: 100%;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .stat-icon-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.05);
        color: var(--text-muted);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        margin-bottom: 12px;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 2px;
    }

    .stat-label {
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .trend-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 4px;
    }

    .trend-up {
        color: #10b981;
        background-color: rgba(16, 185, 129, 0.1);
    }

    .trend-down {
        color: #ef4444;
        background-color: rgba(239, 68, 68, 0.1);
    }

    /* Navigation Tabs */
    .user-tabs {
        display: flex;
        gap: 16px;
        margin-bottom: 24px;
        border-bottom: 1px solid var(--border-color);
        overflow-x: auto;
        white-space: nowrap;
        padding-bottom: 4px;
    }

    .user-tabs::-webkit-scrollbar {
        height: 0px;
        background: transparent;
    }

    .user-tab-btn {
        background: transparent;
        border: none;
        color: var(--text-muted);
        padding: 10px 12px;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
        position: relative;
        transition: 0.2s;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .user-tab-btn:hover {
        color: var(--text-main);
    }

    .user-tab-btn.active {
        color: #ef4444;
    }

    .user-tab-btn.active::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #ef4444;
    }

    /* Filter Section */
    .filter-container {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 24px;
    }

    .search-input-drive {
        background-color: var(--bg-body);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        padding: 10px 16px;
        border-radius: 8px;
        width: 100%;
    }

    .filter-pill {
        border: 1px solid var(--border-color);
        background: transparent;
        color: var(--text-muted);
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        transition: 0.2s;
        cursor: pointer;
        display: inline-block;
        margin-right: 8px;
        margin-bottom: 8px;
        text-decoration: none;
    }

    .filter-pill:hover,
    .filter-pill.active {
        background-color: rgba(239, 68, 68, 0.1);
        color: #ef4444;
        border-color: #ef4444;
    }

    /* User List Item */
    .user-list-item {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: 0.2s;
        border-bottom: none;
    }

    .user-list-item:first-child {
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .user-list-item:last-child {
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
        border-bottom: 1px solid var(--border-color);
    }

    .user-list-item:hover {
        background-color: rgba(255, 255, 255, 0.02);
    }

    .user-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.9rem;
        margin-right: 16px;
        flex-shrink: 0;
    }

    .role-badge-sm {
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        display: block;
        text-align: right;
    }

    .status-active {
        color: #10b981;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .status-danger {
        color: #ef4444;
        font-size: 0.75rem;
        font-weight: 600;
    }

    /* Role Distribution Bars */
    .role-dist-row {
        margin-bottom: 16px;
    }

    .role-dist-label {
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
        margin-bottom: 6px;
        color: var(--text-muted);
    }

    .role-progress {
        height: 6px;
        background: var(--bg-body);
        border-radius: 3px;
        overflow: hidden;
    }

    .role-fill {
        height: 100%;
        border-radius: 3px;
    }

    /* Activity Items */
    .activity-item {
        padding: 16px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        gap: 12px;
        align-items: start;
    }

    .activity-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 1rem;
    }
</style>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show bg-soft-green text-green border-0 mb-4" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row g-4 mb-4">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="user-stat-card">
            <span class="trend-badge trend-up">+12%</span>
            <div class="stat-icon-circle text-danger"><i class="bi bi-people"></i></div>
            <div class="stat-value">{{ number_format($stats['total']) }}</div>
            <div class="stat-label">Total Users</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="user-stat-card">
            <span class="trend-badge trend-up">+8%</span>
            <div class="stat-icon-circle text-success"><i class="bi bi-person-check"></i></div>
            <div class="stat-value">{{ number_format($stats['active']) }}</div>
            <div class="stat-label">Active Users</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="user-stat-card">
            <span class="trend-badge trend-up">+{{ $stats['new_this_month'] > 0 ? 'New' : '0' }}</span>
            <div class="stat-icon-circle text-warning"><i class="bi bi-person-plus"></i></div>
            <div class="stat-value">{{ number_format($stats['new_this_month']) }}</div>
            <div class="stat-label">New This Month</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="user-stat-card">
            <span class="trend-badge text-blue bg-soft-blue">Live</span>
            <div class="stat-icon-circle text-blue"><i class="bi bi-circle"></i></div>
            <div class="stat-value">{{ number_format($stats['online_now']) }}</div>
            <div class="stat-label">Online Now</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="user-stat-card">
            <span class="trend-badge trend-down">-5%</span>
            <div class="stat-icon-circle text-danger"><i class="bi bi-person-x"></i></div>
            <div class="stat-value">{{ number_format($stats['suspended']) }}</div>
            <div class="stat-label">Suspended</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="user-stat-card">
            <span class="trend-badge trend-up">+15%</span>
            <div class="stat-icon-circle text-warning"><i class="bi bi-clock-history"></i></div>
            <div class="stat-value">{{ number_format($stats['pending']) }}</div>
            <div class="stat-label">Pending Verification</div>
        </div>
    </div>
</div>

<div class="user-tabs">
    <button class="user-tab-btn active" onclick="switchUserTab('users')"><i class="bi bi-people"></i> Users</button>
    <button class="user-tab-btn" onclick="switchUserTab('roles')"><i class="bi bi-shield-lock"></i> Roles</button>
    <button class="user-tab-btn" onclick="switchUserTab('activity')"><i class="bi bi-activity"></i> Activity</button>
</div>

<div id="tab-users" class="user-content-block">
    <div class="filter-container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mb-3">
            <form action="{{ route('admin.users') }}" method="GET" class="position-relative flex-grow-1 w-50">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 --text-muted"></i>
                <input type="text" name="search" value="{{ request('search') }}" class="search-input-drive ps-5"
                    placeholder="Search by name or email...">
            </form>

            <button
                class="btn btn-outline-danger d-flex align-items-center gap-2 w-500 w-md-auto justify-content-center"
                data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="bi bi-person-plus"></i> Add User
            </button>
        </div>

        <div class="filter-container">
            <form action="{{ route('admin.users') }}" method="GET" class="position-relative mb-4">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 --text-muted"></i>
                <input type="text" name="search" value="{{ request('search') }}" class="search-input-drive ps-5"
                    placeholder="Search users by name, email, or department...">
            </form>

            <div class="d-flex flex-wrap align-items-center gap-3">
                <span class="--text-muted small fw-bold"><i class="bi bi-funnel"></i> Filters:</span>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.users', array_merge(request()->query(), ['filter' => 'All'])) }}"
                        class="filter-pill {{ request('filter') == 'All' || !request('filter') ? 'active' : '' }}">All</a>
                    <a href="{{ route('admin.users', array_merge(request()->query(), ['filter' => '5'])) }}"
                        class="filter-pill {{ request('filter') == '5' ? 'active' : '' }}">Student</a>
                    <a href="{{ route('admin.users', array_merge(request()->query(), ['filter' => '4'])) }}"
                        class="filter-pill {{ request('filter') == '4' ? 'active' : '' }}">Institution</a>
                    <a href="{{ route('admin.users', array_merge(request()->query(), ['filter' => '3'])) }}"
                        class="filter-pill {{ request('filter') == '3' ? 'active' : '' }}">Mentor</a>
                    <a href="{{ route('admin.users', array_merge(request()->query(), ['filter' => '2'])) }}"
                        class="filter-pill {{ request('filter') == '2' ? 'active' : '' }}">HR</a>
                    <a href="{{ route('admin.users', array_merge(request()->query(), ['filter' => '1'])) }}"
                        class="filter-pill {{ request('filter') == '1' ? 'active' : '' }}">Admin</a>
                </div>

                <div class="vr mx-2 --text-muted d-none d-md-block"></div>

                <div class="d-flex gap-2">
                    <div class="d-flex gap-2">

                        <a href="{{ route('admin.users', array_merge(request()->query(), ['status' => 'All'])) }}"
                            class="filter-pill {{ request('status') == 'All' || !request('status') ? 'active' : '' }}">All</a>

                        <a href="{{ route('admin.users', array_merge(request()->query(), ['status' => 'active'])) }}"
                            class="filter-pill {{ request('status') == 'active' ? 'active' : '' }}">Active</a>

                        <a href="{{ route('admin.users', array_merge(request()->query(), ['status' => 'deactivated'])) }}"
                            class="filter-pill {{ request('status') == 'deactivated' ? 'active' : '' }}">Inactive</a>

                        <a href="{{ route('admin.users', array_merge(request()->query(), ['status' => 'suspended'])) }}"
                            class="filter-pill {{ request('status') == 'suspended' ? 'active' : '' }}">Suspended</a>
                        <a href="{{ route('admin.users', array_merge(request()->query(), ['status' => 'pending'])) }}"
                            class="filter-pill {{ request('status') == 'pending' ? 'active' : '' }}">Pending</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div>
        <h6 class="text-danger fw-bold mb-3 ms-1">
            <i class="bi bi-people me-2"></i> User Directory ({{ $users->count() }} users)
        </h6>

        <div class="d-flex flex-column">
            @forelse($users as $user)
            <div class="user-list-item">
                <div class="d-flex align-items-center">
                    <span class="--text-muted me-3 fw-bold small" style="min-width: 30px;">
                        {{ $loop->iteration }}
                    </span>
                    <div class="user-avatar bg-soft-danger text-danger">
                        @php
                        $name = ($user->admin_role_id == 4 && $user->institution)
                        ? $user->institution->institution_name
                        : $user->full_name;
                        @endphp

                        {{ strtoupper(substr($name, 0, 2)) }}
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-main">
                            @if($user->admin_role_id == 4)
                            {{ $user->institution->institution_name ?? $user->full_name }}
                            @else
                            {{ $user->full_name }}
                            @endif
                            @if($user->account_status == 'active')
                            <i class="bi bi-patch-check-fill text-success small ms-1"></i>
                            @endif
                        </h6>
                        <small class="--text-muted d-block">{{ $user->email }}</small>
                    </div>
                </div>
                <div class="text-end d-none d-sm-block">
                    <span class="role-badge-sm text-danger">
                        @if($user->admin_role_id == 1)
                        ADMIN
                        @elseif($user->admin_role_id == 2)
                        HR
                        @elseif($user->admin_role_id == 3)
                        MENTOR
                        @elseif($user->admin_role_id == 4)
                        INSTITUTION
                        @elseif($user->admin_role_id == 5)
                        STUDENT

                        @else
                        STAFF
                        @endif
                    </span>
                    <div class="status-{{ $user->account_status == 'active' ? 'active' : 'danger' }}">
                        @if($user->account_status == 'pending')
                        <span class="text-warning">Pending</span>
                        @elseif($user->account_status == 'deactivated')
                        <span class="text-secondary">Deactivated</span>
                        @else
                        {{ ucfirst($user->account_status) }}
                        @endif
                    </div>
                    <small class="--text-muted d-block mt-1" style="font-size: 0.7rem;">
                        <i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}
                    </small>

                    <div class="d-flex justify-content-end gap-2 mt-2">
                        <button class="btn btn-sm px-3 py-1 rounded-pill fw-bold edit-user-btn"
                            data-id="{{ $user->id }}" data-name="{{ $user->full_name }}" data-email="{{ $user->email }}"
                            data-role="{{ $user->admin_role_id }}" data-status="{{ $user->account_status }}"
                            data-mentor="{{ $user->mentor_id }}"
                            style="font-size: 0.65rem; background-color: rgba(13, 110, 253, 0.1); color: #0dcaf0; border: 1px solid rgba(13, 110, 253, 0.2);">
                            <i class="bi bi-pencil-square me-1"></i> EDIT
                        </button>

                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to remove {{ $user->full_name }}?');"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm px-3 py-1 rounded-pill fw-bold"
                                style="font-size: 0.65rem; background-color: rgba(220, 53, 69, 0.1); color: #ef4444; border: 1px solid rgba(220, 53, 69, 0.2);">
                                <i class="bi bi-trash3 me-1"></i> REMOVE
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="user-list-item justify-content-center p-5 --text-muted text-center w-100">
                No users found matching your search.
            </div>
            @endforelse
        </div>
    </div>
</div>

<div id="tab-roles" class="user-content-block d-none">
    <div class="filter-container">
        <h6 class="fw-bold text-main mb-4"><i class="bi bi-pie-chart me-2 text-danger"></i> Role Distribution</h6>

        <div class="role-dist-row mb-3">
            <div class="role-dist-label d-flex justify-content-between small mb-1">
                <span class="fw-bold text-danger"><i class="bi bi-shield-lock me-1"></i> Admin</span>
                <span>{{ $stats['admin_count'] }} ({{ number_format($stats['admin_pct'], 1) }}%)</span>
            </div>
            <div class="role-progress"
                style="height: 6px; background: var(--bg-body); border-radius: 3px; overflow: hidden;">
                <div class="role-fill bg-danger" style="width: {{ $stats['admin_pct'] }}%; height: 100%;"></div>
            </div>
        </div>

        <div class="role-dist-row mb-3">
            <div class="role-dist-label d-flex justify-content-between small mb-1">
                <span class="fw-bold text-success"><i class="bi bi-person-badge me-1"></i> HR / Staff</span>
                <span>{{ $stats['hr_count'] }} ({{ number_format($stats['hr_pct'], 1) }}%)</span>
            </div>
            <div class="role-progress"
                style="height: 6px; background: var(--bg-body); border-radius: 3px; overflow: hidden;">
                <div class="role-fill bg-success" style="width: {{ $stats['hr_pct'] }}%; height: 100%;"></div>
            </div>
        </div>

        <div class="role-dist-row mb-3">
            <div class="role-dist-label d-flex justify-content-between small mb-1">
                <span class="fw-bold text-warning"><i class="bi bi-person-video3 me-1"></i> Mentor</span>
                <span>{{ $stats['mentor_count'] }} ({{ number_format($stats['mentor_pct'], 1) }}%)</span>
            </div>
            <div class="role-progress"
                style="height: 6px; background: var(--bg-body); border-radius: 3px; overflow: hidden;">
                <div class="role-fill bg-warning" style="width: {{ $stats['mentor_pct'] }}%; height: 100%;"></div>
            </div>
        </div>

        <div class="role-dist-row mb-3">
            <div class="role-dist-label d-flex justify-content-between small mb-1">
                <span class="fw-bold text-info"><i class="bi bi-building me-1"></i> Institution</span>
                <span>{{ $stats['inst_count'] }} ({{ number_format($stats['inst_pct'], 1) }}%)</span>
            </div>
            <div class="role-progress"
                style="height: 6px; background: var(--bg-body); border-radius: 3px; overflow: hidden;">
                <div class="role-fill bg-info" style="width: {{ $stats['inst_pct'] }}%; height: 100%;"></div>
            </div>
        </div>

        <div class="role-dist-row mb-3">
            <div class="role-dist-label d-flex justify-content-between small mb-1">
                <span class="fw-bold text-primary"><i class="bi bi-person me-1"></i> Student</span>
                <span>{{ $stats['student_count'] }} ({{ number_format($stats['student_pct'], 1) }}%)</span>
            </div>
            <div class="role-progress"
                style="height: 6px; background: var(--bg-body); border-radius: 3px; overflow: hidden;">
                <div class="role-fill bg-primary" style="width: {{ $stats['student_pct'] }}%; height: 100%;"></div>
            </div>
        </div>
    </div>
</div>

<div id="tab-activity" class="user-content-block d-none">
    <div class="filter-container">
        <h6 class="fw-bold text-main mb-4"><i class="bi bi-activity me-2 text-danger"></i> Recent Activity Log</h6>

        @forelse($recentActivities as $activity)
        <div class="activity-item">
            <div class="activity-icon bg-soft-green text-success">
                <i class="bi bi-person-plus"></i>
            </div>
            <div>
                <h6 class="fw-bold text-main mb-1">New user {{ $activity->full_name }} registered</h6>
                <small class="--text-muted">{{ $activity->created_at->diffForHumans() }}</small>
            </div>
        </div>
        @empty
        <div class="p-4 text-center --text-muted">
            No recent activity found.
        </div>
        @endforelse
    </div>
</div>

<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: var(--bg-card); border: 1px solid var(--border-color);">
            <div class="modal-header border-bottom border-secondary opacity-50">
                <h5 class="modal-title text-main fw-bold">Create New User</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    @if ($errors->any())
                    <div class="alert alert-danger bg-soft-red text-red border-0 small py-2 mb-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label --text-muted small fw-bold">FULL NAME</label>
                        <input type="text" name="full_name" class="search-input-drive" placeholder="e.g. Hrushi"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label --text-muted small fw-bold">EMAIL ADDRESS</label>
                        <input type="email" name="email" class="search-input-drive"
                            placeholder="hrushi@kickstartskills.com" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label --text-muted small fw-bold">ROLE</label>
                            <select name="admin_role_id" class="search-input-drive" style="appearance: auto;">
                                <option value="1">Admin</option>
                                <option value="2">HR</option>
                                <option value="3">Mentor</option>
                                <option value="4">Institution</option>
                                <option value="5">Student</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label --text-muted small fw-bold">ASSIGN MENTOR (OPTIONAL)</label>
                            <select name="mentor_id" class="search-input-drive" style="appearance: auto;">
                                <option value="">Choose a Mentor...</option>
                                @foreach($users->where('admin_role_id', 3) as $mentor)
                                <option value="{{ $mentor->id }}">{{ $mentor->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label class="form-label --text-muted small fw-bold">STATUS</label>
                            <select name="account_status" class="search-input-drive" style="appearance: auto;">
                                <option value="active">Active</option>
                                <option value="pending">Pending</option>
                                <option value="deactivated">Deactivated / Inactive</option>
                                <option value="suspended">Suspended</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label --text-muted small fw-bold">TEMPORARY PASSWORD</label>
                        <input type="password" name="password" class="search-input-drive" placeholder="Min 8 characters"
                            required>
                    </div>
                </div>
                <div class="modal-footer border-top border-secondary opacity-90">
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger px-4">Create User</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark border-secondary text-white">
            <div class="modal-header border-secondary">
                <h5 class="modal-title fw-bold">Edit User Permissions</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="editUserForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">FULL NAME</label>
                        <input type="text" name="full_name" id="edit_full_name" class="search-input-drive" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">EMAIL ADDRESS</label>
                        <input type="email" name="email" id="edit_email" class="search-input-drive" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold text-muted">ROLE</label>
                            <select name="admin_role_id" id="edit_admin_role_id" class="search-input-drive"
                                style="appearance: auto;">
                                <option value="1">Admin</option>
                                <option value="2">HR</option>
                                <option value="3">Mentor</option>
                                <option value="4">Institution</option>
                                <option value="5">Student</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold text-muted">ASSIGN MENTOR</label>
                            <select name="mentor_id" id="edit_mentor_id" class="search-input-drive"
                                style="appearance: auto;">
                                <option value="">No Mentor</option>
                                @foreach($users->where('admin_role_id', 3) as $mentor)
                                <option value="{{ $mentor->id }}">{{ $mentor->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label small fw-bold text-muted">STATUS</label>
                            <select name="account_status" id="edit_account_status" class="search-input-drive"
                                style="appearance: auto;">
                                <option value="active">Active</option>
                                <option value="pending">Pending</option>
                                <option value="deactivated">Deactivated / Inactive</option>
                                <option value="suspended">Suspended</option>
                            </select>
                        </div>
                    </div>
                    {{-- <div class="mb-3">
                        {{-- <label class="form-label small fw-bold text-muted">NEW PASSWORD (OPTIONAL)</label>
                        <input type="password" name="password" class="search-input-drive"
                            placeholder="Leave blank to keep current">
                    </div> --}}
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select all buttons with the class 'edit-user-btn'
        const editButtons = document.querySelectorAll('.edit-user-btn');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                // 1. Get data from attributes
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const email = this.getAttribute('data-email');
                const role = this.getAttribute('data-role');
                const status = this.getAttribute('data-status');
                const mentor = this.getAttribute('data-mentor');

                // 2. Set the form action
                const form = document.getElementById('editUserForm');
                form.action = `/admin/users/update/${id}`;

                // 3. Fill the inputs
                document.getElementById('edit_full_name').value = name;
                document.getElementById('edit_email').value = email;
                document.getElementById('edit_admin_role_id').value = role;
                document.getElementById('edit_account_status').value = status;
                document.getElementById('edit_mentor_id').value = mentor || '';

                // 4. Show the modal
                const editModal = new bootstrap.Modal(document.getElementById('editUserModal'));
                editModal.show();
            });
        });
    });

    function switchUserTab(tabName) {
        document.querySelectorAll('.user-tab-btn').forEach(btn => btn.classList.remove('active'));
        event.currentTarget.classList.add('active');

        document.querySelectorAll('.user-content-block').forEach(el => el.classList.add('d-none'));
        document.getElementById('tab-' + tabName).classList.remove('d-none');
    }

    function openEditModal(user) {
        const form = document.getElementById('editUserForm');

        // Use a clean template literal for the URL
        form.action = `/admin/users/update/${user.id}`;

        // IMPORTANT: Manually refresh the CSRF token input from the meta tag
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        form.querySelector('input[name="_token"]').value = token;

        // ... your existing value assignments ...
        document.getElementById('edit_full_name').value = user.full_name;
        document.getElementById('edit_email').value = user.email;
        document.getElementById('edit_admin_role_id').value = user.admin_role_id;
        document.getElementById('edit_account_status').value = user.account_status;
        document.getElementById('edit_mentor_id').value = user.mentor_id || '';

        const modal = new bootstrap.Modal(document.getElementById('editUserModal'));
        modal.show();
    }
</script>
@endsection