<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ColorSize;

class Inventory extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = "inventories";

    protected $fillable = ["color_size_id",'quantity'];


    public function ColorSize()
    {
        return $this->belongsTo(ColorSize::class, 'color_size_id', 'id');
    }
}
