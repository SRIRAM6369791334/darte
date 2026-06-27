<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu" style="    background: unset;
    border-color: unset;">
    {{--

    <body data-layout="horizontal" data-sidebar="dark"> --}}
        <!-- LOGO -->
        <div class="navbar-brand-box" style="background:#ffff;">
            <a href="{{ url('/') }}" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="{{ URL::asset('assets/images/smlo.webp') }}" alt="" style="width:100px">
                </span>
                <span class="logo-lg">
                    <img src="{{ URL::asset('assets/images/logochip.webp') }}" alt="" height="22" style="width:40px">
                </span>
            </a>

            <a href="{{ url('/') }}" class="logo logo-light">
                <span class="logo-lg d-flex align-items-center justify-content-center" style="height: 70px;">
                    <img src="{{ URL::asset('assets/images/logo.webp') }}" alt="Darte Logo" style="max-height: 50px; width: auto; max-width: 100%; object-fit: contain;">
                </span>
                <!-- <span class="logo-sm d-flex align-items-center justify-content-center" style="height: 70px;">
                    <img src="{{ URL::asset('assets/images/logo.webp') }}" alt="Darte Logo" style="max-height: 30px; width: auto; max-width: 100%; object-fit: contain;">
                </span> -->
            </a>
        </div>

        <button type="button" class="btn btn-sm px-3 font-size-16 header-item vertical-menu-btn">
            <i class="fa fa-fw fa-bars"></i>
        </button>

        <div data-simplebar class="sidebar-menu-scroll">

            <!--- Sidemenu -->
            <div id="sidebar-menu" style="background: #000">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">



                    @if (Auth::user()->role == 1)
                        <li class="menu-title" data-key="t-menu">Menu</li>
                        <li>
                            <a href="{{ url('/') }}">
                                <i class="bx bx-tachometer icon nav-icon"></i>
                                <span class="menu-item" data-key="t-dashboards">@lang('translation.Dashboard')</span>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="{{ route('users.index') }}">

                                <i class="mdi mdi-18px mdi-account-circle icon nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Dashboard Users</span>
                            </a>
                        </li> --}}


                        <li class="menu-title" data-key="t-applications">Home Promotions</li>

                        <li>
                            <a href="{{ route('bannerImages.index') }}">
                                <i class="mdi mdi-image-area nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Banner Images</span>
                            </a>
                        </li>

                        <li class="menu-title" data-key="t-applications">Instagram Image</li>
                        <li>
                            <a href="{{ route('instagram-image.index') }}">
                                <i class="mdi mdi-star-box nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Instagram image</span>
                            </a>
                        </li>
                        {{-- <li class="menu-title" data-key="t-applications">Blog</li>
                        <li>
                            <a href="{{ route('blog.index') }}">
                                <i class="mdi mdi-star-box nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Blog</span>
                            </a>
                        </li> --}}

                        {{-- <li class="menu-title" data-key="t-applications">Instagram Image</li>
                        <li>
                            <a href="{{ route('instagram-image.index') }}">
                                <i class="mdi mdi-instagram nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Instagram Image</span>
                            </a>
                        </li> --}}


                        <li class="menu-title" data-key="t-applications">Users</li>
                        <li>
                            <a href="{{ route('customers.index') }}">
                                <i class="bx bxs-user icon nav-icon"></i>
                                <span class="menu-item" data-key="t-calendar">Customers</span>
                            </a>
                        </li>

                        <li class="menu-title" data-key="t-applications">Products</li>

                        <li>
                            <a href="{{ route('categories.index') }}">
                                <i class="bx bx-list-ul icon nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Category</span>
                            </a>
                        </li>

                        <!-- <li>
                                                                                                                                        <a href="{{ route('brands.index') }}">
                                                                                                                                            <i class="bx bx-award nav-icon"></i>
                                                                                                                                            <span class="menu-item" data-key="t-chat">Brands</span>
                                                                                                                                        </a>
                                                                                                                                    </li> -->

                        <li>
                            <a href="{{ route('subcategories.index') }}">
                                <i class="bx bx-store icon nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Sub Category</span>
                                <!-- <span class="badge rounded-pill bg-danger" data-key="t-hot">@lang('translation.Hot')</span> -->
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('products.index') }}">
                                <i class="bx bxs-basket nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Products</span>
                                {{-- <span class="badge rounded-pill bg-danger"
                                    data-key="t-hot">@lang('translation.Hot')</span> --}}
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('productvarient.index') }}">
                                <i class="mdi mdi-timer-sand-empty nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Product Variant</span>

                            </a>
                        </li>

                        <li>
                            <a href="{{ route('stocks.index') }}">
                                <i class="bx bxs-report nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Product Stock</span>
                                @if (isset($stockscount) && $stockscount > 0)
                                    <span class="badge rounded-pill bg-danger float-end">{{ $stockscount }}</span>
                                @endif
                            </a>
                        </li>
                        <!-- <li>
                                                                                                                                            <a href="{{ route('lowstock') }}">
                                                                                                                                                <i class="bx bx-error nav-icon"></i>
                                                                                                                                                <span class="menu-item" data-key="t-chat">Low Stock Alert</span>
                                                                                                                                                @if (isset($stockscount) && $stockscount > 0)
                                    <span class="badge rounded-pill bg-danger float-end">{{ $stockscount }}</span>
                                    @endif
                                                                                                                                            </a>
                                                                                                                                        </li> -->

                        {{-- <li>
                            <a href="{{ route('todaydeals.index') }}">
                                <i class="bx bx-store icon nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Today Deals</span>

                            </a>
                        </li> --}}

                        <li>
                            <a href="{{ route('coupons.index') }}">
                                <i class="bx bxs-report nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Coupons</span>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="{{ route('combostock.index') }}">
                                <i class="mdi mdi-clipboard-plus nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Product Combo Stock</span>
                            </a>
                        </li> --}}

                        <li class="menu-title" data-key="t-applications">Gift Items</li>
                        <li>
                            <a href="{{ route('gift_categories.index') }}">
                                <i class="bx bx-gift icon nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Gift Banner</span>
                            </a>
                        </li>
                        <!-- <li>
                                                                                                                                                                        <a href="{{ route('gift_subcategories.index') }}">
                                                                                                                                                                            <i class="bx bxs-gift icon nav-icon"></i>
                                                                                                                                                                            <span class="menu-item" data-key="t-chat">Gift Sub Category</span>
                                                                                                                                                                        </a>
                                                                                                                                                                    </li>
                                                                                                                                                                    <li>
                                                                                                                                                                        <a href="{{ route('gift_products.index') }}">
                                                                                                                                                                            <i class="mdi mdi-gift-outline nav-icon"></i>
                                                                                                                                                                            <span class="menu-item" data-key="t-chat">Gift Products</span>
                                                                                                                                                                        </a>
                                                                                                                                                                    </li> -->

                        <li class="menu-title" data-key="t-applications">Orders</li>

                        <li>
                            <a href="{{ route('productOrders.index') }}">
                                <i class="mdi mdi-food nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Product Orders</span>
                            </a>
                        </li>


                        {{-- <li class="menu-title" data-key="t-applications">Refund</li>

                        <li>
                            <a href="{{ route('cancelproduct.index') }}">
                                <i class="mdi mdi-bell-ring nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Request Cancel</span>

                                @if ($cancelreq)
                                <span class="badge rounded-pill bg-success">{{ $cancelreq }}</span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('productRefunds.index') }}">
                                <i class="mdi mdi-cash-100 nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Product Refund</span>

                                @if ($productRefundPendingCount)
                                <span class="badge rounded-pill bg-success">{{ $productRefundPendingCount }}</span>
                                @endif
                            </a>
                        </li> --}}


                        <li class="menu-title" data-key="t-applications">Reports</li>
                        <li>
                            <a href="/productwisereport">
                                <i class="mdi mdi-autorenew nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Product Wise Report</span>

                            </a>
                        </li>
                        <li>
                            <a href="/orderwisereport">
                                <i class="mdi mdi-autorenew nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Order Wise Report</span>

                            </a>
                        </li>

                        <li class="menu-title" data-key="t-applications">SEO Management</li>
                        <li>
                            <a href="{{ route('seo-hub.index') }}">
                                <i class="bx bx-globe icon nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">SEO Hub</span>
                            </a>
                        </li>
                        <!-- <li class="menu-title" data-key="t-applications">Shipping Charges</li>
                                                                                                                                                                    <li>
                                                                                                                                                                        <a href="/admin/shipping-amount">
                                                                                                                                                                            <i class="mdi mdi-autorenew nav-icon"></i>
                                                                                                                                                                            <span class="menu-item" data-key="t-chat">Shipping Charges</span>

                                                                                                                                                                        </a>
                                                                                                                                                                    </li>
                                                                                                                                                                    <li>
                                                                                                                                                                        <a href="/admin/free-ship">
                                                                                                                                                                            <i class="mdi mdi-autorenew nav-icon"></i>
                                                                                                                                                                            <span class="menu-item" data-key="t-chat">Free Shipping</span>

                                                                                                                                                                        </a>
                                                                                                                                                                    </li>
                                                                                                                                                                    <li class="menu-title" data-key="t-applications">Coupon Management</li>
                                                                                                                                                                    <li>
                                                                                                                                                                        <a href="/admin/coupons">
                                                                                                                                                                            <i class="mdi mdi-autorenew nav-icon"></i>
                                                                                                                                                                            <span class="menu-item" data-key="t-chat">Coupons</span>

                                                                                                                                                                        </a>
                                                                                                                                                                    </li>

                                                                                                                                                                    <li class="menu-title" data-key="t-applications">Scrolling Bar</li>
                                                                                                                                                                    <li>
                                                                                                                                                                        <a href="/scrollingbar">
                                                                                                                                                                            <i class="mdi mdi-autorenew nav-icon"></i>
                                                                                                                                                                            <span class="menu-item" data-key="t-chat">Scrolling Message</span>

                                                                                                                                                                        </a>
                                                                                                                                                                    </li> -->

                        {{-- <li>
                            <a href="/cancelrequests">
                                <i class="mdi mdi-close nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Cancellation Requests</span>
                                @if ($cancelreq)
                                <span class="badge rounded-pill bg-success">{{ $cancelreq }}</span>
                                @endif

                            </a>
                        </li>
                        <li>
                            <a href="/returnrequests">
                                <i class="mdi mdi-close nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Return Requests</span>
                                @if ($returnreqcount)
                                <span class="badge rounded-pill bg-success">{{ $returnreqcount }}</span>
                                @endif

                            </a>
                        </li> --}}

                        <!-- <li class="menu-title" data-key="t-shiprocket">Shiprocket Integration</li>
                                                                <li class="{{ Request::is('shiprocket*') ? 'active' : '' }}">
                                                                    <a href="{{ route('shiprocket.pickup') }}">
                                                                        <i class="bx bxs-ship nav-icon"></i>
                                                                        <span class="menu-item" data-key="t-pickup-locations">Pickup Locations</span>
                                                                    </a>
                                                                </li> -->

                        {{-- <li>
                            <a href="{{ route('incomeReports') }}">
                                <i class="bx bxs-report nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Income Report</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('ordersummery.index') }}">
                                <i class="mdi mdi-autorenew nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Order Summary</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('highselling') }}">
                                <i class="mdi mdi-percent nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">High Selling</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('topcustomer.index') }}">
                                <i class="mdi mdi-plus-circle-outline nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Top Customer</span>
                            </a>
                        </li> --}}

                        <li class="menu-title" data-key="t-applications">Product Reviews</li>
                        {{-- <li>
                            <a href="{{ route('offerImages.index') }}">
                                <i class="bx bxs-report nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Offers Banner</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('coupons.index') }}">
                                <i class="bx bxs-report nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">One Time Coupon </span>
                            </a>
                        </li> --}}
                        <li>
                            <a href="{{ route('review.index') }}">
                                <i class="mdi mdi-comment-text-multiple nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Reviews</span>
                            </a>
                        </li>

                        <li class="menu-title" data-key="t-applications">Feedback & Subscriptions</li>
                        <li>
                            <a href="{{ route('contacts.index') }}">
                                <i class="mdi mdi-email-receive-outline nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Contact Messages</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('newsletter.index') }}">
                                <i class="mdi mdi-email-newsletter nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Newsletter Subscribers</span>
                            </a>
                        </li>
                        {{-- <li class="menu-title" data-key="t-applications">Bulk Order Enquries</li>

                        <li>
                            <a href="{{ route('bulkenquiry.index') }}">
                                <i class="mdi mdi-plus-circle-outline nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Bulk Order Enquries</span>
                            </a>
                        </li> --}}

                        {{-- Account User Permission --}}
                    @elseif(Auth::user()->role == 2)
                        <li class="menu-title" data-key="t-applications">Orders</li>


                        <li>
                            <a href="{{ route('productOrders.index') }}">
                                <i class="mdi mdi-food nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Billing Products</span>
                                @if ($productOrderBIllingCount)
                                    <span class="badge rounded-pill bg-success">{{ $productOrderBIllingCount }}</span>
                                @endif

                            </a>
                        </li>
                    @elseif (Auth::user()->role == 3)
                        <li class="menu-title" data-key="t-applications">Orders</li>
                        <li>
                            <a href="{{ route('productpacking.index') }}">
                                <i class="mdi mdi-food nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Package Orders</span>
                                @if ($productOrderPendingCount)
                                    <span class="badge rounded-pill bg-success">{{ $productOrderPendingCount }}</span>
                                @endif

                            </a>
                        </li>
                    @elseif (Auth::user()->role == 4)
                        <li class="menu-title" data-key="t-applications">Orders</li>
                        <li>
                            <a href="{{ route('productdispatch.index') }}">
                                <i class="mdi mdi-food nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Dispatched Orders</span>
                                @if ($productOrderDispatchCount)
                                    <span class="badge rounded-pill bg-success">{{ $productOrderDispatchCount }}</span>
                                @endif

                            </a>
                        </li>
                    @elseif (Auth::user()->role == 5)
                        <li class="menu-title" data-key="t-applications">Orders</li>
                        <li>
                            <a href="{{ route('productdelivery.index') }}">
                                <i class="mdi mdi-food nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Out of Delivery Orders</span>
                                @if ($productOrderDeliveryCount)
                                    <span class="badge rounded-pill bg-success">{{ $productOrderDeliveryCount }}</span>
                                @endif

                            </a>
                        </li>
                        <li>
                            <a href="{{ route('productcomplete.index') }}">
                                <i class="mdi mdi-food nav-icon"></i>
                                <span class="menu-item" data-key="t-chat">Delivered Order</span>
                                {{-- @if ($productOrdercompleteCount)
                                <span class="badge rounded-pill bg-success">{{ $productOrdercompleteCount}}</span>
                                @endif --}}

                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <!-- Sidebar -->
        </div>
</div>
<!-- Left Sidebar End -->