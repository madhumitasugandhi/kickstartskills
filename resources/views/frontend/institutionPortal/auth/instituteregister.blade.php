<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institution Registration | KickStartSkills</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ------------------ THEME CONFIGURATION ------------------ */
        :root {
            /* LIGHT MODE (Vibrant Blue) */
            --bg-gradient: linear-gradient(135deg, #099B6D 0%, #0a966d 100%);
            --text-main: #ffffff;
            --card-bg: rgba(255, 255, 255, 0.15);
            --card-border: rgba(255, 255, 255, 0.3);
            --card-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);
            --input-bg: rgba(255, 255, 255, 0.9);
            --input-text: #1e293b;
            --input-placeholder: #64748b;
            --btn-bg: #059166;
            --btn-hover: #1A9E75;
            --btn-text: #ffffff;
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
            --btn-bg: #059166;
            --btn-hover: #1A9E75;
            --review-bg: rgba(255, 255, 255, 0.05);
            --circle-color-1: rgba(70, 150, 255, 0.1);
        }

        /* ------------------ BASE STYLES ------------------ */
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-gradient);
            color: var(--text-main);
            height: auto;
            min-height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: flex-start;
            padding-top: 80px;
            padding-bottom: 40px;
            transition: background 0.5s ease;
        }

        /* Bubbles Animation */
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

        .circles li:nth-child(1) {
            left: 25%;
            width: 80px;
            height: 80px;
            animation-delay: 0s;
        }

        .circles li:nth-child(2) {
            left: 10%;
            width: 20px;
            height: 20px;
            animation-delay: 2s;
            animation-duration: 12s;
        }

        .circles li:nth-child(3) {
            left: 70%;
            width: 20px;
            height: 20px;
            animation-delay: 4s;
        }

        .circles li:nth-child(4) {
            left: 40%;
            width: 60px;
            height: 60px;
            animation-delay: 0s;
            animation-duration: 18s;
        }

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

        /* UI Components */
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

        .icon-box {
            width: 64px;
            height: 64px;
            background: #059166;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            color: #fff;
            margin-bottom: 1rem;
            /* box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4); */
        }

        /* Steps Indicator */
        .steps-container {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(28px);
            -webkit-backdrop-filter: blur(28px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            padding: 12px 25px;
            border-radius: 20px;
            width: 100%;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
            flex-wrap: wrap;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            margin-bottom: 2rem;
        }

        @media (max-width: 400px) {
            .step-line {
                width: 20px;
                /* Shorter lines on mobile */
            }

            .step {
                width: 28px;
                height: 28px;
                font-size: 0.8rem;
            }
        }

        /* ---------------------------------------------------
   MAKE AUTH-CONTAINER SCROLLABLE
--------------------------------------------------- */
        .auth-container {
            padding: 15px;
            width: 100%;
            max-width: 550px;
            padding: 10px;
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;

        }


        /* ---------------------------------------------------
   MAKE MAIN REGISTER FORM SCROLL-Y (long forms)
--------------------------------------------------- */
        #main-register-form {
            max-height: 100vh;
            padding-right: 8px;
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
            cursor: default;
            transition: all 0.3s ease;
        }

        .step.active {
            background: #059166;
            border-color: #059166;
            color: white;
            /* box-shadow: 0 0 15px rgba(59, 130, 246, 0.5); */
            transform: scale(1.1);
        }

        .step-line {
            width: 40px;
            height: 2px;
            background: rgba(255, 255, 255, 0.2);
        }

        /* Form Styles */
        .glass-card {
            background: var(--card-bg);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid var(--card-border);
            box-shadow: var(--card-shadow);
            border-radius: 28px;
            padding: 2rem;
            width: 100%;
            transition: background 0.3s ease;
            animation: slideIn 0.4s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Fix: Form fields often look squashed on mobile */
        @media (max-width: 576px) {
            .glass-card {
                padding: 1.5rem 1rem;
                border-radius: 20px;
            }

            h2 {
                font-size: 1.5rem;
            }
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 1rem;
        }

        .custom-input {
            width: 100%;
            padding: 12px 15px 12px 42px;
            border-radius: 10px;
            background: var(--input-bg);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: var(--input-text);
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .custom-input::placeholder {
            color: var(--input-placeholder);
        }

        .custom-input:focus {
            outline: none;
            background: #ffffff;
            border-color: #059166;
            box-shadow: 0 0 0 4px rgba(5, 145, 102, 0.25);
            color: #1e293b;
        }

        body.dark-mode .custom-input:focus {
            background: rgba(15, 23, 42, 0.8);
            color: #fff;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--input-placeholder);
            font-size: 1rem;
            z-index: 5;
        }

        /* Buttons */
        .btn-action {
            background-color: var(--btn-bg);
            color: var(--btn-text);
            font-weight: 600;
            padding: 12px;
            border-radius: 10px;
            border: none;
            width: 100%;
            margin-top: 0.5rem;
            /* box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3); */
            transition: all 0.2s;
        }

        .btn-action:hover {
            background-color: var(--btn-hover);
            transform: translateY(-2px);
        }

        .btn-prev {
            background: rgba(255, 255, 255, 0.1);
            color: var(--text-main);
            font-weight: 600;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            width: 100%;
            margin-top: 0.5rem;
            transition: all 0.2s;
        }

        .btn-prev:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Review Section Styling */
        .review-box {
            background: var(--review-bg);
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
            text-align: left;
        }

        .review-label {
            font-size: 0.75rem;
            color: var(--text-main);
            opacity: 0.6;
            margin-bottom: 2px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .review-value {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 10px;
        }

        .field-error {
            font-size: 0.8rem;
            color: #ff6b6b;
            margin-top: 4px;
            padding-left: 2px;
        }

        .input-error {
            border: 1px solid #ff6b6b !important;
            box-shadow: 0 0 0 2px rgba(255, 107, 107, 0.25) !important;
        }
    </style>
</head>

<body>

    <div class="container position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index:9999">

        @if(session('success'))
        <div class="alert alert-success shadow">
            {{ session('success') }}
        </div>
        @endif

    </div>
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>

    <a href="{{ url('/institution-login') }}" class="nav-btn back-btn"><i class="fas fa-arrow-left"></i></a>

    <button onclick="toggleTheme()" class="nav-btn theme-btn">
        <i id="theme-icon" class="bi bi-moon"></i>
    </button>

    <div class="auth-container">
        <div class="icon-box"><i class="fas fa-university"></i></div>

        <h2 class="fw-bold mb-1" id="page-title">Institution Registration</h2>
        <p class="opacity-75 mb-4 text-center" id="page-subtitle">Join KickStartSkills to empower your students</p>

        <div class="steps-container">
            <div class="step active" id="step-1-indicator">1</div>
            <div class="step-line"></div>
            <div class="step" id="step-2-indicator">2</div>
            <div class="step-line"></div>
            <div class="step" id="step-3-indicator">3</div>
            <div class="step-line"></div>
            <div class="step" id="step-4-indicator">4</div>
        </div>

        <form action="{{ route('institution.register') }}" method="POST" id="main-register-form">
            @csrf
            <div id="step-1-form">
                @include('frontend.institutionPortal.auth.register.form1')
            </div>

            <div id="step-2-form" style="display: none;">
                @include('frontend.institutionPortal.auth.register.form2')
            </div>

            <div id="step-3-form" style="display: none;">
                @include('frontend.institutionPortal.auth.register.form3')
            </div>
            <div id="step-4-form" style="display: none;">
                @include('frontend.institutionPortal.auth.register.form4')
            </div>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // --- GLOBAL STATE ---
        let currentStep = 1;
        const body = document.body;
        const themeIcon = document.getElementById('theme-icon');

        function switchStep(step) {
            if (step < 1 || step > 4) return;

            currentStep = step;

            // 1. Update Visibility with smooth fade
            for (let i = 1; i <= 4; i++) {
                const form = document.getElementById('step-' + i + '-form');
                const indicator = document.getElementById('step-' + i + '-indicator');

                if (i === step) {
                    form.style.display = 'block';
                    // Trigger reflow for animation
                    form.offsetHeight;
                    form.style.opacity = '1';
                } else {
                    form.style.display = 'none';
                    form.style.opacity = '0';
                }

                // 2. Update Indicators (Highlight all completed steps)
                if (i <= step) {
                    indicator.classList.add('active');
                } else {
                    indicator.classList.remove('active');
                }
            }

            // 3. Update Titles & Subtitles
            const title = document.getElementById('page-title');
            const sub = document.getElementById('page-subtitle');

            const content = {
                1: {
                    t: "Institution Registration",
                    s: "Join KickStartSkills to empower your students"
                },
                2: {
                    t: "Contact & Location",
                    s: "How can we reach your institution?"
                },
                3: {
                    t: "Registration Details",
                    s: "Regulatory information and accreditation"
                },
                4: {
                    t: "Review & Submit",
                    s: "Please verify your details before finishing"
                }
            };

            title.innerText = content[step].t;
            sub.innerText = content[step].s;

            // 4. Populate Review Data if on last step
            if (step === 4) populateReview();

            // 5. UX: Scroll to top on mobile so they see the new header
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // --- STEP SWITCHING LOGIC ---
        function nextStep() {
            switchStep(currentStep + 1);
        }

        function prevStep() {
            switchStep(currentStep - 1);
        }

        /**
         * Review Data Population
         */
        function populateReview() {
            const getVal = (id) => {
                const el = document.getElementById(id);
                return (el && el.value) ? el.value : '-';
            };

            // Standard Fields
            const reviewMapping = {
                'review-name': getVal('fname') + ' ' + getVal('lname'),
                'review-email': getVal('email'),
                'review-phone': getVal('phone'),
                'review-country': document.getElementById('country')?.options[document.getElementById('country').selectedIndex]?.text || '-',
                'review-institution': getVal('institution_name'),
                'review-skills': getVal('skills'),
                'review-goals': getVal('goals')
            };

            for (const [id, val] of Object.entries(reviewMapping)) {
                const el = document.getElementById(id);
                if (el) el.innerText = val;
            }

            // Special Case: Institution Code
            const noCode = document.getElementById('no-institution-code')?.checked;
            const codeEl = document.getElementById('review-code');
            if (codeEl) codeEl.innerText = noCode ? "Individual/Other" : getVal('institution_code');
        }

        /**
         * Theme Toggle
         */
        function toggleTheme() {
            body.classList.toggle('dark-mode');
            themeIcon.className = body.classList.contains('dark-mode') ? 'bi bi-sun' : 'bi bi-moon';
        }

        /**
         * Dynamic Country/State/City Logic
         */
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize UI
            switchStep(1);

            const countryDropdown = document.getElementById('country');
            const stateDropdown = document.getElementById('state');
            const cityDropdown = document.getElementById('city');

            countryDropdown?.addEventListener('change', function() {
                fetch(`/api/states/${this.value}`)
                    .then(res => res.json())
                    .then(states => {
                        stateDropdown.innerHTML = '<option value="">Select State</option>';
                        cityDropdown.innerHTML = '<option value="">Select City</option>';
                        states.forEach(s => {
                            stateDropdown.innerHTML += `<option value="${s.id}">${s.name}</option>`;
                        });
                    });
            });

            stateDropdown?.addEventListener('change', function() {
                fetch(`/api/cities/${this.value}`)
                    .then(res => res.json())
                    .then(cities => {
                        cityDropdown.innerHTML = '<option value="">Select City</option>';
                        cities.forEach(c => {
                            cityDropdown.innerHTML += `<option value="${c.id}">${c.name}</option>`;
                        });
                    });
            });

            // Registration Button / Terms Logic
            const termsCheckbox = document.getElementById("terms_accepted");
            const registerBtn = document.getElementById("registerBtn");
            const mainForm = document.getElementById("main-register-form");

            if (termsCheckbox && registerBtn) {
                termsCheckbox.addEventListener("change", function() {
                    registerBtn.disabled = !this.checked;
                    registerBtn.style.opacity = this.checked ? "1" : "0.5";
                });
            }

            // Add Loading State on final submit
            mainForm?.addEventListener('submit', function() {
                registerBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span> Processing...`;
                registerBtn.style.pointerEvents = 'none';
            });

            document.querySelectorAll(".custom-input").forEach(input => {
                input.addEventListener("input", () => {
                    input.classList.remove("input-error");
                });
            });
        });

        function showError(input, errorId, message) {

            input.classList.add("input-error");

            const errorDiv = document.getElementById(errorId);

            if (errorDiv) {
                errorDiv.innerText = message;
            }

        }

        document.addEventListener("DOMContentLoaded", function() {

            let oldState = "{{ old('state', $formData['state'] ?? '') }}";
            let oldCity = "{{ old('city', $formData['city'] ?? '') }}";
            let country = document.getElementById("country").value;

            if (country) {
                fetch(`/api/states/${country}`)
                    .then(res => res.json())
                    .then(states => {

                        let stateDropdown = document.getElementById("state");

                        states.forEach(s => {
                            let selected = (s.id == oldState) ? "selected" : "";
                            stateDropdown.innerHTML += `<option value="${s.id}" ${selected}>${s.name}</option>`;
                        });

                        if (oldState) {
                            fetch(`/api/cities/${oldState}`)
                                .then(res => res.json())
                                .then(cities => {

                                    let cityDropdown = document.getElementById("city");

                                    cities.forEach(c => {
                                        let selected = (c.id == oldCity) ? "selected" : "";
                                        cityDropdown.innerHTML += `<option value="${c.id}" ${selected}>${c.name}</option>`;
                                    });

                                });
                        }

                    });
            }

        });

        function clearErrors() {

            document.querySelectorAll(".field-error").forEach(el => {
                el.innerText = "";
            });

            document.querySelectorAll(".custom-input").forEach(el => {
                el.classList.remove("input-error");
            });

        }

        function validateStep1() {

            let valid = true;

            const name = document.getElementById("iname");
            const rep = document.getElementById("lname");
            const email = document.getElementById("email");
            const pass = document.querySelector('input[name="password"]');
            const confirm = document.querySelector('input[name="password_confirmation"]');

            clearErrors();

            if (name.value.trim() === "") {
                showError(name, "iname-error", "Institution name is required");
                valid = false;
            }

            if (rep.value.trim() === "") {
                showError(rep, "lname-error", "Representative name is required");
                valid = false;
            }

            if (email.value.trim() === "") {
                showError(email, "email-error", "Email is required");
                valid = false;
            }

            if (pass.value.length < 8) {
                showError(pass, "password-error", "Password must be at least 8 characters");
                valid = false;
            }

            if (confirm.value !== pass.value) {
                showError(confirm, "confirm-password-error", "Passwords do not match");
                valid = false;
            }

            if (valid) {
                switchStep(2);
            }
        }

        function validateStep2() {

            let valid = true;

            const country = document.getElementById("country");
            const state = document.getElementById("state");
            const city = document.getElementById("city");
            const phone = document.getElementById("phone");
            const address = document.getElementById("address1");
            const zip = document.getElementById("zip");

            clearErrors();

            if (country.value === "") {
                showError(country, "country-error", "Please select a country");
                valid = false;
            }

            if (phone.value.trim() === "") {
                showError(phone, "phone-error", "Phone number is required");
                valid = false;
            }

            if (address.value.trim() === "") {
                showError(address, "address1-error", "Address is required");
                valid = false;
            }

            if (state.value === "") {
                showError(state, "state-error", "Please select a state");
                valid = false;
            }

            if (city.value === "") {
                showError(city, "city-error", "Please select a city");
                valid = false;
            }

            if (zip.value.trim() === "") {
                showError(zip, "zip-error", "Postal code is required");
                valid = false;
            }

            if (valid) {
                switchStep(3);
            }

        }

        function validateStep3() {

clearErrors();

const type = document.querySelector('[name="institution_type_id"]');
const aishe = document.getElementById("aishe_code");
const aicte = document.getElementById("aicte_id");
const ugc = document.getElementById("ugc_number");

let valid = true;

if (type.value === "") {
    showError(type, "type-error", "Please select institution type");
    valid = false;
}

if (aishe.value.trim() === "") {
    showError(aishe, "aishe-error", "AISHE code required");
    valid = false;
}

if (aicte.value.trim() === "") {
    showError(aicte, "aicte-error", "AICTE ID required");
    valid = false;
}

if (ugc.value.trim() === "") {
    showError(ugc, "ugc-error", "UGC number required");
    valid = false;
}

if (valid) switchStep(4);
}
    </script>
</body>

</html>