<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductReview;
use App\Models\ProductCart;
use App\Models\ColorSize;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCheckoutMail;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\CoupanDiscount;
use App\Models\UserOrder;
// use PDF;
use App\Jobs\OrderCheckoutJob;


class CartController extends Controller
{

    protected $total;

    protected $data = [];

    public function __construct()
    {

        $this->data['cart_count'] = cartCount();

        $this->data['categories'] = ProductCategory::all();
        $userId = 1;
        $this->data['cart'] = ProductCart::where('user_id', $userId)
            ->with(['product', 'user', 'ColorSize.color', 'colorSize.size', 'colorSize.image'])
            ->get()
            ->each(function ($item) {
                return [
                    $item->total = $item->quantity * $item->price,

                ];
            });

        $total = $this->data['cart']->sum(function ($data) {
            return $data['quantity'] * $data['price'];
        });
        $this->data['total'] = [
            'total' => $total,
            'discount' => round((floor($total) - $total), 2),
            'final' => floor($total)
        ];
        ;
    }

    public function checkoutCart()
    {
    //    $data=CoupanDiscount::find(1);
    //     dd($data);
        $this->data['cartData'] = ProductCart::with(['ColorSize', 'product','ColorSize.image'])->where('unique_token', Cookie::get('cart_token'))->get()->each(
            function ($item) {
                $item->total = $item['product']['price'] * $item['quantity'];
                $this->total += $item['total'];
            }
        );
        $summary = [];
        $summary['subTotal'] = $this->total;
        $summary['gst'] = round(gstCalculator($this->total),2);
        $summary['total'] = $this->total + $summary['gst'];
        $finalAmount = discountCalculator($this->total + $summary['gst']);
        $summary['grandTotal'] = $finalAmount['integer'];
        $summary['discount'] = $finalAmount['discount'];
        $this->data['cartSummary'] = $summary;
        return view('frontend.coupon-checkout')->with(['data' => $this->data]);
    }

