<?php

namespace App\Controller;

use App\Data\SearchEventsData;
use App\Entity\Events;
use App\Entity\Form\SearchEventsForm;
use App\Repository\EventsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class EventsController extends AbstractController
{
    #[Route('/events', name: 'app_events')]
public function displayEvents(EventsRepository $eventsrepo, EntityManagerInterface $em, Request $request): Response
{
    // Recuperation des events pour _carousel
    $lastevents = $em->getRepository(Events::class)->findBy([], ['id' => 'DESC'], 4, 0);

    // Récupérer tous les événements triés par date de création du plus récent au plus ancien
    $allevents = $eventsrepo->findBy([], ['id' => 'DESC']);

    // Search section
    $data = new SearchEventsData();
    $form = $this->createForm(SearchEventsForm::class, $data);
    $form->handleRequest($request);

    return $this->render('events/events.html.twig', [
       'lastevents' => $lastevents,
       'allevents' => $allevents,
       'form' => $form->createView(),
    ]);
}

    #[Route('/events/{id}', name: 'events_card')]
    public function displayEventById(Events $event, Request $request): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $this->getUser();

        return $this->render('events/events_card.html.twig', [
            'event' => $event,
            'user' => $user, 
        ]);
    }

    #[Route('/event_register/{id}', name: 'app_event_register')]
    public function createCurrentAccount(Events $event, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $currentEvent = $entityManager->getRepository(Events::class)->findOneBy(['id' => $event]);

        // Inscrire l'utilisateur à l'événement
        if (null != $user && $currentEvent->getMaxParticipant() > $currentEvent->getNbParticipants()) {
            // $user->addEvent($currentEvent);
            $currentEvent->addUser($user);
            $currentEvent->setNbParticipants($currentEvent->getNbParticipants() + 1);

            $entityManager->persist($user);
            $entityManager->persist($currentEvent);
            $entityManager->flush();

            // Message de succès
            $this->addFlash('success', 'Inscription réussie à l\'événement '.$currentEvent->getTitle());

            return $this->redirectToRoute('app_events');
        }

        $this->addFlash('notConnected', 'Connectez-vous avant de vous inscrire à l\'évenement '.$currentEvent->getTitle());

        // Rediriger vers la page de connexion
        return $this->redirectToRoute('app_login');
    }

    #[Route('/event_unregister/{id}', name: 'app_event_unregister')]
public function unregisterEvent(Events $event, EntityManagerInterface $entityManager): RedirectResponse
{
    $user = $this->getUser();
    $currentEvent = $entityManager->getRepository(Events::class)->findOneBy(['id' => $event]);

    // Vérifier si l'utilisateur est connecté et inscrit à l'événement
    if ($user && $currentEvent->getUsers()->contains($user)) {
        // Retirer l'utilisateur de l'événement
        $currentEvent->removeUser($user);
        $currentEvent->setNbParticipants($currentEvent->getNbParticipants() - 1);

        $entityManager->persist($currentEvent);
        $entityManager->flush();

        // Ajouter un message de succès
        $this->addFlash('success', 'Désinscription réussie de l\'événement '.$currentEvent->getTitle());

        // Rediriger vers la page des événements
        return $this->redirectToRoute('app_events');
    }

    // Ajouter un message d'erreur si l'utilisateur n'est pas inscrit à l'événement
    $this->addFlash('error', 'Vous n\'êtes pas inscrit à cet événement.');

    // Rediriger vers la page des événements
    return $this->redirectToRoute('app_events');
}

}
