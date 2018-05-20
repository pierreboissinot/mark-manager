<?php

namespace App\Controller;


use App\Entity\Mark;
use App\Entity\Retake;
use App\Entity\Student;
use App\Form\MarkFromRetakeType;
use App\Form\MarkType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MarkController extends AbstractController
{
    /**
     * @Route(path="/mark/{id}", methods={"GET", "POST"}, name="mark_edit")
     */
    public function edit(Request $request, Mark $mark)
    {
        $form = $this->createForm(MarkType::class, $mark);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mark);
            $em->flush();
            
            $this->addFlash('success', "{$mark} mise à jour");
    
            return $this->redirectToRoute('manager_student_marks', [
                'id' => $mark->getStudent()->getId()
            ]);
        }
        
        return $this->render('manager/mark_form.html.twig', [
           'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route(path="/student/{id}/marks/new", methods={"GET", "POST"}, name="mark_new")
     */
    public function new(Request $request, Student $student)
    {
        $mark = new Mark();
        $mark->setStudent($student);
        $form = $this->createForm(MarkType::class, $mark);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mark);
            $em->flush();
            
            return $this->redirectToRoute('manager_index');
        }
        
        return $this->render('manager/mark_form.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route(path="/retake/{id}/mark", methods={"GET", "POST"}, name="mark_new_from_retake")
     */
    public function newMarkFromRetake(Request $request, Retake $retake)
    {
        $mark = new Mark();
        $mark->setStudent($retake->getMarkToRetake()->getStudent());
        $mark->setLabel("Rattrapage de {$retake->getMarkToRetake()},le {$retake->getDeadline()->format('d/m/Y')}");
        $mark->setSubject($retake->getMarkToRetake()->getSubject());
        $form = $this->createForm(MarkFromRetakeType::class, $mark);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mark);
            $retake->setMark($mark);
            $em->persist($retake);
            $em->flush();
            
            return $this->redirectToRoute('manager_student_retakes', [
                'id' => $retake->getMarkToRetake()->getStudent()->getId()
            ]);
        }
        
        return $this->render('manager/mark_form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}