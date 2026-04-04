<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Welcome to KickStartSkills</title>
</head>

<body
    style="margin: 0; padding: 0; background-color: #f4f4f4; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 20px 0 30px 0;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600"
                    style="border-collapse: collapse; border: 1px solid #cccccc; background-color: #ffffff;">
                    <tr>
                        <td align="center" bgcolor="#4A90E2"
                            style="padding: 40px 0 30px 0; color: #ffffff; font-size: 28px; font-weight: bold;">
                            KickStartSkills
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px 30px 40px 30px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="color: #153643; font-size: 24px;">
                                        <strong>Welcome, {{ $name }}!</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style="padding: 20px 0 20px 0; color: #153643; font-size: 16px; line-height: 24px;">
                                        Thank you for joining <strong>KickStartSkills</strong>. Your account has been
                                        created successfully.
                                        <br><br>

                                        <div
                                            style="background-color: #f9f9f9; padding: 20px; border-left: 4px solid #4A90E2; margin-bottom: 20px;">
                                            <strong style="display: block; margin-bottom: 10px; color: #333;">Your Login
                                                Credentials:</strong>

                                            <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                                style="font-size: 15px;">
                                                <tr>
                                                    <td width="110" style="padding-bottom: 8px; color: #777;">Account
                                                        Role:</td>
                                                    <td style="padding-bottom: 8px; color: #4A90E2; font-weight: bold;">
                                                        {{ strtoupper($role ?? 'User') }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-bottom: 8px; color: #777;">Login Email:</td>
                                                    <td style="padding-bottom: 8px;"><strong>{{ $email }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-bottom: 8px; color: #777;">Password:</td>
                                                    <td style="padding-bottom: 8px;"><strong>{{ $password }}</strong>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>

                                        <p style="color: #e74c3c; font-size: 13px; margin-top: 0;">
                                            <em>*Note: For security reasons, we recommend changing your password after
                                                your first login.</em>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <a href="{{ url('/student-login') }}"
                                            style="background-color: #4A90E2; color: #ffffff; padding: 15px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">
                                            Login to Your Dashboard
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style="padding: 30px 0 0 0; color: #153643; font-size: 16px; line-height: 24px;">
                                        It's time to start upskilling! Explore your courses and track your progress
                                        today.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td bgcolor="#f9f9f9" style="padding: 30px 30px 30px 30px; border-top: 1px solid #eeeeee;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="color: #888888; font-size: 12px; text-align: center;">
                                        Best Regards,<br>
                                        <strong>Team KickStartSkills</strong><br>
                                        <em>Empowering Your Career Growth</em>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
