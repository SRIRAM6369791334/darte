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
    </style>
    <div class="page-content bg-light">
        <div class="dz-bnr-inr bg-secondary overlay-black-light"
            style="background-image:url(assets/images/background/bg1.webp);">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1>Return Items</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"> Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('account.orders') }}">My Orders</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('account.order.details', $order->id) }}">Order
                                    Details</a></li>
                            <li class="breadcrumb-item">Return Items</li>
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
                        <div class="order-head mb-4">
                            <h4 class="mb-0">Return Items from Order: <span
                                    class="text-primary">#{{ $order->order_number }}</span></h4>
                            <p class="text-muted">Select the items you wish to return, specify the quantity, and provide a
                                reason.</p>
                        </div>

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('account.order.return.submit', $order->id) }}" method="POST"
                            id="returnForm">
                            @csrf
                            <div class="row">
                                @php $hasReturnableItems = false; @endphp

                                @foreach ($order->items as $index => $item)
                                    @php
                                        $alreadyReturnedQty = isset($existingReturns[$item->id])
                                            ? $existingReturns[$item->id]
                                            : 0;
                                        $returnableQty = $item->quantity - $alreadyReturnedQty;
                                    @endphp

                                    @if ($returnableQty > 0)
                                        @php $hasReturnableItems = true; @endphp
                                        <div class="col-12 m-b30">
                                            <div class="order-cancel-card d-flex flex-column flex-md-row align-items-start align-items-md-center p-3"
                                                style="border: 1px solid #eee; border-radius: 8px;">
                                                <div
                                                    class="custom-control custom-checkbox me-md-3 mb-3 mb-md-0 d-flex align-items-center">
                                                    <input class="form-check-input item-checkbox mt-0 me-2" type="checkbox"
                                                        id="item_{{ $item->id }}" data-id="{{ $item->id }}"
                                                        style="width: 20px; height: 20px;">
                                                    <label class="form-check-label d-md-none fw-bold"
                                                        for="item_{{ $item->id }}">Select for Return</label>
                                                </div>
                                                <div class="order-cancel-box flex-grow-1 w-100 p-0 border-0"
                                                    style="cursor:default;">
                                                    <div class="d-flex w-100 flex-column flex-md-row">
                                                        <div class="cancel-media me-3 mb-2 mb-md-0"
                                                            style="width: 80px; flex-shrink: 0;">
                                                            @if ($item->product && $item->product->product_image)
                                                                <img src="{{ env('MAIN_URL') . 'images/' . $item->product->product_image }}"
                                                                    alt="{{ $item->product_name }}"
                                                                    class="img-fluid rounded">
                                                            @else
                                                                <img src="{{ asset('assets/images/shop/small/pic1.webp') }}"
                                                                    alt="" class="img-fluid rounded">
                                                            @endif
                                                        </div>
                                                        <div
                                                            class="order-cancel-content d-flex flex-column justify-content-center me-auto">
                                                            <h5 class="title mb-1" style="font-size: 16px;">
                                                                {{ $item->product_name }}</h5>
                                                            @if ($item->variant_name)
                                                                <p class="mb-1"><small>Size: <strong
                                                                            class="text-black">{{ $item->variant_name }}</strong></small>
                                                                </p>
                                                            @endif
                                                            <p class="mb-0 text-muted" style="font-size: 13px;">Ordered:
                                                                {{ $item->quantity }} | Returnable: <strong
                                                                    class="text-primary">{{ $returnableQty }}</strong></p>
                                                        </div>

                                                        <div
                                                            class="ms-md-auto mt-2 mt-md-0 d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0">₹{{ number_format($item->price, 2) }}</h6>
                                                        </div>
                                                    </div>

                                                    <!-- Return Details (Hidden initially) -->
                                                    <div class="return-details w-100 mt-3 p-3 bg-light rounded d-none"
                                                        id="details_{{ $item->id }}">
                                                        <div class="row align-items-start">
                                                            <div class="col-md-3 mb-2 mb-md-0">
                                                                <label for="qty_{{ $item->id }}" class="form-label"
                                                                    style="font-weight: 600; font-size: 13px;">Return Qty
                                                                    <span class="text-danger">*</span></label>
                                                                <select class="form-control default-select form-select-sm"
                                                                    name="return_items[{{ $index }}][quantity]"
                                                                    id="qty_{{ $item->id }}" disabled required>
                                                                    @for ($i = 1; $i <= $returnableQty; $i++)
                                                                        <option value="{{ $i }}"
                                                                            {{ $i == $returnableQty ? 'selected' : '' }}>
                                                                            {{ $i }}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                            <div class="col-md-9 mb-2 mb-md-0">
                                                                <label for="reason_{{ $item->id }}"
                                                                    class="form-label"
                                                                    style="font-weight: 600; font-size: 13px;">Reason for
                                                                    Return <span class="text-danger">*</span></label>
                                                                <select
                                                                    class="form-control default-select form-select-sm reason-select"
                                                                    name="return_items[{{ $index }}][reason]"
                                                                    id="reason_{{ $item->id }}" disabled required>
                                                                    <option value="">-- Select a reason --</option>
                                                                    <option value="Defective or Damaged">Defective or
                                                                        Damaged Product</option>
                                                                    <option value="Wrong Item Received">Wrong Item Received
                                                                    </option>
                                                                    <option value="Size or Fit Issue">Size or Fit Issue
                                                                    </option>
                                                                    <option value="Quality not as expected">Quality not as
                                                                        expected</option>
                                                                    <option value="Item missing from order">Item missing
                                                                        from order</option>
                                                                    <option value="Other">Other</option>
                                                                </select>
                                                            </div>
                                                            <input type="hidden"
                                                                name="return_items[{{ $index }}][id]"
                                                                value="{{ $item->id }}" disabled
                                                                id="hidden_id_{{ $item->id }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-12 m-b30">
                                            <div class="order-cancel-card d-flex align-items-center opacity-50 p-3"
                                                style="border: 1px solid #eee; border-radius: 8px;">
                                                <div
                                                    class="order-cancel-box flex-grow-1 p-0 border-0 d-flex w-100 flex-column flex-md-row">
                                                    <div class="cancel-media me-3 mb-2 mb-md-0"
                                                        style="width: 80px; filter: grayscale(100%);">
                                                        @if ($item->product && $item->product->product_image)
                                                            <img src="{{ env('MAIN_URL') . 'images/' . $item->product->product_image }}"
                                                                alt="{{ $item->product_name }}"
                                                                class="img-fluid rounded">
                                                        @else
                                                            <img src="{{ asset('assets/images/shop/small/pic1.webp') }}"
                                                                alt="" class="img-fluid rounded">
                                                        @endif
                                                    </div>
                                                    <div
                                                        class="order-cancel-content d-flex flex-column justify-content-center">
                                                        <h5 class="title mb-1" style="font-size: 16px;">
                                                            {{ $item->product_name }}</h5>
                                                        <span class="badge bg-warning text-dark mt-1"
                                                            style="width: fit-content;">Return Requested / Processed</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                                <div class="col-12 mt-4 mt-sm-5 d-flex gap-3 flex-wrap">
                                    @if ($hasReturnableItems)
                                        <button type="submit" class="btn btn-primary btnhover20">Confirm Return
                                            Request</button>
                                    @else
                                        <div class="alert alert-info w-100">
                                            <i class="feather icon-info me-2"></i> All items in this order have already
                                            been returned or have pending return requests.
                                        </div>
                                    @endif
                                    <a href="{{ route('account.order.details', $order->id) }}"
                                        class="btn btn-outline-secondary btnhover20">Detailed Summary</a>
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
            const checkboxes = document.querySelectorAll('.item-checkbox');
            const form = document.getElementById('returnForm');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const id = this.getAttribute('data-id');
                    const detailsDiv = document.getElementById('details_' + id);
                    const inputs = detailsDiv.querySelectorAll(
                        'select, input:not([type="checkbox"])');

                    if (this.checked) {
                        detailsDiv.classList.remove('d-none');
                        inputs.forEach(input => input.removeAttribute('disabled'));
                    } else {
                        detailsDiv.classList.add('d-none');
                        inputs.forEach(input => input.setAttribute('disabled', 'disabled'));
                    }
                });
            });

            if (form) {
                form.addEventListener('submit', function(e) {
                    const checkedBoxes = document.querySelectorAll('.item-checkbox:checked');

                    if (checkedBoxes.length === 0) {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'warning',
                            title: 'Select Items',
                            text: 'Please select at least one item to return.',
                            confirmButtonText: 'OK',
                        });
                        return;
                    }

                    let isValid = true;
                    checkedBoxes.forEach(box => {
                        const id = box.getAttribute('data-id');
                        const reasonSelect = document.getElementById('reason_' + id);
                        if (!reasonSelect.value) {
                            isValid = false;
                        }
                    });

                    if (!isValid) {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'warning',
                            title: 'Missing Reason',
                            text: 'Please select a reason for all selected items.',
                            confirmButtonText: 'OK',
                        });
                        return;
                    }

                    // Show confirmation
                    e.preventDefault();
                    Swal.fire({
                        title: 'Submit Return Request?',
                        html: 'You are about to submit a return request for ' + checkedBoxes
                            .length + ' item(s).',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, Submit',
                        cancelButtonText: 'Cancel',
                        reverseButtons: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            }
        });
    </script>
@endsection
