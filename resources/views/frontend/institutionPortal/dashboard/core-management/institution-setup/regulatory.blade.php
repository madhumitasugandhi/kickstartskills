<div id="regulatoryStep">

<div id="regulatoryData"
     data-session='@json($sessionData["regulatory"] ?? [])'>
</div>

<!-- HEADER -->
<div class="mb-3">
    <div class="ui-section-title">REGULATORY INFORMATION</div>
    <small class="">
        Provide regulatory compliance and accreditation details
    </small>
</div>

<div class="ui-section">

    <!-- AISHE -->
    <div class="mb-3">
        <label class="ui-label">AISHE Code</label>
        <div class="ui-input-icon">
            <i class="bi bi-shield"></i>
            <input type="text"
                name="aishe_code"
                value="{{ $sessionData['regulatory']['aishe_code'] ?? $institution->aishe_code }}"
                class="form-control"
                placeholder="AISHE Code">
        </div>
        <small class="">
            U for Universities, C for Colleges, S for Standalone
        </small>
    </div>

    <!-- AICTE -->
    <div class="mb-3">
        <label class="ui-label">AICTE Permanent ID</label>
        <div class="ui-input-icon">
            <i class="bi bi-gear"></i>
            <input type="text"
                name="aicte_id"
                class="form-control"
                value="{{ $sessionData['regulatory']['aicte_id'] ?? $institution->aicte_id }}"
                placeholder="AICTE ID">
        </div>
        <small class="">
            Required for technical/engineering institutions
        </small>
    </div>

    <!-- UGC -->
    <div class="mb-3">
        <label class="ui-label">UGC Recognition Number</label>
        <div class="ui-input-icon">
            <i class="bi bi-award"></i>
            <input type="text"
                name="ugc_number"
                class="form-control"
                value="{{ $sessionData['regulatory']['ugc_number'] ?? $institution->ugc_number }}"
                placeholder="UGC Recognition Number">
        </div>
    </div>

    <!-- University -->
    <div class="mb-3">
        <label class="ui-label">University Affiliation</label>
        <div class="ui-input-icon">
            <i class="bi bi-link-45deg"></i>
            <input type="text"
                name="affiliated_university"
                class="form-control"
                value="{{ $sessionData['regulatory']['affiliated_university'] ?? $institution->affiliated_university }}"
                placeholder="Affiliated University Name">
        </div>
    </div>

    <div class="ui-divider"></div>

    <!-- ACCREDITATIONS -->
    <div class="mb-3">
        <label class="ui-label">Accreditations</label>
        <small class=" d-block mb-2">
            Select all applicable accreditations
        </small>

        <div class="ui-chips" id="accreditationContainer">
            @foreach($accreditationBodies as $body)
            <div class="ui-chip selectable-chip accreditation-chip
                {{ in_array($body->accreditation_body_id, $selectedAccreditations) ? 'active' : '' }}"
                data-id="{{ $body->accreditation_body_id }}">
                {{ $body->body_name }}
            </div>
            @endforeach
        </div>

        <input type="hidden" name="accreditation_ids" id="accreditation_ids">
    </div>

    <!-- Selected -->
    <div id="selectedAccreditationsBox" class="mt-3 d-none">
        <div class="ui-section">
            <div class="fw-semibold mb-1">
                Selected Accreditations
                <span class="ui-badge" id="selectedCount">0</span>
            </div>
            <div id="selectedAccreditationsText" class="small "></div>
        </div>
    </div>

    <!-- INFO -->
    <div class="ui-alert mt-3">
        <i class="bi bi-info-circle-fill"></i>
        <div>
            <strong>Important Notes</strong>
            <ul class="mb-0 mt-1">
                <li>AISHE code is mandatory for all institutions</li>
                <li>AICTE ID is required for technical programs</li>
                <li>UGC number is required for universities</li>
                <li>Verification may take 2–3 business days</li>
            </ul>
        </div>
    </div>

</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {

let initialized = false;

function initRegulatoryStep(){

    if(initialized) return;
    initialized = true;

    const data = JSON.parse(
        document.getElementById('regulatoryData').dataset.session || '{}'
    );

    const chips = document.querySelectorAll('.accreditation-chip');
    const box = document.getElementById('selectedAccreditationsBox');
    const text = document.getElementById('selectedAccreditationsText');
    const count = document.getElementById('selectedCount');
    const hiddenInput = document.getElementById('accreditation_ids');

    const aishe = document.querySelector('[name="aishe_code"]');
    const aicte = document.querySelector('[name="aicte_id"]');
    const ugc = document.querySelector('[name="ugc_number"]');
    const uni = document.querySelector('[name="affiliated_university"]');

    // SESSION override DB values
    if(data.aishe_code) aishe.value = data.aishe_code;
    if(data.aicte_id) aicte.value = data.aicte_id;
    if(data.ugc_number) ugc.value = data.ugc_number;
    if(data.affiliated_university) uni.value = data.affiliated_university;

    if(data.accreditation_ids){
        const ids = data.accreditation_ids.split(',');

        chips.forEach(chip => {
            if(ids.includes(chip.dataset.id)){
                chip.classList.add('active');
            }
        });
    }

    function updateSelected() {

        const selected = [...chips].filter(c => c.classList.contains('active'));

        const names = selected.map(c => c.innerText.trim());
        const ids = selected.map(c => c.dataset.id);

        count.innerText = selected.length;
        text.innerText = names.join(', ');
        box.classList.toggle('d-none', selected.length === 0);

        hiddenInput.value = ids.join(',');
    }

    chips.forEach(chip => {
        chip.addEventListener('click', () => {
            chip.classList.toggle('active');
            updateSelected();
        });
    });

    updateSelected();

    // SAVE FUNCTION
    window.saveRegulatoryStep = async function () {

        const payload = {
            aishe_code: aishe.value,
            aicte_id: aicte.value,
            ugc_number: ugc.value,
            affiliated_university: uni.value,
            accreditation_ids: hiddenInput.value
        };

        await fetch('/institution/core-management/setup/save-step',{
            method:'POST',
            headers:{
                'Content-Type':'application/json',
                'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                step:'regulatory',
                data: payload
            })
        });
    };
}

// Initialize when step opened
document.addEventListener('stepChanged', e => {
    if(e.detail.step === 4){
        initRegulatoryStep();
    }
});

});
</script>