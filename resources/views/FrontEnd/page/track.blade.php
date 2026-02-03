@extends('FrontEnd.master')
@section('content')
<style>
/* The actual timeline (the vertical ruler) */

.rounded-pill{
    font-size: 15px;
}
.font-15{
  font-size: 15px;
}
.item_image {
    max-width: 40%;
}
/*.timeline {*/
/*  position: relative;*/
/*  max-width: 1200px;*/
/*  margin: 0 auto;*/
/*}*/



/* Container around content */
.containers {
  padding: 10px 40px;
  position: relative;
  background-color: inherit;
  /* width: 50%; */
}

/* The circles on the timeline */
.containers::after {
  content: '';
  position: absolute;
  width: 25px;
  height: 25px;
  right: -17px;
  background-color: white;
  border: 4px solid #FF9F55;
  top: 15px;
  border-radius: 50%;
  z-index: 1;
}

/* Place the containers to the left */
.left {
  left: 0;
}

/* Place the containers to the right */
.right {
  left: 50%;
}

/* Add arrows to the left containers (pointing right) */
.left::before {
  content: " ";
  height: 0;
  position: absolute;
  top: 22px;
  width: 0;
  z-index: 1;
  right: 30px;
  border: medium solid white;
  border-width: 10px 0 10px 10px;
  border-color: transparent transparent transparent white;
}

/* Add arrows to the right containers (pointing left) */
.right::before {
  content: " ";
  height: 0;
  position: absolute;
  top: 22px;
  width: 0;
  z-index: 1;
  left: 30px;
  border: medium solid white;
  border-width: 10px 10px 10px 0;
  border-color: transparent white transparent transparent;
}

/* Fix the circle for containers on the right side */
.right::after {
  left: -14px;
}

/* The actual content */
.content {
  padding: 20px 30px;
  background-color: white;
  position: relative;
  border-radius: 6px;
}

@media only screen and (max-width: 599px) and (min-width: 320px)  {
  .row.single-order-tracking::after {
    left: 79px !important;
}
.row.single-order-tracking {
    margin-left: 30px;
}

.order-date {
    text-align: left !important;
    padding: 0;
    margin: 0;
}

.order-content h6 {
    font-size: 12px;
}
}

/* Media queries - Responsive timeline on screens less than 600px wide */
@media screen and (max-width:600px){
  /* Place the timelime to the left */
  .timeline::after {
  left: 31px;
  }
.invoice-info {
    display: block !important;
}
  .content h3 {
    font-size: 15px;
}

.product_price {
    display: flex;
    justify-content: start !important;
}

.subtotal {
    margin-left: 40px;
}
.content h5 {
    font-size: 12px;
}
  /* Full-width containers */
  .containers {
  width: 100%;
  padding-left: 70px;
  padding-right: 25px;
  }
  .order-content {
    margin-bottom: 0 !important;
}
  /* Make sure that all arrows are pointing leftwards */
  .containers::before {
  left: 60px;
  border: medium solid white;
  border-width: 10px 10px 10px 0;
  border-color: transparent white transparent transparent;
  }

  /* Make sure all circles are at the same spot */
  .left::after, .right::after {
  left: 15px;
  }

  /* Make all right containers behave like the left ones */
  .right {
  left: 0%;
  }

.order_summery ul li {
    justify-content: start;
}
.order_summery ul li span {
    width: 200px !important;
    display:block;
}
.payment_status_system {
    justify-content: start !important;
}
.payment_status_system a {
    margin-left: 100px;
}
.order_summery.product-order-summery p {
    font-size: 14px;
}
.order_summery ul li {
    justify-content: unset !important;
}
.progress-container::before {
    top: 25% !important;
}
.progress {
    top: 25% !important;
}
span.progress-size {
    font-size: 8px !important;
}
.order-date {
    width: 45% !important;
    margin-bottom: 20px;
}
.order-content {
    width: 50% !important;
}






}

.order-date {
    width: 150px;
    text-align: right;
    padding-right: 50px;
}

.order-content {
    width: 300px;
    position: relative;
    margin-bottom: 60px;
    margin-left: -20px;
}
.order-content::after {
    position: absolute;
    left: -18px;
    top: 0;
    content: '';
    background: #FF7475;
    width: 15px;
    height: 15px;
    z-index: 9;
    border-radius: 50px;
}
.row.single-order-tracking {
    position: relative;
}

