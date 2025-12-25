<div class="modal fade" id="createAssignmentModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content glass-modal">

            <!-- HEADER -->
            <div class="modal-header">
                <h6 class="modal-title">New Instructor Assignment</h6>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body p-4 p-md-5">
                <div class="row g-4">

                    <div class="col-md-6">
                        <label class="form-label small ">Instructor *</label>
                        <select class="form-select">
                            <option>Dr. David Kim</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small ">Course *</label>
                        <select class="form-select">
                            <option>Mobile App Development</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small ">Semester *</label>
                        <select class="form-select">
                            <option>Spring 2024</option>
                        </select>
                    </div>

                    <div class="col-md-4 floating-field">
                        <input type="number" class="form-control" placeholder=" " required>
                        <label>Weekly Hours *</label>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small ">Status *</label>
                        <select class="form-select">
                            <option>Active</option>
                            <option>Pending</option>
                        </select>
                    </div>

                </div>
            </div>

            <!-- FOOTER -->
            <div class="modal-footer">
                <button class="btn muted-btn" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-teal">Create Assignment</button>
            </div>

        </div>
    </div>
</div>
