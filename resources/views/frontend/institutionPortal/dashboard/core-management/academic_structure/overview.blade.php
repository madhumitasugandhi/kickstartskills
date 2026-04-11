<div class="row g-4">

    <!-- KPI -->
    <div class="col-md-3">
        <div class="ui-stats-card">
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
        <div class="ui-stats-card">
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
        <div class="ui-stats-card">
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
        <div class="ui-stats-card">
            <div class="stat-icon success">
                <i class="bi bi-mortarboard"></i>
            </div>
            <div>
                <h5 class="mb-0 text-teal">94.2%</h5>
                <small>Graduation Rate</small>
            </div>
        </div>
    </div>

    <!-- Department Distribution -->
    <div class="col-lg-8">
        <div class="ui-section">
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
            <div class="ui-list-item">
                <div>
                    <strong>{{ $dept['name'] }}</strong>
                    <div class="small">Students {{ $dept['students'] }}</div>
                </div>

                <div class="ui-meta">
                    <span><i class="bi bi-people"></i>{{ $dept['faculty'] }}</span>
                    <span><i class="bi bi-journal"></i>{{ $dept['programs'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="col-lg-4">
        <div class="ui-section">
            <h6 class="mb-3">Quick Stats</h6>

            <div class="ui-list-item">
                <span>Faculty–Student Ratio</span>
                <strong>1:18</strong>
            </div>

            <div class="ui-list-item">
                <span>Active Semesters</span>
                <strong>6</strong>
            </div>

            <div class="ui-list-item">
                <span>Accreditation</span>
                <strong>NAAC A+</strong>
            </div>

            <div class="ui-list-item">
                <span>Total Students</span>
                <strong>2847</strong>
            </div>
        </div>
    </div>

</div>