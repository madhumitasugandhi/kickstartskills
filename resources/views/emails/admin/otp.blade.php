<!DOCTYPE html>
<html>
<head>
    <style>
        .email-container {
            font-family: 'Inter', sans-serif;
            padding: 40px;
            background-color: #f8fafc;
            text-align: center;
        }
        .card {
            background: #ffffff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            display: inline-block;
            max-width: 400px;
        }
        .otp-code {
            color: #dc2626;
            font-size: 32px;
            font-weight: 800;
            letter-spacing: 8px;
            margin: 20px 0;
            padding: 10px;
            background: #fef2f2;
            border-radius: 8px;
            display: block;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="card">
            <h2 style="color: #1e293b; margin-bottom: 10px;">Verification Code</h2>
            <p style="color: #64748b;">Use the code below to reset your password for KickStartSkills.</p>

            <span class="otp-code">{{ $otp }}</span>

            <p style="color: #64748b; font-size: 14px;">This code is valid for 10 minutes. If you didn't request this, please ignore this email.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} KickStartSkills Admin Portal
        </div>
    </div>
</body>
</html>
