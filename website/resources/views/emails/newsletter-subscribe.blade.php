<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>New Newsletter Subscriber – DARTE Admin</title>
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
                        <p style="margin:10px 0 0 0; font-size:11px; color:#ffffff; letter-spacing:3px; text-transform:uppercase; font-family: Arial, Helvetica, sans-serif;">Admin Notification</p>
                    </td>
                </tr>

                <!-- Hero Accent Bar -->
                <tr>
                    <td bgcolor="#FBBB00" style="height:4px; font-size:0; line-height:0;">&nbsp;</td>
                </tr>

                <!-- Alert Banner -->
                <tr>
                    <td bgcolor="#FBBB00" align="center" style="padding:24px 24px 20px 24px;">
                        <p style="margin:0 0 4px 0; font-size:24px; font-weight:900; color:#111111; font-family: Arial, Helvetica, sans-serif; letter-spacing:1px;">&#127881; New Subscriber!</p>
                        <p style="margin:0; font-size:13px; color:#4a3a00; font-family: Arial, Helvetica, sans-serif;">Someone just subscribed to the DARTE newsletter.</p>
                    </td>
                </tr>

                <!-- ===== BODY ===== -->
                <tr>
                    <td style="padding:36px 36px 32px 36px;">

                        <p style="margin:0 0 24px 0; font-size:15px; color:#555555; font-family: Arial, Helvetica, sans-serif; line-height:1.7;">
                            Great news! Your newsletter subscriber list is growing. A new visitor has opted in to receive updates from DARTE.
                        </p>

                        <!-- Subscriber Info -->
                        <p style="margin:0 0 16px 0; font-size:13px; font-weight:bold; color:#b87900; text-transform:uppercase; letter-spacing:1px; border-bottom:2px solid #b87900; padding-bottom:6px; font-family: Arial, Helvetica, sans-serif;">Subscriber Details</p>

                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:28px;">
                            <tr>
                                <td width="35%" bgcolor="#fbf8f0" style="padding:14px 16px; font-size:13px; font-weight:bold; color:#555555; font-family: Arial, Helvetica, sans-serif; border-bottom:1px solid #efe6d6; text-transform:uppercase; letter-spacing:0.5px;">Email Address</td>
                                <td width="65%" style="padding:14px 16px; font-size:15px; font-weight:bold; color:#111111; font-family: Arial, Helvetica, sans-serif; border-bottom:1px solid #efe6d6;">
                                    <a href="mailto:{{ $email ?? '' }}" style="color:#b87900; text-decoration:none;">{{ $email ?? '' }}</a>
                                </td>
                            </tr>
                            <tr bgcolor="#fafafa">
                                <td bgcolor="#fbf8f0" style="padding:14px 16px; font-size:13px; font-weight:bold; color:#555555; font-family: Arial, Helvetica, sans-serif; text-transform:uppercase; letter-spacing:0.5px;">Subscribed At</td>
                                <td style="padding:14px 16px; font-size:14px; color:#333333; font-family: Arial, Helvetica, sans-serif;">{{ now()->format('d M Y, h:i A') }}</td>
                            </tr>
                        </table>

                        <!-- Growing list notice -->
                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:16px;">
                            <tr>
                                <td bgcolor="#fff8e1" style="border-left:3px solid #b87900; padding:14px 18px; border-radius:0 4px 4px 0;">
                                    <p style="margin:0; font-size:13px; color:#555555; font-family: Arial, Helvetica, sans-serif; line-height:1.6;">
                                        &#128200;&nbsp; Keep your subscribers engaged with regular updates, new arrivals, and exclusive offers. Every subscriber is a potential loyal customer.
                                    </p>
                                </td>
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
                            This is an internal admin notification. Do not forward.
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