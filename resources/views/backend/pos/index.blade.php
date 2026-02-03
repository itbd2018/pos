@extends('admin.admin_master')
@section('admin')
    @push('css')
        <style>
            .table {
                margin-bottom: 0.5rem;
            }

            .table > :not(caption) > * > * {
                padding: 0.3rem 0.6rem;
            }

            .product-price {
                font-size: 14px;
                font-weight: bold;
            }

            .product-thumb {
                cursor: pointer;
                flex: 0 0 25%;
                max-width: 25%;
            }

            .btn-circle {
                width: 32px;
                height: 32px;
                background-color: #dc3545;
                display: flex;
                align-items: center;
                justify-content: center;
                border: none;
                color: #fff;
                border-radius: 50%;
            }

            .material-icons {
                vertical-align: middle;
                font-size: 18px;
            }

            .select2-container--default .select2-selection--single {
                border-radius: 4px;
            }

            .select2-container--default {
                width: 100%;
            }

            .flex-grow-1 {
                margin-right: 10px;
            }

            .product_wrapper .card-body {
                padding: 0.8rem;
            }

            .text-primary {
                color: #007bff !important;
            }

            .card {
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .card-body {
                padding: 1rem;
            }

            .product-image img {
                width: 100%;
                height: 120px;
                object-fit: cover;
                border-radius: 4px;
            }

            .form-control, .form-select {
                border-radius: 4px;
                border: 1px solid #ced4da;
            }

            .btn {
                border-radius: 4px;
            }

            .btn-primary {
                background-color: #007bff;
                border-color: #007bff;
            }

            .btn-success {
                background-color: #28a745;
                border-color: #28a745;
            }

            .modal-content {
                border-radius: 8px;
            }

            .modal-header {
                background-color: #f8f9fa;
                border-bottom: 1px solid #dee2e6;
            }

            #checkout_list .list-group-item {
                border: none;
                padding: 0.5rem 0;
            }

            hr {
                margin: 0.5rem 0;
            }

            .text-primary{
                color: #FF914D !important;
            }
        </style>
    @endpush
    <section class="content-main">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <form>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <input class="form-control" type="text" name="search_term" id="search_term" placeholder="Search by Name" onkeyup="filter()">
                                </div>
                                <div class="col-md-4">
                                    <select name="category_id" id="category_id" class="form-select" onchange="filter()">
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name_en }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="brand_id" id="brand_id" class="form-select" onchange="filter()">
                                        <option value="">-- Select Brand --</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name_en }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row product_wrapper g-3" id="product_wrapper">
                    @foreach ($products as $product)
                        <input type="hidden" name="" id="discount{{ $product->id }}" value="{{ $product->discount_price }}">
                        <input type="hidden" name="" id="discount_type{{ $product->id }}" value="{{ $product->discount_type }}">
                        <input type="hidden" name="" id="product_name{{ $product->id }}" value="{{ $product->name_en }}">
                        @if ($product->is_varient == 1)
                            @foreach (\App\Models\ProductStock::where('product_id', $product->id)->get() as $variant)
                                <div class="col-md-3 col-sm-6 col-xs-12 product-thumb" onclick="addToList2({{ $variant->id }})">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <div class="product-image">
                                                @if ($product->product_thumbnail && $product->product_thumbnail != '' && $product->product_thumbnail != 'Null')
                                                    <img class="default-img" src="{{ asset($product->product_thumbnail) }}" alt="" />
                                                @else
                                                    <img class="default-img" src="{{ asset('upload/no_image.jpg') }}" alt="" />
                                                @endif
                                            </div>
                                            <p class="mt-2 mb-1" style="font-size: 14px; font-weight: bold; height: 40px; overflow: hidden;">
                                                {{ Str::limit(strip_tags(html_entity_decode($product->name_en)), 30, '...') }} ({{ $variant->varient }})
                                            </p>
                                            <div class="product-price">
                                                @if ($product->discount_price > 0)
                                                    @php
                                                        $price_after_discount = $product->discount_type == 1
                                                            ? $variant->price - $product->discount_price
                                                            : $variant->price - ($variant->price * $product->discount_price / 100);
                                                    @endphp
                                                    <del class="old-price text-muted me-2">৳{{ $variant->price }}</del>
                                                    <span class="price text-primary">৳{{ number_format($price_after_discount, 2) }}</span>
                                                @else
                                                    <span class="price text-primary">৳{{ $variant->price }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-3 col-sm-6 col-xs-12 product-thumb" onclick="addToList({{ $product->id }})">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="product-image">
                                            @if ($product->product_thumbnail && $product->product_thumbnail != '' && $product->product_thumbnail != 'Null')
                                                <img class="default-img" src="{{ asset($product->product_thumbnail) }}" alt="" />
                                            @else
                                                <img class="default-img" src="{{ asset('upload/no_image.jpg') }}" alt="" />
                                            @endif
                                        </div>
                                        <p class="mt-2 mb-1" style="font-size: 14px; font-weight: bold; height: 40px; overflow: hidden;">
                                            {{ Str::limit(strip_tags(html_entity_decode($product->name_en)), 30, '...') }}
                                        </p>
                                        <div class="product-price">
                                            @if ($product->discount_price > 0)
                                                @php
                                                    $price_after_discount = $product->discount_type == 1
                                                        ? $product->regular_price - $product->discount_price
                                                        : $product->regular_price - ($product->regular_price * $product->discount_price / 100);
                                                @endphp
                                                <del class="old-price text-muted me-2">৳{{ $product->regular_price }}</del>
                                                <span class="price text-primary">৳{{ number_format($price_after_discount, 2) }}</span>
                                            @else
                                                <span class="price text-primary">৳{{ $product->regular_price }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <form action="{{ route('pos.store') }}" method="POST">
                    @csrf
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <select name="customer_id" id="customer_id" class="form-select flex-grow-1 me-2" required>
                                    <option value="">-- Select Customer --</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#new-customer">
                                    <i class="material-icons md-person_add"></i>
                                </button>
                            </div>
                            <div id="checkout_list" class="mb-3">
                                <div class="text-center py-3" id="no_product_text">
                                    <span>No Product Added</span>
                                </div>
                            </div>
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Sub Total</td>
                                        <td class="text-end">৳ <span id="subtotal_text">0.00</span></td>
                                        <input type="hidden" id="subtotal" name="subtotal" value="0">
                                    </tr>
                                    <tr>
                                        <td>Tax (%)</td>
                                        <td class="text-end">৳ <span id="tax_amount_text">0.00</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="number" id="tax" name="tax" class="form-control" value="0" style="width: 100px; display: inline-block;">
                                            <input type="hidden" id="tax_amount" name="tax_amount" value="0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td class="text-end">৳ <span id="shipping_amount_text">0.00</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="number" id="shipping_charge" name="shipping_charge" class="form-control" value="0" style="width: 100px; display: inline-block;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td class="text-end">৳ <span id="discount_amount_text">0.00</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="number" id="discount" name="discount" class="form-control" value="0" style="width: 100px; display: inline-block;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <table class="table table-borderless">
                                <tbody>
                                    <tr class="fw-bold fs-5">
                                        <td>Total</td>
                                        <td class="text-end">৳ <span id="total_text">0.00</span></td>
                                        <input type="hidden" id="total" name="total" value="0">
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-end mt-3">
                                <input type="submit" class="btn btn-primary" value="Place Order">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <div class="modal fade" id="new-customer" tabindex="-1" aria-labelledby="new-customerLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="new-customerLabel">Create New Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('customer.ajax.store.pos') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="name" name="name" required placeholder="Customer Name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Phone <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Phone Number" id="phone" name="phone" required class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" placeholder="Email Address" id="email" name="email" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Address <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Address" id="address" name="address" required class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Profile Image</label>
                                <input name="profile_image" class="form-control" type="file" id="image">
                            </div>
                            <div class="col-12 text-center">
                                <img id="showImage" class="rounded-circle avatar-lg" src="{{ url('upload/no_image.jpg') }}" alt="Profile Image" style="width: 80px; height: 80px;">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer-script')
    
    




    <script>
        function calculateTotal() {

            let subtotal = parseFloat($('#subtotal').val()) || 0;
            let taxPercent = parseFloat($('#tax').val()) || 0;
            let shipping = parseFloat($('#shipping_charge').val()) || 0;
            let discount = parseFloat($('#discount').val()) || 0;

            // TAX calculation
            let taxAmount = (subtotal * taxPercent) / 100;

            // FINAL TOTAL
            let total =
                subtotal +
                taxAmount +
                shipping -
                discount;

            if (total < 0) total = 0;

            // UPDATE UI
            $('#subtotal_text').text(subtotal.toFixed(2));
            $('#tax_amount_text').text(taxAmount.toFixed(2));
            $('#shipping_amount_text').text(shipping.toFixed(2));
            $('#discount_amount_text').text(discount.toFixed(2));
            $('#total_text').text(total.toFixed(2));

            // UPDATE HIDDEN INPUTS
            $('#tax_amount').val(taxAmount.toFixed(2));
            $('#total').val(total.toFixed(2));
        }
    </script>
    <script>
        $('#tax, #shipping_charge, #discount').on('input', function() {
            calculateTotal();
        });
    </script>

    <script>
        

        function addToList(id) {
            var arr = $("input[name='product_id[]']")
                .map(function() {
                    return $(this).val();
                }).get();
            let index = $.inArray(id.toString(), arr);

            console.log(index);
            if (index != -1) {
                cart_increase(id);
            } else {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('pos.getProduct') }}',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        console.log(data);

                        // Start Sweertaleart Message
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1200
                        })

                        // if($.isEmptyObject(data.error)){
                        //     Toast.fire({
                        //       type:'success',
                        //       title: data.success
                        //     })
                        // }else{
                        //     Toast.fire({
                        //       type:'error',
                        //       title: data.error
                        //     })
                        // }
                        // Start Sweertaleart Message

                        if (data.stock_qty > 0) {
                            var price = parseFloat(data.regular_price);
                            if (parseFloat(data.discount_price) > 0) {
                                if (data.discount_type == 1) {
                                    price = parseFloat(data.regular_price - data.discount_price);
                                } else if (data.discount_type == 2) {
                                    price = parseFloat(data.regular_price - (data.regular_price * data
                                        .discount_price / 100));
                                }
                            }

                            var subtotal = parseFloat($('#subtotal').val());
                            var total = parseFloat($('#total').val());

                            subtotal = parseFloat(subtotal + price).toFixed(2);
                            total = parseFloat(total + price).toFixed(2);

                            $('#subtotal').val(subtotal);
                            $('#total').val(total);

                            $('#subtotal_text').html(subtotal);
                            $('#total_text').html(total);

                            $('#no_product_text').html('');

                            html = `<div id="${data.id}"><ul class="list-group list-group-flush">
                                <li class="list-group-item py-0 pl-2">
                                    <div class="row gutters-5 align-items-center">
                                        <div class="col-1">
                                            <div class="row no-gutters align-items-center flex-column aiz-plus-minus" style="width: 50px">
                                                <button class="btn btn-default" type="button" data-type="plus" data-field="qty-0" onclick="cart_increase(${data.id})">
                                                    <i class="material-icons md-plus"></i>
                                                </button>
                                                <input type="text" name="qty[]" id="qty${data.id}" class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1" value="1" min="1" max="999" onchange="updateQuantity(0)" readonly >
                                                <button class="btn btn-default" type="button" data-type="plus" data-field="qty-0" onclick="cart_decrease(${data.id})">
                                                    <i class="material-icons md-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-truncate-2">${data.name_en}</div>
                                            <input type="hidden" name="product_id[]" value="${data.id}">
                                        </div>
                                        <div class="col-3">
                                            <div class="fs-12 opacity-60">${price} x <span id="itemMultiplyQtyTxt${data.id}">1</span></div>
                                            <div class="fs-15 fw-600" id="itemTotalPriceTxt${data.id}">${price}</div>
                                            <input type="hidden" name="price[]" id="price${data.id}" value="${price}">
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn-circle" onclick="removeItem(${data.id})">
                                                <i class="material-icons md-delete"></i>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            </ul><hr><div>`;
                            $('#checkout_list').append(html);
                        } else {
                            const errorToast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            errorToast.fire({
                                title: 'Not Enough Stock'
                            });
                        }

                    }
                });
            }
        }

        function addToList2(id) {

            var arr = $("input[name='variant_id[]']")
                .map(function() {
                    return $(this).val();
                }).get();
            let index = $.inArray(id.toString(), arr);

            console.log(index);
            if (index != -1) {
                variant_cart_increase(id);
            } else {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('pos.getVariantProduct') }}',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        console.log(data);

                        // Start Sweertaleart Message
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1200
                        })

                        // if($.isEmptyObject(data.error)){
                        //     Toast.fire({
                        //       type:'success',
                        //       title: data.success
                        //     })
                        // }else{
                        //     Toast.fire({
                        //       type:'error',
                        //       title: data.error
                        //     })
                        // }
                        // Start Sweertaleart Message

                        if (data.qty > 0) {
                            var price = parseFloat(data.price);
                            var discount = $('#discount' + data.product_id).val();
                            var product_name = $('#product_name' + data.product_id).val();
                            var discount_type = $('#discount_type' + data.product_id).val();
                            if (parseFloat(discount) > 0) {

                                if (discount_type == 1) {
                                    price = parseFloat(data.price - discount);
                                } else if (discount_type == 2) {
                                    price = parseFloat(data.price - (data.price * discount / 100));
                                }
                            }

                            var subtotal = parseFloat($('#subtotal').val());
                            var total = parseFloat($('#total').val());

                            subtotal = parseFloat(subtotal + price).toFixed(2);
                            total = parseFloat(total + price).toFixed(2);

                            $('#subtotal').val(subtotal);
                            $('#total').val(total);

                            $('#subtotal_text').html(subtotal);
                            $('#total_text').html(total);

                            $('#no_product_text').html('');

                            html = `<div id="${data.id}"><ul class="list-group list-group-flush">
                                <li class="list-group-item py-0 pl-2">
                                    <div class="row gutters-5 align-items-center">
                                        <div class="col-1">
                                            <div class="row no-gutters align-items-center flex-column aiz-plus-minus" style="width: 50px">
                                                <button class="btn btn-default" type="button" data-type="plus" data-field="qty-0" onclick="variant_cart_increase(${data.id})">
                                                    <i class="material-icons md-plus"></i>
                                                </button>
                                                <input type="text" name="variant_qty[]" id="qty${data.id}" class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1" value="1" min="1" max="999" onchange="updateQuantity(0)" readonly >
                                                <button class="btn btn-default" type="button" data-type="plus" data-field="qty-0" onclick="cart_decrease(${data.id})">
                                                    <i class="material-icons md-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-truncate-2">${product_name} (${data.varient})</div>
                                            <input type="hidden" name="variant_id[]" value="${data.id}" id ="variant${data.id}">
                                        </div>
                                        <div class="col-3">
                                            <div class="fs-12 opacity-60">${price} x <span id="itemMultiplyQtyTxt${data.id}">1</span></div>
                                            <div class="fs-15 fw-600" id="itemTotalPriceTxt${data.id}">${price}</div>
                                            <input type="hidden" name="variant_price[]" id="price${data.id}" value="${price}" >
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn-circle" onclick="removeVariantItem(${data.id})">
                                                <i class="material-icons md-delete"></i>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            </ul><hr><div>`;
                            $('#checkout_list').append(html);
                        } else {
                            const errorToast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            errorToast.fire({
                                title: 'Not Enough Stock'
                            });
                        }

                    }
                });
            }
        }

        function removeItem(id) {
            var qty = parseInt($('#qty' + id).val());
            var price = parseFloat($('#price' + id).val());

            var subtotal = parseFloat($('#subtotal').val());
            var total = parseFloat($('#total').val());

            //alert(price);

            subtotal = parseFloat(subtotal - (price * qty)).toFixed(2);
            total = parseFloat(total - (price * qty)).toFixed(2);

            //alert(subtotal);


            $('#subtotal').val(subtotal);
            $('#total').val(total);

            $('#subtotal_text').html(subtotal);
            $('#total_text').html(total);

            $('#' + id).html('');
        }

        function removeVariantItem(id) {
            var qty = parseInt($('#qty' + id).val());
            var price = parseFloat($('#price' + id).val());

            var subtotal = parseFloat($('#subtotal').val());
            var total = parseFloat($('#total').val());

            //alert(price);

            subtotal = parseFloat(subtotal - (price * qty)).toFixed(2);
            total = parseFloat(total - (price * qty)).toFixed(2);

            //alert(subtotal);


            $('#subtotal').val(subtotal);
            $('#total').val(total);

            $('#subtotal_text').html(subtotal);
            $('#total_text').html(total);

            $('#' + id).html('');

            $('#variant' + id).val('');
            $('#price' + id).val('');
        }

        function cart_increase(id) {
            // alert(id);
            var qty = parseInt($('#qty' + id).val());

            $.ajax({
                type: 'GET',
                url: '{{ route('pos.getProduct') }}',
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(data) {
                    console.log(data);
                    if (qty + 1 <= data.stock_qty) {
                        var price = parseFloat($('#price' + id).val());
                        $('#qty' + id).val(qty + 1);
                        $('#itemMultiplyQtyTxt' + id).html(qty + 1);

                        var totalPrice = price * (qty + 1);
                        $('#itemTotalPriceTxt' + id).html(totalPrice);

                        var subtotal = parseFloat($('#subtotal').val());
                        var total = parseFloat($('#total').val());

                        subtotal = subtotal + price;
                        total = total + price;

                        $('#subtotal').val(subtotal);
                        $('#total').val(total);

                        $('#subtotal_text').html(subtotal);
                        $('#total_text').html(total);
                    } else {
                        const errorToast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        errorToast.fire({
                            title: 'Not Enough Stock'
                        });
                    }

                    // Start Sweertaleart Message


                }
            });
            product_wrapper

        }

        function variant_cart_increase(id) {
            // alert(id);
            var qty = parseInt($('#qty' + id).val());

            $.ajax({
                type: 'GET',
                url: '{{ route('pos.getVariantProduct') }}',
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(data) {
                    console.log(data.qty);
                    if (qty + 1 <= data.qty) {
                        var price = parseFloat($('#price' + id).val());
                        $('#qty' + id).val(qty + 1);
                        $('#itemMultiplyQtyTxt' + id).html(qty + 1);

                        var totalPrice = price * (qty + 1);
                        $('#itemTotalPriceTxt' + id).html(totalPrice);

                        var subtotal = parseFloat($('#subtotal').val());
                        var total = parseFloat($('#total').val());

                        subtotal = subtotal + price;
                        total = total + price;

                        $('#subtotal').val(subtotal);
                        $('#total').val(total);

                        $('#subtotal_text').html(subtotal);
                        $('#total_text').html(total);
                    } else {
                        const errorToast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        errorToast.fire({
                            title: 'Not Enough Stock'
                        });
                    }

                    // Start Sweertaleart Message


                }
            });


        }

        function cart_decrease(id) {
            var qty = parseInt($('#qty' + id).val());
            if (qty > 1) {
                $('#qty' + id).val(qty - 1);

                var price = parseFloat($('#price' + id).val());
                $('#itemMultiplyQtyTxt' + id).html(qty - 1);

                var totalPrice = price * (qty - 1);
                $('#itemTotalPriceTxt' + id).html(totalPrice);

                var subtotal = parseFloat($('#subtotal').val());
                var total = parseFloat($('#total').val());

                subtotal = parseFloat(subtotal - price).toFixed(2);
                total = parseFloat(total - price).toFixed(2);

                $('#subtotal').val(subtotal);
                $('#total').val(total);

                $('#subtotal_text').html(subtotal);
                $('#total_text').html(total);
            }
        }

        function filter() {
            // console.log($('#search_term').val());
            var search_term = $('#search_term').val();
            var category_id = $('#category_id').val();
            var brand_id = $('#brand_id').val();

            var url = '{{ route('pos.filter') }}';
            // var search_status = 0;
            // if(search_term){
            //     if (/\S/.test(search_term)) {
            //         search_term = search_term.replace(/^\s+/g, '');
            //         search_term = search_term.replace(/\s+$/g, '');
            //         url += '&search_term='+search_term;
            //         //alert( '--'+search_term+'--' );
            //         search_status = 1;
            //     }
            // }
            // if(category_id){
            //     url += '&category_id='+category_id;
            //     //alert( category_id );
            //     search_status = 1;
            // }
            // if(brand_id){
            //     url += '&brand_id='+brand_id;
            //     //alert( brand_id );
            //     search_status = 1;
            // }
            //
            // if(search_status == 0){
            //     url = '/admin/pos/get-products';
            // }

            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                data: {
                    search_term: search_term,
                    brand_id: brand_id,
                    category_id: category_id,
                },
                success: function(data) {
                    console.log('variants: ')
                    console.log(data);
                    var html = '';
                    if (Object.keys(data).length > 0) {
                        $.each(data, function(key, value) {
                            var product_name = value.name_en;
                            product_name = product_name.slice(0, 30) + (product_name.length > 30 ?
                                "..." : "");
                            html +=
                                `<input type="hidden" name="" id="discount${value.id}" value="${value.discount_price}">
                                    <input type="hidden" name="" id="discount_type${value.id}" value="${value.discount_type}">
                                        <input type="hidden" name="" id="product_name${value.id}" value="${value.name_en}">`;
                            if (value.is_varient == 1) {
                                $.ajax({
                                    type: 'GET',
                                    url: '{{ route('pos.getProductVariations') }}',
                                    dataType: 'json',
                                    data: {
                                        id: value.id
                                    },
                                    success: function(data) {
                                        console.log(data);
                                        $.each(data, function(key, data) {


                                            var price_after_discount = data.price;
                                            if (value.discount_type == 1) {
                                                price_after_discount = data.price -
                                                    value.discount_price;
                                            } else if (value.discount_type == 2) {
                                                price_after_discount = data.price -
                                                    (data.price * value
                                                        .discount_price / 100);
                                            }

                                            html += `<div class="col-sm-2 col-xs-6 product-thumb" onclick="addToList2(${data.id})">
                                                    <div class="card mb-4">
                                                        <div class="card-body">
                                                            <div class="product-image">`;
                                            if (value.product_thumbnail && value
                                                .product_thumbnail != '' && value
                                                .product_thumbnail != 'Null') {
                                                html +=
                                                    `<img class="default-img" src="/${value.product_thumbnail}" alt="" />`;
                                            } else {
                                                html +=
                                                    `<img class="default-img" src="/upload/no_image.jpg" alt="" />`;
                                            }
                                            html += `</div>
                                                            <p style="font-size: 10px; font-weight: bold; line-height: 15px; height: 40px;">
                                                                ${product_name} (${data.varient})
                                                            </p>
                                                            <div>`;
                                            if (value.discount_price > 0) {

                                                html += `<div class="product-price">
                                                                            <del class="old-price">৳ ${data.price }</del>
                                                                            <span class="price text-primary">৳ ${price_after_discount }</span>
                                                                        </div>`;
                                            } else {
                                                html += `<div class="product-price">
                                                                            <span class="price text-primary">৳ ${data.price }</span>
                                                                        </div>`;
                                            }
                                            html += `</div>
                                                        </div>
                                                    </div>
                                                </div>`;
                                        })
                                        $('#product_wrapper').html(html);
                                    }
                                });
                            } else {
                                // var product_name = value.name_en;
                                // product_name = product_name.slice(0, 30) + (product_name.length > 30 ? "..." : "");

                                var price_after_discount = value.regular_price;
                                if (value.discount_type == 1) {
                                    price_after_discount = value.regular_price - value.discount_price;
                                } else if (value.discount_type == 2) {
                                    price_after_discount = value.regular_price - (value.regular_price *
                                        value.discount_price / 100);
                                }

                                html += `<div class="col-sm-2 col-xs-6 product-thumb" onclick="addToList(${value.id})">
                                            <div class="card mb-4">
                                                <div class="card-body">
                                                    <div class="product-image">`;
                                if (value.product_thumbnail && value.product_thumbnail != '' && value
                                    .product_thumbnail != 'Null') {
                                    html +=
                                        `<img class="default-img" src="/${value.product_thumbnail}" alt="" />`;
                                } else {
                                    html +=
                                        `<img class="default-img" src="/upload/no_image.jpg" alt="" />`;
                                }
                                html += `</div>
                                                    <p style="font-size: 10px; font-weight: bold; line-height: 15px; height: 30px;">
                                                        ${product_name}
                                                    </p>
                                                    <div>`;
                                if (value.discount_price > 0) {

                                    html += `<div class="product-price">
                                                                    <del class="old-price">৳ ${value.regular_price }</del>
                                                                    <span class="price text-primary">৳ ${price_after_discount }</span>
                                                                </div>`;
                                } else {
                                    html += `<div class="product-price">
                                                                    <span class="price text-primary">৳ ${value.regular_price }</span>
                                                                </div>`;
                                }
                                html += `</div>
                                                </div>
                                            </div>
                                        </div>`;
                            }

                        });
                    } else {
                        html = '<div class="text-center"><p>No products found!</p></div>'
                    }
                    $('#product_wrapper').html(html);
                }
            });
        };
    </script>
@endpush
