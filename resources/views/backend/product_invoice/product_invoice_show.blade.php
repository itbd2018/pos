@extends('admin.admin_master')
@section('admin')
    <style>
        /* Ensure DejaVu Sans for PDF compatibility */
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .content-main {
            padding: 20px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 10px 10px 0 0;
            padding: 15px;
        }

        .card-body {
            padding: 30px;
        }

        .invoice-header {
            /* text-align: center; */
            margin-bottom: 20px;
        }

        .invoice-header h2 {
            font-size: 28px;
            font-weight: bold;
            color: #343a40;
        }

        .invoice-header p {
            font-size: 14px;
            color: #6c757d;
            margin: 5px 0;
        }

        .bill-to {
            margin-bottom: 20px;
        }

        .bill-to h5 {
            font-size: 18px;
            font-weight: bold;
            color: #343a40;
        }

        .bill-to p {
            font-size: 14px;
            color: #6c757d;
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #f1f3f5;
            font-weight: bold;
            color: #343a40;
        }

        .text-right {
            text-align: right;
        }

        .no-border {
            border: none;
        }

        .totals-table td {
            padding: 8px;
            font-size: 14px;
        }

        .totals-table .bold {
            font-weight: bold;
            color: #343a40;
        }

        .amount-in-words {
            font-style: italic;
            color: #6c757d;
            /* text-align: center; */
            border: 1px solid #dee2e6;
            margin: 20px 0;
        }

        .signature-section {
            margin-top: 30px;
        }

        .signature-section hr {
            border-top: 1px solid #6c757d;
            width: 200px;
        }

        .payment-history h4 {
            font-size: 18px;
            font-weight: bold;
            color: #343a40;
            margin-top: -50px;
        }

        .btn-primary,
        .btn-success {
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 14px;
        }

        .btn-primary i,
        .btn-success i {
            margin-right: 5px;
        }
    </style>

    <section class="content-main">
        <div class="content-header">
            <h2 class="content-title card-title">Product Invoice - {{ $invoices->first()->invoice_no }}</h2>
            <div>
                <a href="{{ route('product.all.invoice') }}" title="Add Product" class="btn btn-primary">
                    <i class="fa fa-list" style="margin-top: 3px"></i>
                </a>
                <a href="{{ route('product.invoice.download', $invoices->first()->invoice_no) }}" title="Download PDF"
                    class="btn btn-success">
                    <i class="fa fa-download"></i>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <!-- Invoice Header -->
                        <div class="invoice-header">
                            <h2>INVOICE / BILL</h2>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4>LAPTOP ACHE (ল্যাপটপ আছে)</h4>
                                    <p>41/1 Sha, Uttar Badda<br>Gulshan, Dhaka 1212<br>01901-378164<br>laptopache@gmail.com
                                    </p>
                                </div>
                                <div>

                                    <img src="{{ asset('logo.png') }}" alt="Logo" style="max-width: 100px;">
                                    <p><strong>DATE:</strong> {{ $invoices->first()->created_at->format('d.m.Y') }}</p>
                                    <p><strong>INVOICE NO:</strong> {{ $invoices->first()->invoice_no }}</p>
                                    @if ($invoices->first()->return_status == 'returned')
                                        <p><strong>RETURN STATUS:</strong> <span
                                                class="badge rounded-pill alert-danger">Returned</span></p>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <!-- Bill To -->
                        <div class="bill-to">
                            <h5>BILL TO</h5>
                            <hr>
                            <p>
                                <b>Name:</b> {{ $invoices->first()->name ?? 'N/A' }}<br>
                                <b>Phone:</b> {{ $invoices->first()->phone ?? 'N/A' }}<br>
                                <b>Email:</b> {{ $invoices->first()->email ?? 'N/A' }}<br>
                                <b>Address:</b> {{ $invoices->first()->address ?? 'N/A' }}
                            </p>
                        </div>

                        <!-- Product Table -->
                        <div class="table-responsive">
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
                                            <td>
                                                @if (empty($invoice->product_id))
                                                    <strong>{{ $invoice->product_name ?? 'N/A' }}</strong><br>
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
                                                    <strong>{{ $invoice->product->name_en ?? 'N/A' }}</strong><br>

                                                    @php
                                                        $specs = [];
                                                        if (!empty($invoice->product->processorType->name_en)) {
                                                            $specs[] =
                                                                'Processor: ' .
                                                                $invoice->product->processorType->name_en;
                                                        }
                                                        if (!empty($invoice->product->processorModel->name_en)) {
                                                            $specs[] =
                                                                'Model: ' . $invoice->product->processorModel->name_en;
                                                        }
                                                        if (!empty($invoice->product->ramSize->name_en)) {
                                                            $specs[] =
                                                                'RAM Size: ' . $invoice->product->ramSize->name_en;
                                                        }
                                                        if (!empty($invoice->product->ramType->name_en)) {
                                                            $specs[] =
                                                                'RAM Type: ' . $invoice->product->ramType->name_en;
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
                                            <td class="text-right">{{ number_format($invoice->discount_price, 2) ?? '0' }}
                                            </td>
                                            <td class="text-right">
                                                {{ number_format($invoice->total_price - $invoice->shipping_cost - $invoice->cod_cost, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Totals -->
                        <table class="no-border">
                            <tr>
                                <td class="no-border"></td>
                                <td style="width: 40%;border:none">
                                    <table class="totals-table">
                                        <tr>
                                            <td class="bold">TOTAL</td>
                                            <td class="text-right">{{ number_format($total - $shipping - $cod, 2) }}</td>
                                        </tr>
                                        @if ($cod > 0)
                                            <tr>
                                                <td class="bold">COD Condition Charge</td>
                                                <td class="text-right">{{ number_format($cod, 2) }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="bold">Shipping Charge</td>
                                            <td class="text-right">{{ number_format($shipping, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="bold">Net Payable Amount</td>
                                            <td class="text-right">{{ number_format($total, 2) }}</td>
                                        </tr>

                                        @if ($totalDue > 0)
                                            <tr>
                                                <td class="bold">Advanced</td>
                                                <td class="text-right">{{ number_format($paid, 2) }}</td>
                                            </tr>
                                        @endif

                                        @if ($totalDue > 0)
                                            <tr>
                                                <td class="bold" style="font-size: 20px">Due Balance</td>
                                                <td class="text-right">{{ number_format($totalDue, 2) }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td class="bold" style="font-size: 20px">Paid Balance</td>
                                                <td class="text-right">{{ number_format($total, 2) }}</td>
                                            </tr>
                                        @endif
                                    </table>
                                </td>
                            </tr>
                        </table>



                        @if ($payments->count() > 0)
                            <div class="payment-history">
                                <h4>Payment History</h4>
                                <div class="table-responsive">
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
                                                    <td>
                                                        {{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('d.m.Y') : 'N/A' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            <p class="text-muted">No payment history found for this invoice.</p>
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
                </div>
            </div>
        </div>
    </section>
@endsection
