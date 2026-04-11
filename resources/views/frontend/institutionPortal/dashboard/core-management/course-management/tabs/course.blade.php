<h6 class="mb-3 fw-semibold">
    Course Types ({{ $courseTypes->count() }})
</h6>

@foreach($courseTypes as $course)
<div class="ui-course-card">

    <div class="d-flex justify-content-between align-items-start">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <strong>{{ $course->course_name }}</strong>

                <span class="ui-badge">
                    {{ $course->code_extension }}
                </span>

                <span class="status-pill active">Active</span>
            </div>

            <small class="">
                <i class="bi bi-clock"></i>
                {{ $course->duration_years }}y {{ $course->duration_months }}m
            </small>
        </div>

        <div class="dropdown">
            <button class="icon-btn" data-bs-toggle="dropdown">
                <i class="bi bi-three-dots-vertical"></i>
            </button>

            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <button class="dropdown-item edit-btn"
                        data-id="{{ $course->course_type_id }}"
                        data-name="{{ $course->course_name }}"
                        data-years="{{ $course->duration_years }}"
                        data-months="{{ $course->duration_months }}"
                        data-code="{{ $course->code_extension }}"
                        data-bs-toggle="modal"
                        data-bs-target="#editCourseTypeModal">
                        Edit
                    </button>
                </li>
                <li>
                    <button class="dropdown-item text-danger delete-btn"
                        data-id="{{ $course->course_type_id }}">
                        Delete
                    </button>
                </li>
            </ul>
        </div>

    </div>

</div>
@endforeach