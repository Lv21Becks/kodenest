<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Security Code — KodeNest</title>
</head>
<body style="margin:0;padding:0;background-color:#f4f4f5;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;">

    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background-color:#f4f4f5;padding:40px 20px;">
        <tr>
            <td align="center">

                <!-- Email Card -->
                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="max-width:560px;">

                    <!-- Header Logo Bar -->
                    <tr>
                        <td align="center" style="padding-bottom:24px;">
                            <table role="presentation" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="background-color:#111827;border-radius:12px;padding:14px 28px;">
                                        <span style="font-size:20px;font-weight:900;letter-spacing:-0.5px;color:#ffffff;">
                                            Kode<span style="color:#f97316;">Nest</span>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Card Body -->
                    <tr>
                        <td style="background-color:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.08);">

                            <!-- Orange top accent -->
                            <div style="background:linear-gradient(90deg, #ea580c, #f97316);height:5px;"></div>

                            <!-- Content -->
                            <div style="padding:40px 48px;">

                                <!-- Icon -->
                                <div style="text-align:center;margin-bottom:24px;">
                                    <div style="display:inline-block;background-color:#fff7ed;border:2px solid #fed7aa;border-radius:50%;width:64px;height:64px;line-height:64px;text-align:center;">
                                        <span style="font-size:28px;">🔐</span>
                                    </div>
                                </div>

                                <h1 style="margin:0 0 8px;font-size:22px;font-weight:800;color:#111827;text-align:center;">
                                    Admin Login Verification
                                </h1>
                                <p style="margin:0 0 28px;font-size:14px;color:#6b7280;text-align:center;line-height:1.6;">
                                    Hello <strong style="color:#111827;">{{ $user->name }}</strong>,<br>
                                    A sign-in attempt was detected on your KodeNest Admin account. Use the code below to complete your secure login.
                                </p>

                                <!-- OTP Code Box -->
                                <div style="background-color:#fff7ed;border:2px dashed #f97316;border-radius:12px;padding:28px;text-align:center;margin-bottom:28px;">
                                    <p style="margin:0 0 8px;font-size:12px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:#9a3412;">Your Verification Code</p>
                                    <div style="font-size:40px;font-weight:900;letter-spacing:12px;color:#ea580c;line-height:1;">
                                        {{ $code }}
                                    </div>
                                    <p style="margin:12px 0 0;font-size:12px;color:#9a3412;">
                                        ⏱ Expires in <strong>10 minutes</strong>
                                    </p>
                                </div>

                                <!-- Warning Note -->
                                <div style="background-color:#fef2f2;border-left:4px solid #ef4444;border-radius:0 8px 8px 0;padding:14px 18px;margin-bottom:28px;">
                                    <p style="margin:0;font-size:13px;color:#991b1b;line-height:1.6;">
                                        <strong>Didn't try to log in?</strong><br>
                                        If this wasn't you, your account password may be compromised. Please notify your Super Admin immediately and change your credentials.
                                    </p>
                                </div>

                                <p style="margin:0;font-size:13px;color:#9ca3af;text-align:center;line-height:1.6;">
                                    This is an automated security message from the<br>
                                    <strong style="color:#374151;">KodeNest Security System</strong>.
                                    Please do not reply to this email.
                                </p>
                            </div>

                            <!-- Footer -->
                            <div style="background-color:#f9fafb;border-top:1px solid #f3f4f6;padding:20px 48px;text-align:center;">
                                <p style="margin:0;font-size:12px;color:#9ca3af;">
                                    © {{ date('Y') }} KodeNest ICT Academy · All rights reserved.
                                </p>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
