@extends('admin.admin_master')
@section('admin')
    <section class="content-main">
        <div class="row">
            <div class="col-md-10">
                <h3 class="content-title">Withdrawal Request List </h3>
                <strong style="font-weight: bold" class="text-dark"> {{ count($withdrawRequests) }} Requests Found </strong>
            </div>
{{--            <div class="col-md-2">--}}
{{--                <a href="{{ route('payment.create') }}" class="btn btn-primary" title="Payment Create"><i class="material-icons md-plus"></i></a>--}}
{{--            </div>--}}
        </div>

        <div class="card mb-4 mt-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered table-striped" width="100%">
                        <thead>
                        @php $a=1; @endphp
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Date</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Phone (Agent Number)</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Payment Method</th>
                            <th scope="col" class="text-center">Status</th>
                            @if(Auth::guard('admin')->user()->role == 2)
                                <th scope="col" class="text-center">Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($withdrawRequests as $key => $item)
                            <tr>
                                <td> {{ $key+1}} </td>
                                <td> {{ $item->date ?? 'NULL' }} </td>
                                <td> {{ $item->vendor->shop_owner_name}} </td>
                                <td> {{ $item->phone}} </td>
                                <td> {{$item->amount}} </td>
                                <td> {{ $item->paymentMethod->payment_method}} </td>
                                <td class="text-center">
                                    @if(Auth::guard('admin')->user()->role == 1 && $item->status == 0)
                                        <a href="{{route('request.approve', $item->id)}}">
                                        <span class="status badge rounded-pill {{$item->status == 1 ? 'alert-success':'alert-danger'}}">
                                            {{$item->status == 1 ? 'Approved':'Pending'}}
                                        </span>
                                        </a>
                                    @else
                                        <span class="status badge rounded-pill {{$item->status == 1 ? 'alert-success':'alert-danger'}}">
                                            {{$item->status == 1 ? 'Approved':'Pending'}}
                                        </span>
                                    @endif
                                </td>
                                @if(Auth::guard('admin')->user()->role == 2)
                                    <td class="text-center">
                                        <a style="padding:12px;" class="btn btn-primary" href="{{ route('withdraw-requests.edit',$item->id) }}" title="Edit Info"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger" href="{{ route('withdraw-requests.delete', $item->id) }}"  id="delete" title="Delete"><i class="fa fa-trash"></i></a>
                                    </td>
                                @endif
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
