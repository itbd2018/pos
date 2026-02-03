<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProcessorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ProcessorModelController extends Controller
{
    public function ProcessorModelView()
    {
        $models = ProcessorModel::latest()->get();
        return view('backend.processor_model.processor_model_view', compact('models'));
    }

    /*=================== Start ProcessorModel Methoed ===================*/
    public function ProcessorModelAdd()
    {
        return view('backend.processor_model.processor_model_add');
    }


    /*=================== Start ProcessorModel Methoed ===================*/
    public function ProcessorModelStore(Request $request)
    {
        $this->validate($request, [
            'name_en' => 'required|unique:processor_models',
        ]);

        $model = new ProcessorModel();
        $model->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $model->name_bn = $request->name_en;
        } else {
            $model->name_bn = $request->name_bn;
        }

        $model->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if ($request->status == Null) {
            $request->status = 0;
        }
        $model->status = $request->status;
        $model->created_by = Auth::guard('admin')->user()->id;
        $model->created_at = Carbon::now();

        $model->save();

         $notification = array(
            'message' => 'Processor Model Inserted Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('processor.model.all')->with($notification);
    } // end method

    /*=================== Start ProcessorModel Edit Methoed ===================*/
    public function ProcessorModelEdit($id)
    {
        $model = ProcessorModel::findOrFail($id);
        return view('backend.processor_model.processor_model_edit', compact('model'));
    }

    /*=================== Start Processor Model Update Methoed ===================*/
    public function ProcessorModelUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name_en' => 'required',
        ]);

        $model = ProcessorModel::find($id);

        // processor table update
        $model->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $model->name_bn = $request->name_en;
        } else {
            $model->name_bn = $request->name_bn;
        }

        $model->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if ($request->status == Null) {
            $request->status = 0;
        }
        $model->status = $request->status;
        $model->created_by = Auth::guard('admin')->user()->id;

        $model->save();

        $notification = array(
            'message' => 'Processor Model Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('processor.model.all')->with($notification);
    } // end method

    /*=================== Start Processor Model Delete Methoed ===================*/
    public function ProcessorModelDelete($id)
    {
        $processor = ProcessorModel::findOrFail($id);

        $processor->delete();

        $notification = array(
            'message' => 'Processor Model Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    } // end method

    /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id)
    {
        $processor = ProcessorModel::find($id);
        $processor->status = 1;
        $processor->save();

         $notification = array(
            'message' => 'Processor Model Active Successfully.',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }

    public function inactive($id)
    {
        $processor = ProcessorModel::find($id);
        $processor->status = 0;
        $processor->save();

          $notification = array(
            'message' => 'Processor Model InActive Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
