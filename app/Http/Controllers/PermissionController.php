<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(){
        return view('permission.create');
    }

    public function create(){
        dd(1);
    }

    public function store(Request $request){
        Permission::create([
            'name'=>$request->name
        ]);
        return back()->with(['success'=>'completed']);
    }

    public function update(){

    }
}
