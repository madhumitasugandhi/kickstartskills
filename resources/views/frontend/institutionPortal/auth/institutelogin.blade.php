<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institution Portal - Login | KickStartSkills</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ------------------ CUSTOM THEME CONFIGURATION ------------------ */
        :root {
            /* LIGHT MODE (Vibrant Blue) */
            --bg-gradient: linear-gradient(135deg, #099B6D 0%, #05805C 100%);
            --text-main: #ffffff;
            --card-bg: rgba(255, 255, 255, 0.15);
            --card-border: rgba(255, 255, 255, 0.3);
            --card-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);
            --input-bg: rgba(255, 255, 255, 0.9);
            --input-text: #1e293b;
            --input-placeholder: #64748b;
            --btn-bg: #059166; --btn-hover: #1A9E75; --btn-text: #ffffff;
            --review-bg: rgba(0, 0, 0, 0.2);
            --circle-color-1: rgba(255, 255, 255, 0.15);
        }

        /* DARK MODE OVERRIDES */
        body.dark-mode {
            --bg-gradient: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            --text-main: #f8fafc;
            --card-bg: rgba(30, 41, 59, 0.7);
            --card-border: rgba(255, 255, 255, 0.1);
            --card-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
            --input-bg: rgba(15, 23, 42, 0.6);
            --input-text: #f1f5f9;
            --input-placeholder: #94a3b8;
            --btn-bg: #059166; --btn-hover: #1A9E75;
            --review-bg: rgba(255, 255, 255, 0.05);
            --circle-color-1: rgba(70, 150, 255, 0.1);
        }

        /* ------------------ BASE STYLES ------------------ */
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-gradient);
            color: var(--text-main);
            min-height: 100vh;
            overflow-y: auto; overflow-x: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: background 0.5s ease;
            position: relative;
            overflow: hidden;
        }

        /* ------------------ FLOATING CIRCLES ANIMATION ------------------ */
        @keyframes animate {
            0% { transform: translateY(0) rotate(0deg); opacity: 1; border-radius: 50%; }
            100% { transform: translateY(-1000px) rotate(720deg); opacity: 0; border-radius: 50%; }
        }

        .circles {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            overflow: hidden; margin: 0; padding: 0; z-index: 0; pointer-events: none;
        }

        .circles li {
            position: absolute; display: block; list-style: none;
            width: 20px; height: 20px; background: var(--circle-color-1);
            animation: animate 25s linear infinite; bottom: -150px;
        }

        /* Circle Variations & Positions (omitted for brevity) */
        .circles li:nth-child(3n+1) { background: var(--circle-color-1); }
        .circles li:nth-child(3n+2) { background: var(--circle-color-2); }
        .circles li:nth-child(3n) { background: var(--circle-color-3); }
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


        /* ------------------ UI COMPONENT STYLES ------------------ */
        .login-container { width: 100%; max-width: 420px; padding: 15px; z-index: 10; }

        .login-card {
            background: var(--card-bg); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--card-border); box-shadow: var(--card-shadow);
            border-radius: 24px; padding: 2.5rem; transition: all 0.3s ease;
        }

        .logo-box {
            width: 54px; height: 54px; background-color: #059166;
            border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem; color: #fff; margin-bottom: 1rem; backdrop-filter: blur(4px);
        }

        /* Inputs */
        .input-wrapper { position: relative; margin-bottom: 1.25rem; }
        .input-icon {
            position: absolute; left: 15px; top: 50%; transform: translateY(-50%);
            color: #64748b; z-index: 5; transition: color 0.2s;
        }
        .custom-input {
            width: 100%; padding: 12px 15px 12px 42px; border-radius: 10px;
            background: var(--input-bg); border: 1px solid var(--input-border);
            color: var(--input-text); font-size: 0.95rem; transition: all 0.2s;
        }
        .custom-input:focus { outline: none; box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.25); }
        .custom-input:focus + .input-icon, .input-wrapper:focus-within .input-icon { color: var(--btn-bg); }

        .password-toggle {
            position: absolute; right: 15px; top: 50%; transform: translateY(-50%);
            cursor: pointer; color: #64748b; border: none; background: none;
        }

        /* Button */
        .btn-login {
            background-color: var(--btn-bg); color: var(--btn-text); font-weight: 600;
            padding: 12px; border-radius: 12px; border: none; width: 100%; margin-top: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); transition: all 0.2s;
        }
        .btn-login:hover { background-color: var(--btn-hover); transform: translateY(-1px); }

        /* Links & Text */
        .text-muted-custom { color: var(--text-muted) !important; }
        .link-custom {
            color: var(--text-main); opacity: 0.9; text-decoration: none; font-weight: 500;
        }
        .link-custom:hover { opacity: 1; text-decoration: underline; }

        /* Theme Toggle */
        .theme-toggle {
            position: absolute; top: 25px; right: 25px; width: 44px; height: 44px;
            border-radius: 50%; border: none; background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(4px); color: #fff; display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: background 0.2s; z-index: 50;
        }
        .theme-toggle:hover { background: rgba(255, 255, 255, 0.25); }
    </style>
