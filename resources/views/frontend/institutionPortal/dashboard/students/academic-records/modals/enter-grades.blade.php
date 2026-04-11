<div class="modal fade" id="enterGradesModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <!-- HEADER -->
            <div class="modal-header">
                <h5 class="modal-title">Enter Grades</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body">
                <div class="row g-4">

                    <!-- Student -->
                    <div class="col-md-6">
                        <label class="ui-label">Student *</label>
                        <select class="form-select">
                            <option>Alice Johnson</option>
                        </select>
                    </div>

                    <!-- Course -->
                    <div class="col-md-6">
                        <label class="ui-label">Course *</label>
                        <select class="form-select">
                            <option>Full Stack Web Development</option>
                        </select>
                    </div>

                    <!-- Credits -->
                    <div class="col-md-4">
                        <div class="ui-floating">
                            <input type="number" class="form-control" placeholder=" " required>
                            <label>Credits *</label>
                        </div>
                    </div>

                    <!-- Grade -->
                    <div class="col-md-4">
                        <label class="ui-label">Grade *</label>
                        <select class="form-select">
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>
                        </select>
                    </div>

                    <!-- GPA -->
                    <div class="col-md-4">
                        <div class="ui-floating">
                            <input type="number" step="0.01" class="form-control" placeholder=" " required>
                            <label>GPA *</label>
                        </div>
                    </div>

                </div>
            </div>

            <!-- FOOTER -->
            <div class="modal-footer">
                <button class="btn ui-btn-muted" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button class="btn btn-teal">
                    Save Grades
                </button>
            </div>

        </div>
    </div>
</div>