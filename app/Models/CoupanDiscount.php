<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class CoupanDiscount extends Model
{
    use HasFactory;

    protected $table="coupon_discounts";

    protected $fillable = [
        'coupon_code',
        'discount_percentage_price',
        'coupon_type',
        'min_cart_value',
        'max_uses',
        'coupon_count',
        'is_active',
        'expiry_date',
        'start_date',
        'description',
    ];

    public function products(){
        return $this->belongsToMany(Product::class, 'product_discount_coupons', 'discount_coupon_id', 'product_id');
    }

   

}
