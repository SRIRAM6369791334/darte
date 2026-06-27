@extends('layouts.app')
@section('content')
<style>
.page-content, .content-inner, .content-inner-1, .content-inner-3,
.dz-product-detail, .product-description, .shop-card, .modal-content, .bg-light {
    background: #ffffff !important;
}

/* ── Product Card ── */
.dz-product-detail.style-2 .dz-content {
    padding: 24px 20px 12px !important;
}

.dz-content .title {
    font-size: 1.35rem !important;
    font-weight: 800 !important;
    line-height: 1.3 !important;
    margin-bottom: 22px !important;
    letter-spacing: -0.3px;
    color: #000;
    text-align: center !important;
}

/* ── Price ── */
.meta-content {
    gap: 6px !important;
    margin-bottom: 20px !important;
    display: flex !important;
    align-items: center !important;
    flex-wrap: wrap !important;
}

/* ── CSS Grid: Price | Quantity on first row, Size below spanning both ── */
.product-details-grid {
    display: grid !important;
    grid-template-columns: 1fr 1fr;
    row-gap: 22px;
}
.price-section {
    display: flex !important;
    flex-direction: column !important;
    align-items: flex-start !important;
    gap: 4px !important;
}
.price-section .price {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
}
.price-section .badge {
    font-size: 0.85rem !important;
    font-weight: 700 !important;
    border-radius: 4px !important;
    line-height: 1 !important;
    padding: 2px 8px !important;
    background: #dc3545 !important;
    color: #fff !important;
}
.quantity-section {
    display: flex !important;
    flex-direction: column !important;
    align-items: flex-start !important;
}
.quantity-section .form-label {
    margin-bottom: 4px !important;
    width: 100% !important;
}
.size-section {
    grid-column: 1 / -1;
    text-align: center !important;
}
.size-section .form-label {
    text-align: center !important;
    width: 100% !important;
    margin-bottom: 4px !important;
}
.size-section .product-size {
    justify-content: center !important;
}

.price-name {
    font-size: 17px !important;
    letter-spacing: 1px !important;
    color: #000000 !important;
    font-weight: 700 !important;
    text-transform: uppercase;
}
#details-price {
    font-size: 1.5rem !important;
    font-weight: 800 !important;
    color: #000;
}
#details-mrp {
    font-size: 0.9rem !important;
    color: #aaa !important;
}

/* ── Quantity ── */
.qty-stepper {
    height: 42px !important;
    border-radius: 12px !important;
    background: #f8f8f8 !important;
    border: 1px solid #e0e0e0 !important;
    padding: 0 3px !important;
    gap: 2px !important;
    display: flex !important;
    align-items: center !important;
    width: fit-content;
}
.qty-btn {
    min-width: 30px !important;
    width: 30px !important;
    height: 30px !important;
    padding: 0 !important;
    font-size: 15px !important;
    line-height: 1 !important;
    border-radius: 8px !important;
    background: #000 !important;
    color: #fff !important;
    border: none !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
}
.qty-input {
    width: 34px !important;
    min-width: 34px !important;
    height: 30px !important;
    font-weight: 800 !important;
    font-size: 15px !important;
    background: transparent !important;
    border: none !important;
    color: #000 !important;
    text-align: center !important;
}

/* ── Size ── */
.details-variant-btn {
    min-width: 46px !important;
    width: 46px !important;
    height: 46px !important;
    border-radius: 50% !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 0 !important;
    font-size: 13px !important;
    font-weight: 700 !important;
    border: 1.5px solid #ddd !important;
    background: #fff !important;
    color: #000 !important;
    line-height: 1 !important;
    transition: all 0.25s ease !important;
}
.details-variant-btn.btn-dark {
    background: #000 !important;
    border-color: #000 !important;
    color: #fff !important;
}
.product-size {
    gap: 12px !important;
}

/* ── Action Buttons ── */
.cart-btn {
    display: flex !important;
    flex-direction: row !important;
    gap: 14px !important;
    width: 100% !important;
    margin-top: 20px !important;
    margin-bottom: 0 !important;
}
#add-to-cart-btn, .btn-outline-secondary.btn-icon {
    flex: 1 !important;
    height: 52px !important;
    border-radius: 12px !important;
    padding: 0 16px !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    letter-spacing: 0.8px !important;
    text-transform: uppercase;
    white-space: nowrap !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    transition: all 0.3s ease !important;
}
#add-to-cart-btn {
    background: #000 !important;
    background-image: none !important;
    color: #fff !important;
    border: none !important;
}
#add-to-cart-btn:hover {
    background: #222 !important;
}
.btn-outline-secondary.btn-icon {
    background: #fff !important;
    color: #000 !important;
    border: 1.5px solid #000 !important;
    gap: 10px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
}
.btn-outline-secondary.btn-icon:hover {
    background: #000 !important;
    color: #fff !important;
}
.btn-outline-secondary.btn-icon .icon.feather {
    font-size: 18px !important;
    line-height: 1 !important;
    flex-shrink: 0 !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
}

