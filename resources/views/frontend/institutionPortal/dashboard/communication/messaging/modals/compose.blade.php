<div class="modal fade" id="composeMessageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content glass-modal">

            <!-- ================= HEADER ================= -->
            <div class="modal-header">
                <h5 class="modal-title">Compose Message</h5>
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>

            <!-- ================= FORM ================= -->
            <form>
                <div class="modal-body">
                    <div class="row g-3">

                        <!-- RECIPIENT -->
                        <div class="col-md-6">
                            <label class="form-label">Recipient *</label>
                            <select class="form-select form-select-custom" required>
                                <option value="">Select recipient</option>
                                <option>All Students</option>
                                <option>Faculty</option>
                                <option>Individual</option>
                            </select>
                        </div>

                        <!-- PRIORITY -->
                        <div class="col-md-6">
                            <label class="form-label">Priority *</label>
                            <select class="form-select form-select-custom" required>
                                <option value="high">High</option>
                                <option value="medium">Medium</option>
                                <option value="low">Low</option>
                            </select>
                        </div>

                        <!-- SUBJECT -->
                        <div class="col-12">
                            <label class="form-label">Subject *</label>
                            <input type="text"
                                   class="form-control form-control-custom"
                                   placeholder="Enter message subject"
                                   required>
                        </div>

                        <!-- MESSAGE -->
                        <div class="col-12">
                            <label class="form-label">Message *</label>
                            <textarea rows="5"
                                      class="form-control form-control-custom"
                                      placeholder="Write your message here..."
                                      required></textarea>
                        </div>

                        <!-- ATTACHMENTS -->
                        <div class="col-12">
                            <label class="form-label">Attachments</label>
                            <input type="file"
                                   class="form-control form-control-custom"
                                   multiple>
                            <small class="text-muted">
                                Optional — you can attach documents or images
                            </small>
                        </div>

                    </div>
                </div>

                <!-- ================= FOOTER ================= -->
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-link muted-btn"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-teal">
                        <i class="bi bi-send me-1"></i> Send Message
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
