@extends('layouts.app')
@section('content')

    <style>
        .page-content,
        .content-inner-3,
        .shop-card,
        .shop-filter,
        .filter-wrapper {
            background: #fff !important;
        }

        /* Fix product image: show full body centered */
        .shop-card.style-1 .dz-media img,
        .dz-shop-card.style-2 .dz-media img {
            object-fit: cover;
            object-position: center center;
            width: 100%;
            height: 100%;
        }

        /* Corner ribbon — inside dz-media, left border to top border */
        .dz-media {
            position: relative;
            overflow: hidden;
        }
        /* Floating badge styling */
        .shop-card .product-tag {
            position: absolute;
            top: 0;
            left: 20px;
            background-color: #111;
            color: #fff;
            padding: 10px 15px 15px 15px;
            font-size: 0.85rem;
            font-weight: 800;
            text-align: center;
          
            clip-path: polygon(0 0, 100% 0, 100% 80%, 0 100%);
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            z-index: 20;
        }
        .filter-wrapper .filter-right-area .form-group .btn{
            color: #111;
        }
        @media only screen and (max-width: 575px) {
    .dz-bnr-inr .dz-bnr-inr-entry {
        padding: 0px 0 0px 0;
        text-align: center;
        display: table-cell;
    }
}
    </style>
    <div class="page-content bg-light">

        <!-- Banner Start -->


        <div class="dz-bnr-inr bg-secondary overlay-black-light" style="position: relative;min-height: 251px;display: flex;align-items: center;overflow: hidden;z-index: 1;margin-top: 90px;">
            <img src="{{ asset('assets/images/cropped_shop.png') }}" alt="Shop Banner" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;object-fit: revert;object-position: center 15%;z-index: -1;">
            <div class="container" style="position: relative; z-index: 2;">
                <div class="dz-bnr-inr-entry">
                    <h1 class="color1">{{ $activeCategory ? $activeCategory->category_name ?? 'Shop' : 'Shop' }}</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"> Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('shop') }}">Shop</a></li>
                            @if ($activeCategory)
                                <li class="breadcrumb-item">{{ $activeCategory->category_name }}</li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Banner End -->

        <style>
            /* Fix overlapping border issue for select dropdowns and prevent text squishing */
            @media (min-width: 576px) {
                .filter-right-area>div {
                    padding-left: 15px !important;
                    padding-right: 15px !important;
                    flex-shrink: 0 !important;
                }
            }

            /* Ensure the select container doesn't shrink and overlap its dropdown arrow */
            .filter-right-area .bootstrap-select {
                flex-shrink: 0 !important;
                width: auto !important;
            }

            .filter-right-area .bootstrap-select .dropdown-toggle {
                padding-right: 35px !important;
            }

            /* Mobile specific fixes for shop page */
            @media (max-width: 575px) {
                .filter-wrapper {
                    display: flex !important;
                    flex-direction: column !important;
                    align-items: flex-start !important;
                }
                .filter-right-area {
                    width: 100% !important;
                    flex-wrap: wrap !important;
                    justify-content: space-between !important;
                    margin-top: 10px !important;
                }
                .filter-right-area .form-group {
                    margin-bottom: 10px !important;
                }
                .filter-right-area .default-select {
                    width: 100% !important;
                }
                .shop-tab {
                    display: none !important; /* Hide grid/list toggle on small mobile to save space */
                }
                .dz-shop-card.style-2 .dz-media {
                    width: 100% !important;
                    height: auto !important;
                }
                .dz-shop-card.style-2 {
                    flex-direction: column !important;
                }
            }

        </style>

        <section class="content-inner-3 pt-3 z-index-unset">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-xl-3">

                        <div class="sticky-xl-top">
                            <a href="javascript:void(0);" class="panel-close-btn">
                                <svg width="35" height="35" viewBox="0 0 51 50" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M37.748 12.5L12.748 37.5" stroke="white" stroke-width="1.25"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M12.748 12.5L37.748 37.5" stroke="white" stroke-width="1.25"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                            <div class="shop-filter mt-xl-2 mt-0" id="shopFilter">
                                <form id="filterForm"
                                    action="{{ $categorySlug ? route('shop.category', $categorySlug) : route('shop') }}"
                                    method="GET">
                                    <input type="hidden" name="min_price" id="min_price_input"
                                        value="{{ request('min_price', $globalMinPrice ?? 0) }}">
                                    <input type="hidden" name="max_price" id="max_price_input"
                                        value="{{ request('max_price', $globalMaxPrice ?? 1000) }}">
                                    <input type="hidden" name="sort" id="sort_input"
                                        value="{{ request('sort', 'latest') }}">
                                    <input type="hidden" name="per_page" id="per_page_input"
                                        value="{{ request('per_page', 12) }}">
                                    <aside>
                                        <div class="d-flex align-items-center justify-content-between m-b30">
                                            <h6 class="title mb-0 fw-normal d-flex">
                                                <i class="flaticon-filter me-3"></i>
                                                Filter
                                            </h6>
                                        </div>
                                        <div class="widget widget_search">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input name="dzSearch" type="search" value="{{ request('dzSearch') }}"
                                                        class="form-control" placeholder="Search Product" style="background:#fff!important;">
                                                    <div class="input-group-addon">
                                                        <button type="submit" class="btn">
                                                            <i class="icon feather icon-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget">
                                            <h6 class="widget-title">Price</h6>
                                            <div class="price-slide range-slider">
                                                <div class="price">
                                                    <div class="range-slider style-1">
                                                        @php
                                                            $gMin = $globalMinPrice ?? 0;
                                                            $gMax = $globalMaxPrice ?? 1000;
                                                            if ($gMin == $gMax) {
                                                                if ($gMin > 0) {
                                                                    $gMin = 0;
                                                                } else {
                                                                    $gMax = 100;
                                                                }
                                                            }
                                                            $rMin = request('min_price')
                                                                ? max((int) request('min_price'), $gMin)
                                                                : $gMin;
                                                            $rMax = request('max_price')
                                                                ? min((int) request('max_price'), $gMax)
                                                                : $gMax;
                                                        @endphp
                                                        <div id="slider-tooltips2" class="mb-3"
                                                            data-min="{{ $gMin }}" data-max="{{ $gMax }}"
                                                            data-start-min="{{ $rMin }}"
                                                            data-start-max="{{ $rMax }}">
                                                        </div>
                                                        <span class="example-val" id="slider-margin-value-min2"></span>
                                                        <span class="example-val" id="slider-margin-value-max2"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="widget">
                                            <h6 class="widget-title">Size</h6>
                                            <div class="btn-group product-size">
                                                @foreach ($sizes as $index => $size)
                                                    <input type="radio" class="btn-check" name="size"
                                                        value="{{ $size }}" id="size{{ $index }}"
                                                        {{ in_array($size, (array) request('size', [])) ? 'checked' : '' }}
                                                        onclick="applySizeFilter()">
                                                    <label class="btn"
                                                        for="size{{ $index }}">{{ strtoupper(trim($size)) }}</label>
                                                @endforeach
                                            </div>
                                            @if (request('size'))
                                                <a href="javascript:void(0);" onclick="clearSizeFilter()"
                                                    class="btn btn-sm btn-outline-secondary mt-2 w-100">Clear Size</a>
                                            @endif
                                        </div>

                                        <div class="widget widget_categories">
                                            <h6 class="widget-title">Category</h6>
                                            <ul>
                                                @foreach ($categories as $cat)
                                                    <li
                                                        class="cat-item {{ $activeCategoryId == $cat->id ? 'active' : '' }}">
                                                        <a href="{{ route('shop.category', $cat->slug) }}">
                                                            {{ $cat->category_name ?? ($cat->name ?? $cat->cate_name) }}
                                                        </a>
                                                        @if (isset($cat->products_count))
                                                            ({{ $cat->products_count }})
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                            @if ($activeCategoryId)
                                                <a href="{{ route('shop') }}"
                                                    class="btn btn-sm btn-outline-secondary mt-2 w-100">Clear Category</a>
                                            @endif
                                        </div>
                                    </aside>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-9">

                        <div class="filter-wrapper">
                            <div class="filter-left-area">
                                @php
                                    // Base URL for clear links — keeps category slug if active
                                    $shopBase = $categorySlug ? route('shop.category', $categorySlug) : route('shop');
                                @endphp
                                <ul class="filter-tag">
                                    @if (request('dzSearch'))
                                        <li>
                                            <a href="{{ $shopBase . '?' . http_build_query(request()->except('dzSearch')) }}"
                                                class="tag-btn">
                                                Search: {{ request('dzSearch') }}
                                                <i class="icon feather icon-x tag-close"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if (request('size'))
                                        <li>
                                            <a href="{{ $shopBase . '?' . http_build_query(request()->except('size')) }}"
                                                class="tag-btn">
                                                Size: {{ strtoupper(trim(request('size'))) }}
                                                <i class="icon feather icon-x tag-close"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if ($activeCategoryId && $activeCategory)
                                        <li>
                                            <a href="{{ route('shop') }}" class="tag-btn">
                                                Category: {{ $activeCategory->category_name ?? $activeCategory->name }}
                                                <i class="icon feather icon-x tag-close"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if (request()->filled('min_price') &&
                                            request()->filled('max_price') &&
                                            (request('min_price') > ($globalMinPrice ?? 0) || request('max_price') < ($globalMaxPrice ?? 1000)))
                                        <li>
                                            <a href="{{ $shopBase . '?' . http_build_query(request()->except(['min_price', 'max_price'])) }}"
                                                class="tag-btn">
                                                Price: &#8377;{{ request('min_price', $globalMinPrice ?? 0) }} -
                                                &#8377;{{ request('max_price', $globalMaxPrice ?? 1000) }}
                                                <i class="icon feather icon-x tag-close"></i>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                                <span>Showing {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }} Of
                                    {{ $products->total() ?? 0 }} Results</span>
                            </div>
                            <div class="filter-right-area">
                                <a href="javascript:void(0);" class="panel-btn me-2">
                                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25"
                                        width="20" height="20">
                                        <g id="Layer_28" data-name="Layer 28">
                                            <path
                                                d="M2.54,5H15v.5A1.5,1.5,0,0,0,16.5,7h2A1.5,1.5,0,0,0,20,5.5V5h2.33a.5.5,0,0,0,0-1H20V3.5A1.5,1.5,0,0,0,18.5,2h-2A1.5,1.5,0,0,0,15,3.5V4H2.54a.5.5,0,0,0,0,1ZM16,3.5a.5.5,0,0,1,.5-.5h2a.5.5,0,0,1,.5.5v2a.5.5,0,0,1-.5.5h-2a.5.5,0,0,1-.5-.5Z">
                                            </path>
                                            <path
                                                d="M22.4,20H18v-.5A1.5,1.5,0,0,0,16.5,18h-2A1.5,1.5,0,0,0,13,19.5V20H2.55a.5.5,0,0,0,0,1H13v.5A1.5,1.5,0,0,0,14.5,23h2A1.5,1.5,0,0,0,18,21.5V21h4.4a.5.5,0,0,0,0-1ZM17,21.5a.5.5,0,0,1-.5.5h-2a.5.5,0,0,1-.5-.5v-2a.5.5,0,0,1,.5-.5h2a.5.5,0,0,1,.5.5Z">
                                            </path>
                                            <path
                                                d="M8.5,15h2A1.5,1.5,0,0,0,12,13.5V13H22.45a.5.5,0,1,0,0-1H12v-.5A1.5,1.5,0,0,0,10.5,10h-2A1.5,1.5,0,0,0,7,11.5V12H2.6a.5.5,0,1,0,0,1H7v.5A1.5,1.5,0,0,0,8.5,15ZM8,11.5a.5.5,0,0,1,.5-.5h2a.5.5,0,0,1,.5.5v2a.5.5,0,0,1-.5.5h-2a.5.5,0,0,1-.5-.5Z">
                                            </path>
                                        </g>
                                    </svg>
                                    Filter
                                </a>
                                <div class="form-group">
                                    <select id="shop-sort-select" class="default-select"
                                        style="width: 150px !important;">
                                        <option value="latest"
                                            {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>Latest</option>
                                        <option value="popularity"
                                            {{ request('sort') == 'popularity' ? 'selected' : '' }}>Popularity</option>
                                        <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Average
                                            rating</option>
                                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>
                                            Low to high</option>
                                        <option value="price_high"
                                            {{ request('sort') == 'price_high' ? 'selected' : '' }}>High to Low</option>
                                    </select>
                                </div>
                                {{-- <div class="form-group Category">
                                    <select id="shop-perpage-select" class="default-select"
                                        style="width: 150px !important;">
                                        <option value="12" {{ request('per_page', 12) == 12 ? 'selected' : '' }}>12
                                            Products</option>
                                        <option value="9" {{ request('per_page') == 9 ? 'selected' : '' }}>9 Products
                                        </option>
                                        <option value="14" {{ request('per_page') == 14 ? 'selected' : '' }}>14
                                            Products</option>
                                        <option value="18" {{ request('per_page') == 18 ? 'selected' : '' }}>18
                                            Products</option>
                                        <option value="24" {{ request('per_page') == 24 ? 'selected' : '' }}>24
                                            Products</option>
                                    </select>
                                </div>
                                <div class="shop-tab">
                                    <ul class="nav" role="tablist" id="dz-shop-tab">
                                        <li class="nav-item" role="presentation">
                                            <a href="#tab-list-column" class="nav-link active" id="tab-list-column-btn"
                                                data-bs-toggle="pill" data-bs-target="#tab-list-column" role="tab"
                                                aria-controls="tab-list-column" aria-selected="true">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                    id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512"
                                                    style="enable-background:new 0 0 512 512;" xml:space="preserve"
                                                    width="512" height="512">
                                                    <g>
                                                        <path
                                                            d="M85.333,0h64c47.128,0,85.333,38.205,85.333,85.333v64c0,47.128-38.205,85.333-85.333,85.333h-64   C38.205,234.667,0,196.462,0,149.333v-64C0,38.205,38.205,0,85.333,0z">
                                                        </path>
                                                        <path
                                                            d="M362.667,0h64c47.128,0,85.333,38.205,85.333,85.333v64c0,47.128-38.205,85.333-85.333,85.333h-64   c-47.128,0-85.333-38.205-85.333-85.333v-64C277.333,38.205,315.538,0,362.667,0z">
                                                        </path>
                                                        <path
                                                            d="M85.333,277.333h64c47.128,0,85.333,38.205,85.333,85.333v64c0,47.128-38.205,85.333-85.333,85.333h-64   C38.205,512,0,473.795,0,426.667v-64C0,315.538,38.205,277.333,85.333,277.333z">
                                                        </path>
                                                        <path
                                                            d="M362.667,277.333h64c47.128,0,85.333,38.205,85.333,85.333v64c0,47.128-38.205,85.333-85.333,85.333h-64   c-47.128,0-85.333-38.205-85.333-85.333v-64C277.333,315.538,315.538,277.333,362.667,277.333z">
                                                        </path>
                                                    </g>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a href="#tab-list-column" class="nav-link" id="tab-list-column-btn"
                                                data-bs-toggle="pill" data-bs-target="#tab-list-column" role="tab"
                                                aria-controls="tab-list-column" aria-selected="false">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                    id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512"
                                                    style="enable-background:new 0 0 512 512;" xml:space="preserve"
                                                    width="512" height="512">
                                                    <g>
                                                        <path
                                                            d="M85.333,0h64c47.128,0,85.333,38.205,85.333,85.333v64c0,47.128-38.205,85.333-85.333,85.333h-64   C38.205,234.667,0,196.462,0,149.333v-64C0,38.205,38.205,0,85.333,0z">
                                                        </path>
                                                        <path
                                                            d="M362.667,0h64C473.795,0,512,38.205,512,85.333v64c0,47.128-38.205,85.333-85.333,85.333h-64   c-47.128,0-85.333-38.205-85.333-85.333v-64C277.333,38.205,315.538,0,362.667,0z">
                                                        </path>
                                                        <path
                                                            d="M85.333,277.333h64c47.128,0,85.333,38.205,85.333,85.333v64c0,47.128-38.205,85.333-85.333,85.333h-64   C38.205,512,0,473.795,0,426.667v-64C0,315.538,38.205,277.333,85.333,277.333z">
                                                        </path>
                                                        <path
                                                            d="M362.667,277.333h64c47.128,0,85.333,38.205,85.333,85.333v64C512,473.795,473.795,512,426.667,512h-64   c-47.128,0-85.333-38.205-85.333-85.333v-64C277.333,315.538,315.538,277.333,362.667,277.333z">
                                                        </path>
                                                    </g>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a href="#tab-list-grid" class="nav-link" id="tab-list-grid-btn"
                                                data-bs-toggle="pill" data-bs-target="#tab-list-grid" role="tab"
                                                aria-controls="tab-list-grid" aria-selected="false">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                    id="Capa_2" x="0px" y="0px" viewBox="0 0 512 512"
                                                    style="enable-background:new 0 0 512 512;" xml:space="preserve"
                                                    width="512" height="512">
                                                    <g>
                                                        <path
                                                            d="M42.667,373.333H96c23.564,0,42.667,19.103,42.667,42.667v53.333C138.667,492.898,119.564,512,96,512H42.667   C19.103,512,0,492.898,0,469.333V416C0,392.436,19.103,373.333,42.667,373.333z">
                                                        </path>
                                                        <path
                                                            d="M416,373.333h53.333C492.898,373.333,512,392.436,512,416v53.333C512,492.898,492.898,512,469.333,512H416   c-23.564,0-42.667-19.102-42.667-42.667V416C373.333,392.436,392.436,373.333,416,373.333z">
                                                        </path>
                                                        <path
                                                            d="M42.667,186.667H96c23.564,0,42.667,19.103,42.667,42.667v53.333c0,23.564-19.103,42.667-42.667,42.667H42.667   C19.103,325.333,0,306.231,0,282.667v-53.333C0,205.769,19.103,186.667,42.667,186.667z">
                                                        </path>
                                                        <path
                                                            d="M416,186.667h53.333c23.564,0,42.667,19.103,42.667,42.667v53.333c0,23.564-19.102,42.667-42.667,42.667H416   c-23.564,0-42.667-19.103-42.667-42.667v-53.333C373.333,205.769,392.436,186.667,416,186.667z">
                                                        </path>
                                                        <path
                                                            d="M42.667,0H96c23.564,0,42.667,19.103,42.667,42.667V96c0,23.564-19.103,42.667-42.667,42.667H42.667   C19.103,138.667,0,119.564,0,96V42.667C0,19.103,19.103,0,42.667,0z">
                                                        </path>
                                                        <path
                                                            d="M229.333,373.333h53.333c23.564,0,42.667,19.103,42.667,42.667v53.333c0,23.564-19.103,42.667-42.667,42.667h-53.333   c-23.564,0-42.667-19.102-42.667-42.667V416C186.667,392.436,205.769,373.333,229.333,373.333z">
                                                        </path>
                                                        <path
                                                            d="M229.333,186.667h53.333c23.564,0,42.667,19.103,42.667,42.667v53.333c0,23.564-19.103,42.667-42.667,42.667h-53.333   c-23.564,0-42.667-19.103-42.667-42.667v-53.333C186.667,205.769,205.769,186.667,229.333,186.667z">
                                                        </path>
                                                        <path
                                                            d="M229.333,0h53.333c23.564,0,42.667,19.103,42.667,42.667V96c0,23.564-19.103,42.667-42.667,42.667h-53.333   c-23.564,0-42.667-19.103-42.667-42.667V42.667C186.667,19.103,205.769,0,229.333,0z">
                                                        </path>
                                                        <path
                                                            d="M416,0h53.333C492.898,0,512,19.103,512,42.667V96c0,23.564-19.102,42.667-42.667,42.667H416   c-23.564,0-42.667-19.103-42.667-42.667V42.667C373.333,19.103,392.436,0,416,0z">
                                                        </path>
                                                    </g>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div> --}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 tab-content shop-" id="pills-tabContent">
                                <div class="tab-pane fade " id="tab-list-list" role="tabpanel"
                                    aria-labelledby="tab-list-list-btn">
                                    <div class="row">
                                        @forelse($products as $product)
                                            @php
                                                $variant = $product->variants->first();
                                                $offerPrice = $variant?->offer_price ?? ($product->product_price ?? 0);
                                                $mrpPrice = $variant?->mrp_price ?? ($product->product_mrp_price ?? 0);
                                                $currentStock = $variant?->product_qty ?? ($product->product_qty ?? 0);
                                            @endphp
                                            <div class="col-md-12 col-sm-12 col-xxxl-6 mb-3">
                                                <div class="dz-shop-card style-2">
                                                    <div class="dz-media">
                                                        <img src="{{ env('MAIN_URL') . 'images/' . $product->product_image }}"
                                                            alt="image"
                                                            style="object-fit: cover; object-position: top center; width: 100%; height: 100%;">
                                                    </div>

                                                    <div class="dz-content">
                                                        <div class="dz-header">
                                                            <div>
                                                                <h4 class="title mb-0"><a
                                                                        href="{{ route('shop.details', $product->slug) }}">{{ Str::limit($product->product_name ?? $product->name, 50) }}</a>
                                                                </h4>
                                                                <ul class="dz-tags">
                                                                    <li><a
                                                                            href="javascript:void(0);">{{ $product->category->category_name ?? ($product->cate_name ?? '') }},</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="review-num">
                                                                @php
                                                                    $avgRating = $product->reviews->avg('ratings') ?? 0;
                                                                    $reviewCount = $product->reviews->count();
                                                                @endphp
                                                                <ul class="dz-rating">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        <li
                                                                            class="{{ $i <= $avgRating ? 'star-fill' : '' }}">
                                                                            <i class="flaticon-star-1"></i>
                                                                        </li>
                                                                    @endfor
                                                                </ul>
                                                                <span><a href="javascript:void(0);"> {{ $reviewCount }}
                                                                        Review{{ $reviewCount != 1 ? 's' : '' }}</a></span>
                                                            </div>
                                                        </div>
                                                        <div class="dz-body">
                                                            <div class="dz-rating-box">
                                                                <div>
                                                                    <p class="dz-para">
                                                                        {{ Str::limit($product->product_description ?? 'No description available.', 150) }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="rate">
                                                                <div class="d-flex align-items-center mb-xl-3 mb-2">
                                                                    <div class="meta-content m-0">
                                                                        <span class="price-name">Price</span>
                                                                        <span class="price">₹{{ $offerPrice }}
                                                                            @if($mrpPrice > $offerPrice)
                                                                                <del class="text-muted ms-2" style="font-size: 0.85em;">₹{{ $mrpPrice }}</del>
                                                                            @endif
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex">
                                                                    @if($currentStock <= 0)
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-secondary btn-md btn-icon disabled" title="Out of Stock" style="pointer-events: none; opacity: 0.6;">
                                                                        <i
                                                                            class="icon feather icon-shopping-cart d-md-none d-block"></i>
                                                                        <span class="d-md-block d-none">Out of Stock</span>
                                                                    </a>
                                                                    @else
                                                                    <a href="javascript:void(0);"
                                                                        onclick="addToCart({{ $product->id }})"
                                                                        class="btn btn-secondary btn-md btn-icon">
                                                                        <i
                                                                            class="icon feather icon-shopping-cart d-md-none d-block"></i>
                                                                        <span class="d-md-block d-none">Add to cart</span>
                                                                    </a>
                                                                    @endif
                                                                    <div class="bookmark-btn style-1"
                                                                        onclick="addToWishlist({{ $product->id }})">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            id="favoriteCheck1_{{ $product->id }}">
                                                                        <label class="form-check-label"
                                                                            for="favoriteCheck1_{{ $product->id }}">
                                                                            <i class="fa-solid fa-heart"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12 text-center py-5">
                                                <h4>No products found!</h4>
                                            </div>
                                        @endforelse
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12 d-flex justify-content-center">
                                            {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-list-column" role="tabpanel"
                                    aria-labelledby="tab-list-column-btn">
                                    <div class="row gx-xl-4 g-3 mb-xl-0 mb-md-0 mb-3">
                                        @forelse($products as $product)
                                            @php
                                                $variant = $product->variants->first();
                                                $offerPrice = $variant?->offer_price ?? ($product->product_price ?? 0);
                                                $mrpPrice = $variant?->mrp_price ?? ($product->product_mrp_price ?? 0);
                                                $currentStock = $variant?->product_qty ?? ($product->product_qty ?? 0);
                                            @endphp
                                            <div class="col-12 col-sm-6 col-xl-4 col-lg-6 col-md-6 m-md-b15 m-sm-b0 m-b30">

                                                <div class="shop-card style-1">
                                                    <div class="dz-media">
                                                        <img src="{{ env('MAIN_URL') . 'images/' . $product->product_image }}"
                                                            alt="image"
                                                            style="object-fit: cover; object-position: center center; width: 100%; height: 100%;">
                                                        <div class="shop-meta">
                                                            <a href="{{ route('shop.details', $product->slug) }}"
                                                                class="btn btn-secondary btn-md btn-rounded">
                                                                <i class="fa-solid fa-eye d-md-none d-block"></i>
                                                                <span class="d-md-block d-none">Quick View</span>
                                                            </a>
                                                            <div class="btn btn-primary meta-icon dz-wishicon"
                                                                onclick="addToWishlist({{ $product->id }})">
                                                                <i class="icon feather icon-heart dz-heart"></i>
                                                                <i class="icon feather icon-heart-on dz-heart-fill"></i>
                                                            </div>
                                                            @if($currentStock <= 0)
                                                            <div class="btn btn-primary meta-icon dz-carticon disabled" title="Out of Stock" style="pointer-events: none; opacity: 0.5;">
                                                                <i class="flaticon flaticon-basket"></i>
                                                                <i
                                                                    class="flaticon flaticon-shopping-basket-on dz-heart-fill"></i>
                                                            </div>
                                                            @else
                                                            <div class="btn btn-primary meta-icon dz-carticon"
                                                                onclick="addToCart({{ $product->id }})">
                                                                <i class="flaticon flaticon-basket"></i>
                                                                <i
                                                                    class="flaticon flaticon-shopping-basket-on dz-heart-fill"></i>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        @if ($mrpPrice > $offerPrice)
                                                            @php $discountPct = round((($mrpPrice - $offerPrice) / $mrpPrice) * 100); @endphp
                                                            <div class="product-tag">{{ $discountPct }}% OFF</div>
                                                        @endif
                                                    </div>
                                                    <div class="dz-content">
                                                        <h5 class="title"><a
                                                                href="{{ route('shop.details', $product->slug) }}">{{ Str::limit($product->product_name ?? $product->name, 50) }}</a>
                                                        </h5>
                                                        <h5 class="price">₹{{ $offerPrice }}@if($mrpPrice > $offerPrice) <del class="text-muted ms-2" style="font-size: 0.85em; font-weight: 400;">₹{{ $mrpPrice }}</del>@endif</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12 text-center py-5">
                                                <h4>No products found!</h4>
                                            </div>
                                        @endforelse
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12 d-flex justify-content-center">
                                            {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade active show" id="tab-list-grid" role="tabpanel"
                                    aria-labelledby="tab-list-grid-btn">
                                    <div class="row gx-xl-4 g-3">
                                        @forelse($products as $product)
                                            @php
                                                $variant = $product->variants->first();
                                                $offerPrice = $variant?->offer_price ?? ($product->product_price ?? 0);
                                                $mrpPrice = $variant?->mrp_price ?? ($product->product_mrp_price ?? 0);
                                                $currentStock = $variant?->product_qty ?? ($product->product_qty ?? 0);
                                            @endphp
                                            <div class="col-11 col-sm-6 col-xl-3 col-lg-4 col-md-4 m-md-b15 m-b30 mx-auto mx-sm-0 ">

                                                <div class="shop-card style-1">
                                                    <div class="dz-media">
                                                        <img src="{{ env('MAIN_URL') . 'images/' . $product->product_image }}"
                                                            alt="{{ $product->product_name }}"
                                                            style="object-fit: cover; object-position: center center; width: 100%; height: 100%;">
                                                        <div class="shop-meta">
                                                            <a href="{{ route('shop.details', $product->slug) }}"
                                                                class="btn btn-secondary btn-md btn-rounded">
                                                                <i class="fa-solid fa-eye d-md-none d-block"></i>
                                                                <span class="d-md-block d-none">Quick View</span>
                                                            </a>
                                                            <div class="btn btn-primary meta-icon dz-wishicon"
                                                                onclick="addToWishlist({{ $product->id }})">
                                                                <i class="icon feather icon-heart dz-heart"></i>
                                                                <i class="icon feather icon-heart-on dz-heart-fill"></i>
                                                            </div>
                                                            @if($currentStock <= 0)
                                                            <div class="btn btn-primary meta-icon dz-carticon disabled" title="Out of Stock" style="pointer-events: none; opacity: 0.5;">
                                                                <i class="flaticon flaticon-basket"></i>
                                                                <i
                                                                    class="flaticon flaticon-shopping-basket-on dz-heart-fill"></i>
                                                            </div>
                                                            @else
                                                            <div class="btn btn-primary meta-icon dz-carticon"
                                                                onclick="addToCart({{ $product->id }})">
                                                                <i class="flaticon flaticon-basket"></i>
                                                                <i
                                                                    class="flaticon flaticon-shopping-basket-on dz-heart-fill"></i>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        @if ($mrpPrice > $offerPrice)
                                                            @php $discountPct = round((($mrpPrice - $offerPrice) / $mrpPrice) * 100); @endphp
                                                            <div class="product-tag">{{ $discountPct }}% OFF</div>
                                                        @endif
                                                    </div>
                                                    <div class="dz-content">
                                                        <h5 class="title"><a
                                                                href="{{ route('shop.details', $product->slug) }}">{{ Str::limit($product->product_name ?? $product->name, 50) }}</a>
                                                        </h5>
                                                        <h5 class="price">₹{{ $offerPrice }}@if($mrpPrice > $offerPrice) <del class="text-muted ms-2" style="font-size: 0.85em; font-weight: 400;">₹{{ $mrpPrice }}</del>@endif</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12 text-center py-5">
                                                <h4>No products found!</h4>
                                            </div>
                                        @endforelse
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12 d-flex justify-content-center">
                                            {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Footer Start -->
    <script>
        function cleanSubmitForm() {
            var form = document.getElementById('filterForm');
            if (!form) return;

            var sl = form.querySelector('input[name="dzSearch"]');
            if (sl && sl.value.trim() === '') sl.disabled = true;

            var minI = document.getElementById('min_price_input');
            if (minI && Number(minI.value) === Number('{{ $globalMinPrice ?? 0 }}')) minI.disabled = true;
            var maxI = document.getElementById('max_price_input');
            if (maxI && Number(maxI.value) === Number('{{ $globalMaxPrice ?? 1000 }}')) maxI.disabled = true;

            var sortI = document.getElementById('sort_input');
            if (sortI && sortI.value === 'latest') sortI.disabled = true;

            var perP = document.getElementById('per_page_input');
            if (perP && perP.value === '12') perP.disabled = true;

            form.submit();
        }

        function applySizeFilter() {
            cleanSubmitForm();
        }

        function clearSizeFilter() {
            var inputs = document.querySelectorAll('input[name="size"]');
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].checked = false;
                inputs[i].disabled = true;
            }
            cleanSubmitForm();
        }

        document.addEventListener('DOMContentLoaded', function() {

            // ── Helper ───────────────────────────────────────────────────────────
            function submitFilter() {
                cleanSubmitForm();
            }

            // ── Sort dropdown ─────────────────────────────────────────────────────
            var sortSelect = document.getElementById('shop-sort-select');
            if (sortSelect) {
                sortSelect.addEventListener('change', function() {
                    document.getElementById('sort_input').value = this.value;
                    submitFilter();
                });
            }

            // ── Per-Page dropdown ─────────────────────────────────────────────────
            var perPageSelect = document.getElementById('shop-perpage-select');
            if (perPageSelect) {
                perPageSelect.addEventListener('change', function() {
                    document.getElementById('per_page_input').value = this.value;
                    submitFilter();
                });
            }

            // ── Price Slider ──────────────────────────────────────────────────────
            var slider = document.getElementById('slider-tooltips2');
            if (slider && typeof noUiSlider !== 'undefined') {
                var min = parseInt(slider.getAttribute('data-min')) || 0;
                var max = parseInt(slider.getAttribute('data-max')) || 1000;
                var startMin = parseInt(slider.getAttribute('data-start-min')) || min;
                var startMax = parseInt(slider.getAttribute('data-start-max')) || max;

                if (slider.noUiSlider) {
                    slider.noUiSlider.destroy();
                }

                noUiSlider.create(slider, {
                    start: [startMin, startMax],
                    connect: true,
                    format: {
                        to: function(val) {
                            return Math.round(val);
                        },
                        from: function(val) {
                            return Number(val);
                        }
                    },
                    tooltips: [true, true],
                    range: {
                        'min': min,
                        'max': max
                    }
                });

                var minSpan = document.getElementById('slider-margin-value-min2');
                var maxSpan = document.getElementById('slider-margin-value-max2');
                var minInput = document.getElementById('min_price_input');
                var maxInput = document.getElementById('max_price_input');

                slider.noUiSlider.on('update', function(values, handle) {
                    if (handle === 0) {
                        if (minSpan) minSpan.innerHTML = 'Min Price: &#8377;' + values[0];
                        if (minInput) minInput.value = values[0];
                    } else {
                        if (maxSpan) maxSpan.innerHTML = 'Max Price: &#8377;' + values[1];
                        if (maxInput) maxInput.value = values[1];
                    }
                });

                slider.noUiSlider.on('change', function() {
                    submitFilter();
                });
            } else {
                console.warn('noUiSlider not found or #slider-tooltips2 missing.');
            }
        });
    </script>
@endsection