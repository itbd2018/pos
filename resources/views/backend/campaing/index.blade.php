@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="row">
        <div class="col-md-10">
            <h3 class="content-title">Campaign List </h3>
            <strong style="font-weight: bold" class=" text-dark"> {{ count($campaings) }} Campaigns Found </strong>
        </div>
        <div class="col-md-2">
            <div>
                <a href="{{ route('campaing.create') }}" class="btn btn-primary" style="margin-right: 20px" title="Campaign Create"><i class="material-icons md-plus"></i></a>
            </div>
        </div>
    </div>

    <div class="card mb-4 ">
        <div class="card-body">
            <div class="table-responsive-sm">
                <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Campaign Photo</th>
                            <th scope="col">Name</th>
{{--                            <th scope="col">Name (Bangla)</th>--}}
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($campaings as $key => $campaing)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td width="15%">
                                <a href="#" class="itemside">
                                    <div class="left">
                                        <img src="{{ asset($campaing->campaing_image) }}" class="img-sm img-avatar" alt="Userpic" />
                                    </div>
                                </a>
                            </td>
                            <td> {{ $campaing->name_en ?? 'NULL' }} </td>
{{--                            <td> {{ $campaing->name_bn ?? 'NULL' }} </td>--}}
                            <td>
                                @if($campaing->status == 1)
                                  <a href="{{ route('campaing.in_active',['id'=>$campaing->id]) }}">
                                    <span class="product-status badge rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                  <a href="{{ route('campaing.active',['id'=>$campaing->id]) }}" > <span class="product-status badge rounded-pill alert-danger">Disable</span></a>
                                @endif
                            </td>
                            <td class="text-end">
                                <a class="btn btn-primary" style="padding:12px" href="{{ route('campaing.edit',$campaing->id) }}" title="Edit info"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-danger" href="{{ route('campaing.delete',$campaing->id) }}" id="delete" title="Delete"><i class="fa fa-trash"></i></a>
{{--                                <a href="#" class="btn btn-md rounded font-sm">Detail</a>--}}
{{--                                <div class="dropdown">--}}
{{--                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="status material-icons md-more_horiz"></i> </a>--}}
{{--                                    <div class="dropdown-menu">--}}
{{--                                        --}}
{{--                                    </div>--}}
{{--                                </div>--}}
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
