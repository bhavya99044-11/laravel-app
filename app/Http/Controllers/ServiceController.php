<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Services\ServiceService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $datService;

     public function __construct(ServiceService  $datService){
        $this->datService= $datService;
     }
    public function save(Request $request){
        $data=$request->only(
            'title'
        );
        $resut=$this->datService->save($data);
    }
    public function find($id){
       $data= $this->datService->find($id);
        return view('ServiceView')->with(['data'=>$data]);
    }
}
