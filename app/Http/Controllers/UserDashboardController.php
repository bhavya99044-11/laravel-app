<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Carbon;
use App\Mail\LoginOtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Helpers\helpers;
use App\Jobs\SendEmailJob;
use App\Models\ProductCart;

class UserDashboardController extends Controller
{

    protected $data=[];

    public function __construct(){
    //    convertDate();
        $this->data['categories']=ProductCategory::with('Products')->get();
        $userId=User::whereId('1')->first();
        $cartToken=Cookie::get('cart_token');

        $this->data['cart_count']=cartCount();
    }

    public function adminPanel(){
        return view('frontend.admin_panel')->with(['data'=>$this->data]);
    }
    public function dashboard()
    {

      $this->data['products']=Product::with('ColorSize','ColorSize.image')->latest()->take(5)->get();
    //   dd($data['products']);
    //   dd($data['products'][0]->ColorSize[0]->image[0]->url);
      return view('frontend.home')->with(['data'=>$this->data]);

    }

    public function loginUser(LoginRequest $request){
       $crede=$request->only(['email','password']);
      Auth::attempt($crede);
      if(Auth::user()){
        if(isset($request->rememberMe) && !empty($request->rememberMe)){
            Cookie::queue('email', Auth::user()->email, time()+60*24*30);

        //    setcookie('password',Auth::user()->password,60*24*30);
        }
        $user=Auth::user();
        $user->update([
             'two_factor_code'=>111111,
        'tow_factor_code_expires_at'=>Carbon::now()->addMinutes(10),
        ]);

        // Mail::to($user->email)->send(new LoginOtpMail($user->two_factor_code));
        return response()->json([
            'status'=>200,
            'msg'=>'logged in'
        ]);
      }else{
        return response()->json([
            'status'=>401,
            'msg'=>'invalid email password'
        ]);
      }
    }


    public function otpVerify(Request $request){
        $user=Auth::user();
        if($user->two_factor_code==$request->otp && $user->tow_factor_code_expires_at > Carbon::now()){

           $user->update([
            'two_factor_code'=>null,
            'tow_factor_code_expires_at'=>null,
           ]);
        //    dd(redirect()->back());
// Session::flash('url',$request->server('HTTP_REFERER'));



           return response()->json([
            'status'=>200,
           'msg'=>'login success'
           ]);
        }else{
            return response()->json([
           'status'=>401,
           'msg'=>'invalid otp or expired'
            ]);
        }
    }

    public function LiveSearch(Request $request)
    {
        try{

        $category = $request->category;
        if ($category == 1) {
            $category = null;
        }
        if($request->value!=null){
        $data = Product::where('product_name', 'Like', '%' . $request->value . '%')
            ->when($category, function ($query) use ($category) {
                $query->where('category_id', '=', $category);
            })
            ->limit(5)
            ->get(['id','product_name']);
            // $html='';
            // foreach($data as $live){
            //    $html.='<li><div data-id='.$live->id.' id="searchClick" style="color:black; " class="search-cursor searchClick">'.$live->product_name.'</div></li>';
            // }
            // $array=array();

            // foreach ($data as $row) {
            //    $array[]=array('id'=>$row->id,'name'=>$row->product_name);

            // }
 $array=json_encode($data);
            return response()->json([
                'status'=>200,
                'data'=>$array
            ]);

        }
    }catch(\Exception $e){
        return response()->json([
            'status'=>400
        ]);
    }
    }
}
