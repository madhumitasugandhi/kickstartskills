<div class="setup-step" id="courseStep">
    <div class="mb-4">
        <h6 class="section-title-custom mb-1">Course Catalog Setup</h6>
        <p class=" small">Configure course types, durations, and student requirements for your institution</p>
    </div>

    {{-- Add Course Type Section --}}
    <div class="config-card p-4 mb-4" id="courseInputForm">
        <h6 class="text-main fw-semibold mb-4" style="font-size: 0.95rem;">
            <i class="bi bi-plus-circle me-2 text-primary-teal"></i>Course Types Configuration
        </h6>

        {{-- Course Name --}}
        <div class="mb-4">
            <label class="form-label-custom">Course Type Name</label>
            <div class="input-group-custom">
                <i class="bi bi-journal-text"></i>
                <input type="text" id="courseTypeName" class="form-control ps-5" placeholder="e.g. MCA">
            </div>
        </div>

        {{-- Duration --}}
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label class="form-label-custom">Duration (Years)</label>
                <div class="input-group-custom">
                    <i class="bi bi-calendar-range"></i>
                    <input type="number" id="durationYears" placeholder="Years" class="form-control ps-5">
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label-custom">Duration (Months)</label>
                <div class="input-group-custom">
                    <i class="bi bi-clock-history"></i>
                    <input type="number" id="durationMonths" placeholder="Months" class="form-control ps-5">
                </div>
            </div>
        </div>

        {{-- Code Extension --}}
        <div class="mb-4">
            <label class="form-label-custom d-flex justify-content-between">
                Institution Code Extension (2–3 chars)
                <span class=" char-counter" style="font-size: 10px;">0/3</span>
            </label>
            <div class="input-group-custom">
                <i class="bi bi-hash"></i>
                <input type="text" id="codeExtension" maxlength="3" placeholder="e.g. BT" class="form-control ps-5">
            </div>
        </div>

        {{-- Background Requirements --}}
        <div class="mb-4">
            <label class="form-label-custom mb-3">Background Requirements</label>
            <div class="d-flex flex-wrap gap-2" id="requirementContainer">
                @php
                    // Defining variable here prevents the "Undefined variable" error
                    $requirements = [
                        '10th Grade completion', '12th Grade with Science', '12th Grade with Commerce',
                        "Bachelor's degree", 'B.Tech or equivalent', 'Work experience preferred',
                        'Minimum 60% marks', 'Minimum 70% marks', 'Valid entrance exam score'
                    ];
                @endphp

                @foreach($requirements as $req)
                    <button type="button" class="btn btn-sm requirement-btn" onclick="toggleRequirement(this)">
                        {{ $req }}
                    </button>
                @endforeach
            </div>
        </div>

        <button type="button" id="addCourseTypeBtn" class="btn btn-success w-100 py-2 fw-semibold mt-2" style="background-color: var(--primary-teal); border: none;">
            <i class="bi bi-plus-lg me-2"></i> Add Course Type to Catalog
        </button>
    </div>

    {{-- List of Added Courses --}}
    <div class="config-card p-4">
        <h6 class="text-main fw-semibold mb-4" style="font-size: 0.95rem;">
            Configured Course Types <span class="badge rounded-pill ms-2" id="courseCountBadge" style="background: var(--active-bg); color: var(--primary-teal); font-size: 12px;">0</span>
        </h6>
        <div id="courseListContainer">
            <div class="text-center  py-3 empty-state">No courses added yet.</div>
        </div>
    </div>
</div>
{{-- Page-specific styles --}}
<!-- <style>
    .requirement-btn.active {
        color: #fff;
    }

    .form-control::placeholder {
        color: rgba(255,255,255,0.5);
    }
</style> -->
<script>
   
   document.addEventListener('DOMContentLoaded', function () {
    const addBtn = document.getElementById('addCourseTypeBtn');
    const courseList = document.getElementById('courseListContainer');
    const badge = document.getElementById('courseCountBadge');
    const codeInput = document.getElementById('codeExtension');
    const charCounter = document.querySelector('.char-counter');

    // Real-time character counter
    codeInput?.addEventListener('input', (e) => {
        charCounter.innerText = `${e.target.value.length}/3`;
    });

    addBtn?.addEventListener('click', function () {
        // 1. Capture Data
        const name = document.getElementById('courseTypeName').value.trim();
        const years = document.getElementById('durationYears').value.trim();
        const months = document.getElementById('durationMonths').value.trim();
        const code = codeInput.value.trim();
        
        const activeReqs = [];
        document.querySelectorAll('.requirement-btn.active').forEach(btn => {
            activeReqs.push(btn.innerText.trim());
        });

        // 2. Validation
        if (!name || !years || !months || !code) {
            alert('Please fill in Name, Duration, and Code.');
            return;
        }

        // 3. Create Element
        const courseItem = document.createElement('div');
        courseItem.className = 'configured-item d-flex justify-content-between align-items-start mb-3 p-3';
        courseItem.innerHTML = `
            <div>
                <div class="fw-bold mb-1" style="color: var(--primary-teal); font-size: 15px;">${name}</div>
                <div class="text-main small mb-2 fw-medium">
                    <i class="bi bi-calendar3 me-2"></i>${years} years, ${months} months | Code: ${code}
                </div>
                <div style="font-size: 12px; line-height: 1.5;">
                    <i class="bi bi-shield-check me-2"></i>Requirements: ${activeReqs.length > 0 ? activeReqs.join(', ') : 'None'}
                </div>
            </div>
            <button class="delete-btn btn btn-sm btn-danger" onclick="this.parentElement.remove(); updateBadgeCount();">
                <i class="bi bi-trash3"></i>
            </button>
        `;

        // 4. Update UI
        const emptyState = courseList.querySelector('.empty-state');
        if (emptyState) emptyState.remove();
        courseList.appendChild(courseItem);
        updateBadgeCount();

        // 5. Reset Form
        document.getElementById('courseTypeName').value = '';
        document.getElementById('durationYears').value = '';
        document.getElementById('durationMonths').value = '';
        codeInput.value = '';
        charCounter.innerText = '0/3';
        document.querySelectorAll('.requirement-btn.active').forEach(btn => btn.classList.remove('active'));
    });

    function updateBadgeCount() {
        const count = courseList.querySelectorAll('.configured-item').length;
        badge.innerText = count;
        if (count === 0) {
            courseList.innerHTML = '<div class="text-center  py-3 empty-state">No courses added yet.</div>';
        }
    }
    
    window.updateBadgeCount = updateBadgeCount;
});

function toggleRequirement(btn) {
    btn.classList.toggle('active');
}
</script>



