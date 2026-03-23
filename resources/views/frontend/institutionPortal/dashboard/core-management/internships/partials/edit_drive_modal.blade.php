<div class="modal fade" id="editDriveModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
            <h6 class="modal-title mb-0">Edit Internship Drive</h6>
            <small class="text-muted">Update drive details</small>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="editDriveForm">
    <input type="hidden" name="id" id="edit_drive_id">

    <div class="modal-body">
        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Drive Name</label>
                <input type="text" name="drive_name" id="edit_drive_name" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Company Name</label>
                <input type="text" name="company_name" id="edit_company_name" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Drive Date</label>
                <input type="date" name="drive_date" id="edit_drive_date" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Application Deadline</label>
                <input type="date" name="application_deadline" id="edit_application_deadline" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Interview Start Date</label>
                <input type="date" name="interview_start_date" id="edit_interview_start_date" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Interview End Date</label>
                <input type="date" name="interview_end_date" id="edit_interview_end_date" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Stipend</label>
                <input type="number" name="stipend" id="edit_stipend" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Location</label>
                <input type="text" name="location" id="edit_location" class="form-control">
            </div>

            <div class="col-12 mb-3">
                <label>Description</label>
                <textarea name="description" id="edit_description" class="form-control"></textarea>
            </div>

        </div>
    </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">
                        Update Drive
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>