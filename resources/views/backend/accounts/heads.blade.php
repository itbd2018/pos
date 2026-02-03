@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        {{-- <h3 class="content-title">Account Heads <span class="badge rounded-pill alert-success">
                {{ count($account_heads) }} </span></h3> --}}
                <div class="col-md-10">
                    <div class="">
                        <h2 class="">Account Heads</h2>
                    </div>
                    <strong style="font-weight: bold" class="text-dark"> {{ count($account_heads) }} Account Heads Found </strong>
                </div>
        <div>
            <a href="{{ route('accounts.heads.create') }}" title="Add Account Head" class="btn btn-primary"><i
                    class="material-icons md-plus"></i></a>
        </div>
    </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Title</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($account_heads as $key => $head)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $head->title ?? '' }} </td>
                            <td> {{ $head->slug ?? '' }} </td>
                            <td>
                                @if($head->status == 1)
                                <a href="{{ route('accounts.heads.change_status',['id'=>$head->id]) }}">
                                    <span class="badge status rounded-pill alert-success">Active</span>
                                </a>
                                @else
                                <a href="{{ route('accounts.heads.change_status',['id'=>$head->id]) }}"> <span
                                        class="badge status rounded-pill alert-danger">Inactive</span></a>
                                @endif
                            </td>
                            <td class="text-end">

                                @if(Auth::guard('admin')->user()->role == '1' || in_array('52',
                                json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                                <a href="{{ route('accounts.heads.delete',$head->id) }}" id="delete"
                                    class="btn btn-primary btn-icon btn-circle btn-sm btn-xs" style="background-color:red !important " data-href="#">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                                @endif
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
    $(document).ready(function () {
        $(document).on('click', '.viweBtn', function () {
            var p_name = $(this).closest('tr').find('.p_name').text();
            // alert(p_name);
            $.ajax({
                type: "POST",
                url: "",
                data: {
                    'checking_view': true,
                    'p_name': p_name,
                },
                success: function (response) {
                    console.log(response);
                }
            });
        });
    });

</script>
@endpush
