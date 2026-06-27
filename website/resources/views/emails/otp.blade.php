<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Password Reset OTP – DARTE</title>
</head>
<body style="margin:0; padding:0; background-color:#f6f1e7; font-family: Arial, Helvetica, sans-serif;">

<!-- Outer Wrapper -->
<table width="100%" bgcolor="#f6f1e7" cellpadding="0" cellspacing="0" border="0" style="padding:40px 15px;">
    <tr>
        <td align="center">

            <!-- Card Container -->
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width:600px; background-color:#ffffff; border:1px solid #eadfcb;">

                <!-- ===== HEADER ===== -->
                <tr>
                    <td bgcolor="#111111" align="center" style="padding:32px 24px 20px 24px;">
                        <img src="{{ asset('assets/images/logo-white.webp') }}" alt="DARTE" style="width:160px; max-width:160px; height:auto; display:block; margin:0 auto;">
                        <p style="margin:10px 0 0 0; font-size:11px; color:#ffffff; letter-spacing:3px; text-transform:uppercase; font-family: Arial, Helvetica, sans-serif;">Fashion That Defines You</p>
                    </td>
                </tr>

                <!-- Hero Accent Bar -->
                <tr>
                    <td bgcolor="#FBBB00" style="height:4px; font-size:0; line-height:0;">&nbsp;</td>
                </tr>

                <!-- ===== BODY ===== -->
                <tr>
                    <td style="padding:40px 36px 32px 36px;">

                        <!-- Greeting -->
                        <p style="margin:0 0 10px 0; font-size:22px; font-weight:700; color:#111111; font-family: Arial, Helvetica, sans-serif;">Reset Your Password</p>
                        <p style="margin:0 0 28px 0; font-size:15px; color:#555555; line-height:1.7; font-family: Arial, Helvetica, sans-serif;">
                            We received a request to reset the password for your DARTE account. Use the One-Time Password (OTP) below to proceed. This code is valid for <strong style="color:#111111;">15 minutes</strong>.
                        </p>

                        <!-- Section Heading -->
                        <p style="margin:0 0 16px 0; font-size:13px; font-weight:bold; color:#b87900; text-transform:uppercase; letter-spacing:1px; border-bottom:2px solid #b87900; padding-bottom:6px; font-family: Arial, Helvetica, sans-serif;">Your OTP Code</p>

                        <!-- OTP Box -->
                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:28px;">
                            <tr>
                                <td align="center" style="padding:10px 0;">
                                    <table cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td bgcolor="#111111" style="border-radius:10px; padding:22px 48px;" align="center">
                                                <span style="font-size:38px; font-weight:900; letter-spacing:10px; color:#b87900; font-family: 'Courier New', Courier, monospace; display:block;">{{ $otp }}</span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <!-- Expiry notice -->
                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:28px;">
                            <tr>
                                <td bgcolor="#fff8e1" style="border-left:3px solid #b87900; padding:14px 18px; border-radius:0 4px 4px 0;">
                                    <p style="margin:0; font-size:14px; color:#555555; font-family: Arial, Helvetica, sans-serif; line-height:1.6;">
                                        &#9200;&nbsp; This OTP will expire in <strong style="color:#b87900;">15 minutes</strong> from when it was sent. Do not share this code with anyone.
                                    </p>
                                </td>
                            </tr>
                        </table>

                        <!-- Security Warning -->
                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:16px;">
                            <tr>
                                <td bgcolor="#fff3f3" style="border-left:3px solid #cc0000; padding:14px 18px; border-radius:0 4px 4px 0;">
                                    <p style="margin:0; font-size:13px; color:#aa0000; font-family: Arial, Helvetica, sans-serif; line-height:1.6;">
                                        &#9888;&nbsp; <strong>Didn't request this?</strong> If you did not request a password reset, please ignore this email. Your account remains secure. No changes have been made.
                                    </p>
                                </td>
                            </tr>
                        </table>

                        <p style="margin:24px 0 0 0; font-size:14px; color:#888888; font-family: Arial, Helvetica, sans-serif; line-height:1.7;">
                            Warm regards,<br>
                            <strong style="color:#111111;">The DARTE Team</strong>
                        </p>

                    </td>
                </tr>

                <!-- Divider -->
                <tr>
                    <td style="padding:0 36px;">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td style="border-top:1px solid #efe6d6; font-size:0; line-height:0;">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- ===== FOOTER ===== -->
                <tr>
                    <td bgcolor="#111111" align="center" style="padding:24px 24px;">
                        <p style="margin:0 0 8px 0; font-size:12px; color:#999999; font-family: Arial, Helvetica, sans-serif;">
                            &copy; {{ date('Y') }} DARTE. All rights reserved.
                        </p>
                        <p style="margin:0; font-size:11px; color:#666666; font-family: Arial, Helvetica, sans-serif;">
                            This is an automated email. Please do not reply directly to this message.
                        </p>
                    </td>
                </tr>

            </table>
            <!-- /Card Container -->

        </td>
    </tr>
</table>

</body>
</html>