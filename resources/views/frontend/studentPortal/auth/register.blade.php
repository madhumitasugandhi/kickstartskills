<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration | KickStartSkills</title>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* ------------------ THEME CONFIGURATION ------------------ */
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
            --review-bg: rgba(0, 0, 0, 0.2);
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
            --review-bg: rgba(255, 255, 255, 0.05);
            --circle-color-1: rgba(70, 150, 255, 0.1);
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
        }

        .circles li {
            position: absolute;
            display: block;
            list-style: none;
            background: var(--circle-color-1);
            animation: animate 25s linear infinite;
            bottom: -150px;
            border-radius: 50%;
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

        @keyframes animate {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0;
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
            z-index: 50;
        }

        .back-btn {
            left: 25px;
        }

        .theme-btn {
            right: 25px;
        }

        .auth-container {
            width: 100%;
            max-width: 500px;
            z-index: 10;
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
            margin: 0 auto 1rem;
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
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: rgba(255, 255, 255, 0.7);
        }

        .step.active {
            background: #3b82f6;
            border-color: #3b82f6;
            color: white;
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
            border-radius: 28px;
            padding: 2rem;
            width: 100%;
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
            border: 1px solid transparent;
            color: var(--input-text);
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--input-placeholder);
        }

        .btn-action {
            background-color: var(--btn-bg);
            color: var(--btn-text);
            font-weight: 600;
            padding: 12px;
            border-radius: 10px;
            border: none;
            width: 100%;
            margin-top: 1rem;
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
        }

        .btn-outline-light {
            border: 1px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s ease;
        }

        .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.25);
            color: white;
            transform: translateY(-2px);
        }

        .accordion-button:not(.collapsed) {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .modal {
            z-index: 1060 !important;
            /* Forces modal to front */
        }

        .modal-backdrop {
            z-index: 1050 !important;
            /* Keeps backdrop behind modal */
        }

        .skills-scroll-container {
            max-height: 175px;
            /* Adjust this to show exactly 3-4 items */
            overflow-y: auto;
            overflow-x: hidden;
            padding-right: 5px;
            /* Space for the scrollbar */
        }

        /* Custom Scrollbar Styling for a clean Look */
        .skills-scroll-container::-webkit-scrollbar {
            width: 5px;
        }

        .skills-scroll-container::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
        }

        .skills-scroll-container::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }

        .skills-scroll-container::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.4);
        }

        /* Change the Accordion Arrow to White */
        .accordion-button::after {
            filter: brightness(0) invert(1);
            /* This turns the black SVG arrow into pure white */
        }

        /* Ensure it stays white even when the accordion is open */
        .accordion-button:not(.collapsed)::after {
            filter: brightness(0) invert(1);
        }

        /* Optional: If you want to change the background color when clicked */
        .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(255, 255, 255, 0.1);
        }

        .accordion-button:not(.collapsed) {
            background-color: rgba(255, 255, 255, 0.2) !important;
            color: white !important;
        }
    </style>
</head>

<body>
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>

    <a href="{{ url('/student-login') }}" class="nav-btn back-btn"><i class="bi bi-arrow-left"></i></a>
    <button onclick="toggleTheme()" class="nav-btn theme-btn"><i id="theme-icon" class="bi bi-moon"></i></button>

    <div class="auth-container">
        <div class="icon-box"><i class="fas fa-user-plus"></i></div>
        <h2 class="fw-bold mb-1 text-center" id="page-title">Create Account</h2>
        <p class="opacity-75 mb-4 text-center" id="page-subtitle">Join thousands of learners</p>

        <div class="steps-container">
            <div class="step active" id="step-1-indicator">1</div>
            <div class="step-line"></div>
            <div class="step" id="step-2-indicator">2</div>
            <div class="step-line"></div>
            <div class="step" id="step-3-indicator">3</div>
        </div>

        <form action="{{ route('student.register.submit') }}" method="POST" id="main-register-form">
            @csrf
            <div id="step-1-form">@include('frontend.studentPortal.auth.registerLayouts.step1')</div>
            <div id="step-2-form" style="display: none;">@include('frontend.studentPortal.auth.registerLayouts.step2')
            </div>
            <div id="step-3-form" style="display: none;">@include('frontend.studentPortal.auth.registerLayouts.step3')
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous">
    </script>
    <script>
        let selectedSkills = [];

// 1. Institution Code Toggle
function toggleInstitutionFields() {
    const isChecked = document.getElementById('no-institution-code').checked;
    const codeInput = document.getElementById('institution_code');

    if (isChecked) {
        codeInput.value = '';
        codeInput.disabled = true;
        codeInput.style.opacity = '0.5';
    } else {
        codeInput.disabled = false;
        codeInput.style.opacity = '1';
    }
}

