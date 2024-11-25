<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Http;
use Worksome\Exchange\Facades\Exchange;
use Illuminate\Support\Number;
use App\Models\Payment;
use App\Status;
class RoleController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */

     public static function middleware(): array
     {
         return [
             'auth',
             new Middleware('permission:product create',only:['delete']),
         ];
     }

     function __construct()
    {
        // $this->middleware('permission:create-product', ['only' => ['index']]);

    }
    public function index(Request $request)
    {

        // dd(Status::$status);
        // $data=Payment::find(1);
        Payment::create(['payment_method'=>[Status::Active]]);
    //    dd($data->payment_method,$data->payment_method->value);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {


       return view('role-view');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd(44);
        // dd(Auth()->user->roles->first()->name);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd(2);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
