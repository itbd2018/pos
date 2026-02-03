@extends('FrontEnd.master')
@section('content')
    <section class="pb-0 py-2 bg-white" style="border-bottom:1px solid rgb(238, 238, 238)">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <div class="">
                    <a href="{{ route('home') }}">
                        <img style="" src="{{ asset(get_setting('site_logo')->value) }}" class="logo affiliate-logo-width"
                        alt="" />
                    </a>
                </div>
                <div class="d-flex align-items-center" style="gap:20px;">
                    <a href="{{ route('vendor.login_form') }}" class=" px-2 py-1 rounded d-sm-none d-block"
                        style=" font-size: 16px; color: #FF914D; border: 1px solid #FF914D !important;">
                        Affiliate Login
                    </a>
                    <a href="{{ route('vendor.login_form') }}" class=" px-4 py-2 rounded d-sm-block d-none"
                        style=" font-size: 18px; color: #FF914D; border: 1px solid #FF914D !important;">
                        Affiliate Login
                    </a>
                    <a href="{{ route('register.affiliate') }}" class="px-4 py-2 rounded text-white d-sm-block d-none"
                        style="background-color: #FF914D; font-size: 18px; border: 1px solid #FF914D !important;">
                        Regester
                    </a>

                </div>
            </div>
        </div>
    </section>
    <section class="pb-0 py-5   bg-white">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-12 col-md-7">
                    <div class="d-flex align-items-center " style="gap: 5px;">
                        <i class="fas fa-check-circle " style="font-size: 16px;"></i>
                        <p class="pb-0 mb-0">নির্ভরযোগ্য ই-কমার্স প্ল্যাটফর্ম
                        </p>
                    </div>
                    <h1 class="affilater-bannaer-title mt-3 affiliate-title">
                        আপনার ক্যারিয়ারকে উন্নত করুন এবং টাকা আর্ন করুন।
                    </h1>
                    <p class="description mt-3">আমাদের অ্যাফিলিয়েট প্রোগ্রামে যোগ দিন এবং আমাদের পণ্য প্রমোট করে কমিশন অর্জন করুন। এটি শুরু করা খুব সহজ এবং আপনি বাড়িতে বসেই আয় করতে পারবেন।</p>

                    <div class="d-flex align-items-center mt-4" style="gap: 15px;">

                        <a style="border: 1px solid #FF914D; background-color: #FF914D; padding: 12px 25px;"
                            href="{{ route('register.affiliate') }}" class="btn text-white">Get Started</a>
                        {{-- <a class="btn d-flex align-items-center " style=" gap: 10px; border: 1px solid #FF914D;"
                            id="watchVideo" href="">
                            <i class="fas fa-play-circle" style="font-size: 24px; "></i>
                            <p class="mb-0"> Watch Video
                            </p>
                        </a> --}}

                    </div>
                </div>
                <div class="col-12 col-md-4 mt-md-0 mt-4">
                    <img class="w-100" src={{ asset('FrontEnd/assets/img/affiliate-banner.png') }} alt="">

                </div>

            </div>
        </div>

    </section>


    <section class="py-5" style="background-color: #F0F2F5">
        <div class="container px-4 mx-auto position-relative">
            <div>
                <h2 class="text-dark text-center">অ্যাফিলিয়েশন প্রোগ্রাম</h2>
                <p class="text-dark text-center custom-affiliate-width m-auto">অসংখ্য প্রোডাক্ট নিজের পছন্দের প্ল্যাটফর্মে পোস্ট করে শুরু করুন
                    আয় করা।
                    আসুন জেনে নেই কিভাবে সহজ ৩টি ধাপে আপনি হয়ে উঠবেন একজন সফল অ্যাফিলিয়েট পার্টনার।</p>
            </div>
            <div class="mt-md-5 mt-4 pt-md-4 pt-0 position-relative">
                <div class="position-absolute top-0 translate-middle-x d-none d-md-block w-100"
                    style="left: 50%; transform: translateX(-37%);">

                    <img class="m-auto " src={{ asset('FrontEnd/assets/img/Screenshot_2.png') }} alt="">
                </div>
                <div class="row text-center gy-4 gy-md-5">
                    <div class="col-md-4">
                        <div class="icon-circle mx-auto">
                            <i class="fas fa-edit"></i>
                        </div>
                        <h3 class="mt-4 fs-5 fw-semibold text-dark">১. রেজিস্ট্রেশন করুন</h3>
                        <p class="mt-3 text-muted">সহজেই কয়েকটি ধাপে রেজিস্ট্রেশন করে যুক্ত হয়ে যান অ্যাফিলিয়েশন প্রোগ্রামে।
                        </p>
                    </div>
                    <div class="col-md-4">
                        <div class="icon-circle mx-auto">
                            <i class="fas fa-share-square"></i>
                        </div>
                        <h3 class="mt-4 fs-5 fw-semibold text-dark">২. পোস্ট করুন</h3>
                        <p class="mt-3 text-muted">আপনার নিজস্ব অ্যাফিলিয়েট লিংক এবং প্রমোশনাল কন্টেন্ট পোস্ট করুন বিভিন্ন
                            প্ল্যাটফর্মে।</p>
                    </div>
                    <div class="col-md-4">
                        <div class="icon-circle mx-auto">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <h3 class="mt-4 fs-5 fw-semibold text-dark">৩. আয় করুন</h3>
                        <p class="mt-3 text-muted">আপনাকে দেয়া লিংকটি ব্যবহার করে প্রোডাক্ট কেনা হলে পেয়ে যাবেন প্রোডাক্টির
                            মূল্যের ১৫% কমিশন!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-2-8 mb-lg-6">
                <h2 class="text-dark affiliate-section-title text-center font-weight-700">কেন আমাদের অ্যাফিলিয়েট প্রোগ্রাম বেছে নিবেন?
                </h2>

            </div>
            <div class="row align-items-center mt-5">
                <div class="col-sm-6 col-lg-4 mb-2-9 mb-sm-0">
                    <div class="pr-md-3">
                        <div class="text-center text-sm-right mb-2-9">
                            <div class="mb-3">
                                <img style="width: 80px; height:80px; object: cover;"
                                    src="{{ asset('FrontEnd/assets/img/home.png') }}" alt="..." class="rounded-circle">
                            </div>
                            <h4 class="text-dark sub-info">ঘরে বসে আয়ের সুযোগ</h4>
                            <p style="font-size: 14px" class="text-dark mb-0">বিক্রির মাধ্যমে ঘরে বসেই প্রতিমাসে ২৫ থেকে ৫০
                                হাজার+ টাকা উপার্জনের সুযোগ</p>
                        </div>
                        <div class="text-center text-sm-right mt-4">
                            <div class="mb-3">
                                <img style="width: 80px; height:80px; object: cover;"
                                    src="{{ asset('FrontEnd/assets/img/products.png') }}" alt="..."
                                    class="rounded-circle">
                            </div>
                            <h4 class="text-dark sub-info">চমৎকার প্রোডাক্টস ও কন্টেন্টস</h4>
                            <p style="font-size: 14px" class="display-30 mb-0">১০০+ স্কিল ও একাডেমিক কোর্সসমূহ থেকে নিজের
                                প্ল্যাটফর্ম অনুসারে প্রোডাক্ট প্রোমোশনের সুযোগ</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-none d-lg-block">
                    <div class="why-choose-center-image">
                        <img src="{{ asset('FrontEnd/assets/img/chose.us.png') }}" alt="..." class="rounded-circle">

                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="">
                        <div class="text-center text-sm-left mb-2">
                            <div class="mb-3">
                                <img style="width: 80px; height:80px; object: cover;"
                                    src="{{ asset('FrontEnd/assets/img/jobcircular.png') }}" alt="..."
                                    class="rounded-circle">
                            </div>
                            <h4 class="text-dark sub-info">লার্নিং ও ট্রেনিং সেশন</h4>
                            <p style="font-size: 14px" class="mb-0">ডিজিটাল মার্কেটিং এবং সেলস টেকনিক শিখে একজন দক্ষ
                                অ্যাফিলিয়েট হওয়ার দারুন সুযোগ</p>
                        </div>

                        <div class="text-center text-sm-left mt-4">
                            <div class="mb-3">
                                <img style="width: 80px; height:80px; object: cover;"
                                    src="{{ asset('FrontEnd/assets/img/questions.png') }}" alt="..."
                                    class="rounded-circle">
                            </div>
                            <h4 class="text-dark sub-info">লেভেল ওয়াইজ কমিশন স্ট্রাকচার</h4>
                            <p style="font-size: 14px" class="display-30 mb-0">সুপার সেলার সহ আরও বিভিন্ন ক্যাম্পেইনে
                                অংশগ্রহণ করে জিতে নিন লেটেস্ট আইফোন আরো অনেক আকর্ষণীয় গিফট</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-md-5 py-0 bg-white">
        <div class="container py-5">
            <div class="row g-4 align-items-center">
                <div class="col-md-5 col-12">
                    <!-- Title -->
                    <h2 class="text-dark mb-3 text-center text-md-left">অ্যাফিলিয়েশনের জন্য প্রয়োজনীয় <span class="text-warning">স্কিলস্</span>
                    </h2>
                    <!-- Image -->
                    <img class="w-100" src="{{ asset('FrontEnd/assets/img/skill.jpg') }}" class="rounded-2"
                        alt="">
                </div>
                <div class="col-md-7 col-12 mt-md-0 mt-4">
                    <div class="row g-4">
                        <!-- Item -->
                        <div class="col-sm-6 text-center text-md-left mt-3 mt-md-0">
                            <div style="width: 60px; height:60px; background-color:#FFF2E7;"
                                class="rounded icon-lg d-flex align-items-center justify-content-center m-auto m-md-0"><i
                                    class="fas fa-user-tie" style="font-size: 28px; color:#FF914D;"></i></div>
                            <h5 class="mt-3 mb-2 text-dark">কন্টেন্ট ক্রিয়েটর</h5>
                            <p style="font-size: 14px; color:#5c5c5c;" class="">ব্লগ আর্টিকেল, ইউটিউব ভিডিও, পডকাস্ট
                                এবং সোশ্যাল মিডিয়াতে কন্টেন্ট ক্রিয়েট করার অভিজ্ঞতা থাকলে</p>
                        </div>
                        <!-- Item -->
                        <div class="col-sm-6 text-center text-md-left mt-3 mt-md-0">
                            <div style="width: 60px; height:60px; background-color:#E7F6F8;"
                                class="icon-lg rounded m-auto m-md-0 d-flex align-items-center justify-content-center">
                                <i class="fas fa-user-tie" style="font-size: 28px; color: #17A2B8 !important;"></i>
                            </div>
                            <h5 class="mt-3 mb-2 text-dark">এডুকেশন এবং ট্রেইনিংয়ে আগ্রহ আছে</h5>
                            <p style="font-size: 14px; color:#5c5c5c;" class="">বাংলাদেশের অনলাইন এডুকেশন সেক্টর
                                নিয়ে কাজ করার আগ্রহ থাকলে</p>
                        </div>
                        <!-- Item -->
                        <div class="col-sm-6 text-center text-md-left mt-3 mt-md-0">
                            <div style="width: 60px; height:60px;  background-color:#E6F8F3;"
                                class="icon-lg bg-opacity-10 m-auto m-md-0 rounded d-flex align-items-center justify-content-center">
                                <i class="fas fa-user-tie" style="font-size: 28px; color:#0CBC87 !important;"></i>
                            </div>
                            <h5 class="mt-3 mb-2 text-dark">ডিজিটাল মাার্কেটার</h5>
                            <p style="font-size: 14px; color:#5c5c5c;" class="">ডিজিটাল মার্কেটিংয়ে অনলাইন ট্র্যাফিক
                                এবং কাস্টমার কনভার্সন নিয়ে কাজ করার অভিজ্ঞতা থাকলে</p>
                        </div>
                        <!-- Item -->
                        <div class="col-sm-6 text-center text-md-left mt-3 mt-md-0">
                            <div style="width: 60px; height:60px; background-color:#F0ECF9;"
                                class="icon-lg bg-purple m-auto m-md-0 bg-opacity-10  rounded d-flex align-items-center justify-content-center">
                                <i class="fas fa-user-tie" style="font-size: 28px; color:#6F42C1 !important;"></i>
                            </div>
                            <h5 class="mt-3 mb-2 text-dark">পেইড মার্কেটিং স্পেশালিষ্ট</h5>
                            <p style="font-size:14px; color:#5c5c5c;" class="">Google Ads, Facebook Ads এবং YouTube
                                Ads-এর মতো প্ল্যাটফর্মে এড ক্যাম্পেইন রান করার অভিজ্ঞতা থাকলে</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- ===========popup video============================== --}}

    <section id="videoPopup" class="w-100 popup-youtube-video-section d-none"
        style="height: 100vh; position: fixed; background-color: #31313199; top: 0; left: 0; z-index: 999;">
        <div class="d-flex align-items-center justify-content-center w-100" style="height: 100%;">
            <div class="position-relative affiliate-video-popup">
                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/S284KSgOWRU?si=H8Zl7tJeR84QB8kl"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            
                <button type="button" class="btn-close position-absolute start-0" aria-label="Close"
                    onclick="closePopup()">
                    <i class="fas fa-times" style="font-size: 22px;"></i>
                </button>
            </div>
        </div>
    </section>
@endsection
