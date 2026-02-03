@extends('FrontEnd.master')
@section('title')
    Return Order
@endsection
@section('content')
    <div class="row my-5 mx-2">
        <div class="col-md-8 m-auto">
            <div class="card shadow-lg">
                <div class="card-header text-center"><h3><strong>Return Product</strong></h3></div>
                <div class="card-body">
                    <form action="{{route('order.return.submit')}}" method="post" enctype="multipart/form-data">
                        @csrf
{{--                                                <input type="hidden" name="" id="items" value="{{$replaceable}}">--}}
                                                <input type="hidden" name="order_id" id="order_id" value="{{$order->order_id}}">
                                                <input type="hidden" name="product_id" value="{{$order->product_id}}">
                                                <input type="hidden" name="order_details_id" value="{{$order->id}}">
                        <div class="row mb-3">
                            <div class=" col-md-4">
                                <strong>Date</strong><p>{{date('Y-m-d')}}</p>
                            </div>
                            <div class=" col-md-4">
                                <strong >Invoice No</strong>
                                <p>{{$order->invoice_no}}</p>
                            </div>
                            <div class=" col-md-4">
                                <strong >Product Name</strong>
                                <p>{{$order->product->name_en}}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-group col-md-4">
                                <label for="" class="form-control-label">Issue <span class="text-danger">*</span></label>
                                <select class="form-control @error('issue') is-invalid @enderror" name="issue"  required>
                                    <option value="damaged_product">Damaged Product</option>
                                    <option value="wrong_product">Wrong Product</option>
                                    <option value="incorrect_description">Incorrect Description</option>
                                    <option value="poor_fit_and_size">Poor Fit and Size</option>
                                    <option value="duplicate_order">Duplicate Order</option>
                                </select>
                                @error('issue')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="" class="form-control-label">Quantity <span class="text-danger">*</span></label>
                                <input type="number" name ="qty" class="form-control qty @error('qty') is-invalid @enderror" max="{{$order->qty}}" min="1" value="{{$order->qty}}">
                                @error('qty')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="" class="form-control-label">Product Images <span class="text-danger">*</span></label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="" accept="image/*" required>
                            </div>
                            @error('image')
                            <div class="invalid-feedback" role="alert">{{$message}}</div>
                            @enderror
                        </div>
                        {{--                        <div class="row mb-3">--}}
                        {{--                            <div class="col-md-12">--}}
                        {{--                                <label for="" class="form-control-label">Returning Products</label>--}}
                        {{--                                <button type="button" id="addIssueBtn" class="btn"><i class="fa fa-plus text-success"></i></button>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="row" id="issues">--}}

                        {{--                        </div>--}}

                        {{--                        <div class="row mb-3">--}}
                        {{--                            <div class="form-group col-md-12">--}}
                        {{--                                <label for="" class="form-control-label">Comment</label>--}}
                        {{--                                <textarea name="comment" class="form-control" cols="30" rows="5"></textarea>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="row mb-3">
                            <div class="form-group col-md-12" >
                                <button class="btn btn-primary" style="float: right">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
@endsection
@push('js')
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            $('.js-example-basic-multiple').select2();--}}
{{--        });--}}

{{--        $(document).ready(function() {--}}
{{--            var counter = 0;--}}
{{--            $('#addIssueBtn').click(function () {--}}
{{--                if($('#items').val() > counter)--}}
{{--                {--}}
{{--                    counter++;--}}
{{--                    var html = `<div class="mb-3 col-md-3">--}}
{{--                                    <label for="" class="form-control-label">Product <span class="text-danger">*</span></label>--}}
{{--                                    <select class="form-control @error('product') is-invalid @enderror" id="issue_product${counter}" name="product_id[]" onchange="getQty(${counter})" required>--}}
{{--                                    <option value="">Select Product</option>--}}
{{--                                        @foreach($order->order_details as $item)--}}
{{--                                            @if($item->product->is_replaceable == 1)--}}
{{--                                                <option value="{{$item->id}}">{{$item->product->name_en}}</option>--}}
{{--                                            @endif--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                    @error('product')--}}
{{--                                    <div class="invalid-feedback" role="alert">{{$message}}</div>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                                <div class="mb-3 col-md-3">--}}
{{--                                    <label for="" class="form-control-label">Issue <span class="text-danger">*</span></label>--}}
{{--                                    <select class="form-control @error('issue') is-invalid @enderror" name="issue[]"  required>--}}
{{--                                        <option value="damaged_product">Damaged Product</option>--}}
{{--                                        <option value="wrong_product">Wrong Product</option>--}}
{{--                                        <option value="incorrect_description">Incorrect Description</option>--}}
{{--                                        <option value="poor_fit_and_size">Poor Fit and Size</option>--}}
{{--                                        <option value="duplicate_order">Duplicate Order</option>--}}
{{--                                    </select>--}}
{{--                                    @error('issue')--}}
{{--                                        <div class="invalid-feedback" role="alert">{{$message}}</div>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}

{{--                                <div class="mb-3 col-md-3">--}}
{{--                                    <label for="" class="form-control-label">Quantity <span class="text-danger">*</span></label>--}}
{{--                                    <input type="number" name ="qty[]" class="form-control qty" max="{{$item->qty}}" min="1">--}}
{{--                                </div>--}}
{{--                                <div class="col-md-3">--}}
{{--                                    <label for="" class="form-control-label">Product Images <span class="text-danger">*</span></label>--}}
{{--                                    <input type="file" name="image[]" class="form-control @error('image') is-invalid @enderror" id="" accept="image/*" required>--}}
{{--                                                </div>--}}
{{--                                    @error('image')--}}
{{--                                        <div class="invalid-feedback" role="alert">{{$message}}</div>--}}
{{--                                    @enderror--}}
{{--                                </div>`--}}
{{--                    $('#issues').append(html);--}}
{{--                }--}}
{{--                else{--}}
{{--                    alert('All Products Included')--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--        let temp = 0;--}}
{{--        function getQty(count) {--}}

{{--            var product_id = $('#issue_product'+count).val();--}}
{{--            // var order_id = $('#order_id').val();--}}
{{--            // alert(product_id);--}}
{{--                var url = '{{ route("get-product-by-id") }}';--}}
{{--                // url = url.replace(':product',product);--}}
{{--                $.ajax({--}}
{{--                    url: url,--}}
{{--                    dataType: 'json',--}}
{{--                    data: {--}}
{{--                        product_id: product_id--}}
{{--                    },--}}
{{--                    beforeSend: function() {--}}
{{--                        // jQuery('select[name=\'branch_district\']').after('<span class="wait">&nbsp;<img src="images/loading.gif" alt="" /></span>');--}}
{{--                    },--}}
{{--                    complete: function() {--}}
{{--                        jQuery('.wait').remove();--}}
{{--                    },--}}
{{--                    success: function(data) {--}}
{{--                        var string = data.id.toString();--}}
{{--                        var prev = $('#ordered_product').val();--}}
{{--                        if(!prev){--}}
{{--                            $('#ordered_product').val(string);--}}
{{--                        }--}}
{{--                        else{--}}
{{--                            $('#ordered_product').val($('#ordered_product').val() + ','+ string);--}}
{{--                        }--}}

{{--                    }--}}
{{--                });--}}
{{--        }--}}

{{--    </script>--}}
@endpush
