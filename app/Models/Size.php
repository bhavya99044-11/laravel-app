<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Color;

class Size extends Model
{
    use HasFactory;

    protected $table="size";

    protected $guarded=[];


    public function Colors(){
        return $this->belongsToMany(Color::class,"color_sizes","size_id");
    }

     public function Products()
    {

        return $this->belongsToMany(Product::class,'color_sizes','size_id');

    }

}
