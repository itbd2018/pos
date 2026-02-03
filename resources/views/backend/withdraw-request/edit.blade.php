@extends('admin.admin_master')
@section('admin')
    {{--    @php dd($item); @endphp--}}
    <section class="content-main">
        <div class="row">
            <div class="content-header col-md-8 offset-2">
                <h2 class="content-title">Payment Add</h2>
                <div class="">
                    <a href="{{ route('payment.index') }}" class="btn btn-primary p-3"><i class="fa fa-list" title="Payment List"></i> </a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <form method="post" action="{{route('payment.update', $item->id)}}" >
                        @csrf
                        <input type="hidden" name="withdrawal_request_id" value="@isset($item){{$item->withdrawal_request_id == null ? $item->id:''}}@endisset">
                        <div class="card">
                            <div class="card-header">
                                <h3>Payment Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <label for="payment_date" class="col-form-label" style="font-weight: bold;">Payment Date:</label>
                                        <input class="form-control" id="" type="text" name="payment_date" value="@isset($item){{$item->payment_date != null ? $item->payment_date: date('Y-m-d')}} @else{{date('Y-m-d')}}@endisset" readonly>
                                    </div>
                                    {{--                                    <div class="col-md-6 mb-4">--}}
                                    {{--                                        <label for="withdrawal_requested_date" class="col-form-label" style="font-weight: bold;">Withdrawal Requested Date:</label>--}}
                                    {{--                                        <input class="form-control" id="" type="text" name="withdrawal_requested_date" value="@isset($item){{$item->withdrawRequest == null ? '':$item->withdrawRequest->date}}@endisset" readonly>--}}
                                    {{--                                    </div>--}}

                                    <div class="col-md-6 mb-4">
                                        <label for="vendor_id" class="col-form-label" style="font-weight: bold;">Vendor: *</label>
                                        <div class="custom_select">
                                            <select class="form-control @error('vendor_id') is-invalid @enderror" name="vendor_id" id="" @isset($item)  @else required @endisset>
                                                <option value="">Select Vendor</option>
                                                @foreach($vendors as $vendor)
                                                    <option value="{{$vendor->id}}" @isset($item){{$item->vendor_id == $vendor->id ? 'selected':''}}@endisset>{{$vendor->shop_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('vendor_id')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="limit_per_user" class="col-form-label" style="font-weight: bold;">Amount: *</label>
                                        <input class="form-control @error('amount') is-invalid @enderror" id="" type="number" name="amount"
                                               min="0" value="@isset($item){{$item->amount}}@else{{old('amount')}}@endisset" @isset($item) readonly @else required @endisset>
                                        @error('amount')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label for="description" class="col-form-label" style="font-weight: bold;">Description:</label>
                                        <input name="description" id="description" class="form-control" placeholder="Write Description" value="@isset($item){{$item->description ?? null}} @endisset">
                                    </div>
                                </div>
                            </div>
                            <!-- card body .// -->
                        </div>
                        <!-- card .// -->
                        <div class="row mb-4 justify-content-sm-end">
                            <div class="col-lg-3 col-md-4 col-sm-5 col-6">
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- .row // -->
        </div>
    </section>

@endsection
