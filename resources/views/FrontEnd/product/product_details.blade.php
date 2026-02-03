@extends('FrontEnd.master')
@section('canonical', route('product.details', ['id' => $product->id, 'slug' => $product->slug]))
@section('meta_description', strip_tags($product->description_en))

@section('title')
    {{ $product->name_en }} Details
@endsection
@push('css')
    <style>
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            width: 80%;
            height: 80%;
            background: #fff;
            position: relative;
        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 30px;
            color: #fff;
            cursor: pointer;
            z-index: 1001;
        }

        .app-figure {
            width: 100% !important;
            margin: 0px auto;
            border: 0px solid red;
            padding: 20px;
            position: relative;
            text-align: center;
        }

        .MagicZoom {
            display: none;
        }

        .MagicZoom.Active {
            display: block;
        }

        .selectors {
            margin-top: 10px;
        }

        .selectors .mz-thumb img {
            max-width: 56px;
        }

        .video-thumbnail {
            position: relative;
            display: inline-block;
            width: 80px;
            height: 80px;
            cursor: pointer;
        }

        .video-thumbnail img {
            display: block;
            width: 100%;
            height: 100%;
        }

        .play-icon-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 30px;
            height: 30px;
            background-color: rgb(255, 19, 19);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
            /* Ensures the click event passes through */
        }

        .play-icon {
            color: #fff;
            font-size: 18px;
            line-height: 1;
            pointer-events: none;
        }

        /* reveiw rating style */
        .rating {
            display: flex;
            flex-direction: row-reverse;
            /* 5 on left, 1 on right */
            justify-content: flex-end;
            margin-top: 5px;
        }

        .rating input {
            display: none;
            /* hide radios */
        }

        .rating label {
            font-size: 2rem;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s;
        }

        .rating input:checked~label,
        .rating label:hover,
        .rating label:hover~label {
            color: #ffc107;
            /* gold color */
        }

        .progress-bar {
            background-color: #ffc107 !important;
            /* Bootstrap warning color */
        }

        .fa-star,
        .fa-star-o {
            transition: color 0.2s ease-in-out;
        }

        .shadow-sm:hover {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.1);
        }

        .progress {
            border-radius: 10px;
            overflow: hidden;
        }

        /* reveiw rating style */

        @media screen and (max-width: 1023px) {
            .app-figure {
                width: 99% !important;
                margin: 20px auto;
                padding: 0;
            }
        }
    </style>
    <link rel="stylesheet" href="{{ asset('frontend/magiczoomplus/magiczoomplus.css') }}" />
