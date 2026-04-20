<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - KickStartSkills</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --bg-light: linear-gradient(135deg, #d9edff 0%, #c3e2ff 40%, #e7f3ff 100%);
            --txt-main: #0a0a0a;
            --txt-sub: #6e7b88;
            --card-bg: rgba(255, 255, 255, 0.6);
            --card-border: rgba(255, 255, 255, 0.4);
            --circle-blue: rgba(70, 150, 255, 0.2);
            --accent: #0d6efd;
        }

        body.dark-mode {
            --bg-light: linear-gradient(135deg, #041625 0%, #062743 40%, #03121f 100%);
            --txt-main: #f5f5f5;
            --txt-sub: #b7c2cc;
            --card-bg: rgba(0, 0, 0, 0.3);
            --card-border: rgba(255, 255, 255, 0.08);
            --circle-blue: rgba(70, 150, 255, 0.05);
            --accent: #3d8bfd;
        }

        body {
            background: var(--bg-light);
            color: var(--txt-main);
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            transition: 0.4s;
        }

        /* --- Floating Circles --- */
        .circles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
            margin: 0;
            padding: 0;
        }

        .circles li {
            position: absolute;
            display: block;
            list-style: none;
            width: 20px;
            height: 20px;
            background: var(--circle-blue);
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

        .circles li:nth-child(3) {
            left: 70%;
            width: 20px;
            height: 20px;
            animation-delay: 4s;
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

        /* --- Legal Box Styling --- */
        .legal-box {
            background: var(--card-bg);
            backdrop-filter: blur(40px);
            -webkit-backdrop-filter: blur(40px);
            border: 1px solid var(--card-border);
            border-radius: 32px;
            padding: 50px;
            margin-top: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
        }

        .back-link {
            color: var(--txt-sub);
            font-weight: 500;
            transition: 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .back-link:hover {
            color: var(--accent);
            transform: translateX(-5px);
        }

        .section-h {
            color: var(--accent);
            font-weight: 700;
            margin-top: 35px;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-h::before {
            content: '';
            display: inline-block;
            width: 8px;
            height: 24px;
            background: var(--accent);
            border-radius: 4px;
        }

        p {
            color: var(--txt-sub);
            line-height: 1.8;
            font-size: 1.05rem;
        }

        hr {
            border-color: var(--card-border);
            opacity: 0.2;
            margin: 30px 0;
        }
    </style>
</head>

<body class="{{ (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark') ? 'dark-mode' : '' }}">

    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">

                <a href="{{ url('/') }}" class="back-link text-decoration-none">
                    <i class="bi bi-arrow-left"></i> back to portals
                </a>

                <div class="legal-box shadow-lg">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div
                            style="width: 50px; height: 50px; background: rgba(13, 110, 253, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-shield-check text-primary fs-3"></i>
                        </div>
                        <h1 class="fw-bold mb-0" style="letter-spacing: -1px;">Privacy Policy</h1>
                    </div>

                    <p class="text-muted small px-1">Effective Date: April 20, 2026 • KickStartSkills Compliance</p>
                    <hr>

                    <h5 class="section-h">1. Data We Collect</h5>
                    <p>We collect personal information that you provide to us such as name, email address, and
                        professional skills when you register on any of our portals. This helps us personalize your
                        dashboard and mentorship connections.</p>

                    <h5 class="section-h">2. How We Use Your Information</h5>
                    <p>Your data is used to facilitate mentorship, track educational progress, and allow HR
                        professionals to discover talent. We use advanced matching algorithms to connect the right
                        students with the right opportunities.</p>

                    <h5 class="section-h">3. Security Standards</h5>
                    <p>We implement a variety of security measures, including 256-bit encryption and secure socket
                        layers (SSL), to maintain the safety of your personal information when you enter, submit, or
                        access your profile.</p>

                    <div class="mt-5 p-4 rounded-4"
                        style="background: rgba(13, 110, 253, 0.05); border: 1px dashed var(--card-border);">
                        <p class="mb-0 small text-center italic">If you have any questions regarding this policy, you
                            may contact our legal team at <span
                                class="text-primary fw-bold">legal@kickstartskills.com</span></p>
                    </div>
                </div>

                <p class="text-center mt-5 text-muted small">© 2026 KickStartSkills. All rights reserved.</p>
            </div>
        </div>
    </div>

</body>

</html>
