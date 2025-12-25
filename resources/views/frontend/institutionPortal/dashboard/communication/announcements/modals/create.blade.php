<div class="modal fade" id="createAnnouncementModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content glass-modal">

            <!-- HEADER -->
            <div class="modal-header">
                <h5 class="modal-title">New Announcement</h5>

                <!-- Theme-safe close button -->
                <button type="button"
                        class="btn btn-sm icon-btn"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <!-- FORM -->
            <form>
                <div class="modal-body">
                    <div class="row g-3">

                        <!-- TITLE -->
                        <div class="col-12">
                            <label class="form-label">Title *</label>
                            <input type="text"
                                   class="form-control form-control-custom"
                                   placeholder="Enter announcement title"
                                   required>
                        </div>

                        <!-- PRIORITY -->
                        <div class="col-md-4">
                            <label class="form-label">Priority *</label>
                            <select class="form-select form-select-custom" required>
                                <option value="high">High</option>
                                <option value="medium">Medium</option>
                                <option value="low">Low</option>
                            </select>
                        </div>

                        <!-- STATUS -->
                        <div class="col-md-4">
                            <label class="form-label">Status *</label>
                            <select class="form-select form-select-custom"
                                    id="announcementStatus"
                                    required>
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                                <option value="scheduled">Scheduled</option>
                            </select>
                        </div>

                        <!-- AUDIENCE -->
                        <div class="col-md-4">
                            <label class="form-label">Audience *</label>
                            <select class="form-select form-select-custom" required>
                                <option>Students</option>
                                <option>Faculty</option>
                                <option>Staff</option>
                            </select>
                        </div>

                        <!-- SCHEDULE DATE -->
                        <div class="col-md-6 d-none" id="scheduleDateWrapper">
                            <label class="form-label">Publish Date *</label>
                            <input type="datetime-local"
                                   class="form-control form-control-custom">
                        </div>

                        <!-- MESSAGE -->
                        <div class="col-12">
                            <label class="form-label">Message *</label>
                            <textarea rows="4"
                                      class="form-control form-control-custom"
                                      placeholder="Write announcement message..."
                                      required></textarea>
                        </div>

                        <!-- ATTACHMENTS -->
                        <div class="col-12">
                            <label class="form-label">Attachments</label>
                            <input type="file"
                                   class="form-control form-control-custom"
                                   multiple>
                            <small class="text-muted">
                                PDF, DOC, images supported
                            </small>
                        </div>

                    </div>
                </div>

                <!-- FOOTER -->
                <div class="modal-footer">
                    <button type="button"
                            class="btn muted-btn"
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
