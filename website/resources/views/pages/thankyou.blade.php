@extends('layouts.app')

@section('content')
<div class="page-content bg-light">
    <!-- Banner Start -->
    <div class="dz-bnr-inr bg-secondary overlay-black-light" style="background-image:url(assets/images/background/bg1.webp); background-size: cover;">
        <div class="container">
            <div class="dz-bnr-inr-entry">
                <h1>Order Confirmed</h1>
                <nav aria-label="breadcrumb" class="breadcrumb-row">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"> Home</a></li>
                        <li class="breadcrumb-item">Thank You</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <div class="content-inner-1">
        <div class="container text-center">
            <div class="thank-you-content">
                <i class="fa-solid fa-circle-check text-success mb-4" style="font-size: 80px;"></i>
                <h2 class="title font-weight-700">Payment Successful!</h2>
                <p class="m-b30">Your order has been successfully placed. We'll send you a confirmation email with details of your order shortly.</p>
                
                @if(session('order_number'))
                    <div class="alert alert-secondary d-inline-block">
                        <strong>Order Number:</strong> {{ session('order_number') }}
                    </div>
                @endif

                <div class="mt-4">
                    <a href="{{ route('shop') }}" class="btn btn-secondary btn-md btn-rounded">CONTINUE SHOPPING</a>
                    <a href="{{ url('/my-account') }}" class="btn btn-outline-secondary btn-md btn-rounded ms-2">MY ACCOUNT</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
