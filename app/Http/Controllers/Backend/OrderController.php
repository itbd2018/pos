<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AccountLedger;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Vendor;
use App\Models\VendorComission;
use App\Models\VendorTransaction;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\Address;
use App\Models\District;
use App\Models\ProductSerialNumber;
use App\Models\Upazilla;
use App\Models\Shipping;
use Session;
use PDF;
use function Symfony\Component\VarDumper\Dumper\esc;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = $request->date;
        $delivery_status = null;
        $payment_status = null;

        //dd($request);

        //$orders = Order::orderBy('id', 'desc');

        // if ($request->delivery_status != null) {
        //     $orders = $orders->where('delivery_status', $request->delivery_status);
        //     // dd($orders);
        //     $delivery_status = $request->delivery_status;
        // }

        // if ($request->payment_status != null) {
        //     $orders = $orders->where('payment_status', $request->payment_status);
        //     $payment_status = $request->payment_status;
        // }

        // if ($date != null) {
        //     $orders = $orders->where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])));
        // }

        if ($request->delivery_status != null && $request->payment_status != null && $date != null) {

            $orders = Order::where('order_type', 1)
                ->where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))
                ->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])))
                ->where('delivery_status', $request->delivery_status)
                ->where('payment_status', $request->payment_status);

            $delivery_status = $request->delivery_status;
            $payment_status = $request->payment_status;
        } else if ($request->delivery_status == null && $request->payment_status == null && $date == null) {
            $orders = Order::where('order_type', 1)->orderBy('id', 'desc');
        } else {
            if ($request->delivery_status == null) {
                if ($request->payment_status != null && $date != null) {
                    $orders = Order::where('order_type', 1)->where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])))->where('payment_status', $request->payment_status);
                    $payment_status = $request->payment_status;
                } else if ($request->payment_status == null && $date != null) {
                    $orders = Order::where('order_type', 1)->where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])));
                } else {
                    $orders = Order::where('order_type', 1)->where('payment_status', $request->payment_status);
                    $payment_status = $request->payment_status;
                }
            } else if ($request->payment_status == null) {
                if ($request->delivery_status != null && $date != null) {
                    $orders = Order::where('order_type', 1)->where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])))->where('delivery_status', $request->delivery_status);
                    $delivery_status = $request->delivery_status;
                } else if ($request->delivery_status == null && $date != null) {
                    $orders = Order::where('order_type', 1)->where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])));
                } else {
                    $orders = Order::where('order_type', 1)->where('delivery_status', $request->delivery_status);
                    $delivery_status = $request->delivery_status;
                }
            } else if ($request->date == null) {
                if ($request->delivery_status != null && $request->payment_status != null) {
                    $orders = Order::where('order_type', 1)->where('delivery_status', $request->delivery_status)->where('payment_status', $request->payment_status);
                    $delivery_status = $request->delivery_status;
                    $payment_status = $request->payment_status;
                } else if ($request->delivery_status == null && $request->payment_status != null) {
                    $orders = Order::where('order_type', 1)->where('payment_status', $request->payment_status);
                    $payment_status = $request->payment_status;
                } else {
                    $orders = Order::where('order_type', 1)->where('delivery_status', $request->delivery_status);
                    $delivery_status = $request->delivery_status;
                }
            }
        }

        //dd($request);

        $orders = $orders->paginate(15);
        return view('backend.sales.all_orders.index', compact('orders', 'delivery_status', 'date', 'payment_status'));
    }
    public function index2(Request $request)
    {
        $date = $request->date;
        $delivery_status = null;
        $payment_status = null;

        //dd($request);

        //$orders = Order::orderBy('id', 'desc');

        // if ($request->delivery_status != null) {
        //     $orders = $orders->where('delivery_status', $request->delivery_status);
        //     // dd($orders);
        //     $delivery_status = $request->delivery_status;
        // }

        // if ($request->payment_status != null) {
        //     $orders = $orders->where('payment_status', $request->payment_status);
        //     $payment_status = $request->payment_status;
        // }

        // if ($date != null) {
        //     $orders = $orders->where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])));
        // }

        if ($request->delivery_status != null && $request->payment_status != null && $date != null) {

            $orders = Order::where('order_type', 2)
                ->where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))
                ->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])))
                ->where('delivery_status', $request->delivery_status)
                ->where('payment_status', $request->payment_status);

            $delivery_status = $request->delivery_status;
            $payment_status = $request->payment_status;
        } else if ($request->delivery_status == null && $request->payment_status == null && $date == null) {
            $orders = Order::where('order_type', 2)->orderBy('id', 'desc');
        } else {
            if ($request->delivery_status == null) {
                if ($request->payment_status != null && $date != null) {
                    $orders = Order::where('order_type', 2)->where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])))->where('payment_status', $request->payment_status);
                    $payment_status = $request->payment_status;
                } else if ($request->payment_status == null && $date != null) {
                    $orders = Order::where('order_type', 2)->where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])));
                } else {
                    $orders = Order::where('order_type', 2)->where('payment_status', $request->payment_status);
                    $payment_status = $request->payment_status;
                }
            } else if ($request->payment_status == null) {
                if ($request->delivery_status != null && $date != null) {
                    $orders = Order::where('order_type', 2)->where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])))->where('delivery_status', $request->delivery_status);
                    $delivery_status = $request->delivery_status;
                } else if ($request->delivery_status == null && $date != null) {
                    $orders = Order::where('order_type', 2)->where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])));
                } else {
                    $orders = Order::where('order_type', 2)->where('delivery_status', $request->delivery_status);
                    $delivery_status = $request->delivery_status;
                }
            } else if ($request->date == null) {
                if ($request->delivery_status != null && $request->payment_status != null) {
                    $orders = Order::where('order_type', 2)->where('delivery_status', $request->delivery_status)->where('payment_status', $request->payment_status);
                    $delivery_status = $request->delivery_status;
                    $payment_status = $request->payment_status;
                } else if ($request->delivery_status == null && $request->payment_status != null) {
                    $orders = Order::where('order_type', 2)->where('payment_status', $request->payment_status);
                    $payment_status = $request->payment_status;
                } else {
                    $orders = Order::where('order_type', 2)->where('delivery_status', $request->delivery_status);
                    $delivery_status = $request->delivery_status;
                }
            }
        }

        //dd($request);

        $orders = $orders->paginate(15);
        return view('backend.sales.all_orders.index', compact('orders', 'delivery_status', 'date', 'payment_status'));
    }

    public function allOrders(Request $request)
    {
        $date = $request->date;
        $delivery_status = $request->delivery_status;
        $payment_status = $request->payment_status;

        // Start the query with a base condition (order types)
        $orders = Order::whereIn('order_type', [1, 2, 3]);

        // Filter by date range if provided
        if ($date) {
            $startDate = date('Y-m-d', strtotime(explode(" - ", $date)[0]));
            $endDate = date('Y-m-d', strtotime(explode(" - ", $date)[1]));
            $orders->whereBetween('created_at', [$startDate, $endDate]);
        }

        // Filter by delivery status if provided
        if ($delivery_status) {
            $orders->where('delivery_status', $delivery_status);
        }

        // Filter by payment status if provided
        if ($payment_status !== null) { // Explicitly checking for null to allow `0`
            $orders->where('payment_status', $payment_status);
        }

        // Order by the most recent
        $orders = $orders->orderBy('id', 'desc')->paginate(10); // Paginate as needed

        // Pass the results to your view
        return view('backend.sales.all_orders.show_all', compact('orders', 'date', 'delivery_status', 'payment_status'));
    }

    public function installmentOrders(Request $request)
    {
        $date = $request->date;
        $delivery_status = null;
        $payment_status = null;


        if ($request->delivery_status != null && $request->payment_status != null && $date != null) {

            $orders = Order::where('order_type', 3)
                ->where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))
                ->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])))
                ->where('delivery_status', $request->delivery_status)
                ->where('payment_status', $request->payment_status);

            $delivery_status = $request->delivery_status;
            $payment_status = $request->payment_status;
        } else if ($request->delivery_status == null && $request->payment_status == null && $date == null) {
            $orders = Order::where('order_type', 3)->orderBy('id', 'desc');
        } else {
            if ($request->delivery_status == null) {
                if ($request->payment_status != null && $date != null) {
                    $orders = Order::where('order_type', 3)->where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])))->where('payment_status', $request->payment_status);
                    $payment_status = $request->payment_status;
                } else if ($request->payment_status == null && $date != null) {
                    $orders = Order::where('order_type', 3)->where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])));
                } else {
                    $orders = Order::where('order_type', 3)->where('payment_status', $request->payment_status);
                    $payment_status = $request->payment_status;
                }
            } else if ($request->payment_status == null) {
                if ($request->delivery_status != null && $date != null) {
                    $orders = Order::where('order_type', 3)->where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])))->where('delivery_status', $request->delivery_status);
                    $delivery_status = $request->delivery_status;
                } else if ($request->delivery_status == null && $date != null) {
                    $orders = Order::where('order_type', 3)->where('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])));
                } else {
                    $orders = Order::where('order_type', 3)->where('delivery_status', $request->delivery_status);
                    $delivery_status = $request->delivery_status;
                }
            } else if ($request->date == null) {
                if ($request->delivery_status != null && $request->payment_status != null) {
                    $orders = Order::where('order_type', 3)->where('delivery_status', $request->delivery_status)->where('payment_status', $request->payment_status);
                    $delivery_status = $request->delivery_status;
                    $payment_status = $request->payment_status;
                } else if ($request->delivery_status == null && $request->payment_status != null) {
                    $orders = Order::where('order_type', 3)->where('payment_status', $request->payment_status);
                    $payment_status = $request->payment_status;
                } else {
                    $orders = Order::where('order_type', 3)->where('delivery_status', $request->delivery_status);
                    $delivery_status = $request->delivery_status;
                }
            }
        }

        $orders = $orders->paginate(15);
        return view('backend.sales.all_orders.installment', compact('orders', 'delivery_status', 'date', 'payment_status'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //        return AccountLedger::latest()->first();
        $order = Order::findOrFail($id);
        $shippings = Shipping::where('status', 1)->get();
        //  $orderDetails = OrderDetail::where('order_id', $id)->get();
        $orderDetails = OrderDetail::with('product', 'product.serialNumbers')->where('order_id', $id)->get();

        //  dd($order, $orderDetails);
        return view('backend.sales.all_orders.show', compact('order', 'shippings', 'orderDetails'));
    }

    public function installment_show($id)
    {
        $order = Order::findOrFail($id);

        $shippings = Shipping::where('status', 1)->get();
        $orderDetail = OrderDetail::with('product')->where('order_id', $id)->get();
        // dd($order,$orderDetail);
        return view('backend.sales.all_orders.installment_orders_show', compact('order', 'orderDetail', 'shippings'));
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
        // dd($request);
        // return $request;

        $this->validate($request, [
            'payment_method' => 'required',
            'pay_amount' => 'required',

        ]);
        $order = Order::findOrFail($id);

        $order->division_id = $request->division_id;
        $order->district_id = $request->district_id;
        $order->upazilla_id = $request->upazilla_id;
        $order->payment_method = $request->payment_method;
        //        $order->payment_status = $request->status;

        $discount_total = ($order->sub_total - $request->discount);
        $total_ammount = ($discount_total + $request->shipping_charge);

        Order::where('id', $id)->update([

            'shipping_charge'   => $request->shipping_charge,
            'discount'          => $request->discount,
            // 'grand_total'       => $request->grand_total,
            'first_pay_amount'  => $request->pay_amount,
            'paid_amount'       => $request->pay_amount,
            'paid_date'         => now(),
            'payment_status'    => $request->payment_status,


        ]);


        $order->save();

        Session::flash('success', 'Orders Information Updated Successfully');
        return redirect()->back();
    }



    public function installmentupdate(Request $request, $id)
    {
        // Validate the request
        // dd($request);
        $this->validate($request, [
            'installment_value' => 'required|numeric|min:0', // Installment value should be numeric and >= 0
            'installment_type' => 'required|in:first_installment,second_installment,third_installment', // Ensure valid installment type
        ]);


        // Find the order by ID
        $order = Order::findOrFail($id);



        // Check if the order is already paid
        if ($order->grand_total == $order->paid_amount) {
            //return redirect()->back()->withErrors(['error' => 'Order is already paid']);
            Session::flash('error', 'Order is already paid');
            return redirect()->back();
        }

        // Get the installment value and installment type from the request
        $installmentValue = $request->installment_value;
        $installmentType = $request->installment_type;

        // Ensure the installment value doesn't exceed the due amount
        $currentPaidAmount = $order->paid_amount;
        $dueAmount = $order->grand_total - $currentPaidAmount;
        if (empty($installmentValue)) {
            Session::flash('error', 'Installment value cannot be empty');
            return redirect()->back();
        }

        if ($installmentValue > $dueAmount) {
            Session::flash('error', 'Installment value cannot exceed the due amount');
            return redirect()->back();
            //   return redirect()->back()->withErrors(['error' => 'Installment value cannot exceed the due amount']);
        }
        if ((floatval($installmentValue)) < 0) {
            Session::flash('error', 'Installment value cannot be negative');
            return redirect()->back();
        }
        if (
            $installmentType == 'third_installment' &&
            ($currentPaidAmount + $installmentValue) < $order->grand_total
        ) {
            Session::flash('error', 'Due remainig.You have to pay full amount.');
            return redirect()->back();
        }

        // Optionally, check if the value is a valid number
        if (!is_numeric($installmentValue)) {
            Session::flash('error', 'Installment value must be a valid number');
            return redirect()->back();
        }
        // Prepare the data to update
        $updateData = [
            $installmentType => $installmentValue,
            'paid_amount' => $currentPaidAmount + $installmentValue
        ];

        // Update the selected installment based on the type
        switch ($installmentType) {
            case 'first_installment':
                $updateData['first_installment_date'] = now();
                break;
            case 'second_installment':
                $updateData['second_installment_date'] = now();
                break;
            case 'third_installment':
                $updateData['third_installment_date'] = now();
                break;
            default:
                Session::flash('error', 'Invalid installment type');
                return redirect()->back();
                //   return redirect()->back()->withErrors(['error' => 'Invalid installment type']);
        }


        // Update the order with the new installment value and date
        $updated = Order::where('id', $id)->update($updateData);


        // Return success message
        Session::flash('success', 'Installment updated successfully!');
        return redirect()->back();
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        $order->delete();

        $notification = array(
            'message' => 'Order Deleted Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function updateSerialNumber(Request $request)
    {
        $request->validate([
            'order_detail_id' => 'required|exists:order_details,id',
            'serial_number_id' => 'required|exists:product_serial_numbers,id',
        ]);

        try {
            $detail = OrderDetail::findOrFail($request->order_detail_id);

            // optional: free the old serial number
            if ($detail->product_serial_number_id) {
                ProductSerialNumber::where('id', $detail->product_serial_number_id)
                    ->update(['is_sold' => false]); // needs is_sold column
            }

            // assign new one
            $detail->product_serial_number_id = $request->serial_number_id;
            $detail->save();

            // mark new serial as sold
            ProductSerialNumber::where('id', $request->serial_number_id)
                ->update(['is_sold' => true]);

            return response()->json(['success' => 'Serial number updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update serial number.']);
        }
    }


    /*================= Start update_payment_status Methoed ================*/
    public function update_payment_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->payment_status = $request->status;
        $order->save();
        if ($order->user_id != 1) {
            $this->addOrRemovePoints($request->order_id);
        }
        if ($order->payment_status == 0) {
            Order::where('id', $order->id)->update([
                'first_pay_amount' => 0,
                'paid_amount' => 0,
                'paid_date' => null,
            ]);
        }
        if ($order->payment_status == 1 && $order->order_type == 1) {
            Order::where('id', $order->id)->update([
                'paid_amount' => $order->grand_total,
                'paid_date' => now(),

            ]);
        }

        $affiliate_bonus = Vendor::where('user_id', $order->affiliate_user_id)->first();
        if ($affiliate_bonus != Null) {
            if ($order->payment_status == 1) {
                $affiliate_bonus->update([
                    'balance' => $affiliate_bonus->balance + 500,

                ]);
                return response()->json(['success' => 'Payment status has been updated']);
            } elseif ($order->payment_status == 0) {
                $affiliate_bonus->update([
                    'balance' => $affiliate_bonus->balance - 500,
                ]);
                return response()->json(['success' => 'Payment status has been updated']);
            }
        }

        return response()->json(['success' => 'Payment status has been updated']);

        // dd($order);
    }
    public function addOrRemovePoints($id)
    {
        $order = Order::findOrFail($id);
        $user = User::findOrfail($order->user_id);
        if ($user->role == 3) {
            $orderedProducts = OrderDetail::where('order_id', $order->id)->get();
            $point = 0;
            foreach ($orderedProducts as $item) {
                $point += $item->product->points * $item->qty;
            }
            if ($order->payment_status == 1) {
                $user->points += $point;
            } else {
                $user->points -= $point;
            }
            $user->save();
        }
    }

    /*================= Start update_delivery_status Methoed ================*/
    public function update_delivery_status(Request $request)
    {
        //        return $request;
        $order = Order::findOrFail($request->order_id);
        $order->delivery_status = $request->status;
        $order->save();
        if ($order->user_id != 1) {
            $this->addOrRemoveCommission($request->order_id);
        }
        if ($order->delivery_status == 'cancelled') {
            $this->deductAdminBalance($order->id, $order->grand_total);
            $this->addStock($order->id);
        }

        if ($request->request_type && $request->request->type == 1) {
            return redirect()->route('dashboard');
        }

        return response()->json(['success' => 'Delivery status has been updated']);
    }

    public function addOrRemoveCommission($id)
    {

        $orderedProducts = OrderDetail::where('order_id', $id)->get();
        $order = Order::findOrFail($id);

        foreach ($orderedProducts as $item) {
            if ($item->product->vendor_id != 0) {
                $vendor = Vendor::findOrFail($item->product->vendor_id);
                if ($vendor->commission != 0) {
                    if ($vendor->comission_type == 2)
                        $adminCommission = ($item->qty * $item->price) * ($vendor->commission / 100);
                    else {
                        $adminCommission = ($item->qty * $item->price) - $vendor->commission;
                    }
                    $vendorCommission = ($item->qty * $item->price) - $adminCommission;
                    $transaction = VendorTransaction::where('invoice_no', $order->invoice_no)->where('add_amount', '!=', null)->first();
                    if (!$transaction) {
                        if ($order->delivery_status == 'delivered') {
                            $vendor->balance += $vendorCommission;

                            $commission = new VendorComission();
                            $commission->order_id = $id;
                            $commission->vendor_id = $vendor->id;
                            $commission->vendor_amount = $vendorCommission;
                            $commission->admin_commission = $adminCommission;
                            $commission->month = date('m');
                            $commission->year = date('Y');
                            $commission->save();

                            $transaction = new VendorTransaction();
                            $transaction->vendor_id = $vendor->id;
                            $transaction->add_amount = $vendorCommission;
                            $transaction->invoice_no = $order->invoice_no;
                            $transaction->month = date('m');
                            $transaction->year = date('Y');
                            $transaction->status = 1;

                            $transaction->save();
                        }
                    } elseif ($transaction != null) {
                        if ($order->delivery_status == 'cancelled') {
                            $vendor->balance -= $vendorCommission;
                            VendorComission::where('order_id', $id)->delete();

                            $transaction = new VendorTransaction();
                            $transaction->vendor_id = $vendor->id;
                            $transaction->deduct_amount = $vendorCommission;
                            $transaction->invoice_no = $order->invoice_no;
                            $transaction->month = date('m');
                            $transaction->year = date('Y');
                            $transaction->status = 3;
                            $transaction->save();
                        }
                    }

                    $vendor->save();
                }
            }
        }
    }

    public function deductAdminBalance($id, $grandTotal)
    {

        $prev_balance = AccountLedger::orderBy('id', 'desc')->first();


        $account_ledger = new AccountLedger();
        $account_ledger->account_head_id = 22;
        $account_ledger->particulars = 'Order-' . $id . 'Cancellation';
        $account_ledger->type = 1;
        $account_ledger->order_id = $id;
        $account_ledger->debit = $grandTotal;
        $account_ledger->balance = $prev_balance->balance - $grandTotal;

        $account_ledger->save();
    }

    public function addStock($id)
    {
        $orders = OrderDetail::where('order_id', $id)->get();

        foreach ($orders as $product) {

            $item = Product::find($product->product_id);
            if ($item->is_varient) {
                $data = json_decode($product->variation);
                $text = '';
                for ($i = 0; $i < count($data); $i++) {
                    if ($i == 0) {
                        $text = $data[$i]->attribute_value;
                    } else {
                        $text = $text . '-' . $data[$i]->attribute_value;
                    }
                }
                $stock = ProductStock::where('product_id', $product->product_id)->where('varient', $text)->first();
                if ($stock) {
                    $stock->qty = ($stock->qty + $product->qty);
                    $stock->save();
                }
            } else {
                $item->stock_qty += $product->qty;
                $item->save();
            }
        }
    }



    /*================= Start admin_user_update Methoed ================*/
    public function admin_user_update(Request $request, $id)
    {
        $user = Order::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        // dd($user);

        Session::flash('success', 'Customer Information Updated Successfully');
        return redirect()->back();
    }

    /* ============= Start getdivision Method ============== */
    public function getdivision($division_id)
    {
        $division = District::where('division_id', $division_id)->orderBy('district_name_en', 'ASC')->get();

        return json_encode($division);
    }
    /* ============= End getdivision Method ============== */

    /* ============= Start getupazilla Method ============== */
    public function getupazilla($district_id)
    {
        $upazilla = Upazilla::where('district_id', $district_id)->orderBy('name_en', 'ASC')->get();

        return json_encode($upazilla);
    }
    /* ============= End getupazilla Method ============== */

    /* ============= Start invoice_download Method ============== */
    // public function invoice_download($id){
    //     $order = Order::findOrFail($id);

    //     $pdf = PDF::loadView('backend.invoices.invoice',compact('order'))->setPaper('a4')->setOptions([
    //             'tempDir' => public_path(),
    //             'chroot' => public_path(),
    //     ]);
    //     return $pdf->download('invoice.pdf');
    // } // end method

    /* ============= Start invoice_download Method ============== */
    public function invoice_download($id)
    {
        $order = Order::findOrFail($id);
        //dd(app('url')->asset('upload/abc.png'));
        $pdf = PDF::loadView('backend.invoices.invoice', compact('order'))->setPaper('a4');
        return $pdf->download('invoice.pdf');
    } // end method
    /* ============= End invoice_download Method ============== */

    public function cancellationRequest()
    {
        $orders = Order::where('delivery_status', 'cancel_requested')->paginate(25);
        return view('backend.sales.cancellation_request', compact('orders'));
    }

    public function test(Request $request)
    {
        return $request;
    }
}
