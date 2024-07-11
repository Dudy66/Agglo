<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ActivityareaController extends AbstractController
{
    #[Route('/activity/area', name: 'app_activity_area')]
    public function index(): Response
    {
        return $this->render('activity_area/index.html.twig', [
            'controller_name' => 'ActivityareaController',
        ]);
    }
}
