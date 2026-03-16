<div class="setup-step" id="regulatoryStep">

    <!-- ================= HEADER ================= -->
    <div class="mb-4">
        <h6 class="section-title-custom mb-1">Regulatory Information</h6>
        <p class="small">
            Provide regulatory compliance and accreditation details
        </p>
    </div>

    <div class="config-card p-4">

        <!-- AISHE Code -->
        <div class="mb-4">
            <label class="form-label-custom">AISHE Code</label>
            <div class="input-group-custom">
                <i class="bi bi-shield"></i>
                <input type="text"
                       class="form-control ps-5"
                       placeholder="AISHE Code">
            </div>
            <small class="small">
                U for Universities, C for Colleges, S for Standalone
            </small>
        </div>

        <!-- AICTE ID -->
        <div class="mb-4">
            <label class="form-label-custom">AICTE Permanent ID</label>
            <div class="input-group-custom">
                <i class="bi bi-gear"></i>
                <input type="text"
                       class="form-control ps-5"
                       placeholder="AICTE ID">
            </div>
            <small class="small">
                Required for technical/engineering institutions
            </small>
        </div>

        <!-- UGC Number -->
        <div class="mb-4">
            <label class="form-label-custom">UGC Recognition Number</label>
            <div class="input-group-custom">
                <i class="bi bi-award"></i>
                <input type="text"
                       class="form-control ps-5"
                       placeholder="UGC Recognition Number">
            </div>
        </div>

        <!-- University Affiliation -->
        <div class="mb-4">
            <label class="form-label-custom">University Affiliation</label>
            <div class="input-group-custom">
                <i class="bi bi-link-45deg"></i>
                <input type="text"
                       class="form-control ps-5"
                       placeholder="Affiliated University Name">
            </div>
        </div>

        <!-- ================= ACCREDITATIONS ================= -->
        <div class="mb-4">
            <label class="form-label-custom">Accreditations</label>
            <small class="d-block mb-2">
                Select all applicable accreditations
            </small>

            <div class="chip-container" id="accreditationContainer">
                @php
                    $accreditations = [
                        'NAAC (A+/A/B+/B/C)',
                        'NBA (National Board of Accreditation)',
                        'NIRF Ranking',
                        'ISO 9001:2015',
                        'AICTE Approved',
                        'UGC Recognized',
                        'QS World Ranking',
                        'Times Higher Education',
                        'ABET Accredited'
                    ];
                @endphp

                @foreach($accreditations as $acc)
                    <div class="chip-item accreditation-chip">
                        {{ $acc }}
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Selected Accreditations -->
        <div id="selectedAccreditationsBox" class="mt-3 d-none">
            <div class="added-box">
                <div class="fw-semibold mb-1">
                    Selected Accreditations (<span id="selectedCount">0</span>)
                </div>
                <div id="selectedAccreditationsText" class="small"></div>
            </div>
        </div>

        <!-- ================= INFO NOTES ================= -->
        <div class="academic-warning academic-warning--info mt-4">
            <i class="bi bi-info-circle-fill"></i>
            <div>
                <strong>Important Notes</strong>
                <ul class="mb-0 ps-3 mt-1">
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
    const chips = document.querySelectorAll('.accreditation-chip');
    const box = document.getElementById('selectedAccreditationsBox');
    const text = document.getElementById('selectedAccreditationsText');
    const count = document.getElementById('selectedCount');

    function updateSelected() {
        const selected = [...chips]
            .filter(c => c.classList.contains('active'))
            .map(c => c.innerText);

        count.innerText = selected.length;
        text.innerText = selected.join(', ');
        box.classList.toggle('d-none', selected.length === 0);
    }

    chips.forEach(chip => {
        chip.addEventListener('click', () => {
            chip.classList.toggle('active');
            updateSelected();
        });
    });
});
</script>
