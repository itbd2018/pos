@extends('FrontEnd.master')
@section('title')
Checkout
@endsection
@section('content')
<style>
    .card-body * {
        color: rgb(22, 22, 22) !important;
    }
</style>
<!-- Header Start -->
{{-- <div class="container-fluid pt-3 pb-0 ">
    <div class="container bg-white py-3">
        <div class="row justify-content-left">
            <div class="col-lg-10 text-left">
                <h1 class="display-6 fw-bold text-dark">{{ get_setting('business_name')->value }}</h1>
                <div class="d-flex justify-content-left mt-3">
                    <p class="m-0"><a href="{{ route('home') }}">Home</a></p>
                    <p class="m-0 px-2">-</p>
                    <p class="m-0">Checkout</p>
                </div>
            </div>
        </div>
    </div>
</div> --}}


<div class="container-fluid pt-3 pb-0 ">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container bg-white py-3">
        <div class="box-cart-right cpn-m px-3">
            <h5 class="font-md-bold  text-dark mb-2">Apply Coupon</h5>
            <div class="form-group" style="margin-top: 11px;margin-bottom: 20px;">
                <form action="{{ route('apply-coupon') }}" class="d-flex" method="post">
                    @csrf
                    <input class="form-control mr-15 py-2" name="apply_coupon" placeholder="Enter Your Coupon"
                        style="width: 200px;">
                    <input type="hidden" name="cart_value" value="{{ $cartTotal }}">
                    <button type="submit" style="margin-left: 7px ; background-color:#FF914D;"
                        class="btn text-white ">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->



