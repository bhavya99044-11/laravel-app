<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCategory;
use App\Models\ColorSize;
use App\Models\CoupanDiscount;
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'category_id',
        'user_id',
        'price',
        'product_description'
    ];

    protected $table = "products";

    public function ProductCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }

    // public function Colors()
    // {
    //     return $this->hasMany(ColorSize::class, 'product_id', 'id');
    // }

    // public function ColorSize()
    // {

    //     return $this->belongsToMany(ColorSize::class,'color_sizes','product_id')->withPivot('id');

    // }

     public function ColorSize()
    {

        return $this->hasMany(ColorSize::class,'product_id');

    }

    public function ColorPivot(){
        return $this->belongsToMany(Color::class,"color_sizes","product_id")->withPivot('id');
    }

     public function SizePivot()
    {

        return $this->belongsToMany(Size::class,'color_sizes','product_id');

    }

    public function reviews(){
        return $this->hasMany(ProductReview::class,'product_id','id');
    }

    public function copuponDiscount(){
        return $this->belongsToMany(CoupanDiscount::class, 'product_discount_coupons', 'product_id', 'discount_coupon_id');
    }

}
