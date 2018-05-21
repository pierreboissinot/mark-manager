<?php

namespace App\Repository;

use App\Entity\Retake;
use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class RetakeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Retake::class);
    }
    
    public function findByStudent(Student $student)
    {
        $qb = $this->createQueryBuilder('r')
            ->join('r.markToRetake', 'm')
            ->join('m.student', 's')
            ->where('s.id=:studentId')
            ->setParameter('studentId', $student->getId())
            ;
        
        return $qb->getQuery()->getResult();
    }
    
}
