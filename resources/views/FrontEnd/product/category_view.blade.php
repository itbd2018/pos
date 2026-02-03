@extends('FrontEnd.master')
@section('title')
{{ $category->name_en }} Based Products
@endsection
@section('content')
<style>
    /* --- Filter Sidebar Styles (copied from shop.blade.php) --- */
    .prf-filter-modern {
        background: #fff;
        border: 1px solid #e8ecef;
        border-radius: 10px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        min-width: 250px;
        padding: 1.2rem;

    }

    .prf-filter-icon {
        font-size: 1.9rem;
        color: #FF914D;
        background: #f7f7f7;
        border-radius: 50%;
        padding: 9px 13px;
        margin-bottom: 0.6rem;
    }

    .prf-filter-title {
        color: #1A1A1A;
        font-weight: 700;
        font-size: 1.3rem;
        letter-spacing: 0.4px;
    }

    .prf-filter-section {
        margin-bottom: 0.5rem;
    }

    .prf-filter-label {
        color: #1A1A1A;
        font-size: 1.05rem;
        font-weight: 600;
        padding: 9px 12px;
        border-radius: 8px;
        background: #f7f7f7;
        display: flex;
        justify-content: space-between;
        align-items: center;
        text-decoration: none;
        cursor: pointer;
    }

    .prf-chevron {
        font-size: 0.95rem;
        color: #6c757d;
        transition: transform 0.3s ease;
    }

    .prf-chevron.collapsed {
        transform: rotate(-90deg);
    }

    .prf-filter-options {
        display: flex;
        flex-direction: column;
        gap: 8px;
        padding: 10px 12px;
        background: #fff;
        border-radius: 8px;
        margin-top: 5px;
    }

    .prf-filter-checkbox {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 7px 10px;
        font-size: 0.95rem;
        font-weight: 400;
        color: #333;
    }

    .prf-filter-checkbox input[type="checkbox"] {
        width: 17px;
        height: 17px;
        margin: 0;
        accent-color: #FF914D;
    }

    .prf-filter-checkbox span {
        line-height: 1.2;
    }

    .prf-range-wrap {
        padding: 10px 12px;
        background: linear-gradient(180deg, #fff 0%, #f9f9f9 100%);
        border-radius: 10px;
        margin-top: 5px;
        box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.05);
    }

    #prf-amount {
        color: #FF914D;
        font-weight: 700;
        font-size: 1rem;
        text-align: center;
        border: 0;
        background: transparent;
        width: 100%;
        padding: 6px 0;
        letter-spacing: 0.5px;
    }

    .prf-filter-btn {
        background: linear-gradient(90deg, #FF914D 0%, #e07b39 100%);
        color: #fff;
        font-weight: 600;
        font-size: 1rem;
        border-radius: 8px;
        border: none;
        padding: 10px 0;
        width: 100%;
        text-align: center;
        transition: background 0.2s ease, transform 0.2s ease;
    }

    .prf-filter-btn:disabled {
        background: #d1d5db;
        cursor: not-allowed;
    }

    @media (max-width: 991px) {
        .prf-filter-modern {
            min-width: 100%;
        }

        .prf-filter-title {
            color: #1A1A1A;
            font-weight: 600;
            font-size: 1rem;
        }

        .prf-filter-icon {
            font-size: 1.3rem;
            border-radius: 50%;
            padding: 0px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            1 margin-bottom: 0rem;
        }
    }

    /* Example CSS for a responsive, attractive filter section */
    .filter-container {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        background: #fff;
        padding: 1.5rem;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
        margin-bottom: 2rem;
    }

    .filter-item {
        flex: 1 1 180px;
        min-width: 140px;
        background: #f7f9fa;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        margin: 0.25rem 0;
        transition: box-shadow 0.2s;
        cursor: pointer;
    }

    .filter-item:hover {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
        background: #e6f0fa;
    }

    @media (max-width: 600px) {
        .filter-container {
            flex-direction: column;
            padding: 1rem;
        }

        .filter-item {
            width: 100%;
            min-width: unset;
        }
    }

    /* fbgfgfg */
    .modern-product-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
        position: relative;
        height: 100%;
    }

    .modern-product-card:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
    }

    .card-img-container {
        position: relative;
        overflow: hidden;
        height: 250px;
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
    }

    .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .modern-product-card:hover .card-img-top {
        transform: scale(1.1);
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
        padding: 1.5rem;
        background: rgba(255, 255, 255, 0.95);
    }

    .product-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1rem;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 2.6rem;
    }

    .product-title a {
        color: inherit;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .product-title a:hover {
        color: #667eea;
    }

    .price-section {
        margin-bottom: 1.5rem;
    }

    .current-price {
        font-size: 1.5rem;
        font-weight: 800;
        color: #27ae60;
        margin-right: 0.5rem;
    }

    .original-price {
        font-size: 1rem;
        color: #95a5a6;
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
        gap: 0.5rem;
    }

    .btn-buy-now {
        background: #FF914D;
        border: none;
        color: white;
        padding: 10px 16px;
        border-radius: 15px;
        font-weight: 600;
        flex: 2;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        font-size: 0.85rem;
    }

    .btn-buy-now:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-buy-now:hover:before {
        left: 100%;
    }

    .btn-buy-now:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-add-cart {
        background: rgba(52, 73, 94, 0.1);
        border: 2px solid #34495e;
        color: #34495e;
        padding: 10px;
        border-radius: 15px;
        font-weight: 600;
        flex: 1;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-add-cart:hover {
        background: #FF914D;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(52, 73, 94, 0.3);
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

    /* pagination */
    .custom-pagination .pagination {
        display: flex;
        padding-left: 0;
        list-style: none;
        border-radius: 0.5rem;
        background: #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
        overflow: hidden;
    }

    .custom-pagination .page-item {
        margin: 0 2px;
    }

    .custom-pagination .page-link {
        color: #FF914D;
        background-color: #fff;
        border: none;
        border-radius: 0.35rem;
        padding: 0.5rem 1rem;
        font-weight: 600;
        transition: background 0.2s, color 0.2s;
    }

    .custom-pagination .page-link:hover,
    .custom-pagination .page-link:focus {
        background: #FF914D;
        color: #fff;
        text-decoration: none;
    }

    .custom-pagination .active .page-link {
        background: linear-gradient(90deg, #FF914D 0%, #e07b39 100%);
        color: #fff;
        border: none;
    }

    .custom-pagination .disabled .page-link {
        color: #bdbdbd;
        background: #f7f7f7;
    }
</style>
<div class="container-fluid py-md-3 py-1 page-header">
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-md-center mt-1 mt-md-0">
                <h2 class="fw-bold" style="color: black;">{{ $category->name_en }}</h2>
                {{-- <h5 class="display-6 fw-semibold">Deals updated daily</h5> --}}
            </div>
        </div>
    </div>
</div>
<!-- Header End -->

<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-12">
            <!-- Static Filter Sidebar (design only, no logic, same as shop.blade.php) -->
            <div class="prf-filter-modern p-3 mb-3">
                <div class="text-md-center mb-md-3 filter-toggle-header d-md-block d-flex align-items-center"
                    style="cursor:pointer;">
                    <span class="prf-filter-icon"><i class="fas fa-sliders-h"></i></span>
                    <div class="ml-3">
                        <h5 class="prf-filter-title mt-2 mt-md-4">Filter Products</h5>
                        <p class="d-md-none">Find products more easy</p>
                    </div>
                </div>
                <div id="prf-filter-form-wrap">
                    <form id="prf-filter-form" action="" method="">
                        <div id="prf-filter-accordion">
                            <!-- Desktop Type -->
                            <!--            <div class="prf-filter-section" id="prf-section-desktop-type">-->
                            <!--                    <a class="prf-filter-label" href="#prf-desktop-type-options"-->
                            <!--                        data-toggle-target="prf-desktop-type-options">-->
                            <!--                        Brand-->
                            <!--                        <span class="prf-chevron"><i class="fas fa-chevron-down"></i></span>-->
                            <!--                    </a>-->
                            <!--                    <div class="prf-filter-options" id="prf-desktop-type-options" style="display: block;">-->
                            <!--                        @foreach ($categories as $category)-->
                            <!--                            <label class="prf-filter-checkbox">-->
                            <!--                                <input type="checkbox" name="category[]"-->
                            <!--                                    value="{{ $category->name_en }}"@isset($_GET['category']){{ in_array($category->name_en, $_GET['category']) ? 'checked' : '' }} @endisset-->
                            <!--            id="color-all">-->
                            <!--            <span>{{ $category->name_en }}</span>-->
                            <!--            </label>-->
                            <!--            @endforeach-->


                            <!--        </div>-->
                            <!--</div>-->
                            <!-- Brands -->
                            <!--<div class="prf-filter-section" id="prf-section-brands">-->
                            <!--    <a class="prf-filter-label" href="#prf-brands-options"-->
                            <!--        data-toggle-target="prf-brands-options">-->
                            <!--        Brands-->
                            <!--        <span class="prf-chevron"><i class="fas fa-chevron-down"></i></span>-->
                            <!--    </a>-->
                            <!--    <div class="prf-filter-options" id="prf-brands-options">-->
                            <!--        @foreach ($brands as $brand)-->
                            <!--        <label class="prf-filter-checkbox">-->
                            <!--            <input type="checkbox" name="brands[]" value="{{ $brand->name_en }}"-->
                            <!--                @isset($_GET['brands']){{ in_array($brand->name_en, $_GET['brands']) ? 'checked' : '' }} @endisset-->
                            <!--                id="color-all">-->
                            <!--            <span>{{ $brand->name_en }}</span>-->
                            <!--        </label>-->
                            <!--        @endforeach-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!-- Price -->
                            <!--<div class="prf-filter-section mb-4" id="prf-section-price">-->
                            <!--    <a class="prf-filter-label" href="#prf-price-options"-->
                            <!--        data-toggle-target="prf-price-options">-->
                            <!--        Price-->
                            <!--        <span class="prf-chevron"><i class="fas fa-chevron-down"></i></span>-->
                            <!--    </a>-->
                            <!--    <div class="prf-range-wrap" id="prf-price-options">-->
                            <!--        <link rel="stylesheet"-->
                            <!--            href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">-->
                            <!--        <div style="margin-bottom:10px;">-->
                            <!--            <input type="text" id="prf-amount" readonly-->
                            <!--                style="border:0; font-weight:bold;">-->
                            <!--            <input type="hidden" name="price_min" id="prf-price-min"-->
                            <!--                value="{{ request('price_min') }}">-->
                            <!--            <input type="hidden" name="price_max" id="prf-price-max"-->
                            <!--                value="{{ request('price_max') }}">-->
                            <!--        </div>-->
                            <!--        <div id="prf-slider"></div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!-- Processor -->
                            <div class="prf-filter-section" id="prf-section-processor">
                                <a class="prf-filter-label" href="#prf-processor-options"
                                    data-toggle-target="prf-processor-options">
                                    Processor Type
                                    <span class="prf-chevron"><i class="fas fa-chevron-down"></i></span>
                                </a>
                                <div class="prf-filter-options" id="prf-processor-options">
                                    @foreach ($processor_type as $processor)
                                    <label class="prf-filter-checkbox">
                                        <input type="checkbox" name="processors[]"
                                            value="{{ $processor->name_en }}"
                                            @isset($_GET['processors']){{ in_array($processor->name_en, $_GET['processors']) ? 'checked' : '' }} @endisset
                                            id="color-all">
                                        <span>{{ $processor->name_en }}</span>
                                    </label>
                                    @endforeach

                                </div>
                            </div>
                            <!--<div class="prf-filter-section" id="prf-section-processor">-->
                            <!--    <a class="prf-filter-label" href="#prf-processor-options"-->
                            <!--        data-toggle-target="prf-processor-options">-->
                            <!--        Processor Model-->
                            <!--        <span class="prf-chevron"><i class="fas fa-chevron-down"></i></span>-->
                            <!--    </a>-->
                            <!--    <div class="prf-filter-options" id="prf-processor-options">-->
                            <!--        @foreach ($processor_model as $processorsM)-->
                            <!--        <label class="prf-filter-checkbox">-->
                            <!--            <input type="checkbox" name="processorsM[]"-->
                            <!--                value="{{ $processorsM->name_en }}"-->
                            <!--                @isset($_GET['processorsM']){{ in_array($processorsM->name_en, $_GET['processorsM']) ? 'checked' : '' }} @endisset-->
                            <!--                id="color-all">-->
                            <!--            <span>{{ $processorsM->name_en }}</span>-->
                            <!--        </label>-->
                            <!--        @endforeach-->

                            <!--    </div>-->
                            <!--</div>-->


                            <div class="prf-filter-section" id="prf-section-processor">
                                <a class="prf-filter-label" href="#prf-processor-options"
                                    data-toggle-target="prf-processor-options">
                                    Generation
                                    <span class="prf-chevron"><i class="fas fa-chevron-down"></i></span>
                                </a>
                                <div class="prf-filter-options" id="prf-processor-options">
                                    @foreach ($generations as $generation)
                                    <label class="prf-filter-checkbox">
                                        <input type="checkbox" name="generation[]"
                                            value="{{ $generation->name_en }}"
                                            @isset($_GET['generation']){{ in_array($generation->name_en, $_GET['generation']) ? 'checked' : '' }} @endisset
                                            id="color-all">
                                        <span>{{ $generation->name_en }}</span>
                                    </label>
                                    @endforeach

                                </div>
                            </div>

                            <!--<div class="prf-filter-section" id="prf-section-processor">-->
                            <!--    <a class="prf-filter-label" href="#prf-processor-options"-->
                            <!--        data-toggle-target="prf-processor-options">-->
                            <!--        Display Type-->
                            <!--        <span class="prf-chevron"><i class="fas fa-chevron-down"></i></span>-->
                            <!--    </a>-->
                            <!--    <div class="prf-filter-options" id="prf-processor-options">-->
                            <!--        @foreach ($display_type as $type)-->
                            <!--        <label class="prf-filter-checkbox">-->
                            <!--            <input type="checkbox" name="type[]" value="{{ $type->name_en }}"-->
                            <!--                @isset($_GET['type']){{ in_array($type->name_en, $_GET['type']) ? 'checked' : '' }} @endisset-->
                            <!--                id="color-all">-->
                            <!--            <span>{{ $type->name_en }}</span>-->
                            <!--        </label>-->
                            <!--        @endforeach-->

                            <!--    </div>-->
                            <!--</div>-->

                            <div class="prf-filter-section" id="prf-section-processor">
                                <a class="prf-filter-label" href="#prf-processor-options"
                                    data-toggle-target="prf-processor-options">
                                    Display Size
                                    <span class="prf-chevron"><i class="fas fa-chevron-down"></i></span>
                                </a>
                                <div class="prf-filter-options" id="prf-processor-options">
                                    @foreach ($display_size as $display_size)
                                    <label class="prf-filter-checkbox">
                                        <input type="checkbox" name="display_size[]"
                                            value="{{ $display_size->name_en }}"
                                            @isset($_GET['display_size']){{ in_array($display_size->name_en, $_GET['display_size']) ? 'checked' : '' }} @endisset
                                            id="color-all">
                                        <span>{{ $display_size->name_en }}</span>
                                    </label>
                                    @endforeach

                                </div>
                            </div>
                            <!-- RAM -->
                            <div class="prf-filter-section" id="prf-section-ram">
                                <a class="prf-filter-label" href="#prf-ram-options"
                                    data-toggle-target="prf-ram-options">
                                    RAM
                                    <span class="prf-chevron"><i class="fas fa-chevron-down"></i></span>
                                </a>
                                <div class="prf-filter-options" id="prf-ram-options">
                                    @foreach ($ram_size as $ramS)
                                    <label class="prf-filter-checkbox">
                                        <input type="checkbox" name="ramS[]" value="{{ $ramS->name_en }}"
                                            @isset($_GET['ramS']){{ in_array($ramS->name_en, $_GET['ramS']) ? 'checked' : '' }} @endisset
                                            id="color-all">
                                        <span>{{ $ramS->name_en }}</span>
                                    </label>
                                    @endforeach

                                </div>
                            </div>
                            <!-- SSD -->
                            <div class="prf-filter-section" id="prf-section-ssd">
                                <a class="prf-filter-label" href="#prf-ssd-options"
                                    data-toggle-target="prf-ssd-options">
                                    SSD
                                    <span class="prf-chevron"><i class="fas fa-chevron-down"></i></span>
                                </a>
                                <div class="prf-filter-options" id="prf-ssd-options">
                                    @foreach ($ssd as $ssd)
                                    <label class="prf-filter-checkbox">
                                        <input type="checkbox" name="ssd[]" value="{{ $ssd->name_en }}"
                                            @isset($_GET['ssd']){{ in_array($ssd->name_en, $_GET['ssd']) ? 'checked' : '' }} @endisset
                                            id="color-all">
                                        <span>{{ $ssd->name_en }}</span>
                                    </label>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <!--<div class="text-center mt-3">-->
                        <!--    <button type="submit" class="prf-filter-btn" id="prf-apply-btn" disabled>Apply-->
                        <!--        Filters</button>-->
                        <!--</div>-->
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-12">
            <!-- Product Start -->
            <section class="just-for-you container">
                <div class="row align-items-center px-md-3 px-2">
                @foreach ($products as $product)
                @php $data = calculateDiscount($product->id) @endphp
                <div class="col-xl-4 col-lg-4 col-md-6 col-6 px-1 px-md-2 mb-4">
                    <div class="card-container">
                        <div class="card">
                            <div class="card-image">
                                <a href="{{ route('product.details', ['id' => $product->id,'slug' => $product->slug]) }}">
                                    <img src="{{ asset($product->product_thumbnail) }}" alt="{{ $product->name_en }}" />
                                </a>
                                @if ($product->discount_price != 0)
                                <div class="card-labels">
                                    <span class="onsale">{{ $data['text'] }}</span>
                                </div>
                                @endif
                            </div>
                            <div class="card-content">
                                <h3 class="card-title">
                                    <a href="{{ route('product.details', ['id' => $product->id,'slug' => $product->slug]) }}">
                                        {{ Str::limit($product->name_en, 43, '...') }}
                                    </a>
                                </h3>
                                <div class="card-price">
                                    @if ($product->discount_price != 0)
                                    <span>৳{{ $data['discount'] }}</span> – <span>৳{{ $product->regular_price }}</span>
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
                                    <input type="hidden" id="product_product_id" value="{{ $product->id }}" min="1">
                                    <input type="hidden" id="{{ $product->id }}-product_pname" value="{{ $product->name_en }}">

                                    <a href="#" class="btn btn-buy-now" onclick="buyNow({{ $product->id }})">
                                        <i class="fas fa-bolt"></i>
                                        @if (session()->get('language') == 'bangla')
                                        এখুনি কিনুন
                                        @else
                                        Buy Now
                                        @endif
                                    </a>
                                    <a href="#" class="btn btn-add-cart" onclick="addToCartDirect({{ $product->id }})">
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

            <style>
                .card-container {
                    /* padding: 15px; */
                }

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
            </style>
                <div class="pagination justify-content-center mt-4">
                    {{-- Custom pagination design for Bootstrap 5 --}}
                    <style>
                        .custom-pagination .pagination {
                            display: flex;
                            padding-left: 0;
                            list-style: none;
                            border-radius: 0.5rem;
                            background: #fff;
                            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
                            overflow: hidden;
                        }

                        .custom-pagination .page-item {
                            margin: 0 2px;
                        }

                        .custom-pagination .page-link {
                            color: #FF914D;
                            background-color: #fff;
                            border: none;
                            border-radius: 0.35rem;
                            padding: 0.5rem 1rem;
                            font-weight: 600;
                            transition: background 0.2s, color 0.2s;
                        }

                        .custom-pagination .page-link:hover,
                        .custom-pagination .page-link:focus {
                            background: #FF914D;
                            color: #fff;
                            text-decoration: none;
                        }

                        .custom-pagination .active .page-link {
                            background: linear-gradient(90deg, #FF914D 0%, #e07b39 100%);
                            color: #fff;
                            border: none;
                        }

                        .custom-pagination .disabled .page-link {
                            color: #bdbdbd;
                            background: #f7f7f7;
                        }
                    </style>
                    <nav class="custom-pagination">
                        <ul class="pagination mb-0">
                            {{-- Previous Page Link --}}
                            @if ($products->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                            @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev">&laquo;</a>
                            </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($products->getUrlRange(
                            max($products->currentPage() - 1, 1),
                            min($products->currentPage() + 1, $products->lastPage())
                            ) as $page => $url)
                            @if ($page == $products->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($products->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next">&raquo;</a>
                            </li>
                            @else
                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </section>
            <div class="text-center my-5">
                {{-- <button type="button" class="view_more">View More</button> --}}
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    function addToCart() {
        var total_attributes = parseInt($('#total_attributes').val());
        //alert(total_attributes);
        var checkNotSelected = 0;
        var checkAlertHtml = '';
        for (var i = 1; i <= total_attributes; i++) {
            var checkSelected = parseInt($('#attribute_check_' + i).val());
            if (checkSelected == 0) {
                checkNotSelected = 1;
                checkAlertHtml += `<div class="attr-detail mb-5">
											<div class="alert alert-danger d-flex align-items-center" role="alert">
												<div>
													<i class="fa fa-warning mr-10"></i> <span> Select ` + $('#attribute_name_' + i).val() + `</span>
												</div>
											</div>
										</div>`;
            }
        }
        if (checkNotSelected == 1) {
            $('#qty_alert').html('');
            //$('#attribute_alert').html(checkAlertHtml);
            $('#attribute_alert').html(`<div class="attr-detail mb-5">
											<div class="alert alert-danger d-flex align-items-center" role="alert">
												<div>
													<i class="fa fa-warning mr-10"></i> <span> Select all attributes</span>
												</div>
											</div>
										</div>`);
            return false;
        }
        $('.size-filter li').removeClass("active");
        var product_name = $('#pname').val();
        var id = $('#product_id').val();
        var price = $('#product_price').val();
        var color = $('#color option:selected').val();
        var size = $('#size option:selected').val();
        var quantity = $('#qty').val();
        var varient = $('#pvarient').val();

        var min_qty = parseInt($('#minimum_buy_qty').val());
        if (quantity < min_qty) {
            $('#attribute_alert').html('');
            $('#qty_alert').html(`<div class="attr-detail mb-5">
											<div class="alert alert-danger d-flex align-items-center" role="alert">
												<div>
													<i class="fa fa-warning mr-10"></i> <span> Minimum quantity ` + min_qty + ` required.</span>
												</div>
											</div>
										</div>`);
            return false;
        }
        // console.log(min_qty);
        var p_qty = parseInt($('#stock_qty').val());
        // if(quantity > p_qty){
        //     $('#stock_alert').html(`<div class="attr-detail mb-5">
        // 								<div class="alert alert-danger d-flex align-items-center" role="alert">
        // 									<div>
        // 										<i class="fa fa-warning mr-10"></i> <span> Not enough stock.</span>
        // 									</div>
        // 								</div>
        // 							</div>`);
        //     return false;
        // }


        // alert(varient);

        var options = $('#choice_form').serializeArray();
        var jsonString = JSON.stringify(options);
        //console.log(options);

        // Start Message
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            icon: 'success',
            showConfirmButton: false,
            timer: 1200
        });

        $.ajax({
            type: 'POST',
            url: '/cart/data/store/' + id,
            dataType: 'json',
            data: {
                color: color,
                size: size,
                quantity: quantity,
                product_name: product_name,
                product_price: price,
                product_varient: varient,
                options: jsonString,
            },
            success: function(data) {
                // console.log(data);
                miniCart();
                $('#closeModel').click();

                // Start Sweertaleart Message
                if ($.isEmptyObject(data.error)) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1200
                    })

                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })

                    $('#qty').val(min_qty);
                    $('#pvarient').val('');

                    for (var i = 1; i <= total_attributes; i++) {
                        $('#attribute_check_' + i).val(0);
                    }

                } else {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1200
                    })

                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })

                    $('#qty').val(min_qty);
                    $('#pvarient').val('');

                    for (var i = 1; i <= total_attributes; i++) {
                        $('#attribute_check_' + i).val(0);
                    }
                }
                // Start Sweertaleart Message
                var buyNowCheck = $('#buyNowCheck').val();
                //alert(buyNowCheck);
                if (buyNowCheck && buyNowCheck == 1) {
                    $('#buyNowCheck').val(0);
                    window.location = '/checkout';
                }

            }
        });
    }


    function miniCartRemove(rowId) {
        $.ajax({
            type: 'GET',
            url: '/minicart/product-remove/' + rowId,
            dataType: 'json',
            success: function(data) {

                miniCart();
                cart();

                // Start Message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                } else {
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })
                }
                // End Message
            }
        });
    }

    // Mobile filter toggle logic
    (function() {
        function isMobile() {
            return window.innerWidth <= 991;
        }

        function hideFilterForm() {
            var formWrap = document.getElementById('prf-filter-form-wrap');
            if (formWrap) formWrap.style.display = 'none';
        }

        function showFilterForm() {
            var formWrap = document.getElementById('prf-filter-form-wrap');
            if (formWrap) formWrap.style.display = '';
        }

        function setupMobileFilterToggle() {
            var header = document.querySelector('.filter-toggle-header');
            var formWrap = document.getElementById('prf-filter-form-wrap');
            if (!header || !formWrap) return;
            if (isMobile()) {
                hideFilterForm();
                header.onclick = function() {
                    if (formWrap.style.display === 'none') {
                        showFilterForm();
                    } else {
                        hideFilterForm();
                    }
                };
            } else {
                showFilterForm();
                header.onclick = null;
            }
        }
        window.addEventListener('resize', setupMobileFilterToggle);
        document.addEventListener('DOMContentLoaded', setupMobileFilterToggle);
    })();
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<!-- Add Bootstrap JS for collapse/toggle functionality -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Vanilla JavaScript for accordion toggling
    document.querySelectorAll('.prf-filter-label').forEach(label => {
        label.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-toggle-target');
            const target = document.getElementById(targetId);
            const chevron = this.querySelector('.prf-chevron');
            const isVisible = target.style.display === 'block';

            target.style.display = isVisible ? 'none' : 'block';
            chevron.classList.toggle('collapsed', isVisible);

            // Enable apply button
            document.getElementById('prf-apply-btn').disabled = false;
        });
    });

    // jQuery UI for price slider (isolated to avoid conflicts)
    $(function() {
        $("#prf-slider").slider({
            range: true,
            min: 10000,
            max: 500000,
            values: [10000, 200000],
            slide: function(event, ui) {
                $("#prf-amount").val("৳" + ui.values[0].toLocaleString() + " - ৳" + ui.values[1]
                    .toLocaleString());
                $("#prf-price-min").val(ui.values[0]);
                $("#prf-price-max").val(ui.values[1]);
                // Enable apply button using vanilla JS
                document.getElementById('prf-apply-btn').disabled = false;
            }
        });
        $("#prf-amount").val("৳" + $("#prf-slider").slider("values", 0).toLocaleString() +
            " - ৳" + $("#prf-slider").slider("values", 1).toLocaleString());
        $("#prf-price-min").val($("#prf-slider").slider("values", 0));
        $("#prf-price-max").val($("#prf-slider").slider("values", 1));
    });

    // Enable apply button on checkbox change
    document.querySelectorAll('.prf-filter-checkbox input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            document.getElementById('prf-apply-btn').disabled = false;
        });
    });
