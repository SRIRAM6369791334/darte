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
     .content-inner p,
     .content-inner li {
         text-align: justify !important;
     }
</style>
    <div class="page-content bg-light">
        <!-- Banner Start -->
        <div class="dz-bnr-inr bg-secondary overlay-black-light"
            style="background-image:url(assets/images/background/bg1.webp);">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1 class="color1">Shipping & Refund Policy</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"> Home</a></li>
                            <li class="breadcrumb-item">Shipping & Refund Policy</li>
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
                            <h3 class="title">Shipping & Refund Policy</h3>
                            <p>At Darte, we aim to provide a hassle-free shopping experience from order placement to delivery.</p>
                        </div>
                        <div class="content-box">
                            <h4>Shipping</h4>
                            <p>All orders are processed within 1–3 business days. Once shipped, your order will be delivered within 3–7 business days, depending on your location. You will receive tracking details once your order is dispatched.</p>
                            
                            <h4>Returns & Refunds</h4>
                            <p>We accept returns within 7 days of delivery, provided the product is unused and in its original condition. Once your return is approved, refunds will be processed within 5–7 business days.</p>
                            
                            <h4>Important Notes</h4>
                            <ul>
                                <li>Products that are used or damaged are not eligible for return</li>
                                <li>Customized items cannot be returned</li>
                                <li>Orders can be cancelled within 24 hours of purchase</li>
                            </ul>
                            
                            <p>Our goal is to ensure your satisfaction with every purchase.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
