@php
    $themes = [
        'student' => ['bg' => '#099B6D', 'btn' => '#059166'],
        'admin' => ['bg' => '#2563eb', 'btn' => '#1d4ed8'],
        'mentor' => ['bg' => '#7c3aed', 'btn' => '#6d28d9'],
        'hr' => ['bg' => '#ea580c', 'btn' => '#c2410c'],
        'institution' => ['bg' => '#059669', 'btn' => '#047857'],
    ];

    $theme = $themes[$portal] ?? $themes['student'];
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Forgot Password | KickStartSkills</title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
:root {
    --bg-gradient: linear-gradient(135deg, {{ $theme['bg'] }} 0%, {{ $theme['bg'] }} 100%);
    --btn-bg: {{ $theme['btn'] }};
    --text-main: #ffffff;
    --card-bg: rgba(255, 255, 255, 0.15);
    --card-border: rgba(255, 255, 255, 0.3);
    --input-bg: rgba(255, 255, 255, 0.9);
    --input-text: #1e293b;
    --input-placeholder: #64748b;
}

body {
    font-family: 'Inter', sans-serif;
    background: var(--bg-gradient);
    color: var(--text-main);
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
}

.glass-card {
    background: var(--card-bg);
    backdrop-filter: blur(20px);
    border: 1px solid var(--card-border);
    border-radius: 20px;
    padding: 2rem;
}

.custom-input {
    width: 100%;
    padding: 12px 15px 12px 40px;
    border-radius: 10px;
    background: var(--input-bg);
    border: none;
}

.input-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
}

.btn-action {
    background: var(--btn-bg);
    color: white;
    padding: 12px;
    border-radius: 10px;
    border: none;
    width: 100%;
    margin-top: 15px;
}

.auth-wrapper {
    width: 100%;
    max-width: 420px;
    position: relative;
}

.auth-card {
    background: var(--card-bg);
    backdrop-filter: blur(25px);
    border-radius: 24px;
    padding: 2.5rem 2rem;
    text-align: center;
    border: 1px solid var(--card-border);
}

.icon-box {
    width: 60px;
    height: 60px;
    background: var(--btn-bg);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: auto;
    font-size: 1.5rem;
}

.back-btn {
    position: absolute;
    top: 30px;
    left: 20px;
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(6px);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    transition: 0.2s;
    z-index: 10;
}

.back-btn:hover {
    background: rgba(255,255,255,0.35);
    transform: scale(1.05);
}

.steps {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 20px 0;
}

.step {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    border: 2px solid white;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0.5;
}

.step.active {
    background: var(--btn-bg);
    opacity: 1;
}

.line {
    width: 40px;
    height: 2px;
    background: white;
    opacity: 0.3;
}

.otp-container {
    display: flex;
    justify-content: center;   /* center align */
    gap: 6px;
    flex-wrap: nowrap;
    width: auto;
}

.otp-input {
    width: calc(100% / 6 - 6px);  /* 🔥 dynamic width */
    max-width: 45px;
    height: 50px;
    font-size: 18px;
    text-align: center;
    border-radius: 10px;
    border: none;
    background: var(--input-bg);
}

@media(max-width: 420px){
    .otp-input {
        width: 38px;
        height: 48px;
        font-size: 16px;
    }
}

.otp-input:focus {
    outline: none;
    box-shadow: 0 0 0 2px var(--btn-bg);
}
</style>
</head>

<body>

<div class="auth-wrapper">

    <!-- BACK -->
    <div class="d-flex align-items-center mb-3">
    <a href="{{ url('/'.$portal.'-login') }}" class="back-btn">
        <i class="bi bi-arrow-left"></i>
    </a>
    </div>

    <!-- CARD -->
    <div class="auth-card">

        <!-- ICON -->
        <div class="icon-box">
            <i class="bi bi-shield-lock"></i>
        </div>

        <!-- TITLE -->
        <h3 id="title">Forgot Password</h3>
        <p id="subtitle">Enter your email to receive a code</p>

        <!-- STEPS -->
        <div class="steps">
            <div class="step active" id="s1">1</div>
            <div class="line"></div>
            <div class="step" id="s2">2</div>
            <div class="line"></div>
            <div class="step" id="s3">3</div>
        </div>

        <!-- FORMS -->
        <div id="step1">@include('frontend.auth.components.form1')</div>
        <div id="step2" style="display:none;">@include('frontend.auth.components.form2')</div>
        <div id="step3" style="display:none;">@include('frontend.auth.components.form3')</div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
