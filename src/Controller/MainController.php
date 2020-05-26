<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PromotionType;
use App\Entity\Promotion;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index(Request $request)
    {
        $promotion = new Promotion($this->container->get('security.token_storage')->getToken()->getUser());
        $form = $this->createForm(PromotionType::class, $promotion);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $promotion = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($promotion);
            $entityManager->flush();

            return $this->redirectToRoute('main');
        }
        
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'form' => $form->createView()
        ]);
    }
}
