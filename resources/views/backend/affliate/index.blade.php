@extends('admin.admin_master')
@section('admin')
    <section class="content-main">
        <div class="row">
            <div class="col-md-10">
                <div class="">
                    <h2 class="">Affliate Products List </h2>
                </div>
                {{-- <strong style="font-weight: bold" class="text-dark"> {{ count($orders) }} Affliate Account Found </strong> --}}
            </div>
        </div>
        <div class="card mb-4 mt-3">
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table id="example" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th scope="col">Sl</th>
                                <th scope="col">Affiliate User Name</th>
                                <th scope="col">Coupon Code</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Buyer Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Delivary Status</th>
                                <th scope="col">Payment Status</th>
                            </tr>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $order)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td> {{ $order->affiliateUser->name ?? 'N/A' }} </td>
                                    <td> {{ $order->coupon_code ?? 'N/A' }} </td>
                                    <td> {{ $order->order_detail_h->product_name ?? 'N/A' }} </td>
                                    <td> {{ $order->name ?? 'N/A' }} </td>
                                    <td> {{ $order->phone ?? 'N/A' }} </td>
                                    <td> {{ $order->delivery_status ?? 'N/A' }} </td>
                                    <td> {{ $order->payment_status == 1 ?' Paid' : 'Unpaid' }} </td>
                                    {{-- <td>
                                        @if ($order->status == 1)
                                            <a href="{{ route('order.in_active', ['id' => $order->id]) }}">
                                                <span class="status badge rounded-pill alert-success">Active</span>
                                            </a>
                                        @else
                                            <a href="{{ route('order.active', ['id' => $order->id]) }}"> <span
                                                    class="status badge rounded-pill alert-danger">Disable</span></a>
                                        @endif
                                    </td> --}}


                                    {{-- <td class="text-end">
                                        <div class="dropdown">
                                            <div class="">
                                                <a class="btn btn-primary" style="padding: 12px"
                                                    href="{{ route('order.edit', $order->id) }}" title="Edit Info"><i
                                                        class="fa fa-eye"></i></a>
                                                <a class=" btn btn-danger" href="{{ route('order.delete', $order->id) }}"
                                                    title="Delete" id="delete"> <i class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                        <!-- dropdown //end -->
                                    </td> --}}
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
