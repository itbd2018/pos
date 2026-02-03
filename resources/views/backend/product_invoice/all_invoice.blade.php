@extends('admin.admin_master')
@section('admin')
    <style type="text/css">
        table,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td {
            border: 1px solid #dee2e6 !important;
        }

        th {
            font-weight: bolder !important;
        }

        /* Responsive table styles */
        @media (max-width: 767px) {
            .responsive-table {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            table.table {
                width: 100%;
                min-width: 700px;
                font-size: 13px;
            }

            th,
            td {
                white-space: nowrap;
            }
        }
    </style>

    <section class="content-main">
        <div
            class="content-header d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-2 mb-3">
            <div>
                <h2 class="content-title card-title mb-2 mb-md-0">Product Invoice List</h2>
            </div>
            <div class="d-flex flex-row gap-2">
                <a href="{{ route('product.invoice.create') }}" title="Add Product"
                    class="btn btn-primary d-flex align-items-center"><i class="material-icons md-plus me-1"></i> <span
                        class="d-none d-sm-inline">Add Invoice</span></a>
                <a href="{{ route('product.return.list') }}" title="Return List"
                    class="btn btn-primary d-flex align-items-center"><i class="fa fa-arrow-left me-1"
                        style="margin-top: 3px"></i> <span class="d-none d-sm-inline">Return List</span></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <!-- card-header end// -->
                    <div class="card-body">

                        <div class="responsive-table table-responsive">
                            <table id="example" class="table table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Phone</th>
                                        <th>Product Name</th>
                                        <th>Serial Number</th>
                                        <th>Invoice No</th>
                                        {{-- <th>Code</th> --}}
                                        <th>Qty</th>
                                        <th>Total Price</th>
                                        <th>Paid Amount</th>
                                        <th>Due Amount</th>
                                        <th>Due Date</th>
                                        <th>COD</th>
                                        <th>Payment Status</th>
                                        <th>Payment Method</th>
                                        <th>Return Status</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $key => $item)
                                        <tr>
                                            <td>{{ $item->name ?? '' }}</td>
                                            <td>{{ $item->phone ?? '' }}</td>
                                            @if (!empty($item->product_id))
                                                <td>{{ $item->product->name_en ?? '' }}</td>
                                            @else
                                                <td>{{ $item->product_name }}</td>
                                            @endif

                                            <td>{{ $item->serial_number ?? '' }}</td>
                                            <td>{{ $item->invoice_no ?? '' }}</td>
                                            {{-- <td>{{ $item->product_code ?? '' }}</td> --}}
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->total_price ?? '' }}</td>
                                            <td>{{ $item->paid_amount ?? '' }}</td>
                                            <td>{{ $item->due_amount ?? '' }}</td>
                                            <td>{{ $item->due_date ?? '' }}</td>
                                            <td>{{ $item->shipping_cost ?? '' }}</td>
                                            <td>
                                                @if ($item->payment_status == 'paid')
                                                    <span class="badge rounded-pill alert-success">Paid</span>
                                                @elseif ($item->payment_status == 'partial')
                                                    <span class="badge rounded-pill alert-danger">Partial</span>
                                                @else
                                                    <span class="badge rounded-pill alert-warning">Un-Paid</span>
                                                @endif
                                            </td>
                                            @php
                                                $paymentMethod = $item->payments->first()->payment_method ?? null;
                                            @endphp
                                            <td>
                                                @if ($paymentMethod == 'cash')
                                                    <span class="badge rounded-pill alert-success">Cash</span>
                                                @elseif ($paymentMethod == 'bank')
                                                    <span class="badge rounded-pill alert-info">Bank</span>
                                                @elseif ($paymentMethod == 'bkash')
                                                    <span class="badge rounded-pill alert-warning">Bkash</span>
                                                @elseif ($paymentMethod == 'nagad')
                                                    <span class="badge rounded-pill alert-primary">Nagad</span>
                                                @else
                                                    <span class="badge rounded-pill alert-info">Credit Card</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->return_status == 'returned')
                                                    <span class="badge rounded-pill alert-danger">Returned</span>
                                                @else
                                                    <span class="badge rounded-pill alert-warning">Not Returned</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-light btn-sm border-0 p-1" type="button"
                                                        id="actionMenu{{ $item->id }}" data-bs-toggle="dropdown"
                                                        aria-expanded="false" style="background: transparent;">
                                                        <i class="fa-solid fa-ellipsis-vertical fa-lg"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm rounded-3"
                                                        aria-labelledby="actionMenu{{ $item->id }}">
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center"
                                                                href="{{ route('product.invoice.edit', $item->invoice_no) }}">
                                                                <i class="fa-solid fa-pen-to-square me-2"></i> Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center text-danger"
                                                                href="{{ route('product.invoice.delete', $item->invoice_no) }}"
                                                                onclick="return confirm('Are you sure you want to delete this invoice?')">
                                                                <i class="fa-solid fa-trash me-2"></i> Delete
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center text-info"
                                                                href="{{ route('product.invoice.show', $item->invoice_no) }}">
                                                                <i class="fa-solid fa-receipt me-2"></i> Invoice
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-area mt-25 mb-50">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end">
                                        {{ $invoices->links() }}
                                    </ul>
                                </nav>
                            </div>
                        </div>

                        <!-- table-responsive //end -->
                    </div>
                    <!-- card-body end// -->
                </div>
                <!-- card end// -->
            </div>

        </div>
    </section>

    @push('footer-script')
        <script type="text/javascript">
            $(function() {

                $('input[name="date"]').daterangepicker({
                    autoUpdateInput: false,
                    locale: {
                        cancelLabel: 'Clear'
                    }
                });

                $('input[name="date"]').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format(
                        'MM/DD/YYYY'));
                });

                // $('input[name="date"]').on('cancel.daterangepicker', function(ev, picker) {
                //     $(this).val('');
                // });


                var start = moment().subtract(29, 'days');
                var end = moment();

                // start = '';
                // end = '';


                $('input[name="date"]').daterangepicker({
                    autoUpdateInput: false,
                    locale: {
                        cancelLabel: 'Clear'
                    }
                });

                function cb(start, end) {
                    $('#reportrange').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }

                $('#reportrange').daterangepicker({

                    startDate: start,
                    endDate: end,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                            'month').endOf('month')]
                    }
                }, cb);

                cb(start, end);

            });
        </script>
    @endpush
@endsection
