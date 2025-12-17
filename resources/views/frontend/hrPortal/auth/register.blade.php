<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration | KickStartSkills</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        /* ------------------ THEME CONFIGURATION ------------------ */
        :root {
            /* LIGHT MODE - Purple Theme (Matches Reference Image) */
            /* Gradient from a rich violet to a deep purple */
            --bg-gradient: linear-gradient(135deg, #c486f9 0%, #b41ee6 100%);

            --text-main: #ffffff;
            --text-muted: rgba(255, 255, 255, 0.85);
            --card-bg: rgba(255, 255, 255, 0.15); /* Slightly more transparent for glass effect */
            --card-border: rgba(255, 255, 255, 0.3);
            --card-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);

            --input-bg: rgba(255, 255, 255, 0.95);
            --input-border: transparent;
            --input-text: #1e293b;

            /* Primary Button Color - Deep Purple */
            --btn-bg: #6d07c7;
            --btn-hover: #400474;
            --btn-text: #ffffff;

            /* Animation Circles - White/Purple tints */
            --circle-color-1: rgba(255, 255, 255, 0.15);
            --circle-color-2: rgba(255, 255, 255, 0.1);
            --circle-color-3: rgba(255, 255, 255, 0.05);
        }

        /* DARK MODE OVERRIDES */
        body.dark-mode {
            /* Very dark indigo/black gradient */
            --bg-gradient: linear-gradient(135deg, #0f0c29 0%, #442b63 50%, #39243e 100%);

            --text-main: #f5f5f5;
            --text-muted: #a8a29e;
            --card-bg: rgba(30, 27, 75, 0.6); /* Dark Indigo Glass */
            --card-border: rgba(139, 92, 246, 0.2); /* Subtle purple border */

            --input-bg: rgba(15, 23, 42, 0.6);
            --input-border: #4c1d95;
            --input-text: #fff;

            --btn-bg: #7c3aed;
            --btn-hover: #6d28d9;

            --circle-color-1: rgba(139, 92, 246, 0.1);
            --circle-color-2: rgba(124, 58, 237, 0.05);
            --circle-color-3: rgba(255, 255, 255, 0.02);
        }


        /* ------------------ BASE STYLES ------------------ */
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-gradient);
            color: var(--text-main);
            min-height: 100vh;
            overflow-y: auto; overflow-x: hidden;
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
        @keyframes animate { 0% { transform: translateY(0) rotate(0deg); opacity: 1; border-radius: 50%; } 100% { transform: translateY(-1000px) rotate(720deg); opacity: 0; border-radius: 50%; } }

        /* UI Components */
        .nav-btn { position: absolute; top: 25px; width: 44px; height: 44px; border-radius: 50%; border: none; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(4px); color: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s; z-index: 50; text-decoration: none; }
        .nav-btn:hover { background: rgba(255, 255, 255, 0.35); transform: scale(1.05); color: white; }
        .back-btn { left: 25px; } .theme-btn { right: 25px; }

        .auth-container { width: 100%; max-width: 500px; padding: 15px; z-index: 10; display: flex; flex-direction: column; align-items: center; }

        /* Updated Icon Box to Orange Gradient */
        .icon-box {
            width: 64px; height: 64px;
            background: linear-gradient(135deg, #8e1df0 0%, #a800e0 100%);
            border-radius: 18px; display: flex; align-items: center; justify-content: center;
            font-size: 1.75rem; color: #fff; margin-bottom: 1rem;
            box-shadow: 0 0 0 3px rgba(191, 0, 255, 0.25);
        }

        /* Steps Indicator - Updated to Orange */
        .steps-container { display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 2rem; }
        .step { width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.9rem; border: 2px solid rgba(255, 255, 255, 0.4); color: rgba(255, 255, 255, 0.8); cursor: default; transition: all 0.3s ease; }

        .step.active {
            background: var(--btn-bg);
            color: white;
            box-shadow: 0 0 0 3px rgba(191, 0, 255, 0.25);
            transform: scale(1.1);
        }
        .step-line { width: 40px; height: 2px; background: rgba(255, 255, 255, 0.3); }

        /* Form Styles */
        .glass-card { background: var(--card-bg); backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px); border: 1px solid var(--card-border); box-shadow: var(--card-shadow); border-radius: 28px; padding: 2rem; width: 100%; transition: background 0.3s ease; }
        .input-group-custom { position: relative; margin-bottom: 1rem; }

        .custom-input { width: 100%; padding: 12px 15px 12px 42px; border-radius: 10px; background: var(--input-bg); border: 1px solid transparent; color: var(--input-text); font-size: 0.9rem; font-weight: 500; transition: all 0.2s; }
        .custom-input::placeholder { color: var(--input-placeholder); }

        /* Orange Focus Ring */
        .custom-input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(191, 0, 255, 0.25);
            border-color: #3e1463;
        }
        .input-icon { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: var(--input-placeholder); font-size: 1rem; z-index: 5; }

        /* Buttons */
        .btn-action { background-color: var(--btn-bg); color: var(--btn-text); font-weight: 600; padding: 12px; border-radius: 10px; border: none; width: 100%; margin-top: 1rem; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); transition: all 0.2s; }
        .btn-action:hover { background-color: var(--btn-hover); transform: translateY(-2px); }

        .btn-prev { background: rgba(255, 255, 255, 0.15); color: var(--text-main); font-weight: 600; padding: 12px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.4); width: 100%; margin-top: 0.5rem; transition: all 0.2s; }
        .btn-prev:hover { background: rgba(255, 255, 255, 0.25); }

        /* Review Section Styling */
        .review-box { background: var(--review-bg); border-radius: 12px; padding: 15px; margin-bottom: 15px; text-align: left; }
        .review-label { font-size: 0.75rem; color: var(--text-main); opacity: 0.7; margin-bottom: 2px; text-transform: uppercase; letter-spacing: 0.5px; }
        .review-value { font-size: 0.95rem; font-weight: 600; color: var(--text-main); margin-bottom: 10px; }
    </style>
