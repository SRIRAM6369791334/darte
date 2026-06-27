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
                    <h1 class="color1">Terms & Conditions</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"> Home</a></li>
                            <li class="breadcrumb-item">Terms & Conditions</li>
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
                            <h3 class="title">Terms & Conditions</h3>
                            <p>Welcome to Darte. By accessing and using our website, you agree to comply with the following terms designed to ensure a smooth and fair experience for all users.</p>
                        </div>
                        <div class="content-box">
                            <p>All products listed on our website are subject to availability. While we strive to display accurate information, Darte reserves the right to update product details, pricing, and availability at any time without prior notice.</p>
                            
                            <p>Orders are confirmed only after successful payment. In rare cases, we may cancel or refuse an order due to unforeseen circumstances.</p>
                            
                            <p>All content on this website, including images, logos, and text, is the property of Darte and may not be used without permission.</p>
                            
                            <p>We aim to deliver a seamless experience, but we are not responsible for delays caused by external factors such as courier services or unforeseen events.</p>
                            
                            <p>By continuing to use our website, you accept these terms.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
