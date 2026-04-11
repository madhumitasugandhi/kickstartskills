<div id="documentStep">

    <!-- HEADER -->
    <div class="mb-3">
        <div class="ui-section-title">DOCUMENT VERIFICATION</div>
        <small class="">
            Upload required documents for institutional verification
        </small>
    </div>

    <div class="ui-section">

        <!-- DOCUMENT -->
        <div class="ui-list-item mb-3">
            <div>
                <div class="fw-semibold">Institution Registration Certificate</div>
                <small class="">
                    Official registration document from the registrar
                </small>
                <div class="mt-2">
                    <input type="file"
                        accept=".pdf,.jpg,.jpeg,.png"
                        id="doc1"
                        hidden
                        onchange="uploadDoc(this, 'registration_certificate')">

                    <label for="doc1" class="btn btn-outline-secondary btn-sm">
                        @if(isset($documents['registration_certificate']))
                        <i class="bi bi-check-circle text-success me-1"></i> Uploaded (Replace)
                        @else
                        <i class="bi bi-upload me-1"></i> Upload Document
                        @endif
                    </label>
                </div>
            </div>

            <span class="ui-badge">Required</span>
        </div>

        <!-- DOCUMENT -->
        <div class="ui-list-item mb-3">
            <div>
                <div class="fw-semibold">AISHE Certificate</div>
                <small class="">
                    All India Survey on Higher Education certificate
                </small>
                <div class="mt-2">
                    <input type="file"
                        accept=".pdf,.jpg,.jpeg,.png"
                        id="doc2"
                        hidden
                        onchange="uploadDoc(this, 'aishe_certificate')">

                    <label for="doc2" class="btn btn-outline-secondary btn-sm">
                        @if(isset($documents['aishe_certificate']))
                        <i class="bi bi-check-circle text-success me-1"></i> Uploaded (Replace)
                        @else
                        <i class="bi bi-upload me-1"></i> Upload Document
                        @endif
                    </label>
                </div>
            </div>

            <span class="ui-badge">Required</span>
        </div>

        <!-- DOCUMENT -->
        <div class="ui-list-item mb-3">
            <div>
                <div class="fw-semibold">AICTE Approval Letter</div>
                <small class="">
                    Required for technical/engineering institutions
                </small>
                <div class="mt-2">
                    <input type="file"
                        accept=".pdf,.jpg,.jpeg,.png"
                        id="doc3"
                        hidden
                        onchange="uploadDoc(this, 'aicte_approval_letter')">

                    <label for="doc3" class="btn btn-outline-secondary btn-sm">
                        @if(isset($documents['aicte_approval_letter']))
                        <i class="bi bi-check-circle text-success me-1"></i> Uploaded (Replace)
                        @else
                        <i class="bi bi-upload me-1"></i> Upload Document
                        @endif
                    </label>
                </div>
            </div>
        </div>

        <!-- DOCUMENT -->
        <div class="ui-list-item mb-3">
            <div>
                <div class="fw-semibold">Infrastructure Documents</div>
                <small class="">
                    Building plans, facility details, etc.
                </small>
                <div class="mt-2">
                    <input type="file"
                        accept=".pdf,.jpg,.jpeg,.png"
                        id="doc4"
                        hidden
                        onchange="uploadDoc(this, 'infrastructure_documents')">

                    <label for="doc4" class="btn btn-outline-secondary btn-sm">
                        @if(isset($documents['infrastructure_documents']))
                        <i class="bi bi-check-circle text-success me-1"></i> Uploaded (Replace)
                        @else
                        <i class="bi bi-upload me-1"></i> Upload Document
                        @endif
                    </label>
                </div>
            </div>
        </div>

        <div class="ui-divider"></div>

        <!-- VERIFICATION PROCESS -->
        <div class="ui-alert">
            <i class="bi bi-clock-history"></i>
            <div>
                <strong>Verification Process</strong>
                <ul class="mb-0 mt-2">
                    <li>Verify regulatory codes with AICTE / UGC / AISHE</li>
                    <li>Review uploaded documents for authenticity</li>
                    <li>Cross-check institution details with official databases</li>
                    <li>Final approval review (2–3 business days)</li>
                    <li>Verification completion email with institution code</li>
                </ul>
            </div>
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