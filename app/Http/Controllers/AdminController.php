<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Session;
use Artisan;
use Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class AdminController extends Controller
{
    /*=================== Start Index Login Methoed ===================*/
    public function Index()
    {
        if (Auth::check()) {
            abort(404);
        }

        return view('admin.admin_login');
    } // end method



    /*=================== End Index Login Methoed ===================*/

    /*=================== Start Dashboard Methoed ===================*/
    public function Dashboard()
    {

        $vendor = Vendor::where('user_id', Auth::guard('admin')->user()->id)->first();

        $userCount = DB::table('users')
            ->select(DB::raw('count(*) as total_users'))
            ->where('status', 1)
            ->where('role', 3)
            ->first();

        if (Auth::guard('admin')->user()->role == '2') {
            $productCount = DB::table('products')
                ->select(DB::raw('count(*) as total_products'))
                ->where('vendor_id', Auth::guard('admin')->user()->id)
                ->where('status', 1)
                ->first();

            if ($vendor) {
                $productCount = DB::table('products')
                    ->select(DB::raw('count(*) as total_products'))
                    ->where('vendor_id', $vendor->id)
                    ->where('status', 1)
                    ->first();
            }
        } else {
            $productCount = DB::table('products')
                ->select(DB::raw('count(*) as total_products'))
                ->where('status', 1)
                ->first();
        }

        $categoryCount = DB::table('categories')
            ->select(DB::raw('count(*) as total_categories'))
            ->where('status', 1)
            ->first();

        $brandCount = DB::table('brands')
            ->select(DB::raw('count(*) as total_brands'))
            ->where('status', 1)
            ->first();

        $StaffCount = DB::table('staff')->count();

        $vendorCount = Vendor::all();

        $orderCount = DB::table('orders')
            ->select(DB::raw('count(*) as total_orders, sum(grand_total) as total_sell'))
            ->first();

        $lowStockCount = DB::table('product_stocks as s')
            ->leftjoin('products as p', 's.product_id', '=', 'p.id')
            ->select(DB::raw('count(s.id) as total_low_stocks'))
            ->where('p.vendor_id', Auth::guard('admin')->user()->id)
            ->where('s.qty', '<=', 5)
            ->first();

        if ($vendor) {
            $lowStockCount = DB::table('product_stocks as s')
                ->leftjoin('products as p', 's.product_id', '=', 'p.id')
                ->select(DB::raw('count(s.id) as total_low_stocks'))
                ->where('p.vendor_id', $vendor->id)
                ->where('s.qty', '<=', 5)
                ->first();
        }
        //        return $lowStockCount;
        $orders = DB::table('orders')->where('delivery_status', '=', 'pending')->latest()->paginate(6);

        //dd($userCount->total_users);

        if (Auth::guard('admin')->user()->role == 2) {
            $vendor = Vendor::where('user_id', Auth::guard('admin')->user()->id)->first();
            $products = OrderDetail::where('vendor_id', $vendor->id)->select('product_id')->selectRaw('SUM(price*qty) as amount, SUM(qty) as qty')->groupBy('product_id')->get();
            return view('admin.index', compact('products', 'userCount', 'productCount', 'categoryCount', 'brandCount', 'vendorCount', 'orderCount', 'lowStockCount', 'StaffCount', 'orders'));
        }

        return view('admin.index', compact('userCount', 'productCount', 'categoryCount', 'brandCount', 'vendorCount', 'orderCount', 'lowStockCount', 'StaffCount', 'orders'));
    } // end method

    /*=================== End Dashboard Methoed ===================*/

    /*=================== Start Admin Login Methoed ===================*/

    public function Login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::guard('admin')->attempt($credentials)) {
            return back()->with([
                'message' => 'Invalid Email Or Password.',
                'alert-type' => 'error'
            ]);
        }

        $user = Auth::guard('admin')->user();

        //Check Affiliate (Only for vendors / role 2)
        if ($user->role == "2") {
            $affiliateId = $user->affiliate_id;

            if (!$affiliateId) {
                Auth::guard('admin')->logout();
                return back()->with(['message' => 'No affiliate ID found in your profile.']);
            }

            try {
                $responseGhorkonnya = Http::timeout(5)->get('https://ghorkonnya.com/api/check-affiliateId', [
                    'affiliateId' => $affiliateId
                ]);

                $responseUparjok = Http::timeout(5)->get('https://uparjok.com/api/check-affiliateId', [
                    'affiliateId' => $affiliateId
                ]);

                $ghorkonnyaValid = $responseGhorkonnya->successful();
                $uparjokValid = $responseUparjok->successful();

                if ($ghorkonnyaValid || $uparjokValid) {
                    $ghorkonnyaStatus = $ghorkonnyaValid ? data_get($responseGhorkonnya->json(), 'user.status') : null;
                    $uparjokStatus   = $uparjokValid ? data_get($responseUparjok->json(), 'user.status') : null;

                    if (($ghorkonnyaStatus === 2) && ($uparjokStatus === 2)) {
                        Auth::guard('admin')->logout();
                        return back()->with(['message' => 'Your affiliate account is locked or inactive.']);
                    }
                } else {                  
                    return redirect()->route('admin.dashboard')->with([
                        'warning' => 'Affiliate verification failed, but you are logged in. Please contact support if this issue persists.'
                    ]);
                }
            } catch (\Exception $e) {              
                return redirect()->route('admin.dashboard')->with([
                    'warning' => 'Could not verify affiliate account (API timeout). You are still logged in.'
                ]);
            }
        }

        // Role-based access
        if (in_array($user->role, ["1", "2", "5"])) {
            return redirect()->route('pos.index')->with('success', 'Admin Login Successfully.');
        }

        Auth::guard('admin')->logout();
        return back()->with([
            'message' => 'Invalid Email Or Password.',
            'alert-type' => 'error'
        ]);
    }

    // public function Login(Request $request)
    // {
    //     $this->validate($request, [
    //         'email' => 'required',
    //         'password' => 'required',
    //     ]);

    //     $credentials = $request->only('email', 'password');

    //     if (Auth::guard('admin')->attempt($credentials)) {
    //         $user = Auth::guard('admin')->user();

    //         if ($user->role == "2") {
    //             $affiliateId = $user->affiliate_id;

    //             if ($affiliateId) {
    //                 $responseGhorkonnya = Http::get('https://ghorkonnya.com/api/check-affiliateId', [
    //                     'affiliateId' => $affiliateId
    //                 ]);

    //                 $responseUparjok = Http::get('https://uparjok.com/api/check-affiliateId', [
    //                     'affiliateId' => $affiliateId
    //                 ]);

    //                 $ghorkonnyaValid = $responseGhorkonnya->successful();
    //                 $uparjokValid = $responseUparjok->successful();

    //                 if ($ghorkonnyaValid || $uparjokValid) {
    //                     $ghorkonnyaStatus = $ghorkonnyaValid ? $responseGhorkonnya->json()['user']['status'] ?? null : null;
    //                     $uparjokStatus = $uparjokValid ? $responseUparjok->json()['user']['status'] ?? null : null;

    //                     if (($ghorkonnyaStatus !== null && $ghorkonnyaStatus != 2) ||
    //                         ($uparjokStatus !== null && $uparjokStatus != 2)
    //                     ) {
    //                         Auth::guard('admin')->logout();
    //                         return back()->with(['message' => 'Your affiliate account is locked or inactive.']);
    //                     }
    //                 } else {
    //                     Auth::guard('admin')->logout();
    //                     return back()->with(['message' => 'Unable to verify affiliate account. Please try again later.']);
    //                 }
    //             } else {
    //                 Auth::guard('admin')->logout();
    //                 return back()->with(['message' => 'No affiliate ID found in your profile.']);
    //             }
    //         }

    //         if (in_array($user->role, ["1", "2", "5"])) {
    //             return redirect()->route('admin.dashboard')->with('success', 'Admin Login Successfully.');
    //         } else {
    //             Auth::guard('admin')->logout();
    //             return back()->with([
    //                 'message' => 'Invalid Email Or Password.',
    //                 'alert-type' => 'error'
    //             ]);
    //         }
    //     } else {
    //         return back()->with([
    //             'message' => 'Invalid Email Or Password.',
    //             'alert-type' => 'error'
    //         ]);
    //     }
    // }

    /*=================== End Admin Login Methoed ===================*/

    /*=================== Start Logout Methoed ===================*/
    public function AminLogout(Request $request)
    {
        if (Auth::guard('admin')->user()->role == 1) {
            $route = 'login_form';
        } else {
            $route = 'vendor.login_form';
        }

        Auth::guard('admin')->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = array(
            'message' => 'Logout Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route($route)->with($notification);
    } // end method
    /*=================== End Logout Methoed ===================*/

    /*=================== Start AdminRegister Methoed ===================*/
    public function AdminRegister()
    {

        return view('admin.admin_register');
    } // end method
    /*=================== End AdminRegister Methoed ===================*/

    /*=================== Start AdminForgotPassword Methoed ===================*/
    public function AdminForgotPassword()
    {

        return view('admin.admin_forgot_password');
    } // end method
    /*=================== End AdminForgotPassword Methoed ===================*/

    /*=================== Start AdminRegisterStore Methoed ===================*/
    public function AdminRegisterStore(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required'
        ]);
        // dd($request->all());
        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('login_form')->with('success', 'Admin Created Successfully.');
    } // end method
    /*=================== End AdminRegisterStore Methoed ===================*/

    /* =============== Start Profile Method ================*/
    public function Profile()
    {
        $id = Auth::guard('admin')->user()->id;
        $adminData = User::find($id);

        // dd($adminData);
        return view('admin.admin_profile_view', compact('adminData'));
    } // End Method

    /* =============== Start EditProfile Method ================*/
    public function EditProfile()
    {

        $id = Auth::guard('admin')->user()->id;
        $editData = User::find($id);
        return view('admin.admin_profile_edit', compact('editData'));
    } //

    /* =============== Start StoreProfile Method ================*/
    public function StoreProfile(Request $request)
    {
        $id = Auth::guard('admin')->user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('profile_image')) {
            $file = $request->file('profile_image');

            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['profile_image'] = $filename;
        }
        $data->save();

        Session::flash('success', 'Admin Profile Updated Successfully');

        return redirect()->route('admin.profile');
    } // End Method

    /* =============== Start ChangePassword Method ================*/
    public function ChangePassword()
    {

        return view('admin.admin_change_password');
    } //

    /* =============== Start UpdatePassword Method ================*/
    public function UpdatePassword(Request $request)
    {

        $validateData = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirm_password' => 'required|same:newpassword',

        ]);

        $hashedPassword = Auth::guard('admin')->user()->password;

        // dd($hashedPassword);
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $id = Auth::guard('admin')->user()->id;
            $admin = User::find($id);
            $admin->password = bcrypt($request->newpassword);
            $admin->save();

            Session::flash('success', 'Password Updated Successfully');
            return redirect()->back();
        } else {
            Session::flash('error', 'Old password is not match');
            return redirect()->back();
        }
    } // End Method

    /* =============== Start clearCache Method ================*/
    function clearCache(Request $request)
    {
        Artisan::call('optimize:clear');
        Session::flash('success', 'Cache cleared successfully.');
        return redirect()->back();
    } // end method

    /* =============== End clearCache Method ================*/
}
