<style>
    .form-control {
        background: white !important;
    }
</style>


<div class="tab-pane fade show active" id="shopping-cart-pane" role="tabpanel" aria-labelledby="shopping-cart"
    tabindex="0">
    <div class="shop-sidebar-cart">
        <ul class="sidebar-cart-list">
            @forelse($headerCartItems as $item)
                @if(!$item->product) @continue @endif
                <li id="sidebar-cart-item-{{ $item->id }}">
                    <div class="cart-widget">
                        <div class="dz-media me-3">
                            <img src="{{ env('MAIN_URL') . 'images/' . ($item->variant->varient_img ?? $item->product->product_image) }}"
                                alt="">
                        </div>
                        <div class="cart-content">
                            <h6 class="title"><a
                                    href="{{ route('shop.details', $item->product->slug) }}">{{ $item->product->product_name }}</a>
                            </h6>
                            @if ($item->product->variants->count() > 0)
                                <div class="mt-1 mb-2" style="display: flex; align-items: center;">
                                    <small class="text-dark me-1">Size:</small>
                                    <select class="form-select form-select-sm d-inline-block w-auto"
                                        onchange="updateSize({{ $item->id }}, this.value)"
                                        style="padding: 0px 5px; font-size: 14px; height: 25px; border: 1px solid #ccc; width: 70px !important; color: #000000; border-radius: 4px;">
                                        @foreach ($item->product->variants as $variant)
                                            <option value="{{ $variant->id }}" {{ $item->product_varient_id == $variant->id ? 'selected' : '' }}>
                                                {{ $variant->varient }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @elseif($item->variant)
                                <small class="text-dark d-block mb-1">Size: {{ $item->variant->varient }}</small>
                            @endif
                            <div class="d-flex align-items-center">
                                <div class="btn-quantity light quantity-sm me-3">
                                    <input type="text" value="{{ $item->product_quantity }}" readonly
                                        style="width: 30px; text-align: center; border: none; background: transparent;">
                                </div>
                                <h6 class="dz-price mb-0">
                                    ₹{{ $item->variant->offer_price ?? ($item->product->product_regular_price ?? ($item->product->product_mrp_price ?? ($item->product->variants->first()->offer_price ?? 0))) }}
                                </h6>
                            </div>
                        </div>
                        <a href="javascript:void(0);" class="dz-close" onclick="removeFromCart({{ $item->id }})">
                            <i class="ti-close"></i>
                        </a>
                    </div>
                </li>
            @empty
                <li class="text-center py-4">Your cart is empty.</li>
            @endforelse
        </ul>
        <div class="cart-total">
            <h5 class="mb-0">Subtotal:</h5>
            <h5 class="mb-0">₹{{ $headerSubtotal }}</h5>
        </div>
        <div class="mt-auto">
            <!-- <div class="shipping-time">
                                        <div class="dz-icon">
                                            <i class="flaticon flaticon-ship"></i>
                                        </div>
                                        <div class="shipping-content">
                                            <h6 class="title pe-4">Congratulations , you've got free shipping!</h6>
                                            <div class="progress">
                                                <div class="progress-bar progress-animated border-0" style="width: 75%;" role="progressbar">
                                                    <span class="sr-only">75% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
            <a href="{{ route('checkout') }}" class="btn btn-outline-secondary btn-block m-b20">Checkout</a>
            <a href="{{ route('cart') }}" class="btn btn-secondary btn-block">View Cart</a>
        </div>
    </div>
</div>
<div class="tab-pane fade" id="wishlist-pane" role="tabpanel" aria-labelledby="wishlist" tabindex="0">
    <div class="shop-sidebar-cart">
        <ul class="sidebar-cart-list">
            @forelse($headerWishlistItems as $item)
                @if(!$item->product) @continue @endif
                <li id="sidebar-wishlist-item-{{ $item->id }}">
                    <div class="cart-widget">
                        <div class="dz-media me-3">
                            <img src="{{ env('MAIN_URL') . 'images/' . ($item->variant->varient_img ?? $item->product->product_image) }}"
                                alt="">
                        </div>
                        <div class="cart-content">
                            <h6 class="title"><a
                                    href="{{ route('shop.details', $item->product->slug) }}">{{ $item->product->product_name }}</a>
                            </h6>
                            @if ($item->variant && $item->variant->varient)
                                <small class="text-dark d-block mb-1">Size: {{ $item->variant->varient }}</small>
                            @endif
                            <div class="d-flex align-items-center">
                                <h6 class="dz-price mb-0">
                                    ₹{{ $item->variant->offer_price ?? ($item->product->product_regular_price ?? ($item->product->product_mrp_price ?? ($item->product->variants->first()->offer_price ?? 0))) }}
                                </h6>
                            </div>
                        </div>
                        <a href="javascript:void(0);" class="dz-close" onclick="removeFromWishlist({{ $item->id }})">
                            <i class="ti-close"></i>
                        </a>
                    </div>
                </li>
            @empty
                <li class="text-center py-4">Your wishlist is empty.</li>
            @endforelse
        </ul>
        <div class="mt-auto">
            <a href="{{ route('wishlist') }}" class="btn btn-secondary btn-block">Check Your Wishlist</a>
        </div>
    </div>
</div>
<div class="tab-pane fade" id="coupons-pane" role="tabpanel" aria-labelledby="coupons-tab" tabindex="0">
    <div class="shop-sidebar-cart">
        <ul class="sidebar-cart-list">
            @forelse($headerCoupons as $coupon)
                <li>
                    <div class="cart-widget p-3 border rounded mb-3">
                        <div class="cart-content w-100">
                            <h6 class="title mb-1" style="color: #f11b4d; font-weight: 700;">{{ $coupon->codename }}
                            </h6>
                            <p class="mb-1 fw-bold text-dark">
                                Get
                                {{ $coupon->discounttype == 2 ? $coupon->discount . '%' : '₹' . $coupon->discount }}
                                OFF
                            </p>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <small class="text-muted">Min. Order: ₹{{ number_format($coupon->mini_amt) }}</small>
                                <span
                                    class="badge badge-outline-secondary font-12">{{ date('d M', strtotime($coupon->end_date)) }}</span>
                            </div>
                        </div>
                    </div>
                </li>
            @empty
                <li class="text-center py-4">No active coupons available at the moment.</li>
            @endforelse
        </ul>
    </div>
</div>