@extends('frontend.institutionPortal.layout.app')
@section('page_title', 'Course Management')
@section('title','Course Management')


@section('content')
<div class="container-fluid py-4 course-management">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h5 class="fw-semibold mb-1">Course Management</h5>
            <p class=" small mb-0">
                Configure course types, durations, and student requirements
            </p>
        </div>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCourseTypeModal">
            <i class="bi bi-plus-lg me-1"></i> Add Course Type
        </button>
    </div>

    <div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="glass-card d-flex align-items-center gap-3">
            <div class="stat-icon">
                <i class="bi bi-grid"></i>
            </div>
            <div>
                <small class="">Total Types</small>
                <h4 class="mb-0 text-teal">5</h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="glass-card d-flex align-items-center gap-3">
            <div class="stat-icon success">
                <i class="bi bi-check-circle"></i>
            </div>
            <div>
                <small class="">Active Types</small>
                <h4 class="mb-0 text-teal">4</h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="glass-card d-flex align-items-center gap-3">
            <div class="stat-icon info">
                <i class="bi bi-people"></i>
            </div>
            <div>
                <small class="">Total Students</small>
                <h4 class="mb-0 text-info">1865</h4>
            </div>
        </div>
    </div>
</div>


    <!-- Tabs -->
    <div class="course-tabs mb-4 shadow-sm">
    <button class="tab-btn active" data-tab="course-types">
            <i class="bi bi-journal-bookmark"></i> Course Types
        </button>
        <button class="tab-btn" data-tab="configuration">
            <i class="bi bi-gear"></i> Configuration
        </button>
        <button class="tab-btn" data-tab="analytics">
            <i class="bi bi-bar-chart"></i> Analytics
        </button>
    </div>

    <!-- Tab Content -->
    <div class="course-tab-content">
        <div id="course-types" class="tab-pane active">
            @include('frontend.institutionPortal.dashboard.core-management.course-management.tabs.course')
        </div>

        <div id="configuration" class="tab-pane">
            @include('frontend.institutionPortal.dashboard.core-management.course-management.tabs.configuration')
        </div>

        <div id="analytics" class="tab-pane">
            @include('frontend.institutionPortal.dashboard.core-management.course-management.tabs.analytics')
        </div>
    </div>

</div>

@include('frontend.institutionPortal.dashboard.core-management.course-management.modals.add-course')
@include('frontend.institutionPortal.dashboard.core-management.course-management.modals.edit-course')

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ===========================
       TAB SWITCHING (UNCHANGED)
    ============================ */
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabPanes = document.querySelectorAll('.tab-pane');

    tabButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            tabButtons.forEach(b => b.classList.remove('active'));
            tabPanes.forEach(p => p.classList.remove('active'));

            this.classList.add('active');
            const target = this.dataset.tab;
            document.getElementById(target)?.classList.add('active');
            const pane = document.getElementById(target);

if (pane) {
    pane.classList.add('active');
}
        });
    });


    /* ===========================
       FLOATING LEGEND INPUTS
    ============================ */
    const legendMap = [
        "Course Type Name",
        "Duration (Years)",
        "Duration (Months)",
        "Institution Code Extension"
    ];

    function applyFloatingLegends(modal) {
        modal.querySelectorAll('input.form-control').forEach((input, index) => {

            if (input.closest('.floating-field')) return;

            const wrapper = document.createElement('div');
            wrapper.className = 'floating-field';

            const label = document.createElement('label');

            if (input.getAttribute('placeholder')) {
                label.innerText = input.getAttribute('placeholder');
                input.setAttribute('placeholder', ' ');
            } else {
                label.innerText = legendMap[index] || '';
                input.setAttribute('placeholder', ' ');
            }

            input.parentNode.insertBefore(wrapper, input);
            wrapper.appendChild(input);
            wrapper.appendChild(label);
        });
    }

    // 🔥 APPLY ON ADD MODAL OPEN
    const addModal = document.getElementById('addCourseTypeModal');
    addModal?.addEventListener('shown.bs.modal', function () {
        applyFloatingLegends(this);
    });

    // 🔥 APPLY ON EDIT MODAL OPEN
    const editModal = document.getElementById('editCourseTypeModal');
    editModal?.addEventListener('shown.bs.modal', function () {
        applyFloatingLegends(this);
    });

});
</script>

@endpush

@endsection


