@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-7">
                <h3 class="content-title">Attribute List </h3>
                <strong style="font-weight: bold" class="text-dark"> {{ count($attributes) }} Attributes Found</strong>
            </div>
            <div class="col-md-3">
                <a href="{{ route('attribute.create') }}" class="btn btn-primary px-3 text-align-right" style="float: right; margin-right: 20px" title="Add Attribute"><i class="material-icons md-plus"></i></a>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
    <div class=" mt-3 card mb-4 col-10 mx-auto">
        <div class="card-body">
            <div class="table-responsive-sm">
                <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Name</th>
                            <th scope="col">Value</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attributes as $key => $attribute)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $attribute->name ?? 'NULL' }} </td>

                            <td>
                            @foreach($attribute->attribute_values as $value)
                                 {{ $value->value ?? 'NULL' }} ,
                            @endforeach
                            </td>
                            <td class="text-end">
                                <a href="{{ route('attribute.show',$attribute->id) }}" class="btn" style="background-color: #308fde; color: white" title="Details"><i class="fa fa-eye"></i></a>
                                @if(Auth::guard('admin')->user()->role != '2')
                                    <a style="padding:12px;" class="btn btn-primary" href="{{ route('attribute.edit',$attribute->id) }}" title="Edit Info"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger" href="{{ route('attribute.delete',$attribute->id) }}" id="delete" title="Delete"><i class="fa fa-trash"></i></a>
                                @endif
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
