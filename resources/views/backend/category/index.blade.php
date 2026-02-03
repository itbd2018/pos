@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <div class="col-md-10">
            <h2 class="content-title">Brand List</h2>
            <strong style="font-weight: bold" class="text-dark"> {{ count($categories) }} Products Found </strong>

        </div>
        <div class="col-md-2">
            <a href="{{ route('category.create') }}" class="btn btn-primary" title="Add Category"><i class="material-icons md-plus"></i></a>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive-sm">
                <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name <span class="d-none">(English)/(Bangla)</span></th>
{{--                            <th scope="col">Name (Bangla)</th>--}}
                            <th scope="col">Type</th>
{{--                            <th scope="col">Parent</th>--}}
                            <th scope="col">Status</th>
                            <th scope="col">Featured</th>
                            @if(Auth::guard('admin')->user()->role != '2')
                                <th scope="col" class="text-end">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $key => $category)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td width="15%">
                                <a href="#" class="itemside">
                                    <div class="left">
                                        <img src="{{ asset($category->image) }}" class="img-sm img-avatar" alt="Userpic" style="border-radius: 0 !important;"/>
                                    </div>
                                </a>
                            </td>
	                        <td>
                                {{ $category->name_en ?? '' }} <br><span class="d-none">{{ $category->name_bn ?? '' }}</span>

                            </td>
	                        <td>
                             @if($category->type==1)
                                Parent Brand <br> {{ $category->parent_name != null ? '('.$category->parent_name.')':'' }}
                             @elseif($category->type==2)
                                Sub Brand
                             @elseif($category->type==3)
                                Sub Sub Brand
                             @endif

                            </td>

                            <td>
                                @if($category->status == 1)
                                  <a @if(Auth::guard('admin')->user()->role != '2') href="{{ route('category.in_active',['id'=>$category->id]) }}" @endif>
                                    <span class="status badge rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                  <a @if(Auth::guard('admin')->user()->role != '2') href="{{ route('category.active',['id'=>$category->id]) }}" @endif> <span class="status badge rounded-pill alert-danger">Disable</span></a>
                                @endif
                            </td>
                            <td>
                                @if($category->is_featured == 1)
                                    <a @if(Auth::guard('admin')->user()->role != '2') href="{{ route('category.changeFeatureStatus',['id'=>$category->id]) }}"@endif title="Featured Category">
                                        <span class="feature-status text-success"><i class="fa-solid fa-tag"></i></span>
                                    </a>
                                @else
                                    <a @if(Auth::guard('admin')->user()->role != '2') href="{{ route('category.changeFeatureStatus',['id'=>$category->id]) }}" @endif title="Normal Category">
                                        <span class="feature-status text-danger"><i class="fa fa-tag"></i></span></a>
                                @endif
                            </td>
                            @if(Auth::guard('admin')->user()->role != '2')
                                <td >
                                    <div class=" btn-group" style="margin: 25% 0">
                                        <a href="{{ route('category.edit',$category->id) }}" class="btn btn-primary" title="Edit"
                                           style="padding:12px; margin-right: 5px; border-radius: 5px"><i class="fa fa-pencil"></i></a>
                                        <a href="{{ route('category.delete',$category->id) }}" class="btn btn-danger" title="Delete"
                                           style="border-radius: 5px"><i class="fa fa-trash"></i></a>
                                    </div>

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
