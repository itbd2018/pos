@extends('admin.admin_master')
@section('admin')
    <section class="content-main">
        <div class="row">
            <div class="col-md-10">
                <h3 class="content-title">Affiliate Payment List </h3>
                <strong style="font-weight: bold" class="text-dark"> {{ count($payments) }} Payments Found </strong>
            </div>
            <div class="col-md-2">
                <a href="{{ route('payment.create') }}" class="btn btn-primary" title="Payment Create"><i class="material-icons md-plus"></i></a>
            </div>
        </div>

        <div class="card mb-4 mt-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered table-striped" width="100%">
                        <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Paid Amount</th>
                            <th scope="col">Agent Number</th>
                            <th scope="col">Requested Date</th>
                            <th scope="col">Payment Date</th>
                            <th scope="col">Description</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $key => $payment)
                            <tr>
                                <td> {{ $key+1}} </td>
                                <td> {{ $payment->vendor->shop_owner_name ?? 'NULL' }} </td>
                                <td> {{$payment->amount}} </td>
                                <td> {{$payment->phone ?? ' N/A'}} </td>
                                <td> {{ $payment->withdrawRequest->date ?? 'NULL' }} </td>
                                <td> {{ $payment->payment_date ?? 'NULL' }} </td>
                                <td> {{ $payment->description ?? 'NULL' }} </td>
                                <td class="text-end">
                                    <a class="btn btn-primary" style="padding:12px" href="{{ route('payment.edit',$payment->id) }}" title="Edit info"><i class="fa fa-pencil"></i></a>
                                    {{--                                <a href="#" class="btn btn-md rounded font-sm">Detail</a>--}}
                                    <!-- dropdown //end -->
                                </td>
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
