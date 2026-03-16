<div class="modal fade" id="createProgramModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content glass-modal">

            <!-- Header -->
            <div class="modal-header px-4 pt-4 pb-2">
                <h5 class="modal-title">Create New Program</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- Body -->
            <div class="modal-body px-4 pb-4">
                <form>

                    <!-- Program Name -->
                    <div class="floating-field mb-4">
                        <input type="text" class="form-control" placeholder=" " id="progName">
                        <label for="progName">Program Name *</label>
                    </div>

                    <!-- Department -->
                    <div class="floating-field mb-4">
                        <select class="form-select" id="dept">
                            <option value="" disabled selected></option>
                            <option>Engineering</option>
                            <option>Management</option>
                        </select>
                        <label for="dept">Department *</label>
                    </div>

                    <!-- Duration + Fees -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="floating-field mb-4">
                                <input type="text" class="form-control" placeholder=" ">
                                <label>Duration *</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="floating-field mb-4">
                                <input type="number" class="form-control" placeholder=" ">
                                <label>Fees (₹) *</label>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="floating-field mb-4">
                        <textarea class="form-control" rows="4" placeholder=" "></textarea>
                        <label>Description *</label>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex justify-content-end gap-3">
                        <button type="button" class="muted-btn" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-teal px-4">
                            Save Program
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
