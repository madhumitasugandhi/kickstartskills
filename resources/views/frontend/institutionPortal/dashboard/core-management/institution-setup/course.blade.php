<div id="courseDBData"
     data-courses='@json($institution->courseTypes ?? [])'>
</div>

<div id="courseData"
     data-session='@json($sessionData["courses"] ?? [])'>
</div>

<div id="courseStep">

    <!-- HEADER -->
    <div class="mb-3">
        <div class="ui-section-title">COURSE CATALOG SETUP</div>
        <small class="text-muted">
            Configure course types, durations, and student requirements
        </small>
    </div>

    <!-- ADD COURSE TYPE -->
    <div class="ui-section">

        <div class="ui-section-title mb-3">Course Type Configuration</div>

        <!-- Course Name -->
        <div class="mb-3">
            <label class="ui-label">Course Type Name</label>
            <div class="ui-input-icon">
                <i class="bi bi-journal-text"></i>
                <input type="text" id="courseTypeName" class="form-control"
                       placeholder="e.g. MCA, BTech, MBA">
            </div>
        </div>

        <!-- Duration -->
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="ui-label">Duration (Years)</label>
                <div class="ui-input-icon">
                    <i class="bi bi-calendar-range"></i>
                    <input type="number" id="durationYears" class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <label class="ui-label">Duration (Months)</label>
                <div class="ui-input-icon">
                    <i class="bi bi-clock-history"></i>
                    <input type="number" id="durationMonths" class="form-control">
                </div>
            </div>
        </div>

        <!-- Code Extension -->
        <div class="mb-3">
            <label class="ui-label d-flex justify-content-between">
                Course Code Extension
                <span class="char-counter small">0/3</span>
            </label>
            <div class="ui-input-icon">
                <i class="bi bi-hash"></i>
                <input type="text" id="codeExtension" maxlength="3"
                       class="form-control" placeholder="e.g. BT">
            </div>
        </div>

        <!-- Requirements -->
        <div class="mb-3">
            <label class="ui-label mb-2">Background Requirements</label>
            <div class="ui-chips">
                @foreach($requirements as $req)
                    <button type="button"
                        class="ui-chip selectable-chip"
                        data-id="{{ $req->requirement_id }}"
                        onclick="toggleRequirement(this)">
                        {{ $req->requirement_name }}
                    </button>
                @endforeach
            </div>
        </div>

        <button type="button" id="addCourseTypeBtn"
                class="btn btn-primary w-100">
            <i class="bi bi-plus-lg me-2"></i>
            Add Course Type to Catalog
        </button>
    </div>

    <!-- CONFIGURED COURSES -->
    <div class="ui-section">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="ui-section-title mb-0">Configured Course Types</div>
            <span class="ui-badge" id="courseCountBadge">0</span>
        </div>

        <div id="courseListContainer">
            <div class="text-center py-3 text-muted">
                No courses added yet.
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {

let initialized = false;

function initCourseStep(){

    if(initialized) return;
    initialized = true;

    const addBtn = document.getElementById('addCourseTypeBtn');
    const courseList = document.getElementById('courseListContainer');
    const badge = document.getElementById('courseCountBadge');

    const nameInput = document.getElementById('courseTypeName');
    const yearsInput = document.getElementById('durationYears');
    const monthsInput = document.getElementById('durationMonths');
    const codeInput = document.getElementById('codeExtension');

    const sessionCourses = JSON.parse(
        document.getElementById('courseData').dataset.session || '[]'
    );

    const dbCoursesRaw = JSON.parse(
        document.getElementById('courseDBData').dataset.courses || '[]'
    );

    // Convert DB format to session format
    const dbCourses = dbCoursesRaw.map(course => ({
        name: course.course_name,
        years: course.duration_years,
        months: course.duration_months,
        code: course.code_extension,
        requirements: course.requirements
            ? course.requirements.map(r => ({
                id: r.requirement_id,
                name: r.requirement_name
            }))
            : []
    }));

    // Priority: Session → DB
    window.courseCatalog = sessionCourses.length ? sessionCourses : dbCourses;

    renderCourses();

    addBtn.onclick = function () {

        const name = nameInput.value.trim();
        const years = yearsInput.value.trim();
        const months = monthsInput.value.trim();
        const code = codeInput.value.trim().toUpperCase();

        const activeReqs = [];

        document.querySelectorAll('.requirement-btn.active').forEach(btn => {
            activeReqs.push({
                id: btn.dataset.id,
                name: btn.innerText.trim()
            });
        });

        if (!name || !years || !months) {
            Swal.fire({icon:'warning', title:'Fill course details'});
            return;
        }

        if (!code || code.length < 2) {
            Swal.fire({icon:'warning', title:'Course code must be 2-3 characters'});
            return;
        }

        const courseData = {
            name,
            years,
            months,
            code,
            requirements: activeReqs
        };

        window.courseCatalog.push(courseData);

        saveCourseToSession();
        renderCourses();
        resetForm();
    };

    function renderCourses() {

        courseList.innerHTML = '';

        if (window.courseCatalog.length === 0) {
            courseList.innerHTML =
                '<div class="text-center py-3 empty-state">No courses added yet.</div>';
            badge.innerText = 0;
            return;
        }

        window.courseCatalog.forEach((course, index) => {

            const courseItem = document.createElement('div');

            courseItem.className = 'ui-list-item';

            courseItem.innerHTML = `
                <div>
                    <div class="fw-bold mb-1"
                        style="color: var(--primary); font-weight:600;">
                        ${course.name}
                    </div>

                    <div class="text-main small mb-2 fw-medium">
                        ${course.years} years, ${course.months} months
                    </div>

                    <div style="font-size:12px;">
                        Requirements:
                        ${
                            course.requirements && course.requirements.length
                            ? course.requirements.map(r => r.name).join(', ')
                            : 'None'
                        }
                    </div>
                </div>

                <button class="btn btn-sm btn-danger delete-course">
                    <i class="bi bi-trash3"></i>
                </button>
            `;

            courseItem.querySelector('.delete-course')
                .addEventListener('click', function () {

                    window.courseCatalog.splice(index, 1);
                    saveCourseToSession();
                    renderCourses();
                });

            courseList.appendChild(courseItem);
        });

        badge.innerText = window.courseCatalog.length;
    }

    function resetForm() {
        nameInput.value = '';
        yearsInput.value = '';
        monthsInput.value = '';
        codeInput.value = '';

        document.querySelectorAll('.requirement-btn.active')
            .forEach(btn => btn.classList.remove('active'));
    }

    async function saveCourseToSession() {
        await fetch('/institution/core-management/setup/save-step', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                step: 'courses',
                data: window.courseCatalog
            })
        });
    }
}

// Run when step opened
document.addEventListener('stepChanged', e => {
    if(e.detail.step === 2){
        initCourseStep();
    }
});

});

// Requirement toggle
function toggleRequirement(btn) {
btn.classList.toggle('active');
}

window.getCourseCatalog = function () {
return window.courseCatalog || [];
};

</script>



