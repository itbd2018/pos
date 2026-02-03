<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\DisplayType;

class DisplayTypeController extends Controller
{
     public function DisplayTypeView()
    {
        $display_types = DisplayType::latest()->get();
        return view('backend.display_type.display_type_view', compact('display_types'));
    }

    /*=================== Start DisplayType Methoed ===================*/
    public function DisplayTypeAdd()
    {
        return view('backend.display_type.display_type_add');
    }


    /*=================== Start DisplayType Methoed ===================*/
    public function DisplayTypeStore(Request $request)
    {
        $this->validate($request, [
            'name_en' => 'required|unique:display_types',
        ]);

        $display_type = new DisplayType();
        $display_type->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $display_type->name_bn = $request->name_en;
        } else {
            $display_type->name_bn = $request->name_bn;
        }

        $display_type->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if ($request->status == Null) {
            $request->status = 0;
        }
        $display_type->status = $request->status;
        $display_type->created_by = Auth::guard('admin')->user()->id;
        $display_type->created_at = Carbon::now();

        $display_type->save();

         $notification = array(
            'message' => 'DisplayType Inserted Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('display.type.all')->with($notification);
    } // end method

    /*=================== Start DisplayType Edit Methoed ===================*/
    public function DisplayTypeEdit($id)
    {
        $type = DisplayType::findOrFail($id);
        return view('backend.display_type.display_type_edit', compact('type'));
    }

    /*=================== Start DisplayType Update Methoed ===================*/
    public function DisplayTypeUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name_en' => 'required',
        ]);

        $display_type = DisplayType::find($id);

        // DisplayType table update
        $display_type->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $display_type->name_bn = $request->name_en;
        } else {
            $display_type->name_bn = $request->name_bn;
        }

        $display_type->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if ($request->status == Null) {
            $request->status = 0;
        }
        $display_type->status = $request->status;
        $display_type->created_by = Auth::guard('admin')->user()->id;

        $display_type->save();

        $notification = array(
            'message' => 'Display Type Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('display.type.all')->with($notification);
    } // end method

    /*=================== Start DisplayType Delete Methoed ===================*/
    public function DisplayTypeDelete($id)
    {
        $display_type = DisplayType::findOrFail($id);

        $display_type->delete();

        $notification = array(
            'message' => 'Display Type Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    } // end method

    /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id)
    {
        $display_type = DisplayType::find($id);
        $display_type->status = 1;
        $display_type->save();

         $notification = array(
            'message' => 'Display Type Active Successfully.',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }

    public function inactive($id)
    {
        $display_type = DisplayType::find($id);
        $display_type->status = 0;
        $display_type->save();

          $notification = array(
            'message' => 'Display Type InActive Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
