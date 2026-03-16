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
                <div class="row g-4">

                    <div class="col-md-6 floating-field">
                        <input type="text" class="form-control" placeholder=" " required>
                        <label>Full Name *</label>
                    </div>

                    <div class="col-md-6 floating-field">
                        <input type="email" class="form-control" placeholder=" " required>
                        <label>Email *</label>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small ">Department *</label>
                        <select class="form-select">
                            <option>Engineering</option>
                        </select>
                    </div>

                    <div class="col-md-6 floating-field">
                        <input type="text" class="form-control" placeholder=" " required>
                        <label>Designation *</label>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small ">Employment Type *</label>
                        <select class="form-select">
                            <option>Full-time</option>
                            <option>Part-time</option>
                        </select>
                    </div>

                    <div class="col-md-6 floating-field">
                        <input type="number" class="form-control" placeholder=" " required>
                        <label>Experience (Years) *</label>
                    </div>

                    <div class="col-md-6 floating-field">
                        <input type="text" class="form-control" placeholder=" ">
                        <label>Office Location</label>
                    </div>

                </div>
            </div>

            <!-- FOOTER -->
            <div class="modal-footer">
                <button class="btn muted-btn" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-teal">Add Faculty</button>
            </div>

        </div>
    </div>
</div>
