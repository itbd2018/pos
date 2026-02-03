<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorComission extends Model
{
    use HasFactory;
//    protected $guarded = ['id'];
protected $fillable = ['id', 'order_id', 'vendor_id', 'vendor_amount', 'admin_commission', 'month', 'year'];

}
