<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderItem;
class UserOrder extends Model
{
    use HasFactory;

    protected $table = 'user_orders';

    protected $fillable = ['user_id', 'total_price','status','order_number','coupon_id','discount'];

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function orderItems(){
        return $this->hasMany(OrderItem::class,'order_id','id'   );
    }

    public function coupon(){
        return $this->belongsTo(CoupanDiscount::class,'coupon_id','id'   );
    }

}
