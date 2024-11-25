<?php

namespace App\Repositories;

use App\Models\Service;
use Carbon\Carbon;
use DateTime;

class ServiceRepository{

    protected $service;

    public function __construct(Service $service){
        $this->service=$service;
    }

    public function save($data)  {
        $newPost=new $this->service;

        $newPost->title=$data['title'];

        $newPost->save();
        return $newPost->fresh();
    }

    public function find($id){
        $fdate=Service::whereId('2')->first()->created_at;
        $edate=Service::whereId('1')->first()->created_at;
        $dat=$fdate->diff($edate);
        dd($dat->d,$dat->m,$dat->y);
        $result=$this->service->find($id);
     return $result;
    }






}

