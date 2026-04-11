<div class="modal fade" id="addFacultyModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content ui-modal">

            <!-- HEADER -->
            <div class="modal-header ui-modal-header">
                <h6 class="modal-title">Add Faculty</h6>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body p-4">
                <form action="{{ route('institution.faculties.faculty-management.store') }}" method="POST">
                    @csrf

                    <div class="ui-section">
                        <div class="ui-section-title">FACULTY INFORMATION</div>

                        <div class="row g-3">

                            <!-- Name -->
                            <div class="col-md-6">
                                <div class="ui-floating">
                                    <input type="text" name="name" class="form-control" placeholder=" " required>
                                    <label>Full Name *</label>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="ui-floating">
                                    <input type="email" name="email" class="form-control" placeholder=" " required>
                                    <label>Email *</label>
                                </div>
                            </div>

                            <!-- Department -->
                            <div class="col-md-6">
                                <label class="ui-label">Department *</label>
                                <select class="form-select" name="department_id">
                                    @foreach($departments as $dept)
                                        <option value="{{ $dept->department_id }}">
                                            {{ $dept->department_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Courses -->
                            <div class="col-md-6">
                                <label class="ui-label">Courses Teaching</label>
                                <select class="form-select" name="courses[]" multiple>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->course_type_id }}">
                                            {{ $course->course_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Designation -->
                            <div class="col-md-6">
                                <div class="ui-floating">
                                    <input type="text" name="designation" class="form-control" placeholder=" " required>
                                    <label>Designation *</label>
                                </div>
                            </div>

                            <!-- Employment Type -->
                            <div class="col-md-6">
                                <label class="ui-label">Employment Type *</label>
                                <select class="form-select" name="employment_type">
                                    <option>Full-time</option>
                                    <option>Part-time</option>
                                </select>
                            </div>

                            <!-- Experience -->
                            <div class="col-md-6">
                                <div class="ui-floating">
                                    <input type="number" name="experience" class="form-control" placeholder=" " required>
                                    <label>Experience (Years) *</label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- FOOTER -->
                    <div class="modal-footer ui-modal-footer">
                        <button class="btn ui-btn-muted" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-teal" type="submit">Add Faculty</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>