@extends('FrontEnd.master')
@section('title')
    Shopping Cart
@endsection
@section('content')
    {{-- <div class="container-fluid py-3 page-header ">
        <div class="container px-4">
            <div class="row justify-content-left bg-white py-3">
                <div class="col-lg-10 text-left">
                    <input type="hidden" name="" id="cart_products" value="{{ count(Cart::content()) }}">
                    <h2 class="display-6 fw-bold text-dark ">{{ get_setting('business_name')->value }}</h2>
                    <div class="d-flex justify-content-left mt-2">
                        <p class="m-0"><a href="{{ route('home') }}">Home</a></p>
                        <p class="m-0 px-2">-</p>
                        <p class="m-0">Shopping Cart</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Header End -->


    <!-- Cart Information Start -->
    <section class="container my-3" style="padding: 0 10px">
        <div class=" bg-white">
            {{-- <h4 class="px-3 text-dark" style="font-weight: 500;">Shopping Cart</h4> --}}
            <section class="">
                <div class="container px-0">
                    <div class="row px-0 mx-0 d-flex justify-content-center align-items-center ">
                        <div class="col px-0 py-0">
                            <div class="card" style="border: none !important">
                                <div class="card-body p-0" style="background-color: white !important;">

                                    <div class="row mx-0">
                                        <div class="col-lg-8 px-0 pt-3">
                                            <div class="d-flex justify-content-between align-items-center pb-3 px-3 px-md-3"
                                                style="border-bottom: 1px solid #dfdfdf">
                                                <div>
                                                    <h4 class="mb-1">Shopping cart</h4>
                                                    <p id="cartItemCount" class="mb-0">You have 0 items in your cart</p>
                                                </div>

                                            </div>
                                            <div class="mb-3" id="cartPage">

                                            </div>



                                        </div>
                                        <div class="col-lg-4 pl-md-3 pl-0 pr-0">

                                            <div class="card  text-white " style="background: #FF914D; height: 100%;"
                                                style="border-radius: 0px !important">
                                                <div class="card-body" style="border-radius: 0px !important">
                                                    <div class=" mb-4">
                                                        <h4 class="mb-0 text-white" style="color: #fff !important">Cart
                                                            Summary</h4>

                                                    </div>



                                                    <div class="d-flex justify-content-between">
                                                        <p class="mb-2 " style="color: #fff !important">Subtotal</p>
                                                        <p class="mb-2 " style="color: #fff !important">
                                                            <span id="cartSubTotal" style="color: #fff !important;"> </span>
                                                            TK
                                                        </p>

                                                    </div>
                                                    <hr>
                                                    <div class="d-flex justify-content-between mb-4">
                                                        <p class="mb-2 " style="color: #fff !important; font-weight:700;">
                                                            Total</p>
                                                        <p class="mb-2 " style="color: #fff !important"><span
                                                                id="cartSubTotal"
                                                                style="color: #fff !important;font-weight:700;">
                                                            </span> TK</p>
                                                    </div>

                                                    {{-- @auth --}}
                                                        <a href="{{ route('checkout') }}" class="btn w-100 bg-white">
                                                            <div class="d-flex justify-content-center">
                                                                <span>Proceed To Checkout <i class="fas fa-arrow-right ms-2"></i></span>
                                                            </div>
                                                        </a>
                                                    {{-- @endauth --}}
                                                    {{-- @guest
                                                        <a href="{{ route('session.login.data') }}" class="btn w-100 bg-white">
                                                            <div class="d-flex justify-content-center">
                                                                <span>Proceed To Checkout <i
                                                                        class="fas fa-arrow-right ms-2"></i></span>
                                                            </div>
                                                        </a>
                                                    @endguest --}}

                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
@endsection
@push('js')
    <script>
        function cart() {
            $.ajax({
                type: 'GET',
                url: '/get-cart-product',
                dataType: 'json',
                success: function(response) {
                    var rows = "";
                    var cartCount = Object.keys(response.carts).length;

                    // Update total cart quantity display
                    $('#total_cart_qty').text(cartCount);

                    // Update cart item count display
                    $('#cartItemCount').text(`You have ${cartCount} items in your cart`);

                    if (cartCount > 0) {
                        $.each(response.carts, function(key, value) {
                            var slug = value.options.slug;
                            var base_url = window.location.origin;
                            var category = value.options
                                .category; // Assuming this contains the category
                            var qty = value.qty;

                            // Check if quantity is 1 or more
                            var decrementButton = qty > 1 ?
                                `<button type="submit"
                    style="margin-right: 5px; background-color: red !important;"
                    class="btn border btn-xsm text-white" id="${value.rowId}" onclick="cartDecrement(this.id)">
                    <i class="fa fa-minus" style="color:#ffffff !important"
                        aria-hidden="true"></i>
                </button>` :
                                `<button type="submit"
                    style="margin-right: 5px; color: gray !important; border-color: #fadada !important; cursor: not-allowed;"
                    class="btn border btn-xsm text-dark" disabled>
                    <i class="fa fa-minus text-dark"
                        aria-hidden="true"></i>
                </button>`;

                            rows +=
                                ` <div class="card  px-3 px-md-3 py-3"
                        style="border-left: none; border-right: none; border-top: none; background-color: white !important;>
                        <div class="card-body px-0 py-3">
                            <div class="d-flex flex-md-row flex-column justify-content-between"
                                style="gap: 10px;">
                                <div class="d-flex flex-row align-items-start"
                                    style="gap:10px;">
                                    <div>
                                        <img src="/${value.options.image}"
                                            class="img-fluid rounded-3" alt="Shopping item"
                                            style="max-width: 90px; min-width: 90px;">
                                    </div>
                                    <div class="ms-3">
                                        <h5><a href="${base_url}/product-details/${slug}">${value.name}</a></h5>
                                        <p class="small mb-0">Price: <span>${value.price} TK</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex flex-md-column flex-row align-items-end justify-content-between"
                                    style="gap: 8px;">

                                    <a id="${value.rowId}" onclick="cartRemove(this.id)" class="order-md-1 order-3 "
                                        style="color: #e00000;cursor: pointer;"><i
                                            style="color: #ff1010 !important;"
                                            class="fas fa-trash-alt text-danger"></i></a>
                                    <div class="order-md-3 order-1">
                                        <h5 class="mb-0">Total:${value.subtotal} TK</h5>
                                    </div>
                                    <div
                                        class="align-items-center d-flex justify-content-center order-md-2 order-2">

                                        ${decrementButton}

                                        <input type="text" value="${value.qty}" min="1"
                                            max="100" disabled=""
                                            style="width: 32px; height:27px; text-align: center; padding-left:0px;">

                                        <button type="submit"
                                            style="margin-left: 5px; font-size: 12px; border-radius: 0.25rem; color:#ffffff !important"
                                            class="btn btn-xxsm text-dark"
                                            id="${value.rowId}" onclick="cartIncrement(this.id)"><i
                                                style="color:#ffffff !important"
                                                class="fa fa-plus text-white"
                                                aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
                        });


                        $('#cartPage').html(rows);

                    } else {
                        var html =
                            '<div class="text-center pt-4 h2">Cart Empty !</div>';
                        $('#cartPage').html(html);
                    }
                }
            });
        }
        cart();


        /* ==================== Start  cartIncrement ================== */
        function cartIncrement(rowId) {
            $.ajax({
                type: 'GET',
                url: "/cart-increment/" + rowId,
                dataType: 'json',
                success: function(data) {
                    // console.log(data)
                    cart();
                    miniCart();

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
                    }

                }
            });
        }
        /* ==================== End  cartIncrement ================== */

        /* ==================== Start  Cart Decrement ================== */
        function cartDecrement(rowId) {
            $.ajax({
                type: 'GET',
                url: "/cart-decrement/" + rowId,
                dataType: 'json',
                success: function(data) {
                    console.log(data)
                    //console.log(data);
                    // if(data == 2){
                    //     alert("#"+rowId);
                    //     $("#"+rowId).attr("disabled", "true");
                    // }
                    cart();
                    miniCart();

                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                }
            });
        }
        /* ================ Start My Cart Remove Product =========== */

        /* ==================== End  Cart Decrement ================== */

        function cartCheck() {
            $.ajax({
                type: 'GET',
                url: "/checkout",
                dataType: 'json',
                success: function(data) {
                    console.log(data.error)
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
                }
            });
        }
    </script>
    <script>
        $('.place_order').click(function() {
            // Start Message
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            })
            if ($('#cart_products').val() == 0) {
                $('.place_order').prop('disabled', true);
                event.preventDefault();
                Toast.fire({
                    type: 'error',
                    icon: 'error',
                    title: 'Cart is Empty!!'
                })
            } else {
                $('.place_order').prop('disabled', false);
            }
        })
    </script>
@endpush
