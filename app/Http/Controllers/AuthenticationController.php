<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function login(Request $request){
        $data=$request->only(['email','password']);
      if(Auth::attempt($data)){
                $user=Auth::user();
                $user->generateTwofactorCode();
                $request->session(['two_factor_code'=>$user->two_factor_code]);;

            return view('two-factor');
      }
    }

    public function twoFactor(Request $request){
        $user=Auth::user();
        dd(now());

        $data=now()->diff($user->tow_factor_code_expires_at);
        dd($data->s);
        if($data->s && $data->m && $data->h && $data->y <=0 ){
            dd(2);
        }
        dd(1);
    }
}
