<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SendContactController extends AbstractController
{
    #[Route('/send/contact', name: 'app_send_contact')]
    public function index(): Response
    {
        return $this->render('/contacts/send_contact.html.twig', [
            'controller_name' => 'SendContactController',
        ]);
    }
}
