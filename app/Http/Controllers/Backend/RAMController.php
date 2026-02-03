<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\RamSize;
use App\Models\RamType;

class RAMController extends Controller
{
     public function RamSizeView()
    {
        $ram_sizes = RamSize::latest()->get();
        return view('backend.ram.ram_size_view', compact('ram_sizes'));
    }

    /*=================== Start RamSize Methoed ===================*/
    public function RamSizeAdd()
    {
        return view('backend.ram.ram_size_add');
    }


    /*=================== Start RamSize Methoed ===================*/
    public function RamSizeStore(Request $request)
    {
        $this->validate($request, [
            'name_en' => 'required|unique:ram_sizes',
        ]);

        $ram_size = new RamSize();
        $ram_size->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $ram_size->name_bn = $request->name_en;
        } else {
            $ram_size->name_bn = $request->name_bn;
        }

        $ram_size->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if ($request->status == Null) {
            $request->status = 0;
        }
        $ram_size->status = $request->status;
        $ram_size->created_by = Auth::guard('admin')->user()->id;
        $ram_size->created_at = Carbon::now();

        $ram_size->save();

         $notification = array(
            'message' => 'RamSize Inserted Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('ram.size.all')->with($notification);
    } // end method

    /*=================== Start RamSize Edit Methoed ===================*/
    public function RamSizeEdit($id)
    {
        $ram_size = RamSize::findOrFail($id);
        return view('backend.ram.ram_size_edit', compact('ram_size'));
    }

    /*=================== Start RamSize Update Methoed ===================*/
    public function RamSizeUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name_en' => 'required',
        ]);

        $ram_size = RamSize::find($id);

        // RamSize table update
        $ram_size->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $ram_size->name_bn = $request->name_en;
        } else {
            $ram_size->name_bn = $request->name_bn;
        }

        $ram_size->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if ($request->status == Null) {
            $request->status = 0;
        }
        $ram_size->status = $request->status;
        $ram_size->created_by = Auth::guard('admin')->user()->id;

        $ram_size->save();

        $notification = array(
            'message' => 'RamSize Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('ram.size.all')->with($notification);
    } // end method

    /*=================== Start RamSize Delete Methoed ===================*/
    public function RamSizeDelete($id)
    {
        $ram_size = RamSize::findOrFail($id);

        $ram_size->delete();

        $notification = array(
            'message' => 'RamSize Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    } // end method

    /*=================== Start Active/Inactive Methoed ===================*/
    public function RamSizeActive($id)
    {
        $ram_size = RamSize::find($id);
        $ram_size->status = 1;
        $ram_size->save();

         $notification = array(
            'message' => 'RamSize Active Successfully.',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }

    public function RamSizeInactive($id)
    {
        $ram_size = RamSize::find($id);
        $ram_size->status = 0;
        $ram_size->save();

          $notification = array(
            'message' => 'RamSize InActive Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    // ============================Ram Type Start=======================//

     public function RamTypeView()
    {
        $ram_types = RamType::latest()->get();
        return view('backend.ram.ram_type_view', compact('ram_types'));
    }

    /*=================== Start RamType Methoed ===================*/
    public function RamTypeAdd()
    {
        return view('backend.ram.ram_type_add');
    }


    /*=================== Start RamType Methoed ===================*/
    public function RamTypeStore(Request $request)
    {
        $this->validate($request, [
            'name_en' => 'required|unique:ram_types',
        ]);

        $ram = new RamType();
        $ram->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $ram->name_bn = $request->name_en;
        } else {
            $ram->name_bn = $request->name_bn;
        }

        $ram->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if ($request->status == Null) {
            $request->status = 0;
        }
        $ram->status = $request->status;
        $ram->created_by = Auth::guard('admin')->user()->id;
        $ram->created_at = Carbon::now();

        $ram->save();

         $notification = array(
            'message' => 'RamType Inserted Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('ram.type.all')->with($notification);
    } // end method

    /*=================== Start RamType Edit Methoed ===================*/
    public function RamTypeEdit($id)
    {
        $ram_type = RamType::findOrFail($id);
        return view('backend.ram.ram_type_edit', compact('ram_type'));
    }

    /*=================== Start RamType Update Methoed ===================*/
    public function RamTypeUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name_en' => 'required',
        ]);

        $ram = RamType::find($id);

        // RamType table update
        $ram->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $ram->name_bn = $request->name_en;
        } else {
            $ram->name_bn = $request->name_bn;
        }

        $ram->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if ($request->status == Null) {
            $request->status = 0;
        }
        $ram->status = $request->status;
        $ram->created_by = Auth::guard('admin')->user()->id;

        $ram->save();

        $notification = array(
            'message' => 'RamType Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('ram.type.all')->with($notification);
    } // end method

    /*=================== Start RamType Delete Methoed ===================*/
    public function RamTypeDelete($id)
    {
        $ram = RamType::findOrFail($id);

        $ram->delete();

        $notification = array(
            'message' => 'RamType Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    } // end method

    /*=================== Start Active/Inactive Methoed ===================*/
    public function RamTypeActive($id)
    {
        $ram = RamType::find($id);
        $ram->status = 1;
        $ram->save();

         $notification = array(
            'message' => 'RamType Active Successfully.',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }

    public function RamTypeInactive($id)
    {
        $ram = RamType::find($id);
        $ram->status = 0;
        $ram->save();

          $notification = array(
            'message' => 'RamType InActive Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
