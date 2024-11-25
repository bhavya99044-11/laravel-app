<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ColorSize;
class ProductImage extends Model
{
    use HasFactory;

    protected $table='product_images';

    protected $fillable = ['color_id',
    'product_id',
    'url'
     ];

     public function ColorSize(){
return $this->belongsTo(ColorSize::class,'color_id','id');
     }

    //  public function colorImage(){
    //     return $this->belongsTo('');
    //  }
}