</head>

<body>
    <ul class="circles"><li></li><li></li><li></li><li></li><li></li><li></li></ul>

    <a href="{{ url('/hr-login') }}" class="nav-btn back-btn"><i class="fas fa-arrow-left"></i></a>

    <button onclick="toggleTheme()" class="nav-btn theme-btn">
        <i id="theme-icon" class="bi bi-moon"></i>
    </button>

    <div class="auth-container">
        <div class="icon-box"><i class="fas fa-user-plus"></i></div>

        <h2 class="fw-bold mb-1" id="page-title">Create Account</h2>
        <p class="opacity-75 mb-4 text-center" id="page-subtitle">Join thousands of learners and educators</p>

        <div class="steps-container">
            <div class="step active" id="step-1-indicator">1</div>
            <div class="step-line"></div>
            <div class="step" id="step-2-indicator">2</div>
            <div class="step-line"></div>
            <div class="step" id="step-3-indicator">3</div>
        </div>

        <form action="#" method="POST" id="main-register-form">
            <div id="step-1-form">
                @include('frontend.mentorPortal.auth.registerLayouts.step1')
            </div>

            <div id="step-2-form" style="display: none;">
                @include('frontend.mentorPortal.auth.registerLayouts.step2')
            </div>

            <div id="step-3-form" style="display: none;">
                @include('frontend.mentorPortal.auth.registerLayouts.step3')
            </div>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // --- STEP SWITCHING LOGIC ---
        function switchStep(step) {
            document.getElementById('step-1-form').style.display = 'none';
            document.getElementById('step-2-form').style.display = 'none';
            document.getElementById('step-3-form').style.display = 'none';

            document.getElementById('step-1-indicator').classList.remove('active');
            document.getElementById('step-2-indicator').classList.remove('active');
            document.getElementById('step-3-indicator').classList.remove('active');

            document.getElementById('step-' + step + '-form').style.display = 'block';
            for(let i=1; i<=step; i++) {
                document.getElementById('step-' + i + '-indicator').classList.add('active');
            }

            const title = document.getElementById('page-title');
            const sub = document.getElementById('page-subtitle');
            if(step === 1) { title.innerText = "Create Account"; sub.innerText = "Join thousands of learners and educators"; }
            else if(step === 2) { title.innerText = "Additional Info"; sub.innerText = "Tell us more about yourself"; }
            else if(step === 3) { title.innerText = "Review & Submit"; sub.innerText = "Review your information before submitting"; populateReview(); }
        }

        // Initialize to step 1
        switchStep(1);

        // --- REVIEW DATA POPULATION ---
        function populateReview() {
            const getVal = (id) => { const el = document.getElementById(id); return (el && el.value) ? el.value : '-'; };
            // Note: Ensure your step1/step2 forms have matching IDs for these
            if(document.getElementById('review-name')) document.getElementById('review-name').innerText = getVal('fname') + ' ' + getVal('lname');
            if(document.getElementById('review-email')) document.getElementById('review-email').innerText = getVal('email');
            if(document.getElementById('review-phone')) document.getElementById('review-phone').innerText = getVal('phone');
            if(document.getElementById('review-country')) document.getElementById('review-country').innerText = getVal('country');

            const noCodeEl = document.getElementById('no-institution-code');
            const noCode = noCodeEl ? noCodeEl.checked : false;
            if(document.getElementById('review-code')) document.getElementById('review-code').innerText = noCode ? "Individual/Other" : getVal('institution_code');

            if(document.getElementById('review-institution')) document.getElementById('review-institution').innerText = getVal('institution_name');
            if(document.getElementById('review-skills')) document.getElementById('review-skills').innerText = getVal('skills');
            if(document.getElementById('review-goals')) document.getElementById('review-goals').innerText = getVal('goals');
        }

        // --- THEME TOGGLE LOGIC ---
        const body = document.body;
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
