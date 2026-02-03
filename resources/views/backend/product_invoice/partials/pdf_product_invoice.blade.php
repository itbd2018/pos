<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $invoices->first()->invoice_no }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            margin: 10px;
            color: #333333;
        }

        /* .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        } */

        .invoice-header {
            margin-bottom: 10px;
        }

        .invoice-header h2 {
            font-size: 12px;
            font-weight: bold;
            margin: 0;
            color: #000000;
        }

        .invoice-header p {
            font-size: 12px;
            margin: 2px 0;
            line-height: 1.2;
        }



        .bill-to {
            margin-bottom: 10px;
        }

        .bill-to h5 {
            font-size: 12px;
            font-weight: bold;
            margin: 0 0 2px 0;
        }

        .bill-to p {
            margin: 2px 0;
            line-height: 1.2;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th,
        td {
            border: 1px solid #cccccc;
            padding: 4px;
            font-size: 9px;
            text-align: center;
        }

        th {
            background-color: #f5f5f5;
        }

        .text-right {
            text-align: right;
        }

        .no-border {
            border: none;
        }

        .totals-table {
            width: 40%;
            float: right;
        }

        .totals-table td {
            padding: 4px;
            font-size: 8px;
        }

        .totals-table .bold {
            font-weight: bold;
        }

        .amount-in-words {
            font-size: 10px;
            font-weight: bold;
            font-style: italic;
            margin: 10px 0;
            padding: 6px;
            border: 1px solid #cccccc;
            line-height: 1.2;
        }

        .signature-section {
            margin-top: 20px;
        }

        .signature-section table {
            border: none;
        }

        .signature-section hr {
            border-top: 1px solid #333333;
            width: 120px;
            margin: 2px 0;
        }

        .bank-info {
            margin-top: 10px;
            text-align: center;
        }

        .bank-info p {
            margin: 2px 0;
            line-height: 1.2;
        }

        .payment-history {
            margin-top: -30px;
        }

        .payment-history h4 {
            font-size: 12px;
            font-weight: bold;
            margin: 0 0 5px 0;
        }

        .logo {
            max-width: 80px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Invoice Header -->
        <div class="invoice-header" style="width: 100%; padding-bottom: 5px; margin-bottom: 10px;">
            <table style="width: 100%; border: none; border-collapse: collapse;">
                <tr>
                    <!-- Left Side: Company Info -->
                    <td
                        style="width: 50%; vertical-align: top; text-align: left; font-size: 10px; line-height: 1.4; border: none;">
                        <h2 style="font-size: 14px; font-weight: bold; margin: 0 0 3px;">INVOICE / BILL</h2>
                        <p style="font-weight: bold; margin: 0;">LAPTOP ACHE</p>
                        <p style="margin: 2px 0;">
                            41/1 Sha, Uttar Badda,<br>
                            Gulshan, Dhaka 1212,<br>
                            01901-378164,<br>
                            laptopache@gmail.com
                        </p>
                    </td>

                    <!-- Right Side: Logo & Invoice Details -->
                    <td
                        style="width: 50%; vertical-align: top; text-align: right; font-size: 10px; line-height: 1.4; border: none;">
                        <img src="{{ public_path('logo.png') }}" alt="Logo"
                            style="max-width: 100px; margin-bottom: 4px;">
                        <p style="margin: 2px 0;"><strong>DATE:</strong>
                            {{ $invoices->first()->created_at->format('d.m.Y') }}</p>
                        <p style="margin: 2px 0;"><strong>INVOICE NO:</strong> {{ $invoices->first()->invoice_no }}</p>
                        @if ($invoices->first()->return_status == 'returned')
                            <p><strong>RETURN STATUS:</strong> <span style="color: red;">Returned</span></p>
                        @endif
                    </td>
                </tr>
            </table>

        </div>



        <!-- Bill To -->
        <div class="bill-to">
            <h5>BILL TO</h5>
            <hr style="border: 0.3px solid #000; margin: 0 0 5px;">
            <p style="font-size: 12px;">
                <b>Name:</b> {{ $invoices->first()->name ?? 'N/A' }}<br>
                <b>Phone:</b> {{ $invoices->first()->phone ?? 'N/A' }}<br>
                <b>Email:</b> {{ $invoices->first()->email ?? 'N/A' }}<br>
                <b>Address:</b> {{ $invoices->first()->address ?? 'N/A' }}
            </p>
        </div>

        <!-- Product Table -->
        <table>
            <thead>
                <tr>
                    <th>DESCRIPTION</th>
                    <th>PRODUCT CODE</th>
                    <th>QTY</th>
                    <th>UNIT PRICE</th>
                    <th>DISCOUNT PRICE</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                    <tr>
                        <td style="text-align: left;">
                            @if (empty($invoice->product_id))
                                {{ $invoice->product_name ?? 'N/A' }}<br>
                                @if (!empty($invoice->product_description))
                                    {!! $invoice->product_description !!}<br>
                                @endif
                                @if (!empty($invoice->serial_number))
                                    <small>S/L: {{ $invoice->serial_number }}</small><br>
                                @endif
                                @if (!empty($invoice->warrenty))
                                    <small>Warranty: {{ $invoice->warrenty }}</small>
                                @endif
                            @else
                                {{ $invoice->product->name_en ?? 'N/A' }}<br>

                                @php
                                    $specs = [];
                                    if (!empty($invoice->product->processorType->name_en)) {
                                        $specs[] = 'Processor: ' . $invoice->product->processorType->name_en;
                                    }
                                    if (!empty($invoice->product->processorModel->name_en)) {
                                        $specs[] = 'Model: ' . $invoice->product->processorModel->name_en;
                                    }
                                    if (!empty($invoice->product->ramSize->name_en)) {
                                        $specs[] = 'RAM Size: ' . $invoice->product->ramSize->name_en;
                                    }
                                    if (!empty($invoice->product->ramType->name_en)) {
                                        $specs[] = 'RAM Type: ' . $invoice->product->ramType->name_en;
                                    }
                                    if (!empty($invoice->product->hdd->name_en)) {
                                        $specs[] = 'HDD: ' . $invoice->product->hdd->name_en;
                                    }
                                    if (!empty($invoice->product->ssd->name_en)) {
                                        $specs[] = 'SSD: ' . $invoice->product->ssd->name_en;
                                    }
                                @endphp

                                @if (!empty($specs))
                                    <small>{{ implode(', ', $specs) }}</small><br>
                                @endif

                                @if (!empty($invoice->serial_number))
                                    <small>S/L: {{ $invoice->serial_number }}</small><br>
                                @endif

                                @if (!empty($invoice->warrenty))
                                    <small>Warranty: {{ $invoice->warrenty }}</small>
                                @endif
                            @endif
                        </td>
                        <td>{{ $invoice->product_code ?? 'N/A' }}</td>
                        <td>{{ $invoice->quantity ?? '' }}</td>
                        <td class="text-right">{{ number_format($invoice->regular_price, 2) }}</td>
                        <td class="text-right">{{ number_format($invoice->discount_price, 2) ?? '0' }}</td>
                        <td class="text-right">
                            {{ number_format($invoice->total_price - $invoice->shipping_cost - $invoice->cod_cost, 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <table class="no-border">
            <tr>
                <td class="no-border"></td>
                <td class="totals-table" style="border:none;">
                    <table>
                        <tr>
                            <td class="bold" style="padding:4px;font-size:12px;">TOTAL</td>
                            <td class="text-right" style="padding:4px;font-size:12px;">
                                {{ number_format($total - $shipping - $cod, 2) }}</td>
                        </tr>
                        @if ($cod > 0)
                            <tr>
                                <td class="bold" style="padding:4px;font-size:12px;">COD Condition Charge</td>
                                <td class="text-right" style="padding:4px;font-size:12px;">{{ number_format($cod, 2) }}
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td class="bold" style="padding:4px;font-size:12px;">Shipping Charge</td>
                            <td class="text-right" style="padding:4px;font-size:12px;">
                                {{ number_format($shipping, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="bold" style="padding:4px;font-size:12px;">Net Payable Amount</td>
                            <td class="text-right" style="padding:4px;font-size:12px;">{{ number_format($total, 2) }}
                            </td>
                        </tr>

                        @if ($totalDue > 0)
                            <tr>
                                <td class="bold" style="padding:4px;font-size:12px;">Advanced</td>
                                <td class="text-right" style="padding:4px;font-size:12px;">
                                    {{ number_format($paid, 2) }}</td>
                            </tr>
                        @endif

                        @if ($totalDue > 0)
                            <tr>
                                <td class="bold" style="font-size: 20px">Due Balance</td>
                                <td class="text-right" style="padding:4px;font-size:12px;">
                                    {{ number_format($totalDue, 2) }}</td>
                            </tr>
                        @else
                            <tr>
                                <td class="bold" style="font-size: 20px">Paid Balance</td>
                                <td class="text-right" style="padding:4px;font-size:12px;">
                                    {{ number_format($total, 2) }}</td>
                            </tr>
                        @endif

                    </table>
                </td>
            </tr>
        </table>


        <!-- Payment History -->
        @if ($payments->count() > 0)
            <div class="payment-history">
                <h4>Payment History</h4>
                <table>
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Product Code</th>
                            <th>Payment Method</th>
                            <th>Amount</th>
                            <th>Payment Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $key => $payment)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $payment->product_code ?? 'N/A' }}</td>
                                <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</td>
                                <td class="text-right">{{ number_format($payment->amount, 2) }}</td>
                                <td>{{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('d.m.Y') : 'N/A' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Amount in Words -->

        <p class="amount-in-words">{{ $netPayInWords }}</p>


        <!-- Signatures -->
        <div class="signature-section" style="margin-top:50px;">
            <table style="width:100%; border-collapse:collapse;">
                <tr>
                    <td style="border:none; text-align:left; padding-top:40px;">
                        <div style="border-top:1px solid #000; width:30%;"></div>
                        <div style="margin-top:5px;">Customer Signature</div>
                    </td>
                    <td style="border:none; text-align:right; padding-top:40px;">
                        <div style="border-top:1px solid #000; width:30%; float:right;"></div>
                        <div style="margin-top:5px;">Authorized Signature</div>
                    </td>
                </tr>
            </table>
        </div>


    </div>
</body>

</html>
