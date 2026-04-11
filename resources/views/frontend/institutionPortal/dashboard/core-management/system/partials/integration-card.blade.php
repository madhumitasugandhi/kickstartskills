<div class="ui-card mb-4">

    {{-- HEADER --}}
    <div class="ui-card-header">
        <div>
            <div class="ui-card-title">{{ $title }}</div>
            <div class="ui-card-subtitle">{{ $desc }}</div>
        </div>

        <div class="d-flex align-items-center gap-2 student-actions">
            <span class="status-pill">Connected</span>

            <button class="icon-btn kebab-toggle">
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

    <div class="ui-split">

        {{-- LEFT: DETAILS --}}
        <div class="ui-split-left">
            <div class="ui-section-title mb-2">Integration Details</div>

            <div class="ui-meta flex-column">
                <span><strong>Provider:</strong> {{ $provider }}</span>
                <span><strong>Version:</strong> {{ $version }}</span>
                <span><strong>Type:</strong> {{ $type }}</span>
                <span><strong>Category:</strong> {{ $category }}</span>
                <span><strong>Sync Frequency:</strong> {{ $sync }}</span>
                <span><strong>Data Points:</strong> {{ $points }}</span>
            </div>
        </div>

        {{-- RIGHT: HEALTH --}}
        <div class="ui-split-right">
            <div class="ui-section-title mb-2">System Health & Features</div>

            {{-- HEALTH BOX --}}
            <div class="ui-box mb-3">

                <div class="d-flex justify-content-between small mb-2">
                    <span>Uptime</span>
                    <strong>{{ $uptime }}</strong>
                </div>

                <div class="d-flex justify-content-between small mb-2">
                    <span>Latency</span>
                    <strong>{{ $latency }}</strong>
                </div>

                <div class="d-flex justify-content-between small">
                    <span>Error Rate</span>
                    <strong>{{ $error }}</strong>
                </div>

            </div>

            {{-- FEATURES --}}
            <div class="ui-chips">
                @foreach($features as $feature)
                    <div class="ui-chip">
                        {{ $feature }}
                    </div>
                @endforeach
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

