@extends('frontend.institutionPortal.layout.app')

@section('page_title', 'Programs Management')
@section('title', 'Programs Management')

@section('content')
<div class="container-fluid p-3 p-md-5">

    {{-- =====================================================
        PAGE HEADER
    ====================================================== --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-semibold mb-0">Programs Overview</h5>

        <button class="btn btn-teal d-flex align-items-center gap-2"
                data-bs-toggle="modal"
                data-bs-target="#createProgramModal">
            <i class="bi bi-plus-lg"></i>
            Create Program
        </button>
    </div>

    {{-- =====================================================
        STATS CARDS
    ====================================================== --}}
    <div class="row g-3 mb-4">

        <div class="col-md-3">
            <div class="integration-stat">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon">
                        <i class="bi bi-book"></i>
                    </div>
                    <div>
                    <h4 class="mb-0" id="totalPrograms">0</h4>
                    <p class="mb-0">Total Programs</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="integration-stat">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon success">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div>
                    <h4 class="mb-0" id="activePrograms">0</h4>
                    <p class="mb-0">Active Programs</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="integration-stat">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon info">
                        <i class="bi bi-people"></i>
                    </div>
                    <div>
                        <h4 class="mb-0">307</h4>
                        <p class=" mb-0">Total Students</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="integration-stat">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon warning">
                        <i class="bi bi-award"></i>
                    </div>
                    <div>
                        <h4 class="text-warning mb-0">88.3%</h4>
                        <p class=" mb-0">Avg. Completion</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- =====================================================
        SEARCH & FILTERS
    ====================================================== --}}
    <div class="glass-card mb-4">
        <h6 class="mb-3">Search & Filters</h6>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="input-group-custom">
                    <i class="bi bi-search"></i>
                    <input type="text"
       id="programSearch"
       class="form-control"
       placeholder="Search programs...">
                </div>
            </div>

            <div class="col-md-3">
            <select class="form-select" id="departmentFilter">
    <option value="">All Departments</option>
</select>
            </div>

            <div class="col-md-3">
            <select class="form-select" id="statusFilter">
    <option value="">All Status</option>
    <option value="1">Active</option>
    <option value="0">Inactive</option>
</select>
            </div>
        </div>
    </div>

    {{-- =====================================================
        PROGRAMS HEADER
    ====================================================== --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
    <h6 class="fw-semibold mb-0">
    Programs (<span id="programCount">0</span>)
</h6>
        <button class="btn btn-link p-0">
            <i class="bi bi-download fs-5"></i>
        </button>
    </div>

    {{-- =====================================================
        PROGRAM CARD
    ====================================================== --}}
    <div id="programsContainer"></div>

</div>

{{-- =====================================================
    MODALS
====================================================== --}}
@include('frontend.institutionPortal.dashboard.electives.management.modals.create')
@include('frontend.institutionPortal.dashboard.electives.management.modals.edit')
@include('frontend.institutionPortal.dashboard.electives.management.modals.view')

{{-- =====================================================
    PAGE SCRIPTS
====================================================== --}}
@include('frontend.institutionPortal.dashboard.electives.management.scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Close menu when clicking outside
    document.addEventListener('click', function () {
        document.querySelectorAll('.kebab-menu').forEach(menu => {
            menu.classList.remove('show');
        });
    });

});
</script>

@endsection