@endpush
@section('content')
    {{--    @php dd($product->product_type) @endphp --}}
    <!-- Product Information Start -->
    <section class="pb-0">
        <div class="container px-2">
            <div class="bg-white my-3 p-3 p-md-4">

                <div class="row ">
                    <?php $discount = calculateDiscount($product->id); ?>

                    <div class="col-md-5">
                        <!-- default start -->
                        <section id="default" class="pt-0  pb-3">
                            <input type="hidden" id="product_id" value="{{ $product->id }}" min="1">

                            <input type="hidden" id="pname" value="{{ $product->name_en }}">

                            <input type="hidden" id="product_price" value="{{ $discount['discount'] }}">

                            <input type="hidden" id="minimum_buy_qty" value="{{ $product->minimum_buy_qty }}">
                            <input type="hidden" id="stock_qty" value="{{ $product->stock_qty }}">

                            <input type="hidden" id="pvarient" value="">

                            <input type="hidden" id="buyNowCheck" value="0">
                            <input type="hidden" name="" id="discount_amount"
                                value="{{ $product->regular_price - $discount['discount'] }}">
                            <div class="container-fluid">
                                <div class="xzoom-container">
                                    <img class="xzoom img-fluid" id="xzoom-default"
                                        src="{{ asset($product->product_thumbnail) }}"
                                        xoriginal="{{ asset($product->product_thumbnail) }}" alt="Product Thumbnail" />

                                    <div class="xzoom-thumbs mt-3 d-flex flex-wrap justify-content-center "
                                        style="gap: 15px">
                                        <!-- Image Thumbnail -->
                                        <a href="{{ asset($product->product_thumbnail) }}">
                                            <img class="xzoom-gallery img-thumbnail" width="80" height="80"
                                                src="{{ asset($product->product_thumbnail) }}"
                                                xpreview="{{ asset($product->product_thumbnail) }}">
                                        </a>

                                        @foreach ($multiImg as $image)
                                            <a href="{{ asset($image->photo_name) }}">
                                                <img class="xzoom-gallery img-thumbnail" width="80" height="80"
                                                    src="{{ asset($image->photo_name) }}">
                                            </a>
                                        @endforeach

                                        @php
                                            $video_th = $product->video_url;
                                        @endphp

                                        <!-- Video Thumbnail with Clickable Overlay -->
                                        @if ($video_th)
                                            <a href="#" class="video-thumbnail"
                                                onclick="openVideoModal('{{ $video_th }}')">
                                                <img class="xzoom-gallery img-thumbnail" width="80" height="80"
                                                    src="{{ asset($product->video_thumbnail) }}" alt="Video Thumbnail">
                                                <div class="play-icon-overlay">
                                                    <i style="color: rgb(255, 255, 255) !important"
                                                        class="play-icon ">&#9654;</i>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Video Modal -->
                            <div id="videoModal" class="modal-overlay" style="display: none;">
                                <div class="modal-content">
                                    <iframe id="videoFrame" width="100%" height="100%" frameborder="0"
                                        allowfullscreen></iframe>
                                    <span class="close-button" onclick="closeVideoModal()">×</span>
                                </div>
                            </div>


                        </section>
                        <!-- default end -->
                    </div>

                    <div class="col-md-7">
                        <div class="{{ $discount['discount'] == $product->regular_price ? 'd-none' : '' }} py-1"
                            style="background-color: rgba(247,147,41,0.3); border-radius: 5px; color: rgb(247,147,41); width: 90px; ">
                            <p class="m-1 text-center " style="font-size:16px ;">{{ $discount['text'] }}</p>
                        </div>
                        {{--                <span class="stock-status out-stock"> ৳{{  $discount }} Off </span> --}}
                        <h1 class="product-title text-dark mt-3">
                            @if (session()->get('language') == 'bangla')
                                {{ $product->name_bn }}
                            @else
                                {{ $product->name_en }}
                            @endif
                        </h1>
                        {{-- subtitle-1 show here --}}
                        @if ($product->subtitle_1 || $product->subtitle_2)
                            <div class="text-muted mt-2">
                                {!! $product->subtitle_1 ?? '' !!}
                            </div>
                            <div class="text-muted mt-2">
                                {!! $product->subtitle_2 ?? '' !!}
                            </div>
                        @endif
                        <div>

                            <h4 class="price details-price text-dark mt-3">
                                @if (session()->get('language') == 'bangla')
                                    বর্তমান মূল্য:
                                @else
                                    Current Price:
                                @endif
                                <span class="product_price current-price">৳{{ $discount['discount'] }}</span>
                                @if ($discount['discount'] != $product->regular_price)
                                    <del class="old-price {{ $discount['discount'] == 0 ? 'd-none' : '' }}"
                                        style="color: grey">
                                        ৳{{ $product->regular_price }}</del>
                                @endif
                            </h4>
                            <div class="">
                                <p>
                                    @if (session()->get('language') == 'bangla')
                                        ক্যাটাগোরি: {{ $product->category->name_bn ?? '' }}
                                    @else
                                        Brand: {{ $product->category->name_en ?? '' }}
                                    @endif

                                </p>
                                @if ($product->product_type == 2 && count($group_products) > 0)
                                    <strong>
                                        @if (session()->get('language') == 'bangla')
                                            প্যাকেজের পণ্য সমূহ
                                        @else
                                            Package Items
                                        @endif
                                        :
                                    </strong>
                                    @foreach ($group_products as $item)
                                        <div class="row mb-1">
                                            <div class="col-md-1">
                                                <a href="{{ route('product.details', $item->product->slug) }}">
                                                    <img src="{{ asset($item->product->product_thumbnail) }}"
                                                        alt="" height="30px" width="30px">
                                                </a>
                                            </div>
                                            <div class="col-md-11">
                                                <a href="{{ route('product.details', $item->product->slug) }}">
                                                    <p>
                                                        @if (session()->get('language') == 'bangla')
                                                            {{ $item->product->name_bn }}
                                                        @else
                                                            {{ $item->product->name_en }}
                                                        @endif
                                                    </p>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    {{-- <p>
                                        @if (session()->get('language') == 'bangla')
                                            ব্র্যান্ড: {{ $product->brand->name_bn ?? '' }}
                                        @else
                                            Brand:
                                            {{ $product->brand->name_en ?? 'N/A' }}
                                        @endif


                                    </p> --}}
                                @endif
                                <p>
                                    @if (session()->get('language') == 'bangla')
                                        স্টক:
                                    @else
                                        Stock:
                                    @endif
                                    <span class="{{ $product->stock_qty > 0 ? 'text-success' : 'text-danger' }}">
                                        @if (session()->get('language') == 'bangla')
                                            {{ $product->stock_qty > 0 ? 'স্টকে আছে' : 'স্টক আউট' }}
                                        @else
                                            {{ $product->stock_qty > 0 ? 'In Stock' : 'Out of Stock' }}
                                        @endif

                                    </span>
                                    <span
                                        id="stock_qty">{{ $product->stock_qty != 0 ? '(' . $product->stock_qty . ')' : '' }}</span>
                                </p>
                                <p>
                                    <!-- Average Rating -->
                                    <small class="text-muted">Ratings: {{ $totalRatings }}</small>

                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="fa fa-star{{ $i <= round($avgRating) ? '' : '-o' }} fs-5 text-warning"></i>
                                    @endfor
                                </p>

                            </div>
                        </div>
                        <form id="choice_form">
                            <div class="row " id="choice_attributes">
                                @if ($product->is_varient)
                                    {{--                            @php dd($product->attribute_values->attribute_id)  @endphp --}}
                                    @php $i=0; @endphp
                                    @foreach (json_decode($product->attribute_values) as $attribute)
                                        @php
                                            $attr = get_attribute_by_id($attribute->attribute_id);
                                            $i++;
                                            //                                    dd($attribute->attribute_id, $attr->name, $attribute->values[0], $product->id, 1)
                                        @endphp
                                        <input type="hidden" name=""
                                            onload="selectAttribute('{{ $attribute->attribute_id }}', '{{ $attr->name }}', '{{ $attribute->values[0] }}', '{{ $product->id }}', '1')">
                                        <div class="attr-detail attr-size mb-3 col-12">
                                            <strong class="mr-10">{{ $attr->name }}: </strong>
                                            <input type="hidden" name="attribute_ids[]"
                                                id="attribute_id_{{ $i }}"
                                                value="{{ $attribute->attribute_id }}">
                                            <input type="hidden" name="attribute_names[]"
                                                id="attribute_name_{{ $i }}" value="{{ $attr->name }}">
                                            <input type="hidden" id="attribute_check_{{ $i }}"
                                                value="0">
                                            <input type="hidden" id="attribute_check_attr_{{ $i }}"
                                                value="0">
                                            <div class="list-filter size-filter font-p">
                                                @foreach ($attribute->values as $key => $value)
                                                    <label class="radio-inline">
                                                        <input type="radio" class="m-2"
                                                            onclick="selectAttribute('{{ $attribute->attribute_id }}{{ $attr->name }}', '{{ $value }}', '{{ $product->id }}', '{{ $i }}')"
                                                            name="option_{{ $i }}">{{ $value }}
                                                    </label>
                                                    @php $key++; @endphp
                                                @endforeach
                                                <input type="hidden" name="attribute_options[]"
                                                    id="{{ $attribute->attribute_id }}{{ $attr->name }}"
                                                    class="attr_value_{{ $i }}">
                                            </div>
                                        </div>
                                    @endforeach
                                    <input type="hidden" id="total_attributes"
                                        value="{{ count(json_decode($product->attribute_values)) }}">
                                @endif
                            </div>
                        </form>

                        <div class="" id="attribute_alert">
                            <div class="">
                                <div class="d-flex " style="gap: 12px">
                                    <p><i class="fa-solid fa-truck-fast"></i>
                                        @if (session()->get('language') == 'bangla')
                                            স্ট্যান্ডার্ড ডেলিভারি
                                        @else
                                            Standard Delivery
                                        @endif
                                    </p>
                                    <p>
                                        @if (session()->get('language') == 'bangla')
                                            ৫ - ১০ দিন
                                        @else
                                            5 - 10 day(s)
                                        @endif

                                    </p>
                                    <p>{{ $shipping_charge->shipping_charge }}TK</p>
                                </div>

                                <p><i class="fa-regular fa-handshake"></i>
                                    @if (session()->get('language') == 'bangla')
                                        ক্যাশ অন ডেলিভারি পাওয়া যাচ্ছে
                                    @else
                                        Cash on Delivery Available
                                    @endif
                                </p>

                                {{-- extra features --}}
                                @if ($product->extra_features)
                                    <ul>
                                        @foreach (json_decode($product->extra_features, true) as $feature)
                                            <li>{{ $feature }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                {{-- end extra featres --}}

                            </div>
                            <hr class="d-none">
                            <div class="d-none">
                                {{--                    <p>ডেলিভারি</p> --}}
                                {{--                    <p><i class="fa-solid fa-person-walking-arrow-loop-left"></i> 7 Days Returns</p> --}}
                                @if ($product->is_replaceable == 1)
                                    <p>{{ session()->get('language') == 'bangla' ? 'পণ্য প্রতিস্থাপন' . get_setting('order_return_duration')->value . 'দিনের আগে প্রযোজ্য' : 'Replacement Applicable Before ' . get_setting('order_return_duration')->value . ' Days' }}
                                    </p>
                                @else
                                    <p>{{ session()->get('language') == 'bangla' ? 'পণ্য প্রতিস্থাপন প্রযোজ্য নয়' : 'Product Replacement Not Applicable' }}
                                    </p>
                                @endif

                                <p><i
                                        class="fa-solid fa-gears"></i>{{ session()->get('language') == 'bangla' ? 'ওয়ারেন্টি পাওয়া যাবে না' : ' Warranty Not Available' }}
                                </p>
                            </div>
                            <hr>
                            <div class="d-none">
                                <p>
                                    @if (session()->get('language') == 'bangla')
                                        বিক্রেতা
                                    @else
                                        Sold By
                                    @endif

                                </p>
                                <div class="d-flex justify-content-between">
                                    <p><i class="fa-solid fa-shop"></i>
                                        {{ $product->vendor_id != 0 ? $product->vendor->shop_name ?? '' : get_setting('business_name')->value }}
                                    </p>
                                    {{--                        <a href="#"><i class="fa-regular fa-message"></i> CHAT</a> --}}
                                </div>
                            </div>
                        </div>
                        @if ($product->stock_qty > 0)
                            <div class="detail-extralink mb-3 align-items-baseline d-flex">
                                <div class="mr-10">
                                    <span class="">
                                        @if (session()->get('language') == 'bangla')
                                            পরিমাণ:
                                        @else
                                            Quantity:
                                        @endif

                                    </span>
                                </div>
                                <div class="detail-qty border radius mx-2 px-1 " style="overflow:hidden ">
                                    <a href="#" class="qty-down px-3 py-4 fs-md text-dark "
                                        style="border-right: 1px solid #D8DBE2"><i class="fa fa-minus text-dark"></i></a>
                                    <input type="text" name="quantity" class="qty-val  px-3 py-4"
                                        value="{{ $product->minimum_buy_qty }}" min="{{ $product->minimum_buy_qty }}"
                                        id="qty"
                                        style="border: none; width: 40px; height: 50px; text-align: center;" readonly>
                                    <a href="#" class="qty-up px-3 py-4 fs-md text-dark"
                                        style="border-left:1px solid #D8DBE2;"><i class="fa fa-plus text-dark"></i></a>
                                </div>
                                <div class="row mb-3" id="qty_stock_alert">

                                </div>

                            </div>

                            <div class="d-flex mb-3" style="gap:20px;">
                                <input type="hidden" id="pfrom" value="direct">
                                <input type="hidden" id="product_id" value="{{ $product->id }}" min="1">
                                <input type="hidden" id="{{ $product->id }}-product_pname"
                                    value="{{ $product->name_en }}">
                                <button class="like btn btn " style="margin-left: 0px; font-size: 15px; " type="button"
                                    onclick="test()">
                                    @if (session()->get('language') == 'bangla')
                                        কার্টে যোগ করুন
                                    @else
                                        Add to Cart
                                    @endif
                                </button>
                                <button class="like btn  text-white" style="background-color: #FF914D;"
                                    id="{{ $product->is_varient == 1 ? '' : 'buy_now' }}" type="button"
                                    onclick="{{ $product->is_varient == 1 ? 'buyProduct()' : '' }}"
                                    style="font-size: 15px; ">
                                    @if (session()->get('language') == 'bangla')
                                        এখুনি কিনুন
                                    @else
                                        Buy Now
                                    @endif
                                </button>
                                {{--                    <button class="like btn" style="margin-left: 5px" type="button" onclick="addToCartDirect({{$product->id}})">Add to cart</button> --}}

                            </div>
                        @endif

                        {{-- subtitle-2 show here --}}
                        @if ($product->subtitle_3)
                            <div>
                                {!! $product->subtitle_3 ?? '' !!}
                            </div>
                        @endif



                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Product Information End -->
    <!-- Description Part Start -->
    <section class="">
        <div class="container px-2">

            <div class="row g-3 mx-0">
                {{-- <div class="col-md-7 bg-white py-4 px-2 remove-span">
                    <h4 class="text-dark">
                        @if (session()->get('language') == 'bangla')
                            পণ্যের বিবরণ
                        @else
                            About this item
                        @endif

                    </h4>
                    <hr>
                    <h6 class="mb-2 text-dark">Product details</h6>
                    @if (session()->get('language') == 'bangla')
                        {!! $product->description_bn !!}
                    @else
                        {!! $product->description_en !!}
                    @endif
                </div> --}}

                {{-- product details and review system --}}
                <div class="col-md-7 bg-white py-4 px-2 remove-span">
                    <!-- Tabs -->
                    <ul class="nav nav-tabs" id="productTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="details-tab" data-bs-toggle="tab"
                                data-bs-target="#details" type="button" role="tab" aria-controls="details"
                                aria-selected="true">
                                @if (session()->get('language') == 'bangla')
                                    পণ্যের বিবরণ
                                @else
                                    About this item
                                @endif
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link ms-2" id="reviews-tab" data-bs-toggle="tab"
                                data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews"
                                aria-selected="false">
                                @if (session()->get('language') == 'bangla')
                                    রিভিউ
                                @else
                                    Reviews ({{ $product->reviews->count() ?? 0 }})
                                @endif
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content mt-3" id="productTabContent">
                        <!-- Product Details -->
                        <div class="tab-pane fade show active" id="details" role="tabpanel"
                            aria-labelledby="details-tab">
                            <h6 class="mb-2 text-dark">Product details</h6>
                            @if (session()->get('language') == 'bangla')
                                {!! $product->description_bn !!}
                            @else
                                {!! $product->description_en !!}
                            @endif

                            @php
                                $faqs = json_decode($product->faqs, true) ?? [];
                            @endphp

                            <!-- FAQs Accordion -->
                            @if (!empty($faqs))
                                <p class="mt-3 fs-5">Product FAQs</p>
                                <div class="accordion" id="faqAccordion">
                                    @foreach ($faqs as $index => $faq)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading{{ $index }}">
                                                <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ $index }}"
                                                    aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                                    aria-controls="collapse{{ $index }}">
                                                    Q: {{ $faq['question'] }}
                                                </button>
                                            </h2>
                                            <div id="collapse{{ $index }}"
                                                class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                                aria-labelledby="heading{{ $index }}"
                                                data-bs-parent="#faqAccordion">
                                                <div class="accordion-body">
                                                    <strong>A:</strong> {{ $faq['answer'] }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Product Reviews -->
                        <div class="tab-pane fade" style="margin-left:20px;" id="reviews" role="tabpanel"
                            aria-labelledby="reviews-tab">
                            <h6 class="mb-3 text-dark">
                                @if (session()->get('language') == 'bangla')
                                    গ্রাহক রিভিউ
                                @else
                                    Customer Reviews
                                @endif
                            </h6>

                            <div class="container my-4">
                                <div class="row justify-content-center">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="p-4 bg-white rounded-lg shadow-sm border">
                                            <div class="row align-items-center">
                                                <!-- Average Rating -->
                                                <div class="col-md-4 text-center p-3">
                                                    <h2 class="mb-0 fw-bold text-dark">{{ $avgRating }}/5</h2>
                                                    <div class="text-warning mb-2">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i
                                                                class="fa fa-star{{ $i <= round($avgRating) ? '' : '-o' }} fs-5"></i>
                                                        @endfor
                                                    </div>
                                                    <small class="text-muted">{{ $totalRatings }} Ratings</small>
                                                </div>

                                                <!-- Ratings Breakdown -->
                                                <div class="col-md-8 text-center">
                                                    @foreach ($ratingsBreakdown as $stars => $count)
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="text-warning me-2">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <i
                                                                        class="fa fa-star{{ $i <= $stars ? '' : '-o' }} fs-6"></i>
                                                                @endfor
                                                            </div>
                                                            <div class="progress flex-grow-1 me-2"
                                                                style="height: 12px; background-color: #e9ecef;">
                                                                @php
                                                                    $percent = $totalRatings
                                                                        ? ($count / $totalRatings) * 100
                                                                        : 0;
                                                                @endphp
                                                                <div class="progress-bar bg-warning" role="progressbar"
                                                                    style="width: {{ $percent }}%; transition: width 0.3s ease-in-out;"
                                                                    aria-valuenow="{{ $percent }}" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                            </div>
                                                            <span class="text-dark fw-medium">{{ $count }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Reviews List -->
                            @if ($product->reviews && $product->reviews->count() > 0)
                                @foreach ($product->reviews as $review)
                                    <div class="border-bottom mb-3 pb-2">

                                        <span class="text-warning">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fa fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                            @endfor
                                        </span><br>

                                        <strong>
                                            <i class="fa fa-check-circle text-success me-1" title="Verified Purchase"></i>
                                            @if ($review->user_id != 1 && $review->user)
                                                {{ $review->user->name }}
                                            @else
                                                {{-- Guest user: get name from orders table safely --}}
                                                @php
                                                    $order = \App\Models\Order::where('user_id', 1)
                                                        ->where('payment_status', 1)
                                                        ->whereHas('order_details', function ($q) use ($product) {
                                                            $q->where('product_id', $product->id);
                                                        })
                                                        ->first();
                                                @endphp
                                                {{ $order->name ?? 'Anonymous' }}
                                            @endif
                                            <span class="text-muted ms-2 text-success">Verified Purchased</span>
                                        </strong>



                                        <p class="mb-1">{{ $review->comment }}</p>
                                        <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted">No reviews yet.</p>
                            @endif

                            <!-- Review Form -->
                            {{--  {{ route('review.store') }} --}}
                            <div class="mt-4 p-4 border rounded shadow-sm bg-light">
                                <h5 class="text-dark mb-3">
                                    <i class="fa fa-pencil-square-o text-primary"></i>
                                    Write a Review
                                </h5>

                                @if ($canReview)
                                    <form action="{{ route('review.store') }}" method="POST" id="reviewForm">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                                        <div class="row">
                                            <!-- Rating -->
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label fw-bold d-block">Give Us Rating Here </label>
                                                <div class="rating">
                                                    @for ($i = 5; $i >= 1; $i--)
                                                        <input type="radio" id="star{{ $i }}"
                                                            name="rating" value="{{ $i }}" required>
                                                        <label for="star{{ $i }}"
                                                            title="{{ $i }} stars">
                                                            ★
                                                        </label>
                                                    @endfor
                                                </div>
                                            </div>

                                            <!-- Comment -->
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label fw-bold">Write Your Comment Here</label>
                                                <textarea name="comment" class="form-control shadow-sm" rows="3" placeholder="Write your experience..."
                                                    required></textarea>
                                            </div>
                                        </div>

                                        <!-- Submit -->
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary px-4">
                                                <i class="fa fa-paper-plane"></i> Submit Review
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <div class="alert alert-warning">
                                        You can only submit a review after purchasing this product.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- product details and review system --}}

                <div class="just-for-you col-md-5 bg-white border-start py-4 px-md-2 px-2">
                    <div class="">
                        <h4 class="text-dark px-md-2" style="    line-height: 25px">
                            @if (session()->get('language') == 'bangla')
                                সংশ্লিষ্ট পণ্য
                            @else
                                Related Products
                            @endif
                        </h4>
                        <hr>
                        <div class="row pr-3" style="margin-left: 0; ">
                            @if (count($relatedProduct) > 0)
                                <style>
                                    @media (min-width: 768px) and (max-width: 1920px) {
                                        .buy_now {
                                            width: 45%;
                                            font-size: 14px;
                                        }

                                        .add_to_cart {
                                            width: 50%;
                                            font-size: 14px;
                                        }

                                        .out_of_stock {
                                            width: 100%;
                                        }
                                    }

                                    @media (max-width: 767px) {
                                        .buy_now {
                                            width: 45%;
                                            font-size: 12px;
                                        }

                                        .add_to_cart {
                                            width: 52%;
                                            font-size: 12px;
                                        }

                                        .out_of_stock {
                                            width: 100%;
                                        }
                                    }
                                </style>
                                @foreach ($relatedProduct as $product)
                                    @php $data = calculateDiscount($product->id) @endphp
                                    <div class="product-card col-xl-6 col-lg-6 col-md-6 col-6 p-md-2 p-1">
                                        <div class="product_grid card border mb-0">
                                            @if ($product->discount_price != 0)
                                                <div
                                                    class="badge bg-danger text-white position-absolute ft-regular ab-right text-upper">
                                                    {{ $data['text'] }}</div>
                                            @endif
                                            <div class="card-body p-0">
                                                <div class="shop_thumb position-relative">
                                                    <a class="card-img-top d-block overflow-hidden"
                                                        href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}"><img
                                                            class="card-img-top"
                                                            src="{{ asset($product->product_thumbnail) }}"
                                                            alt="..."></a>
                                                    <div class="product-left-hover-overlay">
                                                        <ul class="left-over-buttons">
                                                            <li class="d-none"><a href="javascript:void(0);"
                                                                    class="d-inline-flex circle align-items-center justify-content-center"><i
                                                                        class="fas fa-expand-arrows-alt position-absolute"></i></a>
                                                            </li>
                                                            <li class="d-none"><a href="javascript:void(0);"
                                                                    class="d-inline-flex circle align-items-center justify-content-center snackbar-wishlist"><i
                                                                        class="far fa-heart position-absolute"></i></a>
                                                            </li>
                                                            <li class="d-none"><a href="javascript:void(0);"
                                                                    class="d-inline-flex circle align-items-center justify-content-center snackbar-addcart"><i
                                                                        class="fas fa-shopping-basket position-absolute"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="card-footer b-0 p-0 pt-2 bg-white align-items-start justify-content-between">
                                                <div class="text-left">
                                                    <div class="text-left mb-1">

                                                        <h5 class="product_name fs-md lh-1 mb-1 "><a class=""
                                                                style="color: #151515 !important;"
                                                                href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">{{ Str::limit($product->name_en, 38, '...') }}</a>
                                                        </h5>
                                                        <div class="elis_rty mb-2">
                                                            @if ($product->discount_price != 0)
                                                                <del class="d-block">৳{{ $product->regular_price }}</del>
                                                                <span class="ft-bold text-dark fs-lol">Price:
                                                                    {{ $data['discount'] }} TK</span>
                                                            @else
                                                                <span class="ft-bold text-dark fs-lol">Price:
                                                                    {{ $product->regular_price }} TK</span>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="text-center mb-1 p-0 d-flex align-items-center justify-content-between w-100"
                                                        style="">
                                                        @if ($product->stock_qty == 0)
                                                            <a href=""
                                                                class=" btn btn-warning out_of_stock w-100">Out of
                                                                Stock</a>
                                                        @elseif($product->is_varient == 1)
                                                            <button type="submit" id="{{ $product->id }}"
                                                                onclick="productView(this.id)"data-bs-toggle="modal"
                                                                data-bs-target="#quickViewModal"
                                                                style="@if (session()->get('language') == 'bangla') font-size: x-small; @endif"
                                                                class="buy_now btn btn-outline-dark w-100">
                                                                @if (session()->get('language') == 'bangla')
                                                                    এখুনি কিনুন
                                                                @else
                                                                    Buy Now
                                                                @endif
                                                            </button>
                                                            <button type="submit" id="{{ $product->id }}"
                                                                onclick="productView(this.id)"data-bs-toggle="modal"
                                                                data-bs-target="#quickViewModal"
                                                                style="@if (session()->get('language') == 'bangla') font-size:x-small @endif"
                                                                class="add_to_cart btn btn-outline-dark w-100">

                                                                @if (session()->get('language') == 'bangla')
                                                                    কার্টে যোগ করুন
                                                                @else
                                                                    Add to Cart
                                                                @endif
                                                            </button>
                                                        @else
                                                            <input type="hidden" id="pfrom" value="direct">
                                                            <input type="hidden" id="product_product_id"
                                                                value="{{ $product->id }}" min="1">
                                                            <input type="hidden" id="{{ $product->id }}-product_pname"
                                                                value="{{ $product->name_en }}">

                                                            <button type="submit" onclick="buyNow({{ $product->id }})"
                                                                class="buy_now btn btn-outline-dark ">Buy Now</button>
                                                            <button type="submit"
                                                                onclick="addToCartDirect({{ $product->id }})"
                                                                class="add_to_cart btn btn-outline-dark ">Add to
                                                                Cart</button>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>No Products Found</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Description Part Start -->