</head>

<body id="app-body">
    <ul class="circles">
        <li></li><li></li><li></li><li></li><li></li>
        <li></li><li></li><li></li><li></li><li></li>
    </ul>

    <button onclick="toggleTheme()" class="theme-toggle" title="Toggle Theme">
        <i id="theme-icon" class="bi bi-moon"></i>
    </button>

    <div class="login-container">

        <div class="d-flex flex-column align-items-center mb-4">
            <div class="logo-box">
                <i class="bi bi-book"></i>
            </div>
            <h2 class="fw-bold mb-1">KickStartSkills</h2>
            <p class="text-muted-custom mb-0 fw-medium">Institution Portal</p>
        </div>

        <div class="login-card">
            <div class="text-center mb-4">
                <h4 class="fw-bold mb-2">Welcome, Institution</h4>
                <p class="text-muted-custom small">Manage your educational programs and empower your students</p>
            </div>

            <form>
                <div class="mb-3">
                    <label for="email" class="form-label small ms-1 mb-1 fw-medium text-muted-custom">Institution Email address</label>
                    <div class="input-wrapper">
                        <i class="bi bi-envelope input-icon"></i>
                        <input type="email" class="custom-input" id="email" name="email"
                               placeholder="student@kickstartskills.com" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label small ms-1 mb-1 fw-medium text-muted-custom">Password</label>
                    <div class="input-wrapper">
                        <i class="bi bi-lock input-icon"></i>
                        <input type="password" class="custom-input" id="password" name="password"
                               placeholder="••••••••" required>
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i id="eye-icon" class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label small text-muted-custom" for="remember">Remember me</label>
                    </div>
                    <a href="/institution/forgot-password" class="small link-custom">Forgot password?</a>
                </div>

                <button type="submit" class="btn-login">Access Institution Portal</button>
            </form>

            <div class="text-center mt-4">
                <p class="small text-muted-custom mb-0">
                    New Institution?
                    <a href="/institution/register" class="link-custom ms-1">Register Institution</a>
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const body = document.getElementById('app-body');
        const themeIcon = document.getElementById('theme-icon');
        const eyeIcon = document.getElementById('eye-icon'); // Defined globally for consistency

        function toggleTheme() {
            body.classList.toggle('dark-mode');
            updateIcon();
        }

        function updateIcon() {
            if (body.classList.contains('dark-mode')) {
                // Dark mode shows the sun icon (to switch to light mode)
                themeIcon.className = 'bi bi-sun';
            } else {
                // Light mode shows the moon icon (to switch to dark mode)
                themeIcon.className = 'bi bi-moon';
            }
        }

        // Initialize the icon state on page load
        updateIcon();

        function togglePassword() {
            const passwordInput = document.getElementById('password');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                // Show password icon
                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                // Hide password icon
                eyeIcon.classList.remove('bi-eye-slash');
                eyeIcon.classList.add('bi-eye');
            }
        }
    </script>
</body>
</html>
