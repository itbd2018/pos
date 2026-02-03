@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
            padding: 1rem 1.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .form-control {
            border-radius: 6px;
            border: 1px solid #ced4da;
            padding: 0.5rem 0.75rem;
        }

        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .col-form-label {
            color: #495057;
            font-weight: 600 !important;
        }

        .btn {
            border-radius: 6px;
            padding: 0.5rem 1rem;
            font-weight: 500;
        }

        .product-item {
            background-color: #fff;
            border-radius: 12px;
            border: 1px solid #e0e0e0 !important;
            margin-bottom: 2rem;
            padding: 2rem !important;
            transition: all 0.3s ease;
            position: relative;
        }

        .product-item:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-color: #80bdff !important;
        }

        .product-item .row {
            margin-bottom: 1rem;
        }

        .product_info_row {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
            margin-top: 1.5rem;
            border: 1px solid #e9ecef;
        }

        .product_info_row .col-md-3 {
            margin-bottom: 1.5rem;
        }

        .product-header {
            border-bottom: 2px solid #e9ecef;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
        }

        .form-control {
            height: calc(2.5rem + 2px);
            font-size: 1rem;
        }

        .form-select {
            height: calc(2.5rem + 2px);
        }

        .remove-product {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 6px;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-color: #ced4da;
        }

        .field-group {
            margin-bottom: 1.5rem;
        }

        .custom_select select {
            width: 100%;
            border-radius: 6px;
        }

        .text-danger {
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .product_info_row {
            background-color: #f8f9fa;
            border-radius: 6px;
            padding: 1rem;
            margin-top: 1rem;
        }
    </style>

    <section class="content-main">
        <div class="container-fluid py-4">
            <div class="row mb-4">
                <div class="col-md-10 mx-auto">
                    <div class="d-flex justify-content-between align-items-center bg-white p-4 rounded shadow-sm">
                        <h2 class="content-title h4 mb-0">Create Product Invoice</h2>
                        <a href="{{ route('product.all.invoice') }}" class="btn btn-primary d-flex align-items-center gap-2"
                            title="Product List">
                            <i class="fa fa-list"></i>
                            <span>View All Invoices</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <form method="post" action="{{ route('product.invoice.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    {{-- Invoice Number --}}
                                    <div class="col-md-6 mb-4" id="invoice_no_field">
                                        <label for="invoice_no" class="col-form-label text-primary">
                                            <i class="fa fa-file-text me-2"></i>Invoice Number
                                        </label>
                                        <div class="custom_select">
                                            <input class="form-control form-control-lg" id="invoice_no" type="text"
                                                name="invoice_no" placeholder="Enter invoice number"
                                                value="{{ old('invoice_no', $invoiceNo) }}" required>
                                            @error('invoice_no')
                                                <p class="text-danger mt-1"><i
                                                        class="fa fa-exclamation-circle me-1"></i>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Customer Select --}}
                                    <div class="col-md-6 mb-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label for="user_id" class="col-form-label" style="font-weight: bold;">Customer
                                                Name: <span class="text-danger">(Search customer)</span></label>
                                        </div>
                                        <div class="custom_select">
                                            <select class="form-control select-active w-100 form-select select-nice"
                                                name="user_id" id="user_id">
                                                <option value="" selected disabled>--Select Customer--</option>
                                                @foreach ($customers as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('user_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Users Data --}}
                                    <div class="col-md-6 mb-4" id="customer_name_field">
                                        <label for="customer_name" class="col-form-label"
                                            style="font-weight: bold;">Customer
                                            Name </label>
                                        <div class="custom_select">
                                            <input class="form-control" id="customer_name" type="text"
                                                name="customer_name" placeholder="Write customer name"
                                                value="{{ old('customer_name') }}">
                                            @error('customer_name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4" id="customer_phone_field">
                                        <label for="customer_phone" class="col-form-label"
                                            style="font-weight: bold;">Customer
                                            Phone</label>
                                        <div class="custom_select">
                                            <input class="form-control" id="customer_phone" type="text"
                                                name="customer_phone" placeholder="Write customer phone"
                                                value="{{ old('customer_phone') }}">
                                            @error('customer_phone')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4" id="customer_email_field">
                                        <label for="customer_email" class="col-form-label"
                                            style="font-weight: bold;">Customer
                                            Email</label>
                                        <div class="custom_select">
                                            <input class="form-control" id="customer_email" type="email"
                                                name="customer_email" placeholder="Write customer email"
                                                value="{{ old('customer_email') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4" id="customer_address_field">
                                        <label for="customer_address" class="col-form-label"
                                            style="font-weight: bold;">Customer
                                            Address</label>
                                        <div class="custom_select">
                                            <input class="form-control" id="customer_address" type="text"
                                                name="customer_address" placeholder="Write customer address"
                                                value="{{ old('customer_address') }}">

                                        </div>
                                    </div>
                                </div>


                            </div>



                            <hr>

                            {{-- Product Information Start --}}
                            <div class="card-header bg-light">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="h5 mb-0">
                                        <i class="fa fa-box me-2"></i>Product Information
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="product_container">
                                    @php
                                        $oldProducts = old('product_id', []);
                                        $productCount = count($oldProducts) > 0 ? count($oldProducts) : 1;
                                    @endphp
                                    @for ($index = 0; $index < $productCount; $index++)
                                        <div class="product-item shadow-sm">
                                            <div class="product-header">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h5 class="mb-0">Product #{{ $index + 1 }}</h5>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="button"
                                                            class="btn btn-outline-danger remove-product mt-2">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <label for="product_id_{{ $index }}"
                                                        class="col-form-label fw-bold">
                                                        <i class="fa fa-box me-2"></i>Product Name<span
                                                            class="text-danger ms-1">*</span>
                                                    </label>
                                                    <select
                                                        class="form-control select-active w-100 form-select select-nice product_select"
                                                        name="product_id[]" id="product_id_{{ $index }}" required>
                                                        <option disabled hidden
                                                            {{ !isset($oldProducts[$index]) ? 'selected' : '' }} readonly
                                                            value="">--Select Product--</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}"
                                                                {{ isset($oldProducts[$index]) && $oldProducts[$index] == $product->id ? 'selected' : '' }}>
                                                                {{ $product->name_en }} (Stock: {{ $product->stock_qty }})</option>
                                                        @endforeach
                                                    </select>
                                                    {{-- <select
                                                    class="form-control select-active w-100 form-select select-nice product_select"
                                                    name="product_id[]" id="product_id_{{ $index }}" required>
                                                    <option disabled hidden
                                                        {{ !isset($oldProducts[$index]) ? 'selected' : '' }}
                                                        value="">
                                                        --Select Product--
                                                    </option>
                                                    @foreach ($products as $product)
                                                        @foreach ($product->serialNumbers as $serial)
                                                            <option value="{{ $product->id }}"
                                                                {{ isset($oldProducts[$index]) && $oldProducts[$index] == $product->id ? 'selected' : '' }}>
                                                                {{ $serial->serial_number }} - {{ $product->name_en }}
                                                            </option>
                                                        @endforeach
                                                    @endforeach
                                                </select> --}}
                                                    @error("product_id.$index")
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- Product Information Details --}}
                                            <div class="row product_info_row"
                                                style="display: {{ isset($oldProducts[$index]) ? 'block' : 'none' }};">
                                                <div class="row g-3">
                                                    {{-- Product Code --}}
                                                    <div class="col-md-3 field-group">
                                                        <label for="product_code_{{ $index }}"
                                                            class="col-form-label fw-bold">
                                                            <i class="fa fa-barcode me-2"></i>Product Code
                                                        </label>
                                                        <div class="input-group">
                                                            <input type="text" name="product_code[]"
                                                                id="product_code_{{ $index }}"
                                                                class="form-control bg-light"
                                                                value="{{ old("product_code.$index") }}" readonly>
                                                            <span class="input-group-text"><i
                                                                    class="fa fa-lock"></i></span>
                                                        </div>
                                                    </div>
                                                    {{-- Serial Number --}}
                                                    <div class="col-md-3 mb-4 serial_number_field">
                                                        <label for="serial_number_{{ $index }}"
                                                            class="col-form-label fw-bold">Serial Number: <span
                                                                class="text-danger">(Un-Sold)</span> </label>
                                                        {{-- <div>
                                                    <input type="text" name="serial_number[]"
                                                        id="serial_number_{{ $index }}" class="form-control"
                                                        value="{{ old("serial_number.$index") }}" readonly>
                                                </div> --}}
                                                        <select name="serial_number[]"
                                                            class="form-control serial_number_select" required>
                                                            <option value="">--Select Serial Number--</option>
                                                        </select>
                                                    </div>
                                                    {{-- Regular Price --}}
                                                    <div class="col-md-3 mb-4" id="regular_price_field">
                                                        <label for="regular_price_{{ $index }}"
                                                            class="col-form-label" style="font-weight: bold;">Regular
                                                            Price:</label>
                                                        <div>
                                                            <input type="text" name="regular_price[]"
                                                                id="regular_price_{{ $index }}"
                                                                class="form-control"
                                                                value="{{ old("regular_price.$index") }}">
                                                        </div>
                                                    </div>
                                                    {{-- Discount Price --}}
                                                    <div class="col-md-3 mb-4" id="discount_price_field">
                                                        <label for="discount_price_{{ $index }}"
                                                            class="col-form-label" style="font-weight: bold;">Discount
                                                            Price:</label>
                                                        <div>
                                                            <input type="text" name="discount_price[]"
                                                                id="discount_price_{{ $index }}"
                                                                class="form-control"
                                                                value="{{ old("discount_price.$index") }}">
                                                        </div>
                                                    </div>
                                                    {{-- Quantity --}}
                                                    <div class="col-md-3 mb-4" id="quantity_field">
                                                        <label for="quantity_{{ $index }}" class="col-form-label"
                                                            style="font-weight: bold;">Quantity:</label>
                                                        <div>
                                                            <input type="number" min="1" name="quantity[]"
                                                                id="quantity_{{ $index }}" class="form-control"
                                                                value="{{ old('quantity.' . $index, 1) }}">
                                                        </div>
                                                    </div>
                                                    {{-- Tax --}}
                                                    <div class="col-md-3 mb-4" id="tax_field">
                                                        <label for="tax_{{ $index }}" class="col-form-label"
                                                            style="font-weight: bold;">Tax(%):</label>
                                                        <div>
                                                            <input type="text" name="tax[]"
                                                                id="tax_{{ $index }}" class="form-control"
                                                                value="{{ old("tax.$index") }}">
                                                        </div>
                                                    </div>
                                                    {{-- Total Price --}}
                                                    <div class="col-md-3 mb-4" id="total_price_field">
                                                        <label for="total_price_{{ $index }}"
                                                            class="col-form-label" style="font-weight: bold;">Total
                                                            Price:</label>
                                                        <div>
                                                            <input type="text" name="total_price[]"
                                                                id="total_price_{{ $index }}" class="form-control"
                                                                value="{{ old("total_price.$index") }}">
                                                        </div>
                                                    </div>
                                                    {{-- Paid Amount --}}
                                                    <div class="col-md-3 mb-4" id="paid_amount_field">
                                                        <label for="paid_amount_{{ $index }}"
                                                            class="col-form-label" style="font-weight: bold;">Paid
                                                            Amount:(Or Advance)</label>
                                                        <div>
                                                            <input type="text" name="paid_amount[]"
                                                                id="paid_amount_{{ $index }}" class="form-control"
                                                                value="{{ old("paid_amount.$index") }}">
                                                        </div>
                                                    </div>
                                                    {{-- Due Amount --}}
                                                    <div class="col-md-3 mb-4" id="due_amount_field">
                                                        <label for="due_amount_{{ $index }}"
                                                            class="col-form-label" style="font-weight: bold;">Due
                                                            Amount:</label>
                                                        <div>
                                                            <input type="text" name="due_amount[]"
                                                                id="due_amount_{{ $index }}" class="form-control"
                                                                value="{{ old("due_amount.$index") }}">
                                                        </div>
                                                    </div>
                                                    {{-- Due Date --}}
                                                    <div class="col-md-3 mb-4" id="due_date_field">
                                                        <label for="due_date_{{ $index }}" class="col-form-label"
                                                            style="font-weight: bold;">Due
                                                            Date:</label>
                                                        <div>
                                                            <input type="date" name="due_date[]"
                                                                id="due_date_{{ $index }}" class="form-control"
                                                                value="{{ old("due_date.$index") }}">
                                                        </div>
                                                    </div>
                                                    {{-- Shipping Cost --}}
                                                    <div class="col-md-3 mb-4" id="shipping_cost_field">
                                                        <label for="shipping_cost_{{ $index }}"
                                                            class="col-form-label" style="font-weight: bold;">Shipping
                                                            Cost:</label>
                                                        <div>
                                                            <input type="text" name="shipping_cost[]"
                                                                id="shipping_cost_{{ $index }}"
                                                                class="form-control"
                                                                value="{{ old("shipping_cost.$index", '0') }}">
                                                        </div>
                                                    </div>
                                                    {{-- COD Cost --}}
                                                    <div class="col-md-3 mb-4" id="cod_cost_field">
                                                        <label for="cod_cost_{{ $index }}" class="col-form-label"
                                                            style="font-weight: bold;">COD Cost:(Condition Charge)</label>
                                                        <div>
                                                            <input type="text" name="cod_cost[]"
                                                                id="cod_cost_{{ $index }}" class="form-control"
                                                                value="{{ old("cod_cost.$index", '0') }}">
                                                        </div>
                                                    </div>
                                                    {{-- Payment Status --}}
                                                    <div class="col-md-3 mb-4 payment_status_field">
                                                        <label for="payment_status_{{ $index }}"
                                                            class="col-form-label" style="font-weight: bold;">Payment
                                                            Status:</label>
                                                        <div class="custom_select">
                                                            <select
                                                                class="form-control select-active w-100 form-select select-nice"
                                                                name="payment_status[]"
                                                                id="payment_status_{{ $index }}">
                                                                <option value=""
                                                                    {{ !old("payment_status.$index") ? 'selected' : '' }}>
                                                                    --Select
                                                                    payment status--</option>
                                                                <option value="paid"
                                                                    {{ old("payment_status.$index") == 'paid' ? 'selected' : '' }}>
                                                                    Paid</option>
                                                                <option value="unpaid"
                                                                    {{ old("payment_status.$index") == 'unpaid' ? 'selected' : '' }}>
                                                                    Unpaid</option>
                                                                <option value="partial"
                                                                    {{ old("payment_status.$index") == 'partial' ? 'selected' : '' }}>
                                                                    Partial</option>
                                                            </select>
                                                            @error("payment_status.$index")
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- Payment Method --}}
                                                    <div class="col-md-3 mb-4 payment_methods_field">
                                                        <label for="payment_methods_{{ $index }}"
                                                            class="col-form-label" style="font-weight: bold;">Payment
                                                            Method:</label>
                                                        <div class="custom_select">
                                                            <select
                                                                class="form-control select-active w-100 form-select select-nice"
                                                                name="payment_methods[]"
                                                                id="payment_methods_{{ $index }}">
                                                                <option value=""
                                                                    {{ !old("payment_methods.$index") ? 'selected' : '' }}>
                                                                    --Select
                                                                    payment method--</option>
                                                                <option value="cash"
                                                                    {{ old("payment_methods.$index") == 'cash' ? 'selected' : '' }}>
                                                                    Cash</option>
                                                                <option value="credit_card"
                                                                    {{ old("payment_methods.$index") == 'credit_card' ? 'selected' : '' }}>
                                                                    Credit Card</option>
                                                                <option value="bank"
                                                                    {{ old("payment_methods.$index") == 'bank' ? 'selected' : '' }}>
                                                                    Bank Transfer</option>
                                                                <option value="bkash"
                                                                    {{ old("payment_methods.$index") == 'bkash' ? 'selected' : '' }}>
                                                                    Bkash</option>
                                                                <option value="nagad"
                                                                    {{ old("payment_methods.$index") == 'nagad' ? 'selected' : '' }}>
                                                                    Nagad</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    {{-- Payment Amount --}}
                                                    <div class="col-md-3 mb-4 amount_field">
                                                        <label for="amount_{{ $index }}" class="col-form-label"
                                                            style="font-weight: bold;">Payment
                                                            Amount:</label>
                                                        <div>
                                                            <input type="text" name="amount[]"
                                                                id="amount_{{ $index }}" class="form-control"
                                                                value="{{ old("amount.$index") }}" readonly>
                                                        </div>
                                                    </div>


                                                    {{-- Warranty --}}
                                                    <div class="col-md-3 mb-4 warranty_field">
                                                        <label for="warranty_{{ $index }}" class="col-form-label"
                                                            style="font-weight: bold;">Warranty Period:</label>
                                                        <div>
                                                            <input type="text" name="warranty[]"
                                                                id="warranty_{{ $index }}" class="form-control"
                                                                value="{{ old("warranty.$index") ?: '40 days, 3 Years Servicing' }}">
                                                        </div>
                                                    </div>

                                                    <div class="text-end">
                                                        <button type="button"
                                                            class="btn btn-danger remove-product mt-2">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                    @endfor
                                </div>
                            </div>
                            {{-- Product Information End --}}
                        </div>
                        <!-- card .// -->

                        <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
                            <button type="button" id="add_product"
                                class="btn btn-secondary d-flex align-items-center gap-2">
                                <i class="fa fa-plus"></i>
                                <span>Add Another Product</span>
                            </button>
                            <button type="submit" class="btn btn-primary btn-lg d-flex align-items-center gap-2">
                                <i class="fa fa-save"></i>
                                <span>Create Invoice</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
    </section>


