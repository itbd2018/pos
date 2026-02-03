<?php

use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Division;
use App\Models\User;
use App\Models\District;
use App\Models\Upazilla;
use App\Models\Page;
use App\Models\Setting;
use App\Models\Attribute;
use App\Models\ProductStock;
use App\Models\Vendor;
use Illuminate\Support\Collection;
use App\Models\AccountLedger;
use App\Utility\CategoryUtility;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ReturningProduct;
use App\Models\OrderDetail;

if (!function_exists('get_setting')) {
    function get_setting($name)
    {
        return Setting::where('name', $name)->first();
    }
}

if (!function_exists('default_language')) {
    function default_language()
    {
        return env("DEFAULT_LANGUAGE");
    }
}


if (!function_exists('guest_checkout')) {
    function guest_checkout()
    {
        return env("GUEST_CHECKOUT");
    }
}

if (!function_exists('demo_mode')) {
    function demo_mode()
    {
        return env("DEMO_MODE");
    }
}

 if (!function_exists('get_cart_data')) {
     function get_cart_data()
     {
         return Cart::content();
     }
 }


// Header categories
if (!function_exists('get_categories')) {
    function get_categories()
    {
        $categories = new Collection;
        $cats = Category::where('status', 1)->orderBy('name_en', 'asc')->latest()->get();
        foreach($cats as $cat){
            $has_sub_sub = 0;
            if($cat->parent_id==0){
                $subcats = new Collection;
                foreach($cats as $subcat){
                    if($subcat->parent_id == $cat->id){
                        $subsubcats = new Collection;
                        foreach($cats as $subsubcat){
                            if($subsubcat->parent_id == $subcat->id){
                                $subsubcats->add($subsubcat);
                            }
                        }
                        if(count($subsubcats) > 0){
                            $subcat->sub_sub_categories = $subsubcats;
                            $has_sub_sub = 1;
                        }
                        $subcats->add($subcat);
                    }
                }
                if(count($subcats) > 0){
                    $cat->sub_categories = $subcats;
                }
                $cat->has_sub_sub = $has_sub_sub;
                $categories->add($cat);
            }
        }
        return $categories;
    }
}

// Search By Side All Categories //
if (!function_exists('get_all_categories')) {
    function get_all_categories()
    {
        $categories = Category::where('status', 1)->latest()->get();
        return $categories;
    }
}
//Footer page
if (!function_exists('get_pages_both_footer')) {
    function get_pages_both_footer()
    {
        return Page::where('status',1)
                ->where('position','Both')
                ->orWhere('position','Bottom')
                ->orderBy('id','ASC')
                ->get();
    }
}
//Footer page
if (!function_exists('get_footer_banner')) {
    function get_footer_banner()
    {
        return Banner::where('status',1)
                ->where('position',0)
                ->orderBy('id','DESC')
                ->first();
    }
}

/* ============ Division Select ============ */
if (!function_exists('get_divisions')) {
    function get_divisions()
    {
        return Division::where('status', 1)->get();
    }
}

/* ========== District Select =========== */
if (!function_exists('get_district_by_division_id')) {
    function get_district_by_division_id($id)
    {
        return District::where('division_id', $id)->where('status', 1)->get();
    }
}

/* ========== Upazilla Select =========== */
if (!function_exists('get_upazilla_by_district_id')) {
    function get_upazilla_by_district_id($id)
    {
        return Upazilla::where('district_id', $id)->get();
    }
}



if (!function_exists('get_guest_user_id')) {
    function get_guest_user_id()
    {
        return User::where('role', 4)->first()->id;
    }
}

if (!function_exists('get_attribute_by_id')) {
    function get_attribute_by_id($id)
    {
        return Attribute::find($id);
    }
}

if (!function_exists('get_product_varient_price')) {
    function get_product_varient_price($id, $varient)
    {
        $stock = ProductStock::where('product_id', $id)->where('varient', $varient)->first();
        if($stock){
            return $stock->price;
        }else{
            return null;
        }
    }
}

if (!function_exists('get_vendors')) {
    function get_vendors()
    {
        return Vendor::where('status', 1)->get();
    }
}

if (!function_exists('get_account_balance')) {
    function get_account_balance()
    {
        $ledger = AccountLedger::latest()->first();
//        if($ledger != null){
            return $ledger->balance;
//        }else{
//            return 0.00;
//        }
    }
}

if (!function_exists('get_category_products')) {
    function get_category_products($slug)
    {
        $category = Category::where('slug', $slug)->first();
        // dd($category);


        $conditions = ['status' => 1];

        $products = Product::where($conditions);

        $category_ids = CategoryUtility::children_ids($category->id);
        $category_ids[] = $category->id;
        //dd($category_ids);

        $products->whereIn('category_id', $category_ids);

        $products = $products->orderBy('created_at', 'desc')->get();

        return $products;
    }
}
function findChildCategory($id)
{
    $categories = Category::where('parent_id', $id)->get();
    return $categories;
}


function calculateDiscount($id)
{
    $product = Product::find($id);
    if($product->discount_type == 1){
        $data['discount'] = $product->regular_price - $product->discount_price;
        $data['text'] = '৳'.$product->discount_price. ' Off';
    }
    elseif($product->discount_type == 2){
        $data['discount'] = round($product->regular_price - ($product->discount_price*$product->regular_price/100));
        $data['text'] = $product->discount_price.'% Off';
    }
    return $data;
}


function getInstockPorducts()
{
    return Product::where('stock_qty', '!=', 0)->where('status', 1)->get();

}

function get_brands()
{
    return Brand::where('status', 1)->orderBy('name_en', 'asc')->get();
}

function get_brand_products($id)
{
    return Product::where('brand_id', $id)->where('status', 1)->get();
}

function get_returning_products($id)
{
    return ReturningProduct::where('request_id', $id)->get();
}

function reduceStock($returning_product)
{
    $product = OrderDetail::find($returning_product->ordered_product_id);
    $item = Product::find($product->product_id);
    if($item->is_varient){
        $data = json_decode($product->variation);
        $text = '';
        for ($i=0; $i<count($data); $i++){
            if ($i== 0){
                $text = $data[$i]->attribute_value;
            }
            else{
                $text = $text.'-'. $data[$i]->attribute_value;
            }
        }
        $stock = ProductStock::where('product_id', $product->product_id)->where('varient', $text)->first();
        if($stock){
            $stock->qty = ($stock->qty - $returning_product->qty);
            $stock->save();
        }
    }
    else{
        $item->stock_qty -= $product->qty;
        $item->save();
    }
}
function countReplaceable($order)
{
    $count  = 0;
    foreach ($order->order_details as $order_detail){
        if ($order_detail->product->is_replaceable == 1){
            $count++;
        }

    }
    return $count;
}
function get_tab_category_products($slug)
{
    $category = Category::where('slug', $slug)->first();
    // dd($category);


    $conditions = ['status' => 1];

    $products = Product::where($conditions)->take(8);

    $category_ids = CategoryUtility::children_ids($category->id);
    $category_ids[] = $category->id;
    //dd($category_ids);

    $products->whereIn('category_id', $category_ids);

    $products = $products->orderBy('created_at', 'desc')->get();

    return $products;
}
function get_product_by_id($id){
    return Product::findorFail($id);
}
