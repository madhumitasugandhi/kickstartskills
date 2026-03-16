<h6 class="fw-semibold mb-3">Available Drives (5)</h6>

<div class="drive-list">

    @php
        $drives = [
            [
                'company' => 'ConsultPro Services',
                'role' => 'Management Trainee',
                'location' => 'Chennai, India • Consulting',
                'package' => '₹9–14 LPA',
                'description' => 'Fast-track management program for high-potential graduates to become future leaders.',
                'skills' => ['Leadership', 'Communication', 'Project Management', 'Problem Solving'],
                'apply_by' => '28/11/2024',
                'drive_date' => '05/12/2024',
                'eligible' => 12,
                'applications' => 8,
                'cgpa' => '8.0',
                'status' => 'Approved'
            ],
        ];
    @endphp

    @foreach($drives as $drive)
    <div class="drive-card">

        <!-- LEFT -->
        <div class="drive-left">

            <div class="drive-header">
                <div class="company-avatar">
                    {{ strtoupper(substr($drive['company'],0,2)) }}
                </div>

                <div>
                    <div class="fw-semibold">{{ $drive['company'] }}</div>
                    <div class="text-teal small fw-medium">{{ $drive['role'] }}</div>
                    <div class="small">{{ $drive['location'] }}</div>
                </div>
            </div>

            <span class="package-badge">{{ $drive['package'] }}</span>

            <p class="small mt-2 mb-2">
                {{ $drive['description'] }}
            </p>

            <div class="skill-chips">
                @foreach($drive['skills'] as $skill)
                    <span class="skill-chip">{{ $skill }}</span>
                @endforeach
            </div>

            <div class="drive-dates">
                <span>
                    <i class="bi bi-calendar-event"></i>
                    Apply by: {{ $drive['apply_by'] }}
                </span>
                <span>
                    <i class="bi bi-calendar-check"></i>
                    Drive: {{ $drive['drive_date'] }}
                </span>
            </div>

            <div class="drive-actions">
                <button class="btn btn-success btn-sm">
                    <i class="bi bi-stars me-1"></i> Recommend
                </button>

                <button class="btn btn-outline-success btn-sm">
                    <i class="bi bi-people me-1"></i> Students
                </button>
            </div>

        </div>

        <!-- RIGHT -->
        <div class="drive-right">

            <div class="d-flex justify-content-end gap-2 mb-2">
                <span class="status-pill active">{{ $drive['status'] }}</span>
                <button class="icon-btn">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
            </div>

            <div class="drive-metrics">
                <div>
                    <i class="bi bi-people"></i>
                    {{ $drive['eligible'] }} eligible
                </div>
                <div>
                    {{ $drive['applications'] }} applications
                </div>
                <div>
                    Min CGPA: {{ $drive['cgpa'] }}
                </div>
            </div>

            <a href="#" class="view-link">
                <i class="bi bi-eye"></i> View Details
            </a>

        </div>

    </div>
    @endforeach

</div>
