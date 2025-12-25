<div class="configuration-wrapper">

    <h6 class="fw-semibold mb-4">
        Global Configuration Settings
    </h6>

    <div class="row g-4">

        <!-- LEFT COLUMN -->
        <div class="col-lg-4">

            <!-- Institution Code -->
            <div class="config-card mb-4">
                <h6 class="mb-1">Institution Code Configuration</h6>
                <p class="small mb-3">
                    Configure how student institution codes are generated
                </p>

                <div class="code-preview-box mb-3">
                    <div class="small mb-1">Current Code Format:</div>
                    <div class="fw-medium">
                        INS + [Course Code] + [Year] + [Sequential Number]
                    </div>
                    <div class="small mt-1">
                        Examples: INS-BT-2024-001, INS-MT-2024-045
                    </div>
                </div>

                <button class="btn btn-success btn-sm w-100">
                    <i class="bi bi-gear me-1"></i>
                    Configure Code Format
                </button>
            </div>

            <!-- Common Duration -->
            <div class="config-card">
                <h6 class="mb-2">Common Duration Templates</h6>

                <div class="duration-chips">
                    <span class="duration-chip">1 Year</span>
                    <span class="duration-chip">2 Years</span>
                    <span class="duration-chip">3 Years</span>
                    <span class="duration-chip">4 Years</span>
                    <span class="duration-chip">6 Months</span>
                    <span class="duration-chip">18 Months</span>
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN -->
        <div class="col-lg-8">

            <div class="config-card h-100">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h6 class="mb-1">Background Requirements Templates</h6>
                        <p class="small mb-0">
                            Predefined requirement templates for quick course setup
                        </p>
                    </div>

                    <button class="btn btn-outline-success btn-sm">
                        <i class="bi bi-plus-lg"></i>
                    </button>
                </div>

                <div class="template-list">
                    @php
                        $templates = [
                            '10th Grade completion',
                            '12th Grade with Science',
                            '12th Grade with Commerce',
                            '12th Grade with Arts',
                            'Bachelor’s degree in any field'
                        ];
                    @endphp

                    @foreach($templates as $template)
                        <div class="template-item">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-tag"></i>
                                <span>{{ $template }}</span>
                            </div>

                            <button class="icon-btn danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    @endforeach
                </div>

            </div>

        </div>

    </div>
</div>
