@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Schedule Session')
@section('icon', 'bi bi-plus-circle fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')

<div class="mb-4">
    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm d-flex align-items-center"
        style="background: rgba(25, 135, 84, 0.1); color: #28a745; border-radius: 10px;">
        <i class="bi bi-check-circle-fill me-2"></i>
        <div>{{ session('success') }}</div>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger border-0 shadow-sm d-flex align-items-center"
        style="background: rgba(220, 53, 69, 0.1); color: #dc3545; border-radius: 10px;">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <div>{{ session('error') }}</div>
    </div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
    <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 10px;">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div class="card-custom mb-4">
    <div class="d-flex align-items-center gap-3">
        <div class="bg-soft-orange p-3 rounded-3 text-accent">
            <i class="bi bi-plus-circle fs-3"></i>
        </div>
        <div>
            <h4 class="fw-bold text-main mb-1">Schedule New Session</h4>
            <p class="text-muted-custom mb-0 small">Create a mentoring session with your students</p>
        </div>
    </div>
</div>

<form action="{{ route('mentor.sessions.store') }}" method="POST" id="scheduleForm">
    @csrf
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card-custom mb-4">
                <h6 class="fw-bold text-main mb-4 border-bottom pb-3"
                    style="border-color: var(--border-color) !important;">
                    Session Details
                </h6>

                <div class="mb-3">
                    <label class="form-label small text-muted-custom fw-bold">Session Title</label>
                    <div class="input-group">
                        <span class="input-group-text border-end-0"
                            style="background-color: var(--bg-hover); border-color: var(--border-color); min-width: 45px;">
                            <i class="bi bi-pencil" style="color: var(--text-muted);"></i>
                        </span>
                        <input type="text" name="session_title" class="form-control border-start-0 ps-0"
                            placeholder="e.g. Weekly Sync with John" required value="{{ old('session_title') }}"
                            style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted-custom fw-bold">Session Type</label>
                    <div class="input-group">
                        <span class="input-group-text border-end-0"
                            style="background-color: var(--bg-hover); border-color: var(--border-color); min-width: 45px;">
                            <i class="bi bi-layout-text-sidebar-reverse" style="color: var(--text-muted);"></i>
                        </span>
                        <select name="session_type" class="form-select border-start-0 ps-0"
                            style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                            <option value="One-on-One Meeting">One-on-One Meeting</option>
                            <option value="Group Discussion">Group Discussion</option>
                            <option value="Project Review">Project Review</option>
                            <option value="Code Review">Code Review</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted-custom fw-bold">Description</label>
                    <div class="input-group">
                        <span class="input-group-text border-end-0"
                            style="background-color: var(--bg-hover); border-color: var(--border-color); min-width: 45px;">
                            <i class="bi bi-file-text" style="color: var(--text-muted);"></i>
                        </span>
                        <textarea name="description" class="form-control border-start-0 ps-0" rows="3"
                            placeholder="Enter session details..."
                            style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="mb-0">
                    <label class="form-label small text-muted-custom fw-bold">Agenda</label>
                    <div class="input-group">
                        <span class="input-group-text border-end-0"
                            style="background-color: var(--bg-hover); border-color: var(--border-color); min-width: 45px;">
                            <i class="bi bi-list-ul" style="color: var(--text-muted);"></i>
                        </span>
                        <textarea name="agenda" class="form-control border-start-0 ps-0" rows="3"
                            placeholder="List key discussion points..."
                            style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">{{ old('agenda') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="card-custom mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-bold text-main mb-1">Recurring Session</h6>
                        <p class="text-muted-custom mb-0 small">Create multiple sessions with the same settings</p>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_recurring" value="1"
                            id="recurringSwitch" {{ old('is_recurring') ? 'checked' : '' }}
                            style="width: 3em; height: 1.5em; cursor: pointer;">
                    </div>
                </div>

                <div id="repeatPatternDiv" class="mt-3" style="display: {{ old('is_recurring') ? 'block' : 'none' }};">
                    <label class="form-label small text-muted-custom fw-bold">Repeat Pattern</label>
                    <select name="repeat_pattern" class="form-select"
                        style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                        <option value="Daily">Daily</option>
                        <option value="Weekly">Weekly</option>
                        <option value="Monthly">Monthly</option>
                    </select>
                </div>
            </div>

            <div class="card-custom mb-0">
                <h6 class="fw-bold text-main mb-4 border-bottom pb-3"
                    style="border-color: var(--border-color) !important;">
                    Meeting Settings
                </h6>

                <div class="mb-3">
                    <label class="form-label small text-muted-custom fw-bold">Meeting Platform</label>
                    <div class="input-group">
                        <span class="input-group-text border-end-0"
                            style="background-color: var(--bg-hover); border-color: var(--border-color); min-width: 45px;">
                            <i class="bi bi-camera-video " style="color: var(--text-muted);"></i>
                        </span>
                        <select name="meeting_platform" id="platformSelect" class="form-select border-start-0 ps-0"
                            style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                            <option value="Google Meet">Google Meet</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3" id="urlFieldWrapper">
                    <label class="form-label small text-muted-custom fw-bold">Meeting Link (URL)</label>
                    <div class="input-group">
                        <span class="input-group-text border-end-0"
                            style="background-color: var(--bg-hover); border-color: var(--border-color); min-width: 45px;">
                            <i class="bi bi-link-45deg" style="color: var(--text-muted);"></i>
                        </span>
                        <input type="url" name="meeting_url" class="form-control border-start-0 ps-0"
                            value="{{ old('meeting_url') }}" placeholder="https://meet.google.com/xxx-xxxx-xxx"
                            style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card-custom mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold text-main mb-0">Select Students</h6>
                    <button type="button" id="selectAllStudents"
                        class="btn btn-sm btn-link text-accent p-0 fw-bold text-decoration-none">Select All</button>
                </div>

                <div class="mb-3">
                    <input type="text" id="searchStudent" class="form-control form-control-sm mb-2"
                        placeholder="Search by name..."
                        style="background: var(--bg-hover); border-color: var(--border-color); color: white;">
                    <select id="filterInstitution" class="form-select form-select-sm"
                        style="background: var(--bg-hover); border-color: var(--border-color); color: white;">
                        <option value="">All Institutions</option>
                        @foreach($institutions as $inst)
                        <option value="{{ strtolower($inst) }}">{{ $inst }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex flex-column gap-2" id="studentListContainer"
                    style="max-height: 250px; overflow-y: auto; padding-right: 5px;">
                    @foreach($students as $student)
                    <div class="p-2 rounded-3 border d-flex align-items-center gap-3 cursor-pointer student-card"
                        data-name="{{ strtolower($student->name) }}"
                        data-institution="{{ strtolower($student->institution_name) }}"
                        style="border-color: var(--border-color) !important; background-color: var(--bg-hover); transition: all 0.2s;">

                        <input type="checkbox" name="student_ids[]" value="{{ $student->id }}"
                            class="d-none student-checkbox">

                        <div class="rounded-circle bg-soft-blue text-blue d-flex align-items-center justify-content-center fw-bold"
                            style="width: 40px; height: 40px; font-size: 0.8rem;">
                            {{ strtoupper(substr($student->name, 0, 2)) }}
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold text-main mb-0" style="font-size: 0.85rem;">{{ $student->name }}</h6>
                            <small class="text-success" style="font-size: 0.7rem;">Available</small>
                        </div>
                        <i class="bi bi-circle check-icon text-muted-custom"></i>
                    </div>
                    @endforeach
                </div>
                @error('student_ids')
                <small class="text-danger mt-3 d-block" style="font-size: 0.75rem;">* {{ $message }}</small>
                @enderror
            </div>

            <div class="card-custom mb-4">
                <h6 class="fw-bold text-main mb-3">Date & Time</h6>
                <div class="mb-3">
                    <label class="form-label small text-muted-custom fw-bold">Date</label>
                    <input type="date" name="session_date" class="form-control" required
                        value="{{ old('session_date') }}"
                        style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                </div>
                <div class="mb-3">
                    <label class="form-label small text-muted-custom fw-bold">Time</label>
                    <input type="time" name="session_time" class="form-control" required
                        value="{{ old('session_time') }}"
                        style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                </div>
                <div class="mb-0">
                    <label class="form-label small text-muted-custom fw-bold">Duration</label>
                    <select name="duration" class="form-select"
                        style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                        <option value="30 minutes">30 minutes</option>
                        <option value="60 minutes" selected>60 minutes</option>
                        <option value="90 minutes">90 minutes</option>
                        <option value="2 hours">2 hours</option>
                    </select>
                </div>
            </div>

            <div class="card-custom mb-0">
                <button type="submit" class="btn btn-primary w-100 fw-bold mb-2"
                    style="background-color: var(--accent-color); border: none; padding: 10px;">
                    <i class="bi bi-calendar-check me-2"></i> Schedule Session
                </button>
                <button type="reset" class="btn btn-outline-secondary w-100 fw-bold"
                    style="border-color: var(--border-color); color: var(--text-muted);">
                    <i class="bi bi-arrow-counterclockwise me-2"></i> Reset Form
                </button>
            </div>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        // Recurring Switch logic
        $('#recurringSwitch').on('change', function() {
            if($(this).is(':checked')) {
                $('#repeatPatternDiv').fadeIn();
            } else {
                $('#repeatPatternDiv').fadeOut();
            }
        });

        // 1. Function to Filter Students (Name + Institution)
        function filterStudents() {
            let nameSearch = $('#searchStudent').val().toLowerCase().trim();
            let instFilter = $('#filterInstitution').val().toLowerCase().trim();

            $("#studentListContainer .student-card").each(function() {
                let studentName = $(this).find('h6').text().toLowerCase().trim();
                let studentInst = $(this).attr('data-institution') ? $(this).attr('data-institution').toLowerCase().trim() : "";

                let matchesName = studentName.includes(nameSearch);
                let matchesInst = instFilter === "" || studentInst === instFilter;

                if (matchesName && matchesInst) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        $('#searchStudent').on('input', filterStudents);
        $('#filterInstitution').on('change', filterStudents);

        // 2. Student Card Selection
$(document).on('click', '.student-card', function() {
    // Checkbox ko dhoondo
    let checkbox = $(this).find('.student-checkbox');
    let icon = $(this).find('.check-icon');

    // Toggle Checkbox state
    let isChecked = checkbox.prop('checked');
    checkbox.prop('checked', !isChecked); // Opposite set karo

    // Visual feedback
    if(!isChecked) { // Agar pehle unchecked tha (ab checked ho gaya)
        $(this).css({'border-color': 'var(--accent-color)', 'background-color': 'var(--soft-accent)'});
        icon.removeClass('bi-circle text-muted-custom').addClass('bi-check-circle-fill text-accent');
    } else { // Ab unchecked ho gaya
        $(this).css({'border-color': 'var(--border-color)', 'background-color': 'var(--bg-hover)'});
        icon.removeClass('bi-check-circle-fill text-accent').addClass('bi-circle text-muted-custom');
    }
});
        // 3. Select All Logic - FIXED (Using preventDefault)
        $('#selectAllStudents').on('click', function(e) {
            e.preventDefault();
            $('.student-card:visible').each(function() {
                let checkbox = $(this).find('.student-checkbox');
                if(!checkbox.is(':checked')) {
                    $(this).trigger('click');
                }
            });
        });
    });
</script>

@endsection
