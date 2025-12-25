<div class="modal fade" id="createAssessmentModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content glass-modal">

            <!-- HEADER -->
            <div class="modal-header">
                <h6 class="modal-title">Create Assessment</h6>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body p-4 p-md-5">
                <div class="row g-4">

                    <div class="col-md-6 floating-field">
                        <input type="text" class="form-control" placeholder=" " required>
                        <label>Assessment Title *</label>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small">Course *</label>
                        <select class="form-select">
                            <option>Introduction to ML</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small">Type *</label>
                        <select class="form-select">
                            <option>Quiz</option>
                            <option>Exam</option>
                            <option>Assignment</option>
                        </select>
                    </div>

                    <div class="col-md-4 floating-field">
                        <input type="number" class="form-control" placeholder=" ">
                        <label>Duration (min) *</label>
                    </div>

                    <div class="col-md-4 floating-field">
                        <input type="number" class="form-control" placeholder=" ">
                        <label>Total Marks *</label>
                    </div>

                    <div class="col-md-4 floating-field">
                        <input type="date" class="form-control" placeholder=" ">
                        <label>Schedule Date *</label>
                    </div>

                    <div class="col-md-4 floating-field">
                        <input type="number" class="form-control" placeholder=" ">
                        <label>Pass Percentage *</label>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small">Status *</label>
                        <select class="form-select">
                            <option>Draft</option>
                            <option>Active</option>
                        </select>
                    </div>

                </div>
            </div>

            <!-- FOOTER -->
            <div class="modal-footer">
                <button class="btn muted-btn" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-teal">Save Assessment</button>
            </div>

        </div>
    </div>
</div>
