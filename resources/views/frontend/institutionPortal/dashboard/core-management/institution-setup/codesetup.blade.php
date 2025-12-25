<div class="setup-step" id="codeStep">

    <div class="mb-4">
        <h6 class="section-title-custom mb-1">Institution Code Configuration</h6>
        <p class=" small">Configure how student institution codes will be generated</p>
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
    value="INS">
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
                INS-BT-2024-001
            </div>

            <div class="" style="font-size: 11px;">
                Format Structure: <code class="text-primary-teal">{PREFIX}-{COURSE}-{YEAR}-{NUMBER}</code>
            </div>
        </div>
    </div>

    <div class="config-card p-4">
        <label class="form-label-custom mb-3">Generation Examples</label>

        <div class="example-item mb-2">
            <span class="small fw-medium text-main">Information Technology</span>
            <span class="badge-preview">INS-IT-2024-001</span>
        </div>

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
        const prefixInput = document.getElementById('codePrefix');
        const yearToggle = document.getElementById('includeYearToggle');
        const previewBadge = document.getElementById('liveCodePreview');

        function updatePreview() {
            const prefix = prefixInput.value.toUpperCase() || 'INS';
            const yearPart = yearToggle.checked ? '-2024' : '';
            const coursePart = '-BT'; // Static placeholder for preview
            const seqPart = '-001';
            previewBadge.classList.remove('pulse');
            void previewBadge.offsetWidth;
            previewBadge.classList.add('pulse');


            previewBadge.innerText = `${prefix}${coursePart}${yearPart}${seqPart}`;
        }

        prefixInput.addEventListener('input', updatePreview);
        yearToggle.addEventListener('change', updatePreview);
    });
</script>