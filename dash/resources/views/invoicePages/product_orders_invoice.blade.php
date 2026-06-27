@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Laralink">
    <title>Product Order Details</title>
    <link rel="stylesheet" href="{{ asset('assets/css/invoice_style.css') }}">
</head>

<body>
    <div class="tm_container">
        <div class="tm_invoice_wrap">
            <div class="tm_invoice tm_style1 tm_type1" id="tm_download_section">
                <div class="tm_invoice_in">
                    <div class="tm_invoice_head tm_top_head tm_mb15 tm_align_center">
                        <div class="tm_invoice_left">
                            <div class="tm_logo"></div>
                            <h2>DARTE</h2>
                        </div>
                        <div class="tm_invoice_right tm_text_right tm_mobile_hide">
                            <div class="tm_f40 tm_text_uppercase tm_white_color">Order Details</div>
                        </div>
                        <div class="tm_shape_bg tm_accent_bg tm_mobile_hide"></div>
                    </div>

                    <div class="tm_invoice_info tm_mb25">
                        <div class="tm_card_note tm_mobile_hide"></div>
                        <div class="tm_invoice_info_list tm_white_color">
                            @if ($products->isNotEmpty())
                                <p class="tm_invoice_number tm_m0">Order No: <b>{{ $products[0]->order_id }}</b></p>
                                <p class="tm_invoice_date tm_m0">Date:
                                    <b>{{ Carbon::parse($products[0]->delivery_date)->format('d-m-Y') }}</b>
                                </p>
                            @else
                                <p class="tm_invoice_number tm_m0"><b>No Order Data</b></p>
                            @endif
                        </div>
                        <div class="tm_invoice_seperator tm_accent_bg"></div>
                    </div>

                    <div class="tm_invoice_head tm_mb10">
                        <div class="tm_invoice_left">
                            @php
                                $billingAddress = $addresses->where('address_type_name', 'billing')->first();
                                $shippingAddress =
                                    $addresses->where('address_type_name', 'shipping')->first() ?? $billingAddress;
                            @endphp
                            @if ($billingAddress)
                                <p class="tm_mb2"><b class="tm_primary_color">Billing Address:</b></p>
                                <p class="mb-2" style="margin-bottom:20px;">
                                    {{ $billingAddress->firstname }} <br>
                                    {{ $billingAddress->address_line_one }} <br>
                                    {{ $billingAddress->address_line_two }} <br>
                                    {{ $billingAddress->city }} - {{ $billingAddress->state }} <br>
                                    {{ $billingAddress->country->name ?? '' }} - {{ $billingAddress->pincode }} <br>
                                    <b>{{ $billingAddress->phonecode }} -
                                        {{ $billingAddress->address_phone_number }}</b>
                                </p>
                            @endif
                        </div>
                        <div class="tm_invoice_right tm_text_right">
                            @if ($shippingAddress)
                                <p class="tm_mb2"><b class="tm_primary_color">Shipping Address:</b></p>
                                <p class="mb-2" style="margin-bottom:20px;">
                                    {{ $shippingAddress->firstname }} <br>
                                    {{ $shippingAddress->address_line_one }} <br>
                                    {{ $shippingAddress->address_line_two }} <br>
                                    {{ $shippingAddress->city }} - {{ $shippingAddress->state }} <br>
                                    {{ $shippingAddress->country->name ?? '' }} - {{ $shippingAddress->pincode }} <br>
                                    <b>{{ $shippingAddress->phonecode }} -
                                        {{ $shippingAddress->address_phone_number }}</b>
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="tm_table tm_style1" style="margin-top: 60px">
                        <div class="tm_table_responsive">
                            <table>
                                <thead>
                                    <tr class="tm_accent_bg">
                                        <th class="tm_width_1 tm_semi_bold tm_white_color">S.No</th>
                                        <th class="tm_width_3 tm_semi_bold tm_white_color">Item</th>
                                        <th class="tm_width_1 tm_semi_bold tm_white_color">Unit</th>
                                        <th class="tm_width_1 tm_semi_bold tm_white_color"></th>
                                        <th class="tm_width_2 tm_semi_bold tm_white_color">Price</th>
                                        <th class="tm_width_1 tm_semi_bold tm_white_color">Qty</th>
                                        <th class="tm_width_2 tm_semi_bold tm_white_color">GST %</th>
                                        <th class="tm_width_2 tm_semi_bold tm_white_color">GST Amt</th>
                                        <th class="tm_width_2 tm_semi_bold tm_white_color tm_text_right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $calculatedSubTotal = 0;
                                        $discount = $order->discount_amount ?? 0;
                                        $shipping = $order->delivery_charge ?? ($order->shipping_charge ?? 0);
                                        $shippingtype = $order->shipcharge_type ?? 'standard';
                                    @endphp

                                    @foreach ($products as $product)
                                        @php
                                            // Subtotal calculate pandrom (Price * Qty + GST)
                                            // Neenga database value-va use pandreenga, so adhai summation pandrom
                                            $calculatedSubTotal += (float) $product->product_total;
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="tm_width_3">
                                                {{ $product->product_name }}
                                                @if ($product->preorder == 1)
                                                    <span class="badge bg-warning text-dark ms-2"
                                                        style="background: #f9ed34; color: #000;">Pre Order</span>
                                                    @if ($product->dispatch_date)
                                                        <small class="text-muted d-block"> Dispatch:
                                                            {{ \Carbon\Carbon::parse($product->dispatch_date)->format('d M Y') }}</small>
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="tm_width_1">
                                                {{ $product->productVarient->value ?? '' }}
                                                {{ optional(optional($product->productVarient)->unit)->short_name ?? '' }}
                                            </td>
                                            <td class="tm_width_1"></td>
                                            <td class="tm_width_2">₹{{ number_format($product->product_rate, 2) }}</td>
                                            <td class="tm_width_1">{{ $product->quantity }}</td>
                                            <td class="tm_width_1">{{ $product->gst_per }}%</td>
                                            <td class="tm_width_1">₹{{ number_format($product->gst_amt, 2) }}</td>
                                            <td class="tm_width_2 tm_text_right">
                                                ₹{{ number_format($product->product_total, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="tm_invoice_footer tm_border_top tm_mb15 tm_m0_md">
                            <div class="tm_left_footer"></div>
                            <div class="tm_right_footer">
                                <table class="tm_mb15">
                                    <tbody>
                                        <tr class="tm_accent_bg">
                                            <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color">Items
                                                Total</td>
                                            <td
                                                class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color tm_text_right">
                                                ₹ {{ number_format($calculatedSubTotal, 2) }}
                                            </td>
                                        </tr>
                                        @if ($discount > 0)
                                            <tr class="tm_accent_bg">
                                                <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color">
                                                    Coupon Discount</td>
                                                <td
                                                    class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color tm_text_right">
                                                    - ₹ {{ number_format($discount, 2) }}
                                                </td>
                                            </tr>
                                        @endif
                                        <tr class="tm_accent_bg">
                                            <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color">
                                                Shipping Charge
                                                @if ($shipping != 0)
                                                    ({{ ucfirst($shippingtype) }})
                                                @endif
                                            </td>
                                            <td
                                                class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color tm_text_right">
                                                @if ($shipping == 0)
                                                    <span style="font-size:11px;color:#fff;">Free Shipping</span>
                                                @else
                                                    ₹ {{ number_format($shipping, 2) }}
                                                @endif
                                            </td>
                                        </tr>
                                        @php
                                            // Final Grand Total Calculation
                                            $finalGrandTotal = $calculatedSubTotal - $discount + $shipping;
                                        @endphp
                                        <tr class="tm_accent_bg">
                                            <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color">Grand
                                                Total</td>
                                            <td
                                                class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color tm_text_right">
                                                ₹ {{ number_format($finalGrandTotal, 2) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tm_invoice_btns tm_hide_print">
                <a href="javascript:window.print()" class="tm_invoice_btn tm_color1">
                    <span class="tm_btn_icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                            <path
                                d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24"
                                fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                            <rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32"
                                fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                            <path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none"
                                stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                            <circle cx="392" cy="184" r="24" fill='currentColor' />
                        </svg>
                    </span>
                    <span class="tm_btn_text">Print</span>
                </a>
                <button id="tm_download_btn" class="tm_invoice_btn tm_color2">
                    <span class="tm_btn_icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                            <path
                                d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03"
                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="32" />
                        </svg>
                    </span>
                    <span class="tm_btn_text">Download</span>
                </button>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/invoice/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/invoice/jspdf.min.js') }}"></script>
    <script src="{{ asset('assets/js/invoice/html2canvas.min.js') }}"></script>
    <script src="{{ asset('assets/js/invoice/main.js') }}"></script>
</body>

</html>
