<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ReturnRequest extends Model
{
    use HasFactory;
    private static $returnRequest;

    public static function add($request)
    {
//        dd($request);
        self::$returnRequest = new ReturnRequest();
        $order = Order::where('invoice_no', $request->invoice_no)->first();
        self::$returnRequest->order_id      = $order->id;
        self::$returnRequest->comment       = $request->comment;
        self::$returnRequest->user_id       = Auth::user()->id;
        self::$returnRequest->status        = 0;

        self::$returnRequest->save();
        return self::$returnRequest;
    }

    public function returning_product()
    {
        return $this->hasMany(ReturningProduct::class, 'request_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
