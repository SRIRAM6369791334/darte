@extends('layouts.app')
@section('content')
<style>
     .dz-bnr-inr .dz-bnr-inr-entry {
        padding: 0px 0 0px 0;
        text-align: center;
        display: table-cell;
    }
 @media (max-width: 767px) {
            .dz-bnr-inr {
                min-height: 130px !important;
                height: 173px !important;
            }}
</style>
    <div class="page-content bg-light">
        <!-- Banner Start -->
        <div class="dz-bnr-inr bg-secondary overlay-black-light"
            style="background-image:url(assets/images/background/bg1.webp);">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1 class="color1">Privacy Policy</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"> Home</a></li>
                            <li class="breadcrumb-item">Privacy Policy</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Banner End -->

        <section class="content-inner">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-head style-1">
                            <h3 class="title">Our Privacy Policy</h3>
                            <p>At Darte, your privacy matters to us. We are committed to safeguarding your personal information and ensuring a secure shopping experience every time you visit our website.</p>
                        </div>
                        <div class="content-box">
                            <p>When you interact with Darte, we may collect basic information such as your name, contact details, shipping address, and payment information. This data helps us process your orders smoothly and keep you updated throughout your purchase journey.</p>
                            
                            <p>We use secure and trusted payment gateways, and your sensitive financial details are never stored on our servers. Your information is used only to:</p>
                            <ul>
                                <li>Fulfill your orders efficiently</li>
                                <li>Improve our services and user experience</li>
                                <li>Communicate important updates and offers</li>
                            </ul>
                            
                            <p>We do not sell, trade, or misuse your personal data. By using our website, you agree to our privacy practices designed to keep your information safe and protected.</p>
                            
                            <p>For any concerns, feel free to contact us anytime.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
