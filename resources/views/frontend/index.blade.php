<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KickStartSkills Portals</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* ------------------ CSS VARIABLES ------------------ */
        :root {
            /* Light Mode */
            --bg-light: linear-gradient(135deg, #d9edff 0%, #c3e2ff 40%, #e7f3ff 100%);
            --txt-main: #0a0a0a;
            --txt-sub: #6e7b88;
            --card-bg: rgba(255, 255, 255, 0.50);
            --card-border: rgba(255, 255, 255, 0.35);

            /* Circle Colors */
            --circle-blue-light: rgba(70, 150, 255, 0.3);
            --circle-green-light: rgba(70, 255, 150, 0.25);
            --circle-orange-light: rgba(255, 106, 0, 0.2);

            /* Icon/Button Background Colors (Light Mode) */
            --bg-primary-light: rgba(13, 110, 253, 0.1);
            --bg-success-light: rgba(25, 135, 84, 0.1);
            --bg-danger-light: rgba(220, 53, 69, 0.1);
            --bg-purple-light: rgba(156, 79, 217, 0.1); /* HR Purple opacity */
            --bg-warning-light: rgba(255, 193, 7, 0.1); /* Mentor Yellow opacity */
        }

        body.dark-mode {
            /* Dark Mode */
            --bg-light: linear-gradient(135deg, #041625 0%, #062743 40%, #03121f 100%);
            --txt-main: #f5f5f5;
            --txt-sub: #b7c2cc;
            --card-bg: rgba(0, 0, 0, 0.3);
            --card-border: rgba(255, 255, 255, 0.08);

            /* Circle Colors */
            --circle-blue-dark: rgba(70, 150, 255, 0.1);
            --circle-green-dark: rgba(70, 255, 150, 0.08);
            --circle-orange-dark: rgba(255, 165, 0, 0.06);

            /* Icon/Button Background Colors (Dark Mode) */
            --bg-primary-dark: rgba(13, 110, 253, 0.15);
            --bg-success-dark: rgba(25, 135, 84, 0.15);
            --bg-danger-dark: rgba(220, 53, 69, 0.15);
            --bg-purple-dark: rgba(156, 79, 217, 0.15);
            --bg-warning-dark: rgba(255, 193, 7, 0.15);
        }

        /* ------------------ KEYFRAME ANIMATION ------------------ */
        @keyframes animate {
            0% { transform: translateY(0) rotate(0deg); opacity: 1; border-radius: 50%; }
            100% { transform: translateY(-1000px) rotate(720deg); opacity: 1; border-radius: 50%; }
        }

        /* ------------------ BASE STYLING ------------------ */
        body {
            background: var(--bg-light);
            color: var(--txt-main);
            min-height: 100vh;
            overflow-x: hidden;
            padding: 60px 22px;
            position: relative;
            transition: 0.4s ease-in-out;
        }

        /* Circles Container */
        .circles {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%; overflow: hidden; margin: 0; z-index: -1;
        }

        /* Individual Circle Styles */
        .circles li {
            position: absolute; display: block; list-style: none; width: 20px; height: 20px;
            animation: animate 25s linear infinite; bottom: -150px; border-radius: 50%;
            transition: background 0.4s ease-in-out; backface-visibility: hidden;
        }

        /* --- MULTI-COLOR CIRCLE LOGIC --- */
        .circles li:nth-child(3n+1) { background: var(--circle-blue-light); }
        .circles li:nth-child(3n+2) { background: var(--circle-green-light); }
        .circles li:nth-child(3n) { background: var(--circle-orange-light); }
        body.dark-mode .circles li:nth-child(3n+1) { background: var(--circle-blue-dark); }
        body.dark-mode .circles li:nth-child(3n+2) { background: var(--circle-green-dark); }
        body.dark-mode .circles li:nth-child(3n) { background: var(--circle-orange-dark); }


        /* Staggered Circle Definitions (omitted for brevity) */
        .circles li:nth-child(1) { left: 25%; width: 80px; height: 80px; animation-delay: 0s; }
        .circles li:nth-child(2) { left: 10%; width: 20px; height: 20px; animation-delay: 2s; animation-duration: 12s; }
        .circles li:nth-child(3) { left: 70%; width: 20px; height: 20px; animation-delay: 4s; }
        .circles li:nth-child(4) { left: 40%; width: 60px; height: 60px; animation-delay: 0s; animation-duration: 18s; }
        .circles li:nth-child(5) { left: 65%; width: 20px; height: 20px; animation-delay: 0s; }
        .circles li:nth-child(6) { left: 75%; width: 110px; height: 110px; animation-delay: 3s; }
        .circles li:nth-child(7) { left: 35%; width: 150px; height: 150px; animation-delay: 7s; }
        .circles li:nth-child(8) { left: 50%; width: 25px; height: 25px; animation-delay: 15s; animation-duration: 45s; }
        .circles li:nth-child(9) { left: 20%; width: 15px; height: 15px; animation-delay: 2s; animation-duration: 35s; }
        .circles li:nth-child(10) { left: 85%; width: 150px; height: 150px; animation-delay: 0s; animation-duration: 11s; }
        .circles li:nth-child(11) { left: 5%; width: 90px; height: 90px; animation-delay: 6s; animation-duration: 20s; }
        .circles li:nth-child(12) { left: 90%; width: 40px; height: 40px; animation-delay: 1s; animation-duration: 15s; }
        .circles li:nth-child(13) { left: 15%; width: 65px; height: 65px; animation-delay: 10s; animation-duration: 28s; }
        .circles li:nth-child(14) { left: 45%; width: 10px; height: 10px; animation-delay: 8s; animation-duration: 13s; }
        .circles li:nth-child(15) { left: 78%; width: 70px; height: 70px; animation-delay: 12s; animation-duration: 30s; }
        .circles li:nth-child(16) { left: 30%; width: 55px; height: 55px; animation-delay: 1s; animation-duration: 40s; }
        .circles li:nth-child(17) { left: 60%; width: 100px; height: 100px; animation-delay: 5s; animation-duration: 25s; }
        .circles li:nth-child(18) { left: 55%; width: 30px; height: 30px; animation-delay: 18s; animation-duration: 17s; }
        .circles li:nth-child(19) { left: 80%; width: 15px; height: 15px; animation-delay: 9s; animation-duration: 38s; }
        .circles li:nth-child(20) { left: 2%; width: 120px; height: 120px; animation-delay: 0s; animation-duration: 22s; }


        /* ------------------ PORTAL COMPONENT STYLES ------------------ */

        /* Icon Background (The new opacity background) */
        .portal-icon {
            width: 68px; height: 68px; border-radius: 18px;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.15); /* Subtle white border */
            display: flex; align-items: center; justify-content: center; margin-bottom: 20px;
            font-size: 28px; transition: all 0.4s ease-in-out;
            position: relative; /* Ensure it stacks correctly */
        }

        /* Apply specific color backgrounds for icons */
        .portal-icon.text-primary { background: var(--bg-primary-light); }
        .portal-icon.text-success { background: var(--bg-success-light); }
        .portal-icon.text-danger { background: var(--bg-danger-light); }
        .portal-icon.text-purple { background: var(--bg-purple-light); }
        .portal-icon.text-warning { background: var(--bg-warning-light); }

        /* Dark Mode Icon Background Overrides */
        body.dark-mode .portal-icon.text-primary { background: var(--bg-primary-dark); }
        body.dark-mode .portal-icon.text-success { background: var(--bg-success-dark); }
        body.dark-mode .portal-icon.text-danger { background: var(--bg-danger-dark); }
        body.dark-mode .portal-icon.text-purple { background: var(--bg-purple-dark); }
        body.dark-mode .portal-icon.text-warning { background: var(--bg-warning-dark); }


        /* Login Button Styling (Background Opacity + Glass Effect) */
        .login-btn {
            border-radius: 30px; padding: 5px 18px; font-size: 0.82rem;
            border: 1px solid rgba(255, 255, 255, 0.22);
            background: rgba(255, 255, 255, 0.08); /* Base white transparency */
            backdrop-filter: blur(10px);
            color: inherit;
            transition: all 0.4s ease-in-out;
            text-transform: lowercase; /* Matches video styling */
        }

        /* Apply specific button background colors using opacity variables */
        .login-btn.btn-primary { background: var(--bg-primary-light); border-color: rgba(13, 110, 253, 0.2); }
        .login-btn.btn-success { background: var(--bg-success-light); border-color: rgba(25, 135, 84, 0.2); }
        .login-btn.btn-danger { background: var(--bg-danger-light); border-color: rgba(220, 53, 69, 0.2); }
        /* Using a specific style for HR/purple login */
        .login-btn.btn-purple {
            background: var(--bg-purple-light);
            border-color: rgba(156, 79, 217, 0.2);
            color: #9c4fd9 !important; /* Force text color for HR button */
        }
        .login-btn.btn-warning { background: var(--bg-warning-light); border-color: rgba(255, 193, 7, 0.2); }

        /* Dark Mode Button Background Overrides */
        body.dark-mode .login-btn.btn-primary { background: var(--bg-primary-dark); }
        body.dark-mode .login-btn.btn-success { background: var(--bg-success-dark); }
        body.dark-mode .login-btn.btn-danger { background: var(--bg-danger-dark); }
        body.dark-mode .login-btn.btn-purple { background: var(--bg-purple-dark); }
        body.dark-mode .login-btn.btn-warning { background: var(--bg-warning-dark); }


        /* --- General Card Styling --- */
        .portal-card {
            background: var(--card-bg);
            backdrop-filter: blur(35px);
            -webkit-backdrop-filter: blur(35px);
            border: 1px solid var(--card-border);
            border-radius: 28px;
            box-shadow: 0 8px 30px var(--card-bg);
            height: 360px;
            padding: 45px;
            transition: all 0.3s ease;
            cursor: pointer;
            z-index: 2;
            position: relative;
            display: flex; /* Added for button alignment */
            flex-direction: column;
        }

        /* LIGHT MODE PERFECT HOVER */
        .portal-card:hover {
            transform: translateY(-6px);
            background: rgba(255, 255, 255, 0.80);
            backdrop-filter: blur(45px) saturate(180%);
            -webkit-backdrop-filter: blur(45px) saturate(180%);
            border-color: rgba(255, 255, 255, 0.55);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.08), 0 0 40px rgba(255, 255, 255, 0.45);
        }

        /* Dark Mode Card Styling */
        body.dark-mode .portal-card { background: var(--card-bg); border-color: var(--card-border); }

        /* Other Styles */
        .main-icon { width: 85px; height: 85px; border-radius: 22px; background: rgba(255, 255, 255, 0.45); backdrop-filter: blur(12px); border: 2px solid rgba(255, 255, 255, 0.3); display: flex; align-items: center; justify-content: center; margin: 0 auto 18px; transition: 0.4s ease-in-out; z-index: 3; }
        .portal-title { font-size: 1.25rem; font-weight: 700; margin-bottom: 6px; }
        .portal-sub { font-size: 1rem; color: var(--txt-main); opacity: .85; margin-bottom: 12px; }
        .portal-desc { font-size: 0.82rem; color: var(--txt-sub); margin-bottom: auto; /* Push button to bottom */ }
        .info-bar { background: rgba(255, 255, 255, 0.25); backdrop-filter: blur(18px); border-radius: 18px; padding: 14px 22px; border: 1px solid rgba(255, 255, 255, 0.35); margin-top: 40px; font-size: .9rem; color: var(--txt-sub); transition: 0.4s ease-in-out; }
        body.dark-mode .info-bar { background: rgba(0, 0, 0, 0.3); border-color: rgba(255, 255, 255, 0.15); }
        .toggle-btn { margin-top: 28px; padding: 8px 26px; background: rgba(255, 255, 255, 0.25); border: 1px solid rgba(255, 255, 255, .22); border-radius: 26px; backdrop-filter: blur(12px); cursor: pointer; font-weight: 600; color: var(--txt-main); transition: 0.4s ease-in-out; }
        body.dark-mode .toggle-btn { background: rgba(0, 0, 0, 0.3); border-color: rgba(255, 255, 255, 0.15); }
    </style>
