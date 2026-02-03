<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\User;
use App\Models\AccountHead;
use App\Models\AccountLedger;
use App\Models\Order;
use App\Models\OrderDetail;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('status', 1)->latest()->get();
        $categories = Category::where('status', 1)->latest()->get();
        $brands = Brand::where('status', 1)->latest()->get();
        $customers = User::where('role', 3)->orWhere('role', 4)->where('status', 1)->latest()->get();
        return view('backend.pos.index', compact('products', 'categories', 'brands', 'customers'));
    }

    public function getProduct()
    {
        $product = Product::findOrFail($_GET['id']);
        return json_encode($product);
    }

    public function getProductVariations()
    {
        $product = ProductStock::where('product_id', $_GET['id'])->get();

        return json_encode($product);
    }

    public function getVariantProduct()
    {
        $product = ProductStock::findOrFail($_GET['id']);

        return json_encode($product);
    }

    public function filter()
    {
        $products = Product::where('status', 1);
        if (isset($_GET['search_term']) && $_GET['search_term'] > 0) {
            $products = $products->where('name_en', 'like', '%' . $_GET['search_term'] . '%');
        }
        if (isset($_GET['category_id']) && $_GET['category_id'] > 0) {
            $products = $products->where('category_id', $_GET['category_id']);
        }
        if (isset($_GET['brand_id']) && $_GET['brand_id'] > 0) {
            $products = $products->where('brand_id', $_GET['brand_id']);
        }
        $products = $products->get();
        return json_encode($products);
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
        //        return $request;
        $product_ids = $request->product_id;
        $variant_ids = $request->variant_id;

        if ((!$product_ids || count($product_ids) <= 0) && (!$variant_ids || count($variant_ids) <= 0)) {
            $notification = array(
                'message' => 'Add at least one product.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        //dd($request);

        $user = User::findOrFail($request->customer_id);

        //dd($user);

        if ($request->payment_method == NULL) {
            $request->payment_method = "cash";
        }

        if ($request->payment_status == NULL) {
            $request->payment_status = 0;
        }

        if ($user->phone == NULL) {
            $user->phone = "";
        }

        if ($user->email == NULL) {
            $user->email = "";
        }

        $invoice_data = Order::orderBy('id', 'desc')->first();

        // SERVER-SIDE VALIDATION (IMPORTANT)
        $calculatedTotal =
            $request->subtotal +
            $request->tax_amount +
            $request->shipping_charge -
            $request->discount;

        if (round($calculatedTotal, 2) != round($request->total, 2)) {
            return back()->with([
                'message' => 'Invalid order total',
                'alert-type' => 'error'
            ]);
        }

        if ($invoice_data) {
            $lastId = $invoice_data->id;
            // $idd = str_replace("E-", "", $lastId);
            $id = str_pad($lastId + 1, 7, 0, STR_PAD_LEFT);
            $invoice_no = $id;
        } else {
            $invoice_no = "0000001";
        }

        $order = Order::create([
            'order_type' => 2,
            'user_id' => $request->customer_id,
            'sub_total' => $request->total,
            'tax'             => $request->tax,
            'tax_amount'      => $request->tax_amount,
            'shipping_charge' => $request->shipping_charge,
            'discount'        => $request->discount,
            'grand_total' => $request->total,
            'payment_method' => $request->payment_method,
            'payment_status' => 1,
            'invoice_no' => $invoice_no,
            'division_id' => 0,
            'delivery_status' => 'pending',
            'name' => $user->name,
            'phone' => $user->phone,
            'email' => $user->email,
            'address' => $user->address,
            'type' => 3,
            //'created_by' => Auth::guard('admin')->user()->id,
        ]);

        if ($product_ids && count($product_ids) > 0) {
            // order details add //
            for ($i = 0; $i < count($product_ids); $i++) {
                $product = Product::find($product_ids[$i]);
                OrderDetail::insert([
                    'invoice_no' => $invoice_no,
                    'order_id' => $order->id,
                    'product_id' => $product_ids[$i],
                    'is_varient' => 0,
                    'qty' => $request->qty[$i],
                    'price' => $request->price[$i],
                    'created_at' => Carbon::now(),
                ]);

                $product->update([
                    'stock_qty' => $product->stock_qty - $request->qty[$i],
                ]);
            }
        }
        if ($variant_ids && count($variant_ids) > 0) {

            for ($i = 0; $i < count($variant_ids); $i++) {
                $product = ProductStock::find($variant_ids[$i]);
                //            $varient = explode("-", $product->varient);
                //            $variations = array();
                //            for($i=0; $i<count($varient); $i++){
                //                $item['attribute_name'] = '';
                //                $item['attribute_value'] = $varient;
                //                array_push($variations, $item);
                //            }

                OrderDetail::insert([
                    'invoice_no' => $invoice_no,
                    'order_id' => $order->id,
                    'product_id' => $product->product_id,
                    'is_varient' => 1,
                    'variation' => $product->varient,
                    //                'variation' => json_encode($variations, JSON_UNESCAPED_UNICODE),
                    'qty' => $request->variant_qty[$i],
                    'price' => $request->variant_price[$i],
                    'created_at' => Carbon::now(),
                ]);

                $product->update([
                    'qty' => $product->qty - $request->variant_qty[$i],
                ]);
            }
        }

        //Ledger Entry
        $ledger = AccountLedger::create([
            'account_head_id' => 2,
            'particulars' => 'Order ID: ' . $order->id,
            'credit' => $order->grand_total,
            'order_id' => $order->id,
            'type' => 2,
        ]);
        $ledger->balance = get_account_balance() + $order->grand_total;
        $ledger->save();

        $notification = array(
            'message' => 'Your order has been placed successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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

    public function customerInsert(Request $request)
    {
        //        return $request;
        // if($request->name == Null){
        //     return response()->json(['error'=> 'Customer Field Required']);
        // }

        $this->validate($request, [
            'name'              => 'required',
            'username'          => ['nullable', 'unique:users'],
            'phone'             => ['required', 'regex:/(\+){0,1}(88){0,1}01(3|4|5|6|7|8|9)(\d){8}/', 'min:11', 'max:15', 'unique:users'],
            'email'             => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'address'           => 'required',
            'profile_image'     => 'nullable',
        ]);

        $customer = new User();
        if ($request->hasfile('profile_image')) {
            $imageName = rand() . '.' . $request->profile_image->extension();
            $directory = 'uploads/users/';
            $imageUrl = $directory . $imageName;
            $request->profile_image->move($directory, $imageName);
            //            return $imageUrl;
        } else {
            $imageUrl = '';
        }
        $customer->profile_image = $imageUrl;

        $customer->name     = $request->name;
        $customer->username = $request->username;
        $customer->phone    = $request->phone;
        $customer->email    = $request->email;
        $customer->address  = $request->address;
        $customer->role     = 3;
        $customer->status   = 1;
        $customer->password = Hash::make("12345678");
        $customer->save();

        //        $customers = User::where('role', 3)->orderBy('id','desc')->get();

        //        return response()->json([
        //            'success'=> 'Customer Inserted Successfully',
        //            'customers' => $customers,
        //        ]);
        Session::flash('success', 'Customer Added Successfully');
        return back();
    }
}
