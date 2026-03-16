<div class="modal fade" id="enterGradesModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content glass-modal">

            <!-- HEADER -->
            <div class="modal-header">
                <h6 class="modal-title">Enter Grades</h6>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body p-4 p-md-5">
                <div class="row g-4">

                    <div class="col-md-6">
                        <label class="form-label small ">Student *</label>
                        <select class="form-select">
                            <option>Alice Johnson</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small ">Course *</label>
                        <select class="form-select">
                            <option>Full Stack Web Development</option>
                        </select>
                    </div>

                    <div class="col-md-4 floating-field">
                        <input type="number" class="form-control" placeholder=" " required>
                        <label>Credits *</label>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small ">Grade *</label>
                        <select class="form-select">
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>
                        </select>
                    </div>

                    <div class="col-md-4 floating-field">
                        <input type="number" step="0.01" class="form-control" placeholder=" " required>
                        <label>GPA *</label>
                    </div>

                </div>
            </div>

            <!-- FOOTER -->
            <div class="modal-footer">
                <button class="btn muted-btn" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-teal">Save Grades</button>
            </div>

        </div>
    </div>
</div>
