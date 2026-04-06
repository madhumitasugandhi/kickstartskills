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
        /* (Bhai, tera pura CSS yahan same rahega as it is) */
        :root {
            --bg-gradient: linear-gradient(135deg, #4facfe 0%, #0094fe 100%);
            --text-main: #ffffff;
            --card-bg: rgba(255, 255, 255, 0.15);
            --card-border: rgba(255, 255, 255, 0.3);
            --card-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);
            --input-bg: rgba(255, 255, 255, 0.9);
            --input-text: #1e293b;
            --input-placeholder: #64748b;
            --btn-bg: #2563eb;
            --btn-hover: #1d4ed8;
            --btn-text: #ffffff;
            --circle-color-1: rgba(255, 255, 255, 0.15);
        }

        body.dark-mode {
            --bg-gradient: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            --text-main: #f8fafc;
            --card-bg: rgba(30, 41, 59, 0.7);
            --card-border: rgba(255, 255, 255, 0.1);
            --card-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
            --input-bg: rgba(15, 23, 42, 0.6);
            --input-text: #f1f5f9;
            --input-placeholder: #94a3b8;
            --btn-bg: #3b82f6;
            --btn-hover: #60a5fa;
            --circle-color-1: rgba(70, 150, 255, 0.1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-gradient);
            color: var(--text-main);
            min-height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 15px;
            transition: background 0.5s ease;
        }

        .circles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;
            padding: 0;
            margin: 0;
        }

        .circles li {
            position: absolute;
            display: block;
            list-style: none;
            width: 20px;
            height: 20px;
            background: var(--circle-color-1);
            animation: animate 25s linear infinite;
            bottom: -150px;
        }

        /* ... Animation keyframes and circles li nth-childs ... */
        @keyframes animate {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
                border-radius: 50%;
            }

            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0;
                border-radius: 50%;
            }
        }

        .nav-btn {
            position: absolute;
            top: 25px;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            border: none;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(4px);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            z-index: 50;
            text-decoration: none;
        }

        .nav-btn:hover {
            background: rgba(255, 255, 255, 0.35);
            transform: scale(1.05);
            color: white;
        }

        .back-btn {
            left: 25px;
        }

        .theme-btn {
            right: 25px;
        }

        .auth-container {
            width: 100%;
            max-width: 460px !important;
            padding: 15px;
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .icon-box {
            width: 64px;
            height: 64px;
            background: #3b82f6;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            color: #fff;
            margin-bottom: 1.5rem;
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
        }

        .steps-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 2rem;
        }

        .step {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: rgba(255, 255, 255, 0.7);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .step.active {
            background: #3b82f6;
            border-color: #3b82f6;
            color: white;
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.5);
            transform: scale(1.1);
        }

        .step-line {
            width: 40px;
            height: 2px;
            background: rgba(255, 255, 255, 0.2);
        }

        .glass-card {
            background: var(--card-bg);
            backdrop-filter: blur(24px);
            border: 1px solid var(--card-border);
            box-shadow: var(--card-shadow);
            border-radius: 28px;
            padding: 2.5rem 2rem !important;
            width: 100%;
            text-align: center;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #4b5563 !important;
            font-size: 1.1rem;
            z-index: 5;
            opacity: 1;
        }

        body.dark-mode .input-icon {
            color: #cbd5e1 !important;
        }

        .custom-input:focus+.input-icon {
            color: var(--btn-bg) !important;
            opacity: 1;
        }

        .input-group-custom {
            position: relative;
            text-align: left;
        }

        .custom-input {
            width: 100%;
            padding: 14px 15px 14px 46px;
            border-radius: 12px;
            background: var(--input-bg);
            border: 1px solid transparent;
            color: var(--input-text);
            font-size: 0.95rem;
        }

        .btn-action {
            background-color: var(--btn-bg);
            color: var(--btn-text);
            font-weight: 600;
            padding: 14px;
            border-radius: 12px;
            width: 100%;
            margin-top: 1.5rem;
            border: none;
            cursor: pointer;
        }

        .link-back {
            color: var(--text-main);
            font-weight: 500;
            text-decoration: none;
            font-size: 0.9rem;
            display: inline-block;
            margin-top: 1.5rem;
            transition: opacity 0.2s;
            opacity: 0.8;
        }

        .link-back:hover {
            opacity: 1;
        }
    </style>
</head>

