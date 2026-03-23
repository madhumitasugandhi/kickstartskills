<div class="modal fade" id="editCourseTypeModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content glass-modal">

      <div class="modal-header">
        <h6 class="modal-title">Edit Course Type</h6>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <div class="floating-field mb-3">
        <input name="course_name" id="edit_course_name" class="form-control" />
        <label>Course Type Name</label>
        </div>

        <div class="row g-2 mb-3">
          <div class="col">
            <div class="floating-field">
            <input name="duration_years" id="edit_duration_years" class="form-control" />
            <label>Duration (Years)</label>
            </div>
          </div>
          <div class="col">
            <div class="floating-field">
            <input name="duration_months" id="edit_duration_months" class="form-control" />
            <label>Duration (Months)</label>
            </div>
          </div>
        </div>

        <div class="floating-field">
        <input name="code_extension" id="edit_code_extension" class="form-control" />
                  <label>Course Code Extension</label>
        </div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-link muted-btn" data-bs-dismiss="modal">
          Cancel
        </button>
        <button class="btn btn-success" id="updateCourseBtn">          Save Changes
        </button>
      </div>

    </div>
  </div>
</div>

<script>
  document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', function () {

        let id = this.dataset.id;

        document.getElementById('edit_course_name').value = this.dataset.name;
        document.getElementById('edit_duration_years').value = this.dataset.years;
        document.getElementById('edit_duration_months').value = this.dataset.months;
        document.getElementById('edit_code_extension').value = this.dataset.code;

        // 🔥 SET ID FOR UPDATE
        document.getElementById('updateCourseBtn').dataset.id = id;
    });
});

</script>
