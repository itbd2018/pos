@extends('admin.admin_master')
@section('admin')

    <style type="text/css">
        table, tbody, tfoot, thead, tr, th, td{
            border: 1px solid #dee2e6 !important;
        }
        th{
            font-weight: bolder !important;
        }
        .icon{
            background-color: #365486 !important;
        }
    </style>
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Order detail</h2>
                <p>Details for Order ID: {{ $order->invoice_no?? ''}}</p>
            </div>
        </div>
        <div class="card">
            <header class="card-header">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-4 mb-lg-0 mb-15">
                        <span class="text-black"> <i class="material-icons md-calendar_today"></i> <b>{{ $order->created_at?? ''}}</b> </span> <br />
                        <small class="text-black">Order ID: {{ $order->invoice_no?? ''}}</small>
                    </div>
                    @php
                        $payment_status = $order->payment_status;
                        $delivery_status = $order->delivery_status;
                    @endphp
                    <div class="col-lg-8 col-md-8 ms-auto text-md-end">
                                    <button class="btn btn-secondary installment-btn">
                                  Installment
                                 </button>
                        <select class="form-select d-inline-block mb-lg-0 mr-5 mw-200 bg-white"  id="update_payment_status">
                            <option value="0" @if ($payment_status == '0') selected @endif>Unpaid</option>
                            <option value="1" @if ($payment_status == '1') selected @endif>Paid</option>
                        </select>
                        @if($delivery_status != 'cancelled')
                            <select class="form-select d-inline-block mb-lg-0 mr-5 mw-200" style="background-color: white" id="update_delivery_status">
                                <option value="pending" @if ($delivery_status == 'pending') selected @endif>Pending</option>
                                <option value="confirmed" @if ($delivery_status == 'confirmed') selected @endif>Confirmed</option>
                                <option value="processing" @if($delivery_status == 'processing') selected @endif>Processing</option
                                <option value="shipped" @if ($delivery_status == 'shipped') selected @endif>Shipped</option>
                                <option value="picked_up" @if ($delivery_status == 'picked_up') selected @endif>Picked Up</option>
                                <option value="on_the_way" @if ($delivery_status =='on_the_way') selected @endif>On The Way</option>
                                <option value="delivered" @if ($delivery_status == 'delivered') selected @endif>Delivered</option>
                                <option value="cancelled" @if ($delivery_status == 'cancelled') selected @endif>Cancel</option>
                                <option value="cancelled" @if ($delivery_status == 'cancel_requested') selected @endif>Cancel Requested</option>
                            </select>
                        @else
                            <input type="text" class="form-control d-inline-block mb-lg-0 mr-5 mw-200" value="{{ $delivery_status }}" disabled>
                        @endif

                        <a class="btn btn-secondary print ms-2" href="{{ route('invoice.download', $order->id) }}"  style="font-size: 18px;"><i class="fa fa-file"></i></a>
                    </div>
                </div>
            </header>
            <!-- card-header end// -->
            <div class="card-body" >
                <form action="{{ route('admin.orders.update',$order->id) }}"  method="post">
                    @csrf
                <div class="row mb-50 mt-20 order-info-wrap" >
                    <div class="col-md-4">
                        <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-person"></i>
                        </span>

                            <div class="text">
                                <h6 class="mb-1">Customer</h6>
                                <p class="mb-1">
                                    {{ $order->name ?? ''}} <br />
                                    {{ $order->email ?? ''}} <br />
                                    {{ $order->phone ?? ''}}
                                </p>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop1{{ $order->id }}">Edit Customer</a>
                            </div>
                        </article>
                    </div>
                    <!-- col// -->
                    <div class="col-md-4">
                        <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-local_shipping"></i>
                        </span>
                            <div class="text">
                                <h6 class="mb-1">Order info</h6>
                                <p class="mb-1">
                                    Order Id: {{ $order->invoice_no?? ''}} </br>
                                    Shipping: {{$order->shipping_name ?? ''}} <br />
                                    Pay method: @if($order->payment_method == 'cod') Cash On Delivery @else {{ $order->payment_method }} @endif <br />
                                    Status: @php
                                        $status = $order->delivery_status;
                                        if($order->delivery_status == 'cancelled') {
                                            $status = 'Received';
                                        }

                                    @endphp
                                    {!! $status !!}
                                </p>
                                {{-- <a href="#">Download info</a> --}}
                            </div>
                        </article>
                    </div>
                    <!-- col// -->
                    <div class="col-md-4">
                        <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-place"></i>
                        </span>
                            <div class="text">
                                <h6 class="mb-1">Deliver to</h6>
                                <p class="mb-1">
                                    City: {{ ucwords($order->upazilla->name_en ?? 'Null' ) }}, <br />{{ ucwords($order->district->district_name_en ?? 'Null') }},<br />
                                    {{ ucwords($order->division->division_name_en ?? 'Null') }}
                                </p>
                                <!-- <a  href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $order->id }}">Edit Address</a> -->


                            </div>
                        </article>
                    </div>




                    <div class="col-md-12 mt-40">
                    <div class="col-md-12 mt-40">
    <article class="icontext align-items-start">
        <div class="text">
            <!-- First Row: NID and Nominee Information Inline -->
            <div class="row mb-2">
                <!-- NID Number -->
                <div class="col-md-3">
                    <p><strong>NID Number:</strong> {{ $order->nid ?? 'N/A' }}</p>
                </div>

                <!-- NID Front Image (Smaller as Icon with Download Icon) -->
                <div class="col-md-3">
                    <p><strong>Front Image:</strong></p>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset($order->nid_front) }}" alt="NID Front" class="img-fluid" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                        <a href="{{ asset($order->nid_front) }}" download class="text-primary ml-2">
                        <i class="fa-solid fa-download text-info"></i>
                        </a>
                    </div>
                </div>

                <!-- NID Back Image (Smaller as Icon with Download Icon) -->
                <div class="col-md-3">
                    <p><strong>Back Image:</strong></p>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset($order->nid_back) }}" alt="NID Back" class="img-fluid" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                        <a href="{{ asset($order->nid_back) }}" download class="text-primary ml-2">
                        <i class="fa-solid fa-download text-info"></i>
                        </a>
                    </div>
                </div>

                <!-- Nominee NID Number -->
                <div class="col-md-3">
                    <p><strong>Nominee NID:</strong> {{ $order->nominee_nid ?? 'N/A' }}</p>
                </div>
            </div>

            <!-- Second Row: Nominee Name and Relation Inline -->
            <div class="row mb-2">
                <!-- Nominee Name -->
                <div class="col-md-6">
                    <p><strong>Nominee Name:</strong> {{ $order->nominee_name ?? 'N/A' }}</p>
                </div>

                <!-- Nominee Relation -->
                <div class="col-md-6">
                    <p><strong>Nominee Relation:</strong> {{ $order->relation ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </article>

</div>
        <div class="payment_status_system">
            <h6 style="color: black; display: inline-block; margin-right: 10px;">
                First Paid Amount:
            </h6>
            <span style="font-weight: bold;">{{ $order->first_pay_amount ?? '0.00' }}</span>
            (<span style="font-weight: bold;">{{ $order->paid_date ?? 'Not yet' }}</span>)

            <h6 style="color: black; display: inline-block; margin-left: 15px; margin-right: 10px;">
                Due Amount:
            </h6>
            <span style="font-weight: bold;">{{ number_format(($order->grand_total - $order->paid_amount) ?? 0, 2) }}</span>
        </div>




                                    <div class="payment_status_system">
    <table class="table table-bordered" style="margin-top: 10px; width: 100%; text-align: left; border-spacing: 0; border-collapse: collapse;">
        <thead style="background-color: #f9f9f9;">
            <tr style="height: 30px;">
                <th style="padding: 5px;">Installment Name</th>
                <th style="padding: 5px;">Installment Date</th>
                <th style="padding: 5px;">Installment Amount</th>
                <th style="padding: 5px;">Installment Paid date</th>
            </tr>
        </thead>
        <tbody>
            <tr style="height: 25px;">
                <td style="padding: 5px;">First Installment</td>
                <td style="padding: 5px;">
                    @if(!empty($order->paid_date))
                        {{ \Carbon\Carbon::parse($order->paid_date)->addDays(30)->format('Y-m-d') }}
                    @else
                        N/A
                    @endif
                </td>
                <td style="padding: 5px;">{{ $order->first_installment }}</td>
                <td style="padding: 5px;">{{ $order->first_installment_date ?? 'Not yet' }}</td>
            </tr>

            <tr style="height: 25px;">
                <td style="padding: 5px;">Second Installment</td>
                <td style="padding: 5px;">
                    @if(!empty($order->paid_date))
                        {{ \Carbon\Carbon::parse($order->paid_date)->addDays(60)->format('Y-m-d') }}
                    @else
                        N/A
                    @endif
                </td>
                <td style="padding: 5px;">{{ $order->second_installment }}</td>
                <td style="padding: 5px;">{{ $order->second_installment_date ?? 'Not yet' }}</td>
            </tr>

            <tr style="height: 25px;">
                <td style="padding: 5px;">Third Installment</td>
                <td style="padding: 5px;">
                    @if(!empty($order->paid_date))
                        {{ \Carbon\Carbon::parse($order->paid_date)->addDays(90)->format('Y-m-d') }}
                    @else
                        N/A
                    @endif
                </td>
                <td style="padding: 5px;">{{ $order->third_installment }}</td>
                <td style="padding: 5px;">{{ $order->third_installment_date ?? 'Not yet' }}</td>
            </tr>
        </tbody>
    </table>
</div>





                    <!-- col// -->
                    <div class="col-md-12 mt-40">
                        <table class="table table-bordered">

                                <tbody>
                                <tr>
                                    <th>Invoice</th>
                                    <td>{{ $order->invoice_no?? 'Null'}}</td>
                                    <th>Email</th>
                                    <td><input type="" class="form-control" name="email" value="{{ $order->email ?? 'Null'}}"></td>
                                </tr>
                                <tr>
                                    <th class="col-2">Shipping Address</th>
                                    <td>
                                        <label for="division_id" class="fw-bold text-black"><span class="text-danger">*</span> Division</label>
                                        <select class="form-control select-active"  name="division_id" id="division_id" required>
                                            <option value="">Select Division</option>

                                            @foreach(get_divisions($order->division_id) as $division)
                                                <option value="{{ $division->id }}" {{ $division->id == $order->division_id ? 'selected': '' }}>{{ ucwords($division->division_name_en) }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <label for="district_id" class="fw-bold text-black"><span class="text-danger">*</span> District</label>
                                        <select class="form-control select-active" name="district_id" id="district_id" required>
                                            <option selected=""  value="">Select District</option>
                                            @foreach(get_district_by_division_id($order->division_id) as $district)
                                                <option value="{{ $district->id }}" {{ $district->id == $order->district_id ? 'selected': '' }}>{{ ucwords($district->district_name_en) }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <label for="upazilla_id" class="fw-bold text-black"><span class="text-danger">*</span> Upazilla</label>
                                        <select class="form-control select-active" name="upazilla_id" id="upazilla_id" required>
                                            <option selected=""  value="">Select Upazilla</option>
                                            @foreach(get_upazilla_by_district_id($order->district_id) as $upazilla)
                                                <option value="{{ $upazilla->id }}" {{ $upazilla->id == $order->upazilla_id ? 'selected': '' }}>{{ ucwords($upazilla->name_en) }}</option>
                                            @endforeach

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Payment Method</th>
                                    <td>
                                        <select class="form-control select-active" name="payment_method" id="payment_method" required>
                                            <option selected=""  value="" >Select Payment Method</option>
                                            <option value="cod" @if($order->payment_method == 'cod') selected @endif>Cash</option>
                                            <option value="bikash" @if($order->payment_method == 'bikash') selected @endif>Bikash</option>
                                            <option value="nagad" @if($order->payment_method == 'nagad') selected @endif>Nagad</option>
                                        </select>
                                    </td>
                                    <th>Shipping Charge</th>
                                    <td><input type="" class="form-control" id="cartSubTotalShi" name="shipping_charge" value="{{ $order->shipping_charge}}"></td>
                                </tr>
                                <tr>
                                    <th>Discount</th>
                                    <td><input type="" class="form-control" name="discount" value="{{ $order->discount }}"></td>

                                    <th>Payment Status</th>
                                    <td>
                                        @php
                                            $status = $order->payment_status;
                                            if($order->payment_status == '1') {
                                                if($order->grad_total == $order->paid_amount){
                                                    $status = 'Paid';
                                                }
                                                else{
                                                    $status = 'Partial Paid';
                                                }
                                            }
                                            else{
                                                $status = 'Unpaid';
                                            }
                                        @endphp
                                        <span class="badge rounded-pill alert-success text-success">{!! $status !!}</span>
                                    </td>
                                </tr>
                                <tr>

                                    <th>Payment Date</th>
                                    <td>{{ date_format($order->created_at,"Y/m/d")}}</td>
                                </tr>
                                <tr>
                                    <th>Sub Total</th>
                                    <td>{{ $order->sub_total }} <strong>Tk</strong></td>

                                    <th>Total</th>
                                    <td>{{ $order->grand_total }} <strong>Tk</strong></td>
                                    <!--  <td>

                                         <span class="badge badge-success">Delivered</span>

                                     </td> -->
                                </tr>
                                </tbody>
                        </table>
                    </div>
                    <!-- col// -->
                </div>
                <!-- row // -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th width="40%">Product</th>
                                    <th width="20%">Unit Price</th>
                                    <th width="20%">Quantity</th>
                                    <th width="20%" class="text-end">Total</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($order->order_details as $key => $orderDetail)
                                    <tr>
                                        <td>
                                            <a class="itemside" href="#">
                                                <div class="left">
                                                    <img src="{{ asset($orderDetail->product->product_thumbnail ?? ' ') }}" width="40" height="40" class="img-xs" alt="Item" />
                                                </div>
                                                <div class="info">
                                                    <span class="text-bold">
                                                        {{$orderDetail->product->name_en ?? ' '}}
                                                    </span>

                                                    @if($order->order_type == 1)
                                                        @if($orderDetail->is_varient && count(json_decode($orderDetail->variation))>0)
                                                            @foreach(json_decode($orderDetail->variation) as $varient)
                                                                <br/><span>{{ $varient->attribute_name }} : {{ $varient->attribute_value }}</span>
                                                            @endforeach
                                                        @endif
                                                    @else
                                                        <br/><span>{{ $orderDetail->variation }}</span>
                                                    @endif
                                                </div>
                                            </a>
                                        </td>
                                        <td>{{ $orderDetail->price ?? '0.00' }}</td>
                                        <td>{{ $orderDetail->qty ?? '0' }}</td>
                                        <td class="text-end">{{ $orderDetail->price*$orderDetail->qty ?? '0.00' }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4">
                                        <article class="float-end">
                                            <dl class="dlist">
                                                <dt>Subtotal:</dt>
                                                <dd>{{ $order->sub_total ?? '0.00' }}</dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt>Addon(5% for installment)</dt>
                                                <dd>{{ $order->sub_total*0.05 ?? '0.00' }}</dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt>Shipping cost:</dt>
                                                <dd>{{ $order->shipping_charge }}</dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt>Discount:</dt>
                                                <dd><b class="">{{ $order->coupon ?? '0.00' }}</b></dd>
                                            </dl>

                                            <dl class="dlist">
                                                <dt>Grand total:</dt>
                                                <dd><b class="h5">  {{ $order->grand_total }} TK</b></dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt class="text-muted">Status:</dt>
                                                <dd>
                                                    @php
                                                        $status = $order->delivery_status;
                                                        if($order->delivery_status == 'cancelled') {
                                                            $status = 'Received';
                                                        }

                                                    @endphp
                                                    <span class=" badge rounded-pill alert-success text-success">{!! $status !!}</span>
                                                </dd>
                                            </dl>
                                        </article>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- table-responsive// -->
                    </div>
                    <!-- col// -->
                    <div class="col-lg-1"></div>
                    {{-- <div class="col-lg-4">
                        <div class="box shadow-sm bg-light">
                            <h6 class="mb-15">Payment info</h6>
                            <p>
                                <img src="{{ asset('backend/assets/imgs/card-brands/2.png ') }}" class="border" height="20" /> Master Card ** ** 4768 <br />
                                Business name: Grand Market LLC <br />
                                Phone:
                            </p>
                        </div>
                        <div class="h-25 pt-4">
                            <div class="mb-3">
                                <label>Notes</label>
                                <textarea class="form-control" name="notes" id="notes" placeholder="Type some note"></textarea>
                            </div>
                        </div>
                    </div> --}}
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Update Order</button>
                    </div>
                    <!-- col// -->

                </div>
                </form>
            </div>
            <!-- card-body end// -->
        </div>
        <!-- card end// -->
    </section>

    <!-- payment modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.orders.update',$order->id) }}" id="paymentForm" method="post">
                @csrf
                
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Payment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="totalPrice" class="form-label">Total Price</label>
                        <input type="text" class="form-control" id="totalPrice" name="totalPrice" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="due_amount" class="form-label">Due Amount</label>
                        <input type="text" class="form-control" id="due_amount" name="due_amount" readonly>
                    </div>
                   <!-- Hidden Input Fields -->
                
                    

                    <div class="mb-3">
                        <label for="pay_amount" class="form-label">Pay Amount</label>
                        <input type="number" class="form-control" id="pay_amount" name="pay_amount" required>
                   </div>
                </div>
           
                  <input type="hidden" id="division_id" name="division_id" value="{{ $order->division_id }}">
                    <input type="hidden" id="district_id" name="district_id" value="{{ $order->district_id }}">
                    <input type="hidden" id="upazilla_id" name="upazilla_id" value="{{ $order->upazilla_id }}">
                    <input type="hidden" id="payment_method" name="payment_method" value="{{ $order->payment_method }}">
                    <input type="hidden" id="shipping_charge" name="shipping_charge" value="{{ $order->shipping_charge }}">
                    <input type="hidden" id="discount" name="discount" value="{{ $order->discount }}">
                    <input type="hidden" id="payment_status" name="payment_status">
                   
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


   <!-- Your modal HTML structure -->
@php
    $paymentStatus = $order->payment_status;
@endphp

<!-- Installment Modal -->
<!-- Installment Modal -->
<div class="modal fade" id="installmentModal" tabindex="-1" aria-labelledby="installmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="installmentForm" action="{{ route('admin.installment.update', $order->id) }}" method="POST">
                @csrf <!-- CSRF Token -->
                <div class="modal-header">
                    <h5 class="modal-title" id="installmentModalLabel">Payment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="order_id" name="order_id" value="{{ $order->id }}">
                  
                    <input type="hidden" id="installment_type" name="installment_type">
                    <input type="hidden" id="installment_value" name="installment_value">

                    <!-- Product Name -->
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $orderDetail->product_name }}" readonly>
                    </div>
                    
                    <!-- Total Price -->
                    <div class="mb-3">
                        <label for="totalPrice" class="form-label">Total Price</label>
                        <input type="text" class="form-control" id="totalPrice" name="totalPrice" value="{{ $order->grand_total }}" readonly>
                    </div>

                    <!-- Paid Amount -->
                    <div class="mb-3">
                        <label for="paid_amount" class="form-label">Paid Amount</label>
                        <input type="text" class="form-control" id="paid_amount" name="paid_amount" value="{{ $order->paid_amount }}" readonly>
                    </div>

                    <!-- Due Amount -->
                    <div class="mb-3">
                        <label for="due_amount" class="form-label">Due Amount</label>
                        <input type="text" class="form-control" id="due_amount" name="due_amount" value="{{ $order->grand_total - $order->paid_amount }}" readonly>
                    </div>

                                <!-- First Installment -->
                <div class="mb-3">
                    <label for="first_installment" class="form-label">1st Installment</label>
                    <input 
                        type="number" 
                        class="form-control" 
                        id="first_installment" 
                        name="first_installment" 
                        value="{{ $order->first_installment }}" 
                        {{ $order->first_installment > 0 ? 'readonly' : '' }}>
                </div>

                <!-- Second Installment -->
                <div class="mb-3">
                    <label for="second_installment" class="form-label">2nd Installment</label>
                    <input 
                        type="number" 
                        class="form-control" 
                        id="second_installment" 
                        name="second_installment" 
                        value="{{ $order->second_installment }}" 
                        {{ $order->second_installment > 0 ? 'readonly' : '' }}>
                </div>

                <!-- Third Installment -->
                <div class="mb-3">
                    <label for="third_installment" class="form-label">3rd Installment</label>
                    <input 
                        type="number" 
                        class="form-control" 
                        id="third_installment" 
                        name="third_installment" 
                        value="{{ $order->third_installment }}" 
                        {{ $order->third_installment > 0 ? 'readonly' : '' }}>
                </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>






@endsection
@push('footer-script')

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="shipping_id"]').on('change', function(){
                var shipping_cost = $(this).val();
                if(shipping_cost) {
                    $.ajax({
                        url: "{{  url('/checkout/shipping/ajax') }}/"+shipping_cost,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                            //console.log(data);
                            $('#ship_amount').text(data.shipping_charge);

                            let shipping_price = parseInt(data.shipping_charge);
                            let grand_total_price = parseInt($('#cartSubTotalShi').val());
                            grand_total_price += shipping_price;
                            $('#grand_total_set').html(grand_total_price);
                            $('#total_amount').val(grand_total_price);
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });

       /* ============ Update Payment Status =========== */
                $('#update_payment_status').on('change', function () {
                    var order_id = {{ $order->id }};  // Order ID
                    var status = $('#update_payment_status').val();

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    var first_installment = {{ $order->first_installment }};
                    // Update payment status via AJAX for Unpaid
                    if (status == '0') {
                        if (first_installment > 0) {
                        // Hide the modal if the first installment has been paid
                        $('#paymentModal').modal('hide');
                        Swal.fire({
                            icon: 'info',
                            title: 'You cannot change the payment status to Unpaid.',
                           // text: 'You cannot change the payment status to Unpaid.',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        return; // Stop further execution
                    }
                    else 
                        $.post('{{ route('orders.update_payment_status') }}', {
                            _token: '{{ csrf_token() }}',
                            order_id: order_id,
                            status: status
                        }, function (data) {
                            // Show Toast for Unpaid status change
                            if ($.isEmptyObject(data.error)) {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Payment status updated to Unpaid!'

                                });
                                location.reload();
                                
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: data.error
                                });
                            }
                        });
                    }

                    // Show Toast for "Paid" status change and open modal
                
                    if (status == '1') {
                        var paidAmount = '{{ $order->paid_amount }}';
                        if (paidAmount > 0 ) {
                        // Hide the modal if the first installment has been paid
                        $('#paymentModal').modal('hide');
                        Swal.fire({
                            icon: 'info',
                            title: 'Already paid',
                            text: 'Now,start installment',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        return; // Stop further execution
                    }
                        // Pre-fill modal fields with server-side data
                        var productName = '{{ $orderDetail->product_name }}';
                        var totalPrice = '{{ $order->grand_total }}';
                      
                        var dueAmount = {{ $order->grand_total - $order->paid_amount }};

                        var divisionId = '{{ $order->division_id }}';
                        var districtId = '{{ $order->district_id }}';
                        var upazillaId = '{{ $order->upazilla_id }}';
                        var paymentMethod = '{{ $order->payment_method }}';
                        var shippingCharge = '{{ $order->shipping_charge }}';
                        var discount = '{{ $order->discount }}';
                        
                        
                        $('#product_name').val(productName);
                        $('#totalPrice').val(totalPrice);
                        $('#paid_amount').val(paidAmount);
                        $('#due_amount').val(dueAmount);

                        // Set initial value for pay_amount as 0 or an empty value
                       

                        $('#division_id').val(divisionId);
                        $('#district_id').val(districtId);
                        $('#upazilla_id').val(upazillaId);
                        $('#payment_method').val(paymentMethod);
                        $('#shipping_charge').val(shippingCharge);
                        $('#discount').val(discount);
                        $('#pay_amount').val('');
                        $('#payment_status').val(status);
                    
                        
                        // Show the modal
                        $('#paymentModal').modal('show');
                    }
                });

                $('#paymentModal').on('input', '#pay_amount', function () {
                    $('#paymentModal').on('input', '#pay_amount', function () {
                    var totalPrice = parseFloat($('#totalPrice').val()) || 0;
                    var paidAmount = parseFloat($('#paid_amount').val()) || 0;
                    var payAmount = parseFloat($('#pay_amount').val()) || 0;

                    // Calculate due amount
                    var dueAmount = totalPrice - paidAmount - payAmount;
                    var previousDueAmount = parseFloat($('#due_amount').val()) || 0;

                    if (payAmount < 0 || paidAmount > dueAmount) {
                        $('#pay_amount').val('');
                        
                        // Show error toast
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Payment Amount',
                            text: 'The payment amount cannot be negative, and the paid amount cannot exceed the due amount.',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        
                        $('#due_amount').val((totalPrice - paidAmount).toFixed(2)); // Revert to original due amount without payAmount
                        return;
                    }

                    
                    // Update due amount field
                    $('#due_amount').val(dueAmount.toFixed(2));
                });

                });


                // Handle modal form submission (when modal is confirmed)
                $('#confirmPayment').on('click', function () {
                    var formData = {
                        order_id: {{ $order->id }},
                        status: 1, // Assuming status is "Paid" after modal submit
                        _token: '{{ csrf_token() }}'
                    };

                    // Make AJAX request to update payment status
                    $.post('{{ route('orders.update_payment_status') }}', formData, function (data) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1000
                        });

                        // Display success or error toast after modal submit
                        if ($.isEmptyObject(data.error)) {
                            Toast.fire({
                                icon: 'success',
                                title: 'Payment status updated to Paid!'
                               
                            });
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: data.error
                            });
                        }

                        // Close the modal and reload the page
                        $('#paymentModal').modal('hide');
                        location.reload();
                    }).fail(function (xhr, status, error) {
                        console.error('AJAX error: ' + status + ', ' + error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong. Please try again later.'
                        });
                    });
                });






                //for installment

                $('.installment-btn').on('click', function () {
    // Get the payment status (ensure it's passed from the backend)
    var paymentStatus = {{ $order->payment_status }}; // Ensure this variable is passed correctly from the backend

    if (paymentStatus === 1) {
        // Get data attributes from the button
        const orderId = {{ $order->id }};
        const first_installment={{ $order->first_installment }};
        const second_installment={{ $order->second_installment }};
        const third_installment={{ $order->third_installment }};
       
        
        var productName = $(this).data('product-name');
        var totalPrice = $(this).data('total-price');
        var paidAmount = {{ $order->paid_amount }}; // Ensure this value is valid
        var dueAmount = {{ $order->grand_total - $order->paid_amount }}; // Calculate due amount
        var paidAmount = Number(paidAmount); // Force to number
        var grandTotal = Number(@json($order->grand_total));
        // Check if any installment has already been made
        if (paidAmount === grandTotal) {
            Swal.fire({
                icon: 'warning',
                title: 'The installment for this order has already been paid.',
             //   text: 'The installment for this order has already been paid.',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            return;
        }

        // Populate modal fields
        $('#order_id').val(orderId);
        $('#product_name').val(productName);
        $('#totalPrice').val(totalPrice);
        $('#due_amount').val(dueAmount); // Populate the due amount directly in the form

        $('#first_installment').val(first_installment || '');
        $('#second_installment').val(second_installment || '');
        $('#third_installment').val(third_installment || '');

        // Reset hidden input fields
        $('#installment_type').val('');
        $('#installment_value').val('');

        // Enable all installment fields before showing the modal
        enableInstallmentFields();

        // Show the modal
        $('#installmentModal').modal('show');
    } else if (paymentStatus === 0) {
        // Show message if payment status is 0 (indicating no payment yet)
        Swal.fire({
            icon: 'warning',
            title: 'Please pay first',
            text: 'You need to make a payment before proceeding with the installment.',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
    }
});

// Enable all installment fields
function enableInstallmentFields() {
    $('#first_installment').prop('disabled', false);
    $('#second_installment').prop('disabled', false);
    $('#third_installment').prop('disabled', false);
}

// Update hidden inputs dynamically and lock fields when typing in the respective field
$('#installmentModal').on('input', '#first_installment', function () {
    var firstInstallment = $(this).val();
    if (firstInstallment > 0) {
        $('#second_installment').prop('disabled', true);
        $('#third_installment').prop('disabled', true);

        // Update hidden input fields
        $('#installment_type').val('first_installment');
        $('#installment_value').val(firstInstallment);
    } else {
        $('#second_installment').prop('disabled', false);
        $('#third_installment').prop('disabled', false);

        // Clear hidden inputs if no value is entered
        $('#installment_type').val('');
        $('#installment_value').val('');
    }
});

$('#installmentModal').on('input', '#second_installment', function () {
    var secondInstallment = $(this).val();
    if (secondInstallment > 0) {
        $('#third_installment').prop('disabled', true);

        // Update hidden input fields
        $('#installment_type').val('second_installment');
        $('#installment_value').val(secondInstallment);
    } else {
        $('#third_installment').prop('disabled', false);

        // Clear hidden inputs if no value is entered
        $('#installment_type').val('');
        $('#installment_value').val('');
    }
});

$('#installmentModal').on('input', '#third_installment', function () {
    var thirdInstallment = $(this).val();
    if (thirdInstallment > 0) {
        $('#first_installment').prop('disabled', true);
        $('#second_installment').prop('disabled', true);

        // Update hidden input fields
        $('#installment_type').val('third_installment');
        $('#installment_value').val(thirdInstallment);
    } else {
        $('#first_installment').prop('disabled', false);
        $('#second_installment').prop('disabled', false);

        // Clear hidden inputs if no value is entered
        $('#installment_type').val('');
        $('#installment_value').val('');
    }
});


          /* ============ Update Delivery Status =========== */
          $('#update_delivery_status').on('change', function () {
                var order_id = {{ $order->id }};
                var status = $('#update_delivery_status').val();

                $.post('{{ route('orders.update_delivery_status') }}', {
                    _token: '{{ @csrf_token() }}',
                    order_id: order_id,
                    status: status
                }, function (data) {
                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1000 // Keep the existing timer
                    });

                    // Check if the response contains a success message
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        }).then(() => {
                            // Reload the page after the toast is shown
                            location.reload();
                        });
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        }).then(() => {
                            // Reload the page after the toast is shown
                            location.reload();
                        });
                    }
                }).fail(function (xhr, status, error) {
                    // Handle AJAX request failure
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1000 // Keep the existing timer
                    });

                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: 'Delivery status has been updated.'
                    }).then(() => {
                        // Reload the page after the error toast is shown
                        location.reload();
                    });
                });
            });
    </script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!--  Division To District Show Ajax -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="division_id"]').on('change', function(){
                var division_id = $(this).val();
                // const divArray = division.split("-");
                // var division_id = divArray[0];
                // $('#division_name').val(divArray[1]);
                if(division_id) {
                    $.ajax({
                        url: "{{  url('/division-district/ajax') }}/"+division_id,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                            $('select[name="district_id"]').html('<option value="" selected="" disabled="">Select District</option>');
                            $.each(data, function(key, value){
                                // console.log(value);
                                $('select[name="district_id"]').append('<option value="'+ value.id +'">' + capitalizeFirstLetter(value.district_name_en) + '</option>');
                            });
                            $('select[name="upazilla_id"]').html('<option value="" selected="" disabled="">Select District</option>');
                        },
                    });
                } else {
                    alert('danger');
                }
            });
            function capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }
        });
    </script>

    <!--  District To Upazilla Show Ajax -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="district_id"]').on('change', function(){
                var district_id = $(this).val();
                // const divArray = district.split("-");
                // var division_id = divArray[0];
                // $('#district_name').val(divArray[1]);
                if(district_id) {
                    $.ajax({
                        url: "{{  url('/district-upazilla/ajax') }}/"+district_id,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                            var d =$('select[name="upazilla_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="upazilla_id"]').append('<option value="'+ value.id +'">' + value.name_en + '</option>');
                                $('select[name="upazilla_id"]').append('<option  class="d-none" value="'+ value.id +'">' + value.name_en + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>

    <!-- Customer Edit Modal -->
    <div class="modal fade" id="staticBackdrop1{{ $order->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('admin.user.update',$order->id) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="division_id" class="fw-bold text-black col-form-label"><span class="text-danger">*</span> Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter the name" value="{{ $order->name ?? 'Null'}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="division_id" class="fw-bold text-black col-form-label"><span class="text-danger">*</span> Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Enter the email" value="{{ $order->email ?? 'Null'}}">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="division_id" class="fw-bold text-black col-form-label"><span class="text-danger">*</span> Phone</label>
                                <input type="number" class="form-control" name="phone" placeholder="Enter the phone" value="{{ $order->phone ?? 'Null'}}">
                            </div>
                            <!-- <div class="form-group col-lg-6">
                                <label for="division_id" class="fw-bold text-black col-form-label"><span class="text-danger">*</span> Password</label>
                                <input type="password" class="form-control">
                            </div> -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush
