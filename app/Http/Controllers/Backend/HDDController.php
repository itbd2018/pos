<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\HDD;

class HDDController extends Controller
{
    public function HDDView()
    {
        $hdds = HDD::latest()->get();
        return view('backend.hdd_ssd.hdd_view', compact('hdds'));
    }

    /*=================== Start HDD Methoed ===================*/
    public function HDDAdd()
    {
        return view('backend.hdd_ssd.hdd_add');
    }


    /*=================== Start HDD Methoed ===================*/
    public function HDDStore(Request $request)
    {
        $this->validate($request, [
            'name_en' => 'required|unique:h_d_d_s',
        ]);

        $hdd = new HDD();
        $hdd->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $hdd->name_bn = $request->name_en;
        } else {
            $hdd->name_bn = $request->name_bn;
        }

        $hdd->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if ($request->status == Null) {
            $request->status = 0;
        }
        $hdd->status = $request->status;
        $hdd->created_by = Auth::guard('admin')->user()->id;
        $hdd->created_at = Carbon::now();

        $hdd->save();

         $notification = array(
            'message' => 'HDD Inserted Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('hdd.all')->with($notification);
    } // end method

    /*=================== Start HDD Edit Methoed ===================*/
    public function HDDEdit($id)
    {
        $hdd = HDD::findOrFail($id);
        return view('backend.hdd_ssd.hdd_edit', compact('hdd'));
    }

    /*=================== Start HDD Update Methoed ===================*/
    public function HDDUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name_en' => 'required',
        ]);

        $hdd = HDD::find($id);

        // HDD table update
        $hdd->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $hdd->name_bn = $request->name_en;
        } else {
            $hdd->name_bn = $request->name_bn;
        }

        $hdd->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if ($request->status == Null) {
            $request->status = 0;
        }
        $hdd->status = $request->status;
        $hdd->created_by = Auth::guard('admin')->user()->id;

        $hdd->save();

        $notification = array(
            'message' => 'HDD Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('hdd.all')->with($notification);
    } // end method

    /*=================== Start HDD Delete Methoed ===================*/
    public function HDDDelete($id)
    {
        $hdd = HDD::findOrFail($id);

        $hdd->delete();

        $notification = array(
            'message' => 'HDD Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    } // end method

    /*=================== Start Active/Inactive Methoed ===================*/
    public function HDDActive($id)
    {
        $hdd = HDD::find($id);
        $hdd->status = 1;
        $hdd->save();

         $notification = array(
            'message' => 'HDD Active Successfully.',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }

    public function HDDInactive($id)
    {
        $hdd = HDD::find($id);
        $hdd->status = 0;
        $hdd->save();

          $notification = array(
            'message' => 'HDD InActive Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
