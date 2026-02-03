@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    @php
        $totalRegularPrice = session('totalRegularPrice');
        $totalBuyingPrice = session('totalBuyingPrice');
    @endphp

    <section class="content-main">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="content-header">
                    <h2 class="content-title">Add Product</h2>
                    <div class="">
                        <a href="{{ route('product.all') }}" class="btn btn-primary px-3" title="Product List"><i
                                class="fa fa-list" style="margin-top: 3px"></i> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 mx-auto">
                <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3>Basic Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-md-12 mb-4 d-none">
                                    <label for="product_type" class="col-form-label" style="font-weight: bold;">Product
                                        Type:</label>
                                    <select class="form-control" id="product_type" name="product_type"
                                        onchange="toggleProductFields()" required>
                                        <option value="1">Single Product</option>
                                        <option value="2">Group Product</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="product_name_en" class="col-form-label" style="font-weight: bold;">Product
                                        Name <span class="text-danger">*</span></label>
                                    <input class="form-control" id="product_name_en" type="text" name="name_en" required
                                        placeholder="Write product name english" value="{{ old('name_en') }}">
                                    @error('name_en')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="product_name_bn" class="col-form-label" style="font-weight: bold;">Product
                                        Name (Bn):</label>
                                    <input class="form-control" id="product_name_bn" type="text" name="name_bn"
                                        placeholder="Write product name bangla" value="{{ old('name_bn') }}">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="product_category" class="col-form-label" style="font-weight: bold;">Brand:
                                        <span class="text-danger">*</span></label>
                                    @php
                                        $selectedCategory = 0;
                                    @endphp
                                    <div class="custom_select">
                                        <select class="form-control select-active w-100 form-select select-nice"
                                            name="category_id" id="product_category" required>
                                            <option disabled hidden {{ old('category_id') ? '' : 'selected' }} readonly
                                                value="">--Select Category--</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name_en }}</option>
                                                @foreach ($category->childrenCategories as $childCategory)
                                                    @include('backend.include.child_category', [
                                                        'child_category' => $childCategory,
                                                    ])
                                                @endforeach
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4" id="supplier_field">
                                    <label for="supplier_id" class="col-form-label"
                                        style="font-weight: bold;">Supplier:</label>
                                    <div class="custom_select">
                                        <select class="form-control select-active w-100 form-select select-nice"
                                            name="supplier_id" id="supplier_id">
                                            <option {{ old('supplier_id') ? '' : 'selected' }} readonly value="">
                                                --Select Supplier--</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}"
                                                    {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                                    {{ $supplier->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">








                                <div class="col-md-6 mb-4 d-none" id="unit_field">
                                    <label for="unit_id" class="col-form-label" style="font-weight: bold;">Unit
                                        Type:</label>
                                    <div class="custom_select">
                                        <select class="form-control select-active w-100 form-select select-nice"
                                            name="unit_id" id="unit_id">
                                            <option disabled hidden {{ old('unit_id') ? '' : 'selected' }} readonly
                                                value="">--Select Unit Type--</option>
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}"
                                                    {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                                                    {{ $unit->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 d-none" id="unit_weight_field">
                                    <label for="unit_weight" class="col-form-label" style="font-weight: bold;">Unit
                                        Weight (e.g. 10 mg, 1 Carton, 15 Pcs)</label>
                                    <input class="form-control" id="unit_weight" type="number" min="0"
                                        name="unit_weight" placeholder="Write unit weight"
                                        value="{{ old('unit_weight') }}">
                                </div>
                            </div>
                            <!-- row //-->
                        </div>
                        <!-- card body .// -->
                    </div>
                    <!-- card .// -->

                    <div class="card" id="package_products_field" style="display: none">
                        <div class="card-header" style="background-color: #fff !important;">
                            <h3 style="color: #4f5d77 !important">Package Products</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Variation Start -->
                                <div class="col-md-12">
                                    <label for="products" class="col-form-label"
                                        style="font-weight: bold;">Products:</label>
                                    <div class="custom_select cit-multi-select">
                                        <select name="group_id[]"
                                            class="form-control select-active form-select select-nice" id="products"
                                            multiple="multiple" data-placeholder="Choose Product"
                                            style="width: 908px !important;">
                                            @foreach (\App\Models\Product::where('product_type', 1)->orderBy('created_at', 'desc')->get() as $product)
                                                <option value="{{ $product->id }}">{{ $product->name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" id="discount_table">

                                </div>
                                <!-- Variation End -->
                            </div>
                        </div>
                    </div>

                    {{-- <div class="card " id="product_variation_field">
					<!--<div class="card-header" style="background-color: #fff !important;">-->
					<!--	<h3 style="color: #4f5d77 !important">Product Variation</h3>-->
					<!--</div>-->
		   <!--     	<div class="card-body">-->
		   <!--     		<div class="row">-->
	                        <!-- Variation Start -->
	    <!--                    <div class="col-md-12 mb-4">-->
				 <!--               <div class="custom_select cit-multi-select">-->
				 <!--               	<label for="choice_attributes" class="col-form-label" style="font-weight: bold;">Attributes:</label>-->
     <!--                               <select class="form-control select-active w-100 form-select select-nice" name="choice_attributes[]" id="choice_attributes" multiple="multiple" data-placeholder="Choose Attributes">-->
					<!--                	@foreach ($attributes as $attribute)-->
					<!--                		<option value="{{ $attribute->id }}">{{ $attribute->name }}</option>-->
					<!--               		@endforeach-->
     <!--                               </select>-->
     <!--                           </div>-->
	    <!--                    </div>-->

	    <!--                    <div class="col-md-12 mb-4">-->
	    <!--                    	<div class="customer_choice_options" id="customer_choice_options">-->

	    <!--                    	</div>-->
	    <!--                    </div>-->
	                        <!-- Variation End -->
		   <!--     		</div>-->
		   <!--     	</div>-->
		        </div> --}}
                    <!-- card //-->

                    <div class="card">
                        <div class="card-header" style="background-color: #fff !important;">
                            <h3 style="color: #4f5d77 !important">Pricing</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-4 ">
                                    <label for="purchase_price" class="col-form-label" style="font-weight: bold;">Product
                                        Buying Price:</label>
                                    <input class="form-control" id="totalBuyingPriceInput" type="number" min="0"
                                        name="purchase_price" placeholder="Write product bying price">
                                    @error('purchase_price')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4 d-none" id="whole_sell_price_field">
                                    <label for="whole_sell_price" class="col-form-label" style="font-weight: bold;">Whole
                                        Sell Price:</label>
                                    <input class="form-control" id="whole_sell_price" type="number"
                                        name="wholesell_price" placeholder="Write product whole sell price"
                                        min="0" value="{{ old('wholesell_price', 0) }}">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="regular_price" class="col-form-label" style="font-weight: bold;">Selling
                                        Price: <span class="text-danger">*</span></label>
                                    <input class="form-control" type="number" min="0"
                                        id="totalRegularPriceInput" name="regular_price" required
                                        placeholder="Write product selling price">
                                    @error('regular_price')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4 d-none " id="whole_sell_quantity_field">
                                    <label for="whole_sell_qty" class="col-form-label" style="font-weight: bold;">Whole
                                        Sell Minimum Quantity:</label>
                                    <input class="form-control" id="whole_sell_qty" type="number" min="0"
                                        name="wholesell_minimum_qty" placeholder="Write product whole sell qty"
                                        value="{{ old('wholesell_minimum_qty', 0) }}">
                                </div>
                            </div>
                            <!-- Row //-->
                            <div class="row">

                                <div class="col-md-6 mb-4">
                                    <label for="discount_price" class="col-form-label"
                                        style="font-weight: bold;">Discount Price: <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" id="discount_price" type="number" id="discount_price"
                                        name="discount_price" value="{{ old('discount_price', 0) }}" min="0"
                                        placeholder="Write product discount value" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="discount_type" class="col-form-label" style="font-weight: bold;">Discount
                                        Type:</label>
                                    <div class="custom_select">
                                        <select class="form-control select-active w-100 form-select select-nice"
                                            name="discount_type" id="discount_type">
                                            <option value="1">Flat</option>
                                            <option value="2">Percent %</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 d-none">
                                    <label for="minimum_buy_qty" class="col-form-label "
                                        style="font-weight: bold;">Minimum Buy Quantity:</label>
                                    <input class="form-control" id="minimum_buy_qty" type="number"
                                        name="minimum_buy_qty" placeholder="Write product qty"
                                        value="{{ old('minimum_buy_qty', 1) }}" min="1">
                                    @error('minimum_buy_qty')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-4 ">
                                    <label for="stock_qty" class="col-form-label" style="font-weight: bold;">Stock
                                        Quantity: <span class="text-danger">*</span></label>
                                    <input class="form-control" id="stock_qty" type="number" name="stock_qty"
                                        value="{{ old('stock_qty', 1) }}" min="1"
                                        placeholder="Write product stock  qty" required>
                                    @error('stock_qty')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                {{-- Container for Serial Numbers --}}
                                {{-- <div class="col-md-12 mb-4" id="serial_numbers_wrapper"></div> --}}


                                <!-- Product Attribute Price combination Starts -->
                                <div class="col-12 mt-2 mb-2 text-white" id="variation_wrapper">
                                    <label for="" class="col-form-label" style="font-weight: bold;">Price
                                        Variation:</label>
                                    <table class="table table-bordered" id="combination_table">
                                        <thead class="text-dark text-center">
                                            <tr>
                                                <th>Variant</th>
                                                <th>Price</th>
                                                <th>SKU</th>
                                                <th>Quantity</th>
                                                <th>Photo <span class="text-danger">*</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- Product Attribute Price combination Ends -->
                            </div>
                            <!-- Row //-->
                        </div>
                    </div>
                    <!-- card //-->
                    @if (Auth::guard('admin')->user()->role == 1)
                        <div class="card d-none">
                            <div class="card-header" style="background-color: #fff !important;">
                                <h3 style="color: #4f5d77 !important">Points</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Points Start -->
                                    <div class="col-md-12 mb-4">
                                        <label for="long_descp_en" class="col-form-label"
                                            style="font-weight: bold;">Product Points</label>
                                        <input type="number" min="0" name="points" class="form-control"
                                            placeholder=" Add Points">
                                    </div>
                                    <!-- Points End -->
                                </div>
                            </div>
                        </div>
                    @endif


                    <!-- Stock Visibility Switch -->
                    {{-- <div class="card mb-3">
                        <div class="card-header" style="background-color: #fff !important;">
                            <h3 style="color: #4f5d77 !important">Send Product for separate Stock</h3>
                            <small class="text-muted">
                                When checked, this Product will not be showed on the website But store on the Storage. Sure?
                            </small>
                        </div>
                        <div class="card-body">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="is_stock" name="is_stock"
                                    value="1">
                                <label class="form-check-label fw-bold" for="is_stock">
                                    Do you want to this product (In Stock) ?
                                </label>
                            </div>

                        </div>
                    </div> --}}

                    <div class="card">
                        <div class="card-header" style="background-color: #fff !important;">
                            <h3 style="color: #4f5d77 !important">Short Description</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Description Start -->
                                <div class="col-md-12 mb-4">
                                    <label for="long_descp_en" class="col-form-label"
                                        style="font-weight: bold;">Description: <span class="text-danger">*</span></label>
                                    <textarea name="short_description_en" id="short_description_en" class="form-control"
                                        placeholder="Write Short Description English">
                                        </textarea>
                                </div>
                                <div class="col-md-6 mb-4 d-none">
                                    <label for="long_descp_bn" class="col-form-label"
                                        style="font-weight: bold;">Description (Bn):</label>
                                    <textarea name="short_description_bn" id="short_description_bn" class="form-control d-none"
                                        placeholder="Write Short Description Bangla">
                                        </textarea>
                                </div>
                                <!-- Description End -->
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" style="background-color: #fff !important;">
                            <h3 style="color: #4f5d77 !important">Detailed Description</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Description Start -->
                                <div class="col-md-12 mb-4">
                                    <label for="long_descp_en" class="col-form-label"
                                        style="font-weight: bold;">Description: <span class="text-danger">*</span></label>
                                    <textarea name="description_en" id="description_en" rows="2" cols="2" class="form-control"
                                        placeholder="Write Long Description English">{{ old('description_en') }}</textarea>
                                </div>
                                <div class="col-md-6 mb-4 d-none">
                                    <label for="long_descp_bn" class="col-form-label"
                                        style="font-weight: bold;">Description (Bn):</label>
                                    <textarea name="description_bn" id="description_bn" rows="2" cols="2" class="form-control"
                                        placeholder="Write Long Description Bangla">{{ old('description_bn') }}</textarea>
                                </div>
                                <!-- Description End -->
                            </div>
                        </div>
                    </div>
                    <!-- card //-->

                    {{-- products faqs and subtitle start --}}
                    {{-- <div class="card">
                        <div class="faq_&subtitle" id="faq_&subtitle">
                            <div class="card-header" style="background-color: #fff !important;">
                                <h3 style="color: #4f5d77 !important">Product FAQs and subtitles</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <label for="product_name_en" class="col-form-label"
                                            style="font-weight: bold;">Product
                                            Subtitle - 1 (Optional)</label>
                                        <textarea name="subtitle_1" id="subtitle_1" rows="2" cols="2" class="form-control"
                                            placeholder="Write Subtitle 1">{{ old('subtitle_1') }}</textarea>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label for="product_name_en" class="col-form-label"
                                            style="font-weight: bold;">Product
                                            Subtitle - 2 (Optional)</label>
                                        <textarea name="subtitle_2" id="subtitle_2" rows="2" cols="2" class="form-control"
                                            placeholder="Write Subtitle 2">{{ old('subtitle_2') }}</textarea>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label for="product_name_en" class="col-form-label"
                                            style="font-weight: bold;">Product
                                            Subtitle - 3 (Optional)</label>
                                        <textarea name="subtitle_3" id="subtitle_3" rows="2" cols="2" class="form-control"
                                            placeholder="Write Subtitle 3">{{ old('subtitle_3') }}</textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <label class="col-form-label fw-bold">Product FAQs(Optional)</label>

                                        <div id="faq-wrapper">


                                            <div class="faq-item row align-items-end mb-3">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="faqs[0][question]"
                                                        placeholder="Enter Question">
                                                </div>

                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" name="faqs[0][answer]"
                                                        placeholder="Enter Answer">
                                                </div>

                                                <div class="col-md-1">
                                                    <button type="button"
                                                        class="btn btn-success add-faq w-100">+</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> --}}

                    {{-- products faqs and subtitle end --}}






                    <div class="card">
                        <div class="card-header" style="background-color: #fff !important;">
                            <h3 style="color: #4f5d77 !important">Product Image</h3>
                        </div>
                        <div class="card-body">
                            <!-- Porduct Image Start -->
                            <div class="mb-4">
                                <label for="product_thumbnail" class="col-form-label" style="font-weight: bold;">Product
                                    Image: <span class="text-danger">*</span></label>
                                <input required type="file" name="product_thumbnail" class="form-control"
                                    id="product_thumbnail" onChange="mainThamUrl(this)">
                                <img src="" class="p-2" id="mainThmb">
                                @error('product_thumbnail')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="multiImg" class="col-form-label" style="font-weight: bold;">Product
                                    Gallery
                                    Image:</label>
                                <input type="file" name="multi_img[]" class="form-control" multiple=""
                                    id="multiImg">
                                <div class="row  p-2" id="preview_img">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="product_thumbnail" class="col-form-label"
                                        style="font-weight: bold;">Video Thumbnail:</label>
                                    <input type="file" name="video_thumbnail" class="form-control"
                                        id="video_thumbnail">
                                    @error('video_thumbnail')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4 ">
                                    <label for="stock_qty" class="col-form-label" style="font-weight: bold;">Video
                                        URL:</label>
                                    <input class="form-control" id="video_url" type="text" name="video_url"
                                        value="{{ old('video_url') }}" placeholder="Write Video URL Here">
                                    @error('video_url')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <!-- Porduct Image End -->

                            <!-- ✅ Wrapper Start -->
                            <div id="extraFieldsWrapper">
                                <!-- Checkbox Start -->
                                <div class="mb-4">
                                    <div class="row">
                                        <div class="custom-control custom-switch d-none">
                                            <input type="checkbox" class="form-check-input me-2 cursor" name="is_deals"
                                                id="is_deals" value="1">
                                            <label class="form-check-label cursor" for="is_deals">Today's Deal</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="custom-control custom-switch d-none">
                                            <input type="checkbox" class="form-check-input me-2 cursor" name="is_digital"
                                                id="is_digital" value="1">
                                            <label class="form-check-label cursor" for="is_digital">Digital</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="form-check-input me-2 cursor"
                                                name="is_featured" id="is_featured" value="1">
                                            <label class="form-check-label cursor" for="is_featured">Featured</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="form-check-input me-2 cursor"
                                                name="is_trending" id="is_trending" value="1">
                                            <label class="form-check-label cursor" for="is_trending">Trending</label>
                                        </div>
                                    </div>
                                    <div class="row d-none">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="form-check-input me-2 cursor"
                                                name="is_replaceable" id="is_replaceable" value="1">
                                            <label class="form-check-label cursor"
                                                for="is_replaceable">Replaceable</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="form-check-input me-2 cursor" name="status"
                                                id="status" checked value="1">
                                            <label class="form-check-label cursor" for="status">Status</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Checkbox End -->
                            </div>
                            <!-- Wrapper End -->
                        </div>
                    </div>
                    <!-- card -->

                    <div class="row mb-4 justify-content-sm-end">
                        <div class="col-lg-2 col-md-4 col-sm-5 col-6">
                            <input type="submit" id="submitButton" class="btn btn-primary" value="Publish">
                        </div>
                    </div>

                </form>
            </div>
            <!-- col-6 //-->
            {{-- <div class="col-md-4">
	        <div class="card">
				<div class="card-header">
					<h3>Product Meta</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12 mb-4">
	                        <label for="product_meta_title" class="col-form-label" style="font-weight: bold;">Meta Title</label>
	                        <input class="form-control" id="product_meta_title" type="text" name="product_meta_title" placeholder="Write Product Meta Title" required>
		                </div>
					</div>
				</div>
			</div>
		</div> --}}
            <!-- col-6 //-->
        </div>
    </section>


    <!--  Category Modal -->
    <div class="modal fade" id="category" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header card-header">
                    <h3>Category Create</h3>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="category_store" action="">
                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label class="col-form-label" style="font-weight: bold;">Name English:</label>
                                    <input class="form-control" type="text" id="name_en" name="name_en"
                                        placeholder="Write category name english">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label class="col-form-label" style="font-weight: bold;">Name Bangla:</label>
                                    <input type="text" placeholder="Write category name bangla" id="name_bn"
                                        name="name_bn" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label class="col-form-label" style="font-weight: bold;">Parent Category:</label>
                                    <div class="custom_select">
                                        <select class="form-control select-active form-select select-nice"
                                            style="width: 220px;" name="parent_id" id="parent_id">
                                            <option value="0">--No Parent--</option>
                                            @foreach ($categories as $category)
                                                <option id="cat{{ $category->id }}" value="{{ $category->id }}">
                                                    {{ $category->name_en }}</option>
                                                @foreach ($category->childrenCategories as $childCategory)
                                                    @include('backend.include.child_category', [
                                                        'child_category' => $childCategory,
                                                    ])
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-1 mt-2">
                                <img id="showImage" class="rounded avatar-lg"
                                    src="{{ !empty($editData->profile_image) ? url('upload/admin_images/' . $editData->profile_image) : url('upload/no_image.jpg') }}"
                                    alt="Card image cap" width="100px" height="80px;">
                            </div>
                            <div class="mb-1">
                                <label for="image" class="col-form-label" style="font-weight: bold;">Image:</label>
                                <input name="image" class="form-control" type="file" id="image">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--  Brand Modal -->
    <div class="modal fade" id="brand" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header card-header">
                    <h3>Brand Create</h3>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="brand_store" action="">
                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label class="col-form-label" style="font-weight: bold;">Name English:</label>
                                    <input class="form-control name_en" type="text" name="name_en"
                                        placeholder="Write brand name english">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label class="col-form-label" style="font-weight: bold;">Name Bangla:</label>
                                    <input type="text" placeholder="Write brand name bangla" name="name_bn"
                                        class="form-control name_bn">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <img class="rounded avatar-lg showImage"
                                        src="{{ !empty($editData->profile_image) ? url('upload/admin_images/' . $editData->profile_image) : url('upload/no_image.jpg') }}"
                                        alt="Card image cap" width="100px" height="80px;">
                                </div>
                            </div>
                            <div class="mb-1">
                                <label for="image" class="col-form-label" style="font-weight: bold;">Image:</label>
                                <input name="brand_image" class="form-control brand_image" type="file">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection


    @push('footer-script')
        <!-- CKEditor 4 CDN -->
        <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
        <script>
            if (document.getElementById('short_description_en')) {
                CKEDITOR.replace('short_description_en', {
                    height: 150
                });
            }
            if (document.getElementById('description_en')) {
                CKEDITOR.replace('description_en', {
                    height: 150
                });
            }
            if (document.getElementById('subtitle_1')) {
                CKEDITOR.replace('subtitle_1', {
                    height: 80
                });
            }
            if (document.getElementById('subtitle_2')) {
                CKEDITOR.replace('subtitle_2', {
                    height: 80
                });
            }
            if (document.getElementById('subtitle_3')) {
                CKEDITOR.replace('subtitle_3', {
                    height: 80
                });
            }
        </script>


        <script>
            function makeCombinationTable(el) {
                $.ajax({
                    url: '{{ route('admin.api.attributes.index') }}',
                    type: 'get',
                    dataType: 'json',
                    processData: true,
                    data: $(el).closest('form').serializeArray().filter(function(field) {
                        return field.name.includes('choice');
                    }),
                    success: function(response) {
                        //console.log(response);
                        if (!response.success) {
                            return;
                        }
                        if (Object.keys(response.data).length > 0) {
                            let price = $('#totalRegularPriceInput').val();
                            let qty = $('#stock_qty').val();
                            $('#combination_table tbody').html($.map(response.data, function(item, index) {
                                return `<tr>
									<td>${index}<input type="hidden" name="vnames[]" class="form-control" value="${index}" required></td>
									<td><input type="text" name="vprices[]" class="form-control vdp" value="` + price + `" required></td>
									<td><input type="text" name="vskus[]" class="form-control" required value="sku-${index}"></td>
									<td><input type="text" name="vqtys[]" class="form-control" value="10" required></td>
									<td><input type="file" name="vimages[]" class="form-control" required></td>
								</tr>`;
                            }).join());
                            $('#variation_wrapper').show();
                        } else {
                            $('#combination_table tbody').html();
                        }

                    }
                });
            }
        </script>
        <!-- Attribute -->
        <script type="text/javascript">
            function add_more_customer_choice_option(i, name) {
                $.ajax({
                    type: "POST",
                    url: '{{ route('products.add-more-choice-option') }}',
                    data: {
                        attribute_ids: i,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        $('#customer_choice_options').append(data);
                    }
                });
            }

            $('#choice_attributes').on('change', function() {
                $('#customer_choice_options').html(null);

                $('#choice_attributes').val();
                add_more_customer_choice_option($(this).val(), $(this).text());
            });

            $('#totalRegularPriceInput').on('keyup', function() {
                var price = $('#totalRegularPriceInput').val();
                $('.vdp').val(price);
            });
        </script>

        <!-- Attribute end -->


        <!-- Product Image -->
        <script type="text/javascript">
            function mainThamUrl(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#mainThmb').attr('src', e.target.result).width(100).height(80);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

        <!-- Product MultiImg -->
        <script>
            $(document).ready(function() {
                $('#variation_wrapper').hide();
                $('#multiImg').on('change', function() { //on file input change
                    if (window.File && window.FileReader && window.FileList && window
                        .Blob) //check File API supported browser
                    {
                        var data = $(this)[0].files; //this file data

                        $.each(data, function(index, file) { //loop though each file
                            if (/(\.|\/)(gif|jpe?g|png)$/i.test(file
                                    .type)) { //check supported file type
                                var fRead = new FileReader(); //new filereader
                                fRead.onload = (function(file) { //trigger function on successful read
                                    return function(e) {
                                        var img = $('<img/>').addClass('thumb').attr('src',
                                                e.target.result).width(100)
                                            .height(80); //create image element
                                        $('#preview_img').append(
                                            img); //append image to output element
                                    };
                                })(file);
                                fRead.readAsDataURL(file); //URL representing the file's data.
                            }
                        });

                    } else {
                        alert("Your browser doesn't support File API!"); //if File API is absent
                    }
                });
            });
        </script>


        <!-- Malti Tags  -->
        <script type="text/javascript">
            $(document).ready(function() {
                var tagInputEle = $('.tags-input');
                tagInputEle.tagsinput();
            });
        </script>

        <!-- Ajax Update Category Store -->
        <script type="text/javascript">
            $(document).ready(function(e) {

                $('#category_store').submit(function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('category.ajax.store') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            $('select[name="category_id"]').html(
                                '<option value="" selected="" disabled="">Select Category</option>'
                            );
                            $.each(data.categories, function(key, value) {
                                $('select[name="category_id"]').append('<option value="' +
                                    value.id + '">' + value.name_en + '</option>');
                                $.each(value.children_categories, function(k, sub) {
                                    var stx = '';
                                    for (var i = 0; i < sub.type; i++) {
                                        stx += '--';
                                    }
                                    $('select[name="category_id"]').append(
                                        '<option value="' + sub.id + '">' +
                                        stx + sub.name_en + '</option>');
                                });
                            });

                            // console.log(data);
                            $('#category').modal('hide');
                            $('#showImage').remove();
                            @if (count($categories) > 0)
                                $('#cat{{ $category->id }}').remove();
                            @else
                                $('#cat0').remove();
                            @endif
                            this.reset();
                            // Start Message
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 2000
                            })
                            if ($.isEmptyObject(data.error)) {
                                Toast.fire({
                                    type: 'success',
                                    title: data.success
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: data.error,
                                })
                            }
                            // End Message


                            // alert('Image has been uploaded using jQuery ajax successfully');
                        },

                        error: function(data) {
                            console.log(data);
                        }
                    });
                });
            });
        </script>

        <!-- Ajax Brand Update Store -->
        <script type="text/javascript">
            $(document).ready(function(e) {

                $('#brand_store').submit(function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('brand.ajax.store') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            $('select[name="brand_id"]').html(
                                '<option value="" selected="" disabled="">Select Brand</option>'
                            );
                            $.each(data.brands, function(key, value) {
                                $('select[name="brand_id"]').append('<option value="' +
                                    value.id + '">' + value.name_en + '</option>');
                            });

                            $('#brand').modal('hide');
                            $('.showImage').remove();
                            this.reset();
                            // Start Message
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 2000
                            })
                            if ($.isEmptyObject(data.error)) {
                                Toast.fire({
                                    type: 'success',
                                    title: data.success
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: data.error,
                                })
                            }
                            // End Message

                            // alert('Image has been uploaded using jQuery ajax successfully');
                        },

                        error: function(data) {
                            console.log(data);
                        }
                    });
                });
            });
        </script>


        <!-- modal brand show image  -->
        <script type="text/javascript">
            $(document).ready(function() {
                $('.brand_image').change(function(e) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('.showImage').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(e.target.files['0']);
                });
            });
        </script>

        <script>
            function toggleProductFields() {
                var productType = document.getElementById('product_type').value;
                var brandField = document.getElementById('brand_field');
                var vendorField = document.getElementById('vendor_field');
                var supplierField = document.getElementById('supplier_field');
                var processorTypeField = document.getElementById('processor_type_field');
                var processorModelField = document.getElementById('processor_model_field');
                var generationField = document.getElementById('generation_field');
                var displaySizeField = document.getElementById('display_size_field');
                var displayTypeField = document.getElementById('display_type_field');
                var ramSizeField = document.getElementById('ram_size_field');
                var ramTypeField = document.getElementById('ram_type_field');
                var hddField = document.getElementById('hdd_field');
                var ssdField = document.getElementById('ssd_field');
                var graphicsField = document.getElementById('graphics_field');
                var operatingSystemField = document.getElementById('operating_system_field');
                var specialFeatureField = document.getElementById('special_feature_field');
                var unitField = document.getElementById('unit_field');
                var unitWeightField = document.getElementById('unit_weight_field');
                var productvariation = document.getElementById('product_variation_field');
                var packageproductsfield = document.getElementById('package_products_field');
                var wholesellpricefield = document.getElementById('whole_sell_price_field');
                var wholesellquantityfield = document.getElementById('whole_sell_quantity_field');

                // Hide/Show fields based on the selected product type
                if (productType == '2') {
                    brandField.style.display = 'none';
                    vendorField.style.display = 'none';
                    supplierField.style.display = 'none';
                    unitField.style.display = 'none';
                    unitWeightField.style.display = 'none';
                    productvariation.style.display = 'none';
                    wholesellpricefield.style.display = 'none';
                    wholesellquantityfield.style.display = 'none';
                    packageproductsfield.style.display = 'block';
                } else {
                    brandField.style.display = 'block';
                    vendorField.style.display = 'block';
                    supplierField.style.display = 'block';
                    unitField.style.display = 'block';
                    unitWeightField.style.display = 'block';
                    productvariation.style.display = 'block';
                    packageproductsfield.style.display = 'none';

                }
            }
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#products').on('change', function() {
                    var product_ids = $('#products').val();
                    if (product_ids.length > 0) {
                        $.post('{{ route('group_product.product_discount') }}', {
                            _token: '{{ csrf_token() }}',
                            product_ids: product_ids
                        }, function(data) {
                            $('#discount_table').html(data);

                        });
                    } else {
                        $('#discount_table').html(null);
                    }
                });
            });
        </script>

        {{-- <script type="text/javascript">
    $(document).ready(function() {
        // Function to update the total regular price
        function updateTotalRegularPrice() {
            $.get('/admin/get-total-regular-price', function(data) {
                $('#totalRegularPriceInput').val(data);
            });
        }

        // Function to forget the session value
        function forgetTotalRegularPrice() {
            $.get('/admin/forget-total-regular-price');
        }

        // Call the function initially
        updateTotalRegularPrice();

        // Optionally, set up an interval to periodically update the value
        setInterval(updateTotalRegularPrice, 1000); // Update every 5 seconds (adjust as needed)

        // Forget the session value when the page is reloaded
        $(window).on('beforeunload', function() {
            forgetTotalRegularPrice();
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        // Function to update the total regular price
        function updateTotalBuyingPrice() {
            $.get('/admin/get-total-buying-price', function(data) {
                $('#totalBuyingPriceInput').val(data);
            });
        }

        // Function to forget the session value
        function forgetTotalBuyingPrice() {
            $.get('/admin/forget-total-buying-price');
        }

        // Call the function initially
        updateTotalBuyingPrice();

        // Optionally, set up an interval to periodically update the value
        setInterval(updateTotalBuyingPrice, 1000); // Update every 5 seconds (adjust as needed)

        // Forget the session value when the page is reloaded
        $(window).on('beforeunload', function() {
            forgetTotalBuyingPrice();
        });
    });
</script> --}}
        <script>
            $(document).ready(function() {
                // Variable to track whether any input field is being edited
                var isInputFieldEditing = false;

                // Function to update the total regular price
                function updateTotalRegularPrice() {
                    // Check if the input field is being edited, and if so, do not update
                    var product_type = $('#product_type').val();
                    if (!isInputFieldEditing && product_type == 2) {
                        $.get('/admin/get-total-regular-price', function(data) {
                            $('#totalRegularPriceInput').val(data);
                        });
                    }
                }

                // Function to update the total buying price
                function updateTotalBuyingPrice() {
                    // Check if the input field is being edited, and if so, do not update
                    var product_type = $('#product_type').val();
                    if (!isInputFieldEditing && product_type == 2) {
                        $.get('/admin/get-total-buying-price', function(data) {
                            $('#totalBuyingPriceInput').val(data);
                        });
                    }
                }

                // Function to forget the session value for regular price
                function forgetTotalRegularPrice() {
                    $.get('/admin/forget-total-regular-price');
                }

                // Function to forget the session value for buying price
                function forgetTotalBuyingPrice() {
                    $.get('/admin/forget-total-buying-price');
                }

                // Set up event listeners for input field changes
                $('.form-control').on('focus', function() {
                    isInputFieldEditing = true;
                });

                // Set up event listeners for input field blur
                $('.form-control').on('blur', function() {
                    isInputFieldEditing = false;

                    // Update the total price after editing is finished with a short delay
                    setTimeout(function() {
                        updateTotalRegularPrice();
                        updateTotalBuyingPrice();
                    }, 100); // You can adjust the delay time as needed
                });

                // Set up event listener for clicking elsewhere on the page
                $(document).on('click', function() {
                    // Update the total price after a delay when clicking elsewhere
                    setTimeout(function() {
                        updateTotalRegularPrice();
                        updateTotalBuyingPrice();
                    }, 100); // You can adjust the delay time as needed
                });

                // Optionally, set up an interval to periodically update the values
                setInterval(function() {
                    // Only update if no input field is being edited
                    if (!isInputFieldEditing) {
                        updateTotalRegularPrice();
                        updateTotalBuyingPrice();
                    }
                }, 1000); // Update every 5 seconds (adjust as needed)

                $(window).on('beforeunload', function() {
                    forgetTotalBuyingPrice();
                });
                $(window).on('beforeunload', function() {
                    forgetTotalRegularPrice();
                });
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/pica/dist/pica.min.js"></script>

        <script>
            $(document).ready(function() {
                $(document).on('change', '#product_thumbnail, #multiImg', function(event) {
                    const fileInput = event.target;
                    const files = fileInput.files;

                    //alert('yes');

                    if (files.length > 0) {
                        const dataTransfer = new DataTransfer();
                        const maxWidth = 800; // Max width for the image

                        Array.from(files).forEach(file => {
                            const reader = new FileReader();

                            reader.onload = function(e) {
                                const img = new Image();
                                img.src = e.target.result;

                                img.onload = function() {
                                    const canvas = document.createElement('canvas');
                                    const ctx = canvas.getContext('2d');

                                    const width = maxWidth;
                                    if (maxWidth > img.width) {
                                        width = img.width;
                                    }
                                    const height = (img.height / img.width) * width;

                                    canvas.width = width;
                                    canvas.height = height;

                                    ctx.drawImage(img, 0, 0, width, height);

                                    canvas.toBlob(function(blob) {
                                            const newFile = new File([blob], file.name, {
                                                type: file.type,
                                                lastModified: Date.now()
                                            });

                                            dataTransfer.items.add(newFile);

                                            if (dataTransfer.items.length === files
                                                .length) {
                                                fileInput.files = dataTransfer.files;
                                            }
                                        }, file.type,
                                        0.8); // Adjust the quality parameter as needed
                                };
                            };

                            reader.readAsDataURL(file);
                        });
                    }
                });
            });
        </script>

        {{-- add product serial number multiple --}}
        {{-- <script>
            document.addEventListener("DOMContentLoaded", function() {
                const qtyInput = document.getElementById("stock_qty");
                const wrapper = document.getElementById("serial_numbers_wrapper");

                qtyInput.addEventListener("input", function() {
                    wrapper.innerHTML = ""; // clear previous inputs
                    let qty = parseInt(this.value);

                    if (qty > 0) {
                        for (let i = 1; i <= qty; i++) {
                            let div = document.createElement("div");
                            div.classList.add("mb-2");
                            div.innerHTML = `
                        <label class="form-label fw-bold">Serial Number ${i}</label>
                        <input type="text" name="serial_numbers[]" class="form-control" placeholder="Enter Serial Number ${i}" required>
                    `;
                            wrapper.appendChild(div);
                        }
                    }
                });

                // Trigger on page load if old value exists
                if (qtyInput.value) {
                    qtyInput.dispatchEvent(new Event("input"));
                }
            });
        </script> --}}

        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const stockCheckbox = document.getElementById('is_stock');
                const submitButton = document.getElementById('submit');

                // CKEditor textareas
                const shortDescription = document.getElementById('short_description_en');
                const detailedDescription = document.getElementById('description_en');

                const shortDescriptionCard = shortDescription?.closest('.card');
                const detailedDescriptionCard = detailedDescription?.closest('.card');

                //Product Thumbnail Card
                const productThumbnail = document.getElementById('product_thumbnail');
                const productImageCard = productThumbnail?.closest('.card');

                //FAQ & Subtitle Card
                const faqSubtitleCard = document.getElementById('faq_&subtitle')?.closest('.card');

                function toggleVisibility() {
                    const isStock = stockCheckbox.checked;

                    //Button Text Change
                    if (submitButton) {
                        submitButton.innerText = isStock ? 'Send Stock' : 'Submit';
                    }

                    //Hide / Show Cards
                    if (shortDescriptionCard) shortDescriptionCard.style.display = isStock ? 'none' : '';
                    if (detailedDescriptionCard) detailedDescriptionCard.style.display = isStock ? 'none' : '';
                    if (productImageCard) productImageCard.style.display = isStock ? 'none' : '';
                    if (faqSubtitleCard) faqSubtitleCard.style.display = isStock ? 'none' : '';

                    //FIX REQUIRED ERROR FOR FILE INPUT
                    if (productThumbnail) {
                        if (isStock) {
                            productThumbnail.removeAttribute('required');
                        } else {
                            productThumbnail.setAttribute('required', true);
                        }
                    }

                    //CKEditor Readonly Mode
                    if (window.CKEDITOR) {
                        if (CKEDITOR.instances['short_description_en']) {
                            CKEDITOR.instances['short_description_en'].setReadOnly(isStock);
                        }

                        if (CKEDITOR.instances['description_en']) {
                            CKEDITOR.instances['description_en'].setReadOnly(isStock);
                        }
                    }
                }

                stockCheckbox.addEventListener('change', toggleVisibility);
                toggleVisibility(); //Run on page load

                // Final Submit Validation
                const form = document.querySelector('form');

                form.addEventListener('submit', function(e) {

                    if (CKEDITOR.instances['short_description_en']) {
                        CKEDITOR.instances['short_description_en'].updateElement();
                    }

                    if (CKEDITOR.instances['description_en']) {
                        CKEDITOR.instances['description_en'].updateElement();
                    }

                    // Validate ONLY when NOT stock
                    if (!stockCheckbox.checked) {

                        if (!CKEDITOR.instances['short_description_en'].getData().trim()) {
                            alert('Short Description is required!');
                            e.preventDefault();
                            return false;
                        }

                        if (!CKEDITOR.instances['description_en'].getData().trim()) {
                            alert('Detailed Description is required!');
                            e.preventDefault();
                            return false;
                        }
                    }
                });

            });
        </script>

        <script>
            $(document).ready(function() {
                $('#extra_features').select2({
                    placeholder: "Type & press Enter",
                    tags: true, // ✅ ENABLE FREE TYPING
                    tokenSeparators: [','], // optional
                    width: '100%'
                });
            });
        </script>

        {{-- products faqs qus and answer js --}}
        {{-- <script>
            document.addEventListener('DOMContentLoaded', function() {

                let faqIndex = 1;
                const faqWrapper = document.getElementById('faq-wrapper');

                faqWrapper.addEventListener('click', function(e) {

                    // ✅ ADD FAQ
                    if (e.target.classList.contains('add-faq')) {

                        const newFaq = `
                <div class="faq-item row align-items-end mb-3">
                    <div class="col-md-6">
                        <input type="text" class="form-control"
                            name="faqs[${faqIndex}][question]"
                            placeholder="Enter Question">
                    </div>

                    <div class="col-md-5">
                        <input type="text" class="form-control"
                            name="faqs[${faqIndex}][answer]"
                            placeholder="Enter Answer">
                    </div>

                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger remove-faq w-100">−</button>
                    </div>
                </div>
            `;

                        faqWrapper.insertAdjacentHTML('beforeend', newFaq);
                        faqIndex++;
                    }

                    // ✅ REMOVE FAQ
                    if (e.target.classList.contains('remove-faq')) {
                        e.target.closest('.faq-item').remove();
                    }

                });

            });
        </script> --}}
    @endpush
