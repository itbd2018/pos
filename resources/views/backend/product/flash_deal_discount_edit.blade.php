@if(count($product_ids) > 0)
<style type="text/css">
    table, tbody, tfoot, thead, tr, th, td{
        border: 1px solid #dee2e6 !important;
    }
    th{
        font-weight: bolder !important;
    }
</style>
<table class="table table-bordered table-responsive">
  <thead>
  	<tr>
  		<td width="15%">
          <span>Image</span>
  		</td>
      <td width="40%">
          <span>Product Name</span>
      </td>
      <td data-breakpoints="lg" width="20%">
        <span>Product Buying Price</span>
        </td>
        <td data-breakpoints="lg" width="20%">
        <span>Regular Price</span>
        </td>
  	</tr>
  </thead>
  <tbody>
    @php
    $totalRegularPrice = 0; // Initialize the variable to store the total regular price
    $totalBuyingPrice = 0; // Initialize the variable to store the total regular price
    @endphp
      @foreach ($product_ids as $key => $id)
      @php
        $product = \App\Models\Product::findOrFail($id);
        $totalRegularPrice += $product->regular_price; // Add the regular price to the total
        $totalBuyingPrice += $product->purchase_price;
        $campaing_product = \App\Models\CampaingProduct::where('campaing_id', $campaing_id)->where('product_id', $product->id)->first();

      @endphp
      <tr>
          <td>
            <div class="from-group row">
              <div class="col-auto">
                <img class="size-60px img-fit" src="{{ asset($product->product_thumbnail)}}">
              </div>
            </div>
          </td>
          <td>
              <span>{{ $product->name_en ?? 'Null' }}</span>
          </td>
          <td>
              <span>{{ $product->purchase_price ?? 'Null' }}</span>
          </td>
          <td>
              <span>{{ $product->regular_price ?? 'Null' }}</span>
          </td>
      </tr>
      @endforeach

      @php
    session(['totalRegularPrice' => $totalRegularPrice]);
    session(['totalBuyingPrice' => $totalBuyingPrice]);
    @endphp

  </tbody>
</table>
@endif

