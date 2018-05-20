<?php

namespace App\Controller;

use App\Entity\Mark;
use App\Entity\Retake;
use App\Entity\Student;
use App\Repository\DomainRepository;
use App\Repository\MarkRepository;
use App\Repository\RetakeRepository;
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
     * @Route("/academic-transcript/{id}", methods={"GET"}, name="manager_academic_transcript")
     */
    public function academicTranscript(Student $student, DomainRepository $domainRepository): Response
    {
        $domains = $domainRepository->findDomainsByStudent($student->getId());
        
        return $this->render('manager/academic_transcript.html.twig', [
            'student' => $student,
            'domains' => $domains,
            'purpose' => 'action'
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
        $retake->setMarkToRetake($mark);
    
        return $this->redirectToRoute('easyadmin', array(
            'action' => 'new',
            'entity' => 'Retake',
        ));
    }
    
    /**
     * @Route(path = "/student/{id}/send-academic-transcript/send", name = "student_send_academic_transcript")
     */
    public function sendAcademicTranscript(DomainRepository $domainRepository, \Swift_Mailer $mailer, Student $student)
    {
        $domains = $domainRepository->findAll();
        
        $message = (new \Swift_Message('Synthèse de résultats'))
            ->setFrom('perso@pierreboissinot.me')
            ->setTo($student->getEmail())
            ->setBody(
                $this->renderView(
                    'email/academic_transcript.html.twig',
                    [
                        'domains' => $domains,
                        'student' => $student,
                        'purpose' => 'view'
                    ]
                ),
                'text/html'
            )
        ;
        $mailer->send($message);
    
        $this->addFlash('success', "Synthèse de résultats envoyé à {$student->getEmail()}");
        
        return $this->redirectToRoute('manager_academic_transcript', array(
            'id' => $student->getId(),
            'purpose' => 'view'
        ));
    }
    
    /**
     * @Route(path="/student/{id}/marks", methods={"GET"}, name="manager_student_marks")
     */
    public function studentMarks(Student $student, MarkRepository $markRepository, StudentRepository $studentRepository)
    {
        $marks = $markRepository->findBy([
            'student' => $student
        ]);
        
        return $this->render('manager/student_marks.html.twig', [
            'student' => $student,
            '$marks' => $marks
        ]);
    }
    
    /**
     * @Route(path="/student/{id}/retakes", methods={"GET"}, name="manager_student_retakes")
     */
    public function studentRetakes(Student $student, RetakeRepository $retakeRepository)
    {
        $retakes = $retakeRepository->findByStudent($student);
        return $this->render('manager/student_retakes.html.twig', [
            'student' => $student,
            'retakes' => $retakes
        ]);
    }
    
}