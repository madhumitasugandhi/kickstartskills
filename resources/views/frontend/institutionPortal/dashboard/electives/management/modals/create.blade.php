<div class="modal fade" id="createProgramModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Create New Program</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="createProgramForm">
                    @csrf

                    <div class="ui-floating mb-3">
                        <input type="text" name="name" class="form-control" placeholder=" ">
                        <label>Program Name *</label>
                    </div>

                    <div class="ui-floating mb-3">
                        <select class="form-select" name="department_id" id="dept"></select>
                        <label>Department *</label>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="ui-floating mb-3">
                                <input type="text" name="duration" class="form-control" placeholder=" ">
                                <label>Duration *</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="ui-floating mb-3">
                                <input type="number" name="fees" class="form-control" placeholder=" ">
                                <label>Fees (₹) *</label>
                            </div>
                        </div>
                    </div>

                    <div class="ui-floating mb-3">
                        <textarea name="description" class="form-control" rows="4" placeholder=" "></textarea>
                        <label>Description *</label>
                    </div>

                    <div class="modal-footer border-0 px-0 pb-0">
                        <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">
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