<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Activate Your Account – MediaoneTix</title>
    <style>
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
            border: 0;
            outline: none;
            text-decoration: none;
        }

        body {
            margin: 0 !important;
            padding: 0 !important;
            background-color: #0c1222;
            width: 100% !important;
        }

        a {
            color: inherit;
        }

        .email-body {
            background-color: #0c1222;
        }
    </style>
</head>

<body style="margin:0;padding:0;background-color:#0c1222;font-family:Arial,Helvetica,sans-serif;">

    <!-- Outer wrapper -->
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
        style="background-color:#0c1222;min-height:100vh;">
        <tr>
            <td align="center" style="padding:40px 16px;">

                <!-- Inner container -->
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                    style="max-width:560px;width:100%;">

                    <!-- ===== LOGO ===== -->
                    <tr>
                        <td align="center" style="padding-bottom:28px;">
                            <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="vertical-align:middle;padding-right:10px;">
                                        <!-- Logo icon -->
                                        <div
                                            style="width:38px;height:38px;border-radius:10px;background:linear-gradient(135deg,#2563eb,#06b6d4);display:inline-block;text-align:center;line-height:38px;font-size:18px;color:white;font-weight:900;">
                                            &#9658;
                                        </div>
                                    </td>
                                    <td style="vertical-align:middle;">
                                        <span
                                            style="font-family:Arial,Helvetica,sans-serif;font-size:20px;font-weight:900;color:#ffffff;letter-spacing:-0.5px;">Media<span
                                                style="color:#3b82f6;">one</span>Tix</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- ===== MAIN CARD ===== -->
                    <tr>
                        <td>
                            <!-- Card outer (simulates border-radius + border) -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                                style="background-color:#111827;border:1px solid rgba(255,255,255,0.08);border-radius:20px;overflow:hidden;">

                                <!-- Top gradient bar -->
                                <tr>
                                    <td
                                        style="height:3px;background:linear-gradient(90deg,#2563eb 0%,#3b82f6 50%,#06b6d4 100%);font-size:0;line-height:0;">
                                        &nbsp;</td>
                                </tr>

                                <!-- Card body -->
                                <tr>
                                    <td align="center" style="padding:48px 40px 36px;">

                                        <!-- Icon box -->
                                        <table role="presentation" cellpadding="0" cellspacing="0" border="0"
                                            style="margin-bottom:22px;">
                                            <tr>
                                                <td align="center">
                                                    <div
                                                        style="width:68px;height:68px;border-radius:18px;background:linear-gradient(135deg,#1d4ed8,#3b82f6);display:inline-block;text-align:center;line-height:68px;font-size:30px;">
                                                        &#9993;
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Badge -->
                                        <table role="presentation" cellpadding="0" cellspacing="0" border="0"
                                            style="margin:0 auto 20px;">
                                            <tr>
                                                <td
                                                    style="background-color:rgba(59,130,246,0.12);border:1px solid rgba(59,130,246,0.25);border-radius:999px;padding:5px 16px;">
                                                    <span
                                                        style="color:#93c5fd;font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;">
                                                        &#9679;&nbsp; Account Activation
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Headline -->
                                        <h1
                                            style="margin:0 0 12px;font-family:Arial,Helvetica,sans-serif;font-size:26px;font-weight:900;letter-spacing:-0.5px;line-height:1.25;color:#ffffff;text-align:center;">
                                            Activate your account
                                        </h1>

                                        <!-- Subtext -->
                                        <p
                                            style="margin:0 auto 32px;max-width:380px;color:rgba(255,255,255,0.42);font-size:14px;line-height:1.75;text-align:center;font-family:Arial,Helvetica,sans-serif;">
                                            Hey <strong
                                                style="color:rgba(255,255,255,0.75);font-weight:600;">{{ $user->name ?? 'there' }}</strong>
                                            — welcome to MediaoneTix! Confirm your email to start discovering and
                                            booking tickets for live events near you.
                                        </p>

                                        <!-- CTA Button -->
                                        <table role="presentation" cellpadding="0" cellspacing="0" border="0"
                                            style="margin:0 auto 28px;">
                                            <tr>
                                                <td align="center"
                                                    style="border-radius:13px;background:linear-gradient(135deg,#1d4ed8 0%,#3b82f6 55%,#06b6d4 100%);box-shadow:0 8px 28px rgba(59,130,246,0.40);">
                                                    <a href="{{ $verificationUrl ?? '#' }}"
                                                        style="display:inline-block;padding:16px 48px;font-family:Arial,Helvetica,sans-serif;font-size:15px;font-weight:700;color:#ffffff;text-decoration:none;border-radius:13px;letter-spacing:0.2px;">
                                                        Activate My Account &nbsp;&rarr;
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Expiry note -->
                                        <p
                                            style="margin:0;color:rgba(255,255,255,0.22);font-size:12px;text-align:center;font-family:Arial,Helvetica,sans-serif;">
                                            This link expires in&nbsp;<span
                                                style="color:rgba(255,255,255,0.42);font-weight:600;">24 hours</span>
                                        </p>

                                    </td>
                                </tr>

                                <!-- Divider row -->
                                <tr>
                                    <td style="padding:0 40px;">
                                        <div
                                            style="height:1px;background-color:rgba(255,255,255,0.06);font-size:0;line-height:0;">
                                            &nbsp;</div>
                                    </td>
                                </tr>

                                <!-- ===== INFO ROWS ===== -->
                                <tr>
                                    <td style="padding:28px 40px 36px;">

                                        <!-- Info 1 -->
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                                            border="0" style="margin-bottom:14px;">
                                            <tr>
                                                <td width="38" valign="top">
                                                    <div
                                                        style="width:32px;height:32px;border-radius:8px;background-color:rgba(59,130,246,0.10);border:1px solid rgba(59,130,246,0.20);text-align:center;line-height:32px;font-size:14px;">
                                                        &#128274;
                                                    </div>
                                                </td>
                                                <td style="padding-left:12px;vertical-align:middle;">
                                                    <p
                                                        style="margin:0;color:rgba(255,255,255,0.32);font-size:12.5px;line-height:1.6;font-family:Arial,Helvetica,sans-serif;">
                                                        Didn't create an account? You can safely ignore this email —
                                                        nothing will change.
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Info 2 -->
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                                            border="0" style="margin-bottom:14px;">
                                            <tr>
                                                <td width="38" valign="top">
                                                    <div
                                                        style="width:32px;height:32px;border-radius:8px;background-color:rgba(6,182,212,0.08);border:1px solid rgba(6,182,212,0.18);text-align:center;line-height:32px;font-size:14px;">
                                                        &#128336;
                                                    </div>
                                                </td>
                                                <td style="padding-left:12px;vertical-align:middle;">
                                                    <p
                                                        style="margin:0;color:rgba(255,255,255,0.32);font-size:12.5px;line-height:1.6;font-family:Arial,Helvetica,sans-serif;">
                                                        Button not working? Copy and paste the link below into your
                                                        browser.
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Fallback URL box -->
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                                            border="0">
                                            <tr>
                                                <td
                                                    style="background-color:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.07);border-radius:10px;padding:12px 16px;word-break:break-all;">
                                                    <a href="{{ $verificationUrl ?? '#' }}"
                                                        style="color:rgba(59,130,246,0.65);font-size:11px;text-decoration:none;font-family:monospace;letter-spacing:0.2px;">
                                                        {{ $verificationUrl ?? 'https://mediaonetix.com/verify/...' }}
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>

                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                    <!-- ===== FOOTER ===== -->
                    <tr>
                        <td align="center" style="padding-top:28px;padding-bottom:8px;">
                            <p
                                style="margin:0;color:rgba(255,255,255,0.18);font-size:12px;line-height:1.8;text-align:center;font-family:Arial,Helvetica,sans-serif;">
                                &copy; {{ date('Y') }} MediaoneTix &middot; Your gateway to live experiences<br />
                                <a href="#" style="color:rgba(59,130,246,0.50);text-decoration:none;">Unsubscribe</a>
                                &nbsp;&middot;&nbsp;
                                <a href="#" style="color:rgba(59,130,246,0.50);text-decoration:none;">Privacy Policy</a>
                                &nbsp;&middot;&nbsp;
                                <a href="#" style="color:rgba(59,130,246,0.50);text-decoration:none;">Help</a>
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>

</html>