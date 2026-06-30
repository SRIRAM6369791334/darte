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
        <div class="dz-bnr-inr bg-secondary overlay-black-light"
            style="background-image:url(assets/images/background/bg1.webp);">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1 class="color1">Account Orders</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"> Home</a></li>
                            <li class="breadcrumb-item">Account Orders</li>
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
                        <div class="account-card">
                            <div class="table-responsive table-style-1">
                                <table class="table table-hover mb-3">
                                    <thead>
                                        <tr>
                                            <th>Order #</th>
                                            <th>Date Purchased</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orders as $order)
                                            <tr>
                                                <td><a href="javascript:void(0);"
                                                        class="fw-medium text-primary">#{{ $order->order_number }}</a></td>
                                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                                <td>
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
                                                    <span
                                                        class="badge {{ $badgeClass }} m-0">{{ $order->status }}</span>
                                                </td>
                                                <td>₹{{ number_format($order->total_amount, 2) }}</td>
                                                <td><a href="{{ route('account.order.details', $order->id) }}"
                                                        class="btn-link text-underline p-0">View</a></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-4">
                                                    <p class="mb-0">You haven't placed any orders yet.</p>
                                                    <a href="{{ route('shop') }}"
                                                        class="btn btn-secondary btn-sm mt-3">Start Shopping</a>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>


                            <div class="d-flex justify-content-center mt-4">
                                {{ $orders->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
