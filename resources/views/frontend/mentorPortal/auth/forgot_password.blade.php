<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Student Portal | KickStartSkills</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ------------------ THEME CONFIGURATION ------------------ */
        :root {
            /* LIGHT MODE (Lighter Orange Theme) */
            /* Using a softer, pastel orange gradient compared to the login page */
            --bg-gradient: linear-gradient(135deg, #f8c581 0%, #f88e31 100%);

            --text-main: #ffffff;
            --card-bg: rgba(255, 255, 255, 0.25); /* Slightly more opaque for better contrast */
            --card-border: rgba(255, 255, 255, 0.4);
            --card-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);

            --input-bg: rgba(255, 255, 255, 0.95);
            --input-text: #1e293b;
            --input-placeholder: #64748b;

            /* Orange Button Colors */
            --btn-bg: #ff6b00;
            --btn-hover: #e65100;
            --btn-text: #ffffff;

            --circle-color-1: rgba(255, 255, 255, 0.2);
            --accent-glow: rgba(255, 107, 0, 0.4);
        }

        /* DARK MODE OVERRIDES */
        body.dark-mode {
            /* Dark Brown/Charcoal Gradient with Orange tint */
            --bg-gradient: linear-gradient(135deg, #2d1b14 0%, #1a0f0a 100%);

            --text-main: #f8fafc;
            --card-bg: rgba(45, 27, 20, 0.7);
            --card-border: rgba(255, 165, 0, 0.15);
            --card-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);

            --input-bg: rgba(20, 10, 5, 0.6);
            --input-text: #f1f5f9;
            --input-placeholder: #94a3b8;

            --btn-bg: #ff8c00;
            --btn-hover: #ffa500;

            --circle-color-1: rgba(255, 140, 0, 0.1);
            --accent-glow: rgba(255, 140, 0, 0.5);
        }

        /* ------------------ BASE STYLES ------------------ */
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-gradient);
            color: var(--text-main);

            /* Scrolling Enabled */
            min-height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;

            display: flex; flex-direction: column; align-items: center; justify-content: center;
            padding: 40px 15px;
            transition: background 0.5s ease;
        }

        /* Bubbles Animation */
        .circles { position: fixed; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden; z-index: 0; pointer-events: none; padding: 0; margin: 0; }
        .circles li { position: absolute; display: block; list-style: none; width: 20px; height: 20px; background: var(--circle-color-1); animation: animate 25s linear infinite; bottom: -150px; }
        .circles li:nth-child(1) { left: 25%; width: 80px; height: 80px; animation-delay: 0s; }
        .circles li:nth-child(2) { left: 10%; width: 20px; height: 20px; animation-delay: 2s; animation-duration: 12s; }
        .circles li:nth-child(3) { left: 70%; width: 20px; height: 20px; animation-delay: 4s; }
        .circles li:nth-child(4) { left: 40%; width: 60px; height: 60px; animation-delay: 0s; animation-duration: 18s; }
        .circles li:nth-child(5) { left: 65%; width: 20px; height: 20px; animation-delay: 0s; }
        .circles li:nth-child(6) { left: 75%; width: 110px; height: 110px; animation-delay: 3s; }
        @keyframes animate { 0% { transform: translateY(0) rotate(0deg); opacity: 1; border-radius: 50%; } 100% { transform: translateY(-1000px) rotate(720deg); opacity: 0; border-radius: 50%; } }

        /* UI Components */
        .nav-btn { position: absolute; top: 25px; width: 44px; height: 44px; border-radius: 50%; border: none; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(4px); color: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s; z-index: 50; text-decoration: none; }
        .nav-btn:hover { background: rgba(255, 255, 255, 0.35); transform: scale(1.05); color: white; }
        .back-btn { left: 25px; } .theme-btn { right: 25px; }

        .auth-container { width: 100%; max-width: 460px; padding: 15px; z-index: 10; display: flex; flex-direction: column; align-items: center; }

        /* Updated Icon Box to Orange */
        .icon-box {
            width: 64px; height: 64px;
            background: linear-gradient(135deg, #ff8c00, #ff6b00);
            border-radius: 18px; display: flex; align-items: center; justify-content: center;
            font-size: 1.75rem; color: #fff; margin-bottom: 1.5rem;
            box-shadow: 0 8px 20px var(--accent-glow);
        }

        /* Steps - Updated to Orange */
        .steps-container { display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 2rem; }
        .step { width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.9rem; border: 2px solid rgba(255, 255, 255, 0.4); color: rgba(255, 255, 255, 0.8); cursor: pointer; transition: all 0.3s ease; }
        .step:hover { background: rgba(255,255,255,0.25); color: white; border-color: white; }

        .step.active {
            background: #ff6b00;
            border-color: #ff6b00;
            color: white;
            box-shadow: 0 0 15px var(--accent-glow);
            transform: scale(1.1);
        }
        .step-line { width: 40px; height: 2px; background: rgba(255, 255, 255, 0.3); }

        /* Shared Styles for Included Forms */
        .glass-card { background: var(--card-bg); backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px); border: 1px solid var(--card-border); box-shadow: var(--card-shadow); border-radius: 28px; padding: 2.5rem 2rem; width: 100%; text-align: center; transition: background 0.3s ease; }

        .input-group-custom { position: relative; text-align: left; }
        .custom-input { width: 100%; padding: 14px 15px 14px 46px; border-radius: 12px; background: var(--input-bg); border: 1px solid transparent; color: var(--input-text); font-size: 0.95rem; font-weight: 500; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); transition: all 0.2s; }
        .custom-input::placeholder { color: var(--input-placeholder); }

        /* Orange Focus State */
        .custom-input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 107, 0, 0.25);
            border-color: #ff6b00;
        }
        .input-icon { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--input-placeholder); font-size: 1.1rem; z-index: 5; }

        .btn-action { background-color: var(--btn-bg); color: var(--btn-text); font-weight: 600; padding: 14px; border-radius: 12px; border: none; width: 100%; margin-top: 1.5rem; box-shadow: 0 4px 15px var(--accent-glow); transition: all 0.2s; font-size: 1rem; }
        .btn-action:hover { background-color: var(--btn-hover); transform: translateY(-2px); box-shadow: 0 6px 20px var(--accent-glow); }

        .link-back { color: var(--text-main); font-weight: 500; text-decoration: none; font-size: 0.9rem; display: inline-block; margin-top: 1.5rem; transition: opacity 0.2s; opacity: 0.8; }
        .link-back:hover { opacity: 1; }
    </style>
</head>

<body id="app-body">
    <ul class="circles"><li></li><li></li><li></li><li></li><li></li><li></li></ul>

    <a href="{{ url('/mentor-login') }}" class="nav-btn back-btn">
        <i class="bi bi-arrow-left"></i>
    </a>

    <button onclick="toggleTheme()" class="nav-btn theme-btn">
        <i id="theme-icon" class="bi bi-moon"></i>
    </button>

    <div class="auth-container">
        <div class="icon-box"><i class="bi bi-shield-lock-fill"></i></div>

        <h2 class="fw-bold mb-2" id="page-title">Forgot Password?</h2>
        <p class="opacity-75 mb-4 text-center" style="max-width: 300px;" id="page-subtitle">
            Enter your email to receive a reset link
        </p>

        <div class="steps-container">
            <div class="step active" onclick="switchStep(1)" id="step-1-btn">1</div>
            <div class="step-line"></div>
            <div class="step" onclick="switchStep(2)" id="step-2-btn">2</div>
            <div class="step-line"></div>
            <div class="step" onclick="switchStep(3)" id="step-3-btn">3</div>
        </div>

        <div id="step-1-form">
            @include('frontend.mentorPortal.auth.forgetPasswordLayouts.form1')
        </div>
        <div id="step-2-form" style="display: none;">
            @include('frontend.mentorPortal.auth.forgetPasswordLayouts.form2')
        </div>
        <div id="step-3-form" style="display: none;">
            @include('frontend.mentorPortal.auth.forgetPasswordLayouts.form3')
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // --- STEP SWITCHING LOGIC ---
        function switchStep(step) {
            document.getElementById('step-1-form').style.display = 'none';
            document.getElementById('step-2-form').style.display = 'none';
            document.getElementById('step-3-form').style.display = 'none';

            document.getElementById('step-1-btn').classList.remove('active');
            document.getElementById('step-2-btn').classList.remove('active');
            document.getElementById('step-3-btn').classList.remove('active');

            document.getElementById('step-' + step + '-form').style.display = 'block';
            document.getElementById('step-' + step + '-btn').classList.add('active');

            const title = document.getElementById('page-title');
            const sub = document.getElementById('page-subtitle');

            if(step === 1) {
                title.innerText = "Forgot Password?";
                sub.innerText = "Enter your email to receive a reset link";
            } else if(step === 2) {
                title.innerText = "Verification";
                sub.innerText = "We sent a code to your email";
            } else if(step === 3) {
                title.innerText = "Reset Password";
                sub.innerText = "Create a new strong password";
            }
        }

        // --- THEME TOGGLE LOGIC ---
        const body = document.getElementById('app-body');
        const themeIcon = document.getElementById('theme-icon');

        function toggleTheme() {
            body.classList.toggle('dark-mode');
            if(body.classList.contains('dark-mode')) {
                themeIcon.className = 'bi bi-sun';
            } else {
                themeIcon.className = 'bi bi-moon';
            }
        }
    </script>
</body>
</html>
