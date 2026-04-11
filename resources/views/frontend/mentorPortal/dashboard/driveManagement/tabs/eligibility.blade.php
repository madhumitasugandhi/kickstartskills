<div class="card-custom">

<h6 class="section-title">
    <i class="bi bi-mortarboard"></i> Academic Requirements
</h6>

<input type="hidden" name="institutions" id="selectedInstitutions">

<div class="mb-3">
    <label class="form-label">Institutions</label>
    <div id="institutionsContainer" class="d-flex flex-wrap gap-2">
        @foreach($institutions as $inst)
            <span class="tech-badge institution-badge" data-id="{{ $inst->institution_id }}">
                {{ $inst->institution_name }}
            </span>
        @endforeach
    </div>
</div>

<input type="hidden" name="departments" id="selecteddepartments">

<div class="mb-3">
    <label class="form-label">Departments</label>
    <div id="departmentsContainer" class="d-flex flex-wrap gap-2">
        @foreach($departments as $dept)
            <span class="tech-badge department-badge" data-id="{{ $dept->department_id }}">
                {{ $dept->department_name }}
            </span>
        @endforeach
    </div>
</div>


<input type="hidden" name="years" id="selectedYears">

<div class="mb-3">
<label class="form-label">Eligible Years</label>
<div class="d-flex flex-wrap gap-2">
    <span class="tech-badge year-badge" data-id="1">1st Year</span>
    <span class="tech-badge year-badge" data-id="2">2nd Year</span>
    <span class="tech-badge year-badge" data-id="3">3rd Year</span>
    <span class="tech-badge year-badge" data-id="4">4th Year</span>
</div>
</div>


<input type="hidden" name="courses" id="selectedcourses">

<div class="mb-3">
    <label class="form-label">Courses</label>
    <div id="coursesContainer" class="d-flex flex-wrap gap-2">
        @foreach($courses as $course)
            <span class="tech-badge course-badge" data-id="{{ $course->course_type_id }}">
                {{ $course->course_name }}
            </span>
        @endforeach
    </div>
</div>


<h6 class="section-title mt-4">
    <i class="bi bi-graph-up"></i> Performance Requirements
</h6>

<div class="mb-3">
    <label class="form-label">Minimum CGPA</label>
    <input type="range" name="min_cgpa" class="form-range" min="5" max="10" step="0.1">
</div>

<div class="mb-3">
    <label class="form-label">Minimum Attendance (%)</label>
    <input type="range" name="min_attendance" class="form-range" min="50" max="100">
</div>

<div class="mb-3">
    <label class="form-label">Minimum backlogs allowed</label>
    <input type="range" name="min_backlogs" class="form-range" min="0" max="10">
</div>

<div class="form-footer">
<button type="button" class="btn btn-secondary prev-tab" data-prev="tab-basic">Back</button>
<button type="button" class="btn btn-primary next-tab" data-next="tab-timeline">Next</button>
</div>

</div>

<script>
document.querySelector('#tab-eligibility .next-tab').addEventListener('click', function () {

let formData = new FormData();

formData.append('institutions', document.getElementById('selectedInstitutions').value);
formData.append('departments', document.getElementById('selecteddepartments').value);
formData.append('courses', document.getElementById('selectedcourses').value);
formData.append('years', document.getElementById('selectedYears').value);

formData.append('min_cgpa', document.querySelector('[name="min_cgpa"]').value);
formData.append('min_attendance', document.querySelector('[name="min_attendance"]').value);
formData.append('min_backlogs', document.querySelector('[name="min_backlogs"]').value);

fetch('/mentor/drive/save-eligibility', {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: formData
});
});

document.querySelectorAll('.institution-badge').forEach(badge => {
    badge.addEventListener('click', function() {
        this.classList.toggle('selected');
        updateInstitutions();
    });
});

function updateInstitutions(){
    let ids = [];
    document.querySelectorAll('.institution-badge.selected').forEach(el=>{
        ids.push(el.dataset.id);
    });
    document.getElementById('selectedInstitutions').value = ids.join(',');
}

// departments
document.querySelectorAll('.department-badge').forEach(badge => {
    badge.addEventListener('click', function() {
        this.classList.toggle('selected');
        updateDepartments();
    });
});

function updateDepartments(){
    let ids = [];
    document.querySelectorAll('.department-badge.selected').forEach(el=>{
        ids.push(el.dataset.id);
    });
    document.getElementById('selecteddepartments').value = ids.join(',');
}

// courses
document.querySelectorAll('.course-badge').forEach(badge => {
    
    badge.addEventListener('click', function() {
        this.classList.toggle('selected');
        updateCourses();
    });
});

function updateCourses(){
    let ids = [];
    document.querySelectorAll('.course-badge.selected').forEach(el=>{
        ids.push(el.dataset.id);
    });
    document.getElementById('selectedcourses').value = ids.join(',');
}

// years
document.querySelectorAll('.year-badge').forEach(badge => {
    badge.addEventListener('click', function() {
        this.classList.toggle('selected');
        updateYears();
    });
});

function updateYears(){
    let ids = [];
    document.querySelectorAll('.year-badge.selected').forEach(el=>{
        ids.push(el.dataset.id);
    });
    document.getElementById('selectedYears').value = ids.join(',');
}
</script>