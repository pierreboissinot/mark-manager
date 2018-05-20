<?php

namespace App\Controller;


use App\Entity\Mark;
use App\Entity\Student;
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
    
            return $this->redirectToRoute('manager_index');
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
}