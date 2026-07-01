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
    <!-- Banner Start -->


    <div class="dz-bnr-inr bg-secondary overlay-black-light"
        style="background-image:url(assets/images/background/bg1.webp);">
        <div class="container">
            <div class="dz-bnr-inr-entry">
                <h1 class="color1">Account Address</h1>
                <nav aria-label="breadcrumb" class="breadcrumb-row">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> Home</a></li>
                        <li class="breadcrumb-item">Account Address</li>
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
                    @php
                    $billingAddr =
                    $userAddresses->where('address_type_name', 'Billing')->first() ??
                    $userAddresses->first();
                    $shippingAddr =
                    $userAddresses->where('address_type_name', 'Shipping')->first() ??
                    ($userAddresses->skip(1)->first() ?? $billingAddr);
                    @endphp
                    <div class="row">
                        <div class="col-12 m-b30">
                            <p class="m-b0">The following addresses will be used on the checkout page by
                                default.</p>
                        </div>
                        <div class="col-md-6 m-b30">
                            <div class="address-card">
                                <div class="account-address-box">
                                    <h6 class="mb-3">Billing address</h6>
                                    @if ($user->billing_name)
                                    <ul>
                                        <li>{{ $user->billing_name }}</li>
                                        <li>{{ $user->billing_door_no }}, {{ $user->billing_street }}</li>
                                        <li>{{ $user->billing_area ? $user->billing_area . ',' : '' }}
                                            {{ $user->billing_city }}
                                        </li>
                                        <li>{{ $user->billing_state }} - {{ $user->billing_pincode }}</li>
                                        <li>Ph: {{ $user->billing_phone }}</li>
                                    </ul>
                                    @elseif($billingAddr)
                                    <ul>
                                        <li>{{ $billingAddr->address_first_name }}
                                            {{ $billingAddr->address_last_name }}
                                        </li>
                                        <li>{{ $billingAddr->address_line_one }},
                                            {{ $billingAddr->address_line_two }}
                                        </li>
                                        <li>{{ $billingAddr->landmark ? $billingAddr->landmark . ',' : '' }}
                                            {{ $billingAddr->area_name ? $billingAddr->area_name . ',' : '' }}
                                            {{ $billingAddr->city }}
                                        </li>
                                        <li>{{ $billingAddr->state }} - {{ $billingAddr->pincode }}</li>
                                        <li>Ph: {{ $billingAddr->address_phone_number }}</li>
                                    </ul>
                                    @elseif($latestOrder && $latestOrder->billing_name)
                                    <ul>
                                        <li>{{ $latestOrder->billing_name }} (From Order)</li>
                                        <li>{{ $latestOrder->billing_door_no }},
                                            {{ $latestOrder->billing_street }}
                                        </li>
                                        <li>{{ $latestOrder->billing_area ? $latestOrder->billing_area . ',' : '' }}
                                            {{ $latestOrder->billing_city }}
                                        </li>
                                        <li>{{ $latestOrder->billing_state }} -
                                            {{ $latestOrder->billing_pincode }}
                                        </li>
                                        <li>Ph: {{ $latestOrder->billing_phone }}</li>
                                    </ul>
                                    @elseif($user->door_no || $user->street || $user->city || $user->pincode)
                                    <ul>
                                        <li>{{ $user->name }} (Default)</li>
                                        <li>{{ $user->door_no ? $user->door_no . ',' : '' }} {{ $user->street }}
                                        </li>
                                        <li>{{ $user->area ? $user->area . ',' : '' }} {{ $user->city }}</li>
                                        <li>{{ $user->state }} - {{ $user->pincode }}</li>
                                        <li>Ph: {{ $user->phone_number }}</li>
                                    </ul>
                                    @else
                                    <p class="text-muted">No billing address set.</p>
                                    @endif
                                </div>
                                <div class="account-address-bottom">
                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                        data-bs-target="#editBillingModal" class="d-block me-3 text-primary"><i
                                            class="fa-solid fa-pen me-2"></i>Edit</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 m-b30">
                            <div class="address-card">
                                <div class="account-address-box">
                                    <h6 class="mb-3">Shipping address</h6>
                                    @if ($user->shipping_name)
                                    <ul>
                                        <li>{{ $user->shipping_name }}</li>
                                        <li>{{ $user->shipping_door_no }}, {{ $user->shipping_street }}</li>
                                        <li>{{ $user->shipping_area ? $user->shipping_area . ',' : '' }}
                                            {{ $user->shipping_city }}
                                        </li>
                                        <li>{{ $user->shipping_state }} - {{ $user->shipping_pincode }}</li>
                                        <li>Ph: {{ $user->shipping_phone }}</li>
                                    </ul>
                                    @elseif($shippingAddr)
                                    <ul>
                                        <li>{{ $shippingAddr->address_first_name }}
                                            {{ $shippingAddr->address_last_name }}
                                        </li>
                                        <li>{{ $shippingAddr->address_line_one }},
                                            {{ $shippingAddr->address_line_two }}
                                        </li>
                                        <li>{{ $shippingAddr->landmark ? $shippingAddr->landmark . ',' : '' }}
                                            {{ $shippingAddr->area_name ? $shippingAddr->area_name . ',' : '' }}
                                            {{ $shippingAddr->city }}
                                        </li>
                                        <li>{{ $shippingAddr->state }} - {{ $shippingAddr->pincode }}</li>
                                        <li>Ph: {{ $shippingAddr->address_phone_number }}</li>
                                    </ul>
                                    @elseif($latestOrder && $latestOrder->shipping_name)
                                    <ul>
                                        <li>{{ $latestOrder->shipping_name }} (From Order)</li>
                                        <li>{{ $latestOrder->shipping_door_no }},
                                            {{ $latestOrder->shipping_street }}
                                        </li>
                                        <li>{{ $latestOrder->shipping_area ? $latestOrder->shipping_area . ',' : '' }}
                                            {{ $latestOrder->shipping_city }}
                                        </li>
                                        <li>{{ $latestOrder->shipping_state }} -
                                            {{ $latestOrder->shipping_pincode }}
                                        </li>
                                        <li>Ph: {{ $latestOrder->shipping_phone }}</li>
                                    </ul>
                                    @elseif($user->door_no || $user->street || $user->city || $user->pincode)
                                    <ul>
                                        <li>{{ $user->name }} (Default)</li>
                                        <li>{{ $user->door_no ? $user->door_no . ',' : '' }} {{ $user->street }}
                                        </li>
                                        <li>{{ $user->area ? $user->area . ',' : '' }} {{ $user->city }}</li>
                                        <li>{{ $user->state }} - {{ $user->pincode }}</li>
                                        <li>Ph: {{ $user->phone_number }}</li>
                                    </ul>
                                    @else
                                    <p class="text-muted">No shipping address set.</p>
                                    @endif
                                </div>
                                <div class="account-address-bottom">
                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                        data-bs-target="#editShippingModal" class="d-block me-3 text-primary"><i
                                            class="fa-solid fa-pen me-2"></i>Edit</a>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-12">
                                            <div class="account-card-add">
                                                <div class="account-address-add">
                                                    <svg id="Line" height="50" viewBox="0 0 64 64" width="50"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m59.28775 26.0578-7.30176-6.251v-11.72068a.99973.99973 0 0 0 -1-1h-7.46a.99974.99974 0 0 0 -1 1v3.60693l-7.2109-6.17675a5.07688 5.07688 0 0 0 -6.6416 0l-23.97314 20.54345a2.04251 2.04251 0 0 0 1.32226 3.56787h5.98047v18.92188a8.60569 8.60569 0 0 0 8.59082 8.60059h10.481a1.00019 1.00019 0 0 0 -.00006-2h-10.48094a6.60308 6.60308 0 0 1 -6.59082-6.60059v-19.92188a1.00005 1.00005 0 0 0 -1-1l-6.99951-.05078 23.97119-20.542a3.08781 3.08781 0 0 1 4.03955 0l8.86133 7.59082a1.00655 1.00655 0 0 0 1.65039-.75934v-4.7802h5.46v11.18066a1.00013 1.00013 0 0 0 .34961.75928l7.63184 6.60156h-6.98148a.99974.99974 0 0 0 -1 1v3.7002a1.00019 1.00019 0 0 0 2-.00006v-2.70014h5.98145a2.03152 2.03152 0 0 0 1.32031-3.56982z" />
                                                        <path
                                                            d="m43.99564 33.718a13.00122 13.00122 0 0 0 .00012 26.00244c17.24786-.71391 17.24231-25.29106-.00012-26.00244zm.00012 24.00244c-14.59461-.60394-14.58984-21.40082.00006-22.00244a11.00122 11.00122 0 0 1 -.00006 22.00244z" />
                                                        <path
                                                            d="m49.001 45.71942h-4v-4.00049a1.00019 1.00019 0 0 0 -2 0v4.00049h-4a1.00019 1.00019 0 0 0 .00006 2h3.99994v4a1 1 0 0 0 2 0v-4h4a1 1 0 0 0 0-2z" />
                                                    </svg>
                                                </div>
                                                <h4 class="mb-3">Add New Address</h4>
                                                <button class="btn btn-primary px-5">Add</button>
                                            </div>
                                        </div> -->
                    </div>
                </section>

            </div>
        </div>
    </div>
