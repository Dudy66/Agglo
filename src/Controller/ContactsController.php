<?php

namespace App\Controller;

use App\Entity\Contacts;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContactsController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/contacts', name: 'app_contacts')]
    public function index(Request $request): Response
    {
        $contact = new Contacts();
        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setDate(new \DateTime());
            $this->entityManager->persist($contact);
            $this->entityManager->flush();

            // Rediriger ou afficher un message de confirmation
            return $this->redirectToRoute('app_send_contact');
        }

        return $this->render('contacts/index.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'ContactsController',
        ]);
    }
}
