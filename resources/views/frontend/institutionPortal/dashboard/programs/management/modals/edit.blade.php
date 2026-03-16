<div class="modal fade" id="editProgramModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content glass-modal">

            <div class="modal-header px-4 pt-4 pb-2">
                <h5 class="modal-title">Edit Program</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body px-4 pb-4">
                <form method="POST" id="editProgramForm" class="row g-4">
                    @csrf

                    <div class="col-12">
                        <label class="form-label small">Program Name *</label>
                        <input type="text"
                            class="form-control"
                            name="program_name"
                            id="edit_program_name">
                    </div>

                    <div class="col-12">
                        <label class="form-label small">Department *</label>

                        <select class="form-select"
                            name="department_id"
                            id="edit_department_id">

                            @foreach($departments as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-6">
                        <label class="form-label small">Duration *</label>
                        <input type="text"
                            class="form-control"
                            name="duration"
                            id="edit_duration">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small">Fees (₹) *</label>
                        <input type="number"
                            class="form-control"
                            name="fees"
                            id="edit_fees">
                    </div>

                    <div class="col-12">
                        <label class="form-label small">Description *</label>
                        <textarea rows="4"
                            class="form-control"
                            name="description"
                            id="edit_description"></textarea>
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