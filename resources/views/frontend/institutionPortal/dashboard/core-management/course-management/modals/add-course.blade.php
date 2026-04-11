<div class="modal fade" id="addCourseTypeModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content ui-modal">

      <div class="modal-header ui-modal-header">
        <h6 class="modal-title">Add New Course Type</h6>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <div class="ui-floating mb-3">
          <input name="course_name" class="form-control" placeholder=" ">
          <label>Course Type Name</label>
        </div>

        <div class="row g-2 mb-3">
          <div class="col">
            <div class="ui-floating">
              <input name="duration_years" type="number" class="form-control" placeholder=" ">
              <label>Duration (Years)</label>
            </div>
          </div>
          <div class="col">
            <div class="ui-floating">
              <input name="duration_months" type="number" class="form-control" placeholder=" ">
              <label>Duration (Months)</label>
            </div>
          </div>
        </div>

        <div class="ui-floating">
          <input name="code_extension" class="form-control" placeholder=" ">
          <label>Course Code Extension</label>
        </div>

      </div>

      <div class="modal-footer ui-modal-footer">
        <button class="btn ui-btn-muted" data-bs-dismiss="modal">
          Cancel
        </button>
        <button class="btn btn-success" id="saveCourseBtn">
          Add Course Type
        </button>
      </div>

    </div>
  </div>
</div>