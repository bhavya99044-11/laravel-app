<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoupanDiscount;
use App\Models\Product;
use App\Models\ProductCategory;
class CoupanDiscountController extends Controller
{

    protected $data;


    public function __construct()
    {
        $this->data['products'] = Product::all();
        $this->data['cart_count'] = cartCount();
        $this->data['categories'] = ProductCategory::with('products')->get();
    }
    public function index()
    {
        return view('frontend.checkout-bill')->with(['data' => $this->data]);
    }
    public function create()
    {
    }

    public function store(Request $request)
    {
        try {
            CoupanDiscount::create($request->except('products'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