let userEmail = null;

function showStep(step) {
    ['step1','step2','step3'].forEach(id => {
        document.getElementById(id).style.display = 'none';
    });

    if(step === 2){
        setTimeout(() => inputs[0].focus(), 200);
    }
    document.getElementById('step'+step).style.display = 'block';

    document.querySelectorAll('.step').forEach(s => s.classList.remove('active'));
    document.getElementById('s'+step).classList.add('active');

    const titles = [
        "Forgot Password",
        "Verify OTP",
        "Reset Password"
    ];

    const subtitles = [
        "Enter your email to receive a code",
        "Check your email for OTP",
        "Create a new password"
    ];

    document.getElementById('title').innerText = titles[step-1];
    document.getElementById('subtitle').innerText = subtitles[step-1];
}

// SEND OTP
async function sendOtp(e) {
    e.preventDefault();

    const btn = document.getElementById('sendBtn');
    const loader = document.getElementById('sendLoader');
    const text = document.getElementById('sendText');

    // START LOADING
    loader.classList.remove('d-none');
    text.innerText = "Sending...";
    btn.disabled = true;

    const email = document.getElementById('email').value;

    try {
        const res = await fetch('/auth/password/send-otp', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ email, portal: "{{ $portal }}" })
        });

        const data = await res.json();

        if (data.status === 'success') {
            userEmail = email;
            Swal.fire('Success','OTP Sent','success');
            showStep(2);
        } else {
            Swal.fire('Error',data.message,'error');
        }

    } catch (err) {
        Swal.fire('Error','Something went wrong','error');
    }

    // STOP LOADING
    loader.classList.add('d-none');
    text.innerText = "Send Code";
    btn.disabled = false;
} 

// VERIFY OTP
async function verifyOtp(e) {
    e.preventDefault();

    const otp = document.getElementById('otp').value;

    const res = await fetch('/auth/password/verify-otp', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ email: userEmail, otp, portal: "{{ $portal }}" })
    });

    const data = await res.json();

    if (data.status === 'success') {
        Swal.fire('Verified','','success');
        showStep(3);
    } else {
        Swal.fire('Error',data.message,'error');
    }
}

// RESET PASSWORD
async function resetPassword(e) {
    e.preventDefault();

    const password = document.getElementById('password').value;
    const confirm = document.getElementById('confirm_password').value;

    if(password !== confirm){
        Swal.fire('Error','Passwords do not match','error');
        return;
    }

    const res = await fetch('/auth/password/update', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            email: userEmail,
            password,
            password_confirmation: confirm,
            portal: "{{ $portal }}"
        })
    });

    const data = await res.json();

    if (data.status === 'success') {
        Swal.fire('Success','Password Reset','success')
        .then(()=> window.location.href = "/{{ $portal }}-login");
    } else {
        Swal.fire('Error',data.message,'error');
    }
}

const inputs = document.querySelectorAll('.otp-input');

inputs.forEach((input, index) => {

    input.addEventListener('input', (e) => {
        if (e.target.value.length === 1 && inputs[index + 1]) {
            inputs[index + 1].focus();
        }
        updateOtp();
    });

    input.addEventListener('keydown', (e) => {
        if (e.key === "Backspace" && !input.value && inputs[index - 1]) {
            inputs[index - 1].focus();
        }
    });

});

// paste support 🔥
inputs[0].addEventListener('paste', function(e) {
    const paste = e.clipboardData.getData('text').trim();

    if(paste.length === 6){
        inputs.forEach((input, i) => {
            input.value = paste[i] || '';
        });
        updateOtp();
    }
});

function updateOtp(){
    let otp = '';
    inputs.forEach(i => otp += i.value);
    document.getElementById('otp').value = otp;
}
</script>

</body>
</html>