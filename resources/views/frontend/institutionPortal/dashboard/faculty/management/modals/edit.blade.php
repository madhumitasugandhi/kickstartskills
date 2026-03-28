<div class="modal fade" id="editFacultyModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content glass-modal">

            <form id="editFacultyForm">
                @csrf
                <input type="hidden" id="editFacultyId">

                <div class="modal-header">
                    <h6 class="modal-title">Edit Faculty</h6>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>Name</label>
                            <input type="text" id="editName" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" id="editEmail" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Phone</label>
                            <input type="text" id="editPhone" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Designation</label>
                            <input type="text" id="editDesignation" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Department</label>
                            <select id="editDepartment" class="form-select">
                                @foreach($departments as $dept)
                                <option value="{{ $dept->department_id }}">
                                    {{ $dept->department_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Courses</label>
                            <select id="editCourses" class="form-select" multiple>
                                @foreach($courses as $course)
                                <option value="{{ $course->course_type_id }}">
                                    {{ $course->course_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Experience</label>
                            <input type="number" id="editExperience" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Employment Type</label>
                            <select id="editEmployment" class="form-select">
                                <option value="full_time">Full-time</option>
                                <option value="part_time">Part-time</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn muted-btn" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-teal" type="submit">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>