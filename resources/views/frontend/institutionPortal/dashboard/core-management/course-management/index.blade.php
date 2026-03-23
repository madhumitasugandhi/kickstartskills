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
                <h4 class="mb-0 text-teal">{{ $courseTypes->count() }}</h4>
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

// ADD COURSE
document.getElementById('saveCourseBtn')?.addEventListener('click', function () {

let formData = {
    course_name: document.querySelector('[name="course_name"]').value,
    duration_years: document.querySelector('[name="duration_years"]').value,
    duration_months: document.querySelector('[name="duration_months"]').value,
    code_extension: document.querySelector('[name="code_extension"]').value,
};

fetch('/institution/core-management/course-types/store', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify(formData)
})
.then(res => res.json())
.then(data => {
    if (data.status) {
        alert(data.message);
        location.reload();
    } else {
        console.log(data.errors);
    }
});
});


// UPDATE COURSE
document.getElementById('updateCourseBtn')?.addEventListener('click', function () {

let id = this.dataset.id;

let formData = {
    course_name: document.getElementById('edit_course_name').value,
    duration_years: document.getElementById('edit_duration_years').value,
    duration_months: document.getElementById('edit_duration_months').value,
    code_extension: document.getElementById('edit_code_extension').value,
};

fetch(`/institution/core-management/course-types/update/${id}`, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify(formData)
})
.then(res => res.json())
.then(data => {
    if (data.status) {
        alert(data.message);
        location.reload();
    } else {
        console.log(data.errors);
    }
});
});


//Delete course
document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function () {

        let id = this.dataset.id;

        if (!confirm('Are you sure you want to delete this course?')) return;

        fetch(`/institution/core-management/course-types/delete/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status) {
                alert(data.message);
                location.reload();
            }
        });
    });
});

//Add Requirement
document.getElementById('addRequirementBtn').addEventListener('click', async () => {

    const name = prompt('Enter Requirement Name');
    if (!name) return;

    const res = await fetch('/institution/core-management/requirements/store', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ name })
    });

    const data = await res.json();

    if (data.status === 'success') {

        const item = document.createElement('div');
        item.className = 'template-item';
        item.setAttribute('data-id', data.data.requirement_id);

        item.innerHTML = `
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-tag"></i>
                <span>${data.data.requirement_name}</span>
            </div>
            <button class="icon-btn danger deleteRequirement">
                <i class="bi bi-trash"></i>
            </button>
        `;

        document.getElementById('requirementList').appendChild(item);
    }
});

//Delete Requirement
document.addEventListener('click', async function (e) {

if (e.target.closest('.deleteRequirement')) {

    const item = e.target.closest('.template-item');
    const id = item.dataset.id;

    if (!confirm('Delete this requirement?')) return;

    await fetch(`/institution/core-management/requirements/delete/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    });

    item.remove();
}
});

</script>

@endpush

@endsection


