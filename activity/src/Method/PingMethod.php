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

        $resp = FALSE;
        // $url = $paramList['url'];
        $url = explode("?", $paramList['url'])[0];
        $key = $paramList['key'];

        if($key == 'wowItsSoSecret'){
          try {
            $this->activityLogRepository->update_or_create($url);
            $resp = TRUE;
          } catch (\Exception $e) {
            $resp = FALSE;
          }
        }

        return $resp;
      }

       return 'pong';
   }
}