<body id="app-body">
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>

    <a  href="{{ route('student.login') }}" class="nav-btn back-btn">
        <i class="bi bi-arrow-left"></i>
    </a>

    <button onclick="toggleTheme()" class="nav-btn theme-btn">
        <i id="theme-icon" class="bi bi-moon"></i>
    </button>

    <div class="auth-container">
        <div class="icon-box"><i class="bi bi-shield-lock-fill"></i></div>

        <h2 class="fw-bold mb-2" id="page-title">Forgot Password?</h2>
        <p class="opacity-75 mb-4 text-center" style="max-width: 300px;" id="page-subtitle">
            Enter your email to receive a reset code
        </p>

        <div class="steps-container">
            <div class="step active" id="step-1-btn">1</div>
            <div class="step-line"></div>
            <div class="step" id="step-2-btn">2</div>
            <div class="step-line"></div>
            <div class="step" id="step-3-btn">3</div>
        </div>

        <div id="step-1-form">
            @include('frontend.studentPortal.auth.forgetPasswordLayouts.form1')
        </div>
        <div id="step-2-form" style="display: none;">
            @include('frontend.studentPortal.auth.forgetPasswordLayouts.form2')
        </div>
        <div id="step-3-form" style="display: none;">
            @include('frontend.studentPortal.auth.forgetPasswordLayouts.form3')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        // --- 1. STEP SWITCHING LOGIC (Missing was here) ---
        function switchStep(step) {
            // Hide all forms
            $('#step-1-form, #step-2-form, #step-3-form').hide();
            // Show target form
            $('#step-' + step + '-form').fadeIn();

            // Update Progress Steps UI
            $('.step').removeClass('active');
            $('#step-' + step + '-btn').addClass('active');

            // Update Text
            const title = $('#page-title');
            const sub = $('#page-subtitle');
            if (step === 1) {
                title.text("Forgot Password?");
                sub.text("Enter your email to receive a reset code");
            } else if (step === 2) {
                title.text("Verification");
                sub.text("Check your inbox for the 6-digit code");
            } else if (step === 3) {
                title.text("Reset Password");
                sub.text("Create a new secure password");
            }
        }

        // --- 2. AJAX LOGIC ---

        // Step 1: Send OTP
        $('#otp-send-form').on('submit', function(e) {
            e.preventDefault();
            let email = $('#reset-email').val();
            $('#send-otp-btn').prop('disabled', true).text('Sending...');

            $.post("{{ route('auth.password.sendOtp') }}", $(this).serialize(), function(res) {
                if (res.success) {
                    switchStep(2);
                } else {
                    alert(res.message);
                }
                $('#send-otp-btn').prop('disabled', false).text('Send Reset Code');
            });
        });

        // Step 2: Verify OTP
        $('#otp-verify-form').on('submit', function(e) {
            e.preventDefault();

            // Check if OTP is full
            if ($('#input-otp').val().length < 6) {
                alert("Please enter the full 6-digit code.");
                return;
            }

            let formData = $(this).serialize() + "&email=" + $('#reset-email').val();

            $.post("{{ route('auth.password.verifyOtp') }}", formData, function(res) {
                if (res.success) {
                    switchStep(3);
                } else {
                    alert(res.message);
                }
            });
        });

        // Step 3: Update Password
        $('#password-reset-final-form').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize() + "&email=" + $('#reset-email').val() + "&otp=" + $('#input-otp').val();

            $.post("{{ route('auth.password.update') }}", formData, function(res) {
                if (res.success) {
                    alert('Success! Your password has been changed.');
                    window.location.href = "{{ route('student.login') }}";
                } else {
                    alert(res.message || "Failed to reset password.");
                }
            });
        });
        $(document).ready(function() {
            const inputs = $('.otp-box');

            // Auto-focus and Value gathering
            inputs.on('input', function() {
                const val = $(this).val();

                // Agle box pe jao
                if (val && $(this).next().length) {
                    $(this).next().focus();
                }

                // Saare boxes ko jod kar hidden input mein dalo
                let fullOtp = "";
                inputs.each(function() {
                    fullOtp += $(this).val();
                });
                $('#input-otp').val(fullOtp);

                console.log("Current OTP gathered:", fullOtp); // Debugging ke liye console dekho
            });

            // Backspace support
            inputs.on('keydown', function(e) {
                if (e.key === 'Backspace' && !$(this).val() && $(this).prev().length) {
                    $(this).prev().focus();
                }
            });
        });

        // --- THEME TOGGLE ---
        function toggleTheme() {
            $('#app-body').toggleClass('dark-mode');
            const isDark = $('#app-body').hasClass('dark-mode');
            $('#theme-icon').attr('class', isDark ? 'bi bi-sun' : 'bi bi-moon');
        }

    </script>
</body>

</html>
