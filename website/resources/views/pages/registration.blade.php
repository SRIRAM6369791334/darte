@extends('layouts.app')

@section('content')
    <style>
        .secure-input {
            position: relative;
        }

        .custom-show-pass {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            z-index: 100;
            padding: 5px;
        }

        .form-control {
            border: 1px solid var(--primary);
        }

        .custom-show-pass:after {
            display: none !important;
            /* Hide theme's CSS slash */
        }

        /* Tablet Responsiveness Fix */
        @media (min-width: 769px) and (max-width: 991px) {
            .start-side-content {
                height: auto !important;
                min-height: auto !important;
                padding-bottom: 30px !important;
                margin-bottom: 20px !important;
                display: block !important;
            }

            .my-account-media {
                width: 690px !important;
                padding-left: 417px !important;
                margin: 0 auto !important;
            }

            .my-account-media img {
                max-width: 100% !important;
                height: auto !important;
            }
        }

        
        /* Mobile Responsiveness Fix */
        @media (max-width: 768px) {
            .start-side-content {
                height: auto !important;
                min-height: auto !important;
                padding-bottom: 30px !important;
                margin-bottom: 20px !important;
                display: none !important;
            }

            .my-account-media {
                text-align: center !important;
                margin-top: 20px !important;
            }

            .my-account-media img {
                max-width: 80% !important;
                height: auto !important;
                margin: 0 auto;
            }

            .dz-bnr-inr-entry {
                text-align: center !important;
                margin-bottom: 20px !important;
            }

            .breadcrumb-row .breadcrumb {
                justify-content: center !important;
            }
        }
        #myAccountSection {
            padding-top: 100px !important;
            padding-bottom: 40px !important;
        }

        /* ── Option 1: Dual-Pane Card Layout Styles ── */
        @media (min-width: 992px) {
            #myAccountSection {
                padding-top: 140px !important;
                padding-bottom: 60px !important;
            }

            .my-account-card-container {
                max-width: 1200px !important;
                width: 100% !important;
                margin: 0 auto !important;
                border-radius: 24px !important;
                overflow: hidden !important;
                box-shadow: 0 15px 45px rgba(0, 0, 0, 0.07) !important;
                background: #ffffff !important;
                border: 1px solid rgba(0, 0, 0, 0.05) !important;
            }

            .start-side-content {
                padding: 60px 50px 0 50px !important;
                min-height: 520px !important;
                display: flex !important;
                flex-direction: column !important;
                justify-content: space-between !important;
            }

            .end-side-content {
                padding: 60px 60px !important;
                display: flex !important;
                flex-direction: column !important;
                justify-content: center !important;
                background-color: #ffffff !important;
            }

            .end-side-content .login-area {
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
                background: transparent !important;
                max-width: 100% !important;
                margin: 0 !important;
            }

            .my-account-media {
                margin-top: auto !important;
                text-align: center !important;
            }

            .my-account-media img {
                max-height: 320px !important;
                width: auto !important;
                object-fit: contain !important;
                margin: 0 auto !important;
                padding-right: 97px;
            }
        }

        @media (max-width: 991px) {
            .my-account-card-container {
                width: 100% !important;
                box-shadow: none !important;
                border: none !important;
                background: transparent !important;
            }
            .end-side-content .login-area {
                border: 1px solid #ddd0d0 !important;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03) !important;
                background: #ffffff !important;
                border-radius: 20px !important;
            }
        }
    </style>
    <div class="page-content bg-light">
        <section class="px-3" id="myAccountSection">
            <div class="my-account-card-container">
                <div class="row g-0">
                <div class="col-xxl-6 col-xl-6 col-lg-6 start-side-content">
                    <div class="dz-bnr-inr-entry">
                        <h1>My Account</h1>
                        <nav aria-label="breadcrumb text-align-start" class="breadcrumb-row">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/"> Home</a></li>
                                <li class="breadcrumb-item">Shop my-account</li>
                            </ul>
                        </nav>
                    </div>
                    <div class="my-account-media">
                        <img src="assets/images/my-account/pic3.webp" alt="/" style="max-width:83%">
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 end-side-content">
                    <div class="login-area">
                        <h2 class="text-primary text-center">My-Account Now</h2>
                        <p class="text-center m-b30">Welcome please my-account to your account</p>
                        {{-- <form>
                            <div class="m-b10">
                                <label class="label-title">Username</label>
                                <input name="dzName" required="" class="form-control" placeholder="Username" type="text">
                            </div>
                            <div class="m-b10">
                                <label class="label-title">Email Address</label>
                                <input name="dzName" required="" class="form-control" placeholder="Email Address"
                                    type="email">
                            </div>
                            <div class="m-b40">
                                <label class="label-title">Password</label>
                                <div class="secure-input ">
                                    <input type="password" name="password" class="form-control dz-password"
                                        placeholder="Password">
                                    <div class="show-pass">
                                        <i class="eye-open fa-regular fa-eye"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="my-account" class="btn btn-secondary btnhover text-uppercase me-2">Register</a>
                                <a href="my-account" class="btn btn-outline-secondary btnhover text-uppercase">Sign In</a>
                            </div>
                        </form> --}}

                        <form method="POST" action="{{ route('register.user') }}">
                            @csrf

                            <div class="m-b10">
                                <label>Username</label>
                                <input name="name" value="{{ old('name') }}" class="form-control">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="m-b10">
                                <label>Email</label>
                                <input name="email" value="{{ old('email') }}" class="form-control">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="m-b10">
                                <label>Phone</label>
                                <input name="phone_number" value="{{ old('phone_number') }}" class="form-control"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">

                                @error('phone_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="m-b40">
                                <label>Password</label>
                                <div class="secure-input">
                                    <input type="password" name="password" class="form-control dz-password">
                                    <div class="custom-show-pass">
                                        <i class="fa-regular fa-eye"></i>
                                    </div>
                                </div>
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- <div class="text-center">
                                <button type="submit" class="btn btn-secondary">Register</button>
                            </div> --}}

                            <div class="text-center">
                                <button type="submit" class="btn btn-secondary">Register</button>
                                {{-- <a href="my-account" type="submit"
                                    class="btn btn-secondary btnhover text-uppercase me-2">Register</a> --}}
                                <a href="my-account" class="btn btn-outline-secondary btnhover text-uppercase">Sign In</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </section>
    </div>




    @section('scripts')
        <script>
            document.querySelector("form").addEventListener("submit", function (e) {
                let phone = document.querySelector("[name=phone_number]").value;
                let password = document.querySelector("[name=password]").value;

                if (phone.length !== 10) {
                    alert("Phone must be 10 digits");
                    e.preventDefault();
                }

                if (password.length < 6) {
                    alert("Password must be at least 6 characters");
                    e.preventDefault();
                }
            });

            // Robust Password Toggle in Vanilla JavaScript (safe for deferred scripts)
            document.addEventListener('click', function (e) {
                const button = e.target.closest('.custom-show-pass');
                if (!button) return;

                e.preventDefault();
                
                const secureInput = button.closest('.secure-input');
                if (!secureInput) return;

                const input = secureInput.querySelector('.dz-password');
                if (!input) return;

                const icon = button.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    if (icon) {
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    }
                } else {
                    input.type = 'password';
                    if (icon) {
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                }
            });
        </script>
    @endsection
@endsection