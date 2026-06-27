<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="DARTE">
    <meta name="robots" content="index, follow">
    <meta name="format-detection" content="telephone=no">

    {{-- ============================================================
         DYNAMIC SEO META — Powered by Seotag model via SeoService
         Per-page overrides: use @section('meta') in child views
    ============================================================ --}}
    @yield('meta')

    {{-- Canonical (prevents duplicate content penalties) --}}
    <link rel="canonical" href="{{ url()->current() }}" />

    {{-- Primary Meta Tags --}}
    <meta name="keywords" content="{{ $meta->meta_keyword ?? 'DARTE, apparel, premium clothing, fashion wear' }}" />
    <meta name="description" content="{{ $meta->meta_description ?? 'DARTE — Premium apparel, clothing & accessories. Quality and timeless style.' }}" />

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="DARTE" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="{{ $meta->og_title ?? ($meta->meta_title ?? 'DARTE — Premium Apparel') }}" />
    <meta property="og:description" content="{{ $meta->og_description ?? ($meta->meta_description ?? 'DARTE — Premium apparel & clothing.') }}" />
    <meta property="og:image" content="{{ $meta->og_image ?? asset('assets/images/logo.webp') }}" />
    <meta property="og:image:alt" content="{{ $meta->og_title ?? 'DARTE Logo' }}" />
    <meta property="og:locale" content="en_IN" />

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $meta->og_title ?? ($meta->meta_title ?? 'DARTE — Premium Apparel') }}" />
    <meta name="twitter:description" content="{{ $meta->og_description ?? ($meta->meta_description ?? 'DARTE — Premium apparel & clothing.') }}" />
    <meta name="twitter:image" content="{{ $meta->og_image ?? asset('assets/images/logo.webp') }}" />

    {{-- Schema.org JSON-LD Structured Data --}}
    @if(isset($meta->schema_code) && $meta->schema_code)
        {!! $meta->schema_code !!}
    @endif

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- PAGE TITLE -->
    <title>{{ $meta->meta_title ?? 'DARTE — Premium Apparel & Clothing' }}</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/webp" href="{{ asset('images/logo.webp') }}" />




    <!-- Non-critical vendor CSS: async -->
    <link rel="stylesheet" href="/assets/vendor/swiper/swiper-bundle.min.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="/assets/vendor/nouislider/nouislider.min.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="/assets/vendor/animate/animate.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="/assets/vendor/lightgallery/dist/css/lightgallery.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="/assets/vendor/lightgallery/dist/css/lg-thumbnail.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="/assets/vendor/lightgallery/dist/css/lg-zoom.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="/assets/icons/feather/css/iconfont.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="/assets/icons/fontawesome/css/all.min.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="/assets/icons/themify/themify-icons.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="/assets/icons/iconly/index.min.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="/assets/icons/flaticon/flaticon_pixio.css" media="print" onload="this.media='all'">
    <!-- Google Fonts: async -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Playfair+Display:ital,wght@0,700;1,700&family=Inter:wght@400&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <!-- CRITICAL: main stylesheet synchronous to prevent CLS -->
    <link rel="stylesheet" href="/assets/css/style.min.css">
    <link rel="stylesheet" href="/assets/css/skin/skin-1.min.css">


    {{-- SweetAlert2 Custom Theme using Darte Brand Colors --}}
    <style>
        :root {
            --darte-primary:   #000000;
            --darte-primary-dark: #000000;
            --darte-danger:    #000000;
            --darte-success:   #000000;
            --darte-info:      #000000;
            --darte-warning:   #000000;
            --darte-dark:      #000000;
        }
        .color1{
            color: #fff !important;
        }

        /* SweetAlert2 brand overrides */
        .swal2-popup {
            border-radius: 16px !important;
            font-family: 'DM Sans', 'Roboto', sans-serif !important;
        }
        .swal2-confirm {
            background-color: var(--darte-primary) !important;
            color: #fff !important;
            border-radius: 0px !important;
            font-weight: 600 !important;
            letter-spacing: 0.5px !important;
            box-shadow: none !important;
            text-transform: uppercase;
        }
        .swal2-confirm:focus { box-shadow: none !important; }
        .swal2-cancel {
            background-color: #6c757d !important;
            border-radius: 8px !important;
            font-weight: 600 !important;
        }
        .swal2-deny {
            background-color: var(--darte-danger) !important;
            border-radius: 8px !important;
        }
        .swal2-title { color: var(--darte-dark) !important; font-weight: 700 !important; }
        .swal2-html-container { color: #555 !important; }
        .swal2-icon.swal2-success .swal2-success-ring { border-color: var(--darte-primary) !important; }
        .swal2-icon.swal2-success [class^=swal2-success-line] { background-color: var(--darte-primary) !important; }
        .swal2-timer-progress-bar { background: var(--darte-primary) !important; }

        /* Global Banner Responsive Styling for Mobile */
        @media (max-width: 767px) {
            .dz-bnr-inr {
                min-height: 130px !important;
                height: 130px !important;
            }
            .dz-bnr-inr img {
                object-fit: cover !important;
                object-position: center 15% !important;
            }
            .dz-bnr-inr h1 {
                font-size: 26px !important;
                margin-bottom: 2px !important;
            }
            .dz-bnr-inr .breadcrumb-row {
                margin-top: 0 !important;
            }
            .dz-bnr-inr .breadcrumb-row ul {
                margin-bottom: 0 !important;
            }
        }

        /* Custom side-by-side price format */
        .shop-card .price {
            display: inline-flex !important;
            align-items: center !important;
            gap: 8px !important;
            white-space: nowrap !important;
        }

        .shop-card .price del {
            display: inline-block !important;
            margin: 0 !important;
            font-size: 0.85em !important;
            color: #777 !important;
        }
    </style>

    <!-- RESOURCE HINTS: max 3 preconnects as per Lighthouse recommendation -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">

    <!-- ============================================================
         CRITICAL CSS (minimal, no Bootstrap conflicts)
         Only: preloader hide + font-display:swap + shell dimensions
    ============================================================ -->
    <style>
        /* 1. Hide preloader immediately — kills the 16s Speed Index blocker */
        #loading-area { display: none !important; }

        /* 2. font-display:swap for Lufga — overrides style.min.css @font-face */
        @font-face { font-family: 'Lufga'; src: url('/assets/fonts/lufga-cufonfonts/LufgaRegular.woff') format('woff'); font-weight: 400; font-style: normal; font-display: swap; }
        @font-face { font-family: 'Lufga'; src: url('/assets/fonts/lufga-cufonfonts/LufgaMedium.woff') format('woff'); font-weight: 500; font-style: normal; font-display: swap; }
        @font-face { font-family: 'Lufga'; src: url('/assets/fonts/lufga-cufonfonts/LufgaSemiBold.woff') format('woff'); font-weight: 600; font-style: normal; font-display: swap; }
        @font-face { font-family: 'Lufga'; src: url('/assets/fonts/lufga-cufonfonts/LufgaBold.woff') format('woff'); font-weight: 700; font-style: normal; font-display: swap; }

        /* 3. Shell dimensions — prevent CLS while style.min.css downloads */
        body { margin: 0; overflow-x: hidden; background: #fff; }
        .main-bar { min-height: 80px; background: #fff; }
        .banner-section { min-height: 75vh; background: #fff; }
        .min-vh-75 { min-height: 75vh; }
        .page-wraper { overflow-x: hidden; width: 100%; position: relative; }

        /* 4. Scroltop hidden until JS activates it */
        .scroltop { display: none; }
    </style>
</head>

<body>
    <div class="page-wraper">
        <!--*******************
 Preloader start
********************-->

        <div id="loading-area" class="preloader-wrapper-4">
            <h2>DARTE</h2>
            <!-- <img src="assets/images/loading.gif" alt=""> -->
        </div>
        <!--*******************
 Preloader end
********************-->
        @include('layouts.header')
        {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">
            Forgot Password
        </a> --}}
        <!-- <div class="social-media-side">
            <ul>
                <li class="call">
                    <a href="tel:+919786855855">
                        <img src="/assets/images/Call.webp" alt="Call" width="55" height="55" decoding="async">
                        <span style="padding-left: 10px;">Call</span>

                    </a>
                </li>

                <li class="whatsapp">
                    <a href="https://api.whatsapp.com/send?phone=919786855855" target="_blank">
                        <img src="/assets/images/Whatsapp.webp" alt="WhatsApp" width="55" height="55" decoding="async">
                        <span style="padding-left: 10px;">WhatsApp</span>

                    </a>
                </li>
            </ul>
        </div> -->

        @yield('content')


        @include('layouts.footer')

        <!-- <button class="scroltop" type="button" style="display: none;"><i class="fas fa-arrow-up"></i></button> -->
    </div>
    <!-- JAVASCRIPT FILES ========================================= -->
    <script src="/assets/js/jquery.min.js" defer></script>
    <script src="/assets/vendor/wow/wow.min.js" defer></script>
    <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js" defer></script>
    <script src="/assets/vendor/magnific-popup/magnific-popup.js" defer></script>
    <script src="/assets/vendor/lightgallery/dist/lightgallery.min.js" defer></script>
    <script src="/assets/vendor/lightgallery/dist/plugins/thumbnail/lg-thumbnail.min.js" defer></script>
    <script src="/assets/vendor/lightgallery/dist/plugins/zoom/lg-zoom.min.js" defer></script>
    <script src="/assets/vendor/bootstrap-touchspin/bootstrap-touchspin.js" defer></script>
    <script src="/assets/vendor/counter/waypoints-min.js" defer></script>
    <script src="/assets/vendor/counter/counterup.min.js" defer></script>
    <script src="/assets/vendor/swiper/swiper-bundle.min.js" defer></script>
    <script src="/assets/vendor/imagesloaded/imagesloaded.js" defer></script>
    <script src="/assets/vendor/masonry/masonry-4.2.2.js" defer></script>
    <script src="/assets/vendor/masonry/isotope.pkgd.min.js" defer></script>
    <script src="/assets/vendor/countdown/jquery.countdown.js" defer></script>
    <script src="/assets/vendor/wnumb/wNumb.js" defer></script>
    <script src="/assets/vendor/nouislider/nouislider.min.js" defer></script>
    <script src="/assets/js/dz.carousel.js" defer></script>
    <script src="/assets/js/dz.ajax.js" defer></script>
    <script src="/assets/js/custom.js" defer></script>






    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

    {{-- ============================================================
         GLOBAL SESSION FLASH → SweetAlert2 (covers ALL pages)
         Usage in controllers: ->with('success', 'msg') or ->with('error','msg')
    ============================================================= --}}
    @if(session('success') || session('error') || session('warning') || session('info') || session('message'))
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Done!',
                text: @json(session('success')),
                confirmButtonText: 'OK',
                timer: 4000,
                timerProgressBar: true,
            });
        @elseif(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: @json(session('error')),
                confirmButtonText: 'OK',
            });
        @elseif(session('warning'))
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: @json(session('warning')),
                confirmButtonText: 'OK',
            });
        @elseif(session('info'))
            Swal.fire({
                icon: 'info',
                title: 'Info',
                text: @json(session('info')),
                confirmButtonText: 'OK',
                timer: 3500,
                timerProgressBar: true,
            });
        @elseif(session('message'))
            Swal.fire({
                icon: @json(session('type') ?? 'success'),
                title: @json(session('message')),
                confirmButtonText: 'OK',
            });
        @endif
    });
    </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Global Authentication Check
            window.isAuthenticated = @json(auth()->check());

            /**
             * Fetch live counts and update header badge elements.
             */
            window.updateHeaderCounts = function() {
                fetch('{{ route('cart.counts') }}')
                    .then(r => r.json())
                    .then(data => {
                        document.querySelectorAll('.cart-link .badge, #shopping-cart .badge').forEach(el => el.textContent = data.cart_count);
                        document.querySelectorAll('.wishlist-link .badge, #wishlist .badge').forEach(el => el.textContent = data.wishlist_count);

                        const sidebar = document.getElementById('dz-shopcart-sidebar');
                        if (sidebar && data.html) {
                            sidebar.innerHTML = data.html;
                        }
                    })
                    .catch(() => { }); // silently fail
            }

            /**
             * Helper function to check for authentication and redirect.
             */
            window.checkUserAuth = function() {
                if (!window.isAuthenticated) {
                    window.location.href = "{{ url('/my-account') }}";
                    return false;
                }
                return true;
            }

            /**
             * Generic Add to Cart function with Auth Check.
             */
            window.addToCart = function(productId, variantId = null) {
                if (!checkUserAuth()) return;

                const qtyElement = document.getElementById('qty');
                const quantity = qtyElement ? qtyElement.value : 1;

                fetch('{{ route('cart.add') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ product_id: productId, variant_id: variantId, quantity: quantity })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: data.message,
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false,
                                position: 'center'
                            });
                            updateHeaderCounts(); // ← update badge
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: data.message || 'Failed to add item to cart.',
                                icon: 'error',
                                confirmButtonText: 'Try Again'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({ title: 'Error!', text: 'Something went wrong. Please try again.', icon: 'error' });
                    });
            }

            /**
             * Generic Add to Wishlist function with Auth Check.
             */
            window.addToWishlist = function(productId, variantId = null) {
                if (!checkUserAuth()) return;

                fetch('{{ route('wishlist.add') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ product_id: productId, product_varient_id: variantId })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: data.message,
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            updateHeaderCounts(); // ← update badge
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: data.message || 'Failed to add item to wishlist.',
                                icon: 'error'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({ title: 'Error!', text: 'Something went wrong.', icon: 'error' });
                    });
            }

            window.removeFromCart = function(cartId) {
                Swal.fire({
                    title: 'Remove Item?',
                    text: 'This item will be removed from your cart.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Remove',
                    cancelButtonText: 'Keep It',
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch("{{ route('cart.remove') }}", {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                            body: JSON.stringify({ cart_id: cartId })
                        })
                        .then(r => r.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({ icon: 'success', title: 'Removed!', text: data.message, timer: 1500, showConfirmButton: false, timerProgressBar: true })
                                .then(() => location.reload());
                                updateHeaderCounts();
                            }
                        });
                    }
                });
            }

            window.removeFromWishlist = function(wishlistId) {
                Swal.fire({
                    title: 'Remove Item?',
                    text: 'This item will be removed from your wishlist.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Remove',
                    cancelButtonText: 'Keep It',
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch("{{ route('wishlist.remove') }}", {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                            body: JSON.stringify({ wishlist_id: wishlistId })
                        })
                        .then(r => r.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({ icon: 'success', title: 'Removed!', text: data.message, timer: 1500, showConfirmButton: false, timerProgressBar: true })
                                .then(() => location.reload());
                                updateHeaderCounts();
                            }
                        });
                    }
                });
            }
        });
    </script>


    {{--
    <script>
        $(document).ready(function () {

            function validateField(input) {
                let value = input.val().trim();
                let name = input.attr("name");
                let error = "";

                if (value === "") {
                    error = "This field is required";
                }

                if (name === "email" && value !== "") {
                    let pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!pattern.test(value)) {
                        error = "Invalid email format";
                    }
                }

                if (name === "phone_number" && value !== "") {
                    if (!/^[0-9]{10}$/.test(value)) {
                        error = "Enter valid 10-digit number";
                    }
                }

                let errorBox = input.next(".error-text");

                if (error !== "") {
                    input.addClass("error").removeClass("valid");
                    errorBox.text(error);
                    return false;
                } else {
                    input.removeClass("error").addClass("valid");
                    errorBox.text("");
                    return true;
                }
            }

            // 🔁 Live validation
            $("#contact-form input, #contact-form textarea, #contact-form select").on("keyup change", function () {
                validateField($(this));
            });

            // 🚀 Submit
            $('#contact-form').on('submit', function (e) {
                e.preventDefault();

                let isValid = true;

                $(".error-text").text("");
                $(".form-control").removeClass("error");

                $("#contact-form input, #contact-form textarea, #contact-form select").each(function () {
                    if (!validateField($(this))) {
                        isValid = false;
                    }
                });

                // ❌ If invalid → show SweetAlert error
                if (!isValid) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: 'Please fill all required fields correctly',
                        confirmButtonColor: '#d33'
                    });
                    return;
                }

                const form = $(this);
                const btn = form.find('button[type="submit"]');

                btn.prop('disabled', true).text('Sending...');

                $.ajax({
                    url: form.attr('action'),
                    type: "POST",
                    data: form.serialize(),

                    // ✅ SUCCESS ALERT
                    success: function (res) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message,
                            confirmButtonColor: '#629D23'
                        });

                        form[0].reset();
                        $(".form-control").removeClass("valid");
                    },

                    // ❌ SERVER ERROR ALERT
                    error: function (xhr) {

                        let msg = "Something went wrong";

                        if (xhr.responseJSON?.errors) {
                            msg = Object.values(xhr.responseJSON.errors)
                                .map(e => e[0]).join('\n');
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: msg,
                            confirmButtonColor: '#d33'
                        });
                    },

                    complete: function () {
                        btn.prop('disabled', false).text('Send Message');
                    }
                });
            });

        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof jQuery === 'undefined') return;
            
            function validateField(input) {
                let value = input.val().trim();
                let name = input.attr("name");
                let error = "";

                if (value === "") {
                    error = "This field is required";
                }

                if (name === "email" && value !== "") {
                    let pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!pattern.test(value)) {
                        error = "Invalid email format";
                    }
                }

                if (name === "phone_number" && value !== "") {
                    if (!/^[0-9]{10}$/.test(value)) {
                        error = "Enter valid 10-digit number";
                    }
                }

                let errorBox = input.next(".error-text");

                if (error !== "") {
                    input.addClass("error").removeClass("valid");
                    errorBox.text(error);
                    return false;
                } else {
                    input.removeClass("error").addClass("valid");
                    errorBox.text("");
                    return true;
                }
            }

            // 🔁 Live validation
            $("#contact-form input, #contact-form textarea, #contact-form select").on("keyup change", function () {
                validateField($(this));
            });

            // 🚀 Submit
            $('#contact-form').on('submit', function (e) {
                e.preventDefault();

                let isValid = true;

                $(".error-text").text("");
                $(".form-control").removeClass("error");

                $("#contact-form input, #contact-form textarea, #contact-form select").each(function () {
                    if (!validateField($(this))) {
                        isValid = false;
                    }
                });

                // ❌ STOP submit (no popup)
                if (!isValid) return;

                const form = $(this);
                const btn = form.find('button[type="submit"]');

                btn.prop('disabled', true).text('Sending...');

                $.ajax({
                    url: form.attr('action'),
                    type: "POST",
                    data: form.serialize(),

                    // ✅ SUCCESS POPUP ONLY
                    success: function (res) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message,
                            confirmButtonColor: '#629D23'
                        });

                        form[0].reset();
                        $(".form-control").removeClass("valid");
                    },

                    // ❌ NO POPUP HERE
                    error: function (xhr) {

                        if (xhr.responseJSON?.errors) {

                            $.each(xhr.responseJSON.errors, function (field, messages) {

                                let input = $('[name="' + field + '"]');
                                let errorBox = input.next(".error-text");

                                input.addClass("error");
                                errorBox.text(messages[0]);

                            });

                        }

                    },

                    complete: function () {
                        btn.prop('disabled', false).text('Send Message');
                    }
                });
            });
        });
    </script>



    <!-- <style>
        @media screen and (max-width: 768px) {
            .header-info-box {
                padding-top: 10px;
                padding-bottom: 10px;
            }

            #cal {
                display: none !important;
            }
        }

        /* Ensure swiper buttons are clickable */
        .swiper-button-next,
        .swiper-button-prev {
            z-index: 1000;
        }

        /* Prevent blocking clicks */
        .social-media-side {
            pointer-events: none;
        }

        /* Allow click only on buttons */
        .social-media-side a {
            pointer-events: auto;
        }

        /* Floating container */
        .social-media-side {
            position: fixed;
            right: 0;
            top: 60%;
            transform: translateY(-50%);
            z-index: 999;
        }

        /* List reset */
        .social-media-side ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .social-media-side ul li {
            margin: 10px 0;
        }

        /* Button style */
        .social-media-side ul li a {
            display: flex;
            align-items: center;
            /* justify-content: space-between; */
            width: 155px;
            padding: 10px 0px;
            background: #eee;
            border-radius: 50px 0 0 50px;
            text-decoration: none;
            color: #000;
            font-weight: 500;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);

            /* partially hidden */
            transform: translateX(90px);
            transition: 0.4s ease;
        }

        /* Slide out on hover */
        .social-media-side ul li a:hover {
            transform: translateX(0);
        }

        /* Icon style */
        .social-media-side ul li a img {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            transition: transform 0.6s ease;
        }

        /* Hover rotate effect */
        /* .social-media-side ul li a:hover img {
    transform: rotate(360deg) scale(1.1);
} */
        .social-media-side ul li a:hover img {
            animation: spin 4s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Optional colors */
    </style>

    <script>
        window.addEventListener("scroll", function () {
            const btns = document.querySelector(".social-media-side");

            if (window.scrollY > 100) {
                btns.style.opacity = "1";
            } else {
                btns.style.opacity = "1";
            }
        });
    </script> -->
    <style>
        .account-info-list li a.active {
            color: #000000 !important;
        }
    </style>
    {{-- Footer Newsletter AJAX Handler --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof jQuery === 'undefined') return;

            $('#footer-newsletter-form').on('submit', function (e) {
                e.preventDefault();

                var $btn = $('#footer-newsletter-btn');
                var $msg = $('#footer-newsletter-msg');
                var email = $('#footer-newsletter-email').val();
                var csrf = $('meta[name="csrf-token"]').attr('content');

                if (!email) return;

                $btn.prop('disabled', true);
                $msg.html('');

                fetch('/newsletter/subscribe', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf
                    },
                    body: JSON.stringify({ email: email })
                })
                    .then(function (r) { return r.json(); })
                    .then(function (data) {
                        if (data.success) {
                            Swal.fire({
                                title: '🎉 Subscribed!',
                                text: data.message,
                                icon: 'success',
                                timer: 2500,
                                showConfirmButton: false,
                                timerProgressBar: true
                            });
                            $('#footer-newsletter-email').val('');
                        } else {
                            $msg.html('<div class="text-warning mt-1" style="font-size:12px;"><i class="icon feather icon-alert-circle me-1"></i>' + data.message + '</div>');
                        }
                        $btn.prop('disabled', false);
                    })
                    .catch(function () {
                        $msg.html('<div class="text-danger mt-1" style="font-size:12px;">Something went wrong. Please try again.</div>');
                        $btn.prop('disabled', false);
                    });
            });
        });
    </script>
    @yield('scripts')
</body>

</html>