<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Size;
class Color extends Model
{
    use HasFactory;

    protected $table='color';

    protected $guarded=[];

    public function Sizes(){
        return $this->belongsToMany(Size::class,"color_sizes","color_id");
    }

    public function Products(){
        return $this->belongsToMany(Product::class,"color_sizes","color_id");
    }



}
