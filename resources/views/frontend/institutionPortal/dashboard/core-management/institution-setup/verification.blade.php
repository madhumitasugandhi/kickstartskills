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
                        <small>Official registration document from the registrar</small>
                    </div>
                </div>
                <span class="doc-badge danger">Required</span>
            </div>

            <form enctype="multipart/form-data">
                <input type="file"
                    accept=".pdf,.jpg,.jpeg,.png"
                    id="doc1"
                    hidden
                    onchange="uploadDoc(this, 'registration_certificate')">

                <label for="doc1" class="btn btn-outline-secondary btn-sm mt-3">
                    @if(isset($documents['registration_certificate']))
                    <i class="bi bi-check-circle text-success me-1"></i> Uploaded (Replace)
                    @else
                    <i class="bi bi-upload me-1"></i> Upload Document
                    @endif
                </label>
            </form>
        </div>

        <!-- ================= DOCUMENT ITEM ================= -->
        <div class="document-card mb-3">
            <div class="d-flex justify-content-between align-items-start">
                <div class="d-flex gap-3">
                    <div class="doc-icon danger">
                    <i class="bi bi-file-earmark-text"></i>
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

            <form enctype="multipart/form-data">

                <input type="file"
                    accept=".pdf,.jpg,.jpeg,.png"
                    id="doc2"
                    hidden
                    onchange="uploadDoc(this, 'aishe_certificate')">

                <label for="doc2" class="btn btn-outline-secondary btn-sm mt-3">
                    @if(isset($documents['aishe_certificate']))
                    <i class="bi bi-check-circle text-success me-1"></i> Uploaded (Replace)
                    @else
                    <i class="bi bi-upload me-1"></i> Upload Document
                    @endif
                </label>
            </form>
        </div>

        <!-- ================= DOCUMENT ITEM ================= -->
        <div class="document-card mb-3">
            <div class="d-flex justify-content-between align-items-start">
                <div class="d-flex gap-3">
                    <div class="doc-icon info">
                    <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <div>
                        <div class="fw-semibold mb-1">AICTE Approval Letter</div>
                        <small class="">
                            Required for technical/engineering institutions
                        </small>
                    </div>
                </div>
            </div>

            <form enctype="multipart/form-data">
                <input type="file"
                    accept=".pdf,.jpg,.jpeg,.png"
                    id="doc3"
                    hidden
                    onchange="uploadDoc(this, 'aicte_approval_letter')">

                <label for="doc3" class="btn btn-outline-secondary btn-sm mt-3">
                    @if(isset($documents['aicte_approval_letter']))
                    <i class="bi bi-check-circle text-success me-1"></i> Uploaded (Replace)
                    @else
                    <i class="bi bi-upload me-1"></i> Upload Document
                    @endif
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

            <form enctype="multipart/form-data">
                <input type="file"
                    accept=".pdf,.jpg,.jpeg,.png"
                    id="doc4"
                    hidden
                    onchange="uploadDoc(this, 'infrastructure_documents')"> 

                <label for="doc4" class="btn btn-outline-secondary btn-sm mt-3">
                    @if(isset($documents['infrastructure_documents']))
                    <i class="bi bi-check-circle text-success me-1"></i> Uploaded (Replace)
                    @else
                    <i class="bi bi-upload me-1"></i> Upload Document
                    @endif
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
</div>

<script>
    async function uploadDoc(input, type) {

        const file = input.files[0];
        if (!file) return;

        // ================= FILE VALIDATION =================
        const allowedTypes = [
            'application/pdf',
            'image/jpeg',
            'image/jpg',
            'image/png'
        ];

        if (!allowedTypes.includes(file.type)) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid File',
                text: 'Only PDF, JPG, JPEG, PNG files are allowed'
            });
            input.value = '';
            return;
        }

        // max 2MB
        if (file.size > 2 * 1024 * 1024) {
            Swal.fire({
                icon: 'error',
                title: 'File Too Large',
                text: 'File must be less than 2MB'
            });
            input.value = '';
            return;
        }

        // ================= UPLOAD =================
        const formData = new FormData();
        formData.append('document', file);
        formData.append('document_type', type);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

        try {
            const res = await fetch('/institution/core-management/setup', {
                method: 'POST',
                body: formData
            });

            Swal.fire({
                icon: 'success',
                title: 'Uploaded',
                text: 'Document uploaded successfully'
            });

            input.nextElementSibling.innerHTML =
                `<i class="bi bi-check-circle text-success me-1"></i> Uploaded`;

        } catch (err) {
            Swal.fire({
                icon: 'error',
                title: 'Upload Failed'
            });
        }
    }
</script>