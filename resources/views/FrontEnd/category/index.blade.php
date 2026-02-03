@extends('FrontEnd.master')
@section('title')
    All Categories
@endsection
@section('content')
    <!-- Header Start -->
    <div class="container-fluid pt-4 page-header">
        <div class="container ">
            <div class="row justify-content-center bg-white rounded py-3">
                <div class="col-lg-10 text-center">
                    <h1 class=" fw-bold" style="color: black;">{{ get_setting('site_name')->value }}</h1>
                    <div class="d-flex justify-content-center mt-3">
                        <p class="m-0"><a href="{{ route('home') }}">Home</a></p>
                        <p class="m-0 px-2">-</p>
                        <p class="m-0">All Categories</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Check Out Information Start -->
    <section class="container my-3">
        <div class="row">
            <div class="col-md-12">
                <div class="shop-product-fillter-header">
                    <div class="row">
                        @foreach (get_categories() as $category)
                            <div class="col-md-6 col-12 my-2 card-group">
                                <div class="card shadow-lg px-md-4 px-2 py-md-3 py-0 bg-white" style="border-radius: 20px">
                                    <div class="card-body category_header px-2">
                                        <a href="{{ route('product.category', $category->slug) }}"
                                            class="align-items-center d-flex d-inline-block">
                                            <img src="{{ asset($category->image) }}" class="img-fluid category_image"
                                                alt="{{ env('APP_NAME') }}" height="100px" width="100px">
                                            <h5 class="category-title" style="margin-left: 10px">
                                                @if (session()->get('language') == 'bangla')
                                                    {{ $category->name_bn }}
                                                @else
                                                    {{ $category->name_en }}
                                                @endif
                                            </h5>
                                        </a>
                                        {{-- <hr> --}}
                                    </div>
                                    {{-- @if ($category->sub_categories && count($category->sub_categories) > 0)
                                        <div class="gutters-5 row">
                                            @foreach ($category->sub_categories as $subcategory)
                                                <div class="col-lg-4 col-md-6 col-6">
                                                    <div class="ms-2">
                                                        <div class="subcategory-header">
                                                            <a class="d-inline-block" href="{{ route('product.category', $subcategory->slug) }}">
                                                                <h6 class="mb-sm-3 mb-2 subcategory-title">
                                                                    @if (session()->get('language') == 'bangla')
                                                                        {{ $subcategory->name_bn }}
                                                                    @else
                                                                        {{ $subcategory->name_en }}
                                                                    @endif
                                                                </h6>
                                                            </a>
                                                        </div>
                                                        @if ($subcategory->sub_sub_categories && count($subcategory->sub_sub_categories) > 0)
                                                            <ul class="mb-3">
                                                                @foreach ($subcategory->sub_sub_categories as $subsubcategory)
                                                                    <li class="ms-sm-2 ms-0 mb-1">
                                                                        <div class="subsubcategory-header">
                                                                            <a class="d-inline-block" href="{{ route('product.category', $subsubcategory->slug) }}">
                                                                                <p class="subsubcategory-title">
                                                                                    @if (session()->get('language') == 'bangla')
                                                                                        {{ $subsubcategory->name_bn }}
                                                                                    @else
                                                                                        {{ $subsubcategory->name_en }}
                                                                                    @endif
                                                                                </p>
                                                                            </a>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif --}}
                                </div>
                            </div>
                        @endforeach
                        {{-- Col-6 // --}}
                    </div>
                    {{-- Row // --}}
                </div>
            </div>
        </div>

    </section>
@endsection
