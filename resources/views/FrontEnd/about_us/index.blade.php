@extends('FrontEnd.master')
@section('title')
    About Us
@endsection
@section('content')
    <style>
        .about-page .hero-section {
            position: relative;
        }

        .about-page .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.7));
        }

        .min-vh-75 {
            min-height: 82vh;
        }

        @media (max-width: 768px) {
            .about-page .hero-section {
                text-align: center;
            }

            .min-vh-75 {
                min-height: auto;
            }
        }
    </style>
    <style>
        .la-section-title {
            font-size: 2rem;
            color: #2d2d2d;
            font-weight: 700;
        }

        .la-contact-list {
            list-style: disc !important;
            padding-left: 2rem;
            margin: 0;
        }

        .la-contact-item {
            color: #666;
            margin-bottom: 1.25rem;
            padding-left: 0.5rem;
            line-height: 1.6;
        }

        .la-contact-item::marker {
            color: #FF914D;
        }

        .la-contact-item:hover {
            color: #2d2d2d;
            transition: all 0.3s ease;
        }

        .la-contact-item a {
            color: #FF914D;
            text-decoration: none;
        }

        .la-contact-item a:hover {
            text-decoration: underline;
        }

        .la-contact-item .fw-semibold {
            color: #2d2d2d;
        }

        @media (max-width: 768px) {
            .la-contact-item:hover {
                transform: none;
            }
        }
    </style>
    <style>
        .la-services-section {
            background-color: #fff;
        }

        .la-subtitle {
            font-size: 1.25rem;
            color: #2d2d2d;
            font-weight: 600;
        }

        .la-services-list {
            list-style: disc !important;
            padding-left: 1.5rem;
            margin: 0;
        }

        .la-services-item {
            color: #666;
            margin-bottom: 1rem;
            padding-left: 0.5rem;
            line-height: 1.6;
            font-size: 1.1rem;
        }

        .la-services-item::marker {
            color: #FF914D;
        }

        .la-services-item:hover {
            color: #2d2d2d;
        }

        @media (max-width: 768px) {
            .la-services-item {
                font-size: 1rem;
            }

            .la-services-item:hover {
                transform: none;
            }
        }
    </style>
    <style>
        .la-mission-section {
            background-color: #f8f9fa;
        }

        .la-section-divider {
            width: 60px;
            height: 3px;
            background-color: #FF914D;
            margin-top: -5px;
            margin-bottom: 2rem;
        }

        .la-mission-card {
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .la-mission-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
            border-color: #FF914D;
        }

        .la-mission-quote {
            color: #FF914D;
            font-size: 1.25rem;
            line-height: 1.6;
        }

        .la-mission-text {
            color: #666;
            line-height: 1.8;
        }

        .la-impact-list {
            list-style: disc;
            padding-left: 1.25rem;
            margin: 0;
        }

        .la-impact-item {
            color: #666;
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .la-impact-item:last-child {
            margin-bottom: 0;
        }

        .la-impact-item::marker {
            color: #FF914D;
        }

        @media (max-width: 768px) {
            .la-mission-card:hover {
                transform: none;
            }
        }
    </style>
    <style>
        .la-expertise-section {
            background-color: #f8f9fa;
        }

        .la-expertise-card {
            border: 1px solid rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .la-expertise-card:hover {
            transform: translateY(-5px);
            border-color: #FF914D;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .la-expertise-years {
            padding: 2rem 1rem;
            border-right: 2px solid #FF914D;
        }

        .la-years-number {
            display: block;
            font-size: 3.5rem;
            font-weight: 700;
            color: #FF914D;
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .la-years-text {
            color: #666;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .la-services-item {
            font-size: 1.1rem;
            padding: 0.5rem 0;
        }

        @media (max-width: 768px) {
            .la-expertise-years {
                border-right: none;
                border-bottom: 2px solid #FF914D;
                margin-bottom: 1.5rem;
            }

            .la-years-number {
                font-size: 2.5rem;
            }
        }
    </style>
    <style>
        .la-team-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .la-team-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .la-team-img-wrapper {
            position: relative;
            overflow: hidden;
        }

        .la-team-img-wrapper img {
            width: 100%;
            aspect-ratio: 1;
            object-fit: cover;
        }

        .la-team-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 145, 77, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
        }

        .la-team-card:hover .la-team-overlay {
            opacity: 1;
        }

        .la-social-links a {
            color: #fff;
            font-size: 1.2rem;
            margin: 0 10px;
        }



        .la-team-info {
            padding: 1.5rem;
        }

        .la-team-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2d2d2d;
            margin-bottom: 0.5rem;
        }

        .la-team-position {
            color: #FF914D;
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .la-team-contact {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .la-team-contact li {
            color: #666;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .la-team-contact li i {
            color: #FF914D;
            width: 20px;
            margin-right: 8px;
        }

        @media (max-width: 768px) {
            .la-team-card:hover {
                transform: none;
            }
        }
    </style>
    <style>
        .la-mission-content,
        .la-recognition-card {
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .la-mission-content:hover,
        .la-recognition-card:hover {
            border-color: #FF914D;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1) !important;
        }

        .la-recognition-list {
            list-style: disc !important;
            padding-left: 1.5rem;
            margin: 0 0 1rem 0;
        }

        .la-recognition-item {
            color: #666;
            margin-bottom: 1rem;
            padding-left: 0.5rem;
            line-height: 1.6;
            font-size: 1.1rem;
        }

        .la-recognition-item::marker {
            color: #FF914D;
        }

        .la-recognition-item:last-child {
            margin-bottom: 0;
        }

        .la-recognition-footer {
            border-left: 4px solid #FF914D;
        }

        .la-recognition-text {
            color: #666;
            line-height: 1.8;
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {

            .la-mission-content:hover,
            .la-recognition-card:hover {
                transform: none;
            }

            .la-recognition-item {
                font-size: 1rem;
            }
        }
    </style>
    <style>
        .la-legal-card {
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .la-legal-card:hover {
            border-color: #FF914D;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1) !important;
        }

        .la-legal-text {
            color: #666;
            line-height: 1.8;
            font-size: 1.1rem;
        }

        .la-legal-list {
            list-style: disc !important;
            padding-left: 1.5rem;
            margin: 0;
        }

        .la-legal-item {
            color: #666;
            margin-bottom: 1rem;
            padding-left: 0.5rem;
            line-height: 1.6;
            font-size: 1.1rem;
        }

        .la-legal-item:last-child {
            margin-bottom: 0;
        }

        .la-legal-item::marker {
            color: #FF914D;
        }

        .la-legal-item strong {
            color: #2d2d2d;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .la-legal-card:hover {
                transform: none;
            }

            .la-legal-item {
                font-size: 1rem;
            }
        }
    </style>
    <style>
        .la-faq-wrapper {
            border: 1px solid rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .la-faq-item {
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .la-faq-header {
            background-color: #fff;
            padding: 0.8rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }

        .la-faq-header:hover {
            background-color: #fff5ed;
        }

        .la-faq-question {
            font-size: 1.1rem;
            color: #2d2d2d;
            font-weight: 500;
            margin: 0;
            padding-right: 2rem;
        }

        .la-faq-question i {
            color: #FF914D;
            font-size: 1.25rem;
        }

        .la-faq-header::after {
            content: '\f107';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            right: 1.5rem;
            color: #FF914D;
            transition: transform 0.3s ease;
        }

        .la-faq-item.active .la-faq-header::after {
            transform: rotate(180deg);
        }

        .la-faq-body {
            background-color: #fff;
            padding: 0;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .la-faq-item.active .la-faq-body {
            padding: 1.5rem;
            max-height: 500px;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        .la-faq-answer {
            color: #666;
            line-height: 1.8;
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .la-faq-question {
                font-size: 1rem;
            }

            .la-faq-answer {
                font-size: 1rem;
            }
        }
    </style>

    <section>
        <div class="about-page">
            <div class="hero-section position-relative"
                style="background: url('{{ asset('FrontEnd/assets/img/laptop-ache-about-bg.jpeg') }}') no-repeat center center; background-size: cover;">
                <div class="hero-overlay"></div>
                <div class="container position-relative">
                    <div class="row min-vh-75 align-items-center py-5">
                        <div class="col-lg-7">
                            <h1 class="display-4 fw-bold text-white mb-4">What is Laptop Ache all about?</h1>
                            <p class="lead text-white mb-4">Laptop Ache is a trusted used laptop shop in Dhaka, Bangladesh.
                                Committed to bringing
                                the A+ quality used laptop to everyone in our country, at a price that is affordable to all.
                                For
                                over 5 years, we have been providing A+ quality imported refurbished laptops that come with
                                a <a style="color:#fafafa; text-decoration: underline;"
                                    href="{{ route('product.warrenty') }}">3-year warranty</a>, flexible installment plans,
                                and
                                trusted local support.
                            </p>
                            <div>
                                <p>
                                    <strong style="color:#fafafa !important; font-size:1.2rem;"> Key Offerings
                                        Include:</strong>
                                </p>
                                <ul style="color: #f8f9fa; list-style: disc;">
                                    <li>
                                        A+ quality imported used laptops.
                                    </li>
                                    <li>
                                        3-year comprehensive warranty.

                                    </li>
                                    <li>
                                        Flexible 3-month installment plans.

                                    </li>
                                    <li>
                                        Trusted local support (24/7).

                                    </li>
                            </div>
                            </ul>
                        </div>
                        <div class="col-lg-5 mt-4 mt-lg-0">
                            <div class="image-wrapper"
                                style="box-shadow: 0 10px 30px rgba(0,0,0,0.15); border-radius: 20px; overflow: hidden;">
                                <img src="{{ asset('FrontEnd/assets/img/about-laptop.jpeg') }}" alt="About Laptop Ache"
                                    class="w-100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="la-about-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="la-about-content pe-lg-4">
                        <h2 class="la-section-title mb-4">Who We Are?</h2>


                        <ul class="la-contact-list mb-4">
                            <li class="la-contact-item">
                                <span class="fw-semibold">Brand Name:</span> <a href="{{ route('home') }}"> Laptop Ache</a>
                            </li>
                            <li class="la-contact-item">
                                Year Established: 2020.
                            </li>
                            <li class="la-contact-item">
                                Dependable laptops from us; now in your budget, trustworthy service! </li>
                            <li class="la-contact-item">
                                Address: Badda, Dhaka, Bangladesh.
                            </li>
                            <li class="la-contact-item">
                                Service Area: National (100% Coverage of all 64 districts in Bangladesh).
                            </li>
                            <li class="la-contact-item">
                                Phone : +8801901378164, +8801780966740
                            </li>
                            <li>
                                Website: <a href="{{ route('home') }}"> www.laptopache.com</a>
                            </li>
                        </ul>
                        <button style="border: none;">
                            <a href="{{ route('page.contact') }}" class="btn btn-lg px-4 py-2"
                                style="background-color: #FF914D; color: #fff; border: none; transition: all 0.3s ease;">
                                Contact Us
                            </a>
                        </button>

                        <!-- <a href="{{ route('page.contact') }}" class="la-contact-btn btn btn-lg px-4 py-2"
                                            style="background-color: #FF914D; color: #fff; border: none; transition: all 0.3s ease;">
                                            Contact Us
                                        </a> -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="la-about-image-wrapper"
                        style="border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
                        <img src="{{ asset('FrontEnd/assets/img/who-we-are-laptopache.jpeg') }}" alt="Laptop Store"
                            class=" w-100">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="la-services-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5">
                    <div class="la-services-content">
                        <h2 class="la-section-title mb-4">What We Do?</h2>
                        <h3 class="la-subtitle mb-3">What Laptop Ache provides?</h3>
                        <ul class="la-services-list mb-0">
                            <li class="la-services-item"><span class="la-contact-item"><a
                                        href="{{ route('product.show') }}"> Product </a></span> As a reliable used laptop
                                store in Dhaka, we offer
                                Grade-A+ imported
                                and tested high-quality laptops. Each unit undergoes a <span class="la-contact-item"><a
                                        href="/price-stock-quality">21+ point diagnostic check</a></span>,
                                verified by our in-house A+ certified technicians.
                            </li>
                            <li class="la-services-item"><span class="la-contact-item"><a
                                        href="{{ route('product.warrenty') }}">Warrenty:</a></span>: 0-3 years, clearly
                                defined by product model.
                            </li>
                            <li class="la-services-item">Financing: Easy Installment (50% Down payment, balance paid in 3
                                months).
                            </li>
                            <li class="la-services-item">Support: Customer-first, including 24/7 online assistance.</li>
                            <li class="la-services-item">Delivery: Nationwide delivery with secure order tracking (3-5 days
                                standard).</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="la-audience-content">
                        <h2 class="la-section-title mb-4">Who We Serve?</h2>
                        <ul class="la-services-list mb-0">
                            <li class="la-services-item">Bargain Hunters: Individuals looking for dependable, low-budget
                                laptops.</li>
                            <li class="la-services-item">Professionals: Work-from-home employees and small business owners
                                needing reliable devices. </li>
                            <li class="la-services-item">Creators/Power Users: Professionals requiring powerful, fair-priced
                                machines (e.g.,
                                <span class="la-contact-item"><a
                                        href="/product/shop?processors%5B%5D=Intel&generation%5B%5D=Intel+7th+Gen">
                                        i7</a></span> / <span class="la-contact-item"><a
                                        href="/product/shop?processors%5B%5D=AMD&generation%5B%5D=Ryzen+5000+Series">Ryzen
                                        5</a></span> models).
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="la-mission-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5">
                    <h2 class="la-section-title mb-4">Why Do We Exist ?</h2>
                    <div class="la-section-divider mx-auto"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="la-mission-card p-4 bg-white rounded-4 shadow-sm" style="height: 100%;">
                        <h3 class="la-subtitle mb-3">What are we trying to achieve at Laptop Ache? (Our Goal) </h3>
                        <p class="la-mission-quote mb-0 fst-italic">
                            The primary goal of Laptop Ache is to make laptops affordable, reliable and available to every
                            person in Bangladesh. <span><a href="/price-stock-quality" class="la-contact-item">21+ point
                                    diagnostic check</a></span>
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="la-mission-card p-4 bg-white rounded-4 shadow-sm" style="height: 100%;">
                        <h3 class="la-subtitle mb-3">How did our journey begin? (Our Story)</h3>
                        <p class="la-mission-text mb-0">
                            Laptop Ache was founded to solve a serious problem in the Bangladeshi market, which is
                            the “complexity of quality control” Our internal market research (2020) revealed a major
                            problem in the local market—65% of used laptops fail within 6 months. This discovery
                            inspired us to implement an industry-leading <span class="la-contact-item"><a
                                    href="/price-stock-quality">21+ point diagnostic check</a></span>. We filled that gap
                            with fully tested and factory-certified second-hand laptops, giving customers the confidence
                            to buy without fear of quality issues.

                        </p>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="la-mission-card p-4 bg-white rounded-4 shadow-sm" style="height: 100%;">
                        <h3 class="la-subtitle mb-3">. How are we making technology more accessible for everyone? (Social
                            Impact)</h3>
                        <ul class="la-impact-list mb-0">
                            <li class="la-impact-item">Making technology more affordable and accessible for students and
                                freelancers. We
                                have an established 5% student discount program year-round (proof of
                                enrollment required).
                            </li>
                            <li class="la-impact-item">Reducing <span class="la-contact-item"><a
                                        href="https://www.who.int/news-room/fact-sheets/detail/electronic-waste-(e-waste)">e-waste</a></span>
                                by promoting reuse of laptops. To date, we have
                                diverted over
                                2,500 kg of potential e-waste from landfills. </li>
                            <li class="la-impact-item">Putting sustainable jobs in the local economy in retail, testing,
                                and
                                customer support. </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="la-expertise-section py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5">
                    <h2 class="la-section-title">What makes our team trusted and knowledgeable?
                        (Experience & Expertise)</h2>

                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="la-expertise-card p-4 p-lg-5 bg-white rounded-4">
                        <div class="row">

                            <p>
                                5 years of consistent service in Bangladesh. Thousands of happy customers, academics,
                                students and corporate clients. Clear purchasing process – every laptop is graded and
                                tested before being offered for sale. Reliable long-term value up to 5-year warranties.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="la-team-section py-5 bg-white" id="ceo">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-">
                    <h2 class="la-section-title ">Who’s behind our success and commitment? (Our
                        Team) </h2>
                    <div class="la-section-divider mx-auto"></div>
                </div>
            </div>
            <div class="row mx-auto align-items-center">
                <div class="" style="text-align: end !important; padding: 0 20px;">
                    <img class="ms-auto w-100" style="border-radius: 20px;"
                        src="{{ asset('FrontEnd/assets/img/ibrahim-hossain-ceo.jpg') }}" alt="Ibrahim Hossain">
                </div>
                <div class="col-md-6">
                    <h3 class="mt-4 mb-4 text-dark">
                        Ibrahim Hossain - Founder & CEO
                    </h3>
                    <p>
                        Meet Ibrahim Hossain, Founder of Laptop Ache. Ibrahim Hossain is a technology industry
                        veteran with 10+ years in IT hardware sourcing and refurbishment, personally
                        overseeing the quality assurance process.
                    </p>

                </div>
            </div>

            <div class="row mt-5" id="our-team">
                <!-- Team Member 1 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="la-team-card">
                        <div class="la-team-img-wrapper">
                            <img src="{{ asset('FrontEnd/assets/img/team/muktar-bepari-laptop-ache.jpg') }}"
                                alt="Team Member" class="img-fluid">

                        </div>
                        <div class="la-team-info">
                            <h3 class="la-team-name">Md Mukter Bepari</h3>
                            <p class="la-team-position"> Senior Hardware Engineer</p>
                            <ul class="la-team-contact">
                                <li>
                                    <a href="call:+8801780966740">
                                        <i class="fas fa-phone"></i> +8801780966740
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="la-team-card">
                        <div class="la-team-img-wrapper">
                            <img src="{{ asset('FrontEnd/assets/img/team/monuwara-khatun-laptop-ache.jpg') }}"
                                alt="Team Member" class="img-fluid">
                            <!-- <div class="la-team-overlay">
                                                                                <div class="la-social-links">
                                                                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                                                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                                                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                                                                </div>
                                                                            </div> -->
                        </div>
                        <div class="la-team-info">
                            <h3 class="la-team-name">Md Monoar Hossain</h3>
                            <p class="la-team-position">Sales Executive</p>
                            <ul class="la-team-contact">
                                <li>
                                    <a href="call:+8801817145570">
                                        <i class="fas fa-phone"></i> +8801817145570
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="la-team-card">
                        <div class="la-team-img-wrapper">
                            <img src="{{ asset('FrontEnd/assets/img/team/ismail-laptop-ache.png') }}" alt="Team Member"
                                class="img-fluid">
                            <!-- <div class="la-team-overlay">
                                                                                <div class="la-social-links">
                                                                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                                                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                                                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                                                                </div>
                                                                            </div> -->
                        </div>
                        <div class="la-team-info">
                            <h3 class="la-team-name">Md. Ismail Hossain</h3>
                            <p class="la-team-position">Sales Executive</p>
                            <ul class="la-team-contact">
                                <li>
                                    <a href="call:+8801829096345">
                                        <i class="fas fa-phone"></i> +8801829096345
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Team Member 4 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="la-team-card">
                        <div class="la-team-img-wrapper">
                            <img src="{{ asset('FrontEnd/assets/img/team/sakib-laptop-ache.jpg') }}" alt="Team Member"
                                class="img-fluid">
                            <!-- <div class="la-team-overlay">
                                                            <div class="la-social-links">
                                                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                                                <a href="#"><i class="fab fa-twitter"></i></a>
                                                            </div>
                                                        </div> -->
                        </div>
                        <div class="la-team-info">
                            <h3 class="la-team-name">MD. SHAKIBUL HASAN</h3>
                            <p class="la-team-position">Sales Executive</p>
                            <ul class="la-team-contact">
                                <li>
                                    <a href="call:+8801901378167">
                                        <i class="fas fa-phone"></i> +880 1901-378167
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class=""
                style="background-color: #FF914D90; padding: 40px; border-radius: 10px; margin-top: 30px;">
                <p>
                    You can also visit our physical used laptop <span><a
                            href="https://maps.app.goo.gl/DcDsXpExLENFHdoU9">showroom</a></span> in Dhaka to meet our team
                    and see
                    our inventory.
                </p>

            </div>
        </div>
    </section>
    <section class="la-mission-info py-5 bg-light">
        <div class="container">
            <!-- Mission Section -->
            <div class="row mb-5">
                <div class="col-lg-12">
                    <h2 class="la-section-title">OWhy do we exist and what drives our purpose? (Our
                        Mission)</h2>
                    <div class="la-section-divider"></div>
                    <div class="la-mission-content p-4 p-lg-5 bg-white rounded-4 shadow-sm">
                        <h3 class="la-subtitle mb-3">Used Laptop Sales</h3>
                        <p class="la-mission-text">
                            We are the most trusted name for serving second hand laptops to Bangladesh; we’re known
                            for our value, bringing dependable and peace of mind to your purchase. This mission
                            is driven by our belief that quality tech shouldn't be a luxury, a principle instilled by
                            our founder.

                        </p>
                    </div>
                </div>
            </div>

            <!-- Recognition Section -->
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="la-section-title">What Is Our Customer Trust & Recognition?
                    </h2>
                    <div class="la-section-divider"></div>
                    <div class="la-recognition-card p-4 p-lg-5 bg-white rounded-4 shadow-sm">
                        <p class="la-recognition-text mb-4">
                            In a very short span of time, Laptop Ache has become one of the most popular and trusted
                            used laptop stores in Dhaka, known for high-quality second-hand or used laptops in
                            Bangladesh.

                        </p>



                        <div class="la-recognition-footer mt-4 p-4 bg-light rounded-3">
                            <h3 class="text-dark">
                                Verified Customer Testimonials
                            </h3>
                        </div>
                        <div>

                            <p class="mt-2">
                                "I am giving a review after using it for 1 month. I bought HP Elitebook G6 from you on a
                                student
                                budget. I am getting very good performance. Thank you."

                            </p>
                            <p>
                                <strong>
                                    -Sakib , Freelancer & Student
                                </strong>
                            </p>
                        </div>
                        <div>
                            <p>
                                Our <span class="la-contact-item"><a href="https://share.google/RSG9GEtJYR4Y1uiPT">Google
                                        My Business</a></span> listing indicates a high level of trust from our customers:
                            </p>
                            <ul class="" style="list-style: disc;">
                                <li>
                                    Our GMB profile generates 10,000+ organic impressions monthly (Google Search
                                    Console Data, Q3 2024), demonstrating high visibility.

                                </li>
                                <li>
                                    Our GMB rating is 4.6/5.0 from satisfied students, professionals, and businesses
                                </li>
                                <li>
                                    With an increasingly loyal customer base all around the nation. These are not just
                                    statistics - they represent the trust, quality service and reliability that Laptop Ache
                                    delivers every day. By choosing us, you are choosing a trusted and well-known brand
                                    nationwide.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="la-legal-section py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h2 class="la-section-title text-center">Is Laptop Ache a legally registered business?</h2>
                    <div class="la-section-divider mx-auto mb-1"></div>
                    <p class="text-center mb-5">
                        Laptop Ache is a legally registered business in Bangladesh, operating under local
                        regulations.

                    </p>

                    <div class="la-legal-card p-4 p-lg-5 bg-white rounded-4 shadow-sm">
                        <h3 class="la-subtitle mb-4">Structured Legal Identifiers:</h3>


                        <ul class="la-legal-list">
                            <li class="la-legal-item">
                                <strong>Trade License No:</strong> TRAD/DNCC/013300/2025
                            </li>
                            <li class="la-legal-item">
                                <strong>Tax Identification (TIN) No:</strong> 596889651308
                            </li>
                        </ul>
                        <p class="mt-4">
                            Laptop Ache operates a fully compliant used laptop showroom in Dhaka, adhering to all
                            local business regulations
                        </p>
                    </div>

                    <p class="p-4 "
                        style="font-style: italic; background-color: #FF914D70; border-radius: 10px; margin-top: 30px;">
                        All types of licenses can be viewed in person at our showroom. Due to some confidentiality
                        reasons, these are not being offered online.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="la-faq-section py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5">
                    <h2 class="la-section-title">Frequently Asked Questions (FAQs)</h2>
                    <div class="la-section-divider mx-auto"></div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="la-faq-wrapper p-4 p-lg-5 bg-white rounded-4 shadow-sm">
                        <div class="accordion" id="faqAccordion">
                            <div class="la-faq-item mb-4">
                                <div class="la-faq-header" onclick="toggleFaq('faq1')">
                                    <h3 class="la-faq-question">
                                        <i class="fas fa-question-circle me-2"></i>
                                        What is Laptop Ache?
                                    </h3>
                                </div>
                                <div class="la-faq-body" id="faq1">
                                    <div class="la-faq-answer">
                                        Laptop Ache is a reputed used laptop store in Dhaka that sells all kinds of imported
                                        used
                                        laptops with warranties, offers an installment purchase option, and will ship
                                        anywhere in
                                        Bangladesh. (See our Product Grading Page for quality assurance details).

                                    </div>
                                </div>
                            </div>
                            <div class="la-faq-item mb-4">
                                <div class="la-faq-header" onclick="toggleFaq('faq2')">
                                    <h3 class="la-faq-question">
                                        <i class="fas fa-question-circle me-2"></i>
                                        How long has Laptop Ache been doing business in
                                        Bangladesh?
                                    </h3>
                                </div>
                                <div class="la-faq-body" id="faq2">
                                    <div class="la-faq-answer">
                                        Laptop Ache has been in business for more than 5 years in Bangladesh.

                                    </div>
                                </div>
                            </div>
                            <div class="la-faq-item mb-4">
                                <div class="la-faq-header" onclick="toggleFaq('faq3')">
                                    <h3 class="la-faq-question">
                                        <i class="fas fa-question-circle me-2"></i>
                                        Where is Laptop Ache located?

                                    </h3>
                                </div>
                                <div class="la-faq-body" id="faq3">
                                    <div class="la-faq-answer">
                                        Laptop Ache's head office is in Badda — a leading used laptop shop in Dhaka, and we
                                        deliver securely anywhere in Bangladesh.


                                    </div>
                                </div>
                            </div>
                            <div class="la-faq-item mb-4">
                                <div class="la-faq-header" onclick="toggleFaq('faq4')">
                                    <h3 class="la-faq-question">
                                        <i class="fas fa-question-circle me-2"></i>
                                        Will I get a warranty on your laptops?
                                    </h3>
                                </div>
                                <div class="la-faq-body" id="faq4">
                                    <div class="la-faq-answer">
                                        Yes. Warranty on every laptop is 0 to 3 years depending on the model.

                                    </div>
                                </div>
                            </div>
                            <div class="la-faq-item mb-4">
                                <div class="la-faq-header" onclick="toggleFaq('faq5')">
                                    <h3 class="la-faq-question">
                                        <i class="fas fa-question-circle me-2"></i>
                                        Can I buy your laptops on installments?
                                    </h3>
                                </div>
                                <div class="la-faq-body" id="faq5">
                                    <div class="la-faq-answer">
                                        Yes, it requires a 50% advance, and the balance can be paid till 3 months.


                                    </div>
                                </div>
                            </div>
                            <div class="la-faq-item mb-4">
                                <div class="la-faq-header" onclick="toggleFaq('faq6')">
                                    <h3 class="la-faq-question">
                                        <i class="fas fa-question-circle me-2"></i>
                                        Who can purchase your laptops?
                                    </h3>
                                </div>
                                <div class="la-faq-body" id="faq6">
                                    <div class="la-faq-answer">
                                        Anyone like students, freelancers, office workers, entrepreneurs, and small
                                        businesses
                                        everywhere in Bangladesh.

                                    </div>
                                </div>
                            </div>
                            <div class="la-faq-item mb-4">
                                <div class="la-faq-header" onclick="toggleFaq('faq7')">
                                    <h3 class="la-faq-question">
                                        <i class="fas fa-question-circle me-2"></i>
                                        What is your guarantee regarding the quality of the laptops?

                                    </h3>
                                </div>
                                <div class="la-faq-body" id="faq7">
                                    <div class="la-faq-answer">
                                        We only import A+ Grade laptops and each laptop is tested and graded individually
                                        before
                                        sale using a 21-point inspection process

                                    </div>
                                </div>
                            </div>
                            <div class="la-faq-item mb-4">
                                <div class="la-faq-header" onclick="toggleFaq('faq8')">
                                    <h3 class="la-faq-question">
                                        <i class="fas fa-question-circle me-2"></i>
                                        Do you ship anywhere in Bangladesh?
                                    </h3>
                                </div>
                                <div class="la-faq-body" id="faq8">
                                    <div class="la-faq-answer">
                                        Yes, we ship anywhere in Bangladesh generally with tracked secure shipping (3-5 days
                                        standard).


                                    </div>
                                </div>
                            </div>
                            <div class="la-faq-item mb-4">
                                <div class="la-faq-header" onclick="toggleFaq('faq9')">
                                    <h3 class="la-faq-question">
                                        <i class="fas fa-question-circle me-2"></i>
                                        Why should I trust Laptop Ache?
                                    </h3>
                                </div>
                                <div class="la-faq-body" id="faq9">
                                    <div class="la-faq-answer">
                                        Laptop Ache is a trusted retailer of laptops with transparent pricing, a warranty
                                        for
                                        purchases, easy payment plans, and a proven track record for 5 years in Bangladesh,
                                        supported by a 4.4/5.0 customer rating.

                                    </div>
                                </div>
                            </div>
                            <div class="la-faq-item mb-4">
                                <div class="la-faq-header" onclick="toggleFaq('faq10')">
                                    <h3 class="la-faq-question">
                                        <i class="fas fa-question-circle me-2"></i>
                                        What is the best way to contact the Laptop Ache
                                        Developers?
                                    </h3>
                                </div>
                                <div class="la-faq-body" id="faq10">
                                    <div class="la-faq-answer">
                                        You can reach out through our website www.laptopache.com, or you are welcome to meet
                                        us
                                        and visit our showroom in Badda, Dhaka. You can also call at:

                                        <a href="tel:+8801901378164" class="text-decoration-none">
                                            +8801901378164
                                        </a>

                                    </div>
                                </div>
                            </div>
                            <div class="la-faq-item mb-4">
                                <div class="la-faq-header" onclick="toggleFaq('faq11')">
                                    <h3 class="la-faq-question">
                                        <i class="fas fa-question-circle me-2"></i>
                                        Is a 2nd hand / used laptop eco friendly?
                                    </h3>
                                </div>
                                <div class="la-faq-body" id="faq11">
                                    <div class="la-faq-answer">
                                        Yes. Buying a used laptop is a small way to help reduce e-waste. To date, we have
                                        diverted
                                        over 2,500 kg of potential e-waste.


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function toggleFaq(id) {
            const item = document.getElementById(id).parentElement;
            if (item.classList.contains('active')) {
                item.classList.remove('active');
            } else {
                // Close other open items
                document.querySelectorAll('.la-faq-item').forEach(faq => {
                    faq.classList.remove('active');
                });
                item.classList.add('active');
            }
        }
    </script>
@endsection
