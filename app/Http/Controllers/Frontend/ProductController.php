<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Campaing;
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
use App\Models\SpecialFeature;
use App\Models\SSD;
use DateTime;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Start with base query
        $productQuery = Product::with(['category', 'brand'])
            ->where('status', 1)
            ->orderBy('name_en', 'ASC')
            ->latest();

        // Get all filter data
        $filterData = [
            'categories' => Category::orderBy('id', 'desc')->get(),
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

        // Apply filters
        $this->applyFilters($productQuery, $request);

        // Get paginated results
        $products = $productQuery->paginate(21)->appends($request->query());

        return view('FrontEnd.product.shop', array_merge($filterData, compact('products')));
    }

    protected function applyFilters(&$query, $request)
    {
        // Stock filter
        if ($request->has('stock') && $request->stock > 0) {
            $query->where('stock_qty', '>', 0);
        }

        // Category filter
        if ($request->filled('category')) {
            $categoryIds = Category::whereIn('name_en', $request->category)
                ->pluck('id')
                ->toArray();

            if (!empty($categoryIds)) {
                $query->whereIn('category_id', $categoryIds);
            }
        }

        // Brand filter
        if ($request->filled('brands')) {
            $brandIds = Brand::whereIn('name_en', $request->brands)
                ->pluck('id')
                ->toArray();

            if (!empty($brandIds)) {
                $query->whereIn('brand_id', $brandIds);
            }
        }

        if ($request->filled('price_min') && $request->filled('price_max')) {
            $minPrice = $request->price_min;
            $maxPrice = $request->price_max;

            $query->whereRaw('(regular_price - IFNULL(discount_price, 0)) >= ?', [$minPrice])
                ->whereRaw('(regular_price - IFNULL(discount_price, 0)) <= ?', [$maxPrice]);
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

        // Price Range filter (if you uncomment it in your view)
        // if ($request->filled('price_min') && $request->filled('price_max')) {
        //     $query->whereBetween('price', [
        //         $request->price_min,
        //         $request->price_max
        //     ]);
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $varient
     * @return \Illuminate\Http\Response
     */
    public function getVarient($id, $varient)
    {
        $stock = ProductStock::where('product_id', $id)->where('varient', $varient)->first();
        if ($stock) {
            return $stock;
        } else {
            return null;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function campaignProducts()
    {
        $campaign = Campaing::where('status', 1)->orWhere('is_featured', 1)->orderBy('id', 'desc')->first();
        // return view('FrontEnd.campaign.index', compact('campaign'));

        // $campaign = Campaing::where('status', 1)->where('is_featured', 1)->orderBy('id', 'desc')->first();

        if ($campaign && $this->isCampaignActive($campaign)) {
            return view('FrontEnd.campaign.index', compact('campaign'));
        } else {
            return abort(404);
        }
    }

    protected function isCampaignActive($campaign)
    {
        $flashEnd = date_create($campaign->flash_end);
        $now = new DateTime();

        return $flashEnd > $now;
    }
}
