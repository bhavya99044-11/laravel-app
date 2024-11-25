<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Color;
use App\Models\Size;
use App\Models\UserOrder;
use App\Models\Product;
use App\Models\ColorSize;

class OrderItem extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected $table="order_items";

    protected $fillable=['order_id','product_id','quantity','price','color_size_id','coupon_id','discount'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function colorSize(){
        return $this->belongsTo(ColorSize::class,'color_size_id','id');
    }

    public function order(){
        return $this->belongsTo(UserOrder::class);
    }

    public function color(){
        return $this->belongsTo(Color::class);
    }

    public function size(){
        return $this->belongsTo(Size::class);
    }


}
