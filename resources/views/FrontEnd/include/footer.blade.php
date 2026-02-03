<!-- ============================ Footer Start ================================== -->
<footer class="dark-footer skin-dark-footer" style="">
    <div class="footer-middle">
        <div class="container">
            <div class="row">

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="footer_widget">
                        <img src="{{asset(get_setting('site_footer_logo')->value)}}" class="img-footer small mb-2 w-100" alt="" />
                        <p class="text-white">
                            Laptop AcheLaptop Ache delivers high-quality second-hand laptops imported from Dubai at affordable prices. This e-commerce business aims to make technology accessible to all segments of society.
                        </p>
                        <p>A sister concern of 64 BD Products.</p>

                        {{-- <div class="address mt-3">
                            {{get_setting('business_address')->value}}
                    </div>
                    <div class="address mt-3">
                        {{get_setting('phone')->value}}<br>{{get_setting('email')->value}}
                    </div> --}}
                    <div class="address mt-3">
                        <ul class="list-inline">
                            <li class="list-inline-item text-white"><a href="{{get_setting('facebook_url')->value}}"><i class="lni lni-facebook-filled"></i></a></li>
                            <li class="list-inline-item text-white"><a href="{{get_setting('twitter_url')->value}}"><i class="lni lni-twitter-filled"></i></a></li>
                            <li class="list-inline-item text-white"><a href="{{get_setting('youtube_url')->value}}"><i class="lni lni-youtube"></i></a></li>
                            <li class="list-inline-item text-white"><a href="{{get_setting('instagram_url')->value}}"><i class="lni lni-instagram-filled"></i></a></li>
                            <li class="list-inline-item text-white"><a href="{{get_setting('linkedin_url')->value}}"><i class="lni lni-linkedin-original"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6">
                <div class="footer_widget">
                    <h4 class="widget_title">Supports</h4>
                    <ul class="footer-menu">
                        <li><a href="{{route('page.contact')}}">Contact Us</a></li>
                        <li><a href="{{route('page.about')}}">About Us</a></li>
                        <li><a href="{{route('blogs')}}">Blogs</a></li>  
                        {{-- <li><a href="{{route('')}}">Size Guide</a></li>--}}
                        <li><a href="{{route('page.shipping-return')}}">Shipping & Returns</a></li>
                        <li><a href="{{route('page.faq')}}">FAQ's Page</a></li>
                        <li><a href="{{ route('affiliate') }}">Join As An Affiliate</a></li>
                        <li><a href="{{route('page.policy')}}">Privacy</a></li>
                       
                    </ul>
                </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6">
                <div class="footer_widget">
                    <h4 class="widget_title">Shop</h4>
                    <ul class="footer-menu">
                        @foreach(get_categories() as $key=>$category)
                        @if($key == 5)
                        @php break; @endphp
                        @endif
                        <li><a href="{{route('product.category', $category->slug)}}">{{$category->name_en}}</a></li>
                        @endforeach
                        <li><a href="{{route('product.warrenty')}}">Product Warrenty</a></li>
                        <li><a href="{{route('login_form')}}">Staff Login</a></li>
                        
                    </ul>
                </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6">
                <div class="footer_widget">
                    <h4 class="widget_title">Helpline</h4>
                    <ul class="footer-menu">
                        <li><a href="{{route('page.help')}}"> {{get_setting('phone')->value}}</a></li>
                        <li><a href="{{route('page.help')}}"> {{get_setting('email')->value}}</a></li>
                        <li><a href="{{route('page.help')}}"> {{get_setting('business_address')->value}}</a></li>
                        {{-- <li><a href="#">Blog</a></li>--}}
                        {{-- <li>
                                @if(Auth::user() && Auth::user()->role == 3)
                                    <a href="{{route('dashboard')}}">Dashboard</a>
                        @else
                        <a href="{{route('login')}}">Login</a>
                        @endif
                        </li> --}}
                    </ul>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 d-sm-block d-none">
                <div class="footer_widget">
                    <h4 class="widget_title">Subscribe</h4>
                    <p>Receive updates, hot deals, discounts sent straignt in your inbox daily</p>
                    <div class="foot-news-last">
                        <div class="input-group border ">
                            <input type="text" class="form-control " style="border: none !important" placeholder="Email Address">
                            <div class="input-group-append " style="border-left: 1px solid #fafafa">
                                <button type="button" class="input-group-text b-0 text-light "><i class="lni lni-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="address mt-3">
                        <h5 class="fs-sm text-light">Secure Payments</h5>
                        <div class="scr_payment"><img src="{{asset('FrontEnd')}}/assets/img/card.png" class="img-fluid" alt="" /></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

    <div class="footer-bottom ">
        <div class="container">
            <div class="row align-items-center mb-4">
                <div class="col-lg-12 col-md-12 text-md-center text-left ">
                    <p class="mb-0">Copyright © 2024 | {{get_setting('business_name')->value}} | Developed By <a href="https://ibrahimtechbd.com/" target="_blank">ITBD</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ============================ Footer End ================================== -->