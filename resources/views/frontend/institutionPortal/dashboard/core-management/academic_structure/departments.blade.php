<div class="glass-card">

    <!-- ================= HEADER ACTIONS ================= -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="input-group-custom w-50">
            <i class="bi bi-search"></i>
            <input type="text"
                   class="form-control ps-5"
                   placeholder="Search departments...">
        </div>

        <button class="btn btn-teal btn-sm">
            <i class="bi bi-plus-lg me-1"></i>
            Add Department
        </button>
    </div>

    <!-- ================= DEPARTMENT LIST ================= -->
    <div class="d-flex flex-column gap-3">

        @php
            $departments = [
                [
                    'name' => 'Computer Science & Engineering',
                    'code' => 'CSE',
                    'estd' => 2010,
                    'hod' => 'Dr. Rajesh Kumar',
                    'students' => 680,
                    'faculty' => 28,
                    'programs' => 4,
                    'accreditation' => 'NBA Tier 1',
                    'program_list' => ['B.Tech CSE', 'M.Tech CSE', 'PhD CSE', 'MCA'],
                    'icon' => 'info'
                ],
                [
                    'name' => 'Electronics & Communication',
                    'code' => 'ECE',
                    'estd' => 2012,
                    'hod' => 'Dr. Priya Sharma',
                    'students' => 520,
                    'faculty' => 22,
                    'programs' => 3,
                    'accreditation' => 'NBA Accredited',
                    'program_list' => ['B.Tech ECE', 'M.Tech ECE', 'PhD ECE'],
                    'icon' => 'success'
                ],
                [
                    'name' => 'Business Administration',
                    'code' => 'MBA',
                    'estd' => 2015,
                    'hod' => 'Dr. Arun Patel',
                    'students' => 420,
                    'faculty' => 24,
                    'programs' => 6,
                    'accreditation' => 'AICTE Approved',
                    'program_list' => ['MBA', 'PGDM', 'Executive MBA', 'PhD Management'],
                    'icon' => 'success'
                ],
            ];
        @endphp

        @foreach($departments as $dept)
            <div class="configured-item p-4">

                <div class="d-flex justify-content-between align-items-start">

                    <!-- LEFT -->
                    <div class="d-flex gap-3">
                        <div class="stat-icon {{ $dept['icon'] }}">
                            <i class="bi bi-layers"></i>
                        </div>

                        <div>
                            <h6 class="mb-1">{{ $dept['name'] }}</h6>
                            <small class="">
                                {{ $dept['code'] }} • Est. {{ $dept['estd'] }}
                            </small>
                            <div class="small  mt-1">
                                HOD: {{ $dept['hod'] }}
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT (KEBAB) -->
                    <button class="icon-btn">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                </div>

                <!-- METRICS -->
                <div class="meta-row mt-3">
                    <span><i class="bi bi-people"></i> Students {{ $dept['students'] }}</span>
                    <span><i class="bi bi-person-badge"></i> Faculty {{ $dept['faculty'] }}</span>
                    <span><i class="bi bi-journal-bookmark"></i> Programs {{ $dept['programs'] }}</span>
                    <span><i class="bi bi-patch-check"></i> {{ $dept['accreditation'] }}</span>
                </div>

                <!-- PROGRAM CHIPS -->
                <div class="chip-container mt-3">
                    @foreach($dept['program_list'] as $prog)
                        <span class="chip-item">
                            <span>{{ $prog }}</span>
                        </span>
                    @endforeach
                </div>

            </div>
        @endforeach

    </div>

</div>
