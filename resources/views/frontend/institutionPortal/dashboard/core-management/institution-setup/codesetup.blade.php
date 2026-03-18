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
    <div class="text-end">

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

    </div>

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
    value="{{ $sessionData['code']['prefix'] ?? substr($institution->institution_code,0,3) }}"
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

    const data = JSON.parse(
        document.getElementById('codeSetupData').dataset.session
    ) || {};

    const prefixInput = document.getElementById('codePrefix');
    const yearToggle = document.getElementById('includeYearToggle');
    const formatSelect = document.getElementById('codeFormat');
    const previewBadge = document.getElementById('liveCodePreview');

    const establishedYear = "{{ $institution->established_year ?? date('Y') }}";

    // ================= RESTORE SESSION =================
    if(data.prefix){
        prefixInput.value = data.prefix;
    }

    if(data.include_year !== undefined){
        yearToggle.checked = data.include_year;
    }

    if(data.format){
        formatSelect.value = data.format;
    }

    // ================= PREVIEW =================
    function updatePreview() {

        let prefix = prefixInput.value
            .toUpperCase()
            .replace(/[^A-Z]/g, '')
            .slice(0,3);

        prefixInput.value = prefix;

        const yearPart = yearToggle.checked ? establishedYear : '';

        let numberPart = formatSelect.value === 'random'
            ? 'A9X'
            : '001';

        let preview = '';

        if(prefix && yearPart){
            preview = `${prefix}-${yearPart}-${numberPart}`;
        }
        else if(prefix){
            preview = `${prefix}-${numberPart}`;
        }
        else{
            preview = 'Preview';
        }

        previewBadge.innerText = preview;
    }

    prefixInput.addEventListener('input', updatePreview);
    yearToggle.addEventListener('change', updatePreview);
    formatSelect.addEventListener('change', updatePreview);

    updatePreview();

    // ================= SAVE FUNCTION =================
    window.saveCodeStep = async function () {

        const payload = {
            prefix: prefixInput.value,
            include_year: yearToggle.checked,
            format: formatSelect.value
        };

        await fetch('/institution/setup/save-step',{
            method:'POST',
            headers:{
                'Content-Type':'application/json',
                'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                step:'code',
                data: payload
            })
        });

    };

});
</script>