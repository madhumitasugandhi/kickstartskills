<div id="codeStep">

    <div id="codeSetupData"
        data-session='@json($sessionData["code"] ?? [])'>
    </div>

    <!-- HEADER -->
    <div class="mb-3">
        <div class="ui-section-title">INSTITUTION CODE CONFIGURATION</div>
        <small class="">
            Configure how student institution codes will be generated
        </small>
    </div>

    <!-- CODE SETTINGS -->
    <div class="ui-section">

        <!-- Prefix -->
        <div class="mb-3">
            <label class="ui-label">Institution Code Prefix</label>
            <div class="ui-input-icon">
                <i class="bi bi-type"></i>
                <input
                    type="text"
                    id="codePrefix"
                    class="form-control"
                    maxlength="3"
                    placeholder="e.g. INS"
                    value="{{ $sessionData['code']['prefix'] ?? $institution->institution_code_prefix ?? '' }}"
                    style="text-transform:uppercase;">
            </div>
            <small class="">
                This will be the beginning of all student codes
            </small>
        </div>

        <!-- Format -->
        <div class="mb-3">
            <label class="ui-label">Code Format</label>
            <div class="ui-input-icon">
                <i class="bi bi-layers"></i>
                <select class="form-select" id="codeFormat">
                    <option value="sequential">Sequential (001, 002...)</option>
                    <option value="random">Random (Alpha-numeric)</option>
                </select>
            </div>
        </div>

        <!-- Toggle -->
        <div class="ui-list-item mb-3">
            <div>
                <div class="fw-semibold">Include Year In Code</div>
                <small class="">
                    Include enrollment year (e.g., 2024)
                </small>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input"
                       type="checkbox"
                       id="includeYearToggle"
                       checked>
            </div>
        </div>

        <!-- Preview -->
        <div class="ui-preview-box text-center">
            <div class="mb-2  small">
                Live Preview
            </div>

            <div class="ui-preview-badge mb-2" id="liveCodePreview"></div>

            <div class="small ">
                Format Structure:
                <code>{PREFIX}-{COURSE}-{YEAR}-{NUMBER}</code>
            </div>
        </div>

    </div>

    <!-- EXAMPLES -->
    <div class="ui-section">
        <div class="ui-section-title mb-3">Generation Examples</div>
        <div id="exampleContainer"></div>

        <div class="ui-alert mt-3">
            <i class="bi bi-info-circle-fill"></i>
            <div>
                <strong>Important Notes</strong>
                <ul class="mb-0 mt-1">
                    <li>Once finalized, the code format cannot be changed.</li>
                    <li>Sequential numbering ensures no duplicate student IDs.</li>
                    <li>Codes generate automatically during enrollment.</li>
                </ul>
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
                exampleContainer.innerHTML = '<div class="small ">No courses found</div>';
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