</script>

<script>
    // Mobile filter toggle logic (copied/adapted from category_view.blade.php)
    (function() {
        function isMobile() {
            return window.innerWidth <= 991;
        }

        function hideFilterForm() {
            var formWrap = document.getElementById('prf-filter-form-wrap');
            if (formWrap) formWrap.style.display = 'none';
        }

        function showFilterForm() {
            var formWrap = document.getElementById('prf-filter-form-wrap');
            if (formWrap) formWrap.style.display = '';
        }

        function setupMobileFilterToggle() {
            var header = document.querySelector('.filter-toggle-header');
            var formWrap = document.getElementById('prf-filter-form-wrap');
            if (!header || !formWrap) return;
            if (isMobile()) {
                hideFilterForm();
                header.onclick = function() {
                    if (formWrap.style.display === 'none') {
                        showFilterForm();
                    } else {
                        hideFilterForm();
                    }
                };
            } else {
                showFilterForm();
                header.onclick = null;
            }
        }
        window.addEventListener('resize', setupMobileFilterToggle);
        document.addEventListener('DOMContentLoaded', setupMobileFilterToggle);

        // Auto-close filter on submit (mobile only)
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.getElementById('prf-filter-form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    if (isMobile()) {
                        hideFilterForm();
                    }
                    // Optionally: e.preventDefault(); // Remove if you want real filtering
                });
            }
        });
    })();

    $('#prf-filter-form input[type="checkbox"]').on('change', function() {
        $('#prf-filter-form').submit();
    });
</script>
@endpush