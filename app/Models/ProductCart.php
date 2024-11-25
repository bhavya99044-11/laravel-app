<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'color_size_id',
        'quantity',
        'price',
        'unique_token',
    ];

    protected $table='product_carts';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function ColorSize(){
        return $this->belongsTo(ColorSize::class);
    }

    public function color(){
        return $this->belongsTo(Color::class);
    }

    public function size(){
        return $this->belongsTo(Size::class);
    }

    public function inventory(){
        return $this->belongsTo(Inventory::class);
    }


}
