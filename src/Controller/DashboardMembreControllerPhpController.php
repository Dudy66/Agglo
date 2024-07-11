<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardMembreControllerPhpController extends AbstractController
{
    #[Route('/dashboard/membre', name: 'app_dashboard_membre_controller_php')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        $form = $this->createFormBuilder($user)
            ->add('firstName', null, [
                'label' => 'Prénom',
            ])
            ->add('lastName', null, [
                'label' => 'Nom',
            ])
            ->add('email', null, [
                'label' => 'Email',
            ])

            ->add('address', null, [
                'label' => 'Adresse',
            ])
            ->add('birthdate', null, [
                'label' => 'Date de naissance',
            ])

            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Vos informations ont été mises à jour avec succès.');

            return $this->redirectToRoute('app_dashboard_membre_controller_php');
        }

        return $this->render('dashboardMembre.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
