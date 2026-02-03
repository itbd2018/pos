@extends('FrontEnd.master')
@section('content')
@section('title')
    Login
@endsection
{{-- <div class="container-fluid py-5 page-header d-none">
        <div class="container ">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h2 class="display-3 fw-bold">{{get_setting('business_name')->value}}</h2>
                    <h5 class="display-6 fw-semibold">Happy Shopping</h5>
                    <div class="d-flex justify-content-center mt-3">
                        <p class="m-0"><a href="{{ route('home') }}">Home</a></p>
                        <p class="m-0 px-2">-</p>
                        <p class="m-0">Sign In</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
<!-- Header End -->
{{-- @if (session('checkout_value') == 'proceed_to_checkout')
    <div class="alert alert-info" role="alert">
        Please log in to proceed to checkout.
    </div>
@endif --}}
<!-- Sign In Start -->

<div class="container my-5">

    <div class="row justify-content-center">

        <div class="col-md-6 p-4 rounded"
            style="background-color: #FFECCA; box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.15);">
            @if (session('checkout_value') == 'proceed_to_checkout')
                <div style="color: black" class="alert alert-info" role="alert">
                    Please log in to proceed to checkout.
                </div>
            @endif

            <div class="py-2" style="background-color: #FF914D; border-radius: 5px;">
                <h2 class="text-center mb-4" style="color: black;">User Login</h2>
                <p class="text-center">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="fw-semibold" style="color: white;">Sign Up</a>
                </p>
            </div>
            <form class="row g-3 mt-4" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="col-12 pb-2">
                    <label for="email" class="form-label fw-semibold">Email <span
                            class="text-danger">*</span></label>
                    <input type="email" class="form-control rounded-pill py-2" name="email"
                        style="border-radius: 5px;" placeholder="Enter your email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger fw-bold mt-1">{{ $message }}</div>
                    @enderror
                    @if (session('message'))
                        <div class="alert alert-{{ session('alert-type') }}">
                            @if (session('alert-type') == 'success')
                                <i class="fa fa-check-circle"></i>
                            @elseif (session('alert-type') == 'error')
                                <i class="fa fa-exclamation-circle"></i>
                            @endif
                            <strong>{{ session('message') }}</strong>
                        </div>
                    @endif
                </div>
                <div class="col-12">
                    <label for="password" class="form-label fw-semibold">Password <span
                            class="text-danger">*</span></label>
                    <input type="password" class="form-control rounded-pill py-2" style="border-radius: 5px;"
                        name="password" placeholder="Enter your password" required>
                </div>
                <div class="col-12 d-grid my-3">
                    <button type="submit" class="btn rounded-pill py-2"
                        style="background-color: #FF914D; border-radius: 5px;">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()

    function miniCart() {
        $.ajax({
            type: 'GET',
            url: '/product/mini/cart',
            dataType: 'json',
            success: function(response) {
                // alert(response);
                //checkout();
                $('span[id="cartSubTotal"]').text(response.cartTotal);
                $('#cartSubTotalShi').val(response.cartTotal);
                $('.cartQty').text(Object.keys(response.carts).length);
                $('#total_cart_qty').text(Object.keys(response.carts).length);

                var miniCart = "";

                if (Object.keys(response.carts).length > 0) {
                    $.each(response.carts, function(key, value) {
                        //console.log(value);
                        var slug = value.options.slug;
                        var base_url = window.location.origin;
                        miniCart += `

                            <div class="item-cart mb-20">
                                            <div class="cart-image"><img src="/${value.options.image}" alt="Ecom"></div>
                                    <div class="cart-info"><a class="font-sm-bold color-brand-3" href="${base_url}/product-details/${slug}">${value.name}</a>

                                <p><span class="color-brand-2 font-sm-bold">${value.qty} x ${value.price}</span></p>
                                <div class="shopping-cart-delete">
                                        <a  id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fi-rs-cross-small"></i></a>
                                    </div>
                            </div>
                        </div>`

                    });

                    $('#miniCart').html(miniCart);
                    $('#miniCart_empty_btn').hide();
                    $('#miniCart_btn').show();
                } else {
                    html = '<h4 class="text-center">Cart empty!</h4>';
                    $('#miniCart').html(html);
                    $('#miniCart_btn').hide();
                    $('#miniCart_empty_btn').show();
                }
            }
        });
    }
    /* ============ Function Call ========== */
    miniCart();
</script>
@endpush
