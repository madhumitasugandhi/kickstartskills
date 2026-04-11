<div class="modal fade" id="addStudentModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content ui-modal">

            <!-- HEADER -->
            <div class="modal-header ui-modal-header">
                <h6 class="modal-title">Add Student</h6>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body">

                <div class="ui-section">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <div class="ui-floating">
                                <input type="text" class="form-control" placeholder=" " required>
                                <label>First Name *</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="ui-floating">
                                <input type="text" class="form-control" placeholder=" " required>
                                <label>Last Name *</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="ui-floating">
                                <input type="email" class="form-control" placeholder=" " required>
                                <label>Email *</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="ui-label">Program *</label>
                            <select class="form-select">
                                <option>Full Stack Web Development</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <div class="ui-floating">
                                <input type="text" class="form-control" placeholder=" ">
                                <label>Cohort</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="ui-label">Status *</label>
                            <select class="form-select">
                                <option>Active</option>
                                <option>Inactive</option>
                            </select>
                        </div>

                    </div>
                </div>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer ui-modal-footer">
                <button class="btn ui-btn-muted" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-teal">Add Student</button>
            </div>

        </div>
    </div>
</div>