.row.single-order-tracking::after {
    position: absolute;
    left: 119px;
    top: 0;
    width: 2px;
    height: 100%;
    background: #ddd;
    content: '';
}
.invoice-header {
    margin-bottom: 20px;
}


       .progress-container {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-bottom: 30px;
        }

       .progress-container::before {
    content: '';
    background-color: #ddd;
    position: absolute;
    top: 30%;
    left: 0%;
    transform: translateY(-30%);
    height: 4px;
    width: 95%;
    z-index: 1;
}
.circle.active i {
    color: #fff !important;
}

        .progress {
            background-color: #E4A521;
            position: absolute;
            top: 30%;
            left: 0;
            transform: translateY(-30%);
            height: 4px;
            width: 0%;
            z-index: 1;
            transition: .4s ease;
        }

       .circle {
    background-color: #fff;
    color: #999;
    border-radius: 50%;
    height: 30px;
    width: 30px;
    /* display: flex; */
    /* align-items: center; */
    position: relative;
    text-align: center;
    /* justify-content: center; */
    border: 3px solid #ddd;
    transition: .4s ease;
    z-index: 9;
}

        .circle.active {
            border-color: #E4A521;
            background: #E4A521;
            /* color: #fff; */
        }

        .progress_btn {
            background-color: red;
            color: #fff;
            border: 0;
            border-radius: 6px;
            cursor: pointer;
            font-family: inherit;
            padding: 8px 30px;
            margin: 5px;
            font-size: 14px;
        }

        .progress_btn:active {
            transform: scale(.98);
        }

        .progress_btn:focus {
            outline: 0;
        }
span.progress-size {
    font-size: 12px;
}
.progressing {
    width: 75px;
}
        .btn:disabled {
            background-color: red;
            cursor: not-allowed;
        }
        .product-detail {
    padding: 10px;
    margin-top:20px;
}
.order_summery ul li {
    display: flex;
    margin-bottom: 5px;
    justify-content: space-between;
}
.order_summery ul li span {
    font-weight: 700;
    font-size: 15px;
}
.order_summery p i {
    margin-right: 10px;
}
span.payment_name {
    text-transform: capitalize;
    font-weight: 700;
    color: #DD1D21;
    display: block;
}
/*a.payment_btn {*/
/*    background: #37D274;*/
/*    color: #fff;*/
/*    padding: 5px 10px;*/
/*    border-radius: 5px;*/
/*    font-weight: 600;*/
/*}*/
.payment_status_system {
    display: flex;
    justify-content: space-between;
}
.billing_left {
    width: 50%;
}

.billing_right {
    width: 50%;
}

