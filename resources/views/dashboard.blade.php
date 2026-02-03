@extends('FrontEnd.master')
@section('title')
    Dashboard Nest Online Shop
@endsection
@section('content')
    <style>
        .dashboard .card i {
            font-size: 35px;
            margin-bottom: 10px;
            color: var(--green);
        }

        .m-auto {
            margin: auto !important;
        }

        p:last-child {
            margin-bottom: 0;
        }

        .text-brand {
            color: #0b9fc3 !important;
        }

        @media (min-width: 1200px) .fs-4 {
            font-size: 1.5rem !important;
        }

        .text-center {
            text-align: center !important;
        }

        .fw-bolder {
            font-weight: bolder !important;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        .dashboard-menu ul {
            padding: 0;
            margin: 0;
        }

        .flex-column {
            flex-direction: column !important;
        }

        .nav {
            display: flex;
            flex-wrap: wrap;
            padding-left: 0;
            margin-bottom: 0;
            list-style: none;
        }

        .dashboard-menu ul li:not(:last-child) {
            margin-bottom: 10px;
        }

        .pl-50 {
            padding-left: 50px !important;

        }

        .dashboard .card {
            margin-bottom: 25px;
            color: #313131;
            font-size: 17px;
            font-weight: 500;
            transition: all 0.4s;
            border: 2px solid gainsboro;
            padding: 10px 10px;
            box-shadow: 0 1px 1px rgb(0 0 0 / 10%) !important;
        }

        .dashboard .card i {
            font-size: 35px;
            margin-bottom: 10px;
            color: var(--green);
        }

        .dashboard-menu ul li {
            position: relative;
            border-radius: 10px;
            border: 1px solid #ececec;
            border-radius: 10px;
        }

        .dashboard-menu ul li a.active {
            color: #fff;
            background-color: #ff914d;
            border-radius: 10px;
        }

        .dashboard-menu ul li a {
            font-size: 16px;
            color: #7E7E7E;
            padding: 15px 30px;
            font-family: "Quicksand", sans-serif;
            font-weight: 700;
        }

        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid #ececec;
            border-radius: 0.25rem;
        }

        .account .card .card-header {
            border: 0;
            background: none;
        }

        .card .card-header {
            padding: 1rem;
            margin-bottom: 0;
            background-color: #f7f8f9;
            border-bottom: 1px solid #ececec;
        }

        .card-header:first-child {
            border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
        }

        .card-body {
            flex: 1 1 auto;
            padding: 0rem 1rem;
        }

        .mb-50 {
            margin-bottom: 50px !important;
        }

        .mt-30 {
            margin-top: 30px !important;
        }

        .contact-from-area .contact-form-style button:hover {
            background-color: #3BB77E !important;
        }

        .text-danger {
            color: #FD6E6E !important;
        }

        .contact-from-area .contact-form-style button {
            font-size: 17px;
            font-weight: 500;
            padding: 20px 40px;
            color: #ffffff;
            border: none;
            background-color: #253D4E;
            border-radius: 10px;
            font-family: "Quicksand", sans-serif;
        }

        [type=submit]:not(:disabled),
        button:not(:disabled) {
            cursor: pointer;
        }

        .input-c {
            border: 1px solid #ececec;
            border-radius: 10px;
            height: 64px;
            -webkit-box-shadow: none;
            box-shadow: none;
            padding-left: 20px;
            font-size: 16px;
            width: 100%;
        }

        a,
        button,
        img,
        input,
        span,
        h4 {
            -webkit-transition: all .3s ease 0s;
            transition: all .3s ease 0s;
        }

        .nav-link {
            background: none;
        }

        /*.nav-link:hover, .nav-item li:focus{*/
        /*    background: #E4A521;*/
        /*    border-radius: 10px;*/
        /*    margin: 0;*/
        /*    color: white;*/
        /*}*/


        #orders *,
        .white-content {
            color: #313131 !important;
        }

        .card-body input::placeholder {
            color: #313131 !important;
        }

        .card-body *:not(input, button) {
            color: #313131 !important;
        }
    </style>

    <div class="page-content" style="padding-top: 12px;">
        <div class="container">
            <div class="row mx-0">
                <div class="col-md-3 bg-white py-3 mb-3">
                    <div>
                        <div class="text-center">
                            <img class="m-auto " src="{{ asset('FrontEnd/assets/img/user-image.png') }}" alt="">
                        </div>
                        <p class="fs-4 mt-3 fw-bolder mb-3 text-brand text-center"><span
                                style="font-size: 22px; color:#ff914d;">Hello,
                                {{ Auth::user()->name ?? 'Null' }}</span></p>
                    </div>
                    <div class="dashboard-menu">
                        <ul class="nav flex-column" role="tablist">
                            <li class="nav-item">
                                <a class="mr-0 nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard"
                                    role="tab" aria-controls="dashboard" aria-selected="false"><i
                                        class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="mr-0 nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab"
                                    aria-controls="orders" aria-selected="false"><i
                                        class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                            </li>
                            <li class="nav-item d-none">
                                <a class="mr-0 nav-link d-none" id="orders-tab" data-bs-toggle="tab" href="#return_request"
                                    role="tab" aria-controls="orders" aria-selected="false"><i
                                        class="fi-rs-shopping-bag mr-10"></i>Return Request</a>
                            </li>
                            {{--                                    <li class="nav-item"> --}}
                            {{--                                        <a class="nav-link" id="track-orders-tab" data-bs-toggle="tab" href="#track-orders" role="tab" aria-controls="track-orders" aria-selected="false"><i class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a> --}}
                            {{--                                    </li> --}}
                            {{--                                    <li class="nav-item"> --}}
                            {{--                                        <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="fi-rs-marker mr-10"></i>My Address</a> --}}
                            {{--                                    </li> --}}
                            <li class="nav-item">
                                <a class="mr-0 nav-link" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail"
                                    role="tab" aria-controls="account-detail" aria-selected="true"><i
                                        class="fi-rs-user mr-10"></i>Account details</a>
                            </li>
                            <li class="nav-item">
                                <a class="mr-0 nav-link" id="user-password-tab" data-bs-toggle="tab" href="#user-password"
                                    role="tab" aria-controls="user-password" aria-selected="true"><i
                                        class="fi-rs-user mr-10"></i>Password Change</a>
                            </li>
                            <li class="nav-item">
                                <a class="mr-0 nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fi-rs-sign-out mr-10"></i>
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 dashboard px-md-3 px-0">
                    <div class="tab-content account dashboard-content ">
                        <div class="tab-pane fade active show px-md-0 px-3" id="dashboard" role="tabpanel"
                            aria-labelledby="dashboard-tab">
                            <div class="row">
                                <!--<div class="col-lg-4 col-md-4 col-sm-4 col-6 item text-center">-->
                                <!--    <div class="card">-->
                                <!--        <p><i class="fas fa-coins"></i></p>-->
                                <!--        <span class="mb-4">PENDING POINT</span>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <!--<div class="col-lg-4 col-md-4 col-sm-4 col-6 item text-center">-->
                                <!--    <div class="card">-->
                                <!--        <p><i class="fas fa-coins"></i></p>-->
                                <!--        <span>TOTAL POINT</span>-->
                                <!--        <p>0</p>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <!--<div class="col-lg-4 col-md-4 col-sm-4 col-6 item text-center">-->
                                <!--    <div class="card">-->
                                <!--        <p><i class="fas fa-newspaper"></i></p>-->
                                <!--        <span>TOTAL BLOGS</span>-->
                                <!--        <p>0</p>-->
                                <!--    </div>-->
                                <!--</div>-->

                                <div style="height: 100%" class="col-lg-3 col-md-4 pr-3 pr-md-0 col-sm-4 col-6 item text-center pl-0  pl-md-3">
                                    <div class="card pb-3" style="margin-bottom:16px">
                                        <p><i class="fas fa-box"></i></p>
                                        <span>TOTAL ORDER</span>
                                        <p>{{ count($all) }}</p>
                                    </div>
                                </div>
                                <div style="height: 100%" class="col-lg-3 col-md-4 pr-0 col-sm-4 col-6 item text-center pl-0 pl-md-3 ">
                                    <div class="card pb-3" style="margin-bottom:16px">
                                        <p><i class="fas fa-balance-scale"></i></p>
                                        <span>PENDING ORDER</span>
                                        <p>{{ count($pending) }}</p>
                                    </div>
                                </div>
                                <div style="height: 100%" class="col-lg-3 col-md-4 pr-3 pr-md-0 col-sm-4 col-6 item text-center pl-0  pl-md-3">
                                    <div class="card pb-3" style="margin-bottom:16px">
                                        <p><i class="fas fa-hourglass-start"></i></p>
                                        <span>PROCESSING ORDER</span>
                                        <p>{{ count($processing) }}</p>
                                    </div>
                                </div>
                                <div style="height: 100%" class="col-lg-3 col-md-4 pr-0 col-sm-4 col-6 item text-center pl-0 pl-md-3 ">
                                    <div class="card pb-3" style="margin-bottom:16px">
                                        <p><i class="fas fa-plane"></i></p>
                                        <span>SHIPPING ORDER</span>
                                        <p>{{ count($shipping) }}</p>
                                    </div>
                                </div>
                                <div style="height: 100%" class="col-lg-3 col-md-4 pr-3 pr-md-0 col-sm-4 col-6 item text-center pl-0  pl-md-3">
                                    <div class="card pb-3" style="margin-bottom:16px">
                                        <p><i class="fas fa-thumbs-up"></i></p>
                                        <span>PICKED UP ORDER</span>
                                        <p>{{ count($picked) }}</p>
                                    </div>
                                </div>
                                <div style="height: 100%" class="col-lg-3 col-md-4 pr-0 col-sm-4 col-6 item text-center pl-0 pl-md-3 ">
                                    <div class="card pb-3" style="margin-bottom:16px">
                                        <p><i class="fa fa-window-close"></i></p>
                                        <span>CANCELED ORDER</span>
                                        <p>{{ count($cancelled) }}</p>
                                    </div>
                                </div>
                                <div style="height: 100%" class="col-lg-3 col-md-4 pr-3 pr-md-0 col-sm-4 col-6 item text-center pl-0  pl-md-3">
                                    <div class="card pb-3" style="margin-bottom:16px">
                                        <p><i class="fa fa-font-awesome"></i></p>
                                        <span>COMPLETED ORDER</span>
                                        <p>{{ count($completed) }}</p>
                                    </div>
                                </div>
                                <div style="height: 100%" class="col-lg-3 col-md-4 pr-0 col-sm-4 col-6 item text-center pl-0 pl-md-3 ">
                                    <div class="card pb-3" style="margin-bottom:16px">
                                        <p><i class="fa fa-coins"></i></p>
                                        <span>Earned Points</span>

                                        <p>{{ Auth::guard('admin')->user()->points ?? '0' }}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                            <div class="card  text-dark px-0">
                                <div class="card-header">
                                    <h3 class="mb-0">Your Orders</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive" style="color: white">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Sl</th>
                                                    <th style="white-space: nowrap">Invoice No</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Total</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @if ($orders->count() > 0)
                                                    @foreach ($orders as $key => $order)
                                                        @php
                                                            $datetime1 = strtotime($order->created_at); // convert to timestamps
                                                            $datetime2 = strtotime(date('Y-m-d')); // convert to timestamps
                                                            $days = (int) (($datetime2 - $datetime1) / 86400);
                                                        @endphp
                                                        <input type="hidden" name="" id="invoice_no"
                                                            value="{{ $order->invoice_no }}">
                                                        <tr>
                                                            <td style="white-space: nowrap">{{ $key + 1 }}</td>
                                                            <td style="white-space: nowrap">{{ $order->invoice_no }}</td>
                                                            <td style="white-space: nowrap">{{ \Carbon\Carbon::parse($order->date)->isoFormat('MMM Do YYYY') }}
                                                            </td>
                                                            <td style="white-space: nowrap">{{ $order->delivery_status }}</td>
                                                            <td style="white-space: nowrap">{{ $order->grand_total }}</td>
                                                            <td style="white-space: nowrap">
                                                                <a target="_blank"
                                                                    href="{{ route('order.view', $order->invoice_no) }}"
                                                                    class="btn-small d-block" style="white-space: nowrap">View</a>
                                                                {{--                                                                    <a id="returnBtn" href="#" onclick="checkReturn({{$order->id}})" class="btn-small d-block text-primary">Return</a> --}}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="3"></td>
                                                        <td>
                                                            <span style="white-space: nowrap" class="text-center text-danger">No Orders!</span>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade d-none" id="return_request" role="tabpanel"
                            aria-labelledby="orders-tab">

                            <div class="card ">
                                <div class="card-header">
                                    <h3 class="mb-0">Order Return Requests</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table border="1" class="table">
                                            <thead>
                                                <tr>
                                                    <th>Sl</th>
                                                    <th>Invoice No</th>
                                                    <th>Date</th>
                                                    <th>Product Name</th>
                                                    <th>Issue</th>
                                                    <th>Quantity</th>
                                                    <th>Status</th>
                                                    {{--                                                            <th>Actions</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @if (count($return_requests) > 0)
                                                    @foreach ($return_requests as $key => $request)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $request->order->invoice_no }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($request->created_at)->isoFormat('MMM Do YYYY') }}
                                                            </td>
                                                            <td>{{ $request->product->name_en ?? '' }}</td>
                                                            <td>{{ $request->issue ?? '' }}</td>
                                                            <td>{{ $request->qty ?? '' }}</td>
                                                            <td>
                                                                @if ($request->status == 0)
                                                                    Pending
                                                                @elseif($request->status == 1)
                                                                    Replaced
                                                                @else
                                                                    Rejected
                                                                @endif
                                                            </td>
                                                            {{--                                                                <td> --}}
                                                            {{--                                                                    <button type="button" id="detailBtn" onclick="getDetails({{$request->id}})" class="btn btn-small d-block" style="color: var(--green)">Details</button> --}}
                                                            {{--                                                                </td> --}}
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="5" class="text-center"><span
                                                                class="text-center text-danger"> No
                                                                Requests!</span></td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="request_details">

                            </div>

                            @isset($returning_products)
                                @if (count($returning_products) > 0)
                                @endif
                            @endisset
                        </div>
                        <div class="tab-pane fade" id="track-orders" role="tabpanel" aria-labelledby="track-orders-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="mb-0">Orders tracking</h3>
                                </div>
                                <div class="card-body contact-from-area">
                                    <p>To track your order please enter your OrderID in the box below and press
                                        "Track" button. This was given to you on your receipt and in the
                                        confirmation email you should have received.</p>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <form class="contact-form-style mt-30 mb-50" action="#" method="post">
                                                <div class="input-style mb-20">
                                                    <label>Order ID</label>
                                                    <input class="input-c" name="order-id"
                                                        placeholder="Found in your order confirmation email"
                                                        type="text" />
                                                </div>
                                                <div class="input-style mb-20">
                                                    <label>Billing email</label>
                                                    <input class="input-c" name="billing-email"
                                                        placeholder="Email you used during checkout" type="email" />
                                                </div>
                                                <button class="submit submit-auto-width" type="submit">Track</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                            <h3 class="mb-0">Billing Address</h3>
                            <div class="row mt-3">
                                @php
                                    $id = Auth::user()->id;
                                    $addresses = App\Models\Address::where('user_id', $id)->latest()->get();
                                @endphp
                                @foreach ($addresses as $key => $address)
                                    <div class="col-lg-6 mb-3">
                                        <div class="card mb-lg-0 position-relative">
                                            <div class="card-body">
                                                @if ($address->is_default)
                                                    <p
                                                        style="position:absolute;bottom: 11px;right: 19px;padding: 2px;background: #fc0000;font-weight: 600;font-size: 14px;color: #fff;border-radius: 20px;">
                                                        Default</p>
                                                @endif
                                                <div class="dropdown"
                                                    style="float: right; position: absolute;top: 9px;right: 17px;">
                                                    <a href="#" data-bs-toggle="dropdown"
                                                        class="text-white rounded btn-sm font-sm"
                                                        style="background-color:#3bb77e"> <i
                                                            class="material-icons md-more_horiz"></i>:</a>
                                                    <div class="dropdown-menu">

                                                        @if (!$address->is_default)
                                                            <a class="dropdown-item"
                                                                href="{{ route('addresses.set_default', $address->id) }}">Make
                                                                This Default</a>
                                                        @endif
                                                        <a class="dropdown-item text-danger"
                                                            href="{{ route('user.addresses.destroy', $address->id) }}"
                                                            id="delete">Delete</a>
                                                    </div>
                                                </div>
                                                <address>
                                                    Address {{ $key + 1 }}
                                                </address>
                                                <p>
                                                    {{ $address->address }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#userAddressEdit">Edit info</a>
                                <!-- Modal -->
                                <div class="modal fade" id="userAddressEdit" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Address Edit</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form method="post" action="#">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group col-lg-6">
                                                            <label for="division_id"
                                                                class="fw-bold text-black col-form-label"><span
                                                                    class="text-danger">*</span> Division</label>
                                                            <select class="form-select"
                                                                aria-label="Default select example" name="division_id"
                                                                id="division_id" required>
                                                                <option selected>Select Division</option>
                                                                @foreach (get_divisions() as $division)
                                                                    <option value="{{ $division->id }}">
                                                                        {{ ucwords($division->division_name_en) }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('division_id')
                                                                <span>{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <label for="district_id"
                                                                class="fw-bold text-black col-form-label"><span
                                                                    class="text-danger">*</span> District</label>
                                                            <select class="form-select"
                                                                aria-label="Default select example" name="district_id"
                                                                id="district_id" required>
                                                                <option selected="" value="">Select
                                                                    District</option>
                                                            </select>
                                                            @error('district_id')
                                                                <span>{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <label for="upazilla_id"
                                                                class="fw-bold text-black col-form-label"><span
                                                                    class="text-danger">*</span> Upazilla</label>
                                                            <select class="form-select"
                                                                aria-label="Default select example" name="upazilla_id"
                                                                id="upazilla_id" required>
                                                                <option selected="" value="">Select
                                                                    Upazilla</option>
                                                            </select>
                                                            @error('upazilla_id')
                                                                <span>{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <label for="address"
                                                                class="fw-bold text-black col-form-label"><span
                                                                    class="text-danger">*</span>Address:</label>
                                                            <textarea class="form-control" name="address" id="address" required placeholder="Address"></textarea>
                                                            @error('address')
                                                                <span>{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" id="md_checkbox_29"
                                                                class="form-check-input cursor" name="is_default"
                                                                checked="" value="1">
                                                            <label for="md_checkbox_29" class="form-check-label cursor"
                                                                style="  cursor: pointer; font-weight: semibold; padding-left: 8px;">
                                                                Is Default</label>
                                                        </div>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="form-check-input me-2 cursor"
                                                                name="status" id="status" checked value="1">
                                                            <label style="cursor: pointer;"
                                                                class="form-check-label cursor"
                                                                for="status">Status</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-lg-6">
                                    <button class="btn btn-small" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop">Create New Address</button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Create New
                                                    Address</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form method="post" action="{{ route('user.address.store') }}">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group col-lg-6">
                                                            <label for="division_id"
                                                                class="fw-bold text-black col-form-label"><span
                                                                    class="text-danger">*</span> Division</label>
                                                            <select class="form-select"
                                                                aria-label="Default select example" name="division_id"
                                                                id="division_id" required>
                                                                <option selected>Select Division</option>
                                                                @foreach (get_divisions() as $division)
                                                                    <option value="{{ $division->id }}">
                                                                        {{ ucwords($division->division_name_en) }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('division_id')
                                                                <span>{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <label for="district_id"
                                                                class="fw-bold text-black col-form-label"><span
                                                                    class="text-danger">*</span> District</label>
                                                            <select class="form-select"
                                                                aria-label="Default select example" name="district_id"
                                                                id="district_id" required>
                                                                <option selected="" value="">Select
                                                                    District</option>
                                                            </select>
                                                            @error('district_id')
                                                                <span>{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <label for="upazilla_id"
                                                                class="fw-bold text-black col-form-label"><span
                                                                    class="text-danger">*</span> Upazilla</label>
                                                            <select class="form-select"
                                                                aria-label="Default select example" name="upazilla_id"
                                                                id="upazilla_id" required>
                                                                <option selected="" value="">Select
                                                                    Upazilla</option>
                                                            </select>
                                                            @error('upazilla_id')
                                                                <span>{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <label for="address"
                                                                class="fw-bold text-black col-form-label"><span
                                                                    class="text-danger">*</span>Address:</label>
                                                            <textarea class="form-control" name="address" id="address" required placeholder="Address"></textarea>
                                                            @error('address')
                                                                <span>{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" id="md_checkbox_29"
                                                                class="form-check-input cursor" name="is_default"
                                                                value="0">
                                                            <label for="md_checkbox_29" class="form-check-label cursor"
                                                                style="  cursor: pointer; font-weight: semibold; padding-left: 8px;">
                                                                Is Default</label>
                                                        </div>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="form-check-input me-2 cursor"
                                                                name="status" id="status" checked value="1">
                                                            <label style="cursor: pointer;"
                                                                class="form-check-label cursor"
                                                                for="status">Status</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="account-detail" role="tabpanel"
                            aria-labelledby="account-detail-tab">
                            <div class="card ">
                                <div class="card-header">
                                    <h3 class="text-dark">Account Details</h3>
                                </div>
                                <div class="card-body">
                                    <p class="text-dark white-content mb-3"
                                        style="font-size: 20px; font-weight: 400 !important">Already have an account? <a
                                            style="color: #ff914d !important" href="{{ route('login') }}">Log
                                            in instead!</a></p>
                                    <form method="POST" action="{{ route('user.profile.update') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>Full Name <span class="required">*</span></label>
                                                <input required value="{{ Auth::user()->name }}" class="form-control"
                                                    name="name" type="text" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>User Name<span class="required">*</span></label>
                                                <input required value="{{ Auth::user()->username }}" class="form-control"
                                                    name="username" type="text" />
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Phone <span class="required">*</span></label>
                                                <input required value="{{ Auth::user()->phone }}" class="form-control"
                                                    name="phone" type="number" />
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Email Address <span class="required">*</span></label>
                                                <input required value="{{ Auth::user()->email }}" class="form-control"
                                                    name="email" type="email" />
                                            </div>


                                            <div class="mb-4 ml-3">
                                                <label for="image" class="col-form-label col-md-3"
                                                    style="font-weight: semibold; white-space: nowrap; padding:0 0 8px 0;">User Photo:</label>
                                                <div class="input-group" style="position: relative; width: 100%; overflow: hidden;">
                                                    <img style="border-radius: 50% !important" id="showImage" class="rounded  border p-2"
                                                        src="{{ asset(Auth::user()->profile_image) }}"
                                                         width="100px" height="100px;"
                                                        >
                                                   
                                                        <div style="width: 100% !important; display: flex; align-items: center; flex-direction: column;  justify-content: center; position: absolute !important; top: 50% !important; left: 50% !important; transform: translate(-50%, -50%) !important; height: 100% !important; opacity: 0.5; z-index: 1;" >
                                                            <i style="font-size: 20px !important; " class="mt-2 fa fa-upload text-md"></i>
                                                            <p>Upload</p>
                                                            </div>
                                                        <input style="width: 100%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); height: 100% !important; opacity: 0; z-index: 2;" name="profile_image" class="form-control mx-2"
                                                            type="file" id="image">
                                                   
                                                </div>

                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <button type="submit"
                                                    style="background-color: #ff914d !important; color: #ffffff !important; "
                                                    class="btn  submit font-weight-bold">Save
                                                    Change</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="user-password" role="tabpanel"
                            aria-labelledby="user-password-tab">
                            <div class="card ">
                                <div class="card-header ">
                                    <h3 class="text-dark">Password Change</h3>
                                </div>
                                <div class="card-body">
                                    @if (count($errors))
                                        @foreach ($errors->all() as $error)
                                            <p class="alert alert-danger alert-dismissible fade show">
                                                {{ $error }}</p>
                                        @endforeach
                                    @endif
                                    <form method="POST" action="{{ route('user-passwordupdate') }}" name="enq">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label>Current Password <span class="required">*</span></label>
                                                <input class="form-control" required name="oldpassword"
                                                    type="password" />

                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>New Password <span class="required">*</span></label>
                                                <input class="form-control" required name="newpassword"
                                                    type="password" />
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Confirm Password <span class="required">*</span></label>
                                                <input class="form-control" required name="confirm_password"
                                                    type="password" />
                                            </div>
                                            <div class="col-md-12 mb-3" >
                                                <button style="background-color: #ff914d; color: #fff !important" type="submit" class="btn submit font-weight-bold"
                                                    name="submit" value="Submit">Save Change</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>
@endsection

@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!--  Division To District Show Ajax -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="division_id"]').on('change', function() {
                var division_id = $(this).val();
                // const divArray = division.split("-");
                // var division_id = divArray[0];
                // $('#division_name').val(divArray[1]);
                if (division_id) {
                    $.ajax({
                        url: "{{ url('/division-district/ajax') }}/" + division_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="district_id"]').html(
                                '<option value="" selected="" disabled="">Select District</option>'
                            );
                            $.each(data, function(key, value) {
                                // console.log(value);
                                $('select[name="district_id"]').append(
                                    '<option value="' + value.id + '">' +
                                    capitalizeFirstLetter(value.district_name_en) +
                                    '</option>');
                            });
                            $('select[name="upazilla_id"]').html(
                                '<option value="" selected="" disabled="">Select District</option>'
                            );
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

        function miniCart() {
            $.ajax({
                type: 'GET',
                url: '/product/mini/cart',
                dataType: 'json',
                success: function(response) {
                    // alert(response);
                    //checkout();
                    $('span[id="cartSubTotal"]').text(response.cartTotal);
                    $('#cartSubTotalShi').val(response.cartTotal);
                    $('.cartQty').text(Object.keys(response.carts).length);
                    $('#total_cart_qty').text(Object.keys(response.carts).length);

                    var miniCart = "";

                    if (Object.keys(response.carts).length > 0) {
                        $.each(response.carts, function(key, value) {
                            //console.log(value);
                            var slug = value.options.slug;
                            var base_url = window.location.origin;
                            miniCart += `

                            <div class="item-cart mb-20">
                                            <div class="cart-image"><img src="/${value.options.image}" alt="Ecom"></div>
                                    <div class="cart-info"><a class="font-sm-bold color-brand-3" href="${base_url}/product-details/${slug}">${value.name}</a>

                                <p><span class="color-brand-2 font-sm-bold">${value.qty} x ${value.price}</span></p>
                                <div class="shopping-cart-delete">
                                        <a  id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fi-rs-cross-small"></i></a>
                                    </div>
                            </div>
                        </div>`

                        });

                        $('#miniCart').html(miniCart);
                        $('#miniCart_empty_btn').hide();
                        $('#miniCart_btn').show();
                    } else {
                        html = '<h4 class="text-center">Cart empty!</h4>';
                        $('#miniCart').html(html);
                        $('#miniCart_btn').hide();
                        $('#miniCart_empty_btn').show();
                    }
                }
            });
        }
        /* ============ Function Call ========== */
        miniCart();
    </script>

    <!--  District To Upazilla Show Ajax -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="district_id"]').on('change', function() {
                var district_id = $(this).val();
                // const divArray = district.split("-");
                // var division_id = divArray[0];
                // $('#district_name').val(divArray[1]);
                if (district_id) {
                    $.ajax({
                        url: "{{ url('/district-upazilla/ajax') }}/" + district_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var d = $('select[name="upazilla_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="upazilla_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .name_en + '</option>');
                                $('select[name="upazilla_id"]').append(
                                    '<option  class="d-none" value="' + value.id +
                                    '">' + value.name_en + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>
    <script>
        function checkReturn(id) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                icon: 'success',
                showConfirmButton: false,
                timer: 1200
            });
            $.ajax({
                type: 'get',
                url: 'order/return/check/' + id,
                dataType: 'json',
                success: function(data) {
                    // console.log(data);

                    // Start Sweertaleart Message
                    if (data.result) {
                        var invoice = data.order.invoice_no;
                        console.log(invoice);
                        window.location.href = 'order/return/' + invoice;
                    } else {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1200
                        });

                        Toast.fire({
                            type: 'error',
                            title: data.error
                        });
                    }
                    // Start Sweertaleart Message


                }
            });
        }

        function getDetails(id) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                icon: 'success',
                showConfirmButton: false,
                timer: 1200
            });
            $.ajax({
                type: 'get',
                url: '/get-returning-product/' + id,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    if (data.result) {


                    } else {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1200
                        });

                        Toast.fire({
                            type: 'error',
                            title: data.error
                        });
                    }
                    // Start Sweertaleart Message


                }
            });
        }
    </script>
@endpush
