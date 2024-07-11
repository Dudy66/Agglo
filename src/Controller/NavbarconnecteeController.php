<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NavbarconnecteeController extends AbstractController
{
    #[Route('/navbarconnectee', name: 'app_navbarconnectee')]
    public function index(): Response
    {
        return $this->render('navbarconnectee/index.html.twig', [
            'controller_name' => 'NavbarconnecteeController',
        ]);
    }
}
