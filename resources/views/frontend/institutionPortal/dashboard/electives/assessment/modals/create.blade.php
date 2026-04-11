<div class="modal fade" id="createAssessmentModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content glass-modal">

            <!-- HEADER -->
            <div class="modal-header px-4 pt-4 pb-2">
                <h5 class="modal-title">Create Assessment</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body px-4 pb-4">
                <form id="createAssessmentForm">
                    @csrf

                    <div class="row g-4">

                        <!-- Title -->
                        <div class="col-md-6 floating-field">
                            <input type="text" name="title" id="assessment_title" class="form-control" placeholder=" ">
                            <label>Assessment Title *</label>
                        </div>

                    <div class="col-md-6">
                        <label class="form-label small">Course *</label>
                        <select class="form-select">
                            <option>Introduction to ML</option>
                        </select>
                    </div>

                     <!-- Type -->
                     <div class="col-md-4 floating-field">
                            <select name="type" id="type" class="form-select">
                                <option value="">Select Type</option>
                                <option value="quiz">Quiz</option>
                                <option value="exam">Exam</option>
                                <option value="assignment">Assignment</option>
                            </select>
                            <label>Type *</label>
                        </div>

                        <!-- Duration -->
                        <div class="col-md-4 floating-field">
                            <input type="number" name="duration" id="duration" class="form-control" placeholder=" ">
                            <label>Duration (min) *</label>
                        </div>

                        <!-- Marks -->
                        <div class="col-md-4 floating-field">
                            <input type="number" name="total_marks" id="total_marks" class="form-control" placeholder=" ">
                            <label>Total Marks *</label>
                        </div>

                        <!-- Date -->
                        <div class="col-md-4 floating-field">
                            <input type="date" name="schedule_date" id="schedule_date" class="form-control" placeholder=" ">
                            <label>Schedule Date *</label>
                        </div>

                        <!-- Pass Percentage -->
                        <div class="col-md-4 floating-field">
                            <input type="number" name="pass_percentage" id="pass_percentage" class="form-control" placeholder=" ">
                            <label>Pass Percentage *</label>
                        </div>

                        <!-- Status -->
                        <div class="col-md-4 floating-field">
                            <select name="status" id="status" class="form-select">
                                <option value="draft">Draft</option>
                                <option value="active">Active</option>
                            </select>
                            <label>Status *</label>
                        </div>

                    </div>

                </form>
            </div>

            <!-- FOOTER -->
            <div class="modal-footer border-0 px-4 pb-4">
                <button type="button" class="muted-btn" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" form="createAssessmentForm" class="btn btn-teal px-4">
                    Save Assessment
                </button>
            </div>

        </div>
    </div>
</div>