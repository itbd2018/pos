@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="row">
        <div class="col-md-10">
            <div class="">
                <h2 class="">Affliate Request List </h2>
            </div>
            <strong style="font-weight: bold" class="text-dark"> {{ count($vendors) }} Affliate Found </strong>
        </div>
        {{-- <div class="col-md-2">
            <a href="{{ route('vendor.create') }}" class="btn btn-primary" title="Vendor Create"><i class="material-icons md-plus"></i></a>
        </div> --}}
    </div>
    <div class="card mb-4 mt-3">
        <div class="card-body">
            <div class="table-responsive-sm">
                <form action="{{ route('active.all') }}" method="get" onsubmit="return confirmAction()" style="text-align: right;">
                    <button type="submit" class="btn btn-success mb-3">Activate All</button>
                </form>

                <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Profile Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Approval Status</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vendors as $key => $vendor)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td width="15%">
                                <a href="#" class="itemside">
                                    <div class="left">
                                        @if($vendor->shop_profile)
                                        <img src="{{ asset($vendor->shop_profile) }}" class="img-sm img-avatar" alt="Userpic" />
                                        @else
                                        @endif
                                    </div>
                                </a>
                            </td>
                            <td> {{ $vendor->shop_owner_name ?? ' ' }} </td>
                            <td> {{ $vendor->user->username ?? ' ' }} </td>
                            <td> {{ $vendor->user->email ?? ' ' }} </td>
                            <td> {{ $vendor->user->phone ?? ' ' }} </td>
                            <td>
                                @if($vendor->status == 1)
                                  <a href="{{ route('vendor.in_active',['id'=>$vendor->id]) }}">
                                    <span class="status badge rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                  <a href="{{ route('vendor.active',['id'=>$vendor->id]) }}" > <span class="status badge rounded-pill alert-danger">Disable</span></a>
                                @endif
                            </td>
                           

                            <td class="text-end">
                                <div class="dropdown">
                                    <div class="">
                                        <a class="btn btn-primary" style="padding: 12px" href="{{ route('vendor.edit',$vendor->id) }}" title="Edit Info"><i class="fa fa-eye"></i></a>
                                        <a class=" btn btn-danger" href="{{ route('vendor.delete',$vendor->id) }}" title="Delete" id="delete"> <i class="fa fa-trash"></i></a>
                                    </div>
                                </div>
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
@push('footer-script')
<script>
    function confirmAction() {
        const userConfirmed = confirm("Are you sure you want to activate all?");
        if (userConfirmed) {
            // Proceed with the form submission
            return true;
        } else {
            // Prevent the form submission
            alert("Action cancelled.");
            return false;
        }
    }
</script>
@endpush