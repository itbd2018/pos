<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Vendor;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get-laptopache-amount', function (Request $request) {
    $affiliateId = $request->affiliateId;

    if (!$affiliateId) {
        return response()->json([
            'success' => false,
            'message' => 'Affiliate ID is required.'
        ]);
    }

    $user = User::where('affiliate_id', $affiliateId)->first();

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'User not found.'
        ]);
    }

    $vendor = Vendor::where('user_id', $user->id)->first();

    if (!$vendor) {
        return response()->json([
            'success' => false,
            'message' => 'affiliate data not found.'
        ]);
    }

    return response()->json([
        'success' => true,
        'amount' => $vendor->balance,
        'project'=> 'laptopache',
    ]);
});
