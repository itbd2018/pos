@extends('FrontEnd.master')
@section('title')
    Flash Sale
@endsection
@section('content')
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
        @php $start_diff=0; $end_diff=0; @endphp
    @endif
    @if($campaign)

        @php
            $flash_start = date_create($campaign->flash_start);
            $flash_end = date_create($campaign->flash_end);

            $start_diff = $flash_start->getTimestamp() - time();
            $end_diff = $flash_end->getTimestamp() - time();

            $start_diff2=date_diff(date_create($campaign->flash_start), date_create(date('d-m-Y H:i:s')));
            $end_diff2=date_diff(date_create(date('d-m-Y H:i:s')), date_create($campaign->flash_end));
        @endphp

        @if ($start_diff2->invert == 0 && $end_diff2->invert == 0)
            <section class="middle">
                <div class="container">

                    <div class="row ">
                        <div class="product-card col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="sec_title position-relative text-center">
                                <h1 class="fw-bold pt-2" style="color: rgb(41, 41, 41)">Sales Going On</h1>
                                {{-- <h6 style="color: black;" class="pb-4">{{count($campaign->campaing_products)}} {{session()->get('language') == 'bangla' ? 'টি পণ্য পাওয়া গেছে':'Products Found'}}</h6> --}}
                                <h5 class="trimmers">
                                    <h4 class="text me-2 mb-4" style="color:rgb(36, 36, 36);">Ending in: </h4>
                                    <strong style="color: white" id="demo"></strong>
                                </h5>
                            </div>
                        </div>

                    </div>

                    <div class="row  justify-content-center mx-0">
                        @foreach($campaign->campaing_products as $campaing_product)
                            @php $product = \App\Models\Product::find($campaing_product->product_id);
                                $data = calculateDiscount($product->id); @endphp
                            <div class="product-card col-xl-3 col-lg-4 col-md-6 col-6 px-1 px-md-2" >
                                <div class="product_grid card b-0">
                                    {{--                                                    <div class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">New</div>--}}
                                    @if($product->discount_price != 0)
                                        <div class="badge bg-danger text-white position-absolute ft-regular ab-right text-upper">{{$data['text']}}</div>
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
                                            <div class="text-center mb-1 p-0 d-flex align-items-center mt-2" style="gap: 8px; ">
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

                    </div>

                </div>
            </section>
        @endif
    @endif
    <!-- ======================= Flash sale ======================== -->
@endsection
@push('js')
    <script>
        // function addToCart() {
        //     var total_attributes = parseInt($('#total_attributes').val());
        //     //alert(total_attributes);
        //     var checkNotSelected = 0;
        //     var checkAlertHtml = '';
        //     for (var i = 1; i <= total_attributes; i++) {
        //         var checkSelected = parseInt($('#attribute_check_' + i).val());
        //         if (checkSelected == 0) {
        //             checkNotSelected = 1;
        //             checkAlertHtml += `<div class="attr-detail mb-5">
		// 									<div class="alert alert-danger d-flex align-items-center" role="alert">
		// 										<div>
		// 											<i class="fa fa-warning mr-10"></i> <span> Select ` + $('#attribute_name_' + i).val() + `</span>
		// 										</div>
		// 									</div>
		// 								</div>`;
        //         }
        //     }
        //     if (checkNotSelected == 1) {
        //         $('#qty_alert').html('');
        //         //$('#attribute_alert').html(checkAlertHtml);
        //         $('#attribute_alert').html(`<div class="attr-detail mb-5">
		// 									<div class="alert alert-danger d-flex align-items-center" role="alert">
		// 										<div>
		// 											<i class="fa fa-warning mr-10"></i> <span> Select all attributes</span>
		// 										</div>
		// 									</div>
		// 								</div>`);
        //         return false;
        //     }
        //     $('.size-filter li').removeClass("active");
        //     var product_name = $('#pname').val();
        //     var id = $('#product_id').val();
        //     var price = $('#product_price').val();
        //     var color = $('#color option:selected').val();
        //     var size = $('#size option:selected').val();
        //     var quantity = $('#qty').val();
        //     var varient = $('#pvarient').val();
        //
        //     var min_qty = parseInt($('#minimum_buy_qty').val());
        //     if (quantity < min_qty) {
        //         $('#attribute_alert').html('');
        //         $('#qty_alert').html(`<div class="attr-detail mb-5">
		// 									<div class="alert alert-danger d-flex align-items-center" role="alert">
		// 										<div>
		// 											<i class="fa fa-warning mr-10"></i> <span> Minimum quantity ` + min_qty + ` required.</span>
		// 										</div>
		// 									</div>
		// 								</div>`);
        //         return false;
        //     }
        //     // console.log(min_qty);
        //     var p_qty = parseInt($('#stock_qty').val());
        //     // if(quantity > p_qty){
        //     //     $('#stock_alert').html(`<div class="attr-detail mb-5">
        //     // 								<div class="alert alert-danger d-flex align-items-center" role="alert">
        //     // 									<div>
        //     // 										<i class="fa fa-warning mr-10"></i> <span> Not enough stock.</span>
        //     // 									</div>
        //     // 								</div>
        //     // 							</div>`);
        //     //     return false;
        //     // }
        //
        //
        //     // alert(varient);
        //
        //     var options = $('#choice_form').serializeArray();
        //     var jsonString = JSON.stringify(options);
        //     //console.log(options);
        //
        //     // Start Message
        //     const Toast = Swal.mixin({
        //         toast: true,
        //         position: 'top-end',
        //         icon: 'success',
        //         showConfirmButton: false,
        //         timer: 1200
        //     });
        //
        //     $.ajax({
        //         type: 'POST',
        //         url: '/cart/data/store/' + id,
        //         dataType: 'json',
        //         data: {
        //             color: color,
        //             size: size,
        //             quantity: quantity,
        //             product_name: product_name,
        //             product_price: price,
        //             product_varient: varient,
        //             options: jsonString,
        //         },
        //         success: function (data) {
        //             // console.log(data);
        //             miniCart();
        //             $('#closeModel').click();
        //
        //             // Start Sweertaleart Message
        //             if ($.isEmptyObject(data.error)) {
        //                 const Toast = Swal.mixin({
        //                     toast: true,
        //                     position: 'top-end',
        //                     icon: 'success',
        //                     showConfirmButton: false,
        //                     timer: 1200
        //                 })
        //
        //                 Toast.fire({
        //                     type: 'success',
        //                     title: data.success
        //                 })
        //
        //                 $('#qty').val(min_qty);
        //                 $('#pvarient').val('');
        //
        //                 for (var i = 1; i <= total_attributes; i++) {
        //                     $('#attribute_check_' + i).val(0);
        //                 }
        //
        //             } else {
        //                 const Toast = Swal.mixin({
        //                     toast: true,
        //                     position: 'top-end',
        //                     icon: 'error',
        //                     showConfirmButton: false,
        //                     timer: 1200
        //                 })
        //
        //                 Toast.fire({
        //                     type: 'error',
        //                     title: data.error
        //                 })
        //
        //                 $('#qty').val(min_qty);
        //                 $('#pvarient').val('');
        //
        //                 for (var i = 1; i <= total_attributes; i++) {
        //                     $('#attribute_check_' + i).val(0);
        //                 }
        //             }
        //             // Start Sweertaleart Message
        //             var buyNowCheck = $('#buyNowCheck').val();
        //             //alert(buyNowCheck);
        //             if (buyNowCheck && buyNowCheck == 1) {
        //                 $('#buyNowCheck').val(0);
        //                 window.location = '/checkout';
        //             }
        //
        //         }
        //     });
        // }


        function miniCartRemove(rowId) {
            $.ajax({
                type: 'GET',
                url: '/minicart/product-remove/' + rowId,
                dataType: 'json',
                success: function (data) {

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
    <script>
        $(document).ready(function () {
            console.log('ok');
            var campaign = $('#campaign').val();
            if(campaign == 1){
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
                        var countDownDate = (now < countDownDateStart.getTime()) ? countDownDateStart : countDownDateEnd;

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
    </script>

@endpush

