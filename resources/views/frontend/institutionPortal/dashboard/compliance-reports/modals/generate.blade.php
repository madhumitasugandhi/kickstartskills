<div class="modal fade" id="generateReportModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content glass-modal">

            <!-- HEADER -->
            <div class="modal-header">
                <h5 class="modal-title">Generate Compliance Report</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label small">Category *</label>
                        <select class="form-select-custom">
                            <option>Academic</option>
                            <option>Finance</option>
                            <option>Infrastructure</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small">Priority *</label>
                        <select class="form-select-custom">
                            <option>High</option>
                            <option>Medium</option>
                            <option>Low</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small">From Date *</label>
                        <input type="date"
                               class="form-control form-control-custom">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small">To Date *</label>
                        <input type="date"
                               class="form-control form-control-custom">
                    </div>

                </div>
            </div>

            <!-- FOOTER -->
            <div class="modal-footer">
                <button class="btn muted-btn" data-bs-dismiss="modal">
                    Cancel
                </button>

                <button class="btn btn-teal">
                    <i class="bi bi-file-earmark-text me-1"></i>
                    Generate Report
                </button>
            </div>

        </div>
    </div>
</div>
