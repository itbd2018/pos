<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\User;
use Image;
use Session;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DB;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::where('is_request', 0)->latest()->get();
        return view('backend.vendor.index', compact('vendors'));
    }

    public function vendorrequest()
    {
        // return 'ok';
        $vendors = Vendor::where('is_request', 1)->latest()->get();
        return view('backend.vendor.request', compact('vendors'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'shop_owner_name'   => 'required',
            'phone'             => ['required', 'regex:/(\+){0,1}(88){0,1}01(3|4|5|6|7|8|9)(\d){8}/', 'min:11', 'max:15'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address'           => 'required',
            'shop_profile'      => 'required',
            'nid'               => 'required',
            'password'          => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if ($request->hasfile('shop_profile')) {
            $image = $request->file('shop_profile');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/vendor/' . $name_gen);
            $shop_profile = 'upload/vendor/' . $name_gen;
        } else {
            $shop_profile = '';
        }

        if ($request->hasfile('shop_cover')) {
            $image = $request->file('shop_cover');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/vendor/' . $name_gen);
            $shop_cover = 'upload/vendor/' . $name_gen;
        } else {
            $shop_cover = '';
        }

        if ($request->hasfile('nid')) {
            $image = $request->file('nid');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/vendor/' . $name_gen);
            $nid = 'upload/vendor/' . $name_gen;
        } else {
            $nid = '';
        }

        if ($request->hasfile('trade_license')) {
            $image = $request->file('trade_license');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/vendor/' . $name_gen);
            $trade_license = 'upload/vendor/' . $name_gen;
        } else {
            $trade_license = '';
        }

        if ($request->slug != null) {
            $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        } else {
            $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->shop_name)) . '-' . Str::random(5);
        }

        $role = 2;
        $user = Auth::guard('admin')->user()->id;
        if ($user == null) {
            $user = 0;
        }
        $user = User::create([
            'name' => $request->shop_owner_name,
            'username' => $slug,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'profile_image' => $shop_profile,
            'password' => Hash::make($request->password),
            'status' => $request->status ? 1 : 0,
            'created_by' => Auth::guard('admin')->user()->id,
            'role' => $role,
        ]);

        $user->role = 2;
        $user->save();

        $vendor =  Vendor::insert([
            'shop_owner_name' => $request->shop_owner_name,
            'shop_name' => $request->shop_name,
            'slug' => $slug,
            'user_id' => $user->id,
            'address' => $request->address,
            'commission' => $request->commission,
            'comission_type' => $request->comission_type,
            'description' => $request->description,
            'shop_profile' => $shop_profile,
            'shop_cover' => $shop_cover,
            'nid' => $nid,
            'trade_license' => $trade_license,
            'status' => $request->status ? 1 : 0,
            'created_by' => Auth::guard('admin')->user()->id,
        ]);

        $coupon = Coupon::where('user_id', $user->id)->first();
        if ($coupon == null) {
            Coupon::create([
                'coupon_code' => 'laptop' . rand(0000, 9999),
                'discount' => 500,
                'applies_to' => 'Laptop-SybrC',
                'discount_type' => '1',
                'total_use_limit' => '100000',
                'expire_date' => Carbon::now()->addYears(2),
                'type' => '1',
                'user_id' => $user->id,
                'description' => 'Affiliate',
                'coupon_type' => '2',
                'status' => '1',
            ]);
        } elseif ($coupon->status == 0) {
            $coupon->update([
                'status' => 1,
            ]);
        }

        Session::flash('success', 'Affiliate Created Successfully');
        return redirect()->route('vendor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd('ok');
        $vendor = Vendor::findOrFail($id);
        return view('backend.vendor.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'shop_name'     => 'required',
            'phone'         => ['required', 'regex:/(\+){0,1}(88){0,1}01(3|4|5|6|7|8|9)(\d){8}/', 'min:11', 'max:15'],
            'email'         => ['required', 'string', 'email', 'max:255'],
            'address'       => 'required',
        ]);

        $vendor = Vendor::find($id);

        if ($request->slug != null) {
            $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        } else {
            $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->shop_name)) . '-' . Str::random(5);
        }

        if ($request->status == Null) {
            $request->status = 0;
        }

        $user = User::find($vendor->user_id);
        $user->name = $request->shop_owner_name;
        $user->username = $slug;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->status = $request->status;
        $user->save();

        // Vendor table update
        $vendor->shop_owner_name = $request->shop_owner_name;
        $vendor->shop_name = $request->shop_name;
        $vendor->slug = $slug;
        $vendor->address = $request->address;
        $vendor->comission_type = $request->comission_type;
        $vendor->commission = $request->commission;
        $vendor->description = $request->description;
        $vendor->status = $request->status;
        if ($request->status == 1) {
            $vendor->is_request = 0;
        }
        $vendor->created_by = Auth::guard('admin')->user()->id;

        $vendor->save();

        //Shop Profile Photo Update
        if ($request->hasfile('shop_profile')) {
            try {
                if (file_exists($vendor->shop_profile)) {
                    unlink($vendor->shop_profile);
                }
            } catch (Exception $e) {
            }
            $shop_profile = $request->shop_profile;
            $shop_pro = time() . $shop_profile->getClientOriginalName();
            $shop_profile->move('upload/vendor/', $shop_pro);

            $vendor->shop_profile = 'upload/vendor/' . $shop_pro;
            $user->profile_image = 'upload/vendor/' . $shop_pro;
        } else {
            $shop_pro = '';
        }

        //Shop Cover Photo Update
        if ($request->hasfile('shop_cover')) {
            try {
                if (file_exists($vendor->shop_cover)) {
                    unlink($vendor->shop_cover);
                }
            } catch (Exception $e) {
            }
            $shop_cover = $request->shop_cover;
            $shop_cover_photo = time() . $shop_cover->getClientOriginalName();
            $shop_cover->move('upload/vendor/', $shop_cover_photo);
            $vendor->shop_cover = 'upload/vendor/' . $shop_cover_photo;
        } else {
            $shop_cover_photo = '';
        }

        // Nid Card Update
        if ($request->hasfile('nid')) {
            try {
                if (file_exists($vendor->nid)) {
                    unlink($vendor->nid);
                }
            } catch (Exception $e) {
            }
            $nid = $request->nid;
            $nid_photo = time() . $nid->getClientOriginalName();
            $nid->move('upload/vendor/', $nid_photo);
            $vendor->nid = 'upload/vendor/' . $nid_photo;
        } else {
            $nid_photo = '';
        }

        // Trade License Update
        if ($request->hasfile('trade_license')) {
            try {
                if (file_exists($vendor->trade_license)) {
                    unlink($vendor->trade_license);
                }
            } catch (Exception $e) {
            }
            $trade_license = $request->trade_license;
            $trade_photo = time() . $trade_license->getClientOriginalName();
            $trade_license->move('upload/vendor/', $trade_photo);
            $vendor->trade_license = 'upload/vendor/' . $trade_photo;
        } else {
            $trade_photo = '';
        }

        $user->save();
        $vendor->save();


        Session::flash('success', 'Vendor Updated Successfully');
        return redirect()->route('vendor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);
        $user = $vendor->user_id;
        $users = User::where('id', $user)->first();
        try {
            if (file_exists($vendor->shop_cover)) {
                unlink($vendor->shop_cover);
            }
        } catch (Exception $e) {
        }
        try {
            if (file_exists($vendor->shop_profile)) {
                unlink($vendor->shop_profile);
            }
        } catch (Exception $e) {
        }
        try {
            if (file_exists($vendor->nid)) {
                unlink($vendor->nid);
            }
        } catch (Exception $e) {
        }
        try {
            if (file_exists($vendor->trade_license)) {
                unlink($vendor->trade_license);
            }
        } catch (Exception $e) {
        }

        $vendor->delete();
        $users->delete();

        $notification = array(
            'message' => 'Vendor Deleted Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function passwordUpdate($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('backend.vendor.password_update', compact('vendor'));
    }

    public function passwordUpdateStore(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $vendor = Vendor::findOrFail($id);
        $user = User::findOrFail($vendor->user_id);

        $user->password = Hash::make($request->password);
        $user->save();

        $notification = [
            'message' => 'Password updated successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->route('vendor.index')->with($notification);
    }

    /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id)
    {
        $vendor = Vendor::find($id);
        $vendor->status = 1;
        $vendor->save();
        User::where('id', '=', $vendor->user_id)->update(['status' => '1']);
        if ($vendor->status == 1) {
            // dd('ok');
            $vendor->is_request = 0;
            $vendor->save();
        }

        $coupon = Coupon::where('user_id', $vendor->user_id)->first();
        if ($coupon == null) {
            Coupon::create([
                'coupon_code' => 'laptop' . rand(0000, 9999),
                'discount' => 500,
                'applies_to' => 'Laptop-SybrC',
                'discount_type' => '1',
                'total_use_limit' => '100000',
                'expire_date' => Carbon::now()->addYears(2),
                'type' => '1',
                'user_id' => $vendor->user_id,
                'description' => 'Affiliate',
                'coupon_type' => '2',
                'status' => '1',
            ]);
        } elseif ($coupon->status == 0) {
            $coupon->update([
                'status' => 1,
            ]);
        }

        Session::flash('success', 'Affiliate Account Active Successfully.');
        return redirect()->back();
    }

    public function inactive($id)
    {
        $vendor = Vendor::find($id);
        $vendor->status = 0;
        $vendor->save();
        User::where('id', '=', $vendor->user_id)->update(['status' => '0']);
        if ($vendor->status == 0) {
            $vendor->is_request = 1;
            $vendor->save();
        }

        $coupon = Coupon::where('user_id', $vendor->user_id)->first();
        if ($coupon != null) {
            $coupon->update([
                'status' => '0',
            ]);
        }

        Session::flash('warning', 'Affiliate Account Inactive Successfully.');
        return redirect()->back();
    }

    public function affiliateProduct()
    {
        // dd('ok');
        $data['orders'] = Order::whereNotNull('affiliate_user_id')->whereNotNull('coupon_code')->get();
        return view('backend.affliate.index', $data);
    }

    public function activeAll()
    {
        try {
            $vendors = Vendor::where('status', 0)->get();

            foreach ($vendors as $vendor) {
                $vendor->status = 1;
                $vendor->is_request = 0;
                $vendor->save();

                User::where('id', $vendor->user_id)->update(['status' => 1]);

                $coupon = Coupon::where('user_id', $vendor->user_id)->first();
                if ($coupon === null) {
                    Coupon::create([
                        'coupon_code' => 'laptop' . rand(0000, 9999),
                        'discount' => 500,
                        'applies_to' => 'Laptop-SybrC',
                        'discount_type' => '1',
                        'total_use_limit' => '100000',
                        'expire_date' => Carbon::now()->addYears(2),
                        'type' => '1',
                        'user_id' => $vendor->user_id,
                        'description' => 'Affiliate',
                        'coupon_type' => '2',
                        'status' => '1',
                    ]);
                } elseif ($coupon->status == 0) {
                    $coupon->update(['status' => 1]);
                }
            }

            Session::flash('success', 'All Affiliate Account Actived Successfully.');
            return back();
        } catch (\Exception $e) {
            return back();
        }
    }
}
