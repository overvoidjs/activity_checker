<?php

namespace App\Repository;

use App\Entity\ActivityLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ActivityLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActivityLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActivityLog[]    findAll()
 * @method ActivityLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivityLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActivityLog::class);
    }

    public function update_or_create(string $url){
      $datetime = date('Y-m-d H:i:s');

      $em = $this->getEntityManager();

      $log = $em->getRepository(ActivityLog::class)->findOneBy(['url'=>$url]);

      if(!$log){
        $log = new ActivityLog();
        $hit = 1;
      } else {
        $hit = $log->getHits() + 1;
      }

      $log->setUrl($url);
      $log->setHits((int)$hit);
      $log->setLastDate($datetime);

      $em->persist($log);

      $em->flush();

      return $log->getId();
    }
}
