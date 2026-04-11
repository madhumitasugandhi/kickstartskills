<div class="modal fade" id="createAssignmentModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content ui-modal">

            <!-- HEADER -->
            <div class="modal-header ui-modal-header">
                <h6 class="modal-title">New Instructor Assignment</h6>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body p-4">

                <div class="ui-section">
                    <div class="ui-section-title">ASSIGNMENT DETAILS</div>

                    <div class="row g-3">

                        <!-- Instructor -->
                        <div class="col-md-6">
                            <label class="ui-label">Instructor *</label>
                            <select class="form-select">
                                <option>Dr. David Kim</option>
                            </select>
                        </div>

                        <!-- Course -->
                        <div class="col-md-6">
                            <label class="ui-label">Course *</label>
                            <select class="form-select">
                                <option>Mobile App Development</option>
                            </select>
                        </div>

                        <!-- Semester -->
                        <div class="col-md-4">
                            <label class="ui-label">Semester *</label>
                            <select class="form-select">
                                <option>Spring 2024</option>
                            </select>
                        </div>

                        <!-- Weekly Hours -->
                        <div class="col-md-4">
                            <div class="ui-floating">
                                <input type="number" class="form-control" placeholder=" " required>
                                <label>Weekly Hours *</label>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-4">
                            <label class="ui-label">Status *</label>
                            <select class="form-select">
                                <option>Active</option>
                                <option>Pending</option>
                            </select>
                        </div>

                    </div>
                </div>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer ui-modal-footer">
                <button class="btn ui-btn-muted" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-teal">Create Assignment</button>
            </div>

        </div>
    </div>
</div>