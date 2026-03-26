@extends('frontend.institutionPortal.layout.app')

@section('title','Internship Management')


@section('content')
<div class="container-fluid py-4">

    @include('frontend.institutionPortal.dashboard.core-management.internships.partials.header')

    @include('frontend.institutionPortal.dashboard.core-management.internships.partials.tabs')

    <div class="mt-4">
        @includeIf(
            'frontend.institutionPortal.dashboard.core-management.internships.tabs.' . $tab
        )
    </div>

</div>

@include('frontend.institutionPortal.dashboard.core-management.internships.partials.create_drive_modal')
@include('frontend.institutionPortal.dashboard.core-management.internships.partials.edit_drive_modal')
@include('frontend.institutionPortal.dashboard.core-management.internships.partials.delete_drive_modal')
@endsection



@push('scripts')
<script>

// PAGE LOAD
document.addEventListener("DOMContentLoaded", function() {

    // LOAD DRIVES IF DRIVES TAB
    if(document.getElementById('driveList')){
        loadDrives();
    }

    // CREATE FORM
    const createForm = document.getElementById('createDriveForm');
    if(createForm){
        createForm.addEventListener('submit', storeDrive);
    }

    // EDIT FORM
    const editForm = document.getElementById('editDriveForm');
    if(editForm){
        editForm.addEventListener('submit', updateDrive);
    }

});

// GLOBAL CLICK EVENTS (IMPORTANT)
document.addEventListener('click', function(e){

    // CREATE DRIVE MODAL
    if(e.target.closest('#createDriveBtn')){
        let modal = new bootstrap.Modal(document.getElementById('createDriveModal'));
        modal.show();
    }

    // DELETE BUTTON
if(e.target.closest('.delete-drive-btn')){
    let id = e.target.closest('.delete-drive-btn').dataset.id;

    Swal.fire({
        title: 'Delete Drive?',
        text: 'This action cannot be undone',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e74c3c',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, Delete',
        background: '#1e1e2f',
        color: '#fff'
    }).then((result) => {
        if(result.isConfirmed){
            deleteDrive(id);
        }
    });
}

    // CONFIRM DELETE
    if(e.target.closest('#confirmDeleteDrive')){
        deleteDriveConfirm();
    }

    // EDIT BUTTON
    if(e.target.closest('.edit-drive-btn')){
        let id = e.target.closest('.edit-drive-btn').dataset.id;
        editDrive(id);
    }

});

// LOAD DRIVES
function loadDrives() {
    fetch("{{ route('institution.core.internships.drives.list') }}")
    .then(res => res.json())
    .then(data => {

        let html = '';

        if (data.length === 0) {
            html = `<div class="glass-card text-center p-4">
                        No Internship Drives Found
                    </div>`;
        }

        data.forEach(drive => {

            let initials = drive.company_name.substring(0, 2).toUpperCase();

            html += `
<div class="drive-card">
    <div class="drive-left">

        <div class="drive-header">
            <div class="company-avatar">${initials}</div>
            <div>
                <h6 class="mb-0 fw-semibold">${drive.drive_name}</h6>
                <small class="">${drive.company_name}</small>
            </div>
        </div>

         <div class="drive-description">
            <span><i class="bi bi-pencil"></i> ${drive.description ?? ''}</span>
        </div>

        <div class="meta-row mb-2">
            <span><i class="bi bi-cash"></i>Stiphend: ₹${drive.stipend ?? 0}</span>
            <span><i class="bi bi-geo-alt"></i>Location: ${drive.location ?? ''}</span>
        </div>

    </div>

    <div class="drive-right student-actions">

        <span class="status-pill active">${drive.status}</span>

        <button class="icon-btn kebab-toggle">
            <i class="bi bi-three-dots-vertical"></i>
        </button>

        <ul class="kebab-menu">
            <li class="edit-drive-btn" data-id="${drive.id}">
                <i class="bi bi-pencil"></i> Edit
            </li>
            <li class="danger delete-drive-btn" data-id="${drive.id}">
                <i class="bi bi-trash"></i> Delete
            </li>
        </ul>

    </div>
</div>
`;
        });

        document.getElementById('driveList').innerHTML = html;
    });
}

// STORE DRIVE
function storeDrive(e){
    e.preventDefault();

    let formData = new FormData(e.target);

    fetch("{{ route('institution.core.internships.drives.store') }}", {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
    if (data.status) {

        Swal.fire({
            icon: 'success',
            title: 'Drive Created',
            text: data.message,
            confirmButtonColor: '#16a085',
            background: '#1e1e2f',
            color: '#fff',
            timer: 1600,
            showConfirmButton: false
        });

        loadDrives();

        let modal = bootstrap.Modal.getInstance(
            document.getElementById('createDriveModal')
        );
        modal.hide();

        e.target.reset();

    } else {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: data.message
        });
    }
});
}

// EDIT DRIVE LOAD
function editDrive(id) {
    fetch("/institution/core-management/internships/drives/edit/" + id)
    .then(res => res.json())
    .then(data => {

        document.getElementById('edit_drive_id').value = data.id;
        document.getElementById('edit_drive_name').value = data.drive_name;
        document.getElementById('edit_company_name').value = data.company_name;
        document.getElementById('edit_drive_date').value = data.drive_date;
        document.getElementById('edit_application_deadline').value = data.application_deadline;
        document.getElementById('edit_interview_start_date').value = data.interview_start_date;
        document.getElementById('edit_interview_end_date').value = data.interview_end_date;
        document.getElementById('edit_stipend').value = data.stipend;
        document.getElementById('edit_location').value = data.location;
        document.getElementById('edit_description').value = data.description;

        let modal = new bootstrap.Modal(document.getElementById('editDriveModal'));
        modal.show();
    });
}

// UPDATE DRIVE
function updateDrive(e){
    e.preventDefault();

    let id = document.getElementById('edit_drive_id').value;

    let formData = new FormData(e.target);

    fetch("/institution/core-management/internships/drives/update/" + id, {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
    if (data.status) {

        Swal.fire({
            icon: 'success',
            title: 'Drive Updated',
            text: data.message,
            confirmButtonColor: '#16a085',
            background: '#1e1e2f',
            color: '#fff',
            timer: 1600,
            showConfirmButton: false
        });

        loadDrives();

        let modal = bootstrap.Modal.getInstance(
            document.getElementById('editDriveModal')
        );
        modal.hide();
    }
});
}

// DELETE CONFIRM
function deleteDrive(id){
    fetch("/institution/core-management/internships/drives/delete/" + id, {
        method: "DELETE",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.status) {

            Swal.fire({
                icon: 'success',
                title: 'Deleted',
                text: data.message,
                confirmButtonColor: '#16a085',
                background: '#1e1e2f',
                color: '#fff',
                timer: 1500,
                showConfirmButton: false
            });

            loadDrives();
        }
    });
}

// Kebab toggle
document.addEventListener('click', function(e){

if(e.target.closest('.kebab-toggle')){
    e.stopPropagation();

    document.querySelectorAll('.kebab-menu')
        .forEach(m => m.classList.remove('show'));

    e.target.closest('.student-actions')
        .querySelector('.kebab-menu')
        .classList.toggle('show');
} else {
    document.querySelectorAll('.kebab-menu')
        .forEach(m => m.classList.remove('show'));
}

});
</script>
@endpush


 