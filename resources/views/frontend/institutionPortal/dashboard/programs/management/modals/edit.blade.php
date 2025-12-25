<div class="modal fade" id="editProgramModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content glass-modal">

            <div class="modal-header px-4 pt-4 pb-2">
                <h5 class="modal-title">Edit Program</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body px-4 pb-4">
                <form class="row g-4">

                    <div class="col-12">
                        <label class="form-label small">Program Name *</label>
                        <input type="text"
                               class="form-control"
                               value="Full Stack Web Development">
                    </div>

                    <div class="col-12">
                        <label class="form-label small">Department *</label>
                        <select class="form-select">
                            <option selected>Engineering</option>
                            <option>Management</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small">Duration *</label>
                        <input type="text" class="form-control" value="6 months">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small">Fees (₹) *</label>
                        <input type="number" class="form-control" value="25000">
                    </div>

                    <div class="col-12">
                        <label class="form-label small">Description *</label>
                        <textarea rows="4" class="form-control">
Comprehensive web development program covering front-end and back-end technologies
                        </textarea>
                    </div>

                    <div class="col-12 d-flex justify-content-end gap-3">
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