</div>
<!-- Edit Billing Modal -->
<div class="modal fade" id="editBillingModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('account.address.update') }}" method="POST">
                @csrf
                <input type="hidden" name="address_type" value="billing">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Billing Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name</label>
                            @php
                            $fallbackBillingName =
                            $user->billing_name ?:
                            ($billingAddr
                            ? $billingAddr->address_first_name . ' ' . $billingAddr->address_last_name
                            : $latestOrder->billing_name ?? $user->name);
                            $fallbackBillingPhone =
                            $user->billing_phone ?:
                            $billingAddr->address_phone_number ??
                            ($latestOrder->billing_phone ?? $user->phone_number);
                            $fallbackBillingDoor =
                            $user->billing_door_no ?:
                            $billingAddr->address_line_one ??
                            ($latestOrder->billing_door_no ?? $user->door_no);
                            $fallbackBillingStreet =
                            $user->billing_street ?:
                            $billingAddr->address_line_two ??
                            ($latestOrder->billing_street ?? $user->street);
                            $fallbackBillingArea =
                            $user->billing_area ?:
                            $billingAddr->area_name ?? ($latestOrder->billing_area ?? $user->area);
                            $fallbackBillingCity =
                            $user->billing_city ?:
                            $billingAddr->city ?? ($latestOrder->billing_city ?? $user->city);
                            $fallbackBillingState =
                            $user->billing_state ?:
                            $billingAddr->state ?? ($latestOrder->billing_state ?? $user->state);
                            $fallbackBillingPincode =
                            $user->billing_pincode ?:
                            $billingAddr->pincode ?? ($latestOrder->billing_pincode ?? $user->pincode);
                            @endphp
                            <input type="text" name="billing_name" class="form-control"
                                value="{{ old('billing_name', $fallbackBillingName) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="billing_phone" class="form-control"
                                value="{{ old('billing_phone', $fallbackBillingPhone) }}" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Door No</label>
                            <input type="text" name="billing_door_no" class="form-control"
                                value="{{ old('billing_door_no', $fallbackBillingDoor) }}" required>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Street</label>
                            <input type="text" name="billing_street" class="form-control"
                                value="{{ old('billing_street', $fallbackBillingStreet) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Area (Optional)</label>
                            <input type="text" name="billing_area" class="form-control"
                                value="{{ old('billing_area', $fallbackBillingArea) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">City</label>
                            <input type="text" name="billing_city" class="form-control"
                                value="{{ old('billing_city', $fallbackBillingCity) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">State</label>
                            <select name="billing_state" class="form-control" required>
                                <option value="">Select State</option>
                                @foreach ($states as $state)
                                <option value="{{ $state->name }}"
                                    {{ old('billing_state', $fallbackBillingState) == $state->name ? 'selected' : '' }}>
                                    {{ $state->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pincode</label>
                            <input type="text" name="billing_pincode" class="form-control"
                                value="{{ old('billing_pincode', $fallbackBillingPincode) }}" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Shipping Modal -->
<div class="modal fade" id="editShippingModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('account.address.update') }}" method="POST">
                @csrf
                <input type="hidden" name="address_type" value="shipping">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Shipping Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name</label>
                            @php
                            $fallbackShippingName =
                            $user->shipping_name ?:
                            ($shippingAddr
                            ? $shippingAddr->address_first_name . ' ' . $shippingAddr->address_last_name
                            : $latestOrder->shipping_name ?? $user->name);
                            $fallbackShippingPhone =
                            $user->shipping_phone ?:
                            $shippingAddr->address_phone_number ??
                            ($latestOrder->shipping_phone ?? $user->phone_number);
                            $fallbackShippingDoor =
                            $user->shipping_door_no ?:
                            $shippingAddr->address_line_one ??
                            ($latestOrder->shipping_door_no ?? $user->door_no);
                            $fallbackShippingStreet =
                            $user->shipping_street ?:
                            $shippingAddr->address_line_two ??
                            ($latestOrder->shipping_street ?? $user->street);
                            $fallbackShippingArea =
                            $user->shipping_area ?:
                            $shippingAddr->area_name ?? ($latestOrder->shipping_area ?? $user->area);
                            $fallbackShippingCity =
                            $user->shipping_city ?:
                            $shippingAddr->city ?? ($latestOrder->shipping_city ?? $user->city);
                            $fallbackShippingState =
                            $user->shipping_state ?:
                            $shippingAddr->state ?? ($latestOrder->shipping_state ?? $user->state);
                            $fallbackShippingPincode =
                            $user->shipping_pincode ?:
                            $shippingAddr->pincode ?? ($latestOrder->shipping_pincode ?? $user->pincode);
                            @endphp
                            <input type="text" name="shipping_name" class="form-control"
                                value="{{ old('shipping_name', $fallbackShippingName) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="shipping_phone" class="form-control"
                                value="{{ old('shipping_phone', $fallbackShippingPhone) }}" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Door No</label>
                            <input type="text" name="shipping_door_no" class="form-control"
                                value="{{ old('shipping_door_no', $fallbackShippingDoor) }}" required>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Street</label>
                            <input type="text" name="shipping_street" class="form-control"
                                value="{{ old('shipping_street', $fallbackShippingStreet) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Area (Optional)</label>
                            <input type="text" name="shipping_area" class="form-control"
                                value="{{ old('shipping_area', $fallbackShippingArea) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">City</label>
                            <input type="text" name="shipping_city" class="form-control"
                                value="{{ old('shipping_city', $fallbackShippingCity) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">State</label>
                            <select name="shipping_state" class="form-control" required>
                                <option value="">Select State</option>
                                @foreach ($states as $state)
                                <option value="{{ $state->name }}"
                                    {{ old('shipping_state', $fallbackShippingState) == $state->name ? 'selected' : '' }}>
                                    {{ $state->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pincode</label>
                            <input type="text" name="shipping_pincode" class="form-control"
                                value="{{ old('shipping_pincode', $fallbackShippingPincode) }}" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection