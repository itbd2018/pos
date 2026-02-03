@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <section class="content-main">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="content-header">
                    <h2 class="content-title">Edit Product Invoice</h2>
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
                <form method="post" action="{{ route('product.invoice.update', $invoices->first()->invoice_no) }}">
                    @csrf


                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                {{-- Invoice Number --}}
                                <div class="col-md-6 mb-4">
                                    <label class="col-form-label" style="font-weight: bold;">Invoice Number</label>
                                    <input class="form-control" type="text" name="invoice_no"
                                        value="{{ $invoices->first()->invoice_no }}" readonly>
                                </div>

                                {{-- Customer Name --}}
                                <div class="col-md-6 mb-4">
                                    <label class="col-form-label" style="font-weight: bold;">Customer Name </label>
                                    <select class="form-control select-active w-100" name="user_id" id="user_id"
                                        onfocus="this.dataset.selectedIndex=this.selectedIndex;"
                                        onchange="this.selectedIndex=this.dataset.selectedIndex;">
                                        <option value="">--Select Customer--</option>
                                        @foreach ($customers as $user)
                                            <option value="{{ $user->id }}"
                                                {{ $invoices->first()->user_id == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Users Data --}}
                                <div class="col-md-6 mb-4" id="customer_name_field">
                                    <label for="customer_name" class="col-form-label" style="font-weight: bold;">Customer
                                        Name </label>
                                    <div class="custom_select">
                                        <input class="form-control" id="customer_name" type="text" name="customer_name"
                                            placeholder="Write customer name" value="{{ $invoices->first()->name }}"
                                            required>
                                        @error('customer_name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4" id="customer_phone_field">
                                    <label for="customer_phone" class="col-form-label" style="font-weight: bold;">Customer
                                        Phone</label>
                                    <div class="custom_select">
                                        <input class="form-control" id="customer_phone" type="text" name="customer_phone"
                                            placeholder="Write customer phone" value="{{ $invoices->first()->phone }}"
                                            required>
                                        @error('customer_phone')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4" id="customer_email_field">
                                    <label for="customer_email" class="col-form-label" style="font-weight: bold;">Customer
                                        Email</label>
                                    <div class="custom_select">
                                        <input class="form-control" id="customer_email" type="email" name="customer_email"
                                            placeholder="Write customer email" value="{{ $invoices->first()->email }}">
                                        @error('customer_email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4" id="customer_address_field">
                                    <label for="customer_address" class="col-form-label" style="font-weight: bold;">Customer
                                        Address</label>
                                    <div class="custom_select">
                                        <input class="form-control" id="customer_address" type="text"
                                            name="customer_address" placeholder="Write customer address"
                                            value="{{ $invoices->first()->address }}">
                                        @error('customer_address')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- Product Information --}}
                        <hr>
                        <div class="card-header">
                            <h3>Product Information</h3>
                        </div>

                        <div class="card-body">
                            <div id="product_container">
                                @foreach ($invoices as $index => $invoice)
                                    <div class="product-item border p-3 mb-3">
                                        <div class="row">
                                            {{-- Product select --}}
                                            @if ($invoice->product_id)
                                                <div class="col-md-12 mb-4">
                                                    <label class="col-form-label" style="font-weight: bold;">Product
                                                        Name</label>

                                                    <select class="form-control" name="product_id[]"
                                                        onfocus="this.dataset.selectedIndex=this.selectedIndex;"
                                                        onchange="this.selectedIndex=this.dataset.selectedIndex;">
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}"
                                                                {{ $invoice->product_id == $product->id ? 'selected' : '' }}>
                                                               {{ $product->name_en }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @else
                                                <div class="col-md-12 mb-4">
                                                    <label class="col-form-label" style="font-weight: bold;">Product
                                                        Name</label>
                                                    <input type="text" name="product_name[]" class="form-control"
                                                        value="{{ $invoice->product_name }}" required>
                                                </div>

                                                {{-- Description --}}
                                                <div class="col-md-12 mb-4">
                                                    <label class="col-form-label fw-bold">Description </label>
                                                    <textarea name="product_description[]" class="form-control summernote" rows="2">{!! $invoice->product_description !!}</textarea>
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Product info row --}}
                                        <div class="row product_info_row">
                                            <div class="col-md-3 mb-4">
                                                <label class="col-form-label">Product Code</label>
                                                <input type="text" name="product_code[]" class="form-control"
                                                    value="{{ $invoice->product_code }}">
                                            </div>
                                            <div class="col-md-3 mb-4">
                                                <label class="col-form-label">Serial Number <span class="text-danger">(Un-Sold)</span></label>
                                                {{-- <input type="text" name="serial_number[]" class="form-control"
                                                    value="{{ $invoice->serial_number }}"> --}}
                                                <select name="serial_number[]" class="form-control serial_number_select"
                                                    required>
                                                    {{-- Placeholder --}}
                                                    <option value="">--Select Serial Number--</option>

                                                    {{-- Already saved serial number --}}
                                                    @if (!empty($invoice->serial_number))
                                                        <option value="{{ $invoice->serial_number }}" selected>
                                                            {{ $invoice->serial_number }}</option>
                                                    @endif

                                                    {{-- Other available serial numbers of this product --}}
                                                    @foreach ($invoice->product->serialNumbers as $serial)
                                                        {{-- Skip the already selected one --}}
                                                        @if ($serial->serial_number != $invoice->serial_number)
                                                            <option value="{{ $serial->serial_number }}">
                                                                {{ $serial->serial_number }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="col-md-3 mb-4">
                                                <label class="col-form-label">Regular Price</label>
                                                <input type="text" name="regular_price[]" class="form-control"
                                                    value="{{ $invoice->regular_price }}">
                                            </div>

                                            <div class="col-md-3 mb-4">
                                                <label class="col-form-label">Discount Price</label>
                                                <input type="text" name="discount_price[]" class="form-control"
                                                    value="{{ $invoice->discount_price }}">
                                            </div>

                                            <div class="col-md-3 mb-4">
                                                <label class="col-form-label">Quantity</label>
                                                <input type="number" min="1" name="quantity[]"
                                                    class="form-control" value="{{ $invoice->quantity }}">
                                            </div>

                                            <div class="col-md-3 mb-4">
                                                <label class="col-form-label">Tax (%)</label>
                                                <input type="text" name="tax[]" class="form-control"
                                                    value="{{ $invoice->tax }}">
                                            </div>

                                            <div class="col-md-3 mb-4">
                                                <label class="col-form-label">Total Price</label>
                                                <input type="text" name="total_price[]" class="form-control"
                                                    value="{{ $invoice->total_price }}">
                                            </div>

                                            <div class="col-md-3 mb-4">
                                                <label class="col-form-label">Paid Amount</label>
                                                <input type="text" name="paid_amount[]" class="form-control"
                                                    value="{{ $invoice->paid_amount }}">
                                            </div>

                                            <div class="col-md-3 mb-4">
                                                <label class="col-form-label">Due Amount</label>
                                                <input type="text" name="due_amount[]" class="form-control"
                                                    value="{{ $invoice->due_amount }}">
                                            </div>

                                            <div class="col-md-3 mb-4">
                                                <label class="col-form-label">Due Date</label>
                                                <input type="date" name="due_date[]" class="form-control"
                                                    value="{{ $invoice->due_date }}">
                                            </div>

                                            <div class="col-md-3 mb-4">
                                                <label class="col-form-label">Shipping Cost</label>
                                                <input type="text" name="shipping_cost[]" class="form-control"
                                                    value="{{ $invoice->shipping_cost }}">
                                            </div>
                                            <div class="col-md-3 mb-4">
                                                <label class="col-form-label">COD Cost</label>
                                                <input type="text" name="cod_cost[]" class="form-control"
                                                    value="{{ $invoice->cod_cost }}">
                                            </div>

                                            <div class="col-md-3 mb-4">
                                                <label class="col-form-label">Payment Status</label>
                                                <select name="payment_status[]" class="form-control">
                                                    <option value="">--Select--</option>
                                                    <option value="paid"
                                                        {{ $invoice->payment_status == 'paid' ? 'selected' : '' }}>Paid
                                                    </option>
                                                    <option value="unpaid"
                                                        {{ $invoice->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid
                                                    </option>
                                                    <option value="partial"
                                                        {{ $invoice->payment_status == 'partial' ? 'selected' : '' }}>
                                                        Partial</option>
                                                </select>
                                            </div>

                                            @foreach ($invoice->payments as $payment)
                                                <div class="col-md-3 mb-3">
                                                    <label class="col-form-label">Payment Method</label>
                                                    <select name="payment_methods[{{ $invoice->id }}][]"
                                                        class="form-control">
                                                        <option value="">--Select--</option>
                                                        <option value="cash"
                                                            {{ $payment->payment_method == 'cash' ? 'selected' : '' }}>Cash
                                                        </option>
                                                        <option value="credit_card"
                                                            {{ $payment->payment_method == 'credit_card' ? 'selected' : '' }}>
                                                            Credit Card</option>
                                                        <option value="bank"
                                                            {{ $payment->payment_method == 'bank' ? 'selected' : '' }}>Bank
                                                            Transfer</option>
                                                        <option value="bkash"
                                                            {{ $payment->payment_method == 'bkash' ? 'selected' : '' }}>
                                                            Bkash</option>
                                                        <option value="nagad"
                                                            {{ $payment->payment_method == 'nagad' ? 'selected' : '' }}>
                                                            Nagad</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                    <label class="col-form-label">Payment Amount <span
                                                            class="text-danger">*</span> </label>
                                                    <input type="text" name="amount[{{ $invoice->id }}][]"
                                                        class="form-control" value="{{ $payment->amount }}">
                                                </div>
                                            @endforeach


                                            <div class="col-md-3 mb-4">
                                                <label class="col-form-label">Warrnty Period</label>
                                                <input type="text" name="warrenty[]" class="form-control"
                                                    value="{{ $invoice->warrenty }}">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                    {{-- <div class="mb-3">
                    <button type="button" id="add_product" class="btn btn-secondary">Add Product</button>
                </div> --}}

                    <div class="row mb-4 justify-content-sm-end">
                        <div class="col-lg-2 col-md-4 col-sm-5 col-6">
                            <input type="submit" class="btn btn-primary" value="Update">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('footer-script')
    <script>
        $(document).ready(function() {
            // For each product-item, set up listeners
            $('#product_container').on('input',
                '.product_info_row input[name^="regular_price"], .product_info_row input[name^="discount_price"], .product_info_row input[name^="tax"], .product_info_row input[name^="paid_amount"], .product_info_row input[name^="shipping_cost"], .product_info_row input[name^="cod_cost"], .product_info_row input[name^="quantity"]',
                function() {
                    var $row = $(this).closest('.product_info_row');
                    var regular = parseFloat($row.find('input[name^="regular_price"]').val()) || 0;
                    var discount = parseFloat($row.find('input[name^="discount_price"]').val()) || 0;
                    var tax = parseFloat($row.find('input[name^="tax"]').val()) || 0;
                    var paid = parseFloat($row.find('input[name^="paid_amount"]').val()) || 0;
                    var shipping = parseFloat($row.find('input[name^="shipping_cost"]').val()) || 0;
                    var cod = parseFloat($row.find('input[name^="cod_cost"]').val()) || 0;
                    var quantity = parseFloat($row.find('input[name^="quantity"]').val()) || 1;

                    // Calculate total price (including shipping and quantity)
                    var subtotal = (regular - discount) * quantity;
                    var total = subtotal + (subtotal * tax / 100) + shipping + cod;
                    $row.find('input[name^="total_price"]').val(total.toFixed(2));

                    // Calculate due amount
                    var due = total - paid;
                    $row.find('input[name^="due_amount"]').val(due.toFixed(2));
                });
        });
    </script>
@endpush
