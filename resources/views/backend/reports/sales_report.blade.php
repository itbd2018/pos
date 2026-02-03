@extends('admin.admin_master')
@section('admin')
    <section class="content-main">
        <div class="content-header mx-2">
            <div class="col-md-12">
                <h2 class="content-title">Order List </h2>
                <strong style="font-weight: bold" class="text-dark"> {{ count($orders) }} Orders Found </strong>

            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table id="example" class="table table-bordered table-striped" width="100%">
                        <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Invoice No</th>
                            <th scope="col">Sold Products</th>
                            <th scope="col">Quantity</th>
{{--                            <th scope="col">Total Price</th>--}}
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $price=0; @endphp
                        @foreach($orders as $key => $item)
                            <tr>
                                <td> {{ $key+1}} </td>

                                <td>
                                    {{ $item->order->invoice_no ?? ''}}

                                </td>
                                <td> {{ $item->product ?? '' }} </td>
                                <td> {{ $item->qty }} </td>
{{--                                <td> {{ $item->price}} </td>--}}
{{--                                <td> {{ $total = $item->price *$item->qty}} </td>--}}
                                <td><a href="{{route('report.view', $item->order_id)}}" class="btn btn-primary p-3"><i class="fa fa-eye "></i></a></td>
{{--                                @php $price+=$total @endphp--}}
                            </tr>

                        @endforeach
{{--                        <tr>--}}
{{--                            <td colspan="5" class="text-center" style="font-weight: bold">Total Sales</td>--}}
{{--                            <td colspan="2">৳ {{$price}}</td>--}}

{{--                        </tr>--}}
                        </tbody>
                    </table>
                </div>
                <!-- table-responsive //end -->
            </div>
            <!-- card-body end// -->
        </div>
    </section>
@endsection
