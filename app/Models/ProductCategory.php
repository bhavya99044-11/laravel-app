<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected $table="product_categories";

    public function Products(){
        return $this->hasMany(Product::class,'category_id','id');
    }

}
