@extends('FrontEnd.master')
@section('title')
    Home
@endsection
@section('content')
    @push('css')
        <style>
            @media (max-width: 667px) {}

            @media (min-width: 668px) and (max-width: 1920px) {}
        </style>
    @endpush
    <style>
        .card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }



        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px #FF914D;
        }

        .card-image {
            position: relative;
            overflow: hidden;
        }

        .card-image img {
            width: 100%;
            height: auto;
            transition: transform 0.3s ease;
        }

        .card-image:hover img {
            transform: scale(1.05);
        }

        .card-labels {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 10;
        }

        .onsale {
            background: #ff6b6b;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }

        .card-content {
            padding: 15px;
        }

        .card-title {
            margin: 0 0 10px;
            font-size: 16px;
            line-height: 1.4;
        }

        .card-title a {
            color: #333;
            text-decoration: none;
            transition: color 0.2s;
        }

        .card-title a:hover {
            color: #ff914d;
        }

        .card-price {
            font-size: 18px;
            font-weight: bold;
            color: #ff914d;
            margin-bottom: 15px;
        }

        .card-price span+span {
            color: #999;
            text-decoration: line-through;
            font-size: 14px;
            margin-left: 5px;
        }

        .card-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-select-options,
        .btn-cart {
            flex: 1;
            padding: 8px 15px;
            border: none;
            border-radius: 15px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-select-options {
            background: #FF914D;
            color: white;
            flex: 2;
        }

        .btn-select-options:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-select-options:hover:before {
            left: 100%;
        }

        .btn-select-options:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-cart {
            background: rgba(52, 73, 94, 0.1);
            border: 2px solid #34495e;
            color: #34495e;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-cart:hover {
            background: #FF914D;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(52, 73, 94, 0.3);
        }

        .category-shop {
            background: #FF914D;
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 30px;
            text-decoration: none;
            display: inline-block;
        }

        .category-shop:hover {
            background: #ff7a1a;
            color: #ffffff;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .card-container {
                /* padding: 10px; */
            }

            .card-title {
                font-size: 14px;
            }

            .card-price {
                font-size: 16px;
            }

            .btn-group-custom {
                flex-direction: column;
            }

            .btn-cart {
                font-size: 0.7rem;
                padding: 6px 8px;
                border-radius: 10px;
                background-color: #FF914D;
                color: white;
                border: none;
            }

            .btn-select-options {
                display: none;
            }
        }

        .modern-product-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #eef0f4;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            transition: all 0.35s ease;
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .modern-product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 30px rgba(0, 0, 0, 0.1);
            border-color: #e0e4e9;
        }

        .card-img-container {
            position: relative;
            overflow: hidden;
            height: 250px;
            background: #f8fafc;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.5s ease;
            mix-blend-mode: multiply;
        }

        .modern-product-card:hover .card-img-top {
            transform: scale(1.08);
        }

        .linking-text {
            margin-top: 40px;
            padding: 10px 15px;
            background-color: #FFF4ED;
            border-radius: 8px;
            font-size: 0.9rem;
            margin-top: 10px;
            color: #555;

        }

        .new-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: linear-gradient(135deg, #17a2b8, #138496);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.75rem;
            z-index: 2;
            box-shadow: 0 4px 15px rgba(23, 162, 184, 0.4);
        }

        .discount-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.85rem;
            z-index: 2;
            box-shadow: 0 4px 15px rgba(238, 90, 36, 0.4);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .quick-view {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%) translateY(50px);
            opacity: 0;
            transition: all 0.3s ease;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .modern-product-card:hover .quick-view {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }

        .card-body {
            padding: 1.25rem;
            background: #ffffff;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .product-title {
            font-size: 1rem;
            font-weight: 600;
            color: #1a1f36;
            margin-bottom: 0.75rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 2.8rem;
        }

        .product-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .product-title a:hover {
            color: #FF914D;
        }

        .price-section {
            margin-bottom: 1.25rem;
            display: flex;
            align-items: baseline;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .current-price {
            font-size: 1.25rem;
            font-weight: 700;
            color: #FF914D;
            letter-spacing: -0.5px;
        }

        .original-price {
            font-size: 0.95rem;
            color: #64748b;
            text-decoration: line-through;
            font-weight: 500;
        }

        .savings {
            font-size: 0.85rem;
            color: #e74c3c;
            font-weight: 600;
            display: block;
            margin-top: 0.3rem;
        }

        .btn-group-custom {
            display: flex;
            gap: 0.75rem;
            margin-top: auto;
        }

        .btn-buy-now {
            background: #FF914D;
            border: none;
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 12px;
            font-weight: 600;
            flex: 2;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            font-size: 0.875rem;
            text-align: center;
            box-shadow: 0 2px 4px rgba(255, 145, 77, 0.1);
        }

        .btn-buy-now:before {
            display: none;
        }

        .btn-buy-now:hover {
            background: #ff7c2a;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 145, 77, 0.2);
        }

        .btn-add-cart {
            background: #FDF1EA;
            border: none;
            color: #FF914D;
            padding: 0.75rem;
            border-radius: 12px;
            font-weight: 600;
            flex: 1;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
        }

        .btn-add-cart:hover {
            background: #FF914D;
            color: white;
            transform: translateY(-2px);
        }

        .out-of-stock-btn {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
            padding: 10px 16px;
            border-radius: 15px;
            font-weight: 600;
            text-align: center;
            width: 100%;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card-img-container {
                height: 200px;
            }

            .btn-group-custom {
                flex-direction: column;
            }

            .current-price {
                font-size: 1.3rem;
            }

            .product-title {
                font-size: 1rem;
            }

            .card-body {
                padding: 1rem;
            }
        }

        @media (max-width: 576px) {

            .btn-buy-now,
            .btn-add-cart {
                font-size: 0.75rem;
                padding: 8px 12px;
            }

            .new-badge,
            .discount-badge {
                font-size: 0.7rem;
                padding: 4px 8px;
            }

            .category-shop{
                margin: 10px 0;
            }
        }

        /* Extra Small Devices (xs, <480px) */
        @media (max-width: 480px) {
            .modern-product-card {
                border-radius: 12px;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
                height: auto;
                min-width: 0;
            }

            .product-card {
                padding-left: 2px !important;
                padding-right: 2px !important;
                margin-bottom: 10px !important;
            }

            .card-img-container {
                height: 120px;
                border-radius: 10px 10px 0 0;
            }

            .card-img-top {
                height: 120px !important;
                object-fit: cover;
            }

            .card-body {
                padding: 0.6rem;
            }

            .product-title {
                font-size: 0.85rem;
                min-height: 1.7rem;
            }

            .current-price {
                font-size: 1.05rem;
            }

            .original-price {
                font-size: 0.85rem;
            }

            .savings {
                font-size: 0.7rem;
            }

            .btn-buy-now {
                display: none;
            }

            .btn-add-cart {
                font-size: 0.7rem;
                padding: 6px 8px;
                border-radius: 10px;
                background-color: #FF914D;
                color: white;
            }

            .out-of-stock-btn {
                font-size: 0.75rem;
                padding: 6px 8px;
                border-radius: 10px;
            }

            .discount-badge,
            .new-badge {
                font-size: 0.6rem;
                padding: 3px 6px;
                border-radius: 12px;
            }

            .quick-view {
                font-size: 0.7rem;
                padding: 5px 10px;
                border-radius: 10px;
            }
        }

        /* Even smaller devices (xxs, <375px) */
        @media (max-width: 375px) {
            .card-img-container {
                height: 90px;
            }

            .card-img-top {
                height: 90px !important;
            }

            .product-title {
                font-size: 0.75rem;
                min-height: 1.2rem;
            }

            .btn-buy-now {
                display: none;
            }

            .btn-add-cart {
                font-size: 0.6rem;
                padding: 4px 6px;
            }
        }

        .group {
            position: relative;
            width: 100%;
            height: 250px;
            /* Set a fixed height instead of min-height */
            cursor: pointer;
            overflow: hidden;
            background: #f8f8f8;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* .group img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: opacity 0.3s ease;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
        } */

        /* Responsive adjustments */
        @media (max-width: 768px) {

            .group,
            .card-image {
                height: 200px;
            }
        }

        @media (max-width: 480px) {

            .group,
            .card-image {
                height: 120px;
            }
        }

        @media (max-width: 375px) {

            .group,
            .card-image {
                height: 90px;
            }
        }
    </style>
    <style>
        .info-card {
            border: 1px solid #f2f2f2;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            transition: box-shadow 0.2s;

        }

        .info-card:hover {
            box-shadow: 0 8px 24px rgba(255, 145, 77, 0.12);
            border-color: #FF914D;
        }

        .company-header {
            font-size: 2.2rem;
        }

        .company-subtitle {
            font-size: 1.15rem;
            color: #666;
        }

        @media (max-width: 768px) {
            .info-card {
                padding: 1.2rem;
            }

            .company-header {
                font-size: 1.5rem;
            }
        }
    </style>
    <!-- ======================= Category & Slider ======================== -->
    <style>
        /* Slider Styles */
        .slick-slide {
            height: 100%;
        }

        .slick-list {
            height: 100%;
            border-radius: 10px;
            padding: 50px;
        }

        .slick-track {
            height: 100%;
        }

        /* Navigation Arrows */
        .slick-arrow {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 1;
            transition: all 0.3s ease;
        }

        .slick-arrow:hover {
            background: black;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .slick-next {
            right: 20px;
        }

        .slick-prev {
            left: 20px;
        }

        .slick-prev:before,
        .slick-next:before {
            color: #333;
            font-size: 24px;
            line-height: 1;
            opacity: 1;
            transition: all 0.3s ease;
        }

        .slick-dots {
            bottom: 20px;
        }

        .slick-dots li button:before {
            font-size: 12px;
            color: white;
            opacity: 0.8;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        .slick-dots li.slick-active button:before {
            color: #FF914D;
            opacity: 1;
        }

        /* Main Banner Layout */
        .main-banner {
            display: flex;
            gap: 1rem;
            max-width: 1500px;
            margin: 0 auto;
            /* min-height: 400px; */
            padding: 0.5rem;
        }

        /* Slider Container */
        .slider {
            position: relative;
            width: 100%;
            height: 500px;
            overflow: hidden;
            flex: 1;
        }

        .slider .slick-slide {
            position: relative;
            overflow: hidden;
            height: 500px;
        }

        .slider img {
            width: 100%;
            height: 100%;
            /* object-fit: cover; */
            border-radius: 0.625rem;
            transition: transform 0.3s ease;
            display: block;
        }

        .slider .slick-slide:hover img {
            transform: scale(1.02);
        }

        /* Right Banner */
        .right-banner {
            display: grid;
            /* grid-template-rows: repeat(2, 1fr); */
            align-items: center;
            justify-content: space-between;
            width: 100%;
            height: 500px;
            gap: 1rem;
            flex: 1;
        }

        .second-banner-img {
            width: 100%;
            height: 300px;
            border-radius: 0.625rem;
            /* object-fit: cover; */
            display: block;
        }

        .small-banner {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            ;
            justify-content: space-between;
            width: 100%;
            height: 180px;
        }

        .small-banner-item {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .small-banner-img {
            width: 100%;
            height: 180px;
            border-radius: 10px;
            /* object-fit: cover; */
        }

        .small-banner-item div {
            position: absolute;
            top: 50%;
            left: 40%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 18px;
            font-weight: bold;
            text-shadow: 0px 0px 5px black;
            text-align: left;
        }

        .small-banner-item button {
            padding: 5px 10px;
            background-color: white;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .small-banner-item button:hover {
            background-color: #FF914D;
            color: white;
        }

        @media (max-width: 1024px) {
            /* .main-banner {
                gap: 0.75rem;
                padding: 0.75rem;
            }

           /* .right-banner {
                max-width: 400px;
            }

            .second-banner-img,
            .small-banner {
                height: 170px;
            } */
        }

        @media (max-width: 820px) {
            .main-banner {
                flex-direction: column;
                padding: 0.5rem;
                gap: 0.75rem;
            }

            .right-banner {
                max-width: 100%;
                gap: 0.75rem;
            }

            .slider {
                height: 300px;
                flex: none;
            }

            .slider .slick-slide {
                height: 300px;
            }

            .second-banner-img,
            .small-banner {
                height: 180px;
            }

            .small-banner-item div {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .main-banner {
                padding: 0;
                gap: 0.5rem;
                height: 100%;
                border-radius: 0;
            }

            .right-banner {
                display: none;
            }

            .slider,
            .slider .slick-slide {
                height: 200px;
            }

            .second-banner-img,
            .small-banner-img {
                height: 150px;
            }

            .small-banner {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
                height: auto;
            }

            .small-banner-item div {
                font-size: 0.875rem;
                left: 50%;
                width: 100%;
                text-align: center;
            }
        }

        @media (max-width: 375px) {

            .slider,
            .slider .slick-slide {
                height: 180px;
            }

            .second-banner-img,
            .small-banner-img {
                height: 130px;
            }
        }



        .slider.slick-initialized.slick-slider.slick-dotted {
            margin-bottom: 10px;
        }

        .banner-container {
            padding: 0;
        }
    </style>
    <section class="banner-container">
        <!-- Banner -->
        <div class="main-banner">
            <!-- left -->

            <div class="slider" id="mainSlider">
                @foreach ($sliders as $slider)
                    <div class="slide-item">
                        <img src="{{ asset($slider->slider_img) }}" alt="Slider Image" loading="lazy">
                    </div>
                @endforeach
            </div>
            <!-- right -->
            <div class="right-banner">
                <div>
                    @if (isset($home_banners[0]))
                        <a href="{{ route('product.category', isset($categories[0]) ? $categories[0]->slug : '#') }}">
                            <img src="{{ asset($home_banners[0]->banner_img) }}" alt="Featured Banner"
                                class="second-banner-img"/>
                        </a>
                    @endif
                </div>
                <div class="small-banner">
                    <div>
                        <div class="small-banner-item">
                            @if (isset($home_banners[1]))
                                <a
                                    href="{{ route('product.category', isset($categories[1]) ? $categories[1]->slug : '#') }}">
                                    <img src="{{ asset($home_banners[1]->banner_img) }}" alt="Special Offer"
                                        class="small-banner-img" />
                                </a>
                            @endif
                        </div>
                    </div>
                    <div>
                        <div class="small-banner-item">
                            @if (isset($home_banners[2]))
                                <a
                                    href="{{ route('product.category', isset($categories[2]) ? $categories[2]->slug : '#') }}">
                                    <img src="{{ asset($home_banners[2]->banner_img) }}" alt="New Arrival"
                                        class="small-banner-img" />

                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Include Slick Carousel CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script>
            $(window).on('load', function() {
                setTimeout(function() {
                    initializeSlider();
                }, 100);
            });

            function initializeSlider() {
                if ($(".slider").length > 0 && !$(".slider").hasClass('slick-initialized')) {
                    $(".slider").slick({
                        dots: true,
                        infinite: true,
                        speed: 800,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: true,
                        autoplay: true,
                        autoplaySpeed: 4000,
                        fade: true,
                        cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
                        touchThreshold: 100,
                        pauseOnHover: true,
                        lazyLoad: 'progressive',
                        responsive: [{
                            breakpoint: 768,
                            settings: {
                                arrows: false,
                                dots: true
                            }
                        }]
                    }).on('beforeChange', function(event, slick, currentSlide, nextSlide) {
                        $(this).find('.slick-slide').css('opacity', '0.5');
                        $(this).find('.slick-current').css('opacity', '1');
                    }).on('afterChange', function(event, slick, currentSlide) {
                        $(this).find('.slick-slide').css('opacity', '1');
                    }).hover(
                        function() {
                            $(this).slick('slickPause');
                        },
                        function() {
                            $(this).slick('slickPlay');
                        }
                    );

                    console.log('Slider initialized');
                } else {
                    console.log('Slider already initialized or not found');
                }
            }
        </script>
    @endpush
    <!-- ======================= Category & Slider ======================== -->


    <!-- =====================servicees===================== -->
    <!-- <div class="verified container d-none d-lg-block pr-md:-0 pr-3">
        <ul class="px-0">
            <li style=" gap:10px;" class="lol-width d-flex align-items-center gap-3"><img
                    src="{{ asset('upload/other-img/safe.png') }}" alt="">
                <a style="white-space: nowrap;" href="" class="text-dark">
                    Quality Product
                </a>
            </li>
            <li style=" gap:10px;" class="lol-width d-flex align-items-center gap-3"><img
                    src="{{ asset('upload/other-img/car.png') }}" alt="">
                <a style="white-space: nowrap;" href="" class="text-dark">
                    Fast Delivery
                </a>
            </li>
            <li style=" gap:10px;" class="lol-width d-flex align-items-center gap-3"><img
                    src="{{ asset('upload/other-img/back.png') }}" alt=""><a style="white-space: nowrap;"
                    href="#" class="text-dark">
                    24/7 Support
                </a>
            </li>
            <li style=" gap:10px;" class="lol-width d-flex align-items-center gap-3"><img
                    src="{{ asset('upload/other-img/best.png') }}" alt=""><a style="white-space: nowrap;"
                    href="" class="text-dark">
                    Best Price

                </a>
            </li>
            <li style=" gap:10px;" class="lol-width d-flex align-items-center gap-3"><img
                    src="{{ asset('upload/other-img/right.png') }}" alt=""><a style="white-space: nowrap;"
                    href="" class="text-dark">
                    0 - 3 Years Warranty
                </a></li>
        </ul>
    </div> -->
    <!-- =====================servicees===================== -->









    <!-- ======================= Flash Sale ======================== -->
    @php

        $campaign = \App\Models\Campaing::where('status', 1)->orderBy('id', 'desc')->first();
        // $campaing_products = $campaign->campaing_products;
        //dd(count($campaing_products));
    @endphp
    @if ($campaign)
        <input type="hidden" name="" id="campaign" value="1">
    @else
        <input type="hidden" name="" id="campaign" value="0">
        @php
            $start_diff = 0;
            $end_diff = 0;
        @endphp
    @endif
    @if ($campaign)
        @php
            $flash_start = date_create($campaign->flash_start);
            $flash_end = date_create($campaign->flash_end);

            $start_diff = $flash_start->getTimestamp() - time();
            $end_diff = $flash_end->getTimestamp() - time();

            $start_diff2 = date_diff(date_create($campaign->flash_start), date_create(date('d-m-Y H:i:s')));
            $end_diff2 = date_diff(date_create(date('d-m-Y H:i:s')), date_create($campaign->flash_end));
        @endphp

        @if ($start_diff2->invert == 0 && $end_diff2->invert == 0)
            <div class=" my-md-5 my-4">
                <div class="container">

                    <div class="row justify-content-center">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="sec_title position-relative text-center">
                                <h3 class="ft-bold section-title">Sales Going On</h3>
                                <div class="pt-3 pt-md-4 pb-4 px-md-4 px-3 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center"
                                    style="background-color: #FFECCA;">
                                    <div class="w-100">
                                        <h4 class="text-dark fs-3 mb-0 text-md-left text-center" style="font-weight: 500;">
                                            Deals Of The Day</h4>
                                    </div>
                                    <h5 class="trimmers lol text-center text-md-right" style="white-space: nowrap">
                                        <span class="text me-2 text-dark text-left"> Ends after: </span>
                                        <strong id="demo">

                                        </strong>
                                    </h5>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row align-items-center justify-content-center px-2 ">
                        @foreach ($campaign->campaing_products as $key => $campaing_product)
                            @if ($key == 8)
                                @php break; @endphp
                            @endif
                            @php
                                $product = \App\Models\Product::find($campaing_product->product_id);
                            $data = calculateDiscount($product->id); @endphp
                            <div class="product-card col-xl-3 col-lg-4 col-md-6 col-6 px-1 px-md-2 mb-4">
                                <div class="modern-product-card">
                                    <div class="card-img-container">
                                        <img src="{{ asset($product->product_thumbnail) }}" alt="Product Image"
                                            class="card-img-top">
                                        @if ($product->discount_price != 0)
                                            <div class="discount-badge">{{ $data['text'] }}</div>
                                        @endif
                                        <button class="quick-view" onclick="productView({{ $product->id }})"
                                            data-bs-toggle="modal" data-bs-target="#quickViewModal">Quick View</button>
                                    </div>
                                    <div class="card-body">
                                        <h2 class="product-title">
                                            <a
                                                href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                                {{ Str::limit($product->name_en, 43, '...') }}
                                            </a>
                                        </h2>
                                        <div class="price-section">
                                            @if ($product->discount_price != 0)
                                                <span class="current-price">৳{{ $data['discount'] }}</span>
                                                <span class="original-price">৳{{ $product->regular_price }}</span>
                                            @else
                                                <span class="current-price">৳{{ $product->regular_price }}</span>
                                            @endif
                                        </div>
                                        <div class="btn-group-custom">
                                            @if ($product->stock_qty == 0)
                                                <button class="out-of-stock-btn" disabled>
                                                    <i class="fas fa-times-circle"></i>
                                                    Out of Stock
                                                </button>
                                            @elseif($product->is_varient == 1)
                                                <button type="button" class="btn-buy-now"
                                                    onclick="productView({{ $product->id }})" data-bs-toggle="modal"
                                                    data-bs-target="#quickViewModal">
                                                    Buy Now
                                                </button>
                                                <button type="button" class="btn-add-cart"
                                                    onclick="productView({{ $product->id }})" data-bs-toggle="modal"
                                                    data-bs-target="#quickViewModal">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </button>
                                            @else
                                                <input type="hidden" id="pfrom" value="direct">
                                                <input type="hidden" id="product_product_id"
                                                    value="{{ $product->id }}" min="1">
                                                <input type="hidden" id="{{ $product->id }}-product_pname"
                                                    value="{{ $product->name_en }}">
                                                <button type="button" class="btn-buy-now"
                                                    onclick="buyNow({{ $product->id }})">
                                                    Buy Now
                                                </button>
                                                <button type="button" class="btn-add-cart"
                                                    onclick="addToCartDirect({{ $product->id }})">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 text-right mt-2">
                            <a href="{{ route('campaign.product') }}" class="btn btn-more ">View All</a>
                        </div>
                    </div>

                </div>
            </div>
        @endif
    @endif
    <!-- ======================= Flash sale ======================== -->





    <!-- ======================= All Category ======================== -->
    <div class="brands-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10">
                    <div class="section-header text-center mb-2 mb-md-5">

                        <h1 class="section-title">Best Used Laptop Prices in Bangladesh
                            Explained</h1>
                        <p class="section-subtitle">Get the best used laptop prices in Bangladesh on A+ grade condition
                            laptops imported
                            directly from Dubai. Each unit is verified with import documentation and Dubai reseller
                            records, <a href="#checklist">available for inspection at our showroom</a> Enjoy a 40-day
                            replacement and <a href="product/warrenty">3-year
                                service warranty</a> from Laptop Ache, a trusted best used laptop shop in Dhaka. </p>
                        {{-- <button id="shopByBrand" class="category-shop">
                        All Products
                    </button> --}}
                        <a href="{{ route('product.show') }}" id="shopByBrand" class="category-shop">
                            All Products
                        </a>

                    </div>
                </div>
            </div>

            <!-- Brands Slider -->
            <div class="brands-slider-wrapper">
                <div class="brands-slider ">
                    @foreach ($categories as $category)
                        <div class="brand-slide">
                            <div class="brand-card py-md-2">
                                <div class="brand-circle">
                                    <a href="{{ route('product.category', $category->slug) }}" class="brand-link">
                                        <div class="brand-image-container">
                                            <img src="{{ asset($category->image) }}" class="brand-image"
                                                alt="{{ $category->name_en }}">
                                        </div>
                                        <!-- <div class="brand-overlay">
                                        <i class="fas fa-arrow-right"></i>
                                    </div> -->
                                    </a>
                                </div>
                                <div class="brand-info">
                                    <h5 class="brand-name">
                                        <a href="{{ route('product.category', $category->slug) }}">
                                            {{ $category->name_en }}
                                        </a>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <style>
        .brands-section {
            background-color: #efe9e6;
            /* padding: 80px 0; */
            position: relative;
        }

        .section-header {
            padding-top: 15px;
            /* margin-bottom: 3rem; */
        }

        .section-badge {
            display: inline-block;
            margin-bottom: 1rem;
        }

        .badge-text {
            background-color: #FF914D;
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 0.875rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #FF7C2A;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .section-subtitle {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 0;
            font-weight: 400;
        }

        .brands-slider-wrapper {
            position: relative;
            margin: 0 60px;
        }

        .brands-slider {
            /* padding: 20px 0; */
        }

        .brand-slide {
            padding: 0 15px;
            outline: none;
        }

        .brand-card {
            text-align: center;
            transition: transform 0.3s ease;
        }

        .brand-card:hover {
            transform: translateY(-5px);
        }

        .brand-circle {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            background: white;
            border: 2px solid #e9ecef;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-circle:hover {
            border-color: #FF914D;
            box-shadow: 0 8px 25px rgba(0, 123, 255, 0.2);
        }

        .brand-link {
            display: block;
            width: 100%;
            height: 100%;
            text-decoration: none;
            position: relative;
        }

        .brand-image-container {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
            position: relative;
            z-index: 2;
        }

        .brand-image {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .brand-circle:hover .brand-image {
            transform: scale(1.1);
        }

        .brand-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            /* background: rgba(0, 123, 255, 0.9); */
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 3;
        }

        .brand-circle:hover .brand-overlay {
            opacity: 1;
        }

        .brand-info {
            text-align: center;
        }

        .brand-name {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
            line-height: 1.3;
        }

        .brand-name a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .brand-name a:hover {
            color: #FF914D;
        }

        /* Slider Navigation */
        .slider-navigation {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            transform: translateY(-50%);
            display: flex;
            justify-content: space-between;
            pointer-events: none;
            z-index: 10;
        }

        .slider-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: white;
            border: 1px solid #ddd;
            color: #333;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            pointer-events: auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .slider-btn:hover {
            background: #007bff;
            color: white;
            border-color: #007bff;
            transform: scale(1.1);
        }

        .slider-btn:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
        }

        .prev-btn {
            left: 10px;
            top: 70%;
            /* transform: translateY(-50%); */
        }

        .next-btn {
            right: 10px;
        }

        /* Slick Slider Overrides */
        .slick-track {
            display: flex;
            align-items: center;
        }

        .slick-slide {
            height: auto;
        }

        .slick-slide>div {
            height: 100%;
        }

        .slick-dots {
            display: flex !important;
            justify-content: center;
            gap: 8px;
            margin-top: 2rem;
            list-style: none;
            padding: 0;
        }

        .slick-dots li {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #ddd;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .slick-dots li.slick-active {
            background: #007bff;
        }

        .slick-dots li button {
            display: none;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .brands-slider-wrapper {
                margin: 0 50px;
            }
        }

        @media (max-width: 768px) {
            .brands-section {
                padding: 60px 0;
            }

            .section-title {
                font-size: 2rem;
            }

            .brands-slider-wrapper {
                margin: 0 40px;
            }

            .brand-circle {
                width: 120px;
                height: 120px;
            }

            .brand-image-container {
                padding: 20px;
            }

            .brand-name {
                font-size: 1rem;
            }

            .slider-btn {
                width: 40px;
                height: 40px;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 576px) {
            .brands-section {
                padding: 0px;
            }

            .section-title {
                font-size: 1.2rem;
            }

            .brands-slider-wrapper {
                margin: 0 30px;
            }

            .brand-circle {
                width: 80px;
                height: 80px;
            }

            .brand-image-container {
                padding: 10x;
            }

            .brand-name {
                font-size: 0.9rem;
            }

            .slider-btn {
                width: 35px;
                height: 35px;
                font-size: 0.8rem;
            }

            .prev-btn {
                left: 5px;
            }

            .next-btn {
                right: 5px;
            }
        }

        /* Loading Animation */
        .brand-slide {
            opacity: 0;
            transform: translateY(20px);
            animation: slideIn 0.6s ease forwards;
        }

        @keyframes slideIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Staggered Animation */
        .slick-slide:nth-child(1) .brand-slide {
            animation-delay: 0.1s;
        }

        .slick-slide:nth-child(2) .brand-slide {
            animation-delay: 0.2s;
        }

        .slick-slide:nth-child(3) .brand-slide {
            animation-delay: 0.3s;
        }

        .slick-slide:nth-child(4) .brand-slide {
            animation-delay: 0.4s;
        }

        .slick-slide:nth-child(5) .brand-slide {
            animation-delay: 0.5s;
        }
    </style>

    <!-- Required Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <script>
        $(document).ready(function() {
            // Initialize Slick Slider
            $('.brands-slider').slick({
                infinite: true,
                slidesToShow: 5,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                pauseOnHover: true,
                arrows: false,
                dots: false,
                responsive: [{
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                        }
                    },

                    {
                        breakpoint: 375,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                        }
                    }
                ]
            });

            // Custom Navigation
            $('.prev-btn').click(function() {
                $('.brands-slider').slick('slickPrev');
            });

            $('.next-btn').click(function() {
                $('.brands-slider').slick('slickNext');
            });

            // Pause autoplay on hover
            $('.brand-circle').hover(
                function() {
                    $('.brands-slider').slick('slickPause');
                },
                function() {
                    $('.brands-slider').slick('slickPlay');
                }
            );
        });
    </script>
    <!-- ======================= All Category ======================== -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.group').forEach(container => {
                // Video functionality code removed
            });
        });
    </script>


    <!-- ======================= Products Lists ======================== -->
    <section class="space min pt-3 pt-md-5 mt-2">
        <div class="container">
            <style>

            </style>
            <div class="row px-md-2">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <!-- tab -->
                    <div class="position-relative mb-md-5 mb-4">
                        <!-- Previous Button -->
                        <button class="tab-slider-btn tab-slider-prev d-md-none" type="button" aria-label="Previous">
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                        </button>

                        <!-- Tabs Container -->
                        <div class="tab-slider-wrapper">
                            <ul class="nav nav-tabs b-0 d-flex align-items-md-center justify-content-between justify-content-md-center simple_tab_links px-5"
                                style="gap:12px" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active text-center py-3" style="white-space:nowrap" id="all-tab"
                                        href="#all" data-bs-toggle="tab" role="tab" aria-controls="all"
                                        aria-selected="true">All</a>
                                </li>
                                @foreach ($tab_categories as $category)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link text-center py-3 px-2" style="white-space:nowrap"
                                            id="{{ $category->id }}-tab" href="#{{ $category->id }}"
                                            data-bs-toggle="tab" role="tab" aria-controls="{{ $category->id }}"
                                            aria-selected="true">{{ $category->name_en }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Next Button -->
                        <button class="tab-slider-btn tab-slider-next d-md-none" type="button" aria-label="Next">
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </button>
                    </div>

                    <style>
                        /* Tab Slider Wrapper */
                        .tab-slider-wrapper {
                            overflow-x: auto;
                            overflow-y: hidden;
                            scroll-behavior: smooth;
                            -webkit-overflow-scrolling: touch;
                            scrollbar-width: none;
                            /* Firefox */
                            -ms-overflow-style: none;
                            /* IE and Edge */
                        }

                        .tab-slider-wrapper::-webkit-scrollbar {
                            display: none;
                            /* Chrome, Safari, Opera */
                        }

                        /* Slider Buttons */
                        .tab-slider-btn {
                            position: absolute;
                            top: 50%;
                            transform: translateY(-50%);
                            width: 50px;
                            height: 50px;
                            border: 1px solid #ddd;
                            background: white;
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            cursor: pointer;
                            z-index: 10;
                            transition: all 0.3s ease;
                            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                        }

                        .tab-slider-btn:hover {
                            background: #f8f9fa;
                            border-color: #aaa;
                        }

                        .tab-slider-btn:active {
                            transform: translateY(-50%) scale(0.95);
                        }

                        .tab-slider-prev {
                            left: -10px;
                        }

                        .tab-slider-next {
                            right: -10px;
                        }

                        /* Hide buttons on medium+ screens */
                        @media (min-width: 768px) {
                            .tab-slider-wrapper {
                                overflow-x: visible;
                            }
                        }

                        /* Adjust nav on small screens */
                        @media (max-width: 767px) {
                            .tab-slider-wrapper .nav-tabs {
                                flex-wrap: nowrap;
                                justify-content: flex-start !important;
                            }
                        }
                    </style>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const wrapper = document.querySelector('.tab-slider-wrapper');
                            const prevBtn = document.querySelector('.tab-slider-prev');
                            const nextBtn = document.querySelector('.tab-slider-next');

                            if (!wrapper || !prevBtn || !nextBtn) return;

                            // Scroll amount (adjust as needed)
                            const scrollAmount = 200;

                            prevBtn.addEventListener('click', function() {
                                wrapper.scrollBy({
                                    left: -scrollAmount,
                                    behavior: 'smooth'
                                });
                            });

                            nextBtn.addEventListener('click', function() {
                                wrapper.scrollBy({
                                    left: scrollAmount,
                                    behavior: 'smooth'
                                });
                            });

                            // Optional: Hide/show buttons based on scroll position
                            function updateButtons() {
                                const isAtStart = wrapper.scrollLeft <= 0;
                                const isAtEnd = wrapper.scrollLeft >= (wrapper.scrollWidth - wrapper.clientWidth);

                                prevBtn.style.opacity = isAtStart ? '0.3' : '1';
                                prevBtn.style.pointerEvents = isAtStart ? 'none' : 'auto';

                                nextBtn.style.opacity = isAtEnd ? '0.3' : '1';
                                nextBtn.style.pointerEvents = isAtEnd ? 'none' : 'auto';
                            }

                            wrapper.addEventListener('scroll', updateButtons);
                            updateButtons(); // Initial check
                        });
                    </script>

                    <div class="tab-content" id="myTabContent">
                        <!-- All Content -->
                        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                            <div class="tab_product">
                                <div class="row align-items-center px-md-3 px-2">
                                    @foreach ($tab_categories as $category)
                                        @php $cat_products = get_tab_category_products($category->slug) @endphp
                                        @if (count($cat_products) > 0)
                                            @php $i=1; @endphp
                                            @foreach ($cat_products as $product)
                                                {{-- @if ($i == 2) @php break; @endphp @endif --}}
                                                @php $data = calculateDiscount($product->id) @endphp

                                                <div class="col-xl-3 col-lg-4 col-md-6 col-6 px-1 px-md-2 mb-4">
                                                    <div class="card-container">
                                                        <div class="card">
                                                            <div class="card-image">
                                                                <div class="group">
                                                                    <a
                                                                        href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                                                        <img src="{{ asset($product->product_thumbnail) }}"
                                                                            alt="{{ $product->name_en }}" />
                                                                    </a>
                                                                </div>
                                                                @if ($product->discount_price != 0)
                                                                    <div class="card-labels">
                                                                        <span class="onsale">{{ $data['text'] }}</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="card-content">
                                                                <h3 class="card-title">
                                                                    <a
                                                                        href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                                                        {{ Str::limit($product->name_en, 43, '...') }}
                                                                    </a>
                                                                </h3>
                                                                <div class="card-price">
                                                                    @if ($product->discount_price != 0)
                                                                        <span>৳{{ $data['discount'] }}</span> –
                                                                        <span>৳{{ $product->regular_price }}</span>
                                                                    @else
                                                                        <span>৳{{ $product->regular_price }}</span>
                                                                    @endif
                                                                </div>
                                                                <div class="card-buttons">
                                                                    @if ($product->stock_qty == 0)
                                                                        <div class="out-of-stock-btn">
                                                                            @if (session()->get('language') == 'bangla')
                                                                                স্টক নেই
                                                                            @else
                                                                                Out of Stock
                                                                            @endif
                                                                        </div>
                                                                    @elseif($product->is_varient == 1)
                                                                        <a href="#" class="btn-select-options"
                                                                            id="{{ $product->id }}"
                                                                            onclick="productView(this.id)"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#quickViewModal">
                                                                            <i class="fas fa-bolt"></i>
                                                                            @if (session()->get('language') == 'bangla')
                                                                                এখুনি কিনুন
                                                                            @else
                                                                                Buy Now
                                                                            @endif
                                                                        </a>
                                                                        <a href="#" class="btn-cart"
                                                                            id="{{ $product->id }}"
                                                                            onclick="productView(this.id)"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#quickViewModal">
                                                                            <i class="fas fa-shopping-cart"></i>
                                                                            @if (session()->get('language') == 'bangla')
                                                                                কার্টে যোগ করুন
                                                                            @else
                                                                                Add to Cart
                                                                            @endif
                                                                        </a>
                                                                    @else
                                                                        <input type="hidden" id="pfrom"
                                                                            value="direct">
                                                                        <input type="hidden" id="product_product_id"
                                                                            value="{{ $product->id }}" min="1">
                                                                        <input type="hidden" id="{{ $product->id }}-product_pname"
                                                                            value="{{ $product->name_en }}">

                                                                        <a href="#" class="btn btn-buy-now"
                                                                            onclick="buyNow({{ $product->id }})">
                                                                            <i class="fas fa-bolt"></i>
                                                                            @if (session()->get('language') == 'bangla')
                                                                                এখুনি কিনুন
                                                                            @else
                                                                                Buy Now
                                                                            @endif
                                                                        </a>
                                                                        <a href="#" class="btn btn-add-cart"
                                                                            onclick="addToCartDirect({{ $product->id }})">
                                                                            <i class="fas fa-shopping-cart"></i>
                                                                            @if (session()->get('language') == 'bangla')
                                                                                কার্টে যোগ করুন
                                                                            @else
                                                                                Add to Cart
                                                                            @endif
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php $i++; @endphp
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>

                            </div>
                        </div>
                        @foreach ($tab_categories as $category)
                            <div class="tab-pane fade" id="{{ $category->id }}" role="tabpanel"
                                aria-labelledby="{{ $category->id }}-tab">
                                <div class="tab_product">
                                    @php $cat_products = get_category_products($category->slug) @endphp
                                    <div class="row align-items-center px-md-3 px-2">
                                        @if (count($cat_products) > 0)
                                            @foreach ($cat_products as $product)
                                                @php $data = calculateDiscount($product->id) @endphp
                                                <div class="col-xl-3 col-lg-4 col-md-6 col-6 px-1 px-md-2 mb-4">
                                                    <div class="card-container">
                                                        <div class="card">
                                                            <div class="card-image">
                                                                <a
                                                                    href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                                                    <img src="{{ asset($product->product_thumbnail) }}"
                                                                        alt="{{ $product->name_en }}" />
                                                                </a>
                                                                @if ($product->discount_price != 0)
                                                                    <div class="card-labels">
                                                                        <span class="onsale">{{ $data['text'] }}</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="card-content">
                                                                <h3 class="card-title">
                                                                    <a
                                                                        href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                                                        {{ Str::limit($product->name_en, 43, '...') }}
                                                                    </a>
                                                                </h3>
                                                                <div class="card-price">
                                                                    @if ($product->discount_price != 0)
                                                                        <span>৳{{ $data['discount'] }}</span> –
                                                                        <span>৳{{ $product->regular_price }}</span>
                                                                    @else
                                                                        <span>৳{{ $product->regular_price }}</span>
                                                                    @endif
                                                                </div>
                                                                <div class="card-buttons">
                                                                    @if ($product->stock_qty == 0)
                                                                        <div class="out-of-stock-btn">
                                                                            @if (session()->get('language') == 'bangla')
                                                                                স্টক নেই
                                                                            @else
                                                                                Out of Stock
                                                                            @endif
                                                                        </div>
                                                                    @elseif($product->is_varient == 1)
                                                                        <a href="#" class="btn-select-options"
                                                                            id="{{ $product->id }}"
                                                                            onclick="productView(this.id)"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#quickViewModal">
                                                                            <i class="fas fa-bolt"></i>
                                                                            @if (session()->get('language') == 'bangla')
                                                                                এখুনি কিনুন
                                                                            @else
                                                                                Buy Now
                                                                            @endif
                                                                        </a>
                                                                        <a href="#" class="btn-cart"
                                                                            id="{{ $product->id }}"
                                                                            onclick="productView(this.id)"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#quickViewModal">
                                                                            <i class="fas fa-shopping-cart"></i>
                                                                            @if (session()->get('language') == 'bangla')
                                                                                কার্টে যোগ করুন
                                                                            @else
                                                                                Add to Cart
                                                                            @endif
                                                                        </a>
                                                                    @else
                                                                        <input type="hidden" id="pfrom"
                                                                            value="direct">
                                                                        <input type="hidden" id="product_product_id"
                                                                            value="{{ $product->id }}" min="1">
                                                                        <input type="hidden" id="{{ $product->id }}-product_pname"
                                                                            value="{{ $product->name_en }}">

                                                                        <a href="#" class="btn btn-buy-now"
                                                                            onclick="buyNow({{ $product->id }})">
                                                                            <i class="fas fa-bolt"></i>
                                                                            @if (session()->get('language') == 'bangla')
                                                                                এখুনি কিনুন
                                                                            @else
                                                                                Buy Now
                                                                            @endif
                                                                        </a>
                                                                        <a href="#" class="btn btn-add-cart"
                                                                            onclick="addToCartDirect({{ $product->id }})">
                                                                            <i class="fas fa-shopping-cart"></i>
                                                                            @if (session()->get('language') == 'bangla')
                                                                                কার্টে যোগ করুন
                                                                            @else
                                                                                Add to Cart
                                                                            @endif
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-12 text-center text-danger">
                                                <strong class="">No Products Available</strong>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

        </div>
    </section>
    <!-- ======================= Products List ======================== -->


    {{-- <div class="d-none">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center">
                        <!-- <h2 class="off_title">New Categories</h2> -->
                        <h3 class="ft-bold pt-md-3 text-dark section-title-bangla mb-2">কেন ল্যাপটপ আছে হতে ল্যাপটপ কিনবেন?
                        </h3>
                        <p class="">বিস্তারিত জানার জন্য নিচের ব্যানার গুলো ক্লিক করুন!</p>
                    </div>
                </div>
            </div>
            <div class="row px-0 lol-gap">
                <div class="col-md-5 col-12">

                    <img class="w-100" src="{{ asset('upload/other-img/sec-one.png') }}" loading="lazy"
alt="">
</div>
<div class="col-md-7 col-12 d-flex align-items-start flex-column justify-content-between"
    style="gap:12px;">
    <a href="">

        <img class="w-100" src="{{ asset('upload/other-img/sec-two.png') }}" loading="lazy"
            alt="">
    </a>
    <a href="">
        <img class="w-100" src="{{ asset('upload/other-img/sec-three.png') }}" loading="lazy"
            alt="">
    </a>
</div>
</div>
</div>
</div> --}}




    <!-- ======================= Recently Added ======================== -->
    <div class="middle my-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center">
                        <h3 class="ft-bold pt-3 section-title">Latest Products</h3>
                    </div>
                </div>
            </div>

            <div class="row align-items-center px-md-3 px-2">
                @foreach ($product_recently_adds as $product)
                    @php $data = calculateDiscount($product->id) @endphp
                    <div class="col-xl-3 col-lg-4 col-md-6 col-6 px-1 px-md-2 mb-4">
                        <div class="card-container">
                            <div class="card">
                                <div class="card-image">
                                    <div class="group">
                                        <a
                                            href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                            <img src="{{ asset($product->product_thumbnail) }}"
                                                alt="{{ $product->name_en }}" />
                                        </a>
                                    </div>
                                    @if ($product->discount_price != 0)
                                        <div class="card-labels">
                                            <span class="onsale">{{ $data['text'] }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-content">
                                    <h3 class="card-title">
                                        <a
                                            href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                            {{ Str::limit($product->name_en, 43, '...') }}
                                        </a>
                                    </h3>
                                    <div class="card-price">
                                        @if ($product->discount_price != 0)
                                            <span>৳{{ $data['discount'] }}</span> –
                                            <span>৳{{ $product->regular_price }}</span>
                                        @else
                                            <span>৳{{ $product->regular_price }}</span>
                                        @endif
                                    </div>
                                    <div class="card-buttons">
                                        @if ($product->stock_qty == 0)
                                            <div class="out-of-stock-btn">
                                                @if (session()->get('language') == 'bangla')
                                                    স্টক নেই
                                                @else
                                                    Out of Stock
                                                @endif
                                            </div>
                                        @elseif($product->is_varient == 1)
                                            <a href="#" class="btn-select-options" id="{{ $product->id }}"
                                                onclick="productView(this.id)" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal">
                                                <i class="fas fa-bolt"></i>
                                                @if (session()->get('language') == 'bangla')
                                                    এখুনি কিনুন
                                                @else
                                                    Buy Now
                                                @endif
                                            </a>
                                            <a href="#" class="btn-cart" id="{{ $product->id }}"
                                                onclick="productView(this.id)" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal">
                                                <i class="fas fa-shopping-cart"></i>
                                                @if (session()->get('language') == 'bangla')
                                                    কার্টে যোগ করুন
                                                @else
                                                    Add to Cart
                                                @endif
                                            </a>
                                        @else
                                            <input type="hidden" id="pfrom" value="direct">
                                            <input type="hidden" id="product_product_id" value="{{ $product->id }}"
                                                min="1">
                                            <input type="hidden" id="{{ $product->id }}-product_pname"
                                                value="{{ $product->name_en }}">

                                            <a href="#" class="btn btn-buy-now"
                                                onclick="buyNow({{ $product->id }})">
                                                <i class="fas fa-bolt"></i>
                                                @if (session()->get('language') == 'bangla')
                                                    এখুনি কিনুন
                                                @else
                                                    Buy Now
                                                @endif
                                            </a>
                                            <a href="#" class="btn btn-add-cart"
                                                onclick="addToCartDirect({{ $product->id }})">
                                                <i class="fas fa-shopping-cart"></i>
                                                @if (session()->get('language') == 'bangla')
                                                    কার্টে যোগ করুন
                                                @else
                                                    Add to Cart
                                                @endif
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- ======================= Recently Added ======================== -->

    <!-- <section class="py-2 mt-md-5 mt-2">
            <div class="container">
                <div class="bg-cover" style=" background-image:url({{ asset($home_banners->first()->banner_img) }})">

                    <div class="row p-4 hts-100 w-100 align-items-center">
                        <div class="col-lg-8 col-md-10 col-sm-12">
                            <div class="tags_explore ">
                                <p style="" class="mb-0 text-dark ft-semibold lol-text">
                                    {{ $home_banners->first()->title_en }}</p>
                                <p class="text-dark fs-md">{{ $home_banners->first()->description_en }}</p>
                                <p>
                                    <a href="{{ route('page.policy') }}" class="btn btn-lg  px-5 text-light ft-medium py-1"
                                        style="background-color: #FF914D; border-radius: 5px;">বিস্তারিত জানতে...</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section> -->

    <!-- ======================= Featured Products ======================== -->
    <div>
        <div class="container">

            <div class="row ">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center">
                        <h3 class="ft-bold pt- section-title">Featured Products</h3>
                    </div>
                </div>
            </div>

            <div class="row align-items-center px-md-3 px-2">
                @foreach ($product_featured as $product)
                    @php $data = calculateDiscount($product->id) @endphp
                    <div class="col-xl-3 col-lg-4 col-md-6 col-6 px-1 px-md-2 mb-4">
                        <div class="card-container">
                            <div class="card">
                                <div class="card-image">
                                    <a
                                        href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                        <img src="{{ asset($product->product_thumbnail) }}"
                                            alt="{{ $product->name_en }}" />
                                    </a>

                                    @if ($product->discount_price != 0)
                                        <div class="card-labels">
                                            <span class="onsale">{{ $data['text'] }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-content">
                                    <h3 class="card-title">
                                        <a
                                            href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                            {{ Str::limit($product->name_en, 43, '...') }}
                                        </a>
                                    </h3>
                                    <div class="card-price">
                                        @if ($product->discount_price != 0)
                                            <span>৳{{ $data['discount'] }}</span> –
                                            <span>৳{{ $product->regular_price }}</span>
                                        @else
                                            <span>৳{{ $product->regular_price }}</span>
                                        @endif
                                    </div>
                                    <div class="card-buttons">
                                        @if ($product->stock_qty == 0)
                                            <div class="out-of-stock-btn">
                                                @if (session()->get('language') == 'bangla')
                                                    স্টক নেই
                                                @else
                                                    Out of Stock
                                                @endif
                                            </div>
                                        @elseif($product->is_varient == 1)
                                            <a href="#" class="btn-select-options" id="{{ $product->id }}"
                                                onclick="productView(this.id)" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal">
                                                <i class="fas fa-bolt"></i>
                                                @if (session()->get('language') == 'bangla')
                                                    এখুনি কিনুন
                                                @else
                                                    Buy Now
                                                @endif
                                            </a>
                                            <a href="#" class="btn-cart" id="{{ $product->id }}"
                                                onclick="productView(this.id)" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal">
                                                <i class="fas fa-shopping-cart"></i>
                                                @if (session()->get('language') == 'bangla')
                                                    কার্টে যোগ করুন
                                                @else
                                                    Add to Cart
                                                @endif
                                            </a>
                                        @else
                                            <input type="hidden" id="pfrom" value="direct">
                                            <input type="hidden" id="product_product_id" value="{{ $product->id }}"
                                                min="1">
                                            <input type="hidden" id="{{ $product->id }}-product_pname"
                                                value="{{ $product->name_en }}">

                                            <a href="#" class="btn btn-buy-now"
                                                onclick="buyNow({{ $product->id }})">
                                                <i class="fas fa-bolt"></i>
                                                @if (session()->get('language') == 'bangla')
                                                    এখুনি কিনুন
                                                @else
                                                    Buy Now
                                                @endif
                                            </a>
                                            <a href="#" class="btn btn-add-cart"
                                                onclick="addToCartDirect({{ $product->id }})">
                                                <i class="fas fa-shopping-cart"></i>
                                                @if (session()->get('language') == 'bangla')
                                                    কার্টে যোগ করুন
                                                @else
                                                    Add to Cart
                                                @endif
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <!-- ======================= Featured Products ======================== -->

    <!-- ======================= Trending Products ======================== -->
    <div class="my-3">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center">
                        <h3 class="ft-bold section-title">Trending Products</h3>
                    </div>
                </div>
            </div>

            <div class="row align-items-center px-md-3 px-2">
                @foreach ($product_trendings as $product)
                    @php $data = calculateDiscount($product->id) @endphp
                    <div class="col-xl-3 col-lg-4 col-md-6 col-6 px-1 px-md-2 mb-4">
                        <div class="card-container">
                            <div class="card">
                                <div class="card-image">
                                    <div class="group">
                                        <a
                                            href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                            <img src="{{ asset($product->product_thumbnail) }}"
                                                alt="{{ $product->name_en }}" />
                                        </a>
                                    </div>
                                    @if ($product->discount_price != 0)
                                        <div class="card-labels">
                                            <span class="onsale">{{ $data['text'] }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-content">
                                    <h3 class="card-title">
                                        <a
                                            href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                            {{ Str::limit($product->name_en, 43, '...') }}
                                        </a>
                                    </h3>
                                    <div class="card-price">
                                        @if ($product->discount_price != 0)
                                            <span>৳{{ $data['discount'] }}</span> –
                                            <span>৳{{ $product->regular_price }}</span>
                                        @else
                                            <span>৳{{ $product->regular_price }}</span>
                                        @endif
                                    </div>
                                    <div class="card-buttons">
                                        @if ($product->stock_qty == 0)
                                            <div class="out-of-stock-btn">
                                                @if (session()->get('language') == 'bangla')
                                                    স্টক নেই
                                                @else
                                                    Out of Stock
                                                @endif
                                            </div>
                                        @elseif($product->is_varient == 1)
                                            <a href="#" class="btn-select-options" id="{{ $product->id }}"
                                                onclick="productView(this.id)" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal">
                                                <i class="fas fa-bolt"></i>
                                                @if (session()->get('language') == 'bangla')
                                                    এখুনি কিনুন
                                                @else
                                                    Buy Now
                                                @endif
                                            </a>
                                            <a href="#" class="btn-cart" id="{{ $product->id }}"
                                                onclick="productView(this.id)" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal">
                                                <i class="fas fa-shopping-cart"></i>
                                                @if (session()->get('language') == 'bangla')
                                                    কার্টে যোগ করুন
                                                @else
                                                    Add to Cart
                                                @endif
                                            </a>
                                        @else
                                            <input type="hidden" id="pfrom" value="direct">
                                            <input type="hidden" id="product_product_id" value="{{ $product->id }}"
                                                min="1">
                                            <input type="hidden" id="{{ $product->id }}-product_pname"
                                                value="{{ $product->name_en }}">

                                            <a href="#" class="btn btn-buy-now"
                                                onclick="buyNow({{ $product->id }})">
                                                <i class="fas fa-bolt"></i>
                                                @if (session()->get('language') == 'bangla')
                                                    এখুনি কিনুন
                                                @else
                                                    Buy Now
                                                @endif
                                            </a>
                                            <a href="#" class="btn btn-add-cart"
                                                onclick="addToCartDirect({{ $product->id }})">
                                                <i class="fas fa-shopping-cart"></i>
                                                @if (session()->get('language') == 'bangla')
                                                    কার্টে যোগ করুন
                                                @else
                                                    Add to Cart
                                                @endif
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- ======================= Trending Products ======================== -->

    <!-- ======================= content ============ ================= -->



    <style>
        :root {
            --primary: #ff914d;
            --primary-dark: #ff7a2f;
            --primary-light: #ffb380;
            --dark: #1a1a2e;
            --text: #2d3436;
            --text-light: #636e72;
            --bg: #f8f9fa;
            --white: #ffffff;
            --shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 15px 50px rgba(255, 145, 77, 0.25);
        }





        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #fff5ed 0%, #ffffff 50%, #fff5ed 100%);
            border-radius: 24px;
            padding: 80px 40px;
            text-align: center;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 145, 77, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 145, 77, 0.08) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            font-size: clamp(2rem, 5vw, 3.5rem);
            color: var(--dark);
            font-weight: 800;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero h1 span {
            color: var(--primary);
            display: inline-block;
        }

        .hero p {
            font-size: clamp(1rem, 2vw, 1.3rem);
            color: var(--text-light);
            max-width: 800px;
            margin: 0 auto;
        }

        /* Grid Layout */
        .grid-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
            margin-top: 40px;
        }

        @media (min-width: 1024px) {
            .grid-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Card Styles */
        .cards {
            background: var(--white);
            border-radius: 20px;
            padding: 40px;
            box-shadow: var(--shadow);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .cards::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary) 0%, var(--primary-light) 100%);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .cards:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
        }

        .cards:hover::before {
            transform: scaleX(1);
        }

        .cards h2 {
            font-size: clamp(1.5rem, 3vw, 2rem);
            color: var(--dark);
            margin-bottom: 20px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .cards h2::before {
            content: '';
            width: 6px;
            height: 40px;
            background: linear-gradient(180deg, var(--primary) 0%, var(--primary-light) 100%);
            border-radius: 3px;
        }

        .cards h3 {
            font-size: 1.3rem;
            color: var(--text);
            margin: 30px 0 15px 0;
            font-weight: 600;
        }

        .cards p {
            color: var(--text-light);
            margin-bottom: 15px;
            line-height: 1.8;
        }

        /* Feature List */
        .feature-list {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }

        .feature-list li {
            padding: 16px 20px 16px 50px;
            margin-bottom: 12px;
            background: linear-gradient(135deg, #fff5ed 0%, #ffffff 100%);
            border-radius: 12px;
            position: relative;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .feature-list li:hover {
            border-left-color: var(--primary);
            transform: translateX(8px);
            box-shadow: 0 5px 20px rgba(255, 145, 77, 0.15);
        }

        .feature-list li::before {
            content: '✓';
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 26px;
            height: 26px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
        }

        .feature-list li strong {
            color: var(--primary);
            font-weight: 600;
        }

        .feature-list ul {
            margin-top: 12px;
            padding-left: 0;
        }

        .feature-list ul li {
            background: transparent;
            padding: 10px 0 10px 30px;
            border-left: none;
        }

        .feature-list ul li::before {
            content: '→';
            background: none;
            color: var(--primary);
            width: auto;
            height: auto;
            font-size: 18px;
            left: 0;
        }

        /* Table Styles */
        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 25px 0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .data-table thead {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        }

        .data-table th {
            padding: 18px;
            text-align: left;
            color: white;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .data-table td {
            padding: 16px 18px;
            border-bottom: 1px solid #f0f0f0;
            background: var(--white);
        }

        .data-table tbody tr {
            transition: all 0.3s ease;
        }

        .data-table tbody tr:hover {
            background: #fff5ed !important;
        }

        .data-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* FAQ Section */
        .faq-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
            margin-top: 25px;
        }

        @media (min-width: 768px) {
            .faq-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .faq-item {
            background: linear-gradient(135deg, #fff5ed 0%, #ffffff 100%);
            border-radius: 16px;
            padding: 24px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .faq-item:hover {
            border-color: var(--primary-light);
            box-shadow: 0 8px 25px rgba(255, 145, 77, 0.15);
        }

        .faq-question {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
        }

        .faq-question h3 {
            color: var(--text);
            font-size: 1.05rem;
            font-weight: 600;
            margin: 0;
            flex: 1;
        }

        .faq-toggle {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
            transition: transform 0.3s ease;
            font-weight: 300;
        }

        .faq-item.active .faq-toggle {
            transform: rotate(45deg);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease;
        }

        .faq-item.active .faq-answer {
            max-height: 500px;
            margin-top: 15px;
        }

        .faq-answer p {
            color: var(--text-light);
            line-height: 1.7;
            margin: 0;
        }

        /* Testimonials */
        .testimonial-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 25px;
            margin: 30px 0;
        }

        @media (min-width: 768px) {
            .testimonial-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .testimonial-card {
            background: linear-gradient(135deg, #fff5ed 0%, #ffffff 100%);
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary);
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 35px rgba(255, 145, 77, 0.2);
        }

        .testimonial-image {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            border: 3px solid var(--primary);
            margin-bottom: 20px;
            object-fit: cover;
        }

        .testimonial-text {
            font-style: italic;
            color: var(--text-light);
            margin-bottom: 15px;
            line-height: 1.8;
        }

        .testimonial-author {
            text-align: right;
            color: var(--primary);
            font-weight: 600;
            font-size: 0.95rem;
        }

        /* CTA Section */
        .cta-box {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 60px 40px;
            border-radius: 24px;
            text-align: center;
            margin: 50px 0;
            box-shadow: 0 20px 50px rgba(255, 145, 77, 0.3);
            position: relative;
            overflow: hidden;
        }

        .cta-box::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .cta-content {
            position: relative;
            z-index: 1;
        }

        .cta-box h3 {
            color: white;
            font-size: clamp(1.8rem, 4vw, 2.5rem);
            margin-bottom: 15px;
            font-weight: 700;
        }

        .cta-subtitle {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.95;
        }

        .cta-info {
            font-size: 1.1rem;
            margin: 12px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;

        }

        .cta-info a {

            color: white;
        }

        .cta-button {
            background: white;
            color: var(--primary);
            padding: 16px 45px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 25px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
        }

        /* Links */
        a {
            color: var(--primary);
            text-decoration: none;
            transition: all 0.3s ease;
            border-bottom: 1px solid transparent;
        }

        a:hover {
            border-bottom-color: var(--primary);
        }

        /* Full Width Card */
        .full-width-card {
            grid-column: 1 / -1;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .cards {
            animation: fadeInUp 0.6s ease forwards;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                /* padding: 15px; */
            }

            .hero {
                padding: 50px 25px;
            }

            .cards {
                padding: 25px;
            }

            .data-table {
                font-size: 0.85rem;
                display: block;
                overflow-x: auto;
            }

            .data-table th,
            .data-table td {
                padding: 12px 10px;
            }

            .cta-box {
                padding: 40px 25px;
            }

            .feature-list li {
                padding: 14px 16px 14px 45px;
            }
        }
    </style>

    <div class="container">
        <!-- Hero Section -->
        <div class="hero">
            <div class="hero-content">
                <p>If you're comparing 2nd hand laptop prices in BD, you'll see that our units offer unbeatable
                    value for money.</p>
            </div>
        </div>

        <!-- Main Grid -->
        <div class="grid-container">
            <!-- Why Choose Us -->
            <div class="cards">
                <h2>Why Should You Choose Laptop Ache for Your Used Laptop?</h2>
                <p>When looking for the best used laptop prices in Bangladesh, you need a reliable partner you can trust. At
                    our used laptop shop in Dhaka, we don't just sell laptops; we provide reliable solutions that fit your
                    needs and budget.</p>

                <ul class="feature-list">
                    <li><strong>A+ Grade Laptops from Dubai:</strong> Each laptop looks almost new and delivers top-tier
                        performance.</li>
                    <li><strong>21+ Point Quality Check:</strong> Our experts inspect over 21 points, including the
                        keyboard, screen, and battery, on every single device. <a href="/price-stock-quality">See Our Full
                            Checklist Here</a></li>
                    <li><strong>40-day Replacement Warranty:</strong> Shop with confidence. We are here for you if any issue
                        arises.</li>
                    <li><strong>3-Year Free Service Warranty:</strong> Get free service for any software or hardware issues
                        for 3 entire years (without parts).</li>
                    <li><strong>Physical Store in Badda:</strong> You can visit our store to see, touch, and test your
                        preferred laptop before buying.</li>
                </ul>

                <p>Many buyers also look for the latest second-hand laptop price in BD — Laptop Ache stands out by offering
                    genuine quality with <a href="#checklist">verified import records</a>.</p>

                <p>Laptop Ache is widely recognized as one of the most trusted used laptop showrooms in
                    Dhaka. It offers hands-on testing and reliable after-sales support.</p>
            </div>

            <!-- Pricing Section -->
            <div class="cards">
                <h2>What Are the Average Used Laptop Prices in
                    Bangladesh? </h2>
                <p>When you're planning your budget, it helps to understand the second-hand laptop price in Bangladesh
                    according to processor and category. Below are real, verified price estimates from our data.</p>

                <h3>Price Summary by Processor Type:</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Processor & Model</th>
                            <th>Estimated Price Range (BDT)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="/product/shop?processors%5B%5D=Intel&generation%5B%5D=Intel+5th+Gen">Core i5</a>
                                (Up to 8th Gen)</td>
                            <td>৳ 25,000 - ৳ 35,000</td>
                        </tr>
                        <tr>
                            <td><a href="/product/shop?processors%5B%5D=Intel&generation%5B%5D=Intel+7th+Gen">Core i7</a>
                                (Up to 8th Gen)</td>
                            <td>৳ 40,000 - ৳ 60,000</td>
                        </tr>
                        <tr>
                            <td>Gaming Laptops (with GPU)</td>
                            <td>৳ 45,000 - ৳ 80,000+</td>
                        </tr>
                        <tr>
                            <td><a href="/product/shop?processors%5B%5D=AMD&generation%5B%5D=Ryzen+5000+Series">Ryzen 5</a>
                                Laptops</td>
                            <td>৳ 25,000 - ৳ 40,000</td>
                        </tr>
                        <tr>
                            <td><a href="/product/shop?processors%5B%5D=AMD&generation%5B%5D=Ryzen+5000+Series">Ryzen 7</a>
                                Laptops</td>
                            <td>৳ 40,000 - ৳ 65,000+</td>
                        </tr>
                    </tbody>
                </table>

                <p><strong>Note:</strong> Prices may vary based on the specific model, specifications, and condition. Price
                    ranges are based on Laptop Ache's October 2025 <a href="/price-stock-quality">internal dataset</a> and
                    verified market
                    listings from <a href="https://bikroy.com/bn/ads?query=used%20laptop">Bikroy.com</a> and <a
                        href="https://www.bdstall.com/used-laptop/">bdstall.com</a>.</p>
            </div>

            <!-- Best Value Laptops -->
            <div class="cards">
                <h2>What Are The 4 Best-Value Used Laptops To Buy in
                    Bangladesh Right Now, And Are They Available At The
                    Best Prices? </h2>
                <p>Based on our sales over the past 6 months, these 4 laptops offer the best value:</p>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Recommended Model (A+ Grade)</th>
                            <th>Core/Gen</th>
                            <th>Key Specs</th>
                            <th>Best For</th>
                            <th>Price Range (BDT)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a
                                    href="/product-details/206/HP-EliteBook-840-G6-Core-i5-8th-Gen-8GB-256GB-SSD-Laptop-Oe2Ug">HP
                                    EliteBook 840 G6</a></td>
                            <td>i5 (8th Gen)</td>
                            <td>8GB RAM, 256GB SSD</td>
                            <td>Students & Office Work</td>
                            <td>৳29,500 – ৳33,000</td>
                        </tr>
                        <tr>
                            <td><a href="/product-details/215/Dell-Latitude-7490-Core-i5-8th-Gen-Laptop-9HzqB">Dell
                                    Latitude 7490</a></td>
                            <td>i5 (8th Gen)</td>
                            <td>8GB RAM, 256GB NVMe SSD</td>
                            <td>Freelancers & Multitasking</td>
                            <td>৳25,000 – ৳27,000</td>
                        </tr>
                        <tr>
                            <td><a href="/product/shop?category%5B%5D=Lenovo">Lenovo ThinkPad T480s</a></td>
                            <td>i7 (6th Gen)</td>
                            <td>18GB RAM, 256GB SSD</td>
                            <td>Business & Portability</td>
                            <td>৳24,000 – ৳26,000</td>
                        </tr>
                        <tr>
                            <td><a
                                    href="/product-details/184/-Microsoft-Surface-Laptop-2-Core-i7-8th-Gen-133-Glossy-2k-Touchscreen-16GB-RAM-Laptop-nz3Uq">Microsoft
                                    Surface Laptop 2</a></td>
                            <td>i7 (8th Gen)</td>
                            <td>8GB RAM, 256GB SSD</td>
                            <td>Design & Premium Look</td>
                            <td>৳44,000 – ৳47,000</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="cards">
                <h2>Which Used Laptop Is Best for You in Bangladesh?</h2>
                <p>The best used laptop depends on your budget, brand preference, and work type.</p>
                <h3>Explore the latest used laptop prices in Bangladesh and choose your
                    ideal model by brand, budget, or purpose.</h3>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>By Budget</th>
                            <th>By Brand </th>
                            <th>By Use Case</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Under ৳20,000</td>
                            <td><a href="/product/shop?category%5B%5D=Dell">Dell Laptops</a></td>
                            <td>For Students</td>
                        </tr>
                        <tr>
                            <td>৳25,000 - ৳40,000 </td>
                            <td><a href="/product/shop?category%5B%5D=Hewlett-Packard+%28HP%29">HPl Laptops</a></td>
                            <td>For Freelancers </td>
                        </tr>
                        <tr>
                            <td>Over ৳40,000 </td>
                            <td><a href="/product/shop?category%5B%5D=Microsoft+Surface">Microsoft
                                    surface</a> </td>
                            <td>For Business</td>
                        </tr>
                        <tr>
                            <td>Lenovo Collection</td>
                            <td><a href="/product/shop?category%5B%5D=Lenovo">Lenovo
                                    Laptops </a></td>
                            <td>For Gaming & Graphics </td>
                        </tr>
                    </tbody>
                </table>

                <p>Whether you're checking the 2nd hand laptop price in BD or looking for high-performance
                    models for work, our selection covers every price point.</p>
            </div>

            <!-- Specifications Guide -->
            <div class="cards">
                <h2>Minimum Specs for Professional Used Laptops in 2025 </h2>
                <h3>How to Choose RAM and Processor? </h3>
                <h4>The Freelancer's Checklist </h4>

                <ul class="feature-list">
                    <li><strong>Processor (CPU):</strong> Aim for an 8th Generation <a
                            href="/product/shop?processors%5B%5D=Intel">Intel</a> Core i5 (or <a
                            href="/product/shop?processors%5B%5D=AMD">Ryzen</a> 5 equivalent) or newer for smooth
                        multitasking and professional applications.</li>
                    <li><strong>RAM (Memory):</strong>
                        <ul>
                            <li>16GB DDR4 is the new standard for freelancers, power users, and anyone looking to
                                future-proof their device for 3-5 years.</li>
                            <li>8GB is manageable for students and light tasks, but can easily cause performance
                                bottlenecks.</li>
                        </ul>
                    </li>
                    <li><strong>Storage (Speed):</strong> An SSD (Solid State Drive) is non-negotiable for fast boot times
                        and application loading.
                        <ul>
                            <li>Minimum: 256GB NVMe SSD</li>
                            <li>Optimal Choice: 512GB NVMe SSD</li>
                        </ul>
                    </li>
                </ul>
            </div>

            <!-- A+ Grade Explanation -->
            <div class="cards">
                <h2>What Does "A+ Grade" Mean for Used Laptops?</h2>
                <p>A+ Grade" means the device looks almost new and performs at 100% capacity after strict
                    inspection. </p>

                <h3>We believe in transparency. Here is the <a href="/price-stock-quality">checklist</a> we follow to
                    ensure every laptop meets our A+ Grade standard:</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Checklist</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>✓ Cosmetic Condition</td>
                            <td>No major scratches or dents; may have minimal signs of use.</td>
                        </tr>
                        <tr>
                            <td>✓ Screen</td>
                            <td>No dead pixels, flickering, or discoloration.</td>
                        </tr>
                        <tr>
                            <td>✓ Battery Health</td>
                            <td>Minimum 90% battery health and a 3-4 hour backup guarantee.</td>
                        </tr>
                        <tr>
                            <td>✓ Full Functionality</td>
                            <td>Keyboard, ports, Wi-Fi, and webcam are all fully functional.</td>
                        </tr>
                        <tr>
                            <td>✓ No Internal Issues</td>
                            <td>Inspected and verified by our certified technicians with over 10+ years of combined
                                experience. <button class="btn" style="background-color: #FF863E; color: white; "
                                    onclick="window.location.href='/about-us#our-team'">Meet Our Team</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="cards">

                <h2>
                    What Is The Story Behind Laptop Ache?
                </h2>
                <p>
                    Laptop Ache is a verified used laptop importer and retailer based in Badda, Dhaka. It
                    specializes in A+ Grade Dubai-imported laptops with full warranties.
                </p>
                <p>Laptop Ache (ল্যাপটপ আেছ) is more than just a shop; it's a name you can trust. We have
                    noticed that the dreams of many talented students and freelancers have been put on hold
                    due to the high price of used laptops in Bangladesh, putting quality devices out of their
                    reach.. To bridge this gap, we started our journey with a mission: to make reliable technology
                    accessible to everyone. We're committed to understanding exactly what you need and
                    providing the highest quality Dubai-imported laptops to match.
                </p>

                <h3>About the Author:</h3>

                <p>The Laptop Ache editorial team wrote and verified this page. They are experts with over 5+
                    years of experience in laptop import, testing, and repair in Bangladesh.
                </p>
            </div>

            <div class="cards full-width-card"> 
                <h3>
                    A Message from Our Founder:
                </h3>

                <p>
                    Hello! <a href="/about-us#ceo">I am Ibrahim Hossain</a>. I started Laptop Ache because I believe
                    everybody should be
                    able to achieve their dreams. A good, reliable laptop should not be a privilege; it should be
                    accessible.
                </p>

                <p>
                    I've seen too many talented students and hardworking freelancers in our community stuck
                    using slow and unreliable devices or feeling like a new laptop would be out of reach
                    financially. Their potential was trapped within expensive technology.
                </p>

                <p>
                    That is why I made it my mission to find a better solution. We source only A+ Grade,
                    business-class laptops directly from Dubai—laptops engineered for performance and
                    endurance. Trust is important. Every laptop or device we offer is one I would have no
                    problem giving to my own family and is fully covered by our quality assurance and warranty.
                </p>

                <p>
                    To me, Laptop Ache (ল্যাপটপ আেছ) is more than a business; it's about community
                    empowerment. My aim is to help you find the correct tool for the journey ahead. Thank you
                    for understanding.
                </p>
            </div>

            <div class="cards full-width-card">
                <p>Stop by to discover the latest laptops and find your perfect match and confirm the real used
                    laptop price in Bangladesh directly at our showroom.
                </p>
                <p id="checklist">Due to import confidentiality and supplier agreements, the original Dubai reseller
                    records
                    and import documentation cannot be displayed online, but are available for verification at our
                    showroom. </p>
            </div>

            <!-- FAQ Section -->
            <div class="cards full-width-card">
                <h2>Frequently Asked Questions</h2>
                <p>Have Questions? We Have Answers.</p>

                <div class="faq-grid">
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>Where is your showroom located?</h3>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>Our showroom is at SHA-41/1, Behind Hossain Market, Uttar Badda, Dhaka. <a
                                    href="https://maps.app.goo.gl/ynngimXGG3parMCL9">See our location on Google Maps</a>
                            </p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>What kind of laptops do you sell?</h3>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>We sell A+ grade, Dubai-imported used laptops from top <a href="/categories">brands</a> like
                                <a href="/product/shop?category%5B%5D=Hewlett-Packard+%28HP%29">HP</a>, <a
                                    href="/product/shop?category%5B%5D=Dell">Dell</a>, and <a
                                    href="/product/shop?category%5B%5D=Lenovo">Lenovo</a>.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>What is the price for Core i5 & i7 laptops?</h3>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            <p><a href="/product/shop?generation%5B%5D=Intel+5th+Gen">Core i5</a> models typically range
                                from ৳25,000 - ৳35,000, while <a href="/product/shop?generation%5B%5D=Intel+7th+Gen">Core
                                    i7</a> models are available from ৳40,000 - ৳60,000.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>Do the laptops come with a warranty?</h3>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>Yes, every laptop includes a <a href="/product/warrenty">40-day replacement</a> guarantee
                                and a 3-Year Free service warranty.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>Can I upgrade the laptop later?</h3>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>Absolutely! You can easily upgrade components like RAM and SSD either from us or from any
                                other shop.</p>
                        </div>
                    </div>


                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>Is buying a used laptop in 2025 still a good idea?</h3>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>Absolutely. It is one of the smartest tech decisions you can make. You get access to
                                powerful, business-class hardware for 40-60% less than the cost of a new device.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <h3> What is a realistic price for a good used Core i5 laptop in Bangladesh?</h3>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>As of late 2025, a good condition Core i5 laptop (8th Gen or newer) with an SSD and 8GB
                                RAM typically costs between Tk 25,000 and Tk 38,000. Prices vary based on brand and
                                specific model. </p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>Which shop is the most reliable for used laptops in Dhaka? </h3>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>: Laptop Ache in Badda is widely recognized for its reliability due to its mandatory <a
                                    href="/price-stock-quality">21+ point
                                    certification</a>, Dubai-imported A+ grade units, and a strong 40-day replacement
                                guarantee
                                with a 3-year service warranty. </p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <h3> Do used laptop prices in Bangladesh always stay the same, or do they fluctuate?
                            </h3>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>The price actually fluctuates frequently. It mainly depends on the value of the dollar,
                                import costs, market demand, and the condition of the laptop. For example, when the value of
                                the dollar increases, the price usually increases as well. But if there is a lot of stock in
                                the market, you will often see the price decrease slightly.</p>
                        </div>
                    </div>


                </div>

                <p class="mt-5">Still unsure which model offers the best value for your budget? Visit our showroom to
                    explore
                    the second-hand laptop price in Bangladesh and compare real units side by side. </p>
            </div>

            <!-- Testimonials -->
            <div class="cards full-width-card">
                <h2>What Our Satisfied Customers Are Saying? </h2>
                <p>Our customers are very happy with our service. They have also given their reviews after
                    purchasing laptops from us.</p>

                <div class="testimonial-grid">
                    <div class="testimonial-card">
                        <img class="testimonial-image" src={{ asset('FrontEnd/assets/img/akram-hossain.png') }}
                            alt="Akram Hossen">
                        <p class="testimonial-text">"I bought a Microsoft Surface 3... It is amazing. Special thanks to
                            Mukter vai... I think Laptop Ache is the best used laptop showroom in Dhaka. I am very pleased
                            with their service. Go ahead, Laptop Ache... Best wishes."</p>
                        <div class="testimonial-author">— Akram Hossen, Freelancer, Dhaka</div>
                    </div>

                    <div class="testimonial-card">
                        <img class="testimonial-image" src={{ asset('FrontEnd/assets/img/majurul-ismal.png') }}
                            alt="Manjurul Islam">
                        <p class="testimonial-text">"I have purchased a laptop from Laptop Ache, and I feel that I
                            purchased a new laptop. The battery backup and display resolution are awesome. I recommend
                            purchasing any reused laptop from Laptop Ache and getting a 40-day replacement warranty to
                            secure your money."</p>
                        <div class="testimonial-author">— Md Manjurul Islam, Businessman</div>
                    </div>
                </div>

                <p>Laptop Ache maintains a 4.6/5 rating based on verified <a
                        href="https://www.google.com/search?sca_esv=faf8fed3686593cc&sxsrf=AE3TifMhOoLmPv7eyZWToPgKCo9kT3liiw:1761552327375&si=AMgyJEtREmoPL4P1I5IDCfuA8gybfVI2d5Uj7QMwYCZHKDZ-E-j84cRZeCP438eR7dt4cfDJGL5Wfjs3YjCqCk2G3CIB4AG0VlQrRR-1uuG2_fQEvYCgVcrQxs0M-AcKTkA84vzp3yjREsxtpd7waXU9wV1Y1tBdB2b2nBAkwE3rNBEf45x_JPU0VZ4XGZem8113fT0Fg-CrEaYVITBP0VBvzCYx3JvHOg%3D%3D&q=Laptop+Ache+%7C+Used+Laptop+Shop+in+Dhaka,+Bangladesh+%E2%80%93+Best+Deals+Reviews&sa=X&ved=2ahUKEwje1efl9cOQAxUEyTgGHdeFD4MQ0bkNegQINxAE&biw=1280&bih=551&dpr=1.5">Google</a>
                    and Facebook customer reviews.</p>

                <p>For many buyers, checking the second-hand laptop price in Bangladesh is the first step
                    toward finding a reliable device. At Laptop Ache, we ensure that affordability never means
                    compromising on quality.</p>
            </div>
        </div>

        <!-- CTA Box -->
        <div class="cta-box">
            <div class="cta-content">
                <h3>Visit Our Showroom Today</h3>
                <p class="cta-subtitle">Laptop Ache | Best Used Laptop Shop in Dhaka, Bangladesh</p>
                <div class="cta-info"><a
                        href="https://www.google.com/maps/search/?api=1&query=SHA-41/1+Behind+Hossain+Market+Uttar+Badda+Dhaka+1212"
                        target="_blank">
                        📍 SHA-41/1, Behind Hossain Market, Uttar Badda, Dhaka
                    </a>
                </div>
                <div class="cta-info">📞<a href="callto:+8801901378164"> +8801901378164</a>,<a
                        href="callto:+8801780966740"> +8801780966740</a></div>
                <div class="cta-info">🕒 9:00 AM – 10:00 PM (Saturday - Thursday)</div>
                <button class="cta-button">
                    <a href="/contact-us">Contact Us</a>
                </button>

            </div>
        </div>
    </div>

    <script>
        // FAQ Toggle Functionality
        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(item => {
            item.addEventListener('click', () => {
                const isActive = item.classList.contains('active');

                // Close all other FAQs
                faqItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                    }
                });

                // Toggle current FAQ
                if (!isActive) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });
        });

        // Intersection Observer for fade-in animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all cards
        document.querySelectorAll('.card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            observer.observe(card);
        });

        // Contact button click
        document.querySelector('.cta-button').addEventListener('click', () => {
            window.location.href = 'tel:+8801901378164';
        });
    </script>


    <!-- <div class="container row g-4 pb-4" style="">
        <div class="col-md-6 col-12 px-2">
            <div class="info-card p-4 shadow-sm rounded bg-white" style="height: 100%;">
                <h4 class="mb-2" style="color:#FF914D;">Company Overview</h4>
                <p style="color:#333; font-size:1rem;">
                    LaptopAche is Bangladesh’s trusted laptop retailer, offering authentic products, competitive prices, and expert support. With years of experience, we help customers find the perfect device for work, study, or entertainment.
                </p>
            </div>
        </div>
        <div class="col-md-6 col-12 px-2 mt-md-0 mt-3">
            <div class="info-card p-4 shadow-sm rounded bg-white" style="height: 100%;">
                <h4 class="mb-2" style="color:#FF914D;">Our Mission</h4>
                <p style="color:#333; font-size:1rem;">
                    To deliver quality laptops and accessories at the best prices, ensuring customer satisfaction through reliable service, fast delivery, and genuine warranty support.
                </p>
            </div>
        </div>
        <div class="col-md-6 col-12 px-2 mt-3">
            <div class="info-card p-4 shadow-sm rounded bg-white" style="height: 100%;">
                <h4 class="mb-2" style="color:#FF914D;">Why Choose Us?</h4>
                <ul style="color:#333; font-size:1rem; padding-left:1.2em;">
                    <li>100% Authentic Products</li>
                    <li>0-3 Years Official Warranty</li>
                    <li>Expert Customer Support</li>
                    <li>Fast Nationwide Delivery</li>
                    <li>Best Price Guarantee</li>
                </ul>
            </div>
        </div>
        <div class="col-md-6 col-12 px-2 mt-3">
            <div class="info-card p-4 shadow-sm rounded bg-white" style="height: 100%;">
                <h4 class="mb-2" style="color:#FF914D;">Frequently Asked Questions</h4>
                <p style="color:#333; font-size:1rem;">
                    <strong>Q:</strong> Do you offer warranty?<br>
                    <strong>A:</strong> Yes, all products come with official warranty.<br><br>
                    <strong>Q:</strong> How fast is delivery?<br>
                    <strong>A:</strong> We deliver nationwide within 1-3 business days.<br>
                    <a href="{{ route('page.faq') }}" style="color:#FF914D; text-decoration:underline;">See more FAQs</a>
                </p>
            </div>
        </div>
    </div> -->


    <!-- ======================= content ============================ -->


    <!-- ======================= Customer Features ======================== -->
@endsection
{{-- @section('content') --}}
{{-- <!-- Option & Slider Part Start --> --}}
{{-- <style> --}}
{{-- @media screen and (min-width: 991px) { --}}
{{-- .buy_now { --}}
{{-- width: 73px !important; --}}
{{-- font-size: 13px !important; --}}
{{-- font-weight: 600; --}}
{{-- margin-top: 10px; --}}
{{-- color: var(--yellow); --}}
{{-- border: 1px solid var(--yellow); --}}
{{-- background: transparent; --}}
{{-- } --}}
{{-- .add_to_cart { --}}
{{-- width: 95px !important; --}}
{{-- font-size: 13px !important; --}}
{{-- font-weight: 600; --}}
{{-- margin-top: 10px; --}}
{{-- color: var(--yellow); --}}
{{-- border: 1px solid var(--yellow); --}}
{{-- background: transparent; --}}
{{-- } --}}
{{-- } --}}
{{-- .deals-countdown-wrap { --}}
{{-- text-align: center; --}}
{{-- margin: 20px 0; --}}
{{-- } --}}


{{-- /*.btn-group button{*/ --}}
{{-- /*    margin-right: 5px;*/ --}}
{{-- /*}*/ --}}

{{-- #deals-countdown { --}}
{{-- font-size: 24px; --}}
{{-- color: #333; --}}
{{-- padding: 10px; --}}
{{-- background-color: #f0f0f0; --}}
{{-- border: 1px solid #ccc; --}}
{{-- } --}}
{{-- .loading::after { --}}
{{-- content: ''; --}}
{{-- display: inline-block; --}}
{{-- width: 16px; --}}
{{-- height: 16px; --}}
{{-- border: 2px solid #fff; --}}
{{-- border-top: 2px solid #3498db; --}}
{{-- border-radius: 50%; --}}
{{-- animation: spin 1s linear infinite; --}}
{{-- margin-left: 5px; --}}
{{-- /* Adjust as needed */ --}}
{{-- vertical-align: middle; --}}
{{-- } --}}

{{-- @keyframes spin { --}}
{{-- 0% { --}}
{{-- transform: rotate(0deg); --}}
{{-- } --}}

{{-- 100% { --}}
{{-- transform: rotate(360deg); --}}
{{-- } --}}
{{-- } --}}

{{-- .counter-title { --}}
{{-- color: #000 !important; --}}
{{-- font-size: 10px !important; --}}
{{-- background: #fff !important; --}}
{{-- padding: 0px !important; --}}
{{-- } --}}

{{-- </style> --}}
{{-- <!-- Desktop Option & Slider Part Start --> --}}
{{-- <section class="option-slider container mt-lg-5"> --}}
{{-- <input type="hidden" id="language_status" value="{{session()->get('language')}}"> --}}
{{-- <div> --}}
{{-- <div class="row"> --}}
{{-- <!-- Side Menu Start --> --}}
{{-- <div class="col-md-3 d-none d-lg-block"> --}}
{{-- <div class="sidemenu"> --}}
{{-- <ul> --}}
{{-- <li class="dropdown"><a href="{{route('category_list.index')}}"> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- অল ক্যাটেগরীজ --}}
{{-- @else --}}
{{-- All Categories --}}
{{-- @endif --}}
{{-- <span>&rsaquo;</span></a> --}}
{{-- @foreach ($categories as $category) --}}
{{-- @if ($category->type == 1) --}}
{{-- @php $parent = $category->id @endphp --}}
{{-- <li class="dropdown"><a href="{{route('product.category', $category->slug)}}"> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- {{$category->name_bn}} --}}
{{-- @else --}}
{{-- {{$category->name_en}} --}}
{{-- @endif --}}
{{-- <span>&rsaquo;</span></a> --}}
{{-- @php $child = findChildCategory($category->id) @endphp --}}
{{-- @if (count($child) > 0) --}}
{{-- <ul> --}}
{{-- @foreach ($categories as $subcategory) --}}
{{-- @if ($subcategory->parent_id == $category->id) --}}
{{-- <li class="dropdown_two"><a --}}
{{-- href="{{route('product.category', $subcategory->slug)}}"> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- {{$subcategory->name_bn}} --}}
{{-- @else --}}
{{-- {{$subcategory->name_en}} --}}
{{-- @endif --}}
{{-- </a> --}}
{{-- --}}{{-- --}}{{-- @php $child = findChildCategory($category->id) @endphp --}}
{{-- --}}{{-- --}}{{-- @if (count($child) > 0) --}}
{{-- --}}{{-- --}}{{-- <ul> --}}
{{-- --}}{{-- --}}{{-- @foreach ($categories as $childSubCategory) --}}
{{-- --}}{{-- --}}{{-- <li>{{$childSubCategory->name_en}} --}}
{{-- </li> --}}
{{-- --}}{{-- --}}{{-- @endforeach --}}
{{-- --}}{{-- --}}{{-- </ul> --}}
{{-- --}}{{-- --}}{{-- @endif --}}
{{-- </li> --}}
{{-- @endif --}}
{{-- @endforeach --}}
{{-- </ul> --}}
{{-- @endif --}}
{{-- </li> --}}
{{-- @endif --}}
{{-- @endforeach --}}
{{-- </ul> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- <!-- Side Menu End --> --}}

{{-- <!--Desktop Slider Start --> --}}
{{-- <div class="col-lg-9 d-none d-md-block desktop-slider"> --}}
{{-- <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel"> --}}
{{-- <div class="carousel-indicators"> --}}
{{-- @foreach ($sliders as $index => $slider) --}}
{{-- <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="{{ $index }}" --}}
{{-- class="{{ $index === 0 ? 'active' : '' }}" --}}
{{-- aria-current="{{ $index === 0 ? 'true' : 'false' }}" --}}
{{-- aria-label="Slide {{ $index + 1 }}"></button> --}}
{{-- @endforeach --}}
{{-- </div> --}}
{{-- <div class="carousel-inner"> --}}
{{-- @foreach ($sliders as $index => $slider) --}}
{{-- <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" data-bs-interval="5000"> --}}
{{-- <img src="{{ asset($slider->slider_img) }}" class="d-block w-100" alt="..." --}}
{{-- style="height: 356px; width: 100%;"> --}}
{{-- <!-- Apply different height for mobile view using media query --> --}}
{{-- <style> --}}
{{-- /*@media (max-width: 767px) {*/ --}}
{{-- /*    #carouselExampleInterval .carousel-item img {*/ --}}
{{-- /*        height: 129px !important;*/ --}}
{{-- /*    }*/ --}}
{{-- /*}*/ --}}
{{-- </style> --}}
{{-- </div> --}}
{{-- @endforeach --}}
{{-- </div> --}}
{{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" --}}
{{-- data-bs-slide="prev"> --}}
{{-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> --}}
{{-- <span class="visually-hidden">Previous</span> --}}
{{-- </button> --}}
{{-- <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" --}}
{{-- data-bs-slide="next"> --}}
{{-- <span class="carousel-control-next-icon" aria-hidden="true"></span> --}}
{{-- <span class="visually-hidden">Next</span> --}}
{{-- </button> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- <!-- Desktop Slider End --> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- </section> --}}
{{-- <!-- Desktop Option & Slider Part End --> --}}

{{-- <!-- Mobile Slider Start --> --}}
{{-- <div class="mobile-slider d-block d-md-none"> --}}
{{-- <div id="carouselExampleInterval-1" class="carousel slide" data-bs-ride="carousel"> --}}
{{-- <div class="carousel-indicators"> --}}
{{-- @foreach ($sliders as $index => $slider) --}}
{{-- <button type="button" data-bs-target="#carouselExampleInterval-1" data-bs-slide-to="{{ $index }}" --}}
{{-- class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" --}}
{{-- aria-label="Slide {{ $index + 1 }}"></button> --}}
{{-- @endforeach --}}
{{-- </div> --}}
{{-- <div class="carousel-inner"> --}}
{{-- @foreach ($sliders as $index => $slider) --}}
{{-- <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" data-bs-interval="5000"> --}}
{{-- <img src="{{ asset($slider->slider_img) }}" class="d-block w-100" alt="..." --}}
{{-- style="height: 356px; width: 100%;"> --}}
{{-- <!-- Apply different height for mobile view using media query --> --}}
{{-- <style> --}}
{{-- @media (max-width: 767px) { --}}
{{-- #carouselExampleInterval .carousel-item img { --}}
{{-- height: 129px !important; --}}
{{-- } --}}
{{-- } --}}

{{-- </style> --}}
{{-- </div> --}}
{{-- @endforeach --}}
{{-- </div> --}}
{{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval-1" --}}
{{-- data-bs-slide="prev"> --}}
{{-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> --}}
{{-- <span class="visually-hidden">Previous</span> --}}
{{-- </button> --}}
{{-- <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval-1" --}}
{{-- data-bs-slide="next"> --}}
{{-- <span class="carousel-control-next-icon" aria-hidden="true"></span> --}}
{{-- <span class="visually-hidden">Next</span> --}}
{{-- </button> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- <!-- Mobile Slider End --> --}}



{{-- <!-- Verified PArt Start --> --}}
{{-- <section class="verified container mt-5 p-3 d-none d-lg-block"> --}}
{{-- <ul> --}}
{{-- <li><img src="{{asset('FrontEnd')}}/assect/img/icon/safe.png" alt="" /><a href=""> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- নিরাপদ পেমেন্ট --}}
{{-- @else --}}
{{-- Safe Payments --}}
{{-- @endif --}}
{{-- </a></li> --}}
{{-- <!-- <li>|</li> --> --}}
{{-- <li><img src="{{asset('FrontEnd')}}/assect/img/icon/car.png" alt="" /> --}}
{{-- <a href=""> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- দেশব্যাপী ডেলিভারি --}}
{{-- @else --}}
{{-- Nationwide Delivery --}}
{{-- @endif --}}
{{-- </a></li> --}}
{{-- <!-- <li>|</li> --> --}}
{{-- <li><img src="{{asset('FrontEnd')}}/assect/img/icon/back.png" alt="" /><a href="#"> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- বিনামূল্যে এবং সহজ রিটার্ন --}}
{{-- @else --}}
{{-- Free &amp; Easy Return --}}
{{-- @endif --}}
{{-- </a> --}}
{{-- </li> --}}
{{-- <!-- <li>|</li> --> --}}
{{-- <li><img src="{{asset('FrontEnd')}}/assect/img/icon/best.png" alt="" /><a href=""> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- বেস্ট প্রাইস --}}
{{-- @else --}}
{{-- Best Price Guaranteed --}}
{{-- @endif --}}

{{-- </a> --}}
{{-- </li> --}}
{{-- <!-- <li>|</li> --> --}}
{{-- <li><img src="{{asset('FrontEnd')}}/assect/img/icon/right.png" alt="" /><a href=""> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- ১০০% অথেনটিক পণ্য --}}
{{-- @else --}}
{{-- 100% Authentic Products --}}
{{-- @endif --}}
{{-- </a></li> --}}
{{-- <!-- <li>|</li> --> --}}
{{-- <li><img src="{{asset('FrontEnd')}}/assect/img/icon/safe.png" alt="" /><a href=""> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- দারাজ যাচাইকৃত --}}
{{-- @else --}}
{{-- Daraz Verified --}}
{{-- @endif --}}
{{-- </a></li> --}}

{{-- </ul> --}}
{{-- </section> --}}
{{-- <!-- Verified Part End --> --}}

{{-- <!-- Camping Part Start --> --}}
{{-- <section class="camping container d-none d-xl-block mt-5"> --}}
{{-- <div class="camp-img"> --}}
{{-- @foreach ($home_banners as $banner) --}}
{{-- <div class="camp-img"> --}}
{{-- <a href=""><img src="{{ asset($banner->banner_img) }}" style="width: 1100px; height: 200px" alt=""></a> --}}
{{-- </div> --}}
{{-- @endforeach --}}
{{-- </div> --}}
{{-- </section> --}}
{{-- <!-- Camping Part End --> --}}

{{-- <!-- Services Part Start --> --}}

{{-- <!-- Services Part End --> --}}
{{-- <!-- Flash Sale Start --> --}}
{{-- @php --}}

{{-- $campaign = \App\Models\Campaing::where('status', 1)->where('is_featured', 1)->orderBy('id', 'desc')->first(); --}}
{{-- // $campaing_products = $campaign->campaing_products; --}}
{{-- //dd(count($campaing_products)); --}}
{{-- @endphp --}}

{{-- @if ($campaign) --}}
{{-- @php --}}
{{-- $flash_start = date_create($campaign->flash_start); --}}
{{-- $flash_end = date_create($campaign->flash_end); --}}

{{-- $start_diff = $flash_start->getTimestamp() - time(); --}}
{{-- $end_diff = $flash_end->getTimestamp() - time(); --}}

{{-- $start_diff2=date_diff(date_create($campaign->flash_start), date_create(date('d-m-Y H:i:s'))); --}}
{{-- $end_diff2=date_diff(date_create(date('d-m-Y H:i:s')), date_create($campaign->flash_end)); --}}
{{-- @endphp --}}

{{-- @if ($start_diff2->invert == 0 && $end_diff2->invert == 0) --}}
{{-- <section class="flash-sale container owl-carousel owl-theme owl-loaded mt-lg-5"> --}}
{{-- <div class="d-flex justify-content-between align-items-center"> --}}
{{-- <h2> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- ফ্ল্যাশ সেল --}}
{{-- @else --}}
{{-- Flash Sale --}}
{{-- @endif --}}
{{-- </h2> --}}
{{-- <a class="btn-primary d-block d-md-none" href="" style="border: none;">SHOP MORE</a> --}}
{{-- </div> --}}
{{-- <div class="owl-stage-outer bg-white py-3 px-1"> --}}
{{-- <div class="d-flex justify-content-between align-items-center px-3"> --}}
{{-- <div class="d-flex"> --}}
{{-- <h5 class="me-5 d-none d-lg-block">On Sale Now</h5> --}}
{{-- <h5 class="trimmers"><small class="text me-2">Ending in</small><div id="demo"></div> --}}
{{-- <span>03 day</span> <small>:</small> <span>03 hr</span> <small>:</small> --}}
{{-- <span>47 min</span> <small>:</small> <span> --}}
{{-- 45 sec</span> --}}
{{-- </h5> --}}
{{-- </div> --}}
{{-- <div> --}}
{{-- <a class="btn-primary d-none d-md-block" href="">SHOP MORE</a> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- <div class="d-flex justify-content-between align-items-center px-3 d-none"> --}}
{{-- <div class="d-flex"> --}}

{{-- <h5 class="trimmers" ><small class="text me-2"> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- শেষ হচ্ছে --}}
{{-- @else --}}
{{-- Ending in --}}
{{-- @endif --}}
{{-- </small> --}}
{{-- <span class="trimmers bg-transparent d-inline-grid" id="demo"><small class="text me-2"></small></span> --}}
{{-- </h5> --}}
{{-- --}}{{-- --}}{{-- <p class="trimmers" id="demo"></p> --}}
{{-- </div> --}}
{{-- <div> --}}
{{-- <a class="btn-primary d-none d-md-block" href="{{route('campaign.product')}}"> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- আরো কিনুন --}}
{{-- @else --}}
{{-- SHOP MORE --}}
{{-- @endif --}}
{{-- </a> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- <hr> --}}
{{-- <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 owl-stage g-2"> --}}
{{-- @foreach ($campaign->campaing_products as $product) --}}
{{-- @php $data = calculateDiscount($product->product->id); @endphp --}}
{{-- <div class="col owl-item"> --}}
{{-- <div class="card h-100"> --}}
{{-- <a href="{{route('product.details', $product->product->slug)}}"> --}}
{{-- <img src="{{asset($product->product->product_thumbnail)}}" class="card-img-top" alt="..."> --}}
{{-- </a> --}}
{{-- <div class="card-body"> --}}
{{-- <a href="{{route('product.details', $product->product->slug)}}"> --}}
{{-- <p> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- </a> --}}
{{-- </li> --}}
{{-- <!-- <li>|</li> --> --}}
{{-- <li><img src="{{asset('FrontEnd')}}/assect/img/icon/right.png" alt="" /><a href=""> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- ১০০% অথেনটিক পণ্য --}}
{{-- @else --}}
{{-- 100% Authentic Products --}}
{{-- @endif --}}
{{-- </a></li> --}}
{{-- <!-- <li>|</li> --> --}}
{{-- <li><img src="{{asset('FrontEnd')}}/assect/img/icon/safe.png" alt="" /><a href=""> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- দারাজ যাচাইকৃত --}}
{{-- @else --}}
{{-- Daraz Verified --}}
{{-- @endif --}}
{{-- </a></li> --}}

{{-- </ul> --}}
{{-- </section> --}}
{{-- <!-- Verified Part End --> --}}

{{-- <!-- Camping Part Start --> --}}
{{-- <section class="camping container d-none d-xl-block mt-5"> --}}
{{-- <div class="camp-img"> --}}
{{-- @foreach ($home_banners as $banner) --}}
{{-- <div class="camp-img"> --}}
{{-- <a href=""><img src="{{ asset($banner->banner_img) }}" style="width: 1100px; height: 200px" alt=""></a> --}}
{{-- </div> --}}
{{-- @endforeach --}}
{{-- </div> --}}
{{-- </section> --}}
{{-- <!-- Camping Part End --> --}}

{{-- <!-- Services Part Start --> --}}

{{-- <!-- Services Part End --> --}}
{{-- <!-- Flash Sale Start --> --}}
{{-- @php --}}

{{-- $campaign = \App\Models\Campaing::where('status', 1)->where('is_featured', 1)->orderBy('id', 'desc')->first(); --}}
{{-- // $campaing_products = $campaign->campaing_products; --}}
{{-- //dd(count($campaing_products)); --}}
{{-- @endphp --}}

{{-- @if ($campaign) --}}
{{-- @php --}}
{{-- $flash_start = date_create($campaign->flash_start); --}}
{{-- $flash_end = date_create($campaign->flash_end); --}}

{{-- $start_diff = $flash_start->getTimestamp() - time(); --}}
{{-- $end_diff = $flash_end->getTimestamp() - time(); --}}

{{-- $start_diff2=date_diff(date_create($campaign->flash_start), date_create(date('d-m-Y H:i:s'))); --}}
{{-- $end_diff2=date_diff(date_create(date('d-m-Y H:i:s')), date_create($campaign->flash_end)); --}}
{{-- @endphp --}}

{{-- @if ($start_diff2->invert == 0 && $end_diff2->invert == 0) --}}
{{-- <section class="flash-sale container owl-carousel owl-theme owl-loaded mt-lg-5"> --}}
{{-- <div class="d-flex justify-content-between align-items-center"> --}}
{{-- <h2> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- ফ্ল্যাশ সেল --}}
{{-- @else --}}
{{-- Flash Sale --}}
{{-- @endif --}}
{{-- </h2> --}}
{{-- <a class="btn-primary d-block d-md-none" href="" style="border: none;">SHOP MORE</a> --}}
{{-- </div> --}}
{{-- <div class="owl-stage-outer bg-white py-3 px-1"> --}}
{{-- <div class="d-flex justify-content-between align-items-center px-3"> --}}
{{-- <div class="d-flex"> --}}
{{-- <h5 class="me-5 d-none d-lg-block">On Sale Now</h5> --}}
{{-- <h5 class="trimmers"><small class="text me-2">Ending in</small><div id="demo"></div> --}}
{{-- <span>03 day</span> <small>:</small> <span>03 hr</span> <small>:</small> --}}
{{-- <span>47 min</span> <small>:</small> <span> --}}
{{-- 45 sec</span> --}}
{{-- </h5> --}}
{{-- </div> --}}
{{-- <div> --}}
{{-- <a class="btn-primary d-none d-md-block" href="">SHOP MORE</a> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- <div class="d-flex justify-content-between align-items-center px-3 d-none"> --}}
{{-- <div class="d-flex"> --}}

{{-- <h5 class="trimmers" ><small class="text me-2"> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- শেষ হচ্ছে --}}
{{-- @else --}}
{{-- Ending in --}}
{{-- @endif --}}
{{-- </small> --}}
{{-- <span class="trimmers bg-transparent d-inline-grid" id="demo"><small class="text me-2"></small></span> --}}
{{-- </h5> --}}
{{-- --}}{{-- --}}{{-- <p class="trimmers" id="demo"></p> --}}
{{-- </div> --}}
{{-- <div> --}}
{{-- <a class="btn-primary d-none d-md-block" href="{{route('campaign.product')}}"> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- আরো কিনুন --}}
{{-- @else --}}
{{-- SHOP MORE --}}
{{-- @endif --}}
{{-- </a> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- <hr> --}}
{{-- <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 owl-stage g-2"> --}}
{{-- @foreach ($campaign->campaing_products as $product) --}}
{{-- @php $data = calculateDiscount($product->product->id); @endphp --}}
{{-- <div class="col owl-item"> --}}
{{-- <div class="card h-100"> --}}
{{-- <a href="{{route('product.details', $product->product->slug)}}"> --}}
{{-- <img src="{{asset($product->product->product_thumbnail)}}" class="card-img-top" alt="..."> --}}
{{-- </a> --}}
{{-- <div class="card-body"> --}}
{{-- <a href="{{route('product.details', $product->product->slug)}}"> --}}
{{-- <p> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- {!! Str::substr($product->product->name_bn, 0, 20) !!} --}}
{{-- @else --}}
{{-- {!! Str::substr($product->product->name_en, 0, 20) !!} --}}
{{-- @endif --}}
{{-- </p> --}}
{{-- </a> --}}

{{-- <h5 class="product-price"><span class="discount-price">৳{{$data['discount']}}</span> ৳{{$product->product->regular_price}} </h5> --}}
{{-- <p class="discount-percent">{{$data['text']}}</p> --}}
{{-- <small class="product-ratings"> --}}
{{-- @if ($product->product->stock_qty > 0) --}}
{{-- <span class="text-success">{{session()->get('language') == 'bangla' ? 'স্টকে আছে': 'Available'}} </span> --}}
{{-- <i class="ratings">({{ $product->product->stock_qty }})</i> --}}
{{-- @endif --}}

{{-- </small> --}}
{{-- <div class="text-center"> --}}
{{-- @if ($product->product->stock_qty > 0) --}}
{{-- @if ($product->product->is_varient == 1) --}}
{{-- <button type="submit" id="{{ $product->product->id }}" onclick="productView(this.id)" data-bs-toggle="modal" data-bs-target="#quickViewModal" style="@if (session()->get('language') == 'bangla')font-size: x-small; @endif" --}}
{{-- class="buy_now"> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- এখুনি কিনুন --}}
{{-- @else --}}
{{-- Buy Now --}}
{{-- @endif --}}
{{-- </button> --}}
{{-- <button type="submit" id="{{ $product->product->id }}" onclick="productView(this.id)" data-bs-toggle="modal" data-bs-target="#quickViewModal" style="@if (session()->get('language') == 'bangla')font-size:x-small @endif" class="add_to_cart"> --}}

{{-- @if (session()->get('language') == 'bangla') --}}
{{-- কার্টে যোগ করুন --}}
{{-- @else --}}
{{-- Add to Cart --}}
{{-- @endif --}}
{{-- </button> --}}
{{-- @else --}}
{{-- <button type="submit" onclick="buyNow({{ $product->product->id }})" style="@if (session()->get('language') == 'bangla')font-size: x-small; @endif" --}}
{{-- class="buy_now"> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- এখুনি কিনুন --}}
{{-- @else --}}
{{-- Buy Now --}}
{{-- @endif --}}
{{-- </button> --}}
{{-- <input type="hidden" id="pfrom" value="direct"> --}}
{{-- <input type="hidden" id="product_product_id" value="{{ $product->product->id }}" min="1"> --}}
{{-- <input type="hidden" id="{{ $product->product->id }}-product_pname" --}}
{{-- value="{{ $product->product->name_en }}"> --}}

{{-- @if (session()->get('language') == 'bangla') --}}
{{-- <button type="submit" onclick="addToCartDirect({{ $product->product->id }})" --}}
{{-- style="font-size: x-small;" class="add_to_cart"> --}}
{{-- কার্টে যোগ করুন --}}
{{-- @else --}}
{{-- <button type="submit" onclick="addToCartDirect({{ $product->product->id }})" --}}
{{-- class="add_to_cart"> --}}
{{-- Add to Cart --}}
{{-- </button> --}}
{{-- @endif --}}

{{-- @endif --}}
{{-- @else --}}
{{-- <div class="bg-danger text-white" style="text-shadow: none; margin-top: 37px; padding: 4px 0"> --}}
{{-- {{session()->get('language') == 'bangla' ? 'স্টক আউট':'Out of Stock'}} --}}
{{-- </div> --}}
{{-- @endif --}}

{{-- //hsdflkgshslkhg --}}
{{-- <button type="submit" onclick="buyNow({{ $product->product->id }})" class="buy_now" style="font-size: {{session()->get('language') == 'bangla'? 'x-small':''}}"> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- এখুনি কিনুন --}}
{{-- @else --}}
{{-- Buy Now --}}
{{-- @endif --}}
{{-- </button> --}}
{{-- @if ($product->product->is_varient == 1) --}}
{{-- <button type="submit" id="{{ $product->product->id }}" onclick="productView(this.id)"data-bs-toggle="modal" data-bs-target="#quickViewModal" class="add_to_cart">Add to Cart</button> --}}
{{-- @else --}}
{{-- <input type="hidden" id="pfrom" value="direct"> --}}
{{-- <input type="hidden" id="product_product_id" value="{{ $product->product->id }}" min="1"> --}}
{{-- <input type="hidden" id="{{ $product->product->id }}-product_pname" --}}
{{-- value="{{ $product->product->name_en }}"> --}}
{{-- <button type="submit" onclick="addToCartDirect({{ $product->product->id }})" class="add_to_cart" style="font-size: {{session()->get('language') == 'bangla'? 'x-small':''}}"> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- কার্টে যোগ করুন --}}
{{-- @else --}}
{{-- Add to Cart --}}
{{-- @endif --}}
{{-- </button> --}}
{{-- @endif --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- @endforeach --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- </section> --}}
{{-- @endif --}}
{{-- @endif --}}
{{-- <!-- Flash Sale End --> --}}
{{-- <!-- Categories Part Start --> --}}
{{-- <section class="categories container owl-carousel owl-theme owl-loaded mt-5"> --}}
{{-- <h2> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- ক্যাটাগোরি --}}
{{-- @else --}}
{{-- Categories --}}
{{-- @endif --}}
{{-- </h2> --}}
{{-- <hr> --}}
{{-- <div class="owl-stage-outer"> --}}
{{-- <div class="row owl-stage g-1"> --}}

{{-- @foreach ($featured_category as $fc) --}}
{{-- <div class="col owl-item"> --}}
{{-- <a class="card" href="{{ route('product.category', $fc->slug) }}"><img src="{{ asset($fc->image) }}" --}}
{{--                                                                                               class="card-img-top" alt="..."> --}}
{{--                            @if (session()->get('language') == 'bangla') --}}
{{--                                <p class="product-text">{{ $fc->name_bn }}</p> --}}
{{-- @else --}}
{{-- <p class="product-text">{{ $fc->name_en }}</p> --}}
{{-- @endif --}}
{{-- </a> --}}
{{-- </div> --}}
{{-- @endforeach --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- </section> --}}
{{-- <!-- Categories Part End --> --}}

{{-- <div class="container mt-lg-5"> --}}
{{-- <div class="row row-cols-lg-2"> --}}
{{-- @foreach ($middle_banners1 as $banner) --}}
{{-- <div class="camping"> --}}
{{-- <a href=""><img src="{{ asset($banner->banner_img) }}" style="width: 1100px; height: 200px" alt=""></a> --}}
{{-- </div> --}}
{{-- @endforeach --}}
{{-- </div> --}}
{{-- </div> --}}

{{-- <!--  Featured Start --> --}}
{{-- <section class="feature container owl-carousel owl-theme owl-loaded mt-5"> --}}
{{-- <div class="d-flex justify-content-between align-items-center px-3"> --}}
{{-- <div class="d-flex"> --}}
{{-- <h2>Featured Products</h2> --}}
{{-- </div> --}}
{{-- <div> --}}
{{-- <a href="{{route('product.featured.show')}}" class="view_more btn-primary" style="float: right;padding: 2px 10px">View More</a> --}}

{{-- </div> --}}
{{-- </div> --}}
{{-- <div class="owl-stage-outer py-3 px-1"> --}}
{{-- <hr> --}}
{{-- <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 owl-stage g-2"> --}}
{{-- @php dd($product_featured); @endphp --}}
{{-- @foreach ($product_featured as $product) --}}
{{-- @php $data = calculateDiscount($product->id); @endphp --}}
{{-- <div class="col owl-item "> --}}
{{-- <div class="card h-100"> --}}
{{-- <a href="{{route('product.details', $product->slug)}}"> --}}
{{-- <img src="{{asset($product->product_thumbnail)}}" class="card-img-top" alt="..."> --}}
{{-- </a> --}}
{{-- <div class="card-body"> --}}
{{-- <a href="{{route('product.details', $product->slug)}}"> --}}
{{-- <p> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- {!! Str::substr($product->name_bn, 0, 20) !!} --}}
{{-- @else --}}
{{-- {!! Str::substr($product->name_en, 0, 20) !!} --}}
{{-- @endif --}}
{{-- </p> --}}
{{-- </a> --}}
{{-- <h5 class="product-price"><span class="discount-price">৳{{$data['discount']}}</span> ৳{{$product->regular_price}}</h5> --}}
{{-- <p class="discount-percent">{{$data['text']}}</p> --}}
{{-- <small class="product-ratings"> --}}
{{-- @if ($product->stock_qty > 0) --}}
{{-- <span class="text-success">{{session()->get('language') == 'bangla' ? 'স্টকে আছে': 'Available'}} </span> --}}
{{-- <i class="ratings">({{ $product->stock_qty }})</i> --}}
{{-- @endif --}}

{{-- </small> --}}
{{-- <div class="text-center btn-group"> --}}
{{-- <div class="text-center"> --}}
{{-- @if ($product->stock_qty > 0) --}}
{{-- @if ($product->is_varient == 1) --}}
{{-- <button type="submit" id="{{ $product->id }}" onclick="productView(this.id)" data-bs-toggle="modal" data-bs-target="#quickViewModal" style="@if (session()->get('language') == 'bangla')font-size: x-small; @endif" --}}
{{-- class="buy_now"> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- এখুনি কিনুন --}}
{{-- @else --}}
{{-- Buy Now --}}
{{-- @endif --}}
{{-- </button> --}}
{{-- <button type="submit" id="{{ $product->id }}" onclick="productView(this.id)" data-bs-toggle="modal" data-bs-target="#quickViewModal" style="@if (session()->get('language') == 'bangla')font-size:x-small @endif" class="add_to_cart"> --}}

{{-- @if (session()->get('language') == 'bangla') --}}
{{-- কার্টে যোগ করুন --}}
{{-- @else --}}
{{-- Add to Cart --}}
{{-- @endif --}}
{{-- </button> --}}
{{-- @else --}}
{{-- <button type="submit" onclick="buyNow({{ $product->id }})" style="@if (session()->get('language') == 'bangla')font-size: x-small; @endif" --}}
{{-- class="buy_now"> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- এখুনি কিনুন --}}
{{-- @else --}}
{{-- Buy Now --}}
{{-- @endif --}}
{{-- </button> --}}
{{-- <input type="hidden" id="pfrom" value="direct"> --}}
{{-- <input type="hidden" id="product_product_id" value="{{ $product->id }}" min="1"> --}}
{{-- <input type="hidden" id="{{ $product->id }}-product_pname" --}}
{{-- value="{{ $product->name_en }}"> --}}

{{-- @if (session()->get('language') == 'bangla') --}}
{{-- <button type="submit" onclick="addToCartDirect({{ $product->id }})" --}}
{{-- style="font-size: x-small;" class="add_to_cart"> --}}
{{-- কার্টে যোগ করুন --}}
{{-- @else --}}
{{-- <button type="submit" onclick="addToCartDirect({{ $product->id }})" --}}
{{-- class="add_to_cart"> --}}
{{-- Add to Cart --}}
{{-- </button> --}}
{{-- @endif --}}

{{-- @endif --}}
{{-- @else --}}
{{-- <div class="bg-danger text-white" style="text-shadow: none; margin-top: 37px; padding: 4px 0"> --}}
{{-- {{session()->get('language') == 'bangla' ? 'স্টক আউট':'Out of Stock'}} --}}
{{-- </div> --}}
{{-- @endif --}}

{{-- --}}{{-- --}}{{-- //hsdflkgshslkhg --}}
{{-- --}}{{-- --}}{{-- <button type="submit" onclick="buyNow({{ $product->id }})" class="buy_now" style="font-size: {{session()->get('language') == 'bangla'? 'x-small':''}}"> --}}
{{-- --}}{{-- --}}{{-- @if (session()->get('language') == 'bangla') --}}
{{-- --}}{{-- --}}{{-- এখুনি কিনুন --}}
{{-- --}}{{-- --}}{{-- @else --}}
{{-- --}}{{-- --}}{{-- Buy Now --}}
{{-- --}}{{-- --}}{{-- @endif --}}
{{-- --}}{{-- --}}{{-- </button> --}}
{{-- --}}{{-- --}}{{-- @if ($product->is_varient == 1) --}}
{{-- --}}{{-- --}}{{-- <button type="submit" id="{{ $product->id }}" onclick="productView(this.id)"data-bs-toggle="modal" data-bs-target="#quickViewModal" class="add_to_cart">Add to Cart</button> --}}
{{-- --}}{{-- --}}{{-- @else --}}
{{-- --}}{{-- --}}{{-- <input type="hidden" id="pfrom" value="direct"> --}}
{{-- --}}{{-- --}}{{-- <input type="hidden" id="product_product_id" value="{{ $product->id }}" min="1"> --}}
{{-- --}}{{-- --}}{{-- <input type="hidden" id="{{ $product->id }}-product_pname" --}}
{{-- --}}{{-- --}}{{-- value="{{ $product->name_en }}"> --}}
{{-- --}}{{-- --}}{{-- <button type="submit" onclick="addToCartDirect({{ $product->id }})" class="add_to_cart" style="font-size: {{session()->get('language') == 'bangla'? 'x-small':''}}"> --}}
{{-- --}}{{-- --}}{{-- @if (session()->get('language') == 'bangla') --}}
{{-- --}}{{-- --}}{{-- কার্টে যোগ করুন --}}
{{-- --}}{{-- --}}{{-- @else --}}
{{-- --}}{{-- --}}{{-- Add to Cart --}}
{{-- --}}{{-- --}}{{-- @endif --}}
{{-- --}}{{-- --}}{{-- </button> --}}
{{-- --}}{{-- --}}{{-- @endif --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- @endforeach --}}
{{-- </div> --}}
{{-- </div> --}}


{{-- </section> --}}

{{-- <div class="container mt-lg-5"> --}}
{{-- <div class="row row-cols-lg-2"> --}}
{{-- @foreach ($middle_banners2 as $banner) --}}
{{-- <div class="camping"> --}}
{{-- <a href=""><img src="{{ asset($banner->banner_img) }}" style="width: 1100px; height: 200px" alt=""></a> --}}
{{-- </div> --}}
{{-- @endforeach --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- <section class="feature container owl-carousel owl-theme owl-loaded mt-5"> --}}
{{-- <div class="d-flex justify-content-between align-items-center px-3"> --}}
{{-- <div class="d-flex"> --}}
{{-- <h2>Recently Added Products</h2> --}}
{{-- </div> --}}
{{-- <div> --}}
{{-- --}}{{-- --}}{{-- <a href="{{route('product.featured.show')}}" class="view_more btn-primary" style="float: right;padding: 2px 10px">View More</a> --}}

{{-- </div> --}}
{{-- </div> --}}
{{-- <div class="owl-stage-outer py-3 px-1"> --}}
{{-- <hr> --}}
{{-- <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 owl-stage g-2"> --}}
{{-- --}}{{-- --}}{{-- @php dd($product_featured); @endphp --}}
{{-- @foreach ($product_recently_adds as $product) --}}
{{-- @php $data = calculateDiscount($product->id); @endphp --}}
{{-- <div class="col owl-item"> --}}
{{-- <div class="card h-100"> --}}
{{-- <a href="{{route('product.details', $product->slug)}}"> --}}
{{-- <img src="{{asset($product->product_thumbnail)}}" class="card-img-top" alt="..."> --}}
{{-- </a> --}}
{{-- <div class="card-body"> --}}
{{-- <a href="{{route('product.details', $product->slug)}}"> --}}
{{-- <p> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- {!! Str::substr($product->name_bn, 0, 20) !!} --}}
{{-- @else --}}
{{-- {!! Str::substr($product->name_en, 0, 20) !!} --}}
{{-- @endif --}}
{{-- </p> --}}
{{-- </a> --}}
{{-- <h5 class="product-price"><span class="discount-price">৳{{$data['discount']}}</span> ৳{{$product->regular_price}}</h5> --}}
{{-- <p class="discount-percent">{{$data['text']}}</p> --}}
{{-- <small class="product-ratings"> --}}
{{-- @if ($product->stock_qty > 0) --}}
{{-- <span class="text-success">{{session()->get('language') == 'bangla' ? 'স্টকে আছে': 'Available'}} </span> --}}
{{-- <i class="ratings">({{ $product->stock_qty }})</i> --}}
{{-- @endif --}}

{{-- </small> --}}
{{-- --}}{{-- --}}{{-- <div class="text-center btn-group"> --}}
{{-- <div class="text-center"> --}}
{{-- @if ($product->stock_qty > 0) --}}
{{-- @if ($product->is_varient == 1) --}}
{{-- <button type="submit" id="{{ $product->id }}" onclick="productView(this.id)" data-bs-toggle="modal" data-bs-target="#quickViewModal" style="@if (session()->get('language') == 'bangla')font-size: x-small; @endif" --}}
{{-- class="buy_now"> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- এখুনি কিনুন --}}
{{-- @else --}}
{{-- Buy Now --}}
{{-- @endif --}}
{{-- </button> --}}
{{-- <button type="submit" id="{{ $product->id }}" onclick="productView(this.id)" data-bs-toggle="modal" data-bs-target="#quickViewModal" style="@if (session()->get('language') == 'bangla')font-size:x-small @endif" class="add_to_cart"> --}}

{{-- @if (session()->get('language') == 'bangla') --}}
{{-- কার্টে যোগ করুন --}}
{{-- @else --}}
{{-- Add to Cart --}}
{{-- @endif --}}
{{-- </button> --}}
{{-- @else --}}
{{-- <button type="submit" onclick="buyNow({{ $product->id }})" style="@if (session()->get('language') == 'bangla')font-size: x-small; @endif" --}}
{{-- class="buy_now"> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- এখুনি কিনুন --}}
{{-- @else --}}
{{-- Buy Now --}}
{{-- @endif --}}
{{-- </button> --}}
{{-- <input type="hidden" id="pfrom" value="direct"> --}}
{{-- <input type="hidden" id="product_product_id" value="{{ $product->id }}" min="1"> --}}
{{-- <input type="hidden" id="{{ $product->id }}-product_pname" --}}
{{-- value="{{ $product->name_en }}"> --}}

{{-- @if (session()->get('language') == 'bangla') --}}
{{-- <button type="submit" onclick="addToCartDirect({{ $product->id }})" --}}
{{-- style="font-size: x-small;" class="add_to_cart"> --}}
{{-- কার্টে যোগ করুন --}}
{{-- @else --}}
{{-- <button type="submit" onclick="addToCartDirect({{ $product->id }})" --}}
{{-- class="add_to_cart"> --}}
{{-- Add to Cart --}}
{{-- </button> --}}
{{-- @endif --}}

{{-- @endif --}}
{{-- @else --}}
{{-- <div class="bg-danger text-white" style="text-shadow: none; margin-top: 37px; padding: 4px 0"> --}}
{{-- {{session()->get('language') == 'bangla' ? 'স্টক আউট':'Out of Stock'}} --}}
{{-- </div> --}}
{{-- @endif --}}

{{-- --}}{{-- --}}{{-- //hsdflkgshslkhg --}}
{{-- --}}{{-- --}}{{-- <button type="submit" onclick="buyNow({{ $product->id }})" class="buy_now" style="font-size: {{session()->get('language') == 'bangla'? 'x-small':''}}"> --}}
{{-- --}}{{-- --}}{{-- @if (session()->get('language') == 'bangla') --}}
{{-- --}}{{-- --}}{{-- এখুনি কিনুন --}}
{{-- --}}{{-- --}}{{-- @else --}}
{{-- --}}{{-- --}}{{-- Buy Now --}}
{{-- --}}{{-- --}}{{-- @endif --}}
{{-- --}}{{-- --}}{{-- </button> --}}
{{-- --}}{{-- --}}{{-- @if ($product->is_varient == 1) --}}
{{-- --}}{{-- --}}{{-- <button type="submit" id="{{ $product->id }}" onclick="productView(this.id)"data-bs-toggle="modal" data-bs-target="#quickViewModal" class="add_to_cart">Add to Cart</button> --}}
{{-- --}}{{-- --}}{{-- @else --}}
{{-- --}}{{-- --}}{{-- <input type="hidden" id="pfrom" value="direct"> --}}
{{-- --}}{{-- --}}{{-- <input type="hidden" id="product_product_id" value="{{ $product->id }}" min="1"> --}}
{{-- --}}{{-- --}}{{-- <input type="hidden" id="{{ $product->id }}-product_pname" --}}
{{-- --}}{{-- --}}{{-- value="{{ $product->name_en }}"> --}}
{{-- --}}{{-- --}}{{-- <button type="submit" onclick="addToCartDirect({{ $product->id }})" class="add_to_cart" style="font-size: {{session()->get('language') == 'bangla'? 'x-small':''}}"> --}}
{{-- --}}{{-- --}}{{-- @if (session()->get('language') == 'bangla') --}}
{{-- --}}{{-- --}}{{-- কার্টে যোগ করুন --}}
{{-- --}}{{-- --}}{{-- @else --}}
{{-- --}}{{-- --}}{{-- Add to Cart --}}
{{-- --}}{{-- --}}{{-- @endif --}}
{{-- --}}{{-- --}}{{-- </button> --}}
{{-- --}}{{-- --}}{{-- @endif --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- @endforeach --}}
{{-- </div> --}}
{{-- </div> --}}

{{-- </section> --}}

{{-- <div class="container mt-lg-5"> --}}
{{-- <div class="row g-3"> --}}
{{-- <div class="col-xl-6"> --}}
{{-- <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel"> --}}
{{-- <div class="carousel-indicators"> --}}
{{-- @foreach ($middleSliders as $index => $slider) --}}
{{-- <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$index}}" --}}
{{-- class="{{ $index === 0 ? 'active' : '' }}" --}}
{{-- aria-current="{{ $index === 0 ? 'true' : 'false' }}" --}}
{{-- aria-label="Slide {{$index+1}}"></button> --}}
{{-- @endforeach --}}

{{-- </div> --}}
{{-- <div class="carousel-inner camping"> --}}
{{-- @foreach ($middleSliders as $index => $slider) --}}
{{-- <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-bs-interval="5000"> --}}
{{-- <img src="{{ asset($slider->slider_img) }}" class="d-block" alt="..."> --}}
{{-- </div> --}}
{{-- @endforeach --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- </div> --}}

{{-- <div class="col-xl-6"> --}}
{{-- <div class="services container owl-carousel owl-theme owl-loaded mt-3 mt-lg-5 bg-white "> --}}
{{-- <div class="owl-stage-outer"> --}}
{{-- <div class="row owl-stage g-1"> --}}
{{-- <div class="col owl-item"> --}}
{{-- <a class="card" href="#"><img src="{{asset('FrontEnd')}}/assect/img/services/wholesale price.png" --}}
{{-- class="card-img-top" alt="..."> --}}
{{-- <span class="product-text">Wholesale Price</span> --}}
{{-- </a> --}}
{{-- </div> --}}
{{-- <div class="col owl-item"> --}}
{{-- <a class="card" href="#"><img src="{{asset('FrontEnd')}}/assect/img/services/everyday low price.png" --}}
{{-- class="card-img-top" alt="..."> --}}
{{-- <span class="product-text">Everyday Low Price!</span> --}}
{{-- </a> --}}
{{-- </div> --}}
{{-- <div class="col owl-item"> --}}
{{-- <a class="card" href="#"><img src="{{asset('FrontEnd')}}/assect/img/services/free delivery.png" --}}
{{-- class="card-img-top" alt="..."> --}}
{{-- <span class="product-text">Free Delivery</span> --}}
{{-- </a> --}}
{{-- </div> --}}
{{-- <div class="col owl-item"> --}}
{{-- <a class="card" href="#"><img src="{{asset('FrontEnd')}}/assect/img/services/fashion.png" --}}
{{-- class="card-img-top" alt="..."> --}}
{{-- <span class="product-text">Fashion</span> --}}
{{-- </a> --}}
{{-- </div> --}}
{{-- <div class="col owl-item"> --}}
{{-- <a class="card" href="#"><img src="{{asset('FrontEnd')}}/assect/img/services/beauty & glamour.png" --}}
{{-- class="card-img-top" alt="..."> --}}
{{-- <span class="product-text">Beauty & Glamour</span> --}}
{{-- </a> --}}
{{-- </div> --}}
{{-- <div class="col owl-item"> --}}
{{-- <a class="card" href="#"><img src="{{asset('FrontEnd')}}/assect/img/services/mart.png" --}}
{{-- class="card-img-top" alt="..."> --}}
{{-- <span class="product-text">Mart</span> --}}
{{-- </a> --}}
{{-- </div> --}}
{{-- <div class="col owl-item"> --}}
{{-- <a class="card" href="#"><img src="{{asset('FrontEnd')}}/assect/img/services/home makeover.png" --}}
{{-- class="card-img-top" alt="..."> --}}
{{-- <span class="product-text">Home Makeover</span> --}}
{{-- </a> --}}
{{-- </div> --}}
{{-- <div class="col owl-item"> --}}
{{-- <a class="card" href="#"><img src="{{asset('FrontEnd')}}/assect/img/services/best price.png" --}}
{{-- class="card-img-top" alt="..."> --}}
{{-- <span class="product-text">Best Price Guaranteed</span> --}}
{{-- </a> --}}
{{-- </div> --}}
{{-- <div class="col owl-item"> --}}
{{-- <a class="card last" href="#"><img src="{{asset('FrontEnd')}}/assect/img/services/visa card.png" --}}
{{-- class="card-img-top" alt="..."> --}}
{{-- <span class="product-text">Payment</span> --}}
{{-- </a> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- </div> --}}

{{-- <!-- Camping Add just for you Part End --> --}}
{{-- <!-- Just For You Start --> --}}
{{-- <section class="just-for-you container mt-5"> --}}
{{-- <h2> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- শুধু আপনার জন্য --}}
{{-- @else --}}
{{-- Just For You --}}
{{-- @endif --}}
{{-- </h2> --}}
{{-- <hr> --}}
{{-- <div id="product-container" class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-2"> --}}
{{-- @foreach ($product_trendings as $product_trending) --}}
{{-- @php $data = calculateDiscount($product_trending->id); @endphp --}}
{{-- <div class="col"> --}}
{{-- <div class="card h-100"> --}}
{{-- <a href="{{route('product.details', $product_trending->slug)}}"> --}}
{{-- <img src="{{ asset($product_trending->product_thumbnail) }}" class="card-img-top" alt="..."> --}}
{{-- </a> --}}
{{-- <div class="card-body"> --}}
{{-- <a href="{{route('product.details', $product_trending->slug)}}"> --}}
{{-- <p class="product-text"> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- {!! Str::substr($product_trending->name_bn, 0, 20) !!}</p> --}}
{{-- @else --}}
{{-- {!! Str::substr($product_trending->name_en, 0, 20) !!}</p> --}}
{{-- @endif --}}
{{-- </a> --}}
{{-- @php $data = calculateDiscount($product_trending->id); @endphp --}}
{{-- <h5 class="product-price"><span --}}
{{-- class="discount-price">৳{{ $product_trending->regular_price }}</span> ৳{{ $data['discount'] }}</h5> --}}
{{-- <p class="discount-percent"> {{$data['text']}}</p> --}}
{{-- <small class="product-ratings"> --}}
{{-- @if ($product_trending->stock_qty > 0) --}}
{{-- <span class="text-success">Available</span> --}}
{{-- <i class="ratings">({{ $product_trending->stock_qty }})</i> --}}
{{-- @endif --}}

{{-- <i class="fa-solid fa-star"></i> --}}
{{-- <i class="fa-solid fa-star"></i> --}}
{{-- <i class="fa-solid fa-star"></i> --}}
{{-- <i class="fa-solid fa-star"></i> --}}
{{-- <i class="fa-regular fa-star"></i> --}}

{{-- </small> --}}
{{-- <div class="text-center"> --}}
{{-- @if ($product_trending->stock_qty > 0) --}}
{{-- @if ($product_trending->is_varient == 1) --}}
{{-- <button type="submit" id="{{ $product_trending->id }}" onclick="productView(this.id)"data-bs-toggle="modal" data-bs-target="#quickViewModal" style="@if (session()->get('language') == 'bangla')font-size: x-small; @endif" --}}
{{-- class="buy_now"> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- এখুনি কিনুন --}}
{{-- @else --}}
{{-- Buy Now --}}
{{-- @endif --}}
{{-- </button> --}}
{{-- <button type="submit" id="{{ $product_trending->id }}" onclick="productView(this.id)"data-bs-toggle="modal" data-bs-target="#quickViewModal" style="@if (session()->get('language') == 'bangla')font-size:x-small @endif" class="add_to_cart"> --}}

{{-- @if (session()->get('language') == 'bangla') --}}
{{-- কার্টে যোগ করুন --}}
{{-- @else --}}
{{-- Add to Cart --}}
{{-- @endif --}}
{{-- </button> --}}
{{-- @else --}}
{{-- <button type="submit" onclick="buyNow({{ $product_trending->id }})" style="@if (session()->get('language') == 'bangla')font-size: x-small; @endif" --}}
{{-- class="buy_now"> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- এখুনি কিনুন --}}
{{-- @else --}}
{{-- Buy Now --}}
{{-- @endif --}}
{{-- </button> --}}
{{-- <input type="hidden" id="pfrom" value="direct"> --}}
{{-- <input type="hidden" id="product_product_id" value="{{ $product_trending->id }}" min="1"> --}}
{{-- <input type="hidden" id="{{ $product_trending->id }}-product_pname" --}}
{{-- value="{{ $product_trending->name_en }}"> --}}

{{-- @if (session()->get('language') == 'bangla') --}}
{{-- <button type="submit" onclick="addToCartDirect({{ $product_trending->id }})" --}}
{{-- style="font-size: x-small;" class="add_to_cart"> --}}
{{-- কার্টে যোগ করুন --}}
{{-- @else --}}
{{-- <button type="submit" onclick="addToCartDirect({{ $product_trending->id }})" --}}
{{-- class="add_to_cart"> --}}
{{-- Add to Cart --}}
{{-- </button> --}}
{{-- @endif --}}

{{-- @endif --}}
{{-- @else --}}
{{-- <div class="bg-danger text-white" style="text-shadow: none; margin-top: 37px; padding: 4px 0"> --}}
{{-- {{session()->get('language') == 'bangla' ? 'স্টক আউট':'Out of Stock'}} --}}
{{-- </div> --}}
{{-- @endif --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- </div> --}}

{{-- @endforeach --}}
{{-- </div> --}}
{{-- </section> --}}
{{-- <div class="text-center my-5"> --}}
{{-- <button type="button" id="load-more-btn" class="view_more"> --}}
{{-- @if (session()->get('language') == 'bangla') --}}
{{-- আরো দেখুন --}}
{{-- @else --}}
{{-- View More --}}
{{-- @endif --}}
{{-- </button> --}}
{{-- </div> --}}
{{-- <!-- Just For You End --> --}}
{{-- @endsection --}}
@push('js')
    <script>
        $(document).ready(function() {
            console.log('ok');
            var campaign = $('#campaign').val();
            if (campaign == 1) {
                console.log('ok');
                // Convert PHP date differences to JavaScript format
                var startDiff = <?php echo $start_diff * 1000; ?>;
                var endDiff = <?php echo $end_diff * 1000; ?>;

                // Set the date we're counting down to based on PHP date differences
                var countDownDateStart = new Date(Date.now() + startDiff);
                var countDownDateEnd = new Date(Date.now() + endDiff);

                // Update the count down every 1 second
                var x = setInterval(function() {
                        // Get today's date and time
                        var now = new Date().getTime();

                        // Choose between start and end dates based on your requirement
                        var countDownDate = (now < countDownDateStart.getTime()) ? countDownDateStart :
                            countDownDateEnd;

                        // Calculate the remaining time
                        var distance = countDownDate - now;

                        // Time calculations for days, hours, minutes and seconds
                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        // Output the result in an element with id="demo"
                        // if($('#language_status').val() == 'bangla'){
                        //     var html = `<span>${days}দিন</span> : <span>${hours}ঘন্টা</span> : <span>${minutes}মিনিট</span> : <span>${seconds}সেকেন্ড</span>`;
                        // }
                        //
                        // else{
                        var html = ` <strong>${days} Days ${hours} Hours ${minutes} Minutes </strong>`;
                        // html += `<br><span class="counter-title">Days:</span> <span class="counter-title">Hours:</span> <span class="counter-title">Minutes:</span> <span class="counter-title">Seconds:</span>`;
                        // }


                        document.getElementById("demo").innerHTML = html;

                        // If the count down is over, write some text
                        if (distance < 0) {
                            clearInterval(x);
                            document.getElementById("demo").innerHTML = "EXPIRED";
                        }
                    },
                    1000);
            }
        });


        $(document).ready(function() {
            $('.slick-category-slider').slick({
                infinite: false,
                slidesToShow: 5,
                slidesToScroll: 1,
                arrows: false,
                dots: false,
                autoplay: false,
                autoplaySpeed: 4000,
                responsive: [{
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 5,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 4,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 3,
                        }
                    }
                ]
            });



        });

        $(".slider").slick({
            dots: true,
            infinite: true,
            speed: 800,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            autoplay: true,
            autoplaySpeed: 4000,
            fade: true,
            cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
            touchThreshold: 100,
            pauseOnHover: true,
            lazyLoad: 'progressive',
            // ... other settings
        });
    </script>
@endpush
