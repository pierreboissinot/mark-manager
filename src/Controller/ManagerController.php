<?php

namespace App\Controller;

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
    
}