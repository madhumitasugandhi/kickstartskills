<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Institute Portal')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/institute.css') }}">
    
    <script>
        (function() {
            const theme = localStorage.getItem('theme') || 'dark';
            document.documentElement.classList.add(theme + '-mode');
        })();
    </script>
</head>
<body class="dark-mode"> <div class="layout-wrapper">
    @include('frontend.institutionPortal.layout.sidebar')

    <div class="w-100 d-flex flex-column" style="min-width: 0;">
        @include('frontend.institutionPortal.layout.header')
        <main class="content-area">
            @yield('content')
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const body = document.body;
        const sidebar = document.getElementById("sidebar");
        const sidebarToggle = document.getElementById("sidebarToggle") || null;
        
        // Select all buttons for theme toggling (Header and Sidebar)
        const themeToggles = document.querySelectorAll(".theme-toggle-btn, #themeToggle");

        function updateIcons(isLight) {
            themeToggles.forEach(btn => {
                const icon = btn.querySelector('i');
                if (isLight) {
                    icon.classList.replace('bi-moon', 'bi-brightness-high');
                } else {
                    icon.classList.replace('bi-brightness-high', 'bi-moon');
                }
            });
        }

        // 1. Initial Theme Load
        const currentTheme = localStorage.getItem("theme") || "dark";
        if (currentTheme === "light") {
            body.classList.add("light-mode");
            body.classList.remove("dark-mode");
            updateIcons(true);
        } else {
            updateIcons(false);
        }

        // 2. Global Toggle Logic
        themeToggles.forEach(btn => {
            btn.addEventListener("click", () => {
                const isLight = body.classList.toggle("light-mode");
                body.classList.toggle("dark-mode", !isLight);
                localStorage.setItem("theme", isLight ? "light" : "dark");
                updateIcons(isLight);
            });
        });

        // 3. Sidebar Collapse Logic
        sidebarToggle.addEventListener("click", () => {
            if(window.innerWidth > 768) {
                sidebar.classList.toggle('collapsed');
            } else {
                sidebar.classList.toggle('show-mobile');
            }
        });

        document.addEventListener("click", function (e) {
    if (window.innerWidth <= 768) {
        if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
            sidebar.classList.remove("show-mobile");
        }
    }
});

    });
</script>
<!-- ✅ STACKED PAGE SCRIPTS -->
@stack('scripts')
</body>
</html>