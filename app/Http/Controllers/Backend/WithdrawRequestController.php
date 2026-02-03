<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\Vendor;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class WithdrawRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('admin')->user()->role == 1){
            $withdrawRequests = WithdrawRequest::orderBy('status', 'asc')->latest()->get();
        }
        elseif(Auth::guard('admin')->user()->role == 2){
            $vendor = Vendor::where('user_id', Auth::guard('admin')->user()->id)->first();
            $withdrawRequests = WithdrawRequest::where('vendor_id', $vendor->id)->where('status', 0)->latest()->get();
        }

//        return $withdrawRequests;
        return view('backend.withdraw-request.index', compact('withdrawRequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paymentMethods = PaymentMethod::all();
        return view('backend.withdraw-request.create', compact('paymentMethods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //    return $request;
        $request->validate([
            'payment_method' => ['required'],
            'amount'         => ['required'],
            'phone'          => [
                'required',
                'regex:/^(?:\+?88)?01[3-9]\d{8}$/', // Bangladeshi phone number pattern
                'min:11',
                'max:15'
            ],
        ]);

        $vendor = Vendor::where('user_id', Auth::guard('admin')->user()->id)->first();
        if($request->amount > $vendor->balance){
            return back()->with('message',' Insufficient Balance!!');
        }
        $withdrawRequest = new WithdrawRequest();

        $withdrawRequest->vendor_id         = $vendor->id;
        $withdrawRequest->amount            = $request->amount;
        $withdrawRequest->phone            = $request->phone;
        $withdrawRequest->date              = $request->date;
        $withdrawRequest->month             = date('m');
        $withdrawRequest->year              = date('Y');
        $withdrawRequest->payment_method    = $request->payment_method;
        $withdrawRequest->save();
        Session::flash('success', 'Request has been sent successfully.');
        return redirect()->route('withdraw-requests.index');
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
        $item = WithdrawRequest::findOrFail($id);
        $paymentMethods = PaymentMethod::all();
        return view('backend.withdraw-request.create', compact('paymentMethods', 'item'));
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
        $request->validate([
            'payment_method' => ['required'],
            'amount'         => ['required']
        ]);
        $vendor = Vendor::where('user_id', Auth::guard('admin')->user()->id)->first();
        if($request->amount > $vendor->balance){
            return back()->with('message',' Insufficient Balance!!');
        }
        $withdrawRequest = WithdrawRequest::findOrFail($id);

        $withdrawRequest->vendor_id         = $vendor->id;
        $withdrawRequest->amount            = $request->amount;
        $withdrawRequest->phone             = $request->phone;
        $withdrawRequest->date              = $request->date;
        $withdrawRequest->payment_method    = $request->payment_method;
        $withdrawRequest->save();
        Session::flash('success', 'Request has been updated successfully.');
        return redirect()->route('withdraw-requests.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function delete($id)
    {
//        return $request;
        $withdrawRequest = WithdrawRequest::findOrFail($id);
        $withdrawRequest->delete();

        Session::flash('success', 'Request has been deleted successfully.');
        return back();
    }
}
