@extends('admin.admin_master')
@section('admin')
    <section class="content-main">
        <div class="content-header mx-2">
            <div class="col-md-12">
                <h2 class="content-title">Product List </h2>
                <strong style="font-weight: bold" class="text-dark"> {{ count($items) }} Transactions Found </strong>

            </div>

        </div>
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table id="example" class="table table-bordered table-striped" width="100%">
                        <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Transaction Type</th>
                            <th scope="col">Date</th>
                            <th scope="col">Transaction Details</th>
                            <th scope="col">Amount</th>

                        </tr>
                        </thead>
                        <tbody>
                        @php $balance = 0; @endphp
                        @foreach($items as $key => $item)
                            <tr>
                                <td> {{ $key+1}} </td>
                                <td>
                                    {{ $item->status == 1  ? 'Credit':'Debit' }}
                                </td>
                                <td> {{ $item->created_at }} </td>
                                <td>
                                    @if($item->status == 1 || $item->status == 3)
                                        Order: # {{$item->invoice_no}}
                                    @else
                                        Withdraw: # {{$item->withdraw_request_id}}
                                    @endif
                                </td>
                                @php
                                    if($item->status == 1){
                                      $balance += $item->add_amount;
                                    }
                                    elseif($item->status == 3){
                                         $balance -= $item->deduct_amount;
                                    }
                                    else{
                                        $balance -= $item->withdraw_amount;
                                    }
                                @endphp
                                <td class="{{ $item->status == 1 ? 'text-success':'text-danger'}}">
                                    @if($item->status == 1)
                                        +{{$item->add_amount}}
                                    @elseif($item->status == 2)
                                        -{{$item->withdraw_amount}}
                                    @else
                                        -{{$item->deduct_amount}}
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-center"><strong style="font-weight: bold">Current Balance</strong></td>
                            <td><strong>৳ {{$vendor->balance}}</strong></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- table-responsive //end -->
            </div>
            <!-- card-body end// -->
        </div>
    </section>
@endsection
