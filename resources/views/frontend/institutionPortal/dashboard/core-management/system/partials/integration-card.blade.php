<div class="card glass-card mb-4">
    <div class="card-body">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h6 class="fw-semibold mb-1">{{ $title }}</h6>
                <p class=" fw-semibold small mb-0">{{ $desc }}</p>
            </div>

            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-success">Connected</span>
                <div class="student-actions">
    <button class="btn btn-sm btn-outline-secondary kebab-toggle">
        <i class="bi bi-three-dots-vertical"></i>
    </button>

    <ul class="kebab-menu">
        <li><i class="bi bi-eye"></i> View Details</li>
        <li><i class="bi bi-arrow-repeat"></i> Sync Now</li>
        <li><i class="bi bi-gear"></i> Configure</li>
        <li class="danger"><i class="bi bi-x-circle"></i> Disconnect</li>
    </ul>
</div>

            </div>
        </div>

        <div class="row g-4">

            <!-- LEFT: DETAILS -->
            <div class="col-md-5">
                <h6 class=" mb-3">Integration Details</h6>

                <div class="small  mb-1">
                    <strong>Provider:</strong> {{ $provider }}
                </div>
                <div class="small  mb-1">
                    <strong>Version:</strong> {{ $version }}
                </div>
                <div class="small  mb-1">
                    <strong>Type:</strong> {{ $type }}
                </div>
                <div class="small  mb-1">
                    <strong>Category:</strong> {{ $category }}
                </div>
                <div class="small  mb-1">
                    <strong>Sync Frequency:</strong> {{ $sync }}
                </div>
                <div class="small ">
                    <strong>Data Points:</strong> {{ $points }}
                </div>
            </div>

            <!-- RIGHT: HEALTH -->
            <div class="col-md-7">
                <h6 class=" mb-3">System Health & Features</h6>

                <!-- HEALTH METRICS PANEL -->
<div class="health-panel mb-3">

<div class="health-row">
    <div class="health-item">
        <div class="health-value">{{ $uptime }}</div>
        <div class="health-label">Uptime</div>
    </div>

    <div class="health-item">
        <div class="health-value">{{ $latency }}</div>
        <div class="health-label">Latency</div>
    </div>
</div>

<div class="health-item center">
    <div class="health-value">{{ $error }}</div>
    <div class="health-label">Error Rate</div>
</div>

</div>


                <!-- FEATURES -->
                <div class="d-flex flex-wrap gap-2">
                    @foreach($features as $feature)
                        <span class="badge bg-success bg-opacity-10 text-success">
                            {{ $feature }}
                        </span>
                    @endforeach
                </div>
            </div>

        </div>

    </div>
</div>
<script>
document.addEventListener('click', function (e) {
    // Close all open kebabs
    document.querySelectorAll('.kebab-menu.show').forEach(menu => {
        menu.classList.remove('show');
    });

    // Toggle clicked kebab
    const toggle = e.target.closest('.kebab-toggle');
    if (toggle) {
        e.stopPropagation();
        const menu = toggle.nextElementSibling;
        if (menu) {
            menu.classList.toggle('show');
        }
    }
});
</script>
<style>
    /* ===============================
   DARK MODE – GLASS CARD FIX
=============================== */

body:not(.light-mode) .glass-card {
    background: rgba(255, 255, 255, 0.06); /* ⬅ stronger */
    border-color: rgba(255, 255, 255, 0.12);
}
/* ===============================
   DARK MODE – INTEGRATION TEXT FIX
=============================== */

body:not(.light-mode) .card.glass-card,
body:not(.light-mode) .card.glass-card p,
body:not(.light-mode) .card.glass-card h6,
body:not(.light-mode) .card.glass-card strong,
body:not(.light-mode) .card.glass-card span {
    color: var(--text-main);
}
/* ===============================
   DARK MODE – HEALTH PANEL FIX (FINAL)
=============================== */

body:not(.light-mode) .health-panel {
    background: rgba(16, 185, 129, 0.18);
    border-color: rgba(16, 185, 129, 0.35);
}

body:not(.light-mode) .health-item {
    background: rgba(16, 185, 129, 0.25);
}

body:not(.light-mode) .health-value {
    color: #6ee7b7;
}

body:not(.light-mode) .health-label {
    color: #ecfdf5;
}

</style>
