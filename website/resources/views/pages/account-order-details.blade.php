@extends('layouts.app')
@section('content')

    <style>
        .content-inner-1 {
            background: white !important;
        }

        /* Banner Overrides for this page */
        .dz-bnr-inr {
            padding-top: 200px !important;
        }

        @media (max-width: 767px) {
            .dz-bnr-inr {
                padding-top: 0px !important;
                padding-bottom: 0px !important;
                height: auto !important;
                min-height: 140px !important;
            }
        }
            @media only screen and (max-width: 575px) {
        .dz-bnr-inr {
            --dz-banner-height: 183px;
        }
    }
@media only screen and (max-width: 575px) {
    .dz-bnr-inr .dz-bnr-inr-entry {
        padding: 0px;
        padding-top: 54px;
        text-align: center;
        display: table-cell;
    }
}
    </style>

    <div class="page-content bg-light">
        <!-- <div class="dz-bnr-inr bg-secondary overlay-black-light"
                                                                style="background-image:url(assets/images/background/bg1.webp);padding-top: 200px;">
                                                                <div class="container">
                                                                    <div class="dz-bnr-inr-entry">
                                                                        <h1>Account Orders</h1>
                                                                        <nav aria-label="breadcrumb" class="breadcrumb-row">
                                                                            <ul class="breadcrumb">
                                                                                <li class="breadcrumb-item"><a href="{{ route('home') }}"> Home</a></li>
                                                                                <li class="breadcrumb-item">Account Orders</li>
                                                                            </ul>
                                                                        </nav>
                                                                    </div>
                                                                </div>
                                                            </div> -->
        <div class="dz-bnr-inr bg-secondary overlay-black-light"
            style="background-image:url(/assets/images/background/bg1.webp);">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1 style="color: #fff !important;">Account Order Details</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"> Home</a></li>
                            <li class="breadcrumb-item">Account Order Details</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="content-inner-1">
            <div class="container">
                <div class="row">


                    <aside class="col-xl-3">
                        <div class="toggle-info">
                            <h5 class="title mb-0">Account Navbar</h5>
                            <a class="toggle-btn" href="#accountSidebar">Account Menu</a>
                        </div>
                        <div class="sticky-top account-sidebar-wrapper">
                            <div class="account-sidebar" id="accountSidebar">
                                <button class="btn-close sidebar-close-btn d-xl-none" type="button" onclick="document.getElementById('accountSidebar').classList.remove('show')" aria-label="Close" style="position: absolute; top: 15px; right: 15px; z-index: 999;"></button>
                                <div class="profile-head">
                                    <div class="user-thumb d-flex flex-column align-items-center">
                                        @if ($user->profile_image)
                                            <img id="imagePreview" src="{{ asset($user->profile_image) }}"
                                                alt="{{ $user->name }}"
                                                style="width: 100px; height: 80px; border-radius: 50%; object-fit: cover; display: block;">
                                        @else
                                            <img id="imagePreview" src="" alt=""
                                                style="width: 100px; height: 80px; border-radius: 50%; object-fit: cover; display: none;">
                                            <div id="initialCircle"
                                                style="width: 100px; height: 80px; background-color: #f7a400; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 40px; font-weight: bold;">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <h5 class="title mb-0">{{ $user->name }}</h5>
                                    <span class="text text-primary">{{ $user->email }}</span>
                                </div>
                                <div class="account-nav">
                                    <div class="nav-title bg-light">My ACCOUNT</div>
                                    <ul class="account-info-list">
                                        <li><a href="{{ route('account.profile') }}"
                                                class="{{ request()->routeIs('account.profile') ? 'active' : '' }}">Profile</a>
                                        </li>
                                        <li><a href="{{ route('account.address') }}"
                                                class="{{ request()->routeIs('account.address') ? 'active' : '' }}">Address</a>
                                        </li>
                                        <li><a href="{{ route('account.orders') }}"
                                                class="{{ request()->routeIs('account.orders') ? 'active' : '' }}">Orders</a>
                                        </li>
                                        <li><a href="{{ route('wishlist') }}">Wishlist</a></li>
                                        <li><a href="{{ route('cart') }}">Cart</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </aside>



                    <section class="col-xl-9 account-wrapper">
                        <div class="account-card order-details">
                            <div class="order-head">
                                <div class="head-thumb">
                                    @php
                                        $headImage = $order->items->isNotEmpty() ? $order->items[0]->product_image : null;
                                    @endphp
                                    @if ($headImage)
                                        <img src="{{ env('MAIN_URL') . 'images/' . $headImage }}" alt="">
                                    @else
                                        <img src="/assets/images/shop/small/pic1.webp" alt="">
                                    @endif
                                </div>
                                <div class="clearfix m-l20">
                                    @php
                                        $badgeClass = 'bg-info';
                                        if ($order->status == 'Delivered') {
                                            $badgeClass = 'bg-success';
                                        } elseif ($order->status == 'Canceled') {
                                            $badgeClass = 'bg-danger';
                                        } elseif ($order->status == 'Order Placed') {
                                            $badgeClass = 'bg-warning';
                                        }
                                    @endphp
                                    <div class="badge {{ $badgeClass }}">{{ $order->status }}</div>
                                    <h4 class="mb-0">Order #{{ $order->order_number }}</h4>
                                </div>
                            </div>
                            <div class="row mb-sm-4 mb-2">
                                <div class="col-sm-6">
                                    <div class="shiping-tracker-detail">
                                        <span>Main Item</span>
                                        <h6 class="title">
                                            {{ $order->items->count() > 0 ? $order->items[0]->product_name : 'N/A' }}
                                        </h6>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="shiping-tracker-detail">
                                        <span>Courier</span>
                                        <h6 class="title">{{ $order->courier_name ?? 'Not Assigned' }}</h6>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="shiping-tracker-detail">
                                        <span>Start Time</span>
                                        <h6 class="title">{{ $order->created_at->format('d M Y, H:i:s') }}</h6>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="shiping-tracker-detail">
                                        <span>Address</span>
                                        <h6 class="title">
                                            {{ $order->shipping_door_no }}, {{ $order->shipping_street }}<br>
                                            {{ $order->shipping_city }}, {{ $order->shipping_state }} -
                                            {{ $order->shipping_pincode }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="content-btn m-b15">
                                <!-- <a href="#" class="btn btn-secondary me-xl-3 me-2 m-b15 btnhover20">Download Invoice</a> -->
                                <!-- <a href="{{ route('account.order.return', $order->id) }}"
                                                                    class="btn btn-outline-primary m-b15 me-xl-3 me-2 btnhover20">Return Items</a> -->
                                <a href="{{ route('contact') }}"
                                    class="btn btn-outline-secondary m-b15 me-xl-3 me-2 btnhover20">Support</a>
                            </div>
                            <div class="clearfix">
                                <div class="dz-tabs style-3">
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-order-history-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-order-history" role="tab" aria-controls="nav-order-history"
                                            aria-selected="true">Order
                                            History</button>
                                        <button class="nav-link" id="nav-Item-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-Item" role="tab" aria-controls="nav-Item"
                                            aria-selected="false">Item Details</button>
                                        <button class="nav-link" id="nav-courier-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-courier" role="tab" aria-controls="nav-courier"
                                            aria-selected="false">Courier</button>
                                        <button class="nav-link" id="nav-receiver-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-receiver" role="tab" aria-controls="nav-receiver"
                                            aria-selected="false">Receiver</button>
                                    </div>
                                </div>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-order-history" role="tabpanel"
                                        aria-labelledby="nav-order-history-tab" tabindex="0">
                                        <div class="widget-timeline style-1">
                                            <ul class="timeline">
                                                @if (
                                                        $trackingData &&
                                                        isset($trackingData['shipment_track_activities']) &&
                                                        count($trackingData['shipment_track_activities']) > 0
                                                    )
                                                    {{-- Live Tracking from Shiprocket --}}
                                                    @foreach ($trackingData['shipment_track_activities'] as $index => $scan)
                                                        <li>
                                                            <div class="timeline-badge {{ $index === 0 ? 'success' : 'primary' }}">
                                                            </div>
                                                            <div class="timeline-box">
                                                                <a class="timeline-panel" href="javascript:void(0);">
                                                                    <h6 class="mb-0">{{ $scan['activity'] }}</h6>
                                                                    <span>{{ \Carbon\Carbon::parse($scan['date'])->format('d M Y, H:i') }}</span>
                                                                </a>
                                                                @if (!empty($scan['location']))
                                                                    <p><strong>Location: </strong>{{ $scan['location'] }}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                @else
                                                    {{-- Fallback / Local Status --}}
                                                    @if ($order->status == 'Delivered')
                                                        <li>
                                                            <div class="timeline-badge success"></div>
                                                            <div class="timeline-box">
                                                                <a class="timeline-panel" href="javascript:void(0);">
                                                                    <h6 class="mb-0">Delivered</h6>
                                                                    <span>{{ $order->updated_at->format('d/m/Y H:i') }}</span>
                                                                </a>
                                                                <p>Package has been delivered successfully.</p>
                                                            </div>
                                                        </li>
                                                    @endif

                                                    @if ($order->awb_code)
                                                        <li>
                                                            <div class="timeline-badge primary"></div>
                                                            <div class="timeline-box">
                                                                <a class="timeline-panel" href="javascript:void(0);">
                                                                    <h6 class="mb-0">Product Shipped</h6>
                                                                    <span>{{ $order->updated_at->format('d/m/Y H:i') }}</span>
                                                                </a>
                                                                <p><strong>Courier Service :
                                                                    </strong>{{ $order->courier_name }}</p>
                                                                <p><strong>Tracking Number :
                                                                    </strong>{{ $order->awb_code }}</p>
                                                            </div>
                                                        </li>
                                                    @endif

                                                    <li>
                                                        <div class="timeline-badge primary"></div>
                                                        <div class="timeline-box">
                                                            <a class="timeline-panel" href="javascript:void(0);">
                                                                <h6 class="mb-0">Order Placed</h6>
                                                                <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
                                                            </a>
                                                            <p>Your order has been received and is being processed.</p>
                                                        </div>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-Item" role="tabpanel" aria-labelledby="nav-Item-tab"
                                        tabindex="0">
                                        <h5>Item Details</h5>
                                        @foreach ($order->items as $item)
                                        <div class="tracking-item">
                                            <div class="tracking-product">
                                                @if ($item->product_image)
                                                    <img src="{{ env('MAIN_URL') . 'images/' . $item->product_image }}"
                                                        alt="{{ $item->product_name }}">
                                                @else
                                                    <img src="/assets/images/shop/small/pic1.webp" alt="">
                                                @endif
                                            </div>
                                            <div class="tracking-product-content">
                                                <h6 class="title">{{ $item->product_name }}</h6>
                                                <small class="d-block"><strong>Price</strong> :
                                                    ₹{{ number_format($item->price, 2) }} x
                                                    {{ $item->quantity }}</small>
                                                @if ($item->variant_name)
                                                    <small class="d-block"><strong>Variant</strong> :
                                                        {{ $item->variant_name }}</small>
                                                @endif
                                            </div>
                                        </div>
                                        @endforeach

                                        <div class="tracking-item-content mt-4">
                                            <span>Subtotal</span>
                                            <h6>₹{{ number_format($order->subtotal, 2) }}</h6>
                                        </div>
                                        <div class="tracking-item-content">
                                            <span>Tax (GST)</span>
                                            <h6>+ ₹{{ number_format($order->gst_amount, 2) }}</h6>
                                        </div>
                                        <div class="tracking-item-content">
                                            <span>Shipping</span>
                                            <h6>+ ₹{{ number_format($order->shipping_charge, 2) }}</h6>
                                        </div>
                                        <div class="tracking-item-content border-top border-light pt-2">
                                            <span><strong>Total</strong></span>
                                            <h6 class="text-primary">₹{{ number_format($order->total_amount, 2) }}</h6>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-courier" role="tabpanel"
                                        aria-labelledby="nav-courier-tab" tabindex="0">
                                        <h5>Courier Information</h5>
                                        @if ($order->courier_name)
                                            <p><strong>Service:</strong> {{ $order->courier_name }}</p>
                                            <p><strong>Tracking Code:</strong> {{ $order->awb_code }}</p>

                                            @if ($trackingData && isset($trackingData['track_url']))
                                                <div class="mt-3">
                                                    <a href="{{ $trackingData['track_url'] }}" target="_blank"
                                                        class="btn btn-primary btn-sm">Track on Shiprocket</a>
                                                </div>
                                            @endif

                                            <p class="mt-3">Your package is handled by {{ $order->courier_name }}.
                                                Please use
                                                the tracking code above for updates.</p>
                                        @else
                                            <p>No courier has been assigned to this order yet. Once your order is processed,
                                                tracking details will appear here.</p>
                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="nav-receiver" role="tabpanel"
                                        aria-labelledby="nav-receiver-tab" tabindex="0">
                                        <h5 class="text-success mb-4">Order Summary</h5>
                                        <ul class="tracking-receiver">
                                            <li>Order Number : <strong>#{{ $order->order_number }}</strong></li>
                                            <li>Date : <strong>{{ $order->created_at->format('d/m/Y, H:i') }}</strong></li>
                                            <li>Total Amount :
                                                <strong>₹{{ number_format($order->total_amount, 2) }}</strong>
                                            </li>
                                            <li>Payment Method : <strong>{{ $order->payment_method }}</strong></li>
                                            <li>Payment Status : <strong>{{ $order->payment_status }}</strong></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
@endsection