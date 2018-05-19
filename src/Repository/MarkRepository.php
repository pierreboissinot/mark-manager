<?php

namespace App\Repository;

use App\Entity\Mark;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class MarkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mark::class);
    }
    
    public static function getInvalid(MarkRepository $markRepository)
    {
        $qb = $markRepository->createQueryBuilder('m')
            ->where('m.value < 7')
        ;
        
        return $qb;
    }
    
}
