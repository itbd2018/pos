@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="row">
        <div class="col-md-10">
            <div class="">
                <h3 class="content-title">Display Size List </h3>
                <strong style="font-weight: bold" class="text-dark"> {{ count($display_sizes) }} Display Size Found </strong>
            </div>
        </div>
        <div class="col-md-2">
            <div>
                <a href="{{ route('display.size.add') }}" class="btn btn-primary" title="Display Size Create"><i class="material-icons md-plus"></i></a>
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
                            <th scope="col">Name <span class="d-none">(English)/(Bangla)</span></th>
                            <th scope="col">Status</th>
                            @if(Auth::guard('admin')->user()->role != '2')
                                <th scope="col" class="text-end">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($display_sizes as $key => $display)
                        <tr>
                            <td> {{ $key+1}} </td>

                            <td> {{ $display->name_en ?? 'NULL' }} <br>
                                <span class="d-none">{{ $display->name_bn ?? 'NULL' }}</span> </td>
                            <td>
                                @if($display->status == 1)
                                  <a @if(Auth::guard('admin')->user()->role != '2') href="{{ route('display.size.in_active',['id'=>$display->id]) }}" @endif>
                                    <span class="status badge rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                  <a @if(Auth::guard('admin')->user()->role != '2') href="{{ route('display.size.active',['id'=>$display->id]) }}" @endif> <span class="status badge rounded-pill alert-danger">Disable</span></a>
                                @endif
                            </td>
                            @if(Auth::guard('admin')->user()->role != '2')
                                <td class="text-end">
                                    <div class="">
                                        <div class="">
                                            <a class="btn btn-primary" style="padding: 12px"  href="{{ route('display.size.edit',$display->id) }}" title="Edit Info"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-danger" href="{{ route('display.size.delete',$display->id) }}" id="delete" title="Delete"><i class="fa fa-trash"></i></a>
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
