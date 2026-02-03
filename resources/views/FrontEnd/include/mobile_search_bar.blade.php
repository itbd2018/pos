<div class="w3-ch-sideBar bg-theme w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="Search">
    <div class="rightMenu-scroll">
        <div class="d-flex bg-theme align-items-center justify-content-between slide-head py-3 px-3">
            <h4 class="cart_heading fs-md ft-medium mb-0">Search Products</h4>
            <button onclick="closeSearch()" class="close_slide"><i class="ti-close"></i></button>
        </div>

        <div class="cart_action px-3 py-4">
{{--            <form class="bg-white rounded-md border-bold" >--}}
{{--                @csrf--}}
{{--                <div class="input-group">--}}
{{--                    <input type="text" class="form-control custom-height b-0" name="search" placeholder="Search for products..." />--}}
{{--                    <div class="input-group-append">--}}
{{--                        <div class="input-group-text"><button class="btn bg-white text-danger custom-height rounded px-3" type="submit"><i class="fas fa-search"></i></button></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
            <form class="form m-0 p-0" action="{{ route('product.search')}}" method="post">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="search" placeholder="Product Keyword.." />
                </div>

{{--                <div class="form-group">--}}
{{--                    <select class="custom-select">--}}
{{--                        <option value="1" selected="">Choose Category</option>--}}
{{--                        <option value="2">Men's Store</option>--}}
{{--                        <option value="3">Women's Store</option>--}}
{{--                        <option value="4">Kid's Fashion</option>--}}
{{--                        <option value="5">Inner Wear</option>--}}
{{--                    </select>--}}
{{--                </div>--}}

                <div class="form-group mb-0">
                    <button type="submit" class="btn d-block full-width " style="border-radius:5px; background-color:#FF914D; color:white">Search Product</button>
                </div>
            </form>
        </div>

{{--        <div class="d-flex align-items-center justify-content-center br-top br-bottom py-2 px-3">--}}
{{--            <h4 class="cart_heading fs-md mb-0">Hot Categories</h4>--}}
{{--        </div>--}}

{{--        <div class="cart_action px-3 py-3">--}}
{{--            <div class="row">--}}
{{--                <div class="col-xl-4 col-lg-4 col-md-4 col-4 mb-3">--}}
{{--                    <div class="cats_side_wrap text-center">--}}
{{--                        <div class="sl_cat_01"><div class="d-inline-flex align-items-center justify-content-center p-3 circle mb-2 gray"><a href="javascript:void(0);" class="d-block"><img src="{{asset('FrontEnd')}}/assets/img/tshirt.png" class="img-fluid" width="40" alt="" /></a></div></div>--}}
{{--                        <div class="sl_cat_02"><h6 class="m-0 ft-medium fs-sm"><a href="javascript:void(0);">T-Shirts</a></h6></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xl-4 col-lg-4 col-md-4 col-4 mb-3">--}}
{{--                    <div class="cats_side_wrap text-center">--}}
{{--                        <div class="sl_cat_01"><div class="d-inline-flex align-items-center justify-content-center p-3 circle mb-2 gray"><a href="javascript:void(0);" class="d-block"><img src="{{asset('FrontEnd')}}/assets/img/pant.png" class="img-fluid" width="40" alt="" /></a></div></div>--}}
{{--                        <div class="sl_cat_02"><h6 class="m-0 ft-medium fs-sm"><a href="javascript:void(0);">Pants</a></h6></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xl-4 col-lg-4 col-md-4 col-4 mb-3">--}}
{{--                    <div class="cats_side_wrap text-center">--}}
{{--                        <div class="sl_cat_01"><div class="d-inline-flex align-items-center justify-content-center p-3 circle mb-2 gray"><a href="javascript:void(0);" class="d-block"><img src="{{asset('FrontEnd')}}/assets/img/fashion.png" class="img-fluid" width="40" alt="" /></a></div></div>--}}
{{--                        <div class="sl_cat_02"><h6 class="m-0 ft-medium fs-sm"><a href="javascript:void(0);">Women's</a></h6></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xl-4 col-lg-4 col-md-4 col-4 mb-3">--}}
{{--                    <div class="cats_side_wrap text-center">--}}
{{--                        <div class="sl_cat_01"><div class="d-inline-flex align-items-center justify-content-center p-3 circle mb-2 gray"><a href="javascript:void(0);" class="d-block"><img src="{{asset('FrontEnd')}}/assets/img/sneakers.png" class="img-fluid" width="40" alt="" /></a></div></div>--}}
{{--                        <div class="sl_cat_02"><h6 class="m-0 ft-medium fs-sm"><a href="javascript:void(0);">Shoes</a></h6></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xl-4 col-lg-4 col-md-4 col-4 mb-3">--}}
{{--                    <div class="cats_side_wrap text-center">--}}
{{--                        <div class="sl_cat_01"><div class="d-inline-flex align-items-center justify-content-center p-3 circle mb-2 gray"><a href="javascript:void(0);" class="d-block"><img src="{{asset('FrontEnd')}}/assets/img/television.png" class="img-fluid" width="40" alt="" /></a></div></div>--}}
{{--                        <div class="sl_cat_02"><h6 class="m-0 ft-medium fs-sm"><a href="javascript:void(0);">Television</a></h6></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xl-4 col-lg-4 col-md-4 col-4 mb-3">--}}
{{--                    <div class="cats_side_wrap text-center">--}}
{{--                        <div class="sl_cat_01"><div class="d-inline-flex align-items-center justify-content-center p-3 circle mb-2 gray"><a href="javascript:void(0);" class="d-block"><img src="{{asset('FrontEnd')}}/assets/img/accessories.png" class="img-fluid" width="40" alt="" /></a></div></div>--}}
{{--                        <div class="sl_cat_02"><h6 class="m-0 ft-medium fs-sm"><a href="javascript:void(0);">Accessories</a></h6></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>
</div>
