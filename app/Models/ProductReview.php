<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProductReview extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected $fillable=[
        'product_id',
        'comment',
        'user_id',
        'product_review_id',
        'likes',
        'child',
        'created_at'
    ];

    protected $table="product_reviews";


    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function parent(){
        return $this->belongsTo(ProductReview::class,'product_review_id','id');
    }

    public function child(){
        return $this->hasMany(ProductReview::class,'product_review_id','id');
    }


    public function user(){
        return  $this->belongsTo(User::class,'user_id','id');
    }

    public function childRecursive(){
        return $this->child()->with('childRecursive');
    }
    public function format($value){
       $this->created_at= Carbon::parse($value)->format('jS M Y');;

    }

    // public function childrenArray($comment,&$array){

    //   foreach($comment->child as $child){
    //     $array->push($child);
    //    $this->childrenArray($child,$array);
    //    dd($array);
    //   }
    //   dd($array);
    //   return $array;
    // }


}
