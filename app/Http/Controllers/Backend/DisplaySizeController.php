<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\DisplaySize;

class DisplaySizeController extends Controller
{
     public function DisplaySizeView()
    {
        $display_sizes = DisplaySize::latest()->get();
        return view('backend.display_size.display_size_view', compact('display_sizes'));
    }

    /*=================== Start DisplaySize Methoed ===================*/
    public function DisplaySizeAdd()
    {
        return view('backend.display_size.display_size_add');
    }


    /*=================== Start DisplaySize Methoed ===================*/
    public function DisplaySizeStore(Request $request)
    {
        $this->validate($request, [
            'name_en' => 'required|unique:display_sizes',
        ]);

        $display_size = new DisplaySize();
        $display_size->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $display_size->name_bn = $request->name_en;
        } else {
            $display_size->name_bn = $request->name_bn;
        }

        $display_size->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if ($request->status == Null) {
            $request->status = 0;
        }
        $display_size->status = $request->status;
        $display_size->created_by = Auth::guard('admin')->user()->id;
        $display_size->created_at = Carbon::now();

        $display_size->save();

         $notification = array(
            'message' => 'DisplaySize Inserted Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('display.size.all')->with($notification);
    } // end method

    /*=================== Start DisplaySize Edit Methoed ===================*/
    public function DisplaySizeEdit($id)
    {
        $display = DisplaySize::findOrFail($id);
        return view('backend.display_size.display_size_edit', compact('display'));
    }

    /*=================== Start DisplaySize Update Methoed ===================*/
    public function DisplaySizeUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name_en' => 'required',
        ]);

        $display_size = DisplaySize::find($id);

        // DisplaySize table update
        $display_size->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $display_size->name_bn = $request->name_en;
        } else {
            $display_size->name_bn = $request->name_bn;
        }

        $display_size->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if ($request->status == Null) {
            $request->status = 0;
        }
        $display_size->status = $request->status;
        $display_size->created_by = Auth::guard('admin')->user()->id;

        $display_size->save();

        $notification = array(
            'message' => 'DisplaySize Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('display.size.all')->with($notification);
    } // end method

    /*=================== Start DisplaySize Delete Methoed ===================*/
    public function DisplaySizeDelete($id)
    {
        $display_size = DisplaySize::findOrFail($id);

        $display_size->delete();

        $notification = array(
            'message' => 'DisplaySize Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    } // end method

    /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id)
    {
        $display_size = DisplaySize::find($id);
        $display_size->status = 1;
        $display_size->save();

         $notification = array(
            'message' => 'DisplaySize Active Successfully.',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }

    public function inactive($id)
    {
        $display_size = DisplaySize::find($id);
        $display_size->status = 0;
        $display_size->save();

          $notification = array(
            'message' => 'DisplaySize InActive Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