@endsection

@push('js')
    <script>
        //Qty Up-Down
        $('.detail-qty').each(function() {

            var qtyval = parseInt($(this).find(".qty-val").val(), 10);

            $('.qty-up').on('click', function(event) {

                event.preventDefault();
                qtyval = qtyval + 1;
                $(this).prev().val(qtyval);

            });

            $(".qty-down").on("click", function(event) {

                event.preventDefault();
                qtyval = qtyval - 1;

                if (qtyval > 1) {

                    $(this).next().val(qtyval);

                } else {

                    qtyval = 1;
                    $(this).next().val(qtyval);

                }
            });
        });

        function addCart(id) {
            var qty = $('.qty-val').val();
            addToCartDirect(id, false, qty);
        }

        {{-- $('#buy_now').on('click', function (){ --}}
        {{--    var qty = $('.qty-val').val(); --}}
        {{--    var id = {{$product->id}}; --}}
        {{--    buyNow(id, qty); --}}

        {{-- }); --}}
    </script>
    <script src="{{ asset('FrontEnd') }}/assect/js/xzoom.js"></script>
    <script src="{{ asset('FrontEnd') }}/assect/js/magnific-popup.js"></script>
    <script src="{{ asset('FrontEnd') }}/assect/js/setup.js"></script>



    <script>
        function openVideoModal(videoURL) {
            event.preventDefault();

            if (videoURL.includes('youtube.com/shorts/')) {
                const videoId = videoURL.split('/shorts/')[1].split('?')[0];
                videoURL = 'https://www.youtube.com/embed/' + videoId;
            } else if (videoURL.includes('youtube.com/watch?v=')) {
                const videoId = videoURL.split('v=')[1].split('&')[0];
                videoURL = 'https://www.youtube.com/embed/' + videoId;
            }

            document.getElementById('videoFrame').src = videoURL;
            document.getElementById('videoModal').style.display = 'flex';
        }

        function closeVideoModal() {
            document.getElementById('videoModal').style.display = 'none';
            document.getElementById('videoFrame').src = '';
        }
    </script>

    // review submit
    <script>
        document.getElementById('reviewForm').addEventListener('submit', function(e) {
            e.preventDefault(); // prevent page reload

            let form = this;
            let formData = new FormData(form);

            fetch(form.action, {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) throw new Error("Network error");
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 3000
                        });

                        form.reset(); // clear form
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message || 'Something went wrong!'
                        });
                    }
                })
                .catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: err.message
                    });
                });
        });
    </script>
@endpush
