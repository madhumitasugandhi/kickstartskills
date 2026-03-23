<div class="modal fade" id="deleteDriveModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content glass-modal text-center p-4">

            <div class="stat-icon danger mx-auto mb-3">
                <i class="bi bi-trash"></i>
            </div>

            <h6>Delete Drive?</h6>
            <small class="text-muted">
                This action cannot be undone
            </small>

            <input type="hidden" id="delete_drive_id">

            <div class="d-flex gap-2 justify-content-center mt-3">
                <button class="btn muted-btn"
                        data-bs-dismiss="modal">Cancel</button>

                <button class="btn btn-danger" id="confirmDeleteDrive">
                    Delete
                </button>
            </div>

        </div>
    </div>
</div>