.order_billing ul li i {
    width: 20px;
}
.product_price {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.product-order-summery {
    margin-bottom: 20px;
    border-top: 2px solid #ddd;
    padding: 10px;
}
.order-date h6 span {
    display: block;
}

.order-date h6 {
    font-size: 12px;
}

</style>
    <main class="main">
        <div class="container mt-50">
            <div class="row">
                <div class="col-lg-11 mb-40 mx-auto py-4">
                    <div class=" py-4 px-3 shadow-sm" style="background-color: #FFECCA; border-radius: 5px; color: black;">
                        <div class="timeline order-tracking-area">
                            <div class="order-tracking">
                                <div class="invoice-header">
                                    <div class="invoice-info d-flex justify-content-between align-items-center mb-20">
                                        <h6 style="color: black">Invoice No: <span style="color: #FF914D; font-weight: bold">{{ $order->invoice_no }}</span></h6>
                                        <strong> Date: {{ date_format($order->created_at,"Y-m-d") }}</strong>
                                    </div>

                                    <div class="progress-container">
                                        <div class="progress" id="progress"
                                            @if($order->delivery_status == 'confirmed') style="width: 20%;" @elseif($order->delivery_status == 'confirmed' || $order->delivery_status == 'processing')style="width: 40%;" @elseif($order->delivery_status == 'confirmed' || $order->delivery_status == 'processing' || $order->delivery_status == 'picked_up')style="width: 58%;"@elseif($order->delivery_status == 'confirmed' || $order->delivery_status == 'processing' || $order->delivery_status == 'picked_up'|| $order->delivery_status == 'shipped')style="width: 76%;"@elseif($order->delivery_status == 'confirmed' || $order->delivery_status == 'processing' || $order->delivery_status == 'picked_up'|| $order->delivery_status == 'shipped'|| $order->delivery_status == 'delivered')style="width: 96%;"@else style="width: 0%;" @endif
                                        ></div>
                                        @if ($order->delivery_status == 'cancelled')
                                        <div class="progressing">
                                            <div class="circle @if($order->delivery_status == 'cancelled' || $order->delivery_status == 'pending' ||  $order->delivery_status == 'confirmed' || $order->delivery_status == 'processing' || $order->delivery_status == 'picked_up' || $order->delivery_status == 'shipped' || $order->delivery_status == 'delivered') active @endif" style="
                                                background-color: red;
                                                border-color: red;
                                            ">
                                                <i class="fa fa-close "></i>

                                            </div>
                                            <span class="progress-size">Canceled</span>
                                        </div>
                                        @endif
                                        <div class="progressing">
                                            <div class="circle @if($order->delivery_status == 'pending' || $order->delivery_status == 'confirmed' || $order->delivery_status == 'processing' || $order->delivery_status == 'picked_up' || $order->delivery_status == 'shipped' || $order->delivery_status == 'delivered') active @endif">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <span class="progress-size">Pending</span>
                                        </div>

                                        <div class="progressing">
                                            <div class="circle @if($order->delivery_status == 'confirmed' || $order->delivery_status == 'processing' || $order->delivery_status == 'picked_up' || $order->delivery_status == 'shipped' || $order->delivery_status == 'delivered') active @endif">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <span class="progress-size">Confirmed</span>
                                        </div>

                                        <div class="progressing">
                                            <div class="circle @if($order->delivery_status == 'processing' || $order->delivery_status == 'picked_up' || $order->delivery_status == 'shipped' || $order->delivery_status == 'delivered') active @endif">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <span class="progress-size">Processing</span>
                                        </div>

                                        <div class="progressing">
                                            <div class="circle @if($order->delivery_status == 'picked_up' || $order->delivery_status == 'shipped' || $order->delivery_status == 'delivered') active @endif">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <span class="progress-size">Picked Up</span>
                                        </div>

                                        <div class="progressing">
                                            <div class="circle @if($order->delivery_status == 'shipped' || $order->delivery_status == 'delivered') active @endif">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <span class="progress-size">Shipped</span>
                                        </div>

                                        <div class="progressing">
                                            <div class="circle @if($order->delivery_status == 'delivered') active @endif">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <span class="progress-size">Delivered</span>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="order-body">
                                    @foreach($order->order_status as $value)
                                    <div class="row single-order-tracking">
                                        <div class="order-date">
                                          <h6>{{ date_format(date_create($value->created_at),"d M" ) }} <span>{{ date_format(date_create($value->created_at),"H:i a" ) }} </span></h6>
                                        </div>
                                        <div class="order-content">
                                          <h6>{{ $value->title }}</h6>
                                        </div>
                                    </div>
                                    @endforeach
                              </div> --}}

                                <div class="product-detail pt-20 product-order-summery">
                                    <div class="product-heading pb-10">
                                        <h5 style="color: black">Products</h5>
                                    </div>
                                    <div class="row">
                                        @foreach ($order->order_details as $key => $orderDetail)
                                        <div class="col-md-4">
                                            <div class="product_image">
                                                <a href="#"><img class="item_image" alt="" src="{{ asset($orderDetail->product->product_thumbnail ?? ' ') }}"></a>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                           <div class="product_content">
                                               <span>{{$orderDetail->product->name_en ?? ' '}}</span>

                                               <div class="product_price">
                                                   <div class="price_qty">
                                                       <strong>৳ {{ $orderDetail->price ?? '0.00' }} x {{ $orderDetail->qty ?? '0' }}</strong>
                                                    </div>
                                                   <div class="subtotal">
                                                       <strong>৳ {{ $orderDetail->price*$orderDetail->qty ?? '0.00' }}</strong>
                                                      </div>
                                               </div>
                                           </div>
                                        </div>
                                        {{-- <hr> --}}
                                        @endforeach
                                    </div>
                                </div>

                                <div class="order_summery product-order-summery">
                                    <h5 style="color: black">Order Summery</h5>
                                    <ul class="mt-2">
                                        <li>
                                            <span>Subtotal </span>
                                            <strong>৳ {{ $order->sub_total ?? '0.00' }}</strong>
                                        </li>
                                        @if($order->order_type==3)
                                            <li>
                                                <span>Addon(5% for Installment) </span>
                                                <strong>৳ {{ $order->sub_total*0.05 }}</strong>
                                            </li>
                                        @endif
                                        <li>
                                            <span>Shipping Cost </span>
                                            <strong>৳ {{ $order->shipping_charge }}</strong>
                                        </li>
                                        @if($order->coupon)
                                        <li>
                                            <span>Discount </span>
                                            <strong>
                                                @if ($order->coupon != Null)
                                                ৳ {{ $order->coupon  }}
                                                @else
                                                ৳ 0
                                                @endif
                                            </strong>
                                        </li>
                                        @endif
                                        <hr>
                                        <li>
                                            <span>Grand total </span>
                                            <strong>৳ {{ $order->grand_total ?? '0.00' }}</strong>
                                            
                                           
                                        </li>
                                    </ul>
                                    {{-- <p>*Order Delivery Policy for this order can be found <strong><a href="#">here</a></strong></p>
                                    <p><i class="fa fa-truck"></i>For this order these <strong><a href="#">Delivery Charges</a></strong> are applicables.</p> --}}
                                </div>
                                <div class="payment_status product-order-summery">

                                    <div class="payment_status_system">
                                        <h5 style="color: black">Order Status</h5>
                                        <Span>
                                            @if ($order->delivery_status == 'cancelled')
                                            <strong style="color: red"> {{ $order->delivery_status }}</strong>
                                            @else
                                            <strong>{{ $order->delivery_status }}</strong>
                                            @endif



                                        </Span>
                                    </div>
                                </div>
                              @if($order->order_type == 3)
                                <div class="payment_status product-order-summery">
                                <div class="payment_status_system">
                                        <h5 style="color: black">Payment Status</h5>
                                        <a href="#" class="payment_btn">
                                            @php
    			                                
    			                                if($order->paid_amount == $order->grand_total) {
                                                    $status = '<span class="badge rounded-pill alert-success">Paid</span>';
    			                                }
                                                elseif($order->paid_amount < $order->grand_total && $order->paid_amount > 0) {
                                                    $status = '<span class="badge rounded-pill alert-warning">Partially Paid</span>';
    			                                }
                                                else {
                                                    $status = '<span class="badge rounded-pill alert-danger">Unpaid</span>';
                                                }

    			                            @endphp
                                            {!! $status !!}
                                        </a>
                                      

                                    </div>
                                    <div class="payment_status_system">
                                    <h5 style="color: black">First Paid Amount</h5>
                                    <span style="display: inline-block;">
                                        {{ $order->first_pay_amount ?? '0' }} ({{ $order->paid_date ?? 'Not yet' }})
                                    </span>
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
                @endif
                                    </div>
                          


                                @if ($order->order_type != 3)
                                <div class="payment_status product-order-summery">

                                    <div class="payment_status_system">
                                        <h5 style="color: black">Payment Status</h5>
                                        <a href="#" class="payment_btn">
                                            @php
    			                                $status = $order->payment_status;
    			                                if($order->payment_status == 0) {
    			                                    $status = '<span class="badge rounded-pill alert-danger">Unpaid</span>';
    			                                }
                                                elseif($order->payment_status == 1) {
    			                                    $status = '<span class="badge rounded-pill alert-success">Paid</span>';
    			                                }

    			                            @endphp
                                            {!! $status !!}
                                        </a>
                                    </div>
                                        <div class="payment_system">
                                            <span class="payment_name">@if($order->payment_method == 'cod') Cash On Delivery @else {{ $order->payment_method }} @endif</span>
                                            <span>Account <strong>৳ {{ $order->grand_total }}</strong></span>
                                        </div>
                                </div>
                                @endif

                                <div class="order_billing d-flex product-order-summery" style="margin-left: 18px;">
                                    <div class="billing_left">
                                        <h5 style="color: black">Bill Form</h5>
                                        <ul style="margin-top: 10px;">
                                            <li>
                                                <i class="fa fa-calendar-days"></i>
                                                <span class="font-15">{{ get_setting('business_name')->value ?? ''}}</span>
                                            </li>
                                            <li>
                                                <i class="fa fa-location-dot"></i>
                                                <span class="font-15">{{ get_setting('business_address')->value ?? ''}}</span>
                                            </li>
                                            <li>
                                               <i class="fa fa-phone"></i>
                                               <span class="font-15">{{ get_setting('phone')->value ?? ''}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="billing_right">
                                        <h5 style="color: black">Bill To</h5>
                                          <ul style="margin-top: 10px;">
                                            <li>
                                                <i class="fa fa-user"></i>
                                                <span class="font-15">{{ $order->name ?? ''}}</span>
                                            </li>
                                            <li>
                                                <i class="fa fa-location-dot"></i>
                                                <span class="font-15">{{ $order->address ?? ''}}</span>
                                            </li>
                                            <li>
                                               <i class="fa fa-phone"></i>
                                               <span class="font-15">{{ $order->phone ?? ''}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" ></script>
    <script>
        const progress = document.getElementById('progress');
        const prev = document.getElementById('prev');
        const next = document.getElementById('next');
        const circles = document.querySelectorAll('.circle');

        let currentActive = 1;

        next.addEventListener('click', () => {
            currentActive++

            if (currentActive > circles.length) {
                currentActive = circles.length;
            }

            update();
        });

        prev.addEventListener('click', () => {
            currentActive--

            // prevents currentActive from going below 1
            if (currentActive < 1) {
                currentActive = 1;
            }

            update();
        });

        function update() {
            circles.forEach((circle, idx) => {
                if (idx < currentActive) {
                    circle.classList.add('active')
                } else {
                    circle.classList.remove('active')
                }
            });

            const actives = document.querySelectorAll('.active');
            progress.style.width = (actives.length - 1) / (circles.length - 1) * 70 + '%';

            // disables prev when you can't go back further, disables next when there are no more steps
            if (currentActive === 1) {
                prev.disabled = true;
            } else if (currentActive === circles.length) {
                next.disabled = true;
            } else {
                prev.disabled = false;
                next.disabled = false;
            }
        };

    </script>
@endsection
