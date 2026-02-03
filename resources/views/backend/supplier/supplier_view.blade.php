@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="row">
        <div class="col-md-10">
            <h3 class="content-title">Supplier List </h3>
            <strong style="font-weight: bold" class="text-dark"> {{ count($suppliers) }} Supplier Found </strong>
        </div>
        <div class="col-md-2">
            <a href="{{ route('supplier.create') }}" class="btn btn-primary" title="Supplier Create"><i class="material-icons md-plus"></i></a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive-sm">
               <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                            <th scope="col">Status</th>
                            @if(Auth::guard('admin')->user()->role != '2')
                                <th scope="col" class="text-end">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suppliers as $key => $item)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $item->name ?? '' }} </td>
                            <td> {{ $item->phone ?? '' }} </td>
                            <td> {{ $item->email ?? '' }} </td>
                            <td> {{ $item->address ?? '' }} </td>
                            <td>
                                @if($item->status == 1)
                                  <a @if(Auth::guard('admin')->user()->role != '2') href="{{ route('supplier.in_active',['id'=>$item->id]) }}" @endif>
                                    <span class="status badge rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                  <a @if(Auth::guard('admin')->user()->role != '2') href="{{ route('supplier.active',['id'=>$item->id]) }}" @endif> <span class="status badge rounded-pill alert-danger">Disable</span></a>
                                @endif
                            </td>
                            @if(Auth::guard('admin')->user()->role != '2')
                                <td class="text-end">
                                    <a class="btn btn-primary" style="padding:12px" href="{{ route('supplier.edit',$item->id) }}" title="Edit Info"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger" href="{{ route('supplier.destroy',$item->id) }}" id="delete" title="Delete"><i class="fa fa-trash"></i></a>

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
