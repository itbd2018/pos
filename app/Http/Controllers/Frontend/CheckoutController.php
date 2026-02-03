<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\Address;
use App\Models\District;
use App\Models\Upazilla;
use App\Models\SmsTemplate;
use App\Utility\SmsUtility;
use App\Utility\SendSMSUtility;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductStock;
use App\Models\AccountHead;
use App\Models\AccountLedger;
use App\Http\Controllers\Frontend\PublicSslCommerzPaymentController;
use App\Models\Shipping;
use App\Models\Coupon;
use Intervention\Image\Facades\Image;


class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(!guest_checkout() && !auth()->check()){
        //     return redirect()->route('login');
        // }
        $addresses = Address::where('status', 1)->get();
        $shippings = Shipping::where('status', 1)->get();
        $order_types = Order::select('order_type')->distinct()->get();


        $carts = Cart::content();
        if (count($carts) == 0) {
            //            return back()->with('message', 'Cart is Empty!!');
            return redirect()->route('cart.show');
        }

        $cartTotal = Cart::total();
        // if(Auth::user() && Auth::user()->role == 3){
        //     return view('FrontEnd.checkout.index',compact('addresses','shippings', 'carts', 'cartTotal'));
        // }
        // else{
        //     return redirect()->route('login');
        // }
        return view('FrontEnd.checkout.index', compact('addresses', 'shippings', 'order_types', 'carts', 'cartTotal'));
    } // end method

    public function shippingAjax($shipping_id)
    {
        $shipping = Shipping::find($shipping_id);
        return json_encode($shipping);
    }

    /* ============== Start GetCheckoutProduct Method ============= */
    public function getCheckoutProduct()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal,
        ));
    } //end method
    /* ============= End GetCheckoutProduct Method ============== */

    /* ============= Start getdivision Method ============== */
    public function getdivision()
    {
        $division = District::where('division_id', $_GET['division_id'])->orderBy('district_name_en', 'ASC')->get();

        return json_encode($division);
    }
    /* ============= End getdivision Method ============== */

    /* ============= Start getupazilla Method ============== */
    public function getupazilla()
    {
        $upazilla = Upazilla::where('district_id', $_GET['district_id'])->orderBy('name_en', 'ASC')->get();

        return json_encode($upazilla);
    }
    /* ============= End getupazilla Method ============== */



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
        // dd($request);
        $data = $request->validate([
            // 'payment_type' => 'required|in:1,3', // Ensure it matches one of the dropdown options
            'nid' => 'nullable|required_if:payment_type,3|numeric',
            'nid_front' => 'nullable|required_if:payment_type,3',
            'nid_back' => 'nullable|required_if:payment_type,3',
            'nominee_name' => 'nullable|required_if:payment_type,3|max:191',
            'nominee_relation' => 'nullable|required_if:payment_type,3|max:191',
            'nominee_nid' => 'nullable|required_if:payment_type,3|numeric',
            'name' => 'required|max:191',
            'email' => 'nullable|email|max:191',
            // 'phone' => ['required', 'regex:/(\+){0,1}(88){0,1}01(3|4|5|6|7|8|9)(\d){8}/', 'min:11', 'max:15'],
            'address' => 'required|max:10000',
            // 'payment_option' => 'required',
            'comment' => 'nullable|max:2000',
        ], [
            'payment_type.required' => 'Payment type is required.',
            'payment_type.in' => 'Invalid payment type selected.',
            'nid.required_if' => 'NID is required.',
            'nid.numeric' => 'NID must be a number.',
            'nid_front.required_if' => 'NID front image is required.',
            'nid_back.required_if' => 'NID back image is required.',
            'nominee_name.required_if' => 'Nominee name is required.',
            'nominee_name.max' => 'Nominee name must not exceed 191 characters.',
            'nominee_relation.required_if' => 'Nominee relation is required.',
            'nominee_relation.max' => 'Nominee relation must not exceed 191 characters.',
            'nominee_nid.required_if' => 'Nominee NID is required.',
            'nominee_nid.numeric' => 'Nominee NID must be a number.',
            'name.required' => 'Name is required.',
            'name.max' => 'Name must not exceed 191 characters.',
            'email.email' => 'Email must be a valid email address.',
            'email.max' => 'Email must not exceed 191 characters.',
            'phone.required' => 'Phone number is required.',
            'phone.regex' => 'Phone number is invalid.',
            //  'phone.min' => 'Phone number must be at least 11 characters.',
            //  'phone.max' => 'Phone number cannot exceed 15 characters.',
            'address.required' => 'Address is required.',
            'address.max' => 'Address must not exceed 10000 characters.',
            'payment_option.required' => 'Payment option is required.',
            'comment.max' => 'Comment must not exceed 2000 characters.',
        ]);

        // dd(Cart::total()+$request->total_amount);
        // dd($request->total_amount);
        // if($request->payment_option == 'nagad'){
        //     return redirect()->route('checkout.payment');
        // }
        $carts = Cart::content();
        //dd($carts);

        if ($carts->isEmpty()) {
            $notification = array(
                'message' => 'Your cart is empty.',
                'alert-type' => 'error'
            );
            return redirect()->route('home')->with($notification);
        }

        // dd($request->all());

        if (Auth::check()) {
            $user_id = Auth::id();
            $type = 1;
        } else {
            $user_id = 1;
            $type = 2;
        }

        if ($request->payment_option == 'cod') {
            $payment_status = 0;
        } else {
            $payment_status = 1;
        }

        $invoice_data = Order::orderBy('id', 'desc')->first();

        if ($invoice_data) {
            $lastId = $invoice_data->id;
            // $idd = str_replace("E-", "", $lastId);
            $id = str_pad($lastId + 1, 7, 0, STR_PAD_LEFT);
            $invoice_no = $id;
        } else {
            $invoice_no = "0000001";
        }

        // $checkAffiliate = Session::get('couponCode');
        // dd($checkAffiliate);
        $checkAffiliate = Coupon::where('coupon_code', Session::get('couponCode'))->first();

        //    if($checkAffiliate != NULL){
        if ($checkAffiliate != NULL && $checkAffiliate->coupon_type == 2) {
            $affiliate_user_id = Session::get('couponUserId');
            $couponCode = Session::get('couponCode');
        } else {
            $affiliate_user_id = Null;
            $couponCode = Null;
        }
        //    }

        // Process the nid_front file
        if ($request->hasFile('nid_front')) {
            $nidFront = $request->file('nid_front');
            $nidFrontName = hexdec(uniqid()) . '.' . $nidFront->getClientOriginalExtension();
            Image::make($nidFront)->resize(800, 800)->save('uploads/nid/' . $nidFrontName); // Resize as needed
            $nidFrontPath = 'uploads/nid/' . $nidFrontName;
        } else {
            $nidFrontPath = Null;
        }
        // Process the nid_back file
        if ($request->hasFile('nid_back')) {
            $nidBack = $request->file('nid_back');
            $nidBackName = hexdec(uniqid()) . '.' . $nidBack->getClientOriginalExtension();
            Image::make($nidBack)->resize(800, 800)->save('uploads/nid/' . $nidBackName); // Resize as needed
            $nidBackPath = 'uploads/nid/' . $nidBackName;
        } else {
            $nidBackPath = Null;
        }

        //  dd($nidFrontPath, $nidBackPath);

        // order add //
        $order = Order::create([
            'user_id' => $user_id,
            'order_type' => '1',
            'nid' => $request->nid,
            'nid_front' => $nidFrontPath, // Max file size 2MB
            'nid_back'  => $nidBackPath,
            'nominee_name' => $request->nominee_name ?? null,
            'relation' => $request->nominee_relation ?? null,
            'nominee_nid' => $request->nominee_nid ?? null,
            'affiliate_user_id' => $affiliate_user_id,
            'coupon_code' => $couponCode,
            'name' => $request->name,
            'sub_total' => $request->sub_total,
            'grand_total' => $request->grand_total,
            'shipping_charge' => $request->shipping_charge,
            'shipping_name' => $request->shipping_name,
            'shipping_type' => $request->shipping_type,
            'payment_method' => $request->payment_option,

            'payment_status' => $payment_status,
            // 'invoice_no' => date('Ymd-His') . rand(10, 99),
            'invoice_no' => $invoice_no,
            'delivery_status' => 'pending',
            'phone' => $request->phone,
            'email' => $request->email,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'upazilla_id' => $request->upazilla_id,
            'address' => $request->address,
            'comment' => $request->comment,
            'coupon' => Session::get('amount'),
            'type' => $type,
            //'created_by' => Auth::guard('admin')->user()->id,
        ]);

        // start send order sms to customer phone 
        // $phone = $order->phone;
        // $name = $order->name;

        $phone = "01901378164"; //this is admin phone number;       

        $message = "On LaptopAche.com, A new order has been placed." . PHP_EOL .
            "Invoice No: {$order->invoice_no}" . PHP_EOL .
            "Time: " . now()->format('Y-m-d H:i:s'); 

        $url = "https://msg.elitbuzz-bd.com/smsapi";
        $data = [
            "api_key"   => "C200931167833878873d89.46775453",
            "type"      => "text",
            "contacts"  => $phone,
            "senderid"  => "8809601012461",
            "msg"       => $message,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        // end send order sms to customer phone 

        $coupon = Coupon::where('id', Session::get('couponId'))
            ->where('status', 1)
            ->where('total_use_limit', '>', 0)
            ->first();

        if ($coupon) {
            // Decrement total_use_limit
            $coupon->decrement('total_use_limit');
        }

        // if(get_setting('otp_system')){
        //     $sms_template = SmsTemplate::where('name','order_message')->where('status',1)->first();
        //     if($sms_template){
        //         $sms_body       = $sms_template->body;
        //         $sms_body       = str_replace('[[order_code]]', $order->invoice_no, $sms_body);
        //         $sms_body       = str_replace('[[order_amount]]', $order->grand_total, $sms_body);
        //         $sms_body       = str_replace('[[site_name]]', env('APP_NAME'), $sms_body);

        //         if($order->pay_status == 1){
        //             $payment_info = json_decode($order->payment_info);
        //             $sms_body     = str_replace('[[payment_details]]', 'পেমেন্ট স্ট্যাটাসঃ paid'.', ট্রান্সেকশন আইডিঃ '.$order->transaction_id.', মাধ্যমঃ '.$order->payment_method.' ', $sms_body);
        //         }else{
        //             $sms_body       = str_replace('[[payment_details]]', '', $sms_body);
        //         }

        //         if(substr($order->phone,0,3)=="+88"){
        //             $phone = $order->phone;
        //         }elseif(substr($order->phone,0,2)=="88"){
        //             $phone = '+'.$order->phone;
        //         }else{
        //             $phone = '+88'.$order->phone;
        //         }
        //         //dd($phone);
        //         SendSMSUtility::sendSMS($phone, $sms_body);

        //         // $sms_body = str_replace('আপনার', 'নতুন', $sms_body);
        //         // $setting = Setting::where('name', 'phone')->first();
        //         // if($setting->value != null){
        //         //     $admin_phone=$setting->value;

        //         //     if(substr($admin_phone,0,3)=="+88"){
        //         //         $phone = $admin_phone;
        //         //     }elseif(substr($admin_phone,0,2)=="88"){
        //         //         $phone = '+'.$admin_phone;
        //         //     }else{
        //         //         $phone = '+88'.$admin_phone;
        //         //     }
        //         //     SendSMSUtility::sendSMS($admin_phone, $sms_body);
        //         // }
        //     }
        // }


        // order details add //
        foreach ($carts as $cart) {
            // dd($cart);
            $vendor_id = 0;
            $product = Product::find($cart->id);
            if ($product->vendor_id != 0) {
                $vendor_id = $product->vendor_id;
            }
            if ($cart->options->is_varient == 1) {
                $variations = array();
                for ($i = 0; $i < count($cart->options->attribute_names); $i++) {
                    $item['attribute_name'] = $cart->options->attribute_names[$i];
                    $item['attribute_value'] = $cart->options->attribute_values[$i];
                    array_push($variations, $item);
                }
                OrderDetail::insert([
                    'order_id' => $order->id,
                    'invoice_no' => $order->invoice_no,
                    'product_id' => $cart->id,
                    'vendor_id' => $vendor_id,
                    'product_name' => $cart->name,
                    'is_varient' => 1,
                    'variation' => json_encode($variations, JSON_UNESCAPED_UNICODE),
                    'qty' => $cart->qty,
                    'price' => $cart->price,
                    'tax' => $cart->tax,
                    'created_at' => Carbon::now(),
                ]);

                // stock calculation //
                $stock = ProductStock::where('product_id', $product->id)->where('varient', $cart->options->varient)->first();
                //                 dd($cart);
                if ($stock) {
                    //                     dd($stock->qty, $cart->qty);
                    $stock->qty = ($stock->qty - $cart->qty);
                    $stock->save();
                }
            } else {
                OrderDetail::insert([
                    'order_id' => $order->id,
                    'invoice_no' => $order->invoice_no,
                    'product_id' => $cart->id,
                    'vendor_id' => $vendor_id,
                    'product_name' => $cart->name,
                    'is_varient' => 0,
                    'qty' => $cart->qty,
                    'price' => $cart->price,
                    'tax' => $cart->tax,
                    'created_at' => Carbon::now(),
                ]);
            }

            $product->stock_qty = $product->stock_qty - $cart->qty;
            $product->save();
        }

        Cart::destroy();
        Session::forget('couponCode');
        Session::forget('discountType');
        Session::forget('amount');
        //Ledger Entry
        $prev_balance = AccountLedger::orderBy('id', 'desc')->first();
        if (!$prev_balance) {
            $balance = 0;
        } else {
            $balance = $prev_balance->balance;
        }

        $ledger_balance = $balance + $order->grand_total;
        $ledger = AccountLedger::create([
            'account_head_id' => 2,
            'particulars' => 'Order ID: ' . $order->id,
            'credit' => $order->grand_total,
            'order_id' => $order->id,
            'balance' => $ledger_balance,
            'type' => 2,
        ]);
        //        $ledger->save();

        $notification = array(
            'message' => 'Your order has been placed successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('checkout.success', $order->invoice_no)->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::where('invoice_no', $id)->first();

        $notification = array(
            'message' => 'Your Order Successfully.',
            'alert-type' => 'success'
        );

        return view('FrontEnd.order.order_view', compact('order'))->with($notification);
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

    // public function Myorders(){

    //     $orders = Order::where('user_id',Auth::id())->orderBy('id','DESC')->get();
    //     return view('frontend.user.order.order_view',compact('orders'));

    // }

    public function payment(Request $request)
    {
        //  dd(request()->all());

        if ($request->payment_option == 'cod') {
            $checkout = new CheckoutController;
            return $checkout->store($request);
        }

        $payment_method = $request->payment_option;
        $total_amount = Cart::total();
        $last_order = Order::orderBy('id', 'DESC')->first();
        $order_id = $last_order ? $last_order->id + 1 : 1;
        $invoice_no = date('YmdHi') . $order_id;
        Session::put('invoice_no', $invoice_no);

        if ($request->payment_option == 'cod') {
            return redirect()->route('checkout.store');
        } else {
            Session::put('payment_method', $request->payment_option);
            Session::put('payment_type', 'cart_payment');
            Session::put('payment_amount', $total_amount);
            if ($request->payment_option == 'nagad') {
                $nagad = new NagadController;
                return $nagad->getSession();
            } else if ($request->payment_option == 'bkash') {
                $bkash = new BkashController;
                return $bkash->pay();
            } elseif ($request->payment_option == 'sslcommerz') {
                $sslcommerz = new PublicSslCommerzPaymentController;
                return $sslcommerz->index($request);
            } elseif ($payment_method == 'aamarpay') {
                $aamarpay = new AamarpayController;
                return $aamarpay->index();
            }
        }

        Session::forget('couponCode');
        Session::forget('discountType');
        Session::forget('amount');
        Session::forget('status');

        return view('FrontEnd.checkout.payment', compact('payment_method', 'total_amount', 'invoice_no'));
    }

    public function success($orderId, $json)
    {

        dd(json_decode($json));
    }
}
