@extends('layouts.app')
@section('content')
    <style>
        .page-content {
            background: #fff !important;
        }

        .whatwedo-box {
            background: white !important;
        }

        .exp-head .counter-num h2 .counter {
            font-family: 'Inter', sans-serif !important;
            font-size: 48px !important;
            font-weight: 700 !important;
            color: #000 !important;
            line-height: 1 !important;
        }
    @media screen and (max-width: 850px) {
        .exp-head .counter-num h2 .counter
 {
    font-family: 'Inter', sans-serif !important;
    font-size: 30px !important;
    font-weight: 700 !important;
    color: #000 !important;
    line-height: 1 !important;
}
 .about-style3{
    padding-top: 0px;
 }
}
@media only screen and (max-width: 575px) {
    .dz-bnr-inr .dz-bnr-inr-entry {
        padding: 0px 0 0px 0;
        text-align: center;
        display: table-cell;
    }
}
@media (max-width: 767px) {
    .about-thumb img {
        
        object-fit: cover;
    }
}
    </style>
    <div class="page-content bg-light pt-5 mt-3">

        <div class="dz-bnr-inr bg-secondary overlay-black-light" style="position: relative;min-height: 251px;display: flex;align-items: center;overflow: hidden;z-index: 1;">
            <img src="{{ asset('assets/images/cropped_about.png') }}" alt="About Us Banner" style="position: absolute;top: 0;left: 0;width: 100%;height: 150%;object-fit: revert;object-position: center 15%;z-index: -1;">
            <div class="container" style="position: relative; z-index: 2;">
                <div class="dz-bnr-inr-entry">
                    <h1 class="color1">About Us</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"> Home</a></li>
                            <li class="breadcrumb-item">About Us</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Banner Start -->

        {{-- <div id="loading-area" class="preloader-wrapper-4">
            <img src="assets/images/loading.gif" alt="">
        </div> --}}
        <!-- Banner End -->

        <section class="content-inner">
            <div class="container">
                <div class="row about-style2 align-items-center">
                    <div class="col-lg-6 col-md-12 col-sm-12 m-b30">
                        <div class="about-thumb">
                            <img src="assets/images/pic7.webp" alt="" >
                        </div>
                    </div>
                    <div class=" col-lg-6 col-md-12 col-sm-12">
                        <div class="about-content">
                            <div class="section-head style-1 d-block">
                                <h3 class="title">About Darte</h3>
                                <p>At Darte, fashion is more than just clothing, it is a reflection of identity, confidence,
                                    and everyday lifestyle. We believe that what you wear should represent who you are
                                    without the need to say anything. Our brand is built on the idea of creating clothing
                                    that feels natural, looks effortless, and fits seamlessly into your daily life.</p>
                                <p>Darte was created with a vision to redefine modern fashion by combining style, comfort,
                                    and simplicity. In a world driven by fast-changing trends, we focus on designs that
                                    remain relevant, wearable, and timeless. Every piece we create is thoughtfully designed
                                    to ensure it delivers both aesthetic appeal and practical comfort.</p>
                                <p>We pay close attention to every detail, from selecting the right fabrics to ensuring
                                    quality finishing in every product. Our goal is to provide clothing that not only looks
                                    good but also feels comfortable throughout the day. We understand that true style comes
                                    from confidence, and comfort plays a big role in that.</p>
                            </div>
                            <!-- <div class="about-bx-detail">
                                                                                                                                                                        <div class="about-bx-pic radius">
                                                                                                                                                                            <img src="assets/images/testimonial/testimonial4.webp" alt="">
                                                                                                                                                                        </div>
                                                                                                                                                                        <div>
                                                                                                                                                                            <h6 class="name">Kenneth Fong</h6>
                                                                                                                                                                            <span class="position">Postgraduate Student</span>
                                                                                                                                                                        </div>
                                                                                                                                                                    </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class=" about-style3" style="padding-bottom: 0px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 col-sm-12">
                        <div class="whatwedo-box">
                            <div class="about-content">
                                <div class="section-head style-1 wow fadeInUp d-block" data-wow-delay="0.4s"
                                    style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                                    <h4 class="title">Our Identity</h4>
                                    <p>Our designs are inspired by real people and real lifestyles. Darte is made for
                                        individuals who want to express themselves effortlessly, without overthinking their
                                        style. Whether it is a casual outing, daily wear, or a statement look, our
                                        collections are designed to adapt to different moments of your life.</p>
                                    <p>We are committed to delivering a smooth and reliable experience to our customers.
                                        From browsing to delivery, every step is designed to be simple, transparent, and
                                        satisfying. We believe in building long-term relationships with our customers by
                                        consistently offering quality products and dependable service.</p>
                                    <p>Darte represents a new generation of fashion that values authenticity, comfort, and
                                        confidence. As we continue to grow, our focus remains on creating clothing that
                                        connects with people and becomes a part of their everyday journey.</p>
                                    <p>Darte is not just a brand, it is a reflection of how you choose to present yourself
                                        to the world.</p>
                                </div>
                                <div class="row justify-content-center m-b30 text-lg-start text-center">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4 wow fadeInUp" data-wow-delay="0.5s"
                                        style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                                        <div class="exp-head">
                                            <div class="counter-num">
                                                <h2><span class="counter">40</span>k+</h2>
                                            </div>
                                            <span class="counter-title">Happy Customer</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4 wow fadeInUp" data-wow-delay="0.6s"
                                        style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">
                                        <div class="exp-head">
                                            <div class="counter-num">
                                                <h2><span class="counter">21</span>+</h2>
                                            </div>
                                            <span class="counter-title">Years in Business</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4 wow fadeInUp" data-wow-delay="0.7s"
                                        style="visibility: visible; animation-delay: 0.7s; animation-name: fadeInUp;">
                                        <div class="exp-head">
                                            <div class="counter-num">
                                                <h2><span class="counter">98</span>%</h2>
                                            </div>
                                            <span class="counter-title">Return Clients</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12 col-sm-12">
                        <div class="about-thumb wow fadeInUp" data-wow-delay="0.8s"
                            style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp;">
                            <img src="assets/images/lady3.webp" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- <div class="dz-media alignfullwide m-b30">
            <img src="assets/images/blog/detail/pic3.webp" alt="/">
        </div> -->

        <!-- Get In Touch -->
        <section class="get-in-touch">
            <div class="m-r100 m-md-r0 m-sm-r0">
                <h3 class="dz-title mb-lg-0 mb-3">Questions ?
                    <span>Our experts will help find the grar that’s right for you</span>
                </h3>
            </div>
            <a href="/contact" class="btn btn-light">Get In Touch</a>
        </section>
        <!-- Get In Touch End -->
        {{-- <section class=" about-style4">
            <div class="container">
                <div class="row  align-items-center ">
                    <div class="col-lg-6 order-lg-1 order-2">
                        <div class="side-content">
                            <div class="about-thumb">
                                <img src="assets/images/girl.webp" alt="" style="border-radius:30px 0px;">
                            </div>
                            {{-- <div class="our-customer wow fadeInUp" data-wow-delay="0.2s"
                                style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <h6>Our Satisfied User</h6>
                                <ul>
                                    <li class="customer-image">
                                        <img src="assets/images/testimonial/pic1.webp" alt="">
                                    </li>
                                    <li class="customer-image">
                                        <img src="assets/images/testimonial/pic2.webp" alt="">
                                    </li>
                                    <li class="total-customer">
                                        <span class="font-14">+12K</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 m-b30 aos-item wow fadeInUp  order-lg-2 order-1" data-wow-delay="0.3s"
                        style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                        <div>
                            <div class="section-head">
                                <h2 class="title">What our clients say <br> about us</h2>
                            </div>
                            <div class="swiper swiper-five swiper-initialized swiper-horizontal swiper-backface-hidden">
                                <div class="swiper-wrapper" id="swiper-wrapper-4359c10d9692afdfc" aria-live="polite">
                                    <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 2"
                                        data-swiper-slide-index="0" style="width: 630px; margin-right: 20px;">
                                        <div class="about-content">
                                            <p class="para-text">"DARTE transformed my wardrobe completely! The attention to
                                                detail and quality of their fashion items are simply unmatched. I've never
                                                felt more stylish and confident in my everyday wear."</p>
                                            <div class="about-bx-detail">
                                                {{-- <div class="about-bx-pic radius">
                                                    <img src="assets/images/testimonial/testimonial4.webp" alt="">
                                                </div>
                                                <div>
                                                    <h6 class="name">Kenneth Fong</h6>
                                                    <span class="position">Postgraduate Student</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide swiper-slide-next" role="group" aria-label="2 / 2"
                                        data-swiper-slide-index="1" style="width: 630px; margin-right: 20px;">
                                        <div class="about-content">
                                            <p class="para-text">"From the seamless shopping experience to the perfectly
                                                tailored outfits, DARTE is my go-to luxury fashion brand. The designs are
                                                modern, edgy, and incredibly flattering."</p>
                                            <div class="about-bx-detail">
                                                {{-- <div class="about-bx-pic radius">
                                                    <img src="images/testimonial/testimonial4.webp" alt="">
                                                </div>
                                                <div>
                                                    <h6 class="name">Joe Do</h6>
                                                    <span class="position">Undergraduate Student</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pagination-align">
                                    <div class="about-button-prev btn-prev" tabindex="0" role="button"
                                        aria-label="Previous slide" aria-controls="swiper-wrapper-4359c10d9692afdfc">
                                        <i class="flaticon flaticon-left-chevron"></i>
                                    </div>
                                    <div class="about-button-next btn-next" tabindex="0" role="button"
                                        aria-label="Next slide" aria-controls="swiper-wrapper-4359c10d9692afdfc">
                                        <i class="flaticon flaticon-chevron"></i>
                                    </div>
                                </div>
                                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img src="assets/images/line-shap.webp" alt="" class="line">
        </section> --}}


    </div>
@endsection