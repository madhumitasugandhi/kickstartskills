<div class="modal fade" id="generateReportModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content ui-modal">

            <!-- HEADER -->
            <div class="modal-header ui-modal-header">
                <h5 class="modal-title">Generate Compliance Report</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body p-4">

                <div class="ui-section">
                    <div class="ui-section-title">REPORT PARAMETERS</div>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="ui-label">Category *</label>
                            <select class="form-select">
                                <option>Academic</option>
                                <option>Finance</option>
                                <option>Infrastructure</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="ui-label">Priority *</label>
                            <select class="form-select">
                                <option>High</option>
                                <option>Medium</option>
                                <option>Low</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="ui-label">From Date *</label>
                            <input type="date" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="ui-label">To Date *</label>
                            <input type="date" class="form-control">
                        </div>

                    </div>
                </div>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer ui-modal-footer">
                <button class="btn ui-btn-muted" data-bs-dismiss="modal">
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