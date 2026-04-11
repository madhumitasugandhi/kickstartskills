<div class="modal fade" id="viewCourseModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content glass-modal">

            <!-- HEADER -->
            <div class="modal-header px-4 pt-4 pb-2">
                <div>
                    <h5 class="modal-title" id="view_title"></h5>
                    <small class="ui-muted">
                        by <span id="view_faculty"></span>
                    </small>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <span class="status-pill" id="view_status"></span>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
            </div>

            <!-- BODY -->
            <div class="modal-body px-4 pb-4">

                <!-- META -->
                <div class="ui-card mb-4">
                    <div class="row g-3 small">
                        <div class="col-md-6">
                            <strong>Category:</strong>
                            <span id="view_category"></span>
                        </div>

                        <div class="col-md-6">
                            <strong>Duration:</strong>
                            <span id="view_duration"></span>
                        </div>

                        <div class="col-md-6">
                            <strong>Price:</strong>
                            ₹<span id="view_price"></span>
                        </div>

                        <div class="col-md-6">
                            <strong>Start Date:</strong>
                            <span id="view_start_date"></span>
                        </div>
                    </div>
                </div>

                <!-- DESCRIPTION -->
                <div class="ui-card mb-4">
                    <div class="ui-card-title mb-2">Description</div>
                    <p class="mb-0" id="view_description"></p>
                </div>

                <!-- SKILLS -->
                <div class="ui-card">
                    <div class="ui-card-title mb-2">Skills Covered</div>
                    <div class="d-flex flex-wrap gap-2" id="view_skills"></div>
                </div>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer border-0 px-4 pb-4">
                <button class="muted-btn" data-bs-dismiss="modal">
                    Close
                </button>
            </div>

        </div>
    </div>
</div>