<div class="modal fade" id="editProgramModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content glass-modal">

            <div class="modal-header px-4 pt-4 pb-2">
                <h5 class="modal-title">Edit Program</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body px-4 pb-4">
                <form id="editProgramForm">

                    <input type="hidden" id="edit_program_id">

                    <div class="floating-field mb-4">
                        <input type="text" id="edit_program_name" class="form-control" placeholder=" ">
                        <label>Program Name *</label>
                    </div>

                    <div class="floating-field mb-4">
                        <select id="edit_department_id" class="form-select"></select>
                        <label>Department *</label>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="floating-field mb-4">
                                <input type="text" id="edit_duration" class="form-control" placeholder=" ">
                                <label>Duration *</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="floating-field mb-4">
                                <input type="number" id="edit_fees" class="form-control" placeholder=" ">
                                <label>Fees *</label>
                            </div>
                        </div>
                    </div>

                    <div class="floating-field mb-4">
                        <textarea id="edit_description" class="form-control" rows="4" placeholder=" "></textarea>
                        <label>Description *</label>
                    </div>

                    <div class="d-flex justify-content-end gap-3">
                        <button type="button" class="muted-btn" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-teal px-4">
                            Save Changes
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>