@endsection

@push('footer-script')
    <script>
        $(document).ready(function() {
            $('#user_id').on('change', function() {
                let customerId = $(this).val();

                if (customerId) {
                    $.ajax({
                        url: '/admin/invoice/customers/' + customerId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#customer_name').val(data.name || '');
                            $('#customer_phone').val(data.phone || '');
                            $('#customer_email').val(data.email || '');
                            $('#customer_address').val(data.address || '');
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                            alert('Failed to fetch customer details!');
                        }
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            function calculateTotals($infoRow) {
                let quantity = parseFloat($infoRow.find('input[name="quantity[]"]').val()) || 1;
                if (quantity < 1) quantity = 1;

                let unitRegularPrice = parseFloat($infoRow.find('input[name="regular_price[]"]').val()) || 0;
                let unitDiscountPrice = parseFloat($infoRow.find('input[name="discount_price[]"]').val()) || 0;
                let taxPercent = parseFloat($infoRow.find('input[name="tax[]"]').val()) || 0;
                let shippingCost = parseFloat($infoRow.find('input[name="shipping_cost[]"]').val()) || 0;
                let codCost = parseFloat($infoRow.find('input[name="cod_cost[]"]').val()) || 0;
                let paidAmount = parseFloat($infoRow.find('input[name="paid_amount[]"]').val()) || 0;

                // Calculate total prices based on quantity
                let regularPrice = unitRegularPrice * quantity;
                let discountPrice = unitDiscountPrice * quantity;

                let basePrice = regularPrice - discountPrice;
                if (basePrice < 0) basePrice = 0;

                let taxAmount = basePrice * taxPercent / 100;

                // Total price including tax and shipping cost
                let totalPrice = basePrice + taxAmount + shippingCost + codCost;
                totalPrice = totalPrice.toFixed(2);

                // Update fields
                $infoRow.find('input[name="total_price[]"]').val(totalPrice);

                // Due amount
                let dueAmount = totalPrice - paidAmount;
                if (dueAmount < 0) dueAmount = 0;
                dueAmount = dueAmount.toFixed(2);
                $infoRow.find('input[name="due_amount[]"]').val(dueAmount);

                // Payment amount = paid amount
                $infoRow.find('input[name="amount[]"]').val(paidAmount ? paidAmount.toFixed(2) : '');
            }

            $(document).on('change', '.product_select', function() {
                let productId = $(this).val();
                let $productItem = $(this).closest('.product-item');
                let $infoRow = $productItem.find('.product_info_row');

                if (productId) {
                    $.ajax({
                        url: '/admin/invoice/get-product-details/' + productId,
                        type: 'GET',
                        success: function(data) {
                            $infoRow.show();

                            $infoRow.find('input[name="product_code[]"]').val(data
                                .product_code || '');
                            $infoRow.find('input[name="regular_price[]"]').val(data
                                .regular_price || '');
                            $infoRow.find('input[name="discount_price[]"]').val(data
                                .discount_price || '');
                            $infoRow.find('input[name="quantity[]"]').val(
                                1); // default quantity
                            // Auto-fill serial number
                            //$infoRow.find('input[name="serial_number[]"]').val(data
                            //    .serial_number || '');


                            // Populate serial numbers dropdown
                            let $serialSelect = $infoRow.find('select[name="serial_number[]"]');
                            $serialSelect.empty();
                            $serialSelect.append(
                                '<option value="">--Select Serial Number--</option>');
                            $.each(data.serial_numbers, function(index, serial) {
                                $serialSelect.append('<option value="' + serial + '">' +
                                    serial + '</option>');
                            });

                            // Clear other fields
                            $infoRow.find('input[name="tax[]"]').val('');
                            $infoRow.find('input[name="paid_amount[]"]').val('');
                            $infoRow.find('input[name="due_date[]"]').val('');
                            if (!$infoRow.find('input[name="shipping_cost[]"]').val()) {
                                $infoRow.find('input[name="shipping_cost[]"]').val('0');
                            }
                            if (!$infoRow.find('input[name="cod_cost[]"]').val()) {
                                $infoRow.find('input[name="cod_cost[]"]').val('0');
                            }
                            $infoRow.find('select[name="payment_status[]"]').val('');
                            $infoRow.find('select[name="payment_methods[]"]').val('');
                            $infoRow.find('input[name="amount[]"]').val('');
                            if (!$infoRow.find('input[name="warranty[]"]').val()) {
                                $infoRow.find('input[name="warranty[]"]').val(
                                    '40 days, 3 Years Servicing');
                            }

                            calculateTotals($infoRow);
                        },
                        error: function() {
                            alert('Failed to fetch product details!');
                            $infoRow.hide();
                        }
                    });
                } else {
                    $infoRow.hide();
                    $infoRow.find('input').val('');
                    $infoRow.find('select').val('');
                }
            });

            // Recalculate on quantity change
            $(document).on('input', 'input[name="quantity[]"]', function() {
                let $infoRow = $(this).closest('.product_info_row');
                calculateTotals($infoRow);
            });

            // Recalculate on price, tax, paid amount, shipping cost changes
            $(document).on('input',
                'input[name="tax[]"], input[name="paid_amount[]"], input[name="regular_price[]"], input[name="discount_price[]"], input[name="shipping_cost[]"], input[name="cod_cost[]"]',
                function() {
                    let $infoRow = $(this).closest('.product_info_row');
                    calculateTotals($infoRow);
                });

            // On page load, calculate totals for pre-selected products
            $('#product_container .product-item').each(function() {
                let selectedProduct = $(this).find('.product_select').val();
                if (selectedProduct) {
                    $(this).find('.product_select').trigger('change');
                }
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            let productIndex = $('#product_container .product-item').length || 1;

            $('#add_product').on('click', function() {
                let $first = $('#product_container .product-item:first');
                let $clone = $first.clone(false);

                $clone.find('input[type="text"], input[type="number"], textarea').val('');

                $clone.find('select').each(function() {
                    $(this).find('option').prop('selected', false);
                    $(this).val('');
                    if ($(this).attr('name') === 'product_id') {
                        $(this).find('option:first').prop('selected', true);
                    }
                    $(this).trigger('change');

                    if ($.fn.select2 && $(this).hasClass('select2-hidden-accessible')) {
                        $(this).select2('destroy');
                    }
                });

                $clone.find('[name]').each(function() {
                    let name = $(this).attr('name');
                    if (!name) return;
                    let newName = name.replace(/\[\d+\]/, '[' + productIndex + ']');
                    $(this).attr('name', newName);
                });

                $clone.find('[id]').each(function() {
                    let oldId = $(this).attr('id');
                    let newId = oldId + '_' + productIndex;
                    $(this).attr('id', newId);
                });

                $clone.find('label[for]').each(function() {
                    let oldFor = $(this).attr('for');
                    if (!oldFor) return;
                    $(this).attr('for', oldFor + '_' + productIndex);
                });

                $('#product_container').append($clone);

                if ($.fn.select2) {
                    $('#product_container .product-item:last').find('select').each(function() {
                        $(this).select2({
                            width: '100%'
                        });
                    });
                }

                productIndex++;
            });

            $(document).on('click', '.remove-product', function() {
                if ($('#product_container .product-item').length > 1) {
                    $(this).closest('.product-item').remove();
                } else {
                    alert('At least one product is required.');
                }
            });

        });
    </script>
@endpush
