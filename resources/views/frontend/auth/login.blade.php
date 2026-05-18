@php
    $config = config("roles.$role");
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>{{ $config['title'] }} - Login | KickStartSkills</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
:root {
    /* ✅ REAL gradients (NOT var(--blue)) */
    --blue: linear-gradient(135deg, #316adc 0%, #5331dc 100%);
    --red: linear-gradient(135deg, #f83f3f 0%, #621515 100%);
    --purple: linear-gradient(135deg, #8e1df0 0%, #a800e0 100%);
    --orange: linear-gradient(135deg, #ff9a44 0%, #ff4500 100%);
    --green: linear-gradient(135deg, #099B6D 0%, #05805C 100%);

    /* ✅ THIS FIXES YOUR BACKGROUND */
    --bg-gradient: var(--{{ $config['theme'] }});

    --text-main: #ffffff;
    --text-muted: rgba(255,255,255,0.8);

    --card-bg: rgba(255,255,255,0.15);
    --card-border: rgba(255,255,255,0.3);

    --input-bg: rgba(255,255,255,0.9);
    --input-text: #1e293b;

    --btn-bg: var(--btn-{{ $role }});
--btn-hover: brightness(0.9);

    --btn-admin: #dc2626;
--btn-hr: #9333ea;
--btn-mentor: #f97316;
--btn-institution: #059669;
--btn-student: #2563eb;

--accent-admin: #dc2626;
--accent-hr: #9333ea;
--accent-mentor: #f97316;
--accent-institution: #059669;
--accent-student: #2563eb;

--accent: var(--accent-{{ $role }});

    --circle-color-1: rgba(255,255,255,0.15);
    --circle-color-2: rgba(255,255,255,0.1);
    --circle-color-3: rgba(255,255,255,0.05);
}

/* ✅ REAL DARK MODE (NOT FILTER) */
body.dark-mode {
    --bg-gradient: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);

    --text-main: #f5f5f5;
    --text-muted: #94a3b8;

    --card-bg: rgba(30, 41, 59, 0.7);
    --card-border: rgba(255,255,255,0.1);

    --input-bg: rgba(15, 23, 42, 0.6);
    --input-border: #334155;
    --input-text: #fff;

    --btn-bg: var(--btn-{{ $role }});
    --btn-hover: brightness(0.9);

    /* 🔥 circle colors */
    --circle-color-1: rgba(70,150,255,0.1);
    --circle-color-2: rgba(70,255,150,0.05);
    --circle-color-3: rgba(255,165,0,0.05);
}

body {
    font-family: 'Inter', sans-serif;
    background: var(--bg-gradient);
    color: var(--text-main);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    overflow-x: hidden;
    padding: 2rem 0;
}

/* 🔥 YOUR ORIGINAL CIRCLES */
@keyframes animate {
    0% { transform: translateY(0) rotate(0deg); opacity: 1; }
    100% { transform: translateY(-1000px) rotate(720deg); opacity: 0; }
}

.circles {
    position: fixed;
    width: 100%;
    height: 100%;
    z-index: 0;
}

.circles li {
    position: absolute;
    list-style: none;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: rgba(255,255,255,0.15);
    animation: animate 25s linear infinite;
    bottom: -150px;
}

/* KEEP YOUR POSITIONS */
.circles li:nth-child(1){left:25%;width:80px;height:80px;}
.circles li:nth-child(2){left:10%;animation-delay:2s;}
.circles li:nth-child(3){left:70%;animation-delay:4s;}
.circles li:nth-child(4){left:40%;width:60px;height:60px;}
.circles li:nth-child(5){left:65%;}
.circles li:nth-child(6){left:75%;width:110px;height:110px;}
.circles li:nth-child(7){left:35%;width:150px;height:150px;}
.circles li:nth-child(8){left:50%;animation-delay:15s;}
.circles li:nth-child(9){left:20%;}
.circles li:nth-child(10){left:85%;width:150px;height:150px;}

.login-container {
    width: 100%;
    max-width: 420px;
    z-index: 10;
}

.login-card {
    background: var(--card-bg);
    backdrop-filter: blur(20px);
    border: 1px solid var(--card-border);
    border-radius: 24px;
    padding: 2.5rem;
}

.logo-box {
    width: 54px;
    height: 54px;
    background: rgba(255,255,255,0.25);
    border: 1px solid rgba(255,255,255,0.25);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--accent);
    box-shadow: 0 0 20px rgba(255,255,255,0.1),
    0 0 20px var(--accent);
}
.logo-box i {
    font-size: 1.4rem;
    color: #fff;
}

/* ✅ Dark mode → role color */
body.dark-mode .logo-box i {
    color: var(--accent);
}

.input-wrapper { position: relative; margin-bottom: 1.2rem; }

.input-icon {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #64748b;
    z-index: 5;
}

.custom-input {
    width: 100%;
    padding: 12px 15px 12px 42px;
    border-radius: 10px;
    background: var(--input-bg);
    color: var(--input-text);
    border: none;
}

.btn-login {
    background: var(--btn-bg);
    color: #fff;
    padding: 12px;
    border: none;
    border-radius: 12px;
    width: 100%;
    font-weight: 600;
    transition: 0.2s;
}

.btn-login:hover {
    filter: brightness(0.9);
}

.text-muted-custom {
    color: rgba(255,255,255,0.75);
}

.form-check-label,
.small {
    color: var(--text-muted);
}

.theme-toggle {
    position: absolute;
    top: 25px;
    right: 25px;
    cursor: pointer;
}
.password-toggle {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #64748b;
}

.link-custom {
    color: #ffffff;
    font-weight: 600;
    text-decoration: none;
}

.link-custom:hover {
    color: #e0e7ff;
    text-decoration: underline;
}
</style>
</head>

<body id="app-body">

<ul class="circles">
@for ($i = 0; $i < 10; $i++)
<li></li>
@endfor
</ul>

<div class="theme-toggle">
<i id="theme-icon" class="bi bi-moon" onclick="toggleTheme()"></i></div>

<div class="login-container">

<div class="text-center mb-4">
    <div class="logo-box mx-auto mb-2">
    <i class="bi {{ $config['icon'] }}"></i>    </div>

    <h2 class="fw-bold">KickStartSkills</h2>
    <p class="text-muted-custom">{{ $config['subtitle'] }}</p>
</div>

<div class="login-card">

<div class="text-center mb-4">
    <h4 class="fw-bold">{{ $config['heading'] }}</h4>
    <p class="text-muted-custom small">{{ $config['description'] }}</p>
</div>

<form method="POST" action="{{ route('login.submit', $role) }}">
@csrf

@if($errors->any())
<div class="alert alert-danger small">
    {{ $errors->first() }}
</div>
@endif

<label class="small text-muted-custom">Email address</label>
<div class="input-wrapper">
    <i class="bi bi-envelope input-icon"></i>
    <input type="email" name="email" class="custom-input"
        placeholder="{{ $role }}@kickstartskills.com" required>
</div>

<label class="small text-muted-custom">Password</label>
<div class="input-wrapper">
    <i class="bi bi-lock input-icon"></i>

    <input type="password" id="password" name="password" class="custom-input" required>

    <button type="button" class="password-toggle" onclick="togglePassword()">
        <i id="eye-icon" class="bi bi-eye"></i>
    </button>
</div>

<div class="d-flex justify-content-between mb-3">
    <div>
        <input type="checkbox" name="remember"> <span class="small">Remember me</span>
    </div>

    <a href="{{ route('forgot.password', ['portal' => $role]) }}" class="small text-white">
        Forgot password?
    </a>
</div>

<button class="btn-login">
    Sign in to {{ ucfirst($role) }} Portal
</button>

@if(!in_array($role, ['admin', 'hr']))
<div class="text-center mt-4">
    <p class="small text-muted-custom mb-0">
        Don't have an account?
        <a href="{{ route($role . '.register') }}" class="link-custom ms-1">
            Sign up as {{ ucfirst($role) }}
        </a>
    </p>
</div>
@endif

</form>

</div>
</div>

<script>
function toggleTheme() {
    document.body.classList.toggle('dark-mode');

    const icon = document.getElementById('theme-icon');

    if (document.body.classList.contains('dark-mode')) {
        icon.className = 'bi bi-sun';
    } else {
        icon.className = 'bi bi-moon';
    }
}
function togglePassword() {
    const input = document.getElementById('password');
    const icon = document.getElementById('eye-icon');

    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('bi-eye-slash', 'bi-eye');
    }
}
</script>

</body>
</html>
