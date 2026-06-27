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
                    <h1 class="color1">Tracking & Returns</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"> Home</a></li>
                            <li class="breadcrumb-item">Tracking & Returns</li>
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
                        <!-- Tracking Section -->
                        <div id="tracking" class="mb-5">
                            <div class="section-head style-1">
                                <h3 class="title">How to Track Your Order</h3>
                                <p>Once your order is shipped, we will send you a confirmation email and SMS containing your tracking number and courier partner details. You can easily monitor the status of your shipment using these details.</p>
                            </div>
                            <div class="content-box">
                                <h4 class="mb-3">Tracking Steps:</h4>
                                <p>To check the real-time status of your delivery, please follow these simple steps:</p>
                                <ul>
                                    <li>Check your email inbox or SMS messages for the shipping confirmation containing the tracking link.</li>
                                    <li>Click on the tracking link or copy the tracking ID (AWB number) provided.</li>
                                    <li>Visit our logistics partner's official tracking portal and enter your AWB number to track the package directly.</li>
                                </ul>
                                
                                <p class="text-muted mt-3">Please note that tracking information may take up to 24 hours to update on the courier partner's portal after shipment.</p>
                            </div>
                        </div>

                        <hr class="my-5" style="border-top: 1px solid rgba(0,0,0,0.1);">

                        <!-- Returns Section -->
                        <div id="returns">
                            <div class="section-head style-1">
                                <h3 class="title">How to Return Your Order</h3>
                                <p>We want you to love your Darte purchase. If you are not entirely satisfied, we offer a simple and convenient return process within 7 days of delivery.</p>
                            </div>
                            <div class="content-box">
                                <h4 class="mb-3">Return Policy Guidelines:</h4>
                                <p>To qualify for a return or replacement, please ensure the following conditions are met:</p>
                                <ul>
                                    <li>The request must be initiated within 7 days from the delivery date.</li>
                                    <li>Items must be unused, unwashed, and in their original packaging with all tags intact.</li>
                                    <li>Innerwear, socks, and items purchased during clearance sales may not be eligible for returns due to hygiene and promotional constraints.</li>
                                </ul>

                                <h4 class="mt-4 mb-3">How to Initiate a Return:</h4>
                                <p>You can easily request a return online through your Darte account by following these steps:</p>
                                <ol>
                                    <li>Log in to your account and go to <strong>My Account &gt; Orders</strong>.</li>
                                    <li>Select the order containing the items you wish to return.</li>
                                    <li>Click on the <strong>Return</strong> button, select the items, specify the quantity, and choose a reason for return.</li>
                                    <li>Once submitted, our team will review your request. After approval, a reverse pickup will be scheduled.</li>
                                </ol>
                                
                                <h4 class="mt-4 mb-3">Refund & Processing:</h4>
                                <p>Once we receive the returned items at our warehouse and verify their condition, we will process your refund or exchange. Refunds will be credited to your original payment method or as store credit, depending on your choice, within 5-7 business days of warehouse receipt.</p>
                                
                                <p class="mt-4">If you have any questions or require support tracking your shipment or initiating a return, please contact us at support@darte.com or call +91 78100 78107.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
