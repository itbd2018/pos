@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
{{--<<<<<<< Updated upstream--}}
        {{-- <h2 class="content-title">Customer List <span class="badge rounded-pill alert-success"> {{ count($customers) }} </span></h2> --}}
        <div class="col-md-10">
            <div class="">
                <h2 class="">Customer list</h2>
            </div>
            <strong style="font-weight: bold" class="text-dark"> {{ count($customers) }} Customers Found </strong>
        </div>
         <div>
             <a type="button" title="Customer Create" class="btn btn-primary d-none" style="margin-right: 20px" data-bs-toggle="modal" data-bs-target="#exampleModal">
                              <i class="material-icons md-plus"></i>
             </a>
                     </div>
             {{--=======--}}
{{--        <h2 class="content-title">Customer List <span class="badge rounded-pill alert-success"> {{ count($customers) }} </span></h2>--}}
{{--         <div>--}}
{{--             <a type="button" title="Customer Create" class="btn btn-primary" style="margin-right: 20px" data-bs-toggle="modal" data-bs-target="#exampleModal">--}}
{{--                 <i class="material-icons md-plus"></i>--}}
{{--             </a>--}}
{{--        </div>--}}
{{-->>>>>>> Stashed changes--}}
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
{{--                            <th scope="col" class="text-end">Action</th>--}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $key => $customer)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $customer->name ?? 'No Name' }} </td>
                            <td> {{ $customer->phone ?? 'No Phone Number' }} </td>
                            <td> {{ $customer->email ?? 'No Email' }} </td>
                            <td> {{ $customer->address ?? 'No Address' }} </td>
{{--                            <td class="text-end">--}}
{{--                                <a href="#" class="fa fa-list"></a>--}}
{{--                                <!-- dropdown //end -->--}}
{{--                            </td>--}}
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header card-header">
                <h3>Customer Create</h3>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" id="" action="{{route('customer.ajax.store.pos')}}" >
                    @csrf
                    {{--                    <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">--}}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-1">
                                <label class="col-form-label" style="font-weight: bold;">Name: <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="name" name="name" required placeholder="Write Customer Name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-1">
                                <label class="col-form-label" style="font-weight: bold;">Phone: <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Write Phone" id="phone" name="phone" required class="form-control" >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-1">
                                <label class="col-form-label" style="font-weight: bold;">Email:</label>
                                <input type="email" placeholder="Write Email" id="email" name="email" class="form-control" >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-1">
                                <label class="col-form-label" style="font-weight: bold;">Address: <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Write Address" id="address" name="address" required class="form-control" >
                            </div>
                        </div>
                        <div class="mb-1 mt-2">
                            <img id="showImage" class="rounded avatar-lg" src="{{ (!empty($editData->profile_image))? url('upload/admin_images/'.$editData->profile_image):url('upload/no_image.jpg') }}" alt="Card image cap" width="100px" height="80px;">
                        </div>
                        <div class="mb-1">
                            <label for="image" class="col-form-label" style="font-weight: bold;">Profile Image:</label>
                            <input name="profile_image" class="form-control" type="file" id="image">
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="Close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
