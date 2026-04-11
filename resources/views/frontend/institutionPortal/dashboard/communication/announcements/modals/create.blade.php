<div class="modal fade" id="createAnnouncementModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content ui-modal">

            <!-- HEADER -->
            <div class="modal-header ui-modal-header">
                <h5 class="modal-title">New Announcement</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- FORM -->
            <form>
                <div class="modal-body p-4">

                    <div class="ui-section">
                        <div class="ui-section-title">ANNOUNCEMENT DETAILS</div>

                        <div class="row g-3">

                            <!-- TITLE -->
                            <div class="col-12">
                                <div class="ui-floating">
                                    <input type="text"
                                           class="form-control"
                                           placeholder=" "
                                           required>
                                    <label>Title *</label>
                                </div>
                            </div>

                            <!-- PRIORITY -->
                            <div class="col-md-4">
                                <label class="ui-label">Priority *</label>
                                <select class="form-select" required>
                                    <option value="high">High</option>
                                    <option value="medium">Medium</option>
                                    <option value="low">Low</option>
                                </select>
                            </div>

                            <!-- STATUS -->
                            <div class="col-md-4">
                                <label class="ui-label">Status *</label>
                                <select class="form-select"
                                        id="announcementStatus"
                                        required>
                                    <option value="published">Published</option>
                                    <option value="draft">Draft</option>
                                    <option value="scheduled">Scheduled</option>
                                </select>
                            </div>

                            <!-- AUDIENCE -->
                            <div class="col-md-4">
                                <label class="ui-label">Audience *</label>
                                <select class="form-select" required>
                                    <option>Students</option>
                                    <option>Faculty</option>
                                    <option>Staff</option>
                                </select>
                            </div>

                            <!-- SCHEDULE DATE -->
                            <div class="col-md-6 d-none" id="scheduleDateWrapper">
                                <label class="ui-label">Publish Date *</label>
                                <input type="datetime-local"
                                       class="form-control">
                            </div>

                            <!-- MESSAGE -->
                            <div class="col-12">
                                <label class="ui-label">Message *</label>
                                <textarea rows="4"
                                          class="form-control"
                                          placeholder="Write announcement message..."
                                          required></textarea>
                            </div>

                            <!-- ATTACHMENTS -->
                            <div class="col-12">
                                <label class="ui-label">Attachments</label>
                                <input type="file"
                                       class="form-control"
                                       multiple>
                                <small class="ui-muted">
                                    PDF, DOC, images supported
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
                        Publish Announcement
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>