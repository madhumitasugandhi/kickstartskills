<div class="modal fade" id="editCourseTypeModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content ui-modal">

      <div class="modal-header ui-modal-header">
        <h6 class="modal-title">Edit Course Type</h6>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <div class="ui-floating mb-3">
          <input name="course_name" id="edit_course_name" class="form-control" placeholder=" ">
          <label>Course Type Name</label>
        </div>

        <div class="row g-2 mb-3">
          <div class="col">
            <div class="ui-floating">
              <input name="duration_years" id="edit_duration_years" class="form-control" placeholder=" ">
              <label>Duration (Years)</label>
            </div>
          </div>
          <div class="col">
            <div class="ui-floating">
              <input name="duration_months" id="edit_duration_months" class="form-control" placeholder=" ">
              <label>Duration (Months)</label>
            </div>
          </div>
        </div>

        <div class="ui-floating">
          <input name="code_extension" id="edit_code_extension" class="form-control" placeholder=" ">
          <label>Course Code Extension</label>
        </div>

      </div>

      <div class="modal-footer ui-modal-footer">
        <button class="btn ui-btn-muted" data-bs-dismiss="modal">
          Cancel
        </button>
        <button class="btn btn-success" id="updateCourseBtn">
          Save Changes
        </button>
      </div>

    </div>
  </div>
</div>

<script>
document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', function () {

        let id = this.dataset.id;

        let name = document.getElementById('edit_course_name');
        let years = document.getElementById('edit_duration_years');
        let months = document.getElementById('edit_duration_months');
        let code = document.getElementById('edit_code_extension');

        name.value = this.dataset.name;
        years.value = this.dataset.years;
        months.value = this.dataset.months;
        code.value = this.dataset.code;

        // Trigger floating labels
        [name, years, months, code].forEach(input => {
            if(input.value !== ''){
                input.classList.add('filled');
            }
        });

        document.getElementById('updateCourseBtn').dataset.id = id;
    });
});</script>
