<div class="setup-step" id="documentStep">

    <!-- ================= HEADER ================= -->
    <div class="mb-4">
        <h6 class="section-title-custom mb-1">Document Verification</h6>
        <p class="small">
            Upload required documents for institutional verification
        </p>
    </div>

    <div class="config-card p-4">

        <!-- ================= DOCUMENT ITEM ================= -->
        <div class="document-card mb-3">
            <div class="d-flex justify-content-between align-items-start">
                <div class="d-flex gap-3">
                    <div class="doc-icon danger">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <div>
                        <div class="fw-semibold mb-1">Institution Registration Certificate</div>
                        <small class="">
                            Official registration document from the registrar
                        </small>
                    </div>
                </div>
                <span class="doc-badge danger">Required</span>
            </div>

            <form action="{{ url('/institution/setup') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="document_type" value="registration_certificate">

                <input type="file" name="document" id="doc1" hidden onchange="uploadDoc(this, 'registration_certificate')">

                <label for="doc1" class="btn btn-outline-secondary btn-sm mt-3">
                    <i class="bi bi-upload me-1"></i> Upload Document
                </label>
            </form>
        </div>

        <!-- ================= DOCUMENT ITEM ================= -->
        <div class="document-card mb-3">
            <div class="d-flex justify-content-between align-items-start">
                <div class="d-flex gap-3">
                    <div class="doc-icon danger">
                        <i class="bi bi-award"></i>
                    </div>
                    <div>
                        <div class="fw-semibold mb-1">AISHE Certificate</div>
                        <small class="">
                            All India Survey on Higher Education certificate
                        </small>
                    </div>
                </div>
                <span class="doc-badge danger">Required</span>
            </div>

            <form action="{{ url('/institution/setup') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="document_type" value="aicte_certificate">

                <input type="file" name="document" id="doc2" hidden onchange="uploadDoc(this, 'aicte_certificate')">

                <label for="doc2" class="btn btn-outline-secondary btn-sm mt-3">
                    <i class="bi bi-upload me-1"></i> Upload Document
                </label>
            </form>
        </div>

        <!-- ================= DOCUMENT ITEM ================= -->
        <div class="document-card mb-3">
            <div class="d-flex justify-content-between align-items-start">
                <div class="d-flex gap-3">
                    <div class="doc-icon info">
                        <i class="bi bi-gear"></i>
                    </div>
                    <div>
                        <div class="fw-semibold mb-1">AICTE Approval Letter</div>
                        <small class="">
                            Required for technical/engineering institutions
                        </small>
                    </div>
                </div>
            </div>

            <form action="{{ url('/institution/setup') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="document_type" value="aicte_letter">

                <input type="file" name="document" id="doc3" hidden onchange="uploadDoc(this, 'aicte_letter')">

                <label for="doc3" class="btn btn-outline-secondary btn-sm mt-3">
                    <i class="bi bi-upload me-1"></i> Upload Document
                </label>
            </form>
        </div>

        <!-- ================= DOCUMENT ITEM ================= -->
        <div class="document-card mb-4">
            <div class="d-flex gap-3">
                <div class="doc-icon info">
                    <i class="bi bi-building"></i>
                </div>
                <div>
                    <div class="fw-semibold mb-1">Infrastructure Documents</div>
                    <small class="">
                        Building plans, facility details, etc.
                    </small>
                </div>
            </div>

            <form action="{{ url('/institution/setup') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="document_type" value="infrastructure_docs">

                <input type="file" name="document" id="doc4" hidden onchange="uploadDoc(this, 'infrastructure_docs')">

                <label for="doc4" class="btn btn-outline-secondary btn-sm mt-3">
                    <i class="bi bi-upload me-1"></i> Upload Document
                </label>
            </form>
        </div>

        <!-- ================= VERIFICATION PROCESS ================= -->
        <div class="academic-warning academic-warning--info mt-4">

            <div class="d-flex align-items-center gap-2 mb-3">
                <div class="doc-icon info">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div class="fw-semibold">Verification Process</div>
            </div>

            <p class="small opacity-75 mb-2">
                After submitting your documents, our verification team will:
            </p>

            <ul class="mb-0 ps-3">
                <li>Verify regulatory codes with AICTE / UGC / AISHE</li>
                <li>Review uploaded documents for authenticity</li>
                <li>Cross-check institution details with official databases</li>
                <li>Conduct final approval review (2–3 business days)</li>
                <li>Send verification completion email with institution code</li>
            </ul>

        </div>
    </div>

    <button class="btn btn-success w-100 mt-4" onclick="completeSetup()">
    Complete Setup
</button>
</div>

<script>
async function uploadDoc(input, type){

    const file = input.files[0];
    if(!file) return;

    const formData = new FormData();
    formData.append('document', file);
    formData.append('document_type', type);
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

    try{

        const res = await fetch('/institution/setup', {
            method: 'POST',
            body: formData
        });

        const data = await res.text();

        // SUCCESS UI
        input.nextElementSibling.innerHTML = `
            <i class="bi bi-check-circle text-success me-1"></i> Uploaded
        `;

    }catch(err){
        alert('Upload failed');
    }
}
async function completeSetup(){

if(!confirm('Are you sure you want to submit setup?')) return;

const res = await fetch('/institution/setup/complete', {
    method:'POST',
    headers:{
        'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content
    }
});

const data = await res.json();

if(data.status === 'success'){
    window.location.href = '/institution/dashboard';
}else{
    alert('Something went wrong');
}
}
</script>