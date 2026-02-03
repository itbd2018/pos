<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\SpecialFeature;

class SpecialFeatureController extends Controller
{
     public function SpecialFeatureView()
    {
        $special_features = SpecialFeature::latest()->get();
        return view('backend.special_feature.special_feature_view', compact('special_features'));
    }

    /*=================== Start SpecialFeatures Methoed ===================*/
    public function SpecialFeatureAdd()
    {
        return view('backend.special_feature.special_feature_add');
    }


    /*=================== Start SpecialFeatures Methoed ===================*/
    public function SpecialFeatureStore(Request $request)
    {
        $this->validate($request, [
            'name_en' => 'required|unique:special_features',
        ]);

        $sepcial_feature = new SpecialFeature();
        $sepcial_feature->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $sepcial_feature->name_bn = $request->name_en;
        } else {
            $sepcial_feature->name_bn = $request->name_bn;
        }

        $sepcial_feature->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if ($request->status == Null) {
            $request->status = 0;
        }
        $sepcial_feature->status = $request->status;
        $sepcial_feature->created_by = Auth::guard('admin')->user()->id;
        $sepcial_feature->created_at = Carbon::now();

        $sepcial_feature->save();

         $notification = array(
            'message' => 'Special Feature Inserted Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('special.feature.all')->with($notification);
    } // end method

    /*=================== Start SpecialFeatures Edit Methoed ===================*/
    public function SpecialFeatureEdit($id)
    {
        $special_feature = SpecialFeature::findOrFail($id);
        return view('backend.special_feature.special_feature_edit', compact('special_feature'));
    }

    /*=================== Start SpecialFeatures Update Methoed ===================*/
    public function SpecialFeatureUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name_en' => 'required',
        ]);

        $sepcial_feature = SpecialFeature::find($id);

        // SpecialFeatures table update
        $sepcial_feature->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $sepcial_feature->name_bn = $request->name_en;
        } else {
            $sepcial_feature->name_bn = $request->name_bn;
        }

        $sepcial_feature->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if ($request->status == Null) {
            $request->status = 0;
        }
        $sepcial_feature->status = $request->status;
        $sepcial_feature->created_by = Auth::guard('admin')->user()->id;

        $sepcial_feature->save();

        $notification = array(
            'message' => 'Special Feature Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('special.feature.all')->with($notification);
    } // end method

    /*=================== Start SpecialFeatures Delete Methoed ===================*/
    public function SpecialFeatureDelete($id)
    {
        $sepcial_feature = SpecialFeature::findOrFail($id);

        $sepcial_feature->delete();

        $notification = array(
            'message' => 'Special Feature Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    } // end method

    /*=================== Start Active/Inactive Methoed ===================*/
    public function SpecialFeatureActive($id)
    {
        $sepcial_feature = SpecialFeature::find($id);
        $sepcial_feature->status = 1;
        $sepcial_feature->save();

         $notification = array(
            'message' => 'Special Feature Active Successfully.',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }

    public function SpecialFeatureInactive($id)
    {
        $sepcial_feature = SpecialFeature::find($id);
        $sepcial_feature->status = 0;
        $sepcial_feature->save();

          $notification = array(
            'message' => 'Special Feature InActive Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
