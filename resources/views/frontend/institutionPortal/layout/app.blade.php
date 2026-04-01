<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Institute Portal')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/institute.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
(function() {
    const theme = localStorage.getItem('theme') || 'dark';
    document.documentElement.classList.add(theme);
})();
</script>
</head>
<body>

<div class="layout-wrapper">
    
    @include('frontend.institutionPortal.layout.sidebar')

    <div class="main-wrapper">
        @include('frontend.institutionPortal.layout.header')

        <main class="content-area">
            @yield('content')
        </main>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const root = document.documentElement;
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

        // Initial Theme Load
const currentTheme = localStorage.getItem("theme") || "dark";
root.classList.remove("light", "dark");
root.classList.add(currentTheme);

// Toggle Theme
themeToggles.forEach(btn => {
    btn.addEventListener("click", () => {
        const isLight = root.classList.contains("light");
        root.classList.toggle("light", !isLight);
        root.classList.toggle("dark", isLight);
        localStorage.setItem("theme", isLight ? "dark" : "light");
        updateIcons(!isLight);
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

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Success',
    text: "{{ session('success') }}",
    confirmButtonColor: '#3085d6'
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Error',
    text: "{{ session('error') }}",
    confirmButtonColor: '#d33'
});
</script>
@endif
@stack('scripts')
</body>
</html>