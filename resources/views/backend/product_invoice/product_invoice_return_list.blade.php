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
    </style>

    <section class="content-main">
        <div class="content-header d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-2 mb-3">
            <div>
                <h2 class="content-title card-title mb-2 mb-md-0">Product Invoice Return List</h2>
            </div>
            <div class="d-flex flex-row gap-2">
                <a href="{{ route('product.invoice.create') }}" title="Add Product" class="btn btn-primary d-flex align-items-center"><i class="material-icons md-plus me-1"></i> <span class="d-none d-sm-inline">Add Product</span></a>
                <a href="{{ route('product.all.invoice') }}" class="btn btn-primary d-flex align-items-center px-3" title="Product List"><i class="fa fa-list me-1" style="margin-top: 3px"></i> <span class="d-none d-sm-inline">Product List</span></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <!-- card-header end// -->
                    <div class="card-body">

                        <div class="table-responsive-sm">
                            <table class="table table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>Customer</th>                                       
                                        <th>Product Name</th>
                                        <th>Return Date</th>
                                        <th>Invoice No</th>
                                        <th>Code</th>
                                        <th>Qty</th>
                                        <th>Total Price</th>
                                        <th>Paid Amount</th>
                                        <th>Due Amount</th>
                                        <th>Return Amount</th>
                                        <th>Return Status</th>
                                        

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($returns as $key => $item)
                                        <tr>
                                            <td>{{ $item->productInvoice->name ?? '' }}</td>
                                            @if(!empty($item->productInvoice->product_id))
                                                <td>{{ $item->productInvoice->product->name_en ?? '' }}</td>
                                            @else
                                                <td>{{ $item->productInvoice->product_name ?? '' }}</td>
                                            @endif
                                            <td>{{ Carbon\Carbon::parse($item->return_date)->format('d, M Y') }}</td>
                                            <td>{{ $item->productInvoice->invoice_no ?? '' }}</td>
                                            <td>{{ $item->productInvoice->product_code ?? '' }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->productInvoice->total_price ?? '' }}</td>
                                            <td>{{ $item->productInvoice->paid_amount ?? '' }}</td>
                                            <td>{{ $item->productInvoice->due_amount ?? '' }}</td>
                                            <td>{{ $item->refund_amount ?? '' }}</td>
                                            <td>
                                                <span class="badge rounded-pill alert-danger">Returned</span>
                                            </td>
                                            

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-area mt-25 mb-50">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end">
                                        {{ $returns->links() }}
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
