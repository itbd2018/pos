<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ReturningProduct;
use App\Models\ReturnRequest;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReturnRequestController extends Controller
{
    private $returnRequest;
    public function index($invoice_no, $slug)
    {
        if (Auth::check() && Auth::user()->role == 3){
//            $order = Order::where('user_id',Auth::id())->where('invoice_no', $invoice_no)->first();
//            $replaceable = 0;
//            foreach ($order->order_details as $product){
//                if ($product->product->is_replaceable == 1){
//                    $replaceable++;
//                }
//            }
            $product = Product::where('slug', $slug)->first();
            if (Order::where('invoice_no', $invoice_no)->where('user_id', Auth::user()->id)->first()){
                $order_details = OrderDetail::where('invoice_no', $invoice_no)->where('product_id', $product->id)->first();
                return view('FrontEnd.order.return2', compact('order_details'));
            }
            else{
                return back();
            }

//            return view('FrontEnd.order.return2', compact('order', 'replaceable'));
        }
        else{
            return redirect()->route('login');
        }

    }

    public function submit(Request $request)
    {
//        return $request;
        $ordered_product_id = explode(',', $request->ordered_product_id);
        $this->returnRequest = ReturnRequest::add($request);
        ReturningProduct::add($this->returnRequest, $request, $ordered_product_id);
        return redirect()->route('dashboard')->with('message', 'Return Request Has Been Submitted');
    }

    public function check($id)
    {
        $this->returnRequest = ReturnRequest::where('order_id', $id)->orderBy('order_id', 'desc')->first();
        if ($this->returnRequest){
            if ($this->returnRequest->status == 1) //if product return request response generated
            {
                $data['result'] = true;
                $data['order'] = Order::find($id);
            }
            else{

                $data['result']= false;
                $data['error'] = 'Already Made a Return Request';
            }
        }
        else{
            $order = Order::find($id);

            if ($order->delivery_status == 'delivered' ){
                $datetime1 = strtotime($order->created_at); // convert to timestamps
                $datetime2 = strtotime(date('Y-m-d')); // convert to timestamps
                $days = (int)(($datetime2 - $datetime1)/86400);
                $order_return_duration = get_setting('order_return_duration')->value;
                if($days > $order_return_duration){
                    $data['result'] = false; // not able to make a request
                    $data['error'] = 'Return Period Exceeded';
                }
                else{
                    $data['result'] = true; // able to make a request
                    $data['order'] = Order::find($id);
                }
            }
            elseif ($order->delivery_status == 'cancelled'){
                $data['result'] = false; // not able to make a request
                $data['error'] = 'Your Ordered Has Been Cancelled';
            }
            else{
                $data['result'] = false; // not able to make a request
                $data['error'] = 'Your Ordered Has not Been Delivered Yet';
            }

        }
        return response()->json($data);
    }

    public function list()
    {
        if(Auth::guard('admin')->user()->role == 1){
            $return_requests = ReturnRequest::latest();
        }
        else{
            $request_id = array();
            $vendor = Vendor::where('user_id', Auth::guard('admin')->user()->id)->first();
//            return $vendor;
            foreach (ReturningProduct::all() as $product){
//                return $product;
                $main_product = Product::find($product->product_id);
//                return $main_product;
                if( $main_product != null && $main_product->vendor_id == $vendor->id){
                    array_push($request_id, $product->request_id);
                }
            }
            $return_requests = ReturnRequest::whereIn('id', $request_id)->latest();
        }
        if(isset($_GET['month']) && $_GET['month'] > 0){
            $return_requests  =$return_requests->whereMonth('created_at', $_GET['month']);
        }
//        if(isset($_GET['product_id']) && $_GET['product_id'] > 0){
//
//        }
        if(isset($_GET['status']) && ($_GET['status'] != 0 || $_GET['status'] != null)){
            $return_requests  =$return_requests->where('status', $_GET['status']);
        }
        $return_requests = $return_requests->paginate(25);
        return view('backend.return-request.list', compact('return_requests'));
    }

    public function show($id)
    {
        $return_request = ReturnRequest::find($id);
        $returning_products = get_returning_products($id);
        $order = Order::find($return_request->order_id);
        return view('backend.return-request.details', compact('return_request', 'returning_products', 'order'));
    }

    public function update(Request $request)
    {
//        return $request;
        $return_request = ReturnRequest::find($request->request_id);
//        return $return_request;
        $return_request->status = $request->return_request_status;
        $return_request->save();

        ReturningProduct::updateStatus($request);

        return redirect()->route('return-request.all');
    }


}
