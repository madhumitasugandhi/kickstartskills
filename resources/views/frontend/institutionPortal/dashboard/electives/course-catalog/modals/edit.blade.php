<div class="modal fade" id="editCourseModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content glass-modal">

            <!-- HEADER -->
            <div class="modal-header px-4 pt-4 pb-2">
                <h5 class="modal-title">Edit Course</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body px-4 pb-4">
                <form id="editCourseForm">
                    @csrf
                    <input type="hidden" id="edit_course_id" name="course_id">

                    @include('frontend.institutionPortal.dashboard.electives.course-catalog.modals._form')
                </form>
            </div>

            <!-- FOOTER -->
            <div class="modal-footer border-0 px-4 pb-4">
                <button type="button" class="muted-btn" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" form="editCourseForm" class="btn btn-teal px-4">
                    Update Course
                </button>
            </div>

        </div>
    </div>
</div>