function openSkillModal(name) {
    document.getElementById('skillModalName').innerText = name;

    const modalEl = document.getElementById('addSkillModal');
    const myModal = new bootstrap.Modal(modalEl, {
        backdrop: true,
        keyboard: true
    });

    myModal.show();

    // Fix for the "Unclickable" issue:
    // This moves the modal element to the body so the backdrop doesn't cover it
    document.body.appendChild(modalEl);
}

function saveSkill() {
    // 1. Get Values
    const name = document.getElementById('skillModalName').innerText;
    const level = document.getElementById('skillLevel').value;
    const type = document.querySelector('input[name="skillType"]:checked').value;

    // 2. Add to Array
    selectedSkills.push({ name, type, level });
    renderSkills();

    // 3. Force Close & Clean up
    const modalEl = document.getElementById('addSkillModal');
    const modalInstance = bootstrap.Modal.getInstance(modalEl);
    if (modalInstance) modalInstance.hide();

    // Hard removal of backdrop if it gets stuck
    document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
    document.body.classList.remove('modal-open');
    document.body.style.overflow = 'auto';
}
// 4. Render Skills (Show Chips)
function renderSkills() {
    const currentCont = document.getElementById('currentSkillsContainer');
    const goalCont = document.getElementById('learningGoalsContainer');

    if(!currentCont || !goalCont) return;

    currentCont.innerHTML = '';
    goalCont.innerHTML = '';

    selectedSkills.forEach((skill, index) => {
        const chip = `
            <div class="badge rounded-pill bg-primary bg-opacity-25 text-white p-2 px-3 border border-primary border-opacity-50 d-flex align-items-center gap-2">
                ${skill.name} <small>(${skill.level})</small>
                <i class="bi bi-x-circle-fill" style="cursor:pointer;" onclick="removeSkill(${index})"></i>
            </div>`;

        if(skill.type === 'current') currentCont.innerHTML += chip;
        else goalCont.innerHTML += chip;
    });
}

function removeSkill(index) {
    selectedSkills.splice(index, 1);
    renderSkills();
}

        function switchStep(step) {
            if (step === 3) {
                const noCode = document.getElementById('no-institution-code').checked;
                const codeValue = document.getElementById('institution_code').value.trim();
                if (!noCode && codeValue === "") {
                    alert("Please enter an institution code or select 'Individual learner'.");
                    return;
                }
            }
            document.getElementById('step-1-form').style.display = 'none';
            document.getElementById('step-2-form').style.display = 'none';
            document.getElementById('step-3-form').style.display = 'none';
            document.getElementById('step-' + step + '-form').style.display = 'block';

            for(let i=1; i<=3; i++) {
                document.getElementById('step-' + i + '-indicator').classList.toggle('active', i <= step);
            }
            if(step === 3) populateReview();
        }

    function populateReview() {
    // Helper to get value by ID
    const getVal = (id) => {
        const el = document.getElementById(id);
        if (!el) {
            console.warn("Could not find element with ID: " + id);
            return '-';
        }
        return el.value.trim() !== "" ? el.value : '-';
    };

    // 1. Fetch Personal Info (Check these IDs match Step 1!)
    const firstName = getVal('fname');
    const lastName = getVal('lname');
    const email = getVal('email');

    document.getElementById('review-name').innerText = firstName + ' ' + lastName;
    document.getElementById('review-email').innerText = email;

    // 2. Fetch Details (Check these IDs match Step 2!)
    document.getElementById('review-country').innerText = getVal('country');
    document.getElementById('review-phone').innerText = getVal('phone');

    // 3. Institution Logic
    const noCodeCheck = document.getElementById('no-institution-code');
    if (noCodeCheck && noCodeCheck.checked) {
        document.getElementById('review-code').innerText = "Individual Learner";
    } else {
        document.getElementById('review-code').innerText = getVal('institution_code');
    }

    // 4. Skills Logic
    const current = selectedSkills.filter(s => s.type === 'current').map(s => `${s.name} (${s.level})`).join(', ');
    const goals = selectedSkills.filter(s => s.type === 'goal').map(s => `${s.name} (${s.level})`).join(', ');

    document.getElementById('review-skills').innerText = current || 'None selected';
    document.getElementById('review-goals').innerText = goals || 'None selected';
}

        function toggleTheme() {
            document.body.classList.toggle('dark-mode');
            document.getElementById('theme-icon').className = document.body.classList.contains('dark-mode') ? 'bi bi-sun' : 'bi bi-moon';
        }
    </script>
</body>

</html>
