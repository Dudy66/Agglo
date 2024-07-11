<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Form\SearchForm;
use App\Entity\Prosuccess;
use App\Repository\ProsuccessRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Knp\Component\Pager\PaginatorInterface;

class SuccessHistoryController extends AbstractController
{
    #[Route('/successhistory', name: 'success_history')]
    public function displayProsuccess(ProsuccessRepository $prosucessrepo, EntityManagerInterface $em, Request $request): Response
    {
        // Gestion des SearchData
        $data = new SearchData();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);

        $allstories = $prosucessrepo->findSearch($data);

        // affichage carrousel
        $laststories = $em->getRepository(Prosuccess::class)->findBy([], ['id' => 'DESC'], 4, 0);

        return $this->render('success_history/history.html.twig', [
            'controller_name' => 'SuccessHistoryController',
            'laststories' => $laststories,
            'allstories' => $allstories,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/successhistory/{id}', name: 'success_history_card')]
    public function displayProsuccessById(Prosuccess $prosucess): Response
    {
        return $this->render('success_history/history_card.html.twig', [
            'prosuccess' => $prosucess,
        ]);
    }
}
