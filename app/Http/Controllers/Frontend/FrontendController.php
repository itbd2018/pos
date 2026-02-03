<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CampaingProduct;
use App\Models\GroupProduct;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Banner;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\MultiImg;
use App\Models\Page;
use App\Models\OrderDetail;
use App\Models\Vendor;
use App\Models\Coupon;
use App\Models\Shipping;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Image;
//use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Utility\CategoryUtility;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\DisplaySize;
use App\Models\DisplayType;
use App\Models\Generation;
use App\Models\Graphic;
use App\Models\HDD;
use App\Models\OperatingSystem;
use App\Models\Processor;
use App\Models\ProcessorModel;
use App\Models\RamSize;
use App\Models\RamType;
use App\Models\Review;
use App\Models\SpecialFeature;
use App\Models\SSD;
use App\Mail\SendOtpMail;
use App\Models\Blog;
use App\Models\PasswordOtp;
use App\Models\ProductSerialNumber;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    /*=================== Start Index Methoed ===================*/
    public function index(Request $request)
    {


        //Product All Status Active
        // $products = Product::where('status',1)->orderBy('id','DESC')->get();

        $products = Product::where('status', 1)->where('is_featured', 1)->orderBy('id', 'DESC')->get();

        // Search Start
        $sort_search = null;
        if ($request->has('search')) {
            $sort_search = $request->search;
            $products = $products->where('name_en', 'like', '%' . $sort_search . '%');
            // dd($products);
        } else {
            $products = Product::where('status', 1)->where('is_featured', 1)->orderBy('id', 'DESC')->get();
        }
        // $products = $products->paginate(15);
        // Search Start

        // Header Category Start
        $categories = Category::latest()->orderBy('name_en', 'ASC')->where('status', '=', 1)->where('parent_id', 0)->limit(6)->get();
        // Header Category End

        // Category Featured all
        $featured_category = Category::orderBy('id', 'asc')->where('is_featured', '=', 1)->where('status', '=', 1)->limit(5)->get();

        // Tab Category all
        $tab_categories = Category::orderBy('name_en', 'asc')->where('category_tab', '=', 1)->where('status', '=', 1)->limit(5)->get();

        //Slider
        $sliders = Slider::where('status', 1)->where('type', 1)->orderBy('id', 'DESC')->limit(10)->get();
        $middleSliders = Slider::where('status', 1)->where('type', 2)->orderBy('id', 'DESC')->limit(10)->get();
        // Product Top Selling
        $product_top_sellings = Product::where('status', 1)->orderBy('id', 'ASC')->limit(9)->get();
        //Product Trending
        $product_trendings = Product::where('status', 1)->where('is_trending', 1)->orderBy('id', 'DESC')->limit(4)->get();
        //Product Recently Added
        $product_recently_adds = Product::where('status', 1)->latest()->limit(12)->get();

        //featured_products
        $product_featured = Product::where('status', 1)->where('is_featured', 1)->latest()->limit(4)->get();

        $product_top_rates = Product::where('status', 1)->orderBy('regular_price')->limit(9)->get();
        // Home Banner
        $home_banners = Banner::where('status', 1)->where('position', 1)->orderBy('id', 'DESC')->limit(3)->get();
        // dd($home_banners);
        $middle_banners1 = Banner::where('status', 1)->where('position', 2)->orderBy('id', 'DESC')->limit(2)->get();
        $middle_banners2 = Banner::where('status', 1)->where('position', 3)->orderBy('id', 'DESC')->limit(2)->get();

        // Daily Best Sells
        //dd(date('Y-m-d'));
        $todays_sale  = OrderDetail::where('created_at', 'like', '%' . date('Y-m-d') . '%')->get();
        //$todays_sale  = DB::table('order_details')->select('*')->where('created_at', 'like', '%'.date('Y-m-d').'%')->get();
        $todays_sale = $todays_sale->unique('product_id');
        //dd($todays_sale);

        // today_best_sales
        // $today_best_sales  = Product::where('status',1)->where('is_deals',1)->latest()->get();
        // dd($today_best_sales);

        //Home2 featured category
        $home2_featured_categories = Category::orderBy('name_en', 'DESC')->where('is_featured', '=', 1)->where('status', '=', 1)->get();
        // Hot deals product
        $hot_deals = Product::where('status', 1)->where('is_deals', 1)->latest()->take(9)->get();

        $campaign_products = CampaingProduct::all();

        //        $home_view = 'FrontEnd.home.index';
        $home_view = 'FrontEnd.home.index2';

        // $campaign = \App\Models\Campaing::where('status', 1)->where('is_featured', 1)->first();
        // $start_diff=date_diff(date_create($campaign->flash_start), date_create(date('d-m-Y H:i:s')));
        // $end_diff=date_diff(date_create(date('d-m-Y H:i:s')), date_create($campaign->flash_end));
        // dd($end_diff);
        // if($campaign && $start_diff->invert == 0 && $end_diff->invert == 0){
        //     dd($campaign);
        // }
        //dd($hot_deals);

        //dd($featured_category);

        $brands = Brand::where('status', 1)->get();

        return view($home_view, compact('brands', 'categories', 'tab_categories', 'sliders', 'middleSliders', 'product_featured', 'featured_category', 'products', 'product_top_sellings', 'product_trendings', 'product_recently_adds', 'product_top_rates', 'home_banners', 'middle_banners1', 'middle_banners2', 'sort_search', 'todays_sale', 'home2_featured_categories', 'hot_deals'));
    } // end method

    // public function shopgrid(){
    //     $products = Product::where('status',1)->orderBy('id','DESC')->get();

    //     return view('FrontEnd.shopgrid.index', compact('products'));
    // }

    //    public function index2(Request $request)
    //    {
    //
    //        //Product All Status Active
    //        $products = Product::where('status',1)->orderBy('id','DESC')->get();
    //
    //        // Search Start
    //        $sort_search =null;
    //        if ($request->has('search')){
    //            $sort_search = $request->search;
    //            $products = $products->where('name_en', 'like', '%'.$sort_search.'%');
    //            // dd($products);
    //        }else{
    //            $products = Product::where('status',1)->orderBy('id','DESC')->get();
    //        }
    //        // $products = $products->paginate(15);
    //        // Search Start
    //
    //        // Header Category Start
    //        $categories = Category::orderBy('name_en','DESC')->where('status','=',1)->limit(5)->get();
    //        // Header Category End
    //
    //        // Category Featured all
    //        $featured_category = Category::orderBy('name_en','DESC')->where('is_featured','=',1)->where('status','=',1)->limit(15)->get();
    //
    //        //Slider
    //        $sliders = Slider::where('status',1)->orderBy('id','DESC')->limit(10)->get();
    //        // Product Top Selling
    //        $product_top_sellings = Product::where('status',1)->orderBy('id','ASC')->limit(2)->get();
    //        //Product Trending
    //        $product_trendings = Product::where('status',1)->orderBy('id','ASC')->skip(2)->limit(2)->get();
    //        //Product Recently Added
    //        $product_recently_adds = Product::where('status',1)->latest()->skip(2)->limit(2)->get();
    //
    //        $product_top_rates = Product::where('status',1)->orderBy('regular_price')->limit(2)->get();
    //        // Home Banner
    //        $home_banners = Banner::where('status',1)->where('position',1)->orderBy('id','DESC')->first();
    //
    //        // Daily Best Sells
    //        //dd(date('Y-m-d'));
    //        $todays_sale  = OrderDetail::where('created_at', 'like', '%'.date('Y-m-d').'%')->get();
    //        // dd($todays_sale);
    //
    //        //Home2 featured category
    //        $home2_featured_categories = Category::orderBy('name_en','DESC')->where('is_featured','=',1)->where('status','=',1)->get();
    //        // Hot deals product
    //        $hot_deals = Product::where('status',1)->where('is_deals',1)->latest()->take(4)->get();
    //
    //        return view('frontend.home2', compact('categories','sliders','featured_category','products','product_top_sellings','product_trendings','product_recently_adds','product_top_rates','home_banners','sort_search','todays_sale','home2_featured_categories','hot_deals'));
    //    } // end method

    /* ========== Start ProductDetails Method ======== */

    public function loadMoreProducts(Request $request)
    {
        $count = $request->input('count', 12); // Number of products to load (default is 12)
        $offset = $request->input('offset', 0); // Offset for pagination

        $products = Product::where('status', 1)
            ->orderBy('id', 'desc')
            ->skip($offset)
            ->limit($count)
            ->get();

        $nextOffset = $offset + $count;

        return response()->json(['products' => $products, 'nextOffset' => $nextOffset]);
    }
    public function productDetails($id, $slug = Null)
    {
        // dd($id);
        $product = Product::where('id', $id)->where('slug', $slug)->first();

        if ($product) {
            $multiImg = MultiImg::where('product_id', $product->id)->limit(3)->get();

            $product_color_en = explode(',', $product->product_color_en);
            $product_size_en = explode(',', $product->product_size_en);

            $relatedProduct = Product::where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->orderBy('id', 'DESC')
                ->limit(8)
                ->get();

            $categories = Category::where('status', 1)->orderBy('name_en', 'ASC')->limit(5)->get();
            $new_products = Product::where('status', 1)->latest()->limit(3)->get();
            $shipping_charge = Shipping::where('type', 1)->first();

            $group_products = ($product->product_type == 2)
                ? GroupProduct::where('product_id', $product->id)->get()
                : [];

            $reviews = $product->reviews;
            // Average rating
            $avgRating = $reviews->count() ? round($reviews->avg('rating'), 1) : 0;
            // Total ratings
            $totalRatings = $reviews->count();
            // Ratings breakdown
            $ratingsBreakdown = [
                5 => $reviews->where('rating', 5)->count(),
                4 => $reviews->where('rating', 4)->count(),
                3 => $reviews->where('rating', 3)->count(),
                2 => $reviews->where('rating', 2)->count(),
                1 => $reviews->where('rating', 1)->count(),
            ];

            //Determine if user can submit review
            $userId = auth()->id() ?? 1; // guest user = 1
            $canReview = Order::where('user_id', $userId)
                ->where('payment_status', 1)
                ->whereHas('order_details', function ($q) use ($id) {
                    $q->where('product_id', $id);
                })
                ->exists();


            return view('FrontEnd.product.product_details', compact(
                'group_products',
                'shipping_charge',
                'product',
                'multiImg',
                'categories',
                'new_products',
                'product_color_en',
                'product_size_en',
                'relatedProduct',
                'canReview',
                'avgRating',
                'totalRatings',
                'ratingsBreakdown'
            ));
        }

        return view('FrontEnd.product.productNotFound');
    }

    public function reviewStore(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'nullable|string|max:2000',
        ]);

        // Save review
        Review::create([
            'user_id'    => auth()->id() ?? 1, // store 1 if guest (or force login)
            'product_id' => $request->product_id,
            // 'variant_id' => $request->variant_id ?? null,
            'rating'     => $request->rating,
            'comment'    => $request->comment,
            'status'     => 1, // pending by default
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your review!',
        ]);

        // return redirect()->back()->with('success', 'Thank you for your review!');

    }


    /* ========== Start CatWiseProduct Method ======== */
    public function CatWiseProduct(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        // Get all filter data
        $filterData = [
            'categories' => Category::orderBy('name_en', 'ASC')->where('status', 1)->get(),
            'brands' => Brand::orderBy('id', 'desc')->get(),
            'processor_type' => Processor::orderBy('id', 'desc')->get(),
            'processor_model' => ProcessorModel::orderBy('id', 'desc')->get(),
            'generations' => Generation::orderBy('id', 'desc')->get(),
            'display_type' => DisplayType::orderBy('id', 'desc')->get(),
            'display_size' => DisplaySize::orderBy('id', 'desc')->get(),
            'ram_type' => RamType::orderBy('id', 'desc')->get(),
            'ram_size' => RamSize::orderBy('id', 'desc')->get(),
            'hdd' => HDD::orderBy('id', 'desc')->get(),
            'ssd' => SSD::orderBy('id', 'desc')->get(),
            'graphics_card' => Graphic::orderBy('id', 'desc')->get(),
            'operating_system' => OperatingSystem::orderBy('id', 'desc')->get(),
            'special_features' => SpecialFeature::orderBy('id', 'desc')->get(),
        ];

        // Base query
        $productsQuery = Product::with(['category', 'brand'])
            ->where('status', 1);

        // Apply category filter
        $category_ids = CategoryUtility::children_ids($category->id);
        $category_ids[] = $category->id;
        $productsQuery->whereIn('category_id', $category_ids);

        // Apply sorting
        $sort_by = $request->sort_by;
        switch ($sort_by) {
            case 'newest':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            case 'price-asc':
                $productsQuery->orderByRaw('(regular_price - IFNULL(discount_price, 0)) ASC');
                break;
            case 'price-desc':
                $productsQuery->orderByRaw('(regular_price - IFNULL(discount_price, 0)) DESC');
                break;
            default:
                $productsQuery->orderBy('id', 'desc');
                break;
        }

        // Apply brand filter
        if ($request->filled('brands')) {
            $brandIds = Brand::whereIn('name_en', $request->brands)
                ->pluck('id')
                ->toArray();

            if (!empty($brandIds)) {
                $productsQuery->whereIn('brand_id', $brandIds);
            }
        }

        // Apply price filter
        if ($request->filled('price_min') && $request->filled('price_max')) {
            $productsQuery->whereRaw('(regular_price - IFNULL(discount_price, 0)) >= ?', [$request->price_min])
                ->whereRaw('(regular_price - IFNULL(discount_price, 0)) <= ?', [$request->price_max]);
        }

        // Apply other filters (same as your main product controller)
        $this->applyFilters($productsQuery, $request);

        // Get paginated results
        $products = $productsQuery->paginate(12)->appends($request->query());

        // Get subcategories
        $subcategories = Category::where('parent_id', $category->id)
            ->where('status', 1)
            ->orderBy('name_en', 'ASC')
            ->get();

        return view('FrontEnd.product.category_view', array_merge($filterData, [
            'products' => $products,
            'category' => $category,
            'subcategories' => $subcategories,
            'sort_by' => $sort_by,
        ]));
    }

    // Reuse the same applyFilters method from your main controller
    protected function applyFilters(&$query, $request)
    {
        if ($request->filled('category')) {
            $categoryIds = Category::whereIn('name_en', $request->category)
                ->pluck('id')
                ->toArray();

            if (!empty($categoryIds)) {
                $query->whereIn('category_id', $categoryIds);
            }
        }
        // Processor Type filter
        if ($request->filled('processors')) {
            $processorIds = Processor::whereIn('name_en', $request->processors)
                ->pluck('id')
                ->toArray();

            if (!empty($processorIds)) {
                $query->whereIn('processor_type_id', $processorIds);
            }
        }

        // Processor Model filter
        if ($request->filled('processorsM')) {
            $processorModelIds = ProcessorModel::whereIn('name_en', $request->processorsM)
                ->pluck('id')
                ->toArray();

            if (!empty($processorModelIds)) {
                $query->whereIn('processor_model_id', $processorModelIds);
            }
        }

        // Generation filter
        if ($request->filled('generation')) {
            $generationIds = Generation::whereIn('name_en', $request->generation)
                ->pluck('id')
                ->toArray();

            if (!empty($generationIds)) {
                $query->whereIn('generation_id', $generationIds);
            }
        }

        // Display Type filter
        if ($request->filled('type')) {
            $displayTypeIds = DisplayType::whereIn('name_en', $request->type)
                ->pluck('id')
                ->toArray();

            if (!empty($displayTypeIds)) {
                $query->whereIn('display_type_id', $displayTypeIds);
            }
        }

        // Display Size filter
        if ($request->filled('display_size')) {
            $displaySizeIds = DisplaySize::whereIn('name_en', $request->display_size)
                ->pluck('id')
                ->toArray();

            if (!empty($displaySizeIds)) {
                $query->whereIn('display_size_id', $displaySizeIds);
            }
        }

        // RAM Size filter
        if ($request->filled('ramS')) {
            $ramSizeIds = RamSize::whereIn('name_en', $request->ramS)
                ->pluck('id')
                ->toArray();

            if (!empty($ramSizeIds)) {
                $query->whereIn('ram_size_id', $ramSizeIds);
            }
        }

        // SSD filter
        if ($request->filled('ssd')) {
            $ssdIds = SSD::whereIn('name_en', $request->ssd)
                ->pluck('id')
                ->toArray();

            if (!empty($ssdIds)) {
                $query->whereIn('ssd_id', $ssdIds);
            }
        }
    }
    /* ========== End CatWiseProduct Method ======== */

    /* ========== Start CatWiseProduct Method ======== */
    public function VendorWiseProduct(Request $request, $slug)
    {

        $vendor = Vendor::where('slug', $slug)->first();
        // dd($category);

        $products = Product::where('status', 1)->where('vendor_id', $vendor->id)->orderBy('id', 'DESC')->paginate(20);
        // Price Filter
        if ($request->get('filter_price_start') !== Null && $request->get('filter_price_end') !== Null) {
            $filter_price_start = $request->get('filter_price_start');
            $filter_price_end = $request->get('filter_price_end');

            if ($filter_price_start > 0 && $filter_price_end > 0) {
                $products = Product::where('status', '=', 1)->where('vendor_id', $vendor->id)->whereBetween('regular_price', [$filter_price_start, $filter_price_end])->paginate(20);
                // dd($products);
            }
        }

        $categories = Category::orderBy('name_en', 'ASC')->where('status', '=', 1)->get();
        // dd($products);

        return view('frontEnd.product.vendor_view', compact('products', 'categories', 'vendor'));
    } // end method
    /* ========== End CatWiseProduct Method ======== */

    /* ========== Start TagWiseProduct Method ======== */
    // public function TagWiseProduct($id,$slug){

    //     $products = Product::where('status','=',1)->where('tag_id',$id)->orderBy('id','DESC')->paginate(5);
    //     $categories = Category::orderBy('name_en','ASC')->where('status','=',1)->limit(5)->get();
    //     $tags = Tag::orderBy('name_en','ASC')->where('status','=',1)->limit(5)->get();
    //     $tag = Tag::find($id);
    //     $new_products = Product::orderBy('name_en')->where('status','=',1)->limit(3)->latest()->get();

    //     return view('frontend.product.tag_view',compact('products','categories','tags','tag','new_products'));
    // } // end method
    /* ========== End TagWiseProduct Method ======== */


    /* ================= Start ProductViewAjax Method ================= */
    public function ProductViewAjax($id)
    {

        $product = Product::with('category', 'brand')->findOrFail($id);
        //dd($product);
        $attribute_values = json_decode($product->attribute_values);

        $attributes = new Collection;
        foreach ($attribute_values as $key => $attribute_value) {
            $attr = Attribute::select('id', 'name')->where('id', $attribute_value->attribute_id)->first();
            // $attribute->name = $attr->name;
            // $attribute->id = $attr->id;
            $attr->values = $attribute_value->values;
            $attributes->add($attr);
        }


        return response()->json(array(
            'product' => $product,
            'attributes' => $attributes,
        ));
    }
    /* ================= END PRODUCT VIEW WITH MODAL METHOD =================== */




    /* ================= Start Product Search =================== */
    public function ProductSearch(Request $request)
    {
        //$request->validate(["search" => "required"]);
        $sort_by = $request->sort_by;
        $brand_id = $request->brand;

        $conditions = ['status' => 1];

        if ($brand_id != null) {
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        } elseif ($request->brand != null) {
            $brand_id = (Brand::where('slug', $request->brand)->first() != null) ? Brand::where('slug', $request->brand)->first()->id : null;
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }

        $products_sort_by = Product::where($conditions);

        switch ($sort_by) {
            case 'newest':
                $products_sort_by->orderBy('created_at', 'desc')->paginate(10);
                break;
            case 'oldest':
                $products_sort_by->orderBy('created_at', 'asc')->paginate(10);
                break;
            case 'price-asc':
                $products_sort_by->orderBy('regular_price', 'asc')->paginate(10);
                break;
            case 'price-desc':
                $products_sort_by->orderBy('regular_price', 'desc')->paginate(10);
                break;
            default:
                $products_sort_by->orderBy('id', 'desc')->paginate(10);
                break;
        }

        $item = $request->search;
        $category_id = $request->searchCategory;
        // echo "$item";

        // Header Category Start //
        $categories = Category::orderBy('name_en', 'DESC')->where('status', 1)->get();
        if ($category_id == 0) {
            $products = Product::where('name_en', 'LIKE', "%$item%")->where(
                'status',
                1
            )->latest()->get();
        } else {
            $products = Product::where('name_en', 'LIKE', "%$item%")->where('category_id', $category_id)->where(
                'status',
                1
            )->latest()->get();
        }

        $attributes = Attribute::orderBy('name', 'DESC')->where('status', 1)->latest()->get();

        return view('FrontEnd.product.search', compact('products', 'categories', 'attributes', 'sort_by', 'brand_id'));
    } // end method

    /* ================= End Product Search =================== */

    /* ================= Start Advance Product Search =================== */
    public function advanceProduct(Request $request)
    {

        // return $request;

        $request->validate(["search" => "required"]);

        $item = $request->search;
        $category_id = $request->category;
        // echo "$item";

        // Header Category Start //
        $categories = Category::orderBy('name_en', 'DESC')->where('status', 1)->get();

        if ($category_id == 0) {
            $products = Product::where('name_en', 'LIKE', "%$item%")->where(
                'status',
                1
            )->latest()->get();
        } else {
            $products = Product::where('name_en', 'LIKE', "%$item%")->where('category_id', $category_id)->where(
                'status',
                1
            )->latest()->get();
        }

        $attributes = Attribute::orderBy('name', 'DESC')->where('status', 1)->latest()->get();

        return view('FrontEnd.product.advance_search', compact('products', 'categories', 'attributes'));
    } // end method

    /* ================= End Advance Product Search =================== */

    /* ================= Start Hot Deals Page Show =================== */
    public function hotDeals(Request $request)
    {

        $sort_by = $request->sort_by;
        $brand_id = $request->brand;

        $conditions = ['status' => 1];

        if ($brand_id != null) {
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        } elseif ($request->brand != null) {
            $brand_id = (Brand::where('slug', $request->brand)->first() != null) ? Brand::where('slug', $request->brand)->first()->id : null;
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }

        $products_sort_by = Product::where($conditions);

        switch ($sort_by) {
            case 'newest':
                $products_sort_by->orderBy('created_at', 'desc')->paginate(10);
                break;
            case 'oldest':
                $products_sort_by->orderBy('created_at', 'asc')->paginate(10);
                break;
            case 'price-asc':
                $products_sort_by->orderBy('regular_price', 'asc')->paginate(10);
                break;
            case 'price-desc':
                $products_sort_by->orderBy('regular_price', 'desc')->paginate(10);
                break;
            default:
                $products_sort_by->orderBy('id', 'desc')->paginate(10);
                break;
        }
        // Hot deals product
        $products = Product::where('status', 1)->where('is_deals', 1)->paginate(5);

        // Category Filter Start
        if ($request->get('filtercategory')) {

            $checked = $_GET['filtercategory'];
            // filter With name start
            $category_filter = Category::whereIn('name_en', $checked)->get();
            $catId = [];
            foreach ($category_filter as $cat_list) {
                array_push($catId, $cat_list->id);
            }
            // filter With name end

            $products = Product::whereIn('category_id', $catId)->where('status', 1)->where('is_deals', 1)->latest()->paginate(10);
            // dd($products);
        }
        // Category Filter End

        $attributes = Attribute::orderBy('name', 'DESC')->where('status', 1)->latest()->get();
        // End Shop Product //
        return view('FrontEnd.deals.hot_deals', compact('attributes', 'products', 'sort_by', 'brand_id'));
    } // end method

    public function applycoupon(Request $request)
    {
        $coupon = Coupon::where('coupon_code', $request->apply_coupon)
            ->where('status', 1)
            ->where('total_use_limit', '>', 0) // Ensure total_use_limit is greater than 0
            ->first();

        if ($coupon) {
            // Check if the coupon has expired
            $now = Carbon::now();
            $expirationDate = Carbon::parse($coupon->expire_date);

            if ($expirationDate->greaterThanOrEqualTo($now)) {
                if ($coupon->coupon_type == 2) {
                    // Coupon type 2 now applies to the whole cart, not just laptops
                    $cartItems = Cart::content(); // Get all cart items
                    $cartTotal = 0;

                    // Calculate the total cart value
                    foreach ($cartItems as $item) {
                        $cartTotal += $item->qty * $item->price;
                    }

                    if ($cartTotal > 0) {
                        // Calculate discount based on coupon type
                        $discountAmount = ($coupon->discount_type == 0)
                            ? ($coupon->discount / 100) * $cartTotal
                            : $coupon->discount;

                        $shippingCharge = $this->getShippingCharge($request->shipping_id);

                        Session::put('couponCode', $coupon->coupon_code);
                        Session::put('discountType', $coupon->discount_type);
                        Session::put('amount', $discountAmount);
                        Session::put('couponId', $coupon->id);
                        Session::put('couponUserId', $coupon->user_id);

                        return response()->json([
                            'success' => 'Coupon Applied Successfully',
                            'discount' => $discountAmount,
                            'shipping_charge' => $shippingCharge,
                        ]);
                    } else {
                        return response()->json(['error' => 'Your cart is empty.']);
                    }
                } else {
                    if ($coupon->discount <= $request->cart_value) {
                        // Calculate discount based on coupon type
                        $discountAmount = ($coupon->discount_type == 0) ? ($coupon->discount / 100) * $request->cart_value : $coupon->discount;
                        // ... your existing code for applying the coupon
                        // Fetch shipping charge based on the selected shipping_id
                        $shippingCharge = $this->getShippingCharge($request->shipping_id);
                        // Return both coupon discount and shipping charge as JSON response
                        Session::put('couponCode', $coupon->coupon_code);
                        Session::put('discountType', $coupon->discount_type);
                        Session::put('amount',  $discountAmount);
                        Session::put('couponId', $coupon->id);
                        return response()->json(['success' => 'Coupon Applied Successfully', 'discount' => $discountAmount, 'shipping_charge' => $shippingCharge]);
                    } else {
                        return back()->with('message', 'Not Enough Cart Amount To Get Offer. Please Update Cart Amount.');
                    }
                }
            } else {
                return response()->json(['error' => 'Coupon Date Is Expired']);
            }
        }

        return back()->with('message', 'Invalid coupon code');
    }


    // Add a helper method to fetch the shipping charge based on shipping_id
    protected function getShippingCharge($shipping_id)
    {
        // Find the shipping record based on the provided shipping_id
        $shipping = Shipping::find($shipping_id);

        // Check if the shipping record exists
        if ($shipping) {
            // Return the shipping charge from the database
            return $shipping->shipping_charge;
        }

        // If the shipping record is not found, return a default value or handle it as needed
        return 0;
    }

    public function PageContact()
    {
        return view('FrontEnd.contact.index');
    }
    public function PageTerms()
    {
        $page = Page::first();
        return view('FrontEnd.terms_conditions.index', compact('page'));
    }
    public function PagePolicy()
    {
        $page = Page::first();
        return view('FrontEnd.privacy_policy.index', compact('page'));
    }

    public function PageHelp()
    {
        $page = Page::first();
        return view('FrontEnd.help.index', compact('page'));
    }
    public function shippingReturn()
    {
        $page = Page::first();
        return view('FrontEnd.shipping-return.index', compact('page'));
    }

    public function PageFaq()
    {
        $page = Page::first();
        return view('FrontEnd.FAQ.index', compact('page'));
    }
    public function pageAbout()
    {
        $page = Page::first();
        return view('FrontEnd.about_us.index', compact('page'));
    }

    public function loginCheck()
    {
        if (Auth::user() && Auth::user()->role == 3) {
            return redirect()->route('checkout');
        } else {
            return redirect()->route('login');
        }
    }
    public function orderTracking()
    {
        return view('FrontEnd.page.order_tracking');
    }

    public function orderTrack(Request $request)
    {
        $this->validate($request, [
            'invoice_no' => 'required',
            'phone' => 'required',
        ]);
        $order = Order::where('invoice_no', $request->invoice_no)->where('phone', $request->phone)->first();
        if (!$order) {
            $notification = array(
                'message' => 'Required Data Not Found.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        // dd($order);
        return view('FrontEnd.page.track', compact('order'));
    }

    public function becomeaseller(Request $request)
    {
        // return $request;
        $this->validate($request, [
            'shop_owner_name'   => 'required',
            'phone'         => ['required', 'regex:/(\+){0,1}(88){0,1}01(3|4|5|6|7|8|9)(\d){8}/', 'min:11', 'max:15'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'shop_profile'  => 'required|file|mimes:jpg,jpeg,png,webp',
            'password'      => ['required', 'string', 'min:6', 'confirmed'],
            'affiliate_id'   => 'required',
        ]);

        // dd('ok');

        $checkAffiliate = User::where('affiliate_id', $request->affiliate_id)->first();

        if ($checkAffiliate) {
            return back()->withErrors(['affiliate_id' => 'Affiliate ID is already used.']);
        }

        if (!$request->has('affiliate_id')) {
            return back()->withErrors(['affiliate_id' => 'Affiliate ID is required.']);
        }

        $affiliateId = $request->affiliate_id;
        $isValid = false;

        $responseGk = Http::get('https://ghorkonnya.com/api/check-affiliateId', [
            'affiliateId' => $affiliateId
        ]);

        if ($responseGk->successful()) {
            $data = $responseGk->json();
            if (isset($data['user']) && $data['user']['status'] == 2) {
                $isValid = true;
            }
        }

        if (!$isValid) {
            $responseUp = Http::get('https://uparjok.com/api/check-affiliateId', [
                'affiliateId' => $affiliateId
            ]);

            if ($responseUp->successful()) {
                $data = $responseUp->json();
                if (isset($data['user']) && $data['user']['status'] == 2) {
                    $isValid = true;
                }
            }
        }

        if (!$isValid) {
            return back()->withErrors(['affiliate_id' => 'Invalid or inactive affiliate ID.']);
        }
        if ($request->hasfile('shop_profile')) {
            $image = $request->file('shop_profile');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/vendor/' . $name_gen);
            $shop_profile = 'upload/vendor/' . $name_gen;
        } else {
            $shop_profile = '';
        }

        if ($request->hasfile('shop_cover')) {
            $image = $request->file('shop_cover');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/vendor/' . $name_gen);
            $shop_cover = 'upload/vendor/' . $name_gen;
        } else {
            $shop_cover = '';
        }

        if ($request->hasfile('nid')) {
            $image = $request->file('nid');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/vendor/' . $name_gen);
            $nid = 'upload/vendor/' . $name_gen;
        } else {
            $nid = '';
        }

        if ($request->hasfile('trade_license')) {
            $image = $request->file('trade_license');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/vendor/' . $name_gen);
            $trade_license = 'upload/vendor/' . $name_gen;
        } else {
            $trade_license = '';
        }

        if ($request->slug != null) {
            $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        } else {
            $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->shop_name)) . '-' . Str::random(5);
        }

        $role = 2;
        $temp = 0;
        $user = Auth::guard('admin')->user();
        if ($temp != null) {
            $temp = Auth::guard('admin')->user()->id;
        }


        $user = User::create([
            'name' => $request->shop_owner_name,
            'username' => $slug,
            'affiliate_id' => $request->affiliate_id,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'profile_image' => $shop_profile,
            'password' => Hash::make($request->password),
            'created_by' => $temp,
            'role' => $role,
        ]);

        $user->role = 2;
        $user->status = 0;
        $user->save();

        $vendor = Vendor::create([
            'shop_owner_name' => $request->shop_owner_name,
            'shop_name' => $request->shop_name,
            'fb_url' => $request->fb_url,
            'slug' => $slug,
            'user_id' => $user->id,
            'address' => $request->address,
            'commission' => $request->commission,
            'comission_type' => $request->comission_type,
            'description' => $request->description,
            'shop_profile' => $shop_profile,
            'shop_cover' => $shop_cover,
            'nid' => $nid,
            'trade_license' => $trade_license,
            'created_by' => $temp,
        ]);

        $vendor->status = 0;
        $vendor->is_request = 1;
        $vendor->save();

        Session::flash('success', 'Request Successfully, Please Wait For Admin Approval !!');
        return back();
    }

    public function pagesstore()
    {
        //    $page = new Page();
        //    $page->faq = $request->faq;
        //    $page->faq_bn = $request->faq_bn;
        //    $page->about = $request->about;
        //    $page->about_bn = $request->about_bn;
        //    $page->privacy = $request->privacy;
        //    $page->privacy_bn = $request->privacy_bn;
        //    $page->terms = $request->terms;
        //    $page->terms_bn = $request->terms_bn;
        //    $page->help = $request->help;
        //    $page->help_bn = $request->help_bn;
        //    $page->save();
        //    return back();
    }

    public function sessionlogindata()
    {
        // dd('ok');
        session(['checkout_value' => 'proceed_to_checkout']);
        return redirect()->route('login');
    }

    public function affiliate()
    {
        return view('FrontEnd.Affiliate.index');
    }
    public function registerAffiliate()
    {
        // dd('ok');
        return view('FrontEnd.Affiliate.register');
    }

    public function afiliatePasswordRequestForm()
    {
        if (Auth::check()) {
            abort(404);
        }

        return view('admin.afiliate_password_request');
    } // end method

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $otp = rand(1000, 9999); // 4 digit OTP
        $expiresAt = now()->addMinutes(5);

        PasswordOtp::updateOrCreate(
            ['email' => $user->email],
            ['otp' => $otp, 'expires_at' => $expiresAt]
        );

        // Send OTP via Email
        Mail::to($user->email)->send(new SendOtpMail($otp));

        Session::flash('success', 'OTP sent successfully. Please check your email.');
        return redirect()->to('/affiliate/otp/verify-form');

        // return response()->json(['message' => 'OTP sent successfully']);
    }

    public function afiliateOtpVerifyForm()
    {
        return view('admin.affiliate_otp_varification');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:4'  // Adjust digit length if needed
        ]);

        $record = PasswordOtp::where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (!$record) {
            Session::flash('error', 'Invalid Your OTP. If Forgot, Resend OTP');
            return redirect()->back();
        }

        // OTP is valid — you can delete or mark as used if needed
        // $record->delete();

        return redirect()->to('/affiliate/reset-password/form');
    }

    public function affiliateResetPasswordForm()
    {
        return view('admin.affiliate_reset_password_form');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $record = PasswordOtp::where('email', $request->email)
            ->first();

        // if (!$record || now()->greaterThan($record->expires_at)) {
        //     Session::flash('error', 'Invalid or expired OTP');
        //     return back();
        // }

        $user = User::where('email', $record->email)->first();
        // dd($user);
        if (!$user) {
            Session::flash('error', 'User Not Found');
            return back();
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        // Delete OTP record after successful reset
        $record->delete();

        Session::flash('success', 'Password reset successfully. You can now login.');
        return redirect()->to('/affiliate/login');
    }

    // product warranty
    public function productWarrenty()
    {
        return view('FrontEnd.page.product_warrenty');
    }

    public function blog(){
        $blogs = Blog::where('status', 1)->orderBy('created_at', 'desc')->get();
        return view('FrontEnd.blog.blog', compact('blogs'));
    }
    public function blogDetails($slug){
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $allblogs = Blog::where('status', 1)->orderBy('created_at', 'desc')->get();
        return view('FrontEnd.blog.blog_details', compact('blog','allblogs'));
    }

    public function warrantyCheck(Request $request)
    {
        // Validate input
        $request->validate([
            'serial_number' => 'required|string',
        ]);

        // Find product serial number
        $serial = ProductSerialNumber::where('serial_number', $request->serial_number)->first();

        if (!$serial) {
            return back()->with('message', 'No product found with this serial number.');
        }

        // Find order detail linked with this serial number
        $orderDetail = OrderDetail::with(['product', 'order'])
            ->where('product_serial_number_id', $serial->id)
            ->first();

        if (!$orderDetail || !$orderDetail->order || $orderDetail->order->delivery_status !== 'delivered') {
            return back()->with('message', 'This product has not been delivered yet or is not eligible for warranty.');
        }

        // Use delivered date as starting point
        $purchaseDate = $orderDetail->order->delivered_date ?? $orderDetail->created_at;

        // Warranty & servicing periods (can be config-driven later)
        $warrantyDays   = 45;  // e.g. 45 days
        $servicingYears = 3;   // e.g. 3 years

        // Expiry dates
        $warrantyExpiry  = \Carbon\Carbon::parse($purchaseDate)->addDays($warrantyDays);
        $servicingExpiry = \Carbon\Carbon::parse($purchaseDate)->addYears($servicingYears);

        // Countdown remaining time
        $now = now();

        $remainingWarrantyDays = $now->lessThanOrEqualTo($warrantyExpiry)
            ? $now->diffInDays($warrantyExpiry)
            : 0;

        $remainingServicingDays = $now->lessThanOrEqualTo($servicingExpiry)
            ? $now->diffInDays($servicingExpiry)
            : 0;

        // Pass data to view
        return view('FrontEnd.page.warranty_details', [
            'serial'                => $serial,
            'product'               => $orderDetail->product,
            'orderDetail'           => $orderDetail,
            'order'                 => $orderDetail->order,
            'purchaseDate'          => $purchaseDate,
            'warrantyDays'          => $warrantyDays,
            'servicingYears'        => $servicingYears,
            'warrantyExpiry'        => $warrantyExpiry,
            'servicingExpiry'       => $servicingExpiry,
            'remainingWarrantyDays' => $remainingWarrantyDays,
            'remainingServicingDays' => $remainingServicingDays,
        ]);
    }

    

    public function allBlogs()
    {
        $blogs = DB::table('blogs')
            ->join('blog_categories', 'blogs.category_id', '=', 'blog_categories.id')
            ->select('blogs.*', 'blog_categories.name_en as category_name')
            ->where('blogs.status', 1)
            ->orderBy('blogs.created_at', 'desc')
            ->get();

        return view('FrontEnd.page.blog.all_blogs', compact('blogs'));
    }
}
