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
                        <h4 class="mb-0">4</h4>
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
                           placeholder="Search programs...">
                </div>
            </div>

            <div class="col-md-3">
                <select class="form-select">
                    <option>All Departments</option>
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select">
                    <option>All Status</option>
                </select>
            </div>
        </div>
    </div>

    {{-- =====================================================
        PROGRAMS HEADER
    ====================================================== --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-semibold mb-0">Programs (1)</h6>

        <button class="btn btn-link p-0">
            <i class="bi bi-download fs-5"></i>
        </button>
    </div>

    {{-- =====================================================
        PROGRAM CARD
    ====================================================== --}}
    <div class="course-type-card">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-start mb-2">
            <div>
                <h6 class="fw-semibold mb-1">Full Stack Web Development</h6>
                <small class="">Engineering • 6 months</small>
            </div>

            <div class="d-flex align-items-center gap-2">
                <span class="status-pill active">Active</span>

                <div class="student-actions">
    <button class="icon-btn kebab-toggle" type="button">
        <i class="bi bi-three-dots-vertical"></i>
    </button>

    <ul class="kebab-menu">
        <li>
            <i class="bi bi-eye"></i>
            View Details
        </li>
        <li>
            <i class="bi bi-pencil"></i>
            Edit Program
        </li>
        <li>
            <i class="bi bi-archive"></i>
            Archive
        </li>
        <li class="danger">
            <i class="bi bi-trash"></i>
            Delete
        </li>
    </ul>
</div>

            </div>
        </div>

        {{-- Description --}}
        <p class=" small mb-3">
            Comprehensive web development program covering front-end and back-end technologies
        </p>

        {{-- Metrics --}}
        <div class="row mb-3">
            <div class="col-6 col-md-3">
                <small class=" d-block">Students</small>
                <strong>142 / 156</strong>
            </div>

            <div class="col-6 col-md-3">
                <small class=" d-block">Completion</small>
                <strong>87.5%</strong>
            </div>

            <div class="col-6 col-md-3">
                <small class=" d-block">Fees</small>
                <strong>₹25,000</strong>
            </div>

            <div class="col-6 col-md-3">
                <small class=" d-block">Instructors</small>
                <strong>2</strong>
            </div>
        </div>

        {{-- Skills --}}
        <div class="d-flex flex-wrap gap-2 mb-4">
            <span class="chip-item">HTML / CSS</span>
            <span class="chip-item">JavaScript</span>
            <span class="chip-item">React</span>
            <span class="chip-item">+2 more skills</span>
        </div>

        {{-- Actions --}}
        <div class="d-flex gap-3">
            <button class="btn btn-outline-teal flex-fill"
                    data-bs-toggle="modal"
                    data-bs-target="#viewProgramModal">
                <i class="bi bi-eye me-1"></i>
                View Details
            </button>

            <button class="btn btn-teal flex-fill"
                    data-bs-toggle="modal"
                    data-bs-target="#editProgramModal">
                <i class="bi bi-pencil me-1"></i>
                Edit
            </button>
        </div>

    </div>

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
document.addEventListener('DOMContentLoaded', function () {

    // Toggle kebab menu
    document.querySelectorAll('.kebab-toggle').forEach(button => {
        button.addEventListener('click', function (e) {
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
    document.addEventListener('click', function () {
        document.querySelectorAll('.kebab-menu').forEach(menu => {
            menu.classList.remove('show');
        });
    });

});
</script>

@endsection
