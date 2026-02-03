@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <section class="content-main">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="content-header">
                    <h2 class="content-title">Create Product Invoice</h2>
                    <div>
                        <a href="{{ route('product.all.invoice') }}" class="btn btn-primary px-3" title="Product List">
                            <i class="fa fa-list" style="margin-top: 3px"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 mx-auto">
                <form method="post" action="{{ route('store.unexciting.product.invoice') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            {{-- Invoice Number --}}
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="col-form-label fw-bold">Invoice Number</label>
                                    <input class="form-control" type="text" name="invoice_no"
                                        value="{{ old('invoice_no', $invoiceNo) }}" required>
                                </div>

                                {{-- Customer --}}
                                <div class="col-md-6 mb-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label class="col-form-label fw-bold">Customer Name:</label>
                                        <button type="button" class="btn btn-success" data-bs-target="#new-customer"
                                            data-bs-toggle="modal">
                                            Add Customer
                                        </button>
                                    </div>
                                    <div class="custom_select">
                                        <select class="form-control select-active w-100 form-select select-nice"
                                            name="user_id" id="user_id">
                                            <option {{ old('user_id') ? '' : 'selected' }} readonly value="">
                                                --Select Customer--</option>
                                            @foreach ($customers as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- PRODUCT SECTION --}}
                    <hr>
                    <h3>Product Information</h3>

                    <div id="products-container">
                        {{-- First product row --}}
                        <div class="product-item border rounded p-3 mb-3" data-index="0">
                            @include('backend.product_invoice.partials.product_fields', ['index' => 0])
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="button" id="add_product" class="btn btn-secondary">Add Product</button>
                    </div>

                    <div class="row mb-4 justify-content-sm-end">
                        <div class="col-lg-2 col-md-4 col-sm-5 col-6">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    
     {{-- customer create modal --}}
    <div class="modal fade" id="new-customer" tabindex="-1" aria-labelledby="new-customerLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header card-header">
                    <h3>Customer Create</h3>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id=""
                        action="{{ route('customer.ajax.store.pos') }}">
                        @csrf
                        {{--                    <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}"> --}}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label class="col-form-label" style="font-weight: bold;">Name: <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="name" name="name" required
                                        placeholder="Write Customer Name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label class="col-form-label" style="font-weight: bold;">Phone: <span
                                            class="text-danger">*</span></label>
                                    <input type="text" placeholder="Write Phone" id="phone" name="phone"
                                        required class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label class="col-form-label" style="font-weight: bold;">Email:</label>
                                    <input type="email" placeholder="Write Email" id="email" name="email"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label class="col-form-label" style="font-weight: bold;">Address: <span
                                            class="text-danger">*</span></label>
                                    <input type="text" placeholder="Write Address" id="address" name="address"
                                        required class="form-control">
                                </div>
                            </div>
                            <div class="mb-1 mt-2">
                                <img id="showImage" class="rounded avatar-lg"
                                    src="{{ !empty($editData->profile_image) ? url('upload/admin_images/' . $editData->profile_image) : url('upload/no_image.jpg') }}"
                                    alt="Card image cap" width="100px" height="80px;">
                            </div>
                            <div class="mb-1">
                                <label for="image" class="col-form-label" style="font-weight: bold;">Profile
                                    Image:</label>
                                <input name="profile_image" class="form-control" type="file" id="image">
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="Close" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

   @push('footer-script')
<script>
    $(document).ready(function() {
        let productIndex = 1; // Next product index

        // Add Product
        $('#add_product').click(function() {
            let template = @json(view('backend.product_invoice.partials.product_fields', ['index' => '__INDEX__'])->render());
            template = template.replace(/__INDEX__/g, productIndex);
            $('#products-container').append(
                '<div class="product-item border rounded p-3 mb-3" data-index="' + productIndex + '">' +
                template + '</div>'
            );
            productIndex++;
        });

        // Remove Product
        $(document).on('click', '.remove-product', function() {
            $(this).closest('.product-item').remove();
        });
    });
</script>

<script>
    $(document).ready(function() {
        function calculateRow(row) {
            let quantity = parseFloat(row.find('input[name="quantity[]"]').val()) || 1;
            if (quantity < 1) quantity = 1;

            let unitRegularPrice = parseFloat(row.find('input[name="regular_price[]"]').val()) || 0;
            let unitDiscountPrice = parseFloat(row.find('input[name="discount_price[]"]').val()) || 0;
            let taxPercent = parseFloat(row.find('input[name="tax[]"]').val()) || 0;
            let paidAmount = parseFloat(row.find('input[name="paid_amount[]"]').val()) || 0;
            let shippingCost = parseFloat(row.find('input[name="shipping_cost[]"]').val()) || 0;

            // Step 1: Multiply unit prices by quantity
            let regularPrice = unitRegularPrice * quantity;
            let discountPrice = unitDiscountPrice * quantity;

            // Step 2: Calculate base price after discount
            let totalPrice = regularPrice - discountPrice;
            if (totalPrice < 0) totalPrice = 0;

            // Step 3: Apply tax
            if (taxPercent > 0) {
                totalPrice += (totalPrice * taxPercent / 100);
            }

            // Step 4: Add shipping cost
            totalPrice += shippingCost;

            // Step 5: Update Total Price
            row.find('input[name="total_price[]"]').val(totalPrice.toFixed(2));

            // Step 6: Calculate due amount
            let dueAmount = totalPrice - paidAmount;
            if (dueAmount < 0) dueAmount = 0;
            row.find('input[name="due_amount[]"]').val(dueAmount.toFixed(2));

            // Step 7: Set payment amount = paid amount
            row.find('input[name="amount[]"]').val(paidAmount ? paidAmount.toFixed(2) : '');
        }

        // Trigger recalculation on input change
        $(document).on('input',
            'input[name="quantity[]"], input[name="regular_price[]"], input[name="discount_price[]"], input[name="tax[]"], input[name="paid_amount[]"], input[name="shipping_cost[]"]',
            function() {
                let row = $(this).closest('.row'); // Find the row of current product
                calculateRow(row);
            }
        );
    });
</script>
@endpush
@endsection
