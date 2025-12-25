<div class="row g-4">

    <!-- ================= KPI STATS ================= -->
    <div class="col-md-3">
        <div class="glass-card d-flex align-items-center gap-3">
            <div class="stat-icon info">
                <i class="bi bi-diagram-3"></i>
            </div>
            <div>
                <h5 class="mb-0 text-teal">8</h5>
                <small>Total Departments</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="glass-card d-flex align-items-center gap-3">
            <div class="stat-icon success">
                <i class="bi bi-journal-bookmark"></i>
            </div>
            <div>
                <h5 class="mb-0 text-teal">24</h5>
                <small>Active Programs</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="glass-card d-flex align-items-center gap-3">
            <div class="stat-icon info">
                <i class="bi bi-people"></i>
            </div>
            <div>
                <h5 class="mb-0 text-info">156</h5>
                <small>Faculty Members</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="glass-card d-flex align-items-center gap-3">
            <div class="stat-icon success">
                <i class="bi bi-mortarboard"></i>
            </div>
            <div>
                <h5 class="mb-0 text-teal">94.2%</h5>
                <small>Graduation Rate</small>
            </div>
        </div>
    </div>

    <!-- ================= DEPARTMENT DISTRIBUTION ================= -->
    <div class="col-lg-8">
        <div class="glass-card">
            <h6 class="mb-3">Department Distribution</h6>

            @php
                $departments = [
                    ['name'=>'Computer Science','students'=>680,'faculty'=>28,'programs'=>4,'color'=>'info'],
                    ['name'=>'Electronics & Communication','students'=>520,'faculty'=>22,'programs'=>3,'color'=>'success'],
                    ['name'=>'Mechanical Engineering','students'=>485,'faculty'=>20,'programs'=>3,'color'=>'warning'],
                    ['name'=>'Civil Engineering','students'=>380,'faculty'=>18,'programs'=>2,'color'=>'danger'],
                    ['name'=>'Business Administration','students'=>420,'faculty'=>24,'programs'=>6,'color'=>'success'],
                ];
            @endphp

            @foreach($departments as $dept)
                <div class="configured-item mb-2 p-3 d-flex justify-content-between align-items-center">
                    <div>
                        <strong class="d-block">{{ $dept['name'] }}</strong>
                        <small class="text-muted">
                            Students {{ $dept['students'] }}
                        </small>
                    </div>

                    <div class="meta-row">
                        <span><i class="bi bi-people"></i>{{ $dept['faculty'] }}</span>
                        <span><i class="bi bi-journal"></i>{{ $dept['programs'] }}</span>
                    </div>
                </div>
            @endforeach

            <div class="text-center mt-3">
                <a href="{{ route('institution.academic-structure', ['tab'=>'departments']) }}"
                   class="btn btn-outline-primary btn-sm">
                    View All Departments
                </a>
            </div>
        </div>
    </div>

    <!-- ================= QUICK STATS ================= -->
    <div class="col-lg-4">
        <div class="glass-card">
            <h6 class="mb-3">Quick Stats</h6>

            <div class="configured-item mb-2 p-3 d-flex justify-content-between">
                <span>Faculty–Student Ratio</span>
                <strong>1:18</strong>
            </div>

            <div class="configured-item mb-2 p-3 d-flex justify-content-between">
                <span>Active Semesters</span>
                <strong>6</strong>
            </div>

            <div class="configured-item mb-2 p-3 d-flex justify-content-between">
                <span>Accreditation</span>
                <strong>NAAC A+</strong>
            </div>

            <div class="configured-item p-3 d-flex justify-content-between">
                <span>Total Students</span>
                <strong>2847</strong>
            </div>
        </div>
    </div>

</div>
