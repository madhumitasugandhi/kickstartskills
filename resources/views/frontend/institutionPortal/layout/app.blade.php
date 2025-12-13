<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Institute Portal | KickStartSkills')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            background: #0e1a2b;
            font-family: "Inter", sans-serif;
        }

        .layout-wrapper {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar */
        #sidebar {
            width: 260px;
            background: #132238;
            transition: all .3s ease;
            overflow-y: auto;
        }
        #sidebar.collapsed {
            width: 80px;
        }
        #sidebar .menu-text {
            transition: .3s;
        }
        #sidebar.collapsed .menu-text {
            opacity: 0;
            pointer-events: none;
        }

        /* Header */
        .top-header {
            height: 70px;
            background: #0f2035;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        /* Content */
        .content-area {
            flex-grow: 1;
            overflow-y: auto;
            padding: 20px;
        }

        /* Navigation Items */
        .nav-item-custom {
            padding: 12px 20px;
            color: #cdd9e5;
            font-size: 15px;
            border-radius: 8px;
            margin-bottom: 6px;
            transition: .2s;
        }
        .nav-item-custom:hover,
        .nav-item-custom.active {
            background: #1e2f47;
            color: #fff;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
        }
    </style>

    @stack('styles')
</head>

<body>

<div class="layout-wrapper">

    {{-- Sidebar --}}
    @include('frontend.institutionPortal.layout.sidebar')

    {{-- Main Content --}}
    <div class="w-100 d-flex flex-column">

        {{-- Header --}}
        @include('frontend.institutionPortal.layout.header')

        {{-- Page Content --}}
        <div class="content-area">
            @yield('content')
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Toggle Sidebar
    document.getElementById('sidebarToggle')?.addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('collapsed');
    });
</script>

@stack('scripts')

</body>
</html>

<script>
document.addEventListener("DOMContentLoaded", function () {
    
    const toggleBtn = document.getElementById("themeToggle");
    const toggleIcon = toggleBtn.querySelector("i");

    // Load saved theme
    if (localStorage.getItem("theme") === "light") {
        document.body.classList.add("light-mode");
        toggleIcon.classList.replace("bi-moon", "bi-brightness-high");
    } else {
        document.body.classList.add("dark-mode");
    }

    toggleBtn.addEventListener("click", function () {

        if (document.body.classList.contains("light-mode")) {
            // Switch to dark mode
            document.body.classList.remove("light-mode");
            document.body.classList.add("dark-mode");
            toggleIcon.classList.replace("bi-brightness-high", "bi-moon");
            localStorage.setItem("theme", "dark");

        } else {
            // Switch to light mode
            document.body.classList.remove("dark-mode");
            document.body.classList.add("light-mode");
            toggleIcon.classList.replace("bi-moon", "bi-brightness-high");
            localStorage.setItem("theme", "light");
        }
    });
});
</script>

