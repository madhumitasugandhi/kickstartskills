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
        display: flex; flex-direction: column; justify-content: center;
    }

    .stat-icon-circle {
        width: 40px; height: 40px; border-radius: 50%;
        background-color: rgba(255,255,255,0.05); color: var(--text-muted);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem; margin-bottom: 12px;
    }

    .stat-value { font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin-bottom: 2px; }
    .stat-label { font-size: 0.85rem; color: var(--text-muted); }

    .trend-badge {
        position: absolute; top: 15px; right: 15px; font-size: 0.7rem; font-weight: 600;
        padding: 2px 8px; border-radius: 4px;
    }
    .trend-up { color: #10b981; background-color: rgba(16, 185, 129, 0.1); }
    .trend-down { color: #ef4444; background-color: rgba(239, 68, 68, 0.1); }

    /* Navigation Tabs */
    .user-tabs {
        display: flex; gap: 16px; margin-bottom: 24px; border-bottom: 1px solid var(--border-color);
        overflow-x: auto; white-space: nowrap; padding-bottom: 4px;
    }
    .user-tabs::-webkit-scrollbar { height: 0px; background: transparent; }

    .user-tab-btn {
        background: transparent; border: none; color: var(--text-muted); padding: 10px 12px;
        font-size: 0.9rem; font-weight: 500; cursor: pointer; position: relative; transition: 0.2s;
        display: flex; align-items: center; gap: 8px;
    }
    .user-tab-btn:hover { color: var(--text-main); }
    .user-tab-btn.active { color: #ef4444; }
    .user-tab-btn.active::after {
        content: ''; position: absolute; bottom: -5px; left: 0; width: 100%; height: 2px; background-color: #ef4444;
    }

    /* Filter Section */
    .filter-container {
        background-color: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 12px; padding: 20px; margin-bottom: 24px;
    }

    .search-input-drive { background-color: var(--bg-body); border: 1px solid var(--border-color); color: var(--text-main); padding: 10px 16px; border-radius: 8px; width: 100%; }

    .filter-pill {
        border: 1px solid var(--border-color); background: transparent; color: var(--text-muted);
        padding: 6px 16px; border-radius: 20px; font-size: 0.85rem; transition: 0.2s; cursor: pointer;
        display: inline-block; margin-right: 8px; margin-bottom: 8px;
    }
    .filter-pill:hover, .filter-pill.active {
        background-color: rgba(239, 68, 68, 0.1); color: #ef4444; border-color: #ef4444;
    }

    /* User List Item */
    .user-list-item {
        background-color: var(--bg-card); border: 1px solid var(--border-color);
        padding: 16px 20px; display: flex; align-items: center; justify-content: space-between;
        transition: 0.2s; border-bottom: none;
    }
    .user-list-item:first-child { border-top-left-radius: 12px; border-top-right-radius: 12px; }
    .user-list-item:last-child { border-bottom-left-radius: 12px; border-bottom-right-radius: 12px; border-bottom: 1px solid var(--border-color); }
    .user-list-item:hover { background-color: rgba(255,255,255,0.02); }

    .user-avatar {
        width: 42px; height: 42px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-weight: 600; font-size: 0.9rem; margin-right: 16px; flex-shrink: 0;
    }

    .role-badge-sm { font-size: 0.7rem; font-weight: 600; text-transform: uppercase; display: block; text-align: right; }
    .status-active { color: #10b981; font-size: 0.75rem; font-weight: 600; }

    /* Role Distribution Bars */
    .role-dist-row { margin-bottom: 16px; }
    .role-dist-label { display: flex; justify-content: space-between; font-size: 0.85rem; margin-bottom: 6px; color: var(--text-muted); }
    .role-progress { height: 6px; background: var(--bg-body); border-radius: 3px; overflow: hidden; }
    .role-fill { height: 100%; border-radius: 3px; }

    /* Activity Items */
    .activity-item {
        padding: 16px; border-bottom: 1px solid var(--border-color);
        display: flex; gap: 12px; align-items: start;
    }
    .activity-icon { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 1rem; }

    /* Utilities */
    .text-blue { color: #3b82f6; } .bg-soft-blue { background: rgba(59, 130, 246, 0.1); }
    .text-purple { color: #8b5cf6; } .bg-soft-purple { background: rgba(139, 92, 246, 0.1); }
    .text-teal { color: #14b8a6; } .bg-soft-teal { background: rgba(20, 184, 166, 0.1); }
    .text-orange { color: #f59e0b; } .bg-soft-orange { background: rgba(245, 158, 11, 0.1); }

</style>

<div class="row g-4 mb-4">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="user-stat-card">
            <span class="trend-badge trend-up">+12%</span>
            <div class="stat-icon-circle text-danger"><i class="bi bi-people"></i></div>
            <div class="stat-value">15,420</div>
            <div class="stat-label">Total Users</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="user-stat-card">
            <span class="trend-badge trend-up">+8%</span>
            <div class="stat-icon-circle text-success"><i class="bi bi-person-check"></i></div>
            <div class="stat-value">8,934</div>
            <div class="stat-label">Active Users</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="user-stat-card">
            <span class="trend-badge trend-up">+23%</span>
            <div class="stat-icon-circle text-warning"><i class="bi bi-person-plus"></i></div>
            <div class="stat-value">1,205</div>
            <div class="stat-label">New This Month</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="user-stat-card">
            <span class="trend-badge text-blue bg-soft-blue">Live</span>
            <div class="stat-icon-circle text-blue"><i class="bi bi-circle"></i></div>
            <div class="stat-value">1,834</div>
            <div class="stat-label">Online Now</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="user-stat-card">
            <span class="trend-badge trend-down">-5%</span>
            <div class="stat-icon-circle text-danger"><i class="bi bi-person-x"></i></div>
            <div class="stat-value">23</div>
            <div class="stat-label">Suspended</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="user-stat-card">
            <span class="trend-badge trend-up">+15%</span>
            <div class="stat-icon-circle text-warning"><i class="bi bi-clock-history"></i></div>
            <div class="stat-value">156</div>
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
            <div class="position-relative flex-grow-1 w-50">
                    <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 --text-muted"></i>
                    <input type="text" class="search-input-drive ps-5" placeholder="Search drives, companies, or submitters...">
                </div>
            <button class="btn btn-outline-danger d-flex align-items-center gap-2 w-500 w-md-auto justify-content-center">
                <i class="bi bi-person-plus"></i> Add User
            </button>
        </div>

        <div class="d-flex flex-wrap align-items-center gap-2">
            <span class="--text-muted small me-2"><i class="bi bi-funnel"></i> Filters:</span>
            <span class="filter-pill active">All</span>
            <span class="filter-pill">Student</span>
            <span class="filter-pill">Institution</span>
            <span class="filter-pill">Mentor</span>
            <span class="filter-pill">HR</span>
            <span class="filter-pill">Admin</span>
            <div class="vr mx-2 --text-muted d-none d-md-block"></div>
            <span class="filter-pill">Active</span>
            <span class="filter-pill">Inactive</span>
            <span class="filter-pill">Suspended</span>
            <span class="filter-pill">Pending</span>
        </div>
    </div>

    <div>
        <h6 class="text-danger fw-bold mb-3 ms-1"><i class="bi bi-people me-2"></i> User Directory (8 users)</h6>
        <div class="d-flex flex-column">
            <div class="user-list-item">
                <div class="d-flex align-items-center">
                    <div class="user-avatar bg-soft-blue text-blue">JS</div>
                    <div>
                        <h6 class="fw-bold mb-0 text-main">John Smith <i class="bi bi-patch-check-fill text-success small ms-1"></i></h6>
                        <small class="--text-muted d-block">john.smith@kickstartskills.com</small>
                        <small class="--text-muted" style="font-size: 0.75rem;"><i class="bi bi-geo-alt me-1"></i> New York, USA • Computer Science</small>
                    </div>
                </div>
                <div class="text-end d-none d-sm-block">
                    <span class="role-badge-sm text-blue">Student</span>
                    <div class="status-active">Active</div>
                    <small class="--text-muted d-block mt-1" style="font-size: 0.7rem;"><i class="bi bi-clock"></i> 688d ago</small>
                </div>
            </div>

            <div class="user-list-item">
                <div class="d-flex align-items-center">
                    <div class="user-avatar bg-soft-teal text-teal">SJ</div>
                    <div>
                        <h6 class="fw-bold mb-0 text-main">Sarah Johnson <i class="bi bi-patch-check-fill text-success small ms-1"></i></h6>
                        <small class="--text-muted d-block">sarah.johnson@techuniv.edu</small>
                        <small class="--text-muted" style="font-size: 0.75rem;"><i class="bi bi-geo-alt me-1"></i> California, USA • Administration</small>
                    </div>
                </div>
                <div class="text-end d-none d-sm-block">
                    <span class="role-badge-sm text-teal">Institution</span>
                    <div class="status-active">Active</div>
                    <small class="--text-muted d-block mt-1" style="font-size: 0.7rem;"><i class="bi bi-clock"></i> 688d ago</small>
                </div>
            </div>

            <div class="user-list-item">
                <div class="d-flex align-items-center">
                    <div class="user-avatar bg-soft-blue text-blue">MC</div>
                    <div>
                        <h6 class="fw-bold mb-0 text-main">Michael Chen <i class="bi bi-patch-check-fill text-success small ms-1"></i></h6>
                        <small class="--text-muted d-block">michael.chen@mentor.com</small>
                        <small class="--text-muted" style="font-size: 0.75rem;"><i class="bi bi-geo-alt me-1"></i> Texas, USA • Engineering</small>
                    </div>
                </div>
                <div class="text-end d-none d-sm-block">
                    <span class="role-badge-sm text-blue">Mentor</span>
                    <div class="status-active">Active</div>
                    <small class="--text-muted d-block mt-1" style="font-size: 0.7rem;"><i class="bi bi-clock"></i> 688d ago</small>
                </div>
            </div>

            <div class="user-list-item">
                <div class="d-flex align-items-center">
                    <div class="user-avatar bg-soft-purple text-purple">ED</div>
                    <div>
                        <h6 class="fw-bold mb-0 text-main">Emily Davis <i class="bi bi-patch-check-fill text-success small ms-1"></i></h6>
                        <small class="--text-muted d-block">emily.davis@hrcompany.com</small>
                        <small class="--text-muted" style="font-size: 0.75rem;"><i class="bi bi-geo-alt me-1"></i> Florida, USA • Human Resources</small>
                    </div>
                </div>
                <div class="text-end d-none d-sm-block">
                    <span class="role-badge-sm text-purple">HR</span>
                    <div class="status-active">Active</div>
                    <small class="--text-muted d-block mt-1" style="font-size: 0.7rem;"><i class="bi bi-clock"></i> 688d ago</small>
                </div>
            </div>

            <div class="user-list-item">
                <div class="d-flex align-items-center">
                    <div class="user-avatar bg-soft-danger text-danger">DW</div>
                    <div>
                        <h6 class="fw-bold mb-0 text-main">David Wilson <i class="bi bi-patch-check-fill text-success small ms-1"></i></h6>
                        <small class="--text-muted d-block">david.wilson@admin.com</small>
                        <small class="--text-muted" style="font-size: 0.75rem;"><i class="bi bi-geo-alt me-1"></i> Washington, USA • Administration</small>
                    </div>
                </div>
                <div class="text-end d-none d-sm-block">
                    <span class="role-badge-sm text-danger">Admin</span>
                    <div class="status-active">Active</div>
                    <small class="--text-muted d-block mt-1" style="font-size: 0.7rem;"><i class="bi bi-clock"></i> 688d ago</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="tab-roles" class="user-content-block d-none">
    <div class="filter-container">
        <h6 class="fw-bold text-main mb-4"><i class="bi bi-pie-chart me-2 text-danger"></i> Role Distribution</h6>

        <div class="role-dist-row">
            <div class="role-dist-label">
                <span class="fw-bold text-blue"><i class="bi bi-person me-1"></i> Student</span>
                <span>8756 (57%)</span>
            </div>
            <div class="role-progress"><div class="role-fill bg-blue" style="width: 57%; background-color: #3b82f6;"></div></div>
        </div>

        <div class="role-dist-row">
            <div class="role-dist-label">
                <span class="fw-bold text-teal"><i class="bi bi-building me-1"></i> Institution</span>
                <span>2341 (15%)</span>
            </div>
            <div class="role-progress"><div class="role-fill bg-teal" style="width: 15%; background-color: #14b8a6;"></div></div>
        </div>

        <div class="role-dist-row">
            <div class="role-dist-label">
                <span class="fw-bold text-blue"><i class="bi bi-person-badge me-1"></i> Mentor</span>
                <span>1890 (12%)</span>
            </div>
            <div class="role-progress"><div class="role-fill bg-blue" style="width: 12%; background-color: #3b82f6;"></div></div>
        </div>

        <div class="role-dist-row">
            <div class="role-dist-label">
                <span class="fw-bold text-purple"><i class="bi bi-briefcase me-1"></i> HR</span>
                <span>1205 (8%)</span>
            </div>
            <div class="role-progress"><div class="role-fill bg-purple" style="width: 8%; background-color: #8b5cf6;"></div></div>
        </div>

        <div class="role-dist-row">
            <div class="role-dist-label">
                <span class="fw-bold text-danger"><i class="bi bi-shield-lock me-1"></i> Admin</span>
                <span>1228 (8%)</span>
            </div>
            <div class="role-progress"><div class="role-fill bg-danger" style="width: 8%; background-color: #ef4444;"></div></div>
        </div>
    </div>
</div>

<div id="tab-activity" class="user-content-block d-none">
    <div class="filter-container">
        <h6 class="fw-bold text-main mb-4"><i class="bi bi-activity me-2 text-danger"></i> Recent Activity Log</h6>

        <div class="activity-item">
            <div class="activity-icon bg-soft-green text-success"><i class="bi bi-person-plus"></i></div>
            <div>
                <h6 class="fw-bold text-main mb-1">New user Jennifer Garcia registered</h6>
                <small class="--text-muted">689d ago</small>
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon bg-soft-red text-danger"><i class="bi bi-person-x"></i></div>
            <div>
                <h6 class="fw-bold text-main mb-1">User Robert Taylor was suspended for policy violation</h6>
                <small class="--text-muted">689d ago</small>
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon bg-soft-orange text-orange"><i class="bi bi-pencil"></i></div>
            <div>
                <h6 class="fw-bold text-main mb-1">Sarah Johnson role updated to Institution Admin</h6>
                <small class="--text-muted">689d ago</small>
            </div>
        </div>
    </div>
</div>

<script>
    function switchUserTab(tabName) {
        document.querySelectorAll('.user-tab-btn').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');

        document.querySelectorAll('.user-content-block').forEach(el => el.classList.add('d-none'));
        document.getElementById('tab-' + tabName).classList.remove('d-none');
    }
</script>

@endsection--
