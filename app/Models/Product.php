<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function productPrices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }


    public function processorType()
    {
        return $this->belongsTo(Processor::class);
    }
    public function processorModel()
    {
        return $this->belongsTo(ProcessorModel::class);
    }
    public function generation()
    {
        return $this->belongsTo(Generation::class);
    }
    public function displaySize()
    {
        return $this->belongsTo(DisplaySize::class);
    }
    public function displayType()
    {
        return $this->belongsTo(DisplayType::class);
    }
    public function ramSize()
    {
        return $this->belongsTo(RamSize::class);
    }
    public function ramType()
    {
        return $this->belongsTo(RamType::class);
    }
    public function HDD()
    {
        return $this->belongsTo(HDD::class);
    }
    public function SSD()
    {
        return $this->belongsTo(SSD::class);
    }
    public function graphics()
    {
        return $this->belongsTo(Graphic::class);
    }
    public function operationgSystem()
    {
        return $this->belongsTo(OperatingSystem::class);
    }
    public function specialFeature()
    {
        return $this->belongsTo(SpecialFeature::class);
    }



    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function stocks()
    {
        return $this->hasMany(ProductStock::class);
    }
    public function multi_imgs()
    {
        return $this->hasMany(MultiImg::class);
    }

    public function group_product()
    {
        return $this->hasMany(GroupProduct::class, 'id', 'product_id');
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

    public function serialNumbers()
    {
        return $this->hasMany(ProductSerialNumber::class);
    }

    protected $casts = [
        'special_features' => 'array',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
