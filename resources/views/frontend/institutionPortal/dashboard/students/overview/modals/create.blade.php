<div class="modal fade" id="addStudentModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content glass-modal">

            <!-- HEADER -->
            <div class="modal-header">
                <h6 class="modal-title">Add Student</h6>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body p-4 p-md-5">
                <div class="row g-4">

                    <div class="col-md-6 floating-field">
                        <input type="text" class="form-control" placeholder=" " required>
                        <label>First Name *</label>
                    </div>

                    <div class="col-md-6 floating-field">
                        <input type="text" class="form-control" placeholder=" " required>
                        <label>Last Name *</label>
                    </div>

                    <div class="col-md-6 floating-field">
                        <input type="email" class="form-control" placeholder=" " required>
                        <label>Email *</label>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small ">Program *</label>
                        <select class="form-select">
                            <option>Full Stack Web Development</option>
                        </select>
                    </div>

                    <div class="col-md-6 floating-field">
                        <input type="text" class="form-control" placeholder=" ">
                        <label>Cohort</label>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small ">Status *</label>
                        <select class="form-select">
                            <option>Active</option>
                            <option>Inactive</option>
                        </select>
                    </div>

                </div>
            </div>

            <!-- FOOTER -->
            <div class="modal-footer">
                <button class="btn muted-btn" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-teal">Add Student</button>
            </div>

        </div>
    </div>
</div>
