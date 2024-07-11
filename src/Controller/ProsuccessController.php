<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProsuccessController extends AbstractController
{
    #[Route('/prosuccess', name: 'app_prosuccess')]
    public function index(): Response
    {
        return $this->render('prosuccess/index.html.twig', [
            'controller_name' => 'ProsuccessController',
        ]);
    }
}
