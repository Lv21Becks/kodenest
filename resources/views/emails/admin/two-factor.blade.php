<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KodeNest Admin Security — Login Verification</title>
</head>
<body style="margin:0;padding:0;background-color:#0a192f;font-family:'Inter', 'Helvetica Neue', Helvetica, Arial, sans-serif;color:#ffffff;">

    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background-color:#0a192f;padding:60px 20px;">
        <tr>
            <td align="center">

                <!-- Email Card -->
                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;background-color:#112240;border-radius:24px;overflow:hidden;box-shadow:0 25px 50px -12px rgba(0, 0, 0, 0.5);border:1px solid rgba(255, 255, 255, 0.05);">

                    <!-- Top Accent Line -->
                    <tr>
                        <td style="background:linear-gradient(90deg, #ea580c, #f97316);height:6px;"></td>
                    </tr>

                    <!-- Header Logo Area -->
                    <tr>
                        <td align="center" style="padding:40px 48px 20px 48px;">
                            {{-- We attempt to load the actual image. The alt text acts as a fallback if images are blocked --}}
                            <a href="{{ config('app.url') }}" style="text-decoration:none;display:inline-block;">
                                <img src="{{ asset('images/KODENEST icon 4.png') }}" alt="KodeNest Logo" width="180" style="display:block;border:0;outline:none;text-decoration:none;width:180px;height:auto;max-width:100%;">
                                {{-- If image fails to load, this will show instead (if styled below) --}}
                                <div style="display:none;mso-hide:all;">
                                    <span style="font-size:24px;font-weight:900;letter-spacing:-0.5px;color:#ffffff;">
                                        Kode<span style="color:#f97316;">Nest</span>
                                    </span>
                                </div>
                            </a>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:10px 48px 48px 48px;">

                            <!-- Icon -->
                            <div style="text-align:center;margin-bottom:30px;">
                                <div style="display:inline-block;background:linear-gradient(135deg, rgba(249, 115, 22, 0.1) 0%, rgba(2ea, 88, 12, 0.2) 100%);border:2px solid rgba(249, 115, 22, 0.3);border-radius:50%;width:80px;height:80px;line-height:80px;text-align:center;">
                                    <span style="font-size:36px;text-shadow:0 0 15px rgba(249,115,22,0.4);">🛡️</span>
                                </div>
                            </div>

                            <h1 style="margin:0 0 12px;font-size:26px;font-weight:800;color:#ffffff;text-align:center;letter-spacing:-0.5px;">
                                Security Verification
                            </h1>
                            <p style="margin:0 0 32px;font-size:15px;color:#cbd5e1;text-align:center;line-height:1.6;">
                                Welcome back, <strong style="color:#ffffff;">{{ $user->name }}</strong>.<br>
                                A sign-in attempt was detected on your Admin account. To continue, please enter the security code below:
                            </p>

                            <!-- OTP Code Box -->
                            <div style="background-color:rgba(255, 255, 255, 0.03);border:1px dashed rgba(249, 115, 22, 0.5);border-radius:16px;padding:32px;text-align:center;margin-bottom:32px;">
                                <p style="margin:0 0 12px;font-size:11px;font-weight:700;letter-spacing:4px;text-transform:uppercase;color:#f97316;">Authentication Code</p>
                                <div style="font-size:48px;font-weight:900;letter-spacing:16px;color:#ffffff;line-height:1;margin-left:16px;">
                                    {{ $code }}
                                </div>
                                <p style="margin:16px 0 0;font-size:13px;color:#94a3b8;font-weight:500;">
                                    Valid for <span style="color:#f97316;">10 minutes</span>
                                </p>
                            </div>

                            <!-- Warning Note -->
                            <div style="background-color:rgba(239, 68, 68, 0.1);border-left:4px solid #ef4444;border-radius:0 12px 12px 0;padding:16px 20px;margin-bottom:32px;">
                                <p style="margin:0;font-size:13px;color:#fca5a5;line-height:1.6;">
                                    <strong style="color:#ef4444;display:block;margin-bottom:4px;">Did not request this?</strong>
                                    Someone might have your password. Please notify your Super Admin immediately to secure your account.
                                </p>
                            </div>

                            <p style="margin:0;font-size:12px;color:#64748b;text-align:center;line-height:1.7;">
                                This is an automated security message from the<br>
                                <strong style="color:#94a3b8;">KodeNest Security System</strong>.<br>
                                Please do not reply.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="background-color:#0f1e38;padding:24px 48px;border-top:1px solid rgba(255,255,255,0.05);">
                            <p style="margin:0;font-size:12px;color:#64748b;font-weight:500;">
                                &copy; {{ date('Y') }} KodeNest ICT Academy. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
                
            </td>
        </tr>
    </table>
</body>
</html>
