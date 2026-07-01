@extends('layouts.app')
@section('content')
<style>
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
        padding-top: 170px;
        padding-bottom: 80px;
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
    @media only screen and (max-width: 560px) {
    .content-inner {
        padding-top: 58px;
        padding-bottom: 38px;
    }
}

</style>
<div class="page-content bg-light">

    <div class="dz-bnr-inr bg-secondary overlay-black-light"
        style="background-image:url(assets/images/background/bg1.webp);">
        <div class="container">
            <div class="dz-bnr-inr-entry">
                <h1 class="color1">Shop Wishlist</h1>
                <nav aria-label="breadcrumb" class="breadcrumb-row">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"> Home</a></li>
                        <li class="breadcrumb-item">Shop Wishlist</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <div class="content-inner-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11">
                    <div class="table-responsive">
                        <table class="table check-tbl style-1">
                            <thead>
                                <tr>

                                    <th>Product</th>
                                    <th></th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($wishlistItems as $item)
                                <tr id="wishlist-item-{{ $item->id }}">
                                    <td class="product-item-img">
                                        <img src="{{ env('MAIN_URL') . 'images/' . ($item->variant->varient_img ?? $item->product->product_image) }}"
                                            alt="/">
                                    </td>
                                    <td class="product-item-name">
                                        {{ $item->product->product_name }}
                                        @if ($item->variant && $item->variant->varient)
                                        <br><small class="text-dark">Size: {{ $item->variant->varient }}</small>
                                        @endif
                                        @php
                                        $stock = $item->variant
                                        ? $item->variant->product_qty
                                        : $item->product->product_quantity ?? 0;
                                        @endphp
                                        @if ($stock <= 0)
                                            <br><span class="text-danger small fw-bold">Out of Stock</span>
                                            @endif
                                    </td>
                                    <td class="product-item-price">
                                        @php
                                        $price = 0;
                                        if ($item->variant) {
                                        $price =
                                        $item->variant->offer_price ?? $item->variant->mrp_price;
                                        } else {
                                        $price =
                                        $item->product->product_regular_price ??
                                        ($item->product->product_mrp_price ?? 0);
                                        }
                                        @endphp
                                        <strong class="text-primary">₹{{ $price }}</strong>
                                    </td>

                                    <td class="product-item-quantity">
                                        <div class="quantity btn-quantity style-1 me-3 d-flex align-items-center flex-nowrap">
                                            <button class="btn btn-sm btn-light qty-btn"
                                                onclick="updateWishlistQty({{ $item->id }}, 'decrement')"
                                                style="min-width: 50px; height: 50px; font-weight: bold; border-radius: 50px;background: #000000 !important;font-size: 20px;color:#fff;">-</button>

                                            <input id="qty-{{ $item->id }}" type="text"
                                                value="{{ $item->product_quantity ?? 1 }}" readonly
                                                data-stock="{{ $item->variant->product_qty ?? ($item->product->product_qty ?? 0) }}"
                                                style="width: 40px; text-align: center; border: none;">

                                            <button class="btn btn-sm btn-light qty-btn"
                                                onclick="updateWishlistQty({{ $item->id }}, 'increment')"
                                                style="min-width: 50px; height: 50px; font-weight: bold; border-radius: 50px;background: #000000 !important;font-size: 20px;color:#fff;">+</button>
                                        </div>

                                        <div id="stock-error-{{ $item->id }}" class="text-danger mt-1"
                                            style="font-size: 11px; display: none; font-weight: bold;"></div>
                                    </td>

                                    <td class="product-item-totle" id="subtotal-{{ $item->id }}">
                                        <strong
                                            class="text-primary">₹{{ $price * ($item->product_quantity ?? 1) }}</strong>
                                    </td>

                                    <td class="product-item-totle">
                                        <button onclick="moveToCart({{ $item->id }})"
                                            class="btn btn-secondary btnhover text-nowrap"
                                            {{ ($stock ?? 0) <= 0 ? 'disabled' : '' }}>
                                            Add To Cart
                                        </button>
                                    </td>
                                    <td class="product-item-close">
                                        <a href="javascript:void(0);"
                                            onclick="removeFromWishlist({{ $item->id }})">
                                            <i class="ti-close"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Your wishlist is empty. <a
                                            href="{{ route('shop') }}">Go shopping</a></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function moveToCart(wishlistId) {
        fetch("{{ route('wishlist.move') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    wishlist_id: wishlistId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Success', data.message, 'success').then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            });
    }

    function updateWishlistQty(wishId, action) {
        fetch("{{ route('wishlist.update-qty') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    wishlist_id: wishId,
                    action: action
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('qty-' + wishId).value = data.new_qty;
                    // Update Subtotal logic
                    const priceElement = document.querySelector('#wishlist-item-' + wishId +
                        ' .product-item-price strong');
                    const price = parseFloat(priceElement.innerText.replace('₹', ''));
                    const newSubtotal = price * data.new_qty;
                    document.getElementById('subtotal-' + wishId).innerHTML = '<strong class="text-primary">₹' +
                        newSubtotal + '</strong>';
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            });
    }
</script>
<script>
    function updateWishlistQty(wishId, action) {
        const qtyInput = document.getElementById('qty-' + wishId);
        const errorDiv = document.getElementById('stock-error-' + wishId);

        if (!qtyInput) return;

        let currentQty = parseInt(qtyInput.value) || 1;
        const maxStock = parseInt(qtyInput.getAttribute('data-stock')) || 0;

        // Increment (Plus) click seiyum pothu check
        if (action === 'increment') {
            if (currentQty >= maxStock) {
                // Stock limit-ai thaandinaal message kaattu, function-ai niruthu
                if (errorDiv) {
                    errorDiv.innerText = "Only " + maxStock + " units available!";
                    errorDiv.style.display = 'block';
                }
                return; // Plus icon work aga kudadhu (Function execution stops here)
            }
        }

        // Error message-ai clear seiya
        if (errorDiv) errorDiv.style.display = 'none';

        // DB Update Logic
        fetch("{{ route('wishlist.update-qty') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    wishlist_id: wishId,
                    action: action
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    qtyInput.value = data.new_qty;

                    // Subtotal update logic
                    const priceElement = document.querySelector('#wishlist-item-' + wishId +
                        ' .product-item-price strong');
                    if (priceElement) {
                        const price = parseFloat(priceElement.innerText.replace('₹', ''));
                        const newSubtotal = price * data.new_qty;
                        const subtotalDiv = document.getElementById('subtotal-' + wishId);
                        if (subtotalDiv) {
                            subtotalDiv.innerHTML = '<strong class="text-primary">₹' + newSubtotal.toFixed(2) +
                                '</strong>';
                        }
                    }
                } else {
                    // Vera ethavathu error vandhaal mattum alert kaattalaam
                    console.error(data.message);
                }
            });
    }
</script>
@endsection