@extends('layouts.app')
@section('content')
    <style>
        @media (min-width: 992px) {
            section {
                padding-top: 45px !important;
                padding-bottom: 45px !important;
            }
        }
        @media (max-width: 991px) {
            section {
                padding-top: 1px !important;
                padding-bottom: 1px !important;
            }
            .swiper-button-prev, .swiper-button-next {
                min-width: 44px !important;
                min-height: 44px !important;
            }
            .shop-card .meta-icon a, .shop-card .btn {
                min-width: 44px !important;
                min-height: 44px !important;
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
            }
            
            /* Typography & Margin Fixes for Mobile */
            .luxury-heading {
                font-size: 36px !important;
                line-height: 1.2 !important;
            }
            .banner-content .class2 {
                font-size: 16px !important;
            }
            .section-head .title {
                font-size: 24px !important;
                line-height: 1.2 !important;
                margin-bottom: 10px !important;
                margin-top: 10px !important;
            }
            .section-head p {
                font-size: 14px !important;
            }
            section.about-style4 {
                padding: 30px 0 !important;
                margin: 30px auto !important;
                border-radius: 30px !important;
            }
            .adv-area .product-box.style-circle .sale-box {
                position: absolute !important;
                top: 50% !important;
                right: 5% !important;
                transform: translateY(-50%) !important;
                width: 260px !important;
                height: 260px !important;
                border-radius: 50% !important;
                z-index: 10 !important;
                display: flex !important;
                flex-direction: column !important;
                justify-content: center !important;
                align-items: center !important;
                padding: 25px !important;
                text-align: center !important;
                background: transparent !important;
            }
            .adv-area .product-box.style-circle .sale-box:after {
                display: block !important;
            }
            .adv-area .product-box.style-circle .sale-box .sale-name {
                font-size: 24px !important;
                margin-bottom: 15px !important;
            }
            .adv-area .product-box.style-circle .sale-box .badge.style-1 {
                font-size: 12px !important;
                margin-bottom: 5px !important;
            }
            .adv-area .product-box.style-circle .sale-box .btn {
                padding: 8px 16px !important;
                font-size: 11px !important;
            }
            /* Position images to avoid covering subject faces on mobile/tablet */
            .adv-area .product-box.style-circle .product-media {
                background-position: left center !important;
            }
            .adv-area .product-box:not(.style-circle) .product-media {
                background-position: right center !important;
            }
            .dz-features .title {
                font-size: 40px !important;
            }
            .dz-features li svg {
                width: 30px !important;
                height: 30px !important;
            }
            .about-wraper, .testimonial-swiper, .swiper-insta {
                padding: 0 15px !important;
            }

            /* Banner 2 text overrides for max-width 991px */
            .adv-area .product-box:not(.style-circle) .product-content .product-name {
                font-size: 26px !important;
                margin-bottom: 15px !important;
            }
            .adv-area .product-box:not(.style-circle) .product-content .badge.style-1 {
                font-size: 12px !important;
                margin-bottom: 10px !important;
            }
            .adv-area .product-box:not(.style-circle) .product-content .btn {
                padding: 8px 16px !important;
                font-size: 11px !important;
            }
        }

        @media (max-width: 768px) {
            .adv-area .product-box.style-circle .sale-box .sale-name {
                font-size: 24px !important;
            }
            .adv-area .product-box:not(.style-circle) .product-content .product-name {
                font-size: 22px !important;
            }
        }

        @media (max-width: 575px) {
            .adv-area .product-box.style-circle .sale-box {
                width: 220px !important;
                height: 220px !important;
                right: 3% !important;
                padding: 20px !important;
            }
            .adv-area .product-box.style-circle .sale-box .sale-name {
                font-size: 20px !important;
                margin-bottom: 10px !important;
            }
            .adv-area .product-box.style-circle .sale-box .badge.style-1 {
                font-size: 11px !important;
            }
            .adv-area .product-box.style-circle .sale-box .btn {
                padding: 6px 12px !important;
                font-size: 10px !important;
            }

            /* Banner 2 text overrides for max-width 575px */
            .adv-area .product-box:not(.style-circle) .product-content .product-name {
                font-size: 18px !important;
                margin-bottom: 10px !important;
                max-width: 180px !important; /* Keep it narrow so it doesn't wrap over family faces */
            }
            .adv-area .product-box:not(.style-circle) .product-content .badge.style-1 {
                font-size: 11px !important;
                margin-bottom: 5px !important;
            }
            .adv-area .product-box:not(.style-circle) .product-content .btn {
                padding: 6px 12px !important;
                font-size: 10px !important;
            }
        }

        @media (max-width: 360px) {
            .adv-area .product-box.style-circle .sale-box {
                width: 190px !important;
                height: 190px !important;
                right: 2% !important;
                padding: 12px !important;
            }
            .adv-area .product-box.style-circle .sale-box .sale-name {
                font-size: 14px !important;
                margin-bottom: 8px !important;
                letter-spacing: 1px !important;
            }
            .adv-area .product-box.style-circle .sale-box .badge.style-1 {
                font-size: 9px !important;
                margin-bottom: 4px !important;
            }
            .adv-area .product-box.style-circle .sale-box .btn {
                padding: 8px 14px !important;
                font-size: 9px !important;
                letter-spacing: 1px !important;
            }

            /* Banner 2 text overrides for max-width 360px */
            .adv-area .product-box:not(.style-circle) .product-content {
                padding: 25px 15px !important;
            }
            .adv-area .product-box:not(.style-circle) .product-content .product-name {
                font-size: 14px !important;
                margin-bottom: 8px !important;
                max-width: 125px !important; /* Extremely narrow to keep clear of subject faces */
                letter-spacing: 1px !important;
            }
            .adv-area .product-box:not(.style-circle) .product-content .badge.style-1 {
                font-size: 10px !important;
                margin-bottom: 5px !important;
            }
            .adv-area .product-box:not(.style-circle) .product-content .btn {
                padding: 8px 14px !important;
                font-size: 9px !important;
                letter-spacing: 1px !important;
                margin-left: 20px;
            }
        }

        .container-fluid {
            background: white !important;
        }

        .adv-area .product-box.style-circle {
            position: relative;
            overflow: hidden;
        }

        .swiper-backface-hidden .swiper-slide {
            border-radius: 10px;
            overflow: hidden;
        }

        @media (min-width: 992px) {
            .adv-area .product-box.style-circle .sale-box {
                position: absolute !important;
                top: 50% !important;
                right: 8% !important;
                transform: translateY(-50%) !important;
                width: 380px !important;
                height: 380px !important;
                /* background: rgb(255 255 255 / 85%) !important; */
                border-radius: 50% !important;
                /* border: 1.5px solid #1a1a1a !important; */
                z-index: 10;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 30px;
                text-align: center;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            }

            .adv-area .product-box.style-circle .sale-box .badge.style-1 {
                background: transparent !important;
                color: #000 !important;
                font-size: 16px !important;
                font-weight: 700 !important;
                text-transform: uppercase;
                letter-spacing: 1px;
                margin-bottom: 10px;
            }

            .adv-area .product-box.style-circle .sale-box .sale-name {
                font-family: 'Inter', sans-serif !important;
                font-size: clamp(32px, 5vw, 48px) !important;
                font-weight: 700 !important;
                color: #000 !important;
                text-transform: uppercase;
                letter-spacing: 2px;
                margin: 0 0 25px 0 !important;
                line-height: 1;
            }
        }

        /* Prevent Swiper image alignment shift on page restore */
        .main-swiper-thumb .banner-media {
            width: 100% !important;
            height: 100% !important;
            /* overflow: hidden removed — was clipping DARTE ::after watermark */
        }

        .main-swiper-thumb .banner-media .img-preview {
            width: 100% !important;
            height: 100% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .main-swiper-thumb .banner-media .img-preview img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            object-position: center !important;
            display: block !important;
        }






        section.about-style4 {
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 30px 70px -20px rgba(0, 0, 0, 0.1);
            border-radius: 60px;
            margin: 40px auto;
            padding: 50px 0 !important;
            background: linear-gradient(135deg, #ffffff 0%, #f9f9f9 100%);
            width: calc(100% - 40px);
            max-width: 1400px;
            position: relative;
            overflow: hidden;
            /* To contain the gradient and rounded corners properly */
        }

        section.about-style4::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.8) 0%, transparent 70%);
            pointer-events: none;
            z-index: -1;
        }

        section.about-style4 .about-content {
            border: 1px solid rgba(0, 0, 0, 0.08) !important;
            padding: 40px !important;
            border-radius: 30px !important;
            background: #fff !important;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.03) !important;
            margin: 10px;
            /* Space for shadow */
            height: 100%;
        }

        @media (max-width: 768px) {
            section.about-style4 {
                border-radius: 30px;
                margin: 40px auto;
                padding: 0px 0 !important;
                width: calc(100% - 20px);
            }

            section.about-style4 .about-content {
                padding: 25px 25px 85px 25px !important;
                border-radius: 20px !important;
            }
            .swiper-five .pagination-align {
                right: 25px !important;
                bottom: 20px !important;
            }
        }

        @media screen and (max-width: 860px) {
            .swiper-backface-hidden .swiper-slide {
                transform: translateZ(0);
                -webkit-backface-visibility: hidden;
                backface-visibility: hidden;
                margin-left: 0px !important;
            }

            .content-inner-1 {
                text-align: center
            }
        }

        /* Banner Slider Responsive Fixes */
        @media (max-width: 991px) {
            .main-slider.style-1 .banner-content {
                padding-top: 100px !important;
                padding-bottom: 40px !important;
                height: auto !important;
                min-height: 500px !important;
                /* Ensure enough height to see all content */
            }

            .main-slider.style-1 .swiper-content {
                padding-top: 0px !important;
                padding-left: 15px !important;
                height: 100% !important;
                justify-content: flex-start !important;
                background-color: transparent !important;
            }

            .main-slider.style-1 .main-swiper-thumb {
                width: 100% !important;
                margin-top: 20px !important;
                padding-left: 0 !important;
                overflow: visible !important;
            }

            .main-slider.style-1 .content-info .title {
                font-size: 26px !important;
                line-height: 1.1 !important;
                margin-bottom: 20px !important;
                display: block !important;
                visibility: visible !important;
                opacity: 1 !important;
                color: #000 !important;
            }

            .main-slider.style-1 .content-btn {
                margin-bottom: 25px !important;
                display: block !important;
            }

            .main-slider.style-1 .btn {
                padding: 10px 20px !important;
                font-size: 12px !important;
            }

            .main-slider.style-1 .bottom-content {
                margin-top: 30px !important;
                display: flex !important;
                flex-direction: row !important;
                align-items: center !important;
                gap: 10px;
                width: 200%;
                z-index: 10;
            }

            .main-slider.style-1 .bottom-content .star-icon {
                width: 30px !important;
                height: 30px !important;
                flex-shrink: 0;
            }

            .main-slider.style-1 .bottom-content .sub-title {
                font-size: 8px !important;
                display: block !important;
                opacity: 1 !important;
                visibility: visible !important;
                white-space: nowrap;
            }

            .main-slider.style-1 .bottom-content .title {
                font-size: 10px !important;
                display: block !important;
                opacity: 1 !important;
                visibility: visible !important;
                line-height: 1 !important;
                white-space: nowrap;
                margin-top: 2px;
            }

            .main-slider.style-1 .banner-media img {
                border-radius: 15px !important;
            }

            .main-slider.style-1 .banner-media:after {
                display: none !important;
            }

            /* Ensure WOW animations don't hide content on mobile */
            .main-slider .wow {
                visibility: visible !important;
                opacity: 1 !important;
                animation-name: none !important;
            }
        }

        /* Desktop and general alignment */
        .main-slider.style-1 .main-swiper-thumb {
            margin-left: 0 !important;
            margin-right: auto !important;
        }

        .content-info {
            background: #fff !important;
        }

        /* Consolidated repetitive content-inner classes to reduce CSS bloat */
        [class*="content-inner-"],
        section,
        .adv-area,
        .dz-features-wrapper,
        .main-slider.style-1,
        .swiper-btn-center-lr,
        .about-wraper,
        .about-content,
        .about-box,
        .dz-card,
        .dz-media,
        .shop-card,
        .swiper-container {
            background: #fff !important;
        }

        /* LCP Optimization: Ensure first slide is visible before JS init */
        .noberoSwiper .swiper-slide:first-child {
            visibility: visible !important;
            opacity: 1 !important;
            display: block !important;
        }

        .banner-content {
            position: relative;
        }

        /* Right-side design preserved: next slide + DARTE watermark intentionally visible */

        .dz-features-wrapper {
            background: #FFFFFF !important;
        }

        .star-2 {
            position: absolute !important;
            right: 2rem !important;
            bottom: 2rem !important;
            z-index: 1 !important;
            pointer-events: none !important;
        }

        @media screen and (max-width: 860px) {
            .class1 {
                padding-top: 25px;
                text-align: center;
            }
        }

        @media screen and (min-width: 850px) and (max-width: 1024px) {
            .class2 {
                padding-left: 247px !important;
            }
        }

        /* --- Discover New Arrivals Premium UI --- */
        .premium-product-card {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            cursor: pointer;
            isolation: isolate;
        }

        .premium-img-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
            border-radius: 20px;
        }

        .premium-img-wrapper img {
            transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .premium-product-card:hover .premium-img-wrapper img {
            transform: scale(1.08);
        }

        /* Vercel-core Glass Overlay */
        .premium-shop-overlay {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 16px;
            padding: 12px 16px;
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.6);
            transform: translateY(10px);
            opacity: 0;
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 10;
        }

        .premium-product-card:hover .premium-shop-overlay {
            transform: translateY(0);
            opacity: 1;
        }

        .premium-info-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .premium-product-name {
            font-family: 'Geist', 'Inter', sans-serif;
            font-size: 15px;
            font-weight: 600;
            color: #09090b; /* Zinc-950 */
            margin: 0;
            line-height: 1.2;
            letter-spacing: -0.01em;
            flex: 1;
        }

        .premium-shop-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            background: #09090b; /* Zinc-950 */
            color: #ffffff;
            font-size: 13px;
            font-weight: 600;
            font-family: 'Geist', 'Inter', sans-serif;
            padding: 8px 14px;
            border-radius: 10px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            white-space: nowrap;
        }

        .premium-shop-btn svg {
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .premium-shop-btn:hover {
            background: #27272a; /* Zinc-800 */
            color: #ffffff;
            transform: scale(1.02);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .premium-shop-btn:hover svg {
            transform: translateX(3px);
        }

        /* Mobile View: Make overlay visible by default */
        @media (max-width: 991px) {
            .premium-product-card {
                border-radius: 16px;
            }
            .premium-img-wrapper {
                border-radius: 16px;
            }
            .premium-shop-overlay {
                bottom: 12px;
                left: 12px;
                right: 12px;
                padding: 10px 12px;
                transform: translateY(0);
                opacity: 1; /* Always visible on touch screens */
                background: rgba(255, 255, 255, 0.92);
            }
            .premium-product-name {
                font-size: 13px;
            }
            .premium-shop-btn {
                padding: 6px 12px;
                font-size: 11px;
                border-radius: 8px;
            }
        }

        /* Spacing optimizations to reduce white space */
        .adv-area {
            padding: 0 !important;
        }
        .content-inner-3 {
            padding-top: 20px !important;
            padding-bottom: 20px !important;
        }

        /* Off-white background style for alternating sections */
        .bg-off-white,
        section.bg-off-white,
        .bg-off-white .shop-card,
        .bg-off-white .swiper-btn-center-lr,
        .bg-off-white .dz-media {
            background: #FAF9F6 !important;
        }

        /* Premium Banner Spacings and Background */
        section.banner-section {
            padding-top: 60px !important;
            padding-bottom: 60px !important;
            background-color: #F5EFEB !important;
        }

        section.banner-section .swiper-slide,
        section.banner-section .container-fluid {
            background-color: #F5EFEB !important;
        }

        /* Option 2: Classic Editorial Style overrides */
        @media (min-width: 992px) {
            .banner-content {
                max-width: 600px !important;
                margin-left: auto !important;
                margin-right: auto !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
            }
        }

        @media (max-width: 991px) {
            .banner-content {
                text-align: center !important;
                padding-left: 15px !important;
                padding-right: 15px !important;
            }
            .banner-content p {
                margin-left: auto !important;
                margin-right: auto !important;
                text-align: center !important;
                max-width: 90% !important;
            }
            .banner-content .content-btn {
                text-align: center !important;
            }
            .banner-content .content-btn a {
                display: inline-block !important;
            }
        }

        .banner-content .luxury-heading {
            font-family: 'Poppins', sans-serif !important;
            font-weight: 700 !important;
            font-size: clamp(34px, 4.8vw, 54px) !important;
            letter-spacing: 2px !important;
            line-height: 1.15 !important;
            margin-bottom: 20px !important;
            text-transform: uppercase !important;
        }

        .banner-content p {
            font-family: 'Inter', sans-serif !important;
            font-size: 16px !important;
            font-weight: 400 !important;
            color: #444 !important;
            letter-spacing: 0.5px !important;
            line-height: 1.7 !important;
            max-width: 95% !important;
            margin-bottom: 30px !important;
        }

        /* Luxury Solid Rectangular Button with sharp corners */
        .banner-content .content-btn a {
            border-radius: 0px !important; /* Sharp corners */
            font-family: 'Inter', sans-serif !important;
            font-weight: 600 !important;
            font-size: 13px !important;
            letter-spacing: 2px !important;
            background-color: #111 !important;
            border-color: #111 !important;
            color: #ffffff !important;
            padding: 14px 40px !important;
            text-transform: uppercase !important;
            transition: all 0.3s ease !important;
        }

        .banner-content .content-btn a:hover {
            background-color: #000000 !important;
            border-color: #000000 !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12) !important;
        }

        /* Image padding and spacing to prevent top/bottom clipping */
        .banner-media {
            padding: 20px !important;
            margin-top: 30px !important;
            margin-bottom: 30px !important;
            border: none !important; /* Remove border frame so the rounded image floats cleanly */
            background-color: transparent !important;
        }

        .banner-media img {
            width: auto !important;
            max-height: 460px !important; /* Constrained height to prevent top overlap/clipping */
            border-radius: 20px !important; /* Keep the beautiful rounded corners of the image */
            filter: contrast(1.02) brightness(0.98) !important;
        }

        /* --- Promo Split Section overrides (.adv-area) --- */
        
        /* General fonts for both cards */
        .adv-area .badge.style-1 {
            font-family: 'Inter', sans-serif !important;
            font-weight: 600 !important;
            letter-spacing: 1px !important;
            text-transform: uppercase !important;
        }

        .adv-area .sale-name,
        .adv-area .product-name {
            font-family: 'Poppins', sans-serif !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 2px !important;
            line-height: 1.15 !important;
        }

        /* Left side circular badge vertical centering & style */
        @media (min-width: 992px) {
            .adv-area .product-box.style-circle .sale-box {
                display: flex !important;
                flex-direction: column !important;
                justify-content: center !important;
                align-items: center !important;
                padding: 40px !important;
                background-color: #ffffff !important;
                border-radius: 50% !important;
            }
            .adv-area .product-box.style-circle .sale-box .badge.style-1 {
                font-size: 14px !important;
                margin-top: 0 !important;
                margin-bottom: 12px !important;
            }
            .adv-area .product-box.style-circle .sale-box .sale-name {
                font-size: clamp(28px, 4vw, 38px) !important;
                margin-top: 0 !important;
                margin-bottom: 20px !important;
            }
            .adv-area .product-box.style-circle .sale-box .btn {
                margin: 0 !important;
            }
        }

        /* Right side content position and padding */
        @media (min-width: 992px) {
            .adv-area .product-box:not(.style-circle) .product-content {
                padding: 60px !important;
                display: flex !important;
                flex-direction: column !important;
                justify-content: center !important;
                height: 100% !important;
            }
            .adv-area .product-box:not(.style-circle) .product-content .badge.style-1 {
                font-size: 14px !important;
                margin-bottom: 12px !important;
            }
            .adv-area .product-box:not(.style-circle) .product-content .product-name {
                font-size: clamp(28px, 4vw, 38px) !important;
                margin-bottom: 25px !important;
            }
        }

        /* CTA Buttons matching hero banner style */
        .adv-area .btn {
            border-radius: 0px !important; /* Sharp corners */
            font-family: 'Inter', sans-serif !important;
            font-weight: 600 !important;
            font-size: 13px !important;
            letter-spacing: 2px !important;
            text-transform: uppercase !important;
            padding: 14px 35px !important;
            transition: all 0.3s ease !important;
            display: inline-block !important;
        }

        /* Outlined Button (Left Circle Card) */
        .adv-area .btn-outline-secondary {
            border: 2px solid #111 !important;
            background-color: transparent !important;
            color: #111 !important;
        }
        .adv-area .btn-outline-secondary:hover {
            background-color: #111 !important;
            color: #ffffff !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12) !important;
        }

        /* Solid Button (Right Card) */
        .adv-area .btn-secondary {
            background-color: #111 !important;
            border-color: #111 !important;
            color: #ffffff !important;
        }
        .adv-area .btn-secondary:hover {
            background-color: #000000 !important;
            border-color: #000000 !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12) !important;
        }

        /* Responsive spacing/sizes for mobile & tablet */
        @media (max-width: 991px) {
            .adv-area .badge.style-1 {
                font-size: 12px !important;
                margin-bottom: 8px !important;
            }
            .adv-area .sale-name,
            .adv-area .product-name {
                font-size: 24px !important;
                margin-bottom: 15px !important;
            }
            .adv-area .btn {
                padding: 10px 24px !important;
                font-size: 11px !important;
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
    <div class="page-content bg-white">




        <section class="banner-section relative group overflow-hidden" style="background-color: #F5EFEB !important;">
            <div class="swiper noberoSwiper">
                <div class="swiper-wrapper">
                    @foreach ($bannerImages as $banner)
                        <div class="swiper-slide">
                            <div class="container-fluid px-6 md:px-20">
                                <div class="row g-0 align-items-center flex-row-reverse min-vh-75 py-10">

                                    <!-- Right side: model image -->
                                    <div class="col-lg-6 col-md-12 text-center">
                                        <div class="banner-media relative inline-block p-5 md:p-12">
                                            @php
                                                $bannerImageUrl = env('MAIN_URL') . 'images/' . $banner->image;
                                            @endphp
                                            <img src="{{ $bannerImageUrl }}" alt="banner-media"
                                                class="object-contain transition-all duration-500"
                                                fetchpriority="high" loading="eager"
                                                style="width: 85%; max-height: 550px; margin: 0 auto; filter: contrast(1.05);"
                                                width="600" height="808">
                                        </div>
                                    </div>

                                    <!-- Left side: text content -->
                                    <div class="col-lg-6 col-md-12">
                                        <div class="banner-content text-left pe-lg-5 ps-lg-5">
                                            <!-- Title -->
                                            <h1 class="luxury-heading wow fadeInUp" data-wow-delay="0.2s" style="margin-bottom: 25px;">
                                                {{ $banner->title }}
                                            </h1>

                                            <!-- Description -->
                                            <p class="wow fadeInUp mb-4" data-wow-delay="0.4s"
                                                style="font-size: 16px; line-height: 1.6; color: #555; font-weight: 400; max-width: 95%; margin-bottom: 30px;">
                                                {{ $banner->content }}
                                            </p>

                                            <!-- Button -->
                                            <div class="content-btn wow fadeInUp" data-wow-delay="0.6s">
                                                <a href="/shop"
                                                    class="btn btn-primary px-10 py-3 font-bold transition-all uppercase tracking-widest"
                                                    style="letter-spacing: 2px;">
                                                    {{ $banner->subtitle }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="nobero-pagination absolute bottom-10 left-0 right-0 z-50 flex justify-center gap-3"></div>
            </div>
        </section>

        <style>
            .min-vh-75 {
                min-height: 75vh;
            }

            .banner-content h1 {
                /* Inheriting luxury Playfair Display from skin-1.css */
            }

            .nobero-pagination {
                bottom: 40px !important;
                position: absolute !important;
                cursor: pointer;
            }

            .nobero-pagination .swiper-pagination-bullet {
                width: 15px;
                height: 6px;
                background: #F5F5F5;
                border-radius: 10px;
                transition: all 0.4s ease;
                opacity: 1;
                cursor: pointer !important;
            }

            .nobero-pagination .swiper-pagination-bullet-active {
                width: 40px;
                background: #000 !important;
            }

            .banner-content h1 {
                color: #000000;
            }

            .min-vh-75 {
                min-height: 75vh;
            }

            .banner-media img {
                display: block;
                margin: 0 auto;
                max-width: 100%;
                height: auto !important;
            }

            @media (max-width: 767px) {
                .banner-media img {
                    width: 80% !important;
                    max-height: 340px !important;
                    border-radius: 20px;
                    margin-top: 20px !important;
                }

                .swiper-horizontal>.swiper-pagination-bullets,
                .swiper-pagination-bullets.swiper-pagination-horizontal,
                .swiper-pagination-custom,
                .swiper-pagination-fraction {
                    position: relative !important;
                    bottom: 40px !important;
                    left: 0 !important;
                    width: 100% !important;
                    /* display: flex !important; */
                    justify-content: center !important;
                    top: auto !important;
                    display: none;
                }



                .banner-media {
                    padding: 10px !important;
                    margin-top: 30px;
                }
            }

            @media (max-width: 991px) {

                .swiper-horizontal>.swiper-pagination-bullets,
                .swiper-pagination-bullets.swiper-pagination-horizontal,
                .swiper-pagination-custom,
                .swiper-pagination-fraction {
                    position: relative !important;
                    bottom: 40%;
                    left: 42%;
                    top: 3px;
                }
            }

            @media (min-width: 992px) {
                .banner-media img {
                    width: 85% !important;
                    max-height: 595px !important;
                    border-radius: 20px !important;
                }
            }

            .nobero-pagination {
                position: absolute !important;
                bottom: 30px !important;
                z-index: 99;
                cursor: pointer;
            }

            .nobero-pagination .swiper-pagination-bullet {
                width: 15px;
                height: 6px;
                background: #F5F5F5;
                border-radius: 10px;
                transition: all 0.3s ease;
                opacity: 1;
                cursor: pointer;
            }

            .nobero-pagination .swiper-pagination-bullet-active {
                width: 40px;
                background: #000 !important;
            }

            @media screen and (max-width: 400px) {
                .adv-area .product-box.style-circle .sale-box .badge.style-1 {
                    font-size: 11px !important;
                }
            }
            /* Removed duplicate/conflicting mobile relative styles to preserve circle layout */
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const noberoSwiper = new Swiper('.noberoSwiper', {
                    loop: true,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    speed: 1000,
                    pagination: {
                        el: '.nobero-pagination',
                        clickable: true,
                    },
                    watchSlidesProgress: true,
                    observer: true,
                    observeParents: true,
                });
            });
        </script>



        <!-- Category Structure Start -->
        <section class="content-inner" style="background: #ffffff; border-top: 1px solid #F5F5F5;">
            <div class="container">
                <div class="section-head style-1 text-center wow fadeInUp" data-wow-delay="0.2s">
                    <h2 class="title">Discover our collections</h2>
                    <p class="para-text">Curated selections for every style and occasion.</p>
                </div>

                <div class="swiper category-carousel-v2 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="swiper-wrapper">
                        @if (isset($homeCategories))
                            @foreach ($homeCategories as $category)
                                @php
                                    $categoryImageUrl = !empty($category->category_image)
                                        ? (str_starts_with($category->category_image, 'http')
                                            ? $category->category_image
                                            : rtrim(env('MAIN_URL'), '/') . '/images/' . ltrim($category->category_image, '/'))
                                        : asset('assets/images/shop/product/medium/1.webp');
                                @endphp
                                <div class="swiper-slide">
                                    <div class="category-card text-center px-2">
                                        <a href="{{ route('shop', ['category' => $category->id]) }}"
                                            class="d-block mb-3 overflow-hidden rounded-0">
                                            <div class="dz-media" style="aspect-ratio: 4/5; transition: all 0.5s ease;">
                                                <img src="{{ $categoryImageUrl }}" alt="{{ $category->category_name }}"
                                                    style="width: 100%; height: 100%; object-fit: cover;"
                                                    class="img-fluid transform-hover" loading="lazy" width="280" height="350">
                                            </div>
                                        </a>
                                        <div class="category-info">
                                            <h4 class="title mb-0">
                                                <a href="{{ route('shop', ['category' => $category->id]) }}"
                                                    class="text-uppercase small fw-bold letter-spacing-1 text-dark">
                                                    {{ $category->category_name }}
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <!-- No pagination dots as requested -->
                </div>
            </div>
        </section>
        <!-- Category Structure End -->


        <section class="content-inner-1 overflow-hidden bg-off-white">
            <div class="container">
                <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-center m-b30">
                    <div class="section-head style-1 mb-3 mb-md-0 wow fadeInUp text-center text-md-start" data-wow-delay="0.2s">
                        <div class="left-content">
                            <h2 class="title">Our best sellers</h2>
                            <p class="text-black mb-0">Discover the most popular products in Darte</p>
                        </div>
                    </div>
                    <div class="text-center text-md-end">
                        <a class="btn btn-secondary" href="/shop">View All</a>
                    </div>
                </div>

                <div class="swiper-btn-center-lr">
                    <div class="swiper swiper-four">
                        <div class="swiper-wrapper">
                            @foreach ($trendingProducts as $variant)
                                @php $product = $variant->product; @endphp
                                <div class="swiper-slide">
                                    <div class="shop-card wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="dz-media">
                                            <img src="{{ env('MAIN_URL') . 'images/' . $variant->varient_img }}" alt="image" loading="lazy" width="300" height="375">
                                            <div class="shop-meta">
                                                <a href="{{ route('shop.details', $product->slug) }}"
                                                    class="btn btn-secondary btn-md btn-rounded">
                                                    <i class="fa-solid fa-eye d-md-none d-block"></i>
                                                    <span class="d-md-block d-none">Quick View</span>
                                                </a>
                                                <div class="btn btn-primary meta-icon dz-wishicon"
                                                    data-product-id="{{ $product->id }}" data-variant-id="{{ $variant->id }}">
                                                    <i class="icon feather icon-heart dz-heart"></i>
                                                    <i class="icon feather icon-heart-on dz-heart-fill"></i>
                                                </div>
                                                <div class="btn btn-primary meta-icon dz-carticon"
                                                    data-product-id="{{ $product->id }}" data-variant-id="{{ $variant->id }}"
                                                    onclick="addToCart({{ $product->id }}, {{ $variant->id }})">
                                                    <i class="flaticon flaticon-basket"></i>
                                                    <i class="flaticon flaticon-basket-on dz-heart-fill"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dz-content">
                                            <h5 class="title"><a href="{{ route('shop.details', $product->slug) }}">{{ $variant->varient_name ?? $product->product_name }}</a>
                                            </h5>
                                            <h5 class="price">₹{{ $variant->offer_price }}
                                                @if($variant->mrp_price > $variant->offer_price)
                                                    <del>₹{{ $variant->mrp_price }}</del>
                                                @endif
                                            </h5>
                                        </div>
                                        @if ($variant->mrp_price > $variant->offer_price)
                                            <div class="product-tag">
                                                @php
                                                    $discount = round(
                                                        (($variant->mrp_price - $variant->offer_price) /
                                                            $variant->mrp_price) *
                                                        100,
                                                    );
                                                @endphp
                                                <span class="badge ">Get {{ $discount }}% Off</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="adv-area overflow-hidden">

            <div class="container-fluid px-0">
                <div class="row product-style2 g-0">
                    @if (isset($giftCategories))
                        @foreach ($giftCategories as $index => $cat)
                            @if ($index == 0)
                                <div class="col-lg-6 col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product-box style-4 style-circle">
                                        <div class="product-media"
                                            style="background-image: url('{{ env('MAIN_URL') . 'images/' . $cat->category_image }}');">
                                        </div>
                                        <div class="sale-box">
                                            <div class="badge style-1 mb-1">{{ $cat->banner_title }}</div>
                                            <h2 class="sale-name">{{ $cat->banner_description }}</h2>
                                            <a href="/shop" class="btn btn-outline-secondary btn-lg text-uppercase">Shop
                                                Now</a>
                                        </div>
                                    </div>
                                </div>
                            @elseif($index == 1)
                                <div class="col-lg-6 col-md-12 wow fadeInUp" data-wow-delay="0.2s">
                                    <div class="product-box style-4">
                                        <div class="product-media"
                                            style="background-image: url('{{ env('MAIN_URL') . 'images/' . $cat->category_image }}');">
                                        </div>
                                        <div class="product-content">
                                            <div class="main-content">
                                                <div class="badge style-1 mb-3">{{ $cat->banner_title }}</div>
                                                <h2 class="product-name">{{ $cat->banner_description }}</h2>
                                            </div>
                                            <a href="/shop" class="btn btn-secondary btn-lg text-uppercase">Shop
                                                Now</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </section>



        <section class="content-inner-3 overflow-hidden">
            <!-- Dz Silder Start-->
            <div class="dz-features-wrapper overflow-hidden">
                <ul class="dz-features text-wrapper">
                    @if (isset($allProducts))
                        @foreach ($allProducts as $product)
                            <li class="item">
                                <h2 class="title">{{ $product->product_name }}</h2>
                            </li>
                            <li class="item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="61" height="60" viewBox="0 0 61 60" fill="none">
                                    <path opacity="0.3"
                                        d="M29.302 -0.00499268L38.533 21.2005L60.3307 28.9297L39.1253 38.1607L31.396 59.9585L22.165 38.753L0.367297 31.0237L21.5728 21.7928L29.302 -0.00499268Z"
                                        fill="black" />
                                </svg>
                            </li>
                        @endforeach
                        {{-- Repeat for smooth scrolling --}}
                        @foreach ($allProducts as $product)
                            <li class="item">
                                <h2 class="title">{{ $product->product_name }}</h2>
                            </li>
                            <li class="item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="61" height="60" viewBox="0 0 61 60" fill="none">
                                    <path opacity="0.3"
                                        d="M29.302 -0.00499268L38.533 21.2005L60.3307 28.9297L39.1253 38.1607L31.396 59.9585L22.165 38.753L0.367297 31.0237L21.5728 21.7928L29.302 -0.00499268Z"
                                        fill="black" />
                                </svg>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </section>


        <section class="content-inner overflow-hidden">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-12 m-b30">
                        <div class="swiper about-main-swiper dz-media style-2 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="swiper-wrapper">
                                @if ($popularProducts->isNotEmpty())
                                    @php $mainProduct = $popularProducts->last(); @endphp
                                    <div class="swiper-slide">
                                        <div class="premium-product-card h-100" style="border-radius: 30px;">
                                            <div class="premium-img-wrapper" style="border-radius: 30px;">
                                                <img src="{{ env('MAIN_URL') . 'images/' . $mainProduct->varient_img }}"
                                                    alt="image" loading="lazy" width="400" height="500" class="w-100 object-cover" style="min-height: 400px;">
                                            </div>
                                            <div class="premium-shop-overlay">
                                                <div class="premium-info-container">
                                                    <h5 class="premium-product-name text-truncate" title="{{ $mainProduct->varient_name ?? $mainProduct->product->product_name }}">
                                                        {{ $mainProduct->varient_name ?? $mainProduct->product->product_name }}
                                                    </h5>
                                                    <a class="premium-shop-btn"
                                                        href="{{ route('shop.details', $mainProduct->product->slug) }}">
                                                        <span>Shop</span>
                                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M5 12h14"></path>
                                                            <path d="m12 5 7 7-7 7"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 m-b30">
                        <div class="about-wraper   position-relative">
                            <div class="section-head style-1 wow fadeInUp d-flex flex-column flex-md-row justify-content-md-between align-items-center mb-4"
                                data-wow-delay="0.4s">
                                <h3 class="title mb-3 mb-md-0 text-center text-md-start">Discover New Arrivals</h3>
                                <a class="service-btn-2 wow fadeInUp position-relative light d-flex"
                                    data-wow-delay="0.6s" href="/shop">
                                    <span class="icon-wrapper">
                                        <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.832 31.1663L31.1654 12.833" stroke="var(--title)" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path d="M12.832 12.833H31.1654V31.1663" stroke="var(--title)" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                        </svg>
                                    </span>
                                </a>
                            </div>

                            <div class="swiper testimonial-swiper about-swiper m-b30">
                                <div class="swiper-wrapper">
                                    @foreach ($popularProducts as $variant)
                                        @php $product = $variant->product; @endphp
                                        <div class="swiper-slide">
                                            <div class="about-box premium-product-card">
                                                <div class="about-img premium-img-wrapper">
                                                    <img src="{{ env('MAIN_URL') . 'images/' . $variant->varient_img }}"
                                                        alt="image" loading="lazy" width="300" height="375">
                                                </div>
                                                <div class="premium-shop-overlay">
                                                    <div class="premium-info-container">
                                                        <h5 class="premium-product-name text-truncate" title="{{ $variant->varient_name ?? $product->product_name }}">
                                                            {{ $variant->varient_name ?? $product->product_name }}
                                                        </h5>
                                                        <a class="premium-shop-btn"
                                                            href="{{ route('shop.details', $product->slug) }}">
                                                            <span>Shop</span>
                                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M5 12h14"></path>
                                                                <path d="m12 5 7 7-7 7"></path>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex gap-3">
                                    <div class="testimonial-button-prev">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40"
                                            fill="none">
                                            <path
                                                d="M36.8751 19.372H4.6659L12.288 11.9623C12.8705 11.3965 12.0066 10.4958 11.4164 11.0663C11.4164 11.0663 2.68932 19.5502 2.68932 19.5502C2.43467 19.7821 2.45495 20.2007 2.68935 20.4462C2.68932 20.4462 11.4164 28.9337 11.4164 28.9337C12.0038 29.4974 12.8725 28.6135 12.288 28.0377C12.288 28.0377 4.66308 20.622 4.66308 20.622H36.8751C37.6738 20.6144 37.7149 19.3872 36.8751 19.372Z"
                                                fill="black" />
                                        </svg>
                                    </div>
                                    <div class="testimonial-button-next">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40"
                                            fill="none">
                                            <path
                                                d="M3.12489 19.372H35.3341L27.712 11.9623C27.1295 11.3965 27.9934 10.4958 28.5836 11.0663L37.3107 19.5502C37.5653 19.7821 37.5451 20.2007 37.3107 20.4462L28.5836 28.9337C27.9962 29.4973 27.1275 28.6135 27.712 28.0377L35.3369 20.622H3.12489C2.32618 20.6144 2.28506 19.3872 3.12489 19.372Z"
                                                fill="black" />
                                        </svg>
                                    </div>
                                </div>
                                <div
                                    class="swiper-pagination style-1 text-end swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
                                    <span class="swiper-pagination-bullet" tabindex="0">01</span>
                                    <span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0"
                                        aria-current="true">02</span>
                                    <span class="swiper-pagination-bullet" tabindex="0">03</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>







        <!-- <section class="content-inner-2">
                                                                                                                                                                                                                                                                                <div class="container">
                                                                                                                                                                                                                                                                                    <div class="section-head style-1 wow fadeInUp d-flex  justify-content-between" data-wow-delay="0.2s">
                                                                                                                                                                                                                                                                                        <div class="left-content">
                                                                                                                                                                                                                                                                                            <h2 class="title">Sponsored</h2>
                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                        <a href="#" class="text-primary font-14 d-flex align-items-center gap-1">See All
                                                                                                                                                                                                                                                                                            <i class="icon feather icon-chevron-right font-18"></i>
                                                                                                                                                                                                                                                                                        </a>
                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                    <div class="swiper swiper-company">
                                                                                                                                                                                                                                                                                        <div class="swiper-wrapper ">
                                                                                                                                                                                                                                                                                            <div class="swiper-slide">
                                                                                                                                                                                                                                                                                                <div class="company-box style-1 wow fadeInUp" data-wow-delay="0.4s">
                                                                                                                                                                                                                                                                                                    <div class="dz-media">
                                                                                                                                                                                                                                                                                                        <img src="assets/images/company/1.webp" alt="image" class="company-img">
                                                                                                                                                                                                                                                                                                        <img src="assets/images/company/logo/logo1.webp" alt="image" class="logo">
                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                    <div class="dz-content">
                                                                                                                                                                                                                                                                                                        <h6 class="title">Outdoor Shoes </h6>
                                                                                                                                                                                                                                                                                                        <span class="sale-title">Min. 30% Off</span>
                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                            <div class="swiper-slide">
                                                                                                                                                                                                                                                                                                <div class="company-box style-1 wow fadeInUp" data-wow-delay="0.6s">
                                                                                                                                                                                                                                                                                                    <div class="dz-media">
                                                                                                                                                                                                                                                                                                        <img src="assets/images/company/2.webp" alt="image" class="company-img">
                                                                                                                                                                                                                                                                                                        <img src="assets/images/company/logo/logo2.webp" alt="image" class="logo">
                                                                                                                                                                                                                                                                                                        <span class="sale-badge">in Store</span>
                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                    <div class="dz-content">
                                                                                                                                                                                                                                                                                                        <h6 class="title">Best Cloths</h6>
                                                                                                                                                                                                                                                                                                        <span class="sale-title">Up To 20% Off</span>
                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                            <div class="swiper-slide">
                                                                                                                                                                                                                                                                                                <div class="company-box style-1 wow fadeInUp" data-wow-delay="0.8s">
                                                                                                                                                                                                                                                                                                    <div class="dz-media">
                                                                                                                                                                                                                                                                                                        <img src="assets/images/company/1.webp" alt="image" class="company-img">
                                                                                                                                                                                                                                                                                                        <img src="assets/images/company/logo/logo3.webp" alt="image" class="logo">
                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                    <div class="dz-content">
                                                                                                                                                                                                                                                                                                        <h6 class="title">Sports Shoes</h6>
                                                                                                                                                                                                                                                                                                        <span class="sale-title">up to 30% Off</span>
                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                            <div class="swiper-slide">
                                                                                                                                                                                                                                                                                                <div class="company-box style-1 wow fadeInUp" data-wow-delay="1.0s">
                                                                                                                                                                                                                                                                                                    <div class="dz-media">
                                                                                                                                                                                                                                                                                                        <img src="assets/images/company/3.webp" alt="image" class="company-img">
                                                                                                                                                                                                                                                                                                        <img src="assets/images/company/logo/logo4.webp" alt="image" class="logo">
                                                                                                                                                                                                                                                                                                        <span class="sale-badge">in Store</span>
                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                    <div class="dz-content">
                                                                                                                                                                                                                                                                                                        <h6 class="title">modern jewellery</h6>
                                                                                                                                                                                                                                                                                                        <span class="sale-title">Min. 30% Off</span>
                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                            <div class="swiper-slide">
                                                                                                                                                                                                                                                                                                <div class="company-box style-1 wow fadeInUp" data-wow-delay="1.2s">
                                                                                                                                                                                                                                                                                                    <div class="dz-media">
                                                                                                                                                                                                                                                                                                        <img src="assets/images/company/1.webp" alt="image" class="company-img">
                                                                                                                                                                                                                                                                                                        <img src="assets/images/company/logo/logo1.webp" alt="image" class="logo">
                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                    <div class="dz-content">
                                                                                                                                                                                                                                                                                                        <h6 class="title">Outdoor Shoes </h6>
                                                                                                                                                                                                                                                                                                        <span class="sale-title">Min. 30% Off</span>
                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                            <div class="swiper-slide">
                                                                                                                                                                                                                                                                                                <div class="company-box style-1 wow fadeInUp" data-wow-delay="1.4s">
                                                                                                                                                                                                                                                                                                    <div class="dz-media">
                                                                                                                                                                                                                                                                                                        <img src="assets/images/company/2.webp" alt="image" class="company-img">
                                                                                                                                                                                                                                                                                                        <img src="assets/images/company/logo/logo2.webp" alt="image" class="logo">
                                                                                                                                                                                                                                                                                                        <span class="sale-badge">in Store</span>
                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                    <div class="dz-content">
                                                                                                                                                                                                                                                                                                        <h6 class="title">Best Cloths</h6>
                                                                                                                                                                                                                                                                                                        <span class="sale-title">Up To 20% Off</span>
                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                            </section> -->



        {{-- <section class="content-inner">
            <div class="container">

                <!-- HEADER -->
                <div class="section-head style-1 d-md-flex justify-content-between align-items-center">
                    <div class="left-content">
                        <h2 class="title">Latest Post</h2>
                        <p>Discover the most trending products.</p>
                    </div>

                    <a class="btn btn-secondary" href="{{ route('blog.list') }}">
                        View All
                    </a>
                </div>

                <div class="row blog-shap"> --}}

                    {{-- ================= LEFT BIG BLOG ================= --}}
                    {{-- @if ($blogs->count() > 0)
                    @php $mainBlog = $blogs[0]; @endphp

                    <div class="col-lg-6 col-md-12 m-b30">
                        <div class="dz-card style-1 light">

                            <div class="dz-media">
                                <a href="{{ route('blog.details', $mainBlog->url_name) }}">
                                    <img src="{{ env('MAIN_URL') . 'uploads/blogs/' . $mainBlog->image }}" alt="">
                                </a>
                            </div>

                            <div class="dz-info bg-white">

                                <div class="dz-meta">
                                    <ul>
                                        <li class="post-date">
                                            {{ \Carbon\Carbon::parse($mainBlog->date)->format('d M Y') }}
                                        </li>
                                    </ul>
                                </div>

                                <h3 class="dz-title">
                                    <a href="{{ route('blog.details', $mainBlog->url_name) }}">
                                        {{ $mainBlog->title }}
                                    </a>
                                </h3> --}}

                                <!-- SHORT DESCRIPTION -->
                                {{-- <p>
                                    {{ \Illuminate\Support\Str::limit(strip_tags($mainBlog->description), 120) }}
                                </p> --}}

                                {{-- <a href="{{ route('blog.details', $mainBlog->url_name) }}" class="font-14 read-btn">
                                    Read More <i class="icon feather icon-chevron-right"></i>
                                </a>

                            </div>
                        </div>
                    </div>
                    @endif --}}


                    {{-- ================= RIGHT SMALL BLOGS ================= --}}
                    {{-- <div class="col-lg-6 col-md-12">
                        <div class="row">

                            @foreach ($blogs->skip(1) as $blog)
                            <div class="col-lg-12 col-md-6 m-b30">
                                <div class="dz-card blog-half style-7">

                                    <div class="dz-media">
                                        <a href="{{ route('blog.details', $blog->url_name) }}">
                                            <img src="{{ env('MAIN_URL') . 'uploads/blogs/' . $blog->image }}" alt="">
                                        </a>
                                    </div>

                                    <div class="dz-info">

                                        <div class="dz-meta">
                                            <ul>
                                                <li class="post-date">
                                                    {{ \Carbon\Carbon::parse($blog->date)->format('d M Y') }}
                                                </li>
                                            </ul>
                                        </div>

                                        <h4 class="dz-title">
                                            <a href="{{ route('blog.details', $blog->url_name) }}">
                                                {{ $blog->title }}
                                            </a>
                                        </h4> --}}

                                        {{-- <p>
                                            {{ \Illuminate\Support\Str::limit(strip_tags($blog->description), 80) }}
                                        </p> --}}
                                        {{--
                                        <a href="{{ route('blog.details', $blog->url_name) }}" class="font-14 read-btn">
                                            Read More <i class="icon feather icon-chevron-right"></i>
                                        </a>

                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>

                </div>
            </div>
        </section>--}}

        <div class="content-inner py-0 image-wrapper">
            <div class="container-fluid px-0">
                <div class="swiper-container swiper-insta" >
                    <div class="swiper-wrapper linear-moving ">
                        @foreach ($instaPosts as $key => $post)
                            <div class="swiper-slide" >
                                <div class="insta-post dz-media dz-img-effect rotate" style="margin-right:10px;">
                                    <a href="{{ $post->link_url ?? '#' }}" target="_blank">
                                        <img src="{{ env('MAIN_URL') . 'images/' . $post->bg_image }}" alt="Instagram Post" loading="lazy" width="200" height="200">
                                        <div class="insta-icon">
                                            <i class="fab fa-instagram"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- Follow Button --}}
                    <a href="{{ $instaPosts->first()->link_url ?? '#' }}" class="instagram-link" target="_blank">
                        <div class="follow-link wow bounceIn" data-wow-delay="0.1s">
                            {{-- <div class="follow-link-icon">
                                <img src="{{ asset('assets/images/insta-follow.webp') }}" alt="">
                            </div> --}}
                            {{-- <div class="follow-link-content">
                                <p class="m-0">Follow @Darte</p>
                            </div> --}}
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>


    {{-- <section class="content-inner-3 overflow-hidden " id="Maping" style="margin-top: 20px">
        <div class="container-fluid p-0">
            <div class="row align-items-start">
                <div class="col-xl-7 col-lg-12 col-md-12">
                    <div class="map-area">
                        <img src="assets/images/map/map2.webp" alt="image">
                        <div class="map-line" id="map-line" style="height: 96%;"><img src="assets/images/map/map-line.webp"
                                alt="image"></div>
                        @if ($reviews->count() > 0)
                        <div class="loction-b wow" data-wow-delay="0.2s"
                            style="visibility: visible; animation-delay: 0.2s; animation-name: updown-2;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="47" viewBox="0 0 35 47" fill="none">
                                <path
                                    d="M17.8211 5.10059C11.2718 5.10059 5.96484 10.4115 5.96484 16.9568C5.96484 23.5061 11.2757 28.8131 17.8211 28.8131C24.3704 28.8131 29.6773 23.5061 29.6773 16.9568C29.6773 10.4075 24.3704 5.10059 17.8211 5.10059ZM17.8211 26.8761C12.3435 26.8761 7.90185 22.4344 7.90185 16.9568C7.90185 11.4792 12.3395 7.0376 17.8211 7.0376C23.2987 7.0376 27.7403 11.4792 27.7403 16.9568C27.7403 22.4344 23.2987 26.8761 17.8211 26.8761Z"
                                    fill="black"></path>
                                <path
                                    d="M17.8227 2.75879C9.8603 2.75879 3.40625 9.21284 3.40625 17.1752C3.40625 17.5404 3.42213 17.9135 3.45388 18.2946C4.36681 29.1267 17.8187 46.7583 17.8187 46.7583C17.8187 46.7583 30.1592 30.5795 32.0049 19.6957C32.1557 18.8185 32.2351 17.973 32.2351 17.1713C32.2391 9.21284 25.7851 2.75879 17.8227 2.75879ZM17.8227 27.666C13.2461 27.666 9.34033 24.7962 7.80422 20.7595C7.35172 19.5727 7.10562 18.2906 7.10562 16.945C7.10562 11.0268 11.9045 6.22794 17.8227 6.22794C23.7409 6.22794 28.5397 11.0268 28.5397 16.945C28.5397 18.6121 28.1587 20.1919 27.4799 21.601C25.7493 25.1932 22.0738 27.666 17.8227 27.666Z"
                                    fill="black"></path>
                                <path
                                    d="M17.8242 2.75879V6.23191C23.7424 6.23191 28.5413 11.0308 28.5413 16.949C28.5413 18.6161 28.1602 20.1958 27.4815 21.6049C25.7509 25.1932 22.0753 27.67 17.8242 27.67V46.7622C17.8242 46.7622 30.1647 30.5834 32.0104 19.6997C32.1613 18.8225 32.2407 17.977 32.2407 17.1752C32.2407 9.21284 25.7866 2.75879 17.8242 2.75879Z"
                                    fill="black"></path>
                                <path
                                    d="M26.3002 25.437C30.983 20.7542 30.983 13.1618 26.3002 8.47904C21.6174 3.79623 14.0251 3.79623 9.34225 8.47904C4.65945 13.1618 4.65945 20.7542 9.34226 25.437C14.0251 30.1198 21.6174 30.1198 26.3002 25.437Z"
                                    stroke="white" stroke-width="0.5007" stroke-miterlimit="10"></path>
                                <path opacity="0.39"
                                    d="M32.239 17.1752C32.239 17.973 32.1597 18.8185 32.0088 19.6997C30.6513 20.4578 29.1311 21.1008 27.4799 21.6049C28.1586 20.1958 28.5397 18.6161 28.5397 16.949C28.5397 11.0308 23.7408 6.23191 17.8226 6.23191C11.9044 6.23191 7.10556 11.0308 7.10556 16.949C7.10556 18.2906 7.35166 19.5766 7.80415 20.7634C6.16881 20.0807 4.70414 19.2432 3.45779 18.2946C3.42603 17.9135 3.41016 17.5404 3.41016 17.1752C3.41016 9.21284 9.86421 2.75879 17.8266 2.75879C25.785 2.75879 32.239 9.21284 32.239 17.1752Z"
                                    fill="white"></path>
                                <path
                                    d="M17.9283 23.1084H14.0781V10.9187C15.7174 10.8472 16.9003 10.8115 17.6267 10.8115C18.9603 10.8115 19.9923 11.0695 20.7227 11.5895C21.453 12.1095 21.8182 12.8517 21.8182 13.8163C21.8182 14.3839 21.584 14.8999 21.1196 15.3643C20.6512 15.8287 20.1352 16.1224 19.5716 16.2375C20.6393 16.4717 21.4173 16.8567 21.9055 17.3926C22.3938 17.9324 22.6399 18.6628 22.6399 19.5876C22.6399 20.6593 22.2072 21.5127 21.3379 22.1518C20.4647 22.7908 19.3295 23.1084 17.9283 23.1084ZM15.9199 12.2484V15.7533C16.3049 15.785 16.7852 15.8049 17.3567 15.8049C19.0993 15.8049 19.9725 15.1658 19.9725 13.8837C19.9725 12.7565 19.1707 12.1928 17.5671 12.1928C16.9558 12.1889 16.4081 12.2087 15.9199 12.2484ZM15.9199 17.0433V21.6953C16.551 21.7509 17.0392 21.7786 17.3766 21.7786C18.5317 21.7786 19.3731 21.5842 19.905 21.1912C20.4369 20.7982 20.7029 20.179 20.7029 19.3217C20.7029 18.5278 20.4488 17.9443 19.9447 17.5672C19.4367 17.1902 18.5912 16.9996 17.4083 16.9996L15.9199 17.0433Z"
                                    fill="black"></path>
                                <path
                                    d="M18.319 23.1084H14.4688V10.9187C16.1081 10.8472 17.2909 10.8115 18.0173 10.8115C19.351 10.8115 20.383 11.0695 21.1133 11.5895C21.8437 12.1095 22.2088 12.8517 22.2088 13.8163C22.2088 14.3839 21.9747 14.8999 21.5103 15.3643C21.0419 15.8287 20.5259 16.1224 19.9622 16.2375C21.03 16.4717 21.808 16.8567 22.2962 17.3926C22.7844 17.9324 23.0305 18.6628 23.0305 19.5876C23.0305 20.6593 22.5978 21.5127 21.7286 22.1518C20.8514 22.7908 19.7161 23.1084 18.319 23.1084ZM16.3105 12.2484V15.7533C16.6955 15.785 17.1758 15.8049 17.7474 15.8049C19.4899 15.8049 20.3631 15.1658 20.3631 13.8837C20.3631 12.7565 19.5613 12.1928 17.9578 12.1928C17.3425 12.1889 16.7948 12.2087 16.3105 12.2484ZM16.3105 17.0433V21.6953C16.9416 21.7509 17.4298 21.7786 17.7672 21.7786C18.9223 21.7786 19.7638 21.5842 20.2957 21.1912C20.8275 20.7982 21.0935 20.179 21.0935 19.3217C21.0935 18.5278 20.8394 17.9443 20.3353 17.5672C19.8273 17.1902 18.9818 16.9996 17.799 16.9996L16.3105 17.0433Z"
                                    fill="black"></path>
                            </svg>
                        </div>
                        @endif
                        @if ($reviews->count() > 1)
                        <div class="loction-center wow fadeInUp" data-wow-delay="1.0s"
                            style="visibility: visible; animation-delay: 1s; animation-name: fadeInUp;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="61" height="38" viewBox="0 0 61 38" fill="none">
                                <path opacity="0.41"
                                    d="M41.1005 33.4829C41.1005 35.7087 36.4963 37.5077 30.7944 37.5077C25.1077 37.5077 20.4883 35.7087 20.4883 33.4829C20.4883 31.257 25.0925 29.458 30.7944 29.458C36.4811 29.458 41.1005 31.257 41.1005 33.4829Z"
                                    fill="#050505"></path>
                                <path
                                    d="M40.6576 32.3699C40.6576 34.5043 36.2364 36.227 30.7937 36.227C25.3509 36.227 20.9297 34.5043 20.9297 32.3699C20.9297 30.2355 25.3509 28.5127 30.7937 28.5127C36.2364 28.5127 40.6576 30.2355 40.6576 32.3699Z"
                                    fill="#000000" stroke="white" stroke-width="0.6087" stroke-miterlimit="10">
                                </path>
                                <path
                                    d="M0.589844 0.870117V17.8605H27.0772L30.795 29.9002L34.4936 17.8605H61.0003V0.870117H0.589844Z"
                                    fill="black"></path>
                                <path d="M59.8647 1.83398H1.78516V16.821H59.8647V1.83398Z" stroke="white"
                                    stroke-width="0.3472" stroke-miterlimit="10"></path>
                                <path
                                    d="M11.1641 12.6794L11.8575 11.7547C12.3391 12.1785 12.9363 12.3904 13.6683 12.3904C15.0167 12.3904 15.691 11.851 15.691 10.7723C15.691 10.2714 15.4984 9.88615 15.0938 9.57793C14.7086 9.26971 14.1692 9.1156 13.5335 9.1156H13.4179V8.15242H13.4757C14.7085 8.15242 15.325 7.70935 15.325 6.82323C15.325 5.89858 14.7471 5.43625 13.572 5.43625C12.9363 5.43625 12.4355 5.60963 12.0695 5.95638L11.4145 5.14731C11.8768 4.66572 12.6281 4.43457 13.6876 4.43457C14.6122 4.43457 15.3828 4.64645 15.9799 5.05099C16.5771 5.45552 16.8661 5.97563 16.8661 6.61133C16.8661 7.09292 16.6927 7.53598 16.3652 7.90198C16.0377 8.26799 15.6525 8.51841 15.2094 8.65326C15.8258 8.80737 16.3074 9.09634 16.6734 9.48161C17.0394 9.86688 17.2128 10.3484 17.2128 10.9071C17.2128 11.7162 16.9046 12.3519 16.2689 12.7949C15.6332 13.238 14.7663 13.4499 13.6298 13.4499C13.1482 13.4499 12.6859 13.3728 12.2235 13.238C11.7805 13.0646 11.4338 12.8913 11.1641 12.6794Z"
                                    fill="white"></path>
                                <path
                                    d="M19.8919 9.03866L19.3911 8.74969V4.51172H24.7078V5.53268H20.778V7.65168C21.144 7.43979 21.5871 7.32421 22.1457 7.32421C23.1474 7.32421 23.8988 7.57461 24.4189 8.0562C24.939 8.53779 25.2087 9.23129 25.2087 10.1174C25.2087 12.3135 24.0143 13.4115 21.6256 13.4115C20.6239 13.4115 19.7956 13.1803 19.1406 12.7373L19.6993 11.7355C20.3542 12.1786 20.9899 12.3905 21.6064 12.3905C22.9741 12.3905 23.6676 11.697 23.6676 10.2908C23.6676 8.98086 22.9934 8.32589 21.6449 8.32589C21.0092 8.36442 20.412 8.57634 19.8919 9.03866Z"
                                    fill="white"></path>
                                <path
                                    d="M28.6176 11.6387C28.9258 11.6387 29.1762 11.735 29.3881 11.9084C29.6 12.0817 29.7156 12.2936 29.7156 12.5441C29.7156 12.7945 29.6 13.0064 29.3881 13.1798C29.1762 13.3531 28.9258 13.4494 28.6176 13.4494C28.3094 13.4494 28.0589 13.3531 27.847 13.1798C27.6351 13.0064 27.5195 12.7945 27.5195 12.5441C27.5195 12.2936 27.6351 12.0817 27.847 11.9084C28.0589 11.7157 28.3094 11.6387 28.6176 11.6387Z"
                                    fill="white"></path>
                                <path
                                    d="M37.9599 10.9258V13.3144H36.5729V10.9258H31.6992V10.2515L37.4397 4.53027H37.9599V10.0011H39.0386V10.9258H37.9599ZM36.5729 6.91896L33.4329 10.0204H36.5729V6.91896Z"
                                    fill="white"></path>
                                <path
                                    d="M42.9309 13.3152L41.4669 11.4082L40.7541 12.0053V13.296H39.9258V7.95996H40.7541V11.2733L42.5264 9.50105H43.4895L42.0063 10.9458L43.817 13.296H42.9309V13.3152Z"
                                    fill="white"></path>
                                <path
                                    d="M49.7889 13.3146V10.9067C49.7889 10.3095 49.4807 10.0206 48.845 10.0206C48.6523 10.0206 48.4597 10.0784 48.2863 10.1747C48.1129 10.271 47.9974 10.3866 47.9396 10.5214V13.3339H47.1113V10.637C47.1113 10.4444 47.0342 10.3095 46.8608 10.1939C46.6874 10.0784 46.4563 10.0398 46.1866 10.0398C46.0132 10.0398 45.8399 10.0976 45.6665 10.1939C45.4739 10.2903 45.339 10.4059 45.2619 10.5407V13.3339H44.4336V9.53898H44.973L45.2427 9.98204C45.5509 9.63529 45.9554 9.4812 46.437 9.4812C47.092 9.4812 47.5736 9.65456 47.824 9.98204C47.9203 9.84719 48.0937 9.71234 48.3441 9.61603C48.5945 9.51971 48.8449 9.46191 49.1146 9.46191C49.5962 9.46191 49.9622 9.57751 50.2319 9.80867C50.5016 10.0398 50.6172 10.3673 50.6172 10.7911V13.3339H49.7889V13.3146Z"
                                    fill="white"></path>
                            </svg>
                        </div>
                        @endif
                        @if ($reviews->count() > 2)
                        <div class="loction-a wow" data-wow-delay="1.2s"
                            style="visibility: visible; animation-delay: 1.2s; animation-name: updown-2;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="86" viewBox="0 0 56 86" fill="none">
                                <path
                                    d="M28.1688 5.40039C15.5701 5.40039 5.35547 15.6183 5.35547 28.217C5.35547 40.819 15.5701 51.0337 28.1721 51.0337C40.7741 51.0337 50.9888 40.819 50.9888 28.217C50.9888 15.6183 40.7708 5.40039 28.1688 5.40039ZM28.1688 47.3061C17.6282 47.3061 9.08306 38.761 9.08306 28.2203C9.08306 17.6797 17.6282 9.13127 28.1688 9.13127C38.7095 9.13127 47.2546 17.6764 47.2546 28.217C47.2546 38.7577 38.7095 47.3061 28.1688 47.3061Z"
                                    fill="black"></path>
                                <path
                                    d="M28.1692 0.895508C12.8473 0.895508 0.429688 13.3164 0.429688 28.6351C0.429688 29.3365 0.462617 30.051 0.525182 30.7853C2.28689 51.6328 28.1692 85.5631 28.1692 85.5631C28.1692 85.5631 51.9178 54.4318 55.4675 33.4888C55.754 31.7963 55.9121 30.1729 55.9121 28.6351C55.9121 13.3164 43.4912 0.895508 28.1692 0.895508ZM28.1692 48.8272C19.364 48.8272 11.8462 43.3083 8.8892 35.5403C8.01987 33.2583 7.54569 30.7853 7.54569 28.2037C7.54569 16.8135 16.779 7.57684 28.1692 7.57684C39.5594 7.57684 48.7961 16.8102 48.7961 28.2037C48.7961 31.411 48.0618 34.4504 46.7545 37.1604C43.422 44.0624 36.3521 48.8272 28.1692 48.8272Z"
                                    fill="black"></path>
                                <path
                                    d="M28.168 0.895508V7.57684C39.5582 7.57684 48.7948 16.8102 48.7948 28.2037C48.7948 31.411 48.0605 34.4504 46.7532 37.1604C43.4208 44.0657 36.3509 48.8272 28.168 48.8272V85.5631C28.168 85.5631 51.9165 54.4318 55.4663 33.4888C55.7528 31.7963 55.9108 30.1729 55.9108 28.6351C55.9108 13.3164 43.4899 0.895508 28.168 0.895508Z"
                                    fill="black"></path>
                                <path
                                    d="M28.1672 51.2905C40.9104 51.2905 51.2407 40.9602 51.2407 28.217C51.2407 15.4739 40.9104 5.14355 28.1672 5.14355C15.4241 5.14355 5.09375 15.4739 5.09375 28.217C5.09375 40.9602 15.4241 51.2905 28.1672 51.2905Z"
                                    stroke="white" stroke-width="1.1614" stroke-miterlimit="10"></path>
                                <path
                                    d="M34.3107 39.1875L32.7593 34.4661H24.3855L22.7259 39.1875H19.2852L28.4265 16.4961H29.2399L37.7219 39.1875H34.3107ZM28.6856 22.3651L25.199 32.2199H31.8836L28.6856 22.3651Z"
                                    fill="#CC0D39"></path>
                                <path
                                    d="M34.3107 39.1875L32.7593 34.4661H24.3855L22.7259 39.1875H19.2852L28.4265 16.4961H29.2399L37.7219 39.1875H34.3107ZM28.6856 22.3651L25.199 32.2199H31.8836L28.6856 22.3651Z"
                                    fill="#CC0D39"></path>
                            </svg>
                        </div>
                        @endif

                        @if ($reviews->count() > 0)
                        @php
                        $rev1 = $reviews[0];
                        $prod1 = $rev1->product;
                        $var1 = $rev1->variant;
                        $img1 =
                        $var1 && $var1->varient_img
                        ? env('MAIN_URL') . 'images/' . $var1->varient_img
                        : ($prod1 && $prod1->product_image
                        ? env('MAIN_URL') . 'images/' . $prod1->product_image
                        : asset('assets/images/shop/product/medium/1.webp'));
                        @endphp
                        <div class="area-box1 wow animated" data-wow-delay="1.4s">
                            <div class="shop-card style-7">
                                <div class="dz-media">
                                    <img src="{{ $img1 }}" alt="image">
                                </div>
                                <div class="dz-content">
                                    <h5 class="title"><a href="{{ route('shop.details', $prod1->slug ?? '#') }}">{{
                                            $var1->varient_name ?? ($prod1->product_name ?? 'Product') }}</a>
                                    </h5>
                                    <div class="review-meta">
                                        <ul class="dz-rating mb-1" style="display: flex;">
                                            @for ($i = 1; $i <= 5; $i++) <li><i
                                                    class="{{ $i <= $rev1->ratings ? 'fas' : 'far' }} fa-star text-warning"></i>
                                                </li>
                                                @endfor
                                        </ul>
                                        <span class="sale-title text-muted small">{{
                                            \Illuminate\Support\Str::limit($rev1->review, 35) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if ($reviews->count() > 1)
                        @php
                        $rev2 = $reviews[1];
                        $prod2 = $rev2->product;
                        $var2 = $rev2->variant;
                        $img2 =
                        $var2 && $var2->varient_img
                        ? env('MAIN_URL') . 'images/' . $var2->varient_img
                        : ($prod2 && $prod2->product_image
                        ? env('MAIN_URL') . 'images/' . $prod2->product_image
                        : asset('assets/images/shop/product/medium/1.webp'));
                        @endphp
                        <div class="area-box2 wow animated" data-wow-delay="1.6s">
                            <div class="shop-card style-7">
                                <div class="dz-media">
                                    <img src="{{ $img2 }}" alt="image">
                                </div>
                                <div class="dz-content">
                                    <h5 class="title"><a href="{{ route('shop.details', $prod2->slug ?? '#') }}">{{
                                            $var2->varient_name ?? ($prod2->product_name ?? 'Product') }}</a>
                                    </h5>
                                    <div class="review-meta">
                                        <ul class="dz-rating mb-1" style="display: flex;">
                                            @for ($i = 1; $i <= 5; $i++) <li><i
                                                    class="{{ $i <= $rev2->ratings ? 'fas' : 'far' }} fa-star text-warning"></i>
                                                </li>
                                                @endfor
                                        </ul>
                                        <span class="sale-title text-muted small">{{
                                            \Illuminate\Support\Str::limit($rev2->review, 35) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if ($reviews->count() > 2)
                        @php
                        $rev3 = $reviews[2];
                        $prod3 = $rev3->product;
                        $var3 = $rev3->variant;
                        $img3 =
                        $var3 && $var3->varient_img
                        ? env('MAIN_URL') . 'images/' . $var3->varient_img
                        : ($prod3 && $prod3->product_image
                        ? env('MAIN_URL') . 'images/' . $prod3->product_image
                        : asset('assets/images/shop/product/medium/1.webp'));
                        @endphp
                        <div class="area-box3 wow animated" data-wow-delay="1.8s">
                            <div class="shop-card style-7">
                                <div class="dz-media">
                                    <img src="{{ $img3 }}" alt="image">
                                </div>
                                <div class="dz-content">
                                    <h5 class="title"><a href="{{ route('shop.details', $prod3->slug ?? '#') }}">{{
                                            $var3->varient_name ?? ($prod3->product_name ?? 'Product') }}</a>
                                    </h5>
                                    <div class="review-meta">
                                        <ul class="dz-rating mb-1" style="display: flex;">
                                            @for ($i = 1; $i <= 5; $i++) <li><i
                                                    class="{{ $i <= $rev3->ratings ? 'fas' : 'far' }} fa-star text-warning"></i>
                                                </li>
                                                @endfor
                                        </ul>
                                        <span class="sale-title text-muted small">{{
                                            \Illuminate\Support\Str::limit($rev3->review, 35) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="col-xl-5 col-lg-12 col-md-12 custom-width">
                    <div class="section-head style-1 wow fadeInUp d-lg-flex align-items-end justify-content-between"
                        data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                        <div class="left-content">
                            <h2 class="title">Discovering the Hottest Nearby Destinations in Your Area</h2>
                            <!-- <p class="text-capitalize text-secondary m-0">Up to 60% off + up to $107 cashBACK</p> -->
                        </div>
                        <!-- <a href="shop-list.html" class="text-primary font-14 d-flex align-items-center gap-1 m-b15">See All
                                                                                                                                                                                                                                                                                                <i class="icon feather icon-chevron-right font-18"></i>
                                                                                                                                                                                                                                                                                            </a>			 -->
                    </div>

                    <div class="swiper swiper-shop2">
                        <div class="swiper-wrapper">






                            @foreach ($reviews as $review)
                            @php
                            $rp = $review->product;
                            $rv = $review->variant;
                            $ri =
                            $rv && $rv->varient_img
                            ? env('MAIN_URL') . 'images/' . $rv->varient_img
                            : ($rp && $rp->product_image
                            ? env('MAIN_URL') . 'images/' . $rp->product_image
                            : asset('assets/images/shop/product/medium/1.webp'));
                            @endphp
                            <div class="swiper-slide wow fadeInUp" data-wow-delay="0.2s">
                                <div class="shop-card style-7">
                                    <div class="dz-media">
                                        <img src="{{ $ri }}" alt="image">
                                    </div>
                                    <div class="dz-content">
                                        <h5 class="title"><a href="{{ route('shop.details', $rp->slug ?? '#') }}">{{
                                                $rv->varient_name ?? ($rp->product_name ?? 'Product') }}</a>
                                        </h5>
                                        <div class="review-meta">
                                            <ul class="dz-rating mb-1" style="display: flex;">
                                                @for ($i = 1; $i <= 5; $i++) <li><i
                                                        class="{{ $i <= $review->ratings ? 'fas' : 'far' }} fa-star text-warning"></i>
                                                    </li>
                                                    @endfor
                                            </ul>
                                            <span class="sale-title text-black small">{{
                                                \Illuminate\Support\Str::limit($review->review, 20) }}</span>
                                            <p class="review-author mb-0 tiny text-black">-
                                                {{ $review->name }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <section class=" about-style4">
        <div class="container">
            <div class="row  align-items-center ">
                <div class="col-lg-6 order-lg-1 order-1">
                    <div class="side-content">
                        <div class="about-thumb">
                            <img src="assets/images/girl.webp" alt="" style="border-radius:30px 0px;" loading="lazy" width="600" height="800">
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
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-6  aos-item wow fadeInUp  order-lg-2 order-1 class1" data-wow-delay="0.3s"
                    style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                    <div>
                        <div class="section-head">
                            <h2 class="title">What our clients say <br> about us</h2>
                        </div>
                        <div class="swiper swiper-five swiper-initialized swiper-horizontal swiper-backface-hidden">
                            <div class="swiper-wrapper" id="swiper-wrapper-4359c10d9692afdfc" aria-live="polite">
                                @foreach ($reviews as $review)
                                    <div class="swiper-slide">
                                        <div class="about-content">
                                            <ul class="dz-rating mb-2"
                                                style="display: flex; list-style: none; padding: 0; gap: 5px;">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <li><i
                                                            class="{{ $i <= $review->ratings ? 'fas' : 'far' }} fa-star text-warning"></i>
                                                    </li>
                                                @endfor
                                            </ul>
                                            <p class="para-text">"{{ $review->review }}"</p>
                                            <div class="about-bx-detail">
                                                <div>
                                                    <h6 class="name">- {{ $review->name }}</h6>
                                                    {{-- <span class="position">Verified Customer</span> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="pagination-align">
                                <div class="about-button-prev btn-prev" tabindex="0" role="button"
                                    aria-label="Previous slide" aria-controls="swiper-wrapper-4359c10d9692afdfc">
                                    <i class="flaticon flaticon-left-chevron"></i>
                                </div>
                                <div class="about-button-next btn-next" tabindex="0" role="button" aria-label="Next slide"
                                    aria-controls="swiper-wrapper-4359c10d9692afdfc">
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
    </section>



    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const titleEl = document.getElementById('about-category-title');
            const descEl = document.getElementById('about-category-description');
            const linkEl = document.getElementById('about-category-link');

            if (document.querySelector('.category-carousel-v2')) {
                const categoryCarouselV2 = new Swiper('.category-carousel-v2', {
                    slidesPerView: 3,
                    spaceBetween: 30,
                    loop: document.querySelectorAll('.category-carousel-v2 .swiper-slide').length > 3,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    breakpoints: {
                        0: {
                            slidesPerView: 1,
                            spaceBetween: 15,
                        },
                        576: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        },
                        991: {
                            slidesPerView: 3,
                            spaceBetween: 30,
                        }
                    }
                });
            }

            if (document.querySelector('.category-thumb-swiper') && document.querySelector(
                '.category-main-swiper')) {
                const categoryThumbSwiper = new Swiper('.category-thumb-swiper', {
                    slidesPerView: 2,
                    spaceBetween: 20,
                    loop: document.querySelectorAll('.category-thumb-swiper .swiper-slide').length > 2,
                    watchSlidesProgress: true,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    breakpoints: {
                        0: {
                            slidesPerView: 1
                        },
                        576: {
                            slidesPerView: 2
                        },
                    }
                });

                const categoryMainSwiper = new Swiper('.category-main-swiper', {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    loop: document.querySelectorAll('.category-main-swiper .swiper-slide').length > 2,
                    effect: 'fade',
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    thumbs: {
                        swiper: categoryThumbSwiper,
                    },
                    on: {
                        slideChangeTransitionStart: function () {
                            const activeSlide = this.slides[this.activeIndex];
                            if (activeSlide) {
                                const name = activeSlide.getAttribute('data-category-name');
                                const title = activeSlide.getAttribute('data-banner-title');
                                const link = activeSlide.getAttribute('data-shop-link');

                                if (titleEl && name) {
                                    titleEl.textContent = name;
                                }
                                if (descEl && title) {
                                    descEl.textContent = title;
                                }
                                if (linkEl && link) {
                                    linkEl.href = link;
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
    {{--
    <script>
        // ─── Helper: reset banner swipers to slide 0 ──────────────────
        function resetBannerSwipers() {
            var selectors = ['.main-swiper', '.main-swiper-thumb'];
            selectors.forEach(function (sel) {
                var el = document.querySelector(sel);
                if (!el || !el.swiper) return;
                var sw = el.swiper;
                // Stop autoplay first so it doesn't fight the reset
                try {
                    sw.autoplay && sw.autoplay.stop();
                } catch (e) { }
                // Use slideToLoop for loop:true swipers, slideTo otherwise
                try {
                    if (sw.params && sw.params.loop) {
                        sw.slideToLoop(0, 0, false);
                    } else {
                        sw.slideTo(0, 0, false);
                    }
                } catch (e) { }
                // Recalculate sizes then restart autoplay
                try {
                    sw.updateSize();
                    sw.updateSlides();
                    sw.update();
                } catch (e) { }
                try {
                    sw.autoplay && sw.autoplay.start();
                } catch (e) { }
            });
        }

        // ─── Helper: update all swipers (size recalc) ─────────────────
        function updateAllSwipers() {
            document.querySelectorAll('.swiper, .swiper-container').forEach(function (el) {
                if (!el.swiper) return;
                try {
                    el.swiper.updateSize();
                    el.swiper.updateSlides();
                    el.swiper.update();
                } catch (e) { }
            });
        }

        window.addEventListener('pageshow', function (event) {
            if (event.persisted) {
                resetBannerSwipers();
                updateAllSwipers();

                document.querySelectorAll('.wow').forEach(function (el) {
                    el.style.visibility = 'visible';
                    el.style.opacity = '1';
                    el.style.animationName = 'none';
                });
            }
        });

        document.addEventListener('visibilitychange', function () {
            if (document.visibilityState === 'visible') {
                updateAllSwipers();
            }
        });

        document.querySelectorAll('.main-swiper-thumb img, .main-swiper img').forEach(function (img) {
            img.addEventListener('load', function () {
                var swiperEl = img.closest('.swiper-container, .swiper');
                if (swiperEl && swiperEl.swiper) {
                    try {
                        swiperEl.swiper.update();
                    } catch (e) { }
                }
            });
            // If image already in browser cache, trigger manually
            if (img.complete) {
                img.dispatchEvent(new Event('load'));
            }
        });
    </script> --}}
@endsection