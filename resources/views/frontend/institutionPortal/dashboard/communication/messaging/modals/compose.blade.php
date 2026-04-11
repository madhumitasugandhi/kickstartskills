<div class="modal fade" id="composeMessageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content ui-modal">

            <!-- HEADER -->
            <div class="modal-header ui-modal-header">
                <h5 class="modal-title">Compose Message</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- FORM -->
            <form>
                <div class="modal-body p-4">

                    <div class="ui-section">
                        <div class="ui-section-title">MESSAGE DETAILS</div>

                        <div class="row g-3">

                            <!-- RECIPIENT -->
                            <div class="col-md-6">
                                <label class="ui-label">Recipient *</label>
                                <select class="form-select" required>
                                    <option value="">Select recipient</option>
                                    <option>All Students</option>
                                    <option>Faculty</option>
                                    <option>Individual</option>
                                </select>
                            </div>

                            <!-- PRIORITY -->
                            <div class="col-md-6">
                                <label class="ui-label">Priority *</label>
                                <select class="form-select" required>
                                    <option value="high">High</option>
                                    <option value="medium">Medium</option>
                                    <option value="low">Low</option>
                                </select>
                            </div>

                            <!-- SUBJECT -->
                            <div class="col-12">
                                <div class="ui-floating">
                                    <input type="text"
                                           class="form-control"
                                           placeholder=" "
                                           required>
                                    <label>Subject *</label>
                                </div>
                            </div>

                            <!-- MESSAGE -->
                            <div class="col-12">
                                <label class="ui-label">Message *</label>
                                <textarea rows="5"
                                          class="form-control"
                                          placeholder="Write your message here..."
                                          required></textarea>
                            </div>

                            <!-- ATTACHMENTS -->
                            <div class="col-12">
                                <label class="ui-label">Attachments</label>
                                <input type="file"
                                       class="form-control"
                                       multiple>
                                <small class="ui-muted">
                                    Optional — you can attach documents or images
                                </small>
                            </div>

                        </div>
                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer ui-modal-footer">
                    <button type="button"
                            class="btn ui-btn-muted"
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