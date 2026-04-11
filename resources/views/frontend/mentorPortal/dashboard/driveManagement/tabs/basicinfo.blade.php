<div class="card-custom">
    <h6 class="section-title"><i class="bi bi-info-circle"></i> Drive Information</h6>

    <div class="mb-3">
        <input type="text" name="drive_title" class="form-control" placeholder="Company name, Drive title" >
    </div>

    <div class="mb-3">
        <textarea name="drive_description" class="form-control" rows="3" placeholder="Description"></textarea>
    </div>

    <div class="mb-3">
        <select name="drive_type" class="form-select">
            <option value="INTERNSHIP">Internship</option>
            <option value="APPRENTICESHIP">Apprenticeship</option>
            <option value="FULL_TIME">Full-time</option>
            <option value="PART_TIME">Part-time</option>
            <option value="CONTRACTUAL">Contract</option>
            <option value="FREELANCE">Freelance</option>
        </select>
    </div>

    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
            <input type="text" name="location" class="form-control input-with-icon" placeholder="Location(Bangalore, India)">
        </div>
    </div>

    <!-- <div class="mb-4 d-flex justify-content-between align-items-center bg-bg-hover p-2 rounded border border-secondary-subtle" style="border-color: var(--border-color) !important;">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-wifi text-primary"></i>
            <span class="text-main small fw-bold">Remote Work Available</span>
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="remote_allowed" value="1" role="switch" checked>
        </div>
    </div> -->

    <h6 class="section-title mt-4"><i class="bi bi-briefcase"></i> Job Requirements</h6>

    <div class="mb-3">
        <textarea name="job_description" class="form-control" rows="3" placeholder="Job Description"></textarea>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-12 col-md-6">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-people"></i></span>
                <input type="number" name="positions" class="form-control input-with-icon" placeholder="Number of Positions">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-clock"></i></span>
                <input type="number" name="hours_per_week" class="form-control input-with-icon" placeholder="Hours per Week">
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-md-6">
            <label class="form-label">Work Mode</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-laptop"></i></span>
                <select name="work_mode" class="form-select input-with-icon">
                    <option selected>REMOTE</option>
                    <option>ON-SITE</option>
                    <option>HYBRID</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <label class="form-label">Mentorship Level</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                <select class="form-select input-with-icon" name="mentorship_level" id="mentorshipLevel">
                    <option selected>INTERMEDIATE</option>
                    <option>BEGINNER</option>
                    <option>ADVANCED</option>
                </select>
            </div>
        </div>
    </div>

    <label class="form-label">Skill Category</label>
    <select id="skillCategory" class="form-select mb-4">
        <option value="">Select Category</option>
        @foreach($categories as $cat)
        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
    </select>

    <input type="hidden" name="skills" id="selectedSkills">

    <div class="mb-4">
        <label class="form-label">Required Technologies</label>
        <div id="skillsContainer" class="d-flex flex-wrap gap-2"></div>
    </div>


    <div class="form-footer">
        <button class="btn btn-outline-secondary px-4 fw-bold">Cancel</button>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-primary next-tab" data-next="tab-eligibility">
                Next
            </button>
        </div>
    </div>

</div>

<script>
    document.getElementById('skillCategory').addEventListener('change', function() {
        let categoryId = this.value;

        fetch('/get-skills/' + categoryId)
            .then(response => response.json())
            .then(data => {
                let container = document.getElementById('skillsContainer');
                container.innerHTML = '';

                data.forEach(skill => {
                    let badge = document.createElement('span');
                    badge.className = 'tech-badge';
                    badge.innerText = skill.name;
                    badge.dataset.id = skill.id;

                    badge.addEventListener('click', function() {
                        badge.classList.toggle('selected');
                        updateSelectedSkills();
                    });

                    container.appendChild(badge);
                });
            });
    });

    function updateSelectedSkills() {
        let selected = document.querySelectorAll('.tech-badge.selected');
        let ids = [];

        selected.forEach(el => {
            ids.push(el.dataset.id);
        });

        document.getElementById('selectedSkills').value = ids;
    }

    document.querySelector('.next-tab').addEventListener('click', function () {

let formData = new FormData();

formData.append('drive_title', document.querySelector('[name="drive_title"]').value);
formData.append('drive_description', document.querySelector('[name="drive_description"]').value);
formData.append('drive_type', document.querySelector('[name="drive_type"]').value);
formData.append('location', document.querySelector('[name="location"]').value);
formData.append('job_description', document.querySelector('[name="job_description"]').value);
formData.append('positions', document.querySelector('[name="positions"]').value);
formData.append('hours_per_week', document.querySelector('[name="hours_per_week"]').value);
formData.append('work_mode', document.querySelector('[name="work_mode"]').value);
formData.append('mentorship_level', document.querySelector('[name="mentorship_level"]').value);
formData.append('skills', document.getElementById('selectedSkills').value);

fetch('/mentor/drive/save-basic', {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: formData
});
});
</script>