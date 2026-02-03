@extends('admin.admin_master')
@section('admin')
    @push('css')
        <style>
            th{
                font-weight: bold !important;
            }
        </style>
    @endpush
    <section class="content-main">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header ">
                        <h2 class="text-white">Order Information</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-border">
                            <tr>
                                <th>Invoice No</th>
                                <td>{{$order->invoice_no}}</td>
                                <th>Order Date</th>
                                <td>{{$order->created_at}}</td>
                                <th>Delivery Status</th>
                                <td>{{$order->delivery_status}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-header mx-2">
            <div class="col-md-12">
                <h2 class="content-title">Vendor Products</h2>
{{--                @php $order->order_details->where() @endphp--}}
{{--                <strong style="font-weight: bold" class="text-dark"> {{ count($order->order_details) }} Products Found </strong>--}}

            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table id="example" class="table table-bordered table-striped" width="100%">
                        <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Total Price</th>

                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $price=0;
                            $vendor = \App\Models\Vendor::where('user_id', Auth::guard('admin')->user()->id)->first();
                        @endphp
                        @foreach($order->order_details as $key => $item)
                            @if($item->product->vendor_id  == $vendor->id)
                                <tr>
                                    <td> {{ $key+1}} </td>

                                    <td> {{ $item->product->name_en ?? '' }} </td>
                                    <td> {{ $item->qty }} </td>
                                    <td> {{ $item->price}} </td>
                                    <td> {{ $total = $item->price *$item->qty}} </td>

                                    @php $price+=$total @endphp
                                </tr>
                            @endif


                        @endforeach
                        <tr>
                            <td colspan="4" class="text-center" style="font-weight: bold">Total Sales</td>
                            <td>৳ {{$price}}</td>

                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- table-responsive //end -->
            </div>
            <!-- card-body end// -->
        </div>
    </section>
@endsection
