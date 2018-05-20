<?php

namespace App\Repository;

use App\Entity\Mark;
use App\Entity\Student;
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
    
    public function findByStudent(Student $student)
    {
        $qb = $this->createQueryBuilder('m')
            ->join('m.student', 's')
            ->where('s.id=:studentId')
            ->setParameter('studentId', $student->getId())
            ->orderBy('m.date', 'DESC')
            ->getQuery()
        ;
        
        return $qb->getResult();
    }
    
}
