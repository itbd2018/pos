<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\OperatingSystem;

class OperatingSystemController extends Controller
{
     public function OperatingSystemView()
    {
        $operating_systems = OperatingSystem::latest()->get();
        return view('backend.operating_system.operating_system_view', compact('operating_systems'));
    }

    /*=================== Start OperatingSystems Methoed ===================*/
    public function OperatingSystemAdd()
    {
        return view('backend.operating_system.operating_system_add');
    }


    /*=================== Start OperatingSystems Methoed ===================*/
    public function OperatingSystemStore(Request $request)
    {
        $this->validate($request, [
            'name_en' => 'required|unique:operating_systems',
        ]);

        $operating_system = new OperatingSystem();
        $operating_system->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $operating_system->name_bn = $request->name_en;
        } else {
            $operating_system->name_bn = $request->name_bn;
        }

        $operating_system->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if ($request->status == Null) {
            $request->status = 0;
        }
        $operating_system->status = $request->status;
        $operating_system->created_by = Auth::guard('admin')->user()->id;
        $operating_system->created_at = Carbon::now();

        $operating_system->save();

         $notification = array(
            'message' => 'Operating System Inserted Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('operating.system.all')->with($notification);
    } // end method

    /*=================== Start OperatingSystems Edit Methoed ===================*/
    public function OperatingSystemEdit($id)
    {
        $operating_system = OperatingSystem::findOrFail($id);
        return view('backend.operating_system.operating_system_edit', compact('operating_system'));
    }

    /*=================== Start OperatingSystems Update Methoed ===================*/
    public function OperatingSystemUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name_en' => 'required',
        ]);

        $operating_system = OperatingSystem::find($id);

        // OperatingSystems table update
        $operating_system->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $operating_system->name_bn = $request->name_en;
        } else {
            $operating_system->name_bn = $request->name_bn;
        }

        $operating_system->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if ($request->status == Null) {
            $request->status = 0;
        }
        $operating_system->status = $request->status;
        $operating_system->created_by = Auth::guard('admin')->user()->id;

        $operating_system->save();

        $notification = array(
            'message' => 'Operating System Card Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('operating.system.all')->with($notification);
    } // end method

    /*=================== Start OperatingSystems Delete Methoed ===================*/
    public function OperatingSystemDelete($id)
    {
        $operating_system = OperatingSystem::findOrFail($id);

        $operating_system->delete();

        $notification = array(
            'message' => 'Operating System Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    } // end method

    /*=================== Start Active/Inactive Methoed ===================*/
    public function OperatingSystemActive($id)
    {
        $operating_system = OperatingSystem::find($id);
        $operating_system->status = 1;
        $operating_system->save();

         $notification = array(
            'message' => 'Operating system Active Successfully.',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }

    public function OperatingSystemInactive($id)
    {
        $operating_system = OperatingSystem::find($id);
        $operating_system->status = 0;
        $operating_system->save();

          $notification = array(
            'message' => 'Operating system InActive Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
