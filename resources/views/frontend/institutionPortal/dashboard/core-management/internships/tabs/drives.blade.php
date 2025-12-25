{{-- SEARCH + FILTER --}}
<div class="glass-card mb-4">

    <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap">
        <div class="input-group-custom flex-grow-1">
            <i class="bi bi-search"></i>
            <input class="form-control ps-5"
                   placeholder="Search internship drives...">
        </div>

        <a href="#" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> Create Drive
        </a>
    </div>

    {{-- Status Filters --}}
    <div class="d-flex gap-2 flex-wrap mt-3">
        <button class="requirement-btn active">✔ All Status</button>
        <button class="requirement-btn">Active</button>
        <button class="requirement-btn">Selection Phase</button>
        <button class="requirement-btn">In Progress</button>
        <button class="requirement-btn">Completed</button>
    </div>

</div>

{{-- DRIVES LIST --}}
<div class="drive-list">

    {{-- DRIVE CARD --}}
    <div class="drive-card">

        {{-- LEFT --}}
        <div class="drive-left">

            <div class="drive-header">
                <div class="company-avatar">TC</div>

                <div>
                    <h6 class="mb-0 fw-semibold">Full Stack Development Internship</h6>
                    <small class="">TechCorp Solutions</small>
                </div>
            </div>

            <p class="small  mb-2">
                Comprehensive full-stack development program with real project experience
            </p>

            {{-- META --}}
            <div class="meta-row mb-2">
                <span><i class="bi bi-clock"></i> 120 days</span>
                <span><i class="bi bi-currency-rupee"></i> ₹15,000 / month</span>
                <span><i class="bi bi-people"></i> 25 positions</span>
            </div>

            {{-- SKILLS --}}
            <div class="skill-chips">
                <span class="skill-chip">React</span>
                <span class="skill-chip">Node.js</span>
                <span class="skill-chip">JavaScript</span>
                <span class="skill-chip">MongoDB</span>
            </div>

        </div>

        {{-- RIGHT --}}
        <div class="drive-right">

            <span class="status-pill active">Active</span>

            <div class="drive-metrics mt-2">
                <span><i class="bi bi-file-earmark-text"></i> Applications: <b>156</b></span>
                <span><i class="bi bi-check-circle"></i> Selected: <b>22</b></span>
            </div>

            <a href="#" class="view-link mt-2">View Details</a>
        </div>

    </div>

    {{-- DRIVE CARD --}}
    <div class="drive-card">

        <div class="drive-left">

            <div class="drive-header">
                <div class="company-avatar" style="background: rgba(245,158,11,0.2); color:#f59e0b;">
                    DM
                </div>

                <div>
                    <h6 class="mb-0 fw-semibold">Data Science & Analytics</h6>
                    <small class="">DataMind Analytics</small>
                </div>
            </div>

            <p class="small  mb-2">
                Hands-on experience with real-world data science projects
            </p>

            <div class="meta-row mb-2">
                <span><i class="bi bi-clock"></i> 120 days</span>
                <span><i class="bi bi-currency-rupee"></i> ₹18,000 / month</span>
                <span><i class="bi bi-people"></i> 15 positions</span>
            </div>

            <div class="skill-chips">
                <span class="skill-chip">Python</span>
                <span class="skill-chip">Machine Learning</span>
                <span class="skill-chip">SQL</span>
                <span class="skill-chip">Tableau</span>
            </div>

        </div>

        <div class="drive-right">

            <span class="status-pill warning">Selection Phase</span>

            <div class="drive-metrics mt-2">
                <span><i class="bi bi-file-earmark-text"></i> Applications: <b>89</b></span>
                <span><i class="bi bi-check-circle"></i> Selected: <b>14</b></span>
            </div>

            <a href="#" class="view-link mt-2">View Details</a>
        </div>

    </div>

</div>
