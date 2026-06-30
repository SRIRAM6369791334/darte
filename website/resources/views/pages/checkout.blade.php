@extends('layouts.app')

@section('content')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        .delivery-alert {
            background: #fff8e5;
            border-left: 6px solid #ed008c;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .alert-item {
            margin-bottom: 20px;
        }

        .alert-item:last-child {
            margin-bottom: 0;
        }

        .alert-item h5 {
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
        }

        .alert-item p {
            margin: 0;
            color: #555;
            font-size: 15px;
        }

        .modern-input-group label {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
            color: #1e293b;
        }

        .modern-input-group .form-control {
            height: 50px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            padding: 0 15px;
        }

        /* Courier Selection Styling */
        .courier-option {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .courier-option:hover {
            border-color: #ed008c;
            background-color: #fff5fb;
        }

        .courier-option.selected {
            border-color: #ed008c;
            background-color: #fff5fb;
            box-shadow: 0 0 10px rgba(237, 0, 140, 0.1);
        }

        .courier-info {
            flex-grow: 1;
        }

        .courier-name {
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 2px;
            display: block;
        }

        .courier-etd {
            font-size: 13px;
            color: #64748b;
        }

        .courier-rate {
            font-weight: 700;
            color: #ed008c;
            font-size: 16px;
        }

        .courier-radio {
            margin-right: 15px;
            accent-color: #ed008c;
        }

        #courier_selection_container {
            margin-top: 25px;
            border-top: 2px dashed #e2e8f0;
            padding-top: 20px;
        }
         .content-inner {
        background: white !important;
    }
