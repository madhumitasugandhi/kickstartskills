<div class="setup-step" id="codeStep">
    <div id="codeSetupData"
        data-session='@json($sessionData["code"] ?? [])'>
    </div>


    <div class="mb-4">

        <div class="d-flex justify-content-between align-items-center">

            <div>
                <h6 class="section-title-custom mb-1">
                    Institution Code Configuration
                </h6>

                <p class="small">
                    Configure how student institution codes will be generated
                </p>
            </div>

            <!-- Institution Code Display -->
            <!-- <div class="text-end">

        <div class="small d-flex align-items-center gap-1">

            Your Institution Code

            <i class="bi bi-info-circle"
               data-bs-toggle="tooltip"
               title="This code was automatically generated during registration using institution name, registration year and PIN code.">
            </i>

        </div>

        <span class="badge bg-light text-dark border px-3 py-2"
              style="font-size:13px; font-weight:600;">
            {{ $institution->institution_code }}
        </span>

    </div> -->

        </div>

    </div>

    <div class="config-card p-4 mb-4">

        <div class="mb-4">
            <label class="form-label-custom">Institution Code Prefix</label>
            <div class="input-group-custom">
                <i class="bi bi-type"></i>
                <input
                    type="text"
                    id="codePrefix"
                    class="form-control ps-5"
                    placeholder="e.g. INS"
                    maxlength="3"
                    value="{{ $sessionData['code']['prefix'] ?? $institution->institution_code_prefix ?? '---' }}"
                    style="text-transform:uppercase;">
            </div>
            <small class=" mt-1 d-block" style="font-size: 11px;">
                This will be the beginning of all student codes
            </small>
        </div>

        <div class="mb-4">
            <label class="form-label-custom">Code Format</label>
            <div class="input-group-custom">
                <i class="bi bi-layers"></i>
                <select class="form-select ps-5" id="codeFormat">
                    <option value="sequential" selected>Sequential (001, 002...)</option>
                    <option value="random">Random (Alpha-numeric)</option>
                </select>
            </div>
        </div>

        <div class="added-box d-flex justify-content-between align-items-center mb-4 p-3">
            <div>
                <div class="text-main fw-semibold" style="font-size: 14px;">Include Year In Code</div>
                <small class="" style="font-size: 12px;">Include enrollment year (e.g., 2024)</small>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="includeYearToggle" checked style="cursor: pointer; width: 2.5em; height: 1.25em;">
            </div>
        </div>

        <div class="code-preview-box">
            <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                <i class="bi bi-eye text-primary-teal"></i>
                <span class="fw-semibold text-primary-teal" style="font-size: 14px; text-transform: uppercase;">Live Preview</span>
            </div>

            <div class="code-preview-badge mb-3" id="liveCodePreview">

            </div>

            <div class="" style="font-size: 11px;">
                Format Structure: <code class="text-primary-teal">{PREFIX}-{YEAR}-{NUMBER}</code>
            </div>
        </div>
    </div>

    <div class="config-card p-4">
        <label class="form-label-custom mb-3">Generation Examples</label>

        <div id="exampleContainer"></div>

        <div class="academic-warning academic-warning--info mt-4">
            <div class="warning-container d-flex">
                <div class="warning-icon-wrapper me-3">
                    <i class="bi bi-info-circle-fill"></i>
                </div>
                <div class="warning-body">
                    <div class="warning-title fw-bold mb-2">Important Notes</div>
                    <div class="warning-content">
                        <ul class="mb-0 ps-3">
                            <li>Once finalized, the code format <strong>cannot be changed</strong>.</li>
                            <li>Sequential numbering ensures no duplicate student IDs.</li>
                            <li>Codes generate automatically during the enrollment process.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const data = JSON.parse(
            document.getElementById('codeSetupData').dataset.session
        ) || {};



        const exampleContainer = document.getElementById('exampleContainer');

        function getCourses() {
            if (window.courseCatalog && window.courseCatalog.length) {
                return window.courseCatalog;
            }

            try {
                return JSON.parse(
                    document.getElementById('courseData')?.dataset.session || '[]'
                );
            } catch (e) {
                return [];
            }
        }

        function generateExamples() {
            const courseData = getCourses();

            exampleContainer.innerHTML = '';

            if (courseData.length === 0) {
                exampleContainer.innerHTML = '<div class="small text-muted">No courses found</div>';
                return;
            }

            let prefix = prefixInput.value.toUpperCase();
            let yearPart = yearToggle.checked ? establishedYear : '';

            courseData.forEach((course, index) => {

                let seq = '001';

                let code = `${prefix}-${course.code}`;

                if (yearPart) {
                    code += `-${yearPart}`;
                }

                code += `-${seq}`;

                exampleContainer.innerHTML += `
            <div class="example-item mb-2 d-flex justify-content-between">
                <span class="small fw-medium text-main">${course.name}</span>
                <span class="badge-preview">${code}</span>
            </div>
        `;
            });
        }
        const prefixInput = document.getElementById('codePrefix');
        const yearToggle = document.getElementById('includeYearToggle');
        const formatSelect = document.getElementById('codeFormat');
        const previewBadge = document.getElementById('liveCodePreview');

        const establishedYear = "{{ $institution->established_year ?? date('Y') }}";

        // ================= RESTORE SESSION =================
        if (data.prefix) {
            prefixInput.value = data.prefix;
        }

        if (data.include_year !== undefined) {
            yearToggle.checked = data.include_year;
        }

        if (data.format) {
            formatSelect.value = data.format;
        }

        // ================= PREVIEW =================
        function updatePreview() {

            let prefix = prefixInput.value
                .toUpperCase()
                .replace(/[^A-Z]/g, '')
                .slice(0, 3);

            prefixInput.value = prefix;

            const courseData = getCourses();

            if (courseData.length === 0) {
                previewBadge.innerText = 'No Course';
                return;
            }

            const firstCourse = courseData[0];

            const yearPart = yearToggle.checked ? establishedYear : '';

            let numberPart = formatSelect.value === 'random' ?
                'A9X' :
                '001';

            let preview = `${prefix}-${firstCourse.code}`;

            if (yearPart) {
                preview += `-${yearPart}`;
            }

            preview += `-${numberPart}`;

            previewBadge.innerText = preview;

            generateExamples(); // 🔥 important
        }

        prefixInput.addEventListener('input', updatePreview);
        yearToggle.addEventListener('change', updatePreview);
        formatSelect.addEventListener('change', updatePreview);

        updatePreview();

        // ================= SAVE FUNCTION =================
        window.saveCodeStep = async function() {

            const payload = {
                prefix: prefixInput.value,
                include_year: yearToggle.checked,
                format: formatSelect.value
            };

            await fetch('/institution/core-management/setup/save-step', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    step: 'code',
                    data: payload
                })
            });

        };

        document.addEventListener('coursesUpdated', () => {
        updatePreview();
    });

    document.addEventListener('refreshCodeSetup', () => {

        if (window.getCoursesGlobal) {
            window.courseCatalog = window.getCoursesGlobal();
        }

        updatePreview();
    });
    });

    
</script>