/* ── Accordion ── */
.luxury-accordion {
    border-top: 1px solid #e5e5e5;
    margin-top: 24px;
}
.luxury-accordion .accordion-item {
    border: none;
    border-bottom: 1px solid #e5e5e5;
    background: transparent;
    border-radius: 0 !important;
}
.luxury-accordion .accordion-button {
    background: transparent;
    color: #000;
    font-size: 15px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    padding: 18px 0;
    box-shadow: none !important;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border: none;
}
.luxury-accordion .accordion-button:not(.collapsed) {
    background: transparent;
    color: #000;
}
.luxury-accordion .accordion-button::after {
    display: none !important;
}
.luxury-accordion .accordion-button .accordion-icon {
    font-size: 16px;
    transition: transform 0.3s ease;
}
.luxury-accordion .accordion-button:not(.collapsed) .accordion-icon {
    transform: rotate(180deg);
}
.luxury-accordion .accordion-body {
    padding: 0;
    font-size: 14px;
    color: #555;
    line-height: 1.7;
}
.luxury-accordion .accordion-body p,
.luxury-accordion .accordion-body li,
.luxury-accordion .accordion-body span,
.luxury-accordion .accordion-body td,
.luxury-accordion .accordion-body th,
.luxury-accordion .accordion-body small {
    font-size: 14px !important;
}
.luxury-accordion .feature-card {
    background: #fafafa;
    border: 1px solid #eee;
    border-radius: 8px;
    transition: all 0.3s ease;
}
.luxury-accordion .feature-card:hover {
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    background: #fff;
}
.luxury-accordion .trust-block {
    background: #fafafa;
    border: 1px solid #eee;
    padding: 24px;
    border-radius: 8px;
    height: 100%;
}
.para-text.font-15 {
    font-size: 15px !important;
}

/* ── Mobile (max-width: 767px) ── */
@media (max-width: 767px) {
    .para-text.font-15 { font-size: 14px !important; }

    .dz-product-detail.style-2 .dz-content {
        padding: 18px 16px 10px !important;
        border-radius: 20px !important;
        margin-top: -20px !important;
    }
    .dz-content .title { font-size: 1.15rem !important; }
    #details-price { font-size: 1.3rem !important; }
    .product-details-grid { row-gap: 16px; }
    .price-section,
    .quantity-section { align-items: center !important; }
    .quantity-section .form-label { text-align: center !important; }

    .cart-btn { gap: 12px !important; margin-top: 16px !important; }
    #add-to-cart-btn, .btn-outline-secondary.btn-icon {
        height: 48px !important;
        font-size: 11px !important;
        padding: 0 12px !important;
    }

    .details-variant-btn {
        width: 44px !important;
        height: 44px !important;
        min-width: 44px !important;
    }

    .qty-btn {
        min-width: 28px !important;
        width: 28px !important;
        height: 28px !important;
        font-size: 14px !important;
    }
    .qty-input {
        width: 30px !important;
        min-width: 30px !important;
        height: 28px !important;
        font-size: 14px !important;
    }
    .qty-stepper { height: 38px !important; }
}

