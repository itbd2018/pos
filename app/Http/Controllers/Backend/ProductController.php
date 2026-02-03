<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\AccountLedger;
use App\Models\CampaingProduct;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Vendor;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\MultiImg;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\DisplaySize;
use App\Models\DisplayType;
use App\Models\Generation;
use App\Models\Graphic;
use App\Models\ProductStock;
use App\Models\GroupProduct;
use App\Models\HDD;
use App\Models\OperatingSystem;
use App\Models\Unit;
use App\Models\Processor;
use App\Models\ProcessorModel;
use App\Models\ProductSerialNumber;
use App\Models\RamSize;
use App\Models\RamType;
use App\Models\SpecialFeature;
use App\Models\SSD;
use Carbon\Carbon;
use Image;
use Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use DB;

class ProductController extends Controller
{
    /*=================== Start ProductView Methoed ===================*/
    public function ProductView()
    {
        if (Auth::guard('admin')->user()->role == '2') {
            //            $products = Product::where('vendor_id', Auth::guard('admin')->user()->id)->latest()->get();
            $vendor = Vendor::where('user_id', Auth::guard('admin')->user()->id)->first();
            if ($vendor) {
                $products = Product::where('vendor_id', $vendor->id)->latest()->get();
            }
        } else {
            $products = Product::where('is_stock', 0)->where('status', 1)->latest()->get();
        }
        return view('backend.product.product_view', compact('products'));
    } // end method



    /*=================== Start storageProducts Method ===================*/
    public function storageProducts()
    {
        $user = Auth::guard('admin')->user();

        // If Admin (role = 1) → show all stock products
        if ($user->role == 1) {
            $products = Product::with('serialNumbers')->where('is_stock', 1)
                ->latest()
                ->get();
        }
        // If Vendor (role = 2) → show own stock products only
        elseif ($user->role == 2) {
            $vendor = Vendor::where('user_id', $user->id)->first();
            $products = $vendor
                ? Product::where('vendor_id', $vendor->id)
                ->where('is_stock', 1)
                ->latest()
                ->get()
                : collect(); // empty collection if no vendor record
        }
        //If Staff (role = 5) and has permission 5 → allow access
        elseif ($user->role == 5) {
            $staff = $user->staff; // related staff record
            $permissions = json_decode(optional($staff->role)->permissions ?? '[]', true);

            if (in_array(5, $permissions)) {
                $products = Product::with('serialNumbers')->where('is_stock', 1)->latest()->get();
            } else {
                abort(403, 'Unauthorized access.');
            }
        }
        // Any other role → block access
        else {
            abort(403, 'Unauthorized access.');
        }

        return view('backend.product.storage_products', compact('products'));
    }

    /*=================== Start ProductAdd Methoed ===================*/
    public function ProductAdd()
    {
        // Session::put('a', 0);
        $categories = Category::where('parent_id', 0)->with('childrenCategories')->orderBy('name_en', 'asc')->get();
        $brands = Brand::latest()->get();
        $vendors = Vendor::latest()->get();
        $suppliers = Supplier::latest()->get();
        $units = Unit::latest()->get();
        $attributes = Attribute::latest()->get();
        $processor_types = Processor::latest()->get();
        $processor_models = ProcessorModel::latest()->get();
        $generations = Generation::latest()->get();
        $display_sizes = DisplaySize::latest()->get();
        $display_types = DisplayType::latest()->get();
        $ram_sizes = RamSize::latest()->get();
        $ram_types = RamType::latest()->get();
        $hdds = HDD::latest()->get();
        $ssds = SSD::latest()->get();
        $graphics = Graphic::latest()->get();
        $operating_systems = OperatingSystem::latest()->get();
        $special_features = SpecialFeature::latest()->get();
        return view('backend.product.product_add', compact('categories', 'brands', 'vendors', 'suppliers', 'attributes', 'units', 'processor_types', 'processor_models', 'generations', 'display_sizes', 'display_types', 'ram_sizes', 'ram_types', 'hdds', 'ssds', 'graphics', 'operating_systems', 'special_features'));
    } // end method

