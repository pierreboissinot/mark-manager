<?php

namespace App\Controller;

use App\Entity\Mark;
use App\Repository\DomainRepository;
use App\Repository\MarkRepository;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ManagerController extends AbstractController
{
    /**
     * @Route("/", defaults={}, methods={"GET"}, name="manager_index")
     */
    public function index(StudentRepository $students): Response
    {
        $students = $students->findAll();
        return $this->render('manager/index.html.twig', ['students' => $students]);
    }
    
    /**
     * @Route("/academic-transcript/{studentId}", methods={"GET"}, name="manager_academic_transcript")
     */
    public function academicTranscript(int $studentId, DomainRepository $domainRepository): Response
    {
        $domains = $domainRepository->findDomainsByStudent($studentId);
        
        return $this->render('manager/academic_transcript.html.twig', [
            'studentId' => $studentId,
            'domains' => $domains
        ]);
    }
    
}