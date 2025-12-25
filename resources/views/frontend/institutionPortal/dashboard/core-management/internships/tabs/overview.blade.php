<div class="row g-4">

    {{-- ================= KPI CARDS ================= --}}
    <div class="col-md-3">
        <div class="glass-card d-flex align-items-center gap-3">
            <div class="stat-icon success">
                <i class="bi bi-people"></i>
            </div>
            <div>
                <h5 class="mb-0 text-teal">847</h5>
                <small>Total Interns</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="glass-card d-flex align-items-center gap-3">
            <div class="stat-icon info">
                <i class="bi bi-diagram-3"></i>
            </div>
            <div>
                <h5 class="mb-0 text-info">623</h5>
                <small>Active Programs</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="glass-card d-flex align-items-center gap-3">
            <div class="stat-icon success">
                <i class="bi bi-building"></i>
            </div>
            <div>
                <h5 class="mb-0 text-teal">89</h5>
                <small>Partner Companies</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="glass-card d-flex align-items-center gap-3">
            <div class="stat-icon success">
                <i class="bi bi-graph-up"></i>
            </div>
            <div>
                <h5 class="mb-0 text-teal">87.2%</h5>
                <small>Placement Rate</small>
            </div>
        </div>
    </div>

    {{-- ================= PHASE DISTRIBUTION ================= --}}
    <div class="col-lg-8">
        <div class="analytics-card">
            <h6 class="fw-semibold mb-3">120-Day Phase Distribution</h6>

            @php
                $phases = [
                    ['label'=>'Foundation Phase (Days 1-15)', 'count'=>156, 'color'=>'#f59e0b'],
                    ['label'=>'Advanced Learning Phase (Days 16-60)', 'count'=>189, 'color'=>'#38bdf8'],
                    ['label'=>'Mini-Project Phase (Days 61-90)', 'count'=>134, 'color'=>'#10b981'],
                    ['label'=>'Client Project Phase (Days 91-120)', 'count'=>144, 'color'=>'#22c55e'],
                ];
                $total = collect($phases)->sum('count');
            @endphp

            @foreach($phases as $phase)
                @php
                    $width = ($phase['count'] / $total) * 100;
                @endphp

                <div class="enrollment-row">
                    <div class="d-flex justify-content-between small mb-1">
                        <span>{{ $phase['label'] }}</span>
                        <span class="">
                            {{ $phase['count'] }} students
                        </span>
                    </div>

                    <div class="progress-track">
                        <div class="progress-fill"
                             style="width: {{ $width }}%;
                                    background: {{ $phase['color'] }};">
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="added-box mt-4">

<!-- Header -->
<div class="d-flex align-items-center gap-2 mb-3">
    <div class="stat-icon info">
        <i class="bi bi-calendar-range"></i>
    </div>
    <h6 class="mb-0 fw-semibold">120-Day Internship Structure</h6>
</div>

<!-- Vertical Phases -->
<div class="d-flex flex-column gap-3 small">

    <div class="example-item">
        <div>
            <strong>Foundation Phase</strong>
            <div class="">
                Days 1–15 · Basic training & orientation
            </div>
        </div>
        <span class="badge-preview">15 Days</span>
    </div>

    <div class="example-item">
        <div>
            <strong>Advanced Learning Phase</strong>
            <div class="">
                Days 16–60 · Technical skill development
            </div>
        </div>
        <span class="badge-preview">45 Days</span>
    </div>

    <div class="example-item">
        <div>
            <strong>Mini-Project Phase</strong>
            <div class="">
                Days 61–90 · Independent project work
            </div>
        </div>
        <span class="badge-preview">30 Days</span>
    </div>

    <div class="example-item">
        <div>
            <strong>Client Project Phase</strong>
            <div class="">
                Days 91–120 · Real-world client assignments
            </div>
        </div>
        <span class="badge-preview">30 Days</span>
    </div>

</div>

</div>

        </div>
    </div>

    {{-- ================= RECENT ACTIVITIES ================= --}}
    <div class="col-lg-4">
        <div class="analytics-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-semibold mb-0">Recent Activities</h6>
                <a href="#" class="small text-info">View All</a>
            </div>

            <div class="activity-list">

                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="bi bi-plus-circle"></i>
                    </div>
                    <div class="activity-content">
                        <div class="small fw-medium">New internship drive created</div>
                        <div class="small ">2 hours ago</div>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="activity-content">
                        <div class="small fw-medium">Student completed Phase 2</div>
                        <div class="small ">4 hours ago</div>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="bi bi-chat-left-text"></i>
                    </div>
                    <div class="activity-content">
                        <div class="small fw-medium">Mentor feedback submitted</div>
                        <div class="small ">1 day ago</div>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="bi bi-building"></i>
                    </div>
                    <div class="activity-content">
                        <div class="small fw-medium">New company partnership</div>
                        <div class="small ">2 days ago</div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ================= MONTHLY TRENDS PLACEHOLDER ================= --}}
    <div class="col-12">
        <div class="analytics-card text-center py-5">
            <i class="bi bi-bar-chart fs-2 "></i>
            <p class="small  mt-2 mb-0">
                Monthly Trends Chart<br>
                <span class="">(Chart.js integration)</span>
            </p>
        </div>
    </div>

</div>
