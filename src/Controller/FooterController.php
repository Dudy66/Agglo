<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FooterController extends AbstractController
{
    #[Route('/footer', 'footer.index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('footer.html.twig');
    }
}
