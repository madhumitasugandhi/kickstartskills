<div class="modal fade" id="addFacultyModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content glass-modal">

            <!-- HEADER -->
            <div class="modal-header">
                <h6 class="modal-title">Add Faculty</h6>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body p-4 p-md-5">
                <form action="{{ route('institution.faculties.faculty-management.store') }}" method="POST">
                    @csrf
                    <div class="row g-4">

                        <div class="col-md-6 floating-field">
                            <input type="text" name="name" class="form-control" placeholder=" " required>
                            <label>Full Name *</label>
                        </div>

                        <div class="col-md-6 floating-field">
                            <input type="email" name="email" class="form-control" placeholder=" " required>
                            <label>Email *</label>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small ">Department *</label>
                            <select class="form-select" name="department_id">
                                @foreach($departments as $dept)
                                <option value="{{ $dept->department_id }}">
                                    {{ $dept->department_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small">Courses Teaching</label>
                            <select class="form-select" name="courses[]" multiple>
                                @foreach($courses as $course)
                                <option value="{{ $course->course_type_id }}">
                                    {{ $course->course_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 floating-field">
                            <input type="text" name="designation" class="form-control" placeholder=" " required>
                            <label>Designation *</label>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small ">Employment Type *</label>
                            <select class="form-select" name="employment_type">
                                <option>Full-time</option>
                                <option>Part-time</option>
                            </select>
                        </div>

                        <div class="col-md-6 floating-field">
                            <input type="number" name="experience" class="form-control" placeholder=" " required>
                            <label>Experience (Years) *</label>
                        </div>



                    </div>

                    <!-- FOOTER -->
                    <div class="modal-footer">
                        <button class="btn muted-btn" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-teal" type="submit">Add Faculty</button>
                    </div>


                </form>
            </div>


        </div>
    </div>
</div>