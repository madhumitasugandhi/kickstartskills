<div class="configuration-wrapper">

    <div class="ui-section-title mb-3">
        GLOBAL CONFIGURATION SETTINGS
    </div>

    <div class="row g-4">

        <!-- LEFT -->
        <div class="col-lg-4">

            <div class="ui-section mb-3">
                <div class="fw-semibold mb-2">Institution Code Configuration</div>
                <small class="">
                    Configure how student institution codes are generated
                </small>

                <div class="ui-preview-box mt-3">
                    <div class="small mb-1">Current Code Format:</div>
                    <div class="fw-medium">
                        INS + [Course Code] + [Year] + [Sequential Number]
                    </div>
                </div>

                <button class="btn btn-success btn-sm w-100 mt-3">
                    Configure Code Format
                </button>
            </div>

            <!-- Duration -->
            <div class="ui-section">
                <div class="fw-semibold mb-2">Common Duration Templates</div>

                <div class="ui-chips">
                    <span class="ui-chip">1 Year</span>
                    <span class="ui-chip">2 Years</span>
                    <span class="ui-chip">3 Years</span>
                    <span class="ui-chip">4 Years</span>
                    <span class="ui-chip">6 Months</span>
                    <span class="ui-chip">18 Months</span>
                </div>
            </div>

        </div>

        <!-- RIGHT -->
        <div class="col-lg-8">

            <div class="ui-section h-100">

                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <div class="fw-semibold">Background Requirements Templates</div>
                        <small class="">
                            Predefined requirement templates for quick course setup
                        </small>
                    </div>

                    <button class="btn btn-outline-success btn-sm" id="addRequirementBtn">
                        <i class="bi bi-plus-lg"></i>
                    </button>
                </div>

                <div id="requirementList">
                    @foreach($requirements as $req)
                    <div class="ui-list-item template-item" data-id="{{ $req->requirement_id }}">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-tag"></i>
                            <span>{{ $req->requirement_name }}</span>
                        </div>

                        <button class="icon-btn danger deleteRequirement">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                    @endforeach
                </div>

            </div>

        </div>

    </div>
</div>