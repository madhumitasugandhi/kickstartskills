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
                        <h4 class="mb-0">{{ $programs->count() }}</h4>
                        <p class=" mb-0">Total Programs</p>
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
                        <h4 class="mb-0">3</h4>
                        <p class=" mb-0">Active Programs</p>
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
                        class="form-control"
                        id="programSearch"
                        placeholder="Search programs...">
                </div>
            </div>

            <div class="col-md-3">
                <select class="form-select" id="departmentFilter">

                    <option value="">All Departments</option>

                    @foreach($departments as $id => $name)
                    <option value="{{ strtolower($name) }}">{{ $name }}</option>
                    @endforeach

                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select" id="statusFilter">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>
    </div>

    {{-- =====================================================
        PROGRAMS HEADER
    ====================================================== --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-semibold mb-0">
            Programs (<span id="programCount">{{ $programs->count() }}</span>)
        </h6>
        <button class="btn btn-link p-0">
            <i class="bi bi-download fs-5"></i>
        </button>
    </div>

    {{-- =====================================================
        PROGRAM CARD
    ====================================================== --}}
    @foreach($programs as $program)

    <div class="course-type-card program-card"
        data-name="{{ strtolower($program->program_name) }}"
        data-department="{{ strtolower($program->department->department_name ?? '') }}"
        data-status="active">

        <div class="d-flex justify-content-between align-items-start mb-2">
            <div>
                <h6 class="fw-semibold mb-1">{{ $program->program_name }}</h6>
                <small>
                    {{ $program->department->department_name ?? 'N/A' }} •
                    {{ $program->duration }}
                </small>
            </div>

            <span class="status-pill active">Active</span>
        </div>

        <p class="small mb-3">
            {{ $program->description }}
        </p>

        <div class="row mb-3">

            <div class="col-6 col-md-3">
                <small class="d-block">Fees</small>
                <strong>₹{{ number_format($program->fees) }}</strong>
            </div>

        </div>

        <div class="d-flex gap-3">

            <button class="btn btn-outline-teal flex-fill viewProgramBtn"
                data-bs-toggle="modal"
                data-bs-target="#viewProgramModal"
                data-id="{{ $program->program_id }}">
                View
            </button>

            <button class="btn btn-teal flex-fill editProgramBtn"
                data-bs-toggle="modal"
                data-bs-target="#editProgramModal"
                data-id="{{ $program->program_id }}">
                Edit
            </button>

        </div>

    </div>

    @endforeach

</div>

{{-- =====================================================
    MODALS
====================================================== --}}
@include('frontend.institutionPortal.dashboard.programs.management.modals.create')
@include('frontend.institutionPortal.dashboard.programs.management.modals.edit')
@include('frontend.institutionPortal.dashboard.programs.management.modals.view')

{{-- =====================================================
    PAGE SCRIPTS
====================================================== --}}
@include('frontend.institutionPortal.dashboard.programs.management.scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Toggle kebab menu
        document.querySelectorAll('.kebab-toggle').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation();

                // Close all other open menus
                document.querySelectorAll('.kebab-menu').forEach(menu => {
                    if (menu !== this.nextElementSibling) {
                        menu.classList.remove('show');
                    }
                });

                // Toggle current menu
                const menu = this.nextElementSibling;
                menu.classList.toggle('show');
            });
        });

        // Close menu when clicking outside
        document.addEventListener('click', function() {
            document.querySelectorAll('.kebab-menu').forEach(menu => {
                menu.classList.remove('show');
            });
        });

    });
</script>

@endsection