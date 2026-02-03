@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="row">
        <div class="col-md-10 offset-1">
            <div class="row">
                <div class="col-md-10">
                    <div class="">
                        <h3 class="content-title">Unit List </h3>
                        <strong style="font-weight: bold" class="text-dark"> {{ count($units) }} Units Found </strong>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('unit.create') }}" class="btn btn-primary px-3" style="float: right; margin-right: 20px" title="Unit Create"><i class="material-icons md-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-10 offset-1 card mb-4">
            <div class=" card-body">
                <div class="table-responsive-sm">
                    <table id="example" class="table table-bordered table-striped" width="100%">
                        <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Unit Name</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($units as $key => $unit)
                            <tr>
                                <td> {{ $key+1}} </td>
                                <td> {{ $unit->name ?? '' }} </td>
                                <td>
                                    @if($unit->status == 1)
                                        <a href="{{ route('unit.changeStatus',['id'=>$unit->id]) }}">
                                            <span class="status badge rounded-pill alert-success">Active</span>
                                        </a>
                                    @else
                                        <a href="{{ route('unit.changeStatus',['id'=>$unit->id]) }}" > <span class="status badge rounded-pill alert-danger">Inactive</span></a>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a style="padding:12px" class="btn btn-primary" href="{{ route('unit.edit', $unit->id) }}" title="Edit Info"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger" href="{{ route('unit.delete',$unit->id) }}" id="delete" title="Delete"><i class="fa fa-trash"></i></a>
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
    </div>

</section>
@endsection