    /*=================== Start StoreProduct Methoed ===================*/
    public function StoreProduct(Request $request)
    {
        //         return $request;
        $request->validate([
            'name_en'               => 'required|max:150',
            'regular_price'         => 'required|numeric',
            'short_description_en'  => 'nullable',
            'description_en'        => 'nullable|string',
            'category_id'           => 'required|integer',
            // 'brand_id'              => 'nullable|integer',
            'stock_qty'             => 'required|integer',
            // 'purchase_price'        => 'required|numeric',
            'discount_price'        => 'required|numeric',
            'product_thumbnail'     => 'nullable',

        ]);

        if (!$request->name_bn) {
            $request->name_bn = $request->name_en;
        }

        if (!$request->description_bn) {
            $request->description_bn = $request->description_en;
        }

        // $slug = strtolower(str_replace(' ', '-', $request->name_en));
        if ($request->slug != null) {
            $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        } else {
            $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name_en)) . '-' . Str::random(5);
        }

        if ($request->category_id == null || $request->category_id == "") {
            $request->category_id = 0;
        }

        if ($request->regular_price == null || $request->regular_price == "") {
            $request->regular_price = 0;
        }

        if ($request->vendor_id == null || $request->vendor_id == "") {
            $request->vendor_id = 0;
        }
        if ($request->brand_id == null || $request->brand_id == "") {
            $request->brand_id = 0;
        }
        if ($request->points == null || $request->points == "") {
            $request->points = 0;
        }

        if ($request->supplier_id == null || $request->supplier_id == "") {
            $request->supplier_id = 0;
        }

        if ($request->unit_id == null || $request->unit_id == "") {
            $request->unit_id = 0;
        }

        if ($request->hasfile('product_thumbnail')) {
            $image = $request->file('product_thumbnail');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(438, 438)->save('upload/products/thumbnails/' . $name_gen);
            $save_url = 'upload/products/thumbnails/' . $name_gen;
        } else {
            $save_url = '';
        }

        if ($request->hasfile('video_thumbnail')) {
            $image = $request->file('video_thumbnail');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(438, 438)->save('upload/products/thumbnails/' . $name_gen);
            $video_url = 'upload/products/thumbnails/' . $name_gen;
        } else {
            $video_url = '';
        }

        $product = Product::create([
            'brand_id'              => $request->brand_id,
            'product_type'           => $request->product_type,
            'category_id'           => $request->category_id,
            'vendor_id'             => $request->vendor_id,
            'supplier_id'           => $request->supplier_id,
            'processor_type_id'     => $request->processor_type_id,
            'processor_model_id'    => $request->processor_model_id,
            'generation_id'         => $request->generation_id,
            'display_size_id'       => $request->display_size_id,
            'display_type_id'       => $request->display_type_id,
            'ram_size_id'           => $request->ram_size_id,
            'ram_type_id'           => $request->ram_type_id,
            'hdd_id'                => $request->hdd_id,
            'ssd_id'                => $request->ssd_id,
            'graphics_id'           => $request->graphics_id,
            'operating_system_id'   => $request->operating_system_id,
            // 'special_feature_id'    => $request->special_feature_id,
            'special_features' => $request->special_features,
            'extra_features'     => json_encode($request->extra_features),
            'unit_id'               => $request->unit_id,
            'name_en'               => $request->name_en,
            'subtitle_1'            => $request->subtitle_1,
            'subtitle_2'            => $request->subtitle_2,
            'subtitle_3'            => $request->subtitle_3,
            'faqs'                 => json_encode($request->faqs),
            'serial_number'        => $request->serial_number,
            'name_bn'               => $request->name_bn,
            'slug'                  => $slug,
            'unit_weight'           => $request->unit_weight,
            'purchase_price'        => $request->purchase_price,
            'wholesell_price'       => $request->wholesell_price,
            'wholesell_minimum_qty' => $request->wholesell_minimum_qty,
            'regular_price'         => $request->regular_price,
            'discount_price'        => $request->discount_price,
            'discount_type'         => $request->discount_type,
            'product_code'          => rand(10000, 99999),
            'minimum_buy_qty'       => 1,
            'stock_qty'             => $request->stock_qty,
            'short_description_en'  => $request->short_description_en,
            'short_description_bn'  => $request->short_description_bn,
            'description_en'        => $request->description_en,
            'description_bn'        => $request->description_bn,
            'is_featured'           => $request->is_featured ? 1 : 0,
            'is_trending'           => $request->is_trending ? 1 : 0,
            'is_replaceable'        => $request->is_replaceable ? 1 : 0,
            'is_deals'              => $request->is_deals ? 1 : 0,
            'is_digital'            => $request->is_digital ? 1 : 0,
            'is_stock'              => $request->is_stock ? 1 : 0,
            'status'                => $request->is_stock ? 0 : ($request->status ? 1 : 0),
            'points'                => $request->points,
            'video_thumbnail'       => $video_url,
            'video_url'             => $request->video_url,
            'product_thumbnail'     => $save_url,
            'created_by'            => Auth::guard('admin')->user()->id,
        ]);

        // Store product serial numbers
        // foreach ($request->serial_numbers as $serial) {
        //     $product->serialNumbers()->create([
        //         'serial_number' => $serial,
        //     ]);
        // }

        // dd($product);

        /* ========= Start Multiple Image Upload ========= */
        $images = $request->file('multi_img');
        if ($images) {
            foreach ($images as $img) {
                $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                Image::make($img)->resize(917, 1000)->save('upload/products/multi-image/' . $make_name);
                $uploadPath = 'upload/products/multi-image/' . $make_name;

                MultiImg::insert([
                    'product_id' => $product->id,
                    'photo_name' => $uploadPath,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
        /* ========= End Multiple Image Upload ========= */

        /* ========= Product Attributes Start ========= */
        $attribute_values = array();
        if ($request->has('choice_attributes')) {
            foreach ($request->choice_attributes as $key => $attribute) {
                $atr = 'choice_options' . $attribute;
                $item['attribute_id'] = $attribute;
                $data = array();

                foreach ($request[$atr] as $key => $value) {
                    array_push($data, $value);
                }

                $item['values'] = $data;
                array_push($attribute_values, $item);
            }
        }

        if (!empty($request->choice_attributes)) {
            $product->attributes = json_encode($request->choice_attributes);
            $product->is_varient = 1;

            if ($request->has('vnames')) {
                $i = 0;
                foreach ($request->vnames as $key => $name) {
                    $stock = ProductStock::create([
                        'product_id' => $product->id,
                        'varient'    => $name,
                        'sku'        => $request->vskus[$i],
                        'price'      => $request->vprices[$i],
                        'qty'        => $request->vqtys[$i],
                    ]);

                    $image = $request->vimages[$i];
                    if ($image) {
                        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                        Image::make($image)->resize(438, 438)->save('upload/products/variations/' . $name_gen);
                        $save_url = 'upload/products/variations/' . $name_gen;
                    } else {
                        $save_url = '';
                    }

                    $stock->image = $save_url;
                    $stock->save();

                    $i++;
                }
            }
        } else {
            $product->attributes = json_encode(array());
        }

        $attr_values = collect($attribute_values);
        $attr_values_sorted = $attr_values->sortByDesc('attribute_id');

        $sorted_array = array();
        foreach ($attr_values_sorted as $attr) {
            array_push($sorted_array, $attr);
        }

        $product->attribute_values = json_encode($sorted_array, JSON_UNESCAPED_UNICODE);
        /* ========= End Product Attributes ========= */

        // /* =========== Start Product Tags =========== */
        // $product->tags = implode(',', $request->tags);
        // /* =========== End Product Tags =========== */

        $product->save();

        //Ledger Entry
        $ledger = AccountLedger::create([
            'account_head_id' => 1,
            'particulars' => 'Product ID: ' . $product->id,
            'debit' => $product->regular_price,
            'product_id' => $product->id,
            'type' => 1,
        ]);
        $ledger->balance = get_account_balance() - $product->purchase_price;
        $ledger->save();

        if ($request->product_type == '2') {
            foreach ($request->group_id as $key => $group) {
                $group_product = new GroupProduct();
                $group_product->product_id =  $product->id;
                $group_product->group_product_id =  $group;
                $group_product->status = $request->status ? 1 : 0;
                $group_product->save();
            }
        }

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );
        if ($request->is_stock) {
            return redirect()->route('storage.products')->with($notification);
        }
        return redirect()->route('product.all')->with($notification);
    } // end method

    /*=================== Start EditProduct Methoed ===================*/
    public function EditProduct($id)
    {
        $product = Product::findOrFail($id);
        $faqs = json_decode($product->faqs, true); //decode JSON to array

        if (Auth::guard('admin')->user()->role == 2) {
            $vendor = Vendor::where('user_id', Auth::guard('admin')->user()->id)->first();
            if ($product->vendor_id  != $vendor->id) {
                abort(404);
            }
        }

        // Prepare UNSOLD serials for JS
        $unsoldSerials = $product->serialNumbers
            ->where('is_sold', 0)
            ->values()
            ->map(function ($s) {
                return [
                    'serial_number' => $s->serial_number,
                    'is_sold' => $s->is_sold,
                ];
            });

        $multiImgs = MultiImg::where('product_id', $id)->get();

        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $vendors = Vendor::latest()->get();
        $suppliers = Supplier::latest()->get();
        $units = Unit::latest()->get();
        $attributes = Attribute::latest()->get();
        $processor_types = Processor::latest()->get();
        $processor_models = ProcessorModel::latest()->get();
        $generations = Generation::latest()->get();
        $display_sizes = DisplaySize::latest()->get();
        $display_types = DisplayType::latest()->get();
        $ram_sizes = RamSize::latest()->get();
        $ram_types = RamType::latest()->get();
        $hdds = HDD::latest()->get();
        $ssds = SSD::latest()->get();
        $graphics = Graphic::latest()->get();
        $operating_systems = OperatingSystem::latest()->get();
        $special_features = SpecialFeature::latest()->get();

        //dd($product->stocks);
        // Get only the special features that belong to the product
        $selected_features = $product->special_features ?? [];
        $product_special_features = SpecialFeature::whereIn('id', $selected_features)->get();
        // dd($product_special_features);

        return view('backend.product.product_edit', compact('categories', 'vendors', 'suppliers', 'brands', 'attributes', 'product', 'multiImgs', 'units', 'processor_types', 'processor_models', 'generations', 'display_sizes', 'display_types', 'ram_sizes', 'ram_types', 'hdds', 'ssds', 'graphics', 'operating_systems', 'special_features', 'product_special_features', 'faqs', 'unsoldSerials'));
    }
    // end method
    public function detailsProduct($id)
    {

        $product = Product::findOrFail($id);

        $multiImgs = MultiImg::where('product_id', $id)->get();

        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $vendors = Vendor::latest()->get();
        $suppliers = Supplier::latest()->get();
        $units = Unit::latest()->get();
        $attributes = Attribute::latest()->get();
        $processor_types = Processor::latest()->get();
        $processor_models = ProcessorModel::latest()->get();
        $generations = Generation::latest()->get();
        $display_sizes = DisplaySize::latest()->get();
        $display_types = DisplayType::latest()->get();
        $ram_sizes = RamSize::latest()->get();
        $ram_types = RamType::latest()->get();
        $hdds = HDD::latest()->get();
        $ssds = SSD::latest()->get();
        $graphics = Graphic::latest()->get();
        $operating_systems = OperatingSystem::latest()->get();
        $special_features = SpecialFeature::latest()->get();

        //dd($product->stocks);

        return view('backend.product.product_details', compact('categories', 'vendors', 'suppliers', 'brands', 'attributes', 'product', 'multiImgs', 'units', 'processor_types', 'processor_models', 'generations', 'display_sizes', 'display_types', 'ram_sizes', 'ram_types', 'hdds', 'ssds', 'graphics', 'operating_systems', 'special_features'));
    }
    /*=================== Start ProductUpdate Methoed ===================*/
    public function ProductUpdate(Request $request, $id)
    {
        //        return $request->discount_price;
        $product = Product::find($id);

        if (!$request->name_bn) {
            $request->name_bn = $request->name_en;
        }

        if (!$request->description_bn) {
            $request->description_bn = $request->description_en;
        }

        if ($request->name_en != $product->name_en) {
            if ($request->slug != null) {
                $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            } else {
                $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name_en)) . '-' . Str::random(5);
            }
        } else {
            $slug = $product->slug;
        }

        if ($request->vendor_id == null || $request->vendor_id == "") {
            $request->vendor_id = 0;
        }

        if ($request->brand_id == null || $request->brand_id == "") {
            $request->brand_id = 0;
        }

        if ($request->points == null || $request->points == "") {
            $request->points = 0;
        }

        if ($request->supplier_id == null || $request->supplier_id == "") {
            $request->supplier_id = 0;
        }

        if ($request->unit_id == null || $request->unit_id == "") {
            $request->unit_id = 0;
        }

        if ($request->hasfile('product_thumbnail')) {
            try {
                if (file_exists($product->product_thumbnail)) {
                    unlink($product->product_thumbnail);
                }
            } catch (Exception $e) {
            }
            $image = $request->file('product_thumbnail');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(438, 438)->save('upload/products/thumbnails/' . $name_gen);
            $save_url = 'upload/products/thumbnails/' . $name_gen;
        } else {
            $save_url = $product->product_thumbnail;
        }


        if ($request->hasfile('video_thumbnail')) {
            try {
                if (file_exists($product->video_thumbnail)) {
                    unlink($product->video_thumbnail);
                }
            } catch (Exception $e) {
            }
            $image = $request->file('video_thumbnail');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(438, 438)->save('upload/products/thumbnails/' . $name_gen);
            $video_url = 'upload/products/thumbnails/' . $name_gen;
        } else {
            $video_url = $product->video_thumbnail;
        }

        $product->update([
            'brand_id'              => $request->brand_id,
            'category_id'           => $request->category_id,
            'vendor_id'             => $request->vendor_id,
            'supplier_id'           => $request->supplier_id,
            'processor_type_id'     => $request->processor_type_id,
            'processor_model_id'    => $request->processor_model_id,
            'generation_id'         => $request->generation_id,
            'display_size_id'       => $request->display_size_id,
            'display_type_id'       => $request->display_type_id,
            'ram_size_id'           => $request->ram_size_id,
            'ram_type_id'           => $request->ram_type_id,
            'hdd_id'                => $request->hdd_id,
            'ssd_id'                => $request->ssd_id,
            'graphics_id'           => $request->graphics_id,
            'operating_system_id'   => $request->operating_system_id,
            // 'special_feature_id'    => $request->special_feature_id,
            'special_features' => $request->special_features,
            'extra_features'     => json_encode($request->extra_features),
            'unit_id'               => $request->unit_id,
            'name_en'               => $request->name_en,
            'name_bn'               => $request->name_bn,
            'subtitle_1'            => $request->subtitle_1,
            'subtitle_2'            => $request->subtitle_2,
            'subtitle_3'            => $request->subtitle_3,
            'faqs'                  => json_encode($request->faqs),
            'slug'                  => $slug,
            'unit_weight'           => $request->unit_weight,
            'purchase_price'        => $request->purchase_price,
            'regular_price'         => $request->regular_price,
            'discount_price'        => $request->discount_price,
            'discount_type'         => $request->discount_type,
            'product_code'          => rand(10000, 99999),
            'serial_number'        => $request->serial_number,
            'minimum_buy_qty'       => $request->minimum_buy_qty,
            'stock_qty'             => $request->stock_qty,
            'short_description_en'  => $request->short_description_en,
            'short_description_bn'  => $request->short_description_bn,
            'description_en'        => $request->description_en,
            'description_bn'        => $request->description_bn,
            'is_featured'           => $request->is_featured ? 1 : 0,
            'is_trending'           => $request->is_trending ? 1 : 0,
            'is_replaceable'        => $request->is_replaceable ? 1 : 0,
            'is_deals'              => $request->is_deals ? 1 : 0,
            'is_digital'            => $request->is_digital ? 1 : 0,
            'status'                => $request->status ? 1 : 0,
            'points'                => $request->points,
            'video_url'             => $request->video_url,
            'product_thumbnail'     => $save_url,
            'video_thumbnail'       => $video_url,
            'created_by'            => Auth::guard('admin')->user()->id,
        ]);

       

        /* ========= Product Previous Stock Clear ========= */
        $product_stocks = $product->stocks;
        if (count($product_stocks) > 0) {
            if ($request->is_variation_changed) {
                foreach ($product_stocks as $stock) {
                    // unlink($stock->image);
                    try {
                        if (file_exists($stock->image)) {
                            unlink($stock->image);
                        }
                    } catch (Exception $e) {
                    }
                    $stock->delete();
                }
            } else {

                foreach ($product_stocks as $stock) {
                    $variant = $stock->id . "_variant";
                    $price = $stock->id . "_price";
                    $sku = $stock->id . "_sku";
                    $qty = $stock->id . "_qty";
                    $image = $stock->id . "_image";

                    $stock->update([
                        'sku' => $request->$sku,
                        'price' => $request->$price,
                        'qty' => $request->$qty,
                    ]);
                }
            }
        }

        if ($request->is_variation_changed) {
            /* ========= Product Attributes Start ========= */
            $attribute_values = array();
            if ($request->has('choice_attributes')) {
                foreach ($request->choice_attributes as $key => $attribute) {
                    $atr = 'choice_options' . $attribute;
                    $item['attribute_id'] = $attribute;
                    $data = array();

                    foreach ($request[$atr] as $key => $value) {
                        array_push($data, $value);
                    }

                    $item['values'] = $data;
                    array_push($attribute_values, $item);
                }
            }

            if (!empty($request->choice_attributes)) {
                $product->attributes = json_encode($request->choice_attributes);
                $product->is_varient = 1;

                if ($request->has('vnames')) {
                    $i = 0;
                    foreach ($request->vnames as $key => $name) {
                        $stock = ProductStock::create([
                            'product_id' => $product->id,
                            'varient'    => $name,
                            'sku'        => $request->vskus[$i],
                            'price'      => $request->vprices[$i],
                            'qty'        => $request->vqtys[$i],
                        ]);
                        //                        return $request->vimages[$i] ;
                        if ($request->vimages) {
                            $image = $request->vimages[$i];
                        } else {
                            $image = 0;
                        }

                        if ($image) {
                            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                            Image::make($image)->resize(438, 438)->save('upload/products/variations/' . $name_gen);
                            $save_url = 'upload/products/variations/' . $name_gen;
                        } else {
                            $save_url = '';
                        }

                        $stock->image = $save_url;
                        $stock->save();

                        $i++;
                    }
                }
            } else {
                $product->attributes = json_encode(array());
                $product->is_varient = 0;
            }

            $attr_values = collect($attribute_values);
            $attr_values_sorted = $attr_values->sortByDesc('attribute_id');

            $sorted_array = array();
            foreach ($attr_values_sorted as $attr) {
                array_push($sorted_array, $attr);
            }

            $product->attribute_values = json_encode($sorted_array, JSON_UNESCAPED_UNICODE);
            /* ========= End Product Attributes ========= */
        }


        /* =========== Start Product Tags =========== */
        // $product->tags = implode(',', $request->tags);
        /* =========== End Product Tags =========== */

        /* =========== Multiple Image Update =========== */

        $images = $request->file('multi_img');

        if ($images == Null) {
            $product->multi_imgs->photo_name = $request->multi_img;
            $product->update();
        } else {
            foreach ($images as $img) {
                $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                Image::make($img)->resize(917, 1000)->save('upload/products/multi-image/' . $make_name);
                $uploadPath = 'upload/products/multi-image/' . $make_name;

                MultiImg::insert([
                    'product_id' => $product->id,
                    'photo_name' => $uploadPath,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        $product->save();

        if ($product->product_type == '2') {
            DB::table('group_products')->where('product_id', $product->id)->delete();

            foreach ($request->group_id as $key => $group) {
                $group_product = new GroupProduct();
                $group_product->product_id =  $product->id;
                $group_product->group_product_id =  $group;
                $group_product->status = $request->status ? 1 : 0;
                $group_product->save();
            }
        }

        if ($product->is_stock == 1) {
            Session::flash('success', 'Product Updated Successfully');
            return redirect()->route('storage.products');
        } else {
            Session::flash('success', 'Product Updated Successfully');
            return redirect()->route('product.all');
        }
    } // end method
    /*=================== End ProductUpdate Methoed ===================*/

    /*=================== Start Multi Image Delete =================*/
    public function MultiImageDelete($id)
    {
        $oldimg = MultiImg::findOrFail($id);
        try {
            if (file_exists($oldimg->photo_name)) {
                unlink($oldimg->photo_name);
            }
        } catch (Exception $e) {
        }
        MultiImg::findOrFail($id)->delete();


        return response()->json(['success' => 'Product Deleted Successfully']);
    } // end method
    /*=================== End Multi Image Delete =================*/

    /*=================== Start ProductDelete Method =================*/
    public function ProductDelete($id)
    {
        if (!demo_mode()) {
            $product = Product::findOrFail($id);
            if (CampaingProduct::where('product_id', $id)->get()) {
                CampaingProduct::where('product_id', $id)->delete();
            }
            if (GroupProduct::where('product_id', $id)->get()) {
                GroupProduct::where('product_id', $id)->delete();
            }

            try {
                if (file_exists($product->product_thumbnail)) {
                    unlink($product->product_thumbnail);
                }
            } catch (Exception $e) {
            }

            $product->delete();

            $images = MultiImg::where('product_id', $id)->get();
            foreach ($images as $img) {
                try {
                    if (file_exists($img->photo_name)) {
                        unlink($img->photo_name);
                    }
                } catch (Exception $e) {
                }
                MultiImg::where('product_id', $id)->delete();
            }
            if ($product->product_type == '2') {
                DB::table('group_products')->where('product_id', $product->id)->delete();
            }

            $notification = array(
                'message' => 'Product Deleted Successfully',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Product can not be deleted on demo mode.',
                'alert-type' => 'error'
            );
        }

        $serials = ProductSerialNumber::where('product_id', $id)->get();
        foreach ($serials as $serial) {
            // Do something with each serial, e.g., delete
            $serial->delete();
        }


        return redirect()->back()->with($notification);
    } // end method
    /*=================== End ProductDelete Method =================*/

    /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id)
    {
        $product = Product::find($id);
        $product->status = 1;
        $product->save();

        $notification = array(
            'message' => 'Product Active Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method

    public function inactive($id)
    {
        $product = Product::find($id);
        $product->status = 0;
        $product->save();

        $notification = array(
            'message' => 'Product Inactive Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    } // end method

    /*=================== Start Featured Methoed ===================*/
    public function featured($id)
    {
        $product = Product::find($id);
        if ($product->is_featured == 1) {
            $product->is_featured = 0;
        } else {
            $product->is_featured = 1;
        }
        $product->save();
        $notification = array(
            'message' => 'Product Feature Status Changed Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method

    /*=================== Start Category With SubCategory  Ajax ===================*/
    public function GetSubProductCategory($category_id)
    {
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name_en', 'ASC')->get();
        return json_encode($subcat);
    } // end method

    /*=================== Start SubCategory With Childe Ajax ===================*/
    public function GetSubSubCategory($subcategory_id)
    {
        $childe = SubSubCategory::where('subcategory_id', $subcategory_id)->orderBy('subsubcategory_name_en', 'ASC')->get();
        return json_encode($childe);
    } // end method

    public function add_more_choice_option(Request $request)
    {
        $attributes = Attribute::whereIn('id', $request->attribute_ids)->get();
        // dd($attributes);
        return view('backend.product.attribute_select_value', compact('attributes'));
    }


    /* ============== Category Store Ajax ============ */
    public function categoryInsert(Request $request)
    {

        if ($request->name_en == Null) {
            return response()->json(['error' => 'Category Field  Required']);
        }

        $category = new Category();

        $category->name_en = $request->name_en;

        /* ======== Category Name English ======= */
        $category->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $category->name_bn = $request->name_en;
        } else {
            $category->name_bn = $request->name_bn;
        }

        /* ======== Category Parent Id  ======= */
        if ($request->parent_id != "0") {
            $category->parent_id = $request->parent_id;

            $parent = Category::find($request->parent_id);

            // dd($parent);
            $category->type = $parent->type + 1;
        }

        /* ======== Category Slug   ======= */
        if ($request->slug != null) {
            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        } else {
            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name_en)) . '-' . Str::random(5);
        }

        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/category/' . $name_gen);
            $save_url = 'upload/category/' . $name_gen;
        } else {
            $save_url = '';
        }

        $category->image = $save_url;
        $category->created_by = Auth::guard('admin')->user()->id;
        $category->save();

        $categories = Category::with('childrenCategories')->orderBy('name_en', 'asc')->get();

        return response()->json([
            'success' => 'Category Inserted Successfully',
            'categories' => $categories,
        ]);
    }

    /* ============== Brand Store Ajax ============ */

    /* ============== Brand Store Ajax ============== */
    public function brandInsert(Request $request)
    {

        if ($request->name_en == Null) {
            return response()->json(['error' => 'Brand Field  Required']);
        }

        $brand = new Brand();

        $brand->name_en = $request->name_en;

        /* ======== brand Name English ======= */
        $brand->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $brand->name_bn = $request->name_en;
        } else {
            $brand->name_bn = $request->name_bn;
        }

        /* ======== Category Slug   ======= */
        if ($request->slug != null) {
            $brand->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        } else {
            $brand->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name_en)) . '-' . Str::random(5);
        }



        // dd($request->image);


        if ($request->hasfile('brand_image')) {
            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/brand/' . $name_gen);
            $save_url = 'upload/brand/' . $name_gen;
        } else {
            $save_url = '';
        }

        $brand->brand_image = $save_url;
        $brand->created_by = Auth::guard('admin')->user()->id;

        $brand->save();
        $brands = Brand::all();

        return response()->json([
            'success' => 'Brand Inserted Successfully',
            'brands' => $brands,
        ]);
    }
}
