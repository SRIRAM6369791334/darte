<!-- Header Start -->
<style>
    .nav-item.dropdown .nav-link {
        /* background: #f5f5f5; */
        padding: 10px 15px;
        border-radius: 8px;
        color: #000000;
        font-weight: 600;
    }

    .badge-circle {
        width: 10px !important;
        height: 10px !important;
    }

    /* Logo & Header Polish */
    .main-bar {
        padding: 4px 0;
        transition: all 0.3s ease;
    }

    .logo-header img {
        width: 50%;
        max-width: 132px;
        height: 101px;
        object-fit: contain;
        transition: transform 0.3s ease;
        margin-left: 50px;
    }

    .logo-header:hover img {
        transform: scale(1.02);
    }

    @media only screen and (max-width: 1200px) {
        .logo-header img {
            max-width: 160px;
        }
    }

    @media only screen and (max-width: 991px) {
        .logo-header img {
            max-width: 140px;
        }
        .logo-header {
            display: flex;
            align-items: center;
            height: 100%;
        }
    }

    @media only screen and (max-width: 575px) {
        .logo-header img {
            width: 102%;
            max-width: 132px;
            height: 71px;
            object-fit: contain;
            transition: transform 0.3s ease;
            margin-left: 20px;
        }
    }

    .dropdown-menu {
        border-radius: 8px;
        padding: 10px;
    }

    .dropdown-item {
        padding: 12px 12px;
        font-size: 15px;
    }

    /* Custom Topbar */
    .dz-topbar {
        background: #000;
        color: #fff;
        padding: 10px 0;
        font-size: 14px;
        z-index: 10001;
        position: relative;
        /* Let container handle sticky */
        width: 100%;
        overflow: hidden;
        height: 44px;
        display: flex;
        align-items: center;
    }

    .dz-topbar .marquee-container {
        display: flex;
        white-space: nowrap;
        animation: marquee 20s linear infinite;
        width: 100%;
    }

    .dz-topbar .marquee-item {
        display: flex;
        align-items: center;
        padding-right: 50px;
    }

    .dz-topbar strong {
        color: #FFFFFF;
        margin: 0 5px;
        text-decoration: underline;
    }

    @keyframes marquee {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(-100%);
        }
    }

    /* Site Header Visibility */
    .site-header {
        background: #fff !important;
        /* Force solid background */
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .site-header .nav>li>a,
    .site-header .nav>li>a span,
    .site-header .extra-nav .nav-link,
    .site-header .extra-nav a,
    .site-header .extra-nav i {
        color: #222 !important;
    }

    .site-header .navbar-toggler span {
        background-color: #222 !important;
    }

    /* Mobile Menu Close Button */
    .header-nav .menu-close {
        display: none;
    }

    @media only screen and (max-width: 991px) {
        .header-nav .menu-close {
            display: block;
            position: absolute;
            right: 15px;
            top: 20px;
            font-size: 24px;
            color: #000;
            background: none;
            border: none;
            z-index: 10;
        }

        .header-nav .logo-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            padding-right: 50px;
        }
    }

    @media only screen and (max-width: 991px) {
        .dz-topbar {
            font-size: 11px;
            height: 36px;
            overflow: hidden !important;
            width: 100% !important;
        }
        .site-header, .main-bar, .sticky-header, .main-bar-wraper {
            min-width: auto !important;
            width: 100% !important;
        }
    }

    /* Custom CSS Dropdown Base */
    .custom-dropdown-toggle * {
        pointer-events: none; /* Prevents clicks on nested icon/span from bypassing the link element */
    }

    .custom-dropdown-menu.mobile-category-menu li {
        margin: 2px 0 !important;
        border: none !important;
        display: block;
    }

    /* Desktop Hover Dropdown */
    @media only screen and (min-width: 992px) {
        .custom-dropdown-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .custom-dropdown-menu.mobile-category-menu {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1050;
            visibility: hidden;
            opacity: 0;
            transform-origin: top;
            transform: scaleY(0.95) translateY(10px);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            pointer-events: none;
            display: block !important;
            
            /* Premium Look */
            border-radius: 20px !important;
            box-shadow: 0 40px 60px -15px rgba(0, 0, 0, 0.05), inset 0 1px 0 rgba(255,255,255,0.1) !important;
            padding: 8px !important;
            background: rgba(255, 255, 255, 0.85) !important;
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            border: 1px solid rgba(0, 0, 0, 0.04) !important;
            min-width: 260px;
            margin-top: 10px !important;
        }

        /* Invisible bridge to prevent dropdown from hiding when moving mouse over the 10px gap */
        .custom-dropdown-menu.mobile-category-menu::after {
            content: '';
            position: absolute;
            top: -15px;
            left: 0;
            right: 0;
            height: 15px;
            background: transparent;
        }

        .custom-dropdown-container:hover .custom-dropdown-menu.mobile-category-menu {
            visibility: visible;
            opacity: 1;
            transform: scaleY(1) translateY(0);
            pointer-events: auto;
            justify-items: center;
        }

        .custom-dropdown-menu.mobile-category-menu li a {
            padding: 12px 18px !important;
            text-align: left !important;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
            border-radius: 12px;
            color: #52525b !important; /* Zinc-600 */
            font-family: 'Geist', 'Inter', sans-serif;
            font-weight: 500;
            font-size: 14px;
            letter-spacing: -0.01em;
            display: flex;
            align-items: center;
            background: transparent !important;
            position: relative;
            overflow: hidden;
            text-decoration: none;
        }

        .custom-dropdown-menu.mobile-category-menu li a::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 12px;
            background: #f4f4f5; /* Zinc-100 */
            opacity: 0;
            transform: scale(0.96);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: -1;
        }

        .custom-dropdown-menu.mobile-category-menu li a:hover {
            color: #09090b !important; /* Zinc-950 */
            transform: translateX(6px);
        }

        .custom-dropdown-menu.mobile-category-menu li a:hover::before {
            opacity: 1;
            transform: scale(1);
        }
    }

    /* Mobile Inline Accordion Menu */
    @media only screen and (max-width: 991px) {
        .custom-dropdown-container {
            display: block !important;
            width: 100%;
            position: relative;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05); /* Match typical mobile menu list items */
        }

        .custom-dropdown-container .custom-dropdown-toggle {
            display: flex !important;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 15px 20px !important;
            color: #222 !important;
            font-size: 16px;
            font-weight: 600; /* Matching weight of Home, About, Shop, Contact */
            text-decoration: none;
            transition: background-color 0.2s ease;
        }

        .custom-dropdown-container .custom-dropdown-toggle i {
            transition: transform 0.3s ease;
            font-size: 12px;
            color: #555;
        }

        /* Rotate chevron icon when open */
        .custom-dropdown-container.open .custom-dropdown-toggle i {
            transform: rotate(180deg);
        }

        .custom-dropdown-menu.mobile-category-menu {
            position: relative !important;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            pointer-events: auto !important;
            box-shadow: none !important;
            border: none !important;
            border-radius: 0 !important;
            background: rgba(0, 0, 0, 0.02) !important; /* Extremely subtle contrast */
            padding: 0 !important;
            margin: 0 !important;
            min-width: 100% !important;
            transform: none !important;
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
            
            /* Smooth accordion animation */
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        .custom-dropdown-container.open .custom-dropdown-menu.mobile-category-menu {
            max-height: 300px; /* Safe upper limit to cover list items */
            padding: 8px 0 !important;
        }

        .custom-dropdown-menu.mobile-category-menu li a {
            padding: 12px 35px !important; /* Indent slightly to distinguish from main items */
            font-size: 15px !important;
            color: #4b5563 !important; /* Zinc/Gray-600 */
            font-weight: 500;
            display: block !important;
            text-align: left !important;
            background: transparent !important;
            text-decoration: none;
            transition: color 0.2s ease, background-color 0.2s ease !important;
        }

        .custom-dropdown-menu.mobile-category-menu li a:hover,
        .custom-dropdown-menu.mobile-category-menu li a:focus {
            color: #000 !important;
            background-color: rgba(0, 0, 0, 0.04) !important;
        }

        .custom-dropdown-menu.mobile-category-menu li a::before {
            display: none !important; /* Disable desktop styling element */
        }
    }

    /* Mobile Search Area Responsive Adjustments */
    @media only screen and (max-width: 991px) {
        .dz-search-area.offcanvas {
            height: 100% !important; /* Full screen height on mobile */
            padding: 30px 20px !important; /* Premium spacing all around */
            display: flex !important;
            flex-direction: column !important;
            justify-content: flex-start !important;
        }

        .dz-search-area .container {
            padding: 0 !important;
            max-width: 100% !important;
        }

        .dz-search-area .btn-close {
            position: absolute !important;
            top: 20px !important;
            right: 20px !important;
            font-size: 28px !important;
            opacity: 0.8 !important;
            color: #000 !important;
            z-index: 1100 !important;
            background: none !important;
            border: none !important;
            padding: 0 !important;
            width: 32px !important;
            height: 32px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .dz-search-area .header-item-search {
            margin-bottom: 25px !important;
            margin-top: 20px !important;
        }

        /* Unified container for the inputs */
        .dz-search-area .search-input {
            display: flex !important;
            flex-direction: column !important;
            gap: 12px !important;
            background: transparent !important;
            border: none !important;
            position: relative !important;
        }

        /* Styling category dropdown select */
        .dz-search-area .search-input .bootstrap-select {
            width: 100% !important;
            max-width: 100% !important;
            background: #f5f5f5 !important;
            border-radius: 12px !important;
            border: 1px solid #e5e5e5 !important;
            padding: 4px 10px !important;
        }

        .dz-search-area .search-input .bootstrap-select .dropdown-toggle {
            padding: 10px 5px !important;
            font-weight: 500 !important;
            color: #333 !important;
            font-size: 15px !important;
            height: auto !important;
            background: transparent !important;
            border: none !important;
        }

        /* Search input field full width with soft background */
        .dz-search-area .search-input input[type="search"] {
            width: 100% !important;
            background: #f5f5f5 !important;
            border-radius: 12px !important;
            border: 1px solid #e5e5e5 !important;
            padding: 14px 45px 14px 15px !important;
            font-size: 15px !important;
            height: auto !important;
            color: #000 !important;
        }

        .dz-search-area .search-input input[type="search"]::placeholder {
            color: #888 !important;
        }

        /* Float search button absolutely on the middle right of the search input field */
        .dz-search-area .search-input button[type="submit"] {
            position: absolute !important;
            right: 12px !important;
            bottom: 12px !important; /* aligned with search input */
            background: transparent !important;
            border: none !important;
            padding: 0 !important;
            z-index: 10 !important;
            color: #222 !important;
            display: flex !important;
            align-items: center;
            justify-content: center;
            height: 24px !important;
            width: 24px !important;
        }

        .dz-search-area .search-input button[type="submit"] i {
            font-size: 20px !important;
        }

        /* Premium Chips for Quick Search Tags */
        .dz-search-area .recent-tag {
            display: flex !important;
            flex-wrap: wrap !important;
            align-items: center !important;
            gap: 8px !important;
            margin: 15px 0 0 0 !important;
            padding: 0 !important;
            list-style: none !important;
        }

        .dz-search-area .recent-tag li {
            padding: 0 !important;
            margin: 0 !important;
        }

        .dz-search-area .recent-tag li span {
            font-weight: 600 !important;
            font-size: 14px !important;
            color: #111 !important;
            margin-right: 4px !important;
            font-family: var(--font-family-title) !important;
        }

        .dz-search-area .recent-tag li a {
            display: inline-block !important;
            padding: 6px 14px !important;
            background: #f4f4f5 !important; /* Zinc-100 */
            border-radius: 20px !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            color: #52525b !important; /* Zinc-600 */
            transition: all 0.2s ease !important;
            text-decoration: none !important;
        }

        .dz-search-area .recent-tag li a:hover {
            background: #000000 !important;
            color: #ffffff !important;
        }

        /* Premium Bento-style Product Cards under You May Also Like */
        .dz-search-area .shop-card {
            background: #ffffff !important;
            border-radius: 16px !important;
            overflow: hidden !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03) !important;
            border: 1px solid #f0f0f0 !important;
            margin-bottom: 10px !important;
        }

        .dz-search-area .shop-card .dz-media {
            border-radius: 16px 16px 0 0 !important;
        }

        .dz-search-area .shop-card .dz-content {
            display: flex !important;
            flex-direction: column !important;
            align-items: flex-start !important;
            justify-content: flex-start !important;
            text-align: left !important;
            padding: 12px !important;
            background: #ffffff !important;
        }

        .dz-search-area .shop-card .dz-content .title {
            font-size: 13px !important;
            font-weight: 600 !important;
            margin-bottom: 4px !important;
            line-height: 1.3 !important;
        }

        .dz-search-area .shop-card .dz-content .title a {
            color: #111 !important;
            text-decoration: none !important;
        }

        .dz-search-area .shop-card .dz-content .price {
            font-size: 14px !important;
            font-weight: 700 !important;
            color: var(--primary, #000) !important;
            margin-top: 2px !important;
        }
    }

    /* Mobile Header Layout Rules to show Search and Cart icons */
    @media only screen and (max-width: 991px) {
        .site-header .extra-nav {
            position: relative !important;
            bottom: auto !important;
            left: auto !important;
            height: auto !important;
            width: auto !important;
            float: none !important;
            background: transparent !important;
            box-shadow: none !important;
            display: flex !important;
            align-items: center !important;
            padding: 0 !important;
            margin: 0 !important;
            z-index: 10 !important;
            /* Push to right, next to hamburger */
            margin-left: auto !important;
            margin-right: 15px !important;
            order: 2 !important;
            transition: none !important;
        }

        .site-header .navbar-toggler {
            order: 3 !important;
            margin-left: 0 !important;
            padding: 0 !important;
        }

        .site-header .logo-header {
            order: 1 !important;
        }

        /* Show only Search and Cart in Mobile Header */
        .site-header .extra-nav .extra-cell {
            display: flex !important;
            align-items: center !important;
        }

        .site-header .extra-nav .extra-cell ul.header-right {
            display: flex !important;
            flex-direction: row !important;
            align-items: center !important;
            margin: 0 !important;
            padding: 0 !important;
            list-style: none !important;
            gap: 12px !important;
        }

        .site-header .extra-nav .extra-cell ul.header-right li {
            display: none !important; /* Hide other items */
        }

        .site-header .extra-nav .extra-cell ul.header-right li.search-link,
        .site-header .extra-nav .extra-cell ul.header-right li.cart-link,
        .site-header .extra-nav .extra-cell ul.header-right li.wishlist-link {
            display: block !important; /* Show search, cart, and wishlist */
        }

        .site-header .extra-nav .extra-cell ul.header-right li.search-link a,
        .site-header .extra-nav .extra-cell ul.header-right li.cart-link a,
        .site-header .extra-nav .extra-cell ul.header-right li.wishlist-link a {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 40px !important;
            height: 40px !important;
            padding: 0 !important;
            color: #222 !important;
            position: relative !important;
            background: transparent !important;
            border: none !important;
        }

        .site-header .extra-nav .extra-cell ul.header-right li.search-link a i,
        .site-header .extra-nav .extra-cell ul.header-right li.cart-link a i,
        .site-header .extra-nav .extra-cell ul.header-right li.wishlist-link a i {
            font-size: 24px !important;
            color: #222 !important;
        }

        .site-header .extra-nav .extra-cell ul.header-right li .badge {
            position: absolute !important;
            top: 2px !important;
            right: 2px !important;
            background: #000000 !important;
            color: #ffffff !important;
            border-radius: 50% !important;
            min-width: 16px !important;
            height: 16px !important;
            font-size: 9px !important;
            font-weight: 700 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 0 !important;
            line-height: 1 !important;
            box-shadow: 0 0 0 2px #fff !important;
        }
    }
</style>

<header class="site-header mo-left header style-1 header-transparent">
    <!-- Main Header -->
    <div class="sticky-header main-bar-wraper navbar-expand-lg">
        @if (isset($headerCoupons) && count($headerCoupons) > 0)
            <div class="dz-topbar">
                <div class="marquee-container">
                    @for ($i = 0; $i < 4; $i++)
                        {{-- Repeat for continuous marquee effect --}}
                        @foreach ($headerCoupons as $coupon)
                            <div class="marquee-item">
                                <span>Get
                                    {{ $coupon->discounttype == 2 ? $coupon->discount . '%' : '₹' . $coupon->discount }}
                                    OFF
                                    using code
                                    <strong>{{ $coupon->codename }}</strong>
                                    @if ($coupon->mini_amt > 0)
                                        (Min. Order: ₹{{ number_format($coupon->mini_amt) }})
                                    @endif
                                </span>
                            </div>
                        @endforeach
                    @endfor
                </div>
            </div>
        @endif
        <div class="main-bar clearfix">
            <div class="container-fluid clearfix d-flex align-items-center justify-content-between">
                <!-- Website Logo -->
                <div class="logo-header logo-dark">
                    <a href="/"><img src="{{ asset('images/logo.webp') }}" alt="DARTE Logo" fetchpriority="high" loading="eager" style="max-width: 120px; height: auto; max-height: 80px; object-fit: contain;"></a>
                </div>

                <!-- Nav Toggle Button -->

                <button class="navbar-toggler collapsed navicon justify-content-end" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <!-- Main Nav -->
                <div class="header-nav w3menu navbar-collapse collapse justify-content-start w3menu"
                    id="navbarNavDropdown">
                    <div class="logo-header logo-dark">
                        <a href="/"><img src="{{ asset('images/logo.webp') }}" alt="DARTE Logo" loading="eager" style="max-width: 120px; height: auto; max-height: 80px; object-fit: contain;"></a>
                        <button class="menu-close" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                            aria-label="Toggle navigation">
                        </button>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class="has-mega-menu sub-menu-down auto-width menu-left">
                            <a href="/"><span>Home</span></a>
                        </li>
                        <li class="has-mega-menu sub-menu-down">
                            <a href="/about"><span>About</span></a>
                        </li>
                        <li class="has-mega-menu sub-menu-down">
                            <a href="/shop"><span>Shop</span></a>
                        </li>
                        <li class="has-mega-menu sub-menu-down">
                            <a href="/contact"><span>Contact</span></a>
                        </li>
                        <li class="custom-dropdown-container">
                            <a href="javascript:void(0);" class="nav-link custom-dropdown-toggle">
                                <span>Categories</span>
                                <i class="fa fa-chevron-down ms-1" style="font-size: 10px;"></i>
                            </a>
                            <ul class="custom-dropdown-menu mobile-category-menu">
                                @foreach ($headerCategories as $cat)
                                    <li>
                                        <a href="{{ route('shop', ['category' => $cat->id]) }}">
                                            {{ $cat->category_name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="has-mega-menu sub-menu-down d-lg-none">
                            <a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" onclick="openSidebar('wishlist')"><span>Wishlist</span></a>
                        </li>
                        <li class="has-mega-menu sub-menu-down d-lg-none">
                            <a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" onclick="openSidebar('cart')"><span>Cart</span></a>
                        </li>

                        {{-- My Account --}}
                        <li class="nav-item dropdown d-lg-none">
                            @if (auth()->check())
                                <a class="" href="#" data-bs-toggle="dropdown">
                                    <i class="fa fa-user me-2"></i>
                                    {{ auth()->user()->name }}
                                    <i class="fa fa-caret-down ms-2"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="/account-profile">
                                            My Account
                                        </a>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            @else
                                <a class="nav-link" href="/my-account">
                                    Login / Register
                                </a>
                            @endif
                        </li>

                    </ul>
                    <div class="dz-social-icon">
                        <ul>
                            <!-- <li><a class="fab fa-facebook-f" target="_blank" href="https://www.facebook.com/Darte"></a>
                            </li>
                            <li><a class="fab fa-twitter" target="_blank" href="https://twitter.com/Dartes"></a></li>
                            <li><a class="fab fa-linkedin-in" target="_blank"
                                    href="https://www.linkedin.com/showcase/3686700/admin/"></a></li> -->
                            <li><a class="fab fa-instagram" target="_blank" href="https://www.instagram.com/Darte/"></a>
                            </li>
                        </ul>
                    </div>
                </div>

                 <!-- EXTRA NAV -->
                <div class="extra-nav ">
                    <div class="extra-cell">
                        <ul class="header-right">
                            {{-- <li class="nav-item login-link">
                                <a class="nav-link" href="/my-account">
                                    Login / Register
                                </a>
                            </li> --}}
                            {{-- <li class="nav-item login-link">
                                @if (auth()->check())
                                <a class="nav-link" href="/my-account">
                                    {{ auth()->user()->name }}
                                </a>
                                @else
                                <a class="nav-link" href="/my-account">
                                    Login / Register
                                </a>
                                @endif
                            </li> --}}
                            <li class="nav-item dropdown">
                                @if (auth()->check())
                                    <a class="" href="#" data-bs-toggle="dropdown">
                                        <i class="fa fa-user me-2"></i>
                                        {{ auth()->user()->name }}
                                        <i class="fa fa-caret-down ms-2"></i>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="/account-profile">
                                                My Account
                                            </a>
                                        </li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="dropdown-item">
                                                    Logout
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                @else
                                    <a class="nav-link" href="/my-account">
                                        Login / Register
                                    </a>
                                @endif
                            </li>
                            {{-- @if (auth()->check())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                    {{ auth()->user()->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/my-account">My Account</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @endif --}}
                            <li class="nav-item search-link">
                                <a class="nav-link" href="javascript:void(0);" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasTop" aria-controls="offcanvasTop" aria-label="Search Products">
                                    <i class="iconly-Light-Search"></i>
                                </a>
                            </li>
                            <li class="nav-item wishlist-link">
                                <a class="nav-link"
                                    href="{{ auth()->check() ? 'javascript:void(0);' : url('/my-account') }}"
                                    @if (auth()->check()) data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                    onclick="openSidebar('wishlist')" @endif aria-label="View Wishlist">
                                    <i class="iconly-Light-Heart2"></i>
                                    <span class="badge badge-circle">{{ $wishlistCount }}</span>
                                </a>
                            </li>
                            <li class="nav-item cart-link">
                                <a class="nav-link cart-btn"
                                    href="{{ auth()->check() ? 'javascript:void(0);' : url('/my-account') }}"
                                    @if (auth()->check()) data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                    onclick="openSidebar('cart')" @endif aria-label="View Shopping Cart">
                                    <i class="iconly-Broken-Buy"></i>
                                    <span class="badge badge-circle">{{ $cartCount }}</span>
                                </a>
                            </li>
                            <li class="nav-item filte-link">
                                <a href="javascript:void(0);" class="nav-link filte-btn" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasLeft" aria-controls="offcanvasLeft" aria-label="Open Filter Menu">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        viewBox="0 0 30 13" fill="none">
                                        <rect y="11" width="30" height="2" fill="black" />
                                        <rect width="30" height="2" fill="black" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Header End -->


    <!-- SearchBar -->
    <div class="dz-search-area dz-offcanvas offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
            &times;
        </button>
        <div class="container">
            <form class="header-item-search" action="{{ route('shop') }}" method="GET">
                <div class="input-group search-input">
                    <select class="default-select" name="category">
                        <option value="">All Categories</option>
                        @foreach ($headerCategories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                    <input type="search" class="form-control" name="dzSearch" placeholder="Search Product">
                    <button class="btn" type="submit">
                        <i class="iconly-Light-Search"></i>
                    </button>
                </div>
                <ul class="recent-tag">
                    <li class="pe-0"><span>Quick Search :</span></li>
                    @foreach ($headerCategories->take(4) as $cat)
                        <li><a href="{{ route('shop', ['category' => $cat->id]) }}">{{ $cat->category_name }}</a>
                        </li>
                    @endforeach
                </ul>
            </form>
            <div class="row">
                <div class="col-xl-12">
                    <h5 class="mb-3">You May Also Like</h5>
                    <div class="swiper category-swiper2">
                        <div class="swiper-wrapper">
                            @foreach ($headerRandomProducts as $prod)
                                <div class="swiper-slide">
                                    <div class="shop-card">
                                        <div class="dz-media ">
                                            <a href="{{ route('shop.details', $prod->slug) }}">
                                                <img src="{{ env('MAIN_URL') . 'images/' . $prod->product_image }}"
                                                    alt="{{ $prod->product_name }}" width="300" height="375" loading="lazy">
                                            </a>
                                        </div>
                                        <div class="dz-content text-center">
                                            <h6 class="title mb-1"><a
                                                    href="{{ route('shop.details', $prod->slug) }}">{{ $prod->product_name }}</a>
                                            </h6>
                                            <h6 class="price text-primary">
                                                @if ($prod->variants->isNotEmpty())
                                                    ₹{{ number_format($prod->variants->min('offer_price'), 2) }}
                                                @else
                                                    ₹{{ number_format($prod->product_regular_price, 2) }}
                                                @endif
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SearchBar End -->

    <script>
        // Topbar Swiper removed for marquee logic
    </script>
    <!-- Sidebar cart -->
    <div class="offcanvas dz-offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
            &times;
        </button>
        <div class="offcanvas-body">
            <div class="product-description">
                <div class="dz-tabs">
                    <ul class="nav nav-tabs center" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="shopping-cart" data-bs-toggle="tab"
                                data-bs-target="#shopping-cart-pane" type="button" role="tab"
                                aria-controls="shopping-cart-pane" aria-selected="true">Shopping Cart
                                <span class="badge badge-light">{{ $cartCount }}</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="wishlist" data-bs-toggle="tab"
                                data-bs-target="#wishlist-pane" type="button" role="tab"
                                aria-controls="wishlist-pane" aria-selected="false">Wishlist
                                <span class="badge badge-light">{{ $wishlistCount }}</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="coupons-tab" data-bs-toggle="tab"
                                data-bs-target="#coupons-pane" type="button" role="tab"
                                aria-controls="coupons-pane" aria-selected="false">Coupons
                                <span class="badge badge-light">{{ count($headerCoupons) }}</span>
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content pt-4" id="dz-shopcart-sidebar">
                        @include('partials.sidebar-cart')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sidebar cart -->

    <!-- Sidebar finter -->

    <script>
        function openSidebar(tab) {
            if (tab === 'cart') {
                setTimeout(() => {
                    document.getElementById('shopping-cart').click();
                }, 100);
            } else if (tab === 'wishlist') {
                setTimeout(() => {
                    document.getElementById('wishlist').click();
                }, 100);
            }
        }
    </script>
    <div class="offcanvas dz-offcanvas offcanvas-end" tabindex="-1" id="offcanvasLeft">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
            &times;
        </button>
        <div class="offcanvas-body">
            <form action="{{ route('shop') }}" method="GET">
                <div class="product-description">
                    <div class="widget widget_search">
                        <div class="form-group">
                            <div class="input-group">
                                <input name="dzSearch" type="search" class="form-control"
                                    placeholder="Search Product">
                                <div class="input-group-addon">
                                    <button name="submit" value="Submit" type="submit" class="btn">
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
                                    <div id="slider-tooltips-header" class="mb-3"></div>
                                    <span class="example-val" id="slider-margin-value-min"></span>
                                    <span class="example-val" id="slider-margin-value-max"></span>
                                    <input type="hidden" name="min_price" id="header_min_price"
                                        value="{{ request('min_price', $headerGlobalMinPrice) }}">
                                    <input type="hidden" name="max_price" id="header_max_price"
                                        value="{{ request('max_price', $headerGlobalMaxPrice) }}">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="widget">
                        <h6 class="widget-title">Size</h6>
                        <div class="btn-group product-size flex-wrap">
                            @foreach ($headerAllSizes as $index => $size)
                                <input type="radio" class="btn-check" name="size"
                                    id="size_{{ $index }}" value="{{ $size }}"
                                    {{ request('size') == $size ? 'checked' : '' }}>
                                <label class="btn" for="size_{{ $index }}">{{ $size }}</label>
                            @endforeach
                        </div>
                    </div>
                    <div class="widget widget_categories">
                        <h6 class="widget-title">Category</h6>
                        <ul>
                            @foreach ($headerCategoriesWithCounts as $cat)
                                <li class="cat-item"><a
                                        href="{{ route('shop', ['category' => $cat->id]) }}">{{ $cat->category_name }}</a>
                                    ({{ $cat->products_count }})
                                </li>
                            @endforeach
                        </ul>
                    </div>


                    <div class="row g-2">
                        <div class="col-6">
                            <button type="submit"
                                class="btn btn-sm btn-secondary w-100 font-14 btn-sharp">APPLY</button>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('shop') }}"
                                class="btn btn-sm btn-outline-secondary w-100 font-14 btn-sharp">RESET</a>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    <!-- filter sidebar -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var slider = document.getElementById('slider-tooltips-header');
            if (slider && typeof noUiSlider !== 'undefined') {
                if (slider.noUiSlider) {
                    slider.noUiSlider.destroy();
                }
                noUiSlider.create(slider, {
                    start: [{{ request('min_price', $headerGlobalMinPrice) }},
                        {{ request('max_price', $headerGlobalMaxPrice) }}
                    ],
                    connect: true,
                    range: {
                        'min': {{ $headerGlobalMinPrice }},
                        'max': {{ $headerGlobalMaxPrice }}
                    },
                    format: wNumb({
                        decimals: 0
                    })
                });

                var marginMin = document.getElementById('slider-margin-value-min');
                var marginMax = document.getElementById('slider-margin-value-max');
                var minInput = document.getElementById('header_min_price');
                var maxInput = document.getElementById('header_max_price');

                slider.noUiSlider.on('update', function(values, handle) {
                    if (handle) {
                        marginMax.innerHTML = "₹" + values[handle];
                        maxInput.value = values[handle];
                    } else {
                        marginMin.innerHTML = "₹" + values[handle];
                        minInput.value = values[handle];
                    }
                });
            }
        });
    </script>

</header>
<!-- Header End -->
