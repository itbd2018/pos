<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\SSD;

class SSDController extends Controller
{
    public function SSDView()
    {
        $ssds = SSD::latest()->get();
        return view('backend.hdd_ssd.ssd_view', compact('ssds'));
    }

    /*=================== Start SSD Methoed ===================*/
    public function SSDAdd()
    {
        return view('backend.hdd_ssd.ssd_add');
    }


    /*=================== Start SSD Methoed ===================*/
    public function SSDStore(Request $request)
    {
        $this->validate($request, [
            'name_en' => 'required|unique:s_s_d_s',
        ]);

        $ssd = new SSD();
        $ssd->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $ssd->name_bn = $request->name_en;
        } else {
            $ssd->name_bn = $request->name_bn;
        }

        $ssd->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if ($request->status == Null) {
            $request->status = 0;
        }
        $ssd->status = $request->status;
        $ssd->created_by = Auth::guard('admin')->user()->id;
        $ssd->created_at = Carbon::now();

        $ssd->save();

         $notification = array(
            'message' => 'SSD Inserted Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('ssd.all')->with($notification);
    } // end method

    /*=================== Start SSD Edit Methoed ===================*/
    public function SSDEdit($id)
    {
        $ssd = SSD::findOrFail($id);
        return view('backend.hdd_ssd.ssd_edit', compact('ssd'));
    }

    /*=================== Start SSD Update Methoed ===================*/
    public function SSDUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name_en' => 'required',
        ]);

        $ssd = SSD::find($id);

        // SSD table update
        $ssd->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $ssd->name_bn = $request->name_en;
        } else {
            $ssd->name_bn = $request->name_bn;
        }

        $ssd->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if ($request->status == Null) {
            $request->status = 0;
        }
        $ssd->status = $request->status;
        $ssd->created_by = Auth::guard('admin')->user()->id;

        $ssd->save();

        $notification = array(
            'message' => 'SSD Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('ssd.all')->with($notification);
    } // end method

    /*=================== Start SSD Delete Methoed ===================*/
    public function SSDDelete($id)
    {
        $ssd = SSD::findOrFail($id);

        $ssd->delete();

        $notification = array(
            'message' => 'SSD Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    } // end method

    /*=================== Start Active/Inactive Methoed ===================*/
    public function SSDActive($id)
    {
        $ssd = SSD::find($id);
        $ssd->status = 1;
        $ssd->save();

         $notification = array(
            'message' => 'SSD Active Successfully.',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }

    public function SSDInactive($id)
    {
        $ssd = SSD::find($id);
        $ssd->status = 0;
        $ssd->save();

          $notification = array(
            'message' => 'SSD InActive Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
