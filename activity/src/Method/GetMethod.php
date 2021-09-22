<?php

namespace App\Method;

use Yoanm\JsonRpcServer\Domain\JsonRpcMethodInterface;
use App\Repository\ActivityLogRepository;

class GetMethod implements JsonRpcMethodInterface
{

  public function __construct(ActivityLogRepository $activityLogRepository)
  {
      $this->activityLogRepository = $activityLogRepository;
  }

   public function apply(array $paramList = null)
   {
     $resp = FALSE;

     if(!is_null($paramList)){

       $key = $paramList['key'];

       if($key == 'wowItsSoSecret'){
        $resp = $this->activityLogRepository->get_all();
       }

     }

       return $resp;
   }
}
