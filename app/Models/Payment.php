<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Status;
class Payment extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected $table="payments";

    protected $fillable=['payment_method'];


    protected function casts(){
        return [
            'payment_method'=>AsEnumCollection::of(Status::class)
        ];
    }

}
