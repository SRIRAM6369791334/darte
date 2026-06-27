@extends('layouts.app')
@section('content')
    <style>
        .content-inner{
            background: white !important;
        }
    </style>
    <div class="page-content bg-light">

        <div class="dz-bnr-inr bg-secondary overlay-black-light"
            style="background-image:url(assets/images/background/bg1.webp);">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1 class="color1">Shop Cart</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"> Home</a></li>
                            <li class="breadcrumb-item">Shop Cart</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Banner End -->

        <!-- contact area -->
        <section class="content-inner shop-account">
            <!-- Product -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="table-responsive">
                            <table class="table check-tbl">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th></th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($cartItems as $item)
                                        <tr id="cart-item-{{ $item->id }}">
                                            <td class="product-item-img">
                                                <img src="{{ env('MAIN_URL') . 'images/' . ($item->variant->image ?? $item->product->product_image) }}"
                                                    alt="/">
                                            </td>
                                            <td class="product-item-name">
                                                {{ $item->product->product_name }}
                                                @if ($item->product->variants->count() > 0)
                                                    <br>
                                                    <div class="mt-1" style="display: flex;">
                                                        <small class="text-dark d-block">Size:</small>
                                                        <select class="form-select form-select-sm d-inline-block w-auto"
                                                            onchange="updateSize({{ $item->id }}, this.value)"
                                                            style="padding: 2px 10px; font-size: 16px; height: auto; border: 1px solid #ccc;width: 60px !important;color: #000000;">
                                                            @foreach ($item->product->variants as $variant)
                                                                <option value="{{ $variant->id }}"
                                                                    {{ $item->product_varient_id == $variant->id ? 'selected' : '' }}>
                                                                    {{ $variant->varient }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @elseif($item->variant)
                                                    <br><small class="text-dark">Size: {{ $item->variant->value }}</small>
                                                @endif
                                            </td>
                                            <td class="product-item-price" id="price-{{ $item->id }}">
                                                ₹{{ $item->variant->offer_price ?? ($item->product->product_regular_price ?? $item->product->product_mrp_price) }}
                                            </td>
                                            <td class="product-item-quantity">
                                                <div class="quantity btn-quantity style-1 me-3 d-flex align-items-center flex-nowrap">
                                                    <button class="btn btn-sm btn-light qty-btn"
                                                        onclick="updateQty({{ $item->id }}, 'decrement')"
                                                        style="min-width: 50px; height: 50px; font-weight: bold; border-radius: 50px;background: #000000 !important;font-size: 20px;color:#fff;">-</button>
                                                    <input id="qty-{{ $item->id }}" type="text"
                                                        value="{{ $item->product_quantity }}" readonly
                                                        style="width: 40px; text-align: center; border: none;">
                                                    <button class="btn btn-sm btn-light qty-btn"
                                                        onclick="updateQty({{ $item->id }}, 'increment')"
                                                        style="min-width: 50px; height: 50px; font-weight: bold; border-radius: 50px;background: #000000 !important;font-size: 20px;color:#fff;">+</button>
                                                </div>
                                            </td>
                                            <td class="product-item-totle" id="subtotal-{{ $item->id }}">
                                                ₹{{ ($item->variant->offer_price ?? ($item->product->product_regular_price ?? $item->product->product_mrp_price)) * $item->product_quantity }}
                                            </td>
                                            <td class="product-item-close">
                                                <a href="javascript:void(0);"
                                                    onclick="removeFromCart({{ $item->id }})">
                                                    <i class="ti-close"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Your cart is empty. <a
                                                    href="{{ route('shop') }}">Go shopping</a></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="row shop-form m-t30">
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                 <div class="input-group mb-0">
                                  <input name="dzEmail" required="required" type="text" class="form-control"
                                   placeholder="Coupon Code">
                                  <div class="input-group-addon">
                                   <button name="submit" value="Submit" type="submit" class="btn coupon">
                                    Apply Coupon
                                   </button>
                                  </div>
                                 </div>
                                </div>
                               </div> -->
                            <div class="col-md-12 text-end">
                                <button onclick="removeAllFromCart()" class="btn btn-secondary">Remove All</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <h4 class="title mb15">Cart Total</h4>
                        <div class="cart-detail">
                            <!-- <a href="javascript:void(0);" class="btn btn-outline-secondary w-100 m-b20">Bank Offer 5%
                              Cashback</a>
                             <div class="icon-bx-wraper style-4 m-b15">
                              <div class="icon-bx">
                               <i class="flaticon flaticon-ship"></i>
                              </div>
                              <div class="icon-content">
                               <span class=" font-14">FREE</span>
                               <h6 class="dz-title">Enjoy The Product</h6>
                              </div>
                             </div>
                             <div class="icon-bx-wraper style-4 m-b30">
                              <div class="icon-bx">
                               <img src="assets/images/shop/shop-cart/icon-box/pic2.webp" alt="/">
                              </div>
                              <div class="icon-content">
                               <h6 class="dz-title">Enjoy The Product</h6>
                               <p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
                              </div>
                             </div>
                             <div class="save-text">
                              <i class="icon feather icon-check-circle"></i>
                              <span class="m-l10">You will save ₹504 on this order</span>
                             </div> -->
                            <table>
                                <tbody>
                                    <tr class="total">
                                        <td>
                                            <h6 class="mb-0">Total</h6>
                                        </td>
                                        <td class="price" id="cart-total">
                                            ₹{{ $subtotal }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="{{ route('checkout') }}" class="btn btn-secondary w-100">PLACE ORDER</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product END -->
        </section>

        <script>
            const CSRF_TOKEN = '{{ csrf_token() }}';
            const shopUrl = '{{ route('shop') }}';

            function updateQty(cartId, action) {
                fetch("{{ route('cart.update') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': CSRF_TOKEN
                        },
                        body: JSON.stringify({
                            cart_id: cartId,
                            action: action
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('qty-' + cartId).value = data.new_qty;
                            document.getElementById('subtotal-' + cartId).innerText = '₹' + data.item_subtotal;
                            document.getElementById('cart-total').innerText = '₹' + data.cart_total;
                            // qty change doesn't change item count, no badge update needed
                        } else {
                            Swal.fire('Error', data.message, 'error');
                        }
                    });
            }

            function removeFromCart(cartId) {
                Swal.fire({
                    title: 'Remove item?',
                    text: 'Are you sure you want to remove this item from your cart?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, remove it',
                    cancelButtonText: 'Cancel'
                }).then(result => {
                    if (!result.isConfirmed) return;
                    fetch("{{ route('cart.remove') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': CSRF_TOKEN
                            },
                            body: JSON.stringify({
                                cart_id: cartId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const row = document.getElementById('cart-item-' + cartId);
                                if (row) row.remove();
                                recalcTotal();
                                updateHeaderCounts(); // ← sync header badge
                                Swal.fire('Removed!', data.message, 'success');
                            } else {
                                Swal.fire('Error', data.message, 'error');
                            }
                        });
                });
            }

            function removeAllFromCart() {
                Swal.fire({
                    title: 'Clear cart?',
                    text: 'This will remove ALL items from your cart. Continue?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, clear it',
                    cancelButtonText: 'Cancel'
                }).then(result => {
                    if (!result.isConfirmed) return;
                    fetch("{{ route('cart.remove-all') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': CSRF_TOKEN
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Remove all cart rows from the table
                                document.querySelectorAll('tr[id^="cart-item-"]').forEach(row => row.remove());
                                // Reset total
                                document.getElementById('cart-total').innerText = '₹0';
                                // Show empty message
                                const tbody = document.querySelector('.check-tbl tbody');
                                tbody.innerHTML =
                                    '<tr><td colspan="6" class="text-center">Your cart is empty. <a href="' +
                                    shopUrl + '">Go shopping</a></td></tr>';
                                updateHeaderCounts(); // ← sync header badge to 0
                                Swal.fire('Cleared!', data.message, 'success');
                            } else {
                                Swal.fire('Error', data.message, 'error');
                            }
                        });
                });
            }

            function updateSize(cartId, variantId) {
                fetch("{{ route('cart.update-size') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': CSRF_TOKEN
                        },
                        body: JSON.stringify({
                            cart_id: cartId,
                            variant_id: variantId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            if (data.merged) {
                                // If merged, the current row is deleted, and another row is updated
                                const rowToRemove = document.getElementById('cart-item-' + cartId);
                                if (rowToRemove) rowToRemove.remove();

                                // Update the target row (the one it merged into)
                                const targetQtyInput = document.getElementById('qty-' + data.new_cart_id);
                                if (targetQtyInput) targetQtyInput.value = data.new_qty;

                                const targetSubtotal = document.getElementById('subtotal-' + data.new_cart_id);
                                if (targetSubtotal) targetSubtotal.innerText = '₹' + data.item_subtotal;

                                Swal.fire({
                                    title: 'Merged!',
                                    text: 'Items of the same size were merged.',
                                    icon: 'info',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            } else {
                                document.getElementById('price-' + cartId).innerText = '₹' + data.item_price;
                                document.getElementById('subtotal-' + cartId).innerText = '₹' + data.item_subtotal;
                                Swal.fire({
                                    title: 'Updated!',
                                    text: 'Size updated successfully.',
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                            }
                            document.getElementById('cart-total').innerText = '₹' + data.cart_total;
                            updateHeaderCounts(); // sync header side-cart/badge
                        } else {
                            Swal.fire('Error', data.message, 'error');
                        }
                    });
            }

            // Helper: sum visible subtotals and update cart-total element
            function recalcTotal() {
                let total = 0;
                document.querySelectorAll('[id^="subtotal-"]').forEach(el => {
                    const val = parseFloat(el.innerText.replace(/[^0-9.]/g, ''));
                    if (!isNaN(val)) total += val;
                });
                document.getElementById('cart-total').innerText = '₹' + total.toFixed(2);
            }
        </script>
    @endsection
