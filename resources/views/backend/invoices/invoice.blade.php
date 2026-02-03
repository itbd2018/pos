<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>INVOICE</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="UTF-8">
    <style media="all">
        @page {
            margin: 0;
            padding: 0;
        }

        body {
            font-size: 0.875rem;
            font-weight: normal;
            padding: 0;
            margin: 0;
        }

        .gry-color *,
        .gry-color {
            color: #000;
        }

        table {
            width: 100%;
        }

        table th {
            font-weight: normal;
        }

        table.padding th {
            padding: .25rem .7rem;
        }

        table.padding td {
            padding: .25rem .7rem;
        }

        table.sm-padding td {
            padding: .1rem .7rem;
        }

        .border-bottom td,
        .border-bottom th {
            border-bottom: 1px solid #eceff4;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <div>


        <div style="background: #eceff4;padding: 1rem;">
            <table>
                <tr>
                    <td>
                        @php
                            $logo = get_setting('site_favicon')->value;
                        @endphp
                        @if ($logo != null)
                            <div style="display: inline; align-items:center">
                                <img align=""
                                    src="data:image/jpg;base64,{{ base64_encode(file_get_contents(base_path('public/' . $logo))) }}"
                                    style="height: 2.5rem; width: 2.5rem; margin-bottom:-10px!important;"><span
                                    style="color: #E4A521; font-size: 1.5rem;">{{ get_setting('site_name')->value ?? '' }}</span>

                            </div>
                        @else
                            <img src="{{ asset('upload/no_image.jpg') }}" alt="{{ env('APP_NAME') }}"
                                style="max-width: 200px !important;">
                        @endif
                    </td>
                    <td style="font-size: 1.5rem;" class="text-right strong">INVOICE</td>
                </tr>
            </table>
            <table>
                <tr>
                    <td class="text-right"></td>
                </tr>
                <tr>
                    <td class="gry-color small">Email:{{ $order->email }} </td>
                    <td class="text-right small"><span class="gry-color small">Invoice No:
                            :</span> <span class="strong">{{ $order->invoice_no }}</span></td>
                </tr>
                <tr>
                    <td class="gry-color small">Phone:{{ $order->phone }}</td>
                    <td class="text-right small"><span class="gry-color small">Order Date:</span> <span
                            class=" strong">{{ date('d-m-Y', $order->date) }}</span></td>
                </tr>
                <tr>
                    <td class="gry-color small"></td>
                    <td class="text-right small">
                        <span class="gry-color small">
                            Payment method:
                        </span>
                        <span class=" strong">
                            @if ($order->payment_method == 'cash')
                                Cash
                            @else
                                {{ $order->payment_method }}
                            @endif
                        </span>
                    </td>
                </tr>
            </table>

        </div>

        <div style="padding: 1rem;padding-bottom: 0">
            <table>
                <tr>
                    <td class="strong small gry-color">Bill to:</td>
                </tr>
                <tr>
                    <td class="strong">{{ $order->name }}</td>
                </tr>
                @if ($order->order_type == 1)
                    {{-- <tr>
                    <td class="gry-color small">
                        {{ ucwords($order->upazilla->name_en) }},
                        {{ ucwords($order->district->district_name_en) }},
                        {{ ucwords($order->division->division_name_en) }}
                    </td>
                </tr> --}}
                @endif
                <tr>
                    <td class="gry-color small">Email: {{ $order->email }}</td>
                </tr>
                <tr>
                    <td class="gry-color small">Phone: {{ $order->phone }}</td>
                </tr>
                <tr>
                    <td class="gry-color small">Address: {{ $order->address }}</td>
                </tr>
            </table>
        </div>

        <div style="padding: 1rem;">
            <table class="padding text-left small border-bottom">
                <thead>
                    <tr class="gry-color" style="background: #eceff4;">
                        <th width="35%" class="text-left">Product Name</th>
                        <th width="10%" class="text-left">Qty</th>
                        <th width="15%" class="text-left">Unit Price</th>
                        <th width="15%" class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="strong">
                    @foreach ($order->order_details as $key => $orderDetail)
                        @if ($orderDetail->product != null)
                            <tr class="">
                                <td>
                                    {{ $orderDetail->serialNumber->serial_number ?? ' ' }} -
                                    {{ $orderDetail->product->name_en }} ,
                                    @if ($order->order_type == 1)
                                        @if ($orderDetail->is_varient && count(json_decode($orderDetail->variation)) > 0)
                                            @foreach (json_decode($orderDetail->variation) as $varient)
                                                {{ $varient->attribute_name }}, ({{ $varient->attribute_value }})
                                            @endforeach
                                        @endif
                                    @else
                                        {{ $orderDetail->variation }}
                                    @endif
                                </td>
                                <td class="">{{ $orderDetail->qty }}</td>
                                <td class="currency">{{ $orderDetail->price }}</td>
                                <td class="text-right currency">{{ $orderDetail->price * $orderDetail->qty }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="padding:0 1.5rem;">
            <table class="text-right sm-padding small strong">
                <thead>
                    <tr>
                        <th width="60%"></th>
                        <th width="40%"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left">
                            <p class="tm_mb6"><b class="tm_primary_color">Payment Info:</b></p>
                            <p class="tm_m0">Payment Method: Cash on Delivery</p>
                            <p class="tm_m0">Payment Status:
                                @if ($order->order_type == 3)
                                    @php
                                        if ($order->paid_amount == $order->grand_total) {
                                            $status = '<span>Paid</span>';
                                        } elseif (
                                            $order->paid_amount < $order->grand_total &&
                                            $order->paid_amount > 0
                                        ) {
                                            $status = '<span >Partially Paid</span>';
                                        } else {
                                            $status = '<span>Unpaid</span>';
                                        }
                                    @endphp
                                    {!! $status !!}
                                @endif
                                @if ($order->order_type != 3)
                                    @php
                                        if ($order->payment_status == 1) {
                                            $status = '<span>Paid</span>';
                                        } else {
                                            $status = '<span>Unpaid</span>';
                                        }
                                    @endphp
                                    {!! $status !!}
                                @endif


                            </p>


                            @if ($order->order_type == 3)
                                <p class="tm_m0"><b class="tm_primary_color">Order type:</b> Installment</p>
                            @endif

                            @if ($order->order_type == 1)
                                <p class="tm_m0"><b class="tm_primary_color">Order type:</b> Onsite</p>
                            @endif



                        </td>
                        <td>
                            <table class="text-right sm-padding small strong">
                                <tbody>
                                    <tr>
                                        <th class="gry-color text-left">Sub Total</th>
                                        <td class="currency">{{ $order->sub_total }}</td>
                                    </tr>
                                    @if ($order->order_type == 3)
                                        <tr>
                                            <th class="gry-color text-left">Addon(5% for Installment)</th>
                                            <td class="currency">{{ $order->sub_total * 0.05 }}</td>
                                        </tr>
                                    @endif
                                    @if ($order->coupon)
                                        <tr>
                                            <th class="gry-color text-left">Coupon Discount
                                            </th>
                                            <td class="currency">
                                                -{{ $order->coupon }} TK</td>
                                        </tr>
                                    @endif
                                    @if ($order->tax_amount)
                                        <tr>
                                            <th class="gry-color text-left">Tax amount</th>
                                            <td class="currency">{{ $order->tax_amount ?? '' }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th class="gry-color text-left">Shipping Cost</th>
                                        <td class="currency">{{ $order->shipping_charge ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="gry-color text-left">Discount</th>
                                        <td class="currency">{{ $order->discount ?? '' }}</td>
                                    </tr>

                                    @if ($order->order_type == 3)
                                        <tr>
                                            <th class="text-left strong">Grand Total</th>
                                            <td class="currency">
                                                {{ $order->sub_total - $order->coupon + $order->sub_total * 0.05 + $order->shipping_charge ?? ' ' }}
                                                TK</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <th class="text-left strong">Grand Total</th>
                                            <td class="currency">{{ $order->sub_total ?? '' }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <hr>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>