/* ── Small Mobile (max-width: 575px) ── */
@media (max-width: 575px) {
    .product-gallery-swiper,
    .swiper.product-gallery-swiper.thumb-swiper-lg,
    .swiper.product-gallery-swiper.thumb-swiper-lg.swiper-initialized {
        display: block !important;
        position: relative !important;
        width: 100% !important;
        height: auto !important;
        min-height: 0 !important;
        max-height: none !important;
        margin: 8px 0 0 0 !important;
        padding: 4px 0 !important;
        overflow: visible !important;
        top: auto !important;
        bottom: auto !important;
        left: auto !important;
        right: auto !important;
        transform: none !important;
    }
    .product-gallery-swiper .swiper-wrapper,
    .swiper.product-gallery-swiper.thumb-swiper-lg .swiper-wrapper {
        flex-direction: row !important;
        display: flex !important;
        overflow-x: auto !important;
        height: auto !important;
        min-height: 0 !important;
        gap: 8px;
        transform: none !important;
    }
    .product-gallery-swiper .swiper-slide,
    .swiper.product-gallery-swiper.thumb-swiper-lg .swiper-slide {
        width: 56px !important;
        height: 56px !important;
        flex-shrink: 0 !important;
        border-radius: 10px !important;
        overflow: hidden;
        border: 2px solid #eee;
        background: #fff;
        margin: 0 !important;
    }
    .product-gallery-swiper .swiper-slide.swiper-slide-thumb-active {
        border-color: #000 !important;
    }
    .product-gallery-swiper2 {
        width: 100% !important;
        height: auto !important;
        margin-bottom: 0 !important;
    }
    .dz-product-detail.style-3 .swiper-btn-center-lr {
        display: flex !important;
        flex-direction: column !important;
        padding: 0 !important;
        height: auto !important;
        gap: 0 !important;
    }
    .dz-product-detail.style-3 {
        margin-bottom: 0 !important;
        padding-bottom: 0 !important;
    }

    .dz-product-detail.style-2.p-t50 { padding-top: 16px !important; }

    .product-details-grid { row-gap: 12px; }

    .cart-btn { flex-direction: row !important; }
    #add-to-cart-btn, .btn-outline-secondary.btn-icon {
        height: 46px !important;
        font-size: 10px !important;
        padding: 0 8px !important;
    }
    .btn-outline-secondary.btn-icon .icon.feather {
        font-size: 0.85rem !important;
    }
}
</style>
<div class="page-content bg-light">


    <div class="d-sm-flex justify-content-between container py-3">

        <nav aria-label="breadcrumb" class="breadcrumb-row">
            <ul class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/"> Home</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('shop.category', Str::slug($product->category->category_name ?? ($product->cate_name ?? 'shop'))) }}">
                        {{ $product->category->category_name ?? ($product->cate_name ?? 'Shop') }}</a></li>
                <li class="breadcrumb-item">{{ $product->product_name }}</li>
            </ul>
        </nav>
    </div>

    @php
    $variant = $product->variants->first();
    $initial_category = !empty($variant->subcatename)
    ? $variant->subcatename
    : (!empty($product->category->category_name)
    ? $product->category->category_name
    : (!empty($product->cate_name)
    ? $product->cate_name
    : 'N/A'));
    @endphp

    <section class="content-inner py-0">
        <div class="container-fluid">
            <div class="row">

                <!-- <div class="col-xl-6 col-md-6">
                                                                                                    <div class="dz-product-detail sticky-top">

                                                                                                        <div class="swiper product-gallery-swiper2">
                                                                                                            <div class="swiper-wrapper" id="lightgallery">
                                                                                                                <div class="swiper-slide">
                                                                                                                    <div class="dz-media DZoomImage rounded">
                                                                                                                        <img id="detailsMainImg"
                                                                                                                            src="{{ env('MAIN_URL') . 'images/' . $product->product_image }}"
                                                                                                                            class="img-fluid rounded shadow-sm"
                                                                                                                            style="cursor: pointer; transition: 0.1s; transform: scale(1); transform-origin: 46.3855% 34.8795%;">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                        <div class="swiper product-gallery-swiper thumb-swiper-lg swiper-vertical">
                                                                                                            <div class="swiper-wrapper">


                                                                                                                @foreach ($product->variants as $v)
    @foreach ($v->images as $child)
    <div class="swiper-slide"
                                                                                                                            onclick="changeMainImage('{{ env('MAIN_URL') . 'images/' . $child->product_child_image }}')">
                                                                                                                            <img src="{{ env('MAIN_URL') . 'images/' . $child->product_child_image }}"
                                                                                                                                width="50" style="object-fit: contain; cursor: pointer;">
                                                                                                                        </div>
    @endforeach
    @endforeach

                                                                                                            </div>
                                                                                                        </div>

                                                                                                    </div>
                                                                                                </div> -->
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 pt-2 pt-md-0"">
                        <div class=" dz-product-detail sticky-top style-3" style="margin-top: 45px;">
                    <div class="swiper-btn-center-lr">

                        <div class="swiper product-gallery-swiper2">
                            <div class="swiper-wrapper" id="lightgallery">
                                <div class="swiper-slide">
                                    <div class="dz-media DZoomImage rounded">
                                        <img id="detailsMainImg"
                                            src="{{ env('MAIN_URL') . 'images/' . $product->product_image }}"
                                            class="img-fluid rounded shadow-sm"
                                            style="cursor: pointer; transition: 0.1s; transform: scale(1); transform-origin: 46.3855% 34.8795%;">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="swiper product-gallery-swiper thumb-swiper-lg swiper-vertical">
                            <div class="swiper-wrapper">


                                @foreach ($product->variants as $v)
                                @foreach ($v->images as $child)
                                <div class="swiper-slide thumbnail-item"
                                    data-variant-id="{{ $v->id }}"
                                    style="{{ $v->id == ($variant->id ?? 0) ? '' : 'display:none;' }}"
                                    onclick="changeMainImage('{{ env('MAIN_URL') . 'images/' . $child->product_child_image }}')">
                                    <img src="{{ env('MAIN_URL') . 'images/' . $child->product_child_image }}"
                                        width="50" style="object-fit: contain; cursor: pointer;">
                                </div>
                                @endforeach
                                @endforeach

                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-6">
                <div class="dz-product-detail style-2 p-t50">

                    <div class="dz-content">



                        <h4 class="title mb-1">
                            {{ $product->product_name }}
                        </h4>
                        <!-- <div class="review-num">
                                                        @php
                                                            $avgRating = $product->reviews->avg('ratings') ?? 0;
                                                            $reviewCount = $product->reviews->count();
                                                        @endphp
                                                        <ul class="dz-rating me-2">
                                                            @for ($i = 1; $i <= 5; $i++)
    <li>
                                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M6.74805 0.234375L8.72301 4.51608L13.4054 5.07126L9.9436 8.27267L10.8625 12.8975L6.74805 10.5944L2.63355 12.8975L3.5525 8.27267L0.090651 5.07126L4.77309 4.51608L6.74805 0.234375Z"
                                                                            fill="{{ $i <= $avgRating ? '#000000' : '#5E626F' }}"
                                                                            style="{{ $i > $avgRating ? 'opacity: 0.2;' : '' }}">
                                                                        </path>
                                                                    </svg>
                                                                </li>
    @endfor
                                                        </ul>
                                                        <span class="text-secondary me-2">{{ number_format($avgRating, 1) }} Rating</span>
                                                        <a href="#profile-tab"
                                                            onclick="document.getElementById('profile-tab').click();">({{ $reviewCount }}
                                                            customer reviews)</a>
                                                    </div>
                                                    <p class="para-text">
                                                        {{ $product->description ?? 'No description available' }}
                                                    </p> -->

                        <!-- <div class="meta-content m-b20">
                                                                                                                                                                                                                                        <span class="price-name text-uppercase small font-weight-bold">Price</span>
                                                                                                                                                                                                                                        <span class="price h4 mb-0">
                                                                                                                                                                                                                                            <span
                                                                                                                                                                                                                                                id="details-price">₹{{ $variant->offer_price ?? $product->product_price }}</span>
                                                                                                                                                                                                                                            <del class="text-muted h6 ms-2"
                                                                                                                                                                                                                                                id="details-mrp">₹{{ $variant->mrp_price ?? $product->product_mrp_price }}</del>
                                                                                                                                                                                                                                        </span>
                                                                                                                                                                                                                                    </div> -->
                        <div class="product-details-grid">

                            <!-- Price Section -->
                            <div class="price-section">
                                <span class="price-name">Price</span>
                                <span class="price">
                                    <span id="details-price">₹{{ $variant->offer_price ?? $product->product_price }}</span>
                                    <del id="details-mrp" class="text-muted" style="{{ ($variant->mrp_price ?? $product->product_mrp_price) > ($variant->offer_price ?? $product->product_price) ? '' : 'display: none;' }}">₹{{ $variant->mrp_price ?? $product->product_mrp_price }}</del>
                                </span>
                                @php
                                $offerVal = $variant->offer_price ?? $product->product_price;
                                $mrpVal = $variant->mrp_price ?? $product->product_mrp_price;
                                $hasDiscount = $mrpVal > $offerVal && $mrpVal > 0;
                                $discountPercent = $hasDiscount ? round((($mrpVal - $offerVal) / $mrpVal) * 100) : 0;
                                @endphp
                                <span class="badge" id="details-discount" style="{{ $hasDiscount ? '' : 'display: none;' }}">
                                    {{ $discountPercent }}% OFF
                                </span>
                            </div>

                            <!-- Quantity Section -->
                            @php
                            $currentStock = $variant->product_qty ?? ($product->product_qty ?? 0);
                            @endphp
                            <div class="btn-quantity light quantity-section">
                                <label class="form-label text-uppercase fw-bold">Quantity</label>
                                <div class="qty-stepper">
                                    <button type="button" id="minus-btn" onclick="changeDetailsQty('minus')"
                                        class="qty-btn"
                                        {{ $currentStock <= 0 ? 'disabled' : '' }}>−</button>
                                    <input type="text" id="details-qty" value="1" readonly
                                        class="qty-input"
                                        data-stock="{{ $currentStock }}">
                                    <button type="button" id="plus-btn"
                                        class="qty-btn"
                                        onclick="changeDetailsQty('plus')"
                                        {{ $currentStock <= 0 ? 'disabled' : '' }}>+</button>
                                </div>
                                <small id="stock-error" class="text-danger fw-bold mt-2" style="display:none;"></small>
                            </div>

                            <!-- Size Section -->
                            <div class="size-section">
                                <label class="form-label text-uppercase fw-bold">Size:</label>
                                <div class="btn-group product-size">
                                    @foreach ($product->variants as $v)
                                    @php
                                    $v_category = !empty($v->subcatename)
                                    ? $v->subcatename
                                    : (!empty($product->category->category_name)
                                    ? $product->category->category_name
                                    : (!empty($product->cate_name)
                                    ? $product->cate_name
                                    : 'N/A'));

                                    $v_sku = !empty($v->sku)
                                    ? $v->sku
                                    : ('DRT-' . strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $product->product_name), 0, 3)) . '-' . $v->id);
                                    @endphp
                                    <button type="button"
                                        class="btn btn-sm border details-variant-btn
                                                {{ $v->id == ($variant->id ?? 0) ? 'btn-dark text-white' : 'btn-light' }}"
                                        onclick="updateDetailsVariant(
                                                    {{ $v->id }},
                                                    {{ $v->offer_price }},
                                                    {{ $v->mrp_price }},
                                                    '{{ env('MAIN_URL') . 'images/' . $v->varient_img }}',
                                                    '{{ $v->varient }}',
                                                    '{{ $v_sku }}',
                                                    '{{ $v_category }}',
                                                    this,
                                                    {{ $v->product_qty ?? 0 }}
                                                )">
                                        {{ $v->varient }}
                                    </button>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                        <div class="btn-group cart-btn">
                            <button id="add-to-cart-btn"
                                onclick="addToCartFromDetails({{ $product->id }}, '{{ $variant->id ?? '' }}')"
                                class="btn btn-secondary text-uppercase fw-bold"
                                {{ $currentStock <= 0 ? 'disabled' : '' }}>
                                {{ $currentStock <= 0 ? 'Out of Stock' : 'Add To Cart' }}
                            </button>
                            <button onclick="addToWishlist({{ $product->id }}, currentDetailsVariantId)"
                                class="btn btn-outline-secondary btn-icon">
                                <i class="icon feather icon-heart"></i>
                                Add To Wishlist
                            </button>
                        </div>

                        @php
                        // Initial fallback SKU on page load
                        $initial_sku = 'N/A';
                        if ($variant) {
                        $initial_sku = !empty($variant->sku)
                        ? $variant->sku
                        : ('DRT-' . strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $product->product_name), 0, 3)) . '-' . $variant->id);
                        } else {
                        $initial_sku = 'DRT-' . strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $product->product_name), 0, 3)) . '-' . $product->id;
                        }
                        @endphp

                        <!-- ACCORDION: Product Details + Description + ... -->
                        <div class="accordion luxury-accordion mt-4" id="productAccordion">

                            <!-- Product Details (SKU + Category) — collapsible -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingProductDetails">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProductDetails" aria-expanded="false" aria-controls="collapseProductDetails">
                                        Product Details
                                        <i class="feather icon-chevron-down accordion-icon"></i>
                                    </button>
                                </h2>
                                <div id="collapseProductDetails" class="accordion-collapse collapse" aria-labelledby="headingProductDetails" data-bs-parent="#productAccordion">
                                    <div class="accordion-body">
                                        <div class="py-2">
                                            <!-- SKU row -->
                                            <div style="display:flex; justify-content:space-between; align-items:center; padding: 10px 0; border-bottom: 1px solid #f0f0f0;">
                                                <span style="font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; color:#000;">SKU</span>
                                                <span id="details-sku" style="font-size:13px; color:#555;">{{ $initial_sku }}</span>
                                            </div>
                                            <!-- Category row -->
                                            <div style="display:flex; justify-content:space-between; align-items:center; padding: 10px 0;">
                                                <span style="font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; color:#000;">Category</span>
                                                <span id="details-category" style="font-size:13px; color:#555;">{{ $initial_category }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Description Pane -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingDescription">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDescription" aria-expanded="false" aria-controls="collapseDescription">
                                        Description
                                        <i class="feather icon-chevron-down accordion-icon"></i>
                                    </button>
                                </h2>
                                <div id="collapseDescription" class="accordion-collapse collapse" aria-labelledby="headingDescription" data-bs-parent="#productAccordion">
                                    <div class="accordion-body">
                                        <div class="py-2">
                                            <p class="para-text font-15 leading-relaxed text-dark">
                                                {{ $product->product_specification ?? 'No description available' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Why you will love it Pane -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingLove">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLove" aria-expanded="false" aria-controls="collapseLove">
                                        Why you'll love it
                                        <i class="feather icon-chevron-down accordion-icon"></i>
                                    </button>
                                </h2>
                                <div id="collapseLove" class="accordion-collapse collapse" aria-labelledby="headingLove" data-bs-parent="#productAccordion">
                                    <div class="accordion-body">
                                        <div class="py-2">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <div class="feature-card p-3 d-flex align-items-center gap-3">
                                                        <i class="feather icon-award font-24 text-dark flex-shrink-0"></i>
                                                        <div>
                                                            <h4 class="h6 font-weight-bold text-uppercase mb-1 letter-spacing-1">Premium Fabric</h4>
                                                            <p class="small text-muted mb-0">Handpicked high-grade materials ensuring longevity and a soft-touch finish.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="feature-card p-3 d-flex align-items-center gap-3">
                                                        <i class="feather icon-smile font-24 text-dark flex-shrink-0"></i>
                                                        <div>
                                                            <h4 class="h6 font-weight-bold text-uppercase mb-1 letter-spacing-1">Comfortable Fit</h4>
                                                            <p class="small text-muted mb-0">Engineered with ergonomic seams for a fit that feels like a second skin.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="feature-card p-3 d-flex align-items-center gap-3">
                                                        <i class="feather icon-sun font-24 text-dark flex-shrink-0"></i>
                                                        <div>
                                                            <h4 class="h6 font-weight-bold text-uppercase mb-1 letter-spacing-1">Everyday Use</h4>
                                                            <p class="small text-muted mb-0">Versatile aesthetics that transition effortlessly from morning to moonlight.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Size Guide Pane -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSize">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSize" aria-expanded="false" aria-controls="collapseSize">
                                        Size Guide
                                        <i class="feather icon-chevron-down accordion-icon"></i>
                                    </button>
                                </h2>
                                <div id="collapseSize" class="accordion-collapse collapse" aria-labelledby="headingSize" data-bs-parent="#productAccordion">
                                    <div class="accordion-body">
                                        <div class="py-2">
                                            <div class="luxury-table-wrapper">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered text-center align-middle luxury-table">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-uppercase small letter-spacing-1">Size</th>
                                                                <th class="text-uppercase small letter-spacing-1">Chest (in)</th>
                                                                <th class="text-uppercase small letter-spacing-1">Waist (in)</th>
                                                                <th class="text-uppercase small letter-spacing-1">Length (in)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="font-weight-bold">S</td>
                                                                <td>36 - 38</td>
                                                                <td>30 - 32</td>
                                                                <td>27</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="font-weight-bold">M</td>
                                                                <td>39 - 41</td>
                                                                <td>33 - 35</td>
                                                                <td>28</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="font-weight-bold">L</td>
                                                                <td>42 - 44</td>
                                                                <td>36 - 38</td>
                                                                <td>29</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="font-weight-bold">XL</td>
                                                                <td>45 - 47</td>
                                                                <td>39 - 41</td>
                                                                <td>30</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Shipping Pane -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingShipping">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseShipping" aria-expanded="false" aria-controls="collapseShipping">
                                        Shipping & COD
                                        <i class="feather icon-chevron-down accordion-icon"></i>
                                    </button>
                                </h2>
                                <div id="collapseShipping" class="accordion-collapse collapse" aria-labelledby="headingShipping" data-bs-parent="#productAccordion">
                                    <div class="accordion-body">
                                        <div class="py-2">
                                            <div class="row g-3 align-items-stretch">
                                                <div class="col-12">
                                                    <div class="trust-block p-3">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <i class="feather icon-truck font-20 me-2 text-dark"></i>
                                                            <h4 class="h6 font-weight-bold text-uppercase mb-0 letter-spacing-1">Delivery Information</h4>
                                                        </div>
                                                        <ul class="list-unstyled small text-muted mb-0">
                                                            <li class="mb-1"><i class="feather icon-check me-2 text-dark"></i> Standard Delivery: 3-5 Business Days</li>
                                                            <li class="mb-1"><i class="feather icon-check me-2 text-dark"></i> Express Shipping available at checkout</li>
                                                            <li><i class="feather icon-check me-2 text-dark"></i> Free shipping on orders above ₹1999</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="trust-block p-3">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <i class="feather icon-credit-card font-20 me-2 text-dark"></i>
                                                            <h4 class="h6 font-weight-bold text-uppercase mb-0 letter-spacing-1">Cash on Delivery</h4>
                                                        </div>
                                                        <p class="small text-muted mb-0">We offer COD across most pincodes in India. A small convenience fee may apply to COD orders. Please check at checkout for your specific location.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reviews Pane -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingReviews">
                                    <button class="accordion-button collapsed" id="profile-tab" type="button" data-bs-toggle="collapse" data-bs-target="#collapseReviews" aria-expanded="false" aria-controls="collapseReviews">
                                        Reviews ({{ $product->reviews->count() }})
                                        <i class="feather icon-chevron-down accordion-icon"></i>
                                    </button>
                                </h2>
                                <div id="collapseReviews" class="accordion-collapse collapse" aria-labelledby="headingReviews" data-bs-parent="#productAccordion">
                                    <div class="accordion-body">
                                        <div class="clear" id="comment-list">
                                            <div class="post-comments comments-area style-1 clearfix">
                                                <h4 class="comments-title mb-2">Comments ({{ $product->reviews->count() }})</h4>
                                                <p class="dz-title-text">User reviews for this product.</p>
                                                <div id="comment">
                                                    <ol class="comment-list">
                                                        @forelse($product->reviews as $review)
                                                        <li class="comment even thread-even depth-1 comment" id="comment-{{ $review->id }}">
                                                            <div class="comment-body">
                                                                <div class="comment-author vcard">
                                                                    <img src="{{ env('MAIN_URL') . 'images/' . $product->product_image }}" alt="/" class="avatar">
                                                                    <cite class="fn">{{ $review->name }}</cite>
                                                                    <div class="star-rating" style="display: inline-block; margin-left: 10px; color: #000000;">
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            <i class="{{ $i <= $review->ratings ? 'fas' : 'far' }} fa-star"></i>
                                                                            @endfor
                                                                    </div>
                                                                    <span class="comment-date text-muted" style="font-size: 12px; margin-left: 10px;">{{ $review->created_at->format('M d, Y') }}</span>
                                                                </div>
                                                                <div class="comment-content dz-page-text">
                                                                    <p>{{ $review->review }}</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @empty
                                                        <p>No reviews yet. Be the first to review!</p>
                                                        @endforelse
                                                    </ol>
                                                </div>

                                                @if ($hasPurchased)
                                                <div class="d-flex justify-content-between align-items-center mb-4">
                                                    <h4 class="comments-title mb-0">Customer Reviews</h4>
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#addReviewModal">
                                                        Add Review
                                                    </button>
                                                </div>
                                                @else
                                                <div class="mt-4 py-3 px-4 rounded-3" style="background:rgba(0,0,0,0.05); border-left: 4px solid #000000;">
                                                    <p class="mb-0" style="color:#000000;">
                                                        @auth
                                                        <i class="feather icon-info me-1"></i> Only customers who have purchased this product can leave a review.
                                                        @else
                                                        <i class="feather icon-log-in me-1"></i> Please <a href="{{ url('/registration') }}" style="color:#000000; font-weight:600;">log in</a> to leave a review.
                                                        @endauth
                                                    </p>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>

                </div>
            </div>

        </div>
</div>
</section>

</section>

<section class="content-inner-1  overflow-hidden">
    <div class="container">
        <div class="section-head style-2 d-md-flex align-items-center justify-content-between">
            <div class="left-content">
                <h2 class="title mb-0">Related products</h2>
            </div>
            <a href="{{ route('shop') }}" class="text-primary font-14 d-flex align-items-center gap-1">See all
                products
                <i class="icon feather icon-chevron-right font-18"></i>
            </a>
        </div>
        <div class="swiper-btn-center-lr">
            <div class="swiper swiper-four">
                <div class="swiper-wrapper">
                    @foreach ($relatedProducts as $related)
                    <div class="swiper-slide">
                        <div class="shop-card style-1">
                            <div class="dz-media">
                                <img src="{{ env('MAIN_URL') . 'images/' . $related->product_image }}"
                                    alt="image">
                                <div class="shop-meta">
                                    <a href="{{ route('shop.details', $related->slug) }}"
                                        class="btn btn-secondary btn-md btn-rounded">
                                        <i class="fa-solid fa-eye d-md-none d-block"></i>
                                        <span class="d-md-block d-none">Quick View</span>
                                    </a>
                                    <div class="btn btn-primary meta-icon dz-wishicon"
                                        onclick="addToWishlist({{ $related->id }})">
                                        <i class="icon feather icon-heart dz-heart"></i>
                                    </div>
                                    <div class="btn btn-primary meta-icon dz-carticon"
                                        onclick="addToCart({{ $related->id }})">
                                        <i class="flaticon flaticon-basket"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="dz-content">
                                <h5 class="title"><a
                                        href="{{ route('shop.details', $related->slug) }}">{{ $related->product_name }}</a>
                                </h5>
                                <h5 class="price">
                                    ₹{{ $related->variants->first()->offer_price ?? $related->product_price }}</h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="pagination-align">
                <div class="tranding-button-prev btn-prev">
                    <i class="flaticon flaticon-left-chevron"></i>
                </div>
                <div class="tranding-button-next btn-next">
                    <i class="flaticon flaticon-chevron"></i>
                </div>
            </div>
        </div>
    </div>
</section>
</div>

</div>

<!-- Add Review Modal -->
<div class="modal fade" id="addReviewModal" tabindex="-1" aria-labelledby="addReviewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addReviewModalLabel">Add Reviews</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('product.review.store') }}" method="POST" id="comments_form"
                    class="comment-form">
                    @csrf
                    <input type="hidden" name="prod_id" value="{{ $product->id }}">
                    <input type="hidden" name="prod_var_id" id="review_prod_var_id"
                        value="{{ $variant->id ?? '' }}">
                    <input type="hidden" name="ratings" id="selected_rating" value="5">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label mb-1">Choose Category*</label>
                            <input type="text" class="form-control" value="{{ $product->cate_name ?? 'N/A' }}"
                                readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label mb-1">Product Name*</label>
                            <input type="text" class="form-control" value="{{ $product->product_name }}"
                                readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label mb-1">Name*</label>
                            <input id="name" placeholder="Name *" name="name" type="text"
                                class="form-control" value="{{ Auth::guest() ? '' : Auth::user()->name }}"
                                {{ Auth::check() ? 'readonly' : '' }} required>
                        </div>
                        <div class="col-md-6">
                            <label class="pull-left mb-1 d-block">Rating*</label>
                            <div class="rating-widget">
                                <div class="rating-stars">
                                    <ul id="stars" class="list-inline mb-0">
                                        <li class="star selected list-inline-item" title="Poor" data-value="1">
                                            <i class="fas fa-star fa-fw"></i>
                                        </li>
                                        <li class="star selected list-inline-item" title="Fair" data-value="2">
                                            <i class="fas fa-star fa-fw"></i>
                                        </li>
                                        <li class="star selected list-inline-item" title="Good" data-value="3">
                                            <i class="fas fa-star fa-fw"></i>
                                        </li>
                                        <li class="star selected list-inline-item" title="Excellent" data-value="4">
                                            <i class="fas fa-star fa-fw"></i>
                                        </li>
                                        <li class="star selected list-inline-item" title="WOW!!!" data-value="5">
                                            <i class="fas fa-star fa-fw"></i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="form-label mb-1">Product Review*</label>
                            <textarea id="comments" placeholder="Product Review" class="form-control" name="comment" rows="4" required></textarea>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button id="submit" type="submit" class="btn btn-primary px-5">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let currentDetailsVariantId = '{{ $variant->id ?? '
    ' }}';

    function changeMainImage(imageUrl) {
        const mainImg = document.getElementById('detailsMainImg');
        if (mainImg) {
            mainImg.src = imageUrl;
        }
    }



    function updateDetailsVariant(variantId, offerPrice, mrpPrice, imageUrl, sizeLabel, sku, categoryName, btnElement, productQty) {
        // Update UI
        if (document.getElementById('details-price')) document.getElementById('details-price').innerText =
            `₹${offerPrice}`;

        const mrpEl = document.getElementById('details-mrp');
        if (mrpEl) {
            mrpEl.innerText = `₹${mrpPrice}`;
            if (parseFloat(mrpPrice) > parseFloat(offerPrice)) {
                mrpEl.style.display = 'inline-block';
            } else {
                mrpEl.style.display = 'none';
            }
        }

        const discountEl = document.getElementById('details-discount');
        if (discountEl) {
            const offerNum = parseFloat(offerPrice);
            const mrpNum = parseFloat(mrpPrice);
            if (mrpNum > offerNum && mrpNum > 0) {
                const discountPercent = Math.round(((mrpNum - offerNum) / mrpNum) * 100);
                discountEl.innerText = `${discountPercent}% OFF`;
                discountEl.style.display = 'inline-block';
            } else {
                discountEl.style.display = 'none';
            }
        }
        if (document.getElementById('selected-size-text')) document.getElementById('selected-size-text').innerText =
            sizeLabel;
        if (document.getElementById('details-sku')) document.getElementById('details-sku').innerText = sku;
        if (document.getElementById('details-category')) document.getElementById('details-category').innerText =
            categoryName;

        // Update Main Image
        if (document.getElementById('detailsMainImg') && imageUrl) {
            document.getElementById('detailsMainImg').src = imageUrl;
        }

        // Update Thumbnails
        const thumbnails = document.querySelectorAll('.thumbnail-item');
        let firstThumb = null;
        thumbnails.forEach(thumb => {
            if (thumb.dataset.variantId == variantId) {
                thumb.style.display = 'block';
                if (!firstThumb) firstThumb = thumb;
            } else {
                thumb.style.display = 'none';
            }
        });

        // Auto-click first thumbnail if available
        if (firstThumb) {
            firstThumb.click();
        }

        // Update Active Button
        const buttons = document.querySelectorAll('.details-variant-btn');
        buttons.forEach(btn => {
            btn.classList.remove('btn-dark', 'text-white');
            btn.classList.add('btn-light');
            btn.style.setProperty('background', '', 'important');
            btn.style.setProperty('color', '', 'important');
        });
        btnElement.classList.add('btn-dark', 'text-white');
        btnElement.classList.remove('btn-light');
        btnElement.style.setProperty('background', '#000000', 'important');
        btnElement.style.setProperty('color', '#ffffff', 'important');

        // Set current variant
        currentDetailsVariantId = variantId;

        // Update hidden field in review form if it exists
        const reviewVarInput = document.getElementById('review_prod_var_id');
        if (reviewVarInput) reviewVarInput.value = variantId;

        // Update Add To Cart and Quantity states based on stock
        const addToCartBtn = document.getElementById('add-to-cart-btn');
        const minusBtn = document.getElementById('minus-btn');
        const plusBtn = document.getElementById('plus-btn');
        const qtyInput = document.getElementById('details-qty');
        const errorMsg = document.getElementById('stock-error');

        if (qtyInput) {
            qtyInput.setAttribute('data-stock', productQty);
            qtyInput.value = 1;
        }
        if (errorMsg) {
            errorMsg.style.display = 'none';
        }

        if (productQty <= 0) {
            if (addToCartBtn) {
                addToCartBtn.disabled = true;
                addToCartBtn.innerText = 'Out of Stock';
            }
            if (minusBtn) minusBtn.disabled = true;
            if (plusBtn) plusBtn.disabled = true;
        } else {
            if (addToCartBtn) {
                addToCartBtn.disabled = false;
                addToCartBtn.innerText = 'Add To Cart';
            }
            if (minusBtn) minusBtn.disabled = false;
            if (plusBtn) plusBtn.disabled = false;
        }
    }

    function addToCartFromDetails(productId, defaultVariantId) {
        const variantId = currentDetailsVariantId || defaultVariantId;
        const quantity = document.getElementById('details-qty').value;

        if (!checkUserAuth()) return;

        fetch('{{ route('cart.add') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        variant_id: variantId,
                        quantity: quantity
                    })
                })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Added to Cart!',
                        text: data.message,
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                    }).then(() => location.reload());
                    updateHeaderCounts();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: data.message
                    });
                }
            });
    }

    /* Star Rating Logic */
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('#stars li');
        const ratingInput = document.getElementById('selected_rating');

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const value = parseInt(this.getAttribute('data-value'));
                ratingInput.value = value;

                stars.forEach(s => {
                    if (parseInt(s.getAttribute('data-value')) <= value) {
                        s.classList.add('selected');
                    } else {
                        s.classList.remove('selected');
                    }
                });
            });

            star.addEventListener('mouseover', function() {
                const value = parseInt(this.getAttribute('data-value'));
                stars.forEach(s => {
                    if (parseInt(s.getAttribute('data-value')) <= value) {
                        s.classList.add('hover');
                    } else {
                        s.classList.remove('hover');
                    }
                });
            });

            star.addEventListener('mouseout', function() {
                stars.forEach(s => s.classList.remove('hover'));
            });
        });
    });
