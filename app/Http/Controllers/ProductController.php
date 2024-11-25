<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\ProductCategory;
use App\Models\ProductReview;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;

use App\Models\User;
use Carbon\Carbon;

class ProductController extends Controller
{

    private $totalReview;

    protected $data=[];

    public function __construct(){
        $this->data['cart_count']=cartCount();

        $this->data['categories']=ProductCategory::all();
    }

    public function productData(Request $request ,$id){
        try{
        $this->data['product']=Product::whereId($id)->with(['ProductCategory','reviews'=>function($query){
            $query->whereNull('product_review_id');
        },'reviews.user','ColorSize','ColorSize.Inventory','ColorSize.image','ColorSize.size','ColorSize.color'])->first();
        if(!empty(Cookie::get('cart_token'))){
            $quantity=ProductCart::whereUniqueToken(Cookie::get('cart_token'))->whereProductId($id)->first();
            $this->data['product']->quantity = $quantity!=null?$quantity->quantity:null;

        }
        $this->data['groupColor']=$this->data['product']->ColorSize->groupBy('color_id');
        $this->data['groupSize']= $this->data['groupColor']->first()->pluck('size');
        $this->data['reviews']=self::treeChildren($this->data['product']->reviews->values());
        // dd($this->data['product']['ColorSize'][0]['Inventory'][0]['quantity']);
        return view('frontend.pages.product_page')->with(['data'=>$this->data]);

    }catch(\Exception $e){

        Log::error('An error occurred: '. $e->getMessage());

    }

    }

    public function treeChildren($review){
        $result=collect();
        foreach($review as $data){
            $allComments=collect();
            $data->children=self::collectComment($allComments,$data);
    $result->push($data);

        }
        return $result;


    }

    public function collectComment(&$allComments,$data){
        // if($data->id !=403 && $data->id != 405)
        // dd($data);
        // $allComments->push($data);
        // $old=collect();
    // dd($data->child[0]->with('user')->get());
        foreach($data->child()->with(['user','child'])->get() as $child){
        // dd($child);
            $allComments->push($child);
            // dd($child->child);
            if(isset($child->child)){
                $child->child= self::collectComment($allComments,$child);
                // dd($children);

            }
        }
        // dd($allComments);
        // unset($allComments[0]);
        return $allComments;
    }
    public function product(Request $request, $id)
    {
        $data = [];
        $data['categories'] = ProductCategory::all();
        $data['product'] = Product::with([
            'ColorSize',
            'ColorSize.color',
            'reviews' => function ($query) {
                $query->whereNull('product_review_id');
            },
            'reviews.user',
            'ColorSize.size',
            'reviews.child.user',
            'ColorSize.inventory',
            'ColorSize.image'
        ])
            ->where('id', '=', $id)
            ->get();
            $review=ProductReview::all();
            $this->totalReview=count($review);
         $data['star1']=$this->reviewRating($review->where('stars',1));
         $data['star2']=$this->reviewRating($review->where('stars',2));
         $data['star3']=$this->reviewRating($review->where('stars',3));
         $data['star4']=$this->reviewRating($review->where('stars',4));
         $data['star5']=$this->reviewRating($review->where('stars',5));


        $reviews = ProductReview::orderBy('created_at','DESC')->get();

        self::treeReviewsChild($data['product'][0]->reviews->values(), $reviews);
            // dd($data['product'][0]->reviews);
        return view('pages.productPage')->with(['data' => $data]);
    }

    public  function reviewRating($reviews){
        $percent=(int)ceil((count($reviews)*100)/$this->totalReview);
        return $percent;
     }


    private static function treeReviewsChild($review, $reviews)
    {
        $user=User::all();
        foreach ($review as $data) {
            $data->child = $reviews->where('product_review_id', '=', $data->id)->values();
            //  $data->user=$user->where('id','=',$data->user_id)->values();
            if ($data->child->isNotEmpty()) {
                self::treeReviewsChild($data->child, $reviews);
            }
        }

        return $review;

    }

    public function productComment(Request $request)
    {
        try {
            strtok($request->rating, '-');
            $likes = strtok("");
            $user = 1;
            $data = ProductReview::create([
                'comment' => $request->commentText,
                'product_id' => $request->productId,
                'likes' => 0,
                'stars'=>$likes,
                'user_id' => $user,
                'product_review_id' => null
            ]);

            return response()->json([
                'status' => 200,
                'msg' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function productCommentReply(Request $request)
    {
        $user = 2;
        try {
            $data = ProductReview::create([
                'product_id' => $request->productId,
                'comment' => $request->replyComment,
                'product_review_id' => $request->dataId,
                'user_id' => $user,
                'likes' => 0
            ]);

            $userName = 'vikas';
            // $data['username'] = $userName;
            return response()->json([
                'status' => 200,
                'msg' => $data,

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function commentUpvote(Request $request)
    {
        try {
            $data = ProductReview::where('id', '=', $request->dataId)->first();

            $count = $data->likes;

            $data->update(['likes' => ++$count]);
            $data->save();
            return response()->json([
                'status' => 200,
                'msg' => $data->likes
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function commentDownvote(Request $request)
    {
        try {


            $data = ProductReview::where('id', '=', $request->dataId)->first();

            $count = $data->likes;

            $data->update(['likes' => --$count]);
            $data->save();

            return response()->json([
                'status' => 200,
                'msg' => $data->likes
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function newComment(Request $request ){
        $userId=1;
       $commentData= ProductReview::create([
            'comment'=>$request->comment,
            'user_id'=>$userId,
            'product_id'=>$request->productId
        ]);
        $commentData->load('user');
        // $commentData->created_at=Carbon::parse($commentData->created_at)->format('jS M Y');;
        return response()->json([
            'status'=>200,
            'msg'=>'comment added',
            'data'=>$commentData
        ]);
    }

    public function commentReply(Request $request){
        $userId=1;
        $commentData=ProductReview::create([
            'comment'=>$request->comment,
            'user_id'=>$userId,
            'product_id'=>$request->productId,
            'product_review_id'=>$request->commentReviewId
        ]);

        $commentData->load('user');

        // $commentData->comment=1111;
        //     dd($commentData);

        return response()->json([
           'status'=>200,
           'msg'=>'comment added',
            'data'=>$commentData
        ]);


    }


}