    public function payNow(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->data['cartData'] = ProductCart::with(['ColorSize', 'product'])->where('unique_token', Cookie::get('cart_token'))->get()->each(
                function ($item) {
                    $item->total = $item['product']['price'] * $item['quantity'];
                    $this->total += $item['total'];
                }
            );
            $summary = $this->cartCalculation();
            $time = now();
            $coupon = CoupanDiscount::where(DB::raw('BINARY `coupon_code`'), '=', $request->coupon_code)
                ->where('start_date', '<=', $time)
                ->where('expiry_date', '>=', $time)
                ->whereIsActive(true)
                ->where('coupon_count', '>', 0)
                ->first();
            $summary = $this->cartCalculation();
            $summary['discount'] = abs($summary['discount']);

            if ($coupon) {
                if ($coupon->coupon_type == 1) {
                    $couponData = couponPercentCalculator($summary['grandTotal'], $summary['discount'], $coupon->discount_percentage_price);
                    $summary['grandTotal'] = $couponData['total'];
                    $summary['discount'] = abs($summary['discount']) + $couponData['discount'];
                } else if ($coupon->coupon_type == 0) {
                    $couponData = couponPriceCalculator($summary['grandTotal'], $summary['discount'], $coupon->discount_percentage_price);
                    $summary['grandTotal'] = $couponData['total'];
                    $summary['discount'] = abs($summary['discount']) + $couponData['discount'];
                }
                $coupon->decrement('coupon_count');
            }
            $order = UserOrder::create([
                'user_id' => Auth::id(),
                'status' => 'pending',
                'order_number' => Auth::id() . time(),
                'total_price' => $summary['grandTotal'],
                'coupon_id' => $coupon != null ? $coupon->id : null,
                'discount' => $summary['discount'],
            ]);
            foreach ($this->data['cartData'] as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'color_size_id' => $item->color_size_id,
                ]);
                $item->ColorSize->inventory()->decrement('quantity', $item['quantity']);
                $item->delete();
            }
            session::forget('cart_count');
            Cookie::forget('cart_token');
            DB::commit();
            dispatch(new OrderCheckoutJob(66));
            return response()->json([
                'status' => 200,
                'message' => 'Order placed successfully!',
                'data' => $order,
            ]);
        } catch (\Exception $e) {
            Log::error('An error occurred while applying coupon: ' . $e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function orderMail(Request $request){
        $data = UserOrder::with('orderItems','orderItems.ColorSize','orderItems.ColorSize.product','orderItems.ColorSize.image','orderItems.ColorSize.inventory','orderItems.ColorSize.color')->find(68);
        return view('frontend.order-checkout-mail')->with(['data'=>$data]);
    }
    public function couponApply(Request $request)
    {
        try {
            $couponCode = $request->coupon_code;
            $coupon = CoupanDiscount::where(DB::raw('BINARY `coupon_code`'), $couponCode)->whereIsActive(true)->where('coupon_count', '>', 0)->get();
            if ($coupon->first()) {
                $time = now();
                $expiration = $coupon->toQuery()->where('start_date', '<=', $time)->where('expiry_date', '>=', $time)->first();
                if (isset($expiration) && !empty($expiration)) {
                    $this->data['cartData'] = ProductCart::with(['ColorSize', 'product'])->where('unique_token', Cookie::get('cart_token'))->get()->each(
                        function ($item) {
                            $item->total = $item['product']['price'] * $item['quantity'];
                            $this->total += $item['total'];
                        }
                    );
                    $summary = $this->cartCalculation();
                    if ($expiration->min_cart_value <= $summary['grandTotal']) {
                        $coupon = $expiration->coupon_type == 1 ? couponPercentCalculator($summary['grandTotal'], $summary['discount'], $expiration->discount_percentage_price) : couponPriceCalculator($summary['grandTotal'], $summary['discount'], $expiration->discount_percentage_price);
                        return response()->json([
                            'status' => 200,
                            'message' => 'Yay you saved $' . $coupon['discount'],
                            'amount' => $coupon['total'],
                        ]);
                    } else {
                        return response()->json([
                            'status' => 404,
                            'message' => 'Subtotal should be greater than or equal to ' . $expiration->min_cart_value . '!'
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => 404,
                        'message' => 'Coupon is not valid for this time!'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Coupon not found!'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function cartCalculation()
    {
        $summary = [];
        $summary['subTotal'] = $this->total;
        $summary['gst'] = round(gstCalculator($this->total),2);
        $summary['total'] = $this->total + $summary['gst'];
        $finalAmount = discountCalculator($this->total + $summary['gst']);
        $summary['grandTotal'] = $finalAmount['integer'];
        $summary['discount'] = $finalAmount['discount'];
        return $summary;
    }

    public function cartUpdate(Request $request)
    {
    }

    public function addUserCart(Request $request)
    {
        try {
            $getToken = Cookie::get('cart_token');
            $seeionCart = Session::get('cart');
            $seeionCart[$request->productId] = $request->quantity;
            // Session::put('cart',$seeionCart);
            $cookieToken = null;
            if (empty(Cookie::get('cart_token'))) {
                $cookieToken = time() . rand(100000, 999999);
                Cookie::queue('cart_token', $cookieToken, time() + 60 * 60 * 24 * 365);
            }
            $price = Product::find($request->productId)->price;
            if ($request->colorId == null || $request->sizeId == null) {
                $colorId = ColorSize::whereProductId($request->productId)->first()->id;
                $quantity = 1;
            } else {
                $colorId = ColorSize::where('color_id', $request->colorId)
                    ->where('size_id', $request->sizeId)
                    ->where('product_id', $request->productId)
                    ->first()->id;
                $quantity = $request->quantity;
            }
            $productCart = ProductCart::whereUniqueToken($getToken);
            $count = $productCart->count();
            $cartId = $productCart->whereColorSizeId($colorId)->first();
            $cartId ? $count : $count++;
            if ($cartId) {
                $cartId->quantity += $quantity;
                $cartId->save();
            } else {
                Session::put('cart_count', $count);
                ProductCart::create([
                    'product_id' => $request->productId,
                    'color_size_id' => $colorId,
                    'quantity' => $quantity,
                    'price' => $price,
                    'unique_token' => $cookieToken ? $cookieToken : $getToken,
                ]);
            }
            $userId = User::whereId('1')->first();
            $this->data['cart_count'] = $userId->productCarts->count();
            return response()->json([
                'status' => 200,
                'count' => $count,
                'message' => 'Product added to cart successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function cartView()
    {
        $userId = 1;
        if (!empty(Cookie::get('cart_token'))) {
            $this->data['cart'] = ProductCart::whereuniqueToken(Cookie::get('cart_token'))
                ->with(['product', 'ColorSize.image'])
                ->get()
                ->each(function ($item) {
                    return $item->total = $item->quantity * $item->price;
                });
        }
        return view('frontend.add-cart')->with(['data' => $this->data]);
    }

    public function deleteCart($id)
    {
        try {
            ProductCart::find($id)->delete();
            $count = Session::get('cart_count') - 1;
            Session::put('cart_count', $count);
            return response()->json([
                'status' => 200,
                'message' => 'Product deleted from cart successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function invoice()
    {
        return view('frontend.invoice-pdf')->with(['data' => $this->data]);
    }

    public function invoiceDownload($orderId)
    {
        try {
            $order = UserOrder::with(['orderItems', 'orderItems.ColorSize', 'orderItems.ColorSize.color', 'orderItems.ColorSize.size', 'orderItems.ColorSize.product'])->whereId($orderId)->get()
                ->each(function ($item) {
                    return [
                        $item->orderItems->each(function ($item2) {
                            $item2->total = $item2->quantity * $item2->price;
                        }),

                        $item->grand_total = $item->orderItems->sum('total')
                    ];
                });
            $pdf = PDF::loadView('frontend.invoice-pdf', ['data' => $order]);
            $path = public_path('pdf/');
            $fileName = time() . '.' . 'pdf';
            $pdf->save($path . '/' . $fileName);
            $pdf = public_path('pdf/' . $fileName);
            return response()->download($pdf);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    public function quantityCheck(Request $request, $productId, $colorId, $sizeId)
    {
        try {
            $quantity = Product::with([
                'ColorSize' => function ($query) use ($colorId, $sizeId) {
                    $query->whereColorId($colorId)->whereSizeId($sizeId);
                    $query->with([
                        'inventory' => function ($query1) {
                            $query1->select('color_size_id', 'quantity');
                        }
                    ]);
                }
            ])->whereId($productId)->first();
            $dataQuantity = $quantity['ColorSize'][0]['inventory'][0]->quantity;
            $count = $request->count;
            $count++;
            if ($count > $dataQuantity) {
                return response()->json(['status' => 400, 'message' => 'Insufficient quantity']);
            } else {
                return response()->json(['status' => 200, 'message' => 'Quantity updated successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }
}