.content-inner-1 {
        background: white !important;
        /* padding-top: 30px !important;
            padding-bottom: 30px !important; */
    }

    /* Banner Overrides for this page */
    /* .dz-bnr-inr {
            padding-top: 240px !important;
        } */

  @media only screen and (max-width: 1480px) {
    .content-inner {
        padding-top: 187px;
        padding-bottom: 117px;
    }
}
    @media (max-width: 767px) {
        .dz-bnr-inr {
            min-height: 172px !important;
            height: 130px !important;
        }
        .dz-bnr-inr .dz-bnr-inr-entry {
            padding: 0px;
            text-align: center;
            display: table-cell;
        }
    }
    </style>

    <div class="dz-bnr-inr bg-secondary overlay-black-light" style="background-image:url(assets/images/background/bg1.webp);">
        <div class="container">
            <div class="dz-bnr-inr-entry">
                <h1 class="color1">Shop Checkout</h1>
                <nav aria-label="breadcrumb" class="breadcrumb-row">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> Home</a></li>
                        <li class="breadcrumb-item">Shop Checkout</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="content-inner-1">
        <div class="container">
            <form id="checkoutForm">
                @csrf
                <div class="row shop-checkout">
                    <div class="col-xl-7">
                        <h4 class="title m-b15">Your Information & Shipping Address</h4>
                        <div id="shipping_fields" class="shipping-details-form"
                            style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 25px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                            <div class="row g-4">
                                <div class="col-12 m-b20">
                                    <div class="modern-input-group">
                                        <label for="shipping_name">Full Name <span style="color:#ef4444">*</span></label>
                                        <input id="shipping_name" name="shipping_name" type="text"
                                            class="form-control" required value="{{ $addr->name }}" placeholder="Enter your full name">
                                    </div>
                                </div>
                                <div class="col-md-6 m-b20">
                                    <div class="modern-input-group">
                                        <label for="shipping_email">Email Address <span style="color:#ef4444">*</span></label>
                                        <input id="shipping_email" name="shipping_email" type="email"
                                            class="form-control" required value="{{ $user->email }}" placeholder="example@email.com">
                                    </div>
                                </div>
                                <div class="col-md-6 m-b20">
                                    <div class="modern-input-group">
                                        <label for="shipping_phone">Phone Number <span style="color:#ef4444">*</span></label>
                                        <input id="shipping_phone" name="shipping_phone" type="text"
                                            class="form-control" required value="{{ $addr->phone }}" placeholder="+91 0000000000">
                                    </div>
                                </div>
                                <div class="col-md-6 m-b20">
                                    <div class="modern-input-group">
                                        <label for="shipping_door_no">Door No/Flat No <span style="color:#ef4444">*</span></label>
                                        <input id="shipping_door_no" name="shipping_door_no" type="text"
                                            class="form-control" required value="{{ $addr->door_no }}" placeholder="e.g. 42A">
                                    </div>
                                </div>
                                <div class="col-md-6 m-b20">
                                    <div class="modern-input-group">
                                        <label for="shipping_street">Street Name <span style="color:#ef4444">*</span></label>
                                        <input id="shipping_street" name="shipping_street" type="text"
                                            class="form-control" required value="{{ $addr->street }}" placeholder="e.g. MG Road">
                                    </div>
                                </div>
                                <div class="col-md-6 m-b20">
                                    <div class="modern-input-group">
                                        <label for="shipping_area">Area/Landmark <span style="color:#ef4444">*</span></label>
                                        <input id="shipping_area" name="shipping_area" type="text"
                                            class="form-control" required value="{{ $addr->area }}" placeholder="Near Central Park">
                                    </div>
                                </div>
                                <div class="col-md-6 m-b20">
                                    <div class="modern-input-group">
                                        <label for="shipping_state">State <span style="color:#ef4444">*</span></label>
                                        <select id="shipping_state" name="shipping_state" class="form-control" required style="height:50px; border-radius:8px; border:1px solid #cbd5e1; padding:0 15px;">
                                            <option value="">Select State</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->name }}"
                                                    {{ trim($userState) == trim($state->name) ? 'selected' : '' }}
                                                    data-charge="{{ $state->shipping_charge }}">
                                                    {{ $state->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 m-b20">
                                    <div class="modern-input-group">
                                        <label for="shipping_city">City <span style="color:#ef4444">*</span></label>
                                        <select id="shipping_city_select" name="shipping_city" class="form-control" style="height:50px; border-radius:8px; border:1px solid #cbd5e1; padding:0 15px;">
                                            <option value="">Select City</option>
                                        </select>
                                        <input type="text" id="shipping_city_input" name="" class="form-control" style="height:50px; border-radius:8px; border:1px solid #cbd5e1; padding:0 15px; display:none;" placeholder="Enter City Name">
                                        <input type="hidden" id="preselected_city" value="{{ $userCity }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="modern-input-group">
                                        <label for="shipping_pincode">Pincode <span style="color:#ef4444">*</span></label>
                                        <input id="shipping_pincode" name="shipping_pincode" type="text"
                                            class="form-control" required value="{{ $addr->pincode }}" maxlength="6" placeholder="Enter 6-digit Pincode">
                                    </div>
                                </div>
                            </div>

                            <div id="courier_selection_container" class="mt-4 p-3" style="display:none; border: 1px solid #ed008c; border-radius: 12px; background: #fffbff;">
                                <h5 class="mb-3" style="color: #ed008c;"><i class="fas fa-truck me-2"></i> Select Shipping Courier</h5>
                                <div id="courier_list">
                                    <!-- Couriers will be loaded here via AJAX -->
                                </div>
                                <input type="hidden" name="selected_courier_id" id="selected_courier_id">
                                <input type="hidden" name="selected_courier_name" id="selected_courier_name">
                            </div>

                            <div id="courier_loading" class="text-center py-4" style="display:none;">
                                <div class="spinner-border text-primary" role="status" style="color: #ed008c !important;">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="mt-2 text-muted fw-bold">Calculating shipping rates...</p>
                            </div>
                        </div>

                        <!-- <div class="delivery-alert mt-4">
                            <h4 class="fw-bold">Important Note</h4>
                            <div class="alert-item">
                                <h5>Tamil Nadu Orders</h5>
                                <p>Orders placed within Tamil Nadu are typically delivered within <strong>2 business days</strong> from the date of dispatch.</p>
                            </div>
                            <div class="alert-item">
                                <h5>All-India Delivery</h5>
                                <p>Orders shipped to other parts of India are usually delivered within <strong>3–7 business days</strong>.</p>
                            </div>
                        </div> -->
                    </div>

                    <div class="col-xl-5 side-bar">
                        <h4 class="title m-b15">Your Order</h4>
                        <div class="order-detail sticky-top">
                            @foreach ($cartItems as $item)
                                <div class="cart-item style-1">
                                    <div class="dz-media">
                                        <img src="{{ env('MAIN_URL') . 'images/' . ($item->variant->image ?? $item->product->product_image) }}" alt="/">
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="title mb-0">{{ $item->product->product_name }} <br> x {{ $item->product_quantity }}</h6>
                                        <span class="price">₹{{ number_format($item->variant->offer_price ?? $item->product->product_price, 2) }}</span>
                                    </div>
                                </div>
                            @endforeach

                            <table>
                                <tbody>
                                    <tr class="subtotal">
                                        <td>Subtotal</td>
                                        <td class="price">₹{{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                    <tr class="gst">
                                        <td>Total GST</td>
                                        <td class="price">₹{{ number_format($totalGst, 2) }}</td>
                                    </tr>
                                    <tr class="shipping">
                                        <td>Shipping</td>
                                        <td class="price" id="shipping_charge_display">₹{{ number_format($shippingCharge, 2) }}</td>
                                    </tr>
                                    <tr class="discount">
                                        <td>Coupon Discount</td>
                                        <td class="price text-danger" id="coupon_discount_display">-₹0.00</td>
                                    </tr>
                                    <tr class="total">
                                        <td>Total</td>
                                        <td class="price" id="total_amount_display">₹{{ number_format($totalAmount, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="coupon-box m-b20">
                                <label class="form-label font-weight-600">Have a Coupon?</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="coupon_code" placeholder="Enter coupon code">
                                    <button type="button" class="btn btn-secondary" id="applyCouponBtn">Apply</button>
                                </div>
                                <p id="couponMessage" class="mt-2 small"></p>

                                <input type="hidden" name="coupon_discount" id="coupon_discount" value="0">
                                <input type="hidden" name="shipping_charge" id="shipping_charge" value="{{ $shippingCharge }}">
                                <input type="hidden" name="applied_coupon_code" id="applied_coupon_code">
                            </div>

                            <h4 class="title m-b15">Payment Method</h4>
                            <div class="payment-method-selection m-b20">
                                <div class="custom-control custom-radio m-b10">
                                    <input class="form-check-input" type="radio" name="payment_method" id="cod" value="Cash on Delivery" checked>
                                    <label class="form-check-label font-weight-600" for="cod">
                                        Cash on Delivery
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="form-check-input" type="radio" name="payment_method" id="online" value="Online Payment">
                                    <label class="form-check-label font-weight-600" for="online">
                                        Online Payment
                                    </label>
                                </div>
                            </div>

                            <!-- <div class="form-group m-b15">
                                <p class="text">By placing this order, you agree to our <a href="javascript:void(0);">terms and conditions.</a></p>
                            </div>
                             -->
                            <button type="submit" class="btn btn-secondary w-100" id="placeOrderBtn">Pay & Place Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkoutForm = document.getElementById('checkoutForm');
            const shippingState = document.getElementById('shipping_state');
            const shippingChargeDisplay = document.getElementById('shipping_charge_display');
            const shippingChargeInput = document.getElementById('shipping_charge');
            const couponDiscountDisplay = document.getElementById('coupon_discount_display');
            const totalAmountDisplay = document.getElementById('total_amount_display');

            const subtotal = parseFloat("{{ $subtotal }}") || 0;
            const totalGst = parseFloat("{{ $totalGst }}") || 0;
            let shippingCharge = 0; // Starts at 0 until courier is selected
            let couponDiscount = 0;
            const pincodeInput = document.getElementById('shipping_pincode');
            const courierContainer = document.getElementById('courier_selection_container');
            const courierList = document.getElementById('courier_list');
            const courierLoading = document.getElementById('courier_loading');
            const paymentRadios = document.querySelectorAll('input[name="payment_method"]');

            function updateSummary() {
                const total = Math.max(subtotal + totalGst + shippingCharge - couponDiscount, 0);
                
                shippingChargeDisplay.innerText = `₹${shippingCharge.toLocaleString('en-IN', {minimumFractionDigits: 2})}`;
                couponDiscountDisplay.innerText = `-₹${couponDiscount.toLocaleString('en-IN', {minimumFractionDigits: 2})}`;
                totalAmountDisplay.innerText = `₹${total.toLocaleString('en-IN', {minimumFractionDigits: 2})}`;
                shippingChargeInput.value = shippingCharge;
            }

            function fetchShippingCharge() {
                const stateName = shippingState.value;
                if (!stateName) {
                    shippingCharge = 0;
                    updateSummary();
                    return;
                }

                fetch("{{ route('get-shipping-charge') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ state_name: stateName })
                })
                .then(res => res.json())
                .then(result => {
                    if (result.status === 'success') {
                        shippingCharge = parseFloat(result.shipping_charge) || 0;
                        updateSummary();
                    }
                });
            }

            const shippingCitySelect = document.getElementById('shipping_city_select');
            const shippingCityInput = document.getElementById('shipping_city_input');
            const preselectedCity = document.getElementById('preselected_city')?.value || '';

            function fetchCitiesByState(stateName, preselectCity) {
                // Clear current city options
                shippingCitySelect.innerHTML = '<option value="">Loading...</option>';

                if (!stateName) {
                    shippingCitySelect.innerHTML = '<option value="">Select City</option>';
                    shippingCitySelect.style.display = 'block';
                    shippingCitySelect.name = 'shipping_city';
                    shippingCitySelect.required = true;
                    
                    shippingCityInput.style.display = 'none';
                    shippingCityInput.name = '';
                    shippingCityInput.required = false;
                    return;
                }

                fetch("{{ route('get-cities-by-state') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ state_name: stateName })
                })
                .then(res => res.json())
                .then(result => {
                    if (result.status === 'success' && result.cities.length > 0) {
                        shippingCitySelect.style.display = 'block';
                        shippingCitySelect.name = 'shipping_city';
                        shippingCitySelect.required = true;
                        
                        shippingCityInput.style.display = 'none';
                        shippingCityInput.name = '';
                        shippingCityInput.required = false;

                        shippingCitySelect.innerHTML = '<option value="">Select City</option>';
                        result.cities.forEach(function(city) {
                            const opt = document.createElement('option');
                            opt.value = city;
                            opt.textContent = city;
                            if (preselectCity && city.trim() === preselectCity.trim()) {
                                opt.selected = true;
                            }
                            shippingCitySelect.appendChild(opt);
                        });
                    } else {
                        // No cities found for this state - allow manual input
                        shippingCitySelect.style.display = 'none';
                        shippingCitySelect.name = '';
                        shippingCitySelect.required = false;
                        
                        shippingCityInput.style.display = 'block';
                        shippingCityInput.name = 'shipping_city';
                        shippingCityInput.required = true;
                        
                        if (preselectCity) {
                            shippingCityInput.value = preselectCity;
                        } else {
                            shippingCityInput.value = '';
                        }
                    }
                })
                .catch(() => {
                    shippingCitySelect.innerHTML = '<option value="">Select City</option>';
                });
            }

            if (shippingState) {
                shippingState.addEventListener('change', function() {
                    fetchShippingCharge();
                    fetchCitiesByState(this.value, '');
                });

                // Load cities for pre-selected state on page load
                if (shippingState.value) {
                    fetchCitiesByState(shippingState.value, preselectedCity);
                }
            }

            // Coupon Logic
            $('#applyCouponBtn').click(function() {
                const couponCode = $('#coupon_code').val().trim();
                if (!couponCode) return;

                $.ajax({
                    url: "{{ route('apply-coupon') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        coupon_code: couponCode,
                        subtotal: subtotal
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            couponDiscount = parseFloat(res.discount) || 0;
                            $('#coupon_discount').val(couponDiscount);
                            $('#applied_coupon_code').val(couponCode);
                            $('#couponMessage').text('✓ ' + res.message).css('color', 'green');
                        } else {
                            couponDiscount = 0;
                            $('#coupon_discount').val(0);
                            $('#couponMessage').text('❌ ' + res.message).css('color', 'red');
                        }
                        updateSummary();
                    }
                });
            });

            // Shiprocket Courier Logic
            function fetchCouriers() {
                const pincode = pincodeInput.value.trim();
                const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

                if (pincode.length !== 6) {
                    courierContainer.style.display = 'none';
                    return;
                }

                courierLoading.style.display = 'block';
                courierContainer.style.display = 'none';
                courierList.innerHTML = '';
                
                // Reset shipping selection
                shippingCharge = 0;
                document.getElementById('selected_courier_id').value = '';
                document.getElementById('selected_courier_name').value = '';
                updateSummary();

                $.ajax({
                    url: "{{ route('get-couriers') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        pincode: pincode,
                        payment_method: paymentMethod
                    },
                    success: function(res) {
                        courierLoading.style.display = 'none';
                        if (res.status === 'success' && res.couriers.length > 0) {
                            courierContainer.style.display = 'block';
                            res.couriers.forEach(function(c) {
                                const card = `
                                    <div class="courier-option" data-id="${c.id}" data-rate="${c.rate}" data-name="${c.name}">
                                        <div class="d-flex align-items-center">
                                            <input type="radio" name="courier_choice" class="courier-radio" value="${c.id}">
                                            <div class="courier-info">
                                                <span class="courier-name">${c.name}</span>
                                                <span class="courier-etd">Expected Delivery: ${c.etd}</span>
                                            </div>
                                        </div>
                                        <div class="courier-rate">₹${c.rate}</div>
                                    </div>
                                `;
                                courierList.insertAdjacentHTML('beforeend', card);
                            });

                            // Courier Click Logic
                            $('.courier-option').click(function() {
                                $('.courier-option').removeClass('selected');
                                $(this).addClass('selected');
                                $(this).find('input[type="radio"]').prop('checked', true);
                                
                                shippingCharge = parseFloat($(this).data('rate'));
                                document.getElementById('selected_courier_id').value = $(this).data('id');
                                document.getElementById('selected_courier_name').value = $(this).data('name');
                                updateSummary();
                            });
                        } else {
                            Swal.fire({
                                icon: 'info',
                                title: 'Notice',
                                text: res.message || 'No shipping options found for this pincode.'
                            });
                        }
                    },
                    error: function() {
                        courierLoading.style.display = 'none';
                        Swal.fire({ icon: 'error', title: 'Error', text: 'Failed to fetch shipping rates.' });
                    }
                });
            }

            pincodeInput.addEventListener('input', function() {
                if (this.value.length === 6) {
                    fetchCouriers();
                } else {
                    courierContainer.style.display = 'none';
                    shippingCharge = 0;
                    updateSummary();
                }
            });

            // Re-fetch if payment method changes (COD rates differ)
            paymentRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (pincodeInput.value.length === 6) {
                        fetchCouriers();
                    }
                });
            });

            // Initial load if pincode exists
            if (pincodeInput.value.length === 6) {
                fetchCouriers();
            }

            // Form Submit
            checkoutForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const btn = document.getElementById('placeOrderBtn');
                const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

                if (paymentMethod === 'Online Payment') {
                    btn.disabled = true;
                    btn.innerText = 'Initializing Payment...';

                    const formData = new FormData(this);
                    const data = Object.fromEntries(formData.entries());

                    fetch("{{ route('payment.prepare') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify(data)
                    })
                    .then(res => res.json())
                    .then(res => {
                        if (res.status === 'success') {
                            const options = {
                                "key": res.razorpay_key,
                                "amount": Math.round(res.amount * 100),
                                "currency": "INR",
                                "name": "Darte Checkout",
                                "description": "Order Payment",
                                "order_id": res.razorpay_order_id,
                                "handler": function (response) {
                                    data.razorpay_payment_id = response.razorpay_payment_id;
                                    data.razorpay_order_id = response.razorpay_order_id;
                                    data.razorpay_signature = response.razorpay_signature;
                                    finalizeOrder(data);
                                },
                                "prefill": {
                                    "name": res.user.name,
                                    "email": res.user.email,
                                    "contact": res.user.phone
                                },
                                "theme": { "color": "#ed008c" },
                                "modal": {
                                    "ondismiss": function() {
                                        btn.disabled = false;
                                        btn.innerText = 'Pay & Place Order';
                                    }
                                }
                            };
                            const rzp = new Razorpay(options);
                            rzp.open();
                        } else {
                            Swal.fire({ icon: 'error', title: 'Error', text: res.message });
                            btn.disabled = false;
                            btn.innerText = 'Pay & Place Order';
                        }
                    })
                    .catch(() => {
                        Swal.fire({ icon: 'error', title: 'Error', text: 'Failed to initiate payment.' });
                        btn.disabled = false;
                        btn.innerText = 'Pay & Place Order';
                    });
                } else {
                    const formData = new FormData(this);
                    const data = Object.fromEntries(formData.entries());
                    finalizeOrder(data);
                }
            });

            function finalizeOrder(data) {
                // Ensure courier is selected
                const courierId = document.getElementById('selected_courier_id').value;
                if (!courierId) {
                    Swal.fire({ icon: 'warning', title: 'Selection Required', text: 'Please select a shipping courier first.' });
                    const btn = document.getElementById('placeOrderBtn');
                    btn.disabled = false;
                    btn.innerText = 'Pay & Place Order';
                    return;
                }

                const btn = document.getElementById('placeOrderBtn');
                btn.disabled = true;
                btn.innerText = 'Placing Order...';

                fetch("{{ route('order.place') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify(data)
                })
                .then(res => res.json())
                .then(result => {
                    if (result.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Order successfully placed!',
                            text: 'Order Number: ' + result.order_number
                        }).then(() => {
                            window.location.href = "{{ route('thankyou') }}";
                        });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Error', text: result.message });
                        btn.disabled = false;
                        btn.innerText = 'Pay & Place Order';
                    }
                })
                .catch(() => {
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Something went wrong!' });
                    btn.disabled = false;
                    btn.innerText = 'Pay & Place Order';
                });
            }
        });
    </script>
@endsection
