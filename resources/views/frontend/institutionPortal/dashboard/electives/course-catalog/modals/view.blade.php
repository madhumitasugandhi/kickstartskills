<div class="modal fade" id="viewCourseModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content glass-modal">

            <div class="modal-body p-4 p-md-5">

                <!-- HEADER -->
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h4 class="fw-bold mb-1" id="view_title"></h4>
                        <p class="small  mb-0">
                            by <span id="view_faculty"></span>
                        </p>
                    </div>

                    <span class="status-pill" id="view_status"></span>
                </div>

                <!-- META GRID -->
                <div class="row g-3 small mb-4 ">
                    <div class="col-md-6">
                        <strong>Category:</strong> <span id="view_category"></span>
                    </div>

                    <div class="col-md-6">
                        <strong>Duration:</strong> <span id="view_duration"></span>
                    </div>

                    <div class="col-md-6">
                        <strong>Price:</strong> ₹<span id="view_price"></span>
                    </div>

                    <div class="col-md-6">
                        <strong>Start Date:</strong> <span id="view_start_date"></span>
                    </div>
                </div>

                <!-- DESCRIPTION -->
                <div class="mb-4">
                    <h6 class="fw-semibold mb-2">Description</h6>
                    <p class=" mb-0" id="view_description"></p>
                </div>

                <!-- SKILLS -->
                <div class="mb-4">
                    <h6 class="fw-semibold mb-2">Skills Covered</h6>
                    <div class="d-flex flex-wrap gap-2" id="view_skills"></div>
                </div>

                <!-- ACTION -->
                <div class="text-end">
                    <button class="muted-btn" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>

            </div>

        </div>
    </div>
</div>