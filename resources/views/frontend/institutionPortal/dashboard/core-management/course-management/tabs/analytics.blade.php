<div class="analytics-wrapper">

    <h6 class="fw-semibold mb-4">Course Management Analytics</h6>

    <!-- ================= KPI ROW ================= -->
    <div class="row g-3 mb-4">
        <div class="col-lg-4">
            <div class="glass-card d-flex align-items-center gap-3">
                <div class="stat-icon success">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div>
                    <h5 class="mb-0 text-teal">4</h5>
                    <small class="">Active Types</small>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="glass-card d-flex align-items-center gap-3">
                <div class="stat-icon warning">
                    <i class="bi bi-pause-circle"></i>
                </div>
                <div>
                    <h5 class="mb-0 text-warning">1</h5>
                    <small class="">Inactive Types</small>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="glass-card d-flex align-items-center gap-3">
                <div class="stat-icon info">
                    <i class="bi bi-people"></i>
                </div>
                <div>
                    <h5 class="mb-0 text-info">1865</h5>
                    <small class="">Total Students</small>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= ENROLLMENT ================= -->
    <div class="analytics-card mb-4">
        <h6 class="fw-semibold mb-3">
            Student Enrollment by Course Type
        </h6>

        @php
            $courses = [
                ['name' => 'B.Tech', 'count' => 1250],
                ['name' => 'M.Tech', 'count' => 340],
                ['name' => 'MBA', 'count' => 180],
                ['name' => 'MCA', 'count' => 95],
                ['name' => 'Diploma', 'count' => 0],
            ];
            $max = collect($courses)->max('count') ?: 1;
        @endphp

        @foreach($courses as $course)
            @php $width = ($course['count'] / $max) * 100; @endphp

            <div class="enrollment-row">
                <div class="d-flex justify-content-between mb-1">
                    <span class="fw-medium">{{ $course['name'] }}</span>
                    <span class="small ">
                        {{ $course['count'] }} students
                    </span>
                </div>

                <div class="progress-track">
                    <div class="progress-fill" style="width: {{ $width }}%"></div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- ================= RECENT ACTIVITIES ================= -->
    <div class="analytics-card">
        <h6 class="fw-semibold mb-3">
            Recent Course Configuration Activities
        </h6>

        <div class="activity-list">

            <div class="activity-item">
                <div class="activity-icon">
                    <i class="bi bi-journal-bookmark"></i>
                </div>
                <div class="activity-content">
                    <div class="fw-medium small">
                        B.Tech course type created
                    </div>
                    <div class="small ">
                        Created on 15/1/2024
                    </div>
                </div>
                <i class="bi bi-check-circle-fill text-success"></i>
            </div>

            <div class="activity-item">
                <div class="activity-icon">
                    <i class="bi bi-journal-bookmark"></i>
                </div>
                <div class="activity-content">
                    <div class="fw-medium small">
                        M.Tech course type created
                    </div>
                    <div class="small ">
                        Created on 15/1/2024
                    </div>
                </div>
                <i class="bi bi-check-circle-fill text-success"></i>
            </div>

            <div class="activity-item">
                <div class="activity-icon">
                    <i class="bi bi-journal-bookmark"></i>
                </div>
                <div class="activity-content">
                    <div class="fw-medium small">
                        MBA course type created
                    </div>
                    <div class="small ">
                        Created on 1/2/2024
                    </div>
                </div>
                <i class="bi bi-check-circle-fill text-success"></i>
            </div>

        </div>
    </div>

</div>
