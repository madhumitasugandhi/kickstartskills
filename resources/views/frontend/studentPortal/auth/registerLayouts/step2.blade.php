<div class="glass-card">
    <h5 class="fw-bold mb-3 text-white">Tell us more about you</h5>

    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label class="form-label text-white-50 small">Phone Number</label>
            <div class="input-group-custom">
                <i class="bi bi-telephone input-icon"></i>
                <input type="tel" name="phone" id="phone" class="custom-input" placeholder="+91 9876543210">
            </div>
        </div>
        <div class="col-md-6">
            <label class="form-label text-white-50 small">Country</label>
            <div class="input-group-custom">
                <i class="bi bi-globe input-icon"></i>
                <select name="country" id="country" class="custom-input form-select" style="appearance: auto;">
                    <option value="India">India</option>
                    <option value="USA">United States</option>
                    <option value="UK">United Kingdom</option>
                </select>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label text-white-50 small">Institution Code</label>
        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" id="no-institution-code"
                onchange="toggleInstitutionFields()">
            <label class="form-check-label text-white-50 small" for="no-institution-code">
                I don't have an institution code (Individual learner)
            </label>
        </div>
        <div class="input-group-custom">
            <i class="bi bi-hash input-icon"></i>
            <input type="text" name="institution_code" id="institution_code" class="custom-input"
                placeholder="Enter Code (e.g. DU2024)">
        </div>
    </div>

    <hr class="border-white opacity-25 my-4">

    <h6 class="text-white fw-bold mb-2">Skills & Learning Goals</h6>
    <div class="mb-3">
        <label class="small text-white-50 d-block mb-2">Current Skills</label>
        <div id="currentSkillsContainer" class="d-flex flex-wrap gap-2"
            style="min-height: 40px; border: 1px dashed rgba(255,255,255,0.1); border-radius: 10px; padding: 5px;">
        </div>
    </div>

    <div class="mb-4">
        <label class="small text-white-50 d-block mb-2">Learning Goals</label>
        <div id="learningGoalsContainer" class="d-flex flex-wrap gap-2"
            style="min-height: 40px; border: 1px dashed rgba(255,255,255,0.1); border-radius: 10px; padding: 5px;">
        </div>
    </div>
    <h6 class="text-white fw-bold mb-2">Browse Category</h6>
    <div class="skills-scroll-container mt-3">
        <div class="accordion accordion-flush" id="categoryAccordion">
            @foreach($skillsCategories as $category)
            <div class="accordion-item bg-transparent border-0 mb-2">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed bg-white bg-opacity-10 text-white rounded-3 py-2"
                        type="button" data-bs-toggle="collapse" data-bs-target="#cat-{{ $category->id }}">
                        <i class="bi {{ $category->icon }} me-2 text-info"></i> {{ $category->name }}
                    </button>
                </h2>
                <div id="cat-{{ $category->id }}" class="accordion-collapse collapse"
                    data-bs-parent="#categoryAccordion">
                    <div class="accordion-body d-flex flex-wrap gap-2 pt-2">
                        @foreach($category->subcategories as $sub)
                        <button type="button" class="btn btn-sm btn-outline-light rounded-pill px-3"
                            onclick="openSkillModal('{{ $sub->name }}')">
                            {{ $sub->name }}
                        </button>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="mt-4">
        <button type="button" class="btn-action w-100 mb-2" onclick="switchStep(3)">Continue</button>
        <button type="button" class="btn-prev w-100" onclick="switchStep(1)">Previous</button>
    </div>
</div>

<div class="modal fade" id="addSkillModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white border-secondary" style="border-radius: 20px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="skillModalName">Skill Name</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <label class="small text-white-50 d-block mb-3">Add as:</label>
                    <div class="d-flex gap-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="skillType" id="typeCurrent"
                                value="current" checked>
                            <label class="form-check-label text-white" for="typeCurrent">Current Skill</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="skillType" id="typeGoal" value="goal">
                            <label class="form-check-label text-white" for="typeGoal">Learning Goal</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="small text-white-50 d-block mb-2">Proficiency Level:</label>
                    <select id="skillLevel" class="form-select bg-dark text-white border-secondary py-2">
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advanced">Advanced</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-primary w-100" onclick="saveSkill()">Add Skill</button>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    function toggleInstitutionFields() {
        const isChecked = document.getElementById('no-institution-code').checked;
        const codeInput = document.getElementById('institution_code');
        if (isChecked) {
            codeInput.value = ''; codeInput.disabled = true; codeInput.style.opacity = '0.5';
        } else {
            codeInput.disabled = false; codeInput.style.opacity = '1';
        }
    }
</script> --}}
