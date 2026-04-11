<div class="modal fade" id="editFacultyModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content ui-modal">

            <form id="editFacultyForm">
                @csrf
                <input type="hidden" id="editFacultyId">

                <!-- HEADER -->
                <div class="modal-header ui-modal-header">
                    <h6 class="modal-title">Edit Faculty</h6>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- BODY -->
                <div class="modal-body p-4">

                    <div class="ui-section">
                        <div class="ui-section-title">FACULTY INFORMATION</div>

                        <div class="row g-3">

                            <!-- Name -->
                            <div class="col-md-6">
                                <div class="ui-floating">
                                    <input type="text" id="editName" class="form-control" placeholder=" ">
                                    <label>Full Name</label>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="ui-floating">
                                    <input type="email" id="editEmail" class="form-control" placeholder=" ">
                                    <label>Email</label>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6">
                                <div class="ui-floating">
                                    <input type="text" id="editPhone" class="form-control" placeholder=" ">
                                    <label>Phone</label>
                                </div>
                            </div>

                            <!-- Designation -->
                            <div class="col-md-6">
                                <div class="ui-floating">
                                    <input type="text" id="editDesignation" class="form-control" placeholder=" ">
                                    <label>Designation</label>
                                </div>
                            </div>

                            <!-- Department -->
                            <div class="col-md-6">
                                <label class="ui-label">Department</label>
                                <select id="editDepartment" class="form-select">
                                    @foreach($departments as $dept)
                                        <option value="{{ $dept->department_id }}">
                                            {{ $dept->department_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Courses -->
                            <div class="col-md-6">
                                <label class="ui-label">Courses</label>
                                <select id="editCourses" class="form-select" multiple>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->course_type_id }}">
                                            {{ $course->course_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Experience -->
                            <div class="col-md-6">
                                <div class="ui-floating">
                                    <input type="number" id="editExperience" class="form-control" placeholder=" ">
                                    <label>Experience (Years)</label>
                                </div>
                            </div>

                            <!-- Employment Type -->
                            <div class="col-md-6">
                                <label class="ui-label">Employment Type</label>
                                <select id="editEmployment" class="form-select">
                                    <option value="full_time">Full-time</option>
                                    <option value="part_time">Part-time</option>
                                </select>
                            </div>

                        </div>
                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer ui-modal-footer">
                    <button class="btn ui-btn-muted" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-teal" type="submit">Update</button>
                </div>

            </form>

        </div>
    </div>
</div>