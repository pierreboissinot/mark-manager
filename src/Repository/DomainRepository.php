<?php

namespace App\Repository;

use App\Entity\Domain;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class DomainRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Domain::class);
    }
    
    public function findDomainsByStudent(int $studentId)
    {
        $qb = $this->createQueryBuilder('d')
            ->select('d')
            ->innerJoin('d.subjects', 's')
            ->innerJoin('s.marks', 'm')
            ->innerJoin('m.student', 'p')
            ->where('p.id=:studentId')
            ->setParameter('studentId', $studentId)
        ;
        return $qb->getQuery()->getResult();
    }
    
}
