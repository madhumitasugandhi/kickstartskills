<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal | Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ================= THEME VARIABLES (ADMIN RED) ================= */
        :root {
            /* LIGHT MODE */
            --bg-body: #f8f9fa;
            --bg-sidebar: #ffffff;
            --bg-card: #ffffff;
            --bg-hover: #f8f9fa;
            --text-main: #343a40;
            --text-muted: #6c757d;
            --border-color: #e9ecef;

            /* ACCENT COLORS (ADMIN RED THEME) */
            --accent-color: #f65a5a; /* Crimson Red */
            --soft-accent: #fee2e2;  /* Soft Red Background */

            /* Utility Colors */
            --soft-blue: #e7f1ff; --text-blue: #0d6efd;
            --soft-green: #d1e7dd; --text-green: #0f5132;
            --soft-red: #f8c7cb; --text-red: #e35965;
            --soft-teal: #e0fbf6; --text-teal: #107c6f;
        }

        [data-theme="dark"] {
            /* DARK MODE */
            --bg-body: #0f1626;
            --bg-sidebar: #1e293b;
            --bg-card: #2e333f;
            --bg-hover: #2e333f;
            --text-main: #e9ecef;
            --text-muted: #adb5bd;
            --border-color: #3b455b;

            /* ACCENT COLORS (ADMIN RED THEME) */
            --accent-color: #d95555; /* Brighter Red for Dark Mode */
            --soft-accent: rgba(229, 68, 68, 0.15); /* Transparent Red */

            /* Dark Mode Transparencies */
            --soft-blue: rgba(13, 110, 253, 0.15); --text-blue: #6ea8fe;
            --soft-green: rgba(25, 135, 84, 0.15); --text-green: #75b798;
            --soft-red: rgba(220, 53, 69, 0.15); --text-red: #e03b48;
            --soft-teal: rgba(32, 201, 151, 0.15); --text-teal: #a9e5d6;
        }

        /* ================= GENERAL STYLING ================= */
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            overflow-x: hidden;
            transition: background-color 0.3s, color 0.3s;
            font-size: 0.85rem;
        }

        h5 { font-size: 1.1rem !important; }
        h6 { font-size: 0.95rem !important; }

        .form-control::placeholder {
            color: var(--text-muted) !important;
            opacity: 0.6;
        }

        .cursor-pointer { cursor: pointer; }

        .hover-bg-soft:hover {
            background-color: var(--bg-hover);
            font-weight: bold;
            color: var(--accent-color) !important;
        }

        .hover-accent:hover { color: var(--accent-color) !important; }

        /* --- Fix for Date & Time Picker Icons in Dark Mode --- */
        [data-theme="dark"] input[type="date"]::-webkit-calendar-picker-indicator,
        [data-theme="dark"] input[type="time"]::-webkit-calendar-picker-indicator {
            filter: invert(1); opacity: 0.7; cursor: pointer;
        }

        /* btn-outline-primary custom (Red) */
        .btn-outline-primary {
            color: var(--accent-color);
            border-color: var(--accent-color);
            background-color: transparent;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-outline-primary:hover {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: #fff;
        }

        /* --- Sidebar --- */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed; top: 0; left: 0;
            background: var(--bg-sidebar);
            border-right: 1px solid var(--border-color);
            z-index: 100;
            overflow-y: auto;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .sidebar-brand {
            height: 60px;
            display: flex; align-items: center; padding: 0 20px;
            border-bottom: 1px solid var(--border-color);
            color: var(--accent-color);
            font-weight: 700; font-size: 1rem;
        }

        .nav-link {
            color: var(--text-muted);
            font-weight: 500;
            padding: 10px 14px;
            border-radius: 10px;
            margin-bottom: 2px;
            display: flex; align-items: center; gap: 10px;
            transition: all 0.2s;
            font-size: 0.85rem;
        }

        /* HOVER STATE */
        .nav-link:hover, .nav-link:focus {
            background-color: var(--bg-hover);
            color: var(--accent-color) !important;
        }

        /* ACTIVE STATE */
        .nav-link.active {
            background-color: var(--soft-accent) !important;
            color: var(--accent-color) !important;
        }

        /* Sub-menu Styling */
        .sub-link {
            color: var(--text-muted);
            font-size: 0.85rem;
            padding: 8px 12px;
            border-radius: 8px;
            text-decoration: none;
            display: flex; align-items: center;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .sub-link i {
            margin-right: 10px; font-size: 1rem; opacity: 0.8;
            transition: color 0.2s;
        }

        .sub-link:hover {
            color: var(--accent-color);
            background-color: var(--bg-hover);
        }

        .sub-link:hover i { color: var(--accent-color); opacity: 1; }

        .sub-link.active {
            color: var(--accent-color) !important;
            background-color: var(--soft-accent) !important;
            font-weight: 600;
        }

        .user-footer {
            padding: 14px;
            border-top: 1px solid var(--border-color);
            margin-top: auto;
        }

        /* --- Main Content --- */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            display: flex; flex-direction: column;
            transition: margin-left 0.3s;
        }

        .top-header {
            height: 60px;
            background: var(--bg-sidebar);
            border-bottom: 1px solid var(--border-color);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 24px;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .content-body { padding: 12px; }

        /* --- Cards & Components --- */
        .card-custom {
            border: 1px solid var(--border-color);
            border-radius: 12px;
            background: var(--bg-card);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
            padding: 20px;
            margin-bottom: 20px;
            transition: background-color 0.3s, border-color 0.3s;
        }

        /* Utility Classes */
        .text-main { color: var(--text-main) !important; }
        .text-muted-custom { color: var(--text-muted) !important; }
        .text-accent { color: var(--accent-color) !important; }

        .bg-soft-blue { background-color: var(--soft-blue); color: var(--text-blue); }
        .bg-soft-green { background-color: var(--soft-green); color: var(--text-green); }
        .bg-soft-red { background-color: var(--soft-red); color: var(--text-red); }
        .bg-soft-teal { background-color: var(--soft-teal); color: var(--text-teal); }
        .bg-soft-orange { background-color: var(--soft-accent); color: var(--accent-color); }

        /* Mobile */
        @media (max-width: 991.98px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }

        /* Hide Scrollbar */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <script>
        const savedTheme = localStorage.getItem('theme') || 'dark';
        document.documentElement.setAttribute('data-theme', savedTheme);
    </script>
</head>

<body>
    <div id="sidebarOverlay" class="sidebar-overlay" style="position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,0.5);z-index:999;opacity:0;visibility:hidden;transition:0.3s;"></div>

    @include('frontend.adminPortal.dashboard.layouts.sidebar')

    <main class="main-content">
        @include('frontend.adminPortal.dashboard.layouts.header')

        <div class="content-body">
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';

            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateIcon(newTheme);
        }

        function updateIcon(theme) {
            const icon = document.getElementById('themeIcon');
            // Also check sidebar icon if it exists
            const iconSidebar = document.getElementById('themeIconSidebar');

            if (icon) {
                if (theme === 'dark') {
                    icon.classList.remove('bi-moon'); icon.classList.add('bi-sun');
                } else {
                    icon.classList.remove('bi-sun'); icon.classList.add('bi-moon');
                }
            }
            if (iconSidebar) {
                if (theme === 'dark') {
                    iconSidebar.classList.remove('bi-moon-stars'); iconSidebar.classList.add('bi-sun');
                } else {
                    iconSidebar.classList.remove('bi-sun'); iconSidebar.classList.add('bi-moon-stars');
                }
            }
        }

        // Initialize theme icon on load
        const currentTheme = localStorage.getItem('theme') || 'dark';
        updateIcon(currentTheme);
    </script>
</body>
</html>
