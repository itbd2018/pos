<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\Vendor;
use App\Models\VendorPayment;
use App\Models\VendorTransaction;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class VendorPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dd('ok');
        $payments = VendorPayment::latest()->get();
        return view('backend.vendor-payment.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $vendors = Vendor::all();
        $paymentMethods = PaymentMethod::all();
        return view('backend.vendor-payment.create', compact('vendors', 'paymentMethods'));
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
//        return Auth::guard('admin')->user()->role;
        $this->validate($request,[
            'vendor_id'         => ['required'],
            'amount'            => ['required'],
            'payment_method'    => ['required'],
            'phone'            => ['required']
        ]);

        $payment = new VendorPayment();

        $payment->vendor_id                 = $request->vendor_id;
        $payment->amount                    = $request->amount;
        $payment->payment_date              = date('Y-m-d');
        $payment->month                     = date('m');
        $payment->year                      = date('Y');
        $payment->description               = $request->description;
        $payment->phone                     = $request->phone;
        $payment->payment_method            = $request->payment_method;
        $payment->withdrawal_request_id     = $request->withdrawal_request_id;

        $payment->save();

        $vendor = Vendor::findOrFail($request->vendor_id);
        $vendor->balance -= $request->amount;
        $vendor->save();

        $vendorRequest = WithdrawRequest::find($request->withdrawal_request_id);
        if($vendorRequest != null){
            $vendorRequest->status = 1;
            $vendorRequest->save();
        }


        $transaction = new VendorTransaction();
        $transaction->vendor_id             = $request->vendor_id;
        $transaction->withdraw_amount       = $request->amount;
        $transaction->withdraw_request_id   = $request->withdrawal_request_id;
        $transaction->month                 = date('m');
        $transaction->year                  = date('Y');
        $transaction->status                = 2;
        $transaction->save();

        Session::flash('success', 'Payment has been added successfully.');
        return redirect()->route('payment.index');
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
    {   $paymentMethods = PaymentMethod::all();
        $item = VendorPayment::findOrFail($id);
        $vendors = Vendor::all();
        return view('backend.vendor-payment.edit', compact('item', 'vendors', 'paymentMethods'));
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
//        return $request;
        $this->validate($request,[
            'vendor_id'         => ['required'],
            'amount'            => ['required'],
            'payment_method'    => ['required']
        ]);
        $payment = VendorPayment::findOrFail($id);
        $payment_month = $payment->month;
        $payment_year  = $payment->year;
        $payment->vendor_id                 = $request->vendor_id;
        $payment->amount                    = $request->amount;
        $payment->payment_date              = $request->payment_date;
        $payment->payment_method            = $request->payment_method;
        $payment->month                     = $payment_month;
        $payment->year                      = $payment_year;
        $payment->description               = $request->description;
        $payment->withdrawal_request_id     = $request->withdrawal_request_id;

        $payment->save();

        Session::flash('success', 'Payment information has been updated successfully.');
        return redirect()->route('payment.index');
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
    public function addPaymentForRequest($id)
    {
        $item = WithdrawRequest::findOrFail($id);
        $paymentMethods = PaymentMethod::all();
        $vendors = Vendor::all();
        return view('backend.vendor-payment.create', compact('item', 'vendors', 'paymentMethods'));
    }
}
