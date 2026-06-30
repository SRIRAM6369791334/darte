@extends('layouts.app')
@section('content')

@if (auth()->check())
    <script>
        window.location.href = "{{ route('account.profile') }}";
    </script>
@endif


<style>
    .page-content,
    .end-side-content,
    .modal-content,
    .modal-body,
    .modal-header {
        background-color: #ffffff !important;
    }

    .modal-dialog-centered {
        margin-top: 0px !important;
    }

    .form-control {
        border: 1px solid var(--primary) !important;
    }

    body {
        background: #ffffff !important;
    }

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

    .custom-show-pass:after {
        display: none !important;
    }
    /* Tablet Responsiveness Fix */
        @media (min-width: 769px) and (max-width: 991px) {
            .start-side-content {
                height: auto !important;
                min-height: auto !important;
                padding-bottom: 30px !important;
                margin-bottom: 20px !important;
                display: none !important;
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
                            <li class="breadcrumb-item">My Account</li>
                        </ul>
                    </nav>
                </div>
                <div class="my-account-media">
                    <img src="assets/images/my-account/pic3.webp" alt="/" style="max-width:83%" >
                </div>
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 end-side-content justify-content-center">
                <div class="login-area" style="border: 1px solid #ddd0d0;">
                    <h2 class="text-center">Welcome Back</h2>
                    <p class="text-center m-b25">welcome please login to your account</p>
                    {{-- <form>
                        <div class="m-b10">
                            <label class="label-title">Email Address</label>
                            <input name="dzName" required="" class="form-control" placeholder="Email Address"
                                type="email">
                        </div>
                        <div class="m-b15">
                            <label class="label-title">Password</label>
                            <div class="secure-input ">
                                <input type="password" name="password" class="form-control dz-password"
                                    placeholder="Password">
                                <div class="show-pass">
                                    <i class="eye-open fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-row d-flex justify-content-between m-b30">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input" id="basic_checkbox_1">
                                    <label class="form-check-label" for="basic_checkbox_1">Remember Me</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <a class="text-primary" href="javascript:void(0);">Forgot Password</a>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="my-account" class="btn btn-secondary btnhover text-uppercase me-2 sign-btn">Sign
                                In</a>
                            <a href="registration"
                                class="btn btn-outline-secondary btnhover text-uppercase">Register</a>
                        </div>
                    </form> --}}
                    <form method="POST" action="{{ route('login.user') }}">
                        @csrf

                        <div class="m-b10">
                            <label>Email Address</label>
                            <input name="email" value="{{ old('email') }}" class="form-control" type="email" required>

                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="m-b15">
                            <label>Password</label>
                            <div class="secure-input">
                                <input type="password" name="password" class="form-control dz-password" required>
                                <div class="custom-show-pass">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>

                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-row d-flex justify-content-between m-b30">
                            <div class="form-group">
                                {{-- <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input" id="basic_checkbox_1">
                                    <label class="form-check-label" for="basic_checkbox_1">Remember Me</label>
                                </div> --}}
                            </div>
                            <div class="form-group">
                                {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">
                                    Forgot Password
                                </a> --}}
                                <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">
                                    Forgot Password
                                </a>
                                {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">
                                    Forgot Password
                                </a> --}}
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-secondary text-uppercase">
                                Sign In
                            </button>

                            <a href="registration" class="btn btn-outline-secondary text-uppercase">
                                Register
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </section>
</div>
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forgotPasswordModalLabel">Reset Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Step 1: Send OTP -->
                <div id="fp-step-1">
                    <p class="text-center mb-4" style="color: #666;">Enter your registered email and we'll send you an
                        OTP.</p>
                    <form id="sendOtpForm">
                        @csrf
                        <div class="mb-4">
                            <label for="fp_email" class="form-label">Registered Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"
                                    style="border-radius: var(--input-radius) 0 0 var(--input-radius);"><i
                                        class="fa-solid fa-envelope"></i></span>
                                <input type="email" class="form-control" id="fp_email" name="email"
                                    placeholder="example@gmail.com" required
                                    style="border-radius: 0 var(--input-radius) var(--input-radius) 0;">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-3 shadow-sm font-weight-bold">Send
                            Recovery OTP</button>
                    </form>
                </div>

                <!-- Step 2: Verify OTP -->
                <div id="fp-step-2" style="display: none;">
                    <div class="text-center mb-4">
                        <div class="p-3 bg-light rounded-circle d-inline-block mb-3">
                            <i class="fa-solid fa-shield-halved fa-2x text-primary"></i>
                        </div>
                        <p style="color: #666;">We've sent a 6-digit code to <br><span id="otp-email-display"
                                class="fw-bold text-dark"></span></p>
                    </div>
                    <form id="verifyOtpForm">
                        @csrf
                        <input type="hidden" id="verify_email" name="email">
                        <div class="mb-4 text-center">
                            <label for="fp_otp" class="form-label d-block">Enter Verification Code</label>
                            <input type="text" class="form-control text-center fw-bold" id="fp_otp" name="otp"
                                placeholder="0 0 0 0 0 0" required style="font-size: 24px; letter-spacing: 5px;">
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-3 shadow-sm">Verify & Continue</button>
                    </form>
                </div>

                <!-- Step 3: Reset Password -->
                <div id="fp-step-3" style="display: none;">
                    <p class="text-center mb-4" style="color: #666;">Set a strong new password for your account.</p>
                    <form id="resetPasswordForm">
                        @csrf
                        <input type="hidden" id="reset_email" name="email">
                        <div class="mb-4">
                            <label for="new_password" class="form-label">New Secure Password</label>
                            <div class="input-group secure-input login-area">
                                <span class="input-group-text bg-light border-end-0"
                                    style="border-radius: var(--input-radius) 0 0 var(--input-radius);"><i
                                        class="fa-solid fa-lock"></i></span>
                                <input type="password" class="form-control dz-password" id="new_password"
                                    name="password" placeholder="Min. 6 characters" required minlength="6"
                                    style="border-radius: 0 var(--input-radius) var(--input-radius) 0;">
                                <div class="custom-show-pass">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-3 shadow-sm">Update Password</button>
                    </form>
                </div>

                <div class="mt-4 text-center">
                    <a href="#" id="backToLoginLink" class="text-secondary fw-600" style="font-size: 14px;"><i
                            class="fa-solid fa-arrow-left me-2"></i>Back to Login</a>
                </div>
            </div>
        </div>
    </div>
