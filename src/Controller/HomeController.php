<?php

namespace App\Controller;

use App\Entity\APropos;
use App\Entity\Mentionslegales;
use App\Repository\EventsRepository;
use App\Repository\HomePageRepository;
use App\Repository\ProsuccessRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function displayEvents(EventsRepository $eventsRepository, ProsuccessRepository $prosuccessRepository, EntityManagerInterface $em, HomePageRepository $homePageRepository): Response
    {
        $lastEvents = $eventsRepository->findBy([], ['id' => 'DESC'], 4, 0);
        $laststories = $prosuccessRepository->findBy([], ['id' => 'DESC'], 2, 0);
        $homePage = $homePageRepository->findOneBy([]);
        $imagePaths = [
            'mtp14.jpg',
            'mtp6.png',
            'mtp2.png',
            'mtp3.png',
            'mtp5.png',
        ];

        return $this->render('index.html.twig', [
            'controller_name' => 'HomeController',
            'lastEvents' => $lastEvents,
            'imagePaths' => $imagePaths,
            'laststories' => $laststories,

            'title' => $homePage->getTitle() ?? 'default',
            'subtitle' => $homePage->getSubtitle(),
            'description' => $homePage->getDescription(),
            'webSiteDescription' => $homePage->getSubDescription(),
            'backgroundImage' => $homePage->getBackgroundImage(),
            'image' => $homePage->getImage(),

            'secondBlocTitle' => $homePage->getSecondBlocTitle(),
            'secondBlocSubTitle' => $homePage->getsecondBlocSubTitle(),
            'secondBlocDescription' => $homePage->getSecondBlocDescription(),
            'secondBlocImage' => $homePage->getSecondBlocImage(),
        ]
        );
    }

    #[Route('/apropos', name: 'a_propos')]
    public function apropos(EntityManagerInterface $em): Response
    {
        $apropos = $em->getRepository(APropos::class)->findAll();

        return $this->render('a_propos.html.twig', [
            'controller_name' => 'HomeController',
            'apropos' => $apropos,
        ]);
    }

    #[Route('/mentionslegales', name: 'mention_legales')]
    public function displayMentionsLegales(EntityManagerInterface $em): Response
    {
        $mentions = $em->getRepository(Mentionslegales::class)->findOneBy([]);

        return $this->render('mentions_legales.html.twig', [
            'controller_name' => 'HomeController',
            'mentions' => $mentions,
        ]);
    }
}
