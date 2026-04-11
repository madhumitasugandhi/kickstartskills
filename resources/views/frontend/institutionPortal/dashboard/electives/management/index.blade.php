@extends('frontend.institutionPortal.layout.app')

@section('page_title', 'Programs Management')
@section('title', 'Programs Management')

@section('content')
<div class="container-fluid py-4">

    {{-- =====================================================
        PAGE HEADER
    ====================================================== --}}
    <div class="ui-page-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="ui-icon-box">
                <i class="bi bi-book"></i>
            </div>
            <div>
                <h5 class="mb-1">Programs Overview</h5>
                <small class="ui-muted">
                    Manage academic programs, departments and student enrollments
                </small>
            </div>
        </div>

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
            <div class="ui-stats-card">
                <div class="stats-icon">
                    <i class="bi bi-book"></i>
                </div>
                <div>
                    <h4 id="totalPrograms">0</h4>
                    <small>Total Programs</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="ui-stats-card">
                <div class="stats-icon success">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div>
                    <h4 id="activePrograms">0</h4>
                    <small>Active Programs</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="ui-stats-card">
                <div class="stats-icon info">
                    <i class="bi bi-people"></i>
                </div>
                <div>
                    <h4>307</h4>
                    <small>Total Students</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="ui-stats-card">
                <div class="stats-icon">
                    <i class="bi bi-award"></i>
                </div>
                <div>
                    <h4>88.3%</h4>
                    <small>Avg. Completion</small>
                </div>
            </div>
        </div>

    </div>


    {{-- =====================================================
        SEARCH & FILTERS
    ====================================================== --}}
    <div class="ui-card mb-4">
        <div class="ui-card-title mb-3">Search & Filters</div>

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
        <h6 class="mb-0">
            Programs (<span id="programCount">0</span>)
        </h6>

        <a href="#" class="ui-link">
            <i class="bi bi-download me-1"></i> Export
        </a>
    </div>


    {{-- =====================================================
        PROGRAM CARDS
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


@endsection