</div>






@endsection

@section('scripts')

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            /**
             * STEP 1 - SEND OTP
             */
            document.getElementById('sendOtpForm').addEventListener('submit', function (e) {
                e.preventDefault();

                let email = document.getElementById('fp_email').value;

                fetch('/send-otp', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        email: email
                    })
                })
                    .then(res => res.json())
                    .then(data => {

                        if (data.success) {

                            document.getElementById('fp-step-1').style.display = 'none';
                            document.getElementById('fp-step-2').style.display = 'block';

                            document.getElementById('verify_email').value = email;
                            document.getElementById('otp-email-display').innerText = email;

                            Swal.fire('Success', data.message, 'success');

                        } else {
                            Swal.fire('Error', data.message, 'error');
                        }

                    });
            });


            /**
             * STEP 2 - VERIFY OTP
             */
            document.getElementById('verifyOtpForm').addEventListener('submit', function (e) {
                e.preventDefault();

                let email = document.getElementById('verify_email').value;
                let otp = document.getElementById('fp_otp').value;

                fetch('/verify-otp', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        email: email,
                        otp: otp
                    })
                })
                    .then(res => res.json())
                    .then(data => {

                        if (data.success) {

                            document.getElementById('fp-step-2').style.display = 'none';
                            document.getElementById('fp-step-3').style.display = 'block';

                            document.getElementById('reset_email').value = email;

                            Swal.fire('Success', data.message, 'success');

                        } else {
                            Swal.fire('Error', data.message, 'error');
                        }

                    });
            });


            /**
             * STEP 3 - RESET PASSWORD
             */
            document.getElementById('resetPasswordForm').addEventListener('submit', function (e) {
                e.preventDefault();

                let email = document.getElementById('reset_email').value;
                let password = document.getElementById('new_password').value;

                fetch('/reset-password', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        email: email,
                        password: password
                    })
                })
                    .then(res => res.json())
                    .then(data => {

                        if (data.success) {

                            Swal.fire('Success', data.message, 'success').then(() => {
                                location.reload();
                            });

                        } else {
                            Swal.fire('Error', data.message, 'error');
                        }

                    });
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

        });
    </script>
@endsection