<!-- Check Out Information Start -->
<section class=" mt-3">
    {{-- <div class="row">
        <div class="mb-40">
            <h1 class="heading-2 mb-10">Checkout</h1>
            <div class="d-flex justify-content-between">
                <h6 class="text-body">There are <span class="text-brand" id="total_cart_qty"></span> products in your
                    cart</h6>
            </div>
        </div>
    </div> --}}
    <div class="container">
        <div class="row px-xl-0 lolu">


            <div class="col-lg-8 p-4 bg-white">
                <form action="{{ route('checkout.payment') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <h4 class="fw-semibold mb-4 text-dark">Billing Address</h4>
                        <div class="row g-3">
                       

                            <div class="col-md-12 form-group">
                                <label>Full Name</label><span class="text-danger" style="font-size: 20px;">*</span>
                                <input class="form-control" type="text" required="" id="name" name="name"
                                    placeholder="Full Name" value="{{ Auth::user()->name ?? old('name') }}">
                               
                            </div>
                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input class="form-control" id="email" type="email" name="email"
                                    placeholder="Email address" value="{{ Auth::user()->email ?? old('email') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Mobile No</label><span class="text-danger" style="font-size: 20px;">*</span>
                                <input class="form-control" required type="number" name="phone" placeholder="Phone"
                                    id="phone" value="{{ Auth::user()->phone ?? old('phone') }}">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Full Address</label><span class="text-danger" style="font-size: 20px;">*</span>
                                <textarea name="address" id="address" class="form-control" placeholder="Address"
                                    required>{{ old('address') }}</textarea>
                                @error('address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            {{-- <div class="col-md-6 form-group">
                                <label>Country</label>
                                <select class="form-control">
                                    <option selected>United States</option>
                                    <option>Bangladesh</option>
                                    <option>India</option>
                                    <option>Nepal</option>
                                    <option>Pakistan</option>
                                    <option>Sri-lanka</option>
                                    <option>Nowkhali</option>
                                </select>
                            </div> --}}
                            {{-- <div class="col-md-6 form-group">
                                <label>City</label>
                                <input class="form-control" type="text" placeholder="New York">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>State</label>
                                <input class="form-control" type="text" placeholder="New York">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>ZIP Code</label>
                                <input class="form-control" type="text" placeholder="123">
                            </div> --}}


                            {{-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Devision</label><span class="text-danger">*</span>
                                    <select class="form-control font-sm select-style1 color-gray-700" name="division_id"
                                        id="division_id" required>
                                        <option value="">Select Division</option>

                                        @foreach (get_divisions() as $division)
                                            <option value="{{ $division->id }}">
                                                {{ ucwords($division->division_name_en) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>District</label><span class="text-danger">*</span>
                                    <select class="form-control font-sm select-style1 color-gray-700" name="district_id"
                                        id="district_id" required>
                                        <option selected="" value="">Select District</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Upazila</label><span class="text-danger">*</span>
                                    <select class="form-control font-sm select-style1 color-gray-700" name="upazilla_id"
                                        id="upazilla_id" required>
                                        <option selected="" value="">Select Upazilla</option>
                                    </select>
                                </div>
                            </div> --}}
                            {{-- product shipping --}}
                            <div class="col-md-12 form-group">
                                <label>Product Shipping</label><span class="text-danger" style="font-size: 20px;">*</span>
                                <select class="form-control" name="shipping_id" id="shipping_id" required>
                                    <option value="">Select Shipping</option>
                                    @foreach ($shippings as $key => $shipping)
                                        <option value="{{ $shipping->id }}">
                                            @if ($shipping->type == 1)
                                                Inside Dhaka
                                            @else
                                                Outside Dhaka
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Payment Type Dropdown -->
                            {{-- <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Payment Type</label><span class="text-danger">*</span>
                                    <select class="form-control" name="payment_type" id="payment_type" required>
                                        <option value="">Select Payment Type</option>
                                        <option value="1">Onsite</option>
                                        <option value="3">Installment</option>
                                    </select>
                                </div>
                            </div> --}}

                            <!-- Installment Fields -->
                            <div class="col-lg-12" id="installment-fields" style="display: none;">
                                <div class="row">
                                    <!-- NID Information Section -->
                                    <div class="col-lg-12 form-group">
                                        <strong>NID Information</strong>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>NID Number</label><span class="text-danger">*</span>
                                            <input type="number" class="form-control" name="nid" id="nid" value="{{ old('nid') }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>NID Front Image</label><span class="text-danger">*</span>
                                            <input type="file" class="form-control" name="nid_front" id="nid_front" value="{{ old('nid_front') }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>NID Back Image</label><span class="text-danger">*</span>
                                            <input type="file" class="form-control" name="nid_back" id="nid_back" value="{{ old('nid_back') }}">
                                        </div>
                                    </div>

                                    <!-- Nominee Information Section -->
                                    <div class="col-lg-12 form-group">
                                        <strong>Nominee Information</strong>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nominee Name</label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" name="nominee_name"
                                                id="nominee_name" value="{{ old('nominee_name') }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nominee Relation</label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" name="nominee_relation"
                                                id="nominee_relation" value="{{ old('nominee_relation') }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Nominee NID Number</label><span class="text-danger">*</span>
                                            <input type="number" class="form-control" name="nominee_nid"
                                                id="nominee_nid" value="{{ old('nominee_nid') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12 form-group">
                                <label>Additional Information</label>
                                <textarea name="comment" class="form-control" id="comment"
                                    placeholder="Additional Information" rows="5">{{ old('comment') }}</textarea>
                                @error('address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group d-none">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" data-bs-toggle="collapse"
                                        data-bs-target="#shipping-address">
                                    <label class="custom-control-label" for="shipto" data-bs-toggle="collapse"
                                        data-bs-target="#shipping-address">Ship to different address</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="collapse mb-4" id="shipping-address">
                        <h4 class="font-weight-semi-bold mb-4">Shipping Address</h4>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>First Name</label>
                                <input class="form-control" type="text" placeholder="Sunny">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Last Name</label>
                                <input class="form-control" type="text" placeholder="Dewal">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input class="form-control" type="text" placeholder="example@email.com">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Mobile No</label>
                                <input class="form-control" type="text" placeholder="+88 01700 000000">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Address</label>
                                <input class="form-control" type="text" placeholder="Street">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Country</label>
                                <select class="form-control">
                                    <option selected>United States</option>
                                    <option>Bangladesh</option>
                                    <option>India</option>
                                    <option>Nepal</option>
                                    <option>Pakistan</option>
                                    <option>Sri-lanka</option>
                                    <option>Nowkhali</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>City</label>
                                <input class="form-control" type="text" placeholder="New York">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>State</label>
                                <input class="form-control" type="text" placeholder="New York">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>ZIP Code</label>
                                <input class="form-control" type="text" placeholder="123">
                            </div>

                        </div>
                    </div>

            </div>
            <div class="col-lg-4 pr-0 mt-3 mt-md-0 pl-0 pl-md-3">
                <div class="pb-1 bg-white">
                    <div class=" pt-3 px-3 text-dark">
                        <h4 class="fw-semibold m-0 text-dark">Order Total</h4>
                    </div>
                    <div class="card-body pb-0">
                        <h5 class="fw-semibold mb-3">Products</h5>
                        {{-- @php
                        dd($carts);
                        @endphp --}}
                        @foreach ($carts as $cart)
                            <div class="d-flex justify-content-between mb-1">
                                <p>{{ $cart->name }} x {{ $cart->qty }}</p>
                                <p>৳{{ $cart->subtotal }}</p>
                            </div>
                        @endforeach

                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">৳<span id="cartSubTotal">{{ $cartTotal }}</span></h6>
                        </div>

                        <div id="addonInformation" style="display:none;">
                            <!-- This will be dynamically updated by the script -->
                        </div>

                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">+৳<span id="ship_amount">0.00</span></h6>
                            <input type="hidden" value="" name="shipping_charge" class="ship_amount" />
                            <input type="hidden" value="" name="shipping_type" class="shipping_type" />
                            <input type="hidden" value="" name="shipping_name" class="shipping_name" />
                        </div>
                        @if (Session::get('couponCode'))
                            <input type="hidden" name="coupon" value="{{ $cartTotal }}">
                        @endif
                        <div id="couponInformation" style="margin-top: 13px;">
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent ">
                        <div class="d-flex justify-content-between my-2 px-2 px-md-0">
                            <input type="hidden" value="" name="shipping_charge" class="ship_amount" />
                            <input type="hidden" value="" name="shipping_type" class="shipping_type" />
                            <input type="hidden" value="" name="shipping_name" class="shipping_name" />
                            <input type="hidden" value="{{ $cartTotal }}" name="sub_total" id="cartSubTotalShi" />
                            <input type="hidden" value="" name="grand_total" id="grand_total" />
                            <h5 class="font-weight-bold text-dark">Total</h5>
                            <h5 class="font-weight-bold text-dark">৳<span id="grand_total_set">{{ $cartTotal }}</span>
                            </h5>
                        </div>
                    </div>

                </div>
                <div class="px-3 pb-1 bg-white">
                    <div class="card-header">
                        <h4 class="fw-semibold m-0 text-dark">Payment</h4>
                    </div>
                    <div class="card-body px-1 pb-0">
                        <div class="form-group">
                            <div class="custom-control custom-radio pl-0">
                                <input type="radio" class="custom-control-input" name="payment_option"
                                    id="cash_on_delivery" value="cod" checked>
                                <label class="custom-control-label" for="cash_on_delivery">Cash On Delivery</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="px-3 bg-white pb-3">
                    <button style="background-color:#FF914D;" type="submit"
                        class="btn btn-lg text-white d-block fw-semibold py-2 px-4 w-100">Place Order</button>

                </div>
            </div>
            </form>

        </div>

    </div>
</section>
@endsection
@push('js')
    <!--  Division To District Show Ajax -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('select[name="division_id"]').on('change', function () {
                var division_id = $(this).val();
                if (division_id) {
                    $.ajax({
                        url: 'division-district/ajax/',
                        type: "GET",
                        data: {
                            'division_id': division_id
                        },
                        dataType: "json",
                        success: function (data) {
                            // Reset district selection
                            $('select[name="district_id"]').html(
                                '<option value="" selected="" disabled="">Select District</option>'
                            );
                            // Populate district options
                            $.each(data, function (key, value) {
                                $('select[name="district_id"]').append(
                                    '<option value="' + value.id + '">' +
                                    capitalizeFirstLetter(value.district_name_en) +
                                    '</option>');
                            });
                            $('select[name="upazilla_id"]').html(
                                '<option value="" selected="" disabled="">Select Upazila</option>'
                            );
                        },
                    });
                } else {
                    // Reset district selection if division is not selected
                    $('select[name="district_id"]').html(
                        '<option value="" selected="" disabled="">Select District</option>');
                    $('select[name="upazilla_id"]').html(
                        '<option value="" selected="" disabled="">Select Upazila</option>');
                }
            });

            // Function to capitalize first letter of a string
            function capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }

            // Address Relationship Division/District/Upazilla Show Data Ajax
            $('select[name="address_id"]').on('change', function () {
                var address_id = $(this).val();
                $('.selected_address').removeClass('d-none');
                if (address_id) {
                    $.ajax({
                        url: "{{ url('/address/ajax') }}/" + address_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('#dynamic_division').text(capitalizeFirstLetter(data
                                .division_name_en));
                            $('#dynamic_division_input').val(data.division_id);
                            $("#dynamic_district").text(capitalizeFirstLetter(data
                                .district_name_en));
                            $('#dynamic_district_input').val(data.district_id);
                            $("#dynamic_upazilla").text(capitalizeFirstLetter(data
                                .upazilla_name_en));
                            $('#dynamic_upazilla_input').val(data.upazilla_id);
                            $("#dynamic_address").text(data.address);
                            $('#dynamic_address_input').val(data.address);
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>

    <!--  District To Upazilla Show Ajax -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('select[name="district_id"]').on('change', function () {
                var district_id = $(this).val();
                if (district_id) {
                    $.ajax({
                        url: '/district-upazilla/ajax/',
                        type: "GET",
                        data: {
                            'district_id': district_id
                        },
                        dataType: "json",
                        success: function (data) {
                            var d = $('select[name="upazilla_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="upazilla_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                        .name_en + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>

    <!-- create address ajax -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#addressStore').on('click', function () {
                var division_id = $('#division_id').val();
                var district_id = $('#district_id').val();
                var upazilla_id = $('#upazilla_id').val();
                var address = $('#address').val();
                var is_default = $('#is_default').val();
                var status = $('#status').val();

                $.ajax({
                    url: '{{ route('address.ajax.store') }}',
                    type: "POST",
                    data: {
                        _token: $("#csrf").val(),
                        division_id: division_id,
                        district_id: district_id,
                        upazilla_id: upazilla_id,
                        address: address,
                        is_default: is_default,
                        status: status,
                    },
                    dataType: 'json',
                    success: function (data) {
                        // console.log(data);
                        $('#address').val(null);

                        $('select[name="address_id"]').html(
                            '<option value="" selected="" disabled="">Select Address</option>'
                        );
                        $.each(data, function (key, value) {
                            $('select[name="address_id"]').append('<option value="' +
                                value.id + '">' + value.address + '</option>');
                        });
                        $('select[name="division_id"]').html(
                            '<option value="" selected="" disabled="">Select Division</option>'
                        );
                        $('select[name="district_id"]').html(
                            '<option value="" selected="" disabled="">Select District</option>'
                        );
                        $('select[name="upazilla_id"]').html(
                            '<option value="" selected="" disabled="">Select Upazila</option>'
                        );

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
                            Swal.fire({
                                type: 'error',
                                title: data.error
                            })
                        }

                        // End Message
                        $('#Close').click();
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            var couponApplied = false; // Track if the coupon has been applied

            // Listen to changes on the payment type dropdown
            $('select[name="payment_type"]').on('change', function () {
                var payment_type = $(this).val();

                if (payment_type === '3') { // Installment selected
                    $('#installment-fields').show();
                    showAddon(); // Add 5% addon
                    // $('#cash_on_delivery').closest('.custom-control').hide(); // Hide COD
                    // $('#sslcommerz').closest('.custom-control').show(); // Show sslcommerze
                } else { // Other payment types
                    $('#installment-fields').hide();
                    $('#addonInformation').hide();
                    $('#cash_on_delivery').closest('.custom-control').show(); // Show COD
                    //   $('#sslcommerz').closest('.custom-control').hide(); // Hide sslcommerze
                }
                updateTotalPrice();
            });

            // Function to calculate and display 5% addon for installments
            function showAddon() {
                var subtotal = parseFloat($('#cartSubTotal').text()) || 0;
                var addon = subtotal * 0.05;
                $('#addonInformation').html(`
                        <div class="d-flex justify-content-between mb-3">
                            <h6 class="font-weight-medium">Addon 5% (for installment)</h6>
                            <h6 class="font-weight-medium">+৳<span>${addon.toFixed(2)}</span></h6>
                        </div>
                    `).show();
            }

            // Coupon application logic
            $('form[action="{{ route('apply-coupon') }}"]').submit(function (event) {
                event.preventDefault();
                if (couponApplied) {
                    showToast('Coupon Already Used', 'error');
                    return;
                }

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (data) {
                        if (data.discount) {
                            var couponDiscount = parseFloat(data.discount) || 0;
                            $('#grand_total_set').attr('data-coupon-discount', couponDiscount);
                            $('#coupon_amount').text(`৳${couponDiscount.toFixed(2)}`);
                            couponApplied = true;
                            updateTotalPrice();
                            showCouponInformation(data);
                            showToast(data.success, 'success');
                        } else if (data.error) {
                            showToast(data.error, 'error');
                        }
                    },
                    error: function (xhr) {
                        var errorMsg = xhr.responseJSON?.error || 'Invalid Coupon Code';
                        showToast(errorMsg, 'error');
                    }
                });
            });

            // Listen to changes on the shipping dropdown
            $('select[name="shipping_id"]').on('change', function () {
                var shipping_id = $(this).val();

                if (shipping_id) {
                    $.ajax({
                        url: "{{ url('/checkout/shipping/ajax') }}/" + shipping_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('#ship_amount').text(data.shipping_charge);
                            $('.ship_amount').val(data.shipping_charge);
                            $('.shipping_name').val(data.name);
                            $('.shipping_type').val(data.type);
                            updateTotalPrice();
                        }
                    });
                } else {
                    resetShipping();
                    updateTotalPrice();
                }
            });

            // Reset shipping fields
            function resetShipping() {
                $('#ship_amount').text('0');
                $('.ship_amount, .shipping_name, .shipping_type').val('');
            }

            // Display coupon details
            function showCouponInformation(data) {
                $('#couponInformation').html(`
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Coupon</h6>
                            <h6 class="font-weight-medium">-৳<span>${data.discount}</span></h6>
                        </div>
                    `);
            }

            // Toast notification function
            function showToast(message, type) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: type,
                    title: message,
                    showConfirmButton: false,
                    timer: 2000
                });
            }

            // Update total price calculation
            function updateTotalPrice() {
                var product_price = parseFloat($('#cartSubTotalShi').val()) || 0;
                var shipping_price = parseFloat($('#ship_amount').text()) || 0;
                var couponDiscount = parseFloat($('#grand_total_set').attr('data-coupon-discount')) || 0;
                var addon = 0;

                if ($('select[name="payment_type"]').val() === '3') {
                    addon = product_price * 0.05;
                }

                var grand_total = product_price + addon + shipping_price - couponDiscount;
                $('#grand_total_set').text(grand_total.toFixed(2));
                $('#grand_total').val(grand_total.toFixed(2));
            }

            // Initial total price calculation on page load
            updateTotalPrice();
        });
    </script>

@endpush