<?php

namespace App\Controller;


use App\Entity\Mark;
use App\Entity\Retake;
use App\Form\RetakeType;
use App\Repository\MarkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RetakeController extends AbstractController
{
    /**
     * @Route("/retake/new/{markId}/{domainId}", methods={"GET", "POST"}, name="retake_new")
     */
    public function new(Request $request, int $markId = null, int $domainId = null, MarkRepository $markRepository)
    {
        $retake = new Retake();
        $options = [];
        if (!empty($markId)) {
            /** @var Mark $mark */
            $mark = $markRepository->find($markId);
            $retake->setMark($mark);
        } elseif (!empty($domainId)) {
            $options['domainId'] = $domainId;
        }
        $form = $this->createForm(RetakeType::class, $retake, $options);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($retake);
            $em->flush();
        
            return $this->redirectToRoute('manager_index');
        }
        
        return $this->render('manager/retake_form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}