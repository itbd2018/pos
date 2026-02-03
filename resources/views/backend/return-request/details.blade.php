@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="row">
        <div class="col-md-12">
            <h3 class="content-title">Order Return Details </h3>
{{--            <strong style="font-weight: bold" class="text-dark"> {{ count($return_requests) }} Orders Found </strong>--}}
        </div>
{{--        <div class="col-md-2">--}}
{{--            <a href="{{ route('supplier.create') }}" class="btn btn-primary" title="Supplier Create"><i class="material-icons md-plus"></i></a>--}}
{{--        </div>--}}
    </div>
    <div class="row">
        <div class="col-md-12">
            @if(Auth::guard('admin')->user()->role == 1)


            <form action="{{route('return-request.update')}}" method="post">
                @csrf
                <input type="hidden" name="request_id" value="{{$return_request->id}}">
            @endif
                <div class="card mt-4">
                    <div class="card-header text-white">
                        <h3>Request Summary</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td ><strong class="fw-bold">Order Date:</strong><br>{{$return_request->order->created_at}}</td>
                                    <td><strong class="fw-bold">Invoice No:</strong><br>{{$return_request->order->invoice_no}}</td>
                                    <td ><strong class="fw-bold">Return Request Date:</strong><br>{{$return_request->created_at}}</td>
                                    <td>
                                        <strong class="fw-bold">Status</strong><br>
                                        @if(Auth::guard('admin')->user()->role == 1)
                                            <select name="return_request_status" id="" class="form-control" style="border: 1px solid darkgrey">
                                                @if($return_request->status == 2)
                                                    <option value="2" {{$return_request->status == 2 ? 'selected':''}}>Replaced</option>
                                                @else
                                                    <option value="0" {{$return_request->status == 0 ? 'selected':''}}>Pending</option>
                                                    <option value="1" {{$return_request->status == 1 ? 'selected':''}}>Processing</option>
                                                    <option value="2" {{$return_request->status == 2 ? 'selected':''}}>Replaced</option>
                                                    <option value="3" {{$return_request->status == 3 ? 'selected':''}}>Rejected</option>
                                                    <option value="4" {{$return_request->status == 4 ? 'selected':''}}>Modified</option>
                                                @endif
                                            </select>
                                        @else
                                            <span>
                                                @if($return_request->status == 0)
                                                    Pending
                                                @elseif($return_request->status == 1)
                                                    Processing
                                                @elseif($return_request->status == 2)
                                                    Replaced
                                                @elseif($return_request->status == 3)
                                                    Rejected
                                                @else
                                                    Modified
                                                @endif
                                            </span>
                                        @endif

                                    </td>

                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header text-white">
                        <h3>Requested Products</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table id="example" class="table table-bordered table-striped" width="100%">
                                <thead>
                                <tr>
                                    <th scope="col">Sl</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Issue</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($returning_products as $key => $item)
                                    @php
                                        $product = \App\Models\Product::find($item->product_id);
                                        $vendor = \App\Models\Vendor::where('user_id', Auth::guard('admin')->user()->id)->first();
                                    @endphp
                                    @if(Auth::guard('admin')->user()->role == 2 && $product->vendor_id == $vendor->id)
                                        <input type="hidden" name="returning_product_id[]" value="{{$item->product_id}}">
                                        <tr>
                                            <td> {{ $key+1}} </td>
                                            <td> {{ $item->product->name_en ?? '' }} </td>
                                            <td><img src="{{asset($item->image)}}" alt="" height="150px" width="150px"> </td>
                                            <td> {{ $item->issue ?? '' }} </td>
                                            <td> {{ $item->qty ?? '' }} </td>
                                            <td>
                                                @if(Auth::guard('admin')->user()->role == 1)
                                                    <select name="status[]" id="" class="form-control" style="border: 1px solid darkgrey">
                                                        @if($item->status == 1)
                                                            <option value="1" {{$item->status == 1 ? 'selected':''}}> Replaced</option>
                                                        @else
                                                            <option value="0" {{$item->status == 0 ? 'selected':''}}>Not Replaced</option>
                                                            <option value="1" {{$item->status == 1 ? 'selected':''}}> Replaced</option>
                                                        @endif
                                                    </select>
                                                @else
                                                    <span>{{$item->status == 0 ? 'Not Replaced': 'Replaced'}}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @else
                                        <input type="hidden" name="returning_product_id[]" value="{{$item->product_id}}">
                                        <tr>
                                            <td> {{ $key+1}} </td>
                                            <td> {{ $item->product->name_en ?? '' }} </td>
                                            <td><img src="{{asset($item->image)}}" alt="" height="150px" width="150px"> </td>
                                            <td> {{ $item->issue ?? '' }} </td>
                                            <td> {{ $item->qty ?? '' }} </td>
                                            <td>
                                                @if(Auth::guard('admin')->user()->role == 1)
                                                    <select name="status[]" id="" class="form-control" style="border: 1px solid darkgrey">
                                                        @if($item->status == 1)
                                                            <option value="1" {{$item->status == 1 ? 'selected':''}}> Replaced</option>
                                                        @else
                                                            <option value="0" {{$item->status == 0 ? 'selected':''}}>Not Replaced</option>
                                                            <option value="1" {{$item->status == 1 ? 'selected':''}}> Replaced</option>
                                                        @endif
                                                    </select>
                                                @else
                                                    <span>{{$item->status == 0 ? 'Not Replaced': 'Replaced'}}</span>
                                                @endif
                                            </td>
                                        </tr>

                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- table-responsive //end -->
                    </div>
                    <!-- card-body end// -->
                </div>
                @if(Auth::guard('admin')->user()->role == 1)
                    <div class="form-group mt-2 d-flex" style="margin-bottom: 30px">
                        <button type="submit" class="btn btn-primary" >Update</button>
                    </div>
                @endif
            </form>
        </div>
    </div>

</section>
@endsection
