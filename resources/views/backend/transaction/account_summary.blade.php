@extends('admin.admin_master')
@section('admin')
    <section class="content-main">
        <div class="content-header mx-2">
            <div class="col-md-12">
                <h2 class="content-title">Account Summary </h2>
                <strong style="font-weight: bold" class="text-dark"> {{ count($vendors) }} Vendors Found </strong>

            </div>

        </div>
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table id="example" class="table table-bordered table-striped" width="100%">
                        <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Vendor Name</th>
                            <th scope="col">Total Bill</th>
                            <th scope="col">Withdraw Amount</th>
                            <th scope="col">Order Cancellation</th>
                            <th scope="col">Current Balance</th>
                            <th scope="col">Admin Commission</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($vendors as $key => $item)
                            @php
                                $withdraw =  \App\Models\VendorTransaction::where('vendor_id', $item->id)->sum('withdraw_amount');
                                $order_cancel = \App\Models\VendorTransaction::where('vendor_id', $item->id)->sum('deduct_amount');
                                $bill =  \App\Models\VendorTransaction::where('vendor_id', $item->id)->sum('add_amount');
                                $admin_commission = \App\Models\VendorComission::where('vendor_id', $item->id)->sum('admin_commission')
                            @endphp
                            <tr>
                                <td> {{ $key+1}} </td>
                                <td>
                                    {{ $item->shop_name ?? 'NULL' }}
                                </td>
                                <td> {{ $bill }} </td>
                                <td> {{ $withdraw  }} </td>
                                <td> {{$order_cancel}} </td>
                                <td> {{ $balance = $bill - $withdraw - $order_cancel }} </td>
                                <td>{{$admin_commission}}</td>
                                <td><a href="{{route('transaction.details', $item->id)}}" class="btn btn-info" title="Details"><i class="fa fa-eye"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- table-responsive //end -->
            </div>
            <!-- card-body end// -->
        </div>
    </section>
@endsection
