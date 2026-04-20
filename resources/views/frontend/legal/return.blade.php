<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return & Refund Policy - KickStartSkills</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --bg-light: linear-gradient(135deg, #d9edff 0%, #c3e2ff 40%, #e7f3ff 100%);
            --txt-main: #0a0a0a;
            --txt-sub: #6e7b88;
            --card-bg: rgba(255, 255, 255, 0.6);
            --card-border: rgba(255, 255, 255, 0.4);
            --circle-blue: rgba(13, 110, 253, 0.15);
            --accent: #0d6efd;
        }

        body.dark-mode {
            --bg-light: linear-gradient(135deg, #041625 0%, #062743 40%, #03121f 100%);
            --txt-main: #f5f5f5;
            --txt-sub: #b7c2cc;
            --card-bg: rgba(0, 0, 0, 0.3);
            --card-border: rgba(255, 255, 255, 0.08);
            --circle-blue: rgba(13, 110, 253, 0.05);
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
            font-size: 1.15rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-h::before {
            content: '';
            display: inline-block;
            width: 6px;
            height: 20px;
            background: var(--accent);
            border-radius: 3px;
        }

        .alert-custom {
            background: rgba(13, 110, 253, 0.05);
            border: 1px solid rgba(13, 110, 253, 0.2);
            border-radius: 20px;
            padding: 30px;
            color: var(--txt-main);
        }

        p {
            color: var(--txt-sub);
            line-height: 1.8;
            font-size: 1rem;
        }

        hr {
            border-color: var(--card-border);
            opacity: 0.2;
            margin: 25px 0;
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
            <div class="col-lg-10 col-xl-8 text-center">

                <div class="text-start">
                    <a href="{{ url('/') }}" class="back-link text-decoration-none mb-4">
                        <i class="bi bi-arrow-left"></i> back to portals
                    </a>
                </div>

                <div class="legal-box shadow-lg">
                    <div class="portal-icon mx-auto mb-4"
                        style="background: rgba(13, 110, 253, 0.1); width: 80px; height: 80px; border-radius: 24px; display: flex; align-items: center; justify-content: center; font-size: 2.2rem;">
                        <i class="bi bi-shield-lock-fill text-primary"></i>
                    </div>

                    <h1 class="fw-bold mb-2">Return & Refund Policy</h1>
                    <p class="text-muted small">Standard Digital Service Agreement</p>
                    <hr>

                    <div class="alert-custom mt-4">
                        <h5 class="fw-bold text-primary mb-2"><i class="bi bi-info-circle-fill me-2"></i>No Return / No
                            Refund Policy</h5>
                        <p class="mb-0 small">KickStartSkills is a digital platform providing intangible services like
                            mentorship access and recruitment tools. <strong>Once a portal is accessed, the service is
                                considered fully rendered and non-refundable.</strong></p>
                    </div>

                    <div class="text-start mt-5">
                        <h5 class="section-h">Refund Eligibility</h5>
                        <p>Refunds are not provided for any subscription or one-time access fee. We strongly encourage
                            all users—be it Students, Mentors, or HR professionals—to review portal features before
                            making any financial commitment.</p>

                        <h5 class="section-h">Duplicate Payments</h5>
                        <p>In case of duplicate transactions due to a technical error, please contact our Admin team
                            with payment receipts within 24 hours at <span
                                class="text-primary">billing@kickstartskills.com</span>. We will investigate and process
                            a reversal if verified.</p>
                    </div>
                </div>

                <p class="text-center mt-5 text-muted small">© 2026 KickStartSkills. All rights reserved.</p>
            </div>
        </div>
    </div>

</body>

</html>
