@extends('admin.admin_master')
@section('admin')
<style type="text/css">
    table, tbody, tfoot, thead, tr, th, td{
        border: 1px solid #dee2e6 !important;
    }
    th{
        font-weight: bolder !important;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Product Wise Stock Report</h2>
    </div>
    <div class="row justify-content-center">
    	<div class="col-sm-10">
    		<div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                   <div class="card-body">
				                <form action="{{ route('stock_report.index') }}" id="filterForm" method="GET">
				                    <div class="form-group row mb-3">
				                        <label class="col-md-6 col-form-label">Sort by Category :</label>
				                        <div class="col-md-6">
				                        	<div class="custom_select">
				                        		<select class="form-select select-active select-nice" onchange="$('#filterForm').submit()" aria-label="Default select example" name="category_id" required>
                                                    <option value="">All</option>
											  @foreach (\App\Models\Category::all() as $key => $category)
				                                    <option value="{{ $category->id }}" @isset($_GET['category_id']){{$_GET['category_id'] == $category->id ? 'selected':''}}@endisset>{{ $category->name_en }}</option>
				                                @endforeach
											</select>
				                        	</div>
				                        </div>
{{--				                        <div class="col-md-2">--}}
{{--				                            <button class="btn btn-primary" style="padding-bottom: 12px;" type="submit"><i class="fa fa-filter" style="padding-top: 10px;"></i></button>--}}
{{--				                        </div>--}}
				                    </div>
				                </form>
				                <table  class="table table-bordered table-hover mb-0">
				                    <thead>
				                        <tr>
				                            <th>Product Name</th>
				                            <th class="text-center">Variant</th>
				                            <th class="text-center">Stock</th>
                                            <th>Unit Price</th>
                                            <th>Stock Price</th>
				                        </tr>
                                    @php $total_stock_price=0; @endphp
				                    </thead>
				                    @if($products->count() > 0)
					                    <tbody>
						                        @foreach ($products as $key => $product)
						                        	@if($product->is_varient)
						                        		@foreach ($product->stocks as $key => $stock)
					                        				<tr>
								                                <td>{{ $product->name_en }}</td>
								                                <td class="text-center">{{ $stock->varient }}</td>
								                                <td class="text-center">{{ $stock->qty }}</td>
								                                <td class="text-center">{{ $stock->price }}</td>
								                                <td class="text-center">{{ $stock_price = $stock->price * $stock->qty }}</td>

								                            </tr>
						                        		@endforeach
						                        	@else
							                            <tr>
							                                <td>{{ $product->name_en }}</td>
							                                <td class="text-center">-</td>
							                                <td class="text-center">{{ $product->stock_qty }}</td>
							                                <td class="text-center">{{ $product->regular_price }}</td>
							                                <td class="text-center">{{ $stock_price = $product->regular_price * $product->stock_qty }}</td>
							                            </tr>
						                            @endif
                                                    @php $total_stock_price += $stock_price; @endphp
						                        @endforeach
                                                <tr>
                                                    <th colspan="4">Total</th>
                                                    <td class="text-center">৳{{$total_stock_price}}</td>
                                                </tr>
					                    </tbody>
				                    @else
					                    <tbody>
					                       <tr>
				                                <td colspan="3" class="text-center">There Are No Products.</td>
				                            </tr>
					                    </tbody>
				                    @endif
				                </table>
				                <div class="pagination-area mt-25 mb-50">
		                            <nav aria-label="Page navigation example">
		                                <ul class="pagination justify-content-end">
		                                    {{ $products->links() }}
		                                </ul>
		                            </nav>
		                        </div>
				            </div>
		                </div>
		            </div>
		            <!-- .row // -->
		        </div>
		        <!-- card body .// -->
		    </div>
		    <!-- card .// -->
    	</div>
    </div>
</section>
@endsection
