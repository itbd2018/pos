@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <section class="content-main">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="content-header">
                    <h2 class="content-title">Return Product Invoice</h2>
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
                {{-- Update form action to your return route --}}
                {{-- {{ route('product.return.store') }} --}}
                <form method="post" action="{{ route('product.return.invoice.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="card">
                        {{-- Product Information Start --}}
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3>Product Information</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-4"> <label for="product_invoice_id" class="col-form-label"
                                        style="font-weight: bold;">Product Name<span class="text-danger">*</span></label>
                                    <select class="form-control select-active w-100 form-select select-nice product_select"
                                        name="product_invoice_id" id="product_invoice_id" required>
                                        <option value="">--Select Product--</option>
                                        @foreach ($invoices as $invoice)
                                            @if ($invoice->product_id)
                                                <option value="{{ $invoice->id }}">  {{ $invoice->invoice_no }}-{{ $invoice->product->name_en }}
                                                </option>
                                            @else
                                                <option value="{{ $invoice->id }}">{{ $invoice->invoice_no }}-{{ $invoice->product_name }}</option>
                                            @endif
                                        @endforeach
                                    </select> @error('product_invoice_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label for="reason" class="col-form-label fw-bold">
                                        Return Reason
                                    </label>
                                    <textarea name="reason" id="reason" class="form-control summernote" rows="2">{{ old('reason') }}</textarea>
                                    @error('reason')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                {{-- Quantity --}}

                                <div class="col-md-4 mb-4">
                                    <label class="col-form-label fw-bold">Quantity:</label>
                                    <input type="number" min="1" name="quantity" class="form-control"
                                        value="{{ old('quantity') }}">
                                </div>
                                {{-- Paid Amount --}}
                                <div class="col-md-4 mb-4">
                                    <label class="col-form-label fw-bold">Amount</label>
                                    <input type="text" name="refund_amount" class="form-control"
                                        value="{{ old('refund_amount') }}">
                                </div>
                                {{-- Due Date --}}
                                <div class="col-md-4 mb-4">
                                    <label class="col-form-label fw-bold">Date</label>
                                    <input type="date" name="return_date" class="form-control"
                                        value="{{ old('due_date') }}">
                                </div>
                                
                            </div>
                        </div>
                        {{-- Product Information End --}}
                    </div>
                    <!-- card .// -->

                    <div class="row mb-4 justify-content-sm-end">
                        <div class="col-lg-2 col-md-4 col-sm-5 col-6">
                            <input type="submit" class="btn btn-primary w-100" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('footer-script')
@endpush
