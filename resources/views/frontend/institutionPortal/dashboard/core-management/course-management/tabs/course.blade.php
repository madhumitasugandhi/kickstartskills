<h6 class="mb-3 fw-semibold">
    Course Types ({{ $courseTypes->count() }})
</h6>

@foreach($courseTypes as $course)
<div class="course-type-card">

    <div class="d-flex justify-content-between align-items-start">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <h6 class="mb-0 fw-semibold">
                    {{ $course->course_name }}
                </h6>

                <span class="course-code-chip">
                    {{ $course->code_extension }}
                </span>

                <span class="status-pill active">Active</span>
            </div>

            <div class="meta-row mb-3">
                <span>
                    <i class="bi bi-clock"></i>
                    {{ $course->duration_years }}y {{ $course->duration_months }}m
                </span>
            </div>
        </div>

        <!-- KEBAB -->
        <button class="btn icon-btn">
            <i class="bi bi-three-dots-vertical"></i>
        </button>
    </div>

    <!-- ACTIONS -->
    <div class="card-actions">

        <!-- ✅ EDIT BUTTON -->
        <button class="btn btn-outline-success btn-sm edit-btn"
            data-id="{{ $course->course_type_id }}"
            data-name="{{ $course->course_name }}"
            data-years="{{ $course->duration_years }}"
            data-months="{{ $course->duration_months }}"
            data-code="{{ $course->code_extension }}"
            data-bs-toggle="modal"
            data-bs-target="#editCourseTypeModal">
            Edit
        </button>

        <!-- ✅ DELETE BUTTON -->
        <button class="btn btn-danger btn-sm delete-btn"
            data-id="{{ $course->course_type_id }}">
            Delete
        </button>

    </div>
</div>
@endforeach