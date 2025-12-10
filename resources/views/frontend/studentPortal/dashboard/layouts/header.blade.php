<header class="top-header">
            <button class="btn btn-link text-main d-lg-none me-2"
                onclick="document.getElementById('sidebar').classList.toggle('show')">
                <i class="bi bi-list fs-4"></i>
            </button>
            <div>
                <h5 class="fw-bold m-0 text-main">Dashboard</h5>
                <small class="text-muted-custom" style="font-size: 0.8rem;">Welcome back, John!</small>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-light position-relative rounded-circle px-2">
                    <i class="bi bi-bell" style="font-size: 1rem;"></i>
                    <span
                        class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"
                        style="padding: 0.2rem !important;"></span>
                </button>
                <button class="btn btn-light rounded-circle  px-2 " id="themeToggle" onclick="toggleTheme()">
                    <i class="bi bi-moon" style="font-size: 1rem;" id="themeIcon"></i>
                </button>
            </div>
        </header>
