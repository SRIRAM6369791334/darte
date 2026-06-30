@extends('layouts.app')
@section('content')
<style>
    .label-title {
        font-weight: 800;
        color: #000000 !important;
        font-size: 16px;
        margin-bottom: 10px;
        font-family: 'Inter', sans-serif;
    }

    /* Page Background — White */
    .page-content.bg-light {
        background-color: #ffffff !important;
    }

    /* Content Area — White */
    .content-inner-1 {
        background-color: #ffffff !important;
    }

    /* Account Card — White with subtle shadow */
    .account-card {
        background-color: #ffffff !important;
        border: 1px solid #f0f0f0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    /* Sidebar — White */
    .account-sidebar {
        background-color: #ffffff !important;
        border: 1px solid #f0f0f0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    /* Nav Title — Light grey பதிலா white */
    .account-nav .nav-title.bg-light {
        background-color: #f9f9f9 !important;
    }

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
        @media only screen and (max-width: 575px) {
        .dz-bnr-inr {
            --dz-banner-height: 80px;
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
                <h1 class="color1">Account Profile</h1>
                <nav aria-label="breadcrumb" class="breadcrumb-row">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"> Home</a></li>
                        <li class="breadcrumb-item">Account Profile</li>
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
                                    <img id="sidebarProfileImg" class="rounded-circle"
                                        src="{{ asset($user->profile_image) }}" alt="{{ $user->name }}"
                                        style="width: 80px; height: 80px; object-fit: cover;">
                                    @else
                                    <svg id="sidebarProfileImg" class="rounded-circle" width="80" height="80" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-bottom: 10px;">
                                        <rect width="100" height="100" rx="50" fill="#f4f4f5" />
                                        <path d="M50 52C58.2843 52 65 45.2843 65 37C65 28.7157 58.2843 22 50 22C41.7157 22 35 28.7157 35 37C35 45.2843 41.7157 52 50 52Z" fill="#a1a1aa" />
                                        <path d="M50 58C36.7452 58 26 68.7452 26 82C26 83.1046 26.8954 84 28 84H72C73.1046 84 74 83.1046 74 82C74 68.7452 63.2548 58 50 58Z" fill="#a1a1aa" />
                                    </svg>
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



                <section class="col-xl-9 account-wrapper text-start">
                    <div class="account-card">
                        <form action="{{ route('account.profile.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="profile-edit mb-4">
                                <div class="avatar-upload d-flex align-items-center">
                                    <div class="position-relative">
                                        <div class="avatar-preview thumb">
                                            @if ($user->profile_image)
                                            <img id="imagePreview" src="{{ asset($user->profile_image) }}"
                                                alt="{{ $user->name }}"
                                                style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; display: block; border: 2px solid #eaeaea;">
                                            @else
                                            <svg id="imagePreview" class="rounded-circle" width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="100" height="100" rx="50" fill="#f4f4f5" />
                                                <path d="M50 52C58.2843 52 65 45.2843 65 37C65 28.7157 58.2843 22 50 22C41.7157 22 35 28.7157 35 37C35 45.2843 41.7157 52 50 52Z" fill="#a1a1aa" />
                                                <path d="M50 58C36.7452 58 26 68.7452 26 82C26 83.1046 26.8954 84 28 84H72C73.1046 84 74 83.1046 74 82C74 68.7452 63.2548 58 50 58Z" fill="#a1a1aa" />
                                            </svg>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                                <div class="ms-4">
                                    <h2 class="title mb-0">{{ $user->name }}</h2>
                                    <span class="text text-primary">{{ $user->email }}</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group m-b25">
                                        <label class="label-title">Full Name</label>
                                        <input name="name" value="{{ old('name', $user->name) }}" required
                                            class="form-control">
                                        @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group m-b25">
                                        <label class="label-title">Email address(Not Editable)</label>
                                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                            readonly class="form-control bg-light">
                                        @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group m-b25">
                                        <label class="label-title">Phone</label>
                                        <input type="text" name="phone_number"
                                            value="{{ old('phone_number', $user->phone_number) }}" required
                                            class="form-control">
                                        @error('phone_number')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <div class="form-check custom-checkbox">
                                        <input type="checkbox" class="form-check-input" id="change_password_toggle">
                                        <label class="form-check-label" for="change_password_toggle">Change
                                            Password?</label>
                                    </div>
                                </div>

                                <div id="password_section" style="display: none;" class="row g-3 px-3">
                                    <div class="col-lg-6">
                                        <div class="form-group m-b25">
                                            <label class="label-title">New password</label>
                                            <div class="input-group">
                                                <input type="password" name="password" id="password"
                                                    class="form-control" autocomplete="new-password">
                                                <span class="input-group-text toggle-password" style="cursor:pointer;"
                                                    data-target="password">
                                                    <i class="fa-solid fa-eye"></i>
                                                </span>
                                            </div>
                                            @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group m-b25">
                                            <label class="label-title">Confirm new password</label>
                                            <div class="input-group">
                                                <input type="password" name="password_confirmation"
                                                    id="password_confirmation" class="form-control"
                                                    autocomplete="new-password">
                                                <span class="input-group-text toggle-password" style="cursor:pointer;"
                                                    data-target="password_confirmation">
                                                    <i class="fa-solid fa-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 text-end mt-4">
                                    <button class="btn btn-primary" type="submit">Update Profile</button>
                                </div>
                        </form>
                    </div>
                </section>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Password Section Toggle
    const passwordToggle = document.getElementById('change_password_toggle');
    const passwordSection = document.getElementById('password_section');
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirmation');

    passwordToggle.addEventListener('change', function() {
        if (this.checked) {
            passwordSection.style.display = 'flex';
        } else {
            passwordSection.style.display = 'none';
            passwordInput.value = '';
            confirmInput.value = '';
        }
    });

    // Toggle Password Visibility (Eye Icon)
    document.querySelectorAll('.toggle-password').forEach(span => {
        span.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const targetInput = document.getElementById(targetId);
            const icon = this.querySelector('i');

            if (targetInput.type === "password") {
                targetInput.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                targetInput.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
</script>
<style>
    .input-group-text.toggle-password {
        background-color: transparent;
        border-left: 0;
        padding: 0 15px;
    }

    .form-control:focus+.input-group-text.toggle-password {
        border-color: #629D23;
        /* Your theme primary color if applicable */
    }
</style>
@endsection