<?php

namespace App\Controller;

use App\Entity\Mark;
use App\Entity\Retake;
use App\Repository\DomainRepository;
use App\Repository\MarkRepository;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\MonologBundle\DependencyInjection\Compiler\AddSwiftMailerTransportPass;
use Symfony\Component\HttpFoundation\Request;
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
    
    /**
     * @Route(path = "/admin/mark/retake", name = "mark_retake")
     */
    public function retake(Request $request, MarkRepository $markRepository)
    {
        $id = $request->query->get('id');
        /** @var Mark $mark */
        $mark = $markRepository->find($id);
        $retake = new Retake();
        $retake->setMark($mark);
    
        return $this->redirectToRoute('easyadmin', array(
            'action' => 'new',
            'entity' => 'Retake',
        ));
    }
    
    /**
     * @Route(path = "/admin/student/send-academic-transcript", name = "student_send_academic_transcript")
     */
    public function sendAcademicTranscript(Request $request, DomainRepository $domainRepository, \Swift_Mailer $mailer, StudentRepository $studentRepository)
    {
        $id = $request->query->get('id');
        $student = $studentRepository->find($id);
        $domains = $domainRepository->findAll();
        
        $message = (new \Swift_Message('Synthèse de résultats'))
            ->setFrom('perso@pierreboissinot.me')
            ->setTo('perso@pierreboissinot.me')
            ->setBody(
                $this->renderView(
                    'email/academic_transcript.html.twig',
                    [
                        'domains' => $domains,
                        'studentId' => $id
                    ]
                ),
                'text/html'
            )
        ;
        $mailer->send($message);
    
        $this->addFlash('success', 'Synthèse de résultats envoyé à');
        
        return $this->redirectToRoute('easyadmin', array(
            'action' => 'list',
            'entity' => $request->query->get('entity'),
        ));
    }
    
}