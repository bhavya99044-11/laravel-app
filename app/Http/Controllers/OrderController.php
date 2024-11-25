<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\ColorSize;
use App\Models\OrderItem;
use App\Models\UserOrder;
use App\Models\ProductCart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;



use App\Models\ProductCategory;
class OrderController extends Controller
{

    protected $data;
    public function __construct(){
        $this->data['cart_count']=cartCount();
    }

    public function placeOrder(Request $request)
    {
        // $userId=1;
        //     DB::beginTransaction();
        // try{


        //     $user = User::find($userId);

        //     $cartData=ProductCart::with(['ColorSize','ColorSize.color','ColorSize.inventory'])->where('unique_token',Cookie::get('cart_token'))->get();
        //     $quantity=$cartData->each(function($item) {
        //         return
        //               ColorSize::whereIn('id', $item->pluck('color_size_id'))->get();

        //     });

        //     $html=null;

        //     foreach ($cartData as $item) {
        //        $userQuantity=$item->quantity;
        //        $productQuantiy=(int)$quantity->where('color_size_id','=',$item->color_size_id)->first()->ColorSize->inventory()->pluck('quantity')->first();
        //        if($userQuantity>$productQuantiy){
        //         $html.="product ".$item->with('product')->first()->product->product_name." color ".$item->ColorSize->color->color." is out of stock. Available stock: ".$productQuantiy."<br>";
        //        }

        //     }

        //     if($html!=null){
        //         return response()->json([
        //             'status' => 400,
        //            'message' => 'Some products are out of stock',
        //             'data' => $html
        //         ]);
        //     }

        //     $totalPrice=floor($cartData->sum(function($item) {
        //         return $item['quantity'] * $item['price'];
        //     }));



        //     $order = UserOrder::create([
        //         'user_id' => $userId,
        //         'total_price' =>$totalPrice,
        //         'order_number' => $userId. '-'. time(),
        //         'status'=>0
        //     ]);
        //     // dd($order->id);


        //     foreach ($cartData as $item) {
        //     //   dd($item);

        //         OrderItem::create([
        //             'order_id' => $order->id,
        //             'product_id' => $item->product_id,
        //             'quantity' => $item['quantity'],
        //             'price' => $item['price'],
        //             'color_size_id' => $item->color_size_id,
        //         ]);

        //         $item->ColorSize->inventory()->decrement('quantity', $item['quantity']);
        //     }

        //     $cartData->each->delete();
        //     Session::forget('cart_token');
        //     Session::forget('cart_count');

        //     DB::commit();
        //     // return redirect()->route('viewOrder');
        //     return response()->json([
        //         'status' => '200',
        //         'message' => 'Order placed successfully',
        //     ]);
        // }



        // catch(\Exception $e){

        //     DB::rollBack();
        //     return response()->json([
        //         'status' => '500',
        //         'message' => $e->getMessage(),
        //     ]);
        // }

        return response()->json([
                    'status' => '200',
                    'message' => 'success'
                ]);

    }

    public function viewOrder(){
        $this->data['categories']=ProductCategory::with('Products')->get();
        $userId=User::whereId(Auth::user()->id)->first();

        if($userId){
            $this->data['cart_count']=$userId->productCarts->count();
        }

        $this->data['orders']=UserOrder::with('orderItems')->whereUserId($userId->id)->get();

        return view('frontend.order-history')->with(['data'=>$this->data]);
    }
}
