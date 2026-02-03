@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="row">
        <div class="col-md-10">
            <h3 class="content-title">Coupon List </h3>
            <strong style="font-weight: bold" class="text-dark"> {{ count($coupons) }} Coupons Found </strong>
        </div>
        <div class="col-md-2">
            <a href="{{ route('coupons.create') }}" class="btn btn-primary" title="Coupon Create"><i class="material-icons md-plus"></i></a>
        </div>
    </div>

    <div class="card mb-4 mt-3">
        <div class="card-body">
            <div class="table-responsive">
               <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Coupon Code</th>
                            <th scope="col">Discount Type</th>
                            <th scope="col">Charge</th>
                            <th scope="col">Expiry Date</th>
                            {{-- <th scope="col">User Limit</th> --}}
                            <th scope="col">Total Limit</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($coupons as $key => $coupon)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $coupon->coupon_code ?? 'NULL' }} </td>
                            @if($coupon->discount_type == 1)
                            <td> Fixed Amount </td>
                            @else
                            <td> Percent </td>
                            @endif
                            <td> {{ $coupon->discount ?? 'NULL' }} </td>
                            {{-- <td> {{ $coupon->limit_per_user ?? 'NULL' }} </td> --}}
                            <td>{{$coupon->expire_date}}</td>
                            <td> {{ $coupon->total_use_limit ?? 'NULL' }} </td>
                            <td>
                                @if($coupon->status == 1)
                                  <a href="{{ route('coupon.in_active',['id'=>$coupon->id]) }}">
                                    <span class="status badge rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                  <a href="{{ route('coupon.active',['id'=>$coupon->id]) }}" > <span class="status badge rounded-pill alert-danger">Disable</span></a>
                                @endif
                            </td>
                            <td class="text-end">
                                <a class="btn btn-primary" style="padding:12px" href="{{ route('coupons.edit',$coupon->id) }}" title="Edit info"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-danger" href="{{ route('coupon.delete',$coupon->id) }}" id="delete" title="Delete"><i class="fa fa-trash"></i></a>
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
