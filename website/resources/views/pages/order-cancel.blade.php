@extends('layouts.app')
@section('content')
    <style>
    /* Banner Overrides for this page */
    .dz-bnr-inr {
        padding-top: 200px !important;
    }

    @media (max-width: 767px) {
        .dz-bnr-inr {
            padding-top: 80px !important;
            padding-bottom: 20px !important;
            height: auto !important;
            min-height: 140px !important;
        }
    }
</style>
<div class="page-content bg-light">
        <div class="dz-bnr-inr bg-secondary overlay-black-light"
            style="background-image:url(assets/images/background/bg1.webp);">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1>Cancel Order</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"> Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('account.orders') }}">My Orders</a></li>
                            <li class="breadcrumb-item">Cancel Order</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Banner End -->
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
                        <form action="{{ route('account.order.cancel.submit', $order->id) }}" method="POST">
                            @csrf
                            <div class="row">

                                {{-- Order Items --}}
                                @foreach ($order->items as $index => $item)
                                    <div class="col-md-6 m-b30">
                                        <div class="order-cancel-card">
                                            <div class="order-head">
                                                <h6 class="mb-0">Order: <span
                                                        class="text-primary">#{{ $order->order_number }}</span></h6>
                                            </div>
                                            <div class="order-cancel-box" style="cursor:default;">
                                                <div class="cancel-media">
                                                    @if ($item->product && $item->product->product_image)
                                                        <img src="{{ env('MAIN_URL') . 'images/' . $item->product->product_image }}"
                                                            alt="{{ $item->product_name }}">
                                                    @else
                                                        <img src="{{ asset('assets/images/shop/small/pic1.webp') }}"
                                                            alt="">
                                                    @endif
                                                </div>
                                                <div class="order-cancel-content">
                                                    <span>{{ $order->created_at->format('M d, Y') }}</span>
                                                    <h5 class="title mb-0">{{ $item->product_name }}</h5>
                                                    @if ($item->variant_name)
                                                        <p class="mb-1"><small>Size: <strong
                                                                    class="text-black">{{ $item->variant_name }}</strong></small>
                                                        </p>
                                                    @endif
                                                    <p class="mb-2">Quantity: <strong
                                                            class="text-black">{{ $item->quantity }}</strong></p>
                                                    <h6 class="mb-0">
                                                        ₹{{ number_format($item->price * $item->quantity, 2) }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                {{-- Reason for Cancellation --}}
                                <div class="col-lg-6 m-b30">
                                    <h4>Reason For Cancellation</h4>

                                    @if ($errors->has('cancellation_reason'))
                                        <div class="py-2 px-3 mb-3 rounded-3"
                                            style="background:rgba(227,53,53,0.08); border-left:4px solid var(--darte-danger,#e33535); color:#9b1c1c; font-size:14px;">
                                            <i class="feather icon-alert-circle me-1"></i>
                                            {{ $errors->first('cancellation_reason') }}
                                        </div>
                                    @endif

                                    @php
                                        $reasons = [
                                            'I have changed my mind',
                                            'Expected delivery time is very long',
                                            'I want to change address for the order',
                                            'I want to convert my order to Prepaid',
                                            'Price for the product has decreased',
                                            'I have purchased the product elsewhere',
                                        ];
                                    @endphp

                                    @foreach ($reasons as $i => $reason)
                                        <div class="custom-control custom-checkbox mb-2">
                                            <input class="form-check-input radio" type="radio" name="cancellation_reason"
                                                id="reason{{ $i }}" value="{{ $reason }}"
                                                {{ old('cancellation_reason') == $reason ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="reason{{ $i }}">{{ $reason }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Refund Info & Submit --}}
                                <div class="col-lg-6">
                                    <h4>Refund Status</h4>
                                    @if ($order->payment_method === 'Cash on Delivery' || $order->payment_method === 'COD')
                                        <p class="text-muted">There will be no refund as the order was placed using
                                            <strong>Cash on Delivery</strong>.</p>
                                    @else
                                        <p class="text-muted">Your payment of
                                            <strong>₹{{ number_format($order->total_amount, 2) }}</strong> will be refunded
                                            to your original payment method within <strong>5–7 business days</strong> after
                                            the cancellation is confirmed.</p>
                                    @endif

                                    <div class="d-flex gap-3 mt-3 flex-wrap">
                                        <button type="button" id="cancelSubmitBtn" class="btn btn-danger me-2 btnhover20">
                                            Submit Cancellation
                                        </button>
                                        <a href="{{ route('account.order.details', $order->id) }}"
                                            class="btn btn-outline-secondary btnhover20">
                                            Go Back
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </section>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('cancelSubmitBtn');
            const form = btn ? btn.closest('form') : null;
            if (!btn || !form) return;

            btn.addEventListener('click', function() {
                // Validate reason selection first
                const reason = form.querySelector('input[name="cancellation_reason"]:checked');
                if (!reason) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Select a Reason',
                        text: 'Please select a reason before submitting the cancellation.',
                        confirmButtonText: 'OK',
                    });
                    return;
                }

                Swal.fire({
                    title: 'Cancel This Order?',
                    html: 'Order <strong>#{{ $order->order_number }}</strong> will be permanently cancelled.<br><small class="text-muted">This action cannot be undone.</small>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '✓ Yes, Cancel Order',
                    cancelButtonText: 'No, Keep It',
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
