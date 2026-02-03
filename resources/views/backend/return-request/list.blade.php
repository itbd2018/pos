@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="row">
        <div class="col-md-12">
            <h3 class="content-title">Product Return List </h3>
            <strong style="font-weight: bold" class="text-dark"> {{ count($return_requests) }} Requests Found </strong>
        </div>
{{--        <div class="col-md-2">--}}
{{--            <a href="{{ route('supplier.create') }}" class="btn btn-primary" title="Supplier Create"><i class="material-icons md-plus"></i></a>--}}
{{--        </div>--}}
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive-sm">
               <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Invoice No</th>
                            <th scope="col">Request Date</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Variant</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Issue</th>
                            <th scope="col" class="text-end">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($return_requests as $key => $item)
{{--                            @php dd($item->order_details) @endphp--}}
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $item->order->invoice_no ?? '' }} </td>
                            <td> {{ $item->created_at ?? '' }} </td>
                            <td> {{ $item->product->name_en ?? '' }} </td>
                            <td width="200px"> {{$item->order_details->is_varient == 1 ? $item->order_details->variation:'N/A'}} </td>
{{--                            <td> {{$item->order_details_id}} </td>--}}
                            <td>{{ $item->qty ?? '' }}</td>
                            <td>{{ $item->issue ?? '' }}</td>
                            <td class="">
                                @if(Auth::guard('admin')->user()->role == 1)
                                    @if($item->status == 1) <strong>Replaced</strong> @else
                                        <form action="{{route('return-request.update')}}" method="post" id="statusChangeForm">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <input type="hidden" name="order_details_id" value="{{$item->order_details_id}}">
                                            <select name="status" id="" class="form-control" onchange="this.form.submit()">
                                                <option value="0" {{$item->status == 0 ? 'selected':''}}>Pending</option>
                                                <option value="1" {{$item->status == 1 ? 'selected':''}}>Replaced</option>
                                                <option value="2" {{$item->status == 2 ? 'selected':''}}>Rejected</option>
                                            </select>
                                        </form>
                                    @endif
                                @else
                                    @if($item->status == 0) Pending @elseif($item->status == 1) Replaced  @else Rejected @endif
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
@push('js')
    <script>
        function formSubmit(){
            $('#statusChangeForm').submit();
        }
    </script>
@endpush
