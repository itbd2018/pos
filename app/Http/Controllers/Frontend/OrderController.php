<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use Auth;

class OrderController extends Controller
{
	/* ============ User Orders ============== */
    public function index()
    {
       $orders = Order::where('user_id',Auth::id())->orderBy('id','DESC')->get();

       // dd($orders);
       return view('dashboard', compact('orders'));
    } // end method
    public function getProductById()
    {
//        $data['order_id'] = $_GET['order_id'];
//        $data['product'] = $_GET['product_id'];
//        return response($data);
        $product = OrderDetail::find($_GET['product_id']);
        return response()->json($product);
    }
}


