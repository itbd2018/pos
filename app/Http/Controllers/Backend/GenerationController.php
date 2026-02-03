<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Generation;

class GenerationController extends Controller
{
    public function GenerationView()
    {
        $generations = Generation::latest()->get();
        return view('backend.generation.generation_view', compact('generations'));
    }

    /*=================== Start Generation Methoed ===================*/
    public function GenerationAdd()
    {
        return view('backend.generation.generation_add');
    }


    /*=================== Start Generation Methoed ===================*/
    public function GenerationStore(Request $request)
    {
        $this->validate($request, [
            'name_en' => 'required|unique:generations',
        ]);

        $generation = new Generation();
        $generation->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $generation->name_bn = $request->name_en;
        } else {
            $generation->name_bn = $request->name_bn;
        }

        $generation->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if ($request->status == Null) {
            $request->status = 0;
        }
        $generation->status = $request->status;
        $generation->created_by = Auth::guard('admin')->user()->id;
        $generation->created_at = Carbon::now();

        $generation->save();

         $notification = array(
            'message' => 'Generation Inserted Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('generation.all')->with($notification);
    } // end method

    /*=================== Start Generation Edit Methoed ===================*/
    public function GenerationEdit($id)
    {
        $generation = Generation::findOrFail($id);
        return view('backend.generation.generation_edit', compact('generation'));
    }

    /*=================== Start Generation Update Methoed ===================*/
    public function GenerationUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name_en' => 'required',
        ]);

        $generation = Generation::find($id);

        // generation table update
        $generation->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $generation->name_bn = $request->name_en;
        } else {
            $generation->name_bn = $request->name_bn;
        }

        $generation->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if ($request->status == Null) {
            $request->status = 0;
        }
        $generation->status = $request->status;
        $generation->created_by = Auth::guard('admin')->user()->id;

        $generation->save();

        $notification = array(
            'message' => 'Generation Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('generation.all')->with($notification);
    } // end method

    /*=================== Start Generation Delete Methoed ===================*/
    public function GenerationDelete($id)
    {
        $generation = Generation::findOrFail($id);

        $generation->delete();

        $notification = array(
            'message' => 'Generation Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    } // end method

    /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id)
    {
        $generation = Generation::find($id);
        $generation->status = 1;
        $generation->save();

         $notification = array(
            'message' => 'Generation Active Successfully.',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }

    public function inactive($id)
    {
        $generation = Generation::find($id);
        $generation->status = 0;
        $generation->save();

          $notification = array(
            'message' => 'Generation InActive Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
