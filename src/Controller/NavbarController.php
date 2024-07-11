<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavbarController extends AbstractController
{
    #[Route('/navbar', 'navbar.index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('navbar.html.twig');
    }
}
