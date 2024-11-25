<?php

namespace App\Services;

use App\Repositories\ServiceRepository;
use Exception;
use Illuminate\Container\Attributes\DB;
use Illuminate\Container\Attributes\Log;

class ServiceService{

    protected $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository){

        $this->serviceRepository=$serviceRepository;

    }

    public function save($data){
       $result=$this->serviceRepository->save($data);
       dd($result);
    }

    public function find($id){
        $result=$this->serviceRepository->find($id);
        return $result;
    }


}
