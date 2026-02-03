@extends('FrontEnd.master')
@section('title')
    Searched Products
@endsection
@section('content')
    <div class="container-fluid py-5 page-header">
        <div class="container ">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    {{--                    <h2 class="display-3 fw-bold">{{$category->name_en}}</h2> --}}
                    <h2 class="display-6 fw-semibold" style="color: black">Related Products</h5>
                    <h6 style="color: black">{{ count($products) }} Products Found</h6>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Flash Sale Start -->
    {{-- <section class="flash-sale container-fluid bg-white mt-2">
        <div class="container p-2">
            <div class="d-flex align-items-center">
                <h5 class="me-5 d-none d-md-block">On Sale Now</h5>
                <h5 class="trimmers me-4">Ending in <span>03</span> : <span>47</span> : <span> 45</span></h5>
                <span class="d-none d-md-block">|</span>
                <p class="ms-5 d-none d-md-block">00 : 00 Tomorrow</p>
            </div>
        </div>

    </section> --}}
    <!-- Flash Sale End -->

    <!-- Shop Option Part Start -->
    {{-- <section class="shop-option container-fluid mt-3 p-2">
        <div class="container">
            <ul>
                <li><a href="">All</a></li>
                <li><a href="">Electronic</a></li>
                <li><a href="#">Health &amp; Beauty</a></li>
                <li><a href="">Fashion</a></li>
                <li><a href="">Home &amp; Living</a></li>
                <li><a href="">Supermarket</a></li>
                <li><a href="">Stationary &amp; Toys</a></li>
                <li><a href="">Sports &amp; Motors</a></li>
            </ul>
        </div>
    </section> --}}
    <!-- Shop Option Part End -->


    <!-- Product Start -->
    <section class="just-for-you container mt-2">


        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-2">
            @if (count($products) > 0)
                @foreach ($products as $product)
                    @php $data = calculateDiscount($product->id) @endphp
                    <div class="product-card col-xl-3 col-lg-3 col-md-6 col-6 px-2">
                        <div class="product_grid card border">
                            <div class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">
                                New</div>
                            @if ($product->discount_price != 0)
                                <div class="badge bg-danger text-white position-absolute ft-regular ab-right text-upper">
                                    {{ $data['text'] }}</div>
                            @endif

                            <div class="card-body p-0 ">
                                <div class="shop_thumb position-relative">
                                    <a class="card-img-top d-block overflow-hidden"
                                        href="{{ route('product.details', ['id' => $product->id,'slug' => $product->slug]) }}"><img class="card-img-top"
                                            src="{{ asset($product->product_thumbnail) }}" alt="..."></a>
                                    <div class="product-left-hover-overlay">
                                        <ul class="left-over-buttons">
                                            <li class="d-none"><a href="javascript:void(0);"
                                                    class="d-inline-flex circle align-items-center justify-content-center"><i
                                                        class="fas fa-expand-arrows-alt position-absolute"></i></a>
                                            </li>
                                            <li class="d-none"><a href="javascript:void(0);"
                                                    class="d-inline-flex circle align-items-center justify-content-center snackbar-wishlist"><i
                                                        class="far fa-heart position-absolute"></i></a></li>

                                            <li class="d-none"><a href="javascript:void(0);"
                                                    class="d-inline-flex circle align-items-center justify-content-center snackbar-addcart"><i
                                                        class="fas fa-shopping-basket position-absolute"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-white align-items-start justify-content-between">
                                <div class="text-left">
                                    <div class="text-left mb-1">
                                        <h5 class="product_name fs-md lh-1 mb-1"><a
                                                href="{{ route('product.details', ['id' => $product->id,'slug' => $product->slug]) }}">{{ Str::limit($product->name_en, 43, '...') }}</a>
                                        </h5>
                                        <div class="elis_rty ">
                                            @if ($product->discount_price != 0)
                                                <del class="d-block">৳{{ $product->regular_price }}</del>
                                                <span class="ft-semibold text-dark fs-lg">Price
                                                    {{ $data['discount'] }}
                                                    TK</span>
                                            @else
                                                <span
                                                    class="ft-semibold text-dark fs-lg">৳{{ $product->regular_price }}</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="text-center mb-1 p-0 d-flex align-items-center mt-2" style="gap: 15px; ">
                                        @if ($product->stock_qty == 0)
                                            <div class="bg-danger text-white out_of_stock">Out of Stock</div>
                                        @elseif($product->is_varient == 1)
                                            <button type="submit" id="{{ $product->id }}" onclick="productView(this.id)"
                                                data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                                style="@if (session()->get('language') == 'bangla') font-size: x-small; @endif"
                                                class="buy_now btn btn-outline-dark">
                                                @if (session()->get('language') == 'bangla')
                                                    এখুনি কিনুন
                                                @else
                                                    Buy Now
                                                @endif
                                            </button>
                                            <button type="submit" id="{{ $product->id }}" onclick="productView(this.id)"
                                                data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                                style="@if (session()->get('language') == 'bangla') font-size:x-small @endif"
                                                class="add_to_cart btn btn-outline-dark">

                                                @if (session()->get('language') == 'bangla')
                                                    কার্টে যোগ করুন
                                                @else
                                                    Add to Cart
                                                @endif
                                            </button>
                                        @else
                                            <input type="hidden" id="pfrom" value="direct">
                                            <input type="hidden" id="product_product_id" value="{{ $product->id }}"
                                                min="1">
                                            <input type="hidden" id="{{ $product->id }}-product_pname"
                                                value="{{ $product->name_en }}">

                                            <button type="submit" onclick="buyNow({{ $product->id }})"
                                                class="buy_now btn btn-outline-dark ">Buy Now</button>
                                            <button type="submit" onclick="addToCartDirect({{ $product->id }})"
                                                class="add_to_cart btn btn-outline-dark ">Add to Cart</button>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>
    <div class="text-center my-5">
        {{-- <button type="button" class="view_more">View More</button> --}}
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
    </script>
@endpush
