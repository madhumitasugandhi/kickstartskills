<div class="modal fade" id="editCourseModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content glass-modal">

            <div class="modal-header">
                <h6 class="modal-title">Edit Course</h6>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-4 p-md-5">
                @include('frontend.institutionPortal.dashboard.programs.course-catalog.modals._form')
            </div>

            <div class="modal-footer">
                <button class="btn muted-btn" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-teal">Update Course</button>
            </div>

        </div>
    </div>
</div>