</script>
<script>
    function changeDetailsQty(action) {
        const qtyInput = document.getElementById('details-qty');
        const errorMsg = document.getElementById('stock-error');

        if (!qtyInput) return;

        let currentQty = parseInt(qtyInput.value) || 1;
        const maxStock = parseInt(qtyInput.getAttribute('data-stock')) || 0;

        if (action === 'plus') {
            if (currentQty < maxStock) {
                // Stock irundhaal quantity-ai increase sei
                qtyInput.value = currentQty + 1;
                if (errorMsg) {
                    errorMsg.style.display = 'none'; // Error-ai maraikka
                }
            } else {
                // Stock limit-ai thaandum pothu keezhe ulla message mattum kaattu
                if (errorMsg) {
                    errorMsg.innerText = "Only " + maxStock + " units available in stock!";
                    errorMsg.style.display = 'block';
                }
                // Alert (Swal.fire) ippo remove seiyappattathu
            }
        } else if (action === 'minus') {
            if (currentQty > 1) {
                qtyInput.value = currentQty - 1;
                if (errorMsg) {
                    errorMsg.style.display = 'none';
                }
            }
        }
    }

    function onVariantChange(newStock) {
        const qtyInput = document.getElementById('details-qty');
        const errorMsg = document.getElementById('stock-error');

        if (qtyInput) {
            qtyInput.setAttribute('data-stock', newStock);
            qtyInput.value = 1; // Variant maarum pothu qty-ai 1-kku reset seiyum
        }

        if (errorMsg) {
            errorMsg.style.display = 'none';
        }
    }
</script>

@endsection