@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="row">
        <div class="col-md-10">
            <div class="">
                <h3 class="content-title">Brand List </h3>
                <strong style="font-weight: bold" class="text-dark"> {{ count($brands) }} Brands Found </strong>
            </div>
        </div>
        <div class="col-md-2">
            <div>
                <a href="{{ route('brand.add') }}" class="btn btn-primary" title="Brand Create"><i class="material-icons md-plus"></i></a>
            </div>
        </div>
    </div>
    <div class="card mb-4 mt-3">
        <div class="card-body">
            <div class="table-responsive-sm">
                <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Cover Photo</th>
                            <th scope="col">Name <span class="d-none">(English)/(Bangla)</span></th>
{{--                            <th scope="col">Name </th>--}}
                            <th scope="col">Status</th>
                            @if(Auth::guard('admin')->user()->role != '2')
                                <th scope="col" class="text-end">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brands as $key => $brand)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td width="15%">
                                <a href="#" class="itemside">
                                    <div class="left">
                                        <img src="{{ asset($brand->brand_image) }}" class="img-sm " alt="Userpic" />
                                    </div>
                                </a>
                            </td>
                            <td> {{ $brand->name_en ?? 'NULL' }} <br>
                                <span class="d-none">{{ $brand->name_bn ?? 'NULL' }}</span> </td>
{{--                            <td>  </td>--}}
                            <td>
                                @if($brand->status == 1)
                                  <a @if(Auth::guard('admin')->user()->role != '2') href="{{ route('brand.in_active',['id'=>$brand->id]) }}" @endif>
                                    <span class="status badge rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                  <a @if(Auth::guard('admin')->user()->role != '2') href="{{ route('brand.active',['id'=>$brand->id]) }}" @endif> <span class="status badge rounded-pill alert-danger">Disable</span></a>
                                @endif
                            </td>
                            @if(Auth::guard('admin')->user()->role != '2')
                                <td class="text-end">
{{--                                    <a href="#" class="btn btn-md rounded font-sm">Detail</a>--}}
                                    <div class="">
{{--                                        <a href="#" data-bs-toggle="" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>--}}
                                        <div class="">
                                            <a class="btn btn-primary" style="padding: 12px"  href="{{ route('brand.edit',$brand->id) }}" title="Edit Info"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-danger" href="{{ route('brand.delete',$brand->id) }}" id="delete" title="Delete"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                    <!-- dropdown //end -->
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
