<div class="modal fade" id="createDriveModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content glass-modal">

            <div class="modal-header d-flex justify-content-between align-items-start">

                <div class="d-flex align-items-center gap-2">
                    <div class="stat-icon">
                        <i class="bi bi-briefcase"></i>
                    </div>
                    <div>
                        <h6 class="modal-title mb-0">Create Internship Drive</h6>
                        <small class="">Add new internship opportunity</small>
                    </div>
                </div>

                <button type="button" class="icon-btn ms-auto" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg"></i>
                </button>

            </div>

            <form id="createDriveForm">
                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <div class="floating-field">
                                <input type="text" name="drive_name" class="form-control" placeholder=" ">
                                <label>Drive Name</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="floating-field">
                                <input type="text" name="company_name" class="form-control" placeholder=" ">
                                <label>Company Name</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="floating-field">
                                <input type="date" name="drive_date" class="form-control" placeholder=" ">
                                <label>Drive Date</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="floating-field">
                                <input type="date" name="application_deadline" class="form-control" placeholder=" ">
                                <label>Application Deadline</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="floating-field">
                                <input type="date" name="interview_start_date" class="form-control" placeholder=" ">
                                <label>Interview Start Date</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="floating-field">
                                <input type="date" name="interview_end_date" class="form-control" placeholder=" ">
                                <label>Interview End Date</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="floating-field">
                                <input type="number" name="stipend" class="form-control" placeholder=" ">
                                <label>Stipend</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="floating-field">
                                <input type="text" name="location" class="form-control" placeholder=" ">
                                <label>Location</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="floating-field">
                                <textarea name="description" class="form-control" placeholder=" "></textarea>
                                <label>Description</label>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn muted-btn" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-teal">
                        Create Drive
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>