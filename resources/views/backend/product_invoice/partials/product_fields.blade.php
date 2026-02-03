<div class="row">
    {{-- Product Name --}}
    <div class="col-md-12 mb-4">
        <label class="col-form-label fw-bold">Product Name <span class="text-danger">*</span></label>
        <input type="text" name="product_name[]" class="form-control" value="{{ old('product_name.' . $index) }}">
    </div>

    {{-- Description --}}
    <div class="col-md-12 mb-4">
        <label class="col-form-label fw-bold">Description <span class="text-danger">*</span></label>
        <textarea name="product_description[]" class="form-control summernote" rows="2">{{ old('product_description.' . $index) }}</textarea>
    </div>

    {{-- Product Code --}}
    <div class="col-md-3 mb-4">
        <label class="col-form-label fw-bold">Product Code</label>
        <input type="text" name="product_code[]" class="form-control" value="{{ old('product_code.' . $index) }}">
    </div>

    {{-- Regular Price --}}
    <div class="col-md-3 mb-4">
        <label class="col-form-label fw-bold">Regular Price</label>
        <input type="text" name="regular_price[]" class="form-control" value="{{ old('regular_price.' . $index) }}">
    </div>

    {{-- Discount Price --}}
    <div class="col-md-3 mb-4">
        <label class="col-form-label fw-bold">Discount Price</label>
        <input type="text" name="discount_price[]" class="form-control"
            value="{{ old('discount_price.' . $index) }}">
    </div>

    {{-- Quantity --}}
    
    <div class="col-md-3 mb-4">
        <label class="col-form-label fw-bold">Quantity:</label>
        <input type="number" min="1" name="quantity[]" class="form-control" value="{{ old('quantity.' . $index, 1) }}">
    </div>

 {{-- Tax --}}
    <div class="col-md-3 mb-4">
        <label class="col-form-label fw-bold">Tax (%)</label>
        <input type="text" name="tax[]" class="form-control" value="{{ old('tax.' . $index) }}">
    </div>

    {{-- Total Price --}}
    <div class="col-md-3 mb-4">
        <label class="col-form-label fw-bold">Total Price</label>
        <input type="text" name="total_price[]" class="form-control" value="{{ old('total_price.' . $index) }}">
    </div>

    {{-- Paid Amount --}}
    <div class="col-md-3 mb-4">
        <label class="col-form-label fw-bold">Paid Amount</label>
        <input type="text" name="paid_amount[]" class="form-control" value="{{ old('paid_amount.' . $index) }}">
    </div>

    {{-- Due Amount --}}
    <div class="col-md-3 mb-4">
        <label class="col-form-label fw-bold">Due Amount</label>
        <input type="text" name="due_amount[]" class="form-control" value="{{ old('due_amount.' . $index) }}">
    </div>

    {{-- Due Date --}}
    <div class="col-md-3 mb-4">
        <label class="col-form-label fw-bold">Due Date</label>
        <input type="date" name="due_date[]" class="form-control" value="{{ old('due_date.' . $index) }}">
    </div>

    {{-- Shipping Cost --}}
    <div class="col-md-3 mb-4">
        <label class="col-form-label fw-bold">Shipping Cost</label>
        <input type="text" name="shipping_cost[]" class="form-control" value="{{ old('shipping_cost.' . $index) }}">
    </div>

    {{-- Payment Status --}}
    <div class="col-md-3 mb-4">
        <label class="col-form-label fw-bold">Payment Status</label>
        <select class="form-control" name="payment_status[]">
            <option value="">--Select--</option>
            <option value="paid" {{ old('payment_status.' . $index) == 'paid' ? 'selected' : '' }}>Paid</option>
            <option value="unpaid" {{ old('payment_status.' . $index) == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
            <option value="partial" {{ old('payment_status.' . $index) == 'partial' ? 'selected' : '' }}>Partial
            </option>
        </select>
    </div>

    {{-- Payment Method --}}
    <div class="col-md-3 mb-4">
        <label class="col-form-label fw-bold">Payment Method</label>
        <select class="form-control" name="payment_methods[]">
            <option value="">--Select--</option>
            <option value="cash" {{ old('payment_methods.' . $index) == 'cash' ? 'selected' : '' }}>Cash</option>
            <option value="credit_card" {{ old('payment_methods.' . $index) == 'credit_card' ? 'selected' : '' }}>
                Credit Card</option>
            <option value="bank" {{ old('payment_methods.' . $index) == 'bank' ? 'selected' : '' }}>Bank</option>
            <option value="bkash" {{ old('payment_methods.' . $index) == 'bkash' ? 'selected' : '' }}>Bkash</option>
            <option value="nagad" {{ old('payment_methods.' . $index) == 'nagad' ? 'selected' : '' }}>Nagad</option>
        </select>
    </div>

    {{-- Payment Amount --}}
    <div class="col-md-3 mb-4">
        <label class="col-form-label fw-bold">Payment Amount</label>
        <input type="text" name="amount[]" class="form-control" value="{{ old('amount.' . $index) }}">
    </div>

    {{-- Serial Number --}}
    <div class="col-md-3 mb-4">
        <label class="col-form-label fw-bold">Serial Number</label>
        <input type="text" name="serial_number[]" class="form-control"
            value="{{ old('serial_number.' . $index) }}">
    </div>

    {{-- Warranty --}}
    <div class="col-md-6 mb-4">
        <label class="col-form-label fw-bold">Warrenty Period</label>
        <input type="text" name="warrenty[]" class="form-control" value="{{ old('warrenty.' . $index) }}">
    </div>

    {{-- Remove Button --}}
    <div class="text-end">
        <button type="button" class="btn btn-danger remove-product">Remove</button>
    </div>
</div>