</head>

<body>

    <ul class="circles">
        <li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
        <li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
    </ul>

    <div class="container">

        <div class="text-center mb-5">
            <div class="main-icon">
                <i class="bi bi-lightning-charge-fill fs-1 text-primary"></i>
            </div>
            <h1 class="fw-bold">KickStartSkills</h1>
            <p class="text-secondary">Choose your portal to get started</p>
        </div>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="portal-card">
                    <div class="portal-icon text-primary"><i class="bi bi-book-fill"></i></div>

                    <div class="portal-title text-primary">Student Portal</div>
                    <div class="portal-sub">Continue your learning journey</div>
                    <div class="portal-desc">Access courses, track progress, and develop your skills.</div>

                    <a href="/student-login" class="login-btn text-primary btn-primary">/student-login</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="portal-card">
                    <div class="portal-icon text-success"><i class="bi bi-house-door-fill"></i></div>

                    <div class="portal-title text-success">Institution Portal</div>
                    <div class="portal-sub">Manage your educational programs</div>
                    <div class="portal-desc">Oversee student programs and institutional analytics.</div>

                    <a href="/institution-login" class="login-btn text-success btn-success">/institution-login</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="portal-card">
                    <div class="portal-icon text-warning"><i class="bi bi-person-check-fill"></i></div>

                    <div class="portal-title text-warning">Mentor Portal</div>
                    <div class="portal-sub">Guide and inspire talent</div>
                    <div class="portal-desc">Provide guidance and mentorship to students.</div>

                    <a href="/mentor-login" class="login-btn text-warning btn-warning">/mentor-login</a>
                </div>
            </div>

        </div>

        <div class="row g-4 mt-2">

            <div class="col-md-4">
                <div class="portal-card">
                    <div class="portal-icon text-purple"><i class="bi bi-briefcase-fill" style="color:#9c4fd9"></i></div>

                    <div class="portal-title" style="color:#9c4fd9">HR Portal</div>
                    <div class="portal-sub">Discover top talent</div>
                    <div class="portal-desc">Recruit skilled professionals and manage talent.</div>

                    <a href="/hr-login" class="login-btn btn-purple" style="color:#9c4fd9">/hr-login</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="portal-card">
                    <div class="portal-icon text-danger"><i class="bi bi-gear-fill"></i></div>

                    <div class="portal-title text-danger">Admin Portal</div>
                    <div class="portal-sub">Platform administration</div>
                    <div class="portal-desc">Manage platform operations and oversee all activities.</div>

                    <a href="/admin-login" class="login-btn text-danger btn-danger">/admin-login</a>
                </div>
            </div>

        </div>

        <div class="info-bar mt-4">
            <i class="bi bi-info-circle me-2"></i>
            Each portal has its own dedicated login URL. Bookmark your preferred portal for quick access.
        </div>

        <div class="text-center">
            <button id="toggleMode" class="toggle-btn"><i class="bi bi-moon"></i> Dark Mode</button>
        </div>

    </div>

    <script>
        const btn = document.getElementById("toggleMode");
        const body = document.body;

        // Function to set the theme
        function setTheme(isDarkMode) {
            if (isDarkMode) {
                body.classList.add("dark-mode");
                localStorage.setItem('theme', 'dark');
                btn.innerHTML = "<i class='bi bi-sun'></i> Light Mode";
            } else {
                body.classList.remove("dark-mode");
                localStorage.setItem('theme', 'light');
                btn.innerHTML = "<i class='bi bi-moon'></i> Dark Mode";
            }
        }

        // Check for theme preference on load
        const savedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (savedTheme) {
            setTheme(savedTheme === 'dark');
        } else if (prefersDark) {
            setTheme(true); // System preference is dark
        } else {
            setTheme(false); // Default to light
        }

        // Button click handler
        btn.onclick = () => {
            const isDarkMode = !body.classList.contains("dark-mode");
            setTheme(isDarkMode);
        };
    </script>

</body>
</html>
