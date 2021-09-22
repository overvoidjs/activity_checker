<?php

namespace App\Method;

use Yoanm\JsonRpcServer\Domain\JsonRpcMethodInterface;
use App\Repository\ActivityLogRepository;

class PingMethod implements JsonRpcMethodInterface
{

  public function __construct(ActivityLogRepository $activityLogRepository)
  {
      $this->activityLogRepository = $activityLogRepository;
  }

   public function apply(array $paramList = null)
   {

      if(!is_null($paramList)){

        $url = $paramList['url'];

        try {
          $this->activityLogRepository->update_or_create($url);
          $resp = TRUE;
        } catch (\Exception $e) {
          $resp = $e;
        }

        return $resp;
      }

       return 'pong';
   }
}
