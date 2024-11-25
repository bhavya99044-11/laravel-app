<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\User;
class CategoryController extends Controller
{
    protected $data=[];
    public function __construct(){
        $this->data['categories']=ProductCategory::all();
              $this->data['cart_count']=cartCount();

    }

    public function categories($id){
      $this->data['products']=Product::whereCategoryId($id)->get();
      return view('frontend.pages.category_product')->with(['data'=>$this->data]);
    }
}
