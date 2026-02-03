<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\ReturningProduct;
use App\Models\ReturnRequest;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReturningProductController extends Controller
{
    private $returnRequest;
    public function index($invoice_no, $slug)
    {
//        return 'ok';
        if (Auth::user()->role == 3){
            $product = Product::where('slug', $slug)->first();
            $order = OrderDetail::where('invoice_no', $invoice_no)->where('product_id', $product->id)->first();
//            return $order;
            return view('FrontEnd.order.return2', compact('order'));
//            return view('FrontEnd.order.return2', compact('order', 'replaceable'));
        }
        else{
            return redirect()->route('login');
        }

    }

    public function submit(Request $request)
    {
//        return $request;
        $request->validate([
            'issue' => ['required'],
            'qty' => ['required'],
            'image' => ['required']
        ]);
        ReturningProduct::add($request);
        return redirect()->route('dashboard')->with('message', 'Return Request Has Been Submitted');
    }

    public function check()
    {
        $order = Order::find($_GET['order_id']);
        if($order != null){
            if($order->delivery_status == 'delivered'){
                $this->returnRequest = ReturningProduct::where('order_id', $_GET['order_id'])
                    ->where('product_id', $_GET['product_id'])
                    ->where('order_details_id', $_GET['order_details_id'])->first();
                if ($this->returnRequest != null){
                    if ($this->returnRequest->status == 0) //if product return request response generated
                    {
                        $data['result']= false;
                        $data['error'] = 'Already Made a Return Request';


                    }
                    elseif($this->returnRequest->status == 1){
                        $product = Product::find($_GET['product_id']);
                        $data['invoice_no'] = $order->invoice_no;
                        $data['slug'] = $product->slug;
                        $data['result'] = true;

                    }
                    else{
                        $data['result']= false;
                        $data['error'] = 'Request Has Been Rejected';
                    }
                }
                else{
                    $product = Product::find($_GET['product_id']);
                    $data['invoice_no'] = $order->invoice_no;
                    $data['slug'] = $product->slug;
                    $data['result'] = true;
                }
            }
            else{
                $data['result']= false;
                $data['error'] = 'Cannot Return the Product';
            }
        }
        else{
            $data['result']= false;
            $data['error'] = 'No Order Found';
        }

        return response()->json($data);
    }

    public function list()
    {
        if(Auth::guard('admin')->user()->role == 1){
//            $return_requests = ReturnRequest::latest();
            $return_requests = ReturningProduct::latest();
//            return $return_requests->get();
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
                    array_push($request_id, $product->id);
                }
            }
            $return_requests = ReturningProduct::whereIn('id', $request_id)->latest();
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
        $return_request = ReturningProduct::find($request->id);
//        return $return_request;
        if ($return_request->issue == 'damaged_product'){
            $product = OrderDetail::find($request->order_details_id);
            $item = Product::find($return_request->product_id);
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
                    $stock->qty = ($stock->qty - $product->qty);
                    $stock->damaged_qty += $product->qty;
                    $stock->save();
                }
            }
            else{
                $item->stock_qty -= $product->qty;
                $item->damaged_qty += $product->qty;
                $item->save();
            }
        }
//        return $return_request;
//        $return_request->status = $request->return_request_status;
//        $return_request->save();

        ReturningProduct::updateStatus($request);

        return redirect()->route('return-request.all');
    }
}
