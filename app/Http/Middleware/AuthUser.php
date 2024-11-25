<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;


class AuthUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Session::put('url.intended', URL::previous());

        if (auth()->check() && auth()->user()->two_factor_code==null) {

            return $next($request);
        }
        if($request->ajax()){
            return response()->json(['error' => 'Two-factor authentication is required.',
            'status' => 401,
        ]);
        }else{
            return redirect('/login');

        }

    }
}
