<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Order Confirmation – DARTE</title>
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

                <!-- ===== HERO BODY ===== -->
                <tr>
                    <td bgcolor="#FBBB00" align="center" style="padding:28px 24px 24px 24px;">
                        <p style="margin:0 0 4px 0; font-size:26px; font-weight:900; color:#111111; font-family: Arial, Helvetica, sans-serif; letter-spacing:1px;">&#10003; Order Confirmed!</p>
                        <p style="margin:0; font-size:14px; color:#4a3a00; font-family: Arial, Helvetica, sans-serif;">Thank you for shopping with DARTE. We've received your order.</p>
                    </td>
                </tr>

                <!-- ===== BODY ===== -->
                <tr>
                    <td style="padding:32px 36px 28px 36px;">

                        <!-- Greeting -->
                        <p style="margin:0 0 20px 0; font-size:16px; color:#333333; font-family: Arial, Helvetica, sans-serif; line-height:1.7;">
                            Hello <strong style="color:#111111;">{{ $order->billing_name ?? '' }}</strong>,<br>
                            Your order has been placed successfully. We'll get it packed and shipped to you as soon as possible. Here's a summary of your order:
                        </p>

                        <!-- Order Meta -->
                        <p style="margin:0 0 16px 0; font-size:13px; font-weight:bold; color:#b87900; text-transform:uppercase; letter-spacing:1px; border-bottom:2px solid #b87900; padding-bottom:6px; font-family: Arial, Helvetica, sans-serif;">Order Details</p>

                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:28px;">
                            <tr>
                                <td width="50%" style="padding:10px 12px; font-size:13px; color:#888888; font-family: Arial, Helvetica, sans-serif; border-bottom:1px solid #efe6d6;">Order Number</td>
                                <td width="50%" style="padding:10px 12px; font-size:14px; font-weight:bold; color:#111111; font-family: Arial, Helvetica, sans-serif; border-bottom:1px solid #efe6d6;">{{ $order->order_number ?? '' }}</td>
                            </tr>
                            <tr bgcolor="#fafafa">
                                <td style="padding:10px 12px; font-size:13px; color:#888888; font-family: Arial, Helvetica, sans-serif; border-bottom:1px solid #efe6d6;">Order Date</td>
                                <td style="padding:10px 12px; font-size:14px; color:#333333; font-family: Arial, Helvetica, sans-serif; border-bottom:1px solid #efe6d6;">{{ $order->created_at ? \Carbon\Carbon::parse($order->created_at)->format('d M Y') : '' }}</td>
                            </tr>
                            <tr>
                                <td style="padding:10px 12px; font-size:13px; color:#888888; font-family: Arial, Helvetica, sans-serif; border-bottom:1px solid #efe6d6;">Payment Method</td>
                                <td style="padding:10px 12px; font-size:14px; color:#333333; font-family: Arial, Helvetica, sans-serif; border-bottom:1px solid #efe6d6;">{{ $order->payment_method ?? '' }}</td>
                            </tr>
                            <tr bgcolor="#fafafa">
                                <td style="padding:10px 12px; font-size:13px; color:#888888; font-family: Arial, Helvetica, sans-serif; border-bottom:1px solid #efe6d6;">Payment Status</td>
                                <td style="padding:10px 12px; font-size:14px; color:#333333; font-family: Arial, Helvetica, sans-serif; border-bottom:1px solid #efe6d6;">{{ $order->payment_status ?? '' }}</td>
                            </tr>
                            <tr>
                                <td style="padding:10px 12px; font-size:13px; color:#888888; font-family: Arial, Helvetica, sans-serif;">Order Status</td>
                                <td style="padding:10px 12px; font-size:14px; color:#333333; font-family: Arial, Helvetica, sans-serif;">{{ $order->status ?? '' }}</td>
                            </tr>
                        </table>

                        <!-- Items Section -->
                        <p style="margin:0 0 16px 0; font-size:13px; font-weight:bold; color:#b87900; text-transform:uppercase; letter-spacing:1px; border-bottom:2px solid #b87900; padding-bottom:6px; font-family: Arial, Helvetica, sans-serif;">Items Ordered</p>

                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:28px;">
                            <!-- Table Header -->
                            <tr bgcolor="#111111">
                                <td style="padding:10px 12px; font-size:12px; font-weight:bold; color:#ffffff; font-family: Arial, Helvetica, sans-serif; text-transform:uppercase; letter-spacing:0.5px;">Product</td>
                                <td style="padding:10px 12px; font-size:12px; font-weight:bold; color:#ffffff; font-family: Arial, Helvetica, sans-serif; text-transform:uppercase; letter-spacing:0.5px;" align="center">Size</td>
                                <td style="padding:10px 12px; font-size:12px; font-weight:bold; color:#ffffff; font-family: Arial, Helvetica, sans-serif; text-transform:uppercase; letter-spacing:0.5px;" align="center">Qty</td>
                                <td style="padding:10px 12px; font-size:12px; font-weight:bold; color:#ffffff; font-family: Arial, Helvetica, sans-serif; text-transform:uppercase; letter-spacing:0.5px;" align="right">Price</td>
                                <td style="padding:10px 12px; font-size:12px; font-weight:bold; color:#ffffff; font-family: Arial, Helvetica, sans-serif; text-transform:uppercase; letter-spacing:0.5px;" align="right">Total</td>
                            </tr>
                            @foreach($order->items as $index => $item)
                            <tr @if($index % 2 == 0) bgcolor="#fafafa" @else bgcolor="#ffffff" @endif>
                                <td style="padding:10px 12px; font-size:14px; color:#333333; font-family: Arial, Helvetica, sans-serif; border-bottom:1px solid #efe6d6;">{{ $item->product_name ?? '' }}</td>
                                <td style="padding:10px 12px; font-size:14px; color:#555555; font-family: Arial, Helvetica, sans-serif; border-bottom:1px solid #efe6d6;" align="center">{{ $item->varient ?? $item->size ?? '–' }}</td>
                                <td style="padding:10px 12px; font-size:14px; color:#555555; font-family: Arial, Helvetica, sans-serif; border-bottom:1px solid #efe6d6;" align="center">{{ $item->quantity ?? '' }}</td>
                                <td style="padding:10px 12px; font-size:14px; color:#555555; font-family: Arial, Helvetica, sans-serif; border-bottom:1px solid #efe6d6;" align="right">&#8377;{{ number_format($item->price ?? 0, 2) }}</td>
                                <td style="padding:10px 12px; font-size:14px; color:#333333; font-family: Arial, Helvetica, sans-serif; border-bottom:1px solid #efe6d6;" align="right"><strong>&#8377;{{ number_format($item->total ?? 0, 2) }}</strong></td>
                            </tr>
                            @endforeach
                        </table>

                        <!-- Order Summary -->
                        <p style="margin:0 0 16px 0; font-size:13px; font-weight:bold; color:#b87900; text-transform:uppercase; letter-spacing:1px; border-bottom:2px solid #b87900; padding-bottom:6px; font-family: Arial, Helvetica, sans-serif;">Order Summary</p>

                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:28px;">
                            <tr>
                                <td style="padding:10px 12px; font-size:14px; color:#555555; font-family: Arial, Helvetica, sans-serif; border-bottom:1px solid #efe6d6;">Subtotal</td>
                                <td style="padding:10px 12px; font-size:14px; color:#333333; font-family: Arial, Helvetica, sans-serif; border-bottom:1px solid #efe6d6;" align="right">&#8377;{{ number_format($order->subtotal ?? 0, 2) }}</td>
                            </tr>
                            <tr bgcolor="#fafafa">
                                <td style="padding:10px 12px; font-size:14px; color:#555555; font-family: Arial, Helvetica, sans-serif; border-bottom:1px solid #efe6d6;">GST</td>
                                <td style="padding:10px 12px; font-size:14px; color:#333333; font-family: Arial, Helvetica, sans-serif; border-bottom:1px solid #efe6d6;" align="right">&#8377;{{ number_format($order->gst_amount ?? 0, 2) }}</td>
                            </tr>
                            <tr>
                                <td style="padding:10px 12px; font-size:14px; color:#555555; font-family: Arial, Helvetica, sans-serif; border-bottom:1px solid #efe6d6;">Shipping</td>
                                <td style="padding:10px 12px; font-size:14px; color:#333333; font-family: Arial, Helvetica, sans-serif; border-bottom:1px solid #efe6d6;" align="right">&#8377;{{ number_format($order->shipping_charge ?? 0, 2) }}</td>
                            </tr>
                            @if(($order->coupon_discount ?? 0) > 0)
                            <tr bgcolor="#fafafa">
                                <td style="padding:10px 12px; font-size:14px; color:#28a745; font-family: Arial, Helvetica, sans-serif; border-bottom:1px solid #efe6d6;">Coupon Discount</td>
                                <td style="padding:10px 12px; font-size:14px; color:#28a745; font-family: Arial, Helvetica, sans-serif; border-bottom:1px solid #efe6d6;" align="right">– &#8377;{{ number_format($order->coupon_discount ?? 0, 2) }}</td>
                            </tr>
                            @endif
                            <tr bgcolor="#111111">
                                <td style="padding:14px 12px; font-size:16px; font-weight:bold; color:#ffffff; font-family: Arial, Helvetica, sans-serif;">Total Amount</td>
                                <td style="padding:14px 12px; font-size:16px; font-weight:bold; color:#b87900; font-family: Arial, Helvetica, sans-serif;" align="right">&#8377;{{ number_format($order->total_amount ?? 0, 2) }}</td>
                            </tr>
                        </table>

                        <!-- Shipping Address -->
                        <p style="margin:0 0 16px 0; font-size:13px; font-weight:bold; color:#b87900; text-transform:uppercase; letter-spacing:1px; border-bottom:2px solid #b87900; padding-bottom:6px; font-family: Arial, Helvetica, sans-serif;">Shipping Address</p>

                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:28px;">
                            <tr>
                                <td bgcolor="#fbf8f0" style="border-left:3px solid #b87900; padding:16px 18px;">
                                    <p style="margin:0 0 4px 0; font-size:15px; font-weight:bold; color:#111111; font-family: Arial, Helvetica, sans-serif;">{{ $order->shipping_name ?? '' }}</p>
                                    <p style="margin:0; font-size:14px; color:#555555; font-family: Arial, Helvetica, sans-serif; line-height:1.7;">
                                        {{ $order->shipping_door_no ?? '' }}{{ ($order->shipping_door_no ?? '') ? ', ' : '' }}{{ $order->shipping_street ?? '' }}<br>
                                        {{ $order->shipping_area ?? '' }}{{ ($order->shipping_area ?? '') ? ', ' : '' }}{{ $order->shipping_city ?? '' }}<br>
                                        {{ $order->shipping_state ?? '' }} – {{ $order->shipping_pincode ?? '' }}
                                    </p>
                                </td>
                            </tr>
                        </table>

                        <!-- Delivery Notice -->
                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:16px;">
                            <tr>
                                <td bgcolor="#fff8e1" style="border-left:3px solid #b87900; padding:14px 18px; border-radius:0 4px 4px 0;">
                                    <p style="margin:0; font-size:13px; color:#555555; font-family: Arial, Helvetica, sans-serif; line-height:1.6;">
                                        &#128666;&nbsp; Your order is expected to be delivered within <strong style="color:#b87900;">5–7 business days</strong>. You'll receive a tracking update once your order is dispatched.
                                    </p>
                                </td>
                            </tr>
                        </table>

                        <p style="margin:24px 0 0 0; font-size:14px; color:#888888; font-family: Arial, Helvetica, sans-serif; line-height:1.7;">
                            Questions about your order? Reach out to us anytime.<br>
                            <strong style="color:#111111;">The DARTE Team</strong>
                        </p>

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
