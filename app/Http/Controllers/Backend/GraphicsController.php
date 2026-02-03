<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Graphic;

class graphicsController extends Controller
{
     public function GraphicsView()
    {
        $graphics = Graphic::latest()->get();
        return view('backend.graphics.graphics_view', compact('graphics'));
    }

    /*=================== Start graphics Methoed ===================*/
    public function graphicsAdd()
    {
        return view('backend.graphics.graphics_add');
    }


    /*=================== Start graphics Methoed ===================*/
    public function GraphicsStore(Request $request)
    {
        $this->validate($request, [
            'name_en' => 'required|unique:graphics',
        ]);

        $graphics = new Graphic();
        $graphics->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $graphics->name_bn = $request->name_en;
        } else {
            $graphics->name_bn = $request->name_bn;
        }

        $graphics->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if ($request->status == Null) {
            $request->status = 0;
        }
        $graphics->status = $request->status;
        $graphics->created_by = Auth::guard('admin')->user()->id;
        $graphics->created_at = Carbon::now();

        $graphics->save();

         $notification = array(
            'message' => 'Graphics Card Inserted Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('graphics.all')->with($notification);
    } // end method

    /*=================== Start graphics Edit Methoed ===================*/
    public function graphicsEdit($id)
    {
        $graphic = Graphic::findOrFail($id);
        return view('backend.graphics.graphics_edit', compact('graphic'));
    }

    /*=================== Start graphics Update Methoed ===================*/
    public function GraphicsUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name_en' => 'required',
        ]);

        $graphics = Graphic::find($id);

        // graphics table update
        $graphics->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $graphics->name_bn = $request->name_en;
        } else {
            $graphics->name_bn = $request->name_bn;
        }

        $graphics->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if ($request->status == Null) {
            $request->status = 0;
        }
        $graphics->status = $request->status;
        $graphics->created_by = Auth::guard('admin')->user()->id;

        $graphics->save();

        $notification = array(
            'message' => 'Graphics Card Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('graphics.all')->with($notification);
    } // end method

    /*=================== Start graphics Delete Methoed ===================*/
    public function GraphicsDelete($id)
    {
        $graphics = Graphic::findOrFail($id);

        $graphics->delete();

        $notification = array(
            'message' => 'Graphics Card Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    } // end method

    /*=================== Start Active/Inactive Methoed ===================*/
    public function GraphicsActive($id)
    {
        $graphics = Graphic::find($id);
        $graphics->status = 1;
        $graphics->save();

         $notification = array(
            'message' => 'Graphics Card Active Successfully.',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }

    public function GraphicsInactive($id)
    {
        $graphics = Graphic::find($id);
        $graphics->status = 0;
        $graphics->save();

          $notification = array(
            'message' => 'Graphics Card InActive Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
