<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Processor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;

class ProcessorTypeController extends Controller
{
    public function ProcessorView()
    {
        $processors = Processor::latest()->get();
        return view('backend.processor.processor_view', compact('processors'));
    }

    /*=================== Start Processor Methoed ===================*/
    public function ProcessorAdd()
    {
        return view('backend.processor.processor_add');
    }


    /*=================== Start Processor Methoed ===================*/
    public function ProcessorStore(Request $request)
    {
        $this->validate($request, [
            'name_en' => 'required|unique:processors',
        ]);



        $brand = new Processor();
        $brand->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $brand->name_bn = $request->name_en;
        } else {
            $brand->name_bn = $request->name_bn;
        }


        $brand->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if ($request->status == Null) {
            $request->status = 0;
        }
        $brand->status = $request->status;
        $brand->created_by = Auth::guard('admin')->user()->id;
        $brand->created_at = Carbon::now();

        $brand->save();

        Session::flash('success', 'Processor Inserted Successfully');
        return redirect()->route('processor.all');
    } // end method

    /*=================== Start ProcessorEdit Methoed ===================*/
    public function ProcessorEdit($id)
    {
        $processor = Processor::findOrFail($id);
        return view('backend.processor.processor_edit', compact('processor'));
    }

    /*=================== Start Processor Update Methoed ===================*/
    public function ProcessorUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name_en' => 'required',
        ]);

        $processor = Processor::find($id);


        // processor table update
        $processor->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $processor->name_bn = $request->name_en;
        } else {
            $processor->name_bn = $request->name_bn;
        }


        $processor->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if ($request->status == Null) {
            $request->status = 0;
        }
        $processor->status = $request->status;
        $processor->created_by = Auth::guard('admin')->user()->id;

        $processor->save();

        $notification = array(
            'message' => 'Processor Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('processor.all')->with($notification);
    } // end method

     /*=================== Start Processor Delete Methoed ===================*/
    public function ProcessorDelete($id){
    	$processor = Processor::findOrFail($id);    

    	$processor->delete();

        $notification = array(
            'message' => 'Processor Deleted Successfully.',
            'alert-type' => 'error'
        );
		return redirect()->back()->with($notification);

    } // end method

     /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id){
        $processor = Processor::find($id);
        $processor->status = 1;
        $processor->save();

        Session::flash('success','Processor Active Successfully.');
        return redirect()->back();
    }

    public function inactive($id){
        $processor = Processor::find($id);
        $processor->status = 0;
        $processor->save();

        Session::flash('warning','Processor Inactive Successfully.');
        return redirect()->back();
    }

}
