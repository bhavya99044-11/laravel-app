<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\ProductImage;
class ColorSize extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected $fillable=[
        'color_id',
        'product_id',
        'size_id'
    ];

    protected $table="color_sizes";

    public function Inventory(){
        return $this->hasMany(Inventory::class,"color_size_id",'id');
    }

    public function color(){
       return $this->belongsTo(Color::class,'color_id','id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function size(){
        return $this->belongsTo(Size::class,'size_id','id');
     }

    public function image(){
return $this->hasMany(ProductImage::class,"color_id",'id');
    }
}
