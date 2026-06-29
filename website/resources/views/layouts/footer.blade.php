<footer class="site-footer style-1">
    <!-- Footer Top -->
    <div class="footer-top">
        <div class="container">
            <style>
                .site-footer.style-1 {
                    background: #000 !important;
                    color: #fff !important;
                }

                .disc {
                    font-size: 16px !important;

                }

                @media only screen and (max-width: 1300px) {

                    .disc {
                        font-size: 12px !important;
                    }

                    .site-footer.style-1 .footer-logo h1 {
                        font-size: 40px !important;
                    }

                }

                @media only screen and (max-width: 768px) {
                    .site-footer.style-1 .footer-logo h1 {
                        font-size: 32px !important;
                    }
                }

                .site-footer.style-1 .footer-title,
                .site-footer.style-1 p,
                .site-footer.style-1 a,
                .site-footer.style-1 .widget,
                .site-footer.style-1 .widget_services ul li a,
                .site-footer.style-1 .widget-address p,
                .site-footer.style-1 .widget-address a,
                .site-footer.style-1 .footer-logo h1,
                .site-footer.style-1 .footer-bottom,
                .site-footer.style-1 .footer-bottom a,
                .site-footer.style-1 .footer-bottom span,
                .site-footer.style-1 .footer-bottom p,
                .site-footer.style-1 .form-control,
                .site-footer.style-1 .input-group-addon .btn,
                .site-footer.style-1 .fa-solid,
                .site-footer.style-1 .icon,
                .site-footer.style-1 .footer-logo {
                    color: #fff !important;
                    fill: #fff !important;
                }

                .site-footer.style-1 .form-control#footer-newsletter-email {
                    background: #fff !important;
                    color: #000 !important;
                    border: 1px solid #fff !important;
                }

                .site-footer.style-1 .input-group-addon .btn#footer-newsletter-btn {
                    background: #222 !important;
                    color: #fff !important;
                }

                .site-footer.style-1 .input-group-addon .btn#footer-newsletter-btn .icon {
                    color: #fff !important;
                    fill: #fff !important;
                }

                .site-footer.style-1 .footer-bottom {
                    background: #111 !important;
                    color: #fff !important;
                }

                .site-footer.style-1 .footer-bottom a {
                    color: #fff !important;
                    text-decoration: underline;
                }

                .site-footer.style-1 .footer-logo h1 {
                    color: #fff !important;
                }

                .site-footer.style-1 .widget_services ul {
                    padding-left: 0 !important;
                    margin-left: 0 !important;
                    list-style: none !important;
                }

                .site-footer.style-1 .widget_services ul li {
                    padding-left: 0 !important;
                    margin-left: 0 !important;
                    list-style: none !important;
                }

                .site-footer.style-1 .widget_services ul li::before,
                .site-footer.style-1 .widget_services ul li::after {
                    content: none !important;
                    display: none !important;
                }

                .site-footer.style-1 .widget_services ul li a {
                    padding-left: 0 !important;
                    margin-left: 0 !important;
                }

                .site-footer.style-1 .widget_services ul li a:hover {
                    text-decoration: underline;
                }

                .site-footer.style-1 .fa-solid,
                .site-footer.style-1 .icon {
                    color: #fff !important;
                }

                /* Newsletter input and button sizing */
                .site-footer.style-1 #footer-newsletter-form .input-group {
                    align-items: stretch;
                }

                .site-footer.style-1 #footer-newsletter-form .form-control#footer-newsletter-email {
                    height: 48px !important;
                    min-height: 48px !important;
                    font-size: 1rem;
                }

                .site-footer.style-1 #footer-newsletter-form .input-group-addon .btn#footer-newsletter-btn {
                    height: 48px !important;
                    min-width: 48px !important;
                    padding: 0 18px !important;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 1.25rem;
                    border-radius: 0 4px 4px 0 !important;
                }

                @media (max-width: 767px) {
                    .widget_services ul li {
                        padding: 0 0 5px 0 !important;
                    }
                }
            </style>
            <div class="row">
                <div class="col-xl-4 col-md-4 col-sm-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="widget widget_about me-2 text-center">
                        <div class="footer-logo logo-white mb-3 d-flex justify-content-center">
                            <a href="/"><img src="{{ asset('images/logo.webp') }}" alt="DARTE Logo" style="max-width: 160px; height: auto; max-height: 110px; object-fit: contain;"></a>
                        </div>
                        <p>
                            Modern essentials for everyday confidence
                        </p>


                    </div>
                </div>

                <div class="col-xl-4 col-md-4 col-sm-6 col-6 d-flex justify-content-center wow fadeInUp" data-wow-delay="0.3s">
                    <div class="widget widget_services">
                        <h5 class="footer-title">Quick Links</h5>
                        <ul>
                            <li><a href="/shop">Shop</a></li>
                            <li><a href="/about">About Us</a></li>
                            <li><a href="/contact">Contact Us</a></li>
                            {{-- <li><a href="/blog">Blog</a></li> --}}

                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 col-sm-6 col-6 d-flex justify-content-center wow fadeInUp" data-wow-delay="0.3s">

                    <div class="widget widget_services">
                        <h5 class="footer-title">Our Policies</h5>
                        <ul>
                            <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('terms.conditions') }}">Terms & Conditions</a></li>
                            <li><a href="{{ route('shipping-refund-policy') }}">Shipping & Refund Policy</a></li>
                            <li><a href="{{ route('tracking.order') }}">Tracking & Returns</a></li>

                        </ul>
                    </div>
                </div>
                {{-- <div class="col-xl-2  col-md-6 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="widget widget_services">
                        <h5 class="footer-title">Contact Us</h5>

                        <ul class="widget-address">
                            <li>
                                <p><i class="fa-solid fa-location-dot"></i>46, kumaran colony extension, ammapalayam,
                                    Tirupur, Tamilnadu 641652.</p>
                            </li>
                            <!-- <li>
                                <p><span>E-mail</span> : example@info.com</p>
                            </li> -->
                            <li> <a href="mailto:support@darte.com"><i class="fa-solid fa-envelope"></i>
                                    support@darte.com</a>
                            </li>
                            <li>
                                <a href="tel:+917810078107"><i class="fa-solid fa-phone"></i> +91 78100 78107
                                </a>
                                <!-- <p><span>Phone</span> : (064) 332-1233</p> -->
                            </li>


                        </ul>
                    </div>
                </div> --}}

                {{-- <div class="col-xl-3 col-md-6 col-sm-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="widget widget_post">
                        <h5 class="footer-title">subscribe to our newsletter</h5>
                        <p class="disc-news-letter">
                            Subscribe to the mailing list to receive updates one the new arrivals and other discounts
                        </p>
                        <form id="footer-newsletter-form">
                            @csrf
                            <div id="footer-newsletter-msg" class="dzSubscribeMsg mb-2"></div>
                            <div class="form-group">
                                <div class="input-group mb-0">
                                    <input name="email" id="footer-newsletter-email" required type="email"
                                        class="form-control" placeholder="Your Email Address">
                                    <div class="input-group-addon">
                                        <button type="submit" id="footer-newsletter-btn" class="btn">
                                            <i class="icon feather icon-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Footer Top End -->

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row fb-inner wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-6 col-md-12 text-start">
                    <p class="disc" style="text-align: center">
                        Copyright © Darte All rights reserved 2026. Developed by <a
                            href="https://saitechnosolutions.com/" target="_blank">Sai Techno
                            Solutions</a>
                    </p>
                    <!-- <p class="copyright-text">© <span class="current-year">2026</span> <a
                            href="https://www.Darte.com/">Darte</a> Theme. All Rights Reserved.</p> -->
                </div>
                <div class="col-lg-6 col-md-12 text-end">
                    <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-end">
                        <span class="me-3">We Accept: </span>
                        <div class="payment-icons" style="font-size: 32px; display: flex; gap: 12px; color: #fff;">
                            <i class="fab fa-cc-visa"></i>
                            <i class="fab fa-cc-mastercard"></i>
                            <i class="fab fa-cc-amex"></i>
                            <i class="fab fa-cc-paypal"></i>
                            <i class="fab fa-cc-discover"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Bottom End -->
</footer>
<!-- Footer End -->