@extends('admin.admin_master')
@section('admin')
{{--    @php dd($item); @endphp--}}
    <section class="content-main">
        <div class="row">
            <div class="content-header col-md-8 offset-2">
                <h2 class="content-title">Withdraw Request Add</h2>
                <div class="">
                    <a href="{{ route('withdraw-requests.index') }}" class="btn btn-primary p-3"><i class="fa fa-list" title="View Withdraw Requests"></i> </a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <form method="post" action="@isset($item){{ route('withdraw-requests.update', $item->id)}}@else{{ route('withdraw-requests.store')}}@endisset">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3>Withdraw Request</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <label for="payment_date" class="col-form-label" style="font-weight: bold;">Date:</label>
                                        <input class="form-control" id="" type="text" name="date" value="@isset($item){{$item->date}}@else{{date('Y-m-d')}}@endisset" readonly>
                                    </div>
{{--                                    <div class="col-md-6 mb-4">--}}
{{--                                        <label for="withdrawal_requested_date" class="col-form-label" style="font-weight: bold;">Withdrawal Requested Date:</label>--}}
{{--                                        <input class="form-control" id="" type="text" name="withdrawal_requested_date" value="@isset($item){{$item->withdrawRequest == null ? '':$item->withdrawRequest->date}}@endisset" readonly>--}}
{{--                                    </div>--}}

                                    <div class="col-md-6 mb-4">
                                        <label for="vendor_id" class="col-form-label" style="font-weight: bold;">Payment Method: (Mobile Banking) *</label>
                                        <div class="custom_select">
                                            <select class="form-control @error('payment_method') is-invalid @enderror" name="payment_method" id="" required>
                                                <option value="">Select Payment Method</option>
                                                @foreach($paymentMethods as $method)
                                                    <option value="{{$method->id}}" @isset($item){{$item->payment_method == $method->id ? 'selected':''}}@endisset>{{$method->payment_method}}</option>
                                                @endforeach
                                            </select>
                                            @error('payment_method')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="limit_per_user" class="col-form-label" style="font-weight: bold;">Phone (Mobile Banking): *</label>
                                        <input class="form-control @error('phone') is-invalid @enderror" id="" type="number" name="phone"
                                               min="0" value="@isset($item){{$item->phone}}@else{{old('phone')}}@endisset" required>
                                        @error('phone')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-4">
                                        <label for="limit_per_user" class="col-form-label" style="font-weight: bold;">Amount: *</label>
                                        <input class="form-control @error('amount') is-invalid @enderror" id="" type="number" name="amount"
                                               min="0" value="@isset($item){{$item->amount}}@else{{old('amount')}}@endisset" required>
                                        @error('amount')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
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
