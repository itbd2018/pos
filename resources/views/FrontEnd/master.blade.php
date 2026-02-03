<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    {{--    <meta name="author" content="Themezhub" /> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="5YOg7Me1VUR2hx1IwwbsmW1vJP6P-vhqUvHaSyRacjg" />
	<meta name="facebook-domain-verification" content="equtodb3vn8sstl5cr2izgwx9dc4ug" />
    <link rel="canonical" href="@yield('canonical', url()->current())" />
    <meta name="title" content="{{ get_setting('site_name')->value }} | @yield('meta_title')">
    <meta name="description" content="@yield('meta_description', 'Laptopache')" />
    <link rel="shortcut icon" href="{{ asset(get_setting('site_favicon')->value) }}" type="image/x-icon">
    <title> {{ get_setting('site_name')->value }} | @yield('title')</title>

    <!-- Custom CSS -->
    @stack('css')
    @include('FrontEnd.include.style')

</head>

<body>

    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader"></div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        @if (Route::currentRouteName() !== 'affiliate' && Route::currentRouteName() !== 'register.affiliate')
            @include('FrontEnd.include.header')
            <!-- Meta Pixel Code -->
            <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '602800508762396');
            fbq('track', 'PageView');
            </script>
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-LJKGNSRQVS"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-LJKGNSRQVS');
</script>
            <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=602800508762396&ev=PageView&noscript=1"
            /></noscript>
            <!-- End Meta Pixel Code -->
        @endif

        @yield('content')

        @include('FrontEnd.include.footer')

        <!-- Product View Modal -->
        <div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-headers">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" id="closeModel"
                        aria-label="Close">
                        <span class="ti-close"></span>
                    </button>
                </div>
                <div class="modal-content ">
                    {{--                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close" id="closeModel">Close</button> --}}
                    <div class="modal-body mt-5">
                        <div class="row" style="color: black !important">
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                                <div class="detail-gallery">
                                    <!-- <span class="zoom-icon"><i class="fi-rs-search"></i></span> -->
                                    <!-- MAIN SLIDES -->
                                    <div class="product-image-slider">
                                        <figure class="border-radius-10">
                                            <img id="pimage" src="" class="img-fluid" width="375"
                                                alt="product image" />
                                        </figure>
                                    </div>
                                    <!-- THUMBNAILS -->
                                    <!-- <div class="slider-nav-thumbnails">
                                    <div><img  src="" alt="product image" /></div>
                                </div> -->
                                </div>
                                <!-- End Gallery -->
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-info pr-30 pl-30">
                                    <!--  <span class="stock-status out-stock"> Sale Off </span> -->
                                    <h3 class="title-detail"><a id="product_name" href="#"
                                            class="text-heading text-dark"></a></h3>
                                    <!--  <div class="product-detail-rating">
                                     <div class="product-rate-cover text-end">
                                         <div class="product-rate d-inline-block">
                                             <div class="product-rating" style="width: 90%"></div>
                                         </div>
                                         <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                     </div>
                                 </div> -->
                                    <div class="clearfix product-price-cover">
                                        <div class="product-price primary-color float-left">
                                            <span class="current-price mb-2 d-flex text-brand">৳ <span
                                                    id="pprice"></span></span>
                                            <span>
                                                <!--   <span class="save-price font-md color3 ml-15">26% Off</span> -->
                                                <del id="oldprice" class="old-price font-md ml-15 mb-2"
                                                    style="color: grey">৳</del>
                                            </span>
                                        </div>
                                    </div>
                                    <form id="choice_form">
                                        <div class="row " id="attributes">
                                            <div class="form-group col-lg-6" id="colorArea">
                                                {{-- <label style=" font-weight:bold;color: black;">Chose Color <span>**</span></label>
                                            <select class="form-control" id="color" name="color">
                                                <option value="">--Choose Color--</option>
                                            </select> --}}
                                            </div>
                                        </div>

                                        <div class="row" id="attribute_alert">

                                        </div>
                                    </form>
                                    <div class="font-xs">
                                        <div style="list-style: none">
                                            <p class="mb-1">
                                                {{ session()->get('language') == 'bangla' ? 'ক্যাটাগোরি' : 'Category' }}:
                                                <span class="text-brand" id="pcategory">

                                                </span>
                                            </p>
                                            <p class="mb-1">
                                                {{ session()->get('language') == 'bangla' ? 'ব্র্যান্ড' : 'Brand' }}:
                                                <span class="text-brand" id="pbrand">

                                                </span>
                                            </p>
                                            <p class="mb-1 d-none">
                                                {{ session()->get('language') == 'bangla' ? 'পণ্য কোড' : 'Product Code' }}:
                                                <span class="text-brand" id="pcode">

                                                </span>
                                            </p>
                                            <p class="mb-1">
                                                {{ session()->get('language') == 'bangla' ? 'স্টক' : 'Stock' }}:
                                                <span class="badge badge-pill badge-success" id="pavailable"
                                                    style="background: green; color: white;">
                                                    {{ session()->get('language') == 'bangla' ? 'স্টকে আছে' : 'Available' }}
                                                </span>
                                                <span class="badge badge-pill badge-danger" id="pstockout"
                                                    style="background: red; color: white;">
                                                    {{ session()->get('language') == 'bangla' ? 'স্টক আউট' : 'Stock Out' }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="detail-extralink align-items-baseline d-flex" style="margin-top: 30px;">
                                        <div class="mr-10">
                                            <span
                                                class="">{{ session()->get('language') == 'bangla' ? 'পরিমাণ' : 'Quantity' }}:</span>
                                        </div>
                                        <div class="detail-qty border radius">
                                            <a href="#" class="qty-down"><i
                                                    class="fi-rs-angle-small-down"></i></a>
                                            <input type="number" name="quantity" class="qty-val form-control"
                                                value="{{ $product->minimum_buy_qty ?? '1' }}" min="1"
                                                id="qty" style="width: 100px">
                                            <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                        </div>
                                    </div>
                                    <div class="d-block mt-3" id="qty_stock_alert">

                                    </div>
                                    <div class="detail-extralink d-flex mb-30" style="margin-top: 10px;">
                                        <!-- <div class="detail-qty border radius">
                                        <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>

                                        <input type="text" name="quantity" class="qty-val" id="qty" value="1" min="1">

                                        <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div> -->
                                        <div class="product-extra-link2">
                                            <input type="hidden" id="product_id">
                                            <input type="hidden" id="pname">
                                            <input type="hidden" id="product_price">
                                            <input type="hidden" id="discount_amount">
                                            <input type="hidden" id="pfrom" value="modal">
                                            <input type="hidden" id="pvarient" value="">

                                            <input type="hidden" id="minimum_buy_qty" value="">
                                            <input type="hidden" id="stock_qty" value="">

                                            <input type="hidden" id="buyNowCheck" value="0">

                                            <button style="width: 100px"
                                                class="like btn button btn-outline-dark add_to_cart" onclick="test()"
                                                id="closeModel"><i class="fi-rs-shopping-cart"></i>
                                                {{ session()->get('language') == 'bangla' ? 'কার্টে যোগ করুন' : 'Add to Cart' }}
                                            </button>

                                            <button style="width: 100px" class="like btn btn-outline-dark buy_now"
                                                onclick="buyProduct()"><i class="fi-rs-shopping-cart"></i>
                                                {{ session()->get('language') == 'bangla' ? 'এখুনি কিনুন' : 'Buy Now' }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Detail Info -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->

        <!-- Log In Modal -->
        <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="loginmodal"
            aria-hidden="true">
            <div class="modal-dialog modal-xl login-pop-form" role="document">
                <div class="modal-content" id="loginmodal">
                    <div class="modal-headers">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="ti-close"></span>
                        </button>
                    </div>

                    <div class="modal-body p-5">
                        <div class="text-center mb-4">
                            <h2 class="m-0 ft-regular">Login</h2>
                        </div>

                        <form>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" class="form-control" placeholder="Username*">
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Password*">
                            </div>

                            <div class="form-group">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="flex-1">
                                        <input id="dd" class="checkbox-custom" name="dd"
                                            type="checkbox">
                                        <label for="dd" class="checkbox-custom-label">Remember Me</label>
                                    </div>
                                    <div class="eltio_k2">
                                        <a href="#">Lost Your Password?</a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit"
                                    class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Login</button>
                            </div>

                            <div class="form-group text-center mb-0">
                                <p class="extra">Not a member?<a href="#et-register-wrap" class="text-dark">
                                        Register</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->

        <!-- Search -->
        @include('FrontEnd.include.mobile_search_bar')

        <!-- Wishlist -->
        <div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;"
            id="Wishlist">
            <div class="rightMenu-scroll">
                <div class="d-flex align-items-center justify-content-between slide-head py-3 px-3">
                    <h4 class="cart_heading fs-md ft-medium mb-0">Saved Products</h4>
                    <button onclick="closeWishlist()" class="close_slide"><i class="ti-close"></i></button>
                </div>
                <div class="right-ch-sideBar">

                    <div class="cart_select_items py-2">
                        <!-- Single Item -->
                        <div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3">
                            <div class="cart_single d-flex align-items-center">
                                <div class="cart_selected_single_thumb">
                                    <a href="#"><img src="{{ asset('FrontEnd') }}/assets/img/product/4.jpg"
                                            width="60" class="img-fluid" alt="" /></a>
                                </div>
                                <div class="cart_single_caption pl-2">
                                    <h4 class="product_title fs-sm ft-medium mb-0 lh-1">Women Striped Shirt Dress</h4>
                                    <p class="mb-2"><span class="text-dark ft-medium small">36</span>, <span
                                            class="text-dark small">Red</span></p>
                                    <h4 class="fs-md ft-medium mb-0 lh-1">$129</h4>
                                </div>
                            </div>
                            <div class="fls_last"><button class="close_slide gray"><i class="ti-close"></i></button>
                            </div>
                        </div>

                        <!-- Single Item -->
                        <div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3">
                            <div class="cart_single d-flex align-items-center">
                                <div class="cart_selected_single_thumb">
                                    <a href="#"><img src="{{ asset('FrontEnd') }}/assets/img/product/7.jpg"
                                            width="60" class="img-fluid" alt="" /></a>
                                </div>
                                <div class="cart_single_caption pl-2">
                                    <h4 class="product_title fs-sm ft-medium mb-0 lh-1">Girls Floral Print Jumpsuit
                                    </h4>
                                    <p class="mb-2"><span class="text-dark ft-medium small">36</span>, <span
                                            class="text-dark small">Red</span></p>
                                    <h4 class="fs-md ft-medium mb-0 lh-1">$129</h4>
                                </div>
                            </div>
                            <div class="fls_last"><button class="close_slide gray"><i class="ti-close"></i></button>
                            </div>
                        </div>

                        <!-- Single Item -->
                        <div class="d-flex align-items-center justify-content-between px-3 py-3">
                            <div class="cart_single d-flex align-items-center">
                                <div class="cart_selected_single_thumb">
                                    <a href="#"><img src="{{ asset('FrontEnd') }}/assets/img/product/8.jpg"
                                            width="60" class="img-fluid" alt="" /></a>
                                </div>
                                <div class="cart_single_caption pl-2">
                                    <h4 class="product_title fs-sm ft-medium mb-0 lh-1">Girls Solid A-Line Dress</h4>
                                    <p class="mb-2"><span class="text-dark ft-medium small">30</span>, <span
                                            class="text-dark small">Blue</span></p>
                                    <h4 class="fs-md ft-medium mb-0 lh-1">$100</h4>
                                </div>
                            </div>
                            <div class="fls_last"><button class="close_slide gray"><i class="ti-close"></i></button>
                            </div>
                        </div>

                    </div>

                    <div class="d-flex align-items-center justify-content-between br-top br-bottom px-3 py-3">
                        <h6 class="mb-0">Subtotal</h6>
                        <h3 class="mb-0 ft-medium">$417</h3>
                    </div>

                    <div class="cart_action px-3 py-3">
                        <div class="form-group">
                            <button type="button" class="btn d-block full-width btn-dark">Move To Cart</button>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn d-block full-width btn-dark-light">Edit or View</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Cart -->
        <div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;"
            id="Cart">
            <div class="rightMenu-scroll">
                <div class="d-flex align-items-center justify-content-between slide-head py-3 px-3">
                    <h4 class="cart_heading fs-md ft-medium mb-0">Products List</h4>
                    <button onclick="closeCart()" class="close_slide"><i class="ti-close"></i></button>
                </div>
                <div class="right-ch-sideBar">

                    @php use Gloudemans\Shoppingcart\Facades\Cart; @endphp
                    @php  $subtotal = 0; @endphp
                    {{--                @php dd(Cart::content()) @endphp --}}
                    <div class="cart_select_items py-2">
                        @php $cart_products = get_cart_data() @endphp
                        @if (count($cart_products) > 0)
                            @foreach ($cart_products as $cart)
                                <div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3">
                                    <div class="cart_single d-flex align-items-center">
                                        <div class="cart_selected_single_thumb">
                                            @php $product = get_product_by_id($cart->id) @endphp
                                            <a href="#"><img src="{{ asset($product->product_thumbnail) }}"
                                                    width="60" class="img-fluid" alt="" /></a>
                                        </div>
                                        <div class="cart_single_caption pl-2">
                                            <h4 class="product_title fs-sm ft-medium mb-0 lh-1">
                                                {{ $product->name_en }}</h4>
                                            <p class="mb-2"><span
                                                    class="text-dark ft-medium small">{{ $cart->qty }}</span>,
                                                <span class="text-dark small">Red</span>
                                            </p>
                                            <h4 class="fs-md ft-medium mb-0 lh-1">৳{{ $cart->price }}</h4>
                                        </div>
                                    </div>
                                    <div class="fls_last"><button class="close_slide gray" id="${value.rowId}"
                                            onclick="cartRemove(this.id)"><i class="ti-close"></i></button></div>
                                </div>
                                @php $subtotal+= $cart->price @endphp
                            @endforeach
                        @else
                            <div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3">
                                No Item Included
                            </div>

                        @endif
                        <!-- Single Item -->


                    </div>

                    <div class="d-flex align-items-center justify-content-between br-top br-bottom px-3 py-3">
                        <h6 class="mb-0">Subtotal</h6>
                        <h3 class="mb-0 ft-medium">৳{{ $subtotal }}</h3>
                    </div>

                    <div class="cart_action px-3 py-3">
                        <div class="form-group">
                            <button type="button" class="btn d-block full-width btn-dark">Checkout Now</button>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn d-block full-width btn-dark-light">Edit or View</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>


    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    @include('FrontEnd.include.script')
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    @stack('js')
    <script>
        function openWishlist() {
            document.getElementById("Wishlist").style.display = "block";
        }

        function closeWishlist() {
            document.getElementById("Wishlist").style.display = "none";
        }
    </script>

    <script>
        function openCart() {
            document.getElementById("Cart").style.display = "block";
        }

        function closeCart() {
            document.getElementById("Cart").style.display = "none";
        }
    </script>

    <script>
        function openSearch() {
            document.getElementById("Search").style.display = "block";
        }

        function closeSearch() {
            document.getElementById("Search").style.display = "none";
        }
    </script>
    

<script type="application/ld+json">

{

&nbsp; "@context": "https://schema.org",

&nbsp; "@type": "Organization",

&nbsp; "name": "Laptop Ache",

&nbsp; "alternateName": "ল্যাপটপ আছে",

&nbsp; "url": "https://laptopache.com/",

&nbsp; "logo": "https://laptopache.com/",

&nbsp; "contactPoint": {

&nbsp;   "@type": "ContactPoint",

&nbsp;   "telephone": "01901-378164",

&nbsp;   "contactType": "technical support",

&nbsp;   "contactOption": "TollFree",

&nbsp;   "areaServed": "BD",

&nbsp;   "availableLanguage": \["en","Bengali"]

&nbsp; },

&nbsp; "sameAs": "https://www.facebook.com/laptopache"

}

</script>

<script type="application/ld+json">

{

&nbsp; "@context": "https://schema.org/", 

&nbsp; "@type": "Product", 

&nbsp; "name": "Microsoft Surface Laptop Go Core i5 10th Gen 16GB RAM Laptop",

&nbsp; "image": "https://laptopache.com/product-details/185/-Microsoft-Surface-Laptop-Go-Core-i5-10th-Gen-16GB-RAM-Laptop-8o4tO",

&nbsp; "description": "Product details

✅ Brand: Microsoft 



✅ Model: Microsoft Surface Go



✅ Condition: Used



✅ Processor Type: Intel Core i5-1035G7 10th Generation



✅ Processor Speed: 6M Cache, 1.00 GHz, up to 1.19 GHz



✅ Screen Size: 12.4" Glossy Touchscreen Display



✅ RAM: 16GB DDR4



✅ Hard Disk: 256GB 



✅ Disk Type: NVME SSD 



✅ Graphics Card: 8GB Share Graphic, Intel(R) UHD Graphic



✅ Audio/Speaker: Dolby Audio Premium



✅ Battery Backup: 3 Hours +

✔ Port

1 x USB-A, 1 x USB-C, 3.5 mm headphone jack",

&nbsp; "brand": {

&nbsp;   "@type": "Brand",

&nbsp;   "name": "Microsoft Surface"

&nbsp; },

&nbsp; "offers": {

&nbsp;   "@type": "Offer",

&nbsp;   "url": "https://laptopache.com/product-details/185/-Microsoft-Surface-Laptop-Go-Core-i5-10th-Gen-16GB-RAM-Laptop-8o4tO",

&nbsp;   "priceCurrency": "BDT",

&nbsp;   "price": "41000",

&nbsp;   "availability": "https://schema.org/InStock",

&nbsp;   "itemCondition": "https://schema.org/UsedCondition"

  }

}

</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "Microsoft Surface Laptop 2 Core i7 8th Gen 13.3" Glossy 2k Touchscreen 16GB RAM Laptop",
  "image": "https://laptopache.com/product-details/184/-Microsoft-Surface-Laptop-2-Core-i7-8th-Gen-133-Glossy-2k-Touchscreen-16GB-RAM-Laptop-nz3Uq",
  "description": "Product details
✅ Brand: Microsoft 

✅ Model: Microsoft Surface Laptop 2

✅ Condition: Used 

✅ Processor Type: Intel Core i7-8650U 8th Generation

✅ Processor Speed: 2.11GHz, 8M Cache

✅ Screen Size: 13.3" Glossy 2k Touchscreen Display

✅ RAM: 16GB DDR4

✅ Hard Disk: 512GB 

✅ Disk Type: NVME SSD 

✅ Graphics Card: 8GB Share Graphic, Intel(R) UHD Graphic 620

✅ Audio/Speaker: Dual microphones, Front-facing stereo speakers with Dolby Audio

✅ Battery Backup: 3 Hours +



✅ Description

Microsoft Surface Laptop 2 is powered by an Intel Core i7 8th generation processor with up to 2.11GHz, and 8M cache. The laptop has a 13.3" touchscreen 2K display that features 2256 x 1504 pixel resolution, 201 PPI density, a 3:2 aspect ratio, 3.4 million pixels, and Corning Gorilla Glass 3 protection. The Surface Laptop comes with 16GB of DDR4 RAM and a 512GB Solid-State Drive storage capacity.",
  "brand": {
    "@type": "Brand",
    "name": "Microsoft Surface"
  },
  "offers": {
    "@type": "Offer",
    "url": "https://laptopache.com/product-details/184/-Microsoft-Surface-Laptop-2-Core-i7-8th-Gen-133-Glossy-2k-Touchscreen-16GB-RAM-Laptop-nz3Uq",
    "priceCurrency": "BDT",
    "price": "45000"
  }
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "HP EliteBook 845 G7 Ryzen 5 Pro 4650U 16GB RAM",
  "image": "https://laptopache.com/product-details/212/HP-EliteBook-845-G7-Ryzen-5-Pro-4650U-16GB-RAM-BcMMU",
  "description": "Product details
✅ Brand: HP

✅ Model: HP EliteBook 845 G7

✅ Condition: Used

✅ Processor Type: AMD Ryzen 5 Pro 4650U

✅ Processor Speed: 6 Cores, 12 Threads, 8MB Cache, Max. Boost Clock Up to 4.0GHz

✅ Screen Size: 14″ IPS 1920 x 1080p (Full HD)

✅ RAM: 16GB DDR4

✅ Hard Disk: 256GB

✅ Disk Type: NVME SSD
This HP EliteBook 845 G7 Laptop uses an AMD Ryzen Pro 4650U processor capable of generating 4.0GHz maximum speed with turbo technology & it contains 6 cores, 12 threads & 8M cache. Moreover, this excellent laptop offers 16GB RAM, 256GB SSD, 8GB integrated graphics, a 14" IPS monitor, and network and connectivity features like Bluetooth, Wi-Fi, and LAN.
✅ Graphics Card: Intel UHD 8GB Graphics

✅ Audio/Speaker: Dolby Advanced Audio Speakers

✅ Battery Backup: 2 Hours +

✅ Product Weight (Kg): 1.55 Kg

✅ Series: HP EliteBook



✔ Ports

1 x USB 3.2 Gen 1

1 x USB 3.2 Gen 1 (Always On)

2 x USB-C 3.2 Gen 2 (support data transfer, Power Delivery, and DisplayPort 1.4)

1 x HDMI 2.0

1 x microSD card reader

1 x Ethernet (RJ-45)

1 x Headphone/microphone combo jack (3.5mm)

1 x Side docking connector",
  "brand": {
    "@type": "Brand",
    "name": "HP"
  },
  "offers": {
    "@type": "Offer",
    "url": "https://laptopache.com/product-details/212/HP-EliteBook-845-G7-Ryzen-5-Pro-4650U-16GB-RAM-BcMMU",
    "priceCurrency": "BDT",
    "price": "34000",
    "availability": "https://schema.org/InStock",
    "itemCondition": "https://schema.org/UsedCondition"
  }
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "HP Pavilion Gaming 15 Ryzen 5 5600H with 4GB GTX1650 Laptop",
  "image": "https://laptopache.com/product-details/207/HP-Pavilion-Gaming-15-Ryzen-5-5600H-with-4GB-GTX1650-Laptop-U3Gi5",
  "description": "Product details
✅ Brand: HP 

✅ Model: HP Pavilion Gaming 15

✅ Condition: Used 

✅ Processor Type: Ryzen 5 5600H

✅ Processor Speed: 3.3GHz (guaranteed base clock) to 4.2GHz (Turbo)

✅ Screen Size: 15.6-Inch diagonal, FHD (1920 x 1080p), 144Hz refresh rate, IPS, micro-edge, anti-glare & 45% NTSC

✅ RAM:  16GB DDR4 

✅ Hard Disk: 256GB NVME SSD

✅ HDD: 1TB Seagate  

✅ Graphics Card: NVIDIA GeForce GTX 1650 4GB Dedicated

✅ Audio/Speaker: Audio by B&O / Dual speakers / HP Audio Boost

✅ Battery Backup: 2 Hours +

✅ Product Weight (Kg): 1.98Kg

✅ Series: HP Pavilion



✔I/O Ports

1 x SuperSpeed USB Type-C 5Gbps signaling rate

1 x SuperSpeed USB Type-A 5Gbps signaling rate

USB 2.0 Type-A (HP Sleep and Charge)

1 x HDMI 2.0

1 x RJ-45

1 x Headphone/microphone combo



✅ Description

HP introduces its exclusive Pavilion Gaming 15 laptop, featuring an AMD Ryzen 5 5600H processor that can achieve a maximum speed of up to 4.2GHz. Also, It features a 15.6-inch Diagonal FHD screen with 144Hz refresh rate, IPS, micro-edge, anti-glare & 45% NTSC. Additionally, this laptop comes with 16GB RAM, 256GB SSD, 1TB HDD, Wi-Fi 6, Bluetooth, dual speaker, & superior cooling system.",
  "brand": {
    "@type": "Brand",
    "name": "HP"
  },
  "offers": {
    "@type": "Offer",
    "url": "https://laptopache.com/product-details/207/HP-Pavilion-Gaming-15-Ryzen-5-5600H-with-4GB-GTX1650-Laptop-U3Gi5",
    "priceCurrency": "BDT",
    "price": "55000",
    "availability": "https://schema.org/InStock",
    "itemCondition": "https://schema.org/UsedCondition"
  }
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "HP EliteBook 840 G6 Core i5 8th Gen 8GB 256GB SSD Laptop",
  "image": "https://laptopache.com/product-details/206/HP-EliteBook-840-G6-Core-i5-8th-Gen-8GB-256GB-SSD-Laptop-Oe2Ug",
  "description": "Product details
✅ Brand: HP

✅ Model: HP EliteBook 840 G6

✅ Condition: Used

✅ Processor Type: Intel Core i5-8265U 8th Generation

✅ Processor Speed: 1.60GHz Base Frequency up to 3.90GHz, 6M Cache

✅ Screen Size: 14" Diagonal FHD IPS Anti-Glare LED-Backlit Display

✅ RAM: 8GB DDR4

✅ Hard Disk: 256GB

✅ Disk Type: NVME SSD

✅ Graphics Card: Intel UHD 8GB Graphics

✅ Audio/Speaker: Dual Stereo Speakers

✅ Battery Backup: 2 Hours +

✅ Product Weight (Kg): 1.48 Kg

✅ Series: HP EliteBook



✔ Ports

2 x USB 3.1 Gen 1

1 x RJ-45

1 x HDMI 1.4b



✅ Description

HP EliteBook 840 G6 laptop features Intel Core i5-8265U 8th generation processor with a maximum turbo frequency of 3.90GHz. It includes 8GB RAM, and 256GB SSD storage capacity. This laptop has audio bang & Olufsen, dual stereo speakers, a 3-multi-array microphone, HP Smart 65-watt external AC power adapter.",
  "brand": {
    "@type": "Brand",
    "name": "HP"
  },
  "offers": {
    "@type": "Offer",
    "url": "https://laptopache.com/product-details/206/HP-EliteBook-840-G6-Core-i5-8th-Gen-8GB-256GB-SSD-Laptop-Oe2Ug",
    "priceCurrency": "BDT",
    "price": "30000",
    "availability": "https://schema.org/InStock",
    "itemCondition": "https://schema.org/UsedCondition"
  }
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "HP EliteBook 840 G6 Core i7 8th Gen 8GB 256GB SSD Laptop",
  "image": "https://laptopache.com/product-details/204/HP-EliteBook-840-G6-Core-i7-8th-Gen-8GB-256GB-SSD-Laptop-pa709",
  "description": "Product details
✅ Brand: HP

✅ Model: HP EliteBook 840 G6

✅ Condition: Used

✅ Processor Type: Intel Core i5-8265U 8th Generation

✅ Processor Speed: 1.60GHz Base Frequency up to 3.90GHz, 6M Cache

✅ Screen Size: 14" Diagonal FHD IPS Anti-Glare LED-Backlit Display

✅ RAM: 8GB DDR4

✅ Hard Disk: 256GB

✅ Disk Type: NVME SSD

✅ Graphics Card: Intel UHD 8GB Graphics

✅ Audio/Speaker: Dual Stereo Speakers

✅ Battery Backup: 2 Hours +

✅ Product Weight (Kg): 1.48 Kg

✅ Series: HP EliteBook



✔ Ports

2 x USB 3.1 Gen 1

1 x RJ-45

1 x HDMI 1.4b



✅ Description

HP EliteBook 840 G6 laptop features Intel Core i5-8265U 8th generation processor with a maximum turbo frequency of 3.90GHz. It includes 8GB RAM, and 256GB SSD storage capacity. This laptop has audio bang & Olufsen, dual stereo speakers, a 3-multi-array microphone, HP Smart 65-watt external AC power adapter.",
  "brand": {
    "@type": "Brand",
    "name": "HP"
  },
  "offers": {
    "@type": "Offer",
    "url": "https://laptopache.com/product-details/204/HP-EliteBook-840-G6-Core-i7-8th-Gen-8GB-256GB-SSD-Laptop-pa709",
    "priceCurrency": "BDT",
    "price": "33000",
    "availability": "https://schema.org/InStock",
    "itemCondition": "https://schema.org/UsedCondition"
  }
}
</script>


